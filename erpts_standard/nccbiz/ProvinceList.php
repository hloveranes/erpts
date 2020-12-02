<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Province.php";
include("assessor/ProvinceRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ProvinceList');
$server->handle();
//*/
class ProvinceList
{
    function ProvinceList(){
		
    }

    function getProvinceList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition = $condition." LIMIT $page,".PAGE_BY;
		}
		$provinceRecords = new ProvinceRecords;
		if ($provinceRecords->selectRecords($condition)){
			if(!$domDoc = $provinceRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteProvince($provinceIDArray){
		$provinceRecords = new ProvinceRecords;
		$rows = $provinceRecords->deleteRecords($provinceIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $provinceRecords = new ProvinceRecords;
	    $rows = $provinceRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getProvinceCount(){
		$provinceRecords = new ProvinceRecords;
		return $provinceRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status");
		$provinceRecords = new ProvinceRecords;
		return $provinceRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchProvince($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status");
		$provinceRecords = new ProvinceRecords;
		if ($provinceRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $provinceRecords->getDomDocument()){
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
$obj = new ProvinceList;
//$idArray[] = 126;
echo $obj->getProvinceList();
//echo $obj->deleteProvince($idArray);
//echo $obj->getProvinceCount();
//echo $obj->getProvinceSearchCount("a");
//echo $obj->searchProvince("a",1);
//*/
?>
