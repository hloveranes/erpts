<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class ImprovementsBuildingsActualUsesClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function ImprovementsBuildingsActualUsesClose($improvementsBuildingsActualUsesID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode ImprovementsBuildingsActualUses");
		
		$this->formArray = array("improvementsBuildingsActualUsesID" => $improvementsBuildingsActualUsesID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "ImprovementsBuildingsActualUsesList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("improvementsBuildingsActualUsesID"=>$this->formArray["improvementsBuildingsActualUsesID"],"formAction"=>"view")));
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
$improvementsBuildingsActualUsesClose = new ImprovementsBuildingsActualUsesClose($improvementsBuildingsActualUsesID,$sess);
$improvementsBuildingsActualUsesClose->Main();
?>
<?php page_close(); ?>