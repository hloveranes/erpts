<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Assessor.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('AssessorDetails');
$server->handle();
//*/
class AssessorDetails
{
    function AssessorDetails(){
		
    }
    
    function getAssessorDetails($assessorID) {
		$assessor = new Assessor;
		$assessor->selectRecord($assessorID);
		if(!$domDoc = $assessor->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
}
/*
$obj = new AssessorDetails;
echo $obj->getAssessorDetails(2);
//*/
?>