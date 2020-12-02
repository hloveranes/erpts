<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";

include_once "../collection/Due.php";
include_once "../collection/Payment.php";
include_once "../collection/Receipt.php";

#####################################
# Define Interface Class
#####################################
class PaymentEncode{
	
	var $tpl;
	var $formArray;
	var $person;
	var $birthdate;
	var $monthArray;
	var $sess;
	
	function PaymentEncode($sess,$http_post_vars){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = un_number_format($value);
		}
		$this->formArray["maxLinesPerReceipt"] = 6;
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "confirm":
				$PaymentEncode = new SoapObject(NCCBIZ."PaymentEncode.php", "urn:Object");
				$ReceiptEncode = new SoapObject(NCCBIZ."ReceiptEncode.php", "urn:Object");
				$CollectionEncode = new SoapObject(NCCBIZ."CollectionEncode.php", "urn:Object");

				$basicReceiptIDArrayIndex = 0;
				$sefReceiptIDArrayIndex = 0;
				$idleReceiptIDArrayIndex = 0;

				// create Basic Receipts

				foreach($this->formArray["basicReceipt"] as $basicReceiptArray){
					$basicReceipt = new Receipt;

					$basicReceipt->setReceiptNumber($basicReceiptArray["receiptNumber"]);
					$basicReceipt->setReceiptDate($this->formArray["paymentDate"]);
					$basicReceipt->setPaymentMode($this->formArray["paymentMode"]);
					$basicReceipt->setCheckNumber($this->formArray["checkNumber"]);
					$basicReceipt->setDateOfCheck($this->formArray["dateOfCheck"]);
					$basicReceipt->setDraweeBank($this->formArray["draweeBank"]);
					$basicReceipt->setReceivedFrom($this->formArray["receivedFrom"]);
					$basicReceipt->setPreviousReceiptNumber($basicReceiptArray["previousReceiptNumber"]);
					$basicReceipt->setPreviousReceiptDate($basicReceiptArray["previousReceiptDate_year"]."-".putPreZero($basicReceiptArray["previousReceiptDate_month"]."-".putPreZero($basicReceiptArray["previousReceiptDate_day"])));
					$basicReceipt->setCityTreasurer($this->formArray["cityTreasurer"]);
					$basicReceipt->setDeputyTreasurer($this->formArray["deputyTreasurer"]);
					$basicReceipt->setStatus("");

					$basicReceipt->setDomDocument();
					$domDoc = $basicReceipt->getDomDocument();
					$xmlStr = $domDoc->dump_mem(true);

					if (!$basicReceiptIDArray[$basicReceiptIDArrayIndex] = $ReceiptEncode->saveReceipt($xmlStr)){
						exit("error save basic receipt");
					}
					$receiptIDArray[] = $basicReceiptIDArray[$basicReceiptIDArrayIndex];
					$basicReceiptIDArrayIndex++;
				}

				// create Sef Receipts

				foreach($this->formArray["sefReceipt"] as $sefReceiptArray){
					$sefReceipt = new Receipt;
					$sefReceipt->setReceiptNumber($sefReceiptArray["receiptNumber"]);
					$sefReceipt->setReceiptDate($this->formArray["paymentDate"]);
					$sefReceipt->setPaymentMode($this->formArray["paymentMode"]);
					$sefReceipt->setCheckNumber($this->formArray["checkNumber"]);
					$sefReceipt->setDateOfCheck($this->formArray["dateOfCheck"]);
					$sefReceipt->setDraweeBank($this->formArray["draweeBank"]);
					$sefReceipt->setReceivedFrom($this->formArray["receivedFrom"]);
					$sefReceipt->setPreviousReceiptNumber($sefReceiptArray["previousReceiptNumber"]);
					$sefReceipt->setPreviousReceiptDate($sefReceiptArray["previousReceiptDate_year"]."-".putPreZero($sefReceiptArray["previousReceiptDate_month"]."-".putPreZero($sefReceiptArray["previousReceiptDate_day"])));
					$sefReceipt->setCityTreasurer($this->formArray["cityTreasurer"]);
					$sefReceipt->setDeputyTreasurer($this->formArray["deputyTreasurer"]);
					$sefReceipt->setStatus("");

					$sefReceipt->setDomDocument();
					$domDoc = $sefReceipt->getDomDocument();
					$xmlStr = $domDoc->dump_mem(true);
					if (!$sefReceiptIDArray[$sefReceiptIDArrayIndex] = $ReceiptEncode->saveReceipt($xmlStr)){
						exit("error save sef receipt");
					}
					$receiptIDArray[] = $sefReceiptIDArray[$sefReceiptIDArrayIndex];
					$sefReceiptIDArrayIndex++;
				}

