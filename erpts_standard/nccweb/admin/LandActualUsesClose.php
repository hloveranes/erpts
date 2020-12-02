<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class LandActualUsesClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function LandActualUsesClose($landActualUsesID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode LandActualUses");
		
		$this->formArray = array("landActualUsesID" => $landActualUsesID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "LandActualUsesList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("landActualUsesID"=>$this->formArray["landActualUsesID"],"formAction"=>"view")));
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
$landActualUsesClose = new LandActualUsesClose($landActualUsesID,$sess);
$landActualUsesClose->Main();
?>
<?php page_close(); ?>