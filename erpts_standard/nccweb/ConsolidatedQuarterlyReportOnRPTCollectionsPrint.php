<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/web/clibPDFWriter.php";

include_once "../includes/assessor/Barangay.php";
include_once "../includes/assessor/BarangayRecords.php";
include_once "../includes/assessor/MunicipalityCity.php";
include_once "../includes/assessor/MunicipalityCityRecords.php";
include_once "../includes/assessor/Province.php";
include_once "../includes/assessor/ProvinceRecords.php";

include_once "../includes/assessor/OD.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/TD.php";
include_once "../includes/assessor/LocationAddress.php";

include_once "../includes/assessor/LandActualUses.php";
include_once "../includes/assessor/PlantsTreesActualUses.php";
include_once "../includes/assessor/ImprovementsBuildingsActualUses.php";
include_once "../includes/assessor/MachineriesActualUses.php";

include_once "../includes/collection/BacktaxTD.php";

include_once "../includes/collection/Payment.php";
include_once "../includes/collection/PaymentRecords.php";
include_once "../includes/collection/Collection.php";
include_once "../includes/collection/CollectionRecords.php";
include_once "../includes/collection/Receipt.php";
include_once "../includes/collection/ReceiptRecords.php";

#####################################
# Define Interface Class
#####################################

class ConsolidatedQuarterlyReportOnRPTCollectionsPrint{
	
	var $tpl;
	var $formArray;

	function ConsolidatedQuarterlyReportOnRPTCollectionsPrint($http_post_vars,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "reports2B2a.xml") ;
		$this->tpl->set_var("TITLE", "Consolidated Quarterly Report on Real Property Tax Collections");

