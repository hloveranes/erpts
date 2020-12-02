<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/User.php";
include("assessor/UserRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('UserList');
$server->handle();
//*/
class UserList
{
    function UserList(){
		
    }

    function getUserList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		$userRecords = new UserRecords;
		if ($userRecords->selectRecords($condition)){
			if(!$domDoc = $userRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteUser($userIDArray){
		$userRecords = new UserRecords;
		$rows = $userRecords->deleteRecords($userIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $userRecords = new UserRecords;
	    $rows = $userRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getUserCount(){
		$userRecords = new UserRecords;
		return $userRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status");
		$userRecords = new UserRecords;
		return $userRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchUser($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status");
		$userRecords = new UserRecords;
		if ($userRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $userRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
}
/*
$obj = new UserList;
//$idArray[] = 1;
echo $obj->getUserList();
//echo $obj->deleteUser($idArray);
//echo $obj->getUserCount();
//echo $obj->getUserSearchCount("a");
//echo $obj->searchUser("a",1);
//*/
?>
