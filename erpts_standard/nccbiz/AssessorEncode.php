<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/Assessor.php";
include_once "../includes/assessor/AssessorRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('AssessorEncode');
$server->handle();
//*/
class AssessorEncode
{
    function AssessorEncode(){
		
    }
    
    function saveAssessor($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$assessor = new Assessor;
		$assessor->parseDomDocument($domDoc);
		$ret = $assessor->insertRecord();
		return $ret;
	}
	
	function getAssessorDetails($assessorID) {
		$assessor = new Assessor;
		$assessor->selectRecord($assessorID);
		if(!$domDoc = $assessor->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateAssessor($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$assessor = new Assessor;
		$assessor->parseDomDocument($domDoc);
		$ret = $assessor->updateRecord();
		return $ret;
	}
	
	function deleteAssessor($assessorID){
		$assessor = new Assessor;
		$ret = $assessor->deleteRecord($assessorID);
		return $ret;
	}
}
/*
$address = new Address;
//$address->setAddressID(197);
$address->setNumber("x 2415 Megaplaza Building");
$address->setStreet("x Avenue corner Garnett Street");
$address->setBarangay("x San Antonio");
$address->setDistrict("x Center");
$address->setMunicipalityCity("x City");
$address->setProvince("x Manila");
$address->setDomDocument();

$assessor = new Assessor;
//$assessor->setAssessorID(3);
//$assessor->setPersonID(154);
$assessor->setFirstName("Nelson");
$assessor->setMiddleName("Mirandax");
$assessor->setLastName("Manlapazx");
$assessor->setGender("male");
$assessor->setBirthday("1977/07/09");
$assessor->setMaritalStatus("single");
$assessor->setTin("dffwerfwerf");
$assessor->setTelephone("erfefefref");
$assessor->setMobileNumber("09175302791");
$assessor->setEmail("nelson@k2ia.com");
$assessor->setPosition("web developer");
$assessor->setAddressArray($address);
$assessor->setDomDocument();
$domDoc = $assessor->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new AssessorEncode;
//echo "hello<br>";
//echo $xmlStr;
//echo $obj->updateAssessor($xmlStr);
echo $obj->saveAssessor($xmlStr);
//echo  $obj->getAssessorDetails(3);
//echo $obj->deleteAssessor(1);
//*/
?>