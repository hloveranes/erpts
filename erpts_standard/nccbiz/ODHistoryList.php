<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/ODHistory.php";
include("assessor/ODHistoryRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ODHistoryList');
$server->handle();
//*/
class ODHistoryList
{
    function ODHistoryList(){
		
    }
    
    function getODHistoryList($condition) {
		$odHistoryRecords = new ODHistoryRecords;
		$odHistoryRecords->selectRecords($condition);
		if(!$domDoc = $odHistoryRecords->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}

	function getPrecedingODList($presentODID){
		$condition = sprintf("WHERE presentODID='%s'",fixQuotes($presentODID));
		return $this->getODHistoryList($condition);
	}

	function getSucceedingODList($previousODID){
		$condition = sprintf("WHERE previousODID='%s'",fixQuotes($previousODID));
		return $this->getODHistoryList($condition);
	}
}

?>