<?php
# Setup PHPLIB in storey Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/RPTOP.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('RPTOPEncode');
$server->handle();
//*/
class RPTOPEncode
{
    function RPTOPEncode(){
		
    }
    
    function saveRPTOP($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$rptop = new RPTOP;
		$rptop->parseDomDocument($domDoc);
		//print_r($rptop);
		$ret = $rptop->insertRecord();
		//echo "hello";
		return $ret;
	}
	
	function getRPTOPDetails($storeyID) {
		$rptop = new RPTOP;
		$rptop->selectRPTOP($storeyID);
		if(!$domDoc = $rptop->getDomRPTOP()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateRPTOP($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$rptop = new RPTOP;
		$rptop->parseDomRPTOP($domDoc);
		$ret = $rptop->updateRPTOP();
		return $ret;
	}
	
	function updateRPTOPtotals($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$rptop = new RPTOP;
		$rptop->parseDomDocument($domDoc);
		$ret = $rptop->updateRecordTotals();
		return $ret;
	}
	function getOdID($rptopID){
		$rptop = new RPTOP;
		$rptop->selectRPTOP($rptopID);
		if (!$odID = $rptop->getOdID()) return false;
		else return $odID;
	}
	
	function getRptopID($odID){
		$rptop = new RPTOP;
		if (!$rptopID = $rptop->checkRptopID($odID)) return false;
		else return $rptopID;
	}
	function getOwnerID($rptopID){
		$rptop = new RPTOP;
		$rptop->selectRecord($rptopID);
		if (!$ownerID = $rptop->owner->getOwnerID()) return false;
		else return $ownerID;
	}
	
	
}
/*
$xmlStr = "<xml version=\"1.0\">
<RPTOP>
  <rptopID></rptopID>
  <rptopNumber>121213244332</rptopNumber>
  <rptopDate></rptopDate>
  <taxableYear>2004</taxableYear>
</RPTOP>";
echo "xml<br>".$xmlStr;
$obj = new RPTOPEncode;
//echo $obj->updateRPTOP($xmlStr);
echo $obj->saveRPTOP($xmlStr)."<br>";
//echo $obj->getRPTOPDetails(4);
//echo $obj->getRptopID(72);
//*/
?>