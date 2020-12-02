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

include_once "../includes/collection/dues.php";
include_once "../includes/collection/TDDetails.php";
include_once "../includes/collection/BacktaxTD.php";

#####################################
# Define Interface Class
#####################################
class RPTOPDetails{
	
	var $tpl;
	var $formArray;

	function RPTOPDetails($input,$rptopID){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must have atleast TM-EDIT access
		$pageType = "%%%1%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd());
		$this->tpl->set_file("rptsTemplate", "PayRPTOP2.htm") ;
		$this->tpl->set_var("TITLE", "TM : Apply Payments");

		$this->formArray = array(
			"cityAssessorName" => "",
			"cityTreasurerName" => "",
			"rptopID" => $rptopID
		);
			
		foreach ($input as $key=>$value) {
		//	echo("$key=>$value<br>");
			$this->formArray[$key] = $value;
		}
//		echo $this->formArray[amnesty];
		if (!$input[paymentPeriod]) $this->formArray[paymentPeriod]="Annual";
		if (!$input[amnesty]) $this->formArray[amnesty]="No";
		
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

	function isPriorTDPaid($tdID="") {

		if ($tdID=="") 
			$tdID=41; //Test tdID value
	
		$TDDetails = new TDDetails;
		$tdHistoryArray = $TDDetails->getTDHistory($tdID);#Skultz, Samantha M 

		$ret = true;

		if (is_array($tdHistoryArray)) {
			foreach($tdHistoryArray as $item) {
				$tdID=$item->tdID;

				#echo("tdID=$tdID<br>");
				$yearDue = $item->taxBeginsWithTheYear;

				$dues = new Dues($tdID,$yearDue);
			
				$paymentPeriod = $dues->getPaymentMode();
				$totalDue = $dues->getTotalDue($paymentPeriod);
				$basic = $dues->getBasic($paymentPeriod);

				if (!($totalDue <= 0 && $basic > 0)){
					$this->unpaidTDArray[] = $item;
					$ret = false;
				}
			}
		} 
			
		return $ret;
	}

	function displayPriorTDs($tdID){
		if(is_array($this->unpaidTDArray)){
			$disabledStr = "";
			foreach($this->unpaidTDArray as $key=> $tvalue){
				$propertyType = $tvalue->getPropertyType();
				$propertyID = $tvalue->getPropertyID();
				$afsID = $tvalue->getAfsID();
				$afs = new AFS();
				$afs->selectRecord($afsID);

		        $listValues['propertyIndexNumber'] = $afs->getPropertyIndexNumber();
				$assessedValue = $tvalue->getAssessedValue();
				$listValues['taxBeginsWithTheYear'] = $tvalue->getTaxBeginsWithTheYear();
	            $listValues['tdNum'] = $tvalue->getTaxDeclarationNumber();
				$tdID = $tvalue->getTdID();

	            $listValues['tdID'] = $tdID;

				// get Direct->Succeeding TD;

				$TDDetails = new TDDetails;
				$succeedingTDArray = $TDDetails->getSucceedingTD($tdID);

				$parentTdID = $succeedingTDArray[0]->getTdID();

				if($this->unpaidTDCount == (count($this->unpaidTDArray)-2)){
					$disabledStr = "disabled";
				}
				else{
					if($this->backtaxTDExists){
						$disabledStr = "disabled";
					}
					else{
						$disabledStr = "";
					}
				}

				$dueDate = $listValues['taxBeginsWithTheYear'];
				
				$dues = new Dues($tdID,$dueDate);

				if(!$dues->create($tdID,$dueDate,$assessedValue)){
					$dues->setBasic($assessedValue);
					$dues->setSEF($assessedValue);
										
					# check if land is idle, if yes, set assessed value
					# getIdleStatus -- temporary function
					if($dues->getIdleStatus() == 1){
						#echo("idle<br>");
						$dues->setIdle($assessedValue);
					}
				}

				// Refresh for amnesty and paymentPeriod

				if($this->formArray["formAction"]=="refresh"){
					$amnesty = $this->formArray[amnesty];
					$dues->setAmnesty($amnesty);

					$paymentPeriod = $this->formArray[paymentPeriod];
					$dues->setPaymentMode($paymentPeriod);
				}

				if($dues->getAmnesty()=="Yes"){
					$dues->resetPenalty();
					$dues->computePenalty($paymentPeriod,"now");
				}

				$paymentPeriod = $dues->getPaymentMode();
				$amnesty = $dues->getAmnesty();
				$dues->store();

				switch($paymentPeriod){
					case 'Quarter':
						 $this->tpl->set_var("selectedQuarter","selected");
						 $this->tpl->set_var("paymentPeriod",$paymentPeriod);
									
						 break;
					default: #Annual
						 $this->tpl->set_var("selectedAnnual","selected");
						 $this->tpl->set_var("paymentPeriod",$paymentPeriod);
						 break;
				}

				 $totalDue = $dues->getTotalDue($paymentPeriod);
				 $basic = $dues->getBasic($paymentPeriod);
				 $sef = $dues->getSEF($paymentPeriod);
				 $penalty = $dues->getPenalty($paymentPeriod);
				 $discount = $dues->getDiscount();

				 $totalPaid = $dues->getPaidBasic($paymentPeriod) + $dues->getPaidPenalty($paymentPeriod) + $dues->getPaidSEF($paymentPeriod);

				 $listValues['taxDue'] = $totalDue;
				 $listValues['basic'] = number_format($basic,2);
				 $listValues['sef'] = number_format($sef,2);
				 $listValues['penalty'] = number_format($penalty,2);
				 $listValues['discount'] = number_format($discount,2);

				 $listValues['totalPaid'] = number_format($totalPaid,2);

			     $listValues['strTaxDue'] = number_format($totalDue,2);

				 $sef = $dues->getSEF($paymentPeriod);

				$paidStatus = ($totalDue <= 0) ? (($basic<=0) ?  "N.A." : "PAID") : "<input type=\"checkbox\" name=\"tdID[$tdID]\" value=\"".$tdID."\" onclick=\"javascript: toggle(this, '".$parentTdID."'); updateTotalTaxDue(this,".$tdID.");\" ".$disabledStr.">";
									
	            $listValues['paidStatus'] = $paidStatus;

				$listValues['tdBgcolor'] = '#efefea';

				$this->tpl->set_var($listValues);

				$this->tpl->parse("TDListBlock", "TDList", true);

				$this->tpl->set_var("i", $this->unpaidTDCount);
				$this->tpl->set_var("parentTDID", $parentTdID);
				$this->tpl->parse("JSTDListBlock", "JSTDList", true);
				$this->unpaidTDCount++;
			}
		}
	}

	function displayBacktaxTD($tdID){
		$BacktaxTDDetails = new SoapObject(NCCBIZ."BacktaxTDDetails.php", "urn:Object");

		if(!$xmlStr = $BacktaxTDDetails->getBacktaxTD($tdID)){
			$this->tpl->set_var("BacktaxTDTableBlock", "");
			$this->backtaxTDExists = false;
			return false;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_var("BacktaxTDTableBlock", "");
				$this->backtaxTDExists = false;
				return false;
			}
			else{
				$backtaxTD = new BacktaxTD;
				$backtaxTD->parseDomDocument($domDoc);

				$backtaxTDID = $backtaxTD->getBacktaxTDID();

				$paidStatus = $backtaxTD->getPaidStatus();


				if($paidStatus=="PAID"){
					return false;
				}

				$tdID = $backtaxTD->getTdID();

				$yearRange = $backtaxTD->getStartYear()." - ".$backtaxTD->getEndYear();
				$totalAssessedValue = $backtaxTD->getAssessedValue();
				$totalBasicTax = $backtaxTD->getBasicTax();
				$totalSEFTax = $backtaxTD->getSefTax();
				$totalPenalties = $backtaxTD->getPenalties();
				$totalIdleTax = $backtaxTD->getIdleTax();
				$totalPaid = $backtaxTD->getPaid();

				$totalBacktaxDue = $backtaxTD->getTotalTaxDue();

				$totalTaxes = 0;
				$totalTaxes += $totalBasicTax;
				$totalTaxes += $totalSEFTax;
				$totalTaxes += $totalPenalties;
				$totalTaxes += $totalIdleTax;

				$this->tpl->set_var("backtaxTDID", $backtaxTDID);
				$this->tpl->set_var("tdID", $tdID);
				$this->tpl->set_var("yearRange", $yearRange);
				$this->tpl->set_var("totalTaxes", number_format($totalTaxes,2));
				//$this->tpl->set_var("totalBacktaxAssessedValue", number_format($totalAssessedValue,2));
				//$this->tpl->set_var("totalBasicTax", number_format($totalBasicTax,2));
				//$this->tpl->set_var("totalSEFTax", number_format($totalSEFTax,2));
				//$this->tpl->set_var("totalPenalties", number_format($totalPenalties,2));
				//$this->tpl->set_var("totalIdleTax", number_format($totalIdleTax,2));
				$this->tpl->set_var("totalPaid", number_format($totalPaid,2));

				$this->tpl->set_var("totalBacktaxDue", $totalBacktaxDue);
				$this->tpl->set_var("totalBacktaxDueStr", number_format($totalBacktaxDue,2));

				$this->tpl->parse("BacktaxTDTableBlock", "BacktaxTDTable", true);

				$this->backtaxTDExists = true;
				return true;
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
	
	function Main(){
		global $sess;
		
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
						case "taxableYear":
							$this->tpl->set_var("taxableYear", $value);
							$dueDate = $value;
							break;
						case "tdArray":
							$this->tpl->set_block("rptsTemplate", "TDList", "TDListBlock");
							$this->tpl->set_block("rptsTemplate", "JSTDList", "JSTDListBlock");
							$this->tpl->set_block("rptsTemplate", "BacktaxTDTable", "BacktaxTDTableBlock");
							$this->unpaidTDCount = 0;
							if (count($value)){
								$this->tpl->set_block("rptsTemplate", "TDDBEmpty", "TDDBEmptyBlock");
								$this->tpl->set_var("TDDBEmptyBlock", "");
								foreach($value as $tkey => $tvalue){
									$propertyType = $tvalue->getPropertyType();
									$propertyID = $tvalue->getPropertyID();
										$afsID = $tvalue->getAfsID();
										$afs = new AFS();
										$afs->selectRecord($afsID);
										
						            $listValues['propertyIndexNumber'] = $afs->getPropertyIndexNumber();
									$assessedValue = $tvalue->getAssessedValue();
									#echo("assessedValue=$assessedValue<br7>");

									$listValues['taxBeginsWithTheYear'] = $tvalue->getTaxBeginsWithTheYear();

						            $listValues['tdNum'] = $tvalue->getTaxDeclarationNumber();
									$tdID = $tvalue->getTdID();
						            $listValues['tdID'] = $tdID;

									#echo("tdID=$tdID, dueDate=$dueDate<br>");

									$dues = new Dues($tdID,$dueDate);

									if(!$dues->create($tdID,$dueDate,$assessedValue)){
										$dues->setBasic($assessedValue);
										$dues->setSEF($assessedValue);
										
										# check if land is idle, if yes, set assessed value
										# getIdleStatus -- temporary function
										if($dues->getIdleStatus() == 1){
											#echo("idle<br>");
											$dues->setIdle($assessedValue);
										}
									}

									// Refresh for amnesty and paymentPeriod

									if($this->formArray["formAction"]=="refresh"){
										$amnesty = $this->formArray[amnesty];
										$dues->setAmnesty($amnesty);

										$paymentPeriod = $this->formArray[paymentPeriod];
										$dues->setPaymentMode($paymentPeriod);
									}

									if($dues->getAmnesty()=="Yes"){
										$dues->resetPenalty();
										$dues->computePenalty($paymentPeriod,"now");
									}

									$paymentPeriod = $dues->getPaymentMode();
									$amnesty = $dues->getAmnesty();
									$dues->store();

									switch($paymentPeriod){
										case 'Quarter':
											 $this->tpl->set_var("selectedQuarter","selected");
											 $this->tpl->set_var("paymentPeriod",$paymentPeriod);

											 $this->tpl->set_var("installmentNumber",ceil(date("n")/3));
											 $this->tpl->set_var("netDueFullAmount", number_format($dues->getTotalDue("Annual"),2));
											 break;
										default: #Annual
											 $this->tpl->set_block("rptsTemplate", "QuarterNetDue", "QuarterNetDueBlock");
											 $this->tpl->set_var("QuarterNetDueBlock", "");

											 $this->tpl->set_var("selectedAnnual","selected");
											 $this->tpl->set_var("paymentPeriod",$paymentPeriod);
											 break;
									}

									//$totalDue = $dues->getTotalDue($paymentPeriod);

									 $totalDue = $dues->getTotalDue($paymentPeriod);
									 $basic = $dues->getBasic($paymentPeriod);
									 $sef = $dues->getSEF($paymentPeriod);
									 $penalty = $dues->getPenalty($paymentPeriod);
									 $discount = $dues->getDiscount();

									 $totalPaid = $dues->getPaidBasic($paymentPeriod) + $dues->getPaidPenalty($paymentPeriod) + $dues->getPaidSEF($paymentPeriod);

									 $listValues['taxDue'] = $totalDue;
									 $listValues['basic'] = number_format($basic,2);
									 $listValues['sef'] = number_format($sef,2);
									 $listValues['penalty'] = number_format($penalty,2);
									 $listValues['discount'] = number_format($discount,2);
									 $listValues['totalPaid'] = number_format($totalPaid,2);

								     $listValues['strTaxDue'] = number_format($totalDue,2);


									//$basic = $dues->getBasic($paymentPeriod);
									#echo("basic=$basic<br>");
									//$sef = $dues->getSEF($paymentPeriod);
									#echo("sef=$sef<br>");

									if (!$this->isPriorTDPaid($tdID)) {
										$backtaxes = true;
										$paidStatus = "<input type=\"checkbox\" name=\"tdID[".$tdID."]\" value=\"".$tdID."\" onclick=\"javascript: toggle(this, '".$tdID."'); updateTotalTaxDue(this,".$tdID.");\" disabled>";
									} else {
										$backtaxes = false;
										$paidStatus = ($totalDue <= 0) ? (($basic<=0) ?  "N.A." : "PAID") : "<input type=\"checkbox\" name=\"tdID[".$tdID."]\" value=\"".$tdID."\" onclick=\"javascript: toggle(this, '".$tdID."'); updateTotalTaxDue(this,".$tdID.");\">";
									}
									
						            $listValues['paidStatus'] = $paidStatus;

									$listValues['tdBgcolor'] = '#f6f6f6';

						            $this->tpl->set_var($listValues);
									$this->tpl->parse("TDListBlock", "TDList", true);

									if($backtaxes){
										$oldestUnpaidTD = $this->unpaidTDArray[count($this->unpaidTDArray)-1];
										
										$this->displayBacktaxTD($oldestUnpaidTD->getTdID());

										$this->displayPriorTDs($tdID);
										unset($this->unpaidTDArray);
									}
									else{
										$this->displayBacktaxTD($tdID);
										$this->tpl->set_var("JSTDListBlock", "");
									}

									//$this->tpl->parse("BacktaxTDTableBlock", "BacktaxTDTable", true);
								}

							}
							else {
								$this->tpl->set_block("rptsTemplate", "CheckAll", "CheckAllBlock");
								$this->tpl->set_var("CheckAllBlock", "");
								$this->tpl->set_var("TDListBlock", "");
							}
							$this->tpl->set_var("rptopID",$rptopID);
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
		
		$this->tpl->set_var(amnestyChecked,($amnesty=="Yes") ? " checked" : "");
		$this->tpl->set_var("Session", $sess->url("").$sess->add_query(array("rptopID"=>$this->formArray["rptopID"],"ownerID" => $this->formArray["ownerID"])));
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
$ownerList = new RPTOPDetails($HTTP_POST_VARS,$rptopID);
$ownerList->main();

page_close(); ?>
