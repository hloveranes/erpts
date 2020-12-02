<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/Payment.php";
include_once "../includes/collection/PaymentRecords.php";
//*
$server = new SoapServer("urn:Object");
$server->setClass('PaymentList');
$server->handle();
//*/
class PaymentList
{
    function PaymentList(){
		
    }

	function getPaymentListFromIDArrays($dueIDArray,$backtaxTDIDArray,$status=""){
		$dueIDCondition = "";
		$backtaxTDIDCondition = "";

		if(is_array($dueIDArray)){
			$dueIDCondition = "(";
			$dueIDCount = 0;
			foreach($dueIDArray as $dueID){
				if($dueIDCount > 0) $dueIDCondition .= " OR";
				$dueIDCondition .= " dueID=".$dueID;
				$dueIDCount++;
			}
			$dueIDCondition .= ")";
		}
		if(is_array($backtaxTDIDArray)){
			$backtaxTDIDCondition = "(";
			$backtaxTDIDCount = 0;
			foreach($backtaxTDIDArray as $backtaxTDID){
				if($backtaxTDIDCount > 0) $backtaxTDIDCondition .= " OR";
				$backtaxTDIDCondition .= " backtaxTDID=".$backtaxTDID;
				$backtaxTDIDCount++;
			}
			$backtaxTDIDCondition .= ")";
		}

		if($dueIDCondition!=""){
			$condition = " WHERE status='".$status."' "; 
			$condition .= " AND (".$dueIDCondition.")";
		}
		if($backtaxTDIDCondition!=""){
			if($dueIDCondition!=""){
				$condition .= " OR ";
			}
			else{
				$condition = " WHERE status='".$status."' AND "; 
			}
			$condition .= " (".$backtaxTDIDCondition.") ";
		}
		return $this->getPaymentList($condition);
	}
    
    function getPaymentList($condition=""){
		$paymentRecords = new PaymentRecords;
		if ($paymentRecords->selectRecords($condition)){
			if(!$domDoc = $paymentRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function getPaymentCount($condition=""){
		$paymentRecords = new PaymentRecords;
		return $paymentRecords->countRecords($condition);
	}
	
}
?>
