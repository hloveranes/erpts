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

include_once "../includes/assessor/User.php";
include_once "../includes/assessor/UserRecords.php";

include_once "../includes/assessor/ODHistoryRecords.php";
include_once "../includes/assessor/ODHistory.php";

include_once "../includes/assessor/eRPTSSettings.php";

include_once "../includes/collection/Due.php";
include_once "../includes/collection/DueRecords.php";
include_once "../includes/collection/TreasurySettings.php";
include_once "../includes/collection/BacktaxTD.php";
include_once "../includes/collection/BacktaxTDRecords.php";

include_once "../includes/collection/Payment.php";
include_once "../includes/collection/PaymentRecords.php";

include_once "../includes/collection/Receipt.php";
include_once "../includes/collection/ReceiptRecords.php";

include_once "../includes/collection/Collection.php";
include_once "../includes/collection/CollectionRecords.php";

#####################################
# Define Interface Class
#####################################
class PaymentReceiptDetails{
	
	var $tpl;
	function PaymentReceiptDetails($sess){
		global $auth;
		global $_POST;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		$this->formArray["rptopID"] = $_POST["rptopID"];
		$this->formArray["ownerID"] = $_POST["ownerID"];
		$this->formArray["formAction"] = $_POST["formAction"];

		// must have atleast TM-VIEW access
		$pageType = "%%%%1%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "PaymentReceiptDetails.htm") ;
		$this->tpl->set_var("TITLE", "Apply Payments");
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

	function initSelected($tempVar,$compareTo,$actionStr="selected"){
		if ($this->formArray[$tempVar] == $compareTo){
			$this->tpl->set_var($tempVar."_sel", $actionStr);
		}
		else{
			$this->tpl->set_var($tempVar."_sel", "");
		}
	}

	function displayPreviousReceiptDateList($taxType){
		$TaxType = ucfirst($taxType);

		$startYear = 1900;
		$endYear = date("Y");
		eval(MONTH_ARRAY);//$monthArray

		for($i = $endYear; $i >= $startYear; $i--){
			$this->tpl->set_var("yearValue", $i);
			$this->initSelected($taxType."PreviousReceiptDate_year",$i);
			$this->tpl->parse($TaxType."PreviousReceiptDateYearListBlock", $TaxType."PreviousReceiptDateYearList", true);
		}
		
		foreach($monthArray as $key => $value){
			$this->tpl->set_var("monthValue", $key);
			$this->tpl->set_var("month", $value);

			$this->initSelected($taxType."PreviousReceiptDate_month",$i);
			$this->tpl->parse($TaxType."PreviousReceiptDateMonthListBlock", $TaxType."PreviousReceiptDateMonthList", true);
		}

		for($i = 1; $i<=31; $i++){
			$this->tpl->set_var("dayValue", $i);

			$this->initSelected($taxType."PreviousReceiptDate_day",$i);
			$this->tpl->parse($TaxType."PreviousReceiptDateDayListBlock", $TaxType."PreviousReceiptDateDayList", true);
		}
	}

	function setForm(){
		$this->initMasterTreasurerList("CityTreasurer", "cityTreasurer");
		$this->initMasterTreasurerList("DeputyTreasurer", "deputyTreasurer");

		$startYear = 1900;
		$endYear = date("Y");
		$this->tpl->set_block("rptsTemplate", "DateOfCheckYearList", "DateOfCheckYearListBlock");
		for($i = $endYear; $i >= $startYear; $i--){
			$this->tpl->set_var("yearValue", $i);
			$this->initSelected("dateOfCheck_year",$i);
			$this->tpl->parse("DateOfCheckYearListBlock", "DateOfCheckYearList", true);
		}
		
		eval(MONTH_ARRAY);//$monthArray
		$this->tpl->set_block("rptsTemplate", "DateOfCheckMonthList", "DateOfCheckMonthListBlock");
		foreach($monthArray as $key => $value){
			$this->tpl->set_var("monthValue", $key);
			$this->tpl->set_var("month", $value);
			$this->initSelected("dateOfCheck_month",$key);
			$this->tpl->parse("DateOfCheckMonthListBlock", "DateOfCheckMonthList", true);
		}

		$this->tpl->set_block("rptsTemplate", "DateOfCheckDayList", "DateOfCheckDayListBlock");

		for($i = 1; $i<=31; $i++){
			$this->tpl->set_var("dayValue", $i);
			$this->initSelected("dateOfCheck_day",$i);
			$this->tpl->parse("DateOfCheckDayListBlock", "DateOfCheckDayList", true);
		}

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function initMasterTreasurerList($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		/*

		$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php", "urn:Object");
		if(!$xmlStr = $eRPTSSettingsDetails->getERPTSSettingsDetails(1)){
			// error xml
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
			}
			else{
				$eRPTSSettings = new eRPTSSettings;
				$eRPTSSettings->parseDomDocument($domDoc);
				switch($tempVar){
					case "cityTreasurer":
						$this->tpl->set_var("id",$eRPTSSettings->getTreasurerFullName());
						$this->tpl->set_var("name",$eRPTSSettings->getTreasurerFullName());

						$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
						$this->initSelected($tempVar."ID",$eRPTSSettings->getTreasurerFullName());
						$this->tpl->parse($TempVar."ListBlock",$TempVar."List",true);
						break;
				}
			}
		}

		*/

		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
        if (!$xmlStr = $UserList->getUserList(0, " WHERE ".AUTH_USER_MD5_TABLE.".userType REGEXP '1$' AND ".AUTH_USER_MD5_TABLE.".status='enabled'")){
			// error xmlStr
   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
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

	function getTDNumberFromPayment($tdID,$backtaxTDID){
		$PaymentDetails = new SoapObject(NCCBIZ."PaymentDetails.php", "urn:Object");
		$tdNumber = $PaymentDetails->getTDNumber($tdID,$backtaxTDID);
		return $tdNumber;
	}

	function captureDueDetails($dueID){
		$DueDetails = new SoapObject(NCCBIZ."DueDetails.php", "urn:Object");
		if (!$xmlStr = $DueDetails->getDue($dueID)){
			// error xmlStr
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
			}
			else {
				$due = new Due;
				$due->parseDomDocument($domDoc);
				return $due;
			}
		}
		return false;
	}

	function captureBacktaxTDDetails($backtaxTDID,$dueType){
		$BacktaxTDDetails = new SoapObject(NCCBIZ."BacktaxTDDetails.php", "urn:Object");
		if (!$xmlStr = $BacktaxTDDetails->getBacktaxTD2($backtaxTDID)){
			// error xmlStr
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
			}
			else {
				$backtaxTD = new BacktaxTD;
				$backtaxTD->parseDomDocument($domDoc);

				foreach($this->tdArray as $tdID => $tdElementArray){
					foreach($tdElementArray as $tdElementKey => $tdElementValue){
						switch($tdElementKey){
							case "btTD":
								if(is_array($tdElementValue)){
									$btTDArray = $tdElementValue;
									foreach($btTDArray as $btTDID => $btTDElementArray){
										if($btTDID==$backtaxTDID){
											$backtaxTD->setBasicTax($btTDElementArray["basicTax"]);
											$backtaxTD->setSefTax($btTDElementArray["sefTax"]);
											$backtaxTD->setIdleTax($btTDElementArray["idleTax"]);
											$backtaxTD->setPenalties($btTDElementArray["penalty"]);
											$backtaxTD->setBalance($btTDElementArray["balance"]);
											$backtaxTD->setPaid($btTDElementArray["amountPaid"]);
										}
									}
								}
								break;
						}
					}
				}

				return $backtaxTD;
			}
		}
		return false;
	}

	function getPaidTotals($dueID,$backtaxTDID,$dueType,$taxType){
		$CollectionList = new SoapObject(NCCBIZ."CollectionList.php","urn:Object");
		$totalAmountPaid = 0;

		if(!$xmlStr = $CollectionList->getCollectionListFromDueTaxType($dueID,$backtaxTDID,$dueType,$taxType)){
			return 0;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return 0;
			}
			else{
				$collectionRecords = new CollectionRecords;
				$collectionRecords->parseDomDocument($domDoc);

				$collectionArrayList = $collectionRecords->getArrayList();

				foreach($collectionArrayList as $collection){
					$totalAmountPaid += $collection->getAmountPaid();
				}
			}
		}

		return $totalAmountPaid;
	}

	function getAmountPaidForQuarters($due,$taxType){
		$DueList = new SoapObject(NCCBIZ."DueList.php", "urn:Object");

		if (!$xmlStr = $DueList->getDueList($due->getTdID(),date("Y",strtotime($due->getDueDate())))){
			return 0;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				return 0;
			}
			else{
				$dueRecords = new DueRecords;
				$dueRecords->parseDomDocument($domDoc);
				$amountPaid=0;
				foreach($dueRecords->getArrayList() as $due){
					if($due->getDueType()!="Annual"){
						$amountPaid += $this->getPaidTotals($due->getDueID(),"",$due->getDueType(),$taxType);
					}
				}
			}
		}
		return $amountPaid;
	}

