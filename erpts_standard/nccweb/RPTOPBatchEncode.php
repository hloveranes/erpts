 <?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";

include_once "../includes/assessor/eRPTSSettings.php";

include_once "../includes/assessor/User.php";
include_once "../includes/assessor/UserRecords.php";

include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/RPTOPRecords.php";

include_once "../includes/assessor/RPTOPBatchRecords.php";

#####################################
# Define Interface Class
#####################################
class RPTOPBatchEncode{
	
	var $tpl;
	var $formArray;
	var $rptop;
	var $alphaFilterListArray;

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
			, "stepNumber" => "01" // top right corner image
			, "limit" => 5
			, "formAction" => $formAction
			);

		$this->alphaFilterListArray = array(
			"A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","%");

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function initMasterAssessorList($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");
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

	function displayOwnerCompanyList(){
		// list all Company Owners within limit and alphaFilter who DO NOT have an RPTOP for
	    // the selected taxableYear
		$rptopBatchRecords = new RPTOPBatchRecords;
		$db = new DB_RPTS;
		if($this->formArray["alphaFilter"]!="%"){
			$condition = "WHERE "
				.COMPANY_TABLE.".companyName LIKE '".$this->formArray["alphaFilter"]."%'";
		}
		else{
			$notRegExp = "";
			foreach($this->alphaFilterListArray as $alphaFilter){
				if($alphaFilter!="%"){
					if($notRegExp!=""){
						$notRegExp .= "|";
					}
					$notRegExp .= strtoupper($alphaFilter)."|".strtolower($alphaFilter);
				}
			}
			$condition = "WHERE " 
				.COMPANY_TABLE.".companyName NOT REGEXP '^".$notRegExp."'";
		}

		$condition .= " ORDER BY ".COMPANY_TABLE.".companyName ASC;";
		$sql = "SELECT ".COMPANY_TABLE.".companyID as companyID, "
			.COMPANY_TABLE.".companyName "
			."FROM "
			.COMPANY_TABLE." "
			.$condition;

		$db->query($sql);

		if(!$db->next_record()){
			$this->tpl->set_var("total",0);
			$this->removeTplBlock("OwnerListColumns");
			$this->removeTplBlock("OwnerList");
		}
		else{
			$this->removeTplBlock("OwnerListEmpty");
			$this->tpl->set_block("rptsTemplate","OwnerList","OwnerListBlock");
			while($db->next_record()){
				if($ownerCtr < $this->formArray["limit"]){
					// check if owner has no other RPTOPs generated for the year
					if(!($rptopBatchRecords->getOwnerRPTOPArray($db->f("companyID"),"Company",$this->formArray["taxableYear"]))){
						
						// check if owner has TDs for year 
						// this is where the bottleneck of the process is but the validation is necessary so
						// you don't end up with RPTOPS that have no TDs
						$tdArray = $rptopBatchRecords->getTDListOf($db->f("companyID"),"Company",$this->formArray["taxableYear"]);
						if(is_array($tdArray)){
							$ownerCtr++;

							if($db->f("companyName")==""){
								$ownerName = "BLANK OWNER";
							}
							else{
								$ownerName = $db->f("companyName");
							}

							$this->tpl->set_var("ownerName",$ownerName);
							$this->tpl->set_var("personOrCompanyID",$db->f("companyID"));
							$this->tpl->set_var("i",$ownerCtr);

							$this->tpl->parse("OwnerListBlock","OwnerList",true);
						}
					}
				}
				else{
					break;
				}
			}
			$this->tpl->set_var("total",$ownerCtr);
		}
	}

	function displayOwnerPersonList(){
		// list all Person Owners within limit and alphaFilter who DO NOT have an RPTOP for
	    // the selected taxableYear
		$rptopBatchRecords = new RPTOPBatchRecords;
		$db = new DB_RPTS;
		if($this->formArray["alphaFilter"]!="%"){
			$condition = "WHERE "
				.PERSON_TABLE.".personType NOT LIKE 'propertyAdmin'"
				."AND "
				.PERSON_TABLE.".lastName LIKE '".$this->formArray["alphaFilter"]."%'";
		}
		else{
			$notRegExp = "";
			foreach($this->alphaFilterListArray as $alphaFilter){
				if($alphaFilter!="%"){
					if($notRegExp!=""){
						$notRegExp .= "|";
					}
					$notRegExp .= strtoupper($alphaFilter)."|".strtolower($alphaFilter);
				}
			}
			$condition = "WHERE " 
				.PERSON_TABLE.".personType NOT LIKE 'propertyAdmin'"
				."AND "
				.PERSON_TABLE.".lastName NOT REGEXP '^".$notRegExp."'";
		}

		$condition .= " ORDER BY ".PERSON_TABLE.".lastName, ".PERSON_TABLE.".firstName, ".PERSON_TABLE.".middleName ASC;";
		$sql = "SELECT ".PERSON_TABLE.".personID as personID, "
			.PERSON_TABLE.".lastName as lastName, "
			.PERSON_TABLE.".firstName as firstName, "
			.PERSON_TABLE.".middleName as middleName "
			."FROM "
			.PERSON_TABLE." "
			.$condition;

		$db->query($sql);

		if(!$db->next_record()){
			$this->tpl->set_var("total",0);
			$this->removeTplBlock("OwnerListColumns");
			$this->removeTplBlock("OwnerList");
		}
		else{
			$this->removeTplBlock("OwnerListEmpty");
			$this->tpl->set_block("rptsTemplate","OwnerList","OwnerListBlock");
			while($db->next_record()){
				if($ownerCtr < $this->formArray["limit"]){
					// check if owner has no other RPTOPs generated for the year
					if(!($rptopBatchRecords->getOwnerRPTOPArray($db->f("personID"),"Person",$this->formArray["taxableYear"]))){
						// check if owner has TDs for year <-- bottleneck
						$tdArray = $rptopBatchRecords->getTDListOf($db->f("personID"),"Person",$this->formArray["taxableYear"]);
						if(is_array($tdArray)){
							$ownerCtr++;
							if($db->f("lastName")=="" && $db->f("firstName")==""){
								$ownerName = "BLANK OWNER";
							}
							else{
								$ownerName = $db->f("lastName").", ".$db->f("firstName")." ".$db->f("middleName");
							}
	
							$this->tpl->set_var("ownerName",$ownerName);
							$this->tpl->set_var("personOrCompanyID",$db->f("personID"));
							$this->tpl->set_var("i",$ownerCtr);
	
							$this->tpl->parse("OwnerListBlock","OwnerList",true);
						}
					}
				}
				else{
					break;
				}
			}
			$this->tpl->set_var("total",$ownerCtr);
		}
	}


	function displayOwnerList(){
		$ownerCtr = 0;
		$rptopBatchRecords = new RPTOPBatchRecords;
		switch($this->formArray["ownerType"]){
			case "Person":
				$this->displayOwnerPersonList();
				break;
			case "Company":
				$this->displayOwnerCompanyList();
				break;
		}



	}

	function setAlphaFilterList(){
		$this->tpl->set_block("rptsTemplate","AlphaFilterList","AlphaFilterListBlock");
		foreach($this->alphaFilterListArray as $alphaFilterValue){
			$this->tpl->set_var("alphaFilterValue",$alphaFilterValue);
			$this->tpl->parse("AlphaFilterListBlock","AlphaFilterList",true);
		}
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

	function displaySignatories(){
		// treasurer
		$person = new Person;
		$person->selectRecord($this->formArray["cityTreasurerID"]);
		$this->formArray["cityAssessor"] = $person->getFullName();

		// assessor
		$person = new Person;
		$person->selectRecord($this->formArray["cityAssessorID"]);
		$this->formArray["cityTreasurer"] = $person->getFullName();
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "runBatchEncode":
				$this->removeTplBlock("OwnerListForm");
				$this->removeTplBlock("RPTOPNumberForm");
				$this->formArray["stepNumber"] = "03";
				$this->RPTOPNumberFormResults();
				$this->displaySignatories();

				// establish 'formArray' parameter to pass to RPTOPBatchRecord method
				$formArray["taxableYear"] = $this->formArray["taxableYear"];
				$formArray["cityTreasurer"] = $this->formArray["cityTreasurerID"];
				$formArray["cityAssessor"] = $this->formArray["cityAssessorID"];
				$formArray["userID"] = $this->user["uid"];

				$rptopCtr = 0;
				if(!is_array($this->formArray["personOrCompanyID"])){
					$this->set_var("total","0");
					$this->removeTplBlock("RPTOPListColumns");
					$this->removeTplBlock("RPTOPList");
				}
				else{
					$this->removeTplBlock("RPTOPListEmpty");
					$this->tpl->set_block("rptsTemplate","RPTOPList","RPTOPListBlock");
					$batchRecords = new RPTOPBatchRecords;
					for($i=1 ; $i<=$this->formArray["total"] ; $i++){
						$ownerArray["id"] = $this->formArray["personOrCompanyID"][$i];
						$ownerArray["type"] = $this->formArray["ownerType"];

						$newRPTOPNumber = $this->generateNewRPTOPNumber($i-1);
						$newRPTOPID = $batchRecords->setOwnerRPTOP($formArray,$ownerArray,$newRPTOPNumber);

						$this->tpl->set_var("rptopID",$newRPTOPID);
						$this->tpl->set_var("rptopNumber",$newRPTOPNumber);

						$this->tpl->set_var("personOrCompanyID", $this->formArray["personOrCompanyID"][$i]);
						$this->tpl->set_var("ownerName",$this->formArray["ownerName"][$i]);

						$this->tpl->set_var("i",$i);
						$this->tpl->parse("RPTOPListBlock","RPTOPList",true);
					}
				}

				// clean up 
				unset($this->formArray["rptopNumber"]);
				break;
			case "generateOwnerList":
				$this->removeTplBlock("RPTOPListForm");
				$this->removeTplBlock("RPTOPNumberForm");
				$this->formArray["stepNumber"] = "02";
				$this->RPTOPNumberFormResults();
				$this->displaySignatories();
				$this->formArray["userID"] = $this->user["uid"];

				$this->displayOwnerList();
				break;
			default:
				$this->removeTplBlock("RPTOPListForm");
				$this->removeTplBlock("OwnerListForm");
				$this->getLatestRPTOPNumber();
				$this->RPTOPNumberFormDetails();
				$this->setAlphaFilterList();
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
