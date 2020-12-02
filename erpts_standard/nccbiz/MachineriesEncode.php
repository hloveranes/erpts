<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Machineries.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('MachineriesEncode');
$server->handle();
//*/
class MachineriesEncode
{
    function MachineriesEncode(){
		
    }
    
    function saveMachineries($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$machineries = new Machineries;
		$machineries->parseDomDocument($domDoc);
		$ret = $machineries->insertRecord();
		return $ret;//$machineries->domMachineries->dump_mem();
	}

    function saveMachineriesForBuildup($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$machineries = new Machineries;
		$machineries->parseDomDocument($domDoc);
		$ret = $machineries->insertRecordForBuildup();
		return $ret;//$machineries->domMachineries->dump_mem();
	}
	
	function getMachineriesDetails($machineriesID) {
		$machineries = new Machineries;
		$machineries->selectRecord($machineriesID);
		if(!$domDoc = $machineries->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateMachineries($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$machineries = new Machineries;
		$machineries->parseDomDocument($domDoc);
		$ret = $machineries->updateRecord();
		return $ret;
	}

	function updateMachineriesForBuildup($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$machineries = new Machineries;
		$machineries->parseDomDocument($domDoc);
		//echo $xmlStr;
		$ret = $machineries->updateRecordForBuildup();
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

$machineries = new Machineries;
$machineries->parseDomDocument($domDoc);
//$machineries->setPropertyID("propertyID");
$machineries->setAfsID(1);
$machineries->setArpNumber("arpNumber");
$machineries->setPropertyIndexNumber("propertyIndexNumber");
$machineries->setPropertyAdministrator($propertyAdministrator);
$machineries->setVerifiedByID("5");
$machineries->setVerifiedBy($verifiedBy);
$machineries->setPlottingsByID("5");
$machineries->setPlottingsBy($plottingsBy);
$machineries->setNotedByID("5");
$machineries->setNotedBy($notedBy);
$machineries->setMarketValue("marketValue");
$machineries->setKind("kind");
$machineries->setActualUse("actualUse");
$machineries->setAdjustedMarketValue("adjustedMarketValue");
$machineries->setAssessmentLevel("assessmentLevel");
$machineries->setAssessedValue("assessedValue");
$machineries->setPreviousOwner("previousOwner");
$machineries->setPreviousAssessedValue("previousAssessedValue");
$machineries->setTaxability("taxability");
$machineries->setEffectivity("effectivity");
$machineries->setAppraisedByID("5");
$machineries->setAppraisedBy($appraisedBy);
$machineries->setAppraisedByDate("2003-03-11");
$machineries->setRecommendingApproval($recommendingApproval);
$machineries->setRecommendingApprovalID("5");
$machineries->setRecommendingApprovalDate("2003-03-11");
$machineries->setApprovedByID("5");
$machineries->setApprovedBy($approvedBy);
$machineries->setApprovedByDate("2003-03-11");
$machineries->setMemoranda("memoranda");
$machineries->setPostingDate("2003-03-11");

$machineries->setBuildingPin("test");
$machineries->setLandPin("test");
$machineries->setMachineryDescription("test");
$machineries->setBrand("test");
$machineries->setModelNumber("test");
$machineries->setCapacity("test");
$machineries->setDateAcquired("test");
$machineries->setConditionWhenAcquired("test");
$machineries->setEstimatedEconomicLife("test");
$machineries->setRemainingEconomicLife("test");
$machineries->setDateOfInstallation("test");
$machineries->setDateOfOperation("test");
$machineries->setRemarks("test");
$machineries->setNumberOfUnits("test");
$machineries->setAcquisitionCost("test");
$machineries->setFreightCost("test");
$machineries->setInsuranceCost("test");
$machineries->setInstallationCost("test");
$machineries->setOthersCost("test");
$machineries->setDepreciation("test");
$machineries->setDepreciatedMarketValue("test");

$machineries->setDomDocument();

$obj = new MachineriesEncode;
echo $obj->getMachineriesDetails(1);
//$xmlStr = $machineries->domDocument->dump_mem(true);
//echo $obj->saveMachineries($xmlStr)
//*/
?>