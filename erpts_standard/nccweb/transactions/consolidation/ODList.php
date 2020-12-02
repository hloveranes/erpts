<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/LocationAddress.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/OD.php";
include_once "../includes/assessor/ODRecords.php";

include_once "../includes/assessor/TD.php";

include_once "../includes/assessor/User.php";

include_once "../includes/assessor/Barangay.php";
include_once "../includes/assessor/BarangayRecords.php";

#####################################
# Define Interface Class
#####################################
class ODList{
	
	var $tpl;
	var $formArray;
	var $sess;

	function ODList($http_post_vars,$sess,$odID,$page,$searchKey,$barangay,$formAction,$sortBy,$sortOrder,$viewArchives,$transactionCode="",$mergeBasketCSV){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must have atleast AM-EDIT access
		$pageType = "%1%%%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ODList.htm") ;
		$this->tpl->set_var("TITLE", "Consolidation > RPU List");
		
		$this->sess = $sess;
		$this->formArray["odID"] = $odID;

		$this->formArray["page"] = $page;
		$this->formArray["searchKey"] = $searchKey;
		$this->formArray["barangay"] = $barangay;
		$this->formArray["sortBy"] = $sortBy;
		$this->formArray["sortOrder"] = $sortOrder;
		$this->formArray["viewArchives"] = $viewArchives;

		$this->formArray["transactionCode"] = $transactionCode;

		$this->formArray["formAction"] = $formAction;

		$this->formArray["mergeBasketCSV"] = $mergeBasketCSV;

		$this->formArray["viewArchivesTitle"] = "";
		$this->formArray["archiveValue"] = "";
		$this->formArray["odIDArray"] = "";
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function getPropertyTypeFromOD($od){
		$AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
		$TDDetails = new SoapObject(NCCBIZ."TDDetails.php", "urn:Object");

		if($afsID = $AFSEncode->getAfsID($od->getOdID())){
			if($xmlStr = $TDDetails->getTDFromAfsID($afsID)){
				$td = new TD;
				if($domDoc = domxml_open_mem($xmlStr)){
					$td->parseDomDocument($domDoc);
					return $td->getPropertyType();
				}
			}
		}
		return false;
	}

	function sortBlocks(){
		$this->sortBlockFields = array(
			  "odID" => "ODID"
			, "person" => "Person"
			, "company" => "Company"
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
			case "odID":
				$condition = " ORDER BY ".OD_TABLE.".odID ".$this->formArray["sortOrder"];
				break;
			case "person":
				$condition = " ORDER BY PersonFullName ".$this->formArray["sortOrder"];
				break;
			case "company":
				$condition = " ORDER BY ".COMPANY_TABLE.".companyName ".$this->formArray["sortOrder"];
				break;
			default:
				$this->formArray["sortBy"] = "odID";
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

				$condition = " ORDER BY ".OD_TABLE.".odID DESC";
				break;
		}

		return $condition;
	}

	function filterArchives(){
		$condition = " WHERE ".OD_TABLE.".archive <> 'true' ";
		$condition.= " GROUP BY ".OD_TABLE.".odID "; 
		return $condition;
	}

	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
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

