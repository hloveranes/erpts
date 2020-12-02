<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Province.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('ProvinceEncode');
$server->handle();
//*/
class ProvinceEncode
{
    function ProvinceEncode(){
		
    }

    function saveProvince($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$province = new Province;
		$province->parseDomDocument($domDoc);
		$ret = $province->insertRecord();
		return $ret;
	}
	
	function getProvinceDetails($provinceID) {
		$province = new Province;
		$province->selectRecord($provinceID);
		if(!$domDoc = $province->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
	function updateProvince($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
 			return false;
		}
		$province = new Province;
		$province->parseDomDocument($domDoc);
		$ret = $province->updateRecord();
		return $ret;
	}
}

/*
$province = new Province;
//$province->setProvinceID(126);
$province->setCode("KJKSJDF");
$province->setDescription("KLAJSDFJASLKFJALSKFJ");
$province->setStatus("Active");
$province->setDomDocument();
$domDoc = $province->getDomDocument();
$xmlStr = $domDoc->dump_mem(true);
$obj = new ProvinceEncode;
//echo "hello<br>";
echo $xmlStr;
//echo $obj->updateProvince($xmlStr);
echo $obj->saveProvince($xmlStr);
//echo  $obj->getProvinceDetails(128);
//*/
?>
