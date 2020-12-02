<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/Collection.php";
include_once "../includes/collection/CollectionRecords.php";
//*
$server = new SoapServer("urn:Object");
$server->setClass('CollectionList');
$server->handle();
//*/
class CollectionList
{
    function CollectionList(){
		
    }

	function getCollectionListFromDueTaxType($dueID,$backtaxTDID,$dueType,$taxType,$status=""){
		$collectionRecords = new CollectionRecords;
		if ($collectionRecords->selectRecordsFromDueTaxType($dueID,$backtaxTDID,$dueType,$taxType,$status)){
			if(!$domDoc = $collectionRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}

	function getCollectionListFromIDArrays($paymentIDArray,$status=""){
		if(is_array($paymentIDArray)){
			$condition = " WHERE status='".$status."' AND (";
			$paymentIDCount=0;
			foreach($paymentIDArray as $paymentID){
				if($paymentIDCount > 0){
					$condition .= " OR";
				}
				$condition .= " paymentID = '".$paymentID."'";
				$paymentIDCount++;
			}
			$condition .= ")";
			return $this->getCollectionList($condition);
		}
	}

    function getCollectionList($condition=""){
		$collectionRecords = new CollectionRecords;
		if ($collectionRecords->selectRecords($condition)){
			if(!$domDoc = $collectionRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function getCollectionCount($condition=""){
		$collectionRecords = new CollectionRecords;
		return $collectionRecords->countRecords($condition);
	}

	function getCollectionListFromReceiptID($receiptID){
		$condition = " WHERE receiptID='".$receiptID."' ";
		return $this->getCollectionList($condition);
	}
}
?>
