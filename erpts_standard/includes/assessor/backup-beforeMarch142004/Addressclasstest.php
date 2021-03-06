<?php
//include files

class Address
{
	//attributes
	var $addressID;
	var $number;
	var $street;
	var $barangay;
	var $district;
	var $municipalityCity;	
	var $province;
	var $domDocument;
	var $db;
	
	//constructor
	function Address() {
	}
	
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	function setAddressID($tempVar) {
		$this->addressID = $tempVar;
	}
	
	function setNumber($tempVar) {
		$this->number = $tempVar;
	}
	
	function setStreet($tempVar) {
		$this->street = $tempVar;
	}
	
	function setBarangay($tempVar) {
		$this->barangay = $tempVar;
	}
	
	function setDistrict($tempVar) {
		$this->district = $tempVar;
	}
	
	function setMunicipalityCity($tempVar) {
		$this->municipalityCity = $tempVar;
	}
	
	function setProvince($tempVar) {
		$this->province = $tempVar;
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
	function setDomDocument() {
		$this->domDocument = domxml_new_doc("1.0");
		$rec = $this->domDocument->create_element("address");
		$rec = $this->domDocument->append_child($rec);
		//$rec->set_attribute("addressID",$this->addressID);
		$this->setDocNode("addressID",$this->addressID,$this->domDocument,$rec);
		$this->setDocNode("number",$this->number,$this->domDocument,$rec);
		$this->setDocNode("street",$this->street,$this->domDocument,$rec);
		$this->setDocNode("barangay",$this->barangay,$this->domDocument,$rec);
		$this->setDocNode("district",$this->district,$this->domDocument,$rec);
		$this->setDocNode("municipalityCity",$this->municipalityCity,$this->domDocument,$rec);
		$this->setDocNode("province",$this->province,$this->domDocument,$rec);
	}
	function parseDomDocument($domDoc){
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//eval("\$this->".$child->tagname." = \"".$child->get_content()."\";");

				// test varvars
				$varvar = $child->tagname;
				$this->$varvar = html_entity_decode($child->get_content());

				$child = $child->next_sibling();
			}
		}
		$this->setDomDocument();
	}
	function getDomDocument(){
		return $this->domDocument;
	}
		
	//get
	function getAddressID() {
		return $this->addressID;
	}
	function getNumber() {
		return $this->number;
	}
	function getStreet() {
		return $this->street;
	}
	function getBarangay() {
		return $this->barangay;
	}
	function getDistrict() {
		return $this->district;
	}
	function getMunicipalityCity() {
		return $this->municipalityCity;
	}
	function getProvince() {		
		return $this->province;
	}
	function getFullAddress(){
		return $this->number
		.putPreComma($this->street)
		.putPreComma($this->barangay)
		.putPreComma($this->district)
		.putPreComma($this->municipalityCity)
		.putPreComma($this->province);
	}
	//DB
	function insertRecord(){
		$sql = sprintf("insert into %s (number".
			", street".
			", barangay".
			", district".
			", municipalityCity".
			", province".
			")".
			" values ('%s', '%s', '%s', '%s', '%s', '%s');"
			, ADDRESS_TABLE
			, fixQuotes($this->number)
			, fixQuotes($this->street)
			, fixQuotes($this->barangay)
			, fixQuotes($this->district)
			, fixQuotes($this->municipalityCity)
			, fixQuotes($this->province)
		);
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$addressID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $addressID;
		}
		return $ret;
	}
	
	function selectRecord($addressID){
		if ($addressID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE addressID=%s;",
			ADDRESS_TABLE, $addressID);
		$this->db->query($sql);
		$this->db->query($sql);
		$company = new Address;
		if ($this->db->next_record()) {
			$this->addressID = $this->db->f("addressID");
			$this->number = $this->db->f("number");
			$this->street = $this->db->f("street");
			$this->barangay = $this->db->f("barangay");
			$this->district = $this->db->f("district");
			$this->municipalityCity = $this->db->f("municipalityCity");
			$this->province = $this->db->f("province");
			$this->setDomDocument();
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}
	
	function deleteRecord($addressID=""){
		$this->setDB();
		$this->db->beginTransaction();

		if ($address <> "") $this->selectAddress($addressID);
		$sql = sprintf("delete from %s where addressID=%s;",
			ADDRESS_TABLE, $this->addressID);
		$this->db->query($sql);
		$rows = $this->db->affected_rows();
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $rows;
		}
		return $ret;
	}
	
	function updateRecord(){
		$sql = sprintf("update %s set ".
			"number = '%s'".
			", street = '%s'".
			", barangay = '%s'".
			", district = '%s'".
			", municipalityCity = '%s'".
			", province = '%s'".
			" where addressID = %s"
			, ADDRESS_TABLE
			, fixQuotes($this->number)
			, fixQuotes($this->street)
			, fixQuotes($this->barangay)
			, fixQuotes($this->district)
			, fixQuotes($this->municipalityCity)
			, fixQuotes($this->province)
			, $this->addressID
		);
		//echo $sql;
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$addressID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $this->addressID;
		}
		return $ret;
	}
}
?>