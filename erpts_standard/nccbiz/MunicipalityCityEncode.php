<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/MunicipalityCity.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('MunicipalityCityEncode');
$server->handle();
//*/
class MunicipalityCityEncode
{
    function MunicipalityCityEncode(){
		
    }

    function saveMunicipalityCity($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$municipalityCity = new MunicipalityCity;
		$municipalityCity->parseDomDocument($domDoc);
		$ret = $municipalityCity->insertRecord();
		return $ret;
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
	
	function updateMunicipalityCity($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$municipalityCity = new MunicipalityCity;
		$municipalityCity->parseDomDocument($domDoc);
		$ret = $municipalityCity->updateRecord();
		return $ret;
	}
}

/*
$municipalityCity = new MunicipalityCity;
//$municipalityCity->setMunicipalityCityID(126);
$municipalityCity->setCode("KJKSJDF");
$municipalityCity->setDescription("KLAJSDFJASLKFJALSKFJ");
$municipalityCity->setStatus("Active");
$municipalityCity->setDomDocument();
$domDoc = $municipalityCity->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new MunicipalityCityEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updateMunicipalityCity($xmlStr);
echo $obj->saveMunicipalityCity($xmlStr);
//echo  $obj->getMunicipalityCityDetails(128);
//*/
?>