       	$this->formArray = array(
			"municipalityCityID" => ""
			,"provinceID" => ""
			,"quarter" => ""
			,"year" => ""

			,"municipalityCity" => ""
			,"province" => ""
			,"quarterEndingDate" => ""
			,"year" => ""
			,"levyRate" => "0"
			,"noBgys" => "0"

			,"ypos" => ""

			// Residential
			,"paidBasic1" => "0.00"
			,"discountBasic1" => "0.00"
			,"priorBasic1" => "0.00"
			,"penaltyBasic1" => "0.00"
			,"priorPenaltyBasic1" => "0.00"
			,"totalNetBasic1" => "0.00"

			,"paidSEF1" => "0.00"
			,"discountSEF1" => "0.00"
			,"priorSEF1" => "0.00"
			,"penaltySEF1" => "0.00"
			,"priorPenaltySEF1" => "0.00"
			,"totalNetSEF1" => "0.00"

			,"paidIdle1" => "0.00"
			,"priorIdle1" => "0.00"
			,"penaltyIdle1" => "0.00"
			,"totalIdle1" => "0.00"

			,"specialLevy1" => "0.00"
			,"totalNonCash1" => "0.00"

			,"grandTotalNetCol1" => "0.00"

			// Agricultural
			,"paidBasic2" => "0.00"
			,"discountBasic2" => "0.00"
			,"priorBasic2" => "0.00"
			,"penaltyBasic2" => "0.00"
			,"priorPenaltyBasic2" => "0.00"
			,"totalNetBasic2" => "0.00"
			,"paidSEF2" => "0.00"
			,"discountSEF2" => "0.00"
			,"priorSEF2" => "0.00"
			,"penaltySEF2" => "0.00"
			,"priorPenaltySEF2" => "0.00"
			,"totalNetSEF2" => "0.00"
			,"paidIdle2" => "0.00"
			,"priorIdle2" => "0.00"
			,"penaltyIdle2" => "0.00"
			,"totalIdle2" => "0.00"
			,"specialLevy2" => "0.00"
			,"totalNonCash2" => "0.00"
			,"grandTotalNetCol2" => "0.00"

			// Commercial
			,"paidBasic3" => "0.00"
			,"discountBasic3" => "0.00"
			,"priorBasic3" => "0.00"
			,"penaltyBasic3" => "0.00"
			,"priorPenaltyBasic3" => "0.00"
			,"totalNetBasic3" => "0.00"
			,"paidSEF3" => "0.00"
			,"discountSEF3" => "0.00"
			,"priorSEF3" => "0.00"
			,"penaltySEF3" => "0.00"
			,"priorPenaltySEF3" => "0.00"
			,"totalNetSEF3" => "0.00"
			,"paidIdle3" => "0.00"
			,"priorIdle3" => "0.00"
			,"penaltyIdle3" => "0.00"
			,"totalIdle3" => "0.00"
			,"specialLevy3" => "0.00"
			,"totalNonCash3" => "0.00"
			,"grandTotalNetCol3" => "0.00"

			// Industrial
			,"paidBasic4" => "0.00"
			,"discountBasic4" => "0.00"
			,"priorBasic4" => "0.00"
			,"penaltyBasic4" => "0.00"
			,"priorPenaltyBasic4" => "0.00"
			,"totalNetBasic4" => "0.00"
			,"paidSEF4" => "0.00"
			,"discountSEF4" => "0.00"
			,"priorSEF4" => "0.00"
			,"penaltySEF4" => "0.00"
			,"priorPenaltySEF4" => "0.00"
			,"totalNetSEF4" => "0.00"
			,"paidIdle4" => "0.00"
			,"priorIdle4" => "0.00"
			,"penaltyIdle4" => "0.00"
			,"totalIdle4" => "0.00"
			,"specialLevy4" => "0.00"
			,"totalNonCash4" => "0.00"
			,"grandTotalNetCol4" => "0.00"

			// Mineral
			,"paidBasic5" => "0.00"
			,"discountBasic5" => "0.00"
			,"priorBasic5" => "0.00"
			,"penaltyBasic5" => "0.00"
			,"priorPenaltyBasic5" => "0.00"
			,"totalNetBasic5" => "0.00"
			,"paidSEF5" => "0.00"
			,"discountSEF5" => "0.00"
			,"priorSEF5" => "0.00"
			,"penaltySEF5" => "0.00"
			,"priorPenaltySEF5" => "0.00"
			,"totalNetSEF5" => "0.00"
			,"paidIdle5" => "0.00"
			,"priorIdle5" => "0.00"
			,"penaltyIdle5" => "0.00"
			,"totalIdle5" => "0.00"
			,"specialLevy5" => "0.00"
			,"totalNonCash5" => "0.00"
			,"grandTotalNetCol5" => "0.00"

			// Timber
			,"paidBasic6" => "0.00"
			,"discountBasic6" => "0.00"
			,"priorBasic6" => "0.00"
			,"penaltyBasic6" => "0.00"
			,"priorPenaltyBasic6" => "0.00"
			,"totalNetBasic6" => "0.00"
			,"paidSEF6" => "0.00"
			,"discountSEF6" => "0.00"
			,"priorSEF6" => "0.00"
			,"penaltySEF6" => "0.00"
			,"priorPenaltySEF6" => "0.00"
			,"totalNetSEF6" => "0.00"
			,"paidIdle6" => "0.00"
			,"priorIdle6" => "0.00"
			,"penaltyIdle6" => "0.00"
			,"totalIdle6" => "0.00"
			,"specialLevy6" => "0.00"
			,"totalNonCash6" => "0.00"
			,"grandTotalNetCol6" => "0.00"

			// Special
			,"paidBasic7" => "0.00"
			,"discountBasic7" => "0.00"
			,"priorBasic7" => "0.00"
			,"penaltyBasic7" => "0.00"
			,"priorPenaltyBasic7" => "0.00"
			,"totalNetBasic7" => "0.00"
			,"paidSEF7" => "0.00"
			,"discountSEF7" => "0.00"
			,"priorSEF7" => "0.00"
			,"penaltySEF7" => "0.00"
			,"priorPenaltySEF7" => "0.00"
			,"totalNetSEF7" => "0.00"
			,"paidIdle7" => "0.00"
			,"priorIdle7" => "0.00"
			,"penaltyIdle7" => "0.00"
			,"totalIdle7" => "0.00"
			,"specialLevy7" => "0.00"
			,"totalNonCash7" => "0.00"
			,"grandTotalNetCol7" => "0.00"

			// Hospital
			,"paidBasic8" => "0.00"
			,"discountBasic8" => "0.00"
			,"priorBasic8" => "0.00"
			,"penaltyBasic8" => "0.00"
			,"priorPenaltyBasic8" => "0.00"
			,"totalNetBasic8" => "0.00"
			,"paidSEF8" => "0.00"
			,"discountSEF8" => "0.00"
			,"priorSEF8" => "0.00"
			,"penaltySEF8" => "0.00"
			,"priorPenaltySEF8" => "0.00"
			,"totalNetSEF8" => "0.00"
			,"paidIdle8" => "0.00"
			,"priorIdle8" => "0.00"
			,"penaltyIdle8" => "0.00"
			,"totalIdle8" => "0.00"
			,"specialLevy8" => "0.00"
			,"totalNonCash8" => "0.00"
			,"grandTotalNetCol8" => "0.00"

			// Scientific
			,"paidBasic9" => "0.00"
			,"discountBasic9" => "0.00"
			,"priorBasic9" => "0.00"
			,"penaltyBasic9" => "0.00"
			,"priorPenaltyBasic9" => "0.00"
			,"totalNetBasic9" => "0.00"
			,"paidSEF9" => "0.00"
			,"discountSEF9" => "0.00"
			,"priorSEF9" => "0.00"
			,"penaltySEF9" => "0.00"
			,"priorPenaltySEF9" => "0.00"
			,"totalNetSEF9" => "0.00"
			,"paidIdle9" => "0.00"
			,"priorIdle9" => "0.00"
			,"penaltyIdle9" => "0.00"
			,"totalIdle9" => "0.00"
			,"specialLevy9" => "0.00"
			,"totalNonCash9" => "0.00"
			,"grandTotalNetCol9" => "0.00"

			// Cultural
			,"paidBasic10" => "0.00"
			,"discountBasic10" => "0.00"
			,"priorBasic10" => "0.00"
			,"penaltyBasic10" => "0.00"
			,"priorPenaltyBasic10" => "0.00"
			,"totalNetBasic10" => "0.00"
			,"paidSEF10" => "0.00"
			,"discountSEF10" => "0.00"
			,"priorSEF10" => "0.00"
			,"penaltySEF10" => "0.00"
			,"priorPenaltySEF10" => "0.00"
			,"totalNetSEF10" => "0.00"
			,"paidIdle10" => "0.00"
			,"priorIdle10" => "0.00"
			,"penaltyIdle10" => "0.00"
			,"totalIdle10" => "0.00"
			,"specialLevy10" => "0.00"
			,"totalNonCash10" => "0.00"
			,"grandTotalNetCol10" => "0.00"

			// Others
			,"paidBasic11" => "0.00"
			,"discountBasic11" => "0.00"
			,"priorBasic11" => "0.00"
			,"penaltyBasic11" => "0.00"
			,"priorPenaltyBasic11" => "0.00"
			,"totalNetBasic11" => "0.00"
			,"paidSEF11" => "0.00"
			,"discountSEF11" => "0.00"
			,"priorSEF11" => "0.00"
			,"penaltySEF11" => "0.00"
			,"priorPenaltySEF11" => "0.00"
			,"totalNetSEF11" => "0.00"
			,"paidIdle11" => "0.00"
			,"priorIdle11" => "0.00"
			,"penaltyIdle11" => "0.00"
			,"totalIdle11" => "0.00"
			,"specialLevy11" => "0.00"
			,"totalNonCash11" => "0.00"
			,"grandTotalNetCol11" => "0.00"

			// Totals
			,"totalPaidBasic" => "0.00"
			,"totalDiscountBasic" => "0.00"
			,"totalPriorBasic" => "0.00"
			,"totalPenaltyBasic" => "0.00"
			,"totalPriorPenaltyBasic" => "0.00"
			,"totalTotalNetBasic" => "0.00"
			,"totalPaidSEF" => "0.00"
			,"totalDiscountSEF" => "0.00"
			,"totalPriorSEF" => "0.00"
			,"totalPenaltySEF" => "0.00"
			,"totalPriorPenaltySEF" => "0.00"
			,"totalTotalNetSEF" => "0.00"
			,"totalPaidIdle" => "0.00"
			,"totalPriorIdle" => "0.00"
			,"totalPenaltyIdle" => "0.00"
			,"totalTotalIdle" => "0.00"
			,"totalSpecialLevy" => "0.00"
			,"totalTotalNonCash" => "0.00"
			,"totalGrandTotalNetCol" => "0.00"
		);

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function formatCurrency($key){
		if($this->formArray[$key]!=""){
			$this->formArray[$key] = number_format($this->formArray[$key], 2, ".", ",");
		}
	}

