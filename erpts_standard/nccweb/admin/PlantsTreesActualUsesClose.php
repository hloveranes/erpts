<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class PlantsTreesActualUsesClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function PlantsTreesActualUsesClose($plantsTreesActualUsesID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode PlantsTreesActualUses");
		
		$this->formArray = array("plantsTreesActualUsesID" => $plantsTreesActualUsesID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "PlantsTreesActualUsesList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("plantsTreesActualUsesID"=>$this->formArray["plantsTreesActualUsesID"],"formAction"=>"view")));
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
$plantsTreesActualUsesClose = new PlantsTreesActualUsesClose($plantsTreesActualUsesID,$sess);
$plantsTreesActualUsesClose->Main();
?>
<?php page_close(); ?>