<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Address.php";
include("assessor/Person.php";
include("assessor/PersonRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PersonList');
$server->handle();
//*/
class PersonList
{
    function PersonList(){
		
    }
    
    function getPersonList($page=0,$orderby="",$orderbyType="ASC"){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition = "LIMIT $page,".PAGE_BY;
		}
		if($orderby!=""){
		    $condition = "ORDER BY " . $orderby . " " . $orderbyType . " " . $condition;
		}
		$personRecords = new PersonRecords;
		if ($personRecords->selectRecords($condition)){
			if(!$domDoc = $personRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deletePerson($personIDArray){
		$personRecords = new PersonRecords;
		$rows = $personRecords->deleteRecords($personIDArray);
		return $rows;
	}
	
	function getPersonCount(){
		$personRecords = new PersonRecords;
		return $personRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("firstName","middleName","lastName");
		$personRecords = new PersonRecords;
		return $personRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchPerson($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("firstName","middleName","lastName");
		$personRecords = new PersonRecords;
		if ($personRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $personRecords->getDomDocument()){
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
$obj = new PersonList;
//$idArray[] = 126;
//echo $obj->getPersonList();
//echo $obj->deletePerson($idArray);
//echo $obj->getPersonCount();
//echo $obj->getPersonSearchCount("a");
echo $obj->searchPerson("a",1);
//*/
?>
