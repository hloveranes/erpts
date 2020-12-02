<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/Due.php";
//*
$server = new SoapServer("urn:Object");
$server->setClass('DueEncode');
$server->handle();
//*/
class DueEncode
{
    function DueEncode(){
		
    }

	function saveDue($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$due = new Due;
		$due->parseDomDocument($domDoc);
		$ret = $due->insertRecord();
		return $ret;
	}
	function updateDue($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$due = new Due;
		$due->parseDomDocument($domDoc);
		$ret = $due->updateRecord();
		return $ret;
	}
}
?>
