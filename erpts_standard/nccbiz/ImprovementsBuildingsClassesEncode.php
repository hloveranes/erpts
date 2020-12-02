<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/ImprovementsBuildingsClasses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ImprovementsBuildingsClassesEncode');
$server->handle();
//*/
class ImprovementsBuildingsClassesEncode
{
    function ImprovementsBuildingsClassesEncode(){
		
    }

    function saveImprovementsBuildingsClasses($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
		$improvementsBuildingsClasses->parseDomDocument($domDoc);
		$ret = $improvementsBuildingsClasses->insertRecord();
		return $ret;
	}
	
	function getImprovementsBuildingsClassesDetails($improvementsBuildingsClassesID) {
		$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
		$improvementsBuildingsClasses->selectRecord($improvementsBuildingsClassesID);
		if(!$domDoc = $improvementsBuildingsClasses->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateImprovementsBuildingsClasses($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
		$improvementsBuildingsClasses->parseDomDocument($domDoc);
		$ret = $improvementsBuildingsClasses->updateRecord();
		return $ret;
	}
}

/*
$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
//$improvementsBuildingsClasses->setImprovementsBuildingsClassesID(126);
$improvementsBuildingsClasses->setCode("KJKSJDF");
$improvementsBuildingsClasses->setDescription("KLAJSDFJASLKFJALSKFJ");
$improvementsBuildingsClasses->setValue("1234");
$improvementsBuildingsClasses->setStatus("Active");
$improvementsBuildingsClasses->setDomDocument();
$domDoc = $improvementsBuildingsClasses->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new ImprovementsBuildingsClassesEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updateImprovementsBuildingsClasses($xmlStr);
echo $obj->saveImprovementsBuildingsClasses($xmlStr);
//echo  $obj->getImprovementsBuildingsClassesDetails(128);
//*/
?>
