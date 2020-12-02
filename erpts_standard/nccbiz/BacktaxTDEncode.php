<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/BacktaxTD.php";
include_once "../includes/collection/BacktaxTDRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('BacktaxTDEncode');
$server->handle();
//*/

class BacktaxTDEncode
{
    function BacktaxTDEncode(){
		
    }
    
	function saveBacktaxTD($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$backtaxTD = new BacktaxTD;
		$backtaxTD->parseDomDocument($domDoc);
		$ret = $backtaxTD->insertRecord();
		return $ret;
	}

	function getBacktaxTDDetails($tdID) {
		$backtaxTD = new BacktaxTD;
		$backtaxTD->selectRecord($tdID);
		if(!$domDoc = $backtaxTD->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateBacktaxTD($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$backtaxTD = new BacktaxTD;
		$backtaxTD->parseDomDocument($domDoc);
		$ret = $backtaxTD->updateRecord();
		return $ret;
	}
	function deleteBacktax($backtaxTDIDArray){
		$backtaxTDRecords = new BacktaxTDRecords;
		$rows = $backtaxTDRecords->deleteRecords($backtaxTDIDArray);
		return $rows;
	}
}
/*
$obj = new BacktaxTDEncode;
$arr = array(2,4,6,8);
echo $obj->deleteBacktax($arr);
//*/
?>