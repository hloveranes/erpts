<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

#####################################
# Define Interface Class
#####################################
class QuarterlyComparativeReportOfActualRPTCollections{
	
	var $tpl;
	function QuarterlyComparativeReportOfActualRPTCollections($sess){
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

		$this->tpl->set_file("rptsTemplate", "QuarterlyComparativeReportOfActualRPTCollections.htm") ;
		$this->tpl->set_var("TITLE", "TM : Quarterly Comparative Report of the Actual Real Property Tax Collections");
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
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function getStartingYear(){
		$sql = "SELECT * FROM ".DUE_TABLE." ORDER BY dueDate ASC LIMIT 1;";
		$db = new DB_RPTS;
		$db->query($sql);
		if($db->next_record()){
			$dueDate = $db->f("dueDate");
			$startingYear = date("Y",strtotime($dueDate));
			return $startingYear;
		}
		return false;
	}

	function getEndingYear(){
		$sql = "SELECT * FROM ".DUE_TABLE." ORDER BY dueDate DESC LIMIT 1;";
		$db = new DB_RPTS;
		$db->query($sql);
		if($db->next_record()){
			$dueDate = $db->f("dueDate");
			$endingYear = date("Y",strtotime($dueDate));
			return $endingYear;
		}
		return false;
	}

	function Main(){
		$this->setForm();

		$this->tpl->set_block("rptsTemplate", "YearList", "YearListBlock");
		$startYear = $this->getStartingYear();
		$endYear = $this->getEndingYear();

		for($year=$startYear ; $year<=$endYear ; $year++){
			$this->tpl->set_var("year_selected", "");
			if($year==date("Y")){
				$this->tpl->set_var("year_selected", "selected");
			}
			$this->tpl->set_var("year", $year);
			$this->tpl->parse("YearListBlock", "YearList", true);
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
//*
page_open(array("sess" => "rpts_Session"
	,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/
$quarterlyComparativeReportOfActualRPTCollections = new QuarterlyComparativeReportOfActualRPTCollections($sess);
$quarterlyComparativeReportOfActualRPTCollections->Main();
?>
<?php page_close(); ?>
