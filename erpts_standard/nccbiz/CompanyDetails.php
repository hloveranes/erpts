<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Address.php";
include("assessor/Company.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('CompanyDetails');
$server->handle();
//*/
class CompanyDetails
{
    function CompanyDetails(){
		
    }
    
    function getCompanyDetails($companyID) {
		$company = new Company;
		$company->selectRecord($companyID);
		if(!$domDoc = $company->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
/*
$obj = new CompanyDetails;
echo $obj->getCompanyDetails($id);
//*/
?>