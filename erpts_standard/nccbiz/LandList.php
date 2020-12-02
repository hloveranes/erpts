<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Land.php";
include("assessor/LandRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('LandList');
$server->handle();
//*/
class LandList
{
    function LandList(){
		
    }
    
    function getLandList($afsID) {
		$landRecords = new LandRecords;
		$landRecords->selectRecords($afsID);
		if(!$domDoc = $landRecords->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function deleteLand($landIDArray){
		$landRecords = new LandRecords;
		$rows = $landRecords->deleteRecords($landIDArray);
		return $rows;
	}
	
	function removeLand($landIDArray){
		$landRecords = new LandRecords;
		$rows = $landRecords->removeRecords($landIDArray);
		return $rows;
	}
}
/*
$obj = new LandList;
$id = array(1,2);
//echo "xml".$obj->removeLand($id);
echo $obj->getLandList(1);
//*/
?>