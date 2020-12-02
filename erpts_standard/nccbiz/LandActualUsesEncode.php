<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/LandActualUses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('LandActualUsesEncode');
$server->handle();
//*/
class LandActualUsesEncode
{
    function LandActualUsesEncode(){
		
    }

    function saveLandActualUses($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$landActualUses = new LandActualUses;
		$landActualUses->parseDomDocument($domDoc);
		$ret = $landActualUses->insertRecord();
		return $ret;
	}
	
	function getLandActualUsesDetails($landActualUsesID) {
		$landActualUses = new LandActualUses;
		$landActualUses->selectRecord($landActualUsesID);
		if(!$domDoc = $landActualUses->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateLandActualUses($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$landActualUses = new LandActualUses;
		$landActualUses->parseDomDocument($domDoc);
		$ret = $landActualUses->updateRecord();
		return $ret;
	}
}

/*
$landActualUses = new LandActualUses;
//$landActualUses->setLandActualUsesID(126);
$landActualUses->setCode("KJKSJDF");
$landActualUses->setDescription("KLAJSDFJASLKFJALSKFJ");
$landActualUses->setValue("1234");
$landActualUses->setStatus("Active");
$landActualUses->setDomDocument();
$domDoc = $landActualUses->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new LandActualUsesEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updateLandActualUses($xmlStr);
echo $obj->saveLandActualUses($xmlStr);
//echo  $obj->getLandActualUsesDetails(128);
//*/
?>
