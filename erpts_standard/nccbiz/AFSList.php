<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Owner.php";
include("assessor/OD.php";
include("assessor/ODRecords.php";
include("assessor/AFS.php";
include("assessor/AFSRecords.php";

///*
$server = new SoapServer("urn:Object");
$server->setClass('AFSList');
$server->handle();
//*/
class AFSList
{
    function AFSList(){
		
    }

    function getAFSList($page=0,$condition) {
		if ($page > 0){
			$page = ($page-1) * PAGE_BY;
			$condition .= " LIMIT $page,".PAGE_BY;
		}
		//echo $condition;
		$afsRecords = new AFSRecords;
		if ($afsRecords->selectRecords($condition)){
			if(!$domDoc = $afsRecords->getDomDocument()){
				return false;
			}
			else {
				$xmlStr = $domDoc->dump_mem(true);
				return $xmlStr;
			}
		}
		else return false;
	}
	
	function getAFSCount($condition=""){
		$afsRecords = new AFSRecords;
		return $afsRecords->countRecords($condition);
	}

	function archiveAFS($afsIDArray,$archiveValue,$userID){
		$afsRecords = new AFSRecords;
		$ret = $afsRecords->archiveRecords($afsIDArray,$archiveValue,$userID);
		return $ret;
	}
	
	function searchAFS($page=0,$searchKey,$condition) {
	    if($page > 0){
	        $page = ($page-1) * PAGE_BY;
	        $condition .= " LIMIT $page,".PAGE_BY;
	    }
        $fields = array(
            AFS_TABLE.".arpNumber",
            AFS_TABLE.".propertyIndexNumber",
            COMPANY_TABLE.".companyName",
            PERSON_TABLE.".lastName",
            PERSON_TABLE.".middleName",
            PERSON_TABLE.".firstName"
        );
        $afsRecords = new AFSRecords;
        if ($afsRecords->searchRecords($searchKey,$fields,$condition)){
            if(!$domDoc = $afsRecords->getDomDocument()){
                return false;
            }
            else {
                $xmlStr = $domDoc->dump_mem(true);
                return $xmlStr;
            }
        }
        else return false;
	}	
	
	function getSearchCount($searchKey, $condition){
        $fields = array(
            AFS_TABLE.".arpNumber",
            AFS_TABLE.".propertyIndexNumber",
            COMPANY_TABLE.".companyName",
            PERSON_TABLE.".lastName",
            PERSON_TABLE.".middleName",
            PERSON_TABLE.".firstName"
        );
		$afsRecords = new AFSRecords;
		return $afsRecords->countSearchRecords($searchKey,$fields,$condition);
	}
}
//$afsList = new AFSList;
//echo $afsList->getAFSList(0);

?>
