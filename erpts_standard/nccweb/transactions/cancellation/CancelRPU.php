<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

include_once "../includes/assessor/LocationAddress.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/OD.php";
include_once "../includes/assessor/AFS.php";


#####################################
# Define Interface Class
#####################################
class CancelRPU{
	
	var $tpl;
	var $formArray;
	function CancelRPU($http_post_vars,$sess,$odID,$transactionCode){
		global $auth;

		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->formArray["odID"] = $odID;
		$this->formArray["transactionCode"] = $transactionCode;

		$this->formArray["uid"] = $auth->auth["uid"];

		$this->formArray["odID"] = $odID;
		$this->formArray["transactionCode"] = $transactionCode;

		if($this->formArray["odID"]==""){
			echo "cannot Cancel RPU. <a href='ODList.php".$this->sess->url("")."'>click here</a> to go back to <a href='ODList.php".$this->sess->url("")."'>list</a>.";
			exit;
		}

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function Main(){
		$RPUEncode = new SoapObject(NCCBIZ."RPUEncode.php", "urn:Object");
		//if($RPUEncode->isRPUOkForCancellation($this->formArray["odID"])){
			$RPUEncode->cancelRPU($this->formArray["odID"],$this->formArray["uid"],"CA");
		//}
		//else{
		//	header("location: ODDetails.php".$this->sess->url("")."&odID=".$this->formArray["odID"]."&transactionCode=&formAction=cancelError");
		//	exit;
		//}

		header("location: ODDetails.php".$this->sess->url("")."&odID=".$this->formArray["odID"]."&transactionCode=".$this->formArray["transactionCode"]);
		exit;
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

$obj = new CancelRPU($HTTP_POST_VARS,$sess,$odID,$transactionCode);
$obj->main();
?>
<?php page_close(); ?>