	function initReceipt($payment,$taxType){
		$receipt = new Receipt;

		$receipt->setReceiptDate(date("Y-m-d",strtotime("now")));
		$receipt->setReceivedFrom($payment->getOwnerID());
		$receipt->setTaxType($taxType);

		if($payment->getDueID()!=""){
			$due = $this->captureDueDetails($payment->getDueID());
		}
		else if($payment->getBacktaxTDID()!=""){
			$due = $this->captureBacktaxTDDetails($payment->getBacktaxTDID(),$payment->getDueType());
		}
		else{
			// should not get here.
			// cannot establish taxDue and thus a proper receipt.
			// exit("error. payment has no dueID / backtaxTDID associated. cannot establish receipts");
		}

		switch($taxType){
			case "basic":
				$receipt->setTaxDue(un_number_format($due->getBasicTax()));
				break;
			case "sef":
				$receipt->setTaxDue(un_number_format($due->getSefTax()));
				break;
			case "idle":
				$receipt->setTaxDue(un_number_format($due->getIdleTax()));
				break;
		}

		// use: basicAdvancedPaymentDiscount = (advancedPaymentDiscount/taxDue)(basicTax)
		$advancedPaymentDiscount = un_number_format($payment->getAdvancedPaymentDiscount()) / un_number_format($payment->getTaxDue());
		$advancedPaymentDiscount = $advancedPaymentDiscount * un_number_format($receipt->getTaxDue());
		$receipt->setAdvancedPaymentDiscount($advancedPaymentDiscount);

		// use: basicEarlyPaymentDiscount = (earlyPaymentDiscount/taxDue)(basicTax)
		$earlyPaymentDiscount = un_number_format($payment->getEarlyPaymentDiscount()) / un_number_format($payment->getTaxDue());
		$earlyPaymentDiscount = $earlyPaymentDiscount * un_number_format($receipt->getTaxDue());
		$receipt->setEarlyPaymentDiscount($earlyPaymentDiscount);

		// if amountPaidForQuartersForTaxType > 0 use 
		// use: basicPenalty = (penalty/balanceDue)(basicTax) 
		// else
		// use: basicPenalty = (penalty/taxDue)(basicTax)

		if($amountPaidForQuartersForTaxType > 0){
			$penalty = un_number_format($payment->getPenalty()) / un_number_format($payment->getBalanceDue());
			$penalty = $penalty * un_number_format($receipt->getTaxDue());
		}
		else{
			$penalty = un_number_format($payment->getPenalty()) / un_number_format($payment->getTaxDue());
			$penalty = $penalty * un_number_format($receipt->getTaxDue());
		}

		$receipt->setPenalty($penalty);

		$receipt->setAmnesty($payment->getAmnesty());

		// use: 
		// basicBalanceDue = basicTax
		// ** if discount > 0 : basicBalanceDue = basicTax - [basicEarlyPaymentDiscount or basicAdvancedPaymentDiscount]
		// ** if amnesty is true : basicBalanceDue += basicPenalty
		// basicBalance Due = basicBalanceDue - paidBasic

		$balanceDue = $receipt->getTaxDue();
		if($receipt->getAdvancedPaymentDiscount() > 0){
			$balanceDue = $receipt->getTaxDue() - $receipt->getAdvancedPaymentDiscount();
		}
		else if($receipt->getEarlyPaymentDiscount() > 0){
			$balanceDue = $receipt->getTaxDue() - $receipt->getEarlyPaymentDiscount();
		}

		if($receipt->getAmnesty()!="true"){
			$balanceDue = $balanceDue + un_number_format($receipt->getPenalty());
		}

		$paidTotals = $this->getPaidTotals($payment->getDueID(),$payment->getBacktaxTDID(),$payment->getDueType(),$taxType);

		// if Due Type is "Annual" and previous "Quarter" payments have been made, adjust the Tax Due:
		// this is for reverted annual payments from quarterly mode

		if(is_a($due,"Due")){
			if($due->getDueType()=="Annual"){
				$amountPaidForQuartersForTaxType = $this->getAmountPaidForQuarters($due,$taxType);
			}
			if($amountPaidForQuartersForTaxType > 0){
				$paidTotals = $amountPaidForQuartersForTaxType;
			}
		}

		$balanceDue = $balanceDue - $paidTotals;

		$receipt->setBalanceDue($balanceDue);

		// use: basicAmountPaid = (basicBalanceDue/balanceDue)(amountPaid)

		$amountPaid = un_number_format($receipt->getBalanceDue()) / un_number_format($payment->getBalanceDue());
		$amountPaid = $amountPaid * un_number_format($payment->getAmountPaid());

		$receipt->setAmountPaid($amountPaid);

		return $receipt;
	}

