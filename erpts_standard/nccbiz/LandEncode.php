<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/Assessor.php";
include_once "../includes/assessor/Land.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('LandEncode');
$server->handle();
//*/
class LandEncode
{
    function LandEncode(){
		
    }

    function saveLand($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$land = new Land;
		$land->parseDomDocument($domDoc);
		$ret = $land->insertRecord();
		return $ret;
	}

    function saveLandForBuildup($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$land = new Land;
		$land->parseDomDocument($domDoc);
		$ret = $land->insertRecordForBuildup();
		return $ret;
	}
	
	function getLandDetails($propertyID) {
		$land = new Land;
		$land->selectRecord($propertyID);
		if(!$domDoc = $land->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateLand($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$land = new Land;
		$land->parseDomDocument($domDoc);
		//echo $xmlStr;
		$ret = $land->updateRecord();
		return $ret;
	}

	function updateLandForBuildup($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$land = new Land;
		$land->parseDomDocument($domDoc);
		//echo $xmlStr;
		$ret = $land->updateRecordForBuildup();
		return $ret;
	}
}
//*
/*
$address = new Address;
$address->setAddressId(8);
$address->setNumber("1487");
$address->setStreet("E.Rodriguez Sr.Blvd.");
$address->setBarangay("Christ The King");
$address->setDistrict("Cubao");
$address->setMunicipalityCity("Quezon City");
$address->setProvince("Metro Manila");
$address->setDomDocument();

$propertyAdministrator = new Person;
$propertyAdministrator->setPersonID(7);
$propertyAdministrator->setFirstName("xxxJuan");
$propertyAdministrator->setMiddleName("M");
$propertyAdministrator->setLastName("Nelson");
$propertyAdministrator->setGender("male");
$propertyAdministrator->setBirthday("1977/07/09");
$propertyAdministrator->setMaritalStatus("single");
$propertyAdministrator->setTin("1234567890");
$propertyAdministrator->setTelephone("026584746");
$propertyAdministrator->setMobileNumber("09175302791");
$propertyAdministrator->setEmail("nelson@k2ia.com");
$propertyAdministrator->setAddressArray($address);
$propertyAdministrator->setDomDocument();

$verifiedBy = new Assessor;
$verifiedBy->setAssessorID(1);
$verifiedBy->setPersonID(2);
$verifiedBy->setFirstName("Nelson");
$verifiedBy->setMiddleName("Mirandax");
$verifiedBy->setLastName("Manlapazx");
$verifiedBy->setGender("male");
$verifiedBy->setBirthday("1977/07/09");
$verifiedBy->setMaritalStatus("single");
$verifiedBy->setTin("dffwerfwerf");
$verifiedBy->setTelephone("erfefefref");
$verifiedBy->setMobileNumber("09175302791");
$verifiedBy->setEmail("nelson@k2ia.com");
$verifiedBy->setPosition("web developer");
$verifiedBy->setAddressArray($address);
$verifiedBy->setDomDocument();
$land = new Land;
$land->setPropertyID(2);
$land->setAfsID("bloh");
$land->setArpNumber("bloh");
$land->setPropertyIndexNumber("bloh");
$land->setPropertyAdministrator($propertyAdministrator);
$land->setVerifiedBy($verifiedBy);
$land->setPlottingsBy($verifiedBy);
$land->setNotedBy($verifiedBy);
$land->setMarketValue("bloh");
$land->setKind("bloh");
$land->setActualUse("bloh");
$land->setAdjustedMarketValue("bloh");
$land->setAssessmentLevel("bloh");
$land->setAssessedValue("bloh");
$land->setPreviousOwner("bloh");
$land->setPreviousAssessedValue("bloh");
$land->setTaxability("bloh");
$land->setEffectivity("bloh");
$land->setAppraisedBy($verifiedBy);
$land->setAppraisedByDate("2002/03/11");
$land->setRecommendingApproval($verifiedBy);
$land->setRecommendingApprovalDate("2002/03/11");
$land->setApprovedBy($verifiedBy);
$land->setApprovedByDate("2002/03/11");
$land->setMemoranda("bloh");
$land->setPostingDate("2002/03/11");
$land->setOctTctNumber("bloh");
$land->setSurveyNumber("bloh");
$land->setNorth("bloh");
$land->setEast("bloh");
$land->setSouth("bloh");
$land->setWest("bloh");
$land->setClassification("bloh");
$land->setSubClass("bloh");
$land->setArea("bloh");
$land->setUnitValue("bloh");
$land->setAdjustmentFactor("bloh");
$land->setPercentAdjustment("bloh");
$land->setValueAdjustment("bloh");
$land->setAdjustedMarketValue("bloh");
$land->setDomDocument();
$xmlStr = $land->domDocument->dump_mem(true);
*/
//echo $xmlStr;
//$obj = new LandEncode;
//echo "test"."<br>";
//echo "<br>".$obj->saveLand($xmlStr);
//echo $obj->updateLand($xmlStr);
//echo $obj->getLandDetails(2);
//*/
?>