<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/Collection.php";


//*
$server = new SoapServer("urn:Object");
$server->setClass('CollectionDetails');
$server->handle();
//*/

class CollectionDetails
{
	var $collection;
	
    function CollectionDetails()
    {
		$this->collection = new Collection;
    }

	function getCollection($collectionID){
		$collection = new Collection;
		$collection->selectRecord($collectionID);
		if(!$domDoc = $collection->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
?>
