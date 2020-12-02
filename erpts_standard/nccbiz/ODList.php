<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Owner.php";
include("assessor/ODRecords.php";
include("assessor/OD.php";

include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/TD.php";


//*
$server = new SoapServer("urn:Object");
$server->setClass('ODList');
$server->handle();
//*/
class ODList
{
    function ODList(){
		
    }
    
    function getODList($page=0,$condition) {
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		$odRecords = new ODRecords;
		if ($odRecords->selectRecords($condition)){
			if(!$domDoc = $odRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}

	// NCC Modification checked and implemented by K2 : November 16, 2005
	// details:
	//      added function getLatestActiveODListGenRevBrgy() in line 46

	//alex:
	function getLatestActiveODListGenRevBrgy($brgy = 0){
		$odRecords = new ODRecords;
		if($odIDList = $odRecords->selectLatestActiveRecordsGenRevBrgy($brgy)){
				return $odIDList;
		}
		else{
			return false;
		}
	}

	function getLatestActiveODList(){
		$odRecords = new ODRecords;
		if($odIDList = $odRecords->selectLatestActiveRecords()){
				return $odIDList;
		}
		else{
			return false;
		}
	}
	
	function getODCount($condition=""){
		$odRecords = new ODRecords;
		return $odRecords->countRecords($condition);
	}

	function archiveOD($odIDArray,$archiveValue,$userID){
		$odRecords = new ODRecords;
		$ret = $odRecords->archiveRecords($odIDArray,$archiveValue,$userID);
		return $ret;
	}
	
	function deleteOD($odIDArray){
		$odRecords = new ODRecords;
		$rows = $odRecords->deleteRecords($odIDArray);
		return $rows;
	}

	function filterByBarangay($page=0,$searchKey,$condition="") {
	    if($page > 0){
	        $page = ($page-1) * PAGE_BY;
	        $condition .= " LIMIT $page,".PAGE_BY;
        }
        $fields = array(
			BARANGAY_TABLE . ".description",
        );
        $odRecords = new ODRecords;
        if ($odRecords->searchRecords($searchKey,$fields,$condition)){
            if(!$domDoc = $odRecords->getDomDocument()){
                return false;
            }
            else {
                $xmlStr = $domDoc->dump_mem(true);
                return $xmlStr;
            }
        }
        else return false;
	}

	function filterByBarangayCount($searchKey,$condition){
        $fields = array(
			BARANGAY_TABLE . ".description",
        );
		$odRecords = new odRecords;
		return $odRecords->countSearchRecords($searchKey,$fields,$condition);
	}
	
	function searchOD($page=0,$searchKey,$condition="") {
	    if($page > 0){
	        $page = ($page-1) * PAGE_BY;
	        $condition .= " LIMIT $page,".PAGE_BY;
        }
        $fields = array(
            COMPANY_TABLE . ".companyName",
            PERSON_TABLE . ".lastName",
            PERSON_TABLE . ".middleName",
            PERSON_TABLE . ".firstName",
            LOCATIONADDRESS_TABLE . ".number",
            LOCATIONADDRESS_TABLE . ".street",

			BARANGAY_TABLE . ".description",
			DISTRICT_TABLE . ".description",
			MUNICIPALITYCITY_TABLE . ".description",
			PROVINCE_TABLE . ".description"
        );
        $odRecords = new ODRecords;
        if ($odRecords->searchRecords($searchKey,$fields,$condition)){
            if(!$domDoc = $odRecords->getDomDocument()){
                return false;
            }
            else {
                $xmlStr = $domDoc->dump_mem(true);
                return $xmlStr;
            }
        }
        else return false;
	}	
	
	function getSearchCount($searchKey,$condition){
        $fields = array(
            COMPANY_TABLE . ".companyName",
            PERSON_TABLE . ".lastName",
            PERSON_TABLE . ".middleName",
            PERSON_TABLE . ".firstName",
            LOCATIONADDRESS_TABLE . ".number",
            LOCATIONADDRESS_TABLE . ".street",

			BARANGAY_TABLE . ".description",
			DISTRICT_TABLE . ".description",
			MUNICIPALITYCITY_TABLE . ".description",
			PROVINCE_TABLE . ".description"
        );
		$odRecords = new odRecords;
		return $odRecords->countSearchRecords($searchKey,$fields,$condition);
	}
}

//$odList = new ODList;
//echo $odList->getODList();

//$odList = new ODList;
//echo $odList->searchOD("","ang");


/*
$address = new Address;
//$address->setAddressID(124);
$address->setNumber("10th Floor Orient Square Building");
$address->setStreet("Emerald Avenue");
$address->setBarangay("Barangay San Antonio");
$address->setDistrict("Ortigas Center");
$address->setMunicipalityCity("Pasig City");
$address->setProvince("Metro Manila");
$address->setDomDocument();

$locationAddress = new LocationAddress;
//$address->setAddressID(124);
$location->setNumber("unit 2415 Megaplaza Building");
$location->setStreet("ADB Avenue corner Garnett Street");
$location->setBarangay("Barangay San Antonio");
$location->setDistrict("Ortigas Center");
$location->setMunicipalityCity("Pasig City");
$location->setProvince("Metro Manila");
$location->setDomDocument();

$person = new Person;
//$person->setPersonID(126);
$person->setFirstName("Juan");
$person->setMiddleName("Miranda");
$person->setLastName("Nelson");
$person->setGender("male");
$person->setBirthday("1977/07/09");
$person->setMaritalStatus("single");
$person->setTin("1234567890");
$person->setTelephone("026584746");
$person->setMobileNumber("09175302791");
$person->setEmail("nelson@k2ia.com");
$person->setAddressArray($address);;
$person->setDomDocument();
//$domDoc = $person->getDomDocument();
//$xmlStr = $domDoc->dump_mem(true);

$address1 = new Address;
//$address->setAddressID(130);
$address1->setNumber("4");
$address1->setStreet("1st Avenue");
$address1->setBarangay("Beverly Hills");
$address1->setDistrict("");
$address1->setMunicipalityCity("Antipolo City");
$address1->setProvince("Rizal");
$address1->setDomDocument();

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

$owner = new Owner;
$owner->setPersonArray($person);
$owner->setCompanyArray($company);
$owner->setDomDocument();

$od = new OD;
//$od->setOdID("");
$od->setLocation($location);
$od->setLandArea("200sqm");
$od->setHouseTagNumber("1003-1005");
$od->setLotNumber("8645");
$od->setBlockNumber("34534");
$od->setZoneNumber("3534");
$od->setPsd13("1223");
$od->setAffidavitOfOwnership("1");
$od->setBarangayCertificate("1");
$od->setLandTagging("1");
$od->setOwner($owner);
$od->setDomDocument();
$domDoc = $od->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
echo $xmlStr;
//if(!$domDoc = domxml_open_mem($xmlStr)) {
//	return false;
//}
$object = new od;
$object->parseDomDocument($domDoc);
//echo($od2);
//print_r($object);
$domDoc = $object->getDomDocument();
//print_r($domDOc);
$xmlStr = $domDoc->dump_mem(true);
echo $xmlStr;
//$obj = new ODList;
$dom = domxml_new_doc("1.0");
//print_r($dom);
//echo (get_class($dom) == DomDocument);
//echo "<br>xml".$obj->getODList();

//*/
//$obj = new ODList;
//echo $obj->getODList();
?>
