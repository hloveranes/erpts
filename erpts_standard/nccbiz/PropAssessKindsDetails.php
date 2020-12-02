<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/PropAssessKinds.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PropAssessKindsDetails');
$server->handle();
//*/
class PropAssessKindsDetails
{
    function PropAssessKindsDetails(){
		
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
}
//*

// echo $obj->getPropAssessKindsDetails(4);
//*/
?>
