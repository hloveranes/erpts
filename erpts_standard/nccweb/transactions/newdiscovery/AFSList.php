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
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/AFSRecords.php";

#####################################
# Define Interface Class
#####################################
class AFSList{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function AFSList($http_post_vars,$sess,$odID,$page,$searchKey,$formAction,$sortBy,$sortOrder){
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

		$this->tpl->set_file("rptsTemplate", "AFSList.htm") ;
		$this->tpl->set_var("TITLE", "New Discovery > FAAS List");
		
		$this->formArray["odID"] = $odID;
		$this->formArray["page"] = $page;
		$this->formArray["searchKey"] = $searchKey;
		$this->formArray["sortBy"] = $sortBy;
		$this->formArray["sortOrder"] = $sortOrder;
		$this->formArray["formAction"] = $formAction;

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function sortBlocks(){
		$this->sortBlockFields = array(
			  "afsID" => "AFSID"
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
			case "afsID":
				$condition = " ORDER BY ".AFS_TABLE.".afsID ".$this->formArray["sortOrder"];
				break;
			case "person":
				$condition = " ORDER BY PersonFullName ".$this->formArray["sortOrder"];
				break;
			case "company":
				$condition = " ORDER BY ".COMPANY_TABLE.".companyName ".$this->formArray["sortOrder"];
				break;
			default:
				$this->formArray["sortBy"] = "afsID";
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
				$condition = " ORDER BY ".AFS_TABLE.".afsID DESC";
				break;
		}
		return $condition;
	}

