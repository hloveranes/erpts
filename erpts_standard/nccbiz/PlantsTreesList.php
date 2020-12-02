<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/PlantsTrees.php";
include("assessor/PlantsTreesRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PlantsTreesList');
$server->handle();
//*/
class PlantsTreesList
{
    function PlantsTreesList(){
		
    }
    
    function getPlantsTreesList($afsID) {
		$plantsTreesRecords = new PlantsTreesRecords;
		$plantsTreesRecords->selectRecords($afsID);
		if(!$domDoc = $plantsTreesRecords->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function deletePlantsTrees($plantsTreesIDArray){
		$plantsTreesRecords = new PlantsTreesRecords;
		$rows = $plantsTreesRecords->deleteRecords($plantsTreesIDArray);
		return $rows;
	}
	
	function removePlantsTrees($plantsTreesIDArray){
		$plantsTreesRecords = new PlantsTreesRecords;
		$rows = $plantsTreesRecords->removeRecords($plantsTreesIDArray);
		return $rows;
	}
}
/*
$obj = new PlantsTreesList;
//$id[] = 1295;
//echo "xml".$obj->deletePlantsTrees($id);
echo $obj->getPlantsTreesList();
//*/
?>