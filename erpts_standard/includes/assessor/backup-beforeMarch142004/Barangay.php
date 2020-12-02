<?php

include_once "../web/prepend.php";

class Barangay
{
	//attributes
	var $barangayID;
	var $code;
	var $districtID;
	var $description;
	var $status;
	var $domDocument;
	var $db;
	
	//constructor
	function Barangay() {
	
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	function setBarangayID($tempVar) {
		$this->barangayID = $tempVar;
	}
	function setCode($tempVar) {
		$this->code = $tempVar;
	}
	function setDistrictID($tempVar){
	    $this->districtID = $tempVar;
	}
	function setDescription($tempVar) {
		$this->description = $tempVar;
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
		$rec = $this->domDocument->create_element("Barangay");
		$rec = $this->domDocument->append_child($rec);
		//$rec->set_attribute("barangayID",$this->barangayID);
		$this->setDocNode("barangayID",$this->barangayID,$this->domDocument,$rec);
		$this->setDocNode("code",$this->code,$this->domDocument,$rec);
		$this->setDocNode("districtID",$this->districtID,$this->domDocument,$rec);
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
	function getBarangayID() {
		return $this->barangayID;
	}
	function getCode() {
		return $this->code;
	}
	function getDistrictID() {
	    return $this->districtID;
	}
	function getDescription() {
		return $this->description;
	}
	function getStatus() {
		return $this->status;
	}

	//DB
	function selectRecord($barangayID){
		if ($barangayID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE barangayID=%s;",
			BARANGAY_TABLE, $barangayID);
			$this->db->query($sql);
		$barangay = new Barangay;
		if ($this->db->next_record()) {
			//*
			$this->barangayID = $this->db->f("barangayID");
			$this->code = $this->db->f("code");
			$this->districtID = $this->db->f("districtID");
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
			", districtID".
			", description".
			", status".
			") ".
			"values ('%s', '%s', '%s', '%s');"
			, BARANGAY_TABLE
			, fixQuotes($this->code)
			, fixQuotes($this->districtID)
			, fixQuotes($this->description)
			, fixQuotes($this->status)
		);
		
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$barangayID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $barangayID;
		}
		
		//echo $sql;
		return $ret;
	}
	
	function deleteRecord($barangayID){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($barangayID);
		$sql = sprintf("delete from %s where barangayID=%s;",
			BARANGAY_TABLE, $barangayID);
		$this->db->query($sql);
		$barangayRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $barangayRows;
		}
		return $ret;
	}
	
	function updateRecord(){
		
		$sql = sprintf("update %s set".
			" code = '%s'".
			", districtID = '%s'".
			", description = '%s'".
			", status = '%s'".
			" where barangayID = '%s';",
			BARANGAY_TABLE
			, fixQuotes($this->code)
			, fixQuotes($this->districtID)
			, fixQuotes($this->description)
			, fixQuotes($this->status)
			, $this->barangayID
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
			$ret = $this->barangayID;
		}
		return $ret;
	}
	
}

/*
$barangay = new Barangay;
$barangay->selectRecord(1);
echo $barangay->getDistrictID();
*/
?>
