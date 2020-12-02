<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Address.php";
include("assessor/Person.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PersonDetails');
$server->handle();
//*/
class PersonDetails
{
    function PersonDetails(){
		
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
}
//*

//echo $obj->getPersonDetails(4);
//*/
?>