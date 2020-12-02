<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Address.php";
include("assessor/Assessor.php";
include("assessor/AssessorRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('AssessorList');
$server->handle();
//*/
class AssessorList
{
    function AssessorList(){
		
    }
    
    function getAssessorList($page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition = "LIMIT $page,".PAGE_BY;
		}
		$assessorRecords = new AssessorRecords;
		if ($assessorRecords->selectRecords($condition)){
			if(!$domDoc = $assessorRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function deleteAssessor($assessorIDArray){
		$assessorRecords = new AssessorRecords;
		$rows = $assessorRecords->deleteRecords($assessorIDArray);
		return $rows;
	}
	
	function getAssessorCount(){
		$assessorRecords = new AssessorRecords;
		return $assessorRecords->countRecords();
	}
	
	function getSearchCount($searchKey){
		$fields = array("firstName","middleName","lastName");
		$assessorRecords = new AssessorRecords;
		return $assessorRecords->countSearchRecords($searchKey,$fields);
	}
	
	function searchAssessor($searchKey,$page=0){
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$limit = "LIMIT $page,".PAGE_BY;
		}
		$fields = array("firstName","middleName","lastName");
		$assessorRecords = new AssessorRecords;
		if ($assessorRecords->searchRecords($searchKey,$fields,$limit)){
			if(!$domDoc = $assessorRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
}
/*
$obj = new AssessorList;
//$idArray[] = 126;
echo $obj->getAssessorList();
//echo $obj->deleteAssessor($idArray);
//echo $obj->getAssessorCount();
//echo $obj->getAssessorSearchCount("a");
echo $obj->searchAssessor("a",1);
//*/
?>