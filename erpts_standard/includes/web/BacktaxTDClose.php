<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class TDClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function TDClose($afsID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode Backtaxes");
		
		$this->formArray = array("afsID" => $afsID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "BacktaxesAFSDetails.php";
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
$tdEncode = new TDClose($afsID,$sess);
$tdEncode->main();
?>
<?php page_close(); ?>