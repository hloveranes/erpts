<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/PlantsTreesClasses.php";
include("assessor/PlantsTreesClassesRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PlantsTreesClassesList');
$server->handle();
//*/
class PlantsTreesClassesList
{
    function PlantsTreesClassesList(){
		
    }

    function getPlantsTreesClassesList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		$plantsTreesClassesRecords = new PlantsTreesClassesRecords;
		if ($plantsTreesClassesRecords->selectRecords($condition)){
			if(!$domDoc = $plantsTreesClassesRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deletePlantsTreesClasses($plantsTreesClassesIDArray){
		$plantsTreesClassesRecords = new PlantsTreesClassesRecords;
		$rows = $plantsTreesClassesRecords->deleteRecords($plantsTreesClassesIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $plantsTreesClassesRecords = new PlantsTreesClassesRecords;
	    $rows = $plantsTreesClassesRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getPlantsTreesClassesCount(){
		$plantsTreesClassesRecords = new PlantsTreesClassesRecords;
		return $plantsTreesClassesRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status","value");
		$plantsTreesClassesRecords = new PlantsTreesClassesRecords;
		return $plantsTreesClassesRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchPlantsTreesClasses($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status","value");
		$plantsTreesClassesRecords = new PlantsTreesClassesRecords;
		if ($plantsTreesClassesRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $plantsTreesClassesRecords->getDomDocument()){
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
$obj = new PlantsTreesClassesList;
//$idArray[] = 126;
echo $obj->getPlantsTreesClassesList();
//echo $obj->deletePlantsTreesClasses($idArray);
//echo $obj->getPlantsTreesClassesCount();
//echo $obj->getPlantsTreesClassesSearchCount("a");
//echo $obj->searchPlantsTreesClasses("a",1);
//*/
?>
