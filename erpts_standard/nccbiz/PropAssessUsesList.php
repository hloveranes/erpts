<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/PropAssessUses.php";
include("assessor/PropAssessUsesRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PropAssessUsesList');
$server->handle();
//*/
class PropAssessUsesList
{
    function PropAssessUsesList(){
		
    }

    function getPropAssessUsesList($page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition = "LIMIT $page,".PAGE_BY;
		}
		$propAssessUsesRecords = new PropAssessUsesRecords;
		if ($propAssessUsesRecords->selectRecords($condition)){
			if(!$domDoc = $propAssessUsesRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deletePropAssessUses($propAssessUsesIDArray){
		$propAssessUsesRecords = new PropAssessUsesRecords;
		$rows = $propAssessUsesRecords->deleteRecords($propAssessUsesIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $propAssessUsesRecords = new PropAssessUsesRecords;
	    $rows = $propAssessUsesRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getPropAssessUsesCount(){
		$propAssessUsesRecords = new PropAssessUsesRecords;
		return $propAssessUsesRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status","value");
		$propAssessUsesRecords = new PropAssessUsesRecords;
		return $propAssessUsesRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchPropAssessUses($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status","value");
		$propAssessUsesRecords = new PropAssessUsesRecords;
		if ($propAssessUsesRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $propAssessUsesRecords->getDomDocument()){
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
$obj = new PropAssessUsesList;
//$idArray[] = 126;
echo $obj->getPropAssessUsesList();
//echo $obj->deletePropAssessUses($idArray);
//echo $obj->getPropAssessUsesCount();
//echo $obj->getPropAssessUsesSearchCount("a");
//echo $obj->searchPropAssessUses("a",1);
//*/
?>
