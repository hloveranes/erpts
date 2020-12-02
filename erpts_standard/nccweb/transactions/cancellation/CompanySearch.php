<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
#####################################
# Define Interface Class
#####################################
class CompanyEncode{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function CompanyEncode($http_post_vars,$searchKey,$formAction="",$sess,$ownerID="",$odID="",$page){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "CompanySearch.htm") ;
		$this->tpl->set_var("TITLE", "Company/Group Search");
		
		$this->formArray = array("formAction" => $formAction, "ownerID" => $ownerID, "odID" => $odID, "searchKey" => $searchKey
			, "page" => $page);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "search":
				$CompanyList = new SoapObject(NCCBIZ."CompanyList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				$this->tpl->set_block("rptsTemplate", "PagesList", "PagesListBlock");				
				if (!$count = $CompanyList->getSearchCount($this->formArray["searchKey"])){
					$this->tpl->set_var("PagesBlock", "");
					$this->tpl->set_var("PagesListBlock", "");					
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
							$this->tpl->set_var("pageListPaged",$i);
						}
						else{
							$this->tpl->set_var("pageListPages",$i);
							$this->tpl->set_var("pageListPaged","");
						}
						$this->tpl->parse("PagesListBlock", "PagesList", true);
					}

					// drop down nav					
					for($i=1;$i<=$numOfPages;$i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("pages",$i);
							$this->tpl->set_var("paged","selected");
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
				if (!$xmlStr = $CompanyList->searchCompany($this->formArray["searchKey"],$this->formArray["page"])){
					$this->tpl->set_block("rptsTemplate", "Found", "FoundBlock");
					$this->tpl->set_var("FoundBlock", "");
				}
				else {
					//echo $xmlStr;
					if(!$domDoc = domxml_open_mem($xmlStr)) {
			 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$companyRecords = new CompanyRecords;
						$companyRecords->parseDomDocument($domDoc);
						$list = $companyRecords->getArrayList();
						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
							foreach ($list as $key => $value){
								$this->tpl->set_var("companyID", $value->getCompanyID());
								if (!$cname = $value->getCompanyName()){
									$cname = "none";
								}
								$this->tpl->set_var("companyName", $cname);
								$this->tpl->set_var("telephone", $value->getTelephone());
								$this->tpl->parse("CompanyListBlock", "CompanyList", true);
							}
							$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
							$this->tpl->set_var("NotFoundBlock", "");
						}
						else{
							$this->tpl->set_block("rptsTemplate", "Found", "FoundBlock");
							$this->tpl->set_var("FoundBlock", "");
						}
					}
				}
				break;
		case "add":
					$OwnerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");
					$OwnerList->addOwnerCompany($this->formArray["ownerID"],$this->formArray["companyID"]);
					header("location: CompanySearchClose.php".$this->sess->url("").$this->sess->add_query(array("odID"=>$this->formArray["odID"])));
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "");
				$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
				$this->tpl->set_var("NotFoundBlock", "");
		}
		$this->setForm();
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("odID"=>$this->formArray["odID"],"ownerID"=>$this->formArray["ownerID"],"searchKey"=>$this->formArray["searchKey"], "formAction" => "search")));
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
page_open(array("sess" => "rpts_Session"
	,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/
if(!$page) $page = 1;
$companyEncode = new CompanyEncode($HTTP_POST_VARS,$searchKey,$formAction,$sess,$ownerID,$odID,$page);
$companyEncode->main();
?>

<?php page_close(); ?>
