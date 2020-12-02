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
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/RPTOPRecords.php";

#####################################
# Define Interface Class
#####################################
class RPTOPList{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function RPTOPList($http_post_vars,$sess,$rptopID,$page,$searchKey,$formAction,$sortBy,$sortOrder){
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "RPTOPList.htm") ;
		$this->tpl->set_var("TITLE", "RPTOP List");
		
		$this->sess = $sess;
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
	/*

	function sortBlocks(){
		$this->sortBlockFields = array(
			  "rptopID" => "RPTOPID"
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
			case "rptopID":
				$condition = " ORDER BY ".RPTOP_TABLE.".rptopID ".$this->formArray["sortOrder"];
				break;
			case "person":
				$condition = " ORDER BY PersonFullName ".$this->formArray["sortOrder"];
				break;
			case "company":
				$condition = " ORDER BY ".COMPANY_TABLE.".companyName ".$this->formArray["sortOrder"];
				break;
			default:
				$this->formArray["sortBy"] = "rptopID";
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

				$condition = " ORDER BY ".RPTOP_TABLE.".rptopID DESC";
				break;
		}
		return $condition;
	}
	*/

	///*

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
				if (!$count = $RPTOPList->getSearchCount($this->formArray["searchKey"])){
					$this->tpl->set_var("PagesBlock", "");
					$numOfPages = 1;
					$this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
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

				$condition = $this->sortBlocks();
				if (!$xmlStr = $RPTOPList->searchRPTOP($this->formArray["page"],$condition,$this->formArray["searchKey"])){
                    $this->tpl->set_var("pageOf", "");
                    $this->tpl->set_block("rptsTemplate", "RPTOPTable", "RPTOPTableBlock");
                    $this->tpl->set_var("RPTOPTableBlock", "");
                    $this->tpl->set_block("rptsTemplate", "RPTOPDBEmpty", "RPTOPDBEmptyBlock");
                    $this->tpl->set_var("RPTOPDBEmptyBlock", "");
                    $this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
                    $this->tpl->set_var("PagesBlock", "");
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
				header("location: RPTOPList.php";
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
				
				$RPTOPList = new SoapObject(NCCBIZ."RPTOPList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
				$this->tpl->set_var("NotFoundBlock", "");		
				if (!$count = $RPTOPList->getRPTOPCount()){
					$this->tpl->set_var("PagesBlock", "");
					$this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
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
$rptopList = new RPTOPList($HTTP_POST_VARS,$sess,$rptopID,$page,$searchKey,$formAction,$sortBy,$sortOrder);
$rptopList->main();
?>
<?php page_close(); ?>
