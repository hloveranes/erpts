<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/MunicipalityCity.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('MunicipalityCityDetails');
$server->handle();
//*/
class MunicipalityCityDetails
{
    function MunicipalityCityDetails(){
		
    }

    function getMunicipalityCityDetails($municipalityCityID) {
		$municipalityCity = new MunicipalityCity;
		$municipalityCity->selectRecord($municipalityCityID);
		if(!$domDoc = $municipalityCity->getDomDocument()){
            return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
/*

$obj = new MunicipalityCityDetails;
echo htmlentities($obj->getMunicipalityCityDetails(1));

//*/
?>
