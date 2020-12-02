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
class CancelReceipt{
	
	var $tpl;
	function CancelReceipt($http_post_vars,$searchKey,$formAction="",$sess,$receiptID=""){
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

		$this->tpl->set_file("rptsTemplate", "CancelReceipt.htm") ;
		$this->tpl->set_var("TITLE", "TM : Cancel Receipt");

		$this->formArray = array(
			"formAction" => $formAction
			, "receiptID" => $receiptID
			, "searchKey" => $searchKey
			, "listTitle" => ""
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

	function strikeout($str){
		$str = "<s>".$str."</s>";
		return $str;
	}

	function getOwnerNames($ownerID){
		$ownerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");

		if (!$xmlStr = $ownerList->getOwnerList($ownerID)){
			return "";
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				return "";
			}
			else {
				$ownerRecords = new OwnerRecords;
				$ownerRecords->parseDomDocument($domDoc);
				$list = $ownerRecords->getArrayList();

				$ownerNames = "";
				foreach($list as $owner){
					if(is_array($owner->getPersonArray())){
						$personArray = $owner->getPersonArray();
						foreach($personArray as $person){
							if($ownerNames!="") $ownerNames .= ", ";
							$ownerNames .= $person->getFullName();
						}
					}
					if(is_array($owner->getCompanyArray())){
						$companyArray = $owner->getCompanyArray();
						foreach($companyArray as $company){
							if($ownerNames!="") $ownerNames .= ", ";
							$ownerNames .= $company->getCompanyName();
						}
					}
				}

				return $ownerNames;
			}
		}
	}

	function Main(){
		switch ($this->formArray["formAction"]){
			case "search":
				$ReceiptList = new SoapObject(NCCBIZ."ReceiptList.php", "urn:Object");
				if (!$xmlStr = $ReceiptList->searchReceipt($this->formArray["searchKey"])){
					$this->tpl->set_block("rptsTemplate", "Found", "FoundBlock");
					$this->tpl->set_var("FoundBlock", "");
					$notFoundMessage = "&quot;".$this->formArray["searchKey"]."&quot; not found";
					$this->tpl->set_var("notFoundMessage",$notFoundMessage);
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
			 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
						$notFoundMessage = "&quot;".$this->formArray["searchKey"]."&quot; not found";
						$this->tpl->set_var("notFoundMessage",$notFoundMessage);
					}
					else {
						$receiptRecords = new ReceiptRecords;
						$receiptRecords->parseDomDocument($domDoc);
						$list = $receiptRecords->getArrayList();
						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "ReceiptList", "ReceiptListBlock");
							foreach ($list as $key => $value){
								$this->tpl->set_var("receiptID", $value->getReceiptID());
								$this->tpl->set_var("receiptNumber", $value->getReceiptNumber());
								$this->tpl->set_var("receiptDate", $value->getReceiptDate());

								$receivedFromName = $this->getOwnerNames($value->getReceivedFrom());

								$this->tpl->set_var("receivedFromName", $receivedFromName);
								$this->tpl->parse("ReceiptListBlock", "ReceiptList", true);
							}
							$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
							$this->tpl->set_var("NotFoundBlock", "");
						}
						else{
							$this->tpl->set_block("rptsTemplate", "Found", "FoundBlock");
							$this->tpl->set_var("FoundBlock", "");
						}
					}
				}
				break;
			case "cancel":
				$ReceiptList = new SoapObject(NCCBIZ."ReceiptList.php","urn:Object");
				if(is_array($this->formArray["receiptID"])){
					if(!$xmlStr = $ReceiptList->cancelReceiptList($this->formArray["receiptID"])){
						$this->tpl->set_block("rptsTemplate", "Found", "FoundBlock");
						$this->tpl->set_var("FoundBlock", "");
						$notFoundMessage = "0 receipts cancelled";
						$this->tpl->set_var("notFoundMessage",$notFoundMessage);
					}
					else{
						if(!$domDoc = domxml_open_mem($xmlStr)){
							$this->tpl->set_block("rptsTemplate", "Found", "FoundBlock");
							$this->tpl->set_var("FoundBlock", "");
							$notFoundMessage = "0 receipts cancelled";
							$this->tpl->set_var("notFoundMessage",$notFoundMessage);
						}
						else{
							$receiptRecords = new ReceiptRecords;
							$receiptRecords->parseDomDocument($domDoc);
							$list = $receiptRecords->getArrayList();

							if (count($list)){
								$this->formArray["listTitle"] = "Cancelled selected and associated Receipts";
								$this->tpl->set_block("rptsTemplate", "ReceiptList", "ReceiptListBlock");
								$this->tpl->set_block("ReceiptList", "HideCancelCheckbox", "HideCancelCheckboxBlock");
								foreach ($list as $key => $value){
									$this->tpl->set_var("receiptID", $this->strikeout($value->getReceiptID()));
									$this->tpl->set_var("receiptNumber", $this->strikeout($value->getReceiptNumber()));
									$this->tpl->set_var("receiptDate", $this->strikeout($value->getReceiptDate()));
	
									$receivedFromName = $this->getOwnerNames($value->getReceivedFrom());								
	
									$this->tpl->set_var("receivedFromName", $this->strikeout($receivedFromName));

									$this->tpl->set_var("HideCancelCheckboxBlock", "");
									$this->tpl->parse("ReceiptListBlock", "ReceiptList", true);
								}

								$this->tpl->set_block("rptsTemplate", "HideCancelBtn", "HideCancelBtnBlock");
								$this->tpl->set_var("HideCancelBtnBlock", "");

								$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
								$this->tpl->set_var("NotFoundBlock", "");
							}
							else{
								$this->tpl->set_block("rptsTemplate", "Found", "FoundBlock");
								$this->tpl->set_var("FoundBlock", "");
								$notFoundMessage = "0 receipts cancelled";
								$this->tpl->set_var("notFoundMessage",$notFoundMessage);
							}
						}
					}					
				}

				break;
			default:
				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "");
				$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
				$this->tpl->set_var("NotFoundBlock", "");
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
$cancelReceipt = new CancelReceipt($HTTP_POST_VARS,$searchKey,$formAction,$sess,$receiptID);
$cancelReceipt->Main();
?>
<?php page_close(); ?>
