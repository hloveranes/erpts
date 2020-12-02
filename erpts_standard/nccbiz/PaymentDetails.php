<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/TD.php";
include_once "../includes/collection/BacktaxTD.php";
include_once "../includes/collection/Payment.php";


//*
$server = new SoapServer("urn:Object");
$server->setClass('PaymentDetails');
$server->handle();
//*/

class PaymentDetails
{
	var $payment;
	
    function PaymentDetails()
    {
		$this->payment = new Payment;
    }

	function getPayment($paymentID){
		$payment = new Payment;
		$payment->selectRecord($paymentID);
		if(!$domDoc = $payment->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}

	function getTDNumber($tdID,$backtaxTDID){
		if($tdID!=""){
			$td = new TD;
			$td->selectRecord($tdID);
			$tdNumber = $td->getTaxDeclarationNumber();
		}
		else if($backtaxTDID!=""){
			$backtaxTD = new BacktaxTD;
			$backtaxTD->selectRecord("",$backtaxTDID);
			$tdNumber = $backtaxTD->getTDNumber();
		}
		return $tdNumber;
	}

}
?>
