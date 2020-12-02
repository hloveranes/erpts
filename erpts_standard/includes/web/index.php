<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";

#####################################
# Define Interface Class
#####################################
class Login{
	
	var $tpl;
	function Login($http_post_vars,$sess){
		$this->sess = $sess;
	}
	
	function setForm(){
	}
		
	function Main(){
		//header("location: ODList.php";
		header("location: home.php".$this->sess->url(""));
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
$ownerList = new Login($HTTP_POST_VARS,$sess,$afsID,$type);
$ownerList->Main();
?>
<?php page_close(); ?>
