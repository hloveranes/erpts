<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/TD.php";
include_once "../includes/assessor/TDRecords.php";

/*
$server = new SoapServer("urn:Object");
$server->setClass('TDList');
$server->handle();
//*/
class TDList
{
    function TDList(){
		
    }
    
    function getTDList($rptopID) {
		$tdRecords = new TDRecords;
		$tdRecords->selectRecords($rptopID);
		if(!$domDoc = $tdRecords->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function deleteTD($tdIDArray){
		$tdRecords = new TDRecords;
		$rows = $tdRecords->deleteRecords($tdIDArray);
		return $rows;
	}
	
	function removeTD($tdIDArray){
		$tdRecords = new TDRecords;
		$rows = $tdRecords->removeRecords($tdIDArray);
		return $rows;
	}
}
//*
$obj = new TDList;
echo $obj->getTDList();
//echo $obj->getTDListOfPerson(2);
//*/
?>
