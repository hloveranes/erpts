<?php
# Setup PHPLIB in storey Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Storey.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('StoreyEncode');
$server->handle();
//*/
class StoreyEncode
{
    function StoreyEncode(){
		
    }
    
    function saveStorey($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$storey = new Storey;
		$storey->parseDomStorey($domDoc);
		$ret = $storey->insertStorey();
		return $ret;
	}
	
	function getStoreyDetails($storeyID) {
		$storey = new Storey;
		$storey->selectStorey($storeyID);
		if(!$domDoc = $storey->getDomStorey()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateStorey($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$storey = new Storey;
		$storey->parseDomStorey($domDoc);
		$ret = $storey->updateStorey();
		return $ret;
	}
}
/*
$storey = new Storey;
//$storey->storeyID = 2;
$storey->improvementsBuildingsID = 8;
$storey->floorNumber = "floorNumber2";
$storey->area = "area2";
$storey->materials = "materials2";
$storey->value = "value2";
$storey->foundation = "foundation2";
$storey->columnsBeams = "columnsBeams2";
$storey->trussFraming = "trussFraming2";
$storey->roof = "roof2";
$storey->exteriorWall = "exteriorWall2";
$storey->flooring = "flooring2";
$storey->doors = "doors2";
$storey->windows = "windows2";
$storey->stairs = "stairs2";
$storey->wallFinish = "wallFinish2";
$storey->electrical = "electrical2";
$storey->toiletAndBath = "toiletAndBath2";
$storey->plumbingSewer = "plumbingSewer2";
$storey->fixtures = "fixtures2";
$storey->setDomStorey();
$obj = new StoreyEncode;
$xmlStr = $storey->domStorey->dump_mem(true);
//echo "test"."<br>";
//echo $obj->updateStorey($xmlStr);
echo $obj->saveStorey($xmlStr);
//echo $obj->getStoreyDetails(2);
//*/
?>