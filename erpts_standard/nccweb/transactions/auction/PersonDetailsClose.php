<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class PropertyInfoClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function PropertyInfoClose($odID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "");
		
		$this->formArray = array("odID" => $odID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "ODDetails.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("odID"=>$this->formArray["odID"],"formAction"=>"view")));
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
	//,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/
$odEncode = new PropertyInfoClose($odID,$sess);
$odEncode->main();
?>
<?php page_close(); ?>