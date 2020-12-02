<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Address.php";
include("assessor/Company.php";
include("assessor/CompanyRecords.php";
include("assessor/Owner.php";
include("assessor/OwnerRecords.php";

#####################################
# Define Interface Class
#####################################
class OwnerList{
	
	var $tpl;
	var $formArray;
	function OwnerList($http_post_vars,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "OwnerList.htm") ;
		$this->tpl->set_var("TITLE", "Owner List");
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
			case "deletePerson":
				//print_r($this->formArray);
				if (count($this->formArray["personID"]) > 0) {
					$PersonList = new SoapObject(NCCBIZ."PersonList.php", "urn:Object");
					if (!$deletedRows = $PersonList->deleteOwner($this->formArray["personID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				break;
			case "deleteCompany":
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
				header("location: OwnerList.php";
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
		}
		$OwnerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");
		if (!$xmlStr = $OwnerList->getOwnerList()){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "database empty");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
	 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$personRecords = new OwnerRecords;
				$personRecords->parseDomOwnerRecords($domDoc);
				$list = $personRecords->getOwnerList();
				$this->tpl->set_block("rptsTemplate", "OwnerList", "OwnerListBlock");
				foreach ($list as $key => $value){
					$this->tpl->set_var("personID", $value->getOwnerID());
					if (!$pname = $value->getFullName()){
						$pname = "none";
					}
					$this->tpl->set_var("fullName", $pname);
					$this->tpl->set_var("tin", $value->getTin());
					$this->tpl->set_var("telephone", $value->getTelephone());
					$this->tpl->set_var("mobileNumber", $value->getMobileNumber());
					$this->tpl->parse("OwnerListBlock", "OwnerList", true);
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
$personList = new OwnerList($HTTP_POST_VARS,$sess);
$personList->main();
?>
<?php page_close(); ?>