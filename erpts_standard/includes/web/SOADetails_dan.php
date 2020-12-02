<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";

include_once "../assessor/Barangay.php";

include_once "../assessor/Address.php";
include_once "../assessor/Company.php";
include_once "../assessor/CompanyRecords.php";
include_once "../assessor/Person.php";
include_once "../assessor/PersonRecords.php";
include_once "../assessor/Owner.php";
include_once "../assessor/OwnerRecords.php";
include_once "../assessor/RPTOP.php";
include_once "../assessor/AFS.php";

include_once "../assessor/LandClasses.php";
include_once "../assessor/LandSubclasses.php";
include_once "../assessor/LandActualUses.php";

include_once "../assessor/PlantsTreesClasses.php";
include_once "../assessor/PlantsTreesActualUses.php";
include_once "../assessor/ImprovementsBuildingsClasses.php";
include_once "../assessor/ImprovementsBuildingsActualUses.php";
include_once "../assessor/MachineriesClasses.php";
include_once "../assessor/MachineriesActualUses.php";

include_once "../collection/Due.php";
include_once "../collection/DueRecords.php";
include_once "../collection/TreasurySettings.php";

#####################################
# Define Interface Class
#####################################
class RPTOPDetails{
	
	var $tpl;
	var $formArray;

	var $now;

	function RPTOPDetails($http_post_vars,$sess,$rptopID){
		global $auth;

		$this->now = "2005-04-11";

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

		$this->tpl->set_file("rptsTemplate", "SOADetails.htm") ;
		$this->tpl->set_var("TITLE", "RPTOP Information");
		$this->formArray = array(
			"cityAssessorName" => ""
			, "cityTreasurerName" => ""
		);
		$this->formArray["rptopID"] = $rptopID;
		$this->formArray["landTotalMarketValue"] = 0;
		$this->formArray["landTotalAssessedValue"] = 0;
		$this->formArray["plantTotalMarketValue"] = 0;
		$this->formArray["plantTotalAssessedValue"] = 0;
		$this->formArray["bldgTotalMarketValue"] = 0;
		$this->formArray["bldgTotalAssessedValue"] = 0;
		$this->formArray["machTotalMarketValue"] = 0;
		$this->formArray["machTotalAssessedValue"] = 0;	
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
		$this->formArray["totalTaxDue"] = number_format($this->formArray["totalTaxDue"], 2, '.', ',');

		$this->formArray["totalMarketValue"] = number_format($this->formArray["totalMarketValue"], 2, '.', ',');
		$this->formArray["totalAssessedValue"] = number_format($this->formArray["totalAssessedValue"], 2, '.', ',');

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
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
		}
		else{
			$this->hideBlock("GenerateRPTOPLinkText");
			$this->hideBlock("TreasuryMaintenanceLinkText");
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
			//echo($xmlStr);
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
				$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
			}
			else {
				$rptop = new RPTOP;
				$rptop->parseDomDocument($domDoc);
				//print_r($rptop);
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
								/*
								$this->tpl->set_block("TDList", "Land", "LandBlock");
								$this->tpl->set_block("TDList", "PlantsTrees", "PlantsTreesBlock");
								$this->tpl->set_block("TDList", "ImprovementsBuildings", "ImprovementsBuildingsBlock");
								$this->tpl->set_block("TDList", "Machineries", "MachineriesBlock");
								*/
								foreach($value as $tkey => $tvalue){
									//foreach($tvalue as $column => $val){
									//	$this->tpl->set_var($column,$val);
									//}
									$this->tpl->set_var("tdID",$tvalue->getTDID());
									$this->tpl->set_var("taxDeclarationNumber",$tvalue->getTaxDeclarationNumber());
									$this->tpl->set_var("afsID",$tvalue->getAfsID());
									$this->tpl->set_var("cancelsTDNumber",$tvalue->getCancelsTDNumber());
									$this->tpl->set_var("canceledByTDNumber",$tvalue->getCanceledByTDNumber());
									$this->tpl->set_var("taxBeginsWithTheYear",$tvalue->getTaxBeginsWithTheYear());
									$this->tpl->set_var("ceasesWithTheYear",$tvalue->getCeasesWithTheYear());
									$this->tpl->set_var("enteredInRPARForBy",$tvalue->getEnteredInRPARForBy());
									$this->tpl->set_var("enteredInRPARForYear",$tvalue->getEnteredInRPARForYear());
									$this->tpl->set_var("previousOwner",$tvalue->getPreviousOwner());
									$this->tpl->set_var("previousAssessedValue",$tvalue->getPreviousAssessedValue());
									
									list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$tvalue->getProvincialAssessorDate());
									$this->tpl->set_var("pa_yearValue",removePreZero($dateArr["year"]));
									$this->tpl->set_var("pa_month",removePreZero($dateArr["month"]));
									$this->tpl->set_var("pa_dayValue",removePreZero($dateArr["day"]));
									list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$tvalue->getCityMunicipalAssessorDate());
									$this->tpl->set_var("cm_yearValue",removePreZero($dateArr["year"]));
									$this->tpl->set_var("cm_month",removePreZero($dateArr["month"]));
									$this->tpl->set_var("cm_dayValue",removePreZero($dateArr["day"]));
									
