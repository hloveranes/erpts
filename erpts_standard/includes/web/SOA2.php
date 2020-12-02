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
require_once("collection/dues.php";

#####################################
# Define Interface Class
#####################################
class RPTOPDetails{
	
	var $tpl;
	var $formArray;
	function RPTOPDetails($http_post_vars,$sess,$rptopID){
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

		$this->tpl = new rpts_Template(getcwd());

		$this->tpl->set_file("rptsTemplate", "soa2.htm") ;
		$this->tpl->set_var("TITLE", "TM : Statement of Account");
		$this->formArray = array(
			"cityAssessorName" => ""
			, "cityTreasurerName" => ""
		);
		$this->formArray["rptopID"] = $rptopID;
			
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
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
			$this->hideBlock("ApplyPaymentsLink");
		}
		else{
			$this->hideBlock("GenerateRPTOPLinkText");
			$this->hideBlock("TreasuryMaintenanceLinkText");
			$this->hideBlock("ApplyPaymentsLinkText");
		}
	}
	
	function setForm(){
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
						$this->tpl->set_var("addressID", $lvalue->addressArray[0]->getAddressID());
						$this->tpl->set_var("number", $lvalue->addressArray[0]->getNumber());
						$this->tpl->set_var("street", $lvalue->addressArray[0]->getStreet());
						$this->tpl->set_var("barangay", $lvalue->addressArray[0]->getBarangay());
						$this->tpl->set_var("district", $lvalue->addressArray[0]->getDistrict());
						$this->tpl->set_var("municipalityCity", $lvalue->addressArray[0]->getMunicipalityCity());
						$this->tpl->set_var("province", $lvalue->addressArray[0]->getProvince());
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
						$this->tpl->set_var($lkey, "");
					}
				break;
				case "plottingsBy":
					if (is_a($lvalue,Assessor)){
						$this->tpl->set_var("plottingsByID", $lvalue->getAssessorID());
						$this->tpl->set_var("plottingsByName", $lvalue->getFullName());
					}
					else {
						$this->tpl->set_var($lkey, "");
					}
				break;
				case "notedBy":
					if (is_a($lvalue,Assessor)){
						$this->tpl->set_var("notedByID", $lvalue->getAssessorID());
						$this->tpl->set_var("notedByName", $lvalue->getFullName());
					}
					else {
						$this->tpl->set_var($lkey, "");
					}
				break;
				case "appraisedBy":
					if (is_a($lvalue,Assessor)){
						$this->tpl->set_var("appraisedByID", $lvalue->getAssessorID());
						$this->tpl->set_var("appraisedByName", $lvalue->getFullName());
					}
					else {
						$this->tpl->set_var($lkey, "");
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
					if (is_a($lvalue,Assessor)){
						$this->tpl->set_var("recommendingApprovalID", $lvalue->getAssessorID());
						$this->tpl->set_var("recommendingApprovalName", $lvalue->getFullName());
					}
					else {
						$this->tpl->set_var($lkey, "");
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
					if (is_a($lvalue,Assessor)){
						$this->tpl->set_var("approvedByID", $lvalue->getAssessorID());
						$this->tpl->set_var("approvedByName", $lvalue->getFullName());
					}
					else {
						$this->tpl->set_var($lkey, "");
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
											if (is_a($tdvalue,Assessor)){
												$this->tpl->set_var("provincialAssessorID", $tdvalue->getAssessorID());
												$this->tpl->set_var("provincialAssessorName", $tdvalue->getFullName());
											}
											else {
												$this->tpl->set_var($tdkey, "");
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
											if (is_a($tdvalue,Assessor)){
												$this->tpl->set_var("cityMunicipalAssessorID", $tdvalue->getAssessorID());
												$this->tpl->set_var("cityMunicipalAssessorName", $tdvalue->getFullName());
											}
											else {
												$this->tpl->set_var($tdkey, "");
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
											if (is_a($tdvalue,Assessor)){
												$this->tpl->set_var("enteredInRPARForByID", $tdvalue->getAssessorID());
												$this->tpl->set_var("enteredInRPARForByName", $tdvalue->getFullName());
											}
											else {
												$this->tpl->set_var($tdkey, "");
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

	function Main(){
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
							if (is_a($value,Assessor)){
								$this->tpl->set_var("cityAssessorID", $value->getAssessorID());
								$this->tpl->set_var("cityAssessorName", $value->getFullName());
								$this->formArray["cityAssessorName"] = $value->getFullName();
							}
							else {
								$this->tpl->set_var($key, "");
							}
						break;
						case "cityTreasurer":
							if (is_a($value,Assessor)){
								$this->tpl->set_var("cityTreasurerID", $value->getAssessorID());
								$this->tpl->set_var("cityTreasurerName", $value->getFullName());
								$this->formArray["cityTreasurerName"] = $value->getFullName();
							}
							else {
								$this->tpl->set_var($key, "");
							}
						break;
						case "tdArray":
							$this->tpl->set_block("rptsTemplate", "defaultTDList", "defaultTDListBlock");
							$this->tpl->set_block("rptsTemplate", "toggleTDList", "toggleTDListBlock");
							$this->tpl->set_block("rptsTemplate", "TDList", "TDListBlock");
							$tdCtr = 0;
							$totalBalance=0;
							if (count($value)){
								$this->tpl->set_block("rptsTemplate", "TDDBEmpty", "TDDBEmptyBlock");
								$this->tpl->set_var("TDDBEmptyBlock", "");
								$this->tpl->set_block("TDList", "Land", "LandBlock");
								$this->tpl->set_block("TDList", "PlantsTrees", "PlantsTreesBlock");
								$this->tpl->set_block("TDList", "ImprovementsBuildings", "ImprovementsBuildingsBlock");
								$this->tpl->set_block("TDList", "Machineries", "MachineriesBlock");
								foreach($value as $tkey => $tvalue){
									$propertyType = $tvalue->getPropertyType();
									$assessedValue = $tvalue->getAssessedValue();
									$afs = new AFS();			
									$afs->selectRecord($tvalue->getAfsID());
									$propertyIndexNumber = $afs->getPropertyIndexNumber();

									/*$propertyID = $tvalue->getPropertyID();
									switch ($propertyType){
										case "Land":
											$land = new Land;
											$land->selectRecord($propertyID);
											$assessedValue = $land->getAssessedValue();
											$propertyIdentityNumber = $land->getPropertyIndexNumber();
										break;
										case "PlantsTrees":
											$plantsTrees = new PlantsTrees;
											$plantsTrees->selectRecord($propertyID);
											$assessedValue = $plantsTrees->getAssessedValue();
											$PropertyIndexNumber = $plantsTrees->getPropertyIndexNumber();
										
										break;
										case "ImprovementsBuildings":
											$improvementsBuildings = new ImprovementsBuildings;
											$improvementsBuildings->selectRecord($propertyID);
											$assessedValue = $improvementsBuildings->getAssessedValue();
											$PropertyIndexNumber = $improvementsBuildings->getPropertyIndexNumber();
										
										break;
										case "Machineries":
											$machineries = new Machineries;
											$machineries->selectRecord($propertyID);
											$assessedValue = $machineries->getAssessedValue();
										    $PropertyIndexNumber = $machineries->getPropertyIndexNumber();	
										break;
										default:
										break;
									}*/
									# set or get the due for this TD
									//$taxDue = new Dues();
									
									$taxDue = new Dues($tvalue->getTdID(),$rptop->getTaxableYear(),$assessedValue);
                                    //$taxDue->create($tvalue->getTaxDeclarationNumber(), "Jan 1, ".$rptop->getRptopdate());
									//$taxDue->setBasic($assessedValue);
									//$taxDue->setSEF($assessedValue);
									//$taxDue->store();

									$dueValues['basic'] = number_format($taxDue->getBasic(),2);
									$dueValues['penalty'] = number_format($taxDue->getPenalty(),2);
									$dueValues['sef'] = number_format($taxDue->getSEF(),2);
									$dueValues['total'] = number_format($taxDue->getBasic() + $taxDue->getSEF() + $taxDue->getPenalty(),2);
									$this->tpl->set_var($dueValues);	

									$paidValues['paidBasic'] = number_format($taxDue->getPaidBasic(),2);
									$paidValues['paidPenalty'] = number_format($taxDue->getPaidPenalty(),2);
									$paidValues['paidSEF'] = number_format($taxDue->getPaidSEF(),2);
									$paidValues['paidTotal'] = number_format($taxDue->getPaidBasic() + $taxDue->getPaidPenalty() + $taxDue->getPaidSEF(),2);
									$this->tpl->set_var($paidValues);	
									
									$balance = (round($taxDue->getBasic(),2) + round($taxDue->getSEF(),2) + round($taxDue->getPenalty(),2)) - ($taxDue->getPaidBasic() + $taxDue->getPaidPenalty() + $taxDue->getPaidSEF());
									$totalBalance += $balance;
									$this->tpl->set_var(balance, number_format(abs($balance),2));
									
									$totalValues['totAssessedValue'] += $assessedValue;
									$totalValues['totBasic'] += round($taxDue->getBasic(),2);
									$totalValues['totPenalty'] += round($taxDue->getPenalty(),2);
									$totalValues['totSEF'] += round($taxDue->getSEF(),2);
									$totalValues['totTotal'] += (round($taxDue->getBasic(),2) + round($taxDue->getPenalty(),2) + round($taxDue->getSEF(),2));

									$totPaidBasic += $taxDue->getPaidBasic();
									$totPaidPenalty += $taxDue->getPaidPenalty();
									$totPaidSEF += $taxDue->getPaidSEF();
									$totPaidTotal += ($taxDue->getPaidBasic() + $taxDue->getPaidPenalty() + $taxDue->getPaidSEF());
									$totalValues['totPaidBasic'] = number_format($totPaidBasic,2);
									$totalValues['totPaidPenalty'] = number_format($totPaidPenalty,2);
									$totalValues['totPaidSEF'] = number_format($totPaidSEF,2);
									$totalValues['totPaidTotal'] = number_format($totPaidTotal,2);

									$tdValues['assessedValue'] = number_format($assessedValue,2);
									$tdValues['tdNumber'] = $tvalue->getTaxDeclarationNumber();
									$tdValues['propertyIndexNumber'] = $propertyIndexNumber;
								    $this->tpl->set_var($tdValues);	

									$this->tpl->set_var("ctr", $tdCtr);
									$this->tpl->parse("TDListBlock", "TDList", true);
									$tdCtr++;
								}
							}
							else {
								$this->tpl->set_var("TDListBlock", "");
							}
							$this->tpl->set_var("tdCtr", $tdCtr);
						break;
						default:
						$this->formArray[$key] = $value;
					}
				}
			}	
		}
		$this->setForm();

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->setPageDetailPerms();
		
		$this->tpl->set_var(totBalance, number_format(abs($totalBalance),2));
		$this->tpl->set_var(amountDue, number_format(abs($totalValues['totTotal']-un_number_format($totalValues['totPaidTotal'])),2));

		$totalValues['totAssessedValue'] = number_format($totalValues['totAssessedValue'],2);
		$totalValues['totBasic'] = number_format($totalValues['totBasic'],2);
		$totalValues['totPenalty'] = number_format($totalValues['totPenalty'],2);
		$totalValues['totSEF'] = number_format($totalValues['totSEF'],2);
		$totalValues['totTotal'] = number_format($totalValues['totTotal'],2);
		$totPaidalValues['totPaidBasic'] = number_format($totPaidalValues['totPaidBasic'],2);
		$totPaidalValues['totPaidPenalty'] = number_format($totPaidalValues['totPaidPenalty'],2);
		$totPaidalValues['totPaidSEF'] = number_format($totPaidalValues['totPaidSEF'],2);
		$totPaidalValues['totPaidTotal'] = number_format($totPaidalValues['totPaidTotal'],2);

		$this->tpl->set_var($totalValues);
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
page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/
$ownerList = new RPTOPDetails($HTTP_POST_VARS,$sess,$rptopID);
$ownerList->main();
?>
<?php page_close(); ?>
