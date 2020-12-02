<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('CompanyEncode');
$server->handle();
//*/
class CompanyEncode
{
    function CompanyEncode(){
		
    }
    
    function saveCompany($xmlStr,$ownerID="") {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$company = new Company;
		$company->parseDomDocument($domDoc);
		$ret = $company->insertRecord();
		$owner = new Owner;
		$owner->insertOwnerCompany($ownerID,$ret);
		return $ret;
	}
	
	function getCompanyDetails($companyID) {
		$company = new Company;
		$company->selectRecord($companyID);
		if(!$domDoc = $company->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateCompany($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$company = new Company;
		$company->parseDomDocument($domDoc);
		$ret = $company->updateRecord();
		return $ret;
	}
}
/*
$address = new Address;
//$address->setAddressID(130);
$address->setNumber("4");
$address->setStreet("1st Avenue");
$address->setBarangay("Beverly Hills");
$address->setDistrict("");
$address->setMunicipalityCity("Antipolo City");
$address->setProvince("Rizal");
$address->setDomDocument();

$company = new Company;
//$company->setCompanyID("47");
$company->setCompanyName("Sharp Prints");
$company->setTelephone("4217453");
$company->setFax("4217453");
$company->setTin("11111111111");
$company->setEmail("osty@yahoo.com");
$company->setWebsite("www.sharprints.com");
$company->setAddressArray($address);
$company->setDomDocument();

$domDoc = $company->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new CompanyEncode;
echo $obj->saveCompany($xmlStr);
//echo $obj->updateCompany($xmlStr);
//echo $obj->getCompanyDetails(47);
//*/
?>