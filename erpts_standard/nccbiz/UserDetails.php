<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/User.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('UserDetails');
$server->handle();
//*/
class UserDetails
{
    function UserDetails(){
		
    }

    function getUserDetails($personID) {
		$user = new User;
		$user->selectRecord($personID);
		if(!$domDoc = $user->getDomDocument()){
            return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
//*

// echo $obj->getUserDetails(4);
//*/
?>
