<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/LandClasses.php";
include("assessor/LandClassesRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('LandClassesList');
$server->handle();
//*/
class LandClassesList
{
    function LandClassesList(){
		
    }

    function getLandClassesList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		$landClassesRecords = new LandClassesRecords;
		if ($landClassesRecords->selectRecords($condition)){
			if(!$domDoc = $landClassesRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteLandClasses($landClassesIDArray){
		$landClassesRecords = new LandClassesRecords;
		$rows = $landClassesRecords->deleteRecords($landClassesIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $landClassesRecords = new LandClassesRecords;
	    $rows = $landClassesRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getLandClassesCount(){
		$landClassesRecords = new LandClassesRecords;
		return $landClassesRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status","value");
		$landClassesRecords = new LandClassesRecords;
		return $landClassesRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchLandClasses($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status","value");
		$landClassesRecords = new LandClassesRecords;
		if ($landClassesRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $landClassesRecords->getDomDocument()){
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
$obj = new LandClassesList;
//$idArray[] = 126;
echo $obj->getLandClassesList();
//echo $obj->deleteLandClasses($idArray);
//echo $obj->getLandClassesCount();
//echo $obj->getLandClassesSearchCount("a");
//echo $obj->searchLandClasses("a",1);
//*/
?>
