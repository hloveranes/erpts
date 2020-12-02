<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/Assessor.php";
include_once "../includes/assessor/TD.php";
include_once "../includes/assessor/AFS.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('TDEncode');
$server->handle();
//*/
class TDEncode
{
    function TDEncode(){
		
    }
    
    function saveTDForBuildup($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$td = new TD;
		$td->parseDomDocument($domDoc);
		$ret = $td->insertRecordForBuildup();
		return $ret;
	}

	
	function saveTD($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$td = new TD;
		$td->parseDomDocument($domDoc);
		$ret = $td->insertRecord();
		return $ret;
	}
	
	function getTDDetails($propertyID) {
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
	
	function updateTD($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$td = new TD;
		$td->parseDomDocument($domDoc);
		echo $xmlStr;
		$ret = $td->updateRecord();
		return $ret;
	}

	// added to get afsID from tdID and odID from tdID

	function getAfsID($tdID){
		$td = new TD;
		$td->selectRecord($tdID);
		$propertyID = $td->propertyID;
		$propertyType = $td->propertyType;
		switch($propertyType){
			case "Land":
				$property = new Land;
				break;
			case "PlantsTrees":
				$property = new PlantsTrees;
				break;
			case "ImprovementsBuildings":
				$property = new ImprovementsBuildings;
				break;
			case "Machineries":
				$property = new Machineries;
				break;
		}
		$property->selectRecord($propertyID);
		$afsID = $property->afsID;
		return $afsID;
	}

	function getOdID($tdID){
		$afsID = $this->getAfsID($tdID);
		$afs = new AFS;
		$afs->selectRecord($afsID);
		$odID = $afsID->odID;
		return $odID;
	}

}

/*
$xmlStr = ".?xml version=\"1.0\"?.
<TD>
  <tdID></tdID>
  <propertyID>11</propertyID>
  <propertyType>Land</propertyType>
  <taxDeclarationNumber>a</taxDeclarationNumber>
  <provincialAssessorDate>2003-08-06</provincialAssessorDate>
  <cityMunicipalAssessorDate>2003-08-06</cityMunicipalAssessorDate>
  <cancelsTDNumber>a</cancelsTDNumber>
  <canceledByTDNumber>a</canceledByTDNumber>
  <taxBeginsWithTheYear>a</taxBeginsWithTheYear>
  <ceasesWithTheYear>a</ceasesWithTheYear>
  <enteredInRPARForYear>a</enteredInRPARForYear>
  <previousOwner>a</previousOwner>
  <previousAssessedValue>a</previousAssessedValue>
</TD>";
echo $xmlStr;
$obj = new TDEncode;
echo $obj->saveTD($xmlStr);
//echo $obj->getTDDetails(2);
//*/
?>