<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/PlantsTreesClasses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PlantsTreesClassesDetails');
$server->handle();
//*/
class PlantsTreesClassesDetails
{
    function PlantsTreesClassesDetails(){
		
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
}
//*

// echo $obj->getPlantsTreesClassesDetails(4);
//*/
?>
