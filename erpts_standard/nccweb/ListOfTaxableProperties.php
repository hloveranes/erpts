<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

include_once "../includes/assessor/OD.php";
include_once "../includes/assessor/ODRecords.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/AFSRecords.php";

#####################################
# Define Interface Class
#####################################
class ListOfTaxableProperties{
	
	var $tpl;
	function ListOfTaxableProperties($sess){
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

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ListOfTaxableProperties.htm") ;
		$this->tpl->set_var("TITLE", "List of Taxable Properties");
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

	function setDB(){
		$this->db = new DB_RPTS;
	}

	function Main(){

		$sql = "SELECT COUNT(".OD_TABLE.".odID) as count ";
		$sql.=" FROM ".OD_TABLE.", ".AFS_TABLE." WHERE ".OD_TABLE.".odID = ".AFS_TABLE.".odID AND ";
		$sql.=" ".AFS_TABLE.".taxability = 'Taxable' AND ".OD_TABLE.".archive !=  'true'";

		$this->setDB();

		$this->db->query($sql);

		if ($this->db->next_record()) {
			$count = $this->db->f("count");
		}
		else{
			$count = "0";
		}

		$this->tpl->set_var("countTaxableProperties", $count);

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
//*
page_open(array("sess" => "rpts_Session"
	,"auth" => "rpts_Challenge_Auth"
	,"perm" => "rpts_Perm"
	));
//*/
$listOfTaxableProperties = new ListOfTaxableProperties($sess);
$listOfTaxableProperties->Main();
?>
<?php page_close(); ?>
