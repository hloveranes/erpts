<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class Unauthorized{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function Unauthorized($sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "Unauthorized.htm") ;
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
$unauthorized = new Unauthorized($sess);
$unauthorized->Main();
?>
<?php page_close(); ?>