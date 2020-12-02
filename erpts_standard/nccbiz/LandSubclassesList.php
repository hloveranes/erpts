<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/LandSubclasses.php";
include("assessor/LandSubclassesRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('LandSubclassesList');
$server->handle();
//*/
class LandSubclassesList
{
    function LandSubclassesList(){
		
    }

    function getLandSubclassesList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		$landSubclassesRecords = new LandSubclassesRecords;
		if ($landSubclassesRecords->selectRecords($condition)){
			if(!$domDoc = $landSubclassesRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteLandSubclasses($landSubclassesIDArray){
		$landSubclassesRecords = new LandSubclassesRecords;
		$rows = $landSubclassesRecords->deleteRecords($landSubclassesIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $landSubclassesRecords = new LandSubclassesRecords;
	    $rows = $landSubclassesRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getLandSubclassesCount(){
		$landSubclassesRecords = new LandSubclassesRecords;
		return $landSubclassesRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status","value");
		$landSubclassesRecords = new LandSubclassesRecords;
		return $landSubclassesRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchLandSubclasses($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status","value");
		$landSubclassesRecords = new LandSubclassesRecords;
		if ($landSubclassesRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $landSubclassesRecords->getDomDocument()){
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
$obj = new LandSubclassesList;
//$idArray[] = 126;
echo $obj->getLandSubclassesList();
//echo $obj->deleteLandSubclasses($idArray);
//echo $obj->getLandSubclassesCount();
//echo $obj->getLandSubclassesSearchCount("a");
//echo $obj->searchLandSubclasses("a",1);
//*/
?>
