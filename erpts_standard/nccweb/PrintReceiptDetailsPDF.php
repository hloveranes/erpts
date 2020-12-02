<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

include_once "../includes/web/clibPDFWriter.php";

include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/TD.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/OD.php";

include_once "../includes/assessor/eRPTSSettings.php";

include_once "../includes/collection/BacktaxTD.php";

include_once "../includes/collection/Due.php";
include_once "../includes/collection/Payment.php";
include_once "../includes/collection/Receipt.php";
include_once "../includes/collection/Collection.php";

include_once "../includes/collection/ReceiptRecords.php";
include_once "../includes/collection/CollectionRecords.php";

#####################################
# Define Interface Class
#####################################
class PrintReceiptDetailsPDF{
	
	var $tpl;
	var $formArray;
	function PrintReceiptDetailsPDF($receiptID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "or.xml") ;
		$this->tpl->set_var("TITLE", "Print RPTR");

       	$this->formArray = array(
			"receiptIDArray" => $receiptID

			,"pageNumber" => 1
			,"receiptPageNumber" => ""
			,"receiptType" => ""
			,"prevORNum" => ""
			,"porMonth" => ""
			,"porDay" => ""
			,"porYear" => ""
			,"orNum" => ""
			,"province" => ""
			,"city" => ""
			,"orMonth" => ""
			,"orDay" => ""
			,"orYear" => ""
			,"receivedFrom" => ""
			,"y1TotalInWords" => "244"
			,"totalInWords" => ""
                       //inserted by cht 07282008
                        ,"netAmountPaid" => ""
			,"sefTotal" => ""
                       // end
			,"amountPaid" => ""
			,"total" => ""
			,"paymentMode" => ""
			,"checkNumber" => ""
			,"dateOfCheck" => ""
			,"draweeBank" => ""
			,"fullPmtTotal" => ""
			,"cityTreasurer" => ""
			,"deputyTreasurer" => ""
			,"partialPmtTotal" => ""

			,"ownerName1" => ""
			,"ownerName2" => ""
			,"ownerName3" => ""
			,"ownerName4" => ""
			,"ownerName5" => ""
			,"ownerName6" => ""

			,"lotAddress1" => ""
			,"lotAddress2" => ""
			,"lotAddress3" => ""
			,"lotAddress4" => ""
			,"lotAddress5" => ""
			,"lotAddress6" => ""

			,"blockNumber1" => ""
			,"blockNumber2" => ""
			,"blockNumber3" => ""
			,"blockNumber4" => ""
			,"blockNumber5" => ""
			,"blockNumber6" => ""

			,"idleStatus1" => ""
			,"idleStatus2" => ""
			,"idleStatus3" => ""
			,"idleStatus4" => ""
			,"idleStatus5" => ""
			,"idleStatus6" => ""

			,"tdNum1" => ""
			,"tdNum2" => ""
			,"tdNum3" => ""
			,"tdNum4" => ""
			,"tdNum5" => ""
			,"tdNum6" => ""

			,"assessedValueLand1" => ""
			,"assessedValueLand2" => ""
			,"assessedValueLand3" => ""
			,"assessedValueLand4" => ""
			,"assessedValueLand5" => ""
			,"assessedValueLand6" => ""

			,"assessedValueOthers1" => ""
			,"assessedValueOthers2" => ""
			,"assessedValueOthers3" => ""
			,"assessedValueOthers4" => ""
			,"assessedValueOthers5" => ""
			,"assessedValueOthers6" => ""

			,"assessedValue1" => ""
			,"assessedValue2" => ""
			,"assessedValue3" => ""
			,"assessedValue4" => ""
			,"assessedValue5" => ""
			,"assessedValue6" => ""

			,"subTotal1" => ""
			,"subTotal2" => ""
			,"subTotal3" => ""
			,"subTotal4" => ""
			,"subTotal5" => ""
			,"subTotal6" => ""

			,"num1" => ""
			,"num2" => ""
			,"num3" => ""
			,"num4" => ""
			,"num5" => ""
			,"num6" => ""

			,"partialPmt1" => ""
			,"partialPmt2" => ""
			,"partialPmt3" => ""
			,"partialPmt4" => ""
			,"partialPmt5" => ""
			,"partialPmt6" => ""

			,"fullPmt1" => ""
			,"fullPmt2" => ""
			,"fullPmt3" => ""
			,"fullPmt4" => ""
			,"fullPmt5" => ""
			,"fullPmt6" => ""

			,"penalty1" => ""
			,"penalty2" => ""
			,"penalty3" => ""
			,"penalty4" => ""
			,"penalty5" => ""
			,"penalty6" => ""

			,"grandTotal1" => ""
			,"grandTotal2" => ""
			,"grandTotal3" => ""
			,"grandTotal4" => ""
			,"grandTotal5" => ""
			,"grandTotal6" => ""

			,"landClass1" => ""
			,"landClass2" => ""
			,"landClass3" => ""
			,"landClass4" => ""
			,"landClass5" => ""
			,"landClass6" => ""

			,"dueDate1" => ""
			,"dueDate2" => ""
			,"dueDate3" => ""
			,"dueDate4" => ""
			,"dueDate5" => ""
			,"dueDate6" => ""

		);

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