				// create Idle Receipts

				foreach($this->formArray["idleReceipt"] as $idleReceiptArray){
					$idleReceipt = new Receipt;
					$idleReceipt->setReceiptNumber($idleReceiptArray["receiptNumber"]);
					$idleReceipt->setReceiptDate($this->formArray["paymentDate"]);
					$idleReceipt->setPaymentMode($this->formArray["paymentMode"]);
					$idleReceipt->setCheckNumber($this->formArray["checkNumber"]);
					$idleReceipt->setDateOfCheck($this->formArray["dateOfCheck"]);
					$idleReceipt->setDraweeBank($this->formArray["draweeBank"]);
					$idleReceipt->setReceivedFrom($this->formArray["receivedFrom"]);
					$idleReceipt->setPreviousReceiptNumber($idleReceiptArray["previousReceiptNumber"]);
					$idleReceipt->setPreviousReceiptDate($idleReceiptArray["previousReceiptDate_year"]."-".putPreZero($idleReceiptArray["previousReceiptDate_month"]."-".putPreZero($idleReceiptArray["previousReceiptDate_day"])));
					$idleReceipt->setCityTreasurer($this->formArray["cityTreasurer"]);
					$idleReceipt->setDeputyTreasurer($this->formArray["deputyTreasurer"]);
					$idleReceipt->setStatus("");

					$idleReceipt->setDomDocument();
					$domDoc = $idleReceipt->getDomDocument();
					$xmlStr = $domDoc->dump_mem(true);
					if (!$idleReceiptIDArray[$idleReceiptIDArrayIndex] = $ReceiptEncode->saveReceipt($xmlStr)){
						exit("error save idle receipt");
					}
					$receiptIDArray[] = $idleReceiptIDArray[$idleReceiptIDArrayIndex];
					$idleReceiptIDArrayIndex++;
				}

				$lineCtr = 0;

				$basicReceiptIDArrayIndex = 0;
				$sefReceiptIDArrayIndex = 0;
				$idleReceiptIDArrayIndex = 0;

