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
class ChangeOfOwnership{
	
	var $tpl;
	var $formArray;
	function ChangeOfOwnership($http_post_vars,$sess,$odID){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->formArray["odID"] = $odID;
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function Main(){
		$RPUEncode = new SoapObject(NCCBIZ."RPUEncode.php", "urn:Object");
		if (!$newOdID = $RPUEncode->CreateNewRPU_AFS_TD($this->formArray["odID"])){
			echo $this->formArray["odID"]."<br>";
			exit("create failed");
		}
		else{
			$this->formArray["odID"] = $newOdID;
			header("location: ODDetails.php".$this->sess->url("").$this->sess->add_query(array("odID"=>$this->formArray["odID"])));
		}

		$this->setForm();
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("odID"=>$this->formArray["odID"],"ownerID" => $this->formArray["ownerID"])));
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
$obj = new ChangeOfOwnership($HTTP_POST_VARS,$sess,$odID);
$obj->main();
?>
<?php page_close(); ?>