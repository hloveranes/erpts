<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/TDRecords.php";

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
class TDList{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function TDList($http_post_vars,$sess,$tdID,$page,$searchKey,$formAction,$sortBy,$sortOrder,$viewArchives){
		global $auth;
		//echo "username=>".$auth->auth["uname"];
		
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "TDList.htm") ;
		$this->tpl->set_var("TITLE", "TD List");
		
		$this->sess = $sess;
		$this->formArray["tdID"] = $tdID;

		$this->formArray["page"] = $page;
		$this->formArray["searchKey"] = $searchKey;
		$this->formArray["sortBy"] = $sortBy;
		$this->formArray["sortOrder"] = $sortOrder;
		$this->formArray["viewArchives"] = $viewArchives;

		$this->formArray["formAction"] = $formAction;

		$this->formArray["viewArchivesTitle"] = "";
		$this->formArray["archiveValue"] = "";
		$this->formArray["odIDArray"] = "";
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
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
			}
			else{
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
			}
			else{
				$this->tpl->set_var("CompanyListBlock", "");
			}

			if (count($value->personArray) || count($value->companyArray)){
				$this->tpl->set_var("none","");


			}
			else{
				$this->tpl->set_var("none","none");
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
				$condition = " ORDER BY ".TD_TABLE.".taxBeginsWithTheYear ".$this->formArray["sortOrder"];
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
		if($this->formArray["viewArchives"]=="true"){
			$this->formArray["viewArchivesTitle"] = ": Archives";
			$this->tpl->set_block("rptsTemplate", "ArchiveButton", "ArchiveButtonBlock");
			$this->tpl->set_var("ArchiveButtonBlock", "");
			
			$condition = " WHERE ".TD_TABLE.".archive='true' ";

		}
		else{
			$this->tpl->set_block("rptsTemplate", "UnArchiveButton", "UnArchiveButtonBlock");
			$this->tpl->set_var("UnArchiveButtonBlock", "");

			$condition = " WHERE ".TD_TABLE.".archive <> 'true' ";

		}
		return $condition;
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "archive":
				$TDList = new SoapObject(NCCBIZ."TDList.php", "urn:Object");

				$tdIDArray = $this->formArray["tdIDArray"];
				$archiveValue = $this->formArray["archiveValue"];
				$userID = $this->formArray["uid"];

				if(!$archiveRows = $TDList->archiveTD($tdIDArray,$archiveValue,$userID)){
						$this->tpl->set_var("msg", "SOAP failed");
				}
				else{
					$sess = $this->sess->name."=".$this->sess->id;
					header("Location: TDList.php?".$sess."&viewArchives=".$this->formArray["viewArchives"]);
					exit;
				}
				break;
            case "search":
				$this->tpl->set_var("msg", "");
				$TDList = new SoapObject(NCCBIZ."TDList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");

				$condition = $this->filterArchives();
				if (!$count = $TDList->getSearchCount($this->formArray["searchKey"], $condition)){
					$this->tpl->set_var("PagesBlock", "");
					$numOfPages = 1;
					$this->tpl->set_block("rptsTemplate", "PageNavigator", "PagesBlock");
					$this->tpl->set_var("PageNavigatorBlock", "");
				}
				else{
					$numOfPages = ceil($count / PAGE_BY);
					for($i=1;$i<=$numOfPages;$i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("pages","");
							$this->tpl->set_var("pagesUrl", "");
							$this->tpl->set_var("paged",$i);
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
                    $this->tpl->set_var("previousTxt", "");
                    $this->tpl->set_var("nextTxt", "");

					$this->tpl->set_block("rptsTemplate", "ArchiveButton", "ArchiveButtonBlock");
					$this->tpl->set_var("ArchiveButtonBlock", "");
					$this->tpl->set_block("rptsTemplate", "UnArchiveButton", "UnArchiveButtonBlock");
					$this->tpl->set_var("UnArchiveButtonBlock", "");
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
                $this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
                $this->tpl->set_var("NotFoundBlock", "");

				$condition = $this->filterArchives();
				if (!$count = $TDList->getTDCount($condition)){
					$this->tpl->set_var("PagesBlock", "");
					$this->tpl->set_block("rptsTemplate", "PageNavigator", "PagesBlock");
					$this->tpl->set_var("PageNavigatorBlock", "");
				}
				else{
					$numOfPages = ceil($count / PAGE_BY);
					for($i=1;$i<=$numOfPages;$i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("pages","");
							$this->tpl->set_var("pagesUrl","");
							$this->tpl->set_var("paged",$i);
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

					$this->tpl->set_var("PagesBlock", "");
	                $this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
	                $this->tpl->set_var("PageNavigatorBlock", "");
					$this->tpl->set_block("rptsTemplate", "ArchiveButton", "ArchiveButtonBlock");
					$this->tpl->set_var("ArchiveButtonBlock", "");
					$this->tpl->set_block("rptsTemplate", "UnArchiveButton", "UnArchiveButtonBlock");
					$this->tpl->set_var("UnArchiveButtonBlock", "");
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
$tdList = new TDList($HTTP_POST_VARS,$sess,$tdID,$page,$searchKey,$formAction,$sortBy,$sortOrder,$viewArchives);
$tdList->main();
?>
<?php page_close(); ?>
