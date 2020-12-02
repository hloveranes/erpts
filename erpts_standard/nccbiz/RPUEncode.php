<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/LocationAddress.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/OD.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/TD.php";

include_once "../includes/assessor/LandClasses.php";
include_once "../includes/assessor/LandSubclasses.php";
include_once "../includes/assessor/LandActualUses.php";

include_once "../includes/assessor/PlantsTreesClasses.php";
include_once "../includes/assessor/PlantsTreesActualUses.php";
include_once "../includes/assessor/ImprovementsBuildingsClasses.php";
include_once "../includes/assessor/ImprovementsBuildingsActualUses.php";
include_once "../includes/assessor/MachineriesClasses.php";
include_once "../includes/assessor/MachineriesActualUses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('RPUEncode');
$server->handle();
//*/

class RPUEncode
{
    function RPUEncode(){
		
    }

	function isRPUOkForCancellation($odID){
		$od = new OD;
		if($od->selectRecord($odID)){
			$afs = new AFS;
			if($afs->selectRecord("","",$odID)){
				$afsID = $afs->afsID;
				$td = new TD;
				if($td->selectRecord("",$afsID)){
					return false;
				}
			}
		}
		return true;
	}

	function cancelRPU($odID,$userID,$transactionCode="CA"){
		$od = new OD;
		$od->selectRecord($odID);
		$od->archive = "true";
		$od->modifiedBy = $userID;
		$od->transactionCode = $transactionCode;

		$afs = new AFS;
		$afs->selectRecord("","",$odID);
		$afsID = $afs->afsID;

		$afs->archive = "true";
		$afs->modifiedBy = $userID;

		// NCC Modification checked and implemented by K2 : November 16, 2005
		// details:
		//    added lines 70-76, 79 ($td related)
		$td = new TD;
		$td->selectRecord("",$afsID);
		$tdID = $td->tdID;

		$td->archive = "true";
		$td->modifiedBy = $userID;

		$od->cancelRecord($odID,"true",$userID,$transactionCode);
		$afs->archiveRecord($afsID,"true",$userID);
		$td->archiveRecord($tdID,"true",$userID);

		return true;
	}

	// NCC Modification checked and implemented by K2 : November 16, 2005
	// details:
	//    added function RunGeneralRevisionBrgy() in line 88

	function RunGeneralRevisionBrgy($odID,$userID="",$transactionCode="GR"){
		$newOdID = $this->CreateNewRPU_AFS_TDGenRevBrgy($odID,$userID,$transactionCode);

		// archive old OD

		$oldOD = new OD;
		$oldOD->selectRecord($odID);
		$oldOD->archive = "true";
		$oldOD->modifiedBy = $userID;

		$oldOD->updateRecord();

				// using archiveRecord 'might' be faster
				//$oldOD->archiveRecord($odID,"true",$userID);

		// update new OD/AFS

		$newAFS = new AFS;
		$newAFS->selectRecord($afsID="", $limit="", $newOdID);
		$newAFS->modifiedBy = $userID;
		$newAFS->effectivity = date("Y") + 1;

		$newAFS->updateRecord();

		return $newOdID;
	}

	function RunGeneralRevision($odID,$userID="",$transactionCode="GR"){
		$newOdID = $this->CreateNewRPU_AFS_TD($odID,$userID,$transactionCode);

		// archive old OD

		$oldOD = new OD;
		$oldOD->selectRecord($odID);
		$oldOD->archive = "true";
		$oldOD->modifiedBy = $userID;

		$oldOD->updateRecord();

				// using archiveRecord 'might' be faster
				//$oldOD->archiveRecord($odID,"true",$userID);

		// update new OD/AFS

		$newAFS = new AFS;
		$newAFS->selectRecord($afsID="", $limit="", $newOdID);
		$newAFS->modifiedBy = $userID;
		$newAFS->effectivity = date("Y") + 1;

		$newAFS->updateRecord();

		return $newOdID;
	}

    function ConsolidateRPU($odIDArray,$transactionCode="CS"){
		$od = new OD;
		$od->selectRecord($odIDArray[0]);

		$od->setTransactionCode($transactionCode);
		$od->oldODArray = $odIDArray;

		$newOdID = $od->insertRecord();
		return $newOdID;
	}

