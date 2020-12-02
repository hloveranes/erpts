<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/Assessor.php";
include_once "../includes/assessor/TD.php";

include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/OD.php";
include_once "../includes/assessor/ODHistory.php";
include_once "../includes/assessor/ODHistoryRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('TDDetails');
$server->handle();
//*/

class TDDetails
{
	var $td;
	
    function TDDetails()
    {
		$this->td = new TD;
    }

	function getTDFromODID(){
	}

	function getTDFromAfsID($afsID){
		$td = new TD;
		$td->selectRecord($tdID="",$afsID);
		if(!$domDoc = $td->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function getTD($tdID,$afsID="",$propertyID="",$propertyType=""){
		$td = new TD;
		$td->selectRecord($tdID,$afsID,$propertyID,$propertyType);
		if(!$domDoc = $td->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}

	function getTDOfProperty($tdID, $propertyID){
		$td = new TD;
		$td->selectRecord($propertyID);
		if(!$domDoc = $td->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}

	function generateTDHistory($tdID){
		$td = new TD;
		$td->selectRecord($tdID);
		$afsID = $td->getAfsID();

		$afs = new AFS;
		$afs->selectRecord($afsID);
		$odID = $afs->getOdID();

		$condition = sprintf(" WHERE presentODID='%s' ",fixQuotes($odID));
		
		$odHistoryRecords = new ODHistoryRecords;
		$odHistoryRecords->selectRecords($condition);
		if(count($odHistoryRecords->arrayList) > 0){
			foreach($odHistoryRecords->arrayList as $key=>$odHistory){
				$previousODID = $odHistory->getPreviousODID();

				$presentODID = $odHistory->getPresentODID();

				$previousAFS = new AFS;
				$previousAFS->selectRecord($afsID="", $limit="", $previousODID);
				$previousAFSID = $previousAFS->getAfsID();

				$previousTD = new TD;
				$previousTD->selectRecord($tdID="",$previousAFSID);
				$previousTDID = $previousTD->getTdID();

				$this->tdHistory[] = $previousTD;

				$this->generateTDHistory($previousTDID);
			}
		}
		else{
			return false;
		}
	}

	function getTDHistory($tdID){
		$this->generateTDHistory($tdID);
		return $this->tdHistory;
	}
		
}

/*

$TDDetails = new TDDetails;
$TDHistory = $TDDetails->getTDHistory(13);
echo "<hr>";
print_r($TDHistory);

*/

?>
