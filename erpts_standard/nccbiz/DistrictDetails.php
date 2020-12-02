<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/District.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('DistrictDetails');
$server->handle();
//*/
class DistrictDetails
{
    function DistrictDetails(){
		
    }

    function getDistrictDetails($districtID) {
		$district = new District;
		$district->selectRecord($districtID);
		if(!$domDoc = $district->getDomDocument()){
            return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}

// $obj = new DistrictDetails;
// echo $obj->getDistrictDetails(1);

?>
