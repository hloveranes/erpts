<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";

include_once "../assessor/Address.php";
include_once "../assessor/Company.php";
include_once "../assessor/CompanyRecords.php";
include_once "../assessor/Person.php";
include_once "../assessor/PersonRecords.php";
include_once "../assessor/Owner.php";
include_once "../assessor/OwnerRecords.php";
include_once "../assessor/RPTOP.php";
include_once "../assessor/AFS.php";

include_once "../collection/Due.php";
include_once "../collection/Payment.php";
include_once "../collection/Receipt.php";
include_once "../collection/Collection.php";

include_once "../collection/ReceiptRecords.php";
include_once "../collection/CollectionRecords.php";

#####################################
# Define Interface Class
#####################################
class PrintReceiptDetails{
	
	var $tpl;
	var $formArray;
	function PrintReceiptDetails($sess,$rptopID,$ownerID,$receiptIDArray){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must have atleast TM-VIEW access
		$pageType = "%%%%1%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "PrintReceiptDetails.htm") ;
		$this->tpl->set_var("TITLE", "Print Receipt");

		$this->formArray["rptopID"] = $rptopID;
		$this->formArray["ownerID"] = $ownerID;

		$this->formArray["receiptIDArray"] = $receiptIDArray;
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function hideBlock($tempVar){
		$this->tpl->set_block("rptsTemplate", $tempVar, $tempVar."Block");
		$this->tpl->set_var($tempVar."Block", "");
	}

	function setPageDetailPerms(){
		if(!checkPerms($this->user["userType"],"%%%1%%%%%%")){
			// hide Blocks if userType is not at least TM-Edit
			$this->hideBlock("GenerateRPTOPLink");
			$this->hideBlock("TreasuryMaintenanceLink");
		}
		else{
			$this->hideBlock("GenerateRPTOPLinkText");
			$this->hideBlock("TreasuryMaintenanceLinkText");
		}
	}

	function displayOwnerList($domDoc){
		$owner = new Owner;
		$owner->parseDomDocument($domDoc);
		//$list = $owner->getArrayList();
		//foreach ($list as $key => $value){
			if (count($owner->personArray)){
				$this->tpl->set_block("rptsTemplate", "PersonDBEmpty", "PersonDBEmptyBlock");
				$this->tpl->set_var("PersonDBEmptyBlock", "");
				$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
				foreach($owner->personArray as $personKey =>$personValue){
					$this->tpl->set_var("personID", $personValue->getPersonID());
					if (!$pname = $personValue->getFullName()){
						$pname = "none";
					}
					$this->tpl->set_var("fullName", $pname);
					$this->tpl->set_var("tin", $personValue->getTin());
					$this->tpl->set_var("telephone", $personValue->getTelephone());
					$this->tpl->set_var("mobileNumber", $personValue->getMobileNumber());
					$this->tpl->parse("PersonListBlock", "PersonList", true);
				}
			}
			else{
				$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
				$this->tpl->set_var("PersonListBlock", "");
			}
			if (count($owner->companyArray)){
				$this->tpl->set_block("rptsTemplate", "CompanyDBEmpty", "CompanyDBEmptyBlock");
				$this->tpl->set_var("CompanyDBEmptyBlock", "");
				$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
				//print_r($value->companyArray);
				foreach ($owner->companyArray as $companyKey => $companyValue){
					$this->tpl->set_var("companyID", $companyValue->getCompanyID());
					if (!$cname = $companyValue->getCompanyName()){
						$cname = "none";
					}
					$this->tpl->set_var("companyName", $cname);
					$this->tpl->set_var("tin", $companyValue->getTin());
					$this->tpl->set_var("telephone", $companyValue->getTelephone());
					$this->tpl->set_var("fax", $companyValue->getFax());
					$this->tpl->parse("CompanyListBlock", "CompanyList", true);
				}
			}
			else{
				$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
				$this->tpl->set_var("CompanyListBlock", "");	
			}
		//}
	}

	function getTotalAmountPaid($receiptID){
		if($collectionRecords = $this->getCollectionRecordsFromReceiptID($receiptID)){
			$collectionArrayList = $collectionRecords->getArrayList();
			if(is_array($collectionArrayList)){
				$totalAmountPaid = 0;
				foreach($collectionArrayList as $collection){
					$totalAmountPaid += $collection->getAmountPaid();
				}
				return $totalAmountPaid;
			}
		}
		else{
			return false;
		}
	}

	function getCollectionRecordsFromReceiptID($receiptID){
		$condition = " WHERE receiptID = '".$receiptID."'";

		$CollectionList = new SoapObject(NCCBIZ."CollectionList.php", "urn:Object");
		if(!$xmlStr = $CollectionList->getCollectionList($condition)){
			echo "error collectionXml";
			return false;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				echo "error collectionDomDoc";
				return false;
			}
			else{
				$collectionRecords = new CollectionRecords;
				$collectionRecords->parseDomDocument($domDoc);
				return $collectionRecords;
			}
		}
		
	}

