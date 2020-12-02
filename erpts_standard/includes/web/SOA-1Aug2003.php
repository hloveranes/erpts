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
		$this->tpl = new rpts_Template(getcwd());

		$this->tpl->set_file("rptsTemplate", "soa1.htm") ;
		$this->tpl->set_var("TITLE", "RPTOP List");
		
		$this->sess = $sess;
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
			default:
				$this->tpl->set_var("msg", "");
		}
		$RPTOPList = new SoapObject(NCCBIZ."RPTOPList.php", "urn:Object");
		$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
		if (!$count = $RPTOPList->getRPTOPCount()){
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
		
		$xmlStr = ($this->formArray["formAction"]=="search") ?
				$RPTOPList->searchRPTOP($this->formArray["page"],"",$this->formArray["searchKey"]) :
				$RPTOPList->getRPTOPList($this->formArray["page"]);
				
		if (!$xmlStr){// = $RPTOPList->getRPTOPList($this->formArray["page"])){
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

				if ($this->formArray["sortOrder"]=="") $this->formArray["sortOrder"]="asc";
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
					/*
					$this->tpl->set_block("RPTOPList", "PersonList", "PersonListBlock");
					$this->tpl->set_block("RPTOPList", "CompanyList", "CompanyListBlock");
					*/
					$i=0;
					$buffer=array();
					foreach ($list as $key => $value){
						$buffer[$i]["rptopID"]=$value->getRptopID();
						$buffer[$i]["taxableYear"]=$value->getTaxableYear();
						/*
						$this->tpl->set_var("rptopID", $value->getRptopID());
						$this->tpl->set_var("taxableYear",$value->getTaxableYear());
						*/
						$oValue = $value->owner;
						$pOwnerStr = "";
						if (count($oValue->personArray)){
							foreach($oValue->personArray as $pKey => $pValue){
								$buffer[$i]["ownerScript"]="PersonDetails.php";
								$buffer[$i]["ownerKey"]="personID";
								$buffer[$i]["ownerID"]=$pValue->getPersonID();
								$buffer[$i]["ownerName"]=$pValue->getFullName();
								/*
								$this->tpl->set_var("personID",$pValue->getPersonID());
								$this->tpl->set_var("OwnerPerson",$pValue->getFullName());
								$this->tpl->parse("PersonListBlock", "PersonList", true);
								*/
							}
						}
						if (count($oValue->companyArray)){
							foreach($oValue->companyArray as $cKey => $cValue){
								$buffer[$i]["ownerScript"]="CompanyDetails.php";
								$buffer[$i]["ownerKey"]="companyID";
								$buffer[$i]["ownerID"]=$cValue->getCompanyID();
								$buffer[$i]["ownerName"]=$cValue->getCompanyName();
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
						$i++;
					} 
					$buffer=$this->sortArray($buffer,$this->formArray["sortKey"],$this->formArray["sortOrder"]);
					for ($i=0; $i<count($buffer);$i++) {
						$this->tpl->set_var($buffer[$i]);
						$this->tpl->set_var("totalAssessedValue", "00000");
						$this->tpl->set_var("totalTaxDue", "96876565765");
						$this->tpl->parse("RPTOPListBlock", "RPTOPList", true);
						#$this->tpl->set_var("PersonListBlock", "");
						#$this->tpl->set_var("CompanyListBlock", "");
					}
				}
				else{
					$this->tpl->set_block("rptsTemplate", "RPTOPList", "RPTOPListBlock");
					$this->tpl->set_var("RPTOPListBlock", "huh");
				}
			}
		}
		
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
