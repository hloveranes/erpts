<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/LandActualUses.php";
include("assessor/LandActualUsesRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('LandActualUsesList');
$server->handle();
//*/
class LandActualUsesList
{
    function LandActualUsesList(){
		
    }

    function getLandActualUsesList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		$landActualUsesRecords = new LandActualUsesRecords;
		if ($landActualUsesRecords->selectRecords($condition)){
			if(!$domDoc = $landActualUsesRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteLandActualUses($landActualUsesIDArray){
		$landActualUsesRecords = new LandActualUsesRecords;
		$rows = $landActualUsesRecords->deleteRecords($landActualUsesIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $landActualUsesRecords = new LandActualUsesRecords;
	    $rows = $landActualUsesRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getLandActualUsesCount(){
		$landActualUsesRecords = new LandActualUsesRecords;
		return $landActualUsesRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status","value");
		$landActualUsesRecords = new LandActualUsesRecords;
		return $landActualUsesRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchLandActualUses($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status","value");
		$landActualUsesRecords = new LandActualUsesRecords;
		if ($landActualUsesRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $landActualUsesRecords->getDomDocument()){
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
$obj = new LandActualUsesList;
//$idArray[] = 126;
echo $obj->getLandActualUsesList();
//echo $obj->deleteLandActualUses($idArray);
//echo $obj->getLandActualUsesCount();
//echo $obj->getLandActualUsesSearchCount("a");
//echo $obj->searchLandActualUses("a",1);
//*/
?>
