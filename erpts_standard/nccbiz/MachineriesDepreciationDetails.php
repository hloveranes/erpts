<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/MachineriesDepreciation.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('MachineriesDepreciationDetails');
$server->handle();
//*/
class MachineriesDepreciationDetails
{
    function MachineriesDepreciationDetails(){
		
    }

    function getMachineriesDepreciationDetails($machineriesDepreciationID) {
		$machineriesDepreciation = new MachineriesDepreciation;
		$machineriesDepreciation->selectRecord($machineriesDepreciationID);
		if(!$domDoc = $machineriesDepreciation->getDomDocument()){
            return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
//*

// echo $obj->getMachineriesDepreciationDetails(4);
//*/
?>
