<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";

include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/User.php";
include_once "../includes/assessor/UserRecords.php";

include_once "../includes/assessor/eRPTSSettings.php";
include_once "../includes/assessor/AssessmentSettings.php";

include_once "../includes/assessor/Land.php";
include_once "../includes/assessor/LandRecords.php";

include_once "../includes/assessor/LandClasses.php";
include_once "../includes/assessor/LandClassesRecords.php";
include_once "../includes/assessor/LandActualUses.php";
include_once "../includes/assessor/LandActualUsesRecords.php";
include_once "../includes/assessor/LandSubclasses.php";
include_once "../includes/assessor/LandSubclassesRecords.php";

#####################################
# Define Interface Class
#####################################
class LandEncode{
	
	var $tpl;
	var $formArray;
	var $land;
	
	function LandEncode($http_post_vars,$afsID="",$propertyID="",$formAction="",$sess){
		global $auth;

		$this->sess = $sess;
		$this->userID = $auth->auth["uid"];

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$rptsTemplate = "LandEncode.htm";
/*		$assessmentSettings = new AssessmentSettings;
		if($assessmentSettings->selectRecord()){
			$autoCalculate = $assessmentSettings->getAutoCalculate();
			if($autoCalculate=="false"){
				$rptsTemplate = "LandEncode_AutoCalculateOFF.htm";
			}
		}
*/
		$this->tpl->set_file("rptsTemplate", $rptsTemplate) ;
		$this->tpl->set_var("TITLE", "Encode Land");
		
		$this->formArray = array(
			"afsID" => $afsID
			, "propertyID" => $propertyID
			, "arpNumber" => ""
			, "propertyIndexNumber" => ""
			, "propertyAdministrator" => ""
			, "personID" => ""
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
			, "municipalityCity" => ""
			, "province" => ""
			, "telephone" => ""
			, "mobileNumber" => ""
			, "email" => ""
			, "verifiedByID" => ""
			, "verifiedBy" => ""
			, "verifiedByName" => ""
			, "plottingsByID" => ""
			, "plottingsBy" => ""
			, "plottingsByName" => ""
			, "notedByID" => ""
			, "notedBy" => ""
			, "notedByName" => ""
			, "marketValue" => ""
			, "kind" => ""
			, "actualUse" => ""
			, "adjustedMarketValue" => ""
			, "assessmentLevel" => ""
			, "assessedValue" => ""
			, "previousOwner" => ""
			, "previousAssessedValue" => ""
			, "taxability" => "Taxable"
			, "effectivity" => ""
			, "appraisedByID" => ""
			, "appraisedBy" => ""
			, "appraisedByName" => ""
			, "appraisedByDate" => ""
			, "recommendingApprovalID" => ""
			, "recommendingApproval" => ""
			, "recommendingApprovalName" => ""
			, "recommendingApprovalDate" => ""
			, "approvedByID" => ""
			, "approvedBy" => ""
			, "approvedByName" => ""
			, "approvedByDate" => ""
			, "memoranda" => ""
			, "postingDate" => ""
			, "octTctNumber" => ""
			, "surveyNumber" => ""
			, "north" => ""
			, "east" => ""
			, "south" => ""
			, "west" => ""
			, "boundaryDescription" => ""
			, "classification" => ""
			, "subClass" => ""
			, "area" => ""
			, "unit" => "square meters"
			, "unitValue" => ""
			, "adjustmentFactor" => ""
			, "percentAdjustment" => 100
			, "valueAdjustment" => ""
			, "as_month" => ""
			, "as_day" => ""
			, "as_year" => ""
			, "re_month" => ""
			, "re_day" => ""
			, "re_year" => ""
			, "av_month" => ""
			, "av_day" => ""
			, "av_year" => ""
			, "idle" => "no"
			, "contested" => "no"
			, "formAction" => $formAction
		);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
			//echo $key." = ".$this->formArray[$key]."<br>";
		}
	
