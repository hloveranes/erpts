<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class UnauthorizedPopup{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function UnauthorizedPopup($sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "UnauthorizedPopup.htm") ;
		$this->tpl->set_var("TITLE", "Unauthorized");
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
	//,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/
$unauthorizedPopup = new UnauthorizedPopup($sess);
$unauthorizedPopup->Main();
?>
<?php page_close(); ?>