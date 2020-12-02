<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/Collection.php";
//*
$server = new SoapServer("urn:Object");
$server->setClass('CollectionEncode');
$server->handle();
//*/
class CollectionEncode
{
    function CollectionEncode(){
		
    }

	function saveCollection($xmlStr) {
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$collection = new Collection;
		$collection->parseDomDocument($domDoc);
		$ret = $collection->insertRecord();
		return $ret;
	}
	function updateCollection($xmlStr){
		if(!$domDoc = domxml_open_mem($xmlStr)) {
			return false;
		}
		$collection = new Collection;
		$collection->parseDomDocument($domDoc);
		$ret = $collection->updateRecord();
		return $ret;
	}
}
?>
