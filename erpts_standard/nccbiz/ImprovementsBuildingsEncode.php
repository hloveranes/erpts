<?php
# Setup PHPLIB in storey Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Storey.php";
include_once "../includes/assessor/Property.php";
include_once "../includes/assessor/ImprovementsBuildings.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ImprovementsBuildingsEncode');
$server->handle();
//*/
class ImprovementsBuildingsEncode
{
    function ImprovementsBuildingsEncode(){
		
    }
    
    function saveImprovementsBuildings($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$improvementsBuildings = new ImprovementsBuildings;
		$improvementsBuildings->parseDomDocument($domDoc);
		$ret = $improvementsBuildings->insertRecord();
		return $ret;
	}

    function saveImprovementsBuildingsForBuildup($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$improvementsBuildings = new ImprovementsBuildings;
		$improvementsBuildings->parseDomDocument($domDoc);
		$ret = $improvementsBuildings->insertRecordForBuildup();
		return $ret;
	}
	
	function getImprovementsBuildingsDetails($propertyID) {
		$improvementsBuildings = new ImprovementsBuildings;
		$improvementsBuildings->selectRecord($propertyID);
		if(!$domDoc = $improvementsBuildings->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateImprovementsBuildings($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}

		$improvementsBuildings = new ImprovementsBuildings;
		$improvementsBuildings->parseDomDocument($domDoc);
		$ret = $improvementsBuildings->updateRecord();
		return $ret;
	}

	function updateImprovementsBuildingsForBuildup($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$improvementsBuildings = new ImprovementsBuildings;
		$improvementsBuildings->parseDomDocument($domDoc);
		//echo $xmlStr;
		$ret = $improvementsBuildings->updateRecordForBuildup();
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

$verifiedBy = 5;
$plottingsBy = 5;
$notedBy = 5;
$appraisedBy = 5;
$recommendingApproval = 5;
$approvedBy = 5;

$improvementsBuildings = new ImprovementsBuildings;
$improvementsBuildings->parseDomDocument($domDoc);
//$improvementsBuildings->setPropertyID("propertyID");
$improvementsBuildings->setAfsID(1);
$improvementsBuildings->setArpNumber("arpNumber");
$improvementsBuildings->setPropertyIndexNumber("propertyIndexNumber");
$improvementsBuildings->setPropertyAdministrator($propertyAdministrator);
$improvementsBuildings->setVerifiedByID("5");
$improvementsBuildings->setVerifiedBy($verifiedBy);
$improvementsBuildings->setPlottingsByID("5");
$improvementsBuildings->setPlottingsBy($plottingsBy);
$improvementsBuildings->setNotedByID("5");
$improvementsBuildings->setNotedBy($notedBy);
$improvementsBuildings->setMarketValue("marketValue");
$improvementsBuildings->setKind("kind");
$improvementsBuildings->setActualUse("actualUse");
$improvementsBuildings->setAdjustedMarketValue("adjustedMarketValue");
$improvementsBuildings->setAssessmentLevel("assessmentLevel");
$improvementsBuildings->setAssessedValue("assessedValue");
$improvementsBuildings->setPreviousOwner("previousOwner");
$improvementsBuildings->setPreviousAssessedValue("previousAssessedValue");
$improvementsBuildings->setTaxability("taxability");
$improvementsBuildings->setEffectivity("effectivity");
$improvementsBuildings->setAppraisedByID("5");
$improvementsBuildings->setAppraisedBy($appraisedBy);
$improvementsBuildings->setAppraisedByDate("2003-03-11");
$improvementsBuildings->setRecommendingApproval($recommendingApproval);
$improvementsBuildings->setRecommendingApprovalID("5");
$improvementsBuildings->setRecommendingApprovalDate("2003-03-11");
$improvementsBuildings->setApprovedByID("5");
$improvementsBuildings->setApprovedBy($approvedBy);
$improvementsBuildings->setApprovedByDate("2003-03-11");
$improvementsBuildings->setMemoranda("memoranda");
$improvementsBuildings->setPostingDate("2003-03-11");

$improvementsBuildings->setFoundation("foundation");
$improvementsBuildings->setColumnsBldg("columnsBldg");
$improvementsBuildings->setBeams("beams");
$improvementsBuildings->setTrussFraming("trussFraming");
$improvementsBuildings->setRoof("roof");
$improvementsBuildings->setExteriorWalls("exteriorWalls");
$improvementsBuildings->setFlooring("flooring");
$improvementsBuildings->setDoors("doors");
$improvementsBuildings->setCeiling("ceiling");
$improvementsBuildings->setStructuralTypes("structuralTypes");
$improvementsBuildings->setBuildingClassification("buildingClassification");
$improvementsBuildings->setBuildingPermit("buildingPermit");
$improvementsBuildings->setBuildingAge("buildingAge");
$improvementsBuildings->setCctNumber("cctNumber");
$improvementsBuildings->setNumberOfStoreys("numberOfStoreys");
$improvementsBuildings->setWindows("windows");
$improvementsBuildings->setStairs("stairs");
$improvementsBuildings->setPartition("partition");
$improvementsBuildings->setWallFinish("wallFinish");
$improvementsBuildings->setElectrical("electrical");
$improvementsBuildings->setToiletAndBath("toiletAndBath");
$improvementsBuildings->setPlumbingSewer("plumbingSewer");
$improvementsBuildings->setFixtures("fixtures");
$improvementsBuildings->setDateConstructed("2003-03-11");
$improvementsBuildings->setDateOccupied("2003-03-11");
$improvementsBuildings->setDateCompleted("2003-03-11");
$improvementsBuildings->setAreaOfGroundFloor("areaOfGroundFloor");
$improvementsBuildings->setTotalBuildingArea("totalBuildingArea");
$improvementsBuildings->setBuildingCoreAndAdditionalItems("buildingCoreAndAdditionalItems");
$improvementsBuildings->setDepreciationRate("depreciationRate");
$improvementsBuildings->setAccumulatedDepreciation("accumulatedDepreciation");
$improvementsBuildings->setDepreciatedMarketValue("depreciatedMarketValue");

$improvementsBuildings->setDomDocument();

$obj = new ImprovementsBuildingsEncode;
//echo $obj->getImprovementsBuildings(1);
$xmlStr = $improvementsBuildings->domDocument->dump_mem(true);
echo $obj->saveImprovementsBuildings($xmlStr)
//*/
?>