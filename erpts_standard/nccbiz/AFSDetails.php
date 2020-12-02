<?php
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/LocationAddress.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/AFS.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('AFSDetails');
$server->handle();
//*/

class AFSDetails
{
	var $afs;
	
    function AFSDetails()
    {
		$this->afs = new AFS;
    }
	
	function getOdID($afsID){
		$afs = new AFS;
		$afs->selectRecord($afsID);
		if (!$odID = $afs->getOdID()) return false;
		else return $odID;
	}
	
	function getAFS($afsID){
		$afs = new AFS;
		$afs->selectRecord($afsID);
		if(!$domDoc = $afs->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	function getAFSForList($afsID){
		$afs = new AFS;
		$afs->selectRecordForList($afsID);
		if(!$domDoc = $afs->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}

}

/*
$obj = new AFSDetails;
echo $obj->getAFS(17);
//*/
?>