    function CreateNewRPU_AFS_TD($odID,$userID="",$transactionCode="",$copyOwner=true,$copyAFS=true,$copyTD=false){
		$od = new OD;
		$od->selectRecord($odID);
		unset($od->oldODArray);

		$od->setTransactionCode($transactionCode);
		$od->setOldODArray($odID);

		// create new OD

		$ownerID = $od->owner->getOwnerID();

		$newOdID = $od->insertRecord();
		$newOwnerID = $od->newOwnerID;

		$od->setDomDocument();
		
		// associate existing Owner to new OD
		
		$owner = new Owner;

		$owner->selectRecord($ownerID);

		if (count($owner->personArray)){
			foreach($owner->personArray as $personKey =>$personValue){
				if($copyOwner){
					$owner->insertOwnerPerson($newOwnerID,$personValue->getPersonID());
				}
			}
		}

		if (count($owner->companyArray)){
			foreach ($owner->companyArray as $companyKey => $companyValue){
				if($copyOwner){
					$owner->insertOwnerCompany($newOwnerID,$companyValue->getCompanyID());
				}
			}
		}

		// create new AFS and associate existing properties to new AFS
		
		$afs = new AFS;
		$afsID = $afs->checkAfsID($odID);
		$afs->selectRecord($afsID);

		$afs->setOdID($newOdID);
		$afs->effectivity = date("Y") + 1;

		// new arpNumber is blank
		$afs->arpNumber = "";

		// retain PIN except for Consolidation and Subdivision
		if($transactionCode=="SD" || $transactionCode=="CS"){
			$afs->propertyIndexNumber = "";
		}

		$afs->setDomDocument();

		if($copyAFS){
			$newAfsID = $afs->insertRecord();
			if (count($afs->landArray)){
				foreach ($afs->landArray as $landKey => $landValue){
					$landValue->setPropertyID("");
					$landValue->setAfsID($newAfsID);
					$landValue->propertyAdministrator->setPersonID("");

					// set unitValue from SubClass
					$landSubclasses = new LandSubclasses;
					$landSubclasses->selectRecord(intVal($landValue->subClass));
					$landValue->setUnitValue($landSubclasses->getValue());

					// set assessmentLevel from ActualUse
					$landActualUses = new LandActualUses;
					$landActualUses->selectRecord(intVal($landValue->actualUse));
					$landValue->setAssessmentLevel($landActualUses->getValue());

					$landValue->calculateMarketValue();
					$landValue->calculateValueAdjustment();
					$landValue->calculateAdjustedMarketValue();
					$landValue->calculateAssessedValue();

					$newP = $landValue->insertRecord();
				}
			}
			if (count($afs->plantsTreesArray)){
				foreach ($afs->plantsTreesArray as $plantsTreesKey => $plantsTreesValue){
					$plantsTreesValue->setPropertyID("");
					$plantsTreesValue->setAfsID($newAfsID);
					$plantsTreesValue->propertyAdministrator->setPersonID("");

					// set unitPrice from ProductClass
					$plantsTreesClasses = new PlantsTreesClasses;
					$plantsTreesClasses->selectRecord(intVal($plantsTreesValue->productClass));
					$plantsTreesValue->setUnitPrice($plantsTreesClasses->getValue());

					// set assessmentLevel from ActualUse
					$plantsTreesActualUses = new PlantsTreesActualUses;
					$plantsTreesActualUses->selectRecord(intVal($plantsTreesValue->actualUse));
					$plantsTreesValue->setAssessmentLevel($plantsTreesActualUses->getValue());

					$plantsTreesValue->calculateMarketValue();
					$plantsTreesValue->calculateValueAdjustment();
					$plantsTreesValue->calculateAdjustedMarketValue();
					$plantsTreesValue->calculateAssessedValue();

					$newP = $plantsTreesValue->insertRecord();
				}
			}
			if (count($afs->improvementsBuildingsArray)){
				foreach ($afs->improvementsBuildingsArray as $improvementsBuildingsKey => $improvementsBuildingsValue){
					$improvementsBuildingsValue->setPropertyID("");
					$improvementsBuildingsValue->setAfsID($newAfsID);
					$improvementsBuildingsValue->propertyAdministrator->setPersonID("");				
					// set unitValue from BuildingClassification
					$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
					$improvementsBuildingsClasses->selectRecord(intVal($improvementsBuildingsValue->buildingClassification));
					$improvementsBuildingsValue->setUnitValue($improvementsBuildingsClasses->getValue());

					// this if() line added : November 05 2004:
					// if master table unit value is not 0, update this unit value with the master table unit value
					// otherwise, retain this unit value as it is the old one.
					if($improvementsBuildingsClasses->getValue()!=0){
						$improvementsBuildingsValue->setUnitValue($improvementsBuildingsClasses->getValue());
					}

					// set assessmentLevel from ActualUse
					$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
					$improvementsBuildingsActualUses->selectRecord(intVal($improvementsBuildingsValue->actualUse));
					$improvementsBuildingsValue->setAssessmentLevel($improvementsBuildingsActualUses->getValue());

					$improvementsBuildingsValue->calculateMarketValue();
					$improvementsBuildingsValue->calculateAccumulatedDepreciation();
					$improvementsBuildingsValue->calculatedDepreciatedMarketValue();
					$improvementsBuildingsValue->calculateAdjustedMarketValue();
					$improvementsBuildingsValue->calculateAssessedValue();

					$newP = $improvementsBuildingsValue->insertRecord();
				}
			}
			if (count($afs->machineriesArray)){
				foreach ($afs->machineriesArray as $machineriesKey => $machineriesValue){
					$machineriesValue->setPropertyID("");
					$machineriesValue->setAfsID($newAfsID);
					$machineriesValue->propertyAdministrator->setPersonID("");

					// set assessmentLevel from ActualUse
					$machineriesActualUses = new MachineriesActualUses;
					$machineriesActualUses->selectRecord(intVal($machineriesValue->actualUse));
					$machineriesValue->setAssessmentLevel($machineriesActualUses->getValue());

					$machineriesValue->calculateMarketValue();
					$machineriesValue->calculateDepreciatedMarketValue();
					$machineriesValue->calculateAdjustedMarketValue();
					$machineriesValue->calculateAssessedValue();

					$newP = $machineriesValue->insertRecord();
				}
			}
		}

		return $newOdID;
		echo "OD - ".$odID."->".$newOdID."<br>";
		echo "Owner - ".$ownerID."->".$newOwnerID."<br>";
		echo "AFS - ".$afsID."->".$newAfsID."<br>".$newP;
	}

