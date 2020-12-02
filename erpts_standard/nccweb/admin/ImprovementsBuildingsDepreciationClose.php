<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class ImprovementsBuildingsDepreciationClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function ImprovementsBuildingsDepreciationClose($improvementsBuildingsDepreciationID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode ImprovementsBuildingsDepreciation");
		
		$this->formArray = array("improvementsBuildingsDepreciationID" => $improvementsBuildingsDepreciationID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "ImprovementsBuildingsDepreciationList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("improvementsBuildingsDepreciationID"=>$this->formArray["improvementsBuildingsDepreciationID"],"formAction"=>"view")));
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
$improvementsBuildingsDepreciationClose = new ImprovementsBuildingsDepreciationClose($improvementsBuildingsDepreciationID,$sess);
$improvementsBuildingsDepreciationClose->Main();
?>
<?php page_close(); ?>