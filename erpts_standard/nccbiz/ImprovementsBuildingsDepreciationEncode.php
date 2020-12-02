<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/ImprovementsBuildingsDepreciation.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ImprovementsBuildingsDepreciationEncode');
$server->handle();
//*/
class ImprovementsBuildingsDepreciationEncode
{
    function ImprovementsBuildingsDepreciationEncode(){
		
    }

    function saveImprovementsBuildingsDepreciation($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$improvementsBuildingsDepreciation = new ImprovementsBuildingsDepreciation;
		$improvementsBuildingsDepreciation->parseDomDocument($domDoc);
		$ret = $improvementsBuildingsDepreciation->insertRecord();
		return $ret;
	}
	
	function getImprovementsBuildingsDepreciationDetails($improvementsBuildingsDepreciationID) {
		$improvementsBuildingsDepreciation = new ImprovementsBuildingsDepreciation;
		$improvementsBuildingsDepreciation->selectRecord($improvementsBuildingsDepreciationID);
		if(!$domDoc = $baranggay->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateImprovementsBuildingsDepreciation($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$improvementsBuildingsDepreciation = new ImprovementsBuildingsDepreciation;
		$improvementsBuildingsDepreciation->parseDomDocument($domDoc);
		$ret = $improvementsBuildingsDepreciation->updateRecord();
		return $ret;
	}
}

/*
$improvementsBuildingsDepreciation = new ImprovementsBuildingsDepreciation;
//$improvementsBuildingsDepreciation->setImprovementsBuildingsDepreciationID(126);
$improvementsBuildingsDepreciation->setCode("KJKSJDF");
$improvementsBuildingsDepreciation->setDescription("KLAJSDFJASLKFJALSKFJ");
$improvementsBuildingsDepreciation->setValue("1234");
$improvementsBuildingsDepreciation->setStatus("Active");
$improvementsBuildingsDepreciation->setDomDocument();
$domDoc = $improvementsBuildingsDepreciation->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new ImprovementsBuildingsDepreciationEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updateImprovementsBuildingsDepreciation($xmlStr);
echo $obj->saveImprovementsBuildingsDepreciation($xmlStr);
//echo  $obj->getImprovementsBuildingsDepreciationDetails(128);
//*/
?>
