<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PersonEncode');
$server->handle();
//*/
class PersonEncode
{
    function PersonEncode(){
		
    }
    
    function savePerson($xmlStr,$ownerID="") {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$person = new Person;
		$person->parseDomDocument($domDoc);
		$ret = $person->insertRecord();
		$owner = new Owner;
		$owner->insertOwnerPerson($ownerID,$ret);
		return $ret;
	}
	
	function getPersonDetails($personID) {
		$person = new Person;
		$person->selectRecord($personID);
		if(!$domDoc = $person->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updatePerson($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$person = new Person;
		$person->parseDomDocument($domDoc);
		$ret = $person->updateRecord();
		return $ret;
	}
}
/*
$address = new Address;
//$address->setAddressID(124);
$address->setNumber("xunit 2415 Megaplaza Building");
$address->setStreet("xADB Avenue corner Garnett Street");
$address->setBarangay("xBarangay San Antonio");
$address->setDistrict("xOrtigas Center");
$address->setMunicipalityCity("xPasig City");
$address->setProvince("xMetro Manila");
$address->setDomDocument();

$address1 = new Address;
//$address->setAddressID(124);
$address1->setNumber("unit 2415 Megaplaza Building");
$address1->setStreet("ADB Avenue corner Garnett Street");
$address1->setBarangay("Barangay San Antonio");
$address1->setDistrict("Ortigas Center");
$address1->setMunicipalityCity("Pasig City");
$address1->setProvince("Metro Manila");
$address1->setDomDocument();

$person = new Person;
//$person->setPersonID(126);
$person->setFirstName("Nelson Juan");
$person->setMiddleName("Miranda");
$person->setLastName("Manlapaz");
$person->setGender("male");
$person->setBirthday("1977/07/09");
$person->setMaritalStatus("single");
$person->setTin("1234567890");
$person->setTelephone("026584746");
$person->setMobileNumber("09175302791");
$person->setEmail("nelson@k2ia.com");
$person->setAddressArray($address);
$person->setAddressArray($address1);
$person->setDomDocument();
$domDoc = $person->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new PersonEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updatePerson($xmlStr);
echo $obj->savePerson($xmlStr);
//echo  $obj->getPersonDetails(128);
//*/
?>
