<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/LocationAddress.php";
include("assessor/Company.php";
include("assessor/CompanyRecords.php";
include("assessor/Person.php";
include("assessor/PersonRecords.php";
include("assessor/Owner.php";
include("assessor/OwnerRecords.php";
include("assessor/OD.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PropertyInfoEncode');
$server->handle();
//*/

class PropertyInfoEncode
{
    function PropertyInfoEncode(){
		
    }

    function savePropertyInfoForBuildup($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$od = new OD;
		$od->parseDomDocument($domDoc);
		$ret = $od->insertRecordForBuildup();
		return $ret;
	}
    
    function savePropertyInfo($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			$ret = false;
		}
		$od = new OD;
		$od->parseDomDocument($domDoc);
		$ret = $od->insertRecord();
		return $ret;
	}
	
	function getPropertyInfoDetails($odID) {
		$propertyInfo = new OD;
		$propertyInfo->selectRecord($odID);
		if(!$domDoc = $propertyInfo->getDomDocument()){
			$ret = false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			$ret = $xmlStr;
		}
		return $ret;
	}
	
	function updatePropertyInfo($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			$ret = false;
		}
		$od = new OD;
		$od->parseDomDocument($domDoc);
		$ret = $od->updateRecord();
		return $ret;
	}
}
/*
$locationAddress = new LocationAddress;
$locationAddress->setLocationAddressID("161");
$locationAddress->setNumber("xxxnumber");
$locationAddress->setStreet("xxxstreet");
$locationAddress->setBarangay("3");
$locationAddress->setDistrict("xxxxdistrict");
$locationAddress->setMunicipalityCity("xxxxmunicipalityCity");
$locationAddress->setProvince("xxxxxprovince");
$locationAddress->setDomDocument();

$od = new OD;
$od->setOdID("100");
$od->setlocationAddress($locationAddress);
$od->setHouseTagNumber("xxhouseTagNumber");
$od->setLandArea("xxlandArea");
$od->setLotNumber("xxlotNumber");
$od->setZoneNumber("xxzoneNumber");
$od->setBlockNumber("xxxblockNumber");
$od->setPsd13("xxxpsd13");
$od->setAffidavitOfOwnership(1);
$od->setBarangayCertificate(1);
$od->setLandTagging(1);
$od->setDomDocument();

$doc = $od->getDomDocument();
$xmlStr =  $doc->dump_mem(true);
echo $xmlStr;
$obj = new PropertyInfoEncode;
//echo "<br>".$obj->savePropertyInfo($xmlStr)
echo "<br>".$obj->updatePropertyInfo($xmlStr)
//*/
//$obj = new PropertyInfoEncode;
//echo $obj->getPropertyInfoDetails(105);
?>