	// NCC Modification checked and implemented by K2 : November 16, 2005
	// details:
	//	    added function CreateNewRPU_AFS_TDGenRevBrgy() in line 324
	//		slight modification made to default memoranda with addition of GENERALREVISION_DEFAULT_MEMORANDA (defined in constants.php)

	//alex:
    function CreateNewRPU_AFS_TDGenRevBrgy($odID,$userID="",$transactionCode="",$copyOwner=true,$copyAFS=true,$copyTD=true){

		$link = mysql_connect(MYSQLDBHOST, MYSQLDBUSER, MYSQLDBPWD);
		mysql_select_db(MYSQLDBNAME, $link);
		$sql = "select Person.firstName, Person.lastName from Person, Owner, OwnerPerson ".
				"where Person.personID = OwnerPerson.personID and OwnerPerson.ownerID = Owner.ownerID and Owner.odID = ".$odID;
		$rs = mysql_query($sql,$link);
		$prevowners = '';
		while ($row = mysql_fetch_assoc($rs)) {
			$prevowners .= $row['firstName'].' '.$row['lastName'].', ';
		}
		$prevowners = substr($prevowners,0,strlen($prevowners)-2);

		$sql = "select AFS.totalAssessedValue from AFS where AFS.odID = ".$odID;
		$rs = mysql_query($sql,$link);
		$prevassdval = 0;
		if ($row = mysql_fetch_assoc($rs)) {
			$prevassdval = $row['totalAssessedValue'];
		}


		$od = new OD;
		$od->selectRecord($odID);
		unset($od->oldODArray);

		$od->setTransactionCode($transactionCode);
		$od->setOldODArray($odID);

		// create new OD

		$ownerID = $od->owner->getOwnerID();

		$newOdID = $od->insertRecord();
		$newOwnerID = $od->newOwnerID;

		$od->setDomDocument();
		
		// associate existing Owner to new OD
		
		$owner = new Owner;

		$owner->selectRecord($ownerID);

		if (count($owner->personArray)){
			foreach($owner->personArray as $personKey =>$personValue){
				if($copyOwner){
					$owner->insertOwnerPerson($newOwnerID,$personValue->getPersonID());
				}
			}
		}

		if (count($owner->companyArray)){
			foreach ($owner->companyArray as $companyKey => $companyValue){
				if($copyOwner){
					$owner->insertOwnerCompany($newOwnerID,$companyValue->getCompanyID());
				}
			}
		}

		// create new AFS and associate existing properties to new AFS
		
		$afs = new AFS;
		$afsID = $afs->checkAfsID($odID);
		$afs->selectRecord($afsID);

		$afs->setOdID($newOdID);
		$afs->effectivity = date("Y") + 1;

		// new arpNumber is blank
		//$afs->arpNumber = "";

		// retain PIN except for Consolidation and Subdivision
		//if($transactionCode=="SD" || $transactionCode=="CS"){
			$afs->propertyIndexNumber = "";
		//}

		$afs->setDomDocument();
		$newAFSID = $afs->insertRecord();
		$afs->arpNumber = '(' . $newAFSID . ')';
		$afs->updateRecord();

		if($copyAFS){

			if($copyTD){
				$td = new TD;
				$td->taxDeclarationNumber = $afs->arpNumber;
				$td->afsID = $newAFSID;
				$td->previousOwner = $prevowners;
				$td->previousAssessedValue = $prevassdval;

				$td->setDomDocument();
				$newTDID = $td->insertRecord();
			}
			
			if (count($afs->landArray)){
				foreach ($afs->landArray as $landKey => $landValue){
					$landValue->setPropertyID("");
					$landValue->setAfsID($newAFSID);
					$landValue->propertyAdministrator->setPersonID("");

					// set unitValue from SubClass
					$landSubclasses = new LandSubclasses;
					$landSubclasses->selectRecord(intVal($landValue->subClass));
					$landValue->setUnitValue($landSubclasses->getValue());

					// set assessmentLevel from ActualUse
					$landActualUses = new LandActualUses;
					$landActualUses->selectRecord(intVal($landValue->actualUse));
					$landValue->setAssessmentLevel($landActualUses->getValue());

					$landValue->calculateMarketValue();
					$landValue->calculateValueAdjustment();
					$landValue->calculateAdjustedMarketValue();
					$landValue->calculateAssessedValue();

					$landValue->memoranda = GENERALREVISION_DEFAULT_MEMORANDA;
					$landValue->appraisedByDate = "";
					$landValue->recommendingApprovalDate = "";
					$landValue->approvedByDate = "";
					$newP = $landValue->insertRecord();
				}
			}
			if (count($afs->plantsTreesArray)){
				foreach ($afs->plantsTreesArray as $plantsTreesKey => $plantsTreesValue){
					$plantsTreesValue->setPropertyID("");
					$plantsTreesValue->setAfsID($newAFSID);
					$plantsTreesValue->propertyAdministrator->setPersonID("");

					// set unitPrice from ProductClass
					$plantsTreesClasses = new PlantsTreesClasses;
					$plantsTreesClasses->selectRecord(intVal($plantsTreesValue->productClass));
					$plantsTreesValue->setUnitPrice($plantsTreesClasses->getValue());

					// set assessmentLevel from ActualUse
					$plantsTreesActualUses = new PlantsTreesActualUses;
					$plantsTreesActualUses->selectRecord(intVal($plantsTreesValue->actualUse));
					$plantsTreesValue->setAssessmentLevel($plantsTreesActualUses->getValue());

					$plantsTreesValue->calculateMarketValue();
					$plantsTreesValue->calculateValueAdjustment();
					$plantsTreesValue->calculateAdjustedMarketValue();
					$plantsTreesValue->calculateAssessedValue();

					$plantsTreesValue->memoranda = GENERALREVISION_DEFAULT_MEMORANDA;
					$plantsTreesValue->appraisedByDate = "";
					$plantsTreesValue->recommendingApprovalDate = "";
					$plantsTreesValue->approvedByDate = "";
					$newP = $plantsTreesValue->insertRecord();
				}
			}
			if (count($afs->improvementsBuildingsArray)){
				foreach ($afs->improvementsBuildingsArray as $improvementsBuildingsKey => $improvementsBuildingsValue){
					$improvementsBuildingsValue->setPropertyID("");
					$improvementsBuildingsValue->setAfsID($newAFSID);
					$improvementsBuildingsValue->propertyAdministrator->setPersonID("");				

					// set unitValue from BuildingClassification
					$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
					$improvementsBuildingsClasses->selectRecord(intVal($improvementsBuildingsValue->buildingClassification));
					$improvementsBuildingsValue->setUnitValue($improvementsBuildingsClasses->getValue());

					// set assessmentLevel from ActualUse
					$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
					$improvementsBuildingsActualUses->selectRecord(intVal($improvementsBuildingsValue->actualUse));
					$improvementsBuildingsValue->setAssessmentLevel($improvementsBuildingsActualUses->getValue());

					$improvementsBuildingsValue->calculateMarketValue();
					$improvementsBuildingsValue->calculateAccumulatedDepreciation();
					$improvementsBuildingsValue->calculatedDepreciatedMarketValue();
					$improvementsBuildingsValue->calculateAdjustedMarketValue();
					$improvementsBuildingsValue->calculateAssessedValue();

					$improvementsBuildingsValue->memoranda = GENERALREVISION_DEFAULT_MEMORANDA;
					$improvementsBuildingsValue->appraisedByDate = "";
					$improvementsBuildingsValue->recommendingApprovalDate = "";
					$improvementsBuildingsValue->approvedByDate = "";
					$newP = $improvementsBuildingsValue->insertRecord();
				}
			}
			if (count($afs->machineriesArray)){
				foreach ($afs->machineriesArray as $machineriesKey => $machineriesValue){
					$machineriesValue->setPropertyID("");
					$machineriesValue->setAfsID($newAFSID);
					$machineriesValue->propertyAdministrator->setPersonID("");

					// set assessmentLevel from ActualUse
					$machineriesActualUses = new MachineriesActualUses;
					$machineriesActualUses->selectRecord(intVal($machineriesValue->actualUse));
					$machineriesValue->setAssessmentLevel($machineriesActualUses->getValue());

					$machineriesValue->calculateMarketValue();
					$machineriesValue->calculateDepreciatedMarketValue();
					$machineriesValue->calculateAdjustedMarketValue();
					$machineriesValue->calculateAssessedValue();

					$machineriesValue->memoranda = GENERALREVISION_DEFAULT_MEMORANDA;
					$machineriesValue->appraisedByDate = "";
					$machineriesValue->recommendingApprovalDate = "";
					$machineriesValue->approvedByDate = "";
					$newP = $machineriesValue->insertRecord();
				}
			}
		}

		$sql = "update AFS set archive = 'true' where AFS.odID = " . $odID;
		mysql_query($sql, $link);

		$sql = "update OD set archive = 'true' where OD.odID = " . $odID;
		mysql_query($sql, $link);

		$sql = "update TD set archive = 'true' where TD.afsID = " . $afsID;
		mysql_query($sql, $link);

		mysql_close($link);

		return $newOdID;
		echo "OD - ".$odID."->".$newOdID."<br>";
		echo "Owner - ".$ownerID."->".$newOwnerID."<br>";
		echo "AFS - ".$afsID."->".$newAFSID."<br>".$newP;
	}
}
/*
$odID = 68;
$obj = new RPUEncode;
echo $obj->CreateNewRPU_AFS_TD($odID);
//*/
?>