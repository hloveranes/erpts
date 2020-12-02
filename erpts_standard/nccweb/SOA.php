<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/RPTOPRecords.php";

include_once "../includes/collection/Due.php";



#####################################
# Define Interface Class
#####################################
class SOA{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function SOA($http_post_vars,$sess,$rptopID,$page,$searchKey,$formAction,$sortBy,$sortOrder){
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

		$this->tpl->set_file("rptsTemplate", "SOA.htm") ;
		$this->tpl->set_var("TITLE", "View Statement of Accounts");
		
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
			
			    break;
   			case "cancel":
				header("location: CalculateRPTOP.php";
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
				if(strstr($condition,"ORDER BY")){
					$condition.= ", ".RPTOP_TABLE.".taxableYear DESC";
				}
				else{
					$condition = " ORDER BY ".RPTOP_TABLE.".taxableYear DESC";
				}

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
$soa = new SOA($HTTP_POST_VARS,$sess,$rptopID,$page,$searchKey,$formAction,$sortBy,$sortOrder);
$soa->Main();
?>
<?php page_close(); ?>
