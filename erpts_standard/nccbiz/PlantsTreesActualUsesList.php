<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/PlantsTreesActualUses.php";
include("assessor/PlantsTreesActualUsesRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PlantsTreesActualUsesList');
$server->handle();
//*/
class PlantsTreesActualUsesList
{
    function PlantsTreesActualUsesList(){
		
    }

    function getPlantsTreesActualUsesList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		$plantsTreesActualUsesRecords = new PlantsTreesActualUsesRecords;
		if ($plantsTreesActualUsesRecords->selectRecords($condition)){
			if(!$domDoc = $plantsTreesActualUsesRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deletePlantsTreesActualUses($plantsTreesActualUsesIDArray){
		$plantsTreesActualUsesRecords = new PlantsTreesActualUsesRecords;
		$rows = $plantsTreesActualUsesRecords->deleteRecords($plantsTreesActualUsesIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $plantsTreesActualUsesRecords = new PlantsTreesActualUsesRecords;
	    $rows = $plantsTreesActualUsesRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getPlantsTreesActualUsesCount(){
		$plantsTreesActualUsesRecords = new PlantsTreesActualUsesRecords;
		return $plantsTreesActualUsesRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status","value");
		$plantsTreesActualUsesRecords = new PlantsTreesActualUsesRecords;
		return $plantsTreesActualUsesRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchPlantsTreesActualUses($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","reportCode","description","status","value");
		$plantsTreesActualUsesRecords = new PlantsTreesActualUsesRecords;
		if ($plantsTreesActualUsesRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $plantsTreesActualUsesRecords->getDomDocument()){
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
$obj = new PlantsTreesActualUsesList;
//$idArray[] = 126;
echo $obj->getPlantsTreesActualUsesList();
//echo $obj->deletePlantsTreesActualUses($idArray);
//echo $obj->getPlantsTreesActualUsesCount();
//echo $obj->getPlantsTreesActualUsesSearchCount("a");
//echo $obj->searchPlantsTreesActualUses("a",1);
//*/
?>
