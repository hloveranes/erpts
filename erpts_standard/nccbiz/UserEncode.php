<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/User.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('UserEncode');
$server->handle();
//*/
class UserEncode
{
    function UserEncode(){
		
    }

    function saveUser($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$user = new User;
		$user->parseDomDocument($domDoc);
		$ret = $user->insertRecord();
		return $ret;
	}
	
	function getUserDetails($userID) {
		$user = new User;
		$user->selectRecord($userID);
		if(!$domDoc = $user->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateUser($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$user = new User;
		$user->parseDomDocument($domDoc);
		$ret = $user->updateRecord();
		return $ret;
	}
}

/*
$user = new User;

$user->setUserID(1);
$user->setUserType("myUserType");
$user->setUsername("myUsername");
$user->setPassword("myPassword");
$user->setPersonID("2");
$user->setDateCreated("April 11, 2004");
$user->setDateModified("April 11, 2004");

$user->setDomDocument();
$domDoc = $user->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new UserEncode;
echo $xmlStr;
//echo $obj->updateUser($xmlStr);
//echo $obj->saveUser($xmlStr);
//echo  $obj->getUserDetails(128);
//*/
?>
