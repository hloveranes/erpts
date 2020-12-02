<?php
class OwnerRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function OwnerRecords(){
	
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
		$domList = $this->domDocument->create_element("ArrayList");
		$domList = $this->domDocument->append_child($domList);
		foreach($this->arrayList as $key => $value){
			$domOwner = $value->getDomDocument();
			$this->appendToDomList($domList,$domOwner);
		}
		return true;
	}
	
	///*
	function parseDomDocument($domDoc){
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//if ($child->tagname=="Owner") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$owner = new Owner;
					$owner->parseDomDocument($tempDomDoc);
					$this->setArrayList($owner);
				}
				$child = $child->next_sibling();
			}
		}
		$this->setDomDocument();
		return true;
	}//*/
	
	function selectRecord($ownerID){
		$sql = sprintf("select ownerID from %s where ownerID=%s",
				 OWNER_TABLE, $ownerID);
		$this->setDB();
		$this->db->query($sql);
		if ($this->db->next_record()) {
			$ownerID = $this->db->f("ownerID");
			$owner = new Owner;
			$owner->selectRecord($ownerID);
			$this->arrayList[] = $owner;
			$this->setDomDocument();
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}
	
	function selectRecords($condition=""){
		$sql = sprintf("select * from %s %s;",
				OWNER_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$owner = new Owner;
			$owner->selectRecord($this->db->f("ownerID"));
			$this->arrayList[] = $owner;
		}
		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			$ret = true;
		}
		else {
			$ret = false;
		}
		return $ret;
	}
	
	function deleteRecords($ownerIDArray=""){
		$owner = new Owner;
		$rows = 0;
		foreach ($ownerIDArray as $key => $value){
			if ($owner->deleteOwner($value)) $rows++;
		}
		return $rows;
	}
	
	function removeOwnerPersonRecords($ownerID, $personIDArray=""){
		$person = new Person;
		$rows = 0;
		if (count($personIDArray)){
			foreach ($personIDArray as $key => $value){
				if ($person->removeOwnerPerson($ownerID,$value)) $rows++;
			}
		}
		return $rows;
	}
	
	function removeOwnerCompanyRecords($ownerID, $companyIDArray=""){
		$rows = 0;
		if (count($companyIDArray)){
			foreach ($companyIDArray as $key => $value){
				$company = new Company;
				if ($company->removeOwnerCompany($ownerID,$value)) $rows++;
			}
		}
		return $rows;
	}	
}
?>