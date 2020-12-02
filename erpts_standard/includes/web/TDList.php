<?php
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/TDRecords.php";

include_once "../assessor/Company.php";
include_once "../assessor/CompanyRecords.php";
include_once "../assessor/Person.php";
include_once "../assessor/PersonRecords.php";
include_once "../assessor/Owner.php";
include_once "../assessor/OwnerRecords.php";
include_once "../assessor/OD.php";
include_once "../assessor/ODRecords.php";
include_once "../assessor/AFS.php";
include_once "../assessor/AFSRecords.php";

#####################################
# Define Interface Class
#####################################
class TDList{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function TDList($http_post_vars,$sess,$tdID,$page,$searchKey,$formAction,$sortBy,$sortOrder,$propertyType){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must have atleast AM-VIEW access
		$pageType = "%%1%%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}	

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "TDList.htm") ;
		$this->tpl->set_var("TITLE", "TD List");
		
		$this->formArray["tdID"] = $tdID;
		$this->formArray["page"] = $page;
		$this->formArray["searchKey"] = $searchKey;
		$this->formArray["formAction"] = $formAction;
		$this->formArray["propertyType"] = $propertyType;

		$this->formArray["sortBy"] = $sortBy;
		$this->formArray["sortOrder"] = $sortOrder;
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function displayEffectivity($afsID){
		$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
		if (!$xmlStr = $AFSDetails->getAFS($afsID)){
			$this->tpl->set_var("effectivity", "");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_var("effectivity", "");
			}
			else {
				$afs = new AFS;
				$afs->parseDomDocument($domDoc);
				$this->tpl->set_var("effectivity", $afs->getEffectivity());
			}
		}
	}

	function displayOwnerList($domDoc){
		$ownerRecords = new OwnerRecords;
		$ownerRecords->parseDomDocument($domDoc);
		$list = $ownerRecords->getArrayList();

		foreach ($list as $key => $value){

			if (count($value->personArray)){
				$p=0;
				foreach($value->personArray as $pKey => $pValue){
					$p++;

					if($p==1){
						$this->tpl->set_var("PersonListBlock", "");
					}

					$this->tpl->set_var("personID",$pValue->getPersonID());
					$this->tpl->set_var("OwnerPerson",$pValue->getFullName());

					$this->tpl->parse("PersonListBlock", "PersonList", true);
				}
				$this->tpl->set_var("none","");
			}
			else{
				if(!count($value->companyArray))
					$this->tpl->set_var("none","none");
				$this->tpl->set_var("PersonListBlock", "");
			}


			if (count($value->companyArray)){
				$c=0;
				foreach($value->companyArray as $cKey => $cValue){
					$c++;

					if($c==1){
						$this->tpl->set_var("CompanyListBlock", "");
					}

					$this->tpl->set_var("companyID",$cValue->getCompanyID());
					$this->tpl->set_var("OwnerCompany",$cValue->getCompanyName());
					$this->tpl->parse("CompanyListBlock", "CompanyList", true);
				}

				$this->tpl->set_var("none","");
			}
			else{
				if(!count($value->personArray))
					$this->tpl->set_var("none","none");
				$this->tpl->set_var("CompanyListBlock", "");
			}

		}

	}

	function displayOwner($afsID){

		$AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
		$this->formArray["odID"] = $AFSEncode->getOdID($afsID);

		$ODEncode = new SoapObject(NCCBIZ."ODEncode.php", "urn:Object");
		$this->formArray["ownerID"] = $ODEncode->getOwnerID($this->formArray["odID"]);

		$this->tpl->set_var("ownerID", $this->formArray["ownerID"]);
		$this->tpl->set_var("odID", $this->formArray["odID"]);


		$OwnerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");
		if (!$xmlStr = $OwnerList->getOwnerList($this->formArray["ownerID"])){
			//exit(print_r($OwnerList));
			$this->tpl->set_var("PersonListBlock","");
			$this->tpl->set_var("CompanyListBlock","");
			$this->tpl->set_var("none","none");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_var("PersonListBlock","");
				$this->tpl->set_var("CompanyListBlock","");
				$this->tpl->set_var("none","none");
			}
			else {
				$this->displayOwnerList($domDoc);
			}
		}
	}

	function sortBlocks(){
		$this->sortBlockFields = array(
			  "tdID" => "TDID"
			, "person" => "Person"
			, "company" => "Company"
			, "taxDeclarationNumber" => "TaxDeclarationNumber"
			, "propertyType" => "PropertyType"
			, "year" => "Year"
		);

		foreach($this->sortBlockFields as $tempVar=>$TempVar){
			$this->tpl->set_block("rptsTemplate", "Ascending".$TempVar, "Ascending".$TempVar."Block");
			$this->tpl->set_block("rptsTemplate", "Descending".$TempVar, "Descending".$TempVar."Block");

			$this->formArray[$tempVar."SortOrder"] = "ASC";

			switch($this->formArray["sortBy"]){
				case $tempVar:
					switch($this->formArray["sortOrder"]){
						case "ASC":
							$this->formArray[$tempVar."SortOrder"] = "DESC";
							$this->tpl->parse("Ascending".$TempVar."Block", "Ascending".$TempVar, true);
							$this->tpl->set_var("Descending".$TempVar."Block", "");
							break;
						case "DESC":
							$this->formArray[$tempVar."SortOrder"] = "ASC";
							$this->tpl->parse("Descending".$TempVar."Block", "Descending".$TempVar, true);
							$this->tpl->set_var("Ascending".$TempVar."Block", "");
							break;
						default:
							$this->formArray["sortOrder"] = "DESC";
							$this->tpl->parse("Descending".$TempVar."Block", "Descending".$TempVar, true);
							$this->tpl->set_var("Ascending".$TempVar."Block", "");
							break;
					}

					foreach($this->sortBlockFields as $key => $value){
						if($key!=$tempVar){
							$this->tpl->set_var("Ascending".$value."Block", "");
							$this->tpl->set_var("Descending".$value."Block", "");
						}
					}
				break;
			}
		}

		switch($this->formArray["sortBy"]){
			case "tdID":
				$condition = " ORDER BY ".TD_TABLE.".tdID ".$this->formArray["sortOrder"];
				break;
			case "person":
				$condition = " ORDER BY PersonFullName ".$this->formArray["sortOrder"];
				break;
			case "company":
				$condition = " ORDER BY ".COMPANY_TABLE.".companyName ".$this->formArray["sortOrder"];
				break;
			case "taxDeclarationNumber":
				$condition = " ORDER BY ".TD_TABLE.".taxDeclarationNumber ".$this->formArray["sortOrder"];
				break;
			case "year":
				$condition = " ORDER BY ".AFS_TABLE.".effectivity ".$this->formArray["sortOrder"];
				break;
			case "propertyType":
				$condition = " ORDER BY ".TD_TABLE.".propertyType ".$this->formArray["sortOrder"];
				break;
			default:
				$this->formArray["sortBy"] = "tdID";
				$this->formArray["sortOrder"] = "DESC";
				foreach($this->sortBlockFields as $key=>$value){
					if($key!=$this->formArray["sortBy"]){
						$this->tpl->set_var("Ascending".$value."Block", "");
						$this->tpl->set_var("Descending".$value."Block", "");
					}
					else{
						$this->tpl->set_var("Ascending".$value."Block", "");
						$this->tpl->parse("Descending".$value."Block", "Descending".$value, true);
					}
				}
				$condition = " ORDER BY ".TD_TABLE.".tdID DESC";
				break;
		}
		$condition = "GROUP BY ".TD_TABLE.".tdID ".$condition;
		return $condition;
	}

	function filterArchives(){
		$condition = " WHERE ".TD_TABLE.".archive <> 'true' ";
		return $condition;
	}
	
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
		if(!checkPerms($this->user["userType"],"%1%%%%%%%%")){
			// hide Blocks if userType is not at least AM-Edit

		}
		else{

		}
	}

	function setTDListBlockPerms(){
		if(!checkPerms($this->user["userType"],"%1%%%%%%%%")){
			$this->tpl->set_var("ownerViewAccess","viewOnly");
			$this->tpl->set_var("afsDetailsLinkLabel", "View");
		}
		else{
			$this->tpl->set_var("ownerViewAccess","view");
			$this->tpl->set_var("afsDetailsLinkLabel", "Edit");
		}
	}

	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "filterPropertyType":
				$this->tpl->set_var("msg", "");
				$TDList = new SoapObject(NCCBIZ."TDList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				$this->tpl->set_block("rptsTemplate", "PagesList", "PagesListBlock");

				$condition = $this->filterArchives();

				$searchKey = $this->formArray["propertyType"];

				if (!$count = $TDList->filterPropertyTypeCount($this->formArray["propertyType"],$condition)){
					$this->tpl->set_var("PagesBlock", "");
					$this->tpl->set_var("PagesListBlock", "");
					$numOfPages = 1;
					$this->tpl->set_block("rptsTemplate", "PageNavigator", "PagesBlock");
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
							$this->tpl->set_var("pageListPagesUrl", $i . "&formAction=filterPropertyType&propertyType=" . urlencode($this->formArray["propertyType"]));
							$this->tpl->set_var("pageListPaged","");
						}
						$this->tpl->parse("PagesListBlock", "PagesList", true);
					}

					// drop down nav
					for($i=1;$i<=$numOfPages;$i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("pages",$i);
							$this->tpl->set_var("pagesUrl", $i . "&formAction=filterPropertyType&propertyType=" . urlencode($this->formArray["propertyType"]));
							$this->tpl->set_var("paged","selected");
						}
						else{
							$this->tpl->set_var("pages",$i);
							$this->tpl->set_var("pagesUrl", $i . "&formAction=filterPropertyType&propertyType=" . urlencode($this->formArray["propertyType"]));
							$this->tpl->set_var("paged","");
						}
						$this->tpl->parse("PagesBlock", "Pages", true);
					}
				}
				if ($numOfPages == $this->formArray["page"]){
					$this->tpl->set_var("nextTxt", "");
				}
				else{
					$this->tpl->set_var("next", $this->formArray["page"]+1 . "&formAction=filterPropertyType&propertyType=" . urlencode($this->formArray["propertyType"]));
					$this->tpl->set_var("nextTxt", "next");
				}
				if ($this->formArray["page"] == 1){
					$this->tpl->set_var("previousTxt", "");
				}
				else {
					$this->tpl->set_var("previous", $this->formArray["page"]-1 . "&formAction=filterPropertyType&propertyType=" . urlencode($this->formArray["propertyType"]));
					$this->tpl->set_var("previousTxt", "previous");
				}
				$this->tpl->set_var("pageOf", $this->formArray["page"]." of ".$numOfPages);

				$condition = $this->filterArchives();
				$condition.= $this->sortBlocks();

				if (!$xmlStr = $TDList->filterByPropertyType($this->formArray["page"],$this->formArray["propertyType"],$condition)){
                    $this->tpl->set_var("pageOf", "");
                    $this->tpl->set_block("rptsTemplate", "TDTable", "TDTableBlock");
                    $this->tpl->set_var("TDTableBlock", "");
                    $this->tpl->set_block("rptsTemplate", "TDDBEmpty", "TDDBEmptyBlock");
                    $this->tpl->set_var("TDDBEmptyBlock", "");
                    $this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
                    $this->tpl->set_var("PagesBlock", "");
                    $this->tpl->set_var("PagesListBlock", "");
                    $this->tpl->set_var("previousTxt", "");
                    $this->tpl->set_var("nextTxt", "");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "TDListTable", "TDListTableBlock");
						$this->tpl->set_var("TDListTableBlock", "error xmlDoc");
					}
					else {
					    $this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
					    $this->tpl->set_var("NotFoundBlock", "");
						$tdRecords = new TDRecords;
						$tdRecords->parseDomDocument($domDoc);
						$list = $tdRecords->getArrayList();
						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "TDDBEmpty", "TDDBEmptyBlock");
							$this->tpl->set_var("TDDBEmptyBlock", "");	
							$this->tpl->set_block("rptsTemplate", "TDList", "TDListBlock");
							$this->tpl->set_block("TDList", "PersonList", "PersonListBlock");
							$this->tpl->set_block("TDList", "CompanyList", "CompanyListBlock");
							foreach ($list as $key => $value){
								$this->tpl->set_var("tdID", $value->getTdID());
								$this->tpl->set_var("afsID", $value->getAfsID());
								$this->tpl->set_var("propertyID", $value->getPropertyID());
								$this->tpl->set_var("propertyType", $value->getPropertyType());
								$this->tpl->set_var("taxDeclarationNumber", $value->getTaxDeclarationNumber());
								$this->tpl->set_var("taxBeginsWithTheYear", $value->getTaxBeginsWithTheYear());

								if($value->getCeasesWithTheYear()==""){
									$this->tpl->set_var("ceasesWithTheYear", "");
								}
								else{
									$this->tpl->set_var("ceasesWithTheYear", " - ".$value->getCeasesWithTheYear());
								}

								$this->displayOwner($value->getAfsID());
								$this->displayEffectivity($value->getAfsID());

								$this->setTDListBlockPerms();
								$this->tpl->parse("TDListBlock", "TDList", true);
							}
						}
						else{
							$this->tpl->set_block("rptsTemplate", "TDList", "TDListBlock");
							$this->tpl->set_var("TDListBlock", "huh");
						}
					}
				}
				break;
            case "search":
				$this->tpl->set_var("msg", "");
				$TDList = new SoapObject(NCCBIZ."TDList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				$this->tpl->set_block("rptsTemplate", "PagesList", "PagesListBlock");

				$condition = $this->filterArchives();

				if (!$count = $TDList->getSearchCount($this->formArray["searchKey"],$condition)){
					$this->tpl->set_var("PagesBlock", "");
                    $this->tpl->set_var("PagesListBlock", "");
					$numOfPages = 1;
					$this->tpl->set_block("rptsTemplate", "PageNavigator", "PagesBlock");
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

				$condition = $this->filterArchives();
				$condition.= $this->sortBlocks();

				if (!$xmlStr = $TDList->searchTD($this->formArray["page"],$this->formArray["searchKey"],$condition)){
                    $this->tpl->set_var("pageOf", "");
                    $this->tpl->set_block("rptsTemplate", "TDTable", "TDTableBlock");
                    $this->tpl->set_var("TDTableBlock", "");
                    $this->tpl->set_block("rptsTemplate", "TDDBEmpty", "TDDBEmptyBlock");
                    $this->tpl->set_var("TDDBEmptyBlock", "");
                    $this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
                    $this->tpl->set_var("PagesBlock", "");
                    $this->tpl->set_var("PagesListBlock", "");
                    $this->tpl->set_var("previousTxt", "");
                    $this->tpl->set_var("nextTxt", "");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "TDListTable", "TDListTableBlock");
						$this->tpl->set_var("TDListTableBlock", "error xmlDoc");
					}
					else {
					    $this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
					    $this->tpl->set_var("NotFoundBlock", "");
						$tdRecords = new TDRecords;
						$tdRecords->parseDomDocument($domDoc);
						$list = $tdRecords->getArrayList();
						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "TDDBEmpty", "TDDBEmptyBlock");
							$this->tpl->set_var("TDDBEmptyBlock", "");	
							$this->tpl->set_block("rptsTemplate", "TDList", "TDListBlock");
							$this->tpl->set_block("TDList", "PersonList", "PersonListBlock");
							$this->tpl->set_block("TDList", "CompanyList", "CompanyListBlock");
							foreach ($list as $key => $value){
								$this->tpl->set_var("tdID", $value->getTdID());
								$this->tpl->set_var("afsID", $value->getAfsID());
								$this->tpl->set_var("propertyID", $value->getPropertyID());
								$this->tpl->set_var("propertyType", $value->getPropertyType());
								$this->tpl->set_var("taxDeclarationNumber", $value->getTaxDeclarationNumber());
								$this->tpl->set_var("taxBeginsWithTheYear", $value->getTaxBeginsWithTheYear());

								if($value->getCeasesWithTheYear()==""){
									$this->tpl->set_var("ceasesWithTheYear", "");
								}
								else{
									$this->tpl->set_var("ceasesWithTheYear", " - ".$value->getCeasesWithTheYear());
								}

								$this->displayOwner($value->getAfsID());
								$this->displayEffectivity($value->getAfsID());

								$this->setTDListBlockPerms();
								$this->tpl->parse("TDListBlock", "TDList", true);
							}
						}
						else{
							$this->tpl->set_block("rptsTemplate", "TDList", "TDListBlock");
							$this->tpl->set_var("TDListBlock", "huh");
						}
					}
				}
				break;
			default:
				$this->tpl->set_var("msg", "");
				$TDList = new SoapObject(NCCBIZ."TDList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				$this->tpl->set_block("rptsTemplate", "PagesList", "PagesListBlock");
                $this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
                $this->tpl->set_var("NotFoundBlock", "");

				$condition = $this->filterArchives();
				if (!$count = $TDList->getTDCount($condition)){
					$this->tpl->set_var("PagesBlock", "");
                    $this->tpl->set_var("PagesListBlock", "");
					$this->tpl->set_block("rptsTemplate", "PageNavigator", "PagesBlock");
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
							$this->tpl->set_var("pageListPagesUrl",$i);
							$this->tpl->set_var("pageListPaged","");
						}
						$this->tpl->parse("PagesListBlock", "PagesList", true);
					}

					// drop down nav
					for($i=1;$i<=$numOfPages;$i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("pages",$i);
							$this->tpl->set_var("pagesUrl",$i);
							$this->tpl->set_var("paged","selected");
						}
						else{
							$this->tpl->set_var("pages",$i);
						    $this->tpl->set_var("pagesUrl",$i);	
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

				$condition = $this->filterArchives();
				$condition.= $this->sortBlocks();

				if (!$xmlStr = $TDList->getTDListForList($this->formArray["page"],$condition)){
					$this->tpl->set_block("rptsTemplate", "TDTable", "TDTableBlock");
					$this->tpl->set_var("TDTableBlock", "");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "TDListTable", "TDListTableBlock");
						$this->tpl->set_var("TDListTableBlock", "");
					}
					else {
						$tdRecords = new TDRecords;
						$tdRecords->parseDomDocument($domDoc);
						$list = $tdRecords->getArrayList();
						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "TDDBEmpty", "TDDBEmptyBlock");
							$this->tpl->set_var("TDDBEmptyBlock", "");	
							$this->tpl->set_block("rptsTemplate", "TDList", "TDListBlock");
							$this->tpl->set_block("TDList", "PersonList", "PersonListBlock");
							$this->tpl->set_block("TDList", "CompanyList", "CompanyListBlock");
							foreach ($list as $key => $value){
								$this->tpl->set_var("tdID", $value->getTdID());
								$this->tpl->set_var("afsID", $value->getAfsID());
								$this->tpl->set_var("propertyID", $value->getPropertyID());
								$this->tpl->set_var("propertyType", $value->getPropertyType());
								$this->tpl->set_var("taxDeclarationNumber", $value->getTaxDeclarationNumber());
								$this->tpl->set_var("taxBeginsWithTheYear", $value->getTaxBeginsWithTheYear());

								if($value->getCeasesWithTheYear()==""){
									$this->tpl->set_var("ceasesWithTheYear", "");
								}
								else{
									$this->tpl->set_var("ceasesWithTheYear", " - ".$value->getCeasesWithTheYear());
								}

								$this->displayOwner($value->getAfsID());
								$this->displayEffectivity($value->getAfsID());

								$this->setTDListBlockPerms();								
								$this->tpl->parse("TDListBlock", "TDList", true);
							}
						}
						else{
							$this->tpl->set_block("rptsTemplate", "TDList", "TDListBlock");
							$this->tpl->set_var("TDListBlock", "huh");
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
	//global $auth;
	//print_r($auth);
		
if(!$page) $page = 1;
$tdList = new TDList($HTTP_POST_VARS,$sess,$tdID,$page,$searchKey,$formAction,$sortBy,$sortOrder,$propertyType);
$tdList->main();
?>
<?php page_close(); ?>
