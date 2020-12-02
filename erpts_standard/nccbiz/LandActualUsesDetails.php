<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/LandActualUses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('LandActualUsesDetails');
$server->handle();
//*/
class LandActualUsesDetails
{
    function LandActualUsesDetails(){
		
    }

    function getLandActualUsesDetails($landActualUsesID) {
		$landActualUses = new LandActualUses;
		$landActualUses->selectRecord($landActualUsesID);
		if(!$domDoc = $landActualUses->getDomDocument()){
            return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
//*

// echo $obj->getLandActualUsesDetails(4);
//*/
?>
