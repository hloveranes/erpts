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
	
	function selectRecords($condition=""){
        $sql = "SELECT " . OD_TABLE . ".odID as odID
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
                  ON " . BARANGAY_TABLE . ".barangayID=" . LOCATIONADDRESS_TABLE . ".barangayID ";

		$sql = $sql . $condition;

		$this->setDB();
		$this->db->query($sql);

		while ($this->db->next_record()) {
			$tmpArray[] = $this->db->f("odID");
		}
		$idArray = array_unique($tmpArray);

		foreach($idArray as $key => $odID){
			$od = new OD;
			$od->selectRecord($odID);
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
	
	function searchRecords($searchKey,$fields,$limit=""){
		$condition = "where (";
		
		foreach($fields as $key => $value){
			if($key == 0) $condition = $condition.$value." like '%".$searchKey."%'";
			else $condition = $condition." or ".$value." like '%".$searchKey."%' ";
		}
		
        $sql = "SELECT " . OD_TABLE . ".odID as odID
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
                  ON " . BARANGAY_TABLE . ".barangayID=" . LOCATIONADDRESS_TABLE . ".barangayID ";
        $sql = $sql . $condition . ") " . $limit;
        
		$this->setDB();
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
		$sql = sprintf("select count(*) as count from %s %s;",
				OD_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}
	
	function countSearchRecords($searchKey,$fields){
		$condition = "where (";
		foreach($fields as $key => $value){
			if($key == 0) $condition = $condition.$value." like '%".$searchKey."%'";
			else $condition = $condition." or ".$value." like '%".$searchKey."%' ";
		}
		
        $sql = "SELECT COUNT(" . LOCATION_TABLE . ".odID) as count

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
				  
				  FROM " . LOCATION_TABLE . "
                  LEFT JOIN " . LOCATIONADDRESS_TABLE . "
                  ON " . LOCATION_TABLE . ".locationAddressID=" . LOCATIONADDRESS_TABLE . ".locationAddressID
                  LEFT JOIN " . BARANGAY_TABLE . "
                  ON " . BARANGAY_TABLE . ".barangayID=" . LOCATIONADDRESS_TABLE . ".barangayID ";
        $sql = $sql . $condition . ")";
		
		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
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
