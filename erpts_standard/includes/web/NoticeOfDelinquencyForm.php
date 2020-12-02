<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";

include_once "../assessor/Address.php";

include_once "../assessor/Person.php";
include_once "../assessor/User.php";
include_once "../assessor/UserRecords.php";

#####################################
# Define Interface Class
#####################################
class NoticeOfDelinquencyForm{
	
	var $tpl;
	function NoticeOfDelinquencyForm($sess,$ownerID,$rptopID){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must have atleast TM-VIEW access
		$pageType = "%%%%1%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "NoticeOfDelinquencyForm.htm") ;
		$this->tpl->set_var("TITLE", "TM : Notice of Delinquency");

		$this->formArray["ownerID"] = $ownerID;
		$this->formArray["rptopID"] = $rptopID;
	}

	function hideBlock($tempVar){
		$this->tpl->set_block("rptsTemplate", $tempVar, $tempVar."Block");
		$this->tpl->set_var($tempVar."Block", "");
	}

	function setPageDetailPerms(){
		if(!checkPerms($this->user["userType"],"%%%1%%%%%%")){
			// hide Blocks if userType is not at least TM-Edit
			$this->hideBlock("GenerateRPTOPLink");
			$this->hideBlock("TreasuryMaintenanceLink");
			$this->hideBlock("ApplyPaymentsLink");
			$this->hideBlock("ApplyPaymentsMenuLink");
		}
		else{
			$this->hideBlock("GenerateRPTOPLinkText");
			$this->hideBlock("TreasuryMaintenanceLinkText");
			$this->hideBlock("ApplyPaymentsLinkText");
			$this->hideBlock("ApplyPaymentsMenuLinkText");
		}
	}

	function initMasterSignatoryList($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		// commented out: March 16, 2004:
		// recommended that approval lists come ONLY out of the Users table and NOT out of eRPTSSettings

		/* Begin of Comment out
		
		$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php", "urn:Object");
		if(!$xmlStr = $eRPTSSettingsDetails->getERPTSSettingsDetails(1)){
			// error xml
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
			}
			else{
				$eRPTSSettings = new eRPTSSettings;
				$eRPTSSettings->parseDomDocument($domDoc);
				switch($tempVar){
					case "recommendingApproval":
					case "approvedBy":
						$this->formArray["recommendingApprovalID"] = $this->formArray["recommendingApproval"];
						$this->formArray["approvedByID"] = $this->formArray["approvedBy"];

						// provincialAssessor
						
						if($eRPTSSettings->getProvincialAssessorLastName()!=""){

							$this->tpl->set_var("id",$eRPTSSettings->getAssessorFullName());
							$this->tpl->set_var("name",$eRPTSSettings->getAssessorFullName());

							$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
							$this->initSelected($tempVar."ID",$eRPTSSettings->getAssessorFullName());
							$this->tpl->parse($TempVar."ListBlock",$TempVar."List",true);
	
							$this->formArray["recommendingApprovalID"] = $this->formArray["recommendingApproval"];
							$this->formArray["approvedByID"] = $this->formArray["approvedBy"];												
							$this->tpl->set_var("id",$eRPTSSettings->getProvincialAssessorFullName());
							$this->tpl->set_var("name",$eRPTSSettings->getProvincialAssessorFullName());

							$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
							$this->initSelected($tempVar."ID",$eRPTSSettings->getProvincialAssessorFullName());
							$this->tpl->parse($TempVar."ListBlock",$TempVar."List",true);
						}
						
						
						break;
				}
			}
		}

		*/
		// End of Comment out: March 16, 2004

		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
        if (!$xmlStr = $UserList->getUserList(0, " WHERE ".AUTH_USER_MD5_TABLE.".userType REGEXP '1$' AND ".AUTH_USER_MD5_TABLE.".status='enabled'")){
			//echo "error xml";
           //$this->tpl->set_var("id", "");
           //$this->tpl->set_var("name", "empty list");
		   //$this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
			    //$this->tpl->set_var("", "");
                //$this->tpl->set_var("name", "empty list");
		        //$this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
			}
			else {
				$UserRecords = new UserRecords;
				$UserRecords->parseDomDocument($domDoc);
				$list = $UserRecords->getArrayList();
				foreach ($list as $key => $user){
					$person = new Person;
					$person->selectRecord($user->personID);
					$this->tpl->set_var("id",$user->personID);
					$this->tpl->set_var("name",$person->getFullName());
					$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
			        $this->initSelected($tempVar."ID",$user->personID);
			        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
				}
			}
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
		$this->formArray["asOfDate_year"] = date("Y");
		$this->formArray["asOfDate_month"] = date("n");
		$this->formArray["asOfDate_day"] = date("j");

		$startYear = 1900;
		$endYear = date("Y");
		$this->tpl->set_block("rptsTemplate", "YearList", "YearListBlock");
		for($i = $endYear; $i >= $startYear; $i--){
			$this->tpl->set_var("yearValue", $i);
			$this->initSelected("asOfDate_year",$i);
			$this->tpl->parse("YearListBlock", "YearList", true);
		}

		eval(MONTH_ARRAY);//$monthArray
		$this->tpl->set_block("rptsTemplate", "MonthList", "MonthListBlock");
		foreach($monthArray as $key => $value){
			$this->tpl->set_var("monthValue", $key);
			$this->tpl->set_var("month", $value);
			$this->initSelected("asOfDate_month",$key);
			$this->tpl->parse("MonthListBlock", "MonthList", true);
		}
		$this->tpl->set_block("rptsTemplate", "DayList", "DayListBlock");

		for($i = 1; $i<=31; $i++){
			$this->tpl->set_var("dayValue", $i);
			$this->initSelected("asOfDate_day",$i);
			$this->tpl->parse("DayListBlock", "DayList", true);
		}		

		$this->initMasterSignatoryList("ApprovedBy", "approvedBy");
		$this->initMasterSignatoryList("PreparedBy", "preparedBy");

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function Main(){
		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->setPageDetailPerms();
		$this->setForm();
		
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
$obj = new NoticeOfDelinquencyForm($sess,$ownerID,$rptopID);
$obj->Main();
?>
<?php page_close(); ?>
