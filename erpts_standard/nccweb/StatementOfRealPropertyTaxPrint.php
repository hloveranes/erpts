<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/web/clibPDFWriter.php";

include_once "../includes/assessor/Barangay.php";
include_once "../includes/assessor/Province.php";
include_once "../includes/assessor/ProvinceRecords.php";

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

include_once "../includes/assessor/ODHistoryRecords.php";
include_once "../includes/assessor/ODHistory.php";

include_once "../includes/assessor/eRPTSSettings.php";

include_once "../includes/collection/Due.php";
include_once "../includes/collection/DueRecords.php";
include_once "../includes/collection/TreasurySettings.php";
include_once "../includes/collection/BacktaxTD.php";
include_once "../includes/collection/BacktaxTDRecords.php";

include_once "../includes/collection/PaymentRecords.php";
include_once "../includes/collection/ReceiptRecords.php";
include_once "../includes/collection/CollectionRecords.php";

#####################################
# Define Interface Class
#####################################
class RPTOPDetails{
	
	var $tpl;
	var $formArray;
	var $tdArrayList;
	var $tdRecord;
	var $tdArrayListCounter = 0;

	var $now;

	function RPTOPDetails($http_post_vars,$sess,$rptopID){
		global $auth;

		$this->now = "now";

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

		$this->tpl->set_file("rptsTemplate", "statementOfRealPropertyTax.xml") ;
		$this->tpl->set_var("TITLE", "SOA Details");

		$this->formArray = array(
			"cityAssessorName" => ""
			, "cityTreasurerName" => ""
		);

		$this->formArray["rptopID"] = $rptopID;
		$this->formArray["ownerID"] = $ownerID;
		$this->formArray["lguType"] = "";
		$this->formArray["lguName"] = "";
		$this->formArray["provinceName"] = "";
		$this->formArray["ownerName"] = "";
		$this->formArray["preparedBy"] = "";
		$this->formArray["preparedByDesignation"] = "";
		$this->formArray["approvedBy"] = "";
		$this->formArray["approvedByDesignation1"] = "";
		$this->formArray["approvedByDesignation2"] = "";
		$this->formArray["tdYPosValue"] = "564";

		$this->formArray["landTotalMarketValue"] = 0;
		$this->formArray["landTotalAssessedValue"] = 0;
		$this->formArray["plantTotalMarketValue"] = 0;
		$this->formArray["plantTotalAssessedValue"] = 0;
		$this->formArray["bldgTotalMarketValue"] = 0;
		$this->formArray["bldgTotalAssessedValue"] = 0;
		$this->formArray["machTotalMarketValue"] = 0;
		$this->formArray["machTotalAssessedValue"] = 0;	

		$this->formArray["discountPercentage"] = "";
		$this->formArray["discountPeriod"] = "";
		$this->formArray["earlyPaymentDiscount[Annual]"] = "";
		$this->formArray["earlyPaymentDiscount[Q1]"] = "";
		$this->formArray["earlyPaymentDiscount[Q2]"] = "";
		$this->formArray["earlyPaymentDiscount[Q3]"] = "";
		$this->formArray["earlyPaymentDiscount[Q4]"] = "";
		$this->formArray["advancedDiscountPercentage"] = "";
		$this->formArray["q1AdvancedDiscountPercentage"] = "";
		$this->formArray["advancedPaymentDiscount[Annual]"] = "";
		$this->formArray["advancedPaymentDiscount[Q1]"] = "";
		$this->formArray["advancedPaymentDiscount[Q2]"] = "";
		$this->formArray["advancedPaymentDiscount[Q3]"] = "";
		$this->formArray["advancedPaymentDiscount[Q4]"] = "";
		$this->formArray["monthsOverDue[Annual]"] = "";
		$this->formArray["monthsOverDue[Q1]"] = "";
		$this->formArray["monthsOverDue[Q2]"] = "";
		$this->formArray["monthsOverDue[Q3]"] = "";
		$this->formArray["monthsOverDue[Q4]"] = "";
		$this->formArray["penaltyPercentage[Annual]"] = "";
		$this->formArray["penaltyPercentage[Q1]"] = "";
		$this->formArray["penaltyPercentage[Q2]"] = "";
		$this->formArray["penaltyPercentage[Q3]"] = "";
		$this->formArray["penaltyPercentage[Q4]"] = "";
		$this->formArray["penalty[Annual]"] = "";
		$this->formArray["penalty[Q1]"] = "";
		$this->formArray["penalty[Q2]"] = "";
		$this->formArray["penalty[Q3]"] = "";
		$this->formArray["penalty[Q4]"] = "";

		$this->formArray["totalTaxDue"] = 0.00;
		$this->formArray["totalNetDue"] = 0.00;

		$this->tdRecord = array(
			"arpNumber"
			,"class"
			,"location"
			,"year"
			,"taxDue");

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

		$this->formArray["totalNetDue"] = number_format($this->formArray["totalNetDue"],2, ".", ",");

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
			$this->hideBlock("TreasuryMaintenanceLink");
		}
		else{
			$this->hideBlock("TreasuryMaintenanceLinkText");
		}
	}

	function displayNetDue(){
		// commented out on on February 14, 2005:
		/*
		$this->netDue["Annual"] = ($this->initialNetDue["Annual"] + $this->formArray["totalBacktaxesBalance"]) - $this->formArray["totalPaid"];
		if($this->netDue["Annual"] < 0) $this->netDue["Annual"]=0;
		if(round($this->netDue["Annual"])==0) $this->netDue["Annual"] = 0;
		*/

		// and modified with the following code that removes "+ this->formArray[totalBacktaxesBalance]"
		$this->netDue["Annual"] = ($this->initialNetDue["Annual"]) - $this->formArray["totalPaid"];
		if($this->netDue["Annual"] < 0) $this->netDue["Annual"]=0;
		if(round($this->netDue["Annual"])==0) $this->netDue["Annual"] = 0;

//		$this->netDue["Q1"] = ($this->initialNetDue["Q1"] + $this->formArray["totalBacktaxesBalance"]) - $this->formArray["totalPaid"];;
//		$this->netDue["Q1"] = ($this->initialNetDue["Q1"] + $this->formArray["totalBacktaxesBalance"]) - 75;
		$this->netDue["Q1"] = ($this->initialNetDue["Q1"]) - $this->amountPaid["Q1"];
		if($this->netDue["Q1"] < 0) $this->netDue["Q1"]=0;
		if(round($this->netDue["Q1"])==0) $this->netDue["Q1"] = 0;

//		$this->netDue["Q2"] = ($this->initialNetDue["Q1"] + $this->initialNetDue["Q2"] + $this->formArray["totalBacktaxesBalance"]) - $this->formArray["totalPaid"];;
//		$this->netDue["Q2"] = ($this->initialNetDue["Q1"] + $this->initialNetDue["Q2"] + $this->formArray["totalBacktaxesBalance"]) - 75;
//		if($this->netDue["Q2"] > $this->initialNetDue["Q2"]) $this->netDue["Q2"] = $this->initialNetDue["Q2"];
		$this->netDue["Q2"] = ($this->initialNetDue["Q2"]) - $this->amountPaid["Q2"];
		if($this->netDue["Q2"] < 0) $this->netDue["Q2"]=0;
		if(round($this->netDue["Q2"])==0) $this->netDue["Q2"] = 0;

//		$this->netDue["Q3"] = ($this->initialNetDue["Q1"] + $this->initialNetDue["Q2"] + $this->initialNetDue["Q3"] + $this->formArray["totalBacktaxesBalance"]) - $this->formArray["totalPaid"];;
//		$this->netDue["Q2"] = ($this->initialNetDue["Q1"] + $this->initialNetDue["Q2"] + $this->initialNetDue["Q3"] + $this->formArray["totalBacktaxesBalance"]) - 75;
//		if($this->netDue["Q3"] > $this->initialNetDue["Q3"]) $this->netDue["Q3"] = $this->initialNetDue["Q3"];
		$this->netDue["Q3"] = ($this->initialNetDue["Q3"]) - $this->amountPaid["Q3"];
		if($this->netDue["Q3"] < 0) $this->netDue["Q3"]=0;
		if(round($this->netDue["Q3"])==0) $this->netDue["Q3"] = 0;

//		$this->netDue["Q4"] = ($this->initialNetDue["Q1"] + $this->initialNetDue["Q2"] + $this->initialNetDue["Q3"] + $this->initialNetDue["Q4"] + $this->formArray["totalBacktaxesBalance"]) - $this->formArray["totalPaid"];;
//		$this->netDue["Q4"] = ($this->initialNetDue["Q1"] + $this->initialNetDue["Q2"] + $this->initialNetDue["Q3"] + $this->initialNetDue["Q4"] + $this->formArray["totalBacktaxesBalance"]) - 75;
//		if($this->netDue["Q4"] > $this->initialNetDue["Q4"]) $this->netDue["Q4"] = $this->initialNetDue["Q4"];
		$this->netDue["Q4"] = ($this->initialNetDue["Q4"]) - $this->amountPaid["Q4"];
		if($this->netDue["Q4"] < 0) $this->netDue["Q4"]=0;
		if(round($this->netDue["Q4"])==0) $this->netDue["Q4"] = 0;

		// default netDue values to flat 0 when fully paid to scratch off decimals

		if($this->netDue["Annual"]<=0){
			$this->netDue["Q1"] = 0;
			$this->netDue["Q2"] = 0;
			$this->netDue["Q3"] = 0;
			$this->netDue["Q4"] = 0;
		}

		if($this->netDue["Q4"]<=0){
			if($this->netDue["Q3"]<=0){
				if($this->netDue["Q2"]<=0){
					if($this->netDue["Q1"]<=0){
						$this->netDue["Annual"]=0;
					}
				}
			}
		}

		$this->tpl->set_var("netDue[Annual]",formatCurrency(round($this->netDue["Annual"],4)));
		$this->tpl->set_var("netDue[Q1]",formatCurrency(round($this->netDue["Q1"],4)));
		$this->tpl->set_var("netDue[Q2]",formatCurrency(round($this->netDue["Q2"],4)));
		$this->tpl->set_var("netDue[Q3]",formatCurrency(round($this->netDue["Q3"],4)));
		$this->tpl->set_var("netDue[Q4]",formatCurrency(round($this->netDue["Q4"],4)));
		$this->tpl->set_var("netDue",formatCurrency(round($this->netDue["Annual"],4)));

		$this->tdRecord["taxDue"] = $this->netDue["Annual"];

		$this->formArray["totalNetDue"] += $this->netDue["Annual"];
	}
	
	function getPaymentHistory($dueArrayList="",$backtaxTDID=""){
		$condition = " WHERE status='' AND (";
		if(!is_array($dueArrayList)){
			$condition .= " backtaxTDID = '".$backtaxTDID."' ";
		}
		else{
			$dueCount = 0;
			foreach($dueArrayList as $due){
				if($dueCount > 0){
					$condition .= " OR";
				}
				$condition .= " dueID='".$due->getDueID()."'";
				$dueCount++;
			}
		}
		$condition .= " ) ";
		$condition .= " ORDER BY paymentDate DESC, paymentID DESC";

		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php","urn:Object");
		if(!$xmlStr = $PaymentList->getPaymentList($condition)){
			false;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				false;
			}
			else{
				$paymentRecords = new PaymentRecords;
				$paymentRecords->parseDomDocument($domDoc);

				return $paymentRecords;
			}
		}
	}
	

	function displayTotalPaid(){
		// establish paymentrecords condition

		$this->formArray["totalPaid"] = 0;

		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php","urn:Object");
		$CollectionList = new SoapObject(NCCBIZ."CollectionList.php","urn:Object");

		if(!$xmlStr = $PaymentList->getPaymentListFromIDArrays($this->dueIDArray,$this->backtaxTDIDArray)){
			// error xmlStr
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
			}
			else{
				$paymentRecords = new PaymentRecords;
				$paymentRecords->parseDomDocument($domDoc);
				$paymentArrayList = $paymentRecords->getArrayList();

				$this->amountPaid = array("Annual"=>0, "Q1"=>0, "Q2"=>0, "Q3"=>0, "Q4"=>0);

				foreach($paymentArrayList as $payment){
					if($payment->getStatus()!="cancelled"){
						$this->paymentIDArray[] = $payment->getPaymentID();
						$this->amountPaid[$payment->getDueType()] += $payment->getAmountPaid();
						$this->formArray["totalPaid_P"] += $payment->getAmountPaid();
					}
				}

				if(!$xmlStr = $CollectionList->getCollectionListFromIDArrays($this->paymentIDArray,"")){
					// error xmlStr
				}
				else{
					if(!$domDoc = domxml_open_mem($xmlStr)){
						// error domDoc
					}
					else{
						$collectionRecords = new CollectionRecords;
						$collectionRecords->parseDomDocument($domDoc);
						$collectionArrayList = $collectionRecords->getArrayList();

						foreach($collectionArrayList as $collection){
							if($collection->getStatus()!="cancelled"){
								$this->formArray["totalPaid"] += $collection->getAmountPaid();
							}
						}

					}
				}
			}
		}

		$this->tpl->set_var("totalPaid",number_format($this->formArray["totalPaid"],2));
		
		unset($this->paymentIDArray);
		unset($this->dueIDArray);
		unset($this->backtaxTDIDArray);
	}
	
	function getTreasurySettings(){
		$treasurySettings = new TreasurySettings;
		$treasurySettings->selectRecord();
		return $treasurySettings;
	}

	function getPenaltyLUTArray(){
		$treasurySettings = $this->getTreasurySettings();
		$penaltyLUTArray = $treasurySettings->getPenaltyLUT();
		$this->formArray["penaltyLUTArray"] = $treasurySettings->getPenaltyLUT();
		return $penaltyLUTArray;
	}	
