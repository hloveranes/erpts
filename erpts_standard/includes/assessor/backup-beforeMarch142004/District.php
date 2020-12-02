<?php
include_once "../web/prepend.php";
class District
{
	//attributes
	var $districtID;
	var $code;
	var $municipalityCityID;
	var $description;
	var $status;
	var $domDocument;
	var $db;
	
	//constructor
	function District() {
	
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	function setDistrictID($tempVar) {
		$this->districtID = $tempVar;
	}
	function setCode($tempVar) {
		$this->code = $tempVar;
	}
	function setMunicipalityCityID($tempVar){
	    $this->municipalityCityID = $tempVar;
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
		$rec = $this->domDocument->create_element("District");
		$rec = $this->domDocument->append_child($rec);
		//$rec->set_attribute("districtID",$this->districtID);
		$this->setDocNode("districtID",$this->districtID,$this->domDocument,$rec);
		$this->setDocNode("code",$this->code,$this->domDocument,$rec);
		$this->setDocNode("municipalityCityID",$this->municipalityCityID,$this->domDocument,$rec);
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
	function getDistrictID() {
		return $this->districtID;
	}
	function getCode() {
		return $this->code;
	}
	function getMunicipalityCityID(){
	    return $this->municipalityCityID;
	}
	function getDescription() {
		return $this->description;
	}
	function getStatus() {
		return $this->status;
	}

	//DB
	function selectRecord($districtID){
		if ($districtID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE districtID=%s;",
			DISTRICT_TABLE, $districtID);
			$this->db->query($sql);
		$district = new District;
		if ($this->db->next_record()) {
		
			//*
			$this->districtID = $this->db->f("districtID");
			$this->code = $this->db->f("code");
			$this->municipalityCityID = $this->db->f("municipalityCityID");
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
			", municipalityCityID".
			", description".
			", status".
			") ".
			"values ('%s', '%s', '%s', '%s');"
			, DISTRICT_TABLE
			, fixQuotes($this->code)
			, fixQuotes($this->municipalityCityID)
			, fixQuotes($this->description)
			, fixQuotes($this->status)
		);
	
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$districtID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $districtID;
		}
		
		//echo $sql;
		return $ret;
	}
	
	function deleteRecord($districtID){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($districtID);
		$sql = sprintf("delete from %s where districtID=%s;",
			DISTRICT_TABLE, $districtID);
		$this->db->query($sql);
		$districtRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $districtRows;
		}
		return $ret;
	}
	
	function updateRecord(){
		
		$sql = sprintf("update %s set".
			" code = '%s'".
			", municipalityCityID = '%s'".
			", description = '%s'".
			", status = '%s'".
			" where districtID = '%s';",
			DISTRICT_TABLE
			, fixQuotes($this->code)
			, fixQuotes($this->municipalityCityID)
			, fixQuotes($this->description)
			, fixQuotes($this->status)
			, $this->districtID
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
			$ret = $this->districtID;
		}
		return $ret;
	}
	
}

/*
$district = new District;
$district->selectRecord(1);
echo $district->getMunicipalityCityID();
echo $district->getDistrictID();
//*/
?>
