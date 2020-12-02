<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/District.php";
include("assessor/DistrictRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('DistrictList');
$server->handle();
//*/
class DistrictList
{
    function DistrictList(){
		
    }

    function getDistrictList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition = $condition." LIMIT $page,".PAGE_BY;
		}
		$districtRecords = new DistrictRecords;
		if ($districtRecords->selectRecords($condition)){
			if(!$domDoc = $districtRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteDistrict($districtIDArray){
		$districtRecords = new DistrictRecords;
		$rows = $districtRecords->deleteRecords($districtIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $districtRecords = new DistrictRecords;
	    $rows = $districtRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getDistrictCount(){
		$districtRecords = new DistrictRecords;
		return $districtRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status");
		$districtRecords = new DistrictRecords;
		return $districtRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchDistrict($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status");
		$districtRecords = new DistrictRecords;
		if ($districtRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $districtRecords->getDomDocument()){
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
$obj = new DistrictList;
//$idArray[] = 126;
echo $obj->getDistrictList();
//echo $obj->deleteDistrict($idArray);
//echo $obj->getDistrictCount();
//echo $obj->getDistrictSearchCount("a");
//echo $obj->searchDistrict("a",1);
//*/
?>
