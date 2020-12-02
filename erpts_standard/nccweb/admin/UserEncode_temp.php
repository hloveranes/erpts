<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/User.php";

include("assessor/Person.php";
include("assessor/PersonRecords.php";


#####################################
# Define Interface Class
#####################################
class UserEncode{
	
	var $tpl;
	var $user;
	var $userTypeListArray;
	var $sess;
	
	function UserEncode($http_post_vars,$userID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "UserEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode User");
		$this->tpl->set_var("Session", $this->sess->url(""));
		
		$this->formArray = array(
			"userID" => $userID
			, "userType" => ""
			, "username" => ""
			, "password" => ""
			, "personID" => ""
			,"formAction" => $formAction
		);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
		
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
		
        $this->userTypeListArray[] = "Super User";
		$this->userTypeListArray[] = "Assessor";
		$this->userTypeListArray[] = "Treasury";
		$this->userTypeListArray[] = "Records";
		$this->userTypeListArray[] = "Guest";
		
		foreach($this->userTypeListArray as $key => $value){
			$this->tpl->set_var("userType", $value);
			$this->initSelected("userType",$value);
			$this->tpl->parse("UserTypeListBlock", "UserTypeList", true);
		}
		
		switch ($this->formArray["gender"] == "male"){
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
		for($i = $startYear; $i<=$endYear; $i++){
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
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "edit":
				$UserDetails = new SoapObject(NCCBIZ."UserDetails.php", "urn:Object");
				if (!$xmlStr = $UserDetails->getUserDetails($this->formArray["userID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
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
					}
				}
		
				break;
			case "save":
				$UserEncode = new SoapObject(NCCBIZ."UserEncode.php", "urn:Object");
				if ($this->formArray["userID"] <> ""){
					$UserDetails = new SoapObject(NCCBIZ."UserDetails.php", "urn:Object");
					if (!$xmlStr = $UserDetails->getUserDetails($this->formArray["userID"])){
						exit("record not found");
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
					$user->setPassword($this->formArray["password"]);
					$user->setPersonID($this->formArray["personID"]);
					
					$user->setDomDocument();
			
					$doc = $user->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $UserEncode->saveUser($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["userID"] = $ret;
				
                header("location: UserEncode.php";
				exit;
				break;
			case "cancel":
				header("location: UserList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "UserID", "UserIDBlock");
				$this->tpl->set_var("UserIDBlock", "");
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
	,"auth" => "rpts_Challenge_Auth"
	,"perm" => "rpts_Perm"
	));
//*/
$UserEncode = new UserEncode($HTTP_POST_VARS,$userID,$formAction,$sess);
$UserEncode->Main();
?>

<?php //page_close(); ?>
