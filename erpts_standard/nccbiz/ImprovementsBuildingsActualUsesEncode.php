<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/ImprovementsBuildingsActualUses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ImprovementsBuildingsActualUsesEncode');
$server->handle();
//*/
class ImprovementsBuildingsActualUsesEncode
{
    function ImprovementsBuildingsActualUsesEncode(){
		
    }

    function saveImprovementsBuildingsActualUses($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
		$improvementsBuildingsActualUses->parseDomDocument($domDoc);
		$ret = $improvementsBuildingsActualUses->insertRecord();
		return $ret;
	}
	
	function getImprovementsBuildingsActualUsesDetails($improvementsBuildingsActualUsesID) {
		$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
		$improvementsBuildingsActualUses->selectRecord($improvementsBuildingsActualUsesID);
		if(!$domDoc = $improvementsBuildingsActualUses->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateImprovementsBuildingsActualUses($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
		$improvementsBuildingsActualUses->parseDomDocument($domDoc);
		$ret = $improvementsBuildingsActualUses->updateRecord();
		return $ret;
	}
}

/*
$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
//$improvementsBuildingsActualUses->setImprovementsBuildingsActualUsesID(126);
$improvementsBuildingsActualUses->setCode("KJKSJDF");
$improvementsBuildingsActualUses->setDescription("KLAJSDFJASLKFJALSKFJ");
$improvementsBuildingsActualUses->setValue("1234");
$improvementsBuildingsActualUses->setStatus("Active");
$improvementsBuildingsActualUses->setDomDocument();
$domDoc = $improvementsBuildingsActualUses->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new ImprovementsBuildingsActualUsesEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updateImprovementsBuildingsActualUses($xmlStr);
echo $obj->saveImprovementsBuildingsActualUses($xmlStr);
//echo  $obj->getImprovementsBuildingsActualUsesDetails(128);
//*/
?>
