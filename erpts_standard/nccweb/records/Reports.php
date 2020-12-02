<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

#####################################
# Define Interface Class
#####################################
class Reports{
	
	var $tpl;
	function Reports($sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "Reports.htm") ;
		$this->tpl->set_var("TITLE", "Reports");
	}
	function Main(){
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
$obj = new Reports($sess);
$obj->Main();
?>
<?php page_close(); ?>
