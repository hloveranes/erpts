<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/PropAssessKinds.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PropAssessKindsEncode');
$server->handle();
//*/
class PropAssessKindsEncode
{
    function PropAssessKindsEncode(){
		
    }

    function savePropAssessKinds($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$propAssessKinds = new PropAssessKinds;
		$propAssessKinds->parseDomDocument($domDoc);
		$ret = $propAssessKinds->insertRecord();
		return $ret;
	}
	
	function getPropAssessKindsDetails($propAssessKindsID) {
		$propAssessKinds = new PropAssessKinds;
		$propAssessKinds->selectRecord($propAssessKindsID);
		if(!$domDoc = $propAssessKinds->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updatePropAssessKinds($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$propAssessKinds = new PropAssessKinds;
		$propAssessKinds->parseDomDocument($domDoc);
		$ret = $propAssessKinds->updateRecord();
		return $ret;
	}
}

/*
$propAssessKinds = new PropAssessKinds;
//$propAssessKinds->setPropAssessKindsID(126);
$propAssessKinds->setCode("KJKSJDF");
$propAssessKinds->setDescription("KLAJSDFJASLKFJALSKFJ");
$propAssessKinds->setValue("1234");
$propAssessKinds->setStatus("Active");
$propAssessKinds->setDomDocument();
$domDoc = $propAssessKinds->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new PropAssessKindsEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updatePropAssessKinds($xmlStr);
echo $obj->savePropAssessKinds($xmlStr);
//echo  $obj->getPropAssessKindsDetails(128);
//*/
?>
