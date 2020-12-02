<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/Address.php";

#####################################
# Define Interface Class
#####################################
class OwnerDetails{
	
	var $tpl;
	function OwnerDetails($sess,$ownerType,$id){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "OwnerDetails.htm") ;
		$this->tpl->set_var("TITLE", "NCCSMS - Owner Details");

		$this->formArray["ownerType"] = $ownerType;
		$this->formArray["id"] = $id;
	}

	function hideBlock($tempVar){
		$this->tpl->set_block("rptsTemplate", $tempVar, $tempVar."Block");
		$this->tpl->set_var($tempVar."Block", "");
	}

	function setPageDetailPerms(){
		if(!checkPerms($this->user["userType"],"%1%%%%%%%%")){
			// hide Blocks if userType is not at least AM-Edit
			$this->tpl->set_var("ownerViewAccess","viewOnly");
		}
		else{
			$this->tpl->set_var("ownerViewAccess","view");
		}

	}

	function Main(){
		switch($this->formArray["ownerType"]){
			case "Person":
				$this->tpl->set_block("rptsTemplate", "CompanyDetails", "CompanyDetailsBlock");
				$this->tpl->set_var("CompanyDetailsBlock", "");
				$person = new Person;
				$person->selectRecord($this->formArray["id"]);

				$this->tpl->set_var("id", $person->getPersonID());
				$this->tpl->set_var("lastName", $person->getLastName());
				$this->tpl->set_var("firstName", $person->getFirstName());
				$this->tpl->set_var("middleName", $person->getMiddleName());
				$this->tpl->set_var("gender", $person->getGender());
				$this->tpl->set_var("birthday", $person->getBirthday());
				$this->tpl->set_var("maritalStatus", $person->getMaritalStatus());
				$this->tpl->set_var("tin", $person->getTin());
				$address = $person->addressArray[0];
				if (is_a($address,Address)){
					$this->tpl->set_var("fullAddress", $address->getFullAddress());
				}
				$this->tpl->set_var("telephone", $person->getTelephone());
				$this->tpl->set_var("mobileNumber", $person->getMobileNumber());
				$this->tpl->set_var("email", $person->getEmail());
				break;
			case "Company":
				$this->tpl->set_block("rptsTemplate", "PersonDetails", "PersonDetailsBlock");
				$this->tpl->set_var("PersonDetailsBlock", "");
				$company = new Company;
				$company->selectRecord($this->formArray["id"]);

				$this->tpl->set_var("id", $company->getCompanyID());
				$this->tpl->set_var("companyName", $company->getCompanyName());
				$this->tpl->set_var("tin", $company->getTin());
				$this->tpl->set_var("telephone", $company->getTelephone());
				$this->tpl->set_var("fax", $company->getFax());
				$address = $company->addressArray[0];
				if (is_a($address,Address)){
					$this->tpl->set_var("fullAddress", $address->getFullAddress());
				}
				$this->tpl->set_var("email", $company->getEmail());
				$this->tpl->set_var("website", $company->getWebsite());
				break;
			default:
				exit("No Person/Company selected. <a href='OwnerList.php".$this->sess->url("")."'>Click here</a> to go back to the Owner List.");
				break;
		}
		$this->tpl->set_var("ownerType", $this->formArray["ownerType"]);

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->setPageDetailPerms();
		
		$this->tpl->set_var("Session", $this->sess->url(""));
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
$obj = new OwnerDetails($sess,$ownerType,$id);
$obj->main();
?>
<?php page_close(); ?>
