<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/eRPTSSettings.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('eRPTSSettingsEncode');
$server->handle();
//*/
class eRPTSSettingsEncode
{
    function eRPTSSettingsEncode(){
		
    }

    function saveERPTSSettings($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$erptsSettings = new eRPTSSettings;
		$erptsSettings->parseDomDocument($domDoc);
		$ret = $erptsSettings->insertRecord();
		return $ret;
	}
	
	function getERPTSSettingsDetails($erptsSettingsID) {
		$erptsSettings = new erptsSettings;
		$erptsSettings->selectRecord($erptsSettingsID);
		if(!$domDoc = $erptsSettings->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateERPTSSettings($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$erptsSettings = new eRPTSSettings;
		$erptsSettings->parseDomDocument($domDoc);
		$ret = $erptsSettings->updateRecord();
		return $ret;
	}
}
?>
