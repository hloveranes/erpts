<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/Due.php";
include_once "../includes/collection/BacktaxTD.php";
include_once "../includes/assessor/ODHistory.php";
include_once "../includes/assessor/TD.php";
include_once "../includes/assessor/TDRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('DueDetails');
$server->handle();
//*/

class DueDetails
{
	var $due;
	
    function DueDetails()
    {
		$this->td = new Due;
    }
	function getDue($dueID){
		$due = new Due;
		$due->selectRecord($dueID);
		if(!$domDoc = $due->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	function getDueFromTdID($tdID,$taxableYear){
		$due = new Due;
		$condition = "WHERE tdID='".$tdID."' AND dueDate LIKE '".$taxableYear."%' AND dueType='Annual'";
		$due->selectRecordFromCondition($condition);
		if(!$domDoc = $due->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}

	// Functions belown all start at: getDueIDFromBacktaxTDID()
	// called from nccweb/PaymentReceiptDetails.php

	function getDueIDFromBacktaxTDID($backtaxTDID,$dueType){
		$backtaxTD = new BacktaxTD;
		$backtaxTD->selectRecord("",$backtaxTDID);

		// look for tdID with associated backtaxTD->tdNum

		$tdIDArray = $this->getTDIDArrayFromTDNumber($backtaxTD->getTdNumber());

		if(is_array($tdIDArray)){
			if(count($tdIDArray) > 1){
				unset($tdIDArray);
				$tdIDArray = $this->getTDIDArrayFromParentTDID($backtaxTD->getTDID());
				foreach($tdIDArray as $tdID){
					if($this->isSameTDNumber($tdID,$backtaxTD->getTdNumber())){
						// this is it!
						if($dueID = $this->getDueIDFromTDID($tdID,$dueType,$backtaxTD->getStartYear())){
							return $dueID;
						}
					}
				}
			}
			else{
				// this is it!
				$tdID = $tdIDArray[0];
				$dueID = $this->getDueIDFromTDID($tdID,$dueType,$backtaxTD->getStartYear());
				return $dueID;
			}
		}
		return false;
	}

	function isSameTDNumber($tdID,$tdNumber){
		$td = new TD;
		$td->selectRecord($tdID);
		if($td->getTaxDeclarationNumber==$tdNumber){
			return true;
		}
		else{
			return false;
		}
	}

	function getTDIDArrayFromParentTDID($presentTDID){
		$presentTD = new TD;
		$presentTD->selectRecord($presentTDID);
		$presentAfsID = $presentTD->getAfsID();
		$presentAFS = new AFS;
		$presentAFS->selectRecord($presentAFSID);
		$presentODID = $presentAFS->getOdID();

		$odHistoryRecords = new ODHistoryRecords;
		$odHistoryRecords->selectPrecOD($presentODID);
		if(is_array($odHistoryRecords->arrayList)){
			foreach($odHistoryRecords as $odID){
				$afs = new AFS;
				$afs->selectRecord("","",$odID);
				$afsID = $afs->getAfsID();
				$td = new TD;
				$td->selectRecord("",$afsID);
				$tdID = $td->getTdID();
				$tdIDArray[] = $tdID;
			}
			if(is_array($tdIDArray)){
				return $tdIDArray;
			}
		}
		return false;
	}

	function getDueIDFromTDID($tdID,$dueType,$year){
		$due = new Due;
		$condition = "WHERE tdID='".$tdID."' AND dueDate LIKE '".$year."%' AND dueType='".$dueType."'";
		$due->selectRecordFromCondition($condition);
		$dueID = $due->getDueID();
		return $dueID;
	}

	function getTDIDArrayFromTDNumber($tdNumber){
		$sql = "SELECT tdID FROM ".TD_TABLE." WHERE taxDeclarationNumber LIKE '".$tdNumber."'";
		$db = new DB_RPTS;
		$db->query($sql);

		while ($db->next_record()) {
			$tdIDArray[] = $db->f("tdID");
		}

		return $tdIDArray;
	}
}
?>
