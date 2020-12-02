<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/Receipt.php";
//*
$server = new SoapServer("urn:Object");
$server->setClass('ReceiptEncode');
$server->handle();
//*/
class ReceiptEncode
{
    function ReceiptEncode(){
		
    }

	function saveReceipt($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$receipt = new Receipt;
		$receipt->parseDomDocument($domDoc);
		$ret = $receipt->insertRecord();
		return $ret;
	}
	function updateReceipt($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$receipt = new Receipt;
		$receipt->parseDomDocument($domDoc);
		$ret = $receipt->updateRecord();
		return $ret;
	}
}
?>
