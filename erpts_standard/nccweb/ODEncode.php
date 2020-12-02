<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Address.php";
include("assessor/Company.php";
include("assessor/CompanyRecords.php";
include("assessor/Person.php";
include("assessor/PersonRecords.php";
include("assessor/Owner.php";
include("assessor/OwnerRecords.php";

#####################################
# Define Interface Class
#####################################
class ODDetails{
	
	var $tpl;
	var $formArray;
	function ODDetails($http_post_vars,$sess,$odID){
		global $auth;

		$this->sess = $sess;
		$this->userID = $auth->auth["uid"];

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ODEncode.htm") ;
		$this->tpl->set_var("TITLE", "Owner List");
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("odID"=>$odID)));
		
		$this->formArray["odID"] = $odID;
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
				if (count($this->formArray["personID"]) > 0) {
					$PersonList = new SoapObject(NCCBIZ."PersonList.php", "urn:Object");
					if (!$deletedRows = $PersonList->deletePerson($this->formArray["personID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
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
				header("location: ODEncode.php".$this->sess->url("").$this->sess->add_query(array("ownerID"=>$this->formArray["ownerID"])));
				exit;
				break;				
			case "remove";
				//*
				if (count($this->formArray["personID"])) {
					$OwnerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");
					if (!$deletedRows = $OwnerList->removeOwnerPerson($this->formArray["ownerID"],$this->formArray["personID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");

				if (count($this->formArray["companyID"]) > 0) {
					$OwnerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");
					if (!$deletedRows = $OwnerList->removeOwnerCompany($this->formArray["ownerID"],$this->formArray["companyID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				header("location: ODEncode.php".$this->sess->url("").$this->sess->add_query(array("ownerID"=>$this->formArray["ownerID"])));
				exit;
				break;
			case "cancel":
				header("location: OwnerList.php";
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
		}
		$ODEncode = new SoapObject(NCCBIZ."ODEncode.php", "urn:Object");
		$this->formArray["ownerID"] = $ODEncode->getOwnerID($this->formArray["odID"]);
		echo $this->formArray["odID"]."ownerID=".$this->formArray["ownerID"];
		$OwnerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");
		if (!$xmlStr = $OwnerList->getOwnerList($this->formArray["ownerID"])){
			//exit(print_r($OwnerList));
			$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
			$this->tpl->set_var("OwnerListTableBlock", "invalid ownerID");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
					$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
				$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
			}
			else {
				$ownerRecords = new OwnerRecords;
				$ownerRecords->parseDomOwnerRecords($domDoc);
				$list = $ownerRecords->getOwnerList();
				foreach ($list as $key => $value){
					if (count($value->personArray)){
						$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
						foreach($value->personArray as $personKey =>$personValue){
							$this->tpl->set_var("personID", $personValue->getPersonID());
							if (!$pname = $personValue->getFullName()){
								$pname = "none";
						}
							$this->tpl->set_var("fullName", $pname);
							$this->tpl->set_var("tin", $personValue->getTin());
							$this->tpl->set_var("telephone", $personValue->getTelephone());
							$this->tpl->set_var("mobileNumber", $personValue->getMobileNumber());
							$this->tpl->parse("PersonListBlock", "PersonList", true);
						}
					}
					else{
						$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
						$this->tpl->set_var("PersonListBlock", "");
					}
					if (count($value->companyArray)){
						$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
						//print_r($value->companyArray);
						foreach ($value->companyArray as $companyKey => $companyValue){
							$this->tpl->set_var("companyID", $companyValue->getCompanyID());
							if (!$cname = $companyValue->getCompanyName()){
								$cname = "none";
							}
							$this->tpl->set_var("companyName", $cname);
							$this->tpl->set_var("tin", $companyValue->getTin());
							$this->tpl->set_var("telephone", $companyValue->getTelephone());
							$this->tpl->set_var("fax", $companyValue->getFax());
							$this->tpl->parse("CompanyListBlock", "CompanyList", true);
						}
					}
					else{
						$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
						$this->tpl->set_var("CompanyListBlock", "");	
					}
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
$ownerList = new ODDetails($HTTP_POST_VARS,$sess,$odID);
$ownerList->Main();
?>
<?php page_close(); ?>