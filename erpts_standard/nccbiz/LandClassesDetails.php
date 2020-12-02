<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/LandClasses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('LandClassesDetails');
$server->handle();
//*/
class LandClassesDetails
{
    function LandClassesDetails(){
		
    }

    function getLandClassesDetails($landClassesID) {
		$landClasses = new LandClasses;
		$landClasses->selectRecord($landClassesID);
		if(!$domDoc = $landClasses->getDomDocument()){
            return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
//*

// echo $obj->getLandClassesDetails(4);
//*/
?>
