<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Address.php";
include("assessor/Person.php";
#####################################
# Define Interface Class
#####################################
class PersonDetails{
	
	var $tpl;
	var $formArray;
	var $person;
	
	function PersonDetails($personID,$formAction,$sess,$odID){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PersonDetails.htm") ;
		$this->tpl->set_var("TITLE", "Person Details");
			
		$this->formArray = array(
			"personID" => $personID
			, "odID" => $odID
			, "personName" => ""
			, "lastName" => ""
			, "firstName" => ""
			, "middleName" => ""
			, "gender" => ""
			, "birthday" => ""
			, "maritalStatus" => ""
			, "tin" => ""
			, "addressID" =>""
			, "number" => ""
			, "street" => ""
			, "barangay" => ""
			, "district" => ""
			, "municipalityCity" => ""
			, "province" => ""
			, "telephone" => ""
			, "mobileNumber" => ""
			, "email" => ""
			,"formAction" => $formAction
		);
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main($referer=""){
		//if (trim($referer) == "" || !isset($referer))
		$referer = "OwnerList.php";
		$this->tpl->set_var("referer", $referer);		
		switch ($this->formArray["formAction"]){
			case "save" || "view" || "viewOnly":
				$this->tpl->set_var("referer", $referer);
				$PersonDetails = new SoapObject(NCCBIZ."PersonDetails.php", "urn:Object");
				if (!$xmlStr = $PersonDetails->getPersonDetails($this->formArray["personID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$person = new Person;
						$person->parseDomDocument($domDoc);
						$this->formArray["personID"] = $person->getPersonID();
						$this->formArray["personName"] = $person->getFullName();
						$this->formArray["lastName"] = $person->getLastName();
						$this->formArray["firstName"] = $person->getFirstName();
						$this->formArray["middleName"] = $person->getMiddleName();
						$this->formArray["gender"] = $person->getGender();
						$this->formArray["birthday"] = $person->getBirthday();
						$this->formArray["maritalStatus"] = $person->getMaritalStatus();
						$this->formArray["tin"] = $person->getTin();
						$address = $person->addressArray[0];
						if (is_a($address,Address)){
							$this->formArray["number"] = $address->getNumber();
							$this->formArray["street"] = $address->getStreet();
							$this->formArray["barangay"] = $address->getBarangay();
							$this->formArray["district"] = $address->getDistrict();
							$this->formArray["municipalityCity"] = $address->getMunicipalitycity();
							$this->formArray["province"] = $address->getProvince();
						}
						$this->formArray["telephone"] = $person->getTelephone();
						$this->formArray["mobileNumber"] = $person->getMobileNumber();
						$this->formArray["email"] = $person->getEmail();
					}
				}
				if($this->formArray["formAction"]=="viewOnly"){
					$this->tpl->set_block("rptsTemplate", "ViewOnly", "ViewOnlyBlock");
					$this->tpl->set_var("ViewOnlyBlock", "");
				}				
				break;
			case "cancel":
				//header("location: PersonList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "ACK", "ACKBlock");
				$this->tpl->set_var("ACKBlock", "");
		}
		//*/
		$this->tpl->set_var("Session", $this->sess->url(""));
		$this->setForm();
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
$personDetails = new PersonDetails($personID,$formAction,$sess,$odID);
$personDetails->main($HTTP_REFERER);
?>
<?php page_close(); ?>
