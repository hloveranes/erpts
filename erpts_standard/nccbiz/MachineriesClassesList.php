<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/MachineriesClasses.php";
include("assessor/MachineriesClassesRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('MachineriesClassesList');
$server->handle();
//*/
class MachineriesClassesList
{
    function MachineriesClassesList(){
		
    }

    function getMachineriesClassesList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		$machineriesClassesRecords = new MachineriesClassesRecords;
		if ($machineriesClassesRecords->selectRecords($condition)){
			if(!$domDoc = $machineriesClassesRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteMachineriesClasses($machineriesClassesIDArray){
		$machineriesClassesRecords = new MachineriesClassesRecords;
		$rows = $machineriesClassesRecords->deleteRecords($machineriesClassesIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $machineriesClassesRecords = new MachineriesClassesRecords;
	    $rows = $machineriesClassesRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getMachineriesClassesCount(){
		$machineriesClassesRecords = new MachineriesClassesRecords;
		return $machineriesClassesRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status","value");
		$machineriesClassesRecords = new MachineriesClassesRecords;
		return $machineriesClassesRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchMachineriesClasses($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status","value");
		$machineriesClassesRecords = new MachineriesClassesRecords;
		if ($machineriesClassesRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $machineriesClassesRecords->getDomDocument()){
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
$obj = new MachineriesClassesList;
//$idArray[] = 126;
echo $obj->getMachineriesClassesList();
//echo $obj->deleteMachineriesClasses($idArray);
//echo $obj->getMachineriesClassesCount();
//echo $obj->getMachineriesClassesSearchCount("a");
//echo $obj->searchMachineriesClasses("a",1);
//*/
?>
