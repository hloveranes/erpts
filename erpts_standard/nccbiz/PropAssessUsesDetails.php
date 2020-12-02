<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/PropAssessUses.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('PropAssessUsesDetails');
$server->handle();
//*/
class PropAssessUsesDetails
{
    function PropAssessUsesDetails(){
		
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
}
//*

// echo $obj->getPropAssessUsesDetails(4);
//*/
?>
