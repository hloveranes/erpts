<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

#####################################
# Define Interface Class
#####################################
class Home{
	
	var $tpl;
	function Home($sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "Collection.htm") ;
		$this->tpl->set_var("TITLE", "Home");
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
	//"perm" => "rpts_Perm"
	));
//*/
$obj = new Home($sess);
$obj->main();
?>
<?php page_close(); ?>
