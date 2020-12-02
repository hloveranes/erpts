<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Address.php";
include("assessor/Company.php";
include("assessor/CompanyRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('CompanyList');
$server->handle();
//*/
class CompanyList
{
    function CompanyList(){
		
    }
    
    function getCompanyList($page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition = "LIMIT $page,".PAGE_BY;
		}
		$companyRecords = new CompanyRecords;
		if ($companyRecords->selectRecords($condition)){
			if(!$domDoc = $companyRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteCompany($companyIDArray){
		$companyRecords = new CompanyRecords;
		$rows = $companyRecords->deleteRecords($companyIDArray);
		return $rows;
	}
	
	function getCompanyCount(){
		$companyRecords = new CompanyRecords;
		return $companyRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("companyName");
		$companyRecords = new CompanyRecords;
		return $companyRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchCompany($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("companyName");
		$companyRecords = new CompanyRecords;
		if ($companyRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $companyRecords->getDomDocument()){
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
$obj = new CompanyList;
$idArray[] = 47;
//echo $obj->getCompanyList();
echo $obj->deleteCompany($idArray);
//echo $obj->getCompanyCount();
//echo $obj->getCompanySearchCount("a");
//echo $obj->searchCompany("pr");
//*/
?>