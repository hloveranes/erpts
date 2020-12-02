<?php
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Machineries.php";
include_once "../includes/assessor/MachineriesRecords.php";
//*
$server = new SoapServer("urn:Object");
$server->setClass('MachineriesDetails');
$server->handle();
//*/

class MachineriesDetails
{
	var $machineries;
	
    function MachineriesDetails()
    {
		$this->machineries = new Machineries;
    }
	
	function getMachineries($machineriesID){
		$machineries = new Machineries;
		$machineries->selectRecord($machineriesID);
		if(!$domDoc = $machineries->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}

}

/*
$MachineriesDetails = new MachineriesDetails;
echo $MachineriesDetails->getMachineries(1);
//*/
?>