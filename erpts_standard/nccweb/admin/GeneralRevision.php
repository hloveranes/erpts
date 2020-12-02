<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

include_once "../includes/assessor/Barangay.php";
include_once "../includes/assessor/BarangayRecords.php";

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

#####################################
# Define Interface Class
#####################################
class GeneralRevision{
	
	var $tpl;
	var $countBackDays;
	function GeneralRevision($http_post_vars,$http_get_vars,$sess){

//,$formAction,$totalArchived,$totalCreated,$message,$barang
		global $auth;

		// this will attempt to count "latest active RPUs" that have NOT undergone general revision for the
		// past X number of days from today
		$this->countBackDays = 30;
		$this->countBackDaysTimeStr = strtotime("-".$this->countBackDays." days");

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must be Super-User to access
		$pageType = "1%%%%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->userID = $auth->auth["uid"];
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "GeneralRevision.htm") ;
		$this->tpl->set_var("TITLE", "General Revision");
		$this->tpl->set_var("Session", $this->sess->url(""));

		$this->formArray = array(
			"formAction" => $http_get_vars["formAction"]
			,"barangayID" => $http_get_vars["barangayID"]
			,"totalArchived" => $http_get_vars["totalArchived"]
			,"totalCreated" => $http_get_vars["totalCreated"]
			,"message" => $http_get_vars["message"]
			,"countBackDays" => $this->countBackDays
			,"countBackDaysTimeStr" => $this->countBackDaysTimeStr
			,"progressLog" => $http_get_vars["progressLog"]
			,"timerStart" => $http_get_vars["timerStart"]
			,"timerEnd" => $http_get_vars["timerEnd"]
		);

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function initBarangayList(){
		$this->tpl->set_block("rptsTemplate", "BarangayList", "BarangayListBlock");
	    $BarangayList = new SoapObject(NCCBIZ."BarangayList.php", "urn:Object");
		if (!$xmlStr = $BarangayList->getBarangayList(0, " WHERE ".BARANGAY_TABLE.".status='active' ORDER BY description")){
		   $this->tpl->set_var("barangayID", "");
           $this->tpl->set_var("barangay", "empty barangay list");
		   $this->tpl->parse("BarangayListBlock", "BarangayList", true);
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
			   $this->tpl->set_var("barangayID", "");
	           $this->tpl->set_var("barangay", "empty barangay list");
			   $this->tpl->parse("BarangayListBlock", "BarangayList", true);
			}
			else{
				$barangayRecords = new BarangayRecords;
				$barangayRecords->parseDomDocument($domDoc);
				if(is_array($barangayRecords->arrayList)){
					foreach ($barangayRecords->arrayList as $key => $value){
	          			$this->tpl->set_var("barangayID", $value->getBarangayID());
	               		$this->tpl->set_var("barangay", $value->getDescription());
				        $this->tpl->parse("BarangayListBlock", "BarangayList", true);
					}
				}
			}
		}
	}

	function getLatestActiveRPUsByBarangay($barangayID){
		$latestActiveRPUs = 0;
		$db = new DB_RPTS;

        $sql = "SELECT COUNT(" . OD_TABLE . ".odID) as count "
			."FROM ".OD_TABLE. " "
			."LEFT JOIN ".LOCATION_TABLE." "
			."ON ".OD_TABLE.".odID = ".LOCATION_TABLE.".odID "
			."LEFT JOIN ".LOCATIONADDRESS_TABLE." "
			."ON ".LOCATION_TABLE.".locationAddressID=".LOCATIONADDRESS_TABLE.".locationAddressID "
			."LEFT JOIN ".BARANGAY_TABLE." "
			."ON ".BARANGAY_TABLE.".barangayID=".LOCATIONADDRESS_TABLE.".barangayID "
			."LEFT JOIN ".ODHISTORY_TABLE." "
			."ON ".OD_TABLE.".odID = ".ODHISTORY_TABLE.".previousODID "
			."WHERE ".BARANGAY_TABLE.".barangayID='".fixQuotes($barangayID)."' "
			."AND ".ODHISTORY_TABLE.".previousODID IS NULL "
			."AND ((".OD_TABLE.".transactionCode='GR' AND ".OD_TABLE.".dateCreated <= ".fixQuotes($this->formArray["countBackDaysTimeStr"]).") "
			."OR (".OD_TABLE.".transactionCode!='GR'))";

		$db->query($sql);
		if($db->next_record()){
			$latestActiveRPUs = $db->f("count");
		}
		return $latestActiveRPUs;
	}

	function getLatestActiveRPUs(){
		$latestActiveRPUs = 0;
		$db = new DB_RPTS;
		$sql = "SELECT COUNT(".OD_TABLE.".odID) as count FROM ".OD_TABLE
				." LEFT JOIN ".ODHISTORY_TABLE
				." ON ".OD_TABLE.".odID = ".ODHISTORY_TABLE.".previousODID"
				." WHERE ".ODHISTORY_TABLE.".previousODID IS NULL "
				."AND ((".OD_TABLE.".transactionCode='GR' AND ".OD_TABLE.".dateCreated <= ".fixQuotes($this->formArray["countBackDaysTimeStr"]).") "
				."OR (".OD_TABLE.".transactionCode!='GR'))";

		$db->query($sql);
		if($db->next_record()){
			$latestActiveRPUs = $db->f("count");
		}
		return $latestActiveRPUs;
	}
	
	// NCC Modification checked and implemented by K2 : November 17, 2005
	// details:
	//	    added function CreateNewRPU_AFS_TDGenRevBrgy() in line 161 (taken from nccbiz/RPUEncode.php)
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
					if(is_object($landValue->propertyAdministrator)){
						$landValue->propertyAdministrator->setPersonID("");
					}
					else{
						$landValue->propertyAdministrator = new Person;
						$landValue->propertyAdministrator->setPersonID("");
					}

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
					if(is_object($plantsTreesValue->propertyAdministrator)){
						$plantsTreesValue->propertyAdministrator->setPersonID("");
					}
					else{
						$plantsTreesValue->propertyAdministrator = new Person;
						$plantsTreesValue->propertyAdministrator->setPersonID("");
					}

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
					if(is_object($improvementsBuildingsValue->propertyAdministrator)){
						$improvementsBuildingsValue->propertyAdministrator->setPersonID("");
					}
					else{
						$improvementsBuildingsValue->propertyAdministrator = new Person;
						$improvementsBuildingsValue->propertyAdministrator->setPersonID("");
					}

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
					if(is_object($machineriesValue->propertyAdministrator)){
						$machineriesValue->propertyAdministrator->setPersonID("");
					}
					else{
						$machineriesValue->propertyAdministrator = new Person;
						$machineriesValue->propertyAdministrator->setPersonID("");
					}


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
	}
	
	// NCC Modification checked and implemented by K2 : November 17, 2005
	// details:
	//    added function RunGeneralRevisionBrgy() in line 570 (taken from nccbiz/RPUEncode.php)

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

	function run($barangayID){
		// get od list by barangay
		$this->formArray["progressLog"] = "gathering RPUs...";

		$db = new DB_RPTS;

        $sql = "SELECT ".OD_TABLE.".odID as odID "
			."FROM ".OD_TABLE. " "
			."LEFT JOIN ".LOCATION_TABLE." "
			."ON ".OD_TABLE.".odID = ".LOCATION_TABLE.".odID "
			."LEFT JOIN ".LOCATIONADDRESS_TABLE." "
			."ON ".LOCATION_TABLE.".locationAddressID=".LOCATIONADDRESS_TABLE.".locationAddressID "
			."LEFT JOIN ".BARANGAY_TABLE." "
			."ON ".BARANGAY_TABLE.".barangayID=".LOCATIONADDRESS_TABLE.".barangayID "
			."LEFT JOIN ".ODHISTORY_TABLE." "
			."ON ".OD_TABLE.".odID = ".ODHISTORY_TABLE.".previousODID "
			."WHERE ".BARANGAY_TABLE.".barangayID='".fixQuotes($barangayID)."' "
			."AND ".ODHISTORY_TABLE.".previousODID IS NULL "
			."AND ((".OD_TABLE.".transactionCode='GR' AND ".OD_TABLE.".dateCreated <= ".fixQuotes($this->formArray["countBackDaysTimeStr"]).") "
			."OR (".OD_TABLE.".transactionCode!='GR'))";

		$db->query($sql);
		$this->formArray["totalCreated"] = 0;
		$ctr = 0;

		$this->formArray["progressLog"] = "RPUs gathered...";
		$total = $db->nf();
		while($db->next_record()){
			$ctr++;
			
			// NCC Modification checked and implemented by K2 : November 17, 2005
			// details:
			//		commented out link 659 that uses $this->RunGeneralRevision();
			//		added line 660 that uses $this->RunGeneralRevisionBrgy(); 
					
			//$newODID = $this->RunGeneralRevision($db->f("odID"),$this->userID,"GR");
			$newODID = $this->RunGeneralRevisionBrgy($db->f("odID"),$this->userID,"GR");
			
			if($newODID=="" || $newODID==false || is_numeric($newODID)==false){
				// skipped
				$this->formArray["progressLog"] = "[".$ctr."/".$total."]...[skipped odID:".$db->f("odID")."]" . "\n" . $this->formArray["progressLog"];
			}
			else{
				// ran
				$this->formArray["progressLog"] = "[".$ctr."/".$total."]...[archived odID:".$db->f("odID")." | created odID:".$newODID."]" . "\n" . $this->formArray["progressLog"];
				$this->formArray["totalCreated"]++;
			}
		}

		$this->formArray["totalArchived"] = $db->num_rows();
	}

	function Main(){
		switch ($this->formArray["formAction"]){
			// ajax method
			case "confirmAjax":
				// buildup odID list and print in template as hidden variables

		        $this->tpl->set_block("rptsTemplate", "Run", "RunBlock");
				$this->tpl->set_var("RunBlock", "");

		        $this->tpl->set_block("rptsTemplate", "Done", "DoneBlock");
				$this->tpl->set_var("DoneBlock", "");

		        $this->tpl->set_block("rptsTemplate", "BarangayForm", "BarangayFormBlock");
				$this->tpl->set_var("BarangayFormBlock", "");

		        $this->tpl->set_block("rptsTemplate", "AjaxBarangayForm", "AjaxBarangayFormBlock");
				$this->tpl->set_var("AjaxBarangayFormBlock", "");

		        $this->tpl->set_block("rptsTemplate", "ConventionalConfirm", "ConventionalConfirmBlock");
				$this->tpl->set_var("ConventionalConfirmBlock", "");

				$barangay = new Barangay;
				$barangay->selectRecord($this->formArray["barangayID"]);
				$this->tpl->set_var("barangayID",$this->formArray["barangayID"]);
				$this->tpl->set_var("barangay",$barangay->getDescription());

				$message = "Run General Revision for this barangay?";
				$this->tpl->set_var("message",$message);

				// get latestActiveRPUs for the barangay
				$latestActiveRPUs = $this->getLatestActiveRPUsByBarangay($this->formArray["barangayID"]);
				$this->tpl->set_var("latestActiveRPUs",number_format($latestActiveRPUs));

				$this->tpl->set_var("countBackDays",$this->formArray["countBackDays"]);
				$this->tpl->set_var("countBackDaysTimeStr",$this->formArray["countBackDaysTimeStr"]);
				$this->tpl->set_var("userID",$this->userID);
				break;
			// old-school method
			case "run":
		        $this->tpl->set_block("rptsTemplate", "Page", "PageBlock");
				$this->tpl->set_var("PageBlock", "");

				$this->formArray["timerStart"] = date("F d, Y h:i:s A",strtotime("now"));
				$this->run($this->formArray["barangayID"]);

				if($this->formArray["totalCreated"]==0){
					$this->formArray["message"] = "There were no RPUs generated through General Revision for this barangay.";
				}
				else{
					$this->formArray["message"] = "General Revision successfully generated for this barangay!";
				}

				$this->tpl->set_var("barangayID",$this->formArray["barangayID"]);
				$this->tpl->set_var("message",$this->formArray["message"]);
				$this->tpl->set_var("totalArchived",$this->formArray["totalArchived"]);
				$this->tpl->set_var("totalCreated",$this->formArray["totalCreated"]);
				$this->tpl->set_var("timerStart",$this->formArray["timerStart"]);
				$this->tpl->set_var("timerEnd",$this->formArray["timerEnd"]);
				$this->tpl->set_var("progressLog",$this->formArray["progressLog"]);
				break;
			case "done":
		        $this->tpl->set_block("rptsTemplate", "Run", "RunBlock");
				$this->tpl->set_var("RunBlock", "");

		        $this->tpl->set_block("rptsTemplate", "Confirm", "ConfirmBlock");
				$this->tpl->set_var("ConfirmBlock", "");

		        $this->tpl->set_block("rptsTemplate", "BarangayForm", "BarangayFormBlock");
				$this->tpl->set_var("BarangayFormBlock", "");

		        $this->tpl->set_block("rptsTemplate", "AjaxBarangayForm", "AjaxBarangayFormBlock");
				$this->tpl->set_var("AjaxBarangayFormBlock", "");

		        $this->tpl->set_block("rptsTemplate", "AjaxConfirm", "AjaxConfirmBlock");
				$this->tpl->set_var("AjaxConfirmBlock", "");

				$this->tpl->set_var("progressLog",$this->formArray["progressLog"]);

				if($this->formArray["timerEnd"]==""){
					$this->formArray["timerEnd"] = date("F d, Y h:i:s A",strtotime("now"));
				}

				$duration = strtotime($this->formArray["timerEnd"]) - strtotime($this->formArray["timerStart"]);

				$duration_minutes = floor($duration/60);
				$duration_seconds = $duration % 60;

				$this->tpl->set_var("duration",$duration_minutes."mins ".$duration_seconds."s");

				$this->tpl->set_var("timerStart",date("g:i:s a",strtotime($this->formArray["timerStart"])));
				$this->tpl->set_var("timerEnd",date("g:i:s a",strtotime($this->formArray["timerEnd"])));

				$barangay = new Barangay;
				$barangay->selectRecord($this->formArray["barangayID"]);
				$this->tpl->set_var("barangayID",$this->formArray["barangayID"]);
				$this->tpl->set_var("barangay",$barangay->getDescription());

				$this->tpl->set_var("totalArchived",$this->formArray["totalArchived"]);
				$this->tpl->set_var("totalCreated",$this->formArray["totalCreated"]);

				$this->tpl->set_var("message", $this->formArray["message"]);
				break;
			case "confirm":
		        $this->tpl->set_block("rptsTemplate", "Run", "RunBlock");
				$this->tpl->set_var("RunBlock", "");

		        $this->tpl->set_block("rptsTemplate", "Done", "DoneBlock");
				$this->tpl->set_var("DoneBlock", "");

		        $this->tpl->set_block("rptsTemplate", "BarangayForm", "BarangayFormBlock");
				$this->tpl->set_var("BarangayFormBlock", "");

		        $this->tpl->set_block("rptsTemplate", "AjaxBarangayForm", "AjaxBarangayFormBlock");
				$this->tpl->set_var("AjaxBarangayFormBlock", "");

		        $this->tpl->set_block("rptsTemplate", "AjaxConfirm", "AjaxConfirmBlock");
				$this->tpl->set_var("AjaxConfirmBlock", "");

				$barangay = new Barangay;
				$barangay->selectRecord($this->formArray["barangayID"]);
				$this->tpl->set_var("barangayID",$this->formArray["barangayID"]);
				$this->tpl->set_var("barangay",$barangay->getDescription());

				$message = "Run General Revision for this barangay?";
				$this->tpl->set_var("message",$message);

				// get latestActiveRPUs for the barangay
				$latestActiveRPUs = $this->getLatestActiveRPUsByBarangay($this->formArray["barangayID"]);
				$this->tpl->set_var("latestActiveRPUs",number_format($latestActiveRPUs));

				$this->tpl->set_var("countBackDays",$this->formArray["countBackDays"]);
				$this->tpl->set_var("countBackDaysTimeStr",$this->formArray["countBackDaysTimeStr"]);

				break;
			default:
		        $this->tpl->set_block("rptsTemplate", "Run", "RunBlock");
				$this->tpl->set_var("RunBlock", "");

		        $this->tpl->set_block("rptsTemplate", "Confirm", "ConfirmBlock");
				$this->tpl->set_var("ConfirmBlock", "");

		        $this->tpl->set_block("rptsTemplate", "AjaxConfirm", "AjaxConfirmBlock");
				$this->tpl->set_var("AjaxConfirmBlock", "");

		        $this->tpl->set_block("rptsTemplate", "Done", "DoneBlock");
				$this->tpl->set_var("DoneBlock", "");

				// display barangay list
				$this->initBarangayList();
				$message = "Select a Barangay";
				$this->tpl->set_var("message", $message);

				$this->tpl->set_var("countBackDays",$this->countBackDays);
				$this->tpl->set_var("countBackDaysTimeStr",$this->countBackDaysTimeStr);
				break;
		}

		$this->tpl->set_var("Session", $this->sess->url(""));

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->tpl->parse("templatePage", "rptsTemplate");
		$this->tpl->finish("templatePage");
		$this->tpl->p("templatePage");
	}
}

#####################################
# Define Procedures and Functions
#####################################

##########################################################
# Begin Program Script
##########################################################
//*
page_open(array("sess" => "rpts_Session"
	,"auth" => "rpts_Challenge_Auth"
	//,"perm" => "rpts_Perm"
	));
//*/
$generalRevision = new GeneralRevision($HTTP_POST_VARS,$HTTP_GET_VARS,$sess);
$generalRevision->Main();
?>
<?php page_close(); ?>
