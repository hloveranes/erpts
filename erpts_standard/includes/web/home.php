<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";

#####################################
# Define Interface Class
#####################################
class Home{
	
	var $tpl;
	function Home($sess){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "home.htm") ;
		$this->tpl->set_var("TITLE", "Main");
	}

	function hideBlock($tempVar){
		$this->tpl->set_block("rptsTemplate", $tempVar, $tempVar."Block");
		$this->tpl->set_var($tempVar."Block", "");
	}

	function setPageDetailPerms(){
		// Check Admin Permissions
		if(!checkPerms($this->user["userType"],"1%%%%%%%%%")){
			$this->hideBlock("AdminModuleLink");

		}
		else{
			$this->hideBlock("AdminModuleText");
		}

		// Check Assessor's Module Permissions
		if(!checkPerms($this->user["userType"],"%%1%%%%%%%")){
			$this->hideBlock("AssessorsModuleLink");

		}
		else{
			$this->hideBlock("AssessorsModuleText");
		}

		// Check Treasurer's Module Permissions
		if(!checkPerms($this->user["userType"],"%%%%1%%%%%")){
			$this->hideBlock("TreasurersModuleLink");

		}
		else{
			$this->hideBlock("TreasurersModuleText");
		}


	}

	function Main(){
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
$obj = new Home($sess);
$obj->main();
?>
<?php page_close(); ?>