									$this->tpl->set_var("provincialAssessorName",$tvalue->provincialAssessor);
									$this->tpl->set_var("cityMunicipalAssessorName",$tvalue->cityMunicipalAssessor);
									//$this->tpl->set_var("assessedValue",$tvalue->getAssessedValue());
									
									$this->tpl->set_var("propertyType",$tvalue->getPropertyType());

									$this->tpl->set_var("basicTax","");
									$this->tpl->set_var("sefTax", "");
									$this->tpl->set_var("total", "");
									
									//$this->tpl->set_var("basicTax",$tvalue->getBasicTax());
									//$this->tpl->set_var("sefTax",$tvalue->getSefTax());
									//$this->tpl->set_var("total",$tvalue->getTotal());
									$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
									if (!$xmlStr = $AFSDetails->getAFS($tvalue->getAfsID())){
										//$this->tpl->set_block("rptsTemplate", "AFSTable", "AFSTableBlock");
										//$this->tpl->set_var("AFSTableBlock", "afs not found");
									}
									else{
										//echo $xmlStr;
										if(!$domDoc = domxml_open_mem($xmlStr)) {
											//$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
											//$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
										}
										else {
											$afs = new AFS;
											$afs->parseDomDocument($domDoc);
											$this->formArray["landTotalMarketValue"] += $afs->getLandTotalMarketValue();
											$this->formArray["landTotalAssessedValue"] += $afs->getLandTotalAssessedValue();
											$this->formArray["plantTotalMarketValue"] += $afs->getPlantTotalMarketValue();
											$this->formArray["plantTotalAssessedValue"] += $afs->getPlantTotalAssessedValue();
											$this->formArray["bldgTotalMarketValue"] += $afs->getBldgTotalMarketValue();
											$this->formArray["bldgTotalAssessedValue"] += $afs->getBldgTotalAssessedValue();
											$this->formArray["machTotalMarketValue"] += $afs->getMachTotalMarketValue();
											$this->formArray["machTotalAssessedValue"] += $afs->getMachTotalAssessedValue();
											$this->formArray["totalMarketValue"] += $afs->getTotalMarketValue();
											$this->formArray["totalAssessedValue"] += $afs->getTotalAssessedValue();
											$this->tpl->set_var("marketValue", number_format($afs->getTotalMarketValue(), 2, '.', ','));
											$this->tpl->set_var("assessedValue", number_format($afs->getTotalAssessedValue(), 2, '.', ','));
											
											$this->tpl->set_var("taxability", $afs->getTaxability());
											$this->tpl->set_var("effectivity", $afs->getEffectivity());

											$this->formArray["idle"] = "No";

											if($tvalue->getPropertyType()=="Land"){
												if(is_array($afs->landArray)){
													// if land is stripped
													if((count($afs->landArray)>1)){
														foreach($afs->landArray as $land){
															if($land->getIdle()=="Yes"){
																$this->formArray["idle"] = "Yes";
																break;
															}
														}
													}
													else{
														$this->formArray["idle"] = $afs->landArray[0]->getIdle();
													}													
												}
											}

											if($this->formArray["idle"]==""){
												$this->formArray["idle"] = "No";
											}

											$this->tpl->set_var("idle", $this->formArray["idle"]);
									
										}
									}

