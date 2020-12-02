<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class MachineriesClassesClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function MachineriesClassesClose($machineriesClassesID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode MachineriesClasses");
		
		$this->formArray = array("machineriesClassesID" => $machineriesClassesID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "MachineriesClassesList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("machineriesClassesID"=>$this->formArray["machineriesClassesID"],"formAction"=>"view")));
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
$machineriesClassesClose = new MachineriesClassesClose($machineriesClassesID,$sess);
$machineriesClassesClose->Main();
?>
<?php page_close(); ?>