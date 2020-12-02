<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../records/LGU.php";

#####################################
# Define Interface Class
#####################################
class SummaryReportList{
	
	var $tpl;
	function SummaryReportList($sess){
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

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->tpl->set_file("rptsTemplate", "SummaryReportList.htm") ;
		$this->tpl->set_var("TITLE", "SummaryReportList");
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

	function Main(){
		$this->tpl->set_var("Session", $this->sess->url(""));
		$db = new DB_Records;
		$sql = sprintf("select %s from %s order by LGUName;",
				"LGUID", LGU_TABLE);
		//echo $sql;
		$db->query($sql);
		$this->tpl->set_block("rptsTemplate", "DBList", "DBListBlock");
		while ($db->next_record()) {
			$lgu = new LGU;
			$lgu->selectRecord($db->f("LGUID"));
			$this->tpl->set_var("lguName", $lgu->getLGUDB());
			$this->tpl->set_var("lguDB", $lgu->getLGUID());
			$this->tpl->parse("DBListBlock", "DBList", true);
		}

		$this->setPageDetailPerms();


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
$obj = new SummaryReportList($sess);
$obj->Main();
?>
<?php page_close(); ?>
