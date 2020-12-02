<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";

include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/User.php";
include_once "../includes/assessor/UserRecords.php";

include_once "../includes/assessor/eRPTSSettings.php";

include_once "../includes/assessor/PlantsTrees.php";
include_once "../includes/assessor/PlantsTreesRecords.php";

include_once "../includes/assessor/PlantsTreesClasses.php";
include_once "../includes/assessor/PlantsTreesClassesRecords.php";
include_once "../includes/assessor/PlantsTreesActualUses.php";
include_once "../includes/assessor/PlantsTreesActualUsesRecords.php";



#####################################
# Define Interface Class
#####################################
class PlantsTreesEncode{
	
	var $tpl;
	var $formArray;
	var $plantsTrees;
	
	function PlantsTreesEncode($http_post_vars,$afsID="",$propertyID="",$formAction="",$sess){
		global $auth;

		$this->sess = $sess;
		$this->userID = $auth->auth["uid"];

		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PlantsTreesEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode PlantsTrees");
		
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
			, "surveyNumber" => ""
			, "productClass" => ""
			, "areaPlanted" => ""
			, "totalNumber" => 0
			, "nonFruitBearing" => 0
			, "fruitBearing" => 0
			, "age" => ""
			, "unitPrice" => ""
			, "adjustmentFactor" => ""
			, "percentAdjustment" => ""
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
			, "formAction" => $formAction
		);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
		
