<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/ImprovementsBuildings.php";
include("assessor/ImprovementsBuildingsRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ImprovementsBuildingsList');
$server->handle();
//*/
class ImprovementsBuildingsList
{
    function ImprovementsBuildingsList(){
		
    }
    
    function getImprovementsBuildingsList($afsID) {
		$improvementsBuildingsRecords = new ImprovementsBuildingsRecords;
		$improvementsBuildingsRecords->selectRecords($afsID);
		if(!$domDoc = $improvementsBuildingsRecords->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function deleteImprovementsBuildings($improvementsBuildingsIDArray){
		$improvementsBuildingsRecords = new ImprovementsBuildingsRecords;
		$rows = $improvementsBuildingsRecords->deleteRecords($improvementsBuildingsIDArray);
		return $rows;
	}
	
	function removeImprovementsBuildings($improvementsBuildingsIDArray){
		$improvementsBuildingsRecords = new ImprovementsBuildingsRecords;
		$rows = $improvementsBuildingsRecords->removeRecords($improvementsBuildingsIDArray);
		return $rows;
	}
}
/*
$obj = new ImprovementsBuildingsList;
//$id[] = 1295;
//echo "xml".$obj->deleteImprovementsBuildings($id);
echo $obj->getImprovementsBuildingsList(1);
//*/
?>