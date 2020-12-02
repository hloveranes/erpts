<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/MachineriesDepreciation.php";
include("assessor/MachineriesDepreciationRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('MachineriesDepreciationList');
$server->handle();
//*/
class MachineriesDepreciationList
{
    function MachineriesDepreciationList(){
		
    }

    function getMachineriesDepreciationList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		$machineriesDepreciationRecords = new MachineriesDepreciationRecords;
		if ($machineriesDepreciationRecords->selectRecords($condition)){
			if(!$domDoc = $machineriesDepreciationRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteMachineriesDepreciation($machineriesDepreciationIDArray){
		$machineriesDepreciationRecords = new MachineriesDepreciationRecords;
		$rows = $machineriesDepreciationRecords->deleteRecords($machineriesDepreciationIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $machineriesDepreciationRecords = new MachineriesDepreciationRecords;
	    $rows = $machineriesDepreciationRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getMachineriesDepreciationCount(){
		$machineriesDepreciationRecords = new MachineriesDepreciationRecords;
		return $machineriesDepreciationRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status","value");
		$machineriesDepreciationRecords = new MachineriesDepreciationRecords;
		return $machineriesDepreciationRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchMachineriesDepreciation($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status","value");
		$machineriesDepreciationRecords = new MachineriesDepreciationRecords;
		if ($machineriesDepreciationRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $machineriesDepreciationRecords->getDomDocument()){
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
$obj = new MachineriesDepreciationList;
//$idArray[] = 126;
echo $obj->getMachineriesDepreciationList();
//echo $obj->deleteMachineriesDepreciation($idArray);
//echo $obj->getMachineriesDepreciationCount();
//echo $obj->getMachineriesDepreciationSearchCount("a");
//echo $obj->searchMachineriesDepreciation("a",1);
//*/
?>
