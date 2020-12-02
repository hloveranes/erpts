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
class AuctionProperty{
	
	var $tpl;
	var $formArray;
	function AuctionProperty($http_post_vars,$sess,$odID,$transactionCode){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->formArray["odID"] = $odID;
		$this->formArray["transactionCode"] = $transactionCode;

		$this->formArray["uid"] = $auth->auth["uid"];

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function Main(){
		$RPUEncode = new SoapObject(NCCBIZ."RPUEncode.php", "urn:Object");
		if (!$newOdID = $RPUEncode->CreateNewRPU_AFS_TD($this->formArray["odID"], $this->formArray["uid"], $this->formArray["transactionCode"],false)){
			echo $this->formArray["odID"]."<br>";
			exit("create failed");
		}
		else{
			$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");

			$archiveValue = "true";
			$userID = $this->formArray["uid"];
			$odIDArray[] = $this->formArray["odID"];

			if(!$archiveRows = $ODList->archiveOD($odIDArray,$archiveValue,$userID)){
				exit("archive failed");
			}
			else{
				$this->formArray["odID"] = $newOdID;

				header("location: ODDetails.php".$this->sess->url("")."&odID=".$newOdID."&transactionCode=".$this->formArray["transactionCode"]);
			}
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
$obj = new AuctionProperty($HTTP_POST_VARS,$sess,$odID,$transactionCode);
$obj->main();
?>
<?php page_close(); ?>