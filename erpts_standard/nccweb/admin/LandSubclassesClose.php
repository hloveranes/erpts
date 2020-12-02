<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class LandSubclassesClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function LandSubclassesClose($landSubclassesID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode LandSubclasses");
		
		$this->formArray = array("landSubclassesID" => $landSubclassesID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "LandSubclassesList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("landSubclassesID"=>$this->formArray["landSubclassesID"],"formAction"=>"view")));
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
$landSubclassesClose = new LandSubclassesClose($landSubclassesID,$sess);
$landSubclassesClose->Main();
?>
<?php page_close(); ?>