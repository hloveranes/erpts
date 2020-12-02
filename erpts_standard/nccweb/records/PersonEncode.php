<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/LocationAddress.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
#####################################
# Define Interface Class
#####################################
class PersonEncode{
	
	var $tpl;
	var $formArray;
	var $person;
	var $birthdate;
	var $monthArray;
	var $sess;
	
	function PersonEncode($http_post_vars,$personID="",$formAction="",$sess,$ownerID="",$odID,$locID){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "PersonEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Person");
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("ownerID"=>$ownerID)));
		
		$this->formArray = array(
			"personID" => $personID
			, "lastName" => ""
			, "firstName" => ""
			, "middleName" => ""
			, "gender" => ""
			, "birth_month" => ""
			, "birth_day" => ""
			, "birth_year" => ""
			, "maritalStatus" => ""
			, "tin" => ""
			, "addressID" => ""
			, "number" => ""
			, "street" => ""
			, "barangay" => ""
			, "district" => ""
			,"municipalityCity" => ""
			, "province" => ""
			, "telephone" => ""
			, "mobileNumber" => ""
			, "email" => ""
			,"formAction" => $formAction
			, "ownerID" => $ownerID
			, "odID" => $odID
			, "locID" => $locID
		);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}

		$dateStr = $this->getDateStr("birth_year","birth_month","birth_day");
		$this->birthdate = $dateStr;
	}

	function getDateStr($year,$month,$day){
		$year = $this->formArray[$year];
		$month = $this->formArray[$month];
		$day = $this->formArray[$day];
		if($year!="" && $month!="" && $day!=""){
			$dateStr = $year."-".putPreZero($month)."-".putPreZero($day);
		}
		else{
			$dateStr = "";
		}
		return $dateStr;
	}
	
	function initSelected($tempVar,$compareTo,$actionStr="selected"){
		if ($this->formArray[$tempVar] == $compareTo){
			$this->tpl->set_var($tempVar."_sel", $actionStr);
		}
		else{
			$this->tpl->set_var($tempVar."_sel", "");
		}
	}
	
	
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
		switch ($this->formArray["gender"]){
			case "male":
				$this->tpl->set_var("male", "checked");
				$this->tpl->set_var("female", "");
				break;
			case "female":
				$this->tpl->set_var("female", "checked");
				$this->tpl->set_var("male", "");
				break;
			default:
				$this->tpl->set_var("male", "");
				$this->tpl->set_var("female", "");
		}

		$startYear = 1900;
		$endYear = date("Y");
		$this->tpl->set_block("rptsTemplate", "YearList", "YearListBlock");
		for($i = $endYear; $i >= $startYear; $i--){
			$this->tpl->set_var("yearValue", $i);
			$this->initSelected("birth_year",$i);
			$this->tpl->parse("YearListBlock", "YearList", true);
		}
		
		eval(MONTH_ARRAY);//$monthArray
		$this->tpl->set_block("rptsTemplate", "MonthList", "MonthListBlock");
		foreach($monthArray as $key => $value){
			$this->tpl->set_var("monthValue", $key);
			$this->tpl->set_var("month", $value);
			$this->initSelected("birth_month",$key);
			$this->tpl->parse("MonthListBlock", "MonthList", true);
		}
		$this->tpl->set_block("rptsTemplate", "DayList", "DayListBlock");

		for($i = 1; $i<=31; $i++){
			$this->tpl->set_var("dayValue", $i);
			$this->initSelected("birth_day",$i);
			$this->tpl->parse("DayListBlock", "DayList", true);
		}
		
		eval(MARITAL_STATUS_ARRAY);//$maritalStatusArray
		$this->tpl->set_block("rptsTemplate", "MaritalStatusList", "MaritalStatusListBlock");
		foreach($maritalStatusArray as $key => $value){
			$this->tpl->set_var("maritalStatusKey", $key);
			$this->tpl->set_var("maritalStatusValue", $value);
			$this->initSelected("maritalStatus",$value,"checked");
			$this->tpl->parse("MaritalStatusListBlock", "MaritalStatusList", true);
		}
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "edit":
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
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$person->getBirthday());
						$this->formArray["personID"] = $person->getPersonID();
						$this->formArray["lastName"] = $person->getLastName();
						$this->formArray["firstName"] = $person->getFirstName();
						$this->formArray["middleName"] = $person->getMiddleName();
						$this->formArray["gender"] = $person->getGender();
						$this->formArray["birth_year"] = removePreZero($dateArr["year"]);
						$this->formArray["birth_month"] = removePreZero($dateArr["month"]);
						$this->formArray["birth_day"] = removePreZero($dateArr["day"]);
						$this->formArray["maritalStatus"] = $person->getMaritalStatus();
						$this->formArray["tin"] = $person->getTin();
						$address = $person->addressArray[0];
						if (is_a($address,Address)){
							$this->formArray["addressID"] = $address->getAddressID();
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
				break;
			case "save":
				$PersonEncode = new SoapObject(NCCBIZ."PersonEncode.php", "urn:Object");
				if ($this->formArray["personID"] <> ""){
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
							$address = $person->addressArray[0];
							if (is_a($address,Address)){
								$address->setAddressID($this->formArray["addressID"]);
								$address->setNumber($this->formArray["number"]);
								$address->setStreet($this->formArray["street"]);
								$address->setBarangay($this->formArray["barangay"]);
								$address->setDistrict($this->formArray["district"]);
								$address->setMunicipalityCity($this->formArray["municipalityCity"]);
								$address->setProvince($this->formArray["province"]);
								$address->setDomDocument();
							}
							$person->setPersonID($this->formArray["personID"]);
							$person->setLastName($this->formArray["lastName"]);
							$person->setFirstName($this->formArray["firstName"]);
							$person->setMiddleName($this->formArray["middleName"]);
							$person->setGender($this->formArray["gender"]);
							$person->setBirthday($this->birthdate);
							$person->setMaritalStatus($this->formArray["maritalStatus"]);
							$person->setTin($this->formArray["tin"]);
							$person->setAddressArray($address);
							$person->setTelephone($this->formArray["telephone"]);
							$person->setMobileNumber($this->formArray["mobileNumber"]);
							$person->setEmail($this->formArray["email"]);
							$person->setDomDocument();

							$doc = $person->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $PersonEncode->updatePerson($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
					$address = new Address;
					$address->setNumber($this->formArray["number"]);
					$address->setStreet($this->formArray["street"]);
					$address->setBarangay($this->formArray["barangay"]);
					$address->setDistrict($this->formArray["district"]);
					$address->setMunicipalityCity($this->formArray["municipalityCity"]);
					$address->setProvince($this->formArray["province"]);
					$address->setDomDocument();
					
					$person = new Person;
					$person->setPersonID($this->formArray["personID"]);
					$person->setLastName($this->formArray["lastName"]);
					$person->setFirstName($this->formArray["firstName"]);
					$person->setMiddleName($this->formArray["middleName"]);
					$person->setGender($this->formArray["gender"]);
					$person->setBirthday($this->birthdate);
					$person->setMaritalStatus($this->formArray["maritalStatus"]);
					$person->setTin($this->formArray["tin"]);
					$person->setAddressArray($address);
					$person->setTelephone($this->formArray["telephone"]);
					$person->setMobileNumber($this->formArray["mobileNumber"]);
					$person->setEmail($this->formArray["email"]);
					$person->setDomDocument();
			
					$doc = $person->getDomDocument();
					$xmlStr =  $doc->dump_mem(true);
					//echo $this->formArray["ownerID"].$xmlStr;
					if (!$ret = $PersonEncode->savePerson($xmlStr,$this->formArray["ownerID"])){
						exit("error save");
					}
				}
				$this->formArray["personID"] = $ret;
				header("location: PropertyInfoClose.php".$this->sess->url("").$this->sess->add_query(array("odID"=>$this->formArray["odID"],"personID"=>$ret,"formAction"=>"view")));
				exit;
				break;
			case "cancel":
				header("location: PersonList.php";
				exit;
				break;
			default:
				if ($this->formArray["locID"]){
					$ODDetails = new SoapObject(NCCBIZ."ODDetails.php", "urn:Object");
					if (!$xmlStr = $ODDetails->getLocation($this->formArray["locID"])){
						exit("xml failed");
					}
					else{
						if(!$domDoc = domxml_open_mem($xmlStr)) {
						}
						else {
							$loc = new LocationAddress;
							$loc->parseDomDocument($domDoc);
							foreach($loc as $key => $value){
								$this->formArray[$key] = $value;
							}
						}	
					}
				}
				$this->tpl->set_block("rptsTemplate", "personID", "personIDBlock");
				$this->tpl->set_var("personIDBlock", "");
				$this->tpl->set_block("rptsTemplate", "ACK", "ACKBlock");
				$this->tpl->set_var("ACKBlock", "");
		}
		
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
	//,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/
$personEncode = new PersonEncode($HTTP_POST_VARS,$personID,$formAction,$sess,$ownerID,$odID,$locID);
$personEncode->main();
?>

<?php page_close(); ?>
