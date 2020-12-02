<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
#####################################
# Define Interface Class
#####################################
class UserClose{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function UserClose($userID,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PageClose.htm") ;
		$this->tpl->set_var("TITLE", "Encode User");
		
		$this->formArray = array("userID" => $userID);
	}
	
	
	function Main(){
		$this->tpl->set_var("location", "UserList.php";
		$this->tpl->set_var("Session",$this->sess->url("").$this->sess->add_query(array("userID"=>$this->formArray["userID"],"formAction"=>"view")));
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
$userEncode = new UserClose($userID,$sess);
$userEncode->Main();
?>
<?php page_close(); ?>
