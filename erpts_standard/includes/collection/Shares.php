<?php

include_once "../web/prepend.php";

class Shares
{
	//attributes

	var $provincialCityShare;
	var $municipalShare;
	var $barangayShare;

	var $domDocument;
	var $db;
	
	//constructor
	function Shares() {
	
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}

	function setProvincialCityShare($tempVar){
		$this->provincialCityShare = $tempVar;
	}
	function setMunicipalShare($tempVar){
		$this->municipalShare = $tempVar;
	}
	function setBarangayShare($tempVar){
		$this->barangayShare = $tempVar;
	}

	//DOM
	function setDocNode($elementName,$elementValue,$domDoc,$indexNode){
		$nodeName = "";
		$nodeText = "";
		$nodeName = $domDoc->create_element($elementName);
		$nodeName = $indexNode->append_child($nodeName);

		$trans = get_html_translation_table(HTML_ENTITIES);
		$elementValue = strtr(htmlentities($elementValue), $trans);
		$nodeText = $domDoc->create_text_node($elementValue);

		//$nodeText = $domDoc->create_text_node(htmlentities($elementValue));
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
		$rec = $this->domDocument->create_element("Shares");
		$rec = $this->domDocument->append_child($rec);

		$this->setDocNode("provincialCityShare",$this->provincialCityShare,$this->domDocument,$rec);
		$this->setDocNode("municipalShare",$this->municipalShare,$this->domDocument,$rec);
		$this->setDocNode("barangayShare",$this->barangayShare,$this->domDocument,$rec);
	}
	function parseDomDocument($domDoc){
		$ret = true;
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				$varvar = $child->tagname;

				$trans = array_flip(get_html_translation_table(HTML_ENTITIES));
				$childContent = strtr(html_entity_decode($child->get_content()), $trans);

				$this->$varvar = html_entity_decode($childContent);

				//$this->$varvar = html_entity_decode($child->get_content());

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

	function getProvincialCityShare(){
		return $this->provincialCityShare;
	}
	function getMunicipalShare(){
		return $this->municipalShare;
	}
	function getBarangayShare(){
		return $this->barangayShare;
	}

	//DB

	function tableExists(){
		$this->setDB();
		$tablesArray = $this->db->table_names();
		foreach($tablesArray as $key=>$table){
			if($table["table_name"]==SHARES_TABLE){
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
			"provincialCityShare double NOT NULL default '0',".
			"municipalShare double NOT NULL default '0',".
			"barangayShare double NOT NULL default '0'".
			");",
			SHARES_TABLE);

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
			SHARES_TABLE);

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
			SHARES_TABLE);

		$this->db->query($sql);

		if ($this->db->next_record()) {
			//*

			$this->provincialCityShare = $this->db->f("provincialCityShare");
			$this->municipalShare = $this->db->f("municipalShare");
			$this->barangayShare = $this->db->f("barangayShare");

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
			"provincialCityShare".
			", municipalShare".
			", barangayShare".
			") ".
			"values ('%s', '%s', '%s');"
			, SHARES_TABLE
			, fixQuotes($this->provincialCityShare)
			, fixQuotes($this->municipalShare)
			, fixQuotes($this->barangayShare)
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
			SHARES_TABLE);
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
			" provincialCityShare = '%s'".
			", municipalShare = '%s'".
			", barangayShare = '%s'".
			";",
			SHARES_TABLE
			, fixQuotes($this->provincialCityShare)
			, fixQuotes($this->municipalShare)
			, fixQuotes($this->barangayShare)
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
