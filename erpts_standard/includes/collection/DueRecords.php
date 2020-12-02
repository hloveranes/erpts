<?php
include_once "../web/prepend.php";
include_once "./Due.php";
class DueRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function DueRecords(){
	
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
		$domList = $this->domDocument->create_element("DueList");
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
				//if ($child->tagname=="Due") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$due = new Due;
					$due->parseDomDocument($tempDomDoc);
					$this->arrayList[] = $due;
				}
				$child = $child->next_sibling();
			}
		}
		$this->setDomDocument();
        //$this->setDomDocumentRecords();
		return true;
	}//*/

	function countRecords($condition=""){
		$sql = sprintf("select count(*) as count from %s %s",
				DUE_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}        	

    function selectRecords($tdID="",$taxableYear="",$condition=""){
    	if($tdID!=""){
    		$condition = "WHERE tdID='".$tdID."' AND dueDate LIKE '".$taxableYear."%'";
    	}
		$sql = sprintf("select * from %s %s;",
				DUE_TABLE, $condition);
		$this->setDB();

		$this->db->query($sql);
		while ($this->db->next_record()) {
			$due = new Due;
			$due->selectRecord($this->db->f("dueID"));
			$this->arrayList[] = $due;
			unset($due);
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
}
?>
