<?php
class ODHistoryRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function ODHistoryRecords(){
	
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
		$domList = $this->domDocument->create_element("ODHistoryList");
		$domList = $this->domDocument->append_child($domList);
		foreach($this->arrayList as $key => $value){
			//print_r($value);
			$domDocument = $value->getDomDocument();
			$this->appendToDomList($domList,$domDocument);
		}
		return true;
	}
	
	///*
	function parseDomDocument($domDoc){
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//if ($child->tagname=="ODHistory") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$odHistory = new ODHistory;
					$odHistory->parseDomDocument($tempDomDoc);
					$this->arrayList[] = $odHistory;
				}
				$child = $child->next_sibling();
			}
		}
		$this->setDomDocument();
		return true;
	}//*/
	
	function selectRecords($condition=""){
		$sql = sprintf("select * from %s %s;",
				ODHISTORY_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		//echo $sql;
		while ($this->db->next_record()) {
			$odHistory = new ODHistory;
			$odHistory->selectRecord($this->db->f("odHistoryID"));
			$this->arrayList[] = $odHistory;
		}
		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
	}
}
?>