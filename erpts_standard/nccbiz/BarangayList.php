<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Barangay.php";
include("assessor/BarangayRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('BarangayList');
$server->handle();
//*/
class BarangayList
{
    function BarangayList(){
		
    }

    function getBarangayList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition = $condition." LIMIT $page,".PAGE_BY;
		}
		$barangayRecords = new BarangayRecords;
		if ($barangayRecords->selectRecords($condition)){
			if(!$domDoc = $barangayRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteBarangay($barangayIDArray){
		$barangayRecords = new BarangayRecords;
		$rows = $barangayRecords->deleteRecords($barangayIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $barangayRecords = new BarangayRecords;
	    $rows = $barangayRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getBarangayCount($condition=""){
		$barangayRecords = new BarangayRecords;
		return $barangayRecords->countRecords($condition);
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status");
		$barangayRecords = new BarangayRecords;
		return $barangayRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchBarangay($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status");
		$barangayRecords = new BarangayRecords;
		if ($barangayRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $barangayRecords->getDomDocument()){
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
$obj = new BarangayList;
//$idArray[] = 126;
echo $obj->getBarangayList();
//echo $obj->deleteBarangay($idArray);
//echo $obj->getBarangayCount();
//echo $obj->getBarangaySearchCount("a");
//echo $obj->searchBarangay("a",1);
//*/
?>
