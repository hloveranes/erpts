<?php
include_once "../includes/web/prepend.php";

include_once "../includes/assessor/LocationAddress.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/OD.php";

include_once "../includes/assessor/TD.php";
include_once "../includes/assessor/AFS.php";


//*
$server = new SoapServer("urn:Object");
$server->setClass('ODDetails');
$server->handle();
//*/

class ODDetails
{
	var $od;
	
    function ODDetails()
    {
		//$this->od = new OD;
    }

	function getOdIDFromTdID($tdID){
		$ret = false;

		$td = new TD;
		if($td->selectRecord($tdID)){
			$afsID = $td->getAfsID();
			if($afs = new AFS){
				$afs->selectRecord($afsID);
				$odID = $afs->getOdID();
				$ret = $odID;
			}
		}
		return $ret;
	}
	
	function getOwnerID($odID){
		$od = new OD;
		$od->selectRecord($odID);
		if (!$ownerID = $od->ownerArray[0]->getOwnerID()) return false;
		else return $ownerID;
	}
	
	function getOD($odID){
		$od = new OD;
		$od->selectRecord($odID);
		if(!$domDoc = $od->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function getLocation($locID){
		$loc = new LocationAddress;
		$loc->selectRecord($locID);
		if(!$domDoc = $loc->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}

/*
$obj = new ODDetails;
echo $obj->getOD(111);
//*/
?>
