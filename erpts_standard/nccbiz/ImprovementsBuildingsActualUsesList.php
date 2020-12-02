<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/ImprovementsBuildingsActualUses.php";
include("assessor/ImprovementsBuildingsActualUsesRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ImprovementsBuildingsActualUsesList');
$server->handle();
//*/
class ImprovementsBuildingsActualUsesList
{
    function ImprovementsBuildingsActualUsesList(){
		
    }

    function getImprovementsBuildingsActualUsesList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		$improvementsBuildingsActualUsesRecords = new ImprovementsBuildingsActualUsesRecords;
		if ($improvementsBuildingsActualUsesRecords->selectRecords($condition)){
			if(!$domDoc = $improvementsBuildingsActualUsesRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteImprovementsBuildingsActualUses($improvementsBuildingsActualUsesIDArray){
		$improvementsBuildingsActualUsesRecords = new ImprovementsBuildingsActualUsesRecords;
		$rows = $improvementsBuildingsActualUsesRecords->deleteRecords($improvementsBuildingsActualUsesIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $improvementsBuildingsActualUsesRecords = new ImprovementsBuildingsActualUsesRecords;
	    $rows = $improvementsBuildingsActualUsesRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getImprovementsBuildingsActualUsesCount(){
		$improvementsBuildingsActualUsesRecords = new ImprovementsBuildingsActualUsesRecords;
		return $improvementsBuildingsActualUsesRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status","value");
		$improvementsBuildingsActualUsesRecords = new ImprovementsBuildingsActualUsesRecords;
		return $improvementsBuildingsActualUsesRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchImprovementsBuildingsActualUses($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status","value");
		$improvementsBuildingsActualUsesRecords = new ImprovementsBuildingsActualUsesRecords;
		if ($improvementsBuildingsActualUsesRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $improvementsBuildingsActualUsesRecords->getDomDocument()){
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
$obj = new ImprovementsBuildingsActualUsesList;
//$idArray[] = 126;
echo $obj->getImprovementsBuildingsActualUsesList();
//echo $obj->deleteImprovementsBuildingsActualUses($idArray);
//echo $obj->getImprovementsBuildingsActualUsesCount();
//echo $obj->getImprovementsBuildingsActualUsesSearchCount("a");
//echo $obj->searchImprovementsBuildingsActualUses("a",1);
//*/
?>
