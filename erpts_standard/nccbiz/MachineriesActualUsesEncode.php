<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/MachineriesActualUses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('MachineriesActualUsesEncode');
$server->handle();
//*/
class MachineriesActualUsesEncode
{
    function MachineriesActualUsesEncode(){
		
    }

    function saveMachineriesActualUses($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$machineriesActualUses = new MachineriesActualUses;
		$machineriesActualUses->parseDomDocument($domDoc);
		$ret = $machineriesActualUses->insertRecord();
		return $ret;
	}
	
	function getMachineriesActualUsesDetails($machineriesActualUsesID) {
		$machineriesActualUses = new MachineriesActualUses;
		$machineriesActualUses->selectRecord($machineriesActualUsesID);
		if(!$domDoc = $machineriesActualUses->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateMachineriesActualUses($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$machineriesActualUses = new MachineriesActualUses;
		$machineriesActualUses->parseDomDocument($domDoc);
		$ret = $machineriesActualUses->updateRecord();
		return $ret;
	}
}

/*
$machineriesActualUses = new MachineriesActualUses;
//$machineriesActualUses->setMachineriesActualUsesID(126);
$machineriesActualUses->setCode("KJKSJDF");
$machineriesActualUses->setDescription("KLAJSDFJASLKFJALSKFJ");
$machineriesActualUses->setValue("1234");
$machineriesActualUses->setStatus("Active");
$machineriesActualUses->setDomDocument();
$domDoc = $machineriesActualUses->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new MachineriesActualUsesEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updateMachineriesActualUses($xmlStr);
echo $obj->saveMachineriesActualUses($xmlStr);
//echo  $obj->getMachineriesActualUsesDetails(128);
//*/
?>