	function Main(){
		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));
		$this->setPageDetailPerms();

		// show owner

		$RPTOPDetails = new SoapObject(NCCBIZ."RPTOPDetails.php", "urn:Object");
		if (!$xmlStr = $RPTOPDetails->getRPTOP($this->formArray["rptopID"])){
			exit("xml failed");
		}
		else{
			//echo($xmlStr);
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
				$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
			}
			else {
				$rptop = new RPTOP;
				$rptop->parseDomDocument($domDoc);
				//print_r($rptop);

				if(is_object($rptop->owner)){
					//$RPTOPEncode = new SoapObject(NCCBIZ."RPTOPEncode.php", "urn:Object");
					if (is_a($rptop->owner,"Owner")){
						$this->formArray["ownerID"] = $rptop->owner->getOwnerID();
						$xmlStr = $rptop->owner->domDocument->dump_mem(true);
						if (!$xmlStr){
							$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
							$this->tpl->set_var("OwnerListTableBlock", "");
						}
						else {
							if(!$domDoc = domxml_open_mem($xmlStr)) {
								$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
								$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
							}
							else {
								$this->displayOwnerList($domDoc);
							}
						}
					}
					else {
						$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
						$this->tpl->set_var("PersonListBlock", "");
						$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
						$this->tpl->set_var("CompanyListBlock", "");
					}
				}

				// display Receipts

				$condition = "WHERE";
				foreach($this->formArray["receiptIDArray"] as $receiptIDKey => $receiptID){
					if($condition!="WHERE"){
						$condition .= " OR ";						
					}
					$condition .= " receiptID='".$receiptID."' ";
				}

				$ReceiptList = new SoapObject(NCCBIZ."ReceiptList.php", "urn:Object");
				if (!$xmlStr = $ReceiptList->getReceiptList($condition)){
					// echo "xml failed";
					// xml failed
				}
				else{
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						// echo "error domDoc";
						// error domDoc
					}
					else{
						$receiptRecords = new ReceiptRecords;
						$receiptRecords->parseDomDocument($domDoc);
						$receiptArrayList = $receiptRecords->getArrayList();

						$this->tpl->set_block("rptsTemplate","ReceiptList","ReceiptListBlock");
						foreach($receiptArrayList as $receipt){
							$this->tpl->set_var("receiptID", $receipt->getReceiptID());
							$this->tpl->set_var("receiptNumber", $receipt->getReceiptNumber());
							$this->tpl->set_var("paymentMode", $receipt->getPaymentMode());
							$this->tpl->set_var("amountPaid", formatCurrency($this->getTotalAmountPaid($receipt->getReceiptID())));
							$this->tpl->parse("ReceiptListBlock", "ReceiptList", true);
						}

					}
				}

			}
		}


		$this->setForm();
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
$printReceiptDetails = new PrintReceiptDetails($sess,$rptopID,$ownerID,$receiptIDArray);
$printReceiptDetails->Main();
?>
<?php page_close(); ?>