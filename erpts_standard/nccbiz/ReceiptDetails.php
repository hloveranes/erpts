<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/Receipt.php";


//*
$server = new SoapServer("urn:Object");
$server->setClass('ReceiptDetails');
$server->handle();
//*/

class ReceiptDetails
{
	var $receipt;
	
    function ReceiptDetails()
    {
		$this->receipt = new Receipt;
    }

	function getReceipt($receiptID){
		$receipt = new Receipt;
		$receipt->selectRecord($receiptID);
		if(!$domDoc = $receipt->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
?>
