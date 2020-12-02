<?php
# Setup PHPLIB in storey Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/AFS.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('AFSEncode');
$server->handle();
//*/
class AFSEncode
{
    function AFSEncode(){
		
    }
    
    function saveAFS($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$afs = new AFS;
		$afs->parseDomDocument($domDoc);
		$ret = $afs->insertRecord();
		return $ret;
	}
	
	function getAFSDetails($storeyID) {
		$afs = new AFS;
		$afs->selectAFS($storeyID);
		if(!$domDoc = $afs->getDomAFS()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateAFS($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$afs = new AFS;
		$afs->parseDomDocument($domDoc);
		$ret = $afs->updateRecord();
		return $ret;
	}
	
	function getOdID($afsID){
		$afs = new AFS;
		if(!$odID = $afs->checkOdID($afsID)) return false;
		else return $odID;
	}
	
	function getAFSForList($afsID){
		$afs = new AFS;
		$afs->selectRecordForList($afsID);
		if(!$domDoc = $afs->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function getAfsID($odID){
		$afs = new AFS;
		if (!$afsID = $afs->checkAfsID($odID)) return false;
		else return $afsID;
	}
}
/*
//for ($i = 1; $i <= 999; $i++) {
$afs = new AFS;
$afs->setAfsID(27);
$afs->setPropertyIndexNumber("1xxxx");
$afs->setCertificateOfTitleNumber("2xxxxxx");
$afs->setCadastralLotNumber("3xxxx");
$afs->setNorth("4xxx");
$afs->setSouth("5xxx");
$afs->setEast("6xxx");
$afs->setWest("7xxxxx");
	$person = new Person;
	$person->setPersonID(90);
	$person->setLastName("lastNamexxxxx");
	$person->setFirstName("firstNamexxxx");
	$person->setMiddleName("middleNamexxxx");
		$adminAddress = new Address;
		$adminAddress->setNumber("numberxxxx");
		$adminAddress->setStreet("streetxxxxx");
		$adminAddress->setBarangay("barangayxxxx");
		$adminAddress->setDistrict("districtxxxxxx");
		$adminAddress->setMunicipalityCity("municipalityCityxxxxx");
		$adminAddress->setProvince("provincexxxxx");
		$adminAddress->setDomDocument();
	$person->setAddressArray($adminAddress);
	$person->setTelephone("telephonexxxxx");
	$person->setDomDocument();
$afs->setAdministratorArray($person);
$afs->setDomDocument();
$obj = new AFSEncode;
$xmlStr = $afs->domDocument->dump_mem(true);
//echo $xmlStr;
//echo $obj->updateAFS($xmlStr);
//echo $xmlStr;
echo $obj->saveAFS($xmlStr)."<br>"	;
//}
//echo $obj->getAFSDetails(4);
//echo $obj->getAfsID(72);
//*/
?>