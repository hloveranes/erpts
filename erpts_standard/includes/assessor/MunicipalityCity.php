<?php

include_once "../web/prepend.php";

class MunicipalityCity
{
	//attributes
	var $municipalityCityID;
	var $code;
	var $provinceID;
	var $description;
	var $status;
	var $domDocument;
	var $db;
	
	//constructor
	function MunicipalityCity() {
	
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	function setMunicipalityCityID($tempVar) {
		$this->municipalityCityID = $tempVar;
	}
	function setCode($tempVar) {
		$this->code = $tempVar;
	}
	function setProvinceID($tempVar) {
	    $this->provinceID = $tempVar;
	}
	function setDescription($tempVar) {
		$this->description = $tempVar;
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
		$rec = $this->domDocument->create_element("MunicipalityCity");
		$rec = $this->domDocument->append_child($rec);
		//$rec->set_attribute("municipalityCityID",$this->municipalityCityID);
		$this->setDocNode("municipalityCityID",$this->municipalityCityID,$this->domDocument,$rec);
		$this->setDocNode("code",$this->code,$this->domDocument,$rec);
		$this->setDocNode("provinceID",$this->provinceID,$this->domDocument,$rec);
		$this->setDocNode("description",$this->description,$this->domDocument,$rec);
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
	function getMunicipalityCityID() {
		return $this->municipalityCityID;
	}
	function getCode() {
		return $this->code;
	}
	function getProvinceID(){
	    return $this->provinceID;
	}
	function getDescription() {
		return $this->description;
	}
	function getStatus() {
		return $this->status;
	}

	//DB
	function selectRecord($municipalityCityID){
		if ($municipalityCityID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE municipalityCityID=%s;",
			MUNICIPALITYCITY_TABLE, $municipalityCityID);
			$this->db->query($sql);
		$municipalityCity = new MunicipalityCity;
		if ($this->db->next_record()) {
			//*
			$this->municipalityCityID = $this->db->f("municipalityCityID");
			$this->code = $this->db->f("code");
			$this->provinceID = $this->db->f("provinceID");
			$this->description = $this->db->f("description");
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
			", provinceID".
			", description".
			", status".
			") ".
			"values ('%s', '%s', '%s', '%s');"
			, MUNICIPALITYCITY_TABLE
			, fixQuotes($this->code)
			, fixQuotes($this->provinceID)
			, fixQuotes($this->description)
			, fixQuotes($this->status)
		);
	
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$municipalityCityID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $municipalityCityID;
		}
		
		//echo $sql;
		return $ret;
	}
	
	function deleteRecord($municipalityCityID){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($municipalityCityID);
		$sql = sprintf("delete from %s where municipalityCityID=%s;",
			MUNICIPALITYCITY_TABLE, $municipalityCityID);
		$this->db->query($sql);
		$municipalityCityRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $municipalityCityRows;
		}
		return $ret;
	}
	
	function updateRecord(){
		
		$sql = sprintf("update %s set".
			" code = '%s'".
			", provinceID = '%s'".
			", description = '%s'".
			", status = '%s'".
			" where municipalityCityID = '%s';",
			MUNICIPALITYCITY_TABLE
			, fixQuotes($this->code)
			, fixQuotes($this->provinceID)
			, fixQuotes($this->description)
			, fixQuotes($this->status)
			, $this->municipalityCityID
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
			$ret = $this->municipalityCityID;
		}
		return $ret;
	}
	
}
/*
$municipalityCity = new MunicipalityCity;
$municipalityCity->selectRecord(1);
echo $municipalityCity->getProvinceID();
echo "<br>";
echo $municipalityCity->getMunicipalityCityID();
$municipalityCity->setProvinceID(2);
echo "<br>";
echo $municipalityCity->getProvinceID();
$municipalityCity->updateRecord();
//*/
?>
