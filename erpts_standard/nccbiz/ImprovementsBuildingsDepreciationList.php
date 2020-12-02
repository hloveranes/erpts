<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/ImprovementsBuildingsDepreciation.php";
include("assessor/ImprovementsBuildingsDepreciationRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ImprovementsBuildingsDepreciationList');
$server->handle();
//*/
class ImprovementsBuildingsDepreciationList
{
    function ImprovementsBuildingsDepreciationList(){
		
    }

    function getImprovementsBuildingsDepreciationList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		$improvementsBuildingsDepreciationRecords = new ImprovementsBuildingsDepreciationRecords;
		if ($improvementsBuildingsDepreciationRecords->selectRecords($condition)){
			if(!$domDoc = $improvementsBuildingsDepreciationRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteImprovementsBuildingsDepreciation($improvementsBuildingsDepreciationIDArray){
		$improvementsBuildingsDepreciationRecords = new ImprovementsBuildingsDepreciationRecords;
		$rows = $improvementsBuildingsDepreciationRecords->deleteRecords($improvementsBuildingsDepreciationIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $improvementsBuildingsDepreciationRecords = new ImprovementsBuildingsDepreciationRecords;
	    $rows = $improvementsBuildingsDepreciationRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getImprovementsBuildingsDepreciationCount(){
		$improvementsBuildingsDepreciationRecords = new ImprovementsBuildingsDepreciationRecords;
		return $improvementsBuildingsDepreciationRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status","value");
		$improvementsBuildingsDepreciationRecords = new ImprovementsBuildingsDepreciationRecords;
		return $improvementsBuildingsDepreciationRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchImprovementsBuildingsDepreciation($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status","value");
		$improvementsBuildingsDepreciationRecords = new ImprovementsBuildingsDepreciationRecords;
		if ($improvementsBuildingsDepreciationRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $improvementsBuildingsDepreciationRecords->getDomDocument()){
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
$obj = new ImprovementsBuildingsDepreciationList;
//$idArray[] = 126;
echo $obj->getImprovementsBuildingsDepreciationList();
//echo $obj->deleteImprovementsBuildingsDepreciation($idArray);
//echo $obj->getImprovementsBuildingsDepreciationCount();
//echo $obj->getImprovementsBuildingsDepreciationSearchCount("a");
//echo $obj->searchImprovementsBuildingsDepreciation("a",1);
//*/
?>
