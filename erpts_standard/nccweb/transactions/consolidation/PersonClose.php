<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class PersonClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function PersonClose($sess,$parentURL){
		$this->sess = $sess;
		$this->parentURL = $parentURL;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode Person");
	}
	
	
	function Main(){
		$this->tpl->set_var("location", $this->parentURL);
		$this->tpl->set_var("Session", "");
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
$personClose = new PersonClose($sess,$parentURL);
$personClose->main();
?>
<?php page_close(); ?>