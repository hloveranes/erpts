<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";

include_once "../collection/Collection.php";
include_once "../collection/CollectionRecords.php";

include_once "../collection/Payment.php";
include_once "../collection/PaymentRecords.php";

include_once "../collection/Receipt.php";
include_once "../collection/ReceiptRecords.php";

include_once "../assessor/Owner.php";
include_once "../assessor/OwnerRecords.php";
include_once "../assessor/Person.php";
include_once "../assessor/Company.php";

#####################################
# Define Interface Class
#####################################
class PurgeReceipt{
	
	var $tpl;
	function PurgeReceipt($http_post_vars,$formAction="",$sess){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must have atleast TM-EDIT access
		$pageType = "%%%1%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: UnauthorizedPopup.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "PurgeReceipt.htm") ;
		$this->tpl->set_var("TITLE", "TM : Purge Receipt");

		$this->formArray = array(
			"formAction" => $formAction
		);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function Main(){
		switch ($this->formArray["formAction"]){
			case "purge":
				$ReceiptList = new SoapObject(NCCBIZ."ReceiptList.php","urn:Object");
				if(!$totalPurgedReceipts = $ReceiptList->purgeReceiptList()){
					$this->tpl->set_var("totalPurgedReceipts",0);
				}
				else{
					$this->tpl->set_var("totalPurgedReceipts",$totalPurgedReceipts);
				}

				$this->tpl->set_block("rptsTemplate", "Default", "DefaultBlock");
				$this->tpl->set_var("DefaultBlock", "");
				break;
			default:
				$ReceiptList = new SoapObject(NCCBIZ."ReceiptList.php","urn:Object");
				if(!$totalReceipts = $ReceiptList->getReceiptCount("WHERE status=''")){
					$this->tpl->set_var("totalReceipts",0);
				}
				else{
					$this->tpl->set_var("totalReceipts",$totalReceipts);
				}

				if(!$countReceiptsForPurging = $ReceiptList->countPurgeReceiptList()){
					$this->tpl->set_var("countReceiptsForPurging",0);
				}
				else{
					$this->tpl->set_var("countReceiptsForPurging",$countReceiptsForPurging);
				}

				$this->tpl->set_block("rptsTemplate", "Results", "ResultsBlock");
				$this->tpl->set_var("ResultsBlock", "");
		}
		$this->setForm();

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->tpl->set_var("Session", $this->sess->url(""));
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
$purgeReceipt = new PurgeReceipt($HTTP_POST_VARS,$formAction,$sess);
$purgeReceipt->Main();
?>
<?php page_close(); ?>
