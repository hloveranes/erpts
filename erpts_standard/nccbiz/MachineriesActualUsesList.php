<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/MachineriesActualUses.php";
include("assessor/MachineriesActualUsesRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('MachineriesActualUsesList');
$server->handle();
//*/
class MachineriesActualUsesList
{
    function MachineriesActualUsesList(){
		
    }

    function getMachineriesActualUsesList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		$machineriesActualUsesRecords = new MachineriesActualUsesRecords;
		if ($machineriesActualUsesRecords->selectRecords($condition)){
			if(!$domDoc = $machineriesActualUsesRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteMachineriesActualUses($machineriesActualUsesIDArray){
		$machineriesActualUsesRecords = new MachineriesActualUsesRecords;
		$rows = $machineriesActualUsesRecords->deleteRecords($machineriesActualUsesIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $machineriesActualUsesRecords = new MachineriesActualUsesRecords;
	    $rows = $machineriesActualUsesRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getMachineriesActualUsesCount(){
		$machineriesActualUsesRecords = new MachineriesActualUsesRecords;
		return $machineriesActualUsesRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status","value");
		$machineriesActualUsesRecords = new MachineriesActualUsesRecords;
		return $machineriesActualUsesRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchMachineriesActualUses($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status","value");
		$machineriesActualUsesRecords = new MachineriesActualUsesRecords;
		if ($machineriesActualUsesRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $machineriesActualUsesRecords->getDomDocument()){
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
$obj = new MachineriesActualUsesList;
//$idArray[] = 126;
echo $obj->getMachineriesActualUsesList();
//echo $obj->deleteMachineriesActualUses($idArray);
//echo $obj->getMachineriesActualUsesCount();
//echo $obj->getMachineriesActualUsesSearchCount("a");
//echo $obj->searchMachineriesActualUses("a",1);
//*/
?>
