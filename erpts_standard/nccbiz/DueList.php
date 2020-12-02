<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/Due.php";
include_once "../includes/collection/DueRecords.php";
//*
$server = new SoapServer("urn:Object");
$server->setClass('DueList');
$server->handle();
//*/
class DueList
{
    function DueList(){
		
    }
    
    function getDueList($tdID,$taxableYear="",$condition=""){
		if ($tdID=="") return false;
		$dueRecords = new DueRecords;
		if ($dueRecords->selectRecords($tdID,$taxableYear,$condition)){
			if(!$domDoc = $dueRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function getDueCount($condition=""){
		$dueRecords = new DueRecords;
		return $dueRecords->countRecords($condition);
	}
	
}
?>
