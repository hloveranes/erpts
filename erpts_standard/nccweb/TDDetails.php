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
class TDDetails{
	
	var $tpl;
	var $formArray;
	function TDDetails($http_post_vars,$sess,$tdID,$propertyID,$propertyType){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "TDDetails.htm") ;
		$this->tpl->set_var("TITLE", "TD Details");
		
        $this->formArray["tdID"] = $tdID;
        $this->formArray["propertyID"] = $propertyID;
        $this->formArray["propertyType"] = $propertyType;
			
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
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
					if(is_numeric($lvalue))
					{
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
					if(is_numeric($lvalue))
					{
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
					if(is_numeric($lvalue))
					{
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
					if(is_numeric($lvalue))
					{
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
					if(is_numeric($lvalue))
					{
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
					if(is_numeric($lvalue))
					{
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
											if(is_numeric($lvalue)){
												$provincialAssessor = new Person;
												$provincialAssessor->selectRecord($lvalue);
												$this->tpl->set_var("provincialAssessorID", $provincialAssessor->getPersonID());
												$this->tpl->set_var("provincialAssessorName", $provincialAssessor->getFullName());
											}
											else{
												$provincialAssessor = $lvalue;	
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
											if(is_numeric($lvalue)){
												$cityMunicipalAssessor = new Person;
												$cityMunicipalAssessor->selectRecord($lvalue);
												$this->tpl->set_var("cityMunicipalAssessorID", $cityMunicipalAssessor->getPersonID());
												$this->tpl->set_var("cityMunicipalAssessorName", $cityMunicipalAssessor->getFullName());
											}
											else{
												$cityMunicipalAssessor = $lvalue;	
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
											if(is_numeric($lvalue)){
												$enteredInRPARForBy = new Person;
												$enteredInRPARForBy->selectRecord($lvalue);
												$this->tpl->set_var("enteredInRPARForByID", $enteredInRPARForBy->getPersonID());
												$this->tpl->set_var("enteredInRPARForByName", $enteredInRPARForBy->getFullName());
											}
											else{
												$enteredInRPARForBy = $lvalue;	
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
							$this->tpl->set_var("classification",$landClasses->getDescription());
							break;
						case "subClass":
							$landSubclasses = new LandSubclasses;
							$landSubclasses->selectRecord($lvalue);
							$this->tpl->set_var("subClass",$landSubclasses->getDescription());
							break;
						case "actualUse":
							$landActualUses = new LandActualUses;
							$landActualUses->selectRecord($lvalue);
							$this->tpl->set_var("actualUse",$landActualUses->getDescription());
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
			
			foreach($improvementsBuildings as $ikey => $ivalue){
				if(is_numeric($pvalue)){
					switch($ikey){
						case "buildingClassification":
							$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
							$improvementsBuildingsClasses->selectRecord($ivalue);
							$this->tpl->set_var("buildingClassification", $improvementsBuildingsClasses->getDescription());
							break;
						case "actualUse":
							$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
							$improvementsBuildingsActualUses->selectRecord($ivalue);
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
			foreach($machineries as $mkey => $mvalue){
				if(is_numeric($mvalue)){
					switch($mkey){
						case "kind":
							$machineriesClasses = new MachineriesClasses;
							$machineriesClasses->selectRecord($mvalue);
							$this->tpl->set_var("kind", $machineriesClasses->getDescription());
							break;
						case "actualUse":
							$machineriesActualUses = new MachineriesActualUses;
							$machineriesActualUses->selectRecord($mvalue);
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
	    $this->tpl->set_block("rptsTemplate", "TDList", "TDListBlock");
	    
	    $this->tpl->set_block("rptsTemplate", "TDDBEmpty", "TDDBEmptyBlock");
	    $this->tpl->set_var("TDDBEmptyBlock", "");
	    $this->tpl->set_block("TDList", "Land", "LandBlock");
	    $this->tpl->set_block("TDList", "PlantsTrees", "PlantsTreesBlock");
	    $this->tpl->set_block("TDList", "ImprovementsBuildings", "ImprovementsBuildingsBlock");
	    $this->tpl->set_block("TDList", "Machineries", "MachineriesBlock");
											
        $propertyType = $this->formArray["propertyType"];
	    $propertyID = $this->formArray["propertyID"];
	
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
                        
				$this->tpl->set_var("PlantsTreesBlock", "");
				$this->tpl->set_var("ImprovementsBuildingsBlock", "");
				$this->tpl->set_var("MachineriesBlock", "");

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
                $this->tpl->set_var("LandBlock", "");
				$this->tpl->set_var("ImprovementsBuildingsBlock", "");
				$this->tpl->set_var("MachineriesBlock", "");
						
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
                        
					$this->tpl->set_var("LandBlock", "");
					$this->tpl->set_var("PlantsTreesBlock", "");
					$this->tpl->set_var("MachineriesBlock", "");

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
		                
				    $this->tpl->set_var("LandBlock", "");
					$this->tpl->set_var("PlantsTreesBlock", "");
					$this->tpl->set_var("ImprovementsBuildingsBlock", "");
                        		
		        break;
		
                default:
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
		}

		$TDEncode = new SoapObject(NCCBIZ."TDEncode.php", "urn:Object");
		$this->formArray["afsID"] = $TDEncode->getAfsID($this->formArray["tdID"]);

		$afs = new AFS;
		$this->formArray["odID"] = $afs->checkOdID($this->formArray["afsID"]);

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

        $this->setForm();
		
        $this->tpl->parse("TDListBlock", "TDList", true);
		
        $this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("tdID"=>$this->formArray["rtdID"])));
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

$tdDetails = new TDDetails($HTTP_POST_VARS,$sess,$tdID,$propertyID,$propertyType);
$tdDetails->Main();
?>
<?php page_close(); ?>
