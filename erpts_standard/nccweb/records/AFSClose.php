<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class AFSClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function AFSClose($afsID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode PropertyInfo");
		
		$this->formArray = array("afsID" => $afsID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "AFSDetails.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"],"formAction"=>"view")));
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
$afsEncode = new AFSClose($afsID,$sess);
$afsEncode->main();
?>
<?php page_close(); ?>