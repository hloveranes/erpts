<?php
class ODRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function ODRecords(){
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
	
	function appendToDomList(&$rootNode,&$childNode){
		//$rootNode->append_child($childNode->document_element());

		// test clone_node()
		$nodeTmp = $childNode->document_element();
		$nodeClone = $nodeTmp->clone_node(true);
		$rootNode->append_child($nodeClone);
	}
		
	function setDomDocument(){
		$this->domDocument = domxml_new_doc("1.0");
		$domList = $this->domDocument->create_element("ArrayList");
		$domList = $this->domDocument->append_child($domList);
		if (is_array($this->arrayList)){
			foreach($this->arrayList as $key => $value){
				$domOD = $value->getDomDocument();
				$this->appendToDomList($domList,$domOD);
			}
			$ret = true;
		}
		else{
			$ret = false;
		}
		return $ret;
	}
	
	///*
	function parseDomDocument($domDoc){
		$baseNode = $domDoc->document_element();
		
		// IF statement for bug fix of December 04, 2003
		// when an error occured on a blank FAAS list

		if(!is_object($baseNode)){
			return false;
		}
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//if ($child->tagname=="OD") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$od = new OD;
					if ($od->parseDomDocument($tempDomDoc)) {
						$this->arrayList[] = $od;
					}
				}
				$child = $child->next_sibling();
			}
		}
		$ret = ($this->setDomDocument()) ? true : false;
		return $ret;
	}//*/

	// NCC Modification checked and implemented by K2 : November 16, 2005
	// details:
	//      added function selectLatestActiveRecordsGenRevBrgy() in line 86

	function selectLatestActiveRecordsGenRevBrgy($brgy=0){
		$sql = "SELECT ".OD_TABLE.".odID as odID FROM ".OD_TABLE
				." LEFT JOIN ".ODHISTORY_TABLE
				." ON ".OD_TABLE.".odID = ".ODHISTORY_TABLE.".previousODID"
				." LEFT JOIN Location on Location.odID = OD.odID"
				." LEFT JOIN LocationAddress on Location.locationAddressID = LocationAddress.locationAddressID"
				." WHERE ".ODHISTORY_TABLE.".previousODID IS NULL "
				." and LocationAddress.barangayID = " . $brgy; //alex: set brgy code here!!!
		//alex
		$this->setDB();

		//$dummySQL = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		//$this->db->query($dummySQL);

		$this->db->query($sql);

		while ($this->db->next_record()) {
			$tmpArray[] = $this->db->f("odID");
		}
		$idArray = array_unique($tmpArray);

		foreach($idArray as $key => $odID){
			$od = new OD;
			$odIDList[] = $odID;
		}

		if(count($odIDList) > 0){
			return $odIDList;
		}
		else{
			return false;
		}
	}

	function selectLatestActiveRecords($condition=""){
		$sql = "SELECT ".OD_TABLE.".odID as odID FROM ".OD_TABLE
				." LEFT JOIN ".ODHISTORY_TABLE
				." ON ".OD_TABLE.".odID = ".ODHISTORY_TABLE.".previousODID"
				." WHERE ".ODHISTORY_TABLE.".previousODID IS NULL";

		$this->setDB();

		//$dummySQL = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		//$this->db->query($dummySQL);

		$this->db->query($sql);

		while ($this->db->next_record()) {
			$tmpArray[] = $this->db->f("odID");
		}
		$idArray = array_unique($tmpArray);

		foreach($idArray as $key => $odID){
			$od = new OD;
			$odIDList[] = $odID;
		}

		if(count($odIDList) > 0){
			return $odIDList;
		}
		else{
			return false;
		}
	}
	
	function selectRecords($condition=""){
        $sql = "SELECT distinct (" . OD_TABLE . ".odID) as odID
				  , CONCAT(".PERSON_TABLE.".lastName,".PERSON_TABLE.".firstName,".PERSON_TABLE.".middleName) as PersonFullName
				  FROM " . OD_TABLE . "
				  LEFT JOIN " . LOCATION_TABLE . "
				  ON " . OD_TABLE . ".odID = " . LOCATION_TABLE . ".odID
				  LEFT JOIN " . OWNER_TABLE . "
				  ON " . LOCATION_TABLE . ".odID = " . OWNER_TABLE . ".odID
                  LEFT JOIN " . OWNER_COMPANY_TABLE . "
                  ON " . OWNER_TABLE . ".ownerID = " . OWNER_COMPANY_TABLE . ".ownerID
                  LEFT JOIN " . COMPANY_TABLE . "
                  ON " . OWNER_COMPANY_TABLE . ".companyID = " . COMPANY_TABLE . ".companyID
                  LEFT JOIN " . OWNER_PERSON_TABLE . "
                  ON " . OWNER_TABLE . ".ownerID = " . OWNER_PERSON_TABLE . ".ownerID
                  LEFT JOIN " . PERSON_TABLE . "
                  ON " . OWNER_PERSON_TABLE . ".personID = " . PERSON_TABLE . ".personID

                  LEFT JOIN " . LOCATIONADDRESS_TABLE . "
                  ON " . LOCATION_TABLE . ".locationAddressID=" . LOCATIONADDRESS_TABLE . ".locationAddressID

                  LEFT JOIN " . BARANGAY_TABLE . "
                  ON " . BARANGAY_TABLE . ".barangayID=" . LOCATIONADDRESS_TABLE . ".barangayID 

				  LEFT JOIN " . DISTRICT_TABLE . "
				  ON " . DISTRICT_TABLE . ".districtID=" . LOCATIONADDRESS_TABLE . ".district 
				  LEFT JOIN " . MUNICIPALITYCITY_TABLE . "
				  ON " . MUNICIPALITYCITY_TABLE . ".municipalityCityID=" . LOCATIONADDRESS_TABLE . ".municipalityCity 
				  LEFT JOIN " . PROVINCE_TABLE . "
				  ON " . PROVINCE_TABLE . ".provinceID=" . LOCATIONADDRESS_TABLE . ".province";

		$sql = $sql . $condition;

		$this->setDB();

		//$dummySQL = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		//$this->db->query($dummySQL);

		$this->db->query($sql);

		while ($this->db->next_record()) {
			$tmpArray[] = $this->db->f("odID");
		}

		if(is_array($tmpArray)){
			$idArray = array_unique($tmpArray);
			foreach($idArray as $key => $odID){
				$od = new OD;
				$od->selectRecord($odID);
				$this->arrayList[] = $od;
			}
		}

		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
	}

	function getFullNameSearchCondition($condition,$searchKey){
		// October 07, 2005
		// return condition that searches by Person's FULL NAME

		// {firstName}<space>{lastName} e.g.: PEDRO BALINGIT
		if(strstr(strtoupper($condition),"OR")!=false){
			$condition .= " OR ";
		}
		else{
			if($condition!=""){
				$condition .= " OR ";
			}
		}

		$condition .= " CONCAT_WS(' '";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".firstName))";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".lastName))";
		$condition .= ")";
		$condition .= " LIKE '%".strtoupper($searchKey)."%' ";

		// {firstName}<space>{lastNameInitial} e.g.: PEDRO B
		$condition .= " OR ";
		$condition .= "CONCAT_WS(' '";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".firstName))";
		$condition .= ",TRIM(UCASE(LEFT(".PERSON_TABLE.".middleName,1)))";
		$condition .= ")";
		$condition .= " LIKE '%".strtoupper($searchKey)."%' ";

		// {firstName}<space>{middleName} e.g.: PEDRO ROCES
		$condition .= " OR ";
		$condition .= "CONCAT_WS(' '";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".firstName))";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".middleName))";
		$condition .= ")";
		$condition .= " LIKE '%".strtoupper($searchKey)."%' ";

		// {firstName}<space>{middleInitial} e.g.: PEDRO R
		$condition .= " OR ";
		$condition .= "CONCAT_WS(' '";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".firstName))";
		$condition .= ",TRIM(UCASE(LEFT(".PERSON_TABLE.".lastName,1)))";
		$condition .= ")";
		$condition .= " LIKE '%".strtoupper($searchKey)."%' ";

		// {middleName}<space>{firstName} e.g.: ROCES PEDRO
		$condition .= " OR ";
		$condition .= "CONCAT_WS(' '";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".middleName))";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".firstName))";
		$condition .= ")";
		$condition .= " LIKE '%".strtoupper($searchKey)."%' ";


		// {firstName}<space>{middleName}<space>{lastName} e.g.: PEDRO ROCES BALINGIT
		$condition .= " OR ";
		$condition .= "CONCAT_WS(' '";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".firstName))";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".middleName))";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".lastName))";
		$condition .= ")";
		$condition .= " LIKE '%".strtoupper($searchKey)."%' ";

		// {firstName}<space>{middleInitial}<dot><space>{lastName} e.g.: PEDRO R. BALINGIT
		$condition .= " OR ";
		$condition .= "CONCAT_WS(' '";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".firstName))";
		$condition .= ",CONCAT(TRIM(UCASE(LEFT(".PERSON_TABLE.".middleName,1))),'.')";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".lastName))";
		$condition .= ")";
		$condition .= " LIKE '%".strtoupper($searchKey)."%' ";

		// {lastName}<comma>{firstName} e.g.: BALINGIT, PEDRO
		$condition .= " OR ";
		$condition .= "CONCAT_WS(' '";
		$condition .= ",CONCAT(TRIM(UCASE(".PERSON_TABLE.".lastName)),',')";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".firstName))";
		$condition .= ")";
		$condition .= " LIKE '%".strtoupper($searchKey)."%' ";

		// {lastName}<comma>{firstName}<space>{middleName} e.g.: BALINGIT, PEDRO ROCES
		$condition .= " OR ";
		$condition .= "CONCAT_WS(' '";
		$condition .= ",CONCAT(TRIM(UCASE(".PERSON_TABLE.".lastName)),',')";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".firstName))";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".middleName))";
		$condition .= ")";
		$condition .= " LIKE '%".strtoupper($searchKey)."%' ";

		// {lastName}<comma>{firstName}<space>{middleInitial}<dot> e.g.: BALINGIT, PEDRO R.
		$condition .= " OR ";
		$condition .= "CONCAT_WS(' '";
		$condition .= ",CONCAT(TRIM(UCASE(".PERSON_TABLE.".lastName)),',')";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".firstName))";
		$condition .= ",CONCAT(TRIM(UCASE(LEFT(".PERSON_TABLE.".middleName,1))),'.')";
		$condition .= ")";
		$condition .= " LIKE '%".strtoupper($searchKey)."%' ";

		// {lastName}<space>{firstName} e.g.: BALINGIT PEDRO
		$condition .= " OR ";
		$condition .= "CONCAT_WS(' '";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".lastName))";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".firstName))";
		$condition .= ")";
		$condition .= " LIKE '%".strtoupper($searchKey)."%' ";

		// {lastName}<space>{firstName}<space>{middleName} e.g.: BALINGIT PEDRO ROCES
		$condition .= " OR ";
		$condition .= "CONCAT_WS(' '";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".lastName))";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".firstName))";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".middleName))";
		$condition .= ")";
		$condition .= " LIKE '%".strtoupper($searchKey)."%' ";

		// {lastName}<space>{firstName}<space>{middleInitial}<dot> e.g.: BALINGIT PEDRO R.
		$condition .= " OR ";
		$condition .= "CONCAT_WS(' '";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".lastName))";
		$condition .= ",TRIM(UCASE(".PERSON_TABLE.".firstName))";
		$condition .= ",CONCAT(TRIM(UCASE(LEFT(".PERSON_TABLE.".middleName,1))),'.')";
		$condition .= ")";
		$condition .= " LIKE '%".strtoupper($searchKey)."%' ";





		return $condition;
	}
	
	function searchRecords($searchKey,$fields,$limit=""){
		if($limit!=""){
			$limit = str_replace("WHERE", "and", $limit);
		}

		$condition = " where (";
		
		foreach($fields as $key => $value){
			if($key == 0) $condition = $condition.$value." like '%".$searchKey."%'";
			else $condition = $condition." or ".$value." like '%".$searchKey."%' ";
		}

		// October 07, 2005
		$condition = $this->getFullNameSearchCondition($condition,$searchKey);

        $sql = "SELECT distinct (" . OD_TABLE . ".odID) as odID
				  , CONCAT(".PERSON_TABLE.".lastName,".PERSON_TABLE.".firstName,".PERSON_TABLE.".middleName) as PersonFullName
				  FROM " . OD_TABLE . "
				  LEFT JOIN " . LOCATION_TABLE . "
				  ON " . OD_TABLE . ".odID = " . LOCATION_TABLE . ".odID
				  LEFT JOIN " . OWNER_TABLE . "
				  ON " . LOCATION_TABLE . ".odID = " . OWNER_TABLE . ".odID
                  LEFT JOIN " . OWNER_COMPANY_TABLE . "
                  ON " . OWNER_TABLE . ".ownerID = " . OWNER_COMPANY_TABLE . ".ownerID
                  LEFT JOIN " . COMPANY_TABLE . "
                  ON " . OWNER_COMPANY_TABLE . ".companyID = " . COMPANY_TABLE . ".companyID
                  LEFT JOIN " . OWNER_PERSON_TABLE . "
                  ON " . OWNER_TABLE . ".ownerID = " . OWNER_PERSON_TABLE . ".ownerID
                  LEFT JOIN " . PERSON_TABLE . "
                  ON " . OWNER_PERSON_TABLE . ".personID = " . PERSON_TABLE . ".personID

                  LEFT JOIN " . LOCATIONADDRESS_TABLE . "
                  ON " . LOCATION_TABLE . ".locationAddressID=" . LOCATIONADDRESS_TABLE . ".locationAddressID

                  LEFT JOIN " . BARANGAY_TABLE . "
                  ON " . BARANGAY_TABLE . ".barangayID=" . LOCATIONADDRESS_TABLE . ".barangayID 

				  LEFT JOIN " . DISTRICT_TABLE . "
				  ON " . DISTRICT_TABLE . ".districtID=" . LOCATIONADDRESS_TABLE . ".district 
				  LEFT JOIN " . MUNICIPALITYCITY_TABLE . "
				  ON " . MUNICIPALITYCITY_TABLE . ".municipalityCityID=" . LOCATIONADDRESS_TABLE . ".municipalityCity 
				  LEFT JOIN " . PROVINCE_TABLE . "
				  ON " . PROVINCE_TABLE . ".provinceID=" . LOCATIONADDRESS_TABLE . ".province";

        $sql = $sql . $condition . ") " . $limit;

		$this->setDB();

		//$dummySQL = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		//$this->db->query($dummySQL);

		$this->db->query($sql);
		while ($this->db->next_record()) {
			$od = new OD;
			$od->selectRecord($this->db->f("odID"));
			$this->arrayList[] = $od;
		}
		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
	}
	
	function countRecords($condition=""){

		//$sql = sprintf("select count(*) as count from %s %s;",
		//		OD_TABLE, $condition);

		$sql = "SELECT distinct (" . OD_TABLE . ".odID) as odID
				  , CONCAT(".PERSON_TABLE.".lastName,".PERSON_TABLE.".firstName,".PERSON_TABLE.".middleName) as PersonFullName
				  FROM " . OD_TABLE . "
				  LEFT JOIN " . LOCATION_TABLE . "
				  ON " . OD_TABLE . ".odID = " . LOCATION_TABLE . ".odID
				  LEFT JOIN " . OWNER_TABLE . "
				  ON " . LOCATION_TABLE . ".odID = " . OWNER_TABLE . ".odID
                  LEFT JOIN " . OWNER_COMPANY_TABLE . "
                  ON " . OWNER_TABLE . ".ownerID = " . OWNER_COMPANY_TABLE . ".ownerID
                  LEFT JOIN " . COMPANY_TABLE . "
                  ON " . OWNER_COMPANY_TABLE . ".companyID = " . COMPANY_TABLE . ".companyID
                  LEFT JOIN " . OWNER_PERSON_TABLE . "
                  ON " . OWNER_TABLE . ".ownerID = " . OWNER_PERSON_TABLE . ".ownerID
                  LEFT JOIN " . PERSON_TABLE . "
                  ON " . OWNER_PERSON_TABLE . ".personID = " . PERSON_TABLE . ".personID

                  LEFT JOIN " . LOCATIONADDRESS_TABLE . "
                  ON " . LOCATION_TABLE . ".locationAddressID=" . LOCATIONADDRESS_TABLE . ".locationAddressID

                  LEFT JOIN " . BARANGAY_TABLE . "
                  ON " . BARANGAY_TABLE . ".barangayID=" . LOCATIONADDRESS_TABLE . ".barangayID 

				  LEFT JOIN " . DISTRICT_TABLE . "
				  ON " . DISTRICT_TABLE . ".districtID=" . LOCATIONADDRESS_TABLE . ".district 
				  LEFT JOIN " . MUNICIPALITYCITY_TABLE . "
				  ON " . MUNICIPALITYCITY_TABLE . ".municipalityCityID=" . LOCATIONADDRESS_TABLE . ".municipalityCity 
				  LEFT JOIN " . PROVINCE_TABLE . "
				  ON " . PROVINCE_TABLE . ".provinceID=" . LOCATIONADDRESS_TABLE . ".province";

		$sql = $sql . $condition;

		$this->setDB();

		//$dummySQL = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		//$this->db->query($dummySQL);

		$this->db->query($sql);
		if($this->db->next_record()){
			$ret = $this->db->nf();
		}
		else{
			$ret = false;
		}
		return $ret;
	}
	
	function countSearchRecords($searchKey,$fields,$limit=""){
		if($limit!=""){
			$limit = str_replace("WHERE", "and", $limit);
		}

		$condition = " where (";
		foreach($fields as $key => $value){
			if($key == 0) $condition = $condition.$value." like '%".$searchKey."%'";
			else $condition = $condition." or ".$value." like '%".$searchKey."%' ";
		}

		// October 07, 2005
		$condition = $this->getFullNameSearchCondition($condition,$searchKey);

        $sql = "SELECT distinct (" . OD_TABLE . ".odID) as odID
				  , CONCAT(".PERSON_TABLE.".lastName,".PERSON_TABLE.".firstName,".PERSON_TABLE.".middleName) as PersonFullName
				  FROM " . OD_TABLE . "
				  LEFT JOIN " . LOCATION_TABLE . "
				  ON " . OD_TABLE . ".odID = " . LOCATION_TABLE . ".odID
				  LEFT JOIN " . OWNER_TABLE . "
				  ON " . LOCATION_TABLE . ".odID = " . OWNER_TABLE . ".odID
                  LEFT JOIN " . OWNER_COMPANY_TABLE . "
                  ON " . OWNER_TABLE . ".ownerID = " . OWNER_COMPANY_TABLE . ".ownerID
                  LEFT JOIN " . COMPANY_TABLE . "
                  ON " . OWNER_COMPANY_TABLE . ".companyID = " . COMPANY_TABLE . ".companyID
                  LEFT JOIN " . OWNER_PERSON_TABLE . "
                  ON " . OWNER_TABLE . ".ownerID = " . OWNER_PERSON_TABLE . ".ownerID
                  LEFT JOIN " . PERSON_TABLE . "
                  ON " . OWNER_PERSON_TABLE . ".personID = " . PERSON_TABLE . ".personID

                  LEFT JOIN " . LOCATIONADDRESS_TABLE . "
                  ON " . LOCATION_TABLE . ".locationAddressID=" . LOCATIONADDRESS_TABLE . ".locationAddressID

                  LEFT JOIN " . BARANGAY_TABLE . "
                  ON " . BARANGAY_TABLE . ".barangayID=" . LOCATIONADDRESS_TABLE . ".barangayID 

				  LEFT JOIN " . DISTRICT_TABLE . "
				  ON " . DISTRICT_TABLE . ".districtID=" . LOCATIONADDRESS_TABLE . ".district 
				  LEFT JOIN " . MUNICIPALITYCITY_TABLE . "
				  ON " . MUNICIPALITYCITY_TABLE . ".municipalityCityID=" . LOCATIONADDRESS_TABLE . ".municipalityCity 
				  LEFT JOIN " . PROVINCE_TABLE . "
				  ON " . PROVINCE_TABLE . ".provinceID=" . LOCATIONADDRESS_TABLE . ".province";

        $sql = $sql . $condition . ") " . $limit;

		$this->setDB();

		//$dummySQL = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		//$this->db->query($dummySQL);

		$this->db->query($sql);
		if($this->db->next_record()){
			$ret = $this->db->nf();
		}
		else{
			$ret = false;
		}
		return $ret;
	}

	function archiveRecords($odIDArray="",$archiveValue="",$userID=""){
		$od = new OD;
		$ret = false;
		foreach($odIDArray as $key => $odID){
			if($od->archiveRecord($odID,$archiveValue,$userID)){
				// archive AFS
				$afs = new AFS;
				if($afsID = $afs->checkAfsID($odID)){
					$afs->archiveRecord($afsID,$archiveValue,$userID);
				}
				// archive TD
				$td = new TD;
				if($tdID = $td->checkTdID($afsID)){
					$td->archiveRecord($tdID,$archiveValue,$userID);
				}
			}
			$ret = true;
		}
		return $ret;
	}
	
	function deleteRecords($odIDArray=""){
		$od = new OD;
		$rows = 0;
		foreach ($odIDArray as $key => $value){
			if ($od->deleteRecord($value)) $rows++;
		}
		return $rows;
	}
}
?>
