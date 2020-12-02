<?php
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/Address.php";
include_once "../assessor/Person.php";
include_once "../assessor/User.php";
include_once "../assessor/UserRecords.php";

include_once "../assessor/eRPTSSettings.php";
include_once "../assessor/AssessmentSettings.php";

include_once "../assessor/ImprovementsBuildings01.php";
include_once "../assessor/ImprovementsBuildingsRecords.php";

include_once "../assessor/ImprovementsBuildingsClasses.php";
include_once "../assessor/ImprovementsBuildingsClassesRecords.php";
include_once "../assessor/ImprovementsBuildingsActualUses.php";
include_once "../assessor/ImprovementsBuildingsActualUsesRecords.php";

#####################################
# Define Interface Class
#####################################
class ImprovementsBuildingsEncode{
	
	var $tpl;
	var $formArray;
	var $improvementsBuildings;
	
	function ImprovementsBuildingsEncode($http_post_vars,$afsID="",$type,$propertyID="",$formAction="",$sess){
		global $auth;

		$this->sess = $sess;
		$this->userID = $auth->auth["uid"];

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$rptsTemplate = "ImprovementsBuildingsEncode.htm";
		$assessmentSettings = new AssessmentSettings;
		if($assessmentSettings->selectRecord()){
			$autoCalculate = $assessmentSettings->getAutoCalculate();
			if($autoCalculate=="false"){
				$rptsTemplate = "ImprovementsBuildingsEncode_AutoCalculateOFF.htm";
			}
		}

		$this->tpl->set_file("rptsTemplate", $rptsTemplate);

		$this->tpl->set_var("TITLE", "Encode ImprovementsBuildings");
		
		$this->formArray = array(
			"afsID" => $afsID
			, "propertyID" => $propertyID
			, "type" => $type
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
			, "taxability" => ""
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
			
			, "landPin" => ""
			, "foundation" => ""
			, "columnsBldg" => ""
			, "beams" => ""
			, "trussFraming" => ""
			, "roof" => ""
			, "exteriorWalls" => ""
			, "flooring" => ""
			, "doors" => ""
			, "ceiling" => ""
			, "structuralTypes" => ""
			, "buildingClassification" => ""
			, "buildingPermit" => ""
			, "buildingAge" => ""
			, "cctNumber" => ""
			, "numberOfStoreys" => ""
			, "windows" => ""
			, "stairs" => ""
			, "partition" => ""
			, "wallFinish" => ""
			, "electrical" => ""
			, "toiletAndBath" => ""
			, "plumbingSewer" => ""
			, "fixtures" => ""
			, "dateConstructed" => ""
			, "dateOccupied" => ""
			, "dateCompleted" => ""
			, "areaOfGroundFloor" => ""
			, "totalBuildingArea" => ""
			, "unitValue" => ""
			, "buildingCoreAndAdditionalItems" => ""
			, "addItems" => ""
			, "depreciationRate" => ""
			, "accumulatedDepreciation" => ""
			, "depreciatedMarketValue" => ""
			
			, "as_month" => ""
			, "as_day" => ""
			, "as_year" => ""
			, "re_month" => ""
			, "re_day" => ""
			, "re_year" => ""
			, "av_month" => ""
			, "av_day" => ""
			, "av_year" => ""
			, "dc_month" => ""
			, "dc_day" => ""
			, "dc_year" => ""
			, "do_month" => ""
			, "do_day" => ""
			, "do_year" => ""
			, "dm_month" => ""
			, "dm_day" => ""
			, "dm_year" => ""
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

		$dc_dateStr = $this->getDateStr("dc_year","dc_month","dc_day");
		$this->formArray["dateConstructed"] = $dc_dateStr;

		$do_dateStr = $this->getDateStr("do_year","do_month","do_day");
		$this->formArray["dateOccupied"] = $do_dateStr;

		$dm_dateStr = $this->getDateStr("dm_year","dm_month","dm_day");
		$this->formArray["dateCompleted"] = $dm_dateStr;
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

		$condition = "WHERE status='active' ORDER BY description";

		if (!$xmlStr = $TempVarList->$getList(0,$condition)){
		   // empty list
   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// empty list
			}
			else {
			    switch($tempVar){
			        case "improvementsBuildingsClasses":
			           $tempVarRecords = new ImprovementsBuildingsClassesRecords;
                       $tempVarID = "getImprovementsBuildingsClassesID";
					   $this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
			        break;
			        case "improvementsBuildingsActualUses":
			           $tempVarRecords = new ImprovementsBuildingsActualUsesRecords;
			           $tempVarID = "getImprovementsBuildingsActualUsesID";
				       $this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
                    break;
			    }
			
    			$tempVarRecords->parseDomDocument($domDoc);
				$list = $tempVarRecords->getArrayList();
				$i=0;
				foreach ($list as $key => $value){
          			$this->tpl->set_var($tempVar."ID", $value->$tempVarID());
               		$this->tpl->set_var($tempVar, $value->getDescription());
			        $this->initSelected($tempVar,$value->$tempVarID());
			        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
				
				switch($tempVar){
					case "improvementsBuildingsClasses":
						$this->tpl->set_var("i", $i);
						$this->tpl->set_var("improvementsBuildingsClassesID", $value->getImprovementsBuildingsClassesID());
						$this->tpl->set_var("code", addslashes($value->getCode()));
						$this->tpl->set_var("description", addslashes($value->getDescription()));
						$this->tpl->set_var("value", addslashes($value->getValue()));
						$this->tpl->set_var("type", addslashes($value->getType()));
						$this->initSelected($tempVar,$value->$tempVarID());
						$this->tpl->parse("JS".$TempVar."ListBlock", "JS".$TempVar."List", true);
						$i++;
						
						if($improvementsBuildingsClasses_selected==""){
							if($this->formArray["improvementsBuildingsClasses"]==$value->$tempVarID()){
								$recommendedUnitValue = $value->getValue();
								$improvementsBuildingsClasses = $value->getDescription();
								$improvementsBuildingsClasses_selected = true;
							}
							$this->tpl->set_var("recommendedUnitValue", addslashes($recommendedUnitValue));
							$this->tpl->set_var("improvementsBuildingsUnitValue", addslashes($improvementsBuildingsUnitValue));
						}
						else{
							$this->tpl->set_var("recommendedUnitValue", addslashes($recommendedUnitValue));
							$this->tpl->set_var("improvementsBuildingsUnitValue", addslashes($improvementsBuildingsUnitValue));
						}
						break;
					case "improvementsBuildingsActualUses":
						$this->tpl->set_var("i", $i);
						$this->tpl->set_var("improvementsBuildingsActualUsesID", $value->getImprovementsBuildingsActualUsesID());
						$this->tpl->set_var("code", addslashes($value->getCode()));
						$this->tpl->set_var("description", addslashes($value->getDescription()));
						$this->tpl->set_var("value", addslashes($value->getValue()));
						$this->initSelected($tempVar,$value->$tempVarID());
						$this->tpl->parse("JS".$TempVar."ListBlock", "JS".$TempVar."List", true);
						$i++;
						
						if($improvementsBuildingsActualUses_selected==""){
							if($this->formArray["improvementsBuildingsActualUses"]==$value->$tempVarID()){
								$recommendedAssessmentLevel = $value->getValue();
								$improvementsBuildingsActualUses = $value->getDescription();
								$improvementsBuildingsActualUses_selected = true;
							}
							$this->tpl->set_var("recommendedAssessmentLevel", addslashes($recommendedAssessmentLevel));
							$this->tpl->set_var("improvementsBuildingsActualUses", addslashes($improvementsBuildingsActualUses));
						}
						else{
							$this->tpl->set_var("recommendedAssessmentLevel", addslashes($recommendedAssessmentLevel));
							$this->tpl->set_var("improvementsBuildingsActualUses", addslashes($improvementsBuildingsActualUses));
						}
						break;
				}
				
				
				
				}
			}
		}
	
	}