		$as_dateStr = $this->getDateStr("as_year","as_month","as_day");
		$this->formArray["appraisedByDate"] = $as_dateStr;

		$re_dateStr = $this->getDateStr("re_year","re_month","re_day");
		$this->formArray["recommendingApprovalDate"] = $re_dateStr;

		$av_dateStr = $this->getDateStr("av_year","av_month","av_day");		
		$this->formArray["approvedByDate"] = $av_dateStr;
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

	function initMasterPropertyList($TempVar, $tempVar){
	    $getList = "get".$TempVar."List";
	    $getID = "get".$TempVar."ID";
	
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		$TempVarList = new SoapObject(NCCBIZ.$TempVar."List.php", "urn:Object");
        if (!$xmlStr = $TempVarList->$getList(0, "WHERE status='active' ORDER BY description")){
		   // empty list
   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// empty list
			}
			else {
			    switch($tempVar){
			        case "landClasses":
			           $tempVarRecords = new LandClassesRecords;
                       $tempVarID = "getLandClassesID";
			        break;
			        case "landActualUses":
			           $tempVarRecords = new LandActualUsesRecords;
			           $tempVarID = "getLandActualUsesID";
			   	       $this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
                    break;
                    case "landSubclasses":
                       $tempVarRecords = new LandSubclassesRecords;
                       $tempVarID = "getLandSubclassesID";
			   	       $this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
                    break;
			    }
			    
    			$tempVarRecords->parseDomDocument($domDoc);
				$list = $tempVarRecords->getArrayList();
				$i = 0;
				$j = 0;
				foreach ($list as $key => $value){
          				$this->tpl->set_var($tempVar."ID", $value->$tempVarID());
		               		$this->tpl->set_var($tempVar, $value->getDescription());
					if($tempVar=="landSubclasses")
						$this->tpl->set_var($tempVar, $value->getDescription()." (".$value->getCode().")");
				        $this->initSelected($tempVar,$value->$tempVarID());
				        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);

					switch($tempVar){
						case "landSubclasses":
							$this->tpl->set_var("i", $i);
							$this->tpl->set_var("landSubclassesID", $value->getLandSubclassesID());
							$this->tpl->set_var("code", addslashes($value->getCode()));
							$this->tpl->set_var("description", addslashes($value->getDescription()));
							$this->tpl->set_var("value", addslashes($value->getValue()));
							$this->tpl->parse("JS".$TempVar."ListBlock", "JS".$TempVar."List", true);
	  					    $i++;
							
							if($landSubclasses_selected==""){
								if ($this->formArray["landSubclasses"]==$value->$tempVarID()){
									$recommendedUnitValue = $value->getValue();
									$landSubclasses = $value->getDescription();
									$landSubclasses_selected = true;
								}
							}
							$this->tpl->set_var("recommendedUnitValue", addslashes($recommendedUnitValue));
							$this->tpl->set_var("landSubclasses", addslashes($landSubclasses));
							break;
						case "landActualUses":
							$this->tpl->set_var("i", $j);
							$this->tpl->set_var("landActualUsesID", $value->getLandActualUsesID());
							$this->tpl->set_var("code", addslashes($value->getCode()));
							$this->tpl->set_var("description", addslashes($value->getDescription()));
							$this->tpl->set_var("value", addslashes($value->getValue()));
							$this->tpl->parse("JS".$TempVar."ListBlock", "JS".$TempVar."List", true);
	  					    $j++;
							
							if($landActualUses_selected==""){
								if ($this->formArray["landActualUses"]==$value->$tempVarID()){
									$recommendedAssessmentLevel = $value->getValue();
									$landActualUses = $value->getDescription();
									$landActualUses_selected = true;
								}
								$this->tpl->set_var("recommendedAssessmentLevel", addslashes($recommendedAssessmentLevel));
								$this->tpl->set_var("landActualUses", addslashes($landActualUses));
							}
							else{
								$this->tpl->set_var("recommendedAssessmentLevel", addslashes($recommendedAssessmentLevel));
								$this->tpl->set_var("landActualUses", addslashes($landActualUses));
							}
							break;
					}
				}
			}
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

