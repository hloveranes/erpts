<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

include_once "../includes/assessor/Barangay.php";

include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/AFS.php";

include_once "../includes/assessor/LandClasses.php";
include_once "../includes/assessor/LandSubclasses.php";
include_once "../includes/assessor/LandActualUses.php";

include_once "../includes/assessor/PlantsTreesClasses.php";
include_once "../includes/assessor/PlantsTreesActualUses.php";
include_once "../includes/assessor/ImprovementsBuildingsClasses.php";
include_once "../includes/assessor/ImprovementsBuildingsActualUses.php";
include_once "../includes/assessor/MachineriesClasses.php";
include_once "../includes/assessor/MachineriesActualUses.php";

#####################################
# Define Interface Class
#####################################
class RPTOPDetails{
	
	var $tpl;
	var $formArray;
	function RPTOPDetails($http_post_vars,$sess,$rptopID){
		global $auth;

		$this->sess = $sess;
		$this->userID = $auth->auth["uid"];

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "RPTOPDetails.htm") ;
		$this->tpl->set_var("TITLE", "Owner List");
		$this->formArray = array(
			"cityAssessorName" => ""
			, "cityTreasurerName" => ""
		);
		$this->formArray["rptopID"] = $rptopID;
			
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
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
			$this->tpl->set_var($key, $value);
		}
	}
	
	function displayOwnerList($domDoc){
		$owner = new Owner;
		$owner->parseDomDocument($domDoc);
		//$list = $owner->getArrayList();
		//foreach ($list as $key => $value){
			if (count($owner->personArray)){
				$this->tpl->set_block("rptsTemplate", "PersonDBEmpty", "PersonDBEmptyBlock");
				$this->tpl->set_var("PersonDBEmptyBlock", "");
				$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
				foreach($owner->personArray as $personKey =>$personValue){
					$this->tpl->set_var("personID", $personValue->getPersonID());
					if (!$pname = $personValue->getFullName()){
						$pname = "none";
					}
					$this->tpl->set_var("fullName", $pname);
					$this->tpl->set_var("tin", $personValue->getTin());
					$this->tpl->set_var("telephone", $personValue->getTelephone());
					$this->tpl->set_var("mobileNumber", $personValue->getMobileNumber());
					$this->tpl->parse("PersonListBlock", "PersonList", true);
				}
			}
			else{
				$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
				$this->tpl->set_var("PersonListBlock", "");
			}
			if (count($owner->companyArray)){
				$this->tpl->set_block("rptsTemplate", "CompanyDBEmpty", "CompanyDBEmptyBlock");
				$this->tpl->set_var("CompanyDBEmptyBlock", "");
				$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
				//print_r($value->companyArray);
				foreach ($owner->companyArray as $companyKey => $companyValue){
					$this->tpl->set_var("companyID", $companyValue->getCompanyID());
					if (!$cname = $companyValue->getCompanyName()){
						$cname = "none";
					}
					$this->tpl->set_var("companyName", $cname);
					$this->tpl->set_var("tin", $companyValue->getTin());
					$this->tpl->set_var("telephone", $companyValue->getTelephone());
					$this->tpl->set_var("fax", $companyValue->getFax());
					$this->tpl->parse("CompanyListBlock", "CompanyList", true);
				}
			}
			else{
				$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
				$this->tpl->set_var("CompanyListBlock", "");	
			}
		//}
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
					if(is_numeric($lvalue)){
						$verifiedBy = new Person;
						$verifiedBy->selectRecord($lvalue);
						$this->tpl->set_var("verifiedByID", $verifiedBy->getPersonID());
						$this->tpl->set_var("verifiedByName", $verifiedBy->getFullName());
					}
					else{
						$verifiedBy = $lvalue;
						$this->tpl->set_var("verifiedByID", $verifiedBy);
						$this->tpl->set_var("verifiedByName", $verifiedBy);
					}
				break;
				case "plottingsBy":
					if(is_numeric($lvalue)){
						$plottingsBy = new Person;
						$plottingsBy->selectRecord($lvalue);
						$this->tpl->set_var("plottingsByID", $plottingsBy->getPersonID());
						$this->tpl->set_var("plottingsByName", $plottingsBy->getFullName());
					}
					else{
						$plottingsBy = $lvalue;
						$this->tpl->set_var("plottingsByID", $plottingsBy);
						$this->tpl->set_var("plottingsByName", $plottingsBy);
					}
				break;
				case "notedBy":
					if(is_numeric($lvalue)){
						$notedBy = new Person;
						$notedBy->selectRecord($lvalue);
						$this->tpl->set_var("notedByID", $notedBy->getPersonID());
						$this->tpl->set_var("notedByName", $notedBy->getFullName());
					}
					else{
						$notedBy = $lvalue;
						$this->tpl->set_var("notedByID", $notedBy);
						$this->tpl->set_var("notedByName", $notedBy);
					}
				break;
				case "appraisedBy":
					if(is_numeric($lvalue)){
						$appraisedBy = new Person;
						$appraisedBy->selectRecord($lvalue);
						$this->tpl->set_var("appraisedByID", $appraisedBy->getPersonID());
						$this->tpl->set_var("appraisedByName", $appraisedBy->getFullName());
					}
					else{
						$appraisedBy = $lvalue;
						$this->tpl->set_var("appraisedByID", $appraisedBy);
						$this->tpl->set_var("appraisedByName", $appraisedBy);
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
						$this->tpl->set_var($lkey, "");
					}
				break;
				case "recommendingApproval":
					if(is_numeric($lvalue)){
						$recommendingApproval = new Person;
						$recommendingApproval->selectRecord($lvalue);
						$this->tpl->set_var("recommendingApprovalID", $recommendingApproval->getPersonID());
						$this->tpl->set_var("recommendingApprovalName", $recommendingApproval->getFullName());
					}
					else{
						$recommendingApproval = $lvalue;
						$this->tpl->set_var("recommendingApprovalID", $recommendingApproval);
						$this->tpl->set_var("recommendingApprovalName", $recommendingApproval);
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
						$this->tpl->set_var($lkey, "");
					}
				case "approvedBy":
					if(is_numeric($lvalue)){
						$approvedBy = new Person;
						$approvedBy->selectRecord($lvalue);
						$this->tpl->set_var("approvedByID", $approvedBy->getPersonID());
						$this->tpl->set_var("approvedByName", $approvedBy->getFullName());
					}
					else{
						$approvedBy = $lvalue;
						$this->tpl->set_var("approvedByID", $approvedBy);
						$this->tpl->set_var("approvedByName", $approvedBy);
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
						$this->tpl->set_var($lkey, "");
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
									switch ($tdkey){
										case "provincialAssessor":
											if(is_numeric($tdvalue)){
												$provincialAssessor = new Person;
												$provincialAssessor->selectRecord($tdvalue);
												$this->tpl->set_var("provincialAssessorID", $provincialAssessor->getPersonID());
												$this->tpl->set_var("provincialAssessorName", $provincialAssessor->getFullName());
											}
											else {
												$provincialAssessor = $tdvalue;
												$this->tpl->set_var("provincialAssessorID", $provincialAssessor);
												$this->tpl->set_var("provincialAssessorName", $provincialAssessor);
											}
										break;
										case "provincialAssessorDate":
											if (true){
												list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$tdvalue);
												$this->tpl->set_var("pa_yearValue", removePreZero($dateArr["year"]));
												eval(MONTH_ARRAY);//$monthArray
												$this->tpl->set_var("pa_month", $monthArray[removePreZero($dateArr["month"])]);
												$this->tpl->set_var("pa_dayValue", removePreZero($dateArr["day"]));
											}
											else {
												$this->tpl->set_var($tdkey, "");
											}
										break;
										case "cityMunicipalAssessor":
											if(is_numeric($tdvalue)){
												$cityMunicipalAssessor = new Person;
												$cityMunicipalAssessor->selectRecord($tdvalue);
												$this->tpl->set_var("cityMunicipalAssessorID", $cityMunicipalAssessor->getPersonID());
												$this->tpl->set_var("cityMunicipalAssessorName", $cityMunicipalAssessor->getFullName());
											}
											else {
												$cityMunicipalAssessor = $tdvalue;
												$this->tpl->set_var("cityMunicipalAssessorID", $cityMunicipalAssessor);
												$this->tpl->set_var("cityMunicipalAssessorName", $cityMunicipalAssessor);
											}
										break;
										case "cityMunicipalAssessorDate":
											if (true){
												list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$tdvalue);
												$this->tpl->set_var("cm_yearValue", removePreZero($dateArr["year"]));
												eval(MONTH_ARRAY);//$monthArray
												$this->tpl->set_var("cm_month", $monthArray[removePreZero($dateArr["month"])]);
												$this->tpl->set_var("cm_dayValue", removePreZero($dateArr["day"]));
											}
											else {
												$this->tpl->set_var($tdkey, "");
											}
										break;
										case "enteredInRPARForBy":
											if(is_numeric($tdvalue)){
												$enteredInRPARForBy = new Person;
												$enteredInRPARForBy->selectRecord($tdvalue);
												$this->tpl->set_var("enteredInRPARForByID", $enteredInRPARForBy->getPersonID());
												$this->tpl->set_var("enteredInRPARForByName", $enteredInRPARForBy->getFullName());
											}
											else {
												$enteredInRPARForBy = $tdvalue;
												$this->tpl->set_var("enteredInRPARForByID", $enteredInRPARForBy);
												$this->tpl->set_var("enteredInRPARForByName", $enteredInRPARForBy);
											}
										break;
										default:
											$this->tpl->set_var($tdkey, $tdvalue);
									}
								}
							}
						}
					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				default:
					$this->tpl->set_var($lkey,$lvalue);
			}				
		}
	}
	function displayLand($land){
		if ($land){
			$this->displayDetails($land);
			foreach($land as $lkey => $lvalue){
				if(is_numeric($lvalue)){
					switch($lkey){
						case "classification":
							$landClasses = new LandClasses;
							$landClasses->selectRecord($lvalue);
							$this->tpl->set_var("classification", $landClasses->getDescription());
							break;
						case "subClass":
							$landSubclasses = new LandSubclasses;
							$landSubclasses->selectRecord($lvalue);
							$this->tpl->set_var("subClass", $landSubclasses->getDescription());
							break;
						case "actualUse":
							$landActualUses = new LandActualUses;
							$landActualUses->selectRecord($lvalue);
							$this->tpl->set_var("actualUse", $landActualUses->getDescription());
							break;
					}
				}
			}
			$this->tpl->parse("LandBlock", "Land", true);
		}
		else {
			$this->tpl->set_var("LandBlock", "");
		}
	}
	function displayPlantsTrees($plantsTrees){
		if ($plantsTrees){
			$this->displayDetails($plantsTrees);
			foreach($plantsTrees as $pkey => $pvalue){
				if(is_numeric($pvalue)){
					switch($pkey){
						case "productClass":
							$plantsTreesClasses = new PlantsTreesClasses;
							$plantsTreesClasses->selectRecord($pvalue);
							$this->tpl->set_var("productClass", $plantsTreesClasses->getDescription());
							break;
						case "actualUse":
							$plantsTreesActualUses = new LandActualUses;
							$plantsTreesActualUses->selectRecord($pvalue);
							$this->tpl->set_var("actualUse", $plantsTreesActualUses->getDescription());
							break;
					}
				}
			}
			$this->tpl->parse("PlantsTreesBlock", "PlantsTrees", true);
		}
		else {
			$this->tpl->set_block("TDList", "PlantsTrees", "PlantsTreesBlock");
			$this->tpl->set_var("PlantsTreesBlock", "");
		}
	}
	function displayImprovementsBuildings($improvementsBuildings){
		if ($improvementsBuildings){
			$this->displayDetails($improvementsBuildings);
			foreach($improvementsBuildings as $lkey => $lvalue){
				if(is_numeric($lvalue)){
					switch($lkey){
						case "buildingClassification":
							$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
							$improvementsBuildingsClasses->selectRecord($lvalue);
							$this->tpl->set_var("buildingClassification", $improvementsBuildingsClasses->getDescription());
							break;
						case "actualUse":
							$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
							$improvementsBuildingsActualUses->selectRecord($lvalue);
							$this->tpl->set_var("actualUse", $improvementsBuildingsActualUses->getDescription());
							break;
					}
				}
			}
			$this->tpl->parse("ImprovementsBuildingsBlock", "ImprovementsBuildings", true);
		}
		else {
			$this->tpl->set_block("TDList", "ImprovementsBuildings", "ImprovementsBuildingsBlock");
			$this->tpl->set_var("ImprovementsBuildingsBlock", "");
		}
	}
	function displayMachineries($machineries){
		if ($machineries){
			$this->displayDetails($machineries);
			foreach($machineries as $lkey => $lvalue){
				if(is_numeric($lvalue)){
					switch($lkey){
						case "kind":
							$machineriesClasses = new MachineriesClasses;
							$machineriesClasses->selectRecord($lvalue);
							$this->tpl->set_var("kind", $machineriesClasses->getDescription());
							break;
						case "actualUse":
							$machineriesActualUses = new MachineriesActualUses;
							$machineriesActualUses->selectRecord($lvalue);
							$this->tpl->set_var("actualUse", $machineriesActualUses->getDescription());
							break;
					}
				}
			}
			$this->tpl->parse("MachineriesBlock", "Machineries", true);
		}
		else {
			$this->tpl->set_block("TDList", "Machineries", "MachineriesBlock");
			$this->tpl->set_var("MachineriesBlock", "");
		}
	}
	function Main(){
		switch ($this->formArray["formAction"]){
			case "remove";
				//echo "removeOwnerRPTOP(".$this->formArray["rptopID"].",".$this->formArray["ownerID"].",".$this->formArray["personID"].",".$this->formArray["companyID"].")";
				$OwnerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");
				if (count($this->formArray["personID"]) || count($this->formArray["companyID"])) {
					if (!$deletedRows = $OwnerList->removeOwnerRPTOP($this->formArray["rptopID"],$this->formArray["ownerID"],$this->formArray["personID"],$this->formArray["companyID"])){
						$this->tpl->set_var("msg", "SOAP failed");
						//echo "SOAP failed";
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				/*
				if (count($this->formArray["companyID"])) {
					//print_r($this->formArray["companyID"]);
					//exit;
					if (!$deletedRows = $OwnerList->removeOwnerCompanyRPTOP($this->formArray["rptopID"],$this->formArray["ownerID"],$this->formArray["companyID"])){
						$this->tpl->set_var("msg", "SOAP failed");
						echo "SOAP failed";
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");*/
				header("location: RPTOPDetails.php".$this->sess->url("").$this->sess->add_query(array("rptopID"=>$this->formArray["rptopID"])));
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
		}//select
		$RPTOPDetails = new SoapObject(NCCBIZ."RPTOPDetails.php", "urn:Object");
		if (!$xmlStr = $RPTOPDetails->getRPTOP($this->formArray["rptopID"])){
			exit("xml failed");
		}
		else{
			//echo $xmlStr;
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
				$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
			}
			else {
				$rptop = new RPTOP;
				$rptop->parseDomDocument($domDoc);
				foreach($rptop as $key => $value){
					switch ($key){
						case "owner":
							//$RPTOPEncode = new SoapObject(NCCBIZ."RPTOPEncode.php", "urn:Object");
							if (is_a($value,"Owner")){
								$this->formArray["ownerID"] = $rptop->owner->getOwnerID();
								$xmlStr = $rptop->owner->domDocument->dump_mem(true);
								if (!$xmlStr){
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
							else {
								$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
								$this->tpl->set_var("PersonListBlock", "");
								$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
								$this->tpl->set_var("CompanyListBlock", "");
							}
						break;
						case "cityAssessor":
							if(is_numeric($value)){
								$cityAssessor = new Person;
								$cityAssessor->selectRecord($value);
								$this->tpl->set_var("cityAssessorID", $cityAssessor->getPersonID());
								$this->tpl->set_var("cityAssessorName", $cityAssessor->getFullName());
								$this->formArray["cityAssessorName"] = $cityAssessor->getFullName();
							}
							else {
								$cityAssessor = $value;
								$this->tpl->set_var("cityAssessorID", $cityAssessor);
								$this->tpl->set_var("cityAssessorName", $cityAssessor);
								$this->formArray["cityAssessorName"] = $cityAssessor;
							}
						break;
						case "cityTreasurer":
							if(is_numeric($value)){
								$cityTreasurer = new Person;
								$cityTreasurer->selectRecord($value);
								$this->tpl->set_var("cityTreasurerID", $cityTreasurer->getPersonID());
								$this->tpl->set_var("cityTreasurerName", $cityTreasurer->getFullName());
								$this->formArray["cityTreasurerName"] = $cityTreasurer->getFullName();
							}
							else {
								$cityTreasurer = $value;
								$this->tpl->set_var("cityTreasurerID", $cityTreasurer);
								$this->tpl->set_var("cityTreasurerName", $cityTreasurer);
								$this->formArray["cityTreasurerName"] = $cityTreasurer;
							}						
							break;
						case "tdArray":
							$this->tpl->set_block("rptsTemplate", "defaultTDList", "defaultTDListBlock");
							$this->tpl->set_block("rptsTemplate", "toggleTDList", "toggleTDListBlock");
							$this->tpl->set_block("rptsTemplate", "TDList", "TDListBlock");
							$tdCtr = 0;
							if (count($value)){
								$this->tpl->set_block("rptsTemplate", "TDDBEmpty", "TDDBEmptyBlock");
								$this->tpl->set_var("TDDBEmptyBlock", "");
								$this->tpl->set_block("TDList", "Land", "LandBlock");
								$this->tpl->set_block("TDList", "PlantsTrees", "PlantsTreesBlock");
								$this->tpl->set_block("TDList", "ImprovementsBuildings", "ImprovementsBuildingsBlock");
								$this->tpl->set_block("TDList", "Machineries", "MachineriesBlock");
											
								foreach($value as $tkey => $tvalue){
									$propertyType = $tvalue->getPropertyType();
									$propertyID = $tvalue->getPropertyID();
									switch ($propertyType){
										case "Land":
											$LandDetails = new SoapObject(NCCBIZ."LandDetails.php", "urn:Object");
											if (!$xmlStr = $LandDetails->getLand($propertyID)){
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
													//$land->selectRecord($propertyID);
													$this->formArray["landTotalMarketValue"] += tofloat($land->getMarketValue());
													$this->formArray["landTotalAssessedValue"] += tofloat($land->getAssessedValue());
													$this->displayLand($land);
													//echo $this->formArray["landTotalAssessedValue"];
												}
											}
										break;
										case "PlantsTrees":
											$PlantsTreesDetails = new SoapObject(NCCBIZ."PlantsTreesDetails.php", "urn:Object");
											if (!$xmlStr = $PlantsTreesDetails->getPlantsTrees($propertyID)){
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
													//$plantsTrees->selectRecord($propertyID);
													$this->formArray["plantTotalMarketValue"] += tofloat($plantsTrees->getMarketValue());
													$this->formArray["plantTotalAssessedValue"] += tofloat($plantsTrees->getAssessedValue());
													$this->displayPlantsTrees($plantsTrees);
												}
											}
										break;
										case "ImprovementsBuildings":
											$ImprovementsBuildingsDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsDetails.php", "urn:Object");
											if (!$xmlStr = $ImprovementsBuildingsDetails->getImprovementsBuildings($propertyID)){
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
													//$improvementsBuildings->selectRecord($propertyID);
													$this->formArray["bldgTotalMarketValue"] += tofloat($improvementsBuildings->getMarketValue());
													$this->formArray["bldgTotalAssessedValue"] += tofloat($improvementsBuildings->getAssessedValue());
													$this->displayImprovementsBuildings($improvementsBuildings);
												}
											}
										break;
										case "Machineries":
											$MachineriesDetails = new SoapObject(NCCBIZ."MachineriesDetails.php", "urn:Object");
											if (!$xmlStr = $MachineriesDetails->getMachineries($propertyID)){
												echo ("xml failed");
											}
											else{
												//echo $xmlStr;
												if(!$domDoc = domxml_open_mem($xmlStr)) {
													$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
													$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
												}
												else {
													$machineries = new Machineries;
													$machineries->parseDomDocument($domDoc);
													//$machineries->selectRecord($propertyID);
													$this->formArray["machTotalMarketValue"] += tofloat($machineries->getMarketValue());
													$this->formArray["machTotalAssessedValue"] += tofloat($machineries->getAssessedValue());
													$this->displayMachineries($machineries);
												}
											}
										break;
										default:
											/*
											$this->tpl->set_block("TDList", "Land", "LandBlock");
											$this->tpl->set_var("LandBlock", "");
											$this->tpl->set_block("TDList", "PlantsTrees", "PlantsTreesBlock");
											$this->tpl->set_var("PlantsTreesBlock", "");
											$this->tpl->set_block("TDList", "ImprovementsBuildings", "ImprovementsBuildingsBlock");
											$this->tpl->set_var("ImprovementsBuildingsBlock", "");
											$this->tpl->set_block("TDList", "Machineries", "MachineriesBlock");
											$this->tpl->set_var("MachineriesBlock", "");
											$this->tpl->set_block("TDList", "TD", "TDBlock");
											$this->tpl->set_var("TDBlock", "");
											*/
									}
									$this->tpl->set_var("ctr", $tdCtr);
									$this->tpl->parse("defaultTDListBlock", "defaultTDList", true);
									$this->tpl->parse("toggleTDListBlock", "toggleTDList", true);
									$this->tpl->parse("TDListBlock", "TDList", true);
									$this->tpl->set_var("LandBlock", "");
									$this->tpl->set_var("PlantsTreesBlock", "");
									$this->tpl->set_var("ImprovementsBuildingsBlock", "");
									$this->tpl->set_var("MachineriesBlock", "");
									$tdCtr++;
									//echo $this->formArray["landTotalAssessedValue"]."<br>";
								}
							}
							else {
								$this->tpl->set_var("defaultTDListBlock", "//no default");
								$this->tpl->set_var("toggleTDListBlock", "//no Toggle");
								$this->tpl->set_var("TDListBlock", "");
							}
							$this->tpl->set_var("tdCtr", $tdCtr);
						break;
						case "landTotalMarketValue":
							if (!$this->formArray[$key]) $this->formArray[$key] = $value;
						break;
						case "landTotalAssessedValue":
							if (!$this->formArray[$key]) $this->formArray[$key] = $value;
						break;
						case "plantTotalMarketValue":
							if (!$this->formArray[$key]) $this->formArray[$key] = $value;
						break;
						case "plantTotalAssessedValue":
							if (!$this->formArray[$key]) $this->formArray[$key] = $value;
						break;
						case "bldgTotalMarketValue":
							if (!$this->formArray[$key]) $this->formArray[$key] = $value;
						break;
						case "bldgTotalAssessedValue":
							if (!$this->formArray[$key]) $this->formArray[$key] = $value;
						break;
						case "machTotalMarketValue":
							if (!$this->formArray[$key]) $this->formArray[$key] = $value;
						break;
						case "machTotalAssessedValue":
							if (!$this->formArray[$key]) $this->formArray[$key] = $value;
						break;
						case "totalMarketValue":
							if (!$this->formArray[$key]) $this->formArray[$key] = $value;
						break;
						case "totalAssessedValue":
							if (!$this->formArray[$key]) $this->formArray[$key] = $value;
						break;
						default:
						$this->formArray[$key] = $value;
					}
				}
				$this->formArray["totalMarketValue"] = $this->formArray["landTotalMarketValue"]
											+ $this->formArray["plantTotalMarketValue"]
											+ $this->formArray["bldgTotalMarketValue"]
											+ $this->formArray["machTotalMarketValue"];
				$this->formArray["totalAssessedValue"] = $this->formArray["landTotalAssessedValue"]
											+ $this->formArray["plantTotalAssessedValue"]
											+ $this->formArray["bldgTotalAssessedValue"]
											+ $this->formArray["machTotalAssessedValue"];
				unset($rptop);
				$AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
				$rptop = new RPTOP;
				$rptop->setRptopID($this->formArray["rptopID"]);
				$rptop->setLandTotalMarketValue($this->formArray["landTotalMarketValue"]);
				$rptop->setLandTotalAssessedValue($this->formArray["landTotalAssessedValue"]);
				$rptop->setPlantTotalMarketValue($this->formArray["plantTotalMarketValue"]);
				$rptop->setPlantTotalPlantAssessedValue($this->formArray["plantTotalAssessedValue"]);
				$rptop->setBldgTotalMarketValue($this->formArray["bldgTotalMarketValue"]);
				$rptop->setBldgTotalAssessedValue($this->formArray["bldgTotalAssessedValue"]);
				$rptop->setMachTotalMarketValue($this->formArray["machTotalMarketValue"]);
				$rptop->setMachTotalAssessedValue($this->formArray["machTotalAssessedValue"]);
				$rptop->setTotalMarketValue($this->formArray["totalMarketValue"]);
				$rptop->setTotalAssessedValue($this->formArray["totalAssessedValue"]);

				$rptop->setCreatedBy($this->userID);
				$rptop->setModifiedBy($this->userID);

				$rptop->setDomDocument();
				$RPTOPEncode = new SoapObject(NCCBIZ."RPTOPEncode.php", "urn:Object");
				$rptop->setDomDocument();
				$doc = $rptop->getDomDocument();
				$xmlStr =  $doc->dump_mem(true);
				//echo $xmlStr;
				if (!$ret = $RPTOPEncode->updateRPTOPtotals($xmlStr)){
					echo("ret=".$ret);
				}
				//echo $ret;
			}	
		}
		$this->setForm();
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("rptopID"=>$this->formArray["rptopID"],"ownerID" => $this->formArray["ownerID"])));
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
$ownerList = new RPTOPDetails($HTTP_POST_VARS,$sess,$rptopID);
$ownerList->main();
?>
<?php page_close(); ?>
