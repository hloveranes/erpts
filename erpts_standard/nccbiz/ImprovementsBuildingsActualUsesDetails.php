<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/ImprovementsBuildingsActualUses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ImprovementsBuildingsActualUsesDetails');
$server->handle();
//*/
class ImprovementsBuildingsActualUsesDetails
{
    function ImprovementsBuildingsActualUsesDetails(){
		
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
}
//*

// echo $obj->getImprovementsBuildingsActualUsesDetails(4);
//*/
?>
