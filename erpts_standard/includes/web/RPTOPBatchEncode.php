 <?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/Person.php";
include_once "../assessor/PersonRecords.php";

include_once "../assessor/eRPTSSettings.php";

include_once "../assessor/User.php";
include_once "../assessor/UserRecords.php";

include_once "../assessor/RPTOP.php";
include_once "../assessor/RPTOPRecords.php";

include_once "../assessor/RPTOPBatchRecords.php";



#####################################
# Define Interface Class
#####################################
class RPTOPBatchEncode{
	
	var $tpl;
	var $formArray;
	var $rptop;

	function RPTOPBatchEncode($http_post_vars,$formAction="",$sess){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must have atleast AM-EDIT access
		$pageType = "%1%%%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}	

		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "RPTOPBatchEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode RPTOP by Batch");
		
		$this->formArray = array(
			"rptopID" => $rptopID
			, "rptopNumber" => ""
			, "taxableYear" => ""
			, "cityAssessor" => ""
			, "citytreasurer" => ""
			, "cityAssessorID" => ""
			, "citytreasurerID" => ""
			, "stepNumber" => "01"
			, "limit" => 5
			, "formAction" => $formAction
			);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function initMasterAssessorList($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		/*

		$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php", "urn:Object");
		if(!$xmlStr = $eRPTSSettingsDetails->getERPTSSettingsDetails(1)){
			echo "blabla";
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				echo "blabla2";
			}
			else{
				$eRPTSSettings = new eRPTSSettings;
				$eRPTSSettings->parseDomDocument($domDoc);
				switch($tempVar){
					case "cityAssessor":
						$this->tpl->set_var("id",$eRPTSSettings->getAssessorFullName());
						$this->tpl->set_var("name",$eRPTSSettings->getAssessorFullName());

						$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
						$this->initSelected($tempVar."ID",$eRPTSSettings->getAssessorFullName());
						$this->tpl->parse($TempVar."ListBlock",$TempVar."List",true);
						break;
				}
			}
		}

		*/

		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
        if (!$xmlStr = $UserList->getUserList(0, " WHERE ".AUTH_USER_MD5_TABLE.".userType REGEXP '1$' AND ".AUTH_USER_MD5_TABLE.".status='enabled'")){
			// error xml

   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
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

	function initMasterTreasurerList($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		/*

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
					case "cityTreasurer":
						$this->tpl->set_var("id",$eRPTSSettings->getTreasurerFullName());
						$this->tpl->set_var("name",$eRPTSSettings->getTreasurerFullName());

						$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
						$this->initSelected($tempVar."ID",$eRPTSSettings->getTreasurerFullName());
						$this->tpl->parse($TempVar."ListBlock",$TempVar."List",true);
						break;
				}
			}
		}

		*/

		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
        if (!$xmlStr = $UserList->getUserList(0, " WHERE ".AUTH_USER_MD5_TABLE.".userType REGEXP '1$' AND ".AUTH_USER_MD5_TABLE.".status='enabled'")){
			// error xmlStr
   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
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

	function getLatestRPTOPNumber(){
		$latestRPTOPNumber = array(
			"latestRPTOPNumber" => ""
			,"prefix" => ""
			,"delimeter" => ""
			,"startNumber" => ""
			);

		$RPTOPList = new SoapObject(NCCBIZ."RPTOPList.php", "urn:Object");
		$condition = " WHERE ".RPTOP_TABLE.".archive!='true' ORDER BY rptopID DESC LIMIT 1";
		if (!$xmlStr = $RPTOPList->getRPTOPList(0,$condition)){
			// no latest available RPTOP
			$this->tpl->set_var("latestRPTOPNumber", "");
			$this->tpl->set_var("rptopNumber[prefix]", "");
			$this->tpl->set_var("rptopNumber[delimeter]", "");
			$this->tpl->set_var("rptopNumber[startNumber]", "");
			$this->tpl->set_var("rptopNumber[sample]", "");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// no latest available RPTOP
				$this->tpl->set_var("latestRPTOPNumber", "");
				$this->tpl->set_var("rptopNumber[prefix]", "");
				$this->tpl->set_var("rptopNumber[delimeter]", "");
				$this->tpl->set_var("rptopNumber[startNumber]", "");
				$this->tpl->set_var("rptopNumber[sample]", "");
			}
			else{
				$rptopRecords = new RPTOPRecords;
				$rptopRecords->parseDomDocument($domDoc);
				$arrayList = $rptopRecords->getArrayList();
				if(is_array($arrayList)){
					foreach($arrayList as $key=>$rptop){
						// get delimeter and prefix
						$latestRPTOPNumber = $rptop->getRptopNumber();

						$splitArray = split("[^0-9]",$latestRPTOPNumber);
						$prefix = "";
						if(is_array($splitArray)){
							$i=0;
							$j=0;
							foreach($splitArray as $str){
								if($i < count($splitArray)-1){
									$prefix .= $splitArray[$i];
									$prefix .= substr($latestRPTOPNumber,$j+strlen($splitArray[$i]),1);
									$j += strlen($splitArray[$i])+1;
								}
								$i++;
							}
							$delimeter = substr($prefix,strlen($prefix)-1,1);
							$prefix = substr($prefix,0,strlen($prefix)-1);
							$startNumber = $splitArray[count($splitArray)-1] + 1;
						}

						$rptopNumber["prefix"] = $prefix;
						$rptopNumber["delimeter"] = $delimeter;
						$rptopNumber["startNumber"] = $startNumber;
						$rptopNumber["sample"] = $prefix.$delimeter.$startNumber;

						$this->tpl->set_var("latestRPTOPNumber", $latestRPTOPNumber);
						$this->tpl->set_var("rptopNumber[prefix]", $rptopNumber["prefix"]);
						$this->tpl->set_var("rptopNumber[delimeter]", $rptopNumber["delimeter"]);
						$this->tpl->set_var("rptopNumber[startNumber]", $rptopNumber["startNumber"]);
						$this->tpl->set_var("rptopNumber[sample]", $rptopNumber["sample"]);
					
						break;
					}
				}
				else{
					// no latest available RPTOP
					$this->tpl->set_var("latestRPTOPNumber", "");
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

	function RPTOPNumberFormResults(){
		$rptopNumber = $this->formArray["rptopNumber"];
		$this->tpl->set_var("rptopNumber[prefix]", $rptopNumber["prefix"]);
		$this->tpl->set_var("rptopNumber[delimeter]", $rptopNumber["delimeter"]);
		$this->tpl->set_var("rptopNumber[startNumber]", $rptopNumber["startNumber"]);
	}

	function RPTOPNumberFormDetails(){
		$startYear = 1990;
		$endYear = date("Y")+3;
		$this->tpl->set_block("rptsTemplate", "YearList", "YearListBlock");
		for($i = $endYear; $i>=$startYear; $i--){
			$this->tpl->set_var("year", $i);
			$this->initSelected("taxableYear",$i);
			$this->tpl->parse("YearListBlock", "YearList", true);
		}
		$this->initMasterAssessorList("CityAssessor", "cityAssessor");
		$this->initMasterTreasurerList("CityTreasurer", "cityTreasurer");
	}

	function generateNewRPTOPNumber($i){
		$rptopNumber = $this->formArray["rptopNumber"];
		$newRPTOPNumber = $rptopNumber["startNumber"]+($i);  
		$nprfx = $rptopNumber["prefix"];
		$nprfx.= $rptopNumber["delimeter"];
		$newRPTOPNumber = $nprfx.$newRPTOPNumber;
		return $newRPTOPNumber;
	}

	function displayOwnerList(){
		$batchRecords = new RPTOPBatchRecords;
		$i=0;

		if($ownerNameArray = $batchRecords->getOwnerNameArray($this->formArray["taxableYear"],$this->formArray["limit"])){
			if(is_array($ownerNameArray)){
				$this->removeTplBlock("OwnerListEmpty");
				$this->tpl->set_block("rptsTemplate", "OwnerList", "OwnerListBlock");

				foreach($ownerNameArray as $ownerName){
					$this->tpl->set_var("i",$i+1);
					$this->tpl->set_var("ownerName", $ownerName["ownerName"]);
					$this->tpl->set_var("id", $ownerName["id"]);

					$newRPTOP["rptopNumber"] = $this->generateNewRPTOPNumber($i);
					
					if($newRPTOP["rptopID"] = $batchRecords->setOwnerRPTOP($this->formArray,$ownerName,$newRPTOP["rptopNumber"])){
						// generate NEW RPTOP NUMBER
						$this->tpl->set_var("newRPTOP[rptopID]", $newRPTOP["rptopID"]);
						$this->tpl->set_var("newRPTOP[rptopNumber]", $newRPTOP["rptopNumber"]);

						$this->tpl->parse("OwnerListBlock", "OwnerList", true);
						$this->tpl->set_var("OwnerTDListBlock", "");
						$i++;
					}

				}

			}
		}
		else{
			$this->removeTplBlock("OwnerListColumns");
			$this->removeTplBlock("OwnerList");
		}

		$this->tpl->set_var("total", $i);
	}

	function removeTplBlock($blockName){
		$this->tpl->set_block("rptsTemplate", $blockName, $blockName."Block");
		$this->tpl->set_var($blockName."Block", "");
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "runBatchEncode":
				$this->removeTplBlock("RPTOPNumberForm");
				$this->formArray["stepNumber"] = "02";
				$this->RPTOPNumberFormResults();

				$this->formArray["cityAssessor"] = $this->formArray["cityAssessorID"];
				$this->formArray["cityTreasurer"] = $this->formArray["cityTreasurerID"];
				$this->formArray["userID"] = $this->user["uid"];

				// run batch encoding process and display the outcome in owners list
				$this->displayOwnerList();
				break;
			default:
				$this->removeTplBlock("OwnerListForm");
				$this->getLatestRPTOPNumber();
				$this->RPTOPNumberFormDetails();
		}

		$this->setForm();

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

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
$rptopBatchEncode = new RPTOPBatchEncode($HTTP_POST_VARS,$formAction,$sess);
$rptopBatchEncode->main();
?>
<?php page_close(); ?>
