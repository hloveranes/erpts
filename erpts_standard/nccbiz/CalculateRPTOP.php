<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/RPTOP.php";
include("assessor/RPTOPRecords.php";

//*
$server = new SoapServer("urn:Object");
$server->setClass('RPTOPList');
$server->handle();
//*/
class RPTOPList
{
    function RPTOPList(){
		
    }
    
    function getRPTOPList() {
		$rptopRecords = new RPTOPRecords;
		$rptopRecords->selectRecords();
		if(!$domDoc = $rptopRecords->getDomDocument()){
			return false;
		}
		else {
			$xmlStr = $domDoc->dump_mem(true);
			return $xmlStr;
		}
	}
	function getRPTOPCount(){
		$rptopRecords = new RPTOPRecords;
		return $rptopRecords->countRecords();
	}
	
	function deleteRPTOP($rptopIDArray){
		$rptopRecords = new RPTOPRecords;
		$rows = $rptopRecords->deleteRPTOPRecords($rptopIDArray);
		return $rows;
	}
	
	function searchRPTOP($page=0,$searchKey) {
	    if($page > 0){
	        $page = ($page-1) * PAGE_BY;
	        $condition = "LIMIT $page,".PAGE_BY;
        }
        $fields = array(
            RPTOP_TABLE . ".rptopNumber",
            COMPANY_TABLE . ".companyName",
            PERSON_TABLE . ".lastName",
            PERSON_TABLE . ".middleName",
            PERSON_TABLE . ".firstName",
            TD_TABLE . ".taxDeclarationNumber"
        );
        
        $rptopRecords = new RPTOPRecords;
        if ($rptopRecords->searchRecords($searchKey,$fields,$condition)){
            if(!$domDoc = $rptopRecords->getDomDocument()){
                return false;
            }
            else {
                $xmlStr = $domDoc->dump_mem(true);
                return $xmlStr;
            }
        }
        else return false;
	}	
	
	function getSearchCount($searchKey){
        $fields = array(
            RPTOP_TABLE . ".rptopNumber",
            COMPANY_TABLE . ".companyName",
            PERSON_TABLE . ".lastName",
            PERSON_TABLE . ".middleName",
            PERSON_TABLE . ".firstName",
            TD_TABLE . ".taxDeclarationNumber"
        );
		$rptopRecords = new rptopRecords;
		return $rptopRecords->countSearchRecords($searchKey,$fields);
	}	
}

//$rptopList = new RPTOPList;
//echo $rptopList->searchRPTOP("","ltd");

/*
$obj = new RPTOPList;
//$id[] = 1295;
//echo "xml".$obj->deleteRPTOP($id);
echo $obj->getRPTOPList();
//*/
?>
