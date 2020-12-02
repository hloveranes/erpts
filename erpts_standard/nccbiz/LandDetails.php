<?php
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Land.php";
include_once "../includes/assessor/LandRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('LandDetails');
$server->handle();
//*/

class LandDetails
{
	var $land;
	
    function LandDetails()
    {
		$this->land = new Land;
    }
	
	function getLand($propertyID){
		$land = new Land;
		$land->selectRecord($propertyID);
		if(!$domDoc = $land->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}

}

/*
$LandDetails = new LandDetails;
echo $LandDetails->getLand(1);
//*/
?>