<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/PropAssessKinds.php";
include("assessor/PropAssessKindsRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PropAssessKindsList');
$server->handle();
//*/
class PropAssessKindsList
{
    function PropAssessKindsList(){
		
    }

    function getPropAssessKindsList($page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition = "LIMIT $page,".PAGE_BY;
		}
		$propAssessKindsRecords = new PropAssessKindsRecords;
		if ($propAssessKindsRecords->selectRecords($condition)){
			if(!$domDoc = $propAssessKindsRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deletePropAssessKinds($propAssessKindsIDArray){
		$propAssessKindsRecords = new PropAssessKindsRecords;
		$rows = $propAssessKindsRecords->deleteRecords($propAssessKindsIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $propAssessKindsRecords = new PropAssessKindsRecords;
	    $rows = $propAssessKindsRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getPropAssessKindsCount(){
		$propAssessKindsRecords = new PropAssessKindsRecords;
		return $propAssessKindsRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status","value");
		$propAssessKindsRecords = new PropAssessKindsRecords;
		return $propAssessKindsRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchPropAssessKinds($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status","value");
		$propAssessKindsRecords = new PropAssessKindsRecords;
		if ($propAssessKindsRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $propAssessKindsRecords->getDomDocument()){
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
$obj = new PropAssessKindsList;
//$idArray[] = 126;
echo $obj->getPropAssessKindsList();
//echo $obj->deletePropAssessKinds($idArray);
//echo $obj->getPropAssessKindsCount();
//echo $obj->getPropAssessKindsSearchCount("a");
//echo $obj->searchPropAssessKinds("a",1);
//*/
?>
