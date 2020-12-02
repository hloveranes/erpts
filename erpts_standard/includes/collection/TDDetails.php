<?php
include_once "../web/prepend.php";
include_once "../assessor/Owner.php";
include_once "../assessor/Assessor.php";
include_once "../assessor/TD.php";

include_once "../assessor/AFS.php";
include_once "../assessor/OD.php";
include_once "../assessor/ODHistory.php";
include_once "../assessor/ODHistoryRecords.php";

class TDDetails
{
	var $td;
	
    function TDDetails()
    {
		$this->td = new TD;
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

	function getSucceedingTD($tdID){
		$td = new TD;
		$td->selectRecord($tdID);
		$afsID = $td->getAfsID();

		$afs = new AFS;
		$afs->selectRecord($afsID);
		$odID = $afs->getOdID();

		$condition = sprintf(" WHERE previousODID='%s' ",fixQuotes($odID));

		$odHistoryRecords = new ODHistoryRecords;
		$odHistoryRecords->selectRecords($condition);
		if(count($odHistoryRecords->arrayList) > 0){
			foreach($odHistoryRecords->arrayList as $key=>$odHistory){
				$previousODID = $odHistory->getPreviousODID();
				$presentODID = $odHistory->getPresentODID();

				$presentAFS = new AFS;
				$presentAFS->selectRecord($afsID="", $limit="", $presentODID);
				$presentAFSID = $presentAFS->getAfsID();

				$presentTD = new TD;
				$presentTD->selectRecord($tdID="", $presentAFSID);
				$presentTDID = $presentTD->getTdID();

				$presentTDArray[] = $presentTD;
			}

			return $presentTDArray;
		}
		else{
			return false;
		}

	}

	function generateTDHistory($tdID){
		$td = new TD;
		$td->selectRecord($tdID);
		$afsID = $td->getAfsID();
#		echo("afsID=$afsID<br>");
		$afs = new AFS;
		$afs->selectRecord($afsID);
		$odID = $afs->getOdID();
		
		$condition = sprintf(" WHERE presentODID='%s' ",fixQuotes($odID));
		
		$odHistoryRecords = new ODHistoryRecords;
		$odHistoryRecords->selectRecords($condition);

		
		if(count($odHistoryRecords->arrayList) > 0){
			#echo("count>0<br>");
			foreach($odHistoryRecords->arrayList as $key=>$odHistory){

				$previousODID = $odHistory->getPreviousODID();
				$presentODID = $odHistory->getPresentODID();
				$previousAFS = new AFS;
				$previousAFS->selectRecord($afsID="", $limit="", $previousODID);
				$previousAFSID = $previousAFS->getAfsID();
				$previousTD = new TD;
				$previousTD->selectRecord($tdID="",$previousAFSID);
				//print_r($previousTD);
				$previousTDID = $previousTD->getTdID();

				$this->tdHistory[] = $previousTD;

				$this->generateTDHistory($previousTDID);
			}
		}
		else{
			#echo("count==0<br>");
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
#$TDDetails = new SoapObject(NCCBIZ."TDDetails.php", "urn:Object");
$tdHistoryArray = $TDDetails->getTDHistory(41);#Skultz, Samantha M 


echo("tdHistoryArray=$tdHistoryArray<br>");
if (is_array($tdHistoryArray)) {
	foreach($tdHistoryArray as $item) {
		foreach ($item as $k=>$v) {
			echo("$k=>$v<br>");
		}
		echo("====<br>");
	}
} else {
	echo("Not an array");
}
*/
?>