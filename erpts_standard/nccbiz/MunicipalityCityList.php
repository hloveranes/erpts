<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/MunicipalityCity.php";
include("assessor/MunicipalityCityRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('MunicipalityCityList');
$server->handle();
//*/
class MunicipalityCityList
{
    function MunicipalityCityList(){
		
    }

    function getMunicipalityCityList($page=0,$condition=""){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		$municipalityCityRecords = new MunicipalityCityRecords;
		if ($municipalityCityRecords->selectRecords($condition)){
			if(!$domDoc = $municipalityCityRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteMunicipalityCity($municipalityCityIDArray){
		$municipalityCityRecords = new MunicipalityCityRecords;
		$rows = $municipalityCityRecords->deleteRecords($municipalityCityIDArray);
		return $rows;
	}
	
	function updateStatus($statusIDArray){
	    $municipalityCityRecords = new MunicipalityCityRecords;
	    $rows = $municipalityCityRecords->updateStatus($statusIDArray);
	    return $rows;
	}
	
	function getMunicipalityCityCount(){
		$municipalityCityRecords = new MunicipalityCityRecords;
		return $municipalityCityRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("code","description","status");
		$municipalityCityRecords = new MunicipalityCityRecords;
		return $municipalityCityRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchMunicipalityCity($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("code","description","status");
		$municipalityCityRecords = new MunicipalityCityRecords;
		if ($municipalityCityRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $municipalityCityRecords->getDomDocument()){
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
$obj = new MunicipalityCityList;
//$idArray[] = 126;
echo $obj->getMunicipalityCityList();
//echo $obj->deleteMunicipalityCity($idArray);
//echo $obj->getMunicipalityCityCount();
//echo $obj->getMunicipalityCitySearchCount("a");
//echo $obj->searchMunicipalityCity("a",1);
//*/
?>
