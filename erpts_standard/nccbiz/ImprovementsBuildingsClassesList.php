<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/ImprovementsBuildingsClasses.php";
include("assessor/ImprovementsBuildingsClassesRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ImprovementsBuildingsClassesList');
$server->handle();
//*/
class ImprovementsBuildingsClassesList
{
    function ImprovementsBuildingsClassesList(){
		
    }

    function getImprovementsBuildingsClassesList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition = "LIMIT $page,".PAGE_BY;
		}
		$improvementsBuildingsClassesRecords = new ImprovementsBuildingsClassesRecords;
		if ($improvementsBuildingsClassesRecords->selectRecords($condition)){
			if(!$domDoc = $improvementsBuildingsClassesRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteImprovementsBuildingsClasses($improvementsBuildingsClassesIDArray){
		$improvementsBuildingsClassesRecords = new ImprovementsBuildingsClassesRecords;
		$rows = $improvementsBuildingsClassesRecords->deleteRecords($improvementsBuildingsClassesIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $improvementsBuildingsClassesRecords = new ImprovementsBuildingsClassesRecords;
	    $rows = $improvementsBuildingsClassesRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getImprovementsBuildingsClassesCount(){
		$improvementsBuildingsClassesRecords = new ImprovementsBuildingsClassesRecords;
		return $improvementsBuildingsClassesRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status","value");
		$improvementsBuildingsClassesRecords = new ImprovementsBuildingsClassesRecords;
		return $improvementsBuildingsClassesRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchImprovementsBuildingsClasses($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status","value");
		$improvementsBuildingsClassesRecords = new ImprovementsBuildingsClassesRecords;
		if ($improvementsBuildingsClassesRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $improvementsBuildingsClassesRecords->getDomDocument()){
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
$obj = new ImprovementsBuildingsClassesList;
//$idArray[] = 126;
echo $obj->getImprovementsBuildingsClassesList();
//echo $obj->deleteImprovementsBuildingsClasses($idArray);
//echo $obj->getImprovementsBuildingsClassesCount();
//echo $obj->getImprovementsBuildingsClassesSearchCount("a");
//echo $obj->searchImprovementsBuildingsClasses("a",1);
//*/
?>
