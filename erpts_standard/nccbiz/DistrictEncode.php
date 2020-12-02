<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/District.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('DistrictEncode');
$server->handle();
//*/
class DistrictEncode
{
    function DistrictEncode(){
		
    }

    function saveDistrict($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$district = new District;
		$district->parseDomDocument($domDoc);
		$ret = $district->insertRecord();
		return $ret;
	}
	
	function getDistrictDetails($districtID) {
		$district = new District;
		$district->selectRecord($districtID);
		if(!$domDoc = $district->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateDistrict($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$district = new District;
		$district->parseDomDocument($domDoc);
		$ret = $district->updateRecord();
		return $ret;
	}
}

/*
$district = new District;
//$district->setDistrictID(126);
$district->setCode("KJKSJDF");
$district->setDescription("KLAJSDFJASLKFJALSKFJ");
$district->setStatus("Active");
$district->setDomDocument();
$domDoc = $district->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new DistrictEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updateDistrict($xmlStr);
echo $obj->saveDistrict($xmlStr);
//echo  $obj->getDistrictDetails(128);
//*/
?>
