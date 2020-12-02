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
	
	function RPTOPList($sess,$http_post_vars){
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

		$this->tpl->set_file("rptsTemplate", "ViewSOA.htm") ;
		$this->tpl->set_var("TITLE", "TM : View SOA");		
		$this->sess = $sess;

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function setPersonList(){
		$db = new DB_RPTS();
		$db1 = new DB_RPTS();
		$db->query("SELECT DISTINCT personID from OwnerPerson inner join Owner on Owner.ownerID=OwnerPerson.ownerID where Owner.rptopID <> ''");
		$this->tpl->set_block("rptsTemplate","Owner","oBlk");
		for($i=0;$db->next_record();$i++){
			$personID = $db->f("personID");
				$person = new Person;
				if ($person->selectRecord($personID)){ //$setPersonArray($person);
				$this->tpl->set_var(ownerName,$person->getFullName());
				$this->tpl->set_var(ownerID,$personID);
				}
				$this->tpl->parse("oBlk","Owner",true);
		}
	}
	
	function setCompanyList(){
		$db = new DB_RPTS();
		$db1 = new DB_RPTS();
		$db->query("SELECT DISTINCT companyID from OwnerCompany inner join Owner on Owner.ownerID=OwnerCompany.ownerID where Owner.rptopID <> ''");
		$this->tpl->set_block("rptsTemplate","Company","cBlk");
		for($i=0;$db->next_record();$i++){
			$companyID = $db->f("companyID");
				$company = new Company;
				if ($company->selectRecord($companyID)){ //$setPersonArray($person);
				$this->tpl->set_var(companyName,$company->getCompanyName());
				$this->tpl->set_var(companyID,$companyID);
				}
				$this->tpl->parse("cBlk","Company",true);
		}
	}

	function setMunicipalityList() {
		$db = new DB_RPTS();
		$db->query("SELECT * FROM MunicipalityCity order by description");
		$this->tpl->set_block("rptsTemplate","MUNICIPALITY","municipalityBlk");

		for($i=0;$db->next_record();$i++){
			foreach ($db->Record as $k=>$v) {
				$this->tpl->set_var("mun_$k",$v);
			}
			$this->tpl->parse(municipalityBlk,MUNICIPALITY,true);
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
	
	
	function Main(){
		$this->setMunicipalityList();
		$this->setPersonList();
		$this->setCompanyList();
		$status = (isset($_POST['status']))? $_POST['status']:$_GET['status'];
		if($status==1){
			$this->tpl->set_var(status_report,"Invalid Owner Please Select Another");
		}elseif($status==2){
			$this->tpl->set_var(status_report,"Invalid MunicipalityCity Please Select Another");
		}elseif($status==""){
			$this->tpl->set_block("rptsTemplate","STAT","sBlk");
			$this->tpl->parse("sBlk","STAT",false);
		}

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->setPageDetailPerms();		
		
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
page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
if(!$page) $page = 1;
$rptopList = new RPTOPList($sess,$HTTP_POST_VARS);
$rptopList->main();
?>
<?php page_close(); ?>
