<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class ProvinceClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function ProvinceClose($provinceID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode Province");
		
		$this->formArray = array("provinceID" => $provinceID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "ProvinceList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("provinceID"=>$this->formArray["provinceID"],"formAction"=>"view")));
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
$provinceClose = new ProvinceClose($provinceID,$sess);
$provinceClose->Main();
?>
<?php page_close(); ?>