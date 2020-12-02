<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class MachineriesActualUsesClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function MachineriesActualUsesClose($machineriesActualUsesID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode MachineriesActualUses");
		
		$this->formArray = array("machineriesActualUsesID" => $machineriesActualUsesID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "MachineriesActualUsesList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("machineriesActualUsesID"=>$this->formArray["machineriesActualUsesID"],"formAction"=>"view")));
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
$machineriesActualUsesClose = new MachineriesActualUsesClose($machineriesActualUsesID,$sess);
$machineriesActualUsesClose->Main();
?>
<?php page_close(); ?>