	function getPersonName($personID){
		$PersonDetails = new SoapObject(NCCBIZ."PersonDetails.php","urn:Object");
		if(!$xmlStr = $PersonDetails->getPersonDetails($personID)){
			// error xmlStr
			return "xmlStr";
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
				return "domDoc";
			}
			else{
				$person = new Person;
				$person->parseDomDocument($domDoc);
				
				$personName = $person->getFirstName();
				if($person->getMiddleName()!=""){
					$personName .= " ".substr($person->getMiddleName(),0,1).".";
				}
				$personName .= " ".$person->getLastName();
				
				//$personName = $person->getFullName();
				return $personName;
			}
		}
	}

	function getBacktaxTD($backtaxTDID){
		$BacktaxTDDetails = new SoapObject(NCCBIZ."BacktaxTDDetails.php","urn:Object");
		if(!$xmlStr = $BacktaxTDDetails->getBacktaxTD2($backtaxTDID)){
			// error xmlStr
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
			}
			else{
				$backtaxTD = new BacktaxTD;
				$backtaxTD->parseDomDocument($domDoc);
				return $backtaxTD;
			}
		}
	}

	function getDue($dueID){
		$DueDetails = new SoapObject(NCCBIZ."DueDetails.php","urn:Object");
		if(!$xmlStr = $DueDetails->getDue($dueID)){
			// error xmlStr
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
			}
			else{
				$due = new Due;
				$due->parseDomDocument($domDoc);
				return $due;
			}
		}
	}

	function getTD($tdID){
		$TDDetails = new SoapObject(NCCBIZ."TDDetails.php","urn:Object");
		if(!$xmlStr = $TDDetails->getTD($tdID)){
			// error xmlStr
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
			}
			else{
				$td = new TD;
				$td->parseDomDocument($domDoc);
				return $td;
			}
		}
	}

	function getAFS($afsID){
		$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php","urn:Object");
		if(!$xmlStr = $AFSDetails->getAFS($afsID)){
			// error xmlStr
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
			}
			else{
				$afs = new AFS;
				$afs->parseDomDocument($domDoc);
				return $afs;
			}
		}
	}

	function getOD($odID){
		$ODDetails = new SoapObject(NCCBIZ."ODDetails.php","urn:Object");
		if(!$xmlStr = $ODDetails->getOD($odID)){
			// error xmlStr
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
			}
			else{
				$od = new OD;
				$od->parseDomDocument($domDoc);
				return $od;
			}
		}
	}

	function getReceivedFromName($ownerID){
		$OwnerList = new SoapObject(NCCBIZ."OwnerList.php","urn:Object");
		if(!$xmlStr = $OwnerList->getOwnerList($ownerID)){
			// error xmlStr
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
			}
			else{
				$ownerRecords = new OwnerRecords;
				$ownerRecords->parseDomDocument($domDoc);
				$receivedFromName = "";
				$ownerArrayList = $ownerRecords->getArrayList();
				foreach($ownerArrayList as $owner){
					$companyArray = $owner->getCompanyArray();
					$personArray = $owner->getPersonArray();
					if(is_array($personArray)){
						foreach($personArray as $person){
							if($receivedFromName!=""){
								$receivedFromName .= ", ";
							}
							$receivedFromName .= $person->getFirstName();
							if($person->getMiddleName()!=""){
								$receivedFromName .= " ".substr($person->getMiddleName(),0,1).".";
							}
							$receivedFromName .= " ".$person->getLastName();
						}
					}
					if(is_array($companyArray)){
						foreach($companyArray as $company){
							if($receivedFromName!=""){
								$receivedFromName .= ", ";
							}
							$receivedFromName .= $company->getCompanyName();
						}
					}
				}
				return $receivedFromName;
			}
		}
	}

	function getERPTSSettingsDetails(){
		$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php","urn:Object");
		if(!$xmlStr = $eRPTSSettingsDetails->getERPTSSettingsDetails(1)){
			// error xmlStr
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
			}
			else{
				$eRPTSSettings = new eRPTSSettings;
				$eRPTSSettings->parseDomDocument($domDoc);
				return $eRPTSSettings;
			}
		}
	}


	function displayOwnerList($domDoc){
		$owner = new Owner;
		$owner->parseDomDocument($domDoc);

		$oValue = $owner;
	
		if (count($oValue->personArray)){

			$firstOwner = $oValue->personArray[0]->getTitle();
			$firstOwner .= " ";
			$firstOwner .= $oValue->personArray[0]->getName();

			if(is_object($oValue->personArray[0]->addressArray[0])){
				$number = $oValue->personArray[0]->addressArray[0]->getNumber();
				$street = $oValue->personArray[0]->addressArray[0]->getStreet();
				$barangay = $oValue->personArray[0]->addressArray[0]->getBarangay();
				$district = $oValue->personArray[0]->addressArray[0]->getDistrict();
				$municipalityCity = $oValue->personArray[0]->addressArray[0]->getMunicipalityCity();
				$province = $oValue->personArray[0]->addressArray[0]->getProvince();
			}
	
		}
		if (count($oValue->companyArray)){
			if($firstOwner==""){
				$firstOwner = $oValue->companyArray[0]->getCompanyName();

				if(is_object($oValue->companyArray[0]->addressArray[0])){
					$number = $oValue->companyArray[0]->addressArray[0]->getNumber();
					$street = $oValue->companyArray[0]->addressArray[0]->getStreet();
					$barangay = $oValue->companyArray[0]->addressArray[0]->getBarangay();
					$district = $oValue->companyArray[0]->addressArray[0]->getDistrict();
					$municipalityCity = $oValue->companyArray[0]->addressArray[0]->getMunicipalityCity();
					$province = $oValue->companyArray[0]->addressArray[0]->getProvince();
				}
			}
		}

		if($number!=""){
			$address1 = $number;
		}
		if($address1!=""){
			$address1.= " ".$street;
		}
		if($address1!=""){
			$address1.= ", ".$barangay;
		}
		if($municipalityCity!=""){
			$address2 = $municipalityCity;
		}
		if($address2!=""){
			$address2.= ", ".$province;
		}
		if($district != "" &&  $district !="no district"){
			$address2 = $district." , ".$address2;
		}

		$this->formArray["owner"] = $firstOwner;

		$this->formArray["address1"] = $address1;
		$this->formArray["address2"] = $address2;
	}

	function clearLine(){
		$this->setvar("receiptType","",false);
		$this->setvar("prevORNum","",false);
		$this->setvar("porMonth","",false);
		$this->setvar("porDay","",false);
		$this->setvar("porYear","",false);
		$this->setvar("orNum","",false);
		$this->setvar("province","",false);
		$this->setvar("city","",false);
		$this->setvar("orMonth","",false);
		$this->setvar("orDay","",false);
		$this->setvar("orYear","",false);
		$this->setvar("receivedFrom","",false);
		$this->setvar("y1TotalInWords","",false);
		$this->setvar("totalInWords","",false);
		//Inserted by cht 07282008
		$this->setvar("netAmountPaid","",false);
		$this->setvar("sefTotal","",false);
		// End
		$this->setvar("amountPaid","",false);
		$this->setvar("total","",false);
		$this->setvar("paymentMode","",false);
		$this->setvar("checkNumber","",false);
		$this->setvar("dateOfCheck","",false);
		$this->setvar("draweeBank","",false);
		$this->setvar("fullPmtTotal","",false);
		$this->setvar("cityTreasurer","",false);
		$this->setvar("deputyTreasurer","",false);
		$this->setvar("partialPmtTotal","",false);
		$this->setvar("ownerName1","",false);
		$this->setvar("ownerName2","",false);
		$this->setvar("ownerName3","",false);
		$this->setvar("ownerName4","",false);
		$this->setvar("ownerName5","",false);
		$this->setvar("ownerName6","",false);
		$this->setvar("lotAddress1","",false);
		$this->setvar("lotAddress2","",false);
		$this->setvar("lotAddress3","",false);
		$this->setvar("lotAddress4","",false);
		$this->setvar("lotAddress5","",false);
		$this->setvar("lotAddress6","",false);
		$this->setvar("blockNumber1","",false);
		$this->setvar("blockNumber2","",false);
		$this->setvar("blockNumber3","",false);
		$this->setvar("blockNumber4","",false);
		$this->setvar("blockNumber5","",false);
		$this->setvar("blockNumber6","",false);
		$this->setvar("idleStatus1","",false);
		$this->setvar("idleStatus2","",false);
		$this->setvar("idleStatus3","",false);
		$this->setvar("idleStatus4","",false);
		$this->setvar("idleStatus5","",false);
		$this->setvar("idleStatus6","",false);
		$this->setvar("tdNum1","",false);
		$this->setvar("tdNum2","",false);
		$this->setvar("tdNum3","",false);
		$this->setvar("tdNum4","",false);
		$this->setvar("tdNum5","",false);
		$this->setvar("tdNum6","",false);
		$this->setvar("assessedValueLand1","",false);
		$this->setvar("assessedValueLand2","",false);
		$this->setvar("assessedValueLand3","",false);
		$this->setvar("assessedValueLand4","",false);
		$this->setvar("assessedValueLand5","",false);
		$this->setvar("assessedValueLand6","",false);
		$this->setvar("assessedValueOthers1","",false);
		$this->setvar("assessedValueOthers2","",false);
		$this->setvar("assessedValueOthers3","",false);
		$this->setvar("assessedValueOthers4","",false);
		$this->setvar("assessedValueOthers5","",false);
		$this->setvar("assessedValueOthers6","",false);
		$this->setvar("assessedValue1","",false);
		$this->setvar("assessedValue2","",false);
		$this->setvar("assessedValue3","",false);
		$this->setvar("assessedValue4","",false);
		$this->setvar("assessedValue5","",false);
		$this->setvar("assessedValue6","",false);
		$this->setvar("subTotal1","",false);
		$this->setvar("subTotal2","",false);
		$this->setvar("subTotal3","",false);
		$this->setvar("subTotal4","",false);
		$this->setvar("subTotal5","",false);
		$this->setvar("subTotal6","",false);
		$this->setvar("num1","",false);
		$this->setvar("num2","",false);
		$this->setvar("num3","",false);
		$this->setvar("num4","",false);
		$this->setvar("num5","",false);
		$this->setvar("num6","",false);
		$this->setvar("partialPmt1","",false);
		$this->setvar("partialPmt2","",false);
		$this->setvar("partialPmt3","",false);
		$this->setvar("partialPmt4","",false);
		$this->setvar("partialPmt5","",false);
		$this->setvar("partialPmt6","",false);
		$this->setvar("fullPmt1","",false);
		$this->setvar("fullPmt2","",false);
		$this->setvar("fullPmt3","",false);
		$this->setvar("fullPmt4","",false);
		$this->setvar("fullPmt5","",false);
		$this->setvar("fullPmt6","",false);
		$this->setvar("penalty1","",false);
		$this->setvar("penalty2","",false);
		$this->setvar("penalty3","",false);
		$this->setvar("penalty4","",false);
		$this->setvar("penalty5","",false);
		$this->setvar("penalty6","",false);
		$this->setvar("grandTotal1","",false);
		$this->setvar("grandTotal2","",false);
		$this->setvar("grandTotal3","",false);
		$this->setvar("grandTotal4","",false);
		$this->setvar("grandTotal5","",false);
		$this->setvar("grandTotal6","",false);
	}


	function Main(){
		$this->setForm();
		$this->tpl->set_block("rptsTemplate", "ReceiptPage", "ReceiptPageBlock");
		$pageNumber = 1;

		$ReceiptDetails = new SoapObject(NCCBIZ."ReceiptDetails.php","urn:Object");
		$CollectionList = new SoapObject(NCCBIZ."CollectionList.php","urn:Object");
		$PaymentDetails = new SoapObject(NCCBIZ."PaymentDetails.php","urn:Object");

		foreach($this->formArray["receiptIDArray"] as $receiptID){
			$this->tpl->set_var("pageNumber",$pageNumber);
			$totalAmountPaid = 0;

			$eRPTSSettings = $this->getERPTSSettingsDetails();
			if($eRPTSSettings->getLguType()=="City"){
				$this->setvar("city",$eRPTSSettings->getLguName());
				$this->setvar("province","");
			}
			else{
				$this->setvar("city","");
				$this->setvar("province",$eRPTSSettings->getLguName());
			}

			if(!$xmlStr = $ReceiptDetails->getReceipt($receiptID)){
				//exit("xml failed.");
			}
			else{
				if(!$domDoc = domxml_open_mem($xmlStr)){
					//exit("error domDoc");
				}
				else{
					$receipt = new Receipt;
					$receipt->parseDomDocument($domDoc);

					$this->setvar("prevORNum", $receipt->getPreviousReceiptNumber());

					$porMonth = "";
					$porDay = "";
					$porYear = "";

					if($receipt->getPreviousReceiptDate()!="0000-00-00"){
						$porMonth = date("F",strtotime($receipt->getPreviousReceiptDate()));
						$porDay = date("d", strtotime($receipt->getPreviousReceiptDate()));
						$porYear = date("Y", strtotime($receipt->getPreviousReceiptDate()));
					}

					$this->setvar("porMonth", $porMonth);
					$this->setvar("porDay", $porDay);
					$this->setvar("porYear", $porYear);

					$this->setvar("orNum", $receipt->getReceiptNumber());

					$orDate = "";
					if($receipt->getReceiptDate()!="0000-00-00"){
						$orDate = date("F d, Y", strtotime($receipt->getReceiptDate()));
					}

					$this->setvar("orDate",$orDate);

					$this->setvar("receivedFrom", $this->getReceivedFromName($receipt->getReceivedFrom()));

					$this->setvar("paymentMode",$receipt->getPaymentMode());

					if($receipt->getPaymentMode()=="check"){
						$this->setvar("checkNumber", "using Check Number : ".$receipt->getCheckNumber());
						$this->setvar("dateOfCheck", " dated ".date("F d, Y", strtotime($receipt->getDateOfCheck())));
						$this->setvar("draweeBank", "(".$receipt->getDraweeBank().")");
					}

					$this->setvar("cityTreasurer", $this->getPersonName($receipt->getCityTreasurer()));
					$this->setvar("deputyTreasurer", $this->getPersonName($receipt->getDeputyTreasurer()));

					if(!$collectionXmlStr = $CollectionList->getCollectionListFromReceiptID($receiptID)){
						// xml failed
					}
					else{
						if(!$collectionDomDoc = domxml_open_mem($collectionXmlStr)){
							// error domDoc
						}
						else{
							$collectionRecords = new CollectionRecords;
							$collectionRecords->parseDomDocument($collectionDomDoc);

							$collectionArrayList = $collectionRecords->getArrayList();
							$i=0;
							foreach($collectionArrayList as $collection){
								$i++;

								if($i<=1){
									if($collection->getTaxType()=="basic"){
										$this->setvar("receiptType", "[ X ]  BASIC TAX      [  ]  SPECIAL EDUCATION FUND");
									}
									else if($collection->getTaxType()=="sef"){
										$this->setvar("receiptType", "[  ]  BASIC TAX     [ X ]  SPECIAL EDUCATION FUND");
									}
									else if($collection->getTaxType()=="idle"){
										$this->setvar("receiptType", "[  ]  BASIC TAX     [  ]  SPECIAL EDUCATION FUND     [ X ]  IDLE TAX");
									}
								}

								$paymentID = $collection->getPaymentID();
								if(!$paymentXmlStr = $PaymentDetails->getPayment($paymentID)){
									// xml failed
								}
								else{
									if(!$paymentDomDoc = domxml_open_mem($paymentXmlStr)){
										// error domDoc
									}
									else{
										$payment = new Payment;
										$payment->parseDomDocument($paymentDomDoc);

										$assessedValue = 0;

										// added "orYear" for fix of Feb 08, 2005
										$this->formArray["orYear"] = substr($payment->dueDate,0,4);
										$this->setvar("orYear",$this->formArray["orYear"],false);

										if($i<=6){
											$this->setvar("ownerName".$i,$this->getReceivedFromName($receipt->getReceivedFrom()));
											if($payment->getDueID()!="" && $payment->getDueID()!="0"){
												// due payment
												$due = $this->getDue($payment->getDueID());
												$td = $this->getTD($due->getTdID());
												$afs = $this->getAFS($td->getAfsID());
												$tdNum = $td->getTaxDeclarationNumber();
												if($td->getPropertyType()=="Land"){
													$this->setvar("assessedValueLand".$i,$afs->getTotalAssessedValue(),true);
												}
												else{
													$this->setvar("assessedValueOthers".$i,$afs->getTotalAssessedValue(),true);
												}
												$assessedValue = $afs->getTotalAssessedValue();

												if($payment->getDueType()=="Annual"){
													// commented out: February 08, 2005
													// "fullPmt" must be total paid less penalties... (tax due)
													//$this->setvar("fullPmt".$i,$collection->getBalanceDue(),true);
													$this->setvar("fullPmt".$i,$collection->getTaxDue(),true);
												}
												else{
													$this->setvar("num".$i,$payment->getDueType());

													// commented out: February 08, 2005
													// $this->setvar("partialPmt".$i,$collection->getBalanceDue(),true);
													$this->setvar("partialPmt".$i,$collection->getTaxDue(),true);
												}
											}
											else if($payment->getBacktaxTDID()!="" && $payment->getBacktaxTDID()!="0"){
												// backtaxtd payment
												$backtaxTD = $this->getBacktaxTD($payment->getBacktaxTDID());
												$parentTD = $this->getTD($backtaxTD->getTdID());
												$afs = $this->getAFS($parentTD->getAfsID());
												$tdNum = $backtaxTD->getTDNumber();
												$assessedValue = $backtaxTD->getAssessedValue();

												if($payment->getDueType()=="Annual"){

													// commented out: February 08, 2005
													// $this->setvar("fullPmt".$i,$collection->getBalanceDue(),true);
													$this->setvar("fullPmt".$i,$collection->getTaxDue(),true);
												}
												else{
													$this->setvar("num".$i,$payment->getDueType());

													// commented out: February 08, 2005
													// $this->setvar("partialPmt".$i,$collection->getBalanceDue(),true);
													$this->setvar("partialPmt".$i,$collection->getTaxDue(),true);
												}
											}
											$od = $this->getOD($afs->getOdID());
											$this->setvar("lotAddress".$i,$od->locationAddress->getStreet().", ".$od->locationAddress->getBarangay());
											$this->setvar("blockNumber".$i,$od->getLotNumber().", ".$od->getBlockNumber());
											$this->setvar("landClass".$i, $payment->getPropertyClassification());
											$this->setvar("tdNum".$i,$tdNum);
											$this->setvar("dueDate".$i, "(".substr($payment->getDueDate(),0,4).")");
											$this->setvar("assessedValue".$i,$assessedValue,true);
											$this->setvar("subTotal".$i,$collection->getTaxDue(),true);

											if($collection->getPenalty() > 0){
												if($collection->getAmnesty()=="true"){
													//	$this->setvar("penalty".$i,round((($collection->getPenalty()/$collection->getTaxDue())*100)) . " % (amnesty)",true);
													$this->setvar("penalty".$i,$collection->getPenalty());
												}
												else{
													// $this->setvar("penalty".$i,round((($collection->getPenalty()/$collection->getTaxDue())*100)) . " %",true);
													$this->setvar("penalty".$i,$collection->getPenalty());
												}
											}
											$this->setvar("grandTotal".$i,$collection->getAmountPaid(),true);
											$totalAmountPaid += $collection->getAmountPaid();
//Inserted by cht 07282008
$sefTotal = $total;
$netAmountPaid = $totalAmountPaid*2;
//End
											}

									}
								}
							}
						}

	// ORIG					
	//$this->setvar("total",$totalAmountPaid,true);
	//$this->setvar("amountPaid",$totalAmountPaid,true);
	//$totalInWords = makewords($totalAmountPaid);
						$this->setvar("sefTotal",$totalAmountPaid,true);
						$this->setvar("total",$totalAmountPaid,true);
						$this->setvar("amountPaid",$netAmountPaid,true);
						$totalInWords = makewords($netAmountPaid);
						
//						$totalInWords = "One Hundred Thousand Two Hundred Thirty Four Pesos And Fifty Seven Centavos Only";
						if(strlen($totalInWords)<62){
							$this->setvar("y1TotalInWords","254");
						}
						else{
							$this->setvar("y1TotalInWords","263");
						}
						$this->setvar("totalInWords",$totalInWords);
					}
				}
			}

			$this->tpl->parse("ReceiptPageBlock", "ReceiptPage", true);
			$pageNumber++;

			$this->clearLine();
		}

		//exit;

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

$printReceiptDetailsPDF = new PrintReceiptDetailsPDF($receiptID,$sess);
$printReceiptDetailsPDF->Main();
?>
<?php page_close(); ?>
