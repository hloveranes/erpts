<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Address.php";
include("assessor/Company.php";
include("assessor/CompanyRecords.php";

#####################################
# Define Interface Class
#####################################
class CompanyList{
	
	var $tpl;
	var $formArray;
	var $sess;
	function CompanyList($http_post_vars,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$test = "nelson";
		$this->sess->register($test);
		$this->tpl->set_file("rptsTemplate", "CompanyList.htm") ;
		$this->tpl->set_var("TITLE", "Company List");
		$this->tpl->set_var("Session", $this->sess->url(""));
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "delete":
				//print_r($this->formArray);
				if (count($this->formArray["companyID"]) > 0) {
					$CompanyList = new SoapObject(NCCBIZ."CompanyList.php", "urn:Object");
					if (!$deletedRows = $CompanyList->deleteCompany($this->formArray["companyID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				break;
			case "cancel":
				header("location: CompanyList.php";
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
		}
		$CompanyList = new SoapObject(NCCBIZ."CompanyList.php", "urn:Object");
		if (!$xmlStr = $CompanyList->getCompanyList()){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "database empty");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
	 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$companyRecords = new CompanyRecords;
				$companyRecords->parseDomCompanyRecords($domDoc);
				$list = $companyRecords->getCompanyList();
				$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
				foreach ($list as $key => $value){
					$this->tpl->set_var("companyID", $value->getCompanyID());
					if (!$cname = $value->getCompanyName()){
						$cname = "none";
					}
					$this->tpl->set_var("companyName", $cname);
					$this->tpl->set_var("tin", $value->getTin());
					$this->tpl->set_var("telephone", $value->getTelephone());
					$this->tpl->set_var("fax", $value->getFax());
					$this->tpl->parse("CompanyListBlock", "CompanyList", true);
				}
			}
		}
		$this->tpl->parse("templatePage", "rptsTemplate");
		$this->tpl->finish("templatePage");
		$this->tpl->p("templatePage");
	}
}

#####################################
# Define Procedures and Functions
#####################################

##########################################################
# Begin Program Script
##########################################################
//*
page_open(array("sess" => "rpts_Session"
	,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/
//print_r($sess);
$test = "labas";
$sess->register(test);
$companyList = new CompanyList($HTTP_POST_VARS,$sess);
$companyList->main();
?>
<?php page_close(); ?>