				if(is_array($this->formArray["payment"])){
					foreach($this->formArray["payment"] as $formPaymentArray){
						$payment = new Payment;
						$payment->setTdID($formPaymentArray["tdID"]);
						$payment->setDueID($formPaymentArray["dueID"]);
						$payment->setDueType($formPaymentArray["dueType"]);
						$payment->setBacktaxTDID($formPaymentArray["backtaxTDID"]);
						$payment->setTaxDue($formPaymentArray["taxDue"]);
						$payment->setAdvancedPaymentDiscount($formPaymentArray["advancedPaymentDiscount"]);
						$payment->setEarlyPaymentDiscount($formPaymentArray["earlyPaymentDiscount"]);
						$payment->setPenalty($formPaymentArray["penalty"]);
						$payment->setAmnesty($formPaymentArray["amnesty"]);
						$payment->setBalanceDue($formPaymentArray["balanceDue"]);
						$payment->setAmountPaid($formPaymentArray["amountPaid"]);
						$payment->setDueDate($formPaymentArray["dueDate"]);
						$payment->setPaymentDate($formPaymentArray["paymentDate"]);
						$payment->setOwnerID($formPaymentArray["ownerID"]);

						$payment->setDomDocument();
						$domDoc = $payment->getDomDocument();
						$xmlStr = $domDoc->dump_mem(true);
						if (!$paymentID = $PaymentEncode->savePayment($xmlStr)){
							exit("error save payment");
						}

						//  basicCollection
						if(is_array($formPaymentArray["basicReceipt"])){
							$basicReceiptID = $basicReceiptIDArray[$basicReceiptIDArrayIndex];

							foreach($formPaymentArray["basicReceipt"] as $basicCollectionArray){
								$basicCollection = new Collection;

								$basicCollection->setPaymentID($paymentID);
								$basicCollection->setReceiptID($basicReceiptID);
								$basicCollection->setTaxType($basicCollectionArray["taxType"]);
								$basicCollection->setTaxDue($basicCollectionArray["taxDue"]);
								$basicCollection->setAdvancedPaymentDiscount($basicCollectionArray["advancedPaymentDiscount"]);
								$basicCollection->setEarlyPaymentDiscount($basicCollectionArray["earlyPaymentDiscount"]);
								$basicCollection->setPenalty($basicCollectionArray["penalty"]);
								$basicCollection->setAmnesty($basicCollectionArray["amnesty"]);
								$basicCollection->setBalanceDue($basicCollectionArray["balanceDue"]);
								$basicCollection->setAmountPaid($basicCollectionArray["amountPaid"]);

								$basicCollection->setDomDocument();
								$domDoc = $basicCollection->getDomDocument();
								$xmlStr = $domDoc->dump_mem(true);
								if (!$basicCollectionID = $CollectionEncode->saveCollection($xmlStr)){
									exit("error save basic collection");
								}
							}
						}

						//  sefCollection
						if(is_array($formPaymentArray["sefReceipt"])){
							$sefReceiptID = $sefReceiptIDArray[$sefReceiptIDArrayIndex];

							foreach($formPaymentArray["sefReceipt"] as $sefCollectionArray){
								$sefCollection = new Collection;

								$sefCollection->setPaymentID($paymentID);
								$sefCollection->setReceiptID($sefReceiptID);
								$sefCollection->setTaxType($sefCollectionArray["taxType"]);
								$sefCollection->setTaxDue($sefCollectionArray["taxDue"]);
								$sefCollection->setAdvancedPaymentDiscount($sefCollectionArray["advancedPaymentDiscount"]);
								$sefCollection->setEarlyPaymentDiscount($sefCollectionArray["earlyPaymentDiscount"]);
								$sefCollection->setPenalty($sefCollectionArray["penalty"]);
								$sefCollection->setAmnesty($sefCollectionArray["amnesty"]);
								$sefCollection->setBalanceDue($sefCollectionArray["balanceDue"]);
								$sefCollection->setAmountPaid($sefCollectionArray["amountPaid"]);

								$sefCollection->setDomDocument();
								$domDoc = $sefCollection->getDomDocument();
								$xmlStr = $domDoc->dump_mem(true);
								if (!$sefCollectionID = $CollectionEncode->saveCollection($xmlStr)){
									exit("error save basic collection");
								}
							}
						}

						//  idleCollection
						if(is_array($formPaymentArray["idleReceipt"])){
							$idleReceiptID = $idleReceiptIDArray[$idleReceiptIDArrayIndex];

							foreach($formPaymentArray["idleReceipt"] as $idleCollectionArray){
								$idleCollection = new Collection;

								$idleCollection->setPaymentID($paymentID);
								$idleCollection->setReceiptID($idleReceiptID);
								$idleCollection->setTaxType($idleCollectionArray["taxType"]);
								$idleCollection->setTaxDue($idleCollectionArray["taxDue"]);
								$idleCollection->setAdvancedPaymentDiscount($idleCollectionArray["advancedPaymentDiscount"]);
								$idleCollection->setEarlyPaymentDiscount($idleCollectionArray["earlyPaymentDiscount"]);
								$idleCollection->setPenalty($idleCollectionArray["penalty"]);
								$idleCollection->setAmnesty($idleCollectionArray["amnesty"]);
								$idleCollection->setBalanceDue($idleCollectionArray["balanceDue"]);
								$idleCollection->setAmountPaid($idleCollectionArray["amountPaid"]);

								$idleCollection->setDomDocument();
								$domDoc = $idleCollection->getDomDocument();
								$xmlStr = $domDoc->dump_mem(true);
								if (!$idleCollectionID = $CollectionEncode->saveCollection($xmlStr)){
									exit("error save basic collection");
								}
							}
						}

						$lineCtr++;
						if($lineCtr==$this->formArray["maxLinesPerReceipt"] || $lineCtr==count($this->formArray["payment"])){
							$lineCtr=0;
							$basicReceiptIDArrayIndex++;
							$sefReceiptIDArrayIndex++;
							$idleReceiptIDArrayIndex++;
						}
					}

					$receiptIDArrayQueryString = "";

					foreach($receiptIDArray as $receiptID){
						$receiptIDArrayQueryString .= "&receiptIDArray[]=".$receiptID;						
					}

					header("Location: PrintReceiptDetails.php".$this->sess->url("")."&rptopID=".$this->formArray["rptopID"]."&ownerID=".$this->formArray["ownerID"].$receiptIDArrayQueryString);
					exit;
				}
				break;
			default:
				header("Location: Unauthorized.php".$this->sess->url(""));
				exit;
		}
		
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
	//,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/


// use $_POST instead of $HTTP_POST_VARS
$paymentEncode = new PaymentEncode($sess,$_POST);
$paymentEncode->Main();
?>

<?php page_close(); ?>
