<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/TD.php";
include_once "../includes/assessor/TDRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('TDList');
$server->handle();
//*/
class TDList
{
    function TDList(){
		
    }
    
    function getTDListForList($page=1,$condition="") {
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		else{
		    $page = 1;
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		$tdRecords = new TDRecords;
		if ($tdRecords->selectRecordsForList($condition)){
			if(!$domDoc = $tdRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	

    function getTDList($rptopID) {
		$tdRecords = new TDRecords;
		$tdRecords->selectRecords($rptopID);
		if(!$domDoc = $tdRecords->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	
    function searchTD($page=1,$searchKey,$condition) {
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		else{
		    $page = 1;
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		
        $fields = array(
            "taxDeclarationNumber" => TD_TABLE.".taxDeclarationNumber",
            "effectivity" => AFS_TABLE.".effectivity"
        );
        
        $tdRecords = new TDRecords;
        if ($tdRecords->searchRecords($searchKey,$fields,$condition)){
            if(!$domDoc = $tdRecords->getDomDocument()){
                return false;
            }
            else {
                $xmlStr = $domDoc->dump_mem(true);
                return $xmlStr;
            }
        }
        else return false;
	}

	function filterByPropertyType($page=0,$searchKey,$condition="") {
	    if($page > 0){
	        $page = ($page-1) * PAGE_BY;
	        $condition .= " LIMIT $page,".PAGE_BY;
        }
        $fields = array(
			"propertyType" => TD_TABLE . ".propertyType"
        );

        $tdRecords = new TDRecords;
        if ($tdRecords->searchRecords($searchKey,$fields,$condition)){
            if(!$domDoc = $tdRecords->getDomDocument()){
                return false;
            }
            else {
                $xmlStr = $domDoc->dump_mem(true);
                return $xmlStr;
            }
        }
        else return false;
	}

	function filterPropertyTypeCount($searchKey,$condition){
        $fields = array(
			"propertyType" => TD_TABLE . ".propertyType"
        );
		$tdRecords = new tdRecords;
		return $tdRecords->countSearchRecords($searchKey,$fields,$condition);
	}
	
	
	function getTDCount($condition){
		$tdRecords = new TDRecords;
		return $tdRecords->countRecords($condition);
	}	
	
    function getSearchCount($searchKey,$condition) {
        $fields = array(
            "taxDeclarationNumber" => TD_TABLE.".taxDeclarationNumber",
            "effectivity" => AFS_TABLE.".effectivity"
        );
        
		$tdRecords = new tdRecords;
		return $tdRecords->countSearchRecords($searchKey,$fields,$condition);
	}
	
	function archiveTD($tdIDArray,$archiveValue,$userID){
		$tdRecords = new TDRecords;
		$ret = $tdRecords->archiveRecords($tdIDArray,$archiveValue,$userID);
		return $ret;
	}
	
	function deleteTD($tdIDArray){
		$tdRecords = new TDRecords;
		$rows = $tdRecords->deleteRecords($tdIDArray);
		return $rows;
	}
	
	function removeTD($tdIDArray){
		$tdRecords = new TDRecords;
		$rows = $tdRecords->removeRecords($tdIDArray);
		return $rows;
	}
}
//*
//$obj = new TDList;
//echo htmlentities($obj->getTDListForList($thisVarHasAbsolutelyNothingInIt));

//echo $obj->getTDListOfPerson(2);
//echo $obj->getTDListForList(1);
//*/
?>
