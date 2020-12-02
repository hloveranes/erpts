<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/Payment.php";
//*
$server = new SoapServer("urn:Object");
$server->setClass('PaymentEncode');
$server->handle();
//*/
class PaymentEncode
{
    function PaymentEncode(){
		
    }

	function savePayment($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$payment = new Payment;
		$payment->parseDomDocument($domDoc);
		$ret = $payment->insertRecord();
		return $ret;
	}
	function updatePayment($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$payment = new Payment;
		$payment->parseDomDocument($domDoc);
		$ret = $payment->updateRecord();
		return $ret;
	}
}
?>
