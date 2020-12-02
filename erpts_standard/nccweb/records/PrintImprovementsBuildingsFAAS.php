<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/web/clibPDFWriter.php";
include_once "../includes/assessor/Barangay.php";

include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/OD.php";

include_once "../includes/assessor/ImprovementsBuildingsClasses.php";

#####################################
# Define Interface Class
#####################################
class PrintImprovementsBuildingsFAAS{
	
	var $tpl;
	var $formArray;
	function PrintImprovementsBuildingsFAAS($http_post_vars,$sess,$odID,$ownerID,$afsID,$print){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "bldgfaas.xml") ;
		$this->tpl->set_var("TITLE", "Print ImprovementsBuildings FAAS");
		
       	$this->formArray = array(

			"arpNumber" => ""
			,"propertyIndexNumber" => ""

			,"owner" => ""
			,"address1" => ""
			,"address2" => ""
			,"telno" => ""

			,"administrator" => ""
			,"adminAddress1" => ""
			,"adminAddress2" => ""
			,"adminTelno" => ""

			,"number" => ""
			,"street" => ""
			,"barangay" => ""
			,"district" => ""
			,"cityMunicipality" => ""
			,"province" => ""

			,"landOwner" => ""
			,"landSurveyNumber" => ""
			,"landTdNumber" => ""
			,"landArpNumberNumber" => ""
			,"landArea" => ""

			,"foundation" => ""
			,"windows" => ""
			,"columns" => ""
			,"stairs" => ""
			,"beams" => ""
			,"partition" => ""
			,"trussFraming" => ""
			,"wallFinish" => ""
			,"roof" => ""
			,"electrical" => ""
			,"exteriorWalls" => ""
			,"toiletAndBath" => ""
			,"flooring" => ""
			,"plumbingSewer" => ""
			,"doors" => ""
			,"fixtures" => ""
			,"ceiling" => ""
			,"dateConstructed" => ""
			,"structuralTypes" => ""
			,"dateOccupied" => ""
			,"classification" => ""
			,"dateCompleted" => ""
			,"bldgPermit" => ""
			,"areaOfGroundFloor" => ""
			,"buildingAge" => ""
			,"totalBuildingArea" => ""
			,"numberOfStoreys" => ""
			,"cctNumber" => ""

			,"bldgCore1" => ""
			,"addItems" => ""
			,"subTotal" => ""

			,"adjustments" => ""
			,"depreciationRate" => ""
			,"subTotal2" => ""
			,"depreciationRate" => ""

			,"accumulatedDepreciation" => ""

			,"kind1" => ""
			,"actualUse1" => ""
			,"marketValue1" => ""
			,"assessmentLevel1" => ""
			,"assessedValue1" => ""

			,"kind2" => ""
			,"actualUse2" => ""
			,"marketValue2" => ""
			,"assessmentLevel2" => ""
			,"assessedValue2" => ""

			,"kind3" => ""
			,"actualUse3" => ""
			,"marketValue3" => ""
			,"assessmentLevel3" => ""
			,"assessedValue3" => ""

			,"kind4" => ""
			,"actualUse4" => ""
			,"marketValue4" => ""
			,"assessmentLevel4" => ""
			,"assessedValue4" => ""

			,"total" => ""

			,"previousOwner" => ""
			,"previousAssessedValue" => ""

			,"taxability" => ""
			,"effectivity" => ""

			,"assessedBy" => ""

			,"recommendingApproval" => ""
			,"ra_date" => ""
			,"assessor" => ""
			,"ca_date" => ""

			,"memoranda" => ""

			,"prevPIN" => ""
			,"presPIN" => ""
			,"initPIN" => ""
			,"datePIN" => ""
			,"prevTD" => ""
			,"presTD" => ""
			,"initTD" => ""
			,"dateTD" => ""
			,"prevARP" => ""
			,"presARP" => ""
			,"initARP" => ""
			,"dateARP" => ""

		);

		$this->formArray["odID"] = $odID;
		$this->formArray["ownerID"] = $ownerID;
		$this->formArray["afsID"] = $afsID;
        
		$this->formArray["propertyID"] = $propertyID;
        $this->formArray["propertyType"] = $propertyType;
		$this->formArray["print"] = $print;

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function formatCurrency($key){
		$this->formArray[$key] = number_format($this->formArray[$key], 2, ".", ",");
	}
	