		$this->formArray["plantsTreesClasses"] = $this->formArray["productClass"];
		$this->formArray["plantsTreesActualUses"] = $this->formArray["actualUse"];
		
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
			        case "plantsTreesClasses":
			           $tempVarRecords = new PlantsTreesClassesRecords;
                		   $tempVarID = "getPlantsTreesClassesID";
				   $this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
			        break;
			        case "plantsTreesActualUses":
			           $tempVarRecords = new PlantsTreesActualUsesRecords;
			           $tempVarID = "getPlantsTreesActualUsesID";
				   $this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
                    		break;
			    }
			
   			    $tempVarRecords->parseDomDocument($domDoc);
			    $list = $tempVarRecords->getArrayList();
			    $i=0;
			    $j=0;
			    foreach ($list as $key => $value){
          			$this->tpl->set_var($tempVar."ID", $value->$tempVarID());
               			$this->tpl->set_var($tempVar, $value->getDescription());
			        $this->initSelected($tempVar,$value->$tempVarID());
			        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
				
				switch($tempVar){
					case "plantsTreesClasses":
						$this->tpl->set_var("i", $i);
						$this->tpl->set_var("plantsTreesClassesID", $value->getPlantsTreesClassesID());
						$this->tpl->set_var("code", addslashes($value->getCode()));
						$this->tpl->set_var("description", addslashes($value->getDescription()));
						$this->tpl->set_var("value", addslashes($value->getValue()));
						$this->tpl->parse("JS".$TempVar."ListBlock", "JS".$TempVar."List", true);
						$i++;
						
						if($plantsTreesClasses_selected==""){
							if($this->formArray["plantsTreesClasses"]==$value->$tempVarID()){
								$recommendedUnitPrice = $value->getValue();
								$plantsTreesClasses = $value->getDescription();
								$plantsTreesClasses_selected = true;
							}
						}
						
						$this->tpl->set_var("recommendedUnitPrice", addslashes($recommendedUnitPrice));
						$this->tpl->set_var("plantsTreesClasses", addslashes($plantsTreesClasses));
						
						break;
					case "plantsTreesActualUses":
						$this->tpl->set_var("i", $j);
						$this->tpl->set_var("plantsTreesActualUsesID", $value->getPlantsTreesActualUsesID());
						$this->tpl->set_var("code", addslashes($value->getCode()));
						$this->tpl->set_var("description", addslashes($value->getDescription()));
						$this->tpl->set_var("value", addslashes($value->getValue()));
						$this->tpl->parse("JS".$TempVar."ListBlock", "JS".$TempVar."List", true);
						$j++;
						
						if($plantsTreesActualUses_selected==""){
							if($this->formArray["plantsTreesActualUses"]==$value->$tempVarID()){
								$recommendedAssessmentLevel = $value->getValue();
								$plantsTreesActualUses = $value->getDescription();
								$plantsTreesActualUses_selected = true;
							}
						}

						$this->tpl->set_var("recommendedAssessmentLevel", addslashes($recommendedAssessmentLevel));
						$this->tpl->set_var("plantsTreesActualUses", addslashes($plantsTreesActualUses));


						break;						
				}
			    }
			}
		}
	
	}

	function initMasterSignatoryList($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php", "urn:Object");
		if(!$xmlStr = $eRPTSSettingsDetails->getERPTSSettingsDetails(1)){
			echo "xml failed";
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				echo "xml failed";
			}
			else{
				$eRPTSSettings = new eRPTSSettings;
				$eRPTSSettings->parseDomDocument($domDoc);
				switch($tempVar){
					case "recommendingApproval":
					case "approvedBy":
						$this->formArray["recommendingApprovalID"] = $this->formArray["recommendingApproval"];
						$this->formArray["approvedByID"] = $this->formArray["approvedBy"];
						$this->tpl->set_var("id",$eRPTSSettings->getAssessorFullName());
						$this->tpl->set_var("name",$eRPTSSettings->getAssessorFullName());
						$this->initSelected($tempVar."ID",$eRPTSSettings->getAssessorFullName());
						$this->tpl->parse($TempVar."ListBlock",$TempVar."List",true);
						
						// provincialAssessor
						if($eRPTSSettings->getProvincialAssessorLastName()!=""){
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

		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
        if (!$xmlStr = $UserList->getUserList(0, " WHERE (userType='Signatory' OR userType='Assessor') AND status='enabled'")){
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
		$PlantsTreesList = new SoapObject(NCCBIZ."PlantsTreesList.php", "urn:Object");
		if(!$xmlStr = $PlantsTreesList->getPlantsTreesList($this->formArray["afsID"])){
			return false;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				return false;
			}
			else{
				$plantsTreesRecords = new PlantsTreesRecords;
				$plantsTreesRecords->parseDomDocument($domDoc);
				$list = $plantsTreesRecords->getArrayList();
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
		//$this->setDateDropDown("da_");
		//$this->setDateDropDown("di_");
		//$this->setDateDropDown("do_");
		$this->setDateDropDown("as_");
		$this->setDateDropDown("re_");
		$this->setDateDropDown("av_");

        $this->formArray["plantsTreesClasses"] = $this->formArray["productClass"];
        $this->formArray["plantsTreesActualUses"] = $this->formArray["actualUse"];
        // plantsTreesClasses Listbox	
        $this->initMasterPropertyList("PlantsTreesClasses", "plantsTreesClasses");
        // plantsTreesActualUses Listbox	
        $this->initMasterPropertyList("PlantsTreesActualUses", "plantsTreesActualUses");

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

	function Main(){
		switch ($this->formArray["formAction"]){
			case "edit":
				$PlantsTreesDetails = new SoapObject(NCCBIZ."PlantsTreesDetails.php", "urn:Object");
				if (!$xmlStr = $PlantsTreesDetails->getPlantsTrees($this->formArray["propertyID"])){
					echo ("xml failed");
				}
				else{
					//echo $xmlStr;
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
						$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
					}
					else {
						$plantsTrees = new PlantsTrees;
						$plantsTrees->parseDomDocument($domDoc);
						foreach($plantsTrees as $key => $value){
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
										$this->formArray["addressID"] = $value->addressArray[0]->getAddressID();
										$this->formArray["number"] = $value->addressArray[0]->getNumber();
										$this->formArray["street"] = $value->addressArray[0]->getStreet();
										$this->formArray["barangay"] = $value->addressArray[0]->getBarangay();
										$this->formArray["district"] = $value->addressArray[0]->getDistrict();
										$this->formArray["municipalityCity"] = $value->addressArray[0]->getMunicipalityCity();
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
								case "dateAcquired":
									if (true){
										list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
										$this->formArray["da_year"] = removePreZero($dateArr["year"]);
										$this->formArray["da_month"] = removePreZero($dateArr["month"]);
										$this->formArray["da_day"] = removePreZero($dateArr["day"]);
									}
									else {
										$this->formArray[$key] = "";
									}
								break;
								case "dateOfInstallation":
									if (true){
										list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
										$this->formArray["di_year"] = removePreZero($dateArr["year"]);
										$this->formArray["di_month"] = removePreZero($dateArr["month"]);
										$this->formArray["di_day"] = removePreZero($dateArr["day"]);
									}
									else {
										$this->formArray[$key] = "";
									}
								break;
								case "dateOfOperation":
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
								default:
									$this->formArray[$key] = $value;
							}
						}
					}
				}
				break;
			case "save":
				$PlantsTreesEncode = new SoapObject(NCCBIZ."PlantsTreesEncode.php", "urn:Object");
				if ($this->formArray["propertyID"] <> ""){
					$PlantsTreesDetails = new SoapObject(NCCBIZ."PlantsTreesDetails.php", "urn:Object");
					if (!$xmlStr = $PlantsTreesDetails->getPlantsTrees($this->formArray["propertyID"])){
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

							$plantsTrees = new PlantsTrees;
							$plantsTrees->parseDomDocument($domDoc);
							$plantsTrees->setPropertyID($this->formArray["propertyID"]);
							$plantsTrees->setAfsID($this->formArray["afsID"]);
							$plantsTrees->setArpNumber($this->formArray["arpNumber"]);
							$plantsTrees->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
							$plantsTrees->setPropertyAdministrator($propertyAdministrator);
							$plantsTrees->setVerifiedBy($this->formArray["verifiedByID"]);
							$plantsTrees->setPlottingsBy($this->formArray["plottingsByID"]);
							$plantsTrees->setNotedBy($this->formArray["notedByID"]);
							$plantsTrees->setMarketValue($this->formArray["marketValue"]);
							$plantsTrees->setKind($this->formArray["kind"]);
							$plantsTrees->setActualUse($this->formArray["actualUse"]);
							$plantsTrees->setAdjustedMarketValue($this->formArray["adjustedMarketValue"]);
							$plantsTrees->setAssessmentLevel($this->formArray["assessmentLevel"]);
							$plantsTrees->setAssessedValue($this->formArray["assessedValue"]);
							$plantsTrees->setPreviousOwner($this->formArray["previousOwner"]);
							$plantsTrees->setPreviousAssessedValue($this->formArray["previousAssessedValue"]);
							$plantsTrees->setTaxability($this->formArray["taxability"]);
							$plantsTrees->setEffectivity($this->formArray["effectivity"]);
							$plantsTrees->setAppraisedBy($this->formArray["appraisedByID"]);
							$plantsTrees->setAppraisedByDate($this->formArray["appraisedByDate"]);
							$plantsTrees->setRecommendingApproval($this->formArray["recommendingApprovalID"]);
							$plantsTrees->setRecommendingApprovalDate($this->formArray["recommendingApprovalDate"]);
							$plantsTrees->setApprovedBy($this->formArray["approvedByID"]);
							$plantsTrees->setApprovedByDate($this->formArray["approvedByDate"]);
							$plantsTrees->setMemoranda($this->formArray["memoranda"]);
							$plantsTrees->setPostingDate($this->formArray["postingDate"]);
							
							$plantsTrees->setLandPin($this->formArray["landPin"]);
							$plantsTrees->setSurveyNumber($this->formArray["surveyNumber"]);
							$plantsTrees->setProductClass($this->formArray["productClass"]);
							$plantsTrees->setAreaPlanted($this->formArray["areaPlanted"]);
							$plantsTrees->setTotalNumber($this->formArray["totalNumber"]);
							$plantsTrees->setNonFruitBearing($this->formArray["nonFruitBearing"]);
							$plantsTrees->setFruitBearing($this->formArray["fruitBearing"]);
							$plantsTrees->setAge($this->formArray["age"]);
							$plantsTrees->setUnitPrice($this->formArray["unitPrice"]);
							$plantsTrees->setAdjustmentFactor($this->formArray["adjustmentFactor"]);
							$plantsTrees->setPercentAdjustment($this->formArray["percentAdjustment"]);
							$plantsTrees->setValueAdjustment($this->formArray["valueAdjustment"]);

							$plantsTrees->setCreatedBy($this->userID);
							$plantsTrees->setModifiedBy($this->userID);

							$plantsTrees->setDomDocument();

							$doc = $plantsTrees->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							//echo $xmlStr;
							if (!$ret = $PlantsTreesEncode->updatePlantsTrees($xmlStr)){
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

					$plantsTrees = new PlantsTrees;
					$plantsTrees->parseDomDocument($domDoc);
					//$plantsTrees->setPropertyID($this->formArray["propertyID"]);
					$plantsTrees->setAfsID($this->formArray["afsID"]);
					$plantsTrees->setArpNumber($this->formArray["arpNumber"]);
					$plantsTrees->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
					$plantsTrees->setPropertyAdministrator($propertyAdministrator);
					$plantsTrees->setVerifiedBy($this->formArray["verifiedByID"]);
					$plantsTrees->setPlottingsBy($this->formArray["plottingsByID"]);
					$plantsTrees->setNotedBy($this->formArray["notedByID"]);
					$plantsTrees->setMarketValue($this->formArray["marketValue"]);
					$plantsTrees->setKind($this->formArray["kind"]);
					$plantsTrees->setActualUse($this->formArray["actualUse"]);
					$plantsTrees->setAdjustedMarketValue($this->formArray["adjustedMarketValue"]);
					$plantsTrees->setAssessmentLevel($this->formArray["assessmentLevel"]);
					$plantsTrees->setAssessedValue($this->formArray["assessedValue"]);
					$plantsTrees->setPreviousOwner($this->formArray["previousOwner"]);
					$plantsTrees->setPreviousAssessedValue($this->formArray["previousAssessedValue"]);
					$plantsTrees->setTaxability($this->formArray["taxability"]);
					$plantsTrees->setEffectivity($this->formArray["effectivity"]);
					$plantsTrees->setAppraisedBy($this->formArray["appraisedByID"]);
					$plantsTrees->setAppraisedByDate($this->formArray["appraisedByDate"]);
					$plantsTrees->setRecommendingApproval($this->formArray["recommendingApprovalID"]);
					$plantsTrees->setRecommendingApprovalDate($this->formArray["recommendingApprovalDate"]);
					$plantsTrees->setApprovedBy($this->formArray["approvedByID"]);
					$plantsTrees->setApprovedByDate($this->formArray["approvedByDate"]);
					$plantsTrees->setMemoranda($this->formArray["memoranda"]);
					$plantsTrees->setPostingDate($this->formArray["postingDate"]);

					$plantsTrees->setLandPin($this->formArray["landPin"]);
					$plantsTrees->setSurveyNumber($this->formArray["surveyNumber"]);
					$plantsTrees->setProductClass($this->formArray["productClass"]);
					$plantsTrees->setAreaPlanted($this->formArray["areaPlanted"]);
					$plantsTrees->setTotalNumber($this->formArray["totalNumber"]);
					$plantsTrees->setNonFruitBearing($this->formArray["nonFruitBearing"]);
					$plantsTrees->setFruitBearing($this->formArray["fruitBearing"]);
					$plantsTrees->setAge($this->formArray["age"]);
					$plantsTrees->setUnitPrice($this->formArray["unitPrice"]);
					$plantsTrees->setAdjustmentFactor($this->formArray["adjustmentFactor"]);
					$plantsTrees->setPercentAdjustment($this->formArray["percentAdjustment"]);
					$plantsTrees->setValueAdjustment($this->formArray["valueAdjustment"]);

					$plantsTrees->setCreatedBy($this->userID);
					$plantsTrees->setModifiedBy($this->userID);

					$plantsTrees->setDomDocument();

					$doc = $plantsTrees->getDomDocument();
					$xmlStr =  $doc->dump_mem(true);
					//exit($xmlStr);
					
					if (!$ret = $PlantsTreesEncode->savePlantsTrees($xmlStr)){
						echo("ret=".$ret);
					}
				}
				$this->formArray["propertyID"] = $ret;
				header("location: PlantsTreesClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
				exit();
				break;
			case "cancel":
				header("location: PlantsTreesList.php";
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
					$PlantsTreesDetails = new SoapObject(NCCBIZ."PlantsTreesDetails.php", "urn:Object");
					if (!$xmlStr = $PlantsTreesDetails->getPlantsTrees($firstPropertyID)){
						echo ("xml failed");
					}
					else{
						//echo $xmlStr;
						if(!$domDoc = domxml_open_mem($xmlStr)) {
							$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
							$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
						}
						else {
							$plantsTrees = new PlantsTrees;
							$plantsTrees->parseDomDocument($domDoc);
							foreach($plantsTrees as $key => $value){
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
									case "dateAcquired":
										if (true){
											list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = 	explode("-",$value);
											$this->formArray["da_year"] = removePreZero($dateArr["year"]);
											$this->formArray["da_month"] = removePreZero($dateArr["month"]);
											$this->formArray["da_day"] = removePreZero($dateArr["day"]);
										}
										else {
											$this->formArray[$key] = "";
										}
									break;
									case "dateOfInstallation":
										if (true){
											list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = 	explode("-",$value);
											$this->formArray["di_year"] = removePreZero($dateArr["year"]);
											$this->formArray["di_month"] = removePreZero($dateArr["month"]);
											$this->formArray["di_day"] = removePreZero($dateArr["day"]);
										}
										else {
											$this->formArray[$key] = "";
										}
									break;
									case "dateOfOperation":
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
									case "landPin":
									case "surveyNumber":
									case "productClass":
									case "areaPlanted":
									case "totalNumber":
									case "nonFruitBearing":
									case "fruitBearing":
									case "age":
									case "unitPrice":
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
$plantsTreesEncode = new PlantsTreesEncode($HTTP_POST_VARS,$afsID,$propertyID,$formAction,$sess);
$plantsTreesEncode->Main();
?>
<?php page_close(); ?>
