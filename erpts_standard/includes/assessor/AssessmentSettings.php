<?php

include_once "../web/prepend.php";

class AssessmentSettings
{
	//attributes

	var $autoCalculate; // boolean

	var $domDocument;
	var $db;
	
	//constructor
	function TreasurySettings() {
	
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}

	function setAutoCalculate($tempVar){
		$this->autoCalculate = $tempVar;
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
		$rec = $this->domDocument->create_element("TreasurySettings");
		$rec = $this->domDocument->append_child($rec);

		$this->setDocNode("autoCalculate",$this->autoCalculate,$this->domDocument,$rec);
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

	function getAutoCalculate(){
		return $this->autoCalculate;
	}

	//DB

	function tableExists(){
		$this->setDB();
		$tablesArray = $this->db->table_names();
		foreach($tablesArray as $key=>$table){
			if($table["table_name"]==ASSESSMENT_SETTINGS_TABLE){
				return true;
			}
		}
		return false;
	}

	function createTable(){
		if($this->tableExists()){
			return false;
		}

		$sql = sprintf("CREATE TABLE %s (".
			"autoCalculate varchar(32) NOT NULL default ''".
			");",
			ASSESSMENT_SETTINGS_TABLE);

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
			$ret = true;
		}
		return $ret;
	}

	function countRecord(){
		$this->setDB();
		$sql = sprintf("SELECT COUNT(*) as count FROM %s;",
			ASSESSMENT_SETTINGS_TABLE);

		$this->db->query($sql);

		if ($this->db->next_record()) {
			$ret = $this->db->f("count");
		}
		else $ret = false;
		return $ret;
	}

	function selectRecord(){
		$this->setDB();
		$sql = sprintf("SELECT * FROM %s;",
			ASSESSMENT_SETTINGS_TABLE);

		$this->db->query($sql);

		if ($this->db->next_record()) {
			//*

			$this->autoCalculate = $this->db->f("autoCalculate");

			//*/
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
			"autoCalculate".
			") ".
			"values ('%s');"
			, ASSESSMENT_SETTINGS_TABLE
			, fixQuotes($this->autoCalculate)
		);

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
			$ret = true;
		}
		return $ret;
	}
	
	function deleteRecord(){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord();
		$sql = sprintf("delete from %s;",
			ASSESSMENT_SETTINGS_TABLE);
		$this->db->query($sql);
		$affectedRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $affectedRows;
		}
		return $ret;
	}
	
	function updateRecord(){
		$sql = sprintf("update %s set".
			" autoCalculate = '%s'".
			";",
			ASSESSMENT_SETTINGS_TABLE
			, fixQuotes($this->autoCalculate)
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
			$ret = true;
		}
		return $ret;
	}
	
}
?>
