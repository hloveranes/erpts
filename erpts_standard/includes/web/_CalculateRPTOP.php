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

#####################################
# Define Interface Class
#####################################
class RPTOPList{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function RPTOPList($http_post_vars,$sess,$rptopID,$page){
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

		$this->tpl = new rpts_Template(getcwd());

		$this->tpl->set_file("rptsTemplate", "CalculateRPTOP1.htm") ;
		$this->tpl->set_var("TITLE", "TM : Calculate Individually");
		
		$this->formArray["rptopID"] = $rptopID;
		$this->formArray["page"] = $page;
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}

		if (!$this->formArray["searchKey"]) {
			$this->removeNotFoundBlock();
		} else {
			$this->tpl->set_var("searchKey", $this->formArray["searchKey"]);
		}
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
		}
		else{
			$this->hideBlock("GenerateRPTOPLinkText");
			$this->hideBlock("TreasuryMaintenanceLinkText");
		}
	}
	
	function removeNotFoundBlock() {
		$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
		$this->tpl->set_var("NotFoundBlock", "");
	}

	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main(){
		$numOfPages=1;
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
			case "cancel":
				header("location: RPTOPList.php";
				exit;
				break;
			case "search":
					$RPTOPList = new SoapObject(NCCBIZ."RPTOPList.php", "urn:Object");
			$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
		
			$count = ($this->formArray["formAction"]=="search") ? 
				$RPTOPList->getSearchCount($this->formArray["searchKey"]) : $RPTOPList->getRPTOPCount();

			if (!$count){
				$this->tpl->set_var("PagesBlock", "");
			}
			else{
				$numOfPages = ceil($count / PAGE_BY);
				for($i=1;$i<=$numOfPages;$i++){
					if ($i==$this->formArray["page"]){
						$this->tpl->set_var("pages","");
						$this->tpl->set_var("paged",$i);
					}
					else{
						$this->tpl->set_var("pages",$i);
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
			$this->tpl->set_var("pageOf", $this->formArray["page"]." of ".$numOfPages);

			$condition = " ORDER BY ".RPTOP_TABLE.".rptopID desc";

			$xmlStr = ($this->formArray["formAction"]=="search") ?
					$RPTOPList->searchRPTOP($this->formArray["page"],$condition,$this->formArray["searchKey"]) :
					$RPTOPList->getRPTOPList($this->formArray["page"]);
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

					$condition = " ORDER BY ".RPTOP_TABLE.".rptopID desc";

			$xmlStr = $RPTOPList->getRPTOPList($this->formArray["page"],$condition);
		

		}
	/*	$RPTOPList = new SoapObject(NCCBIZ."RPTOPList.php", "urn:Object");
		$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
		
		$count = ($this->formArray["formAction"]=="search") ? 
				$RPTOPList->getSearchCount($this->formArray["searchKey"]) : $RPTOPList->getRPTOPCount();

		if (!$count){
			$this->tpl->set_var("PagesBlock", "");
		}
		else{
			$numOfPages = ceil($count / PAGE_BY);
			for($i=1;$i<=$numOfPages;$i++){
				if ($i==$this->formArray["page"]){
					$this->tpl->set_var("pages","");
					$this->tpl->set_var("paged",$i);
				}
				else{
					$this->tpl->set_var("pages",$i);
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
		$this->tpl->set_var("pageOf", $this->formArray["page"]." of ".$numOfPages);

		$condition = " ORDER BY ".RPTOP_TABLE.".rptopID desc";

		$xmlStr = ($this->formArray["formAction"]=="search") ?
				$RPTOPList->searchRPTOP($this->formArray["page"],$condition,$this->formArray["searchKey"]) :
				$RPTOPList->getRPTOPList($this->formArray["page"]);
	*/	
		if (!$xmlStr){
			$this->tpl->set_block("rptsTemplate", "RPTOPTable", "RPTOPTableBlock");
			$this->tpl->set_var("RPTOPTableBlock", "page not found");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
	 			$this->tpl->set_block("rptsTemplate", "RPTOPListTable", "RPTOPListTableBlock");
				$this->tpl->set_var("RPTOPListTableBlock", "error xmlDoc");
			}
			else {
				$rptopRecords = new RPTOPRecords;
				$rptopRecords->parseDomDocument($domDoc);
				$list = $rptopRecords->getArrayList();

				if ($this->formArray["sortOrder"]=="") $this->formArray["sortOrder"]="desc";
				$this->tpl->set_var("sortOrder", ($this->formArray["sortOrder"]=="asc") ? "desc" : "asc");
				if ($this->formArray["sortKey"]=="rptopID") {
					$this->tpl->set_var("sortImageID", "<img src=\"images/".$this->formArray["sortOrder"]."_order.png\" border=0 alt=\"".ucfirst($this->formArray["sortOrder"])."ending\">");				
					$this->tpl->set_var("sortImageName", "");				
				} elseif ($this->formArray["sortKey"]=="ownerName") {
					$this->tpl->set_var("sortImageID", "");				
					$this->tpl->set_var("sortImageName", "<img src=\"images/".$this->formArray["sortOrder"]."_order.png\" border=0 alt=\"".ucfirst($this->formArray["sortOrder"])."ending\">");
				}

				if (count($list)){
					$this->removeNotFoundBlock();
					$this->tpl->set_block("rptsTemplate", "RPTOPDBEmpty", "RPTOPDBEmptyBlock");
					$this->tpl->set_var("RPTOPDBEmptyBlock", "");	
					$this->tpl->set_block("rptsTemplate", "RPTOPList", "RPTOPListBlock");
					$this->tpl->set_block("RPTOPList", "TaxableYear", "TaxableYearBlock");
					$this->tpl->set_block("RPTOPList", "OwnerList", "OwnerListBlock");
					#$this->tpl->set_block("RPTOPList", "PersonList", "PersonListBlock");
					#$this->tpl->set_block("RPTOPList", "CompanyList", "CompanyListBlock");
					
					$i=0;
					$buffer=array();
					foreach ($list as $key => $value){
						$buffer[$i]["rptopID"]=$value->getRptopID();
						# $forDate = getdate(strtotime($value->getTaxableYear()));
						$buffer[$i]["taxableYear"]=$value->getTaxableYear();

						$buffer[$i]["ownerName"] = "";

						/*
						$this->tpl->set_var("rptopID", $value->getRptopID());
						$forDate = getdate(strtotime($value->getRptopDate()));
						$this->tpl->set_var("rptopDate", $forDate['year']);
						*/
						$oValue = $value->owner;
						$pOwnerStr = "";
						if (count($oValue->personArray)){
							foreach($oValue->personArray as $pKey => $pValue){
								$ownerRecord = array(
									"ownerScript" => "PersonDetails.php"
									, "ownerKey" => "personID"
									, "ownerID" => $pValue->getPersonID()
									, "ownerName" => $pValue->getFullName()
								);

								$ownerRecords[] = $ownerRecord;

								$buffer[$i]["ownerRecords"] = $ownerRecords;
								$buffer[$i]["ownerName"] .= $pValue->getFullName();

								/*
								$this->tpl->set_var("personID",$pValue->getPersonID());
								$this->tpl->set_var("OwnerPerson",$pValue->getFullName());
								$this->tpl->parse("PersonListBlock", "PersonList", true);
								*/
							}
						}
						if (count($oValue->companyArray)){
							foreach($oValue->companyArray as $cKey => $cValue){
								$ownerRecord = array(
									"ownerScript" => "CompanyDetails.php"
									, "ownerKey" => "companyID"
									, "ownerID" => $cValue->getCompanyID()
									, "ownerName" => $cValue->getCompanyName()
								);

								$ownerRecords[] = $ownerRecord;
								$buffer[$i]["ownerRecords"] = $ownerRecords;
								$buffer[$i]["ownerName"] .= $cValue->getCompanyName();

								/*
								$this->tpl->set_var("companyID",$cValue->getCompanyID());
								$this->tpl->set_var("OwnerCompany",$cValue->getCompanyName());
								$this->tpl->parse("CompanyListBlock", "CompanyList", true);
								*/
							}
						}
						if (count($oValue->personArray) || count($oValue->companyArray)){
							$this->tpl->set_var("none","");
						}
						else{
							$this->tpl->set_var("none","none");
						}

						unset($ownerRecords);
						
						$i++;
					} #end  foreach ($list)

					$buffer=$this->sortArray($buffer,$this->formArray["sortKey"],$this->formArray["sortOrder"]);

					for ($i=0; $i<count($buffer);$i++) {
						//$this->tpl->set_var($buffer[$i]);

						$rptopRecord = $buffer[$i];

						$ownerRecords = $rptopRecord["ownerRecords"];

						$this->tpl->set_var("rptopID", $rptopRecord["rptopID"]);
						$this->tpl->set_var("taxableYear", $rptopRecord["taxableYear"]);

						if($rptopRecord["ownerName"]==""){
							$this->tpl->set_var("OwnerListBlock", "");
							$this->tpl->set_var("none", "none");
						}
						else{
							$this->tpl->set_var("OwnerListBlock", "");
							foreach($ownerRecords as $key=>$ownerRecord){
								$this->tpl->set_var("ownerScript", $ownerRecord["ownerScript"]);
								$this->tpl->set_var("ownerKey", $ownerRecord["ownerKey"]);
								$this->tpl->set_var("ownerID", $ownerRecord["ownerID"]);
								$this->tpl->set_var("ownerName", $ownerRecord["ownerName"]);

								$this->tpl->parse("OwnerListBlock", "OwnerList", true);
							}
							$this->tpl->set_var("none", "");
						}

						//$this->tpl->set_var("totalAssessedValue", "00000");
						//$this->tpl->set_var("totalTaxDue", "96876565765");
						$this->tpl->parse("RPTOPListBlock", "RPTOPList", true);
						$this->tpl->set_var("PersonListBlock", "");
						$this->tpl->set_var("CompanyListBlock", "");
					} #end  foreach ($list)
				}
				else{
					$this->tpl->set_block("rptsTemplate", "RPTOPList", "RPTOPListBlock");
					$this->tpl->set_var("RPTOPListBlock", "huh");
				}
			}
		}

		$this->tpl->set_var("page", $this->formArray["page"]);

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->setPageDetailPerms();

		$this->tpl->set_var("Session", $this->sess->url(""));
		$this->tpl->parse("templatePage", "rptsTemplate");
		$this->tpl->finish("templatePage");
		$this->tpl->p("templatePage");
	}
	
	function sortArray($buffer,$sortKey,$order="asc") {
		if ($sortKey=="") $sortKey="rptopID";
		$sBuffer=array();
		foreach ($buffer as $k=>$v) {
			$sBuffer[$k]=$v[$sortKey];
		}
		if ($order=="asc") asort($sBuffer);
		else arsort($sBuffer);
		reset($sBuffer);

		$i=0;
		$rBuffer=array();
		foreach ($sBuffer as $k=>$v) {
			$rBuffer[$i++]=$buffer[$k];
		}
		
		return $rBuffer;
	} #sortArray();
}

#####################################
# Define Procedures and Functions
#####################################

##########################################################
# Begin Program Script
##########################################################
page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
if(!$page) $page = 1;
$rptopList = new RPTOPList($HTTP_POST_VARS,$sess,$rptopID,$page);
$rptopList->main();
?>
<?php page_close(); ?>
