<?php

include_once "../web/prepend.php";

class ODHistory
{
	//attributes

	var $odHistoryID;
	var $presentODID;
	var $previousODID;
	var $transactionCode;

	var $domDocument;
	var $db;
	
	//constructor
	function ODHistory() {
	
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}

	function setODHistoryID($tempVar){
		$this->odHistoryID = $tempVar;
	}
	function setPresentODID($tempVar){
		$this->presentODID = $tempVar;
	}
	function setPreviousODID($tempVar){
		$this->previousODID = $tempVar;
	}
	function setTransactionCode($tempVar){
		$this->transactionCode = $tempVar;
	}

	//DOM
	function setDocNode($elementName,$elementValue,$domDoc,$indexNode){
		$nodeName = "";
		$nodeText = "";
		$nodeName = $domDoc->create_element($elementName);
		$nodeName = $indexNode->append_child($nodeName);
		$nodeText = $domDoc->create_text_node(htmlentities($elementValue));
		$nodeText = $nodeName->append_child($nodeText);
	}
	function setArrayDocNode($elementName,$arrayList,$indexNode){
		$list = $this->domDocument->create_element($elementName);
		$list = $indexNode->append_child($list);
		if (is_array($arrayList)){
			foreach ($arrayList as $key => $value){
                $domTmp = $value->getDomDocument();
				//$list->append_child($domTmp->document_element());

				// test clone_node()
				$nodeTmp = $domTmp->document_element();
				$nodeClone = $nodeTmp->clone_node(true);
				$list->append_child($nodeClone);
			}
		}
	}
	function setObjectDocNode($elementName,$elementObject,$domDoc,$indexNode){
		$nodeName = "";
		$nodeDomDoc = $elementObject->getDomDocument();
		$nodeObject = $nodeDomDoc->document_element();

		$nodeClone = $nodeObject->clone_node(true);
			
		$nodeName = $domDoc->create_element($elementName);
		$nodeName = $indexNode->append_child($nodeName);
		$nodeObject = $nodeName->append_child($nodeClone);
	}
	function setDomDocument() {
		$this->domDocument = domxml_new_doc("1.0");
		$rec = $this->domDocument->create_element("ODHistory");
		$rec = $this->domDocument->append_child($rec);

		$this->setDocNode("odHistoryID",$this->odHistoryID,$this->domDocument,$rec);
		$this->setDocNode("presentODID",$this->presentODID,$this->domDocument,$rec);
		$this->setDocNode("previousODID",$this->previousODID,$this->domDocument,$rec);
		$this->setDocNode("transactionCode",$this->transactionCode,$this->domDocument,$rec);
	}
	function parseDomDocument($domDoc){
		$ret = true;
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				$varvar = $child->tagname;
				$this->$varvar = html_entity_decode($child->get_content());

				$child = $child->next_sibling();
			}
		}
		$this->setDomDocument();
		return $ret;
	}
	function getDomDocument() {
		return $this->domDocument;
	}
	
	//get
	function getODHistoryID(){
		return $this->odHistoryID;
	}
	function getPresentODID(){
		return $this->presentODID;
	}
	function getPreviousODID(){
		return $this->previousODID;
	}
	function getTransactionCode(){
		return $this->transactionCode;
	}

	//DB
	function selectRecord($odHistoryID=1){
		if ($odHistoryID==""){
			return;
		}

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE odHistoryID=%s;",
			ODHISTORY_TABLE, $odHistoryID);

		$this->db->query($sql);

		if ($this->db->next_record()) {
			$this->odHistoryID = $this->db->f("odHistoryID");
			$this->presentODID = $this->db->f("presentODID");
			$this->previousODID = $this->db->f("previousODID");
			$this->transactionCode = $this->db->f("transactionCode");

			foreach ($this->db->Record as $key => $value){
				$this->$key = $value;
			}
			$this->setDomDocument();
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}
	
	function insertRecord(){
		$sql = sprintf("insert into %s (".
			"presentODID".
			", previousODID".
			", transactionCode".
			") ".
			"values ('%s', '%s', '%s');"
			, ODHISTORY_TABLE
			, fixQuotes($this->presentODID)
			, fixQuotes($this->previousODID)
			, fixQuotes($this->transactionCode)
		);
		
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$odHistoryID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $odHistoryID;
		}
		return $ret;
	}
	
	function deleteRecord($odHistoryID){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($odHistoryID);
		$sql = sprintf("delete from %s where odHistoryID=%s;",
			ODHISTORY_TABLE, $odHistoryID);
		$this->db->query($sql);
		$odHistoryRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $odHistory;
		}
		return $ret;
	}
	
	function updateRecord(){
		$sql = sprintf("update %s set".
			" presentODID = '%s'".
			", previousODID = '%s'".
			", transactionCode = '%s'".
			" where odHistoryID = '%s';",
			ODHISTORY_TABLE
			, fixQuotes($this->presentODID)
			, fixQuotes($this->previousODID)
			, fixQuotes($this->transactionCode)
			, $this->odHistoryID
		);
		//echo $sql;
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $this->eRPTSSettingsID;
		}
		return $ret;
	}
	
}
?>
