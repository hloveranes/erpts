<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Storey.php";
include("assessor/StoreyRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('StoreyList');
$server->handle();
//*/
class StoreyList
{
    function StoreyList(){
		
    }
    
    function getStoreyList($improvementsBuildingsID) {
		$storeyRecords = new StoreyRecords;
		$storeyRecords->selectStoreyRecords($improvementsBuildingsID);
		if(!$domDoc = $storeyRecords->getDomStoreyRecords()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function deleteStorey($storeyIDArray){
		$storeyRecords = new StoreyRecords;
		$rows = $storeyRecords->deleteStoreyRecords($storeyIDArray);
		return $rows;
	}
	
	function removeStorey($storeyIDArray){
		$storeyRecords = new StoreyRecords;
		$rows = $storeyRecords->removeStoreyRecords($storeyIDArray);
		return $rows;
	}
}
/*
$obj = new StoreyList;
//$id[] = 1295;
//echo "xml".$obj->deleteStorey($id);
echo $obj->getStoreyList();
//*/
?>