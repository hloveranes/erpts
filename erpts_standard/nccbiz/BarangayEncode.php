<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Barangay.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('BarangayEncode');
$server->handle();
//*/
class BarangayEncode
{
    function BarangayEncode(){
		
    }

    function saveBarangay($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$barangay = new Barangay;
		$barangay->parseDomDocument($domDoc);
		$ret = $barangay->insertRecord();
		return $ret;
	}
	
	function getBarangayDetails($barangayID) {
		$barangay = new Barangay;
		$barangay->selectRecord($barangayID);
		if(!$domDoc = $barangay->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateBarangay($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$barangay = new Barangay;
		$barangay->parseDomDocument($domDoc);
		$ret = $barangay->updateRecord();
		return $ret;
	}
}

/*
$barangay = new Barangay;
//$barangay->setBarangayID(126);
$barangay->setCode("KJKSJDF");
$barangay->setDescription("KLAJSDFJASLKFJALSKFJ");
$barangay->setStatus("Active");
$barangay->setDomDocument();
$domDoc = $barangay->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new BarangayEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updateBarangay($xmlStr);
echo $obj->saveBarangay($xmlStr);
//echo  $obj->getBarangayDetails(128);
//*/
?>
