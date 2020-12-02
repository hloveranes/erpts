<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class DistrictClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function DistrictClose($districtID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode District");
		
		$this->formArray = array("districtID" => $districtID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "DistrictList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("districtID"=>$this->formArray["districtID"],"formAction"=>"view")));
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
$districtClose = new DistrictClose($districtID,$sess);
$districtClose->Main();
?>
<?php page_close(); ?>