<?php
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Storey.php";
//*
$server = new SoapServer("urn:Object");
$server->setClass('StoreyDetails');
$server->handle();
//*/

class StoreyDetails
{
	var $storey;
	
    function StoreyDetails()
    {
		$this->storey = new Storey;
    }
	
	function getStorey($storeyID){
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

}

/*
$StoreyDetails = new StoreyDetails;
echo $StoreyDetails->getStorey(2);
//*/
?>