	function setvar($key,$value,$formatCurrency=false){
		$this->formArray[$key] = $value;
		if($formatCurrency){
			$value = formatCurrency($value);
		}
		$this->tpl->set_var($key,html_entity_to_alpha($value));
	}
	
	function setForm(){




		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, html_entity_to_alpha($value));
		}
	}

	function displayPageHeading(){
		$BarangayList = new SoapObject(NCCBIZ."BarangayList.php", "urn:Object");
		if(!$this->formArray["noBgys"] = $BarangayList->getBarangayCount("WHERE ".BARANGAY_TABLE.".status='active'")) $this->formArray["noBgys"] = 0;

		$MunicipalityCityDetails = new SoapObject(NCCBIZ."MunicipalityCityDetails.php", "urn:Object");
		if(!$xmlStr = $MunicipalityCityDetails->getMunicipalityCityDetails($this->formArray["municipalityCityID"])){
			exit("no municipality/city selected");
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				exit("no municipality/city selected");
			}
			else{
				$municipalityCity = new MunicipalityCity;
				$municipalityCity->parseDomDocument($domDoc);

				$this->formArray["municipalityCity"] = $municipalityCity->getDescription();
				$this->formArray["provinceID"] = $municipalityCity->getProvinceID();

				$ProvinceDetails = new SoapObject(NCCBIZ."ProvinceDetails.php","urn:Object");
				if(!$xmlStr = $ProvinceDetails->getProvinceDetails($this->formArray["provinceID"])){
					exit("no province associated with selected municipality/city");
				}
				else{
					if(!$domDoc = domxml_open_mem($xmlStr)){
						exit("no province associated with selected municipality/city");
					}
					else{
						$province = new Province;
						$province->parseDomDocument($domDoc);
						$this->formArray["province"] = $province->getDescription();
					}
				}
			}
		}

		$quarterEndingDateArray = array(
			"Q1" => "March 31"
			,"Q2" => "June 30"
			,"Q3" => "September 30"
			,"Q4" => "December 31"
		);

		$quarterBeginningDateArray = array(
			"Q1" => "January 1"
			,"Q2" => "April 1"
			,"Q3" => "July 1"
			,"Q4" => "October 1"
		);

		$this->formArray["quarterEndingDate"] = $quarterEndingDateArray[$this->formArray["quarter"]];
		$this->formArray["quarterBeginningDate"] = $quarterBeginningDateArray[$this->formArray["quarter"]];
	}

	function filterPaymentsByCurrentQuarter(){
		$paymentEndingDate = date("Y-m-d", strtotime($this->formArray["quarterEndingDate"]." ".$this->formArray["year"]));
		$paymentBeginningDate = date("Y-m-d", strtotime($this->formArray["quarterBeginningDate"]." ".$this->formArray["year"]));

		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php", "urn:Object");
		$condition = "WHERE ".PAYMENT_TABLE.".status!='cancelled' AND (".PAYMENT_TABLE.".paymentDate >= '".$paymentBeginningDate."' AND ".PAYMENT_TABLE.".paymentDate <= '".$paymentEndingDate."')";

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
				return $paymentRecords;
			}
		}
	}

	function checkTDIsInLocation($tdID){
		$ODDetails = new SoapObject(NCCBIZ."ODDetails.php", "urn:Object");
		if($odID = $ODDetails->getOdIDFromTdID($tdID)){
			if(!$xmlStr = $ODDetails->getOD($odID)){
				return false;
			}
			else{
				if(!$domDoc = domxml_open_mem($xmlStr)){
					return false;
				}
				else{
					$od = new OD;
					$od->parseDomDocument($domDoc);
					$locationAddress = $od->getLocationAddress();

					if(is_object($locationAddress)){
						// ideally, locationAddress->municipalityCity is an ID
						// but old data still stores textual municipalityCity information
						$municipalityCity = $locationAddress->getMunicipalityCity();
						if($municipalityCity==$this->formArray["municipalityCityID"]){
							return true;
						}
						else if($municipalityCity==$this->formArray["municipalityCity"]){
							return true;
						}
					}
					return false;
				}
			}
		}
		else{
			return false;
		}
	}
	
	function checkBacktaxTDIsInLocation($backtaxTDID){
		$BacktaxTDDetails = new SoapObject(NCCBIZ."BacktaxTDDetails.php", "urn:Object");
		if(!$xmlStr = $BacktaxTDDetails->getBacktaxTD2($backtaxTDID)){
			return false;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return false;
			}
			else{
				$backtaxTD = new BacktaxTD;
				$backtaxTD->parseDomDocument($domDoc);
				if($tdID = $backtaxTD->getTDID()){
					return $this->checkTDIsInLocation($tdID);
				}
				else{
					return false;
				}
			}
		}
	}

	function getPropertyClassificationFromTD($tdID){
		$TDDetails = new SoapObject(NCCBIZ."TDDetails.php","urn:Object");
		if(!$xmlStr = $TDDetails->getTD($tdID)){
			return false;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return false;
			}
			else{
				$td = new TD;
				$td->parseDomDocument($domDoc);

				$afsID = $td->getAfsID();
				$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");

				if(!$xmlStr = $AFSDetails->getAFS($afsID)){
					return false;
				}
				else{
					if(!$domDoc = domxml_open_mem($xmlStr)){
						return false;
					}
					else{
						$afs = new AFS;
						$afs->parseDomDocument($domDoc);

						$LandActualUsesDetails = new SoapObject(NCCBIZ."LandActualUsesDetails.php", "urn:Object");
						$PlantsTreesActualUsesDetails = new SoapObject(NCCBIZ."PlantsTreesActualUsesDetails.php", "urn:Object");
						$ImprovementsBuildingsActualUsesDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsActualUsesDetails.php", "urn:Object");
						$MachineriesActualUsesDetails = new SoapObject(NCCBIZ."MachineriesActualUsesDetails.php", "urn:Object");

						if(is_array($afs->landArray)){
							foreach($afs->landArray as $land){
								$landActualUsesID = $land->getActualUse();

								if($xmlStr = $LandActualUsesDetails->getLandActualUsesDetails($landActualUsesID)){
									if($domDoc = domxml_open_mem($xmlStr)){
										$landActualUses = new LandActualUses;
										$landActualUses->parseDomDocument($domDoc);

										return $landActualUses->getReportCode();
									}
								}
							}
						}
						else if(is_array($afs->plantsTreesArray)){
							foreach($afs->plantsTreesArray as $plantsTrees){
								$plantsTreesActualUsesID = $plantsTrees->getActualUse();

								if($xmlStr = $PlantsTreesActualUsesDetails->getPlantsTreesActualUsesDetails($plantsTreesActualUsesID)){
									if($domDoc = domxml_open_mem($xmlStr)){
										$plantsTreesActualUses = new PlantsTreesActualUses;
										$plantsTreesActualUses->parseDomDocument($domDoc);

										return $plantsTreesActualUses->getReportCode();
									}
								}
							}
						}
						else if(is_array($afs->improvementsBuildingsArray)){
							foreach($afs->improvementsBuildingsArray as $improvementsBuildings){
								$improvementsBuildingsActualUsesID = $improvementsBuildings->getActualUse();

								if($xmlStr = $ImprovementsBuildingsActualUsesDetails->getImprovementsBuildingsActualUsesDetails($improvementsBuildingsActualUsesID)){
									if($domDoc = domxml_open_mem($xmlStr)){
										$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
										$improvementsBuildingsActualUses->parseDomDocument($domDoc);

										return $improvementsBuildingsActualUses->getReportCode();
									}
								}
							}
						}
						else if(is_array($afs->machineriesArray)){
							foreach($afs->machineriesArray as $machineries){
								$machineriesActualUsesID = $machineries->getActualUse();

								if($xmlStr = $MachineriesActualUsesDetails->getMachineriesActualUsesDetails($machineriesActualUsesID)){
									if($domDoc = domxml_open_mem($xmlStr)){
										$machineriesActualUses = new MachineriesActualUses;
										$machineriesActualUses->parseDomDocument($domDoc);

										return $machineriesActualUses->getReportCode();
									}
								}
							}
						}

						return true;
					}
				}
			}
		}
	}

	function getPropertyClassificationFromBacktaxTD($backtaxTDID){
		$BacktaxTDDetails = new SoapObject(NCCBIZ."BacktaxTDDetails.php", "urn:Object");
		if(!$xmlStr = $BacktaxTDDetails->getBacktaxTD2($backtaxTDID)){
			return false;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return false;
			}
			else{
				$backtaxTD = new BacktaxTD;
				$backtaxTD->parseDomDocument($domDoc);
				if($tdID = $backtaxTD->getTDID()){
					return $this->getPropertyClassificationFromTD($tdID);
				}
				else{
					return false;
				}
			}
		}
	}

	function filterPaymentsByLocationAndAssignPropertyClassification(){
		if(is_array($this->paymentRecords->getArrayList())){
			$list = $this->paymentRecords->getArrayList();
			$paymentRecords = new PaymentRecords;
			foreach($list as $payment){
				$tdID = $payment->getTdID();
				$backtaxTDID = $payment->getBacktaxTDID();
				if($tdID!="0"){
					if($this->checkTDIsInLocation($tdID)){
						$propertyClassification = $this->getPropertyClassificationFromTD($tdID);
						$payment->setPropertyClassification($propertyClassification);
						$paymentRecords->arrayList[] = $payment;
					}
				}
				else if($backtaxTDID!="0"){
					if($this->checkBacktaxTDIsInLocation($backtaxTDID)){
						$propertyClassification = $this->getPropertyClassificationFromBacktaxTD($backtaxTDID);
						$payment->setPropertyClassification($propertyClassification);
						$paymentRecords->arrayList[] = $payment;
					}
				}
			}
			return $paymentRecords;
		}
		else{
			return false;
		}
	}

	function getReceipt($receiptID){
		$ReceiptDetails = new SoapObject(NCCBIZ."ReceiptDetails.php", "urn:Object");
		if(!$xmlStr = $ReceiptDetails->getReceipt($receiptID)){
			return false;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return false;
			}
			else{
				$receipt = new Receipt;
				$receipt->parseDomDocument($domDoc);
				return $receipt;
			}
		}
	}

	function computeIncrementValues($suffixKey,$collection,$yearType,$taxType){
		$discount = 0;
		$penalty = 0;
		$paid = 0;

		if($collection->getAmountPaid() > 0){
			if($collection->getAmountPaid() < $collection->getBalanceDue()){
				if($collection->getAmnesty()=="true"){
					$discount = $collection->getEarlyPaymentDiscount() + $collection->getAdvancedPaymentDiscount();
					$penalty = 0;
					$paid = $collection->getAmountPaid();
				}
				else{
					$discount = $collection->getEarlyPaymentDiscount() + $collection->getAdvancedPaymentDiscount();
					$penalty = $collection->getPenalty();
					$paid = $collection->getAmountPaid() - $collection->getPenalty();
					if($paid < 0){
						$penalty = $penalty + $paid;
						$paid = 0;
					}
				}
			}
			else{
				if($collection->getAmnesty()=="true"){
					$discount = $collection->getEarlyPaymentDiscount() + $collection->getAdvancedPaymentDiscount();
					$penalty = 0;
					$paid = $collection->getAmountPaid();
				}
				else{
					$discount = $collection->getEarlyPaymentDiscount() + $collection->getAdvancedPaymentDiscount();
					$penalty = $collection->getPenalty();
					$paid = $collection->getAmountPaid() - $collection->getPenalty();
				}
			}
		}
		else{
			$paid = 0;
			$discount = 0;
			$penalty = 0;
		}
		
		switch($taxType){
			case "basic":
				if($yearType=="prior"){
					$this->formArray["priorBasic".$suffixKey] += $paid;
					$this->formArray["priorPenaltyBasic".$suffixKey] += $penalty;

					$this->formArray["totalNetBasic".$suffixKey] += $paid + $penalty;
					$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $penalty;
				}
				// yearType = 'current'
				else{
					$this->formArray["paidBasic".$suffixKey] += $paid;

					$this->formArray["discountBasic".$suffixKey] += $discount;
					$this->formArray["penaltyBasic".$suffixKey] += $penalty;

					// removed discount from computing for totalNet and grandTotalNet
					// $this->formArray["totalNetBasic".$suffixKey] += $paid + $discount + $penalty;
					// $this->formArray["grandTotalNetCol".$suffixKey] += $paid + $discount + $penalty;
					
					$this->formArray["totalNetBasic".$suffixKey] += $paid + $penalty;
					$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $penalty;
				}
				break;
			case "sef":
				if($yearType=="prior"){
					$this->formArray["priorSEF".$suffixKey] += $paid;
					$this->formArray["priorPenaltySEF".$suffixKey] += $penalty;

					$this->formArray["totalNetSEF".$suffixKey] += $paid + $penalty;
					$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $penalty;
				}
				// yearType = 'current'
				else{
					$this->formArray["paidSEF".$suffixKey] += $paid;
					$this->formArray["discountSEF".$suffixKey] += $discount;
					$this->formArray["penaltySEF".$suffixKey] += $penalty;

					// removed discount from computing for totalNet and grandTotalNet
					// $this->formArray["totalNetSEF".$suffixKey] += $paid + $discount + $penalty;
					// $this->formArray["grandTotalNetCol".$suffixKey] += $paid + $discount + $penalty;

					$this->formArray["totalNetSEF".$suffixKey] += $paid + $penalty;
					$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $penalty;
				}
				break;
			case "idle":
				if($yearType=="prior"){
					$this->formArray["priorIdle".$suffixKey] += $paid;
					$this->formArray["penaltyIdle".$suffixKey] += $penalty;

					$this->formArray["totalIdle".$suffixKey] += $paid + $penalty;
					$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $penalty;
				}
				// yearType = 'current'
				else{
					$this->formArray["paidIdle"] += $paid;
					$this->formArray["penaltyIdle".$suffixKey] += $penalty;

					$this->formArray["totalIdle".$suffixKey] += $paid + $penalty;
					$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $penalty;
				}
				break;
		}
	}

	function incrementValues($suffixKey,$payment){
		$CollectionList = new SoapObject(NCCBIZ."CollectionList.php", "urn:Object");
		$condition = "WHERE ".COLLECTION_TABLE.".paymentID='".$payment->getPaymentID()."' AND ".COLLECTION_TABLE.".status!='cancelled'";

		if($xmlStr = $CollectionList->getCollectionList($condition)){
			if($domDoc = domxml_open_mem($xmlStr)){
				$collectionRecords = new CollectionRecords;
				$collectionRecords->parseDomDocument($domDoc);
				if(is_array($collectionRecords->getArrayList())){
					$list = $collectionRecords->getArrayList();

					foreach($list as $collection){
						$receipt = $this->getReceipt($collection->getReceiptID());
						if(is_object($receipt)){
							if($receipt->getPaymentMode()=="cash"){
								switch($collection->getTaxType()){
									case "basic":
										$dueDateYear = date("Y",strtotime($payment->getDueDate()));
										if($dueDateYear < $this->formArray["year"]){
											$this->computeIncrementValues($suffixKey,$collection,"prior","basic");
										}
										else{
											$this->computeIncrementValues($suffixKey,$collection,"current","basic");
										}
										break;
									case "sef":
										$dueDateYear = date("Y",strtotime($payment->getDueDate()));
										if($dueDateYear < $this->formArray["year"]){
											$this->computeIncrementValues($suffixKey,$collection,"prior","sef");
										}
										else{
											$this->computeIncrementValues($suffixKey,$collection,"current","sef");
										}
										break;
									case "idle":
										$dueDateYear = date("Y",strtotime($payment->getDueDate()));
										if($dueDateYear < $this->formArray["year"]){
											$this->computeIncrementValues($suffixKey,$collection,"prior","idle");
										}
										else{
											$this->computeIncrementValues($suffixKey,$collection,"current","idle");
										}
										break;
								}
							}
							else{
								$this->formArray["totalNonCash".$suffixKey] += $collection->getAmountPaid();
								$this->formArray["grandTotalNetCol".$suffixKey] += $collection->getAmountPaid();
							}
						}
					}
				}
			}
		}
	}

	function formatCurrencyFigures(){
		$suffixKey = 1;

		for($suffixKey = 1 ; $suffixKey <= 11 ; $suffixKey++){
			$this->formArray["paidBasic".$suffixKey] = formatCurrency($this->formArray["paidBasic".$suffixKey]);
			$this->formArray["discountBasic".$suffixKey] = formatCurrency($this->formArray["discountBasic".$suffixKey]);
			$this->formArray["priorBasic".$suffixKey] = formatCurrency($this->formArray["priorBasic".$suffixKey]);
			$this->formArray["penaltyBasic".$suffixKey] = formatCurrency($this->formArray["penaltyBasic".$suffixKey]);
			$this->formArray["priorPenaltyBasic".$suffixKey] = formatCurrency($this->formArray["priorPenaltyBasic".$suffixKey]);
			$this->formArray["totalNetBasic".$suffixKey] = formatCurrency($this->formArray["totalNetBasic".$suffixKey]);
			$this->formArray["paidSEF".$suffixKey] = formatCurrency($this->formArray["paidSEF".$suffixKey]);
			$this->formArray["discountSEF".$suffixKey] = formatCurrency($this->formArray["discountSEF".$suffixKey]);
			$this->formArray["priorSEF".$suffixKey] = formatCurrency($this->formArray["priorSEF".$suffixKey]);
			$this->formArray["penaltySEF".$suffixKey] = formatCurrency($this->formArray["penaltySEF".$suffixKey]);
			$this->formArray["priorPenaltySEF".$suffixKey] = formatCurrency($this->formArray["priorPenaltySEF".$suffixKey]);
			$this->formArray["totalNetSEF".$suffixKey] = formatCurrency($this->formArray["totalNetSEF".$suffixKey]);
			$this->formArray["paidIdle".$suffixKey] = formatCurrency($this->formArray["paidIdle".$suffixKey]);
			$this->formArray["priorIdle".$suffixKey] = formatCurrency($this->formArray["priorIdle".$suffixKey]);
			$this->formArray["penaltyIdle".$suffixKey] = formatCurrency($this->formArray["penaltyIdle".$suffixKey]);
			$this->formArray["totalIdle".$suffixKey] = formatCurrency($this->formArray["totalIdle".$suffixKey]);
			$this->formArray["specialLevy".$suffixKey] = formatCurrency($this->formArray["specialLevy".$suffixKey]);
			$this->formArray["totalNonCash".$suffixKey] = formatCurrency($this->formArray["totalNonCash".$suffixKey]);
			$this->formArray["grandTotalNetCol".$suffixKey] = formatCurrency($this->formArray["grandTotalNetCol".$suffixKey]);
		}
		$this->formArray["totalPaidBasic"] = formatCurrency($this->formArray["totalPaidBasic"]);
		$this->formArray["totalDiscountBasic"] = formatCurrency($this->formArray["totalDiscountBasic"]);
		$this->formArray["totalPriorBasic"] = formatCurrency($this->formArray["totalPriorBasic"]);
		$this->formArray["totalPenaltyBasic"] = formatCurrency($this->formArray["totalPenaltyBasic"]);
		$this->formArray["totalPriorPenaltyBasic"] = formatCurrency($this->formArray["totalPriorPenaltyBasic"]);
		$this->formArray["totalTotalNetBasic"] = formatCurrency($this->formArray["totalTotalNetBasic"]);
		$this->formArray["totalPaidSEF"] = formatCurrency($this->formArray["totalPaidSEF"]);
		$this->formArray["totalDiscountSEF"] = formatCurrency($this->formArray["totalDiscountSEF"]);
		$this->formArray["totalPriorSEF"] = formatCurrency($this->formArray["totalPriorSEF"]);
		$this->formArray["totalPenaltySEF"] = formatCurrency($this->formArray["totalPenaltySEF"]);
		$this->formArray["totalPriorPenaltySEF"] = formatCurrency($this->formArray["totalPriorPenaltySEF"]);
		$this->formArray["totalTotalNetSEF"] = formatCurrency($this->formArray["totalTotalNetSEF"]);
		$this->formArray["totalPaidIdle"] = formatCurrency($this->formArray["totalPaidIdle"]);
		$this->formArray["totalPriorIdle"] = formatCurrency($this->formArray["totalPriorIdle"]);
		$this->formArray["totalPenaltyIdle"] = formatCurrency($this->formArray["totalPenaltyIdle"]);
		$this->formArray["totalTotalIdle"] = formatCurrency($this->formArray["totalTotalIdle"]);
		$this->formArray["totalSpecialLevy"] = formatCurrency($this->formArray["totalSpecialLevy"]);
		$this->formArray["totalTotalNonCash"] = formatCurrency($this->formArray["totalTotalNonCash"]);
		$this->formArray["totalGrandTotalNetCol"] = formatCurrency($this->formArray["totalGrandTotalNetCol"]);
	}

	function computeTotals(){
		$suffixKey=1;
		for($suffixKey = 1 ; $suffixKey <= 11 ; $suffixKey++){
			$this->formArray["totalPaidBasic"] += $this->formArray["paidBasic".$suffixKey];
			$this->formArray["totalDiscountBasic"] += $this->formArray["discountBasic".$suffixKey];
			$this->formArray["totalPriorBasic"] += $this->formArray["priorBasic".$suffixKey];
			$this->formArray["totalPenaltyBasic"] += $this->formArray["penaltyBasic".$suffixKey];
			$this->formArray["totalPriorPenaltyBasic"] += $this->formArray["priorPenaltyBasic".$suffixKey];
			$this->formArray["totalTotalNetBasic"] += $this->formArray["totalNetBasic".$suffixKey];
			$this->formArray["totalPaidSEF"] += $this->formArray["paidSEF".$suffixKey];
			$this->formArray["totalDiscountSEF"] += $this->formArray["discountSEF".$suffixKey];
			$this->formArray["totalPriorSEF"] += $this->formArray["priorSEF".$suffixKey];
			$this->formArray["totalPenaltySEF"] += $this->formArray["penaltySEF".$suffixKey];
			$this->formArray["totalPriorPenaltySEF"] += $this->formArray["priorPenaltySEF".$suffixKey];
			$this->formArray["totalTotalNetSEF"] += $this->formArray["totalNetSEF".$suffixKey];
			$this->formArray["totalPaidIdle"] += $this->formArray["paidIdle".$suffixKey];
			$this->formArray["totalPriorIdle"] += $this->formArray["priorIdle".$suffixKey];
			$this->formArray["totalPenaltyIdle"] += $this->formArray["penaltyIdle".$suffixKey];
			$this->formArray["totalTotalIdle"] += $this->formArray["totalIdle".$suffixKey];
			$this->formArray["totalSpecialLevy"] += $this->formArray["specialLevy".$suffixKey];
			$this->formArray["totalTotalNonCash"] += $this->formArray["totalNonCash".$suffixKey];
			$this->formArray["totalGrandTotalNetCol"] += $this->formArray["grandTotalNetCol".$suffixKey];
		}
	}

	function getFilteredPaymentRecords(){
		$paymentEndingDate = date("Y-m-d", strtotime($this->formArray["quarterEndingDate"]." ".$this->formArray["year"]));
		$paymentBeginningDate = date("Y-m-d", strtotime($this->formArray["quarterBeginningDate"]." ".$this->formArray["year"]));

		$condition = "WHERE ".PAYMENT_TABLE.".status!='cancelled' AND (".PAYMENT_TABLE.".paymentDate >= '".$paymentBeginningDate."' AND ".PAYMENT_TABLE.".paymentDate <= '".$paymentEndingDate."')";

		$condition .= " AND (".PAYMENT_TABLE.".municipalityCity LIKE '".$this->formArray["municipalityCity"]."' OR ".PAYMENT_TABLE.".municipalityCity LIKE '".$this->formArray["municipalityCityID"]."') ";

		$condition .= " AND ".PAYMENT_TABLE.".propertyType IS NOT NULL";

		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php", "urn:Object");

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
				return $paymentRecords;
			}
		}
	}

	function Main(){
		$this->displayPageHeading();

		if($this->paymentRecords = $this->getFilteredPaymentRecords()){

// (modifed Dec. 08 but released on February 16, 2005)
// ff two lines commented out: December 08, 2004 in favor of getFilteredPaymentRecords for faster processing.

//		if($this->paymentRecords = $this->filterPaymentsByCurrentQuarter()){
//			if($this->paymentRecords = $this->filterPaymentsByLocationAndAssignPropertyClassification()){
				if(is_array($this->paymentRecords->getArrayList())){
					$list = $this->paymentRecords->getArrayList();
					foreach($list as $payment){
						switch($payment->getPropertyClassification()){
							case "RE":
								$suffixKey = 1;
								$this->incrementValues($suffixKey,$payment);
								break;
							case "AG":
								$suffixKey = 2;
								$this->incrementValues($suffixKey,$payment);
								break;
							case "CO":
								$suffixKey = 3;
								$this->incrementValues($suffixKey,$payment);
								break;
							case "IN":
								$suffixKey = 4;
								$this->incrementValues($suffixKey,$payment);
								break;
							case "MI":
								$suffixKey = 5;
								$this->incrementValues($suffixKey,$payment);
								break;
							case "TI":
								$suffixKey = 6;
								$this->incrementValues($suffixKey,$payment);
								break;
							case "SP":
								$suffixKey = 7;
								$this->incrementValues($suffixKey,$payment);
								break;
							case "HO":
								$suffixKey = 8;
								$this->incrementValues($suffixKey,$payment);
								break;
							case "SC":
								$suffixKey = 9;
								$this->incrementValues($suffixKey,$payment);
								break;
							case "CU":
								$suffixKey = 10;
								$this->incrementValues($suffixKey,$payment);
								break;
	
							case "CH":
							case "ED":
							case "GO":
							case "OTX":
							case "OTE":
							case "RL":
							default:
								$suffixKey = 11;
								$this->incrementValues($suffixKey,$payment);
								break;
						}
					}
				}				
//			}
		}

		$this->computeTotals();
		$this->formatCurrencyFigures();
		$this->setForm();

        $this->tpl->parse("templatePage", "rptsTemplate");
        $this->tpl->finish("templatePage");
//exit;
		$testpdf = new PDFWriter;
        $testpdf->setOutputXML($this->tpl->get("templatePage"),"test");
        if(isset($this->formArray["print"])){
        	$testpdf->writePDF($name);//,$this->formArray["print"]);
        }
        else {
        	$testpdf->writePDF($name);
        }
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
	//,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/

$consolidatedQuarterlyReportOnRPTCollectionsPrint = new ConsolidatedQuarterlyReportOnRPTCollectionsPrint($HTTP_POST_VARS,$sess);
$consolidatedQuarterlyReportOnRPTCollectionsPrint->Main();
?>
<?php page_close(); ?>