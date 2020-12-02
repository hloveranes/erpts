<?php

class LandClasses
{
	//attributes
	var $landClassesID;
	var $code;
	var $description;
	var $value;
	var $status;
	var $domDocument;
	var $db;
	
	//constructor
	function LandClasses() {
	
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	function setLandClassesID($tempVar) {
		$this->landClassesID = $tempVar;
	}
	function setCode($tempVar) {
		$this->code = $tempVar;
	}
	function setDescription($tempVar) {
		$this->description = $tempVar;
	}
	function setValue($tempVar) {
		$this->value = $tempVar;
	}	
	function setStatus($tempVar) {
		$this->status = $tempVar;
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
		$rec = $this->domDocument->create_element("LandClasses");
		$rec = $this->domDocument->append_child($rec);
		//$rec->set_attribute("landClassesID",$this->landClassesID);
		$this->setDocNode("landClassesID",$this->landClassesID,$this->domDocument,$rec);
		$this->setDocNode("code",$this->code,$this->domDocument,$rec);
		$this->setDocNode("description",$this->description,$this->domDocument,$rec);
		$this->setDocNode("value",$this->value,$this->domDocument,$rec);
		$this->setDocNode("status",$this->status,$this->domDocument,$rec);
	}
	function parseDomDocument($domDoc){
		$ret = true;
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//eval("\$this->".$child->tagname." = \"".$child->get_content()."\";");
				//eval("\$this->set".ucfirst($child->tagname)."(\"".$child->get_content()."\");");

				// test varvars
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
	function getLandClassesID() {
		return $this->landClassesID;
	}
	function getCode() {
		return $this->code;
	}
	function getDescription() {
		return $this->description;
	}
	function getValue() {
		return $this->value;
	}	
	function getStatus() {
		return $this->status;
	}

	//DB
	function selectRecord($landClassesID){
		if ($landClassesID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE landClassesID=%s;",
			LANDCLASSES_TABLE, $landClassesID);
			$this->db->query($sql);
		$landClasses = new LandClasses;
		if ($this->db->next_record()) {
			//*
			$this->landClassesID = $this->db->f("landClassesID");
			$this->code = $this->db->f("code");
			$this->description = $this->db->f("description");
			$this->value = $this->db->f("value");	
			$this->status = $this->db->f("status");
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
			"code".
			", description".
			", value".
			", status".
			") ".
			"values ('%s', '%s', %s, '%s');"
			, LANDCLASSES_TABLE
			, fixQuotes($this->code)
			, fixQuotes($this->description)
		    , fixQuotes($this->value)	
			, fixQuotes($this->status)
		);
	
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$landClassesID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $landClassesID;
		}
		
		//echo $sql;
		return $ret;
	}
	
	function deleteRecord($landClassesID){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($landClassesID);
		$sql = sprintf("delete from %s where landClassesID=%s;",
			LANDCLASSES_TABLE, $landClassesID);
		$this->db->query($sql);
		$landClassesRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $landClassesRows;
		}
		return $ret;
	}
	
	function updateRecord(){
		
		$sql = sprintf("update %s set".
			" code = '%s'".
			", description = '%s'".
			", value = '%s'".
			", status = '%s'".
			" where landClassesID = '%s';",
			LANDCLASSES_TABLE
			, fixQuotes($this->code)
			, fixQuotes($this->description)
			, fixQuotes($this->value)
			, fixQuotes($this->status)
			, $this->landClassesID
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
			$ret = $this->landClassesID;
		}
		return $ret;
	}
	
}
?>
