<?php
include_once "../web/prepend.php";
include_once "./Collection.php";
class CollectionRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function CollectionRecords(){
	
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
		$domList = $this->domDocument->create_element("CollectionList");
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
					$collection = new Collection;
					$collection->parseDomDocument($tempDomDoc);
					$this->arrayList[] = $collection;
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
				COLLECTION_TABLE, $condition);

		echo $sql;
		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}        	

    function selectRecords($condition=""){
		$sql = sprintf("select * from %s %s;",
				COLLECTION_TABLE, $condition);

		$this->setDB();

		$this->db->query($sql);
		while ($this->db->next_record()) {
			$collection = new Collection;
			$collection->selectRecord($this->db->f("collectionID"));
			$this->arrayList[] = $collection;
			unset($collection);
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

	function selectRecordsFromDueTaxType($dueID,$backtaxTDID,$dueType,$taxType,$status=""){
		$sql = sprintf("SELECT ".COLLECTION_TABLE.".collectionID as collectionID FROM %s, %s WHERE"
			." ".PAYMENT_TABLE.".paymentID = ".COLLECTION_TABLE.".paymentID"
			." AND"
			." ("
			." ".PAYMENT_TABLE.".dueID='%s'"
			." AND"
			." ".PAYMENT_TABLE.".backtaxTDID='%s'"
			.")"
			." AND"
			." ".PAYMENT_TABLE.".dueType='%s'"
			." AND"
			." ".COLLECTION_TABLE.".taxType='%s'"
			." AND"
			." ".COLLECTION_TABLE.".status='%s'"
			." AND"
			." ".PAYMENT_TABLE.".status='%s'"
			, COLLECTION_TABLE
			, PAYMENT_TABLE
			, $dueID
			, $backtaxTDID
			, $dueType
			, $taxType
			, $status
			, $status
		);

		$this->setDB();

		$this->db->query($sql);
		while ($this->db->next_record()) {
			$collection = new Collection;
			$collection->selectRecord($this->db->f("collectionID"));
			$this->arrayList[] = $collection;
			unset($collection);
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
