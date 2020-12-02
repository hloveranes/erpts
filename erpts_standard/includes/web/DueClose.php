<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class DueClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function DueClose($rptopID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode Due");
		
		$this->formArray = array("rptopID" => $rptopID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "CalculateRPTOPDetails.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("rptopID"=>$this->formArray["rptopID"],"formAction"=>"view")));
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
	//"perm" => "rpts_Perm"
	));
//*/
$dueClose = new DueClose($rptopID,$sess);
$dueClose->main();
?>
<?php page_close(); ?>
