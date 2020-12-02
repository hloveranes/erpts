<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Company.php";

include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/User.php";
include_once "../includes/assessor/UserRecords.php";

#####################################
# Define Interface Class
#####################################
class NoticeOfAssessmentList{
	
	var $tpl;
	function NoticeOfAssessmentList($sess,$sortKey,$sortOrder,$page,$http_get_vars){
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

		$this->formArray["sortKey"] = "TRIM(".COMPANY_TABLE.".companyName) ";
		$this->formArray["sortOrder"] = "asc";
		$this->formArray["page"] = 1;
	
		if($sortKey!="")
			$this->formArray["sortKey"] = $sortKey;
		if($sortOrder!="")
			$this->formArray["sortOrder"] = $sortOrder;

		if($page!=""){
			$this->formArray["page"] = $page;
		}

		$this->formArray["namesOfRepresentatives"] = "";
		$this->formArray["signatoryID"] = "";
		$this->formArray["designation"] = "";
		$this->formArray["searchKey"] = "";

		foreach ($http_get_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "NoticeOfAssessmentCompanyList.htm") ;
		$this->tpl->set_var("TITLE", "Notice of Assessment");
	}

	function hideBlock($tempVar){
		$this->tpl->set_block("rptsTemplate", $tempVar, $tempVar."Block");
		$this->tpl->set_var($tempVar."Block", "");
	}

	function setPageDetailPerms(){
		if(!checkPerms($this->user["userType"],"%1%%%%%%%%")){
			// hide Blocks if userType is not at least AM-Edit
			$this->hideBlock("TransactionsLink");
		}
		else{
			$this->hideBlock("TransactionsLinkText");
		}
	}

