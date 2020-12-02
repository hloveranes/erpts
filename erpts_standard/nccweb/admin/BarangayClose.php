<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class BarangayClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function BarangayClose($barangayID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode Barangay");
		
		$this->formArray = array("barangayID" => $barangayID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "BarangayList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("barangayID"=>$this->formArray["barangayID"],"formAction"=>"view")));
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
$barangayEncode = new BarangayClose($barangayID,$sess);
$barangayEncode->Main();
?>
<?php page_close(); ?>