<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/eRPTSSettings.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('eRPTSSettingsDetails');
$server->handle();
//*/
class eRPTSSettingsDetails
{
    function eRPTSSettingsDetails(){
		
    }

    function getERPTSSettingsDetails($eRPTSSettingsID) {
		$erptsSettings = new eRPTSSettings;
		$erptsSettings->selectRecord($eRPTSSettingsID);
		if(!$domDoc = $erptsSettings->getDomDocument()){
            return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
?>
