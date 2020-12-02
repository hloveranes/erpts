<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Company.php";

#####################################
# Define Interface Class
#####################################
class OwnerCompanyList{
	
	var $tpl;
	function OwnerCompanyList($sess,$sortKey,$sortOrder,$page){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		$this->formArray["sortKey"] = "TRIM(Company.companyName)";
		$this->formArray["sortOrder"] = "asc";
		$this->formArray["page"] = 1;
	
		if($sortKey!="")
			$this->formArray["sortKey"] = $sortKey;
		if($sortOrder!="")
			$this->formArray["sortOrder"] = $sortOrder;

		if($page!=""){
			$this->formArray["page"] = $page;
		}

		// must be Super-User to access
		$pageType = "1%%%%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "OwnerCompanyList.htm") ;
		$this->tpl->set_var("TITLE", "Owner Company List");
	}

	// Start DB Functions

	function setDB(){
		$this->db = new DB_RPTS;
	}
	function countRecords($condition=""){
		$this->setDB();
		$sql = sprintf(
				"SELECT COUNT(DISTINCT(OwnerCompany.companyID)) as count".
				" FROM OwnerCompany,Company ".
				" WHERE OwnerCompany.companyID = Company.companyID ".
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
	function selectRecords($condition=" ORDER BY TRIM(Company.companyName) ASC LIMIT 0,10"){
		$this->setDB();
		$sql = sprintf(
				"SELECT DISTINCT(OwnerCompany.companyID) as companyID".
				" FROM OwnerCompany,Company ".
				" WHERE OwnerCompany.companyID = Company.companyID ".
				" %s;",
				$condition);

		$this->db->query($sql);	
		
		while ($this->db->next_record()) {
			$company = new Company;
			$company->selectRecord($this->db->f("companyID"));
			$this->arrayList[] = $company;
		}
	}
	function displayPageNavigation(){
		$totalRecords = $this->countRecords();

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
	}
	function displayRecords(){
		$condition = "ORDER BY ".$this->formArray["sortKey"]. " ".$this->formArray["sortOrder"];

		if($this->formArray["page"] > 0){
			$this->formArray["page"] = ($this->formArray["page"]-1) * PAGE_BY;
		}

		$condition .= " LIMIT ".$this->formArray["page"].",".PAGE_BY;
	
		$this->selectRecords($condition);

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
			$this->tpl->set_var("tin", $company->getTin());
			$this->tpl->set_var("telephone", $company->getTelephone());
			$this->tpl->set_var("fax", $company->getFax());
			$this->tpl->set_var("website", $company->getWebsite());
			$this->tpl->set_var("email", $company->getEmail());

			if(is_array($company->addressArray)){
				$address = $company->addressArray[0];
				$this->tpl->set_var("address", $address->getFullAddress());
			}

			$this->tpl->parse("OwnerCompanyListBlock", "OwnerCompanyList", true);
		}
	}

	// End DB Functions

	function Main(){
		$this->displayPageNavigation();
		$this->displayRecords();

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
//*
page_open(array("sess" => "rpts_Session"
	,"auth" => "rpts_Challenge_Auth"
	,"perm" => "rpts_Perm"
	));
//*/
$obj = new OwnerCompanyList($sess,$sortKey,$sortOrder,$page);
$obj->Main();
?>
<?php page_close(); ?>
