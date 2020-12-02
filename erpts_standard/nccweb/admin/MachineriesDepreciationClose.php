<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class MachineriesDepreciationClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function MachineriesDepreciationClose($machineriesDepreciationID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode MachineriesDepreciation");
		
		$this->formArray = array("machineriesDepreciationID" => $machineriesDepreciationID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "MachineriesDepreciationList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("machineriesDepreciationID"=>$this->formArray["machineriesDepreciationID"],"formAction"=>"view")));
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
$machineriesDepreciationClose = new MachineriesDepreciationClose($machineriesDepreciationID,$sess);
$machineriesDepreciationClose->Main();
?>
<?php page_close(); ?>