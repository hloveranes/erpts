<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/MachineriesClasses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('MachineriesClassesDetails');
$server->handle();
//*/
class MachineriesClassesDetails
{
    function MachineriesClassesDetails(){
		
    }

    function getMachineriesClassesDetails($machineriesClassesID) {
		$machineriesClasses = new MachineriesClasses;
		$machineriesClasses->selectRecord($machineriesClassesID);
		if(!$domDoc = $machineriesClasses->getDomDocument()){
            return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
//*

// echo $obj->getMachineriesClassesDetails(4);
//*/
?>