									// grab DueRecords from tdID
									
									$this->formArray["totalTaxDue"] = 0.00;

									$DueList = new SoapObject(NCCBIZ."DueList.php", "urn:Object");

									$dueArrayList = array(
										"Annual" => ""
										,"Q1" => ""
										,"Q2" => ""
										,"Q3" => ""
										,"Q4" => "");

									if (!$xmlStr = $DueList->getDueList($tvalue->getTdID())){
										foreach($dueArrayList as $dueKey=>$dueValue){
											$this->tpl->set_var("basicTax[".$dueKey."]","uncalculated");
											$this->tpl->set_var("sefTax[".$dueKey."]","uncalculated");
											$this->tpl->set_var("idleTax[".$dueKey."]","uncalculated");
											$this->tpl->set_var("taxDue[".$dueKey."]","uncalculated");
											$this->tpl->set_var("dueDate[".$dueKey."]","-");
										}
									}
									else{
										if(!$domDoc = domxml_open_mem($xmlStr)) {
											foreach($dueArrayList as $dueKey=>$dueValue){
												$this->tpl->set_var("basicTax[".$dueKey."]","uncalculated");
												$this->tpl->set_var("sefTax[".$dueKey."]","uncalculated");
												$this->tpl->set_var("idleTax[".$dueKey."]","uncalculated");
												$this->tpl->set_var("taxDue[".$dueKey."]","uncalculated");
												$this->tpl->set_var("dueDate[".$dueKey."]","-");
											}
										}
										else {
											$dueRecords = new DueRecords;
											$dueRecords->parseDomDocument($domDoc);

											foreach($dueRecords->getArrayList() as $due){
												foreach($due as $dueKey=>$dueValue){
													switch($dueKey){
														case "dueType":
															if($dueValue=="Annual"){
																$this->formArray["totalTaxDue"] += $due->getTaxDue();
															}
															$dueArrayList[$dueValue] = $due;

															$this->tpl->set_var("basicTax[".$dueValue."]",formatCurrency($due->getBasicTax()));
															$this->tpl->set_var("sefTax[".$dueValue."]",formatCurrency($due->getSEFTax()));
															$this->tpl->set_var("idleTax[".$dueValue."]",formatCurrency($due->getIdleTax()));
															$this->tpl->set_var("taxDue[".$dueValue."]",formatCurrency($due->getTaxDue()));
															$this->tpl->set_var("dueDate[".$dueValue."]",date("M. d, Y",strtotime($due->getDueDate())));
															break;
													}
												}
											}

											$treasurySettings = new TreasurySettings;
											$treasurySettings->selectRecord();

											// initialize discountPeriod and discountPercentage for earlyPaymentDiscount 

											$this->tpl->set_var("discountPercentage",$treasurySettings->getDiscountPercentage()."%");
											$this->tpl->set_var("discountPeriod","January 01, ".date("Y")." - ".date("F d, Y",strtotime(date("Y")."-".$treasurySettings->getDiscountPeriod())));

											$this->formArray["discountPercentage"] = $treasurySettings->getDiscountPercentage();
											$this->formArray["discountPeriod"] = $treasurySettings->getDiscountPeriod();

											$this->formArray["discountPeriod_End"] = strtotime(date("Y")."-".$this->formArray["discountPeriod"]);
											$this->formArray["discountPeriod_Start"] = strtotime(date("Y")."-01-01");

											// initialize penaltyLUTArray

											$penaltyLUTArray = $treasurySettings->getPenaltyLUT();

											foreach($dueArrayList as $dKey => $due){
												$dueArrayList[$dKey]->setEarlyPaymentDiscountPeriod($this->formArray["discountPeriod"]);
												$dueArrayList[$dKey]->setEarlyPaymentDiscountPercentage($this->formArray["discountPercentage"]);

												// compute earlyPaymentDiscount as of today
												// check if today is within the discountPeriod and compute Discount
												if(strtotime($this->now) >= $this->formArray["discountPeriod_Start"] && strtotime($this->now) <= $this->formArray["discountPeriod_End"]){
													$dueArrayList[$dKey]->setEarlyPaymentDiscount($dueArrayList[$dKey]->getTaxDue() * ($this->formArray["discountPercentage"]/100));
												}
												else{
													$dueArrayList[$dKey]->setEarlyPaymentDiscount(0.00);
												}

												// compute Penalty as of today
												// check if today is exceeding dueDate and compute penalty

												if(strtotime($this->now) > strtotime($dueArrayList[$dKey]->getDueDate())){
													// count months

													// numYears = today[year] - dueDate[year]
													$numYears = date("Y",strtotime($this->now)) - date("Y",strtotime($dueArrayList[$dKey]->getDueDate()));
													// numMonths = today[month] - dueDate[month]
													$numMonths = date("n",strtotime($this->now)) - date("n",strtotime($dueArrayList[$dKey]->getDueDate()));
													// totalMonths = (numYears*12) + numMonths
													$totalMonths = ($numYears*12) + $numMonths;

													// associate penaltyPercentage

													if($totalMonths >= count($penaltyLUTArray)){
														$penaltyPercentage = 0.72;
													}
													else{			
														$penaltyPercentage = $penaltyLUTArray[$totalMonths];
													}

													$penalty = $dueArrayList[$dKey]->getTaxDue() * $penaltyPercentage;

													$dueArrayList[$dKey]->setMonthsOverDue($totalMonths);
													$dueArrayList[$dKey]->setPenaltyPercentage($penaltyPercentage);
													$dueArrayList[$dKey]->setPenalty($penalty);
												}
												else{
													$dueArrayList[$dKey]->setMonthsOverDue(0);
													$dueArrayList[$dKey]->setPenaltyPercentage(0.00);
													$dueArrayList[$dKey]->setPenalty(0.00);
												}

												$this->tpl->set_var("earlyPaymentDiscount[".$dKey."]",formatCurrency($dueArrayList[$dKey]->getEarlyPaymentDiscount()));
												$this->tpl->set_var("monthsOverDue[".$dKey."]",$dueArrayList[$dKey]->getMonthsOverDue());
												$this->tpl->set_var("penaltyPercentage[".$dKey."]",$dueArrayList[$dKey]->getPenaltyPercentage()*100);
												$this->tpl->set_var("penalty[".$dKey."]",formatCurrency($dueArrayList[$dKey]->getPenalty()));
											}
											$this->tpl->set_var("netDue",formatCurrency($dueArrayList["Annual"]->getNetDue()));
										}
									}

									$this->tpl->set_var("ctr", $tdCtr);
									$this->tpl->parse("defaultTDListBlock", "defaultTDList", true);
									$this->tpl->parse("toggleTDListBlock", "toggleTDList", true);
									$this->tpl->parse("TDListBlock", "TDList", true);
									/*
									$this->tpl->set_var("LandBlock", "");
									$this->tpl->set_var("PlantsTreesBlock", "");
									$this->tpl->set_var("ImprovementsBuildingsBlock", "");
									$this->tpl->set_var("MachineriesBlock", "");
									*/
									$tdCtr++;
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
		$this->setPageDetailPerms();

		$this->tpl->set_var("uname", $this->user["uname"]);

		$this->tpl->set_var("today", date("F j, Y",strtotime($this->now)));

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
