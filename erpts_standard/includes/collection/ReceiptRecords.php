<?php
include_once "../web/prepend.php";
include_once "./Receipt.php";
class ReceiptRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function ReceiptRecords(){
	
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
		$domList = $this->domDocument->create_element("ReceiptList");
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
					$receipt = new Receipt;
					$receipt->parseDomDocument($tempDomDoc);
					$this->arrayList[] = $receipt;
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
				RECEIPT_TABLE, $condition);

		//echo $sql;
		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}        	

    function selectRecords($condition=""){
		$sql = sprintf("select * from %s %s;",
				RECEIPT_TABLE, $condition);
		$this->setDB();

		$this->db->query($sql);
		while ($this->db->next_record()) {
			$receipt = new Receipt;
			$receipt->selectRecord($this->db->f("receiptID"));
			$this->arrayList[] = $receipt;
			unset($receipt);
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

	function searchRecords($searchKey,$fields,$limit){
		$condition = "where (";
		foreach($fields as $key => $value){
			if($key == 0) $condition = $condition.$value." like '%".$searchKey."%'";
			else $condition = $condition."or ".$value." like '%".$searchKey."%' ";
		}

		if(!strstr(strtoupper($limit), 'ORDER')){
			$sql = sprintf("select * from %s %s;",RECEIPT_TABLE, $condition.") and status != 'cancelled' ORDER BY receiptID DESC ".$limit);
		}
		else{
			$limit = str_replace("WHERE","and",$limit);
			$sql = sprintf("select * from %s %s;",RECEIPT_TABLE, $condition.") ".$limit);
		}		

		//echo $sql;

		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$receipt = new Receipt;
			$receipt->selectRecord($this->db->f("receiptID"));
			$this->arrayList[] = $receipt;
		}
		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
	}

	function countSearchRecords($searchKey,$fields){
		$condition = "where (";
		foreach($fields as $key => $value){
			if($key == 0) $condition = $condition.$value." like '%".$searchKey."%'";
			else $condition = $condition."or ".$value." like '%".$searchKey."%' ";
		}
		
		$sql = sprintf("select count(*) as count from %s %s;",
				RECEIPT_TABLE, $condition.") and status != 'cancelled' ".$limit);
 		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}

}
?>
