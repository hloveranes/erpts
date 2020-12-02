<?php
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/ImprovementsBuildings.php";
include_once "../includes/assessor/ImprovementsBuildingsRecords.php";
//*
$server = new SoapServer("urn:Object");
$server->setClass('ImprovementsBuildingsDetails');
$server->handle();
//*/

class ImprovementsBuildingsDetails
{
	var $improvementsBuildings;
	
    function ImprovementsBuildingsDetails()
    {
		$this->improvementsBuildings = new ImprovementsBuildings;
    }
	
	function getImprovementsBuildings($improvementsBuildingsID){
		$improvementsBuildings = new ImprovementsBuildings;
		$improvementsBuildings->selectRecord($improvementsBuildingsID);
		if(!$domDoc = $improvementsBuildings->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}

}

/*
$ImprovementsBuildingsDetails = new ImprovementsBuildingsDetails;
echo $ImprovementsBuildingsDetails->getImprovementsBuildings(2);
//*/
?>