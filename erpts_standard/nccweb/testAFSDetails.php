<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/LocationAddress.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/TD.php";

#####################################
# Define Interface Class
#####################################
class AFSDetails{
	
	var $tpl;
	var $formArray;
	
	function AFSDetails($http_post_vars,$sess,$afsID){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "AFSDetails.htm") ;
		$this->tpl->set_var("TITLE", "Owner List");
		
		$this->formArray["afsID"] = $afsID;
		$this->formArray["landFormAction"] = "";
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
		$this->formArray["totalMarketValue"] = 0;
		$this->formArray["totalAssessedValue"] = 0;
	}
	
	function initCheckBox($checkboxName){
		$checked = "checked";
		if (!$this->formArray[$checkboxName]) $checked = "";
		$this->tpl->set_var($checkboxName, $checked);
	}
	
	function setForm(){
		$this->formArray["landTotalMarketValue"] = number_format($this->formArray["landTotalMarketValue"], 2, '.', ',');
		$this->formArray["plantTotalMarketValue"] = number_format($this->formArray["plantTotalMarketValue"], 2, '.', ',');
		$this->formArray["bldgTotalMarketValue"] = number_format($this->formArray["bldgTotalMarketValue"], 2, '.', ',');
		$this->formArray["machTotalMarketValue"] = number_format($this->formArray["machTotalMarketValue"], 2, '.', ',');
		$this->formArray["landTotalAssessedValue"] = number_format($this->formArray["landTotalAssessedValue"], 2, '.', ',');
		$this->formArray["plantTotalAssessedValue"] = number_format($this->formArray["plantTotalAssessedValue"], 2, '.', ',');
		$this->formArray["bldgTotalAssessedValue"] = number_format($this->formArray["bldgTotalAssessedValue"], 2, '.', ',');
		$this->formArray["machTotalAssessedValue"] = number_format($this->formArray["machTotalAssessedValue"], 2, '.', ',');
		$this->formArray["totalMarketValue"] = number_format($this->formArray["totalMarketValue"], 2, '.', ',');
		$this->formArray["totalAssessedValue"] = number_format($this->formArray["totalAssessedValue"], 2, '.', ',');
		foreach ($this->formArray as $key => $value){
			if ($key == "totalMarketValue" || $key == "totalAssessedValue"){
				$this->tpl->set_var($key, $value);
			}
			else $this->tpl->set_var($key, $value);
		}
		$checked = "checked";
		$this->initCheckBox("affidavitOfOwnership");
		$this->initCheckBox("barangayCertificate");
		$this->initCheckBox("landTagging");
	}
	
	function displayOwnerList($domDoc){
		$ownerRecords = new OwnerRecords;
		$ownerRecords->parseDomDocument($domDoc);
		$list = $ownerRecords->getArrayList();
		foreach ($list as $key => $value){
			if (count($value->personArray)){
				$this->tpl->set_block("rptsTemplate", "OwnerDBEmpty", "OwnerDBEmptyBlock");
				$this->tpl->set_var("OwnerDBEmptyBlock", "");
				$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
				foreach($value->personArray as $personKey =>$personValue){
					$this->tpl->set_var("personID", $personValue->getPersonID());
					if (!$pname = $personValue->getFullName()){
						$pname = "none";
					}
					$this->tpl->set_var("fullName", $pname);
					$pAddress = ($personValue->addressArray) ?$personValue->addressArray[0]->getFullAddress() : "";
					$this->tpl->set_var("address", $pAddress);
					$this->tpl->set_var("telephone", $personValue->getTelephone());
					$this->tpl->parse("PersonListBlock", "PersonList", true);
				}
			}
			else{
				$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
				$this->tpl->set_var("PersonListBlock", "");
			}
			if (count($value->companyArray)){
				$this->tpl->set_block("rptsTemplate", "OwnerDBEmpty", "OwnerDBEmptyBlock");
				$this->tpl->set_var("OwnerDBEmptyBlock", "");
				$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
				foreach ($value->companyArray as $companyKey => $companyValue){
					$this->tpl->set_var("companyID", $companyValue->getCompanyID());
					if (!$cname = $companyValue->getCompanyName()){
						$cname = "none";
					}
					$this->tpl->set_var("companyName", $cname);
					$cAddress = ($companyValue->addressArray) ?$companyValue->addressArray[0]->getFullAddress() : "";	
					$this->tpl->set_var("address", $cAddress);
					$this->tpl->set_var("telephone", $companyValue->getTelephone());
					$this->tpl->parse("CompanyListBlock", "CompanyList", true);
				}
			}
			else{
				$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
				$this->tpl->set_var("CompanyListBlock", "");	
			}
			//if (!count($value->companyArray)&&count($value->personArray)){
			//	$this->tpl->set_block("rptsTemplate", "OwnerDBEmpty", "OwnerDBEmptyBlock");
			//	$this->tpl->set_var("OwnerDBEmptyBlock", "");
			//}
		}
	}
	
	function displayDetails($value){
        foreach($value as $lkey => $lvalue){
			switch ($lkey){
				case "propertyAdministrator":
					if (is_a($lvalue,Person)){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue->getBirthday());
						$this->tpl->set_var("personID", $lvalue->getPersonID());
						$this->tpl->set_var("lastName", $lvalue->getLastName());
						$this->tpl->set_var("firstName", $lvalue->getFirstName());
						$this->tpl->set_var("middleName", $lvalue->getMiddleName());
						$this->tpl->set_var("gender", $lvalue->getGender());
						$this->tpl->set_var("birth_year", removePreZero($dateArr["year"]));
						$this->tpl->set_var("birth_month", removePreZero($dateArr["month"]));
						$this->tpl->set_var("birth_day", removePreZero($dateArr["day"]));
						$this->tpl->set_var("maritalStatus", $lvalue->getMaritalStatus());
						$this->tpl->set_var("tin", $lvalue->getTin());
						if (is_a($lvalue->addressArray[0],"address")){
						$this->tpl->set_var("addressID", $lvalue->addressArray[0]->getAddressID());
						$this->tpl->set_var("number", $lvalue->addressArray[0]->getNumber());
						$this->tpl->set_var("street", $lvalue->addressArray[0]->getStreet());
						$this->tpl->set_var("barangay", $lvalue->addressArray[0]->getBarangay());
						$this->tpl->set_var("district", $lvalue->addressArray[0]->getDistrict());
						$this->tpl->set_var("municipalityCity", $lvalue->addressArray[0]->getMunicipalityCity());
						$this->tpl->set_var("province", $lvalue->addressArray[0]->getProvince());
						}
						$this->tpl->set_var("telephone", $lvalue->getTelephone());
						$this->tpl->set_var("mobileNumber", $lvalue->getMobileNumber());
						$this->tpl->set_var("email", $lvalue->getEmail());
					}
					else {
						$this->tpl->set_var($lkey, "");
					}
				break;
				case "verifiedBy":
					if (is_a($lvalue,Assessor)){
						$this->tpl->set_var("verifiedByID", $lvalue->getAssessorID());
						$this->tpl->set_var("verifiedByName", $lvalue->getFullName());
					}
					else {
						$this->tpl->set_var("verifiedByID", "");
						$this->tpl->set_var("verifiedByName", "");
					}
				break;
				case "plottingsBy":
					if (is_a($lvalue,Assessor)){
						$this->tpl->set_var("plottingsByID", $lvalue->getAssessorID());
						$this->tpl->set_var("plottingsByName", $lvalue->getFullName());
					}
					else {
						$this->tpl->set_var("plottingsByID", "");
						$this->tpl->set_var("plottingsByName", "");
					}
				break;
				case "notedBy":
					if (is_a($lvalue,Assessor)){
						$this->tpl->set_var("notedByID", $lvalue->getAssessorID());
						$this->tpl->set_var("notedByName", $lvalue->getFullName());
					}
					else {
						$this->tpl->set_var("notedByID", "");
						$this->tpl->set_var("notedByName", "");
					}
				break;
				case "appraisedBy":
					if (is_a($lvalue,Assessor)){
						$this->tpl->set_var("appraisedByID", $lvalue->getAssessorID());
						$this->tpl->set_var("appraisedByName", $lvalue->getFullName());
					}
					else {
						$this->tpl->set_var("appraisedByID", "");
						$this->tpl->set_var("appraisedByName", "");
					}
				break;
				case "appraisedByDate":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("as_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("as_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("as_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->tpl->set_var("as_yearValue", "");
						$this->tpl->set_var("as_month", "");
						$this->tpl->set_var("as_dayValue", "");
					}
				break;
				case "recommendingApproval":
					if (is_a($lvalue,Assessor)){
						$this->tpl->set_var("recommendingApprovalID", $lvalue->getAssessorID());
						$this->tpl->set_var("recommendingApprovalName", $lvalue->getFullName());
					}
					else {
						$this->tpl->set_var("recommendingApprovalID", "");
						$this->tpl->set_var("recommendingApprovalName", "");
					}
				break;
				case "recommendingApprovalDate":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("re_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("re_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("re_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->tpl->set_var("re_yearValue", "");
						$this->tpl->set_var("re_month", "");
						$this->tpl->set_var("re_dayValue", "");
					}
				case "approvedBy":
					if (is_a($lvalue,Assessor)){
						$this->tpl->set_var("approvedByID", $lvalue->getAssessorID());
						$this->tpl->set_var("approvedByName", $lvalue->getFullName());
					}
					else {
						$this->tpl->set_var("approvedByID", "");
						$this->tpl->set_var("approvedByName", "");
					}
				break;
				case "approvedByDate":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("av_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("av_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("av_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->tpl->set_var("av_yearValue", "");
						$this->tpl->set_var("av_month", "");
						$this->tpl->set_var("av_dayValue", "");
				}
				break;
				case "dateConstructed":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("dc_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("dc_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("dc_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				case "dateOccupied":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("do_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("do_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("do_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				case "dateCompleted":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("dm_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("dm_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("dm_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				case "dateAcquired":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("da_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("da_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("da_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				case "dateOfInstallation":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("di_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("di_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("di_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				case "dateOfOperation":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("do_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("do_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("do_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				case "propertyID":
					if (true){
						//echo $lvalue."=>".get_class($value)."<br>";
						switch (get_class($value)){
							case "land":
								$propertyType = "Land";
							break;
							case "improvementsbuildings":
								$propertyType = "ImprovementsBuildings";
							break;
							case "plantstrees":
								$propertyType = "PlantsTrees";
							break;
							case "machineries":
								$propertyType = "Machineries";
							break;
						}
						$this->tpl->set_var($lkey,$lvalue);
						$TDDetails = new SoapObject(NCCBIZ."TDDetails.php", "urn:Object");
						if (!$xmlStr = $TDDetails->getTD("",$lvalue,$propertyType)){
							$this->tpl->set_var("tdNumber", "enter TD");
							$this->tpl->set_var("tdID", "");
							$this->tpl->set_var("propertyType", $propertyType);
						}
						else{
							//echo get_class($value);
							//echo $xmlStr;
							if(!$domDoc = domxml_open_mem($xmlStr)) {
								$this->tpl->set_var("tdNumber", "enter TD");
								$this->tpl->set_var("tdID", "");
								$this->tpl->set_var("propertyType", $propertyType);
							}
							else {
								$td = new TD;
								$td->parseDomDocument($domDoc);
								$this->tpl->set_var("tdNumber", $td->getTaxDeclarationNumber());
								foreach($td as $tdkey => $tdvalue){
									$this->tpl->set_var($tdkey, $tdvalue);
								}
							}
						}
					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				case "arpNumber":
					$lvalue = ($lvalue) ? $lvalue : "enter ARP Number";
					$this->tpl->set_var($lkey,$lvalue);
				break;
				default:
					$this->tpl->set_var($lkey,$lvalue);
			}				
		}
	}
	function displayLandList($landList){
		$this->tpl->set_block("rptsTemplate", "LandDBEmpty", "LandDBEmptyBlock");
		$this->tpl->set_var("LandDBEmptyBlock", "");
		$this->tpl->set_block("rptsTemplate", "defaultLandList", "defaultLandListBlock");
		$this->tpl->set_block("rptsTemplate", "toggleLandList", "toggleLandListBlock");
		//echo $this->formArray["totalMarketValue"];
        if (count($landList)){
			//$this->tpl->set_block("rptsTemplate", "hideLandList", "hideLandListBlock");
			$this->tpl->set_block("rptsTemplate", "LandList", "LandListBlock");
			$i = 0;
			$totalMarketValue = 0;
			$totalAssessedValue = 0;
			foreach ($landList as $key => $value){
				$totalMarketValue += tofloat($value->getMarketValue());
				$totalAssessedValue += tofloat($value->getAssessedValue());
				$this->displayDetails($value);
				$this->tpl->set_var("ctr",$i);
				$this->tpl->parse("defaultLandListBlock", "defaultLandList", true);
				$this->tpl->parse("toggleLandListBlock", "toggleLandList", true);
				//$this->tpl->parse("hideLandListBlock", "hideLandList", true);
				$this->tpl->parse("LandListBlock", "LandList", true);
				$i++;
			}
			$this->formArray["totalMarketValue"] += $totalMarketValue;
			$this->formArray["totalAssessedValue"] += $totalAssessedValue;
			$this->formArray["landTotalMarketValue"] = $totalMarketValue;
			$this->formArray["landTotalAssessedValue"] = $totalAssessedValue;
			$this->tpl->set_var("landCtr", $i);
		}
		else {
			$this->tpl->set_var("defaultLandListBlock", "");
			$this->tpl->set_var("toggleLandListBlock", "");
		}
	}
	
	function displayPlantsTreesList($plantsTreesList){
		$this->tpl->set_block("rptsTemplate", "PlantsTreesDBEmpty", "PlantsTreesDBEmptyBlock");
		$this->tpl->set_var("PlantsTreesDBEmptyBlock", "");
		$this->tpl->set_block("rptsTemplate", "defaultPlantsTreesList", "defaultPlantsTreesListBlock");
		$this->tpl->set_block("rptsTemplate", "togglePlantsTreesList", "togglePlantsTreesListBlock");
		if (count($plantsTreesList)){
			//$this->tpl->set_block("rptsTemplate", "hidePlantsTreesList", "hidePlantsTreesListBlock");
			$this->tpl->set_block("rptsTemplate", "PlantsTreesList", "PlantsTreesListBlock");
			$i = 0;
			$totalMarketValue = 0;
			$totalAssessedValue = 0;
			foreach ($plantsTreesList as $key => $value){
				$totalMarketValue += tofloat($value->getMarketValue());
				$totalAssessedValue += tofloat($value->getAssessedValue());
				$this->displayDetails($value);
				$this->tpl->set_var("ctr",$i);
				$this->tpl->parse("defaultPlantsTreesListBlock", "defaultPlantsTreesList", true);
				$this->tpl->parse("togglePlantsTreesListBlock", "togglePlantsTreesList", true);
			//$this->tpl->parse("hidePlantsTreesListBlock", "hidePlantsTreesList", true);
					$this->tpl->parse("PlantsTreesListBlock", "PlantsTreesList", true);
				$i++;
			}
			$this->formArray["totalMarketValue"] += $totalMarketValue;
			$this->formArray["totalAssessedValue"] += $totalAssessedValue;
			$this->formArray["plantTotalMarketValue"] = $totalMarketValue;
			$this->formArray["plantTotalAssessedValue"] = $totalAssessedValue;
			$this->tpl->set_var("plantsTreesCtr", $i);
		}
		else {
			$this->tpl->set_var("defaultPlantsTreesListBlock", "");
			$this->tpl->set_var("togglePlantsTreesListBlock", "");
		}
	}
	
	function displayImprovementsBuildingsList($improvementsBuildingsList){
		$this->tpl->set_block("rptsTemplate", "ImprovementsBuildingsDBEmpty", "ImprovementsBuildingsDBEmptyBlock");
		$this->tpl->set_var("ImprovementsBuildingsDBEmptyBlock", "");
		$this->tpl->set_block("rptsTemplate", "defaultImprovementsBuildingsList", "defaultImprovementsBuildingsListBlock");
		$this->tpl->set_block("rptsTemplate", "toggleImprovementsBuildingsList", "toggleImprovementsBuildingsListBlock");
		if (count($improvementsBuildingsList)){
			//$this->tpl->set_block("rptsTemplate", "hideImprovementsBuildingsList", "hideImprovementsBuildingsListBlock");
			$this->tpl->set_block("rptsTemplate", "ImprovementsBuildingsList", "ImprovementsBuildingsListBlock");
			$i = 0;
			$totalMarketValue = 0;
			$totalAssessedValue = 0;
			foreach ($improvementsBuildingsList as $key => $value){
				$totalMarketValue += tofloat($value->getMarketValue());
				$totalAssessedValue += tofloat($value->getAssessedValue());
				$this->displayDetails($value);
				$this->tpl->set_var("ctr",$i);
				$this->tpl->parse("defaultImprovementsBuildingsListBlock", "defaultImprovementsBuildingsList", true);
				$this->tpl->parse("toggleImprovementsBuildingsListBlock", "toggleImprovementsBuildingsList", true);
				//$this->tpl->parse("hideImprovementsBuildingsListBlock", "hideImprovementsBuildingsList", true);
				$this->tpl->parse("ImprovementsBuildingsListBlock", "ImprovementsBuildingsList", true);
				$i++;
			}
				$this->formArray["totalMarketValue"] += $totalMarketValue;
				$this->formArray["totalAssessedValue"] += $totalAssessedValue;
				$this->formArray["bldgTotalMarketValue"] = $totalMarketValue;
				$this->formArray["bldgTotalAssessedValue"] = $totalAssessedValue;
				$this->tpl->set_var("improvementsBuildingsCtr", $i);
		}
		else {
			$this->tpl->set_var("defaultImprovementsBuildingsListBlock", "");
			$this->tpl->set_var("toggleImprovementsBuildingsListBlock", "");
		}
	}
	
	function displayMachineriesList($machineriesList){
		$this->tpl->set_block("rptsTemplate", "MachineriesDBEmpty", "MachineriesDBEmptyBlock");
		$this->tpl->set_var("MachineriesDBEmptyBlock", "");
		$this->tpl->set_block("rptsTemplate", "defaultMachineriesList", "defaultMachineriesListBlock");
		$this->tpl->set_block("rptsTemplate", "toggleMachineriesList", "toggleMachineriesListBlock");
		if (count($machineriesList)){
			//$this->tpl->set_block("rptsTemplate", "hideMachineriesList", "hideMachineriesListBlock");
			$this->tpl->set_block("rptsTemplate", "MachineriesList", "MachineriesListBlock");
			$i = 0;
			$totalMarketValue = 0;
			$totalAssessedValue = 0;
			foreach ($machineriesList as $key => $value){
				$totalMarketValue += tofloat($value->getMarketValue());
				$totalAssessedValue += tofloat($value->getAssessedValue());
				$this->displayDetails($value);
				$this->tpl->set_var("ctr",$i);
				$this->tpl->parse("defaultMachineriesListBlock", "defaultMachineriesList", true);
				$this->tpl->parse("toggleMachineriesListBlock", "toggleMachineriesList", true);
				//$this->tpl->parse("hideMachineriesListBlock", "hideMachineriesList", true);
				$this->tpl->parse("MachineriesListBlock", "MachineriesList", true);
				$i++;
			}
			$this->formArray["totalMarketValue"] += $totalMarketValue;
			$this->formArray["totalAssessedValue"] += $totalAssessedValue;
			$this->formArray["machTotalMarketValue"] = $totalMarketValue;
			$this->formArray["machTotalAssessedValue"] = $totalAssessedValue;
			$this->tpl->set_var("machineriesCtr", $i);
		}
		else {
			$this->tpl->set_var("defaultMachineriesListBlock", "");
			$this->tpl->set_var("toggleMachineriesListBlock", "");
		}
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "remove":
				if (count($this->formArray["landID"])) {
					//print_r($this->formArray["landID"]);
					$LandList = new SoapObject(NCCBIZ."LandList.php", "urn:Object");
					if (!$deletedRows = $LandList->removeLand($this->formArray["landID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				if (count($this->formArray["plantsTreesID"])) {
					//print_r($this->formArray["plantsTreesID"]);
					$PlantsTreesList = new SoapObject(NCCBIZ."PlantsTreesList.php", "urn:Object");
					if (!$deletedRows = $PlantsTreesList->removePlantsTrees($this->formArray["plantsTreesID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				if (count($this->formArray["machineriesID"])) {
					//print_r($this->formArray["machineriesID"]);
					$MachineriesList = new SoapObject(NCCBIZ."MachineriesList.php", "urn:Object");
					if (!$deletedRows = $MachineriesList->removeMachineries($this->formArray["machineriesID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				if (count($this->formArray["improvementsBuildingsID"])) {
					//print_r($this->formArray["improvementsBuildingsID"]);
					$ImprovementsBuildingsList = new SoapObject(NCCBIZ."ImprovementsBuildingsList.php", "urn:Object");
					if (!$deletedRows = $ImprovementsBuildingsList->removeImprovementsBuildings($this->formArray["improvementsBuildingsID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				if (count($this->formArray["storeyID"])) {
					//print_r($this->formArray["storeyID"]);
					$StoreyList = new SoapObject(NCCBIZ."StoreyList.php", "urn:Object");
					if (!$deletedRows = $StoreyList->removeStorey($this->formArray["storeyID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				header("location: AFSDetails.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
				exit;
				break;				
			default:
				$this->tpl->set_var("msg", "");
		}
		$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
		if (!$xmlStr = $AFSDetails->getAFS($this->formArray["afsID"])){
			$this->tpl->set_block("rptsTemplate", "AFSTable", "AFSTableBlock");
			$this->tpl->set_var("AFSTableBlock", "afs not found");
		}
		else{
			//echo $xmlStr;
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
				$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
			}
			else {
				$afs = new AFS;
				$afs->parseDomDocument($domDoc);
				//print_r($afs);
				foreach($afs as $key => $value){
					$this->formArray[$key] = $value;
                    $this->formArray["totalMarketValue"] = 0;
                    $this->formArray["totalAssessedValue"] = 0;
                }
				//land
				$landList = $afs->getLandArray();
				if(count($landList)){
					$this->displayLandList($landList);
				}
				else{
					$this->tpl->set_var("landCtr", 0);
					$this->tpl->set_block("rptsTemplate", "defaultLandList", "defaultLandListBlock");
					$this->tpl->set_var("defaultLandListBlock", "");
					$this->tpl->set_block("rptsTemplate", "toggleLandList", "toggleLandListBlock");
					$this->tpl->set_var("toggleLandListBlock", "");
					$this->tpl->set_block("rptsTemplate", "LandList", "LandListBlock");
					$this->tpl->set_var("LandListBlock", "");
				}
				
				//plantsTrees
				$plantsTreesList = $afs->getPlantsTreesArray();
				if(count($plantsTreesList)){
					$this->displayPlantsTreesList($plantsTreesList);
				}
				else{
					$this->tpl->set_var("plantsTreesCtr", 0);
					$this->tpl->set_block("rptsTemplate", "defaultPlantsTreesList", "defaultPlantsTreesListBlock");
					$this->tpl->set_var("defaultPlantsTreesListBlock", "");
					$this->tpl->set_block("rptsTemplate", "togglePlantsTreesList", "togglePlantsTreesListBlock");
					$this->tpl->set_var("togglePlantsTreesListBlock", "");
					$this->tpl->set_block("rptsTemplate", "PlantsTreesList", "PlantsTreesListBlock");
					$this->tpl->set_var("PlantsTreesListBlock", "");
				}
				
				//improvementsBuildings
				$improvementsBuildingsList = $afs->getImprovementsBuildingsArray();
				if(count($improvementsBuildingsList)){
					$this->displayImprovementsBuildingsList($improvementsBuildingsList);
				}
				else{
					$this->tpl->set_var("improvementsBuildingsCtr", 0);
					$this->tpl->set_block("rptsTemplate", "defaultImprovementsBuildingsList", "defaultImprovementsBuildingsListBlock");
					$this->tpl->set_var("defaultImprovementsBuildingsListBlock", "");
					$this->tpl->set_block("rptsTemplate", "toggleImprovementsBuildingsList", "toggleImprovementsBuildingsListBlock");
					$this->tpl->set_var("toggleImprovementsBuildingsListBlock", "");
					$this->tpl->set_block("rptsTemplate", "ImprovementsBuildingsList", "ImprovementsBuildingsListBlock");
					$this->tpl->set_var("ImprovementsBuildingsListBlock", "");
				}
				
				//machineries
				$machineriesList = $afs->getMachineriesArray();
				//print_r($machineriesList);
				if(count($machineriesList)){
					$this->displayMachineriesList($machineriesList);
				}
				else{
					$this->tpl->set_var("machineriesCtr", 0);
					$this->tpl->set_block("rptsTemplate", "defaultMachineriesList", "defaultMachineriesListBlock");
					$this->tpl->set_var("defaultMachineriesListBlock", "");
					$this->tpl->set_block("rptsTemplate", "toggleMachineriesList", "toggleMachineriesListBlock");
					$this->tpl->set_var("toggleMachineriesListBlock", "");
					$this->tpl->set_block("rptsTemplate", "MachineriesList", "MachineriesListBlock");
					$this->tpl->set_var("MachineriesListBlock", "");
				}
				
				$ODDetails = new SoapObject(NCCBIZ."ODDetails.php", "urn:Object");
				if (!$xmlStr = $ODDetails->getOD($this->formArray["odID"])){
					exit("xml failed");
				}
				else{
					//echo $xmlStr;
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
						$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
					}
					else {
						$od = new OD;
						$od->parseDomDocument($domDoc);
						foreach($od as $key => $value){
							if ($key == "locationAddress"&&is_object($value)){
								foreach($value as $lkey => $lvalue){
									$this->formArray[$lkey] = $lvalue;
								}
							}
							else $this->formArray[$key] = $value;
						}
						
						$ODEncode = new SoapObject(NCCBIZ."ODEncode.php", "urn:Object");
						$this->formArray["ownerID"] = $ODEncode->getOwnerID($this->formArray["odID"]);
						$OwnerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");
						if (!$xmlStr = $OwnerList->getOwnerList($this->formArray["ownerID"])){
							//exit(print_r($OwnerList));
							$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
							$this->tpl->set_var("OwnerListTableBlock", "");
						}
						else {
							if(!$domDoc = domxml_open_mem($xmlStr)) {
								$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
								$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
							}
							else {
								$this->displayOwnerList($domDoc);
							}
						}
					}	
				}
			}
		}
		$AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
		$afs = new AFS;
		$afs->setAfsID($this->formArray["afsID"]);
		$afs->setLandTotalMarketValue($this->formArray["landTotalMarketValue"]);
		$afs->setLandTotalAssessedValue($this->formArray["landTotalAssessedValue"]);
		$afs->setPlantTotalMarketValue($this->formArray["plantTotalMarketValue"]);
		$afs->setPlantTotalPlantAssessedValue($this->formArray["plantTotalAssessedValue"]);
		$afs->setBldgTotalMarketValue($this->formArray["bldgTotalMarketValue"]);
		$afs->setBldgTotalAssessedValue($this->formArray["bldgTotalAssessedValue"]);
		$afs->setMachTotalMarketValue($this->formArray["machTotalMarketValue"]);
		$afs->setMachTotalAssessedValue($this->formArray["machTotalAssessedValue"]);
		$afs->setTotalMarketValue($this->formArray["totalMarketValue"]);
		$afs->setTotalAssessedValue($this->formArray["totalAssessedValue"]);
		$afs->setDomDocument();
		$doc = $afs->getDomDocument();
		$xmlStr =  $doc->dump_mem(true);
		//print_r($AFSEncode);
		//echo $xmlStr;
		if (!$ret = $AFSEncode->updateAFS($xmlStr)){
			echo("ret=".$ret);
		}
		//echo $ret;
		$this->setForm();
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
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

$ownerList = new AFSDetails($HTTP_POST_VARS,$sess,$afsID,$type);
$ownerList->main();
?>
<?php //page_close(); ?>
