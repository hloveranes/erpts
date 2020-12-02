<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/PlantsTreesActualUses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PlantsTreesActualUsesEncode');
$server->handle();
//*/
class PlantsTreesActualUsesEncode
{
    function PlantsTreesActualUsesEncode(){
		
    }

    function savePlantsTreesActualUses($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$plantsTreesActualUses = new PlantsTreesActualUses;
		$plantsTreesActualUses->parseDomDocument($domDoc);
		$ret = $plantsTreesActualUses->insertRecord();
		return $ret;
	}
	
	function getPlantsTreesActualUsesDetails($plantsTreesActualUsesID) {
		$plantsTreesActualUses = new PlantsTreesActualUses;
		$plantsTreesActualUses->selectRecord($plantsTreesActualUsesID);
		if(!$domDoc = $plantsTreesActualUses->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updatePlantsTreesActualUses($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$plantsTreesActualUses = new PlantsTreesActualUses;
		$plantsTreesActualUses->parseDomDocument($domDoc);
		$ret = $plantsTreesActualUses->updateRecord();
		return $ret;
	}
}

/*
$plantsTreesActualUses = new PlantsTreesActualUses;
//$plantsTreesActualUses->setPlantsTreesActualUsesID(126);
$plantsTreesActualUses->setCode("KJKSJDF");
$plantsTreesActualUses->setDescription("KLAJSDFJASLKFJALSKFJ");
$plantsTreesActualUses->setValue("1234");
$plantsTreesActualUses->setStatus("Active");
$plantsTreesActualUses->setDomDocument();
$domDoc = $plantsTreesActualUses->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new PlantsTreesActualUsesEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updatePlantsTreesActualUses($xmlStr);
echo $obj->savePlantsTreesActualUses($xmlStr);
//echo  $obj->getPlantsTreesActualUsesDetails(128);
//*/
?>
