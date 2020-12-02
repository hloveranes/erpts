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
include_once "../includes/assessor/ODRecords.php";

#####################################
# Define Interface Class
#####################################
class GeneralRevision{
	
	var $tpl;
	function GeneralRevision($http_post_vars,$formAction,$totalArchived,$totalCreated,$sess){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must be Super-User to access
		$pageType = "1%%%%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->userID = $auth->auth["uid"];
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "GeneralRevision.htm") ;
		$this->tpl->set_var("TITLE", "General Revision");
		$this->tpl->set_var("Session", $this->sess->url(""));

		$this->formArray = array(
			"formAction" => $formAction
			,"totalArchived" => $totalArchived
			,"totalCreated" => $totalCreated
		);

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	function Main(){
		switch ($this->formArray["formAction"]){
			case "run":
				$RPUEncode = new SoapObject(NCCBIZ."RPUEncode.php", "urn:Object");
				$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");
				$oldOdIDList = $ODList->getLatestActiveODList();

				if(count($oldOdIDList) > 0){
					foreach($oldOdIDList as $key=>$odID){
						$newOdIDList[] = $RPUEncode->RunGeneralRevision($odID,$this->userID,"GR");
					}

					$totalArchived = count($oldOdIDList);
					$totalCreated = count($newOdIDList);

					$url = "GeneralRevision.php" . $this->sess->url("") . "&formAction=done&totalArchived=".$totalArchived."&totalCreated=".$totalCreated;
					header("Location: ".$url);

					exit;
				}
				else{
	 				$message = "Error. No RPUs to run General Revision.";
					$this->tpl->set_var("message", $message);
				}

				break;
			case "done":
		        $this->tpl->set_block("rptsTemplate", "FormButton", "FormButtonBlock");
				$this->tpl->set_var("FormButtonBlock", "");

 				$message = "General Revision successfully completed.<br><br>";
				$message.= "<br>RPUs Archived: ".$this->formArray["totalArchived"];
				$message.= "<br>RPUs Created: ".$this->formArray["totalCreated"];

				$this->tpl->set_var("message", $message);

				break;
			default:
				$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");
				$oldOdIDList = $ODList->getLatestActiveODList();

				$message = "Latest Active RPUs :" . count($oldOdIDList);
				$message .="<br>";
				$messaeg = "";

				$this->tpl->set_var("message", $message);

				//print_r($oldOdIDList);
				//echo "google!";
				break;
		}

		$this->tpl->set_var("Session", $this->sess->url(""));

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

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
	//,"perm" => "rpts_Perm"
	));
//*/
$generalRevision = new GeneralRevision($HTTP_POST_VARS,$formAction,$totalArchived,$totalCreated,$sess);
$generalRevision->Main();
?>
<?php page_close(); ?>
