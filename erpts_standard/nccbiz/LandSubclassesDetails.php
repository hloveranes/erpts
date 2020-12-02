<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/LandSubclasses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('LandSubclassesDetails');
$server->handle();
//*/
class LandSubclassesDetails
{
    function LandSubclassesDetails(){
		
    }

    function getLandSubclassesDetails($landSubclassesID) {
		$landSubclasses = new LandSubclasses;
		$landSubclasses->selectRecord($landSubclassesID);
		if(!$domDoc = $landSubclasses->getDomDocument()){
            return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
//*

// echo $obj->getLandSubclassesDetails(4);
//*/
?>
