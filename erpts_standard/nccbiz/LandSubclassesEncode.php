<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/LandSubclasses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('LandSubclassesEncode');
$server->handle();
//*/
class LandSubclassesEncode
{
    function LandSubclassesEncode(){
		
    }

    function saveLandSubclasses($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$landSubclasses = new LandSubclasses;
		$landSubclasses->parseDomDocument($domDoc);
		$ret = $landSubclasses->insertRecord();
		return $ret;
	}
	
	function getLandSubclassesDetails($landSubclassesID) {
		$landSubclasses = new LandSubclasses;
		$landSubclasses->selectRecord($landSubclassesID);
		if(!$domDoc = $landSubclasses->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateLandSubclasses($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$landSubclasses = new LandSubclasses;
		$landSubclasses->parseDomDocument($domDoc);
		$ret = $landSubclasses->updateRecord();
		return $ret;
	}
}

/*
$landSubclasses = new LandSubclasses;
//$landSubclasses->setLandSubclassesID(126);
$landSubclasses->setCode("KJKSJDF");
$landSubclasses->setDescription("KLAJSDFJASLKFJALSKFJ");
$landSubclasses->setValue("1234");
$landSubclasses->setStatus("Active");
$landSubclasses->setDomDocument();
$domDoc = $landSubclasses->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new LandSubclassesEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updateLandSubclasses($xmlStr);
echo $obj->saveLandSubclasses($xmlStr);
//echo  $obj->getLandSubclassesDetails(128);
//*/
?>
