<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class LandClassesClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function LandClassesClose($landClassesID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode LandClasses");
		
		$this->formArray = array("landClassesID" => $landClassesID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "LandClassesList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("landClassesID"=>$this->formArray["landClassesID"],"formAction"=>"view")));
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
$landClassesClose = new LandClassesClose($landClassesID,$sess);
$landClassesClose->Main();
?>
<?php page_close(); ?>