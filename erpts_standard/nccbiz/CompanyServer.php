<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Address.php";
include("assessor/Company.php";
include("assessor/CompanyRecords.php";


$server = new SoapServer("urn:Object");
$server->setClass('CompanyServer');
$server->handle();

class CompanyServer
{
    function CompanyServer(){
		
    }
    
    function getCompany($page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition = "LIMIT $page,".PAGE_BY;
		}
		$companyRecords = new CompanyRecords;
		if ($companyRecords->selectCompanyRecords($condition)){
			if(!$domDoc = $companyRecords->getDomCompanyRecords()){
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
		$rows = $companyRecords->deleteCompanyRecords($companyIDArray);
		return $rows;
	}
	
	function getCompanyCount(){
		$companyRecords = new CompanyRecords;
		return $companyRecords->countCompanyRecords();
	}
	
	function getCompanySearchCount($searchKey){
		$fields = array("companyName");
		$companyRecords = new CompanyRecords;
		return $companyRecords->countCompanySearchRecords($searchKey,$fields);
	}
	
	function searchCompany($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("companyName");
		$companyRecords = new CompanyRecords;
		if ($companyRecords->searchCompanyRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $companyRecords->getDomCompanyRecords()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	 function saveCompany($xmlStr,$ownerID="") {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$company = new Company;
		$company->parseDomCompany($domDoc);
		$ret = $company->insertCompany();
		$owner = new Owner;
		$owner->insertOwnerCompany($ownerID,$ret);
		return $ret;
	}
	
	function getCompanyDetails($companyID) {
		$company = new Company;
		$company->selectCompany($companyID);
		if(!$domDoc = $company->getDomCompany()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateCompany($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$company = new Company;
		$company->parseDomCompany($domDoc);
		$ret = $company->updateCompany();
		return $ret;
	}
	
	function getCompanyDetails($companyID) {
		$company = new Company;
		$company->selectCompany($companyID);
		if(!$domDoc = $company->getDomCompany()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
?>