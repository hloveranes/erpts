<?php

class MachineriesDepreciation
{
	//attributes
	var $machineriesDepreciationID;
	var $code;
	var $reportCode;
	var $description;
	var $value;
	var $status;
	var $domDocument;
	var $db;
	
	//constructor
	function MachineriesDepreciation() {
	
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	function setMachineriesDepreciationID($tempVar) {
		$this->machineriesDepreciationID = $tempVar;
	}
	function setCode($tempVar) {
		$this->code = $tempVar;
	}
	function setReportCode($tempVar) {
		$this->reportCode = $tempVar;
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
	function setDocNode ($elementName,$elementValue,$domDoc,$indexNode){
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
		$rec = $this->domDocument->create_element("MachineriesDepreciation");
		$rec = $this->domDocument->append_child($rec);
		//$rec->set_attribute("machineriesDepreciationID",$this->machineriesDepreciationID);
		$this->setDocNode("machineriesDepreciationID",$this->machineriesDepreciationID,$this->domDocument,$rec);
		$this->setDocNode("code",$this->code,$this->domDocument,$rec);
		$this->setDocNode("reportCode",$this->reportCode,$this->domDocument,$rec);
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
	function getMachineriesDepreciationID() {
		return $this->machineriesDepreciationID;
	}
	function getCode() {
		return $this->code;
	}
	function getReportCode() {
		return $this->reportCode;
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
	function selectRecord($machineriesDepreciationID){
		if ($machineriesDepreciationID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE machineriesDepreciationID=%s;",
			MACHINERIES_DEPRECIATION_TABLE, $machineriesDepreciationID);
			$this->db->query($sql);
		$machineriesDepreciation = new MachineriesDepreciation;
		if ($this->db->next_record()) {
			//*
			$this->machineriesDepreciationID = $this->db->f("machineriesDepreciationID");
			$this->code = $this->db->f("code");
			$this->reportCode = $this->db->f("reportCode");
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
			", reportCode".
			", description".
			", value".
			", status".
			") ".
			"values ('%s', '%s', '%s', '%s', '%s');"
			, MACHINERIES_DEPRECIATION_TABLE
			, fixQuotes($this->code)
			, fixQuotes($this->reportCode)
			, fixQuotes($this->description)
		    , fixQuotes($this->value)	
			, fixQuotes($this->status)
		);
	
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$machineriesDepreciationID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $machineriesDepreciationID;
		}
		
		//echo $sql;
		return $ret;
	}
	
	function deleteRecord($machineriesDepreciationID){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($machineriesDepreciationID);
		$sql = sprintf("delete from %s where machineriesDepreciationID=%s;",
			MACHINERIES_DEPRECIATION_TABLE, $machineriesDepreciationID);
		$this->db->query($sql);
		$machineriesDepreciationRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $machineriesDepreciationRows;
		}
		return $ret;
	}
	
	function updateRecord(){
		
		$sql = sprintf("update %s set".
			" code = '%s'".
			", reportCode = '%s'".
			", description = '%s'".
			", value = '%s'".
			", status = '%s'".
			" where machineriesDepreciationID = '%s';",
			MACHINERIES_DEPRECIATION_TABLE
			, fixQuotes($this->code)
			, fixQuotes($this->reportCode)
			, fixQuotes($this->description)
			, fixQuotes($this->value)
			, fixQuotes($this->status)
			, $this->machineriesDepreciationID
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
			$ret = $this->machineriesDepreciationID;
		}
		return $ret;
	}
	
}
?>
