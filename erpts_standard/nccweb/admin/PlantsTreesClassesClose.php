<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class PlantsTreesClassesClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function PlantsTreesClassesClose($landSubclassesID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode PlantsTreesClasses");
		
		$this->formArray = array("plantsTreesClassesID" => $plantsTreesClassesID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "PlantsTreesClassesList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("plantsTreesClassesID"=>$this->formArray["plantsTreesClassesID"],"formAction"=>"view")));
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
$plantsTreesClassesClose = new PlantsTreesClassesClose($plantsTreesClassesID,$sess);
$plantsTreesClassesClose->Main();
?>
<?php page_close(); ?>