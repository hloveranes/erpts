<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/Receipt.php";
include_once "../includes/collection/ReceiptRecords.php";

include_once "../includes/collection/Collection.php";
include_once "../includes/collection/CollectionRecords.php";

include_once "../includes/collection/Payment.php";
include_once "../includes/collection/PaymentRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ReceiptList');
$server->handle();
//*/
class ReceiptList
{
    function ReceiptList(){
		
    }
    
    function getReceiptList($condition=""){
		$receiptRecords = new ReceiptRecords;
		if ($receiptRecords->selectRecords($condition)){
			if(!$domDoc = $receiptRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function getReceiptCount($condition=""){
		$receiptRecords = new ReceiptRecords;
		return $receiptRecords->countRecords($condition);
	}

	function getSearchCount($searchKey){
		$fields = array("receiptNumber");
		$receiptRecords = new ReceiptRecords;
		return $receiptRecords->countSearchRecords($searchKey,$fields);
	}

	function searchReceipt($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("receiptNumber");
		$receiptRecords = new ReceiptRecords;
		if ($receiptRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $receiptRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}

	function countPurgeReceiptList(){
		$collectionRecords = new CollectionRecords;
		$condition = "WHERE status='' AND amountPaid <=0";
		if(!$ret = $collectionRecords->countRecords($condition)){
			$ret=0;
		}
		return $ret;
	}

	function purgeReceiptList(){
		$collectionRecords = new CollectionRecords;
		$receipt = new Receipt;
		$condition = "WHERE status='' AND amountPaid <= 0";
		$collectionRecords->selectRecords($condition);
		if(is_array($collectionRecords->getArrayList())){
			$totalPurgedReceipts=0;
			foreach($collectionRecords->getArrayList() as $collection){
				$receipt->selectRecord($collection->getReceiptID());

				$receipt->setStatus("cancelled");
				$receipt->updateRecord();

				$collection->setStatus("cancelled");
				$collection->updateRecord();
				$totalPurgedReceipts++;
			}
			return $totalPurgedReceipts;
		}
		else{
			return false;
		}
	}

	function cancelReceiptList($receiptIDArray=""){
		if(is_array($receiptIDArray)){
			$collectionRecords = new CollectionRecords;
			
			$collection = new Collection;
			$receipt = new Receipt;
			$payment = new Payment;

			foreach($receiptIDArray as $receiptID){
				// find other receipts associated to payment

				$collectionRecords->selectRecords("WHERE receiptID='".$receiptID."'");
				$paymentID = $collectionRecords->arrayList[0]->getPaymentID();

				$collectionRecords->selectRecords("WHERE paymentID='".$paymentID."'");
				if(is_array($collectionRecords->getArrayList())){
					foreach($collectionRecords->getArrayList() as $collection){
						$cancelReceiptIDArray[] = $collection->getReceiptID();
						$cancelPaymentIDArray[] = $collection->getPaymentID();
						$cancelCollectionIDArray[] = $collection->getCollectionID();
					}
				}
			}

			$cancelCollectionIDArray = array_unique($cancelCollectionIDArray);
			$cancelReceiptIDArray = array_unique($cancelReceiptIDArray);
			$cancelPaymentIDArray = array_unique($cancelPaymentIDArray);

			foreach($cancelCollectionIDArray as $collectionID){
				$collection->selectRecord($collectionID);
				$collection->setStatus("cancelled");
				$collection->updateRecord();
			}

			$condition = " WHERE ";
			foreach($cancelReceiptIDArray as $receiptID){
				if($condition!= " WHERE "){
					$condition .= " OR ";
				}
				$condition .= " receiptID = '".$receiptID."' ";

				$receipt->selectRecord($receiptID);
				$receipt->setStatus("cancelled");
				$receipt->updateRecord();
			}

			foreach($cancelPaymentIDArray as $paymentID){
				$payment->selectRecord($paymentID);
				$payment->setStatus("cancelled");
				$payment->updateRecord();
			}

			// cancel associated mergedReceipts

			$receiptRecords = new ReceiptRecords;
			if ($receiptRecords->selectRecords($condition)){
				if(!$domDoc = $receiptRecords->getDomDocument()){
					return false;
				}
				else {
					$xmlStr = $domDoc->dump_mem(true);
					return $xmlStr;
				}
			}
			else return false;
		}
		else{
			return false;
		}
	}
	
}
?>
