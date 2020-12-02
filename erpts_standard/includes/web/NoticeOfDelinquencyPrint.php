<?php
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "./clibPDFWriter.php";

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

include_once "../assessor/ODHistoryRecords.php";
include_once "../assessor/ODHistory.php";

include_once "../assessor/LandActualUses.php";
include_once "../assessor/PlantsTreesActualUses.php";
include_once "../assessor/ImprovementsBuildingsActualUses.php";
include_once "../assessor/MachineriesActualUses.php";


include_once "../collection/Due.php";
include_once "../collection/DueRecords.php";
include_once "../collection/TreasurySettings.php";
include_once "../collection/BacktaxTD.php";
include_once "../collection/BacktaxTDRecords.php";

include_once "../collection/PaymentRecords.php";
include_once "../collection/ReceiptRecords.php";
include_once "../collection/CollectionRecords.php";

include_once "../assessor/eRPTSSettings.php";


#####################################
# Define Interface Class
#####################################
class NoticeOfDelinquencyPrint{
	
	var $tpl;
	var $formArray;
	var $tdArrayList;
	var $tdRecord;
	var $tdArrayListCounter = 0;
	
	function NoticeOfDelinquencyPrint($http_post_vars,$sess,$rptopID,$ownerID){
		$this->now = "now";

		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "noticeOfDelinquency.xml") ;
		$this->tpl->set_var("TITLE", "Notice Of Delinquency Print");

       	$this->formArray = array(
			"rptopID" => $rptopID
			,"ownerID" => $ownerID
			,"lguType" => ""
			,"lguName" => ""
			,"ownerName" => ""
			,"address1" => ""
			,"address2" => ""
			,"tdYPosValue" => "366"
			,"signatory1" => ""
			,"signatory1Designation" => ""
			,"signatory2" => ""
			,"signaotyr2Designation" => ""
			,"dateIssued" => date("F d, Y")
			,"dateAsOf" => ""
		);

