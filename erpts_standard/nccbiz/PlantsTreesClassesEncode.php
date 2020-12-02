<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/PlantsTreesClasses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PlantsTreesClassesEncode');
$server->handle();
//*/
class PlantsTreesClassesEncode
{
    function PlantsTreesClassesEncode(){
		
    }

    function savePlantsTreesClasses($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$plantsTreesClasses = new PlantsTreesClasses;
		$plantsTreesClasses->parseDomDocument($domDoc);
		$ret = $plantsTreesClasses->insertRecord();
		return $ret;
	}
	
	function getPlantsTreesClassesDetails($plantsTreesClassesID) {
		$plantsTreesClasses = new PlantsTreesClasses;
		$plantsTreesClasses->selectRecord($plantsTreesClassesID);
		if(!$domDoc = $plantsTreesClasses->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updatePlantsTreesClasses($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$plantsTreesClasses = new PlantsTreesClasses;
		$plantsTreesClasses->parseDomDocument($domDoc);
		$ret = $plantsTreesClasses->updateRecord();
		return $ret;
	}
}

/*
$plantsTreesClasses = new PlantsTreesClasses;
//$plantsTreesClasses->setPlantsTreesClassesID(126);
$plantsTreesClasses->setCode("KJKSJDF");
$plantsTreesClasses->setDescription("KLAJSDFJASLKFJALSKFJ");
$plantsTreesClasses->setValue("1234");
$plantsTreesClasses->setStatus("Active");
$plantsTreesClasses->setDomDocument();
$domDoc = $plantsTreesClasses->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new PlantsTreesClassesEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updatePlantsTreesClasses($xmlStr);
echo $obj->savePlantsTreesClasses($xmlStr);
//echo  $obj->getPlantsTreesClassesDetails(128);
//*/
?>
