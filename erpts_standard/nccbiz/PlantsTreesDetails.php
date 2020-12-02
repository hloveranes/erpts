<?php
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/PlantsTrees.php";
include_once "../includes/assessor/PlantsTreesRecords.php";
//*
$server = new SoapServer("urn:Object");
$server->setClass('PlantsTreesDetails');
$server->handle();
//*/

class PlantsTreesDetails
{
	var $plantsTrees;
	
    function PlantsTreesDetails()
    {
		$this->plantsTrees = new PlantsTrees;
    }
	
	function getPlantsTrees($plantsTreesID){
		$plantsTrees = new PlantsTrees;
		$plantsTrees->selectRecord($plantsTreesID);
		if(!$domDoc = $plantsTrees->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}

}

/*
$PlantsTreesDetails = new PlantsTreesDetails;
echo $PlantsTreesDetails->getPlantsTrees(1);
//*/
?>