/*
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
*/

	function displayOwnerList($domDoc){
		$owner = new Owner;
		$owner->parseDomDocument($domDoc);
		//$list = $owner->getArrayList();
		//foreach ($list as $key => $value){
			if (count($owner->personArray)){
				$pname = "";
				foreach($owner->personArray as $personKey =>$personValue){
					if (!$personValue->getName() || $personValue->getName==""){
						$pname = "";
					}
					if($pname!=""){
						$pname .= ", ";
					}
					$ownerNames[] = $personValue->getName();
					$pname .= $personValue->getName();
				}
			}
			else{
				$pname = "";
			}
			if (count($owner->companyArray)){
				foreach ($owner->companyArray as $companyKey => $companyValue){
					if (!$companyValue->getCompanyName() || $companyValue->getCompanyName()==""){
						$cname = "";
					}
					if($cname!=""){
						$cname .= ", ";
					}
					$ownerNames[] = $companyValue->getCompanyName();
					$cname .= $companyValue->getCompanyName();
				}
			}
			else{
				$cname = "";
			}
		//}

		if(is_array($ownerNames)){
			sort($ownerNames);
			reset($ownerNames);
			$this->formArray["ownerName"] = implode(" ,", $ownerNames);
		}
		else{
			$this->formArray["ownerName"] = "";
		}
	}

	function getPrecedingTDArray($td){
		$ODDetails = new SoapObject(NCCBIZ."ODDetails.php", "urn:Object");

		if($this->formArray["odID"] = $ODDetails->getOdIDFromTdID($td->getTdID())){
			$ODHistoryList = new SoapObject(NCCBIZ."ODHistoryList.php", "urn:Object");
			$ODHistoryRecords = new ODHistoryRecords;

			if(!$xmlStr = $ODHistoryList->getPrecedingODList($this->formArray["odID"])){
				// do nothing. no preceding OD
				return false;
			}
			else{
				if(!$domDoc = domxml_open_mem($xmlStr)){
					// no nothing. no preceding OD
					return false;
				}
				else{
					$ODHistoryRecords->parseDomDocument($domDoc);
					$precedingODList = $ODHistoryRecords->arrayList;

					$AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
					$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
					$TDDetails = new SoapObject(NCCBIZ."TDDetails.php", "urn:Object");

					foreach($precedingODList as $key => $odHistory){
						$previousODID = $odHistory->getPreviousODID();
						$previousAFSID = $AFSEncode->getAfsID($previousODID);
						$previousAFSxml = $AFSDetails->getAfs($previousAFSID);
						$previousAFSdomDoc = domxml_open_mem($previousAFSxml);
						$previousAFS = new AFS;
						$previousAFS->parseDomDocument($previousAFSdomDoc);

						$precedingTDxml = $TDDetails->getTDFromAfsID($previousAFSID);
						$precedingTDdomDoc = domxml_open_mem($precedingTDxml);
						$precedingTD = new TD;
						$precedingTD->parseDomDocument($precedingTDdomDoc);
						$this->precedingTDArray[] = $precedingTD;
					}
				}
				return $this->precedingTDArray;
			}
		}
	}

