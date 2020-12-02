<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/MachineriesActualUses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('MachineriesActualUsesDetails');
$server->handle();
//*/
class MachineriesActualUsesDetails
{
    function MachineriesActualUsesDetails(){
		
    }

    function getMachineriesActualUsesDetails($machineriesActualUsesID) {
		$machineriesActualUses = new MachineriesActualUses;
		$machineriesActualUses->selectRecord($machineriesActualUsesID);
		if(!$domDoc = $machineriesActualUses->getDomDocument()){
            return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
//*

// echo $obj->getMachineriesActualUsesDetails(4);
//*/
?>
