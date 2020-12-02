<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/PlantsTreesActualUses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PlantsTreesActualUsesDetails');
$server->handle();
//*/
class PlantsTreesActualUsesDetails
{
    function PlantsTreesActualUsesDetails(){
		
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
}
//*

// echo $obj->getPlantsTreesActualUsesDetails(4);
//*/
?>
