<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Address.php";
include("assessor/Person.php";
include("assessor/PersonRecords.php";

#####################################
# Define Interface Class
#####################################
class PersonList{
	
	var $tpl;
	var $formArray;
	function PersonList($http_post_vars,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "PersonList.htm") ;
		$this->tpl->set_var("TITLE", "Person List");
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
				break;
			case "cancel":
				header("location: PersonList.php";
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
		}
		$PersonList = new SoapObject(NCCBIZ."PersonList.php", "urn:Object");
		if (!$xmlStr = $PersonList->getPersonList()){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "database empty");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
	 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$personRecords = new PersonRecords;
				$personRecords->parseDomDocument($domDoc);
				$list = $personRecords->getArrayList();
				$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
				foreach ($list as $key => $value){
					$this->tpl->set_var("personID", $value->getPersonID());
					if (!$pname = $value->getFullName()){
						$pname = "none";
					}
					$this->tpl->set_var("fullName", $pname);
					$this->tpl->set_var("tin", $value->getTin());
					$this->tpl->set_var("telephone", $value->getTelephone());
					$this->tpl->set_var("mobileNumber", $value->getMobileNumber());
					$this->tpl->parse("PersonListBlock", "PersonList", true);
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
$personList = new PersonList($HTTP_POST_VARS,$sess);
$personList->main();
?>
<?php page_close(); ?>
