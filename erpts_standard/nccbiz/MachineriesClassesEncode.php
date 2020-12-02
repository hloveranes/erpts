<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/MachineriesClasses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('MachineriesClassesEncode');
$server->handle();
//*/
class MachineriesClassesEncode
{
    function MachineriesClassesEncode(){
		
    }

    function saveMachineriesClasses($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$machineriesClasses = new MachineriesClasses;
		$machineriesClasses->parseDomDocument($domDoc);
		$ret = $machineriesClasses->insertRecord();
		return $ret;
	}
	
	function getMachineriesClassesDetails($machineriesClassesID) {
		$machineriesClasses = new MachineriesClasses;
		$machineriesClasses->selectRecord($machineriesClassesID);
		if(!$domDoc = $machineriesClasses->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateMachineriesClasses($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$machineriesClasses = new MachineriesClasses;
		$machineriesClasses->parseDomDocument($domDoc);
		$ret = $machineriesClasses->updateRecord();
		return $ret;
	}
}

/*
$machineriesClasses = new MachineriesClasses;
//$machineriesClasses->setMachineriesClassesID(126);
$machineriesClasses->setCode("KJKSJDF");
$machineriesClasses->setDescription("KLAJSDFJASLKFJALSKFJ");
$machineriesClasses->setValue("1234");
$machineriesClasses->setStatus("Active");
$machineriesClasses->setDomDocument();
$domDoc = $machineriesClasses->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new MachineriesClassesEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updateMachineriesClasses($xmlStr);
echo $obj->saveMachineriesClasses($xmlStr);
//echo  $obj->getMachineriesClassesDetails(128);
//*/
?>