		$this->tdRecord = array(
			"arpNumber"

			,"assessedValue"
			,"basic"
			,"sef"
			,"penalty"

			,"class"
			,"location"
			,"year"
			,"taxDue");

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}

		$this->formArray["dateAsOf"] = date("F d, Y", strtotime($this->formArray["asOfDate_year"]."-".putPreZero($this->formArray["asOfDate_month"])."-".putPreZero($this->formArray["asOfDate_day"])));
		$this->now = $this->formArray["dateAsOf"];
	}
	
	function formatCurrency($key){
		if($this->formArray[$key]=="")
			return false;

		if(is_numeric($this->formArray[$key]))
			$this->formArray[$key] = number_format(un_number_format($this->formArray[$key]), 2, ".", ",");
	}
	
	function setForm(){
		$this->formArray["totalTaxDue"] = formatCurrency($this->formArray["totalTaxDue"]);
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, html_entity_to_alpha($value));
		}
	}

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

				$address = $owner->personArray[0]->addressArray[0];
				if (is_a($address,Address)){
					if($address->getNumber()!="" && $address->getNumber()!=" " && $address->getNumber()!="-" && $address->getNumber()!="--"){
						$this->formArray["address1"] = $address->getNumber();
					}
					if($address->getStreet()!="" && $address->getStreet()!=" " && $address->getStreet()!="-" && $address->getStreet()!="--"){
						if($this->formArray["address1"]!=""){
							$this->formArray["address1"] .= " ".$address->getStreet();
						}
						else{
							$this->formArray["address1"] = $address->getStreet();
						}
					}
					if($address->getBarangay()!="" && $address->getBarangay()!=" " && $address->getBarangay()!="-" && $address->getBarangay()!="--"){
						if($this->formArray["address1"]!=""){
							$this->formArray["address1"] .= ", ".$address->getBarangay();
						}
						else{
							$this->formArray["address1"] = $address->getBarangay();
						}						
					}
					if($address->getDistrict()!="" && $address->getDistrict()!=" " && $address->getDistrict()!="-" && $address->getDistrict()!="--"){
						if($this->formArray["address1"]!=""){
							$this->formArray["address1"] .= ", ".$address->getDistrict();
						}
						else{
							$this->formArray["address1"] = $address->getDistrict();
						}						
					}
					if($address->getMunicipalityCity()!="" && $address->getMunicipalityCity()!=" " && $address->getMunicipalityCity()!="-" && $address->getMunicipalityCity()!="--"){
						$this->formArray["address2"] = $address->getMunicipalityCity();
					}
					if($address->getProvince()!="" && $address->getProvince()!=" " && $address->getProvince()!="-" && $address->getProvince()!="--"){
						if($this->formArray["address2"]!=""){
							$this->formArray["address2"] .= ", ".$address->getProvince();
						}
						else{
							$this->formArray["address2"] = $address->getProvince();
						}	
					}
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

				if(!is_object($address)){
					$address = $owner->personArray[0]->addressArray[0];
					if (is_a($address,Address)){
						if($address->getNumber()!="" && $address->getNumber()!=" " && $address->getNumber()!="-" && $address->getNumber()!="--"){
							$this->formArray["address1"] = $address->getNumber();
						}
						if($address->getStreet()!="" && $address->getStreet()!=" " && $address->getStreet()!="-" && $address->getStreet()!="--"){
							if($this->formArray["address1"]!=""){
								$this->formArray["address1"] .= " ".$address->getStreet();
							}
							else{
								$this->formArray["address1"] = $address->getStreet();
							}
						}
						if($address->getBarangay()!="" && $address->getBarangay()!=" " && $address->getBarangay()!="-" && $address->getBarangay()!="--"){
							if($this->formArray["address1"]!=""){
								$this->formArray["address1"] .= ", ".$address->getBarangay();
							}
							else{
								$this->formArray["address1"] = $address->getBarangay();
							}						
						}
						if($address->getDistrict()!="" && $address->getDistrict()!=" " && $address->getDistrict()!="-" && $address->getDistrict()!="--"){
							if($this->formArray["address1"]!=""){
								$this->formArray["address1"] .= ", ".$address->getDistrict();
							}
							else{
								$this->formArray["address1"] = $address->getDistrict();
							}						
						}
						if($address->getMunicipalityCity()!="" && $address->getMunicipalityCity()!=" " && $address->getMunicipalityCity()!="-" && $address->getMunicipalityCity()!="--"){
							$this->formArray["address2"] = $address->getMunicipalityCity();
						}
						if($address->getProvince()!="" && $address->getProvince()!=" " && $address->getProvince()!="-" && $address->getProvince()!="--"){
							if($this->formArray["address2"]!=""){
								$this->formArray["address2"] .= ", ".$address->getProvince();
							}
							else{
								$this->formArray["address2"] = $address->getProvince();
							}	
						}
					}
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
			}
		}
	}

	function displayNetDue(){
		$this->netDue["Annual"] = ($this->initialNetDue["Annual"] + $this->formArray["totalBacktaxesBalance"]) - $this->formArray["totalPaid"];

		$this->netDue["Q1"] = ($this->initialNetDue["Q1"] + $this->formArray["totalBacktaxesBalance"]) - $this->formArray["totalPaid"];
//		$this->netDue["Q1"] = ($this->initialNetDue["Q1"] + $this->formArray["totalBacktaxesBalance"]) - 75;
		if($this->netDue["Q1"] < 0) $this->netDue["Q1"]=0;

		$this->netDue["Q2"] = ($this->initialNetDue["Q1"] + $this->initialNetDue["Q2"] + $this->formArray["totalBacktaxesBalance"]) - $this->formArray["totalPaid"];
//		$this->netDue["Q2"] = ($this->initialNetDue["Q1"] + $this->initialNetDue["Q2"] + $this->formArray["totalBacktaxesBalance"]) - 75;
		if($this->netDue["Q2"] > $this->initialNetDue["Q2"]) $this->netDue["Q2"] = $this->initialNetDue["Q2"];
		if($this->netDue["Q2"] < 0) $this->netDue["Q2"]=0;

		$this->netDue["Q3"] = ($this->initialNetDue["Q1"] + $this->initialNetDue["Q2"] + $this->initialNetDue["Q3"] + $this->formArray["totalBacktaxesBalance"]) - $this->formArray["totalPaid"];
//		$this->netDue["Q2"] = ($this->initialNetDue["Q1"] + $this->initialNetDue["Q2"] + $this->initialNetDue["Q3"] + $this->formArray["totalBacktaxesBalance"]) - 75;
		if($this->netDue["Q3"] > $this->initialNetDue["Q3"]) $this->netDue["Q3"] = $this->initialNetDue["Q3"];
		if($this->netDue["Q3"] < 0) $this->netDue["Q3"]=0;

		$this->netDue["Q4"] = ($this->initialNetDue["Q1"] + $this->initialNetDue["Q2"] + $this->initialNetDue["Q3"] + $this->initialNetDue["Q4"] + $this->formArray["totalBacktaxesBalance"]) - $this->formArray["totalPaid"];
//		$this->netDue["Q4"] = ($this->initialNetDue["Q1"] + $this->initialNetDue["Q2"] + $this->initialNetDue["Q3"] + $this->initialNetDue["Q4"] + $this->formArray["totalBacktaxesBalance"]) - 75;
		if($this->netDue["Q4"] > $this->initialNetDue["Q4"]) $this->netDue["Q4"] = $this->initialNetDue["Q4"];
		if($this->netDue["Q4"] < 0) $this->netDue["Q4"]=0;

		if($this->netDue["Q4"]<=0 && $this->netDue["Q3"]<=0 && $this->netDue["Q2"]<=0 && $this->netDue["Q1"]<=0){
			$this->netDue["Annual"]=0;
		}

		$this->tpl->set_var("netDue[Annual]",formatCurrency(round($this->netDue["Annual"],4)));
		$this->tpl->set_var("netDue[Q1]",formatCurrency(round($this->netDue["Q1"],4)));
		$this->tpl->set_var("netDue[Q2]",formatCurrency(round($this->netDue["Q2"],4)));
		$this->tpl->set_var("netDue[Q3]",formatCurrency(round($this->netDue["Q3"],4)));
		$this->tpl->set_var("netDue[Q4]",formatCurrency(round($this->netDue["Q4"],4)));
		$this->tpl->set_var("netDue",formatCurrency(round($this->netDue["Annual"],4)));

		if($this->formArray["totalBacktaxesBalance"] > 0){
			$this->tdRecord["taxDue"] = $this->netDue["Annual"] - $this->formArray["totalBacktaxesBalance"];
		}
		else{
			$this->tdRecord["taxDue"] = $this->netDue["Annual"];
		}

		$this->formArray["totalNetDue"] += $this->netDue["Annual"];

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

				foreach($paymentArrayList as $payment){
					$this->paymentIDArray[] = $payment->getPaymentID();
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
							$this->formArray["totalPaid"] += $collection->getAmountPaid();
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

						$this->tpl->set_var("taxDue", number_format($val->getTotal(),2));


						$this->formArray["totalBacktaxesDue"] = 0;
						$this->formArray["totalBacktaxesDue"] += $val->getBasicTax();
						$this->formArray["totalBacktaxesDue"] += $val->getSefTax();
						$this->formArray["totalBacktaxesDue"] += $val->getIdleTax();
						$this->formArray["totalBacktaxesDue"] += $val->getPenalties();
						$this->formArray["totalBacktaxesBalance"] += ($val->getTotalTaxDue() + $val->getPaid());

						$this->backtaxTDIDArray[] = $val->getBacktaxTDID();

						$backtaxTDRecord["arpNumber"] = $val->getTdNumber();
						$backtaxTDRecord["assessedValue"] = $val->getAssessedValue();
						$backtaxTDRecord["basic"] = $val->getBasicTax();
						$backtaxTDRecord["sef"] = $val->getSEFTax();
						$backtaxTDRecord["penalty"] = $val->getPenalties();

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

	function getAmnestyStatusForDue($dueArrayList){
		$condition = " WHERE status='' AND (";
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

	function getAmountPaidForDue($dueArrayList){
		$condition = " WHERE status='' AND ";
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

	function Main(){
		$RPTOPDetails = new SoapObject(NCCBIZ."RPTOPDetails.php", "urn:Object");
		if (!$xmlStr = $RPTOPDetails->getRPTOP($this->formArray["rptopID"])){
			exit("xml failed");
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				exit("error domDoc");				
			}
			else{
				$rptop = new RPTOP;
				$rptop->parseDomDocument($domDoc);
				foreach($rptop as $key => $value){
					switch ($key){
						case "owner":
							if (is_a($value,"Owner")){
								$this->formArray["ownerID"] = $rptop->owner->getOwnerID();
								$xmlStr = $rptop->owner->domDocument->dump_mem(true);
								if (!$xmlStr){
									$this->formArray["ownerName"] = "";
								}
								else {
									if(!$domDoc = domxml_open_mem($xmlStr)) {
										$this->formArray["ownerName"] = "";
									}
									else {
										$this->displayOwnerList($domDoc);
									}
								}
							}
							else{
								$this->formArray["ownerNames"] = "";
							}
						break;
						case "tdArray":
							$tdCtr = 0;
							if (count($value)){
								foreach($value as $tkey => $tvalue){

									$this->tdRecord["arpNumber"] = $tvalue->getTaxDeclarationNumber();

									$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
									if (!$xmlStr = $AFSDetails->getAFS($tvalue->getAfsID())){
										// error xml
									}
									else{
										if(!$domDoc = domxml_open_mem($xmlStr)) {
											// error domDoc
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

											$this->tdRecord["assessedValue"] = $afs->getTotalAssessedValue();

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
										// error xml
										// taxDue = uncalculated
									}
									else{
										if(!$domDoc = domxml_open_mem($xmlStr)) {
											// error domDoc
											// taxDue = uncalculated
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
																$this->tdRecord["basic"] = $due->getBasicTax();
																$this->tdRecord["sef"] = $due->getSEFTax();
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
												if(strtotime($this->now) >= $this->formArray["discountPeriod_Start"] && strtotime($this->now) <= $this->formArray["discountPeriod_End"]){
													if(strtotime($this->now) <= strtotime($dueArrayList[$dKey]->getDueDate())){
														$dueArrayList[$dKey]->setEarlyPaymentDiscount($dueArrayList[$dKey]->getTaxDue() * ($this->formArray["discountPercentage"]/100));
													}
												}

												// compute advancedPaymentDiscount as of today
												// check if today is BEFORE January 1 of the year of the annual dueDate

												$dueArrayList[$dKey]->setAdvancedPaymentDiscount(0.00);
												if(strtotime($this->now) < strtotime(date("Y",strtotime($dueArrayList[$dKey]->getDueDate()))."-01-01")){
													$dueArrayList[$dKey]->setAdvancedPaymentDiscount($dueArrayList[$dKey]->getTaxDue() * ($this->formArray["advancedDiscountPercentage"]/100));
												}

												$latestPaymentDate = $this->getLatestPaymentDate($dueArrayList);
												$amountPaidForDue = $this->getAmountPaidForDue($dueArrayList);
												$amnestyStatus = $this->getAmnestyStatusForDue($dueArrayList);

												// calculate Penalties verses either today or verses the last paymentDate
												if($latestPaymentDate!=""){
													$dueArrayList[$dKey] = $this->computePenalty($latestPaymentDate,$dueArrayList[$dKey]);

													// if balance is 0 leave penalty as is, otherwise calculatePenalty according to date now
													$balance = $dueArrayList[$dKey]->getInitialNetDue() - $amountPaidForDue;
													if(round($balance,4) > 0){
														$dueArrayList[$dKey] = $this->computePenalty($this->now,$dueArrayList[$dKey]);
													}
												}
												else{
													$dueArrayList[$dKey] = $this->computePenalty($this->now,$dueArrayList[$dKey]);
												}

												$this->tpl->set_var("advancedPaymentDiscount[".$dKey."]",formatCurrency($dueArrayList[$dKey]->getAdvancedPaymentDiscount()));
												$this->tpl->set_var("earlyPaymentDiscount[".$dKey."]",formatCurrency($dueArrayList[$dKey]->getEarlyPaymentDiscount()));
												$this->tpl->set_var("monthsOverDue[".$dKey."]",$dueArrayList[$dKey]->getMonthsOverDue());
												$this->tpl->set_var("penaltyPercentage[".$dKey."]",$dueArrayList[$dKey]->getPenaltyPercentage()*100);
												$this->tpl->set_var("penalty[".$dKey."]",formatCurrency($dueArrayList[$dKey]->getPenalty()));
												$this->tpl->set_var("initialNetDue[".$dKey."]",formatCurrency($dueArrayList[$dKey]->getInitialNetDue()));
												$this->initialNetDue[$dKey] = $dueArrayList[$dKey]->getInitialNetDue();
												if($amnestyStatus){
													$this->initialNetDue[$dKey] -= $dueArrayList[$dKey]->getPenalty();
													$this->tpl->set_var("amnesty[".$dKey."]","Yes");
												}
												else{
													$this->tpl->set_var("amnesty[".$dKey."]","No");
												}

												if($dKey=="Annual"){
													$this->tdRecord["penalty"] = $dueArrayList[$dKey]->getPenalty();
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

									$tdCtr++;
								}
							}
							else {
								// 0
							}
							$this->tpl->set_var("tdCtr", $tdCtr);
						break;
					}
				}
			}
		}

		if(is_array($this->tdArrayList)){
			ksort($this->tdArrayList);
			reset($this->tdArrayList);
			$this->tpl->set_block("rptsTemplate", "TDList", "TDListBlock");
			$this->formArray["totalTaxDue"] = 0;
			foreach($this->tdArrayList as $tdRecord){
				$this->tpl->set_var("tdYPos", $this->formArray["tdYPosValue"]);

				$this->tpl->set_var("arpNumber", $tdRecord["arpNumber"]);
				$this->tpl->set_var("class", $tdRecord["class"]);

				if(strlen($tdRecord["location"]) > 25){
					$this->formArray["tdYPosValue"]-=15;
				}

				$this->tpl->set_var("location", $tdRecord["location"]);
				$this->tpl->set_var("year", $tdRecord["year"]);

				$this->tpl->set_var("assessedValue", formatCurrency($tdRecord["assessedValue"]));
				$this->tpl->set_var("basic", formatCurrency($tdRecord["basic"]));
				$this->tpl->set_var("sef", formatCurrency($tdRecord["sef"]));
				$this->tpl->set_var("penalty", formatCurrency($tdRecord["penalty"]));
				$this->tpl->set_var("taxDue", formatCurrency($tdRecord["taxDue"]));
				
				$this->formArray["totalTaxDue"] += $tdRecord["taxDue"];
				$this->tpl->parse("TDListBlock", "TDList", true);
				$this->formArray["tdYPosValue"]-=15;
			}
		}

        $this->setForm();
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

$noticeOfDelinquencyPrint = new NoticeOfDelinquencyPrint($HTTP_POST_VARS,$sess,$rptopID,$ownerID);
$noticeOfDelinquencyPrint->Main();
?>
<?php page_close(); ?>