	function Main(){
		global $_POST;
		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));
		$this->setPageDetailPerms();

		$this->formArray["formAction"] = $_POST["formAction"];

		switch($this->formArray["formAction"]){
			case "applyPayment":

				// show owner

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

						if(is_object($rptop->owner)){
							//$RPTOPEncode = new SoapObject(NCCBIZ."RPTOPEncode.php", "urn:Object");
							if (is_a($rptop->owner,"Owner")){
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
						}
					}
				}

				// gather payments

				$this->tdArray = $_POST["td"];

				if(is_array($this->tdArray)){
					foreach($this->tdArray as $tdID => $tdElementArray){
						// grab dueID from tdID
						$dueID = 
						$dueType = $tdElementArray["dueType"];

						// start: the following 'for' loop is an un_number_format sweep added February 10, 2005
						foreach($tdElementArray as $tdElementKey => $tdElementValue){
							$tdElementArray[$tdElementKey] = un_number_format($tdElementValue);
						}
						// end: un_number_format sweep loop of February 10, 2005 

						foreach($tdElementArray as $tdElementKey => $tdElementValue){
							switch($tdElementKey){
								case "amountPaid":
									if($tdElementValue > 0){
										$payment = new Payment;

										$payment->setPaymentID("");

										$payment->setTdID($tdID);
										$payment->setDueID($tdElementArray["dueID"]);
										$payment->setDueType($tdElementArray["dueType"]);

										$payment->setBacktaxTDID("");

										$payment->setTaxDue($tdElementArray["taxDue"]);
										$payment->setAdvancedPaymentDiscount($tdElementArray["advancedPaymentDiscount"]);
										$payment->setEarlyPaymentDiscount($tdElementArray["earlyPaymentDiscount"]);
										$payment->setPenalty($tdElementArray["penalty"]);
										$payment->setAmnesty($tdElementArray["amnesty"]);
										$payment->setBalanceDue($tdElementArray["balance"]);
										$payment->setAmountPaid(un_number_format($tdElementArray["amountPaid"]));

										$payment->setDueDate(date("Y-m-d",strtotime($tdElementArray["dueDate"])));
										$payment->setPaymentDate(date("Y-m-d",strtotime("now")));
										$payment->setOwnerID($this->formArray["ownerID"]);

										$payment->setTdNumber($this->getTDNumberFromPayment($tdID,""));

										$payment->setBasicReceipt($this->initReceipt($payment,"basic"));
										$payment->setSefReceipt($this->initReceipt($payment,"sef"));
										$payment->setIdleReceipt($this->initReceipt($payment,"idle"));

										$this->paymentArrayList[] = $payment;
									}
									break;
								case "btTD":
									if(is_array($tdElementValue)){
										$btTDArray = $tdElementValue;
										foreach($btTDArray as $backtaxTDID => $btTDElementArray){
											if($btTDElementArray["amountPaid"] > 0){
												$payment = new Payment;

												$payment->setPaymentID("");

												$payment->setTdID("");
												$payment->setDueID($btTDElementArray["dueID"]);
												$payment->setDueType($btTDElementArray["dueType"]);

												$payment->setBacktaxTDID($backtaxTDID);

												$payment->setTaxDue($btTDElementArray["taxDue"]);
												$payment->setAdvancedPaymentDiscount($btTDElementArray["advancedPaymentDiscount"]);
												$payment->setEarlyPaymentDiscount($btTDElementArray["earlyPaymentDiscount"]);
												$payment->setPenalty($btTDElementArray["penalty"]);
												$payment->setAmnesty($btTDElementArray["amnesty"]);
												$payment->setBalanceDue($btTDElementArray["balance"]);

												$payment->setAmountPaid(un_number_format($btTDElementArray["amountPaid"]));

												$payment->setDueDate(date("Y-m-d",strtotime($btTDElementArray["dueDate"])));
												$payment->setPaymentDate(date("Y-m-d",strtotime("now")));
												$payment->setOwnerID($this->formArray["ownerID"]);

												$payment->setTdNumber($this->getTDNumberFromPayment("",$backtaxTDID));

												$payment->setBasicReceipt($this->initReceipt($payment,"basic"));
												$payment->setSefReceipt($this->initReceipt($payment,"sef"));
												$payment->setIdleReceipt($this->initReceipt($payment,"idle"));

												$this->paymentArrayList[] = $payment;
											}
										}
									}
									break;
								default:
									break;
							}
						}
					}
				}

				$this->tpl->set_block("rptsTemplate", "PaymentList", "PaymentListBlock");

				$this->tpl->set_block("rptsTemplate", "BasicReceipt", "BasicReceiptBlock");
				$this->tpl->set_block("BasicReceipt", "BasicReceiptList", "BasicReceiptListBlock");
				$this->tpl->set_block("BasicReceipt", "BasicPreviousReceiptDateYearList", "BasicPreviousReceiptDateYearListBlock");
				$this->tpl->set_block("BasicReceipt", "BasicPreviousReceiptDateMonthList", "BasicPreviousReceiptDateMonthListBlock");
				$this->tpl->set_block("BasicReceipt", "BasicPreviousReceiptDateDayList", "BasicPreviousReceiptDateDayListBlock");

				$this->tpl->set_block("rptsTemplate", "SefReceipt", "SefReceiptBlock");
				$this->tpl->set_block("SefReceipt", "SefReceiptList", "SefReceiptListBlock");
				$this->tpl->set_block("SefReceipt", "SefPreviousReceiptDateYearList", "SefPreviousReceiptDateYearListBlock");
				$this->tpl->set_block("SefReceipt", "SefPreviousReceiptDateMonthList", "SefPreviousReceiptDateMonthListBlock");
				$this->tpl->set_block("SefReceipt", "SefPreviousReceiptDateDayList", "SefPreviousReceiptDateDayListBlock");

				$this->tpl->set_block("rptsTemplate", "IdleReceipt", "IdleReceiptBlock");
				$this->tpl->set_block("IdleReceipt", "IdleReceiptList", "IdleReceiptListBlock");
				$this->tpl->set_block("IdleReceipt", "IdlePreviousReceiptDateYearList", "IdlePreviousReceiptDateYearListBlock");
				$this->tpl->set_block("IdleReceipt", "IdlePreviousReceiptDateMonthList", "IdlePreviousReceiptDateMonthListBlock");
				$this->tpl->set_block("IdleReceipt", "IdlePreviousReceiptDateDayList", "IdlePreviousReceiptDateDayListBlock");


				$paymentCtr = 0;
				$basicCtr = 0;
				$sefCtr = 0;
				$idleCtr = 0;

				$basicReceiptCtr=0;
				$sefReceiptCtr=0;
				$idleReceiptCtr=0;

				foreach($this->paymentArrayList as $payment){
					$this->tpl->set_var("tdNumber",$payment->getTdNumber());
					$this->tpl->set_var("year", date("Y",strtotime($payment->getDueDate())));
					$this->tpl->set_var("balanceDue_formatted", formatCurrency($payment->getBalanceDue()));
					$this->tpl->set_var("amountPaid_formatted",formatCurrency($payment->getAmountPaid()));

					$this->tpl->set_var("paymentCtr",$paymentCtr);

					$this->tpl->set_var("tdID",$payment->getTdID());
					$this->tpl->set_var("dueID",$payment->getDueID());
					$this->tpl->set_var("dueType",$payment->getDueType());
					$this->tpl->set_var("backtaxTDID",$payment->getBacktaxTDID());
					$this->tpl->set_var("taxDue",$payment->getTaxDue());
					$this->tpl->set_var("advancedPaymentDiscount",$payment->getAdvancedPaymentDiscount());
					$this->tpl->set_var("earlyPaymentDiscount",$payment->getEarlyPaymentDiscount());
					$this->tpl->set_var("penalty",$payment->getPenalty());
					$this->tpl->set_var("amnesty",$payment->getAmnesty());
					$this->tpl->set_var("balanceDue",$payment->getBalanceDue());
					$this->tpl->set_var("amountPaid",$payment->getAmountPaid());
					$this->tpl->set_var("dueDate",date("Y-m-d",strtotime($payment->getDueDate())));
					$this->tpl->set_var("paymentDate",date($payment->getPaymentDate(),strtotime($payment->getPaymentDate())));
					$this->tpl->set_var("ownerID",$payment->getOwnerID());

					$this->tpl->set_var("basicReceipt[receiptDate]", $payment->basicReceipt->getReceiptDate());
					$this->tpl->set_var("basicReceipt[receivedFrom]", $payment->basicReceipt->getReceivedFrom());
					$this->tpl->set_var("basicReceipt[taxType]", $payment->basicReceipt->getTaxType());
					$this->tpl->set_var("basicReceipt[taxDue]", $payment->basicReceipt->getTaxDue());
					$this->tpl->set_var("basicReceipt[advancedPaymentDiscount]", $payment->basicReceipt->getAdvancedPaymentDiscount());
					$this->tpl->set_var("basicReceipt[earlyPaymentDiscount]", $payment->basicReceipt->getEarlyPaymentDiscount());
					$this->tpl->set_var("basicReceipt[penalty]", $payment->basicReceipt->getPenalty());
					$this->tpl->set_var("basicReceipt[amnesty]", $payment->basicReceipt->getAmnesty());
					$this->tpl->set_var("basicReceipt[balanceDue]", $payment->basicReceipt->getBalanceDue());
					$this->tpl->set_var("basicReceipt[amountPaid]", $payment->basicReceipt->getAmountPaid());
					$this->tpl->set_var("basicReceipt[cityTreasurer]", $payment->basicReceipt->getCityTreasurer());
					$this->tpl->set_var("basicReceipt[deputyTreasurer]", $payment->basicReceipt->getDeputyTreasurer());

					$this->tpl->set_var("sefReceipt[receiptDate]", $payment->sefReceipt->getReceiptDate());
					$this->tpl->set_var("sefReceipt[receivedFrom]", $payment->sefReceipt->getReceivedFrom());
					$this->tpl->set_var("sefReceipt[taxType]", $payment->sefReceipt->getTaxType());
					$this->tpl->set_var("sefReceipt[taxDue]", $payment->sefReceipt->getTaxDue());
					$this->tpl->set_var("sefReceipt[advancedPaymentDiscount]", $payment->sefReceipt->getAdvancedPaymentDiscount());
					$this->tpl->set_var("sefReceipt[earlyPaymentDiscount]", $payment->sefReceipt->getEarlyPaymentDiscount());
					$this->tpl->set_var("sefReceipt[penalty]", $payment->sefReceipt->getPenalty());
					$this->tpl->set_var("sefReceipt[amnesty]", $payment->sefReceipt->getAmnesty());
					$this->tpl->set_var("sefReceipt[balanceDue]", $payment->sefReceipt->getBalanceDue());
					$this->tpl->set_var("sefReceipt[amountPaid]", $payment->sefReceipt->getAmountPaid());
					$this->tpl->set_var("sefReceipt[cityTreasurer]", $payment->sefReceipt->getCityTreasurer());
					$this->tpl->set_var("sefReceipt[deputyTreasurer]", $payment->sefReceipt->getDeputyTreasurer());

					$this->tpl->set_var("idleReceipt[receiptDate]", $payment->idleReceipt->getReceiptDate());
					$this->tpl->set_var("idleReceipt[receivedFrom]", $payment->idleReceipt->getReceivedFrom());
					$this->tpl->set_var("idleReceipt[taxType]", $payment->idleReceipt->getTaxType());
					$this->tpl->set_var("idleReceipt[taxDue]", $payment->idleReceipt->getTaxDue());
					$this->tpl->set_var("idleReceipt[advancedPaymentDiscount]", $payment->idleReceipt->getAdvancedPaymentDiscount());
					$this->tpl->set_var("idleReceipt[earlyPaymentDiscount]", $payment->idleReceipt->getEarlyPaymentDiscount());
					$this->tpl->set_var("idleReceipt[penalty]", $payment->idleReceipt->getPenalty());
					$this->tpl->set_var("idleReceipt[amnesty]", $payment->idleReceipt->getAmnesty());
					$this->tpl->set_var("idleReceipt[balanceDue]", $payment->idleReceipt->getBalanceDue());
					$this->tpl->set_var("idleReceipt[amountPaid]", $payment->idleReceipt->getAmountPaid());
					$this->tpl->set_var("idleReceipt[cityTreasurer]", $payment->idleReceipt->getCityTreasurer());
					$this->tpl->set_var("idleReceipt[deputyTreasurer]", $payment->idleReceipt->getDeputyTreasurer());

					$this->tpl->set_var("basicBalanceDue", formatCurrency($payment->basicReceipt->getBalanceDue()));
					$this->tpl->set_var("sefBalanceDue", formatCurrency($payment->sefReceipt->getBalanceDue()));
					$this->tpl->set_var("idleBalanceDue", formatCurrency($payment->idleReceipt->getBalanceDue()));

					$this->tpl->set_var("basicAmountPaid", formatCurrency($payment->basicReceipt->getAmountPaid()));
					$this->tpl->set_var("sefAmountPaid", formatCurrency($payment->sefReceipt->getAmountPaid()));
					$this->tpl->set_var("idleAmountPaid", formatCurrency($payment->idleReceipt->getAmountPaid()));

					$this->tpl->parse("BasicReceiptListBlock", "BasicReceiptList", true);
					$this->tpl->parse("SefReceiptListBlock", "SefReceiptList", true);
					$this->tpl->parse("IdleReceiptListBlock", "IdleReceiptList", true);

					$this->tpl->parse("PaymentListBlock", "PaymentList", true);

					if($basicCtr==5 || $paymentCtr==count($this->paymentArrayList)-1){
						$basicCtr=0;

						$this->tpl->set_var("basicReceiptCtr", $basicReceiptCtr);
						$this->displayPreviousReceiptDateList("basic");

						$this->tpl->parse("BasicReceiptBlock", "BasicReceipt",true);
						$this->tpl->set_var("BasicReceiptListBlock", "");
						$this->tpl->set_var("BasicPreviousReceiptDateYearListBlock", "");
						$this->tpl->set_var("BasicPreviousReceiptDateMonthListBlock", "");
						$this->tpl->set_var("BasicPreviousReceiptDateDayListBlock", "");

						$basicReceiptCtr++;
					}

					if($sefCtr==5 || $paymentCtr==count($this->paymentArrayList)-1){
						$sefCtr=0;

						$this->tpl->set_var("sefReceiptCtr", $sefReceiptCtr);
						$this->displayPreviousReceiptDateList("sef");

						$this->tpl->parse("SefReceiptBlock", "SefReceipt",true);
						$this->tpl->set_var("SefReceiptListBlock", "");
						$this->tpl->set_var("SefPreviousReceiptDateYearListBlock", "");
						$this->tpl->set_var("SefPreviousReceiptDateMonthListBlock", "");
						$this->tpl->set_var("SefPreviousReceiptDateDayListBlock", "");

						$sefReceiptCtr++;
					}

					if($idleCtr==5 || $paymentCtr==count($this->paymentArrayList)-1){
						$idleCtr=0;

						$this->tpl->set_var("idleReceiptCtr", $idleReceiptCtr);
						$this->displayPreviousReceiptDateList("idle");

						$this->tpl->parse("IdleReceiptBlock", "IdleReceipt",true);
						$this->tpl->set_var("IdleReceiptListBlock", "");
						$this->tpl->set_var("IdlePreviousReceiptDateYearListBlock", "");
						$this->tpl->set_var("IdlePreviousReceiptDateMonthListBlock", "");
						$this->tpl->set_var("IdlePreviousReceiptDateDayListBlock", "");

						$idleReceiptCtr++;
					}

					$paymentCtr++;
					$basicCtr++;
					$sefCtr++;
					$idleCtr++;
				}
				break;
			default:
				header("Location: Unauthorized.php".$this->sess->url(""));
				exit();
		}

		$this->setForm();

		$this->tpl->set_var("Session", $this->sess->url(""));
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

$paymentReceiptDetails = new PaymentReceiptDetails($sess);
$paymentReceiptDetails->Main();
?>
<?php page_close(); ?>
