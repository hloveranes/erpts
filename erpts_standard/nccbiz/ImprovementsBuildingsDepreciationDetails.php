<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/ImprovementsBuildingsDepreciation.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ImprovementsBuildingsDepreciationDetails');
$server->handle();
//*/
class ImprovementsBuildingsDepreciationDetails
{
    function ImprovementsBuildingsDepreciationDetails(){
		
    }

    function getImprovementsBuildingsDepreciationDetails($improvementsBuildingsDepreciationID) {
		$improvementsBuildingsDepreciation = new ImprovementsBuildingsDepreciation;
		$improvementsBuildingsDepreciation->selectRecord($improvementsBuildingsDepreciationID);
		if(!$domDoc = $improvementsBuildingsDepreciation->getDomDocument()){
            return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
//*

// echo $obj->getImprovementsBuildingsDepreciationDetails(4);
//*/
?>
