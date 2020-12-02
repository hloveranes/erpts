<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/User.php";
include_once "../includes/assessor/UserRecords.php";
#####################################
# Define Interface Class
#####################################
class UserEncode{
	
	var $tpl;
	var $formArray;
	var $person;
	var $birthdate;
	var $monthArray;
	var $sess;
	
	function UserEncode($http_post_vars,$userID="",$personID="",$formAction="",$sess,$ownerID="",$odID){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "UserEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode User / Person");
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("ownerID"=>$ownerID)));
        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");				
		
		$this->formArray = array(
		    "userID" => $userID
			, "username" => ""
			, "userType" => ""
			, "oldPassword" => ""
			, "newPassword" => ""
			, "password" => ""
			, "confirmPassword" => ""
			, "status" => ""
			, "personID" => $personID
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
		);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
		$dateStr = $this->formArray["birth_year"]."-".putPreZero($this->formArray["birth_month"])."-".putPreZero($this->formArray["birth_day"]);
		$this->birthdate = $dateStr;
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

		$this->tpl->set_block("rptsTemplate", "UserTypeList", "UserTypeListBlock");

		$user = new User;
		$this->userTypeListArray = $user->getUserTypeListArray();
		$this->userTypeBitArray = $user->getUserTypeBitArray($this->formArray["userType"]);

		$i=0;
		foreach($this->userTypeListArray as $key => $value){
			$this->tpl->set_var("userTypeDescription", $value);
			$this->tpl->set_var("i", $i);

			if($this->userTypeBitArray[$i]==1){
				$this->tpl->set_var("userType_sel", "checked");
			}
			else{
				$this->tpl->set_var("userType_sel", "");
			}

			$this->tpl->parse("UserTypeListBlock", "UserTypeList", true);
			$i++;
		}

		switch ($this->formArray["status"]){
			case "enabled":
				$this->tpl->set_var("status_enabled", "checked");
				$this->tpl->set_var("status_disabled", "");
				break;
			case "disabled":
				$this->tpl->set_var("status_enabled", "");
				$this->tpl->set_var("status_disabled", "checked");
				break;
			default:
				$this->tpl->set_var("status_enabled", "checked");
				$this->tpl->set_var("status_disabled", "");
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
		for($i = $endYear; $i>=$startYear; $i--){
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
		for($i = 1; $i<=28; $i++){
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
	
	function usernameAlreadyExists(){
	        $UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
	        if (!$xmlStr = $UserList->getUserList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $userRecords = new UserRecords;
			        $userRecords->parseDomDocument($domDoc);
			        $list = $userRecords->getArrayList();
			        foreach ($list as $key => $user){
			            if(strtoupper($this->formArray["username"])==strtoupper($user->getUsername())){
							if($this->formArray["userID"]!=$user->getUserID()){
								return true;
							}
                        }
				    }
			    }
		    }
    }
    
    function isOldPasswordCorrect(){
        if($this->formArray["oldPassword"]=="null"){
            return true;
        }
        else{
            if($this->formArray["newPassword"]!=""){
                if(md5($this->formArray["oldPassword"])!=$this->formArray["password"]){
                    return false;
                }
                else{
                    $this->formArray["password"] = md5($this->formArray["newPassword"]);
                    return true;
                }
            }
            else{
                return true;
            }
        }
    }
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "edit":
				$UserDetails = new SoapObject(NCCBIZ."UserDetails.php", "urn:Object");
				if (!$xmlStr = $UserDetails->getUserDetails($this->formArray["userID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "User record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$user = new User;
						$user->parseDomDocument($domDoc);
						$this->formArray["userID"] = $user->getUserID();
						$this->formArray["userType"] = $user->getUserType();
						$this->formArray["username"] = $user->getUsername();
						$this->formArray["password"] = $user->getPassword();
						$this->formArray["personID"] = $user->getPersonID();
						$this->formArray["status"] = $user->getStatus();
					}
				}
				$PersonDetails = new SoapObject(NCCBIZ."PersonDetails.php", "urn:Object");
				if (!$xmlStr = $PersonDetails->getPersonDetails($this->formArray["personID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "Person record not found");
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

                $this->tpl->set_block("rptsTemplate", "NewUserPassword", "NewUserPasswordBlock");
                $this->tpl->set_var("NewUserPasswordBlock", "");

                $this->tpl->set_block("rptsTemplate", "OldUserPassword", "OldUserPasswordBlock");
                $this->tpl->set_var("oldNewUserRowspan", 5);
                //$this->tpl->set_var("oldNewUserRowspan", 3);
                $this->tpl->parse("OldUserPasswordBlock", "OldUserPassword", true);
                                  				
				break;
			case "save":
				/*
			    if($this->isOldPasswordCorrect()==false){
			        $this->message = "Error. Cannot Save. Old password incorrect to create new password.";
		    	    $this->tpl->set_var("message", $this->message);	
		    	    $this->tpl->parse("MessageBlock", "Message", true);
		    	    
                    $this->tpl->set_block("rptsTemplate", "NewUserPassword", "NewUserPasswordBlock");
                    $this->tpl->set_var("NewUserPasswordBlock", "");

                    $this->tpl->set_block("rptsTemplate", "OldUserPassword", "OldUserPasswordBlock");
                    $this->tpl->set_var("oldNewUserRowspan", 3);
                    $this->tpl->parse("OldUserPasswordBlock", "OldUserPassword", true);		    	
		    	    break;
			    }
				*/

				if($this->formArray["newPassword"]!="" && $this->formArray["newPassword"]!="null")
					$this->formArray["password"] = md5($this->formArray["newPassword"]);
			    if($this->usernameAlreadyExists()==true){
			        $this->message = "Error. Cannot Save. Username already exists.";
		    	    $this->tpl->set_var("message", $this->message);	
		    	    $this->tpl->parse("MessageBlock", "Message", true);
		    	    
                    $this->tpl->set_block("rptsTemplate", "NewUserPassword", "NewUserPasswordBlock");
                    $this->tpl->set_block("rptsTemplate", "OldUserPassword", "OldUserPasswordBlock");

					if($this->formArray["personID"]!=""){
	                    $this->tpl->set_var("NewUserPasswordBlock", "");
	                    $this->tpl->set_var("oldNewUserRowspan", 3);
	                    $this->tpl->parse("OldUserPasswordBlock", "OldUserPassword", true);		    	
					}
					else{
	                    $this->tpl->set_var("oldNewUserRowspan", 2);
	                    $this->tpl->parse("NewUserPasswordBlock", "NewUserPassword", true);
	                    $this->tpl->set_var("OldUserPasswordBlock", "");
					}

				    break;
			    }
				$PersonEncode = new SoapObject(NCCBIZ."PersonEncode.php", "urn:Object");
				if ($this->formArray["personID"] <> ""){
					$PersonDetails = new SoapObject(NCCBIZ."PersonDetails.php", "urn:Object");
					if (!$xmlStr = $PersonDetails->getPersonDetails($this->formArray["personID"])){
						$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "Person record not found");
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
							$person->setPersonType("adminUser");
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

							//echo $doc->html_dump_mem();



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
					$person->setPersonType("adminUser");
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
				
				$UserEncode = new SoapObject(NCCBIZ."UserEncode.php", "urn:Object");
				if ($this->formArray["userID"] <> ""){
					$UserDetails = new SoapObject(NCCBIZ."UserDetails.php", "urn:Object");
					if (!$xmlStr = $UserDetails->getUserDetails($this->formArray["userID"])){
						exit("User record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$user = new User;
							$user->parseDomDocument($domDoc);
							$user->setUserID($this->formArray["userID"]);
							$user->setUserType($this->formArray["userType"]);
							$user->setUsername($this->formArray["username"]);
						    $user->setPassword($this->formArray["password"]);
							$user->setPersonID($this->formArray["personID"]);
							$user->setStatus($this->formArray["status"]);
							$user->setDomDocument();

							$doc = $user->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $UserEncode->updateUser($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $user = new User;
					//$user->setUserID($this->formArray["userID"]);
					$user->setUserType($this->formArray["userType"]);
					$user->setUsername($this->formArray["username"]);
					$user->setPassword(md5($this->formArray["password"]));
					$user->setPersonID($this->formArray["personID"]);
					$user->setStatus($this->formArray["status"]);
					
					$user->setDomDocument();
			
					$doc = $user->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $UserEncode->saveUser($xmlStr)){
                        exit("error save");
					}
				}		

				header("location: UserClose.php".$this->sess->url(""));
				
				exit;
				break;
			case "cancel":
				header("location: UserClose.php".$this->sess->url(""));
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "UserID", "UserIDBlock");
				$this->tpl->set_var("UserIDBlock", "");
				$this->tpl->set_block("rptsTemplate", "ACK", "ACKBlock");
				$this->tpl->set_var("ACKBlock", "");
				
                $this->tpl->set_block("rptsTemplate", "NewUserPassword", "NewUserPasswordBlock");
                $this->tpl->set_var("oldNewUserRowspan", 2);
                $this->tpl->parse("NewUserPasswordBlock", "NewUserPassword", true);

                $this->tpl->set_block("rptsTemplate", "OldUserPassword", "OldUserPasswordBlock");
                $this->tpl->set_var("OldUserPasswordBlock", "");				
		}
		
		$this->setForm();
		
		if($this->message==""){
			$this->tpl->set_var("MessageBlock", "");	
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
	,"perm" => "rpts_Perm"
	));
//*/
$userEncode = new UserEncode($HTTP_POST_VARS,$userID,$personID,$formAction,$sess,$ownerID,$odID);
$userEncode->Main();
?>

<?php page_close(); ?>
