<?php
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Assessor.php";
include_once "../includes/assessor/AssessorRecords.php";
include_once "../includes/assessor/TD.php";
include_once "../includes/assessor/TDRecords.php";
include_once "../includes/assessor/RPTOP.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('RPTOPDetails');
$server->handle();
//*/

class RPTOPDetails
{
	var $rptop;
	
    function RPTOPDetails(){
	}
		
	function getRPTOP($rptopID){
		$rptop = new RPTOP;
		$rptop->selectRecord($rptopID);
		if(!$domDoc = $rptop->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}

}

/*
$obj = new RPTOPDetails;
echo $obj->getRPTOP(8);
//*/
?>
