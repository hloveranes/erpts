<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/Address.php";
include_once "../assessor/Company.php";
include_once "../assessor/CompanyRecords.php";
include_once "../assessor/Person.php";
include_once "../assessor/PersonRecords.php";
include_once "../assessor/Owner.php";
include_once "../assessor/OwnerRecords.php";
include_once "../assessor/RPTOP.php";
include_once "../assessor/RPTOPRecords.php";

include_once "../assessor/AFS.php";

include_once "../assessor/ODHistoryRecords.php";
include_once "../assessor/ODHistory.php";

include_once "../collection/Due.php";
include_once "../collection/DueRecords.php";
include_once "../collection/BacktaxTD.php";

include_once "../collection/TreasurySettings.php";

#####################################
# Define Interface Class
#####################################
class CalculateRPTOPBatch{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function CalculateRPTOPBatch($http_post_vars,$sess,$rptopID,$page,$searchKey,$formAction,$sortBy,$sortOrder){
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

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "CalculateRPTOPBatch.htm") ;
		$this->tpl->set_var("TITLE", "Calculate Taxes");
		
		$this->formArray["rptopID"] = $rptopID;
		$this->formArray["page"] = $page;
		$this->formArray["searchKey"] = $searchKey;
		$this->formArray["formAction"] = $formAction;
		$this->formArray["sortBy"] = $sortBy;
		$this->formArray["sortOrder"] = $sortOrder;

        		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function sortBlocks(){
		$this->tpl->set_block("rptsTemplate", "AscendingRPTOPID", "AscendingRPTOPIDBlock");
		$this->tpl->set_block("rptsTemplate", "AscendingPerson", "AscendingPersonBlock");
		$this->tpl->set_block("rptsTemplate", "AscendingCompany", "AscendingCompanyBlock");
		$this->tpl->set_block("rptsTemplate", "DescendingRPTOPID", "DescendingRPTOPIDBlock");
		$this->tpl->set_block("rptsTemplate", "DescendingPerson", "DescendingPersonBlock");
		$this->tpl->set_block("rptsTemplate", "DescendingCompany", "DescendingCompanyBlock");

		$this->formArray["rptopIDSortOrder"] = "ASC";
		$this->formArray["personSortOrder"] = "DESC";
		$this->formArray["companySortOrder"] = "DESC";

		switch($this->formArray["sortBy"]){
			case "rptopID":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["rptopIDSortOrder"] = "DESC";
						$this->tpl->parse("AscendingRPTOPIDBlock", "AscendingRPTOPID", true);
						$this->tpl->set_var("DescendingRPTOPIDBlock", "");
						break;
					case "DESC":
						$this->formArray["rptopIDSortOrder"] = "ASC";
						$this->tpl->parse("DescendingRPTOPIDBlock", "DescendingRPTOPID", true);
						$this->tpl->set_var("AscendingRPTOPIDBlock", "");
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						$this->tpl->parse("DescendingRPTOPIDBlock", "DescendingRPTOPID", true);
						$this->tpl->set_var("AscendingRPTOPIDBlock", "");
						break;
				}
				$this->tpl->set_var("AscendingPersonBlock", "");
				$this->tpl->set_var("DescendingPersonBlock", "");
				$this->tpl->set_var("AscendingCompanyBlock", "");
				$this->tpl->set_var("DescendingCompanyBlock", "");
				$condition = " ORDER BY ".RPTOP_TABLE.".rptopID ".$this->formArray["sortOrder"];
				break;
			case "person":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["personSortOrder"] = "DESC";
						$this->tpl->parse("AscendingPersonBlock", "AscendingPerson", true);
						$this->tpl->set_var("DescendingPersonBlock", "");
						break;
					case "DESC":
						$this->formArray["personSortOrder"] = "ASC";
						$this->tpl->parse("DescendingPersonBlock", "DescendingPerson", true);
						$this->tpl->set_var("AscendingPersonBlock", "");
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						$this->formArray["personSortOrder"] = "ASC";
						$this->tpl->parse("DescendingPersonBlock", "DescendingPerson", true);
						$this->tpl->set_var("AscendingPersonBlock", "");
						break;
				}
				$this->tpl->set_var("AscendingRPTOPIDBlock", "");
				$this->tpl->set_var("DescendingRPTOPIDBlock", "");
				$this->tpl->set_var("AscendingCompanyBlock", "");
				$this->tpl->set_var("DescendingCompanyBlock", "");
				$condition = " ORDER BY PersonFullName ".
					$this->formArray["sortOrder"];
				break;
			case "company":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["companySortOrder"] = "DESC";
						$this->tpl->parse("AscendingCompanyBlock", "AscendingCompany", true);
						$this->tpl->set_var("DescendingCompanyBlock", "");
						break;
					case "DESC":
						$this->formArray["companySortOrder"] = "ASC";
						$this->tpl->parse("DescendingCompanyBlock", "DescendingCompany", true);
						$this->tpl->set_var("AscendingCompanyBlock", "");
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						$this->formArray["companySortOrder"] = "ASC";
						$this->tpl->parse("DescendingCompanyBlock", "DescendingCompany", true);
						$this->tpl->set_var("AscendingCompanyBlock", "");
						break;
				}
				$this->tpl->set_var("AscendingRPTOPIDBlock", "");
				$this->tpl->set_var("DescendingRPTOPIDBlock", "");
				$this->tpl->set_var("AscendingPersonBlock", "");
				$this->tpl->set_var("DescendingPersonBlock", "");
				$condition = " ORDER BY ".COMPANY_TABLE.".companyName ".
					$this->formArray["sortOrder"];
				break;
			default:
				$this->formArray["sortBy"] = "rptopID";
				$this->formArray["sortOrder"] = "DESC";
				$this->tpl->set_var("AscendingRPTOPIDBlock", "");
				$this->tpl->set_var("AscendingPersonBlock", "");
				$this->tpl->set_var("AscendingCompanyBlock", "");
				$this->tpl->parse("DescendingRPTOPIDBlock", "DescendingRPTOPID", true);
				$this->tpl->set_var("DescendingPersonBlock", "");
				$this->tpl->set_var("DescendingCompanyBlock", "");
				$condition = " ORDER BY ".RPTOP_TABLE.".rptopID DESC";
				break;
		}
		return $condition;
	}
	//*/
	
	function setForm(){
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

	function setRPTOPListBlockPerms(){
		if(!checkPerms($this->user["userType"],"%1%%%%%%%%")){
			$this->tpl->set_var("ownerViewAccess","viewOnly");
			$this->tpl->set_var("rptopDetailsLinkLabel", "View");
		}
		else{
			$this->tpl->set_var("ownerViewAccess","view");
			$this->tpl->set_var("rptopDetailsLinkLabel", "Edit");
		}
	}

	function setBacktaxTDFromDueArray($tdID,$backtaxTDID,$dueArray,$previousTD,$previousAFS){
		$backtaxTD = new BacktaxTD;

		$backtaxTD->setBacktaxTDID($backtaxTDID);

		$backtaxTD->setCreatedBy($this->user["uid"]);
		$backtaxTD->setModifiedBy($this->user["uid"]);

		$backtaxTD->setTDID($tdID);
		$backtaxTD->setTdNumber($previousTD->getTaxDeclarationNumber());

		$backtaxTD->setStartYear(date("Y",strtotime($dueArray["Annual"]->getDueDate())));
		$backtaxTD->setEndYear(date("Y",strtotime($dueArray["Annual"]->getDueDate())));

		$backtaxTD->setAssessedValue($previousAFS->getTotalAssessedValue());
		$backtaxTD->setBasicRate($dueArray["Annual"]->getBasicTaxRate());
		$backtaxTD->setSefRate($dueArray["Annual"]->getSefTaxRate());
		$backtaxTD->setBasicTax($dueArray["Annual"]->getBasicTax());
		$backtaxTD->setSefTax($dueArray["Annual"]->getSefTax());
		$backtaxTD->setIdleTax($dueArray["Annual"]->getIdleTax());
		$backtaxTD->setBalance($backtaxTD->getTotalTaxes());

		// figure out startQuarter, penalties, paid
		$backtaxTD->setStartQuarter("");
		$backtaxTD->setPenalties("");
		$backtaxTD->setPaid("");

		return $backtaxTD;
	}

	function refreshTDHistory($td){
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

						// capture DUES of precedingTD

						$DueList = new SoapObject(NCCBIZ."DueList.php", "urn:Object");
						if (!$xmlStr = $DueList->getDueList($precedingTD->getTdID(),$this->formArray["taxableYear"]-1)){
							// no Dues for precedingTD
							//echo "no dues";
						}
						else {
							if(!$domDoc = domxml_open_mem($xmlStr)) {
								// no Dues for precedingTD
								//echo "no dues";
							}
							else {
								$dueRecords = new DueRecords;
								$dueRecords->parseDomDocument($domDoc);

								foreach($dueRecords->getArrayList() as $due){
									foreach($due as $dueKey=>$dueValue){
										switch($dueKey){
											case "dueType":
												$dueArray[$dueValue] = $due;
												break;
										}
									}
								}

								$BacktaxTDDetails = new SoapObject(NCCBIZ."BacktaxTDDetails.php", "urn:Object");
								$BacktaxTDEncode = new SoapObject(NCCBIZ."BacktaxTDEncode.php", "urn:Object");

								if(!$xmlStr = $BacktaxTDDetails->getBacktaxTD($td->getTdID(),$this->formArray["taxableYear"]-1)){
									// backtax for Due does not exist, create backtax
									$backtaxTD = $this->setBacktaxTDFromDueArray($td->getTdID(),"",$dueArray,$precedingTD,$previousAFS);
									$backtaxTD->setDomDocument();
									$backtaxTDDoc = $backtaxTD->getDomDocument();
									$backtaxTDXmlStr =  $backtaxTDDoc->dump_mem(true);
									if (!$backtaxTDID = $BacktaxTDEncode->saveBacktaxTD($backtaxTDXmlStr)){
										echo("Error saving BacktaxTD");
									}
								}
								else{
									if(!$domDoc = domxml_open_mem($xmlStr)){
										// backtax for Due does not exist, create backtax
										$backtaxTD = $this->setBacktaxTDFromDueArray($td->getTdID(),"",$dueArray,$precedingTD,$previousAFS);
										$backtaxTD->setDomDocument();
										$backtaxTDDoc = $backtaxTD->getDomDocument();
										$backtaxTDXmlStr =  $backtaxTDDoc->dump_mem(true);
										if (!$backtaxTDID = $BacktaxTDEncode->saveBacktaxTD($backtaxTDXmlStr)){
											echo("Error saving BacktaxTD");
										}
									}
									else{
										// update backtax from Due
										$backtaxTD = new BacktaxTD;
										$backtaxTD->parseDomDocument($domDoc);

										$backtaxTD = $this->setBacktaxTDFromDueArray($td->getTdID(),$backtaxTD->getBacktaxTDID(),$dueArray,$precedingTD,$previousAFS);
										$backtaxTD->setDomDocument();
										$backtaxTDDoc = $backtaxTD->getDomDocument();
										$backtaxTDXmlStr =  $backtaxTDDoc->dump_mem(true);
										if (!$backtaxTDID = $BacktaxTDEncode->updateBacktaxTD($backtaxTDXmlStr)){
											echo("Error updating BacktaxTD");
										}
									}
								}


							}
						}

					}

				}
			}
		}

	}
	
	function setDues(){
		$dueArray[0] = new Due;

		$dueArray[0]->setDueID($this->formArray["dueID"]);
		$dueArray[0]->setTdID($this->formArray["tdID"]);
		$dueArray[0]->setDueType("Annual");
		$dueArray[0]->setDueDate($this->formArray["dueDate"]);
		$dueArray[0]->setBasicTax(un_number_format($this->formArray["basicTax"]));
		$dueArray[0]->setBasicTaxRate($this->formArray["basicTaxRate"]);
		$dueArray[0]->setSefTax(un_number_format($this->formArray["sefTax"]));
		$dueArray[0]->setSefTaxRate($this->formArray["sefTaxRate"]);
		$dueArray[0]->setIdleTax(un_number_format($this->formArray["idleTax"]));
		$dueArray[0]->setIdleTaxRate($this->formArray["idleTaxRate"]);
		$dueArray[0]->setDomDocument();

		// set Quarter Dues

		$dueIDArray = array(
			"Annual" => ""
			,"Q1" => ""
			,"Q2" => ""
			,"Q3" => ""
			,"Q4" => "");

		$DueList = new SoapObject(NCCBIZ."DueList.php", "urn:Object");
		if (!$xmlStr = $DueList->getDueList($this->formArray["tdID"],date("Y",strtotime($this->formArray["dueDate"])))){
			// error xmlStr
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
			}
			else {
				//print_r(htmlspecialchars($xmlStr));
				//exit;

				$dueRecords = new DueRecords;
				$dueRecords->parseDomDocument($domDoc);

				foreach($dueRecords->getArrayList() as $due){
					foreach($due as $dueKey=>$dueValue){
						switch($dueKey){
							case "dueType":
								$dueIDArray[$dueValue] = $due->getDueID();
								break;
						}
					}
				}
			}
		}

		$dueArray[1] = new Due;
		$dueArray[1]->setDueID($dueIDArray["Q1"]);
		$dueArray[1]->setTdID($this->formArray["tdID"]);
		$dueArray[1]->setDueType("Q1");
		$dueArray[1]->setDueDate(date("Y",strtotime($this->formArray["dueDate"]))."-03-31"); // March 31
		$dueArray[1]->setBasicTax(roundUpNearestFiveCent(un_number_format($this->formArray["basicTax"])/4));
		$dueArray[1]->setBasicTaxRate($this->formArray["basicTaxRate"]);
		$dueArray[1]->setSefTax(roundUpNearestFiveCent(un_number_format($this->formArray["sefTax"])/4));
		$dueArray[1]->setSefTaxRate($this->formArray["sefTaxRate"]);
		$dueArray[1]->setIdleTax(roundUpNearestFiveCent(un_number_format($this->formArray["idleTax"])/4));
		$dueArray[1]->setIdleTaxRate($this->formArray["idleTaxRate"]);
		$dueArray[1]->setDomDocument();

		$dueArray[2] = new Due;
		$dueArray[2]->setDueID($dueIDArray["Q2"]);
		$dueArray[2]->setTdID($this->formArray["tdID"]);
		$dueArray[2]->setDueType("Q2");
		$dueArray[2]->setDueDate(date("Y",strtotime($this->formArray["dueDate"]))."-06-30"); // June 30
		$dueArray[2]->setBasicTax(roundUpNearestFiveCent(un_number_format($this->formArray["basicTax"])/4));
		$dueArray[2]->setBasicTaxRate($this->formArray["basicTaxRate"]);
		$dueArray[2]->setSefTax(roundUpNearestFiveCent(un_number_format($this->formArray["sefTax"])/4));
		$dueArray[2]->setSefTaxRate($this->formArray["sefTaxRate"]);
		$dueArray[2]->setIdleTax(roundUpNearestFiveCent(un_number_format($this->formArray["idleTax"])/4));
		$dueArray[2]->setIdleTaxRate($this->formArray["idleTaxRate"]);
		$dueArray[2]->setDomDocument();

		$dueArray[3] = new Due;
		$dueArray[3]->setDueID($dueIDArray["Q3"]);
		$dueArray[3]->setTdID($this->formArray["tdID"]);
		$dueArray[3]->setDueType("Q3");
		$dueArray[3]->setDueDate(date("Y",strtotime($this->formArray["dueDate"]))."-09-30"); // Sept 30
		$dueArray[3]->setBasicTax(roundUpNearestFiveCent(un_number_format($this->formArray["basicTax"])/4));
		$dueArray[3]->setBasicTaxRate($this->formArray["basicTaxRate"]);
		$dueArray[3]->setSefTax(roundUpNearestFiveCent(un_number_format($this->formArray["sefTax"])/4));
		$dueArray[3]->setSefTaxRate($this->formArray["sefTaxRate"]);
		$dueArray[3]->setIdleTax(roundUpNearestFiveCent(un_number_format($this->formArray["idleTax"])/4));
		$dueArray[3]->setIdleTaxRate($this->formArray["idleTaxRate"]);
		$dueArray[3]->setDomDocument();

		$dueArray[4] = new Due;
		$dueArray[4]->setDueID($dueIDArray["Q4"]);
		$dueArray[4]->setTdID($this->formArray["tdID"]);
		$dueArray[4]->setDueType("Q4");
		$dueArray[4]->setDueDate(date("Y",strtotime($this->formArray["dueDate"]))."-12-31"); // Dec 31
		$dueArray[4]->setBasicTax(roundUpNearestFiveCent(un_number_format($this->formArray["basicTax"])/4));
		$dueArray[4]->setBasicTax(un_number_format($this->formArray["basicTax"])-($dueArray[4]->getBasicTax())*3);
		$dueArray[4]->setSefTax(roundUpNearestFiveCent(un_number_format($this->formArray["sefTax"])/4));
		$dueArray[4]->setSefTax(un_number_format($this->formArray["sefTax"])-($dueArray[4]->getSefTax())*3);
		$dueArray[4]->setIdleTax(roundUpNearestFiveCent(un_number_format($this->formArray["idleTax"])/4));
		$dueArray[4]->setIdleTax(un_number_format($this->formArray["idleTax"])-($dueArray[4]->getIdleTax())*3);
		$dueArray[4]->setBasicTaxRate($this->formArray["basicTaxRate"]);
		$dueArray[4]->setSefTaxRate($this->formArray["sefTaxRate"]);
		$dueArray[4]->setIdleTaxRate($this->formArray["idleTaxRate"]);
		$dueArray[4]->setDomDocument();

		return $dueArray;
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "delete":
				//print_r($this->formArray);
				if (count($this->formArray["rptopID"]) > 0) {
					$RPTOPList = new SoapObject(NCCBIZ."RPTOPList.php", "urn:Object");
					if (!$deletedRows = $RPTOPList->deleteRPTOP($this->formArray["rptopID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				break;	
			case "updateCalculation":
				if(is_array($this->formArray["rptopID"])){

					$RPTOPDetails = new SoapObject(NCCBIZ."RPTOPDetails.php", "urn:Object");
					$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
					$DueDetails = new SoapObject(NCCBIZ."DueDetails.php", "urn:Object");
					$DueEncode = new SoapObject(NCCBIZ."DueEncode.php", "urn:Object");
					$DueList = new SoapObject(NCCBIZ."DueList.php", "urn:Object");
					$dueIDArray = array(
						"Annual" => ""
						,"Q1" => ""
						,"Q2" => ""
						,"Q3" => ""
						,"Q4" => "");

					$treasurySettings = new TreasurySettings;
					$treasurySettings->selectRecord();
				
					$this->formArray["masterBasicTaxRate"] = $treasurySettings->getPctRPTax();
					$this->formArray["masterSEFTaxRate"] = $treasurySettings->getPctSEF();
					$this->formArray["masterIdleTaxRate"] = $treasurySettings->getPctIdle();	
					$this->formArray["discountPeriod"] = $treasurySettings->getDiscountPeriod();
					$this->formArray["annualDueDate"] = $treasurySettings->getAnnualDueDate();
					
					foreach($this->formArray["rptopID"] as $rptopID){
						if(!$xmlStr = $RPTOPDetails->getRPTOP($rptopID)){
							// error xmlStr
						}
						else{
							if(!$domDoc = domxml_open_mem($xmlStr)) {
								// error domDoc								
							}
							else {
								$rptop = new RPTOP;
								$rptop->parseDomDocument($domDoc);
								$this->formArray["taxableYear"] = $rptop->getTaxableYear();
								$tdArray = $rptop->getTDArray();
								if(is_array($tdArray)){
									foreach($tdArray as $td){
									
										$this->formArray["assessedValue"] = "";
										$this->formArray["taxability"] = "";
										$this->formArray["idle"] = "";
										$this->formArray["tdID"] = $td->getTdID();
										$this->formArray["dueID"] = "";
										$this->formArray["propertyType"] = $td->getPropertyType();

										if (!$afsXmlStr = $AFSDetails->getAFS($td->getAfsID())){
											// error afsXmlStr
										}
										else{
											if(!$afsDomDoc = domxml_open_mem($afsXmlStr)) {
												// error afsDomDoc
											}
											else {
												$afs = new AFS;
												$afs->parseDomDocument($afsDomDoc);
											
												$this->formArray["assessedValue"] = $afs->getTotalAssessedValue();
												$this->formArray["taxability"] = $afs->getTaxability();
												$this->formArray["effectivity"] = $afs->getEffectivity();

												$this->formArray["dueDate"] = date("Y-n-d",strtotime($this->formArray["taxableYear"]."-".$this->formArray["annualDueDate"]));
												
												if($this->formArray["propertyType"]=="Land"){
													if(is_array($afs->getLandArray())){
														$this->formArray["idle"] = $afs->landArray[0]->getIdle();
													}
												}
											}
										}
									
										if (!$dueXmlStr = $DueList->getDueList($td->getTdID(),$rptop->getTaxableYear())){
											$this->formArray["dueID"] = "";
											$dueIDArray["Annual"] = "";
										}
										else {
											if(!$dueDomDoc = domxml_open_mem($dueXmlStr)) {
												$this->formArray["dueID"] = "";
												$dueIDArray["Annual"] = "";
											}
											else {
												//print_r(htmlspecialchars($xmlStr));
												//exit;

												$dueRecords = new DueRecords;
												$dueRecords->parseDomDocument($dueDomDoc);

												foreach($dueRecords->getArrayList() as $due){
													foreach($due as $dueKey=>$dueValue){
														switch($dueKey){
															case "dueType":
																$dueIDArray[$dueValue] = $due->getDueID();
																break;
														}
													}
												}
												$this->formArray["dueID"] = $dueIDArray["Annual"];
											}
										}
										
										$this->formArray["basicTaxRate"] = $this->formArray["masterBasicTaxRate"];
										$this->formArray["sefTaxRate"] = $this->formArray["masterSEFTaxRate"];
										$this->formArray["idleTaxRate"] = $this->formArray["masterIdleTaxRate"];

										$this->formArray["basicTax"] = un_number_format($this->formArray["assessedValue"]) * $this->formArray["basicTaxRate"];
										$this->formArray["sefTax"] = un_number_format($this->formArray["assessedValue"]) * $this->formArray["sefTaxRate"];

										// if land->idle is "Yes", compute idleTax, otherwise set idleTax to zero
										
										if($this->formArray["propertyType"]=="Land"){
											if($this->formArray["idle"]=="Yes"){
												$this->formArray["idleTax"] = un_number_format($this->formArray["assessedValue"]) * $this->formArray["idleTaxRate"];
											}
											else{
												$this->formArray["idleTax"] = "0.00";
											}
										}

										// if afs->taxability is "Exempt", reset computations to zero.
										if($this->formArray["taxability"]=="Exempt"){
											$this->formArray["basicTax"] = "0.00";
											$this->formArray["sefTax"] = "0.00";
											$this->formArray["idleTax"] = "0.00";
										}
										
										
										if($dueIDArray["Annual"]!=""){
											$dueArray = $this->setDues();

											foreach($dueArray as $due){
												$doc = $due->getDomDocument();
												$xmlStr =  $doc->dump_mem(true);

												if (!$ret = $DueEncode->updateDue($xmlStr)){
													// error update
												}

												unset($doc);
												unset($xmlStr);
											}
										}
										else{
											$dueArray = $this->setDues();

											foreach($dueArray as $due){
												$doc = $due->getDomDocument();
												$xmlStr =  $doc->dump_mem(true);

												if (!$ret = $DueEncode->saveDue($xmlStr)){
													// error save
												}
												unset($doc);
												unset($xmlStr);
											}
										}

										$this->formArray["taxableYear"] = $rptop->getTaxableYear();
										$this->refreshTDHistory($td);
										
									}
								}
								unset($tdArray);
							}
						}
					
					
					}					
				}
				
				
				if($this->formArray["searchKey"]!=""){
					$this->formArray["formAction"] = "search";
				}
				else{
					$this->formArray["formAction"] = "";
				}

				header("Location: CalculateRPTOPBatch.php".$this->sess->url("")."&page=".$this->formArray["page"]."&sortBy=".$this->formArray["sortBy"]."&sortOrder=".$this->formArray["sortOrder"]."&formAction=".$this->formArray["formAction"]."&searchKey=".$this->formArray["searchKey"]);
				exit;
				break;
			case "search":
				$RPTOPList = new SoapObject(NCCBIZ."RPTOPList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				$this->tpl->set_block("rptsTemplate", "PagesList", "PagesListBlock");

				if (!$count = $RPTOPList->getSearchCount($this->formArray["searchKey"])){
					$this->tpl->set_var("PagesBlock", "");
					$this->tpl->set_var("PagesListBlock", "");
					$numOfPages = 1;
					$this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
					$this->tpl->set_var("PageNavigatorBlock", "");
				}
				else{
					$numOfPages = ceil($count / PAGE_BY);

					// page list nav
					$this->formArray["pageLinksInLine"] = 7;
					if($this->formArray["page"] < round($this->formArray["pageLinksInLine"]/2)){
						$startPageLinks = 1;
					}
					else{
						$startPageLinks = $this->formArray["page"] - round($this->formArray["pageLinksInLine"]/2);
						if($startPageLinks<1) $startPageLinks = 1;
					}
					$endPageLinks = $startPageLinks + ($this->formArray["pageLinksInLine"]-1);
					if($endPageLinks > $numOfPages) $endPageLinks = $numOfPages;

					for($i=$startPageLinks ; $i<=$endPageLinks ; $i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("pageListPages","");
							$this->tpl->set_var("pageListPagesUrl", "");
							$this->tpl->set_var("pageListPaged",$i);
						}
						else{
							$this->tpl->set_var("pageListPages",$i);
							$this->tpl->set_var("pageListPagesUrl", $i . "&formAction=search&searchKey=" . urlencode($this->formArray["searchKey"]));
							$this->tpl->set_var("pageListPaged","");
						}
						$this->tpl->parse("PagesListBlock", "PagesList", true);
					}

					// drop down nav
					for($i=1;$i<=$numOfPages;$i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("pages",$i);
							$this->tpl->set_var("pagesUrl", $i . "&formAction=search&searchKey=" . urlencode($this->formArray["searchKey"]));
							$this->tpl->set_var("paged","selected");
						}
						else{
							$this->tpl->set_var("pages",$i);
							$this->tpl->set_var("pagesUrl", $i . "&formAction=search&searchKey=" . urlencode($this->formArray["searchKey"]));
							$this->tpl->set_var("paged","");
						}
						$this->tpl->parse("PagesBlock", "Pages", true);
					}
				}
				if ($numOfPages == $this->formArray["page"]){
					$this->tpl->set_var("nextTxt", "");
				}
				else{
					$this->tpl->set_var("next", $this->formArray["page"]+1 . "&formAction=search&searchKey=" . urlencode($this->formArray["searchKey"]));
					$this->tpl->set_var("nextTxt", "next");
				}
				if ($this->formArray["page"] == 1){
					$this->tpl->set_var("previousTxt", "");
				}
				else {
					$this->tpl->set_var("previous", $this->formArray["page"]-1 . "&formAction=search&searchKey=" . urlencode($this->formArray["searchKey"]));
					$this->tpl->set_var("previousTxt", "previous");
				}
				$this->tpl->set_var("pageOf", $this->formArray["page"]." of ".$numOfPages);

				$condition = $this->sortBlocks();
				if (!$xmlStr = $RPTOPList->searchRPTOP($this->formArray["page"],$condition,$this->formArray["searchKey"])){
                    $this->tpl->set_var("pageOf", "");
                    $this->tpl->set_block("rptsTemplate", "RPTOPTable", "RPTOPTableBlock");
                    $this->tpl->set_var("RPTOPTableBlock", "");
                    $this->tpl->set_block("rptsTemplate", "RPTOPDBEmpty", "RPTOPDBEmptyBlock");
                    $this->tpl->set_var("RPTOPDBEmptyBlock", "");
                    $this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
                    $this->tpl->set_var("PagesBlock", "");
                    $this->tpl->set_var("PagesListBlock", "");
                    $this->tpl->set_var("previousTxt", "");
                    $this->tpl->set_var("nextTxt", "");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "RPTOPListTable", "RPTOPListTableBlock");
						$this->tpl->set_var("RPTOPListTableBlock", "error xmlDoc");
					}
					else {
                        $this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
                        $this->tpl->set_var("NotFoundBlock", "");
						$rptopRecords = new RPTOPRecords;
						$rptopRecords->parseDomDocument($domDoc);
						$list = $rptopRecords->getArrayList();
						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "RPTOPDBEmpty", "RPTOPDBEmptyBlock");
							$this->tpl->set_var("RPTOPDBEmptyBlock", "");	
							$this->tpl->set_block("rptsTemplate", "RPTOPList", "RPTOPListBlock");
							$this->tpl->set_block("RPTOPList", "PersonList", "PersonListBlock");
							$this->tpl->set_block("RPTOPList", "CompanyList", "CompanyListBlock");
							foreach ($list as $key => $value){
								$this->tpl->set_var("rptopID", $value->getRptopID());
								$oValue = $value->owner;
								$pOwnerStr = "";
								if (count($oValue->personArray)){
									foreach($oValue->personArray as $pKey => $pValue){
										$this->tpl->set_var("personID",$pValue->getPersonID());
										$this->tpl->set_var("OwnerPerson",$pValue->getFullName());
										$this->tpl->parse("PersonListBlock", "PersonList", true);
									}
								}
								if (count($oValue->companyArray)){
									foreach($oValue->companyArray as $cKey => $cValue){
										$this->tpl->set_var("companyID",$cValue->getCompanyID());
										$this->tpl->set_var("OwnerCompany",$cValue->getCompanyName());
										$this->tpl->parse("CompanyListBlock", "CompanyList", true);
									}
								}
								if (count($oValue->personArray) || count($oValue->companyArray)){
									$this->tpl->set_var("none","");
								}
								else{
									$this->tpl->set_var("none","none");
								}
								
								$this->tpl->set_var("totalMarketValue", number_format($value->getTotalMarketValue(), 2, '.', ','));
								$this->tpl->set_var("totalAssessedValue", number_format($value->getTotalAssessedValue(), 2, '.', ','));

								$this->tpl->set_var("taxableYear",$value->getTaxableYear());
					
								// grab Dues of rptop to get totalTaxDue
								$totalTaxDue = 0.00;
								if(is_array($value->tdArray)){
									foreach($value->tdArray as $td){
										$DueDetails = new SoapObject(NCCBIZ."DueDetails.php", "urn:Object");	
										
										$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
										$afsXml = $AFSDetails->getAfs($td->getAfsID());
										$afsDomDoc = domxml_open_mem($afsXml);
										$afs = new AFS;
										$afs->parseDomDocument($afsDomDoc);

										if (!$xmlStr = $DueDetails->getDueFromTdID($td->getTdID(),$value->getTaxableYear())){
											$totalTaxDue = "uncalculated";
											break;
										}
										else{
											if(!$domDoc = domxml_open_mem($xmlStr)) {
												$totalTaxDue = "uncalculated";
											}
											else {
												$due = new Due;
												$due->parseDomDocument($domDoc);
	
												$totalTaxDue += $due->getTaxDue();											
											}
										}									
									}
								}
								else{
									$totalTaxDue = "no TD's";
								}
								if(is_numeric($totalTaxDue)) $totalTaxDue = formatCurrency($totalTaxDue);
								

								$this->tpl->set_var("totalTaxDue", $totalTaxDue);

								$this->setRPTOPListBlockPerms();

								$this->tpl->parse("RPTOPListBlock", "RPTOPList", true);
								$this->tpl->set_var("PersonListBlock", "");
								$this->tpl->set_var("CompanyListBlock", "");
							}
						}
						else{
							$this->tpl->set_block("rptsTemplate", "RPTOPList", "RPTOPListBlock");
							$this->tpl->set_var("RPTOPListBlock", "huh");
						}
					}
				}						
			
			    break;
   			case "cancel":
				header("location: CalculateRPTOPBatch.php";
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
				
				$RPTOPList = new SoapObject(NCCBIZ."RPTOPList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				$this->tpl->set_block("rptsTemplate", "PagesList", "PagesListBlock");
				$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
				$this->tpl->set_var("NotFoundBlock", "");		
				if (!$count = $RPTOPList->getRPTOPCount()){
					$this->tpl->set_var("PagesBlock", "");
					$this->tpl->set_var("PagesListBlock", "");
					$this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
					$this->tpl->set_var("PageNavigatorBlock", "");
				}
				else{
					$numOfPages = ceil($count / PAGE_BY);

					// page list nav
					$this->formArray["pageLinksInLine"] = 7;
					if($this->formArray["page"] < round($this->formArray["pageLinksInLine"]/2)){
						$startPageLinks = 1;
					}
					else{
						$startPageLinks = $this->formArray["page"] - round($this->formArray["pageLinksInLine"]/2);
						if($startPageLinks<1) $startPageLinks = 1;
					}
					$endPageLinks = $startPageLinks + ($this->formArray["pageLinksInLine"]-1);
					if($endPageLinks > $numOfPages) $endPageLinks = $numOfPages;

					for($i=$startPageLinks ; $i<=$endPageLinks ; $i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("pageListPages","");
							$this->tpl->set_var("pageListPagesUrl", "");
							$this->tpl->set_var("pageListPaged",$i);
						}
						else{
							$this->tpl->set_var("pageListPages",$i);
							$this->tpl->set_var("pageListPagesUrl", $i);
							$this->tpl->set_var("pageListPaged","");
						}
						$this->tpl->parse("PagesListBlock", "PagesList", true);
					}

					// drop down nav
					for($i=1;$i<=$numOfPages;$i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("pages",$i);
							$this->tpl->set_var("pagesUrl", $i);
							$this->tpl->set_var("paged","selected");
						}
						else{
							$this->tpl->set_var("pages",$i);
							$this->tpl->set_var("pagesUrl", $i);
							$this->tpl->set_var("paged","");
						}
						$this->tpl->parse("PagesBlock", "Pages", true);
					}
				}
				if ($numOfPages == $this->formArray["page"]){
					$this->tpl->set_var("nextTxt", "");
				}
				else{
					$this->tpl->set_var("next", $this->formArray["page"]+1);
					$this->tpl->set_var("nextTxt", "next");
				}
				if ($this->formArray["page"] == 1){
					$this->tpl->set_var("previousTxt", "");
				}
				else {
					$this->tpl->set_var("previous", $this->formArray["page"]-1);
					$this->tpl->set_var("previousTxt", "previous");
				}
				if($numOfPages==""){
					$this->tpl->set_var("pageOf", "");
				}
				else{
					$this->tpl->set_var("pageOf", $this->formArray["page"]." of ".$numOfPages);
				}

				$condition = $this->sortBlocks();

				if (!$xmlStr = $RPTOPList->getRPTOPList($this->formArray["page"],$condition)){
					$this->tpl->set_block("rptsTemplate", "RPTOPTable", "RPTOPTableBlock");
					$this->tpl->set_var("RPTOPTableBlock", "");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "RPTOPListTable", "RPTOPListTableBlock");
						$this->tpl->set_var("RPTOPListTableBlock", "");
					}
					else {
						$rptopRecords = new RPTOPRecords;
						$rptopRecords->parseDomDocument($domDoc);
						$list = $rptopRecords->getArrayList();
						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "RPTOPDBEmpty", "RPTOPDBEmptyBlock");
							$this->tpl->set_var("RPTOPDBEmptyBlock", "");	
							$this->tpl->set_block("rptsTemplate", "RPTOPList", "RPTOPListBlock");
							$this->tpl->set_block("RPTOPList", "PersonList", "PersonListBlock");
							$this->tpl->set_block("RPTOPList", "CompanyList", "CompanyListBlock");
							foreach ($list as $key => $value){
								$this->tpl->set_var("rptopID", $value->getRptopID());
								$oValue = $value->owner;
								$pOwnerStr = "";
								if (count($oValue->personArray)){
									foreach($oValue->personArray as $pKey => $pValue){
										$this->tpl->set_var("personID",$pValue->getPersonID());
										$this->tpl->set_var("OwnerPerson",$pValue->getFullName());
										$this->tpl->parse("PersonListBlock", "PersonList", true);
									}
								}
								if (count($oValue->companyArray)){
									foreach($oValue->companyArray as $cKey => $cValue){
										$this->tpl->set_var("companyID",$cValue->getCompanyID());
										$this->tpl->set_var("OwnerCompany",$cValue->getCompanyName());
										$this->tpl->parse("CompanyListBlock", "CompanyList", true);
									}
								}
								if (count($oValue->personArray) || count($oValue->companyArray)){
									$this->tpl->set_var("none","");
								}
								else{
									$this->tpl->set_var("none","none");
								}
								$this->tpl->set_var("totalMarketValue", number_format($value->getTotalMarketValue(), 2, '.', ','));
								$this->tpl->set_var("totalAssessedValue", number_format($value->getTotalAssessedValue(), 2, '.', ','));

								$this->tpl->set_var("taxableYear", $value->getTaxableYear());
								
								// grab Dues of rptop to get totalTaxDue
								$totalTaxDue = 0.00;
								if(is_array($value->tdArray)){
									foreach($value->tdArray as $td){
										$DueDetails = new SoapObject(NCCBIZ."DueDetails.php", "urn:Object");
										
										$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
										$afsXml = $AFSDetails->getAfs($td->getAfsID());
										$afsDomDoc = domxml_open_mem($afsXml);
										$afs = new AFS;
										$afs->parseDomDocument($afsDomDoc);

										if (!$xmlStr = $DueDetails->getDueFromTdID($td->getTdID(),$value->getTaxableYear())){
											$totalTaxDue = "uncalculated";
											break;
										}
										else{
											if(!$domDoc = domxml_open_mem($xmlStr)) {
												$totalTaxDue = "uncalculated";
											}
											else {
												$due = new Due;
												$due->parseDomDocument($domDoc);
	
												$totalTaxDue += $due->getTaxDue();											
											}
										}									
									}
								}
								else{
									$totalTaxDue = "no TD's";
								}
								if(is_numeric($totalTaxDue)) $totalTaxDue = formatCurrency($totalTaxDue);
								
								$this->tpl->set_var("totalTaxDue", $totalTaxDue);

								$this->setRPTOPListBlockPerms();

								$this->tpl->parse("RPTOPListBlock", "RPTOPList", true);
								$this->tpl->set_var("PersonListBlock", "");
								$this->tpl->set_var("CompanyListBlock", "");
							}
						}
						else{
							$this->tpl->set_block("rptsTemplate", "RPTOPList", "RPTOPListBlock");
							$this->tpl->set_var("RPTOPListBlock", "huh");
						}
					}
				}			
		}
		
		$this->setForm();
		$this->setPageDetailPerms();

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

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
page_open(array("sess" => "rpts_Session"
	,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
if(!$page) $page = 1;
$calculateRPTOPBatch = new CalculateRPTOPBatch($HTTP_POST_VARS,$sess,$rptopID,$page,$searchKey,$formAction,$sortBy,$sortOrder);
$calculateRPTOPBatch->Main();
?>
<?php page_close(); ?>
