<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/LandClasses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('LandClassesEncode');
$server->handle();
//*/
class LandClassesEncode
{
    function LandClassesEncode(){
		
    }

    function saveLandClasses($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$landClasses = new LandClasses;
		$landClasses->parseDomDocument($domDoc);
		$ret = $landClasses->insertRecord();
		return $ret;
	}
	
	function getLandClassesDetails($landClassesID) {
		$landClasses = new LandClasses;
		$landClasses->selectRecord($landClassesID);
		if(!$domDoc = $landClasses->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateLandClasses($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$landClasses = new LandClasses;
		$landClasses->parseDomDocument($domDoc);
		$ret = $landClasses->updateRecord();
		return $ret;
	}
}

/*
$landClasses = new LandClasses;
//$landClasses->setLandClassesID(126);
$landClasses->setCode("KJKSJDF");
$landClasses->setDescription("KLAJSDFJASLKFJALSKFJ");
$landClasses->setValue("1234");
$landClasses->setStatus("Active");
$landClasses->setDomDocument();
$domDoc = $landClasses->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new LandClassesEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updateLandClasses($xmlStr);
echo $obj->saveLandClasses($xmlStr);
//echo  $obj->getLandClassesDetails(128);
//*/
?>