/*
	function displayBacktaxTD($tdID){
		$BacktaxTDDetails = new SoapObject(NCCBIZ."BacktaxTDDetails.php", "urn:Object");
		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php","urn:Object");
		$CollectionList = new SoapObject(NCCBIZ."CollectionList.php","urn:Object");

		if (!$xmlStr = $BacktaxTDDetails->getBacktaxTDList($tdID)){
			$this->tpl->set_block("TDList", "BacktaxesTable", "BacktaxesTableBlock");
			$this->tpl->set_var("BacktaxesTableBlock", "no backtaxes");
		}
		else{
			//echo $xmlStr;
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_block("TDList", "BacktaxesTable", "BacktaxesTableBlock");
				$this->tpl->set_var("BacktaxesTableBlock", "no backtaxes");
			}
			else {
				$backtaxTDRecords = new BacktaxTDRecords;
				$backtaxTDRecords->parseDomDocument($domDoc);

				$backTaxTDList = $backtaxTDRecords->getArrayList();
				//$this->tpl->set_block("TDList", "BacktaxesList", "BacktaxesListBlock");
				//$this->tpl->set_block("rptsTemplate", "BacktaxesDBEmpty", "BacktaxesDBEmptyBlock");
				if(count($backTaxTDList)){
					//$this->tpl->set_var("BacktaxesDBEmptyBlock", "");
					foreach ($backTaxTDList as $key => $val){
						// check Paid values from Payments and increment to paid value in BacktaxTD
						$condition = " WHERE backtaxTDID = '".$val->getBacktaxTDID()."'";
						$condition .= " AND status='' ";
						$condition .= " ORDER BY paymentDate DESC ";
						if(!$xmlStr = $PaymentList->getPaymentList($condition)){
							// error xmlStr. do nothing
						}
						else{
							if(!$domDoc = domxml_open_mem($xmlStr)){
								// error domDoc. do nothing
							}
							else{
								$paymentRecords = new PaymentRecords;
								$paymentRecords->parseDomDocument($domDoc);
								$paymentArrayList = $paymentRecords->getArrayList();
								$collectionCondition = "WHERE status='' AND (";
								$paymentCount = 0;
								foreach($paymentArrayList as $payment){
									if($paymentCount>0){
										$collectionCondition .= " OR";
									}
									$collectionCondition .= " paymentID = '".$payment->getPaymentID()."' ";
									$paymentCount++;
								}
								$collectionCondition .= ") ";
								

								if(!$xmlStr = $CollectionList->getCollectionList($collectionCondition)){
									// error xmlStr
								}
								else{
									if(!$domDoc = domxml_open_mem($xmlStr)){
										// error domDoc
									}
									else{
										$collectionRecords = new CollectionRecords;
										$collectionRecords->parseDomDocument($domDoc);
										$collectionArrayList = $collectionRecords->getArrayList();
										$totalPaid = 0;
										foreach($collectionArrayList as $collection){
											$totalPaid += $collection->getAmountPaid();
										}
										$totalPaid += $val->getPaid();

										// to avoid -0.01, 0.01 balances
										if($totalPaid!=$payment->getAmountPaid()) $totalPaid = $payment->getAmountPaid();

										$val->setPaid($totalPaid);
									}
								}
							}
						}

						// calculate Penalties verses either today or verses the last paymentDate

						/*
						echo "backtaxTDID:".$val->getBacktaxTDID();
						echo "<br>";
						echo "startYear:".$val->getStartYear();
						echo "<br>";
						echo "startQuarter:".$val->getStartQuarter();
						echo "<br>";
						*/

						/*
						
						$payment = new Payment;
						if($payment->selectRecordFromCondition("WHERE status!='cancelled' AND backtaxTDID='".$val->getBacktaxTDID()."'")){
							$lastPaymentDate = $payment->getPaymentDate();
							$lastPaymentDate = $payment->getPaymentDate();
							$lastPaymentDueType = $payment->getDueType();
							$amnestyStatus = $payment->getAmnesty();							
						}
						else{
							$lastPaymentDate = "now";
						}
						
						if($lastPaymentDate!=""){
							$val->calculatePenalty($lastPaymentDate);

							//echo "val->calculatePenalty(".$lastPaymentDate.")";
							// if balance is 0 leave penalty as is, otherwise calculatePenalty according to date now
							$balanceB = $val->getTotalTaxDue();

							$penaltyLUTArray = $this->getPenaltyLUTArray();

							switch($lastPaymentDueType){
								case "Q1":
									$btDueDate = date("M. d, Y",strtotime($val->getStartYear()."-03-31"));
									$btBasicTax = roundUpNearestFiveCent($val->getBasicTax()/4);
									$btSefTax = roundUpNearestFiveCent($val->getSEFTax()/4);
									$btIdleTax = roundUpNearestFiveCent($val->getIdleTax()/4);
									$btTaxDue = $btBasicTax + $btSefTax + $btIdleTax;
									$btPenalty = $this->btCalculateQuarterlyPenalty($lastPaymentDate,$btTaxDue,$lastPaymentDueType,$btDueDate);
									$balanceB = ($btTaxDue + $btPenalty) - $totalPaid;
									break;
								case "Q2":
									$btDueDate = date("M. d, Y",strtotime($val->getStartYear()."-06-30"));
									$btBasicTax = roundUpNearestFiveCent($val->getBasicTax()/4);
									$btSefTax = roundUpNearestFiveCent($val->getSEFTax()/4);
									$btIdleTax = roundUpNearestFiveCent($val->getIdleTax()/4);
									$btTaxDue = $btBasicTax + $btSefTax + $btIdleTax;
									$btPenalty = $this->btCalculateQuarterlyPenalty($lastPaymentDate,$btTaxDue,$lastPaymentDueType,$btDueDate);
									$balanceB = ($btTaxDue + $btPenalty) - $totalPaid;
									break;
								case "Q3":
									$btDueDate = date("M. d, Y",strtotime($val->getStartYear()."-09-30"));
									$btBasicTax = roundUpNearestFiveCent($val->getBasicTax()/4);
									$btSefTax = roundUpNearestFiveCent($val->getSEFTax()/4);
									$btIdleTax = roundUpNearestFiveCent($val->getIdleTax()/4);
									$btTaxDue = $btBasicTax + $btSefTax + $btIdleTax;
									$btPenalty = $this->btCalculateQuarterlyPenalty($lastPaymentDate,$btTaxDue,$lastPaymentDueType,$btDueDate);
									$balanceB = ($btTaxDue + $btPenalty) - $totalPaid;
									break;
								case "Q4":
									$btDueDate = date("M. d, Y",strtotime($val->getStartYear()."-12-31"));
									$btBasicTax = roundUpNearestFiveCent($val->getBasicTax()/4);
									$btSefTax = roundUpNearestFiveCent($val->getSEFTax()/4);
									$btIdleTax = roundUpNearestFiveCent($val->getIdleTax()/4);
									$btTaxDue = $btBasicTax + $btSefTax + $btIdleTax;
									$btPenalty = $this->btCalculateQuarterlyPenalty($lastPaymentDate,$btTaxDue,$lastPaymentDueType,$btDueDate);
									$balanceB = ($btTaxDue + $btPenalty) - $totalPaid;
									break;
							}
							

							$penaltyComputeDate = $lastPaymentDate;

							// 0.1 is used instead of 0 because sometimes rounded off balances intended to be 0 end up appearing as 0.002 or so...
							if(round($balanceB,4) > 0.1){
								$val->calculatePenalty($this->now);
								$penaltyComputeDate = $this->now;

								$btBasicTax = $val->getBasicTax();
								$btSefTax = $val->getSEFTax();
								$btIdleTax = $val->getIdleTax();
								$btTaxDue = $val->getBasicTax + $val->getSEFTax() + $val->getIdleTax();
								$btPenalty = $val->getPenalties();
								$btDueDate = date("M. d, Y",strtotime($val->getStartYear()."-03-31"));
							}
						}
						else{
							$val->calculatePenalty($this->now);
							$penaltyComputeDate = $this->now;

							$btBasicTax = $val->getBasicTax();
							$btSefTax = $val->getSEFTax();
							$btIdleTax = $val->getIdleTax();
							$btTaxDue = $val->getBasicTax + $val->getSEFTax() + $val->getIdleTax();
							$btPenalty = $val->getPenalties();
							$btDueDate = date("M. d, Y",strtotime($val->getStartYear()."-03-31"));
						}
						
						if($amnestyStatus=="true"){
							$this->tpl->set_var("amnestyB", "<= waived");
							$val->setPenalties(0);
						}
						else{
							$this->tpl->set_var("amnestyB", "");
						}

						$this->tpl->set_var("backtaxTDID", $val->getBacktaxTDID());

						$this->tpl->set_var("tdNumberB", $val->getTdNumber());
						$this->tpl->set_var("startYearB", $val->getStartYear());
						$this->tpl->set_var("endYearB", $val->getEndYear());
						$this->tpl->set_var("startQuarterB", $val->getStartQuarter());
						$this->tpl->set_var("assessedValueB", number_format($val->getAssessedValue(),2));
						$this->tpl->set_var("basicRateB", number_format($val->getBasicRate(),2));
						$this->tpl->set_var("sefRateB", number_format($val->getSEFRate(),2));

						$this->tpl->set_var("basicTaxB", number_format($val->getBasicTax(),2));
						$this->tpl->set_var("sefTaxB", number_format($val->getSEFTax(),2));
						$this->tpl->set_var("idleTaxB", number_format($val->getIdleTax(),2));
						$this->tpl->set_var("penaltiesB", number_format($val->getPenalties(),2));
						$this->tpl->set_var("paidB", number_format($val->getPaid(),2));
						$this->tpl->set_var("balanceB", number_format($val->getTotalTaxDue(),2));
						$this->tpl->set_var("totalTaxDueB", number_format($val->getTotal(),2));

						$this->formArray["totalBacktaxesDue"] = 0;
						$this->formArray["totalBacktaxesDue"] += $val->getBasicTax();
						$this->formArray["totalBacktaxesDue"] += $val->getSefTax();
						$this->formArray["totalBacktaxesDue"] += $val->getIdleTax();
						$this->formArray["totalBacktaxesDue"] += $val->getPenalties();
						$this->tpl->parse("BacktaxesListBlock", "BacktaxesList", true);
						$this->formArray["totalBacktaxesBalance"] += ($val->getTotalTaxDue() + $val->getPaid());

						$this->backtaxTDIDArray[] = $val->getBacktaxTDID();
					}

				}
				else{
					//$this->tpl->set_block("TDList", "Backtax", "BacktaxBlock");
					//$this->tpl->set_var("BacktaxBlock", "");
				}
			}
		}
	}

*/
//*/

	function displayBacktaxTD($tdID){
		$backtaxTDRecord = array(
			"arpNumber" => ""
			,"class" => ""
			,"location" => ""
			,"year" => ""
			,"taxDue" => "");

		$BacktaxTDDetails = new SoapObject(NCCBIZ."BacktaxTDDetails.php", "urn:Object");
		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php","urn:Object");
		$CollectionList = new SoapObject(NCCBIZ."CollectionList.php","urn:Object");

		if (!$xmlStr = $BacktaxTDDetails->getBacktaxTDList($tdID)){
			// error xml
		}
		else{
			//echo $xmlStr;
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
			}
			else {
				$backtaxTDRecords = new BacktaxTDRecords;
				$backtaxTDRecords->parseDomDocument($domDoc);

				$backTaxTDList = $backtaxTDRecords->getArrayList();
				//$this->tpl->set_block("TDList", "BacktaxesList", "BacktaxesListBlock");
				//$this->tpl->set_block("rptsTemplate", "BacktaxesDBEmpty", "BacktaxesDBEmptyBlock");
				if(count($backTaxTDList)){
					//$this->tpl->set_var("BacktaxesDBEmptyBlock", "");
					foreach ($backTaxTDList as $key => $val){
						// check Paid values from Payments and increment to paid value in BacktaxTD
						$condition = " WHERE backtaxTDID = '".$val->getBacktaxTDID()."'";
						$condition .= " AND status='' ";
						$condition .= " ORDER BY paymentDate DESC ";
						if(!$xmlStr = $PaymentList->getPaymentList($condition)){
							// error xmlStr. do nothing
						}
						else{
							if(!$domDoc = domxml_open_mem($xmlStr)){
								// error domDoc. do nothing
							}
							else{
								$paymentRecords = new PaymentRecords;
								$paymentRecords->parseDomDocument($domDoc);
								$paymentArrayList = $paymentRecords->getArrayList();
								$collectionCondition = "WHERE status='' AND (";
								$paymentCount = 0;
								foreach($paymentArrayList as $payment){
									if($paymentCount>0){
										$collectionCondition .= " OR";
									}
									else{
										$lastPaymentDate = $payment->getPaymentDate();
									}
									$collectionCondition .= " paymentID = '".$payment->getPaymentID()."' ";
									$paymentCount++;
								}
								$collectionCondition .= ") ";

								if(!$xmlStr = $CollectionList->getCollectionList($collectionCondition)){
									// error xmlStr
								}
								else{
									if(!$domDoc = domxml_open_mem($xmlStr)){
										// error domDoc
									}
									else{
										$collectionRecords = new CollectionRecords;
										$collectionRecords->parseDomDocument($domDoc);
										$collectionArrayList = $collectionRecords->getArrayList();
										$totalPaid = 0;
										foreach($collectionArrayList as $collection){
											$totalPaid += $collection->getAmountPaid();
										}

										// to avoid -0.01, 0.01 balances
										if($totalPaid!=$payment->getAmountPaid()) $totalPaid = $payment->getAmountPaid();

										$totalPaid += $val->getPaid();
										$val->setPaid($totalPaid);
									}
								}
							}
						}

						// calculate Penalties verses either today or verses the last paymentDate

						/*
						echo "backtaxTDID:".$val->getBacktaxTDID();
						echo "<br>";
						echo "startYear:".$val->getStartYear();
						echo "<br>";
						echo "startQuarter:".$val->getStartQuarter();
						echo "<br>";
						*/

						if($lastPaymentDate!=""){
							$val->calculatePenalty($lastPaymentDate);
							//echo "val->calculatePenalty(".$lastPaymentDate.")";
							// if balance is 0 leave penalty as is, otherwise calculatePenalty according to date now
							$balanceB = $val->getTotalTaxDue();
							if(round($balanceB,4) > 0){
								$val->calculatePenalty($this->now);
								//echo "val->calculatePenalty(".$this->now.")";
							}
						}
						else{
							$val->calculatePenalty($this->now);
							//echo "val->calculatePenalty(".$this->now.")";
						}

						//echo "<hr>";

						$this->tpl->set_var("backtaxTDID", $val->getBacktaxTDID());
						$this->tpl->set_var("tdNumberB", $val->getTdNumber());
						$this->tpl->set_var("startYearB", $val->getStartYear());
						$this->tpl->set_var("endYearB", $val->getEndYear());
						$this->tpl->set_var("startQuarterB", $val->getStartQuarter());
						$this->tpl->set_var("assessedValueB", number_format($val->getAssessedValue(),2));
						$this->tpl->set_var("basicRateB", number_format($val->getBasicRate(),2));
						$this->tpl->set_var("sefRateB", number_format($val->getSEFRate(),2));
						$this->tpl->set_var("basicTaxB", number_format($val->getBasicTax(),2));
						$this->tpl->set_var("sefTaxB", number_format($val->getSEFTax(),2));
						$this->tpl->set_var("idleTaxB", number_format($val->getIdleTax(),2));

						$this->tpl->set_var("penaltiesB", number_format($val->getPenalties(),2));
						$this->tpl->set_var("paidB", number_format($val->getPaid(),2));
						$this->tpl->set_var("balanceB", number_format($val->getTotalTaxDue(),2));
						$this->tpl->set_var("totalTaxDueB", number_format($val->getTotal(),2));

						// $this->tpl->set_var("taxDue", number_format($val->getTotal(),2));


						$this->formArray["totalBacktaxesDue"] = 0;
						$this->formArray["totalBacktaxesDue"] += $val->getBasicTax();
						$this->formArray["totalBacktaxesDue"] += $val->getSefTax();
						$this->formArray["totalBacktaxesDue"] += $val->getIdleTax();
						$this->formArray["totalBacktaxesDue"] += $val->getPenalties();
						$this->formArray["totalBacktaxesBalance"] += ($val->getTotalTaxDue() + $val->getPaid());

						$this->backtaxTDIDArray[] = $val->getBacktaxTDID();

						$backtaxTDRecord["arpNumber"] = $val->getTdNumber();
						$backtaxTDRecord["class"] = "--";
						$backtaxTDRecord["location"] = "--";
						$backtaxTDRecord["year"] = $val->getStartYear();
						if($val->getEndYear()!=$val->getStartYear()){
							$backtaxTDRecord["year"] = $val->getStartYear()."-".$val->getEndYear();
						}
						$backtaxTDRecord["taxDue"] = $val->getTotalTaxDue();

						$this->tdArrayList[$backtaxTDRecord["year"].$this->tdArrayListCounter] = $backtaxTDRecord;
						$this->tdArrayListCounter++;
						unset($backtaxTDRecord);
					}

				}
				else{
					//$this->tpl->set_block("TDList", "Backtax", "BacktaxBlock");
					//$this->tpl->set_var("BacktaxBlock", "");
				}
			}
		}
	}
	
	function getLatestPaymentDateForDue($due){
		$condition = " WHERE status='' AND (";
		$condition .= " dueID='".$due->getDueID()."'";
		
		$condition .= " ) ";
		$condition .= " ORDER BY paymentDate DESC, paymentID DESC";


		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php","urn:Object");
		if(!$xmlStr = $PaymentList->getPaymentList($condition)){
			return $this->now;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return $this->now;
			}
			else{
				$paymentRecords = new PaymentRecords;
				$paymentRecords->parseDomDocument($domDoc);

				$paymentArrayList = $paymentRecords->getArrayList();
				$paymentCount=0;
				foreach($paymentArrayList as $payment){
					return $payment->getPaymentDate();
				}
			}
		}
	}	

	function getLatestPaymentDate($dueArrayList){
		$condition = " WHERE status='' AND (";
		$dueCount = 0;
		foreach($dueArrayList as $due){
			if($dueCount > 0){
				$condition .= " OR";
			}
			$condition .= " dueID='".$due->getDueID()."'";
			$dueCount++;
		}
		$condition .= ") ";
		$condition .= " ORDER BY paymentDate DESC";


		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php","urn:Object");
		if(!$xmlStr = $PaymentList->getPaymentList($condition)){
			return $this->now;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return $this->now;
			}
			else{
				$paymentRecords = new PaymentRecords;
				$paymentRecords->parseDomDocument($domDoc);

				$paymentArrayList = $paymentRecords->getArrayList();
				$paymentCount=0;
				foreach($paymentArrayList as $payment){
					return $payment->getPaymentDate();
				}
			}
		}
	}

	function getAmnestyStatusForDue($due){
		$condition = " WHERE status='' AND (";
		$condition .= " dueID='".$due->getDueID()."'";
		$condition .= ")";
		$condition .= "AND status != 'cancelled ' ";
		$condition .= " ORDER BY paymentDate DESC, paymentID DESC";

		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php","urn:Object");
		if(!$xmlStr = $PaymentList->getPaymentList($condition)){
			return false;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return false;
			}
			else{
				$paymentRecords = new PaymentRecords;
				$paymentRecords->parseDomDocument($domDoc);

				$paymentArrayList = $paymentRecords->getArrayList();
				$paymentCount=0;
				foreach($paymentArrayList as $payment){
					if($payment->getAmnesty()=="true"){
						return true;
					}
				}
			}
		}
		return false;
	}
	
	function getTotalAdvancedPaymentDiscountForDue($dueArrayList){
		$condition = " WHERE status = '' AND (";
		$dueCount = 0;
		foreach($dueArrayList as $due){
			if($dueCount > 0){
				$condition .= " OR";
			}
			$condition .= " dueID='".$due->getDueID()."'";
			$dueCount++;
		}
		$condition .= ")";
		$condition .= " ORDER BY paymentDate DESC, paymentID DESC";

		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php","urn:Object");
		$totalAdvancedPaymentDiscount = 0;
		if(!$xmlStr = $PaymentList->getPaymentList($condition)){
			return 0;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return 0;
			}
			else{
				$paymentRecords = new PaymentRecords;
				$paymentRecords->parseDomDocument($domDoc);

				$paymentArrayList = $paymentRecords->getArrayList();
				foreach($paymentArrayList as $payment){
					$totalAdvancedPaymentDiscount += $payment->getAdvancedPaymentDiscount();
				}
			}
		}
		return $totalAdvancedPaymentDiscount;
	}	

	function getTotalAdvancedPaymentDiscountForDueType($due){
		$condition = " WHERE status = '' AND (";
		$condition .= " dueID='".$due->getDueID()."'";
		$condition .= ")";
		$condition .= " ORDER BY paymentDate DESC, paymentID DESC";

		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php","urn:Object");
		$totalAdvancedPaymentDiscount = 0;
		if(!$xmlStr = $PaymentList->getPaymentList($condition)){
			return 0;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return 0;
			}
			else{
				$paymentRecords = new PaymentRecords;
				$paymentRecords->parseDomDocument($domDoc);

				$paymentArrayList = $paymentRecords->getArrayList();
				foreach($paymentArrayList as $payment){
					$totalAdvancedPaymentDiscount += $payment->getAdvancedPaymentDiscount();
				}
			}
		}
		return $totalAdvancedPaymentDiscount;
	}	

	function getTotalEarlyPaymentDiscountForDue($dueArrayList){
		$condition = " WHERE status = '' AND (";
		$dueCount = 0;
		foreach($dueArrayList as $due){
			if($dueCount > 0){
				$condition .= " OR";
			}
			$condition .= " dueID='".$due->getDueID()."'";
			$dueCount++;
		}
		$condition .= ")";
		$condition .= " ORDER BY paymentDate DESC, paymentID DESC";

		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php","urn:Object");
		$totalEarlyPaymentDiscount = 0;
		if(!$xmlStr = $PaymentList->getPaymentList($condition)){
			return 0;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return 0;
			}
			else{
				$paymentRecords = new PaymentRecords;
				$paymentRecords->parseDomDocument($domDoc);

				$paymentArrayList = $paymentRecords->getArrayList();
				foreach($paymentArrayList as $payment){
					$totalEarlyPaymentDiscount += $payment->getEarlyPaymentDiscount();
				}
			}
		}
		return $totalEarlyPaymentDiscount;
	}

	function getTotalEarlyPaymentDiscountForDueType($due){
		$condition = " WHERE status = '' AND (";
		$condition .= " dueID='".$due->getDueID()."'";
		$condition .= ")";
		$condition .= " ORDER BY paymentDate DESC, paymentID DESC";

		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php","urn:Object");
		$totalEarlyPaymentDiscount = 0;
		if(!$xmlStr = $PaymentList->getPaymentList($condition)){
			return 0;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return 0;
			}
			else{
				$paymentRecords = new PaymentRecords;
				$paymentRecords->parseDomDocument($domDoc);

				$paymentArrayList = $paymentRecords->getArrayList();
				foreach($paymentArrayList as $payment){
					$totalEarlyPaymentDiscount += $payment->getEarlyPaymentDiscount();
				}
			}
		}
		return $totalEarlyPaymentDiscount;
	}

	function getAmountPaidForDue($dueArrayList){
		$condition = " WHERE status = '' AND (";
		$dueCount = 0;
		foreach($dueArrayList as $due){
			if($dueCount > 0){
				$condition .= " OR";
			}
			$condition .= " dueID='".$due->getDueID()."'";
			$dueCount++;
		}
		$condition .= ")";
		$condition .= " ORDER BY paymentDate DESC, paymentID DESC";

		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php","urn:Object");
		$amountPaidForDue = 0;
		if(!$xmlStr = $PaymentList->getPaymentList($condition)){
			return 0;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return 0;
			}
			else{
				$paymentRecords = new PaymentRecords;
				$paymentRecords->parseDomDocument($domDoc);

				$paymentArrayList = $paymentRecords->getArrayList();
				foreach($paymentArrayList as $payment){
					$amountPaidForDue += $payment->getAmountPaid();
				}
			}
		}
		return $amountPaidForDue;
	}

	function getLatestPaymentDueType($dueArrayList){
		$condition = " WHERE status = '' AND (";
		$dueCount = 0;
		foreach($dueArrayList as $due){
			if($dueCount > 0){
				$condition .= " OR";
			}
			$condition .= " dueID='".$due->getDueID()."'";
			$dueCount++;
		}
		$condition .= ")";
		$condition .= " ORDER BY paymentDate DESC, paymentID DESC";

		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php","urn:Object");
		$amountPaidForDue = 0;
		if(!$xmlStr = $PaymentList->getPaymentList($condition)){
			return 0;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return 0;
			}
			else{
				$paymentRecords = new PaymentRecords;
				$paymentRecords->parseDomDocument($domDoc);

				$paymentArrayList = $paymentRecords->getArrayList();
				$paymentCtr=0;
				foreach($paymentArrayList as $payment){
					return $payment->getDueType();
				}
			}
		}
		return false;
	}


	/**function computePenalty($penaltyComputeDate,$due){
		// compute Penalty as of $penaltyComputeDate
		// check if today is exceeding dueDate and compute penalty

		$totalMonths=0;

		if(strtotime($penaltyComputeDate) > strtotime($due->getDueDate()." 23:59:59")){
			// count months

			// numYears = today[year] - dueDate[year]
			$numYears = date("Y",strtotime($penaltyComputeDate)) - date("Y",strtotime($due->getDueDate()));
			// numMonths = today[month] - dueDate[month]
			$numMonths = date("n",strtotime($penaltyComputeDate)) - date("n",strtotime($due->getDueDate()));
			// totalMonths = (numYears*12) + numMonths

			$totalMonths = $due->calculateMonthOverDue(date("Y-m-d",strtotime($penaltyComputeDate)));

			// associate penaltyPercentage

			$penaltyLUTArray = $this->getPenaltyLUTArray();

			if($totalMonths >= count($penaltyLUTArray)-1){
				$penaltyPercentage = 0.72;
			}
			else{			
				$penaltyPercentage = $penaltyLUTArray[$totalMonths-1];
			}

			$penalty = $due->getTaxDue() * $penaltyPercentage;

			$due->setMonthsOverDue($totalMonths);
			$due->setPenaltyPercentage($penaltyPercentage);
			$due->setPenalty($penalty);
		}
		else{
			$due->setMonthsOverDue(0);
			$due->setPenaltyPercentage(0.00);
			$due->setPenalty(0.00);
		}

		return $due;
	}**/
