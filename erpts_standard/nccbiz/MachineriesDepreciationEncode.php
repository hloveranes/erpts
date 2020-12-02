<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/MachineriesDepreciation.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('MachineriesDepreciationEncode');
$server->handle();
//*/
class MachineriesDepreciationEncode
{
    function MachineriesDepreciationEncode(){
		
    }

    function saveMachineriesDepreciation($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$machineriesDepreciation = new MachineriesDepreciation;
		$machineriesDepreciation->parseDomDocument($domDoc);
		$ret = $machineriesDepreciation->insertRecord();
		return $ret;
	}
	
	function getMachineriesDepreciationDetails($machineriesDepreciationID) {
		$machineriesDepreciation = new MachineriesDepreciation;
		$machineriesDepreciation->selectRecord($machineriesDepreciationID);
		if(!$domDoc = $machineriesDepreciation->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateMachineriesDepreciation($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$machineriesDepreciation = new MachineriesDepreciation;
		$machineriesDepreciation->parseDomDocument($domDoc);
		$ret = $machineriesDepreciation->updateRecord();
		return $ret;
	}
}

/*
$machineriesDepreciation = new MachineriesDepreciation;
//$machineriesDepreciation->setMachineriesDepreciationID(126);
$machineriesDepreciation->setCode("KJKSJDF");
$machineriesDepreciation->setDescription("KLAJSDFJASLKFJALSKFJ");
$machineriesDepreciation->setValue("1234");
$machineriesDepreciation->setStatus("Active");
$machineriesDepreciations->setDomDocument();
$domDoc = $machineriesDepreciation->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new MachineriesDepreciationEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updateMachineriesDepreciation($xmlStr);
echo $obj->saveMachineriesDepreciation($xmlStr);
//echo  $obj->getMachineriesDepreciationDetails(128);
//*/
?>
