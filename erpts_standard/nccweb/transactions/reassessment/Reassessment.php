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
class Reassessment{
	
	var $tpl;
	var $formArray;
	function Reassessment($http_post_vars,$sess,$odID,$transactionCode){
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
		if (!$newOdID = $RPUEncode->CreateNewRPU_AFS_TD($this->formArray["odID"], $this->formArray["uid"], $this->formArray["transactionCode"])){
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

				$AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
				if($newAfsID = $AFSEncode->getAfsID($newOdID)){
					$this->formArray["afsID"] = $newAfsID;
					header("location: AFSDetails.php".$this->sess->url("")."&odID=".$newOdID."&afsID=".$newAfsID."&transactionCode=".$this->formArray["transactionCode"]);
				}
				else{
					header("location: ODDetails.php".$this->sess->url("")."&odID=".$newOdID);
				}
			}
		}

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
$obj = new Reassessment($HTTP_POST_VARS,$sess,$odID,$transactionCode);
$obj->main();
?>
<?php page_close(); ?>