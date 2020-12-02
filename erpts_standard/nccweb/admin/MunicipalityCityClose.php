<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class MunicipalityCityClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function MunicipalityCityClose($municipalityCityID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode MunicipalityCity");
		
		$this->formArray = array("municipalityCityID" => $municipalityCityID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "MunicipalityCityList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("municipalityCityID"=>$this->formArray["municipalityCityID"],"formAction"=>"view")));
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
$municipalityCityClose = new MunicipalityCityClose($municipalityCityID,$sess);
$municipalityCityClose->Main();
?>
<?php page_close(); ?>