	function setForm(){
		$this->formatCurrency("landTotal");
		$this->formatCurrency("valAdjFacTotal");

		$this->formatCurrency("propertyAdjMrktValTotal");
		$this->formatCurrency("propertyTotal");

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, html_entity_to_alpha($value));
		}
	}

	function displayOwnerList($domDoc){
		$owner = new Owner;
		$owner->parseDomDocument($domDoc);
			$ownerName = "";
			if (count($owner->personArray)){
				foreach($owner->personArray as $personKey =>$personValue){
					if ($ownerName == ""){
						$address = $personValue->addressArray[0]->getFullAddress();

						$address1 = $personValue->addressArray[0]->getNumber();
						$address1.= " ".$personValue->addressArray[0]->getStreet();
						$address1.= ", ".$personValue->addressArray[0]->getBarangay();

						$address2 = $personValue->addressArray[0]->getDistrict();
						$address2.= ", ".$personValue->addressArray[0]->getMunicipalityCity();
						$address2.= ", ".$personValue->addressArray[0]->getProvince();

						$telno = $personValue->getTelephone();

						$ownerName = $personValue->getName();
					}
					else{
						$ownerName = $ownerName." , ".$personValue->getName();
					}
				}
			}
			else{
			}
			if (count($owner->companyArray)){
				foreach ($owner->companyArray as $companyKey => $companyValue){
					if ($ownerName == ""){
						$address = $companyValue->addressArray[0]->getFullAddress();

						$address1 = $companyValue->addressArray[0]->getNumber();
						$address1.= " ".$companyValue->addressArray[0]->getStreet();
						$address1.= ", ".$companyValue->addressArray[0]->getBarangay();

						$address2 = $companyValue->addressArray[0]->getDistrict();
						$address2.= ", ".$companyValue->addressArray[0]->getMunicipalityCity();
						$address2.= ", ".$companyValue->addressArray[0]->getProvince();

						$telno = $companyValue->getTelephone();

						$ownerName = $companyValue->getCompanyName();
					}
					else{
						$ownerName = $ownerName." , ".$companyValue->getCompanyName();
					}
					
				}
			}
			else{
			}

			$this->formArray["owner"] = $ownerName;
			$this->formArray["landOwner"] = $ownerName;
			$this->formArray["address1"] = $address1;
			$this->formArray["address2"] = $address2;
			$this->formArray["telno"] = $telno;
	}
	function displayODAFS($afsID){
		$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
		if (!$odID = $AFSDetails->getOdID($afsID)){
			exit("get od id failed");
		}
		else{
			$ODDetails = new SoapObject(NCCBIZ."ODDetails.php", "urn:Object");
			if (!$xmlStr = $ODDetails->getOD($odID)){
				exit("xml failed");
			}
			else{
				//exit($xmlStr);
				if(!$domDoc = domxml_open_mem($xmlStr)) {
					exit("error open xml");
				}
				else {
					$od = new OD;
					$od->parseDomDocument($domDoc);
					if (is_object($od->locationAddress)){
						$this->formArray["number"] = $od->locationAddress->getNumber();
						$this->formArray["street"] = $od->locationAddress->getStreet();
						$this->formArray["barangay"] = $od->locationAddress->getBarangay();
						$this->formArray["district"] = $od->locationAddress->getDistrict();
						$this->formArray["cityMunicipality"] = $od->locationAddress->getMunicipalityCity();
						$this->formArray["province"] = $od->locationAddress->getProvince();
					}

					$ODEncode = new SoapObject(NCCBIZ."ODEncode.php", "urn:Object");
					$this->formArray["ownerID"] = $ODEncode->getOwnerID($this->formArray["odID"]);
					$xmlStr = $od->owner->domDocument->dump_mem(true);
					if (!$xmlStr){
						exit("error xml");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
							exit("error open xml");
						}
						else {
							$this->displayOwnerList($domDoc);
						}
					}
				}	
			}
		}
	}

	function displayImprovementsBuildingsList($improvementsBuildingsList){
        if (count($improvementsBuildingsList)){
			$i = 0;
			foreach ($improvementsBuildingsList as $key => $improvementsBuildings){
				if($i==0){

					//$this->formArray["arpNumber"] = $improvementsBuildings->getArpNumber();
					//$this->formArray["propertyIndexNumber"] = $improvementsBuildings->getPropertyIndexNumber();

					$this->formArray["foundation"] = $improvementsBuildings->getFoundation();
					$this->formArray["windows"] = $improvementsBuildings->getWindows();
					$this->formArray["columns"] = $improvementsBuildings->getColumnsBldg();
					$this->formArray["stairs"] = $improvementsBuildings->getStairs();
					$this->formArray["beams"] = $improvementsBuildings->getBeams();
					$this->formArray["partition"] = $improvementsBuildings->getPartition();
					$this->formArray["trussFraming"] = $improvementsBuildings->getTrussFraming();
					$this->formArray["wallFinish"] = $improvementsBuildings->getWallFinish();
					$this->formArray["roof"] = $improvementsBuildings->getRoof();
					$this->formArray["electrical"] = $improvementsBuildings->getElectrical();
					$this->formArray["exteriorWalls"] = $improvementsBuildings->getExteriorWalls();
					$this->formArray["toiletAndBath"] = $improvementsBuildings->getToiletAndBath();
					$this->formArray["flooring"] = $improvementsBuildings->getFlooring();
					$this->formArray["plumbingSewer"] = $improvementsBuildings->getPlumbingSewer();
					
					$this->formArray["doors"] = $improvementsBuildings->getDoors();
					$this->formArray["fixtures"] = $improvementsBuildings->getFixtures();
					$this->formArray["ceiling"] = $improvementsBuildings->getCeiling();
					$this->formArray["dateConstructed"] = $improvementsBuildings->getDateConstructed();
					$this->formArray["structuralTypes"] = $improvementsBuildings->getStructuralTypes();

					$this->formArray["dateOccupied"] = $improvementsBuildings->getDateOccupied();

					// buildingClassification

					$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
					if(is_numeric($improvementsBuildings->getBuildingClassification())){
						$improvementsBuildingsClasses->selectRecord($improvementsBuildings->getBuildingClassification());
						$this->formArray["classification"] = $improvementsBuildingsClasses->getDescription();
					}
					else{
						$this->formArray["classification"] = $improvementsBuildings->getBuildingClassification();
					}

					$this->formArray["dateCompleted"] = $improvementsBuildings->getDateCompleted();
					$this->formArray["bldgPermit"] = $improvementsBuildings->getBuildingPermit();
					$this->formArray["areaOfGroundFloor"] = $improvementsBuildings->getAreaOfGroundFloor();
					$this->formArray["buildingAge"] = $improvementsBuildings->getBuildingAge();
					$this->formArray["totalBuildingArea"] = $improvementsBuildings->getTotalBuildingArea();
					$this->formArray["numberOfStoreys"] = $improvementsBuildings->getNumberOfStoreys();
					$this->formArray["cctNumber"] = $improvementsBuildings->getCctNumber();
					$this->formArray["bldgCore1"] = $improvementsBuildings->getBuildingCoreAndAdditionalItems();
					$this->formArray["addItems"] = "";
					$this->formArray["subTotal"] = "";

					$this->formArray["adjustments"] = "";
					$this->formArray["depreciationRate"] = $improvementsBuildings->getDepreciationRate();
					$this->formArray["subTotal2"] = "";

					$this->formArray["depreciationRate"] = $improvementsBuildings->getDepreciationRate();

					$this->formArray["accumulatedDepreciation"] = $improvementsBuildings->getAccumulatedDepreciation();

					if (is_a($improvementsBuildings->propertyAdministrator,Person)){
						$this->formArray["administrator"] = $improvementsBuildings->propertyAdministrator->getFullName();
						if (is_a($improvementsBuildings->propertyAdministrator->addressArray[0],"address")){
							$address1 = $improvementsBuildings->propertyAdministrator->addressArray[0]->getNumber();
							$address1.= " ".$improvementsBuildings->propertyAdministrator->addressArray[0]->getStreet();
							$address1.= ", ".$improvementsBuildings->propertyAdministrator->addressArray[0]->getBarangay();
							
							$address2 = $improvementsBuildings->propertyAdministrator->addressArray[0]->getDistrict();
							$address2.= ", ".$improvementsBuildings->propertyAdministrator->addressArray[0]->getMunicipalityCity();
							$address2.= ", ".$improvementsBuildings->propertyAdministrator->addressArray[0]->getProvince();

							$this->formArray["adminAddress1"] = $address1;
							$this->formArray["adminAddress2"] = $address2;
						}
						$this->formArray["adminTelno"] = $improvementsBuildings->propertyAdministrator->getTelephone();
					}

					// recommendingApproval
					if(is_numeric($improvementsBuildings->recommendingApproval))
					{
						$recommendingApproval = new Person;
						$recommendingApproval->selectRecord($improvementsBuildings->recommendingApproval);
						$this->formArray["recommendingApproval"] = $recommendingApproval->getFullName();
						$this->recommendingApproval = $recommendingApproval->getFullName();
					}
					else{
						$recommendingApproval = $improvementsBuildings->recommendingApproval;
						$this->formArray["recommendingApproval"] = $recommendingApproval;
						$this->recommendingApproval = $recommendingApproval;
					}

					$this->formArray["dateRecommendingApproval"] = $improvementsBuildings->getRecommendingApprovalDate();

					// approvedBy
					if(is_numeric($improvementsBuildings->approvedBy))
					{
						$approvedBy = new Person;
						$approvedBy->selectRecord($improvementsBuildings->approvedBy);
						$this->formArray["approvedBy"] = $approvedBy->getFullName();
						$this->approvedBy = $approvedBy->getFullName();
					}
					else{
						$approvedBy = $improvementsBuildings->approvedBy;
						$this->formArray["approvedBy"] = $approvedBy;
						$this->approvedBy = $approvedBy;
					}
					$this->formArray["dateApprovedBy"] = $improvementsBuildings->getApprovedByDate();

					// appraisedBy (assessedBy)
					if(is_numeric($improvementsBuildings->appraisedBy))
					{
						$appraisedBy = new Person;
						$appraisedBy->selectRecord($improvementsBuildings->appraisedBy);
						$this->formArray["assessedBy"] = $appraisedBy->getFullName();
						$this->appraisedBy = $appraisedBy->getFullName();
					}
					else{
						$appraisedBy = $improvementsBuildings->appraisedBy;
						$this->formArray["assessedBy"] = $appraisedBy;
						$this->appraisedBy = $appraisedBy;
					}
					$this->formArray["dateAssessedBy"] = $improvementsBuildings->getAppraisedByDate();
				}


				if($i<4){
					$this->formArray["kind".($i+1)] = $improvementsBuildings->getKind();

					// actualUse

					$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
					if(is_numeric($improvementsBuildings->getActualUse())){
						$improvementsBuildingsClasses->selectRecord($improvementsBuildings->getActualUse());
						$this->formArray["actualUse".($i+1)] = $improvementsBuildingsClasses->getDescription();
					}
					else{
						$this->formArray["actualUse".($i+1)] = $improvementsBuildings->getActualUse();
					}

					$this->formArray["marketValue".($i+1)] = $improvementsBuildings->getMarketValue();
					$this->formArray["assessmentLevel".($i+1)] = $improvementsBuildings->getAssessmentLevel();
					$this->formArray["assessedValue".($i+1)] = $improvementsBuildings->getAssessedValue();
				}

				$i++;
			}
		}
		$this->formArray["landTotal"] = $landTotal;
		$this->formArray["valAdjFacTotal"] = $valAdjFacTotal;
		$this->formArray["propertyAdjMrktValTotal"] = $propertyAdjMrktValTotal;
		$this->formArray["propertyTotal"] = $propertyTotal;
	}

	function Main(){
		$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
		if (!$xmlStr = $AFSDetails->getAFS($this->formArray["afsID"])){
			exit("afs not found");
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				exit("error xmlDoc");
			}
			else {
				$afs = new AFS;
				$afs->parseDomDocument($domDoc);

				$this->formArray["arpNumber"] = $afs->arpNumber;
				$this->formArray["propertyIndexNumber"] = $afs->propertyIndexNumber;

				$this->displayODAFS($this->formArray["afsID"]);

				$improvementsBuildingsList = $afs->getImprovementsBuildingsArray();

				if(count($improvementsBuildingsList)){
					$this->displayImprovementsBuildingsList($improvementsBuildingsList);
				}
			}
		}

		$this->setForm();
		
        $this->tpl->parse("templatePage", "rptsTemplate");
        $this->tpl->finish("templatePage");

		$testpdf = new PDFWriter;
        $testpdf->setOutputXML($this->tpl->get("templatePage"),"test");
        if(isset($this->formArray["print"])){
        	$testpdf->writePDF($name);//,$this->formArray["print"]);
        }
        else {
        	$testpdf->writePDF($name);
        }		
//		header("location: ".$testpdf->pdfPath);
		exit;

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
	//"perm" => "rpts_Perm"
	));
//*/

$printImprovementsBuildingsFAAS = new PrintImprovementsBuildingsFAAS($HTTP_POST_VARS,$sess,$odID,$ownerID,$afsID,$print);
$printImprovementsBuildingsFAAS->Main();
?>
<?php page_close(); ?>