function computePenalty($penaltyComputeDate,$due){
		// compute Penalty as of $penaltyComputeDate
		// check if today is exceeding dueDate and compute penalty

		if(strtotime($penaltyComputeDate) > strtotime($due->getDueDate())){
			// count months

			// numYears = today[year] - dueDate[year]
			$numYears = date("Y",strtotime($penaltyComputeDate)) - date("Y",strtotime($due->getDueDate()));
			// numMonths = today[month] - dueDate[month]
			$numMonths = date("n",strtotime($penaltyComputeDate)) - date("n",strtotime($due->getDueDate()));
			// totalMonths = (numYears*12) + numMonths

			$totalMonths = $due->calculateMonthOverDue(date("Y-m-d",strtotime($penaltyComputeDate)));

			// associate penaltyPercentage

			if($totalMonths >= count($this->penaltyLUTArray)){
				$penaltyPercentage = 0.72;
			}
			else{			
				$penaltyPercentage = $this->penaltyLUTArray[$totalMonths];
			}

			$penalty = $due->getTaxDue() * $penaltyPercentage;

			$due->setMonthsOverDue($totalMonths);
			$due->setPenaltyPercentage($penaltyPercentage);
			$due->setPenalty($penalty);
		}
		else{
			$due->setMonthsOverDue(0);
			$due->setPenaltyPercentage(0.00);
			$due->setPenalty(0.00);
		}

		return $due;
	}


	function setLguDetails(){
		$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php", "urn:Object");
		if (!$xmlStr = $eRPTSSettingsDetails->getERPTSSettingsDetails(1)){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "record not found");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$erptsSettings = new eRPTSSettings;
				$erptsSettings->parseDomDocument($domDoc);
				$this->formArray["lguName"] = strtoupper($erptsSettings->getLguName());
				$this->formArray["lguType"] = strtoupper($erptsSettings->getLguType());
				$this->tpl->set_var("lguName", $this->formArray["lguName"]);
				$this->tpl->set_var("lguType", $this->formArray["lguType"]);

				if(strtolower($this->formArray["lguType"])=="municipality"){
					$provinceRecords = new ProvinceRecords;
					$condition = "WHERE status='active' ORDER BY provinceID ASC LIMIT 1";
					if($provinceRecords->selectRecords($condition)){
						if(is_array($provinceRecords->arrayList)){
							$province = $provinceRecords->arrayList[0];
							$this->formArray["provinceName"] = strtoupper($province->getDescription());
							$this->tpl->set_var("provinceName", strtoupper($this->formArray["provinceName"]));
						}
					}
				}
			}
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
							//$this->tpl->set_block("rptsTemplate", "defaultTDList", "defaultTDListBlock");
							//$this->tpl->set_block("rptsTemplate", "toggleTDList", "toggleTDListBlock");
							//$this->tpl->set_block("rptsTemplate", "TDList", "TDListBlock");
							//$this->tpl->set_block("TDList", "BacktaxesList", "BacktaxesListBlock");
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
									/*
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
									*/

									$this->tdRecord["arpNumber"] = $tvalue->getTaxDeclarationNumber();

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

											$odID = $afs->getOdID();

											$od = new OD;
											$od->selectRecord($odID);

											if(is_object($od->locationAddress)){
												$locationAddress = $od->getLocationAddress();
												$this->tdRecord["location"] = $locationAddress->getBarangay().", ".$locationAddress->getMunicipalityCity();
											}

											switch($tvalue->getPropertyType()){
												case "ImprovementsBuildings":
													if(is_array($afs->getImprovementsBuildingsArray())){
														$improvementsBuildings = $afs->improvementsBuildingsArray[0];
														$actualUse = $improvementsBuildings->getActualUse();
														if(is_numeric($actualUse)){
															$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
															$improvementsBuildingsActualUses->selectRecord($actualUse);
															$actualUse = $improvementsBuildingsActualUses->getCode();
															//$actualUse = $improvementsBuildingsActualUses->getDescription();
														}
														$this->tdRecord["class"] = $actualUse;
													}
													break;
												case "Machineries":
													if(is_array($afs->getMachineriesArray())){
														$machineries = $afs->machineriesArray[0];
														$actualUse = $machineries->getActualUse();
														if(is_numeric($actualUse)){
															$machineriesActualUses = new MachineriesActualUses;
															$machineriesActualUses->selectRecord($actualUse);
															$actualUse = $machineriesActualUses->getCode();
															//$actualUse = $machineriesActualUses->getDescription();
														}
														$this->tdRecord["class"] = $actualUse;
													}
													break;
												case "Land":
												default:
													if(is_array($afs->getLandArray())){
														$land = $afs->landArray[0];
														$actualUse = $land->getActualUse();
														if(is_numeric($actualUse)){
															$landActualUses = new LandActualUses;
															$landActualUses->selectRecord($actualUse);
															$actualUse = $landActualUses->getCode();
															//$actualUse = $landActualUses->getDescription();
														}
														$this->tdRecord["class"] = $actualUse;
													}
													else if(is_array($afs->getPlantsTreesArray())){
														if(is_numeric($actualUse)){
															$plantsTreesActualUses = new PlantsTreesActualUses;
															$plantsTreesActualUses->selectRecord($actualUse);
															$actualUse = $plantsTreesActualUses->getCode();
															//$actualUse = $plantsTreesActualUses->getDescription();
														}
														$this->tdRecord["class"] = $actualUse;
													}
											}

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
									
									$DueList = new SoapObject(NCCBIZ."DueList.php", "urn:Object");

									$dueArrayList = array(
										"Annual" => ""
										,"Q1" => ""
										,"Q2" => ""
										,"Q3" => ""
										,"Q4" => "");

									if (!$xmlStr = $DueList->getDueList($tvalue->getTdID(),$rptop->getTaxableYear())){
										if($this->formArray["rptopID"]!="")
											$redirectMessage = "Dues are uncalculated. <a href='CalculateRPTOPDetails.php".$this->sess->url("")."&rptopID=".$this->formArray["rptopID"]."'>Click here</a> to go to calculation page or <a href='SOA.php".$this->sess->url("")."'>return to list</a>.";
										else
											$redirectMessage = "Dues are uncalculated. <a href='SOA.php".$this->sess->url("")."'>Click here</a> to return to list.";
										exit($redirectMessage);
									}
									else{
										if(!$domDoc = domxml_open_mem($xmlStr)) {
											if($this->formArray["rptopID"]!="")
												$redirectMessage = "Dues are uncalculated. <a href='CalculateRPTOPDetails.php".$this->sess->url("")."&rptopID=".$this->formArray["rptopID"]."'>Click here</a> to go to calculation page or <a href='SOA.php".$this->sess->url("")."'>return to list</a>.";
											else
												$redirectMessage = "Dues are uncalculated. <a href='SOA.php".$this->sess->url("")."'>Click here</a> to return to list.";
											exit($redirectMessage);
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
															$dueDateYear = date("Y",strtotime($due->getDueDate()));

															$this->tdRecord["year"] = $dueDateYear;
															break;
													}
												}
											}

											$treasurySettings = new TreasurySettings;
											$treasurySettings->selectRecord();

											// initialize discountPeriod and discountPercentage for earlyPaymentDiscount 
											$this->tpl->set_var("discountPercentage",$treasurySettings->getDiscountPercentage()."%");
											$this->tpl->set_var("discountPeriod","January 01, ".$dueDateYear." - ".date("F d, Y",strtotime($dueDateYear."-".$treasurySettings->getDiscountPeriod())));

											$this->formArray["discountPercentage"] = $treasurySettings->getDiscountPercentage();
											$this->formArray["discountPeriod"] = $treasurySettings->getDiscountPeriod();

											$this->formArray["discountPeriod_End"] = strtotime($dueDateYear."-".$this->formArray["discountPeriod"]);
											$this->formArray["discountPeriod_Start"] = strtotime($dueDateYear."-01-01");

											// initialize advancedDiscountPercentage for advancedPayment

											$this->tpl->set_var("advancedDiscountPercentage",$treasurySettings->getAdvancedDiscountPercentage()."%");
											$this->formArray["advancedDiscountPercentage"] = $treasurySettings->getAdvancedDiscountPercentage();
											$this->tpl->set_var("q1AdvancedDiscountPercentage",$treasurySettings->getQ1AdvancedDiscountPercentage()."%");
											$this->formArray["q1AdvancedDiscountPercentage"] = $treasurySettings->getQ1AdvancedDiscountPercentage();

											// initialize penaltyLUTArray

											$penaltyLUTArray = $treasurySettings->getPenaltyLUT();
											$this->penaltyLUTArray = $treasurySettings->getPenaltyLUT();

											foreach($dueArrayList as $dKey => $due){
												$dueArrayList[$dKey]->setEarlyPaymentDiscountPeriod($this->formArray["discountPeriod"]);
												$dueArrayList[$dKey]->setEarlyPaymentDiscountPercentage($this->formArray["discountPercentage"]);

												// compute earlyPaymentDiscount as of today
												// check if today is within the discountPeriod and compute Discount
												// AND if today is BEFORE annual dueDate

												$dueArrayList[$dKey]->setEarlyPaymentDiscount(0.00);
												
												if($due->getDueType()=="Annual"){
													if(strtotime($this->now) >= $this->formArray["discountPeriod_Start"] && strtotime($this->now) <= $this->formArray["discountPeriod_End"]){
														if(strtotime($this->now) <= strtotime($dueArrayList[$dKey]->getDueDate())){
															$dueArrayList[$dKey]->setEarlyPaymentDiscount($dueArrayList[$dKey]->getTaxDue() * ($this->formArray["discountPercentage"]/100));
														}
													}
												}
												else{
													// if today is BEFORE dueDate
													if(strtotime($this->now) <= strtotime($due->getDueDate()) && strtotime($this->now) >= $this->formArray["discountPeriod_Start"]){
														$dueArrayList[$dKey]->setEarlyPaymentDiscount($dueArrayList[$dKey]->getTaxDue() * ($this->formArray["discountPercentage"]/100));														
													}

													// commented out Febuary 08, 2005 : Provide Quarterly Discounts
													// earlyPaymentDiscount aren't given to Quarterly Dues except for Quarter 1
													/*
													if($due->getDueType()=="Q1"){
														if(strtotime($this->now) >= $this->formArray["discountPeriod_Start"] && strtotime($this->now) <= $this->formArray["discountPeriod_End"]){
															if(strtotime($this->now) <= strtotime($dueArrayList[$dKey]->getDueDate())){
																$dueArrayList[$dKey]->setEarlyPaymentDiscount($dueArrayList[$dKey]->getTaxDue() * ($this->formArray["discountPercentage"]/100));
															}
														}
													}
													*/
												}

												// compute advancedPaymentDiscount as of today
												// check if today is BEFORE January 1 of the year of the annual dueDate

												$dueArrayList[$dKey]->setAdvancedPaymentDiscount(0.00);
												if(strtotime($this->now) < strtotime(date("Y",strtotime($dueArrayList[$dKey]->getDueDate()))."-01-01")){

													// for advanced payments, give 20% discount to annual dues [advanced discount]
													// give 10% discount to quarterly dues [early discount]

													if($due->getDueType()=="Annual"){
														$dueArrayList[$dKey]->setAdvancedPaymentDiscount($dueArrayList[$dKey]->getTaxDue() * ($this->formArray["advancedDiscountPercentage"]/100));
													}
													else{
														if($due->getDueType()=="Q1"){
															$dueArrayList[$dKey]->setAdvancedPaymentDiscount($dueArrayList[$dKey]->getTaxDue() * ($this->formArray["q1AdvancedDiscountPercentage"]/100));
														}
														else{
															$dueArrayList[$dKey]->setAdvancedPaymentDiscount($dueArrayList[$dKey]->getTaxDue() * ($this->formArray["discountPercentage"]/100));
														}

														// commented out: February 08, 2005
														// advancedPaymentDiscount aren't given to Quarterly Dues except for Quarter 1
														/*
														if($due->getDueType()=="Q1"){
															$dueArrayList[$dKey]->setAdvancedPaymentDiscount($dueArrayList[$dKey]->getTaxDue() * ($this->formArray["q1AdvancedDiscountPercentage"]/100));
														}
														*/
													}
												}

												$latestPaymentDate[$dKey] = $this->getLatestPaymentDateForDue($dueArrayList[$dKey]);
												$amountPaidForDue = $this->getAmountPaidForDue($dueArrayList);
												$latestPaymentDueType = $this->getLatestPaymentDueType($dueArrayList);
												$amnestyStatus[$dKey] = $this->getAmnestyStatusForDue($dueArrayList[$dKey]);
												$totalEarlyPaymentDiscount = $this->getTotalEarlyPaymentDiscountForDue($dueArrayList);
												$totalAdvancedPaymentDiscount = $this->getTotalAdvancedPaymentDiscountForDue($dueArrayList);
												
												if($totalEarlyPaymentDiscount > 0){
													$earlyPaymentDiscountForDueType = $this->getTotalEarlyPaymentDiscountForDueType($dueArrayList[$dKey]);
													if($earlyPaymentDiscountForDueType > 0){
														$dueArrayList[$dKey]->setEarlyPaymentDiscount($earlyPaymentDiscountForDueType);
													}
												}
												if($totalAdvancedPaymentDiscount > 0){
													$advancedPaymentDiscountForDueType = $this->getTotalAdvancedPaymentDiscountForDueType($dueArrayList[$dKey]);
													if($advancedPaymentDiscountForDueType > 0){
														$dueArrayList[$dKey]->setAdvancedPaymentDiscount($advancedPaymentDiscountForDueType);
													}
												}
												
												// calculate Penalties verses either today or verses the last paymentDate

												if($latestPaymentDate[$dKey]!="" || $latestPaymentDate[$dKey]!="now"){
													$dueArrayList[$dKey] = $this->computePenalty($latestPaymentDate[$dKey],$dueArrayList[$dKey]);

													// if balance is 0 leave penalty as is, otherwise calculatePenalty according to date now

													$balance = round($dueArrayList[$dKey]->getInitialNetDue() - $amountPaidForDue,4);

													// 0.1 is used instead of 0 because a lot of balances may end up as 0.002 or so...
													
													if($balance > 0.1){
														$dueArrayList[$dKey] = $this->computePenalty($this->now,$dueArrayList[$dKey]);
													}
												}
												else{
													$dueArrayList[$dKey] = $this->computePenalty($this->now,$dueArrayList[$dKey]);
												}

												//print_r($dueArrayList[$dKey]);
												//echo "<hr>";

												$this->tpl->set_var("advancedPaymentDiscount[".$dKey."]",formatCurrency($dueArrayList[$dKey]->getAdvancedPaymentDiscount()));
												$this->tpl->set_var("earlyPaymentDiscount[".$dKey."]",formatCurrency($dueArrayList[$dKey]->getEarlyPaymentDiscount()));
												$this->tpl->set_var("monthsOverDue[".$dKey."]",$dueArrayList[$dKey]->getMonthsOverDue());
												$this->tpl->set_var("penaltyPercentage[".$dKey."]",$dueArrayList[$dKey]->getPenaltyPercentage()*100);
												$this->tpl->set_var("penalty[".$dKey."]",formatCurrency($dueArrayList[$dKey]->getPenalty()));

												$this->initialNetDue[$dKey] = $dueArrayList[$dKey]->getInitialNetDue();
												if($amnestyStatus[$dKey]){
													$this->initialNetDue[$dKey] -= $dueArrayList[$dKey]->getPenalty();
													$this->tpl->set_var("amnesty[".$dKey."]","Yes");
												}
												else{
													$this->tpl->set_var("amnesty[".$dKey."]","No");
												}
												$this->tpl->set_var("initialNetDue[".$dKey."]",formatCurrency($this->initialNetDue[$dKey]));

											}

											// out of the loop, 
											// verify balances to make disable penalties and discounts for Annual if ALL QUARTERS have been paid
											// and to disable penalties and discounts for Quarters if ALL of ANNUAL has been paid

											// example: Q1, Q2, Q3 and Q4 have been fully paid. Annual should not show any payables.
											//          Likewise if Annual has been fully paid, Q1, Q2, Q3 and Q4 should not show any payables.

											$totalQuarterlyNetDue = 0;
											$totalQuarterlyNetDue += $dueArrayList["Q1"]->getBasicTax() + $dueArrayList["Q1"]->getSefTax() + $dueArrayList["Q1"]->getIdleTax();
											$totalQuarterlyNetDue -= ($dueArrayList["Q1"]->getEarlyPaymentDiscount() + $dueArrayList["Q1"]->getAdvancedPaymentDiscount());
											if(!$amnestyStatus["Q1"]) $totalQuarterlyNetDue += $dueArrayList["Q1"]->getPenalty();

											$totalQuarterlyNetDue += $dueArrayList["Q2"]->getBasicTax() + $dueArrayList["Q2"]->getSefTax() + $dueArrayList["Q2"]->getIdleTax();
											$totalQuarterlyNetDue -= ($dueArrayList["Q2"]->getEarlyPaymentDiscount() + $dueArrayList["Q2"]->getAdvancedPaymentDiscount());
											if(!$amnestyStatus["Q2"]) $totalQuarterlyNetDue += $dueArrayList["Q2"]->getPenalty();

											$totalQuarterlyNetDue += $dueArrayList["Q3"]->getBasicTax() + $dueArrayList["Q3"]->getSefTax() + $dueArrayList["Q3"]->getIdleTax();
											$totalQuarterlyNetDue -= ($dueArrayList["Q3"]->getEarlyPaymentDiscount() + $dueArrayList["Q3"]->getAdvancedPaymentDiscount());
											if(!$amnestyStatus["Q3"]) $totalQuarterlyNetDue += $dueArrayList["Q3"]->getPenalty();

											$totalQuarterlyNetDue += $dueArrayList["Q4"]->getBasicTax() + $dueArrayList["Q4"]->getSefTax() + $dueArrayList["Q4"]->getIdleTax();
											$totalQuarterlyNetDue -= ($dueArrayList["Q4"]->getEarlyPaymentDiscount() + $dueArrayList["Q4"]->getAdvancedPaymentDiscount());
											if(!$amnestyStatus["Q4"]) $totalQuarterlyNetDue += $dueArrayList["Q4"]->getPenalty();

											$totalAnnualNetDue = 0;
											$totalAnnualNetDue += $dueArrayList["Annual"]->getBasicTax() + $dueArrayList["Annual"]->getSefTax() + $dueArrayList["Annual"]->getIdleTax();
											$totalAnnualNetDue -= ($dueArrayList["Annual"]->getEarlyPaymentDiscount() + $dueArrayList["Annual"]->getAdvancedPaymentDiscount());
											if(!$amnestyStatus["Annual"]) $totalAnnualNetDue += $dueArrayList["Annual"]->getPenalty();

											if($latestPaymentDueType!="Annual" && ($totalQuarterlyNetDue - $amountPaidForDue) <= 0){
												// all QUARTERLY DUES have been paid, modify Annual Due values

												$dueArrayList["Annual"]->setAdvancedPaymentDiscount(0);
												$dueArrayList["Annual"]->setEarlyPaymentDiscount(0);
												$dueArrayList["Annual"]->setMonthsOverDue(0);
												$dueArrayList["Annual"]->setPenaltyPercentage(0);
												$dueArrayList["Annual"]->setPenalty(0);
												$this->initialNetDue["Annual"] = $dueArrayList["Annual"]->getInitialNetDue();

												$this->tpl->set_var("advancedPaymentDiscount[Annual]",formatCurrency($dueArrayList["Annual"]->getAdvancedPaymentDiscount()));
												$this->tpl->set_var("earlyPaymentDiscount[Annual]",formatCurrency($dueArrayList["Annual"]->getEarlyPaymentDiscount()));
												$this->tpl->set_var("monthsOverDue[Annual]",$dueArrayList["Annual"]->getMonthsOverDue());
												$this->tpl->set_var("penaltyPercentage[Annual]",$dueArrayList["Annual"]->getPenaltyPercentage()*100);
												$this->tpl->set_var("penalty[Annual]",formatCurrency($dueArrayList["Annual"]->getPenalty()));
												$this->tpl->set_var("amnesty[Annual]","No");

												$this->tpl->set_var("initialNetDue[Annual]",formatCurrency($this->initialNetDue["Annual"]));
											}
											else if($latestPaymentDueType=="Annual" && ($totalAnnualNetDue - $amountPaidForDue) <= 0){
												// all of ANNUAL Due has been fully paid, modify Quarterly Due values
												$quarterlyDueKeys = array("Q1", "Q2", "Q3", "Q4");
												foreach($quarterlyDueKeys as $dKey){
													$dueArrayList[$dKey]->setAdvancedPaymentDiscount(0);
													$dueArrayList[$dKey]->setEarlyPaymentDiscount(0);
													$dueArrayList[$dKey]->setMonthsOverDue(0);
													$dueArrayList[$dKey]->setPenaltyPercentage(0);
													$dueArrayList[$dKey]->setPenalty(0);
													$this->initialNetDue[$dKey] = $dueArrayList[$dKey]->getInitialNetDue();

													$this->tpl->set_var("advancedPaymentDiscount[".$dKey."]",formatCurrency($dueArrayList[$dKey]->getAdvancedPaymentDiscount()));
													$this->tpl->set_var("earlyPaymentDiscount[".$dKey."]",formatCurrency($dueArrayList[$dKey]->getEarlyPaymentDiscount()));
													$this->tpl->set_var("monthsOverDue[".$dKey."]",$dueArrayList[$dKey]->getMonthsOverDue());
													$this->tpl->set_var("penaltyPercentage[".$dKey."]",$dueArrayList[$dKey]->getPenaltyPercentage()*100);
													$this->tpl->set_var("penalty[".$dKey."]",formatCurrency($dueArrayList[$dKey]->getPenalty()));
													$this->tpl->set_var("amnesty[".$dKey."]","No");

													$this->tpl->set_var("initialNetDue[".$dKey."]",formatCurrency($this->initialNetDue[$dKey]));
												}
											}
										}
									}

									// display Backtaxes and previousTD Backtaxes

									$this->formArray["totalBacktaxesBalance"] = 0;
									$this->displayBacktaxTD($tvalue->getTdID());
									$precedingTDArray = $this->getPrecedingTDArray($tvalue);
									if(is_array($precedingTDArray)){
										foreach($precedingTDArray as $precedingTD){
											$this->displayBacktaxTD($precedingTD->getTdID());
										}
									}
									$this->tpl->set_var("total", number_format($this->formArray["totalBacktaxesDue"],2));
									$this->tpl->set_var("totalBacktaxesBalance",number_format($this->formArray["totalBacktaxesBalance"],2));

									// grab dueID's and backtaxTDID's to run through payments
									// create $dueIDArray

									foreach($dueArrayList as $due){
										$this->dueIDArray[] = $due->getDueID();
									}

									$this->displayTotalPaid();
									$this->displayNetDue();

									$this->tdArrayList[$this->tdRecord["year"].$this->tdArrayListCounter] = $this->tdRecord;
									$this->tdArrayListCounter++;
									unset($this->tdRecord);

									$this->tpl->set_var("ctr", $tdCtr);
									//$this->tpl->parse("defaultTDListBlock", "defaultTDList", true);
									//$this->tpl->parse("toggleTDListBlock", "toggleTDList", true);
									//$this->tpl->parse("TDListBlock", "TDList", true);
									//$this->tpl->set_var("BacktaxesListBlock", "");
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

		if(is_array($this->tdArrayList)){
			ksort($this->tdArrayList);
			reset($this->tdArrayList);
//			$this->tpl->set_block("rptsTemplate", "TDList", "TDListBlock");
			$this->tpl->set_block("rptsTemplate", "Page", "PageBlock");
			$this->tpl->set_block("Page", "TDList", "TDListBlock");
			$this->tpl->set_block("Page", "TotalDue", "TotalDueBlock");
			$this->formArray["totalTaxDue"] = 0;

			$maxRows = 20;
			$numRows = count($this->tdArrayList);
			$numPages = ceil($numRows/$maxRows);
			$rowStr = "";
			$j = 0;
			$page = 0;
			foreach($this->tdArrayList as $tdRecord){
				++$j;
				if ($j>$maxRows) {
					$this->formArray["tdYPosValue"] = "564";
					$this->tpl->set_var("TDListBlock", $rowStr);
					$this->tpl->set_var("PageNumber", ++$page);
					if ($page==$numPages)
						$this->tpl->set_var("TotalDueBlock", $this->tpl->subst("TotalDue"));
					else
						$this->tpl->set_var("TotalDueBlock", "");
					$this->tpl->parse("PageBlock", "Page", true);
					$rowStr = "";
					$j = 1;
				}

				$this->tpl->set_var("arpNumber", $tdRecord["arpNumber"]);
				$this->tpl->set_var("class", $tdRecord["class"]);
				$this->tpl->set_var("location", $tdRecord["location"]);
				$this->tpl->set_var("year", $tdRecord["year"]);
				$this->tpl->set_var("taxDue", formatCurrency($tdRecord["taxDue"]));
				$this->tpl->set_var("tdYPos", $this->formArray["tdYPosValue"]);
				$this->formArray["tdYPosValue"]-=15;
				$this->formArray["totalTaxDue"] += $tdRecord["taxDue"];
				$rowStr .= $this->tpl->subst("TDList");
			}
			$this->tpl->set_var("TDListBlock", $rowStr);
			$this->tpl->set_var("PageNumber", ++$page);
			if ($page==$numPages)
				$this->tpl->set_var("TotalDueBlock", $this->tpl->subst("TotalDue"));
			else
				$this->tpl->set_var("TotalDueBlock", "");
			$this->tpl->parse("PageBlock", "Page", true);
//			echo $this->tpl->subst("Page");

/*
			$maxRows = 5;
			$numRows = count($this->tdArrayList);
			$numPages = ceil($numRows/$maxRows);
			$tdRecord = current($this->tdArrayList);
			for ($page=0; $page<$numPages; ++$page) {
				$rowStr = "";
				$this->formArray["tdYPosValue"] = "564";
				for ($currRow=0; $currRow<$maxRows; ++$currRow) {
//					$tdRecord = $this->tdArrayList[($page*$maxRows)+$currRow];

					$this->tpl->set_var("arpNumber", $tdRecord["arpNumber"]);
					$this->tpl->set_var("class", $tdRecord["class"]);
					$this->tpl->set_var("location", $tdRecord["location"]);
					$this->tpl->set_var("year", $tdRecord["year"]);
					$this->tpl->set_var("taxDue", formatCurrency($tdRecord["taxDue"]));
					$this->tpl->set_var("tdYPos", $this->formArray["tdYPosValue"]);
					$this->formArray["tdYPosValue"]-=15;
					$rowStr .= $this->tpl->subst("TDList");

					$this->formArray["totalTaxDue"] += $tdRecord["taxDue"];
					$tdRecord = next($this->tdArrayList);
				}
				echo $rowStr;
				$this->tpl->set_var("TDListBlock", $rowStr);
				$this->tpl->set_var("PageNum", $page+1);
				$this->tpl->parse("PageBlock", "Page", true);
			}

			foreach($this->tdArrayList as $tdRecord){
				$this->tpl->set_var("arpNumber", $tdRecord["arpNumber"]);
				$this->tpl->set_var("class", $tdRecord["class"]);
				$this->tpl->set_var("location", $tdRecord["location"]);
				$this->tpl->set_var("year", $tdRecord["year"]);
				$this->tpl->set_var("taxDue", formatCurrency($tdRecord["taxDue"]));
				$this->tpl->set_var("tdYPos", $this->formArray["tdYPosValue"]);

				$this->formArray["totalTaxDue"] += $tdRecord["taxDue"];
				$this->tpl->parse("TDListBlock", "TDList", true);
				$this->formArray["tdYPosValue"]-=15;
			}
*/
		}
		
		$this->setForm();

		/*
		$this->setPageDetailPerms();

		$this->tpl->set_var("uname", $this->user["uname"]);

		$this->tpl->set_var("today", date("F j, Y",strtotime($this->now)));

		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("rptopID"=>$this->formArray["rptopID"],"ownerID" => $this->formArray["ownerID"])));
		$this->tpl->parse("templatePage", "rptsTemplate");
		$this->tpl->finish("templatePage");
		$this->tpl->p("templatePage");
		*/

		$this->tpl->set_var("today", date("F j, Y",strtotime($this->now)));

		$this->setLguDetails();

	    $this->tpl->parse("templatePage", "rptsTemplate");
        $this->tpl->finish("templatePage");

		$testpdf = new PDFWriter;
        $testpdf->setOutputXML($this->tpl->get("templatePage"),"test");

        if(isset($this->formArray["print"])){
        	$testpdf->writePDF($name);//,$this->formArray["print"]);
        }
        else {
        	$testpdf->writePDF($name);
        }		
//		header("location: ".$testpdf->pdfPath);
		exit;
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
