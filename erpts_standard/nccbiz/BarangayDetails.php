<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Barangay.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('BarangayDetails');
$server->handle();
//*/
class BarangayDetails
{
    function BarangayDetails(){
		
    }

    function getBarangayDetails($barangayID) {
		$barangay = new Barangay;
		$barangay->selectRecord($barangayID);
		if(!$domDoc = $barangay->getDomDocument()){
            return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
//*

// echo $obj->getBarangayDetails(4);
//*/
?>