	function initMasterSignatoryList($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];

		// commented out: March 16, 2004:
		// recommended that approval lists come ONLY out of the Users table and not out of eRPTSSettings

		/* Begin of Comment out

		$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php", "urn:Object");
		if(!$xmlStr = $eRPTSSettingsDetails->getERPTSSettingsDetails(1)){
			// xml failed
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

						// provincialAssessor
						
						if($eRPTSSettings->getProvincialAssessorLastName()!=""){

							$this->formArray["recommendingApprovalID"] = $this->formArray["recommendingApproval"];
							$this->formArray["approvedByID"] = $this->formArray["approvedBy"];
							$this->tpl->set_var("id",$eRPTSSettings->getAssessorFullName());
							$this->tpl->set_var("name",$eRPTSSettings->getAssessorFullName());
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
		// End of Comment out : March 16, 2004

		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
        if (!$xmlStr = $UserList->getUserList(0, " WHERE ".AUTH_USER_MD5_TABLE.".userType REGEXP '1$' AND ".AUTH_USER_MD5_TABLE.".status='enabled'")){
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
		$ImprovementsBuildingsList = new SoapObject(NCCBIZ."ImprovementsBuildingsList.php", "urn:Object");
		if(!$xmlStr = $ImprovementsBuildingsList->getImprovementsBuildingsList($this->formArray["afsID"])){
			return false;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				return false;
			}
			else{
				$improvementsBuildingsRecords = new ImprovementsBuildingsRecords;
				$improvementsBuildingsRecords->parseDomDocument($domDoc);
				$list = $improvementsBuildingsRecords->getArrayList();
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
		for($i = 1; $i<=28; $i++){
			$this->tpl->set_var($type."dayValue", $i);
			$this->initSelected($type."day",$i);
			$this->tpl->parse($type."DayListBlock", $type."DayList", true);
		}
	}
	function setForm(){
		$this->setDateDropDown("dc_");
		$this->setDateDropDown("do_");
		$this->setDateDropDown("dm_");
		$this->setDateDropDown("as_");
		$this->setDateDropDown("re_");
		$this->setDateDropDown("av_");
		
        $this->formArray["improvementsBuildingsClasses"] = $this->formArray["buildingClassification"];
        $this->formArray["improvementsBuildingsActualUses"] = $this->formArray["actualUse"];

        $this->initMasterPropertyList("ImprovementsBuildingsClasses", "improvementsBuildingsClasses");
        $this->initMasterPropertyList("ImprovementsBuildingsActualUses", "improvementsBuildingsActualUses");

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
//		echo $afsIDVer, " : ". $userIDVer, " : ", $propIDVer;
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
				$ImprovementsBuildingsDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsDetails.php", "urn:Object");
				if (!$xmlStr = $ImprovementsBuildingsDetails->getImprovementsBuildings($this->formArray["propertyID"])){
					echo ("xml failed");
				}
				else{
					//echo $xmlStr;
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
						$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
					}
					else {
						$improvementsBuildings = new ImprovementsBuildings;
						$improvementsBuildings->parseDomDocument($domDoc);
						foreach($improvementsBuildings as $key => $value){
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
									break;
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
								case "dateConstructed":
									if (true){
										list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
										$this->formArray["dc_year"] = removePreZero($dateArr["year"]);
										$this->formArray["dc_month"] = removePreZero($dateArr["month"]);
										$this->formArray["dc_day"] = removePreZero($dateArr["day"]);
									}
									else {
										$this->formArray[$key] = "";
									}
								break;
								case "dateOccupied":
									if (true){
										list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
										$this->formArray["do_year"] = removePreZero($dateArr["year"]);
										$this->formArray["do_month"] = removePreZero($dateArr["month"]);
										$this->formArray["do_day"] = removePreZero($dateArr["day"]);
									}
									else {
										$this->formArray[$key] = "";
									}
								break;
								case "dateCompleted":
									if (true){
										list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
										$this->formArray["dm_year"] = removePreZero($dateArr["year"]);
										$this->formArray["dm_month"] = removePreZero($dateArr["month"]);
										$this->formArray["dm_day"] = removePreZero($dateArr["day"]);
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

				$ImprovementsBuildingsEncode = new SoapObject(NCCBIZ."ImprovementsBuildingsEncode.php", "urn:Object");
				if ($this->formArray["propertyID"] <> ""){
					$ImprovementsBuildingsDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsDetails.php", "urn:Object");
					if (!$xmlStr = $ImprovementsBuildingsDetails->getImprovementsBuildings($this->formArray["propertyID"])){
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

							$improvementsBuildings = new ImprovementsBuildings;
							$improvementsBuildings->parseDomDocument($domDoc);
							$improvementsBuildings->setPropertyID($this->formArray["propertyID"]);
							$improvementsBuildings->setAfsID($this->formArray["afsID"]);
							$improvementsBuildings->setArpNumber($this->formArray["arpNumber"]);
							$improvementsBuildings->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
							$improvementsBuildings->setPropertyAdministrator($propertyAdministrator);
							$improvementsBuildings->setVerifiedBy($this->formArray["verifiedByID"]);
							$improvementsBuildings->setPlottingsBy($this->formArray["plottingsByID"]);
							$improvementsBuildings->setNotedBy($this->formArray["notedByID"]);
							$improvementsBuildings->setMarketValue($this->formArray["marketValue"]);
							$improvementsBuildings->setKind($this->formArray["kind"]);
							$improvementsBuildings->setActualUse($this->formArray["actualUse"]);
							$improvementsBuildings->setAdjustedMarketValue($this->formArray["adjustedMarketValue"]);
							$improvementsBuildings->setAssessmentLevel($this->formArray["assessmentLevel"]);
							$improvementsBuildings->setAssessedValue($this->formArray["assessedValue"]);
							$improvementsBuildings->setPreviousOwner($this->formArray["previousOwner"]);
							$improvementsBuildings->setPreviousAssessedValue($this->formArray["previousAssessedValue"]);
							$improvementsBuildings->setTaxability($this->formArray["taxability"]);
							$improvementsBuildings->setEffectivity($this->formArray["effectivity"]);
							$improvementsBuildings->setAppraisedBy($this->formArray["appraisedByID"]);
							$improvementsBuildings->setAppraisedByDate($this->formArray["appraisedByDate"]);
							$improvementsBuildings->setRecommendingApproval($this->formArray["recommendingApprovalID"]);
							$improvementsBuildings->setRecommendingApprovalDate($this->formArray["recommendingApprovalDate"]);
							$improvementsBuildings->setApprovedBy($this->formArray["approvedByID"]);
							$improvementsBuildings->setApprovedByDate($this->formArray["approvedByDate"]);
							$improvementsBuildings->setMemoranda($this->formArray["memoranda"]);
							$improvementsBuildings->setPostingDate($this->formArray["postingDate"]);
							
							
							$improvementsBuildings->setLandPin($this->formArray["landPin"]);
							$improvementsBuildings->setFoundation($this->formArray["foundation"]);
							$improvementsBuildings->setColumnsBldg($this->formArray["columnsBldg"]);
							$improvementsBuildings->setBeams($this->formArray["beams"]);
							$improvementsBuildings->setTrussFraming($this->formArray["trussFraming"]);
							$improvementsBuildings->setRoof($this->formArray["roof"]);
							$improvementsBuildings->setExteriorWalls($this->formArray["exteriorWalls"]);
							$improvementsBuildings->setFlooring($this->formArray["flooring"]);
							$improvementsBuildings->setDoors($this->formArray["doors"]);
							$improvementsBuildings->setCeiling($this->formArray["ceiling"]);
							$improvementsBuildings->setStructuralTypes($this->formArray["structuralTypes"]);
							$improvementsBuildings->setBuildingClassification($this->formArray["buildingClassification"]);
							$improvementsBuildings->setBuildingPermit($this->formArray["buildingPermit"]);
							$improvementsBuildings->setBuildingAge($this->formArray["buildingAge"]);
							$improvementsBuildings->setCctNumber($this->formArray["cctNumber"]);
							$improvementsBuildings->setNumberOfStoreys($this->formArray["numberOfStoreys"]);
							$improvementsBuildings->setWindows($this->formArray["windows"]);
							$improvementsBuildings->setStairs($this->formArray["stairs"]);
							$improvementsBuildings->setPartition($this->formArray["partition"]);
							$improvementsBuildings->setWallFinish($this->formArray["wallFinish"]);
							$improvementsBuildings->setElectrical($this->formArray["electrical"]);
							$improvementsBuildings->setToiletAndBath($this->formArray["toiletAndBath"]);
							$improvementsBuildings->setPlumbingSewer($this->formArray["plumbingSewer"]);
							$improvementsBuildings->setFixtures($this->formArray["fixtures"]);
							$improvementsBuildings->setDateConstructed($this->formArray["dateConstructed"]);
							$improvementsBuildings->setDateOccupied($this->formArray["dateOccupied"]);
							$improvementsBuildings->setDateCompleted($this->formArray["dateCompleted"]);
							$improvementsBuildings->setAreaOfGroundFloor($this->formArray["areaOfGroundFloor"]);
							$improvementsBuildings->setTotalBuildingArea($this->formArray["totalBuildingArea"]);
							$improvementsBuildings->setUnitValue($this->formArray["unitValue"]);
							$improvementsBuildings->setBuildingCoreAndAdditionalItems($this->formArray["buildingCoreAndAdditionalItems"]);
							$improvementsBuildings->setAddItems($this->formArray["addItems"]);
							$improvementsBuildings->setDepreciationRate($this->formArray["depreciationRate"]);
							$improvementsBuildings->setAccumulatedDepreciation($this->formArray["accumulatedDepreciation"]);
							$improvementsBuildings->setDepreciatedMarketValue($this->formArray["depreciatedMarketValue"]);

							$improvementsBuildings->setCreatedBy($this->userID);
							$improvementsBuildings->setModifiedBy($this->userID);

							$improvementsBuildings->setDomDocument();

							$doc = $improvementsBuildings->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);

							//echo $xmlStr;

							$ret = $ImprovementsBuildingsEncode->updateImprovementsBuildings($xmlStr);
							if (!$ret = $ImprovementsBuildingsEncode->updateImprovementsBuildings($xmlStr)){
								exit("error update".$ret);
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

					$improvementsBuildings = new ImprovementsBuildings;
					$improvementsBuildings->parseDomDocument($domDoc);
					//$improvementsBuildings->setPropertyID($this->formArray["propertyID"]);
					$improvementsBuildings->setAfsID($this->formArray["afsID"]);
					$improvementsBuildings->setArpNumber($this->formArray["arpNumber"]);
					$improvementsBuildings->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
					$improvementsBuildings->setPropertyAdministrator($propertyAdministrator);
					$improvementsBuildings->setVerifiedBy($this->formArray["verifiedByID"]);
					$improvementsBuildings->setPlottingsBy($this->formArray["plottingsByID"]);
					$improvementsBuildings->setNotedBy($this->formArray["notedByID"]);
					$improvementsBuildings->setMarketValue($this->formArray["marketValue"]);
					$improvementsBuildings->setKind($this->formArray["kind"]);
					$improvementsBuildings->setActualUse($this->formArray["actualUse"]);
					$improvementsBuildings->setAdjustedMarketValue($this->formArray["adjustedMarketValue"]);
					$improvementsBuildings->setAssessmentLevel($this->formArray["assessmentLevel"]);
					$improvementsBuildings->setAssessedValue($this->formArray["assessedValue"]);
					$improvementsBuildings->setPreviousOwner($this->formArray["previousOwner"]);
					$improvementsBuildings->setPreviousAssessedValue($this->formArray["previousAssessedValue"]);
					$improvementsBuildings->setTaxability($this->formArray["taxability"]);
					$improvementsBuildings->setEffectivity($this->formArray["effectivity"]);
					$improvementsBuildings->setAppraisedBy($this->formArray["appraisedByID"]);
					$improvementsBuildings->setAppraisedByDate($this->formArray["appraisedByDate"]);
					$improvementsBuildings->setRecommendingApproval($this->formArray["recommendingApprovalID"]);
					$improvementsBuildings->setRecommendingApprovalDate($this->formArray["recommendingApprovalDate"]);
					$improvementsBuildings->setApprovedBy($this->formArray["approvedByID"]);
					$improvementsBuildings->setApprovedByDate($this->formArray["approvedByDate"]);
					$improvementsBuildings->setMemoranda($this->formArray["memoranda"]);
					$improvementsBuildings->setPostingDate($this->formArray["postingDate"]);
					
					$improvementsBuildings->setLandPin($this->formArray["landPin"]);
					$improvementsBuildings->setFoundation($this->formArray["foundation"]);
					$improvementsBuildings->setColumnsBldg($this->formArray["columnsBldg"]);
					$improvementsBuildings->setBeams($this->formArray["beams"]);
					$improvementsBuildings->setTrussFraming($this->formArray["trussFraming"]);
					$improvementsBuildings->setRoof($this->formArray["roof"]);
					$improvementsBuildings->setExteriorWalls($this->formArray["exteriorWalls"]);
					$improvementsBuildings->setFlooring($this->formArray["flooring"]);
					$improvementsBuildings->setDoors($this->formArray["doors"]);
					$improvementsBuildings->setCeiling($this->formArray["ceiling"]);
					$improvementsBuildings->setStructuralTypes($this->formArray["structuralTypes"]);
					$improvementsBuildings->setBuildingClassification($this->formArray["buildingClassification"]);
					$improvementsBuildings->setBuildingPermit($this->formArray["buildingPermit"]);
					$improvementsBuildings->setBuildingAge($this->formArray["buildingAge"]);
					$improvementsBuildings->setCctNumber($this->formArray["cctNumber"]);
					$improvementsBuildings->setNumberOfStoreys($this->formArray["numberOfStoreys"]);
					$improvementsBuildings->setWindows($this->formArray["windows"]);
					$improvementsBuildings->setStairs($this->formArray["stairs"]);
					$improvementsBuildings->setPartition($this->formArray["partition"]);
					$improvementsBuildings->setWallFinish($this->formArray["wallFinish"]);
					$improvementsBuildings->setElectrical($this->formArray["electrical"]);
					$improvementsBuildings->setToiletAndBath($this->formArray["toiletAndBath"]);
					$improvementsBuildings->setPlumbingSewer($this->formArray["plumbingSewer"]);
					$improvementsBuildings->setFixtures($this->formArray["fixtures"]);
					$improvementsBuildings->setDateConstructed($this->formArray["dateConstructed"]);
					$improvementsBuildings->setDateOccupied($this->formArray["dateOccupied"]);
					$improvementsBuildings->setDateCompleted($this->formArray["dateCompleted"]);
					$improvementsBuildings->setAreaOfGroundFloor($this->formArray["areaOfGroundFloor"]);
					$improvementsBuildings->setTotalBuildingArea($this->formArray["totalBuildingArea"]);
					$improvementsBuildings->setUnitValue($this->formArray["unitValue"]);
					$improvementsBuildings->setBuildingCoreAndAdditionalItems($this->formArray["buildingCoreAndAdditionalItems"]);
					$improvementsBuildings->setAddItems($this->formArray["addItems"]);
					$improvementsBuildings->setDepreciationRate($this->formArray["depreciationRate"]);
					$improvementsBuildings->setAccumulatedDepreciation($this->formArray["accumulatedDepreciation"]);
					$improvementsBuildings->setDepreciatedMarketValue($this->formArray["depreciatedMarketValue"]);

					$improvementsBuildings->setCreatedBy($this->userID);
					$improvementsBuildings->setModifiedBy($this->userID);
					
					$improvementsBuildings->setDomDocument();

					$doc = $improvementsBuildings->getDomDocument();
					$xmlStr =  $doc->dump_mem(true);
					//echo $xmlStr;
					
					$xmlStr =  $doc->dump_mem(true);
					if (!$ret = $ImprovementsBuildingsEncode->saveImprovementsBuildings($xmlStr)){
						echo("ret=".$ret);
					}
				}
				$this->formArray["propertyID"] = $ret;
				header("location: ImprovementsBuildingsClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
				exit();
				break;
			case "cancel":
				header("location: ImprovementsBuildingsList.php";
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
					$ImprovementsBuildingsDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsDetails.php", 	"urn:Object");
					if (!$xmlStr = 	$ImprovementsBuildingsDetails->getImprovementsBuildings($firstPropertyID)){
						echo ("xml failed");
					}
					else{
						//echo $xmlStr;
						if(!$domDoc = domxml_open_mem($xmlStr)) {
							$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
							$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
						}
						else {
							$improvementsBuildings = new ImprovementsBuildings;
							$improvementsBuildings->parseDomDocument($domDoc);
							foreach($improvementsBuildings as $key => $value){
								switch ($key){
									case "propertyID":
										$this->formArray["propertyID"] = "";
										break;

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
											$this->formArray["addressID"] = 	$value->addressArray[0]->getAddressID();
											$this->formArray["number"] = $value->addressArray[0]->getNumber();
											$this->formArray["street"] = $value->addressArray[0]->getStreet();
											$this->formArray["barangay"] = $value->addressArray[0]->getBarangay();
											$this->formArray["district"] = $value->addressArray[0]->getDistrict();
											$this->formArray["municipalityCity"] = 	$value->addressArray[0]->getMunicipalityCity();
											$this->formArray["province"] = $value->addressArray[0]->getProvince();
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
										break;
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
									case "dateConstructed":
										if (true){
											list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = 	explode("-",$value);
											$this->formArray["dc_year"] = removePreZero($dateArr["year"]);
											$this->formArray["dc_month"] = removePreZero($dateArr["month"]);
											$this->formArray["dc_day"] = removePreZero($dateArr["day"]);
										}
										else {
											$this->formArray[$key] = "";
										}
									break;
									case "dateOccupied":
										if (true){
											list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
											$this->formArray["do_year"] = removePreZero($dateArr["year"]);
											$this->formArray["do_month"] = removePreZero($dateArr["month"]);
											$this->formArray["do_day"] = removePreZero($dateArr["day"]);
										}
										else {
											$this->formArray[$key] = "";
										}
									break;
									case "dateCompleted":
										if (true){
											list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
											$this->formArray["dm_year"] = removePreZero($dateArr["year"]);
											$this->formArray["dm_month"] = removePreZero($dateArr["month"]);
											$this->formArray["dm_day"] = removePreZero($dateArr["day"]);
										}
										else {
											$this->formArray[$key] = "";
										}
									break;
	

									
									case "arpNumber":
									case "propertyIndexNumber":
									case "propertyAdministrator":
									case "personID":
									case "lastName":
									case "firstName":
									case "middleName":
									case "gender":
									case "birth_month":
									case "birth_day":
									case "birth_year":
									case "maritalStatus":
									case "tin":
									case "addressID":
									case "number":
									case "street":
									case "barangay":
									case "district":
									case "municipalityCity":
									case "province":
									case "telephone":
									case "mobileNumber":
									case "email":
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
			
									case "landPin":
									case "foundation":
									case "columnsBldg":
									case "beams":
									case "trussFraming":
									case "roof":
									case "exteriorWalls":
									case "flooring":
									case "doors":
									case "ceiling":
									case "structuralTypes":
									case "buildingClassification":
									case "buildingPermit":
									case "buildingAge":
									case "cctNumber":
									case "numberOfStoreys":
									case "windows":
									case "stairs":
									case "partition":
									case "wallFinish":
									case "electrical":
									case "toiletAndBath":
									case "plumbingSewer":
									case "fixtures":
									case "dateConstructed":
									case "dateOccupied":
									case "dateCompleted":
									case "areaOfGroundFloor":
									case "totalBuildingArea":
									case "unitValue":
									case "buildingCoreAndAdditionalItems":
									case "addItems":
									case "depreciationRate":
									case "accumulatedDepreciation":
									case "depreciatedMarketValue":
			
									case "as_month":
									case "as_day":
									case "as_year":
									case "re_month":
									case "re_day":
									case "re_year":
									case "av_month":
									case "av_day":
									case "av_year":
									case "dc_month":
									case "dc_day":
									case "dc_year":
									case "do_month":
									case "do_day":
									case "do_year":
									case "dm_month":
									case "dm_day":
									case "dm_year":

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
$improvementsBuildingsEncode = new ImprovementsBuildingsEncode($HTTP_POST_VARS,$afsID,$type,$propertyID,$formAction,$sess);
$improvementsBuildingsEncode->Main();
?>
<?php page_close(); ?>