	function filterMiddleName($middleName){
		if($middleName=="NONE"){
			return "";
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

	function setForm(){
		$this->initMasterSignatoryList("Signatory", "signatory");

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function initMasterSignatoryList($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
        if (!$xmlStr = $UserList->getUserList(0, " WHERE ".AUTH_USER_MD5_TABLE.".userType REGEXP '1$' AND ".AUTH_USER_MD5_TABLE.".status='enabled'")){
			// error xmlStr
   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
			}
			else {
				$UserRecords = new UserRecords;
				$UserRecords->parseDomDocument($domDoc);
				$list = $UserRecords->getArrayList();
				foreach ($list as $key => $user){
					$person = new Person;
					$person->selectRecord($user->personID);
					$this->tpl->set_var("id",$user->personID);
					$this->tpl->set_var("name",$person->getFullName());
					$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
			        $this->initSelected($tempVar."ID",$user->personID);
			        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
				}
			}
		}
	}

	// Start DB Functions

	function setDB(){
		$this->db = new DB_RPTS;
	}

	function countRecords($condition=""){
		if($condition!="") $condition = " AND ".$condition;
		$this->setDB();
		$sql = sprintf(
				"SELECT COUNT(DISTINCT(".OWNER_COMPANY_TABLE.".companyID)) as count".
				" FROM ".OWNER_COMPANY_TABLE.",".COMPANY_TABLE." ".
				" WHERE ".OWNER_COMPANY_TABLE.".companyID = ".COMPANY_TABLE.".companyID ".
				" %s;",
				$condition);

		$this->db->query($sql);
		if($this->db->next_record()){
			$count = $this->db->f("count");
			return $count;
		}
		else{
			return false;
		}
	}

	function selectRecords($condition=" ORDER BY companyName ASC LIMIT 0,10"){
		$this->setDB();
		$sql = sprintf(
				"SELECT DISTINCT(".OWNER_COMPANY_TABLE.".companyID) as companyID, ".COMPANY_TABLE.".companyName as companyName ".
				" FROM ".OWNER_COMPANY_TABLE.",".COMPANY_TABLE." ".
				" WHERE ".OWNER_COMPANY_TABLE.".companyID = ".COMPANY_TABLE.".companyID ".
				" %s;",
				$condition);

		$this->db->query($sql);	
		
		while ($this->db->next_record()) {
			$company = new Company;
			$company->selectRecord($this->db->f("companyID"));
			$this->arrayList[] = $company;
		}

		if(is_array($this->arrayList)){
			return true;
		}
		else{
			return false;
		}
	}
	function displayPageNavigation($searchCondition=""){
		$totalRecords = $this->countRecords($searchCondition);

		$totalPages = ceil($totalRecords/PAGE_BY);

		$prev = 1;
		$next = $totalPages;

		if($next > $this->formArray["page"] + 1){
			$next = $this->formArray["page"] + 1;
		}
		if($prev < $this->formArray["page"] - 1){
			$prev = $this->formArray["page"] - 1;
		}

		$this->tpl->set_var("totalPages",$totalPages);
		$this->tpl->set_var("next",$next);
		$this->tpl->set_var("prev",$prev);
		$this->tpl->set_var("page",$this->formArray["page"]);
		$this->tpl->set_var("sortKey",$this->formArray["sortKey"]);
		$this->tpl->set_var("sortOrder",$this->formArray["sortOrder"]);

		$this->tpl->set_block("rptsTemplate", "DropDownPageList", "DropDownPageListBlock");
		for($i=1 ; $i<=$totalPages ; $i++){
			if($i==$this->formArray["page"])
				$this->tpl->set_var("dropDownPage_selected", "selected");
			else
				$this->tpl->set_var("dropDownPage_selected", "");

			$this->tpl->set_var("dropDownPage", $i);
			$this->tpl->parse("DropDownPageListBlock", "DropDownPageList", true);
		}
	}

	function displayRecords($searchCondition=""){
		$condition = "ORDER BY ".$this->formArray["sortKey"]. " ".$this->formArray["sortOrder"];

		if($this->formArray["page"] > 0){
			$limit = ($this->formArray["page"]-1) * PAGE_BY;
		}

		$condition .= " LIMIT ".$limit.",".PAGE_BY;

		if($searchCondition!="") $condition = " AND (".$searchCondition.") ".$condition;	
	
		if($this->selectRecords($condition)){
			if($this->formArray["sortOrder"]=="asc"){
				$this->tpl->set_var("oppositeSortOrder", "desc");
			}
			else{
				$this->tpl->set_var("oppositeSortOrder", "asc");
			}

			$this->tpl->set_block("rptsTemplate", "OwnerCompanyList", "OwnerCompanyListBlock");

			foreach($this->arrayList as $company) {
				$this->tpl->set_var("companyID", $company->getCompanyID());
				$this->tpl->set_var("companyName", $company->getCompanyName());
	
				if(is_array($company->addressArray)){
					$address = $company->addressArray[0];
					$this->tpl->set_var("address", $address->getFullAddress());
				}
	
				$this->tpl->parse("OwnerCompanyListBlock", "OwnerCompanyList", true);
			}
		}
		else{
			$this->tpl->set_block("rptsTemplate", "LIST", "ListBlock");
			$this->tpl->set_var("ListBlock", "no company records to list");
		}
	}

	function Main(){
		$this->setPageDetailPerms();

		switch($this->formArray["formAction"]){
			case "search":
				$condition = " (".COMPANY_TABLE.".companyName LIKE '%".fixQuotes($this->formArray["searchKey"])."%') ";

				$searchCount = $this->countRecords($condition);
				if($searchCount==0 || $searchCount==false){
					$this->displayPageNavigation();
					$this->displayRecords();
					$this->formArray["listType"] = "All";
					$this->formArray["resultsMessage"] = "| &nbsp; 0 results found for \"<b>".$this->formArray["searchKey"]."</b>\"";
				}
				else{
					$this->displayPageNavigation($condition);
					$this->displayRecords($condition);
					$this->formArray["listType"] = "Search Results";
					if($searchCount > 1) $s = "s";
					else $s = "";
					$this->formArray["resultsMessage"] = "| &nbsp; ".$searchCount." result".$s." found for \"<b>".$this->formArray["searchKey"]."</b>\"";
				}
				break;
			case "list":
			default:
				$this->displayPageNavigation();
				$this->displayRecords();
				$this->formArray["listType"] = "All";
				$this->formArray["resultsMessage"] = "";
				break;
		}

		$this->setForm();

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->tpl->set_var("sessionID", $this->sess->id);
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
//*
page_open(array("sess" => "rpts_Session"
	,"auth" => "rpts_Challenge_Auth"
	,"perm" => "rpts_Perm"
	));
//*/
$obj = new NoticeOfAssessmentList($sess,$sortKey,$sortOrder,$page,$HTTP_GET_VARS);
$obj->Main();
?>
<?php page_close(); ?>
