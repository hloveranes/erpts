<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/ImprovementsBuildingsClasses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ImprovementsBuildingsClassesDetails');
$server->handle();
//*/
class ImprovementsBuildingsClassesDetails
{
    function ImprovementsBuildingsClassesDetails(){
		
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
}
//*

// echo $obj->getImprovementsBuildingsClassesDetails(4);
//*/
?>
