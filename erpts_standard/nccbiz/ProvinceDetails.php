<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Province.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ProvinceDetails');
$server->handle();
//*/
class ProvinceDetails
{
    function ProvinceDetails(){
		
    }

    function getProvinceDetails($provinceID) {
		$province = new Province;
		$province->selectRecord($provinceID);
		if(!$domDoc = $province->getDomDocument()){
            return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
//*

// echo $obj->getProvinceDetails(4);
//*/
?>
