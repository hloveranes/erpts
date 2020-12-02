<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/PlantsTrees.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PlantsTreesEncode');
$server->handle();
//*/
class PlantsTreesEncode
{
    function PlantsTreesEncode(){
		
    }
    
    function savePlantsTrees($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$plantsTrees = new PlantsTrees;
		$plantsTrees->parseDomDocument($domDoc);
		$ret = $plantsTrees->insertRecord();
		return $ret;
	}

    function savePlantsTreesForBuildup($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$plantsTrees = new PlantsTrees;
		$plantsTrees->parseDomDocument($domDoc);
		$ret = $plantsTrees->insertRecordForBuildup();
		return $ret;
	}	
	
	function getPlantsTreesDetails($plantsTreesID) {
		$plantsTrees = new PlantsTrees;
		$plantsTrees->selectRecord($plantsTreesID);
		if(!$domDoc = $plantsTrees->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updatePlantsTrees($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$plantsTrees = new PlantsTrees;
		$plantsTrees->parseDomDocument($domDoc);
		$ret = $plantsTrees->updateRecord();
		return $ret;
	}

	function updatePlantsTreesForBuildup($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$plantsTrees = new PlantsTrees;
		$plantsTrees->parseDomDocument($domDoc);
		//echo $xmlStr;
		$ret = $plantsTrees->updateRecordForBuildup();
		return $ret;
	}
}
/*
$address = new Address;
//$address->setAddressID("addressID");
$address->setNumber("number");
$address->setStreet("street");
$address->setBarangay("barangay");
$address->setDistrict("district");
$address->setMunicipalityCity("municipalityCity");
$address->setProvince("province");
$address->setDomDocument();

$propertyAdministrator = new Person;
//$propertyAdministrator->setPersonID("personID");
$propertyAdministrator->setLastName("lastName");
$propertyAdministrator->setFirstName("firstName");
$propertyAdministrator->setMiddleName("middleName");
//$propertyAdministrator->setGender("gender");
//$propertyAdministrator->setBirthday($this->birthdate);
//$propertyAdministrator->setMaritalStatus("maritalStatus");
//$propertyAdministrator->setTin("tin");
$propertyAdministrator->setAddressArray($address);
$propertyAdministrator->setTelephone("telephone");
//$propertyAdministrator->setMobileNumber("mobileNumber");
$propertyAdministrator->setEmail("email");
$propertyAdministrator->setDomDocument();

$verifiedBy = 3;
$plottingsBy = 3;
$notedBy = 3;
$appraisedBy = 3;
$recommendingApproval = 3;
$approvedBy = 3;

$plantsTrees = new PlantsTrees;
$plantsTrees->parseDomDocument($domDoc);
//$plantsTrees->setPropertyID("propertyID");
$plantsTrees->setAfsID("afsID");
$plantsTrees->setArpNumber("arpNumber");
$plantsTrees->setPropertyIndexNumber("propertyIndexNumber");
$plantsTrees->setPropertyAdministrator($propertyAdministrator);
$plantsTrees->setVerifiedByID("verifiedByID");
$plantsTrees->setVerifiedBy($verifiedBy);
$plantsTrees->setPlottingsByID("plottingsByID");
$plantsTrees->setPlottingsBy($plottingsBy);
$plantsTrees->setNotedByID("notedByID");
$plantsTrees->setNotedBy($notedBy);
$plantsTrees->setMarketValue("marketValue");
$plantsTrees->setKind("kind");
$plantsTrees->setActualUse("actualUse");
$plantsTrees->setAdjustedMarketValue("adjustedMarketValue");
$plantsTrees->setAssessmentLevel("assessmentLevel");
$plantsTrees->setAssessedValue("assessedValue");
$plantsTrees->setPreviousOwner("previousOwner");
$plantsTrees->setPreviousAssessedValue("previousAssessedValue");
$plantsTrees->setTaxability("taxability");
$plantsTrees->setEffectivity("effectivity");
$plantsTrees->setAppraisedByID("appraisedByID");
$plantsTrees->setAppraisedBy($appraisedBy);
$plantsTrees->setAppraisedByDate("appraisedByDate");
$plantsTrees->setRecommendingApproval($recommendingApproval);
$plantsTrees->setRecommendingApprovalID("recommendingApprovalID");
$plantsTrees->setRecommendingApprovalDate("recommendingApprovalDate");
$plantsTrees->setApprovedByID("approvedByID");
$plantsTrees->setApprovedBy($approvedBy);
$plantsTrees->setApprovedByDate("approvedByDate");
$plantsTrees->setMemoranda("memoranda");
$plantsTrees->setPostingDate("postingDate");

$plantsTrees->setLandPin("landPin");
$plantsTrees->setSurveyNumber("surveyNumber");
$plantsTrees->setProductClass("productClass");
$plantsTrees->setAreaPlanted("areaPlanted");
$plantsTrees->setTotalNumber("totalNumber");
$plantsTrees->setNonFruitBearing("nonFruitBearing");
$plantsTrees->setFruitBearing("fruitBearing");
$plantsTrees->setAge("age");
$plantsTrees->setUnitPrice("unitPrice");
$plantsTrees->setAdjustmentFactor("adjustmentFactor");
$plantsTrees->setPercentAdjustment("percentAdjustment");
$plantsTrees->setValueAdjustment("valueAdjustment");
$plantsTrees->setDomDocument();
$obj = new PlantsTreesEncode;
$xmlStr = $plantsTrees->domDocument->dump_mem(true);
//echo "test"."<br>";
echo $obj->savePlantsTrees($xmlStr);
//echo $obj->getPlantsTreesDetails(1);
//*/
?>
