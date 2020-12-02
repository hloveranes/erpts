<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/PropAssessUses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PropAssessUsesEncode');
$server->handle();
//*/
class PropAssessUsesEncode
{
    function PropAssessUsesEncode(){
		
    }

    function savePropAssessUses($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$propAssessUses = new PropAssessUses;
		$propAssessUses->parseDomDocument($domDoc);
		$ret = $propAssessUses->insertRecord();
		return $ret;
	}
	
	function getPropAssessUsesDetails($propAssessUsesID) {
		$propAssessUses = new PropAssessUses;
		$propAssessUses->selectRecord($propAssessUsesID);
		if(!$domDoc = $propAssessUses->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updatePropAssessUses($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$propAssessUses = new PropAssessUses;
		$propAssessUses->parseDomDocument($domDoc);
		$ret = $propAssessUses->updateRecord();
		return $ret;
	}
}

/*
$propAssessUses = new PropAssessUses;
//$propAssessUses->setPropAssessUsesID(126);
$propAssessUses->setCode("KJKSJDF");
$propAssessUses->setDescription("KLAJSDFJASLKFJALSKFJ");
$propAssessUses->setValue("1234");
$propAssessUses->setStatus("Active");
$propAssessUses->setDomDocument();
$domDoc = $propAssessUses->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new PropAssessUsesEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updatePropAssessUses($xmlStr);
echo $obj->savePropAssessUses($xmlStr);
//echo  $obj->getPropAssessUsesDetails(128);
//*/
?>
