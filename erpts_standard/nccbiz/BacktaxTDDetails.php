<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/BacktaxTD.php";
include_once "../includes/collection/BacktaxTDRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('BacktaxTDDetails');
$server->handle();
//*/

class BacktaxTDDetails
{
	var $backtaxTD;
	
    function BacktaxTDDetails()
    {
		$this->backtaxTD = new BacktaxTD;
    }

	function getBacktaxTD($tdID,$startYear=""){
		$backtaxTD = new BacktaxTD;
		$backtaxTD->selectRecord($tdID,"",$startYear);
		if(!$domDoc = $backtaxTD->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function getBacktaxTD2($backtaxTDID){
		$backtaxTD = new BacktaxTD;
		$backtaxTD->selectRecord("",$backtaxTDID);
		if(!$domDoc = $backtaxTD->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function getBacktaxTDList($tdID){
		$records  = new BacktaxTDRecords;
		if ($records->selectRecords($tdID)){
			if(!$domDoc = $records->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
}
/*
$obj = new BacktaxTDDetails;
$xmlStr = $obj->getBacktaxTDList('5800');
echo $xmlStr;
$obj = "";
//*/
?>