	function initBarangayList(){
		$this->tpl->set_block("rptsTemplate", "BarangayList", "BarangayListBlock");
	    $BarangayList = new SoapObject(NCCBIZ."BarangayList.php", "urn:Object");
		if (!$xmlStr = $BarangayList->getBarangayList(0, " WHERE ".BARANGAY_TABLE.".status='active' ORDER BY description")){
		   $this->tpl->set_var("barangayID", "");
           $this->tpl->set_var("barangay", "empty barangay list");
		   $this->tpl->parse("BarangayListBlock", "BarangayList", true);
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
			   $this->tpl->set_var("barangayID", "");
	           $this->tpl->set_var("barangay", "empty barangay list");
			   $this->tpl->parse("BarangayListBlock", "BarangayList", true);
			}
			else{
				$barangayRecords = new BarangayRecords;
				$barangayRecords->parseDomDocument($domDoc);
				if(is_array($barangayRecords->arrayList)){
					foreach ($barangayRecords->arrayList as $key => $value){
	          			$this->tpl->set_var("barangayID", $value->getBarangayID());
	               		$this->tpl->set_var("barangay", $value->getDescription());
						$this->initSelected("barangay",$value->getDescription());
				        $this->tpl->parse("BarangayListBlock", "BarangayList", true);
					}
				}
			}
		}
	}

	function addToMerger(){
		$odIDArray = $this->formArray["odIDArray"];

		if(is_array($this->formArray["mergeBasketArray"])){
			$this->formArray["mergeBasketArray"] = array_merge($this->formArray["mergeBasketArray"],$odIDArray);
		}
		else{
			$this->formArray["mergeBasketArray"] = $odIDArray;
		}

		$this->formArray["mergeBasketCSV"] = implode(",",$this->formArray["mergeBasketArray"]);

		$odListQueryArray = explode("&",$this->formArray["ODListQuery"]);
		if(is_array($odListQueryArray)){
			foreach($odListQueryArray as $query){
				$queryArray = explode("=",$query);
				$name = $queryArray[0];
				$value = urldecode($queryArray[1]);
				$this->formArray[$name] = $value;
			}
		}
	}

	function mergeBasketMain(){
		if($this->formArray["mergeBasketCSV"]!=""){
			$this->formArray["mergeBasketArray"] = explode(",",$this->formArray["mergeBasketCSV"]);
		}

		if($this->formArray["formAction"]=="addToMerger"){
			$this->addToMerger();
		}

		if(!is_array($this->formArray["mergeBasketArray"])){
			$this->formArray["totalInMergeBasket"] = "";
			$this->formArray["mergeBasketCSV"] = "";
			$this->tpl->set_block("rptsTemplate", "MergeBasket", "MergeBasketBlock");
			$this->tpl->set_var("MergeBasketBlock", "");
		}
		else{
			$this->formArray["totalInMergeBasket"] = count($this->formArray["mergeBasketArray"]);
		}
	}

	function Main(){
		$this->mergeBasketMain();

		switch ($this->formArray["formAction"]){
			case "delete":
				//print_r($this->formArray);
				if (count($this->formArray["odID"]) > 0) {
					$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");
					if (!$deletedRows = $ODList->deleteOD($this->formArray["odID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				break;
			case "consolidate":
				$odIDArray = $this->formArray["mergeBasketArray"];

				$RPUEncode = new SoapObject(NCCBIZ."RPUEncode.php", "urn:Object");
				$newOdID = $RPUEncode->ConsolidateRPU($odIDArray, $this->formArray["transactionCode"]);

				$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");

				$archiveValue = "true";
				$userID = $this->formArray["uid"];

				if(!$archiveRows = $ODList->archiveOD($odIDArray,$archiveValue,$userID)){
						// archive failed
				}
				else{
						// archive succeeded
				}

				$sess = $this->sess->name."=".$this->sess->id;
				header("Location: ODDetails.php?".$sess."&odID=".$newOdID);
				exit;

				break;
			case "archive":
				$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");

				$odIDArray = $this->formArray["odIDArray"];
				$archiveValue = $this->formArray["archiveValue"];
				$userID = $this->formArray["uid"];

				if(!$archiveRows = $ODList->archiveOD($odIDArray,$archiveValue,$userID)){
						$this->tpl->set_var("msg", "SOAP failed");
				}
				else{
					$sess = $this->sess->name."=".$this->sess->id;
					header("Location: ODList.php?".$sess."&viewArchives=".$this->formArray["viewArchives"]);
					exit;
				}
				break;
			case "filterBarangay":
				$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				$this->tpl->set_block("rptsTemplate", "PagesList", "PagesListBlock");

				$condition = $this->filterArchives();

				if (!$count = $ODList->filterByBarangayCount($this->formArray["barangay"],$condition)){
					$this->tpl->set_var("PagesBlock", "");
					$this->tpl->set_var("PagesListBlock", "");
	                $this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
					$this->tpl->set_var("PageNavigatorBlock","");
					$numOfPages = 1;
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
							$this->tpl->set_var("pageListPagesUrl", $i . "&formAction=filterBarangay&barangay=" . urlencode($this->formArray["barangay"]));
							$this->tpl->set_var("pageListPaged","");
						}
						$this->tpl->parse("PagesListBlock", "PagesList", true);
					}

					// drop down nav
					for($i=1;$i<=$numOfPages;$i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("pages",$i);
							$this->tpl->set_var("pagesUrl", $i . "&formAction=filterBarangay&barangay=" . urlencode($this->formArray["barangay"]));
							$this->tpl->set_var("paged","selected");
						}
						else{
							$this->tpl->set_var("pages",$i);
							$this->tpl->set_var("pagesUrl", $i . "&formAction=filterBarangay&barangay=" . urlencode($this->formArray["barangay"]));
							$this->tpl->set_var("paged","");
						}
						$this->tpl->parse("PagesBlock", "Pages", true);
					}
				}
				if ($numOfPages == $this->formArray["page"]){
					$this->tpl->set_var("nextTxt", "");
				}
				else{
					$this->tpl->set_var("next", $this->formArray["page"]+1 . "&formAction=filterBarangay&barangay=" . urlencode($this->formArray["barangay"]));
					$this->tpl->set_var("nextTxt", "next");
				}
				if ($this->formArray["page"] == 1){
					$this->tpl->set_var("previousTxt", "");
				}
				else {
					$this->tpl->set_var("previous", $this->formArray["page"]-1 . "&formAction=filterBarangay&barangay=" . urlencode($this->formArray["barangay"]));
					$this->tpl->set_var("previousTxt", "previous");
				}

				$condition = $this->filterArchives();
				$condition.= $this->sortBlocks();

				$this->tpl->set_var("pageOf", $this->formArray["page"]." of ".$numOfPages);
				if (!$xmlStr = $ODList->filterByBarangay($this->formArray["page"],$this->formArray["barangay"],$condition)){
                    $this->tpl->set_var("pageOf", "");
                    $this->tpl->set_block("rptsTemplate", "ODTable", "ODTableBlock");
                    $this->tpl->set_var("ODTableBlock", "");
                    $this->tpl->set_block("rptsTemplate", "ODDBEmpty", "ODDBEmptyBlock");
                    $this->tpl->set_var("ODDBEmptyBlock", "");
                    $this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
                    $this->tpl->set_var("PagesBlock", "");
					$this->tpl->set_var("PagesListBlock", "");
                    $this->tpl->set_var("previousTxt", "");
                    $this->tpl->set_var("nextTxt", "");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "ODListTable", "ODListTableBlock");
						$this->tpl->set_var("ODListTableBlock", "error xmlDoc");
					}
					else {
                        $this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
                        $this->tpl->set_var("NotFoundBlock", "");
						$odRecords = new ODRecords;
						$odRecords->parseDomDocument($domDoc);
						$list = $odRecords->getArrayList();
						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "ODDBEmpty", "ODDBEmptyBlock");
							$this->tpl->set_var("ODDBEmptyBlock", "");	
							$this->tpl->set_block("rptsTemplate", "ODList", "ODListBlock");
							$this->tpl->set_block("ODList", "PersonList", "PersonListBlock");
							$this->tpl->set_block("ODList", "CompanyList", "CompanyListBlock");
							foreach ($list as $key => $value){
								$this->tpl->set_var("odID", $value->getOdID());

								$propertyType = $this->getPropertyTypeFromOD($value);
								if($propertyType!="Land"){
									$this->tpl->set_var("checkbox_status", "disabled");
									$this->tpl->set_var("checkbox_style", "style='display:none;'");
								}
								else{
									$this->tpl->set_var("checkbox_status", "");
									$this->tpl->set_var("checkbox_style", "");
									if(is_array($this->formArray["mergeBasketArray"])){
										if(in_array($value->getOdID(),$this->formArray["mergeBasketArray"])){
											$this->tpl->set_var("checkbox_status", "checked disabled");
										}
									}
								}

								switch($propertyType){
									case "Land":
										$this->tpl->set_var("propertyType", "L/P");
										break;
									case "ImprovementsBuildings":
										$this->tpl->set_var("propertyType", "I/B");
										break;
									case "Machineries":
										$this->tpl->set_var("propertyType", "M");
										break;
									default:
										$this->tpl->set_var("propertyType", "-");
										break;
								}

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
								//*/
								//echo method_exists($value->location,getFullAddress);
								$this->tpl->set_var("locationAddress", $value->locationAddress->getFullAddress());
								$this->tpl->set_var("landArea", number_format($value->getLandArea(), 2, '.', ','));

								$this->tpl->parse("ODListBlock", "ODList", true);
								$this->tpl->set_var("PersonListBlock", "");
								$this->tpl->set_var("CompanyListBlock", "");
							}
						}
						else{
							$this->tpl->set_block("rptsTemplate", "ODList", "ODListBlock");
							$this->tpl->set_var("ODListBlock", "huh");
						}
					}
				}
				break;
            case "search":
				$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				$this->tpl->set_block("rptsTemplate", "PagesList", "PagesListBlock");

				$condition = $this->filterArchives();

				if (!$count = $ODList->getSearchCount($this->formArray["searchKey"],$condition)){
					$this->tpl->set_var("PagesBlock", "");
					$this->tpl->set_var("PagesListBlock", "");
	                $this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
					$this->tpl->set_var("PageNavigatorBlock","");
					$numOfPages = 1;
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

				$condition = $this->filterArchives();
				$condition.= $this->sortBlocks();

				$this->tpl->set_var("pageOf", $this->formArray["page"]." of ".$numOfPages);
				if (!$xmlStr = $ODList->searchOD($this->formArray["page"],$this->formArray["searchKey"],$condition)){
                    $this->tpl->set_var("pageOf", "");
                    $this->tpl->set_block("rptsTemplate", "ODTable", "ODTableBlock");
                    $this->tpl->set_var("ODTableBlock", "");
                    $this->tpl->set_block("rptsTemplate", "ODDBEmpty", "ODDBEmptyBlock");
                    $this->tpl->set_var("ODDBEmptyBlock", "");
                    $this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
                    $this->tpl->set_var("PagesBlock", "");
					$this->tpl->set_var("PagesListBlock", "");
                    $this->tpl->set_var("previousTxt", "");
                    $this->tpl->set_var("nextTxt", "");

					$this->tpl->set_block("rptsTemplate", "ArchiveButton", "ArchiveButtonBlock");
					$this->tpl->set_var("ArchiveButtonBlock", "");
					$this->tpl->set_block("rptsTemplate", "UnArchiveButton", "UnArchiveButtonBlock");
					$this->tpl->set_var("UnArchiveButtonBlock", "");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "ODListTable", "ODListTableBlock");
						$this->tpl->set_var("ODListTableBlock", "error xmlDoc");
					}
					else {
                        $this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
                        $this->tpl->set_var("NotFoundBlock", "");
						$odRecords = new ODRecords;
						$odRecords->parseDomDocument($domDoc);
						$list = $odRecords->getArrayList();
						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "ODDBEmpty", "ODDBEmptyBlock");
							$this->tpl->set_var("ODDBEmptyBlock", "");	
							$this->tpl->set_block("rptsTemplate", "ODList", "ODListBlock");
							$this->tpl->set_block("ODList", "PersonList", "PersonListBlock");
							$this->tpl->set_block("ODList", "CompanyList", "CompanyListBlock");
							foreach ($list as $key => $value){
								$this->tpl->set_var("odID", $value->getOdID());

								$propertyType = $this->getPropertyTypeFromOD($value);
								if($propertyType!="Land"){
									$this->tpl->set_var("checkbox_status", "disabled");
									$this->tpl->set_var("checkbox_style", "style='display:none;'");
								}
								else{
									$this->tpl->set_var("checkbox_status", "");
									$this->tpl->set_var("checkbox_style", "");
									if(is_array($this->formArray["mergeBasketArray"])){
										if(in_array($value->getOdID(),$this->formArray["mergeBasketArray"])){
											$this->tpl->set_var("checkbox_status", "checked disabled");
										}
									}
								}

								switch($propertyType){
									case "Land":
										$this->tpl->set_var("propertyType", "L/P");
										break;
									case "ImprovementsBuildings":
										$this->tpl->set_var("propertyType", "I/B");
										break;
									case "Machineries":
										$this->tpl->set_var("propertyType", "M");
										break;
									default:
										$this->tpl->set_var("propertyType", "-");
										break;
								}

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
								//*/
								//echo method_exists($value->location,getFullAddress);
								$this->tpl->set_var("locationAddress", $value->locationAddress->getFullAddress());
								$this->tpl->set_var("landArea", number_format($value->getLandArea(), 2, '.', ','));
								$this->tpl->parse("ODListBlock", "ODList", true);
								$this->tpl->set_var("PersonListBlock", "");
								$this->tpl->set_var("CompanyListBlock", "");
							}
						}
						else{
							$this->tpl->set_block("rptsTemplate", "ODList", "ODListBlock");
							$this->tpl->set_var("ODListBlock", "huh");
						}
					}
				}
                break;
			case "cancel":
				header("location: ODList.php";
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
				$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				$this->tpl->set_block("rptsTemplate", "PagesList", "PagesListBlock");
                $this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
                $this->tpl->set_var("NotFoundBlock", "");

				$condition = $this->filterArchives();

				if (!$count = $ODList->getODCount($condition)){
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
				if ($numOfPages == $this->formArray["page"] || $numOfPages==""){
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

				if (!$xmlStr = $ODList->getODList($this->formArray["page"],$condition)){
					$this->tpl->set_block("rptsTemplate", "ODTable", "ODTableBlock");
					$this->tpl->set_var("ODTableBlock", "");

					$this->tpl->set_var("PagesBlock", "");
					$this->tpl->set_var("PagesListBlock", "");
	                $this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
	                $this->tpl->set_var("PageNavigatorBlock", "");
					$this->tpl->set_block("rptsTemplate", "ArchiveButton", "ArchiveButtonBlock");
					$this->tpl->set_var("ArchiveButtonBlock", "");
					$this->tpl->set_block("rptsTemplate", "UnArchiveButton", "UnArchiveButtonBlock");
					$this->tpl->set_var("UnArchiveButtonBlock", "");
				}
				else {
					//echo $xmlStr;
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "ODListTable", "ODListTableBlock");
						$this->tpl->set_var("ODListTableBlock", "");

						$this->tpl->set_var("PagesBlock", "");
						$this->tpl->set_var("PagesListBlock", "");
		                $this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
			            $this->tpl->set_var("PageNavigatorBlock", "");
						$this->tpl->set_block("rptsTemplate", "ArchiveButton", "ArchiveButtonBlock");
						$this->tpl->set_var("ArchiveButtonBlock", "");
						$this->tpl->set_block("rptsTemplate", "UnArchiveButton", "UnArchiveButtonBlock");
						$this->tpl->set_var("UnArchiveButtonBlock", "");
					}
					else {
						$odRecords = new ODRecords;
						$odRecords->parseDomDocument($domDoc);
						$list = $odRecords->getArrayList();
						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "ODDBEmpty", "ODDBEmptyBlock");
							$this->tpl->set_var("ODDBEmptyBlock", "");	
							$this->tpl->set_block("rptsTemplate", "ODList", "ODListBlock");
							$this->tpl->set_block("ODList", "PersonList", "PersonListBlock");
							$this->tpl->set_block("ODList", "CompanyList", "CompanyListBlock");
							foreach ($list as $key => $value){
								//print_r($value);
								//echo "<br>";
								$this->tpl->set_var("odID", $value->getOdID());

								$propertyType = $this->getPropertyTypeFromOD($value);
								if($propertyType!="Land"){
									$this->tpl->set_var("checkbox_status", "disabled");
									$this->tpl->set_var("checkbox_style", "style='display:none;'");
								}
								else{
									$this->tpl->set_var("checkbox_status", "");
									$this->tpl->set_var("checkbox_style", "");
									if(is_array($this->formArray["mergeBasketArray"])){
										if(in_array($value->getOdID(),$this->formArray["mergeBasketArray"])){
											$this->tpl->set_var("checkbox_status", "checked disabled");
										}
									}
								}

								switch($propertyType){
									case "Land":
										$this->tpl->set_var("propertyType", "L/P");
										break;
									case "ImprovementsBuildings":
										$this->tpl->set_var("propertyType", "I/B");
										break;
									case "Machineries":
										$this->tpl->set_var("propertyType", "M");
										break;
									default:
										$this->tpl->set_var("propertyType", "-");
										break;
								}

								$propertyType = $this->getPropertyTypeFromOD($value);
								if($propertyType!="Land"){
									$this->tpl->set_var("checkbox_status", "disabled");
									$this->tpl->set_var("checkbox_style", "style='display:none;'");
								}
								else{
									$this->tpl->set_var("checkbox_status", "");
									$this->tpl->set_var("checkbox_style", "");
									if(is_array($this->formArray["mergeBasketArray"])){
										if(in_array($value->getOdID(),$this->formArray["mergeBasketArray"])){
											$this->tpl->set_var("checkbox_status", "checked disabled");
										}
									}
								}

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
								//*/
								//if (method_exists($value->locationAddress,$value->locationAddress->getFullAddress()))
								if ($value->locationAddress <> "")
								$this->tpl->set_var("locationAddress", $value->locationAddress->getFullAddress());
					//Begin Edited, Decimal 2 was change to 4 ****************			
					$this->tpl->set_var("landArea", number_format($value->getLandArea(), 4, '.',','));
                                        //End
								$this->tpl->parse("ODListBlock", "ODList", true);
								$this->tpl->set_var("PersonListBlock", "");
								$this->tpl->set_var("CompanyListBlock", "");
							}
						}
						else{
							$this->tpl->set_block("rptsTemplate", "ODList", "ODListBlock");
							$this->tpl->set_var("ODListBlock", "huh");
						}
					}
				}
		}

		$this->initBarangayList();		
        $this->setForm();

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
$odList = new ODList($HTTP_POST_VARS,$sess,$odID,$page,$searchKey,$barangay,$formAction,$sortBy,$sortOrder,$viewArchives,$transactionCode,$mergeBasketCSV);
$odList->main();
?>
<?php page_close(); ?>
