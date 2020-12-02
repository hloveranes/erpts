<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/Company.php";

include_once "../includes/collection/Receipt.php";
include_once "../includes/collection/ReceiptRecords.php";

include_once "../includes/collection/Collection.php";
include_once "../includes/collection/CollectionRecords.php";

include_once "../includes/collection/MergedReceipt.php";
include_once "../includes/collection/MergedReceiptRecords.php";

#####################################
# Define Interface Class
#####################################
class SingleReceiptList{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function SingleReceiptList($http_post_vars,$sess,$receiptIDArray,$page,$searchKey,$formAction,$sortBy,$sortOrder){
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

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "SingleReceiptList.htm") ;
		$this->tpl->set_var("TITLE", "TM : RPTR List");
		
		$this->formArray["receiptIDArray"] = $receiptIDArray;
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
		$this->sortBlockFields = array(
			  "receiptID" => "ReceiptID"
			, "receiptNumber" => "ReceiptNumber"
			, "receiptDate" => "ReceiptDate"
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
			case "receiptID":
				$condition = " ORDER BY ".RECEIPT_TABLE.".receiptID ".$this->formArray["sortOrder"];
				break;
			case "receiptNumber":
				$condition = " ORDER BY ".RECEIPT_TABLE.".receiptNumber ".$this->formArray["sortOrder"];
				break;
			case "receiptDate":
				$condition = " ORDER BY ".RECEIPT_TABLE.".receiptDate ".$this->formArray["sortOrder"];
				break;
			default:
				$this->formArray["sortBy"] = "receiptID";
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
				$condition = " ORDER BY ".RECEIPT_TABLE.".receiptID DESC";
				break;
		}
		return $condition;
	}

	function filterCancelled(){
		$condition = " WHERE ".RECEIPT_TABLE.".status <> 'cancelled' ";
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
		if(!checkPerms($this->user["userType"],"%%%1%%%%%%")){
			// hide Blocks if userType is not at least TM-Edit
			$this->hideBlock("TreasuryMaintenanceLink");
		}
		else{
			$this->hideBlock("TreasuryMaintenanceLinkText");
		}
	}

	function setReceiptListBlockPerms(){
		if(!checkPerms($this->user["userType"],"%1%%%%%%%%")){
			$this->tpl->set_var("ownerViewAccess","viewOnly");
			$this->tpl->set_var("afsDetailsLinkLabel", "View");
		}
		else{
			$this->tpl->set_var("ownerViewAccess","view");
			$this->tpl->set_var("afsDetailsLinkLabel", "Edit");
		}
	}

	function getOwnerNames($ownerID){
		$ownerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");

		if (!$xmlStr = $ownerList->getOwnerList($ownerID)){
			return "";
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				return "";
			}
			else {
				$ownerRecords = new OwnerRecords;
				$ownerRecords->parseDomDocument($domDoc);
				$list = $ownerRecords->getArrayList();

				$ownerNames = "";
				foreach($list as $owner){
					if(is_array($owner->getPersonArray())){
						$personArray = $owner->getPersonArray();
						foreach($personArray as $person){
							if($ownerNames!="") $ownerNames .= ", ";
							$ownerNames .= $person->getFullName();
						}
					}
					if(is_array($owner->getCompanyArray())){
						$companyArray = $owner->getCompanyArray();
						foreach($companyArray as $company){
							if($ownerNames!="") $ownerNames .= ", ";
							$ownerNames .= $company->getCompanyName();
						}
					}
				}

				return $ownerNames;
			}
		}
	}

	function getTaxType($receiptID){
		$taxType = "";

		$condition = "WHERE receiptID='".$receiptID."'";

		$collectionRecords = new CollectionRecords;
		if($collectionRecords->selectRecords($condition)){
			if(count($collectionRecords->arrayList) > 0){
				$collection = $collectionRecords->arrayList[0];
				$taxType = strtoupper($collection->getTaxType());
			}
		}

		return $taxType;
	}

	
	function Main(){
		switch ($this->formArray["formAction"]){
            case "search":
				$this->tpl->set_var("msg", "");

				$receiptRecords = new ReceiptRecords;

				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				$this->tpl->set_block("rptsTemplate", "PagesList", "PagesListBlock");

				$condition = $this->filterCancelled();

				$fields = array(
						"receiptNumber"
						,"checkNumber"
						,"draweeBank"
				);

				$count = $receiptRecords->countSearchRecords($this->formArray["searchKey"],$fields);

				if ($count==0 || $count==false){
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

				$condition = $this->filterCancelled();
				$condition.= $this->sortBlocks();
				$condition.= " LIMIT ".(($this->formArray["page"]-1) * PAGE_BY).",".PAGE_BY;

				if (!$receiptRecords->searchRecords($this->formArray["searchKey"],$fields,$condition)){
                    $this->tpl->set_var("pageOf", "");
                    $this->tpl->set_block("rptsTemplate", "ReceiptTable", "ReceiptTableBlock");
                    $this->tpl->set_var("ReceiptTableBlock", "");
                    $this->tpl->set_block("rptsTemplate", "ReceiptDBEmpty", "ReceiptDBEmptyBlock");
                    $this->tpl->set_var("ReceiptDBEmptyBlock", "");
                    $this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
                    $this->tpl->set_var("PagesBlock", "");
					$this->tpl->set_var("PagesListBlock", "");
                    $this->tpl->set_var("previousTxt", "");
                    $this->tpl->set_var("nextTxt", "");
				}
				else {
				    $this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
				    $this->tpl->set_var("NotFoundBlock", "");
					$list = $receiptRecords->getArrayList();
					if (count($list)){
						$this->tpl->set_block("rptsTemplate", "ReceiptDBEmpty", "ReceiptDBEmptyBlock");
						$this->tpl->set_var("ReceiptDBEmptyBlock", "");	
						$this->tpl->set_block("rptsTemplate", "ReceiptList", "ReceiptListBlock");
						foreach ($list as $key => $value){
							$this->tpl->set_var("receiptID", $value->getReceiptID());
							$this->tpl->set_var("receiptNumber", $value->getReceiptNumber());
							$this->tpl->set_var("receiptDate", date("m/d/Y",strtotime($value->getReceiptDate())));

							$this->tpl->set_var("taxType", $this->getTaxType($value->getReceiptID()));

							$receivedFromName = $this->getOwnerNames($value->getReceivedFrom());
							$this->tpl->set_var("receivedFromName", $receivedFromName);

							$this->tpl->parse("ReceiptListBlock", "ReceiptList", true);
						}
					}
				}
				break;
			default:
				$this->tpl->set_var("msg", "");
				$ReceiptList = new SoapObject(NCCBIZ."ReceiptList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				$this->tpl->set_block("rptsTemplate", "PagesList", "PagesListBlock");
                $this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
                $this->tpl->set_var("NotFoundBlock", "");

				$condition = $this->filterCancelled();

				$receiptRecords = new ReceiptRecords;

				$count = $receiptRecords->countRecords($condition);

				if ($count==0 || $count==false){
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

				$condition = $this->filterCancelled();
				$condition.= $this->sortBlocks();
				$condition.= " LIMIT ".(($this->formArray["page"]-1) * PAGE_BY).",".PAGE_BY;

				if (!$receiptRecords->selectRecords($condition)){
					$this->tpl->set_block("rptsTemplate", "ReceiptTable", "ReceiptTableBlock");
					$this->tpl->set_var("ReceiptTableBlock", "");
				}
				else {
					$list = $receiptRecords->getArrayList();
					if (count($list)){
						$this->tpl->set_block("rptsTemplate", "ReceiptDBEmpty", "ReceiptDBEmptyBlock");
						$this->tpl->set_var("ReceiptDBEmptyBlock", "");	
						$this->tpl->set_block("rptsTemplate", "ReceiptList", "ReceiptListBlock");
						foreach ($list as $key => $value){
							$this->tpl->set_var("receiptID", $value->getReceiptID());
							$this->tpl->set_var("receiptNumber", $value->getReceiptNumber());
							$this->tpl->set_var("receiptDate", date("m/d/Y",strtotime($value->getReceiptDate())));

							$this->tpl->set_var("taxType", $this->getTaxType($value->getReceiptID()));

							$receivedFromName = $this->getOwnerNames($value->getReceivedFrom());
							$this->tpl->set_var("receivedFromName", $receivedFromName);

							$this->tpl->parse("ReceiptListBlock", "ReceiptList", true);
						}
					}
				}
				break;
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
$singleReceiptList = new SingleReceiptList($HTTP_POST_VARS,$sess,$receiptIDArray,$page,$searchKey,$formAction,$sortBy,$sortOrder);
$singleReceiptList->Main();
?>
<?php page_close(); ?>
