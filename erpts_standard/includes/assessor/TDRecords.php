<?php
include_once "../web/prepend.php";
include_once "./TD.php";
class TDRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function TDRecords(){
	
	}
	
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	function setArrayList($tempVar){
		$this->arrayList[] = $tempVar;
	}
	
	function getArrayList(){
		return $this->arrayList;
	}
	
	function getDomDocument(){
		return $this->domDocument;
	}
	
	function appendToDomList($rootNode,$childNode){
		//$rootNode->append_child($childNode->document_element());

		// test clone_node()
		$nodeTmp = $childNode->document_element();
		$nodeClone = $nodeTmp->clone_node(true);
		$rootNode->append_child($nodeClone);
	}
		
	function setDomDocument(){
		$this->domDocument = domxml_new_doc("1.0");
		$domList = $this->domDocument->create_element("TDList");
		$domList = $this->domDocument->append_child($domList);
		if ($this->arrayList){
			foreach($this->arrayList as $key => $value){
				$domDocument = $value->getDomDocument();
				$this->appendToDomList($domList,$domDocument);
			}
		}
		return true;
	}
	
	///*
	function parseDomDocument($domDoc){
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//if ($child->tagname=="TD") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$td = new TD;
					$td->parseDomDocument($tempDomDoc);
					$this->arrayList[] = $td;
				}
				$child = $child->next_sibling();
			}
		}
		$this->setDomDocument();
        //$this->setDomDocumentRecords();
		return true;
	}//*/

	///* START OF ORIGINAL GENERIC SCRIPT
	function selectRecordsForList($condition=""){
//		$sql = sprintf("select * from %s order by tdID desc %s;",TD_TABLE, $condition);

		$sql = "SELECT "
		    .TD_TABLE.".tdID as tdID, "
			.TD_TABLE.".afsID, "
			.AFS_TABLE.".odID, "
			.TD_TABLE.".taxDeclarationNumber as taxDeclarationNumber, "
			."(".TD_TABLE.".ceasesWithTheYear - ".TD_TABLE.".taxBeginsWithTheYear) as year, "
			."CONCAT(".PERSON_TABLE.".lastName,".PERSON_TABLE.".firstName,".PERSON_TABLE.".middleName) as PersonFullName, "
			.COMPANY_TABLE.".companyName "
			."FROM ".TD_TABLE." "
			."LEFT JOIN ".AFS_TABLE." "
			."ON ".TD_TABLE.".afsID = ".AFS_TABLE.".afsID "
            ."LEFT JOIN ".OWNER_TABLE." "
            ."ON ".AFS_TABLE.".odID = ".OWNER_TABLE.".odID "
            ."LEFT JOIN ".OWNER_PERSON_TABLE." "
            ."ON ".OWNER_TABLE.".ownerID = ".OWNER_PERSON_TABLE.".ownerID "
            ."LEFT JOIN ".PERSON_TABLE." "
            ."ON ".OWNER_PERSON_TABLE.".personID = ".PERSON_TABLE.".personID "
            ."LEFT JOIN ".OWNER_COMPANY_TABLE." "
            ."ON ".OWNER_TABLE.".ownerID = ".OWNER_COMPANY_TABLE.".ownerID "
            ."LEFT JOIN ".COMPANY_TABLE." "
            ."ON ".OWNER_COMPANY_TABLE.".companyID = ".COMPANY_TABLE.".companyID ";

		$sql = $sql . " " . $condition;

		$this->setDB();

		//$dummySQL = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		//$this->db->query($dummySQL);


		$this->db->query($sql);

		while ($this->db->next_record()) {
			$idArray[] = $this->db->f("tdID");
		}
		$idArray = array_unique($idArray);

		foreach($idArray as $key => $tdID){
			$td = new TD;
			$td->selectRecord($tdID);
			$this->arrayList[] = $td;
		}

		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
	}
	//*/
	// END OF ORIGINAL GENERIC SCRIPT

	// START OF NEW SCRIPT (SEPT 2005)
	/*
	function selectRecordsForList($condition=""){
		$this->setDB();

		$tempTable = "tempTD";
		$sql = "DROP TABLE IF EXISTS ".$tempTable."; ";
		$this->db->query($sql);

		$sql = "CREATE TEMPORARY TABLE ".$tempTable." ";
		$sql .= "SELECT "
		    .TD_TABLE.".tdID as tdID, "
			.TD_TABLE.".afsID, "
			.AFS_TABLE.".odID, "
			.TD_TABLE.".taxDeclarationNumber as taxDeclarationNumber, "
			."(".TD_TABLE.".ceasesWithTheYear - ".TD_TABLE.".taxBeginsWithTheYear) as year, "
			."CONCAT(".PERSON_TABLE.".lastName,".PERSON_TABLE.".firstName,".PERSON_TABLE.".middleName) as PersonFullName, "
			.COMPANY_TABLE.".companyName "
			."FROM ".TD_TABLE." "
			."LEFT JOIN ".AFS_TABLE." "
			."ON ".TD_TABLE.".afsID = ".AFS_TABLE.".afsID "
            ."LEFT JOIN ".OWNER_TABLE." "
            ."ON ".AFS_TABLE.".odID = ".OWNER_TABLE.".odID "
            ."LEFT JOIN ".OWNER_PERSON_TABLE." "
            ."ON ".OWNER_TABLE.".ownerID = ".OWNER_PERSON_TABLE.".ownerID "
            ."LEFT JOIN ".PERSON_TABLE." "
            ."ON ".OWNER_PERSON_TABLE.".personID = ".PERSON_TABLE.".personID "
            ."LEFT JOIN ".OWNER_COMPANY_TABLE." "
            ."ON ".OWNER_TABLE.".ownerID = ".OWNER_COMPANY_TABLE.".ownerID "
            ."LEFT JOIN ".COMPANY_TABLE." "
            ."ON ".OWNER_COMPANY_TABLE.".companyID = ".COMPANY_TABLE.".companyID ";
		$sql = $sql . " " . $condition.";";
		$this->db->query($sql);

		$sql = " SELECT DISTINCT(tdID) FROM ".$tempTable;
		$this->db->query($sql);

		$dummySQL = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		$this->db->query($dummySQL);

		while ($this->db->next_record()) {
			$idArray[] = $this->db->f("tdID");
		}

		foreach($idArray as $key => $tdID){
			$td = new TD;
			$td->selectRecord($tdID);
			$this->arrayList[] = $td;
		}

		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
	}
	*/
	// END OF NEW EXPERIMENTAL SCRIPT (SEPT 2005)

    function searchRecords($searchKey,$fields,$limit=""){
		if($limit!=""){
			$limit = str_replace("WHERE", "and", $limit);
		}

        $condition = " where ".TD_TABLE.".afsID=".AFS_TABLE.".afsID AND (";

		if($fields["propertyType"] != ""){
	        $condition = $condition.$fields["propertyType"]." like '%".$searchKey."%'";
		}
		else{
	        $condition = $condition.$fields["taxDeclarationNumber"]." like '%".$searchKey."%'";

			$condition = $condition. " or ";
			$condition = $condition. "(";
			$condition = $condition.$fields["effectivity"]." like '%".$searchKey."%'";
			$condition = $condition. ") ";
		}

		$sql = "SELECT ".TD_TABLE.".tdID FROM ".TD_TABLE.", ".AFS_TABLE." ";
		
        $sql = $sql . $condition . ") " . $limit;
        
		$this->setDB();

		//$dummySQL = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		//$this->db->query($dummySQL);

		$this->db->query($sql);
		while ($this->db->next_record()) {
			$td = new TD;
			$td->selectRecord($this->db->f("tdID"));
			$this->arrayList[] = $td;
		}
		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
    }

    function countSearchRecords($searchKey,$fields,$limit=""){
		if($limit!=""){
			$limit = str_replace("WHERE", "and", $limit);
		}

        $condition = " where ".TD_TABLE.".afsID=".AFS_TABLE.".afsID AND (";

		if($fields["propertyType"] != ""){
	        $condition = $condition.$fields["propertyType"]." like '%".$searchKey."%'";
		}
		else{
	        $condition = $condition.$fields["taxDeclarationNumber"]." like '%".$searchKey."%'";

			$condition = $condition. " or ";
			$condition = $condition. "(";
			$condition = $condition.$fields["effectivity"]." like '%".$searchKey."%'";
			$condition = $condition. ") ";
		}
		
		$sql = "SELECT COUNT(".TD_TABLE.".tdID) as count FROM ".TD_TABLE.", ".AFS_TABLE." ";

        $sql = $sql . $condition . ")";

		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
    }
	
	function countRecords($condition=""){
		$sql = sprintf("select count(*) as count from %s %s",
				TD_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}        	

    function selectRecords($rptopID=false,$condition=""){
		$where = ($rptopID) ? "where rptopID = $rptopID" : $condition;
		$sql = sprintf("select * from %s %s limit 0,10;",
				TD_TABLE, $where);
		$this->setDB();

		$this->db->query($sql);
		//echo $sql;
		while ($this->db->next_record()) {
			//echo $this->db->f("tdID")."<br>";
			$td = new TD;
			$td->selectRecord($this->db->f("tdID"));
			//print_r($td);
			//echo "<br>";
			$this->arrayList[] = $td;
			unset($td);
		}
		unset($this->db);
		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
	}

	function archiveRecords($tdIDArray="",$archiveValue="",$userID=""){
		$td = new TD;
		$ret = false;
		foreach($tdIDArray as $key => $value){
			if($td->archiveRecord($value,$archiveValue,$userID))
				$ret = true;
		}
		return $ret;
	}
	
	function deleteRecords($tdIDArray=""){
		$td = new TD;
		$rows = 0;
		foreach ($tdIDArray as $key => $value){
			if ($td->deleteRecord($value)) $rows++;
		}
		return $rows;
	}
	
	function removeRecords($tdIDArray=""){
		$td = new TD;
		$rows = 0;
		foreach ($tdIDArray as $key => $value){
			if ($td->removeRecord($value)) $rows++;
		}
		return $rows;
	}
	
	function addTDToList($td){
		$this->arrayList[] = $td;
	}
}

//$obj = new TDrecords;
//$page = 1;
//$page = ($page-1) * PAGE_BY;
//$condition = "LIMIT $page,".PAGE_BY;

//$fields = array(
//    "taxDeclarationNumber" => "taxDeclarationNumber",
//    "taxBeginsWithTheYear" => "taxBeginsWithTheYear",
//    "ceasesWithTheYear" => "ceasesWithTheYear"
//);

//$obj->searchRecords("1234", $fields, $condition);
//print_r($obj->arrayList);

//$obj->selectRecordsForList($condition);
//print_r($obj->arrayList);
//echo htmlentities($obj->domDocument->dump_mem());

//$obj->selectRecords();
//print_r($obj->arrayList);
//echo $obj->domDocument->dump_mem(true);
//unset($obj);

?>
