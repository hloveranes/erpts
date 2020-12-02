<?php
class PersonRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function PersonRecords(){
	
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
	
	//DOM
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
		$domList = $this->domDocument->create_element("PersonList");
		$domList = $this->domDocument->append_child($domList);
		if ($this->arrayList){
			foreach($this->arrayList as $key => $value){
				$domDoc = $value->getDomDocument();
				$this->appendToDomList($domList,$domDoc);
			}
		}
		else return false;
		return true;
	}
	function parseDomDocument($domDoc){
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//if ($child->tagname=="Person") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$person = new Person;
					$person->parseDomDocument($tempDomDoc);
					$this->arrayList[] = $person;
				}
				$child = $child->next_sibling();
			}
		}
		else return false;
		return $this->setDomDocument();
	}
	
	//db
	function selectRecords($condition=""){
		$sql = sprintf("select * from %s %s;",
				PERSON_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$person = new Person;
			$person->selectRecord($this->db->f("personID"));
			$this->arrayList[] = $person;
		}
		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
	}
	function searchRecords($searchKey,$fields,$limit){
		/*
		$condition = "where (";
		foreach($fields as $key => $value){
			if($key == 0) $condition = $condition.$value." like '%".$searchKey."%'";
			else $condition = $condition."or ".$value." like '%".$searchKey."%' ";
		}
		*/

		// November 22, 2005
		// commented out old $condition generator
		// use new search condition
		$condition = "where (".$this->getFullNameSearchCondition("",$searchKey)." ";
		
		$sql = sprintf("select * from %s %s;",
				PERSON_TABLE, $condition.") and personType = 'owner' ORDER BY lastName,firstName,middleName ASC ".$limit);
		//echo $sql;
		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$person = new Person;
			$person->selectRecord($this->db->f("personID"));
			$this->arrayList[] = $person;
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
				PERSON_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}
	
	function countSearchRecords($searchKey,$fields){
		/*
		$condition = "where (";
		foreach($fields as $key => $value){
			if($key == 0) $condition = $condition.$value." like '%".$searchKey."%'";
			else $condition = $condition."or ".$value." like '%".$searchKey."%' ";
		}
		*/

		// November 22, 2005
		// commented out old $condition generator
		// use new search condition
		$condition = "where (".$this->getFullNameSearchCondition("",$searchKey)." ";
		
		$sql = sprintf("select count(*) as count from %s %s;",
				PERSON_TABLE, $condition.") and personType = 'owner' ".$limit);
 		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}
	
	function deleteRecords($personIDArray=""){
		$person = new Person;
		$rows = 0;
		foreach ($personIDArray as $key => $value){
			if ($person->deleteRecord($value)) $rows++;
		}
		return $rows;
	}

	function getFullNameSearchCondition($condition,$searchKey){
		// November 22, 2005
		// return condition that searches by Person's FULL NAME (taken from ODRecords.php)

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
}
?>