	function filterArchives(){
		$condition = " WHERE ".AFS_TABLE.".archive <> 'true' ";
		$condition.= " GROUP BY ".AFS_TABLE.".afsID "; 
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

	function setAFSListBlockPerms(){
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
            case "search":
				$this->tpl->set_var("msg", "");
				$AFSList = new SoapObject(NCCBIZ."AFSList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				$this->tpl->set_block("rptsTemplate", "PagesList", "PagesListBlock");

				$condition = $this->filterArchives();

				if (!$count = $AFSList->getSearchCount($this->formArray["searchKey"],$condition)){
					$this->tpl->set_var("PagesBlock", "");
					$this->tpl->set_var("PagesListBlock", "");
	                $this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
					$this->tpl->set_var("PageNavigatorBlock","");
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
							$this->tpl->set_var("pageListPagesUrl",$i . "&formAction=search&searchKey=" . urlencode($this->formArray["searchKey"]));	
							$this->tpl->set_var("pageListPaged","");
						}
						$this->tpl->parse("PagesListBlock", "PagesList", true);
					}

					// drop down nav
					for($i=1;$i<=$numOfPages;$i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("pages",$i);
							$this->tpl->set_var("pagesUrl",$i . "&formAction=search&searchKey=" . urlencode($this->formArray["searchKey"]));	
							$this->tpl->set_var("paged","selected");
						}
						else{
							$this->tpl->set_var("pages",$i);
						    $this->tpl->set_var("pagesUrl",$i . "&formAction=search&searchKey=" . urlencode($this->formArray["searchKey"]));	
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

				if (!$xmlStr = $AFSList->searchAFS($this->formArray["page"], $this->formArray["searchKey"], $condition)){
                    $this->tpl->set_var("pageOf", "");
                    $this->tpl->set_block("rptsTemplate", "AFSTable", "AFSTableBlock");
                    $this->tpl->set_var("AFSTableBlock", "");
                    $this->tpl->set_block("rptsTemplate", "AFSDBEmpty", "AFSDBEmptyBlock");
                    $this->tpl->set_var("AFSDBEmptyBlock", "");
                    $this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
                    $this->tpl->set_var("PagesBlock", "");
					$this->tpl->set_var("PagesListBlock", "");
                    $this->tpl->set_var("previousTxt", "");
                    $this->tpl->set_var("nextTxt", "");
				}
				else {
					//echo $xmlStr;
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "AFSListTable", "AFSListTableBlock");
						$this->tpl->set_var("AFSListTableBlock", "error xmlDoc");
					}
					else {
					
                        $this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
                        $this->tpl->set_var("NotFoundBlock", "");
                        					
						$odRecords = new ODRecords;
						$odRecords->parseDomDocument($domDoc);
						$list = $odRecords->getArrayList();
						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "AFSDBEmpty", "AFSDBEmptyBlock");
							$this->tpl->set_var("AFSDBEmptyBlock", "");	
							$this->tpl->set_block("rptsTemplate", "AFSList", "AFSListBlock");
							$this->tpl->set_block("AFSList", "PersonList", "PersonListBlock");
							$this->tpl->set_block("AFSList", "CompanyList", "CompanyListBlock");
							//echo hello;
							foreach ($list as $key => $value){
                                $AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
                                $this->afsID = $AFSEncode->getAFSID($value->getOdID());
								if (!$xmlStr = $AFSEncode->getAFSForList($this->afsID)){
									echo "error domdoc";
								}
								else {
									//echo $xmlStr."<br><br><br>";
									if(!$domDoc = domxml_open_mem($xmlStr)) {
										echo "hello";
										$this->tpl->set_var("totalMarketValue", "");
										$this->tpl->set_var("totalAssessedValue", "");
										//$this->tpl->set_block("rptsTemplate", "AFSListTable", "AFSListTableBlock");
										//$this->tpl->set_var("AFSListTableBlock", "error xmlDoc");
									}
									else {
										$afs = new AFS;
										$afs->parseDomDocument($domDoc);
										$this->tpl->set_var("totalMarketValue", number_format($afs->getTotalMarketValue(), 2, '.', ','));
										$this->tpl->set_var("totalAssessedValue", number_format($afs->getTotalAssessedValue(), 2, '.', ','));
									}
								}
								$this->tpl->set_var("odID", $value->getOdID());
								$this->tpl->set_var("afsID", $this->afsID);
								
                                $oValue = $value->owner;
                                $this->tpl->set_var("ownerID", $oValue->getOwnerID());
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
								$this->tpl->set_var("landArea", $value->getLandArea());
								
								$this->setAFSListBlockPerms();

								$this->tpl->parse("AFSListBlock", "AFSList", true);
								$this->tpl->set_var("PersonListBlock", "");
								$this->tpl->set_var("CompanyListBlock", "");
							}
						}
						else{
							$this->tpl->set_block("rptsTemplate", "AFSList", "AFSListBlock");
							$this->tpl->set_var("AFSListBlock", "huh");
						}
					}
				}
                break;
			default:
				$this->tpl->set_var("msg", "");
				$AFSList = new SoapObject(NCCBIZ."AFSList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				$this->tpl->set_block("rptsTemplate", "PagesList", "PagesListBlock");
                $this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
                $this->tpl->set_var("NotFoundBlock", "");

				$condition = $this->filterArchives();

				if (!$count = $AFSList->getAFSCount($condition)){
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

				if (!$xmlStr = $AFSList->getAFSList($this->formArray["page"],$condition)){
					$this->tpl->set_block("rptsTemplate", "AFSTable", "AFSTableBlock");
					$this->tpl->set_var("AFSTableBlock", "");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "AFSTable", "AFSTableBlock");
						$this->tpl->set_var("AFSTableBlock", "");
					}
					else {
						$odRecords = new ODRecords;
						$odRecords->parseDomDocument($domDoc);
						$list = $odRecords->getArrayList();
						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "AFSDBEmpty", "AFSDBEmptyBlock");
							$this->tpl->set_var("AFSDBEmptyBlock", "");	
							$this->tpl->set_block("rptsTemplate", "AFSList", "AFSListBlock");
							$this->tpl->set_block("AFSList", "PersonList", "PersonListBlock");
							$this->tpl->set_block("AFSList", "CompanyList", "CompanyListBlock");
							foreach ($list as $key => $value){
                               $AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
                                $this->afsID = $AFSEncode->getAFSID($value->getOdID());
								if (!$xmlStr = $AFSEncode->getAFSForList($this->afsID)){
									echo "error domdoc";
								}
								else {
									if(!$domDoc = domxml_open_mem($xmlStr)) {
										$this->tpl->set_var("totalMarketValue", "");
										$this->tpl->set_var("totalAssessedValue", "");
										//$this->tpl->set_block("rptsTemplate", "AFSListTable", "AFSListTableBlock");
										//$this->tpl->set_var("AFSListTableBlock", "error xmlDoc");
									}
									else {
										$afs = new AFS;
										$afs->parseDomDocument($domDoc);
										$this->tpl->set_var("totalMarketValue", number_format($afs->getTotalMarketValue(), 2, '.', ','));
										$this->tpl->set_var("totalAssessedValue", number_format($afs->getTotalAssessedValue(), 2, '.', ','));
									}
								}
								$this->tpl->set_var("odID", $value->getOdID());
								$this->tpl->set_var("afsID", $this->afsID);
								
                                $oValue = $value->owner;
                                $this->tpl->set_var("ownerID", $oValue->getOwnerID());
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
								$this->tpl->set_var("landArea", $value->getLandArea());

								$this->setAFSListBlockPerms();

								$this->tpl->parse("AFSListBlock", "AFSList", true);
								$this->tpl->set_var("PersonListBlock", "");
								$this->tpl->set_var("CompanyListBlock", "");
							}
						}
						else{
							$this->tpl->set_block("rptsTemplate", "AFSList", "AFSListBlock");
							$this->tpl->set_var("AFSListBlock", "huh");
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
		
if(!$page){
	$page = 1;
}
$afsList = new AFSList($HTTP_POST_VARS,$sess,$odID,$page,$searchKey,$formAction,$sortBy,$sortOrder);
$afsList->main();
?>
<?php page_close(); ?>
