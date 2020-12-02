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

#####################################
# Define Interface Class
#####################################
class ODList{
	
	var $tpl;
	var $formArray;
	var $sess;

	function ODList($http_post_vars,$sess,$odID,$page,$searchKey,$formAction,$sortBy,$sortOrder){
		global $auth;
//		echo "username=>".$auth->auth["uname"];
//		echo "userID=>".$auth->auth["uid"];
		
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ChangeOfOwnershipODList.htm") ;
		$this->tpl->set_var("TITLE", "Change Of Ownership");
		
		$this->sess = $sess;
		$this->formArray["odID"] = $odID;
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
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main(){
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
            case "search":
				$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");

				if (!$count = $ODList->getSearchCount($this->formArray["searchKey"])){
					$this->tpl->set_var("PagesBlock", "");
	                $this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
					$this->tpl->set_var("PageNavigatorBlock","");
					$numOfPages = 1;
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

				$condition = $this->sortBlocks();

				$this->tpl->set_var("pageOf", $this->formArray["page"]." of ".$numOfPages);
				if (!$xmlStr = $ODList->searchOD($this->formArray["page"],$condition,$this->formArray["searchKey"])){
                    $this->tpl->set_var("pageOf", "");
                    $this->tpl->set_block("rptsTemplate", "ODTable", "ODTableBlock");
                    $this->tpl->set_var("ODTableBlock", "");
                    $this->tpl->set_block("rptsTemplate", "ODDBEmpty", "ODDBEmptyBlock");
                    $this->tpl->set_var("ODDBEmptyBlock", "");
                    $this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
                    $this->tpl->set_var("PagesBlock", "");
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
                $this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
                $this->tpl->set_var("NotFoundBlock", "");
				if (!$count = $ODList->getODCount()){
					$this->tpl->set_var("PagesBlock", "");
	                $this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
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

				$condition = $this->sortBlocks();

				if (!$xmlStr = $ODList->getODList($this->formArray["page"],$condition)){
					$this->tpl->set_block("rptsTemplate", "ODTable", "ODTableBlock");
					$this->tpl->set_var("ODTableBlock", "");
				}
				else {
					//echo $xmlStr;
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "ODListTable", "ODListTableBlock");
						$this->tpl->set_var("ODListTableBlock", "");
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
$odList = new ODList($HTTP_POST_VARS,$sess,$odID,$page,$searchKey,$formAction,$sortBy,$sortOrder);
$odList->main();
?>
<?php page_close(); ?>