	function getFirstPropertyID(){
		$LandList = new SoapObject(NCCBIZ."LandList.php", "urn:Object");
		if(!$xmlStr = $LandList->getLandList($this->formArray["afsID"])){
			return false;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				return false;
			}
			else{
				$landRecords = new LandRecords;
				$landRecords->parseDomDocument($domDoc);
				$list = $landRecords->getArrayList();
				foreach ($list as $key => $value){
					$propertyIDList[] = $value->propertyID;
				}
				sort($propertyIDList);
				return($propertyIDList[0]);
			}
		}
	}

	function setDateDropDown($type){
		$startYear = 1900;
		$endYear = date("Y");
		$this->tpl->set_block("rptsTemplate", $type."YearList", $type."YearListBlock");
		for($i = $endYear; $i>=$startYear; $i--){
			$this->tpl->set_var($type."yearValue", $i);
			$this->initSelected($type."year",$i);
			$this->tpl->parse($type."YearListBlock", $type."YearList", true);
		}
		
		eval(MONTH_ARRAY);//$monthArray
		$this->tpl->set_block("rptsTemplate", $type."MonthList", $type."MonthListBlock");
		foreach($monthArray as $key => $value){
			$this->tpl->set_var($type."monthValue", $key);
			$this->tpl->set_var($type."month", $value);
			$this->initSelected($type."month",$key);
			$this->tpl->parse($type."MonthListBlock", $type."MonthList", true);
		}
		$this->tpl->set_block("rptsTemplate", $type."DayList", $type."DayListBlock");
		for($i = 1; $i<=31; $i++){
			$this->tpl->set_var($type."dayValue", $i);
			$this->initSelected($type."day",$i);
			$this->tpl->parse($type."DayListBlock", $type."DayList", true);
		}
	}

	function setForm(){
		$this->setDateDropDown("as_");
		$this->setDateDropDown("re_");
		$this->setDateDropDown("av_");
		
		$this->formArray["landClasses"] = $this->formArray["classification"];
		$this->formArray["landSubclasses"] = $this->formArray["subClass"];
		$this->formArray["landActualUses"] = $this->formArray["actualUse"];

        $this->initMasterPropertyList("LandClasses", "landClasses");
        $this->initMasterPropertyList("LandActualUses", "landActualUses");
        $this->initMasterPropertyList("LandSubclasses", "landSubclasses");

		$this->initMasterSignatoryList("VerifiedBy", "verifiedBy");
		$this->initMasterSignatoryList("PlottingsBy", "plottingsBy");
		$this->initMasterSignatoryList("NotedBy", "notedBy");
		$this->initMasterSignatoryList("AppraisedBy", "appraisedBy");
		$this->initMasterSignatoryList("RecommendingApproval", "recommendingApproval");
		$this->initMasterSignatoryList("ApprovedBy", "approvedBy");

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function saveVerified($afsIDVer=0, $userIDVer=0, $propIDVer=0) {
		$conn = mysql_connect(MYSQLDBHOST,MYSQLDBUSER, MYSQLDBPWD) 
			or die("failed to connect: " . mysql_error());
		mysql_select_db(MYSQLDBNAME) 
			or die("failed to select database: ". mysql_error());

		$query = "select afsID from AFSVerifications".
					" where afsID = ".$afsIDVer.
					" and proptype = 'Land'".
					" and propertyID = ".$propIDVer;

		$result = mysql_query($query, $conn)
			or die("query failed: " . mysql_error());

		if (mysql_num_rows($result) == 0) {

			$query = "select arpNumber, odID from AFS ".
						"where AFS.afsID = ".$afsIDVer;
	//		echo $query.'<br>';
			$result1 = mysql_query($query, $conn)
				or die("query failed: " . mysql_error());

			if (mysql_num_rows($result1) > 0) {
				$row = mysql_fetch_assoc($result1);

				$query = "insert into AFSVerifications values(".
							$row[odID].", ".
							$afsIDVer.", ".
							"'Land', ".
							$propIDVer.", ".
							"'".$row[arpNumber]."', ".
							$userIDVer.", ".
							"'".time()."'".
							")";

	//			echo $query.'<br>';
				$result2 = mysql_query($query, $conn)
					or die("query failed: " . mysql_error());
				mysql_free_result($result2);
			}
			mysql_free_result($result1);
		}
		mysql_free_result($result);
	}

	function Main(){
		switch ($this->formArray["formAction"]){
			case "edit":
				$LandDetails = new SoapObject(NCCBIZ."LandDetails.php", "urn:Object");
				if (!$xmlStr = $LandDetails->getLand($this->formArray["propertyID"])){
					echo ("xml failed");
				}
				else{
					//echo $xmlStr;
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
						$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
					}
					else {
						$land = new Land;
						$land->parseDomDocument($domDoc);
						foreach($land as $key => $value){
							switch ($key){
								case "propertyAdministrator":
									if (is_a($value,Person)){
										list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value->getBirthday());
										$this->formArray["personID"] = $value->getPersonID();
										$this->formArray["lastName"] = $value->getLastName();
										$this->formArray["firstName"] = $value->getFirstName();
										$this->formArray["middleName"] = $value->getMiddleName();
										$this->formArray["gender"] = $value->getGender();
										$this->formArray["birth_year"] = removePreZero($dateArr["year"]);
										$this->formArray["birth_month"] = removePreZero($dateArr["month"]);
										$this->formArray["birth_day"] = removePreZero($dateArr["day"]);
										$this->formArray["maritalStatus"] = $value->getMaritalStatus();
										$this->formArray["tin"] = $value->getTin();
										if(is_array($value->addressArray)){
											$this->formArray["addressID"] = $value->addressArray[0]->getAddressID();
											$this->formArray["number"] = $value->addressArray[0]->getNumber();
											$this->formArray["street"] = $value->addressArray[0]->getStreet();
											$this->formArray["barangay"] = $value->addressArray[0]->getBarangay();
											$this->formArray["district"] = $value->addressArray[0]->getDistrict();
											$this->formArray["municipalityCity"] = $value->addressArray[0]->getMunicipalityCity();
											$this->formArray["province"] = $value->addressArray[0]->getProvince();
										}
										$this->formArray["telephone"] = $value->getTelephone();
										$this->formArray["mobileNumber"] = $value->getMobileNumber();
										$this->formArray["email"] = $value->getEmail();
									}
									else {
										$this->formArray[$key] = "";
									}
								break;
								case "appraisedByDate":
									if (true){
										list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
										$this->formArray["as_year"] = removePreZero($dateArr["year"]);
										$this->formArray["as_month"] = removePreZero($dateArr["month"]);
										$this->formArray["as_day"] = removePreZero($dateArr["day"]);
									}
									else {
										$this->formArray[$key] = "";
									}
								break;
								case "recommendingApprovalDate":
									if (true){
										list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
										$this->formArray["re_year"] = removePreZero($dateArr["year"]);
										$this->formArray["re_month"] = removePreZero($dateArr["month"]);
										$this->formArray["re_day"] = removePreZero($dateArr["day"]);
									}
									else {
										$this->formArray[$key] = "";
									}
								case "approvedByDate":
									if (true){
										list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
										$this->formArray["av_year"] = removePreZero($dateArr["year"]);
										$this->formArray["av_month"] = removePreZero($dateArr["month"]);
										$this->formArray["av_day"] = removePreZero($dateArr["day"]);
									}
									else {
										$this->formArray[$key] = "";
									}
								break;
								default:
									$this->formArray[$key] = $value;
							}
						}
					}
				}
				break;
			case "save":
				if ($this->formArray["verifiedByID"] <> "" && $this->formArray["verifiedByID"] <> "xx" && $this->formArray["propertyID"] <> "") {
					$this->saveVerified($this->formArray["afsID"], $this->formArray["verifiedByID"], $this->formArray["propertyID"]);
				}

				$LandEncode = new SoapObject(NCCBIZ."LandEncode.php", "urn:Object");
				if ($this->formArray["propertyID"] <> ""){
					$LandDetails = new SoapObject(NCCBIZ."LandDetails.php", "urn:Object");
					if (!$xmlStr = $LandDetails->getLand($this->formArray["propertyID"])){
						$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$address = new Address;
							$address->setAddressID($this->formArray["addressID"]);
							$address->setNumber($this->formArray["number"]);
							$address->setStreet($this->formArray["street"]);
							$address->setBarangay($this->formArray["barangay"]);
							$address->setDistrict($this->formArray["district"]);
							$address->setMunicipalityCity($this->formArray["municipalityCity"]);
							$address->setProvince($this->formArray["province"]);
							$address->setDomDocument();
							
							$propertyAdministrator = new Person;
							$propertyAdministrator->setPersonID($this->formArray["personID"]);
							$propertyAdministrator->setLastName($this->formArray["lastName"]);
							$propertyAdministrator->setFirstName($this->formArray["firstName"]);
							$propertyAdministrator->setMiddleName($this->formArray["middleName"]);
							//$propertyAdministrator->setGender($this->formArray["gender"]);
							//$propertyAdministrator->setBirthday($this->birthdate);
							//$propertyAdministrator->setMaritalStatus($this->formArray["maritalStatus"]);
							//$propertyAdministrator->setTin($this->formArray["tin"]);
							$propertyAdministrator->setAddressArray($address);
							$propertyAdministrator->setTelephone($this->formArray["telephone"]);
							//$propertyAdministrator->setMobileNumber($this->formArray["mobileNumber"]);
							$propertyAdministrator->setEmail($this->formArray["email"]);
							$propertyAdministrator->setDomDocument();

							$land = new Land;
							$land->parseDomDocument($domDoc);
							$land->setPropertyID($this->formArray["propertyID"]);
							$land->setAfsID($this->formArray["afsID"]);
							$land->setArpNumber($this->formArray["arpNumber"]);
							$land->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
							$land->setPropertyAdministrator($propertyAdministrator);
							$land->setVerifiedBy($this->formArray["verifiedByID"]);
							$land->setPlottingsBy($this->formArray["plottingsByID"]);
							$land->setNotedBy($this->formArray["notedByID"]);
							$land->setMarketValue($this->formArray["marketValue"]);
							$land->setKind($this->formArray["kind"]);
							$land->setActualUse($this->formArray["actualUse"]);
							$land->setAdjustedMarketValue($this->formArray["adjustedMarketValue"]);
							$land->setAssessmentLevel($this->formArray["assessmentLevel"]);
							$land->setAssessedValue($this->formArray["assessedValue"]);
							$land->setPreviousOwner($this->formArray["previousOwner"]);
							$land->setPreviousAssessedValue($this->formArray["previousAssessedValue"]);
							$land->setTaxability($this->formArray["taxability"]);
							$land->setEffectivity($this->formArray["effectivity"]);
							$land->setAppraisedBy($this->formArray["appraisedByID"]);
							$land->setAppraisedByDate($this->formArray["appraisedByDate"]);
							$land->setRecommendingApproval($this->formArray["recommendingApprovalID"]);
							$land->setRecommendingApprovalDate($this->formArray["recommendingApprovalDate"]);
							$land->setApprovedBy($this->formArray["approvedByID"]);
							$land->setApprovedByDate($this->formArray["approvedByDate"]);
							$land->setMemoranda($this->formArray["memoranda"]);
							$land->setPostingDate($this->formArray["postingDate"]);
							$land->setOctTctNumber($this->formArray["octTctNumber"]);
							$land->setSurveyNumber($this->formArray["surveyNumber"]);
							$land->setNorth($this->formArray["north"]);
							$land->setEast($this->formArray["east"]);
							$land->setSouth($this->formArray["south"]);
							$land->setWest($this->formArray["west"]);
							$land->setBoundaryDescription($this->formArray["boundaryDescription"]);
							$land->setClassification($this->formArray["classification"]);
							$land->setSubClass($this->formArray["subClass"]);
							$land->setArea($this->formArray["area"]);
							$land->setUnit($this->formArray["unit"]);
							$land->setPercentAdjustment($this->formArray["percentAdjustment"]);
							$land->setUnitValue($this->formArray["unitValue"]);
							$land->setAdjustmentFactor($this->formArray["adjustmentFactor"]);
							$land->setPercentAdjustment($this->formArray["percentAdjustment"]);
							$land->setValueAdjustment($this->formArray["valueAdjustment"]);
							$land->setIdle($this->formArray["idle"]);
							$land->setContested($this->formArray["contested"]);
							$land->setCreatedBy($this->userID);
							$land->setModifiedBy($this->userID);

							$land->setDomDocument();

							$doc = $land->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							//echo $xmlStr;
							if (!$ret = $LandEncode->updateLand($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
					$address = new Address;
					//$address->setAddressID($this->formArray["addressID"]);
					$address->setNumber($this->formArray["number"]);
					$address->setStreet($this->formArray["street"]);
					$address->setBarangay($this->formArray["barangay"]);
					$address->setDistrict($this->formArray["district"]);
					$address->setMunicipalityCity($this->formArray["municipalityCity"]);
					$address->setProvince($this->formArray["province"]);
					$address->setDomDocument();
					
					$propertyAdministrator = new Person;
					//$propertyAdministrator->setPersonID($this->formArray["personID"]);
					$propertyAdministrator->setLastName($this->formArray["lastName"]);
					$propertyAdministrator->setFirstName($this->formArray["firstName"]);
					$propertyAdministrator->setMiddleName($this->formArray["middleName"]);
					//$propertyAdministrator->setGender($this->formArray["gender"]);
					//$propertyAdministrator->setBirthday($this->birthdate);
					//$propertyAdministrator->setMaritalStatus($this->formArray["maritalStatus"]);
					//$propertyAdministrator->setTin($this->formArray["tin"]);
					$propertyAdministrator->setAddressArray($address);
					$propertyAdministrator->setTelephone($this->formArray["telephone"]);
					//$propertyAdministrator->setMobileNumber($this->formArray["mobileNumber"]);
					$propertyAdministrator->setEmail($this->formArray["email"]);
					$propertyAdministrator->setDomDocument();

					$land = new Land;
					$land->parseDomDocument($domDoc);
					//$land->setPropertyID($this->formArray["propertyID"]);
					$land->setAfsID($this->formArray["afsID"]);
					$land->setArpNumber($this->formArray["arpNumber"]);
					$land->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
					$land->setPropertyAdministrator($propertyAdministrator);
					$land->setVerifiedBy($this->formArray["verifiedByID"]);
					$land->setPlottingsBy($this->formArray["plottingsByID"]);
					$land->setNotedBy($this->formArray["notedByID"]);
					$land->setMarketValue($this->formArray["marketValue"]);
					$land->setKind($this->formArray["kind"]);
					$land->setActualUse($this->formArray["actualUse"]);
					$land->setAdjustedMarketValue($this->formArray["adjustedMarketValue"]);
					$land->setAssessmentLevel($this->formArray["assessmentLevel"]);
					$land->setAssessedValue($this->formArray["assessedValue"]);
					$land->setPreviousOwner($this->formArray["previousOwner"]);
					$land->setPreviousAssessedValue($this->formArray["previousAssessedValue"]);
					$land->setTaxability($this->formArray["taxability"]);
					$land->setEffectivity($this->formArray["effectivity"]);
					$land->setAppraisedBy($this->formArray["appraisedByID"]);
					$land->setAppraisedByDate($this->formArray["appraisedByDate"]);
					$land->setRecommendingApproval($this->formArray["recommendingApprovalID"]);
					$land->setRecommendingApprovalDate($this->formArray["recommendingApprovalDate"]);
					$land->setApprovedBy($this->formArray["approvedByID"]);
					$land->setApprovedByDate($this->formArray["approvedByDate"]);
					$land->setMemoranda($this->formArray["memoranda"]);
					$land->setPostingDate($this->formArray["postingDate"]);
					$land->setOctTctNumber($this->formArray["octTctNumber"]);
					$land->setSurveyNumber($this->formArray["surveyNumber"]);
					$land->setNorth($this->formArray["north"]);
					$land->setEast($this->formArray["east"]);
					$land->setSouth($this->formArray["south"]);
					$land->setWest($this->formArray["west"]);
					$land->setBoundaryDescription($this->formArray["boundaryDescription"]);
					$land->setClassification($this->formArray["classification"]);
					$land->setSubClass($this->formArray["subClass"]);
					$land->setArea($this->formArray["area"]);
					$land->setUnit($this->formArray["unit"]);
					$land->setPercentAdjustment($this->formArray["percentAdjustment"]);
					$land->setUnitValue($this->formArray["unitValue"]);
					$land->setAdjustmentFactor($this->formArray["adjustmentFactor"]);
					$land->setPercentAdjustment($this->formArray["percentAdjustment"]);
					$land->setValueAdjustment($this->formArray["valueAdjustment"]);
					$land->setIdle($this->formArray["idle"]);
					$land->setContested($this->formArray["contested"]);
					$land->setCreatedBy($this->userID);
					$land->setModifiedBy($this->userID);

					$land->setDomDocument();

					$doc = $land->getDomDocument();
					$xmlStr =  $doc->dump_mem(true);
					//echo $xmlStr;
					
					$xmlStr =  $doc->dump_mem(true);
					if (!$ret = $LandEncode->saveLand($xmlStr)){
						echo("ret=".$ret);
					}
				}
				$this->formArray["propertyID"] = $ret;

				header("location: LandClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
				exit();
				break;
			case "cancel":
				header("location: LandList.php";
				exit;
				break;
			default:
				if(!$firstPropertyID = $this->getFirstPropertyID()){
					$this->tpl->set_block("rptsTemplate", "odID", "odIDBlock");
					$this->tpl->set_var("odIDBlock", "");
					$this->tpl->set_block("rptsTemplate", "ACK", "ACKBlock");
					$this->tpl->set_var("ACKBlock", "");
				}
				else{
					$LandDetails = new SoapObject(NCCBIZ."LandDetails.php", "urn:Object");
					if (!$xmlStr = $LandDetails->getLand($firstPropertyID)){
						echo ("xml failed");
					}
					else{
						//echo $xmlStr;
						if(!$domDoc = domxml_open_mem($xmlStr)) {
							$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
							$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
						}
						else {
							$land = new Land;
							$land->parseDomDocument($domDoc);
							foreach($land as $key => $value){
								switch ($key){
									case "propertyID":
										$this->formArray["propertyID"] = "";
										break;

									case "propertyAdministrator":
										if (is_a($value,Person)){
											list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = 	explode("-",$value->getBirthday());
											$this->formArray["personID"] = $value->getPersonID();
											$this->formArray["lastName"] = $value->getLastName();
											$this->formArray["firstName"] = $value->getFirstName();
											$this->formArray["middleName"] = $value->getMiddleName();
											$this->formArray["gender"] = $value->getGender();
											$this->formArray["birth_year"] = removePreZero($dateArr["year"]);
											$this->formArray["birth_month"] = removePreZero($dateArr["month"]);
											$this->formArray["birth_day"] = removePreZero($dateArr["day"]);
											$this->formArray["maritalStatus"] = $value->getMaritalStatus();
											$this->formArray["tin"] = $value->getTin();
											if(is_array($value->addressArray)){
												$this->formArray["addressID"] = 	$value->addressArray[0]->getAddressID();
												$this->formArray["number"] = $value->addressArray[0]->getNumber();
												$this->formArray["street"] = $value->addressArray[0]->getStreet();
												$this->formArray["barangay"] = 	$value->addressArray[0]->getBarangay();
												$this->formArray["district"] = 	$value->addressArray[0]->getDistrict();
												$this->formArray["municipalityCity"] = 	$value->addressArray[0]->getMunicipalityCity();
												$this->formArray["province"] = $value->addressArray[0]->getProvince();
											}
											$this->formArray["telephone"] = $value->getTelephone();
											$this->formArray["mobileNumber"] = $value->getMobileNumber();
											$this->formArray["email"] = $value->getEmail();
										}
										else {
											$this->formArray[$key] = "";
										}
									break;
									case "appraisedByDate":
										if (true){
											list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = 	explode("-",$value);
											$this->formArray["as_year"] = removePreZero($dateArr["year"]);
											$this->formArray["as_month"] = removePreZero($dateArr["month"]);
											$this->formArray["as_day"] = removePreZero($dateArr["day"]);
										}
										else {
											$this->formArray[$key] = "";
										}
									break;
									case "recommendingApprovalDate":
										if (true){
											list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = 	explode("-",$value);
											$this->formArray["re_year"] = removePreZero($dateArr["year"]);
											$this->formArray["re_month"] = removePreZero($dateArr["month"]);
											$this->formArray["re_day"] = removePreZero($dateArr["day"]);
										}
										else {
											$this->formArray[$key] = "";
										}
									case "approvedByDate":
										if (true){
											list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = 	explode("-",$value);
											$this->formArray["av_year"] = removePreZero($dateArr["year"]);
											$this->formArray["av_month"] = removePreZero($dateArr["month"]);
											$this->formArray["av_day"] = removePreZero($dateArr["day"]);
										}
										else {
											$this->formArray[$key] = "";
										}
									break;

									case "arpNumber":

									case "propertyIndexNumber":

									case "verifiedByID":
									case "verifiedBy":
									case "verifiedByName":
									case "plottingsByID":
									case "plottingsBy":
									case "plottingsByName":
									case "notedByID":
									case "notedBy":
									case "notedByName":

									case "marketValue":
									case "kind":
									case "actualUse":
									case "adjustedMarketValue":
									case "assessmentLevel":
									case "assessedValue":
									case "previousOwner":
									case "previousAssessedValue":
									case "taxability":
									case "effectivity":
									case "appraisedByID":
									case "appraisedBy":
									case "appraisedByName":
									case "appraisedByDate":
									case "recommendingApprovalID":
									case "recommendingApproval":
									case "recommendingApprovalName":
									case "recommendingApprovalDate":
									case "approvedByID":
									case "approvedBy":
									case "approvedByName":
									case "approvedByDate":
									case "memoranda":
									case "postingDate":
									case "octTctNumber":
									case "surveyNumber":
									case "north":
									case "east":
									case "south":
									case "west":
									case "boundaryDescription":
									case "classification":
									case "subClass":
									case "area":
									case "unit":
									case "unitValue":
									case "adjustmentFactor":
									case "percentAdjustment":
									case "valueAdjustment":
									case "as_month":
									case "as_day":
									case "as_year":
									case "re_month":
									case "re_day":
									case "re_year":
									case "av_month":
									case "av_day":
									case "av_year":
									case "idle":
									case "contested":


										$this->formArray[$key] = $value;
										break;
								}
							}
						}
					}

				}
		}
		$this->setForm();
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("odID"=>$this->formArray["odID"],"ownerID" => $this->formArray["ownerID"])));
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
$landEncode = new LandEncode($HTTP_POST_VARS,$afsID,$propertyID,$formAction,$sess);
$landEncode->Main();
?>
<?php page_close(); ?>
