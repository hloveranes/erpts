<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

include_once "../includes/records/LGU.php";

#####################################
# Define Interface Class
#####################################
class ProvincialQuarterlyReportOnRPTCollections{
	
	var $tpl;
	function ProvincialQuarterlyReportOnRPTCollections($sess){
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

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ProvincialQuarterlyReportOnRPTCollections.htm") ;
		$this->tpl->set_var("TITLE", "TM : Provincial Quarterly Report On RPT Collections");
	}

	function hideBlock($tempVar){
		$this->tpl->set_block("rptsTemplate", $tempVar, $tempVar."Block");
		$this->tpl->set_var($tempVar."Block", "");
	}

	function setPageDetailPerms(){
		if(!checkPerms($this->user["userType"],"%%%1%%%%%%")){
			// hide Blocks if userType is not at least TM-Edit
			$this->hideBlock("TreasuryMaintenanceLink");
		}
		else{
			$this->hideBlock("TreasuryMaintenanceLinkText");
		}
	}

	function setForm(){
		$startYear = date("Y")-25;
		$endYear = date("Y")+5;
		$this->tpl->set_block("rptsTemplate", "YearList", "YearListBlock");
		for($i = $endYear; $i>=$startYear; $i--){
			$this->tpl->set_var("year", $i);
			$this->tpl->parse("YearListBlock", "YearList", true);
		}

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function Main(){
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

		$this->setForm();

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
//*
page_open(array("sess" => "rpts_Session"
	,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/
$provincialQuarterlyReportOnRPTCollections = new ProvincialQuarterlyReportOnRPTCollections($sess);
$provincialQuarterlyReportOnRPTCollections->Main();
?>
<?php page_close(); ?>
