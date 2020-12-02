<?php
//include files

class LocationAddress
{
	//attributes
	var $locationAddressID;
	var $number;
	var $street;
	var $barangay;
	var $district;
	var $municipalityCity;	
	var $province;

	var $barangayID;
	var $districtID;
	var $municipalityCityID;
	var $provinceID;

	var $domDocument;
	var $db;
	
	//constructor
	function LocationAddress() {
	}
	
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	function setlocationAddressID($tempVar) {
		$this->locationAddressID = $tempVar;
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

	function setBarangayID($tempVar){
		$this->barangayID = $tempVar;
	}
	function setDistrictID($tempVar){
		$this->districtID = $tempVar;
	}
	function setMunicipalityCityID($tempVar){
		$this->municipalityCityID = $tempVar;
	}
	function setProvinceID($tempVar){
		$this->provinceID = $tempVar;
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
		$rec = $this->domDocument->create_element("locationAddress");
		$rec = $this->domDocument->append_child($rec);
		//$rec->set_attribute("locationAddressID",$this->locationAddressID);
		$this->setDocNode("locationAddressID",$this->locationAddressID,$this->domDocument,$rec);
		$this->setDocNode("number",$this->number,$this->domDocument,$rec);
		$this->setDocNode("street",$this->street,$this->domDocument,$rec);
		$this->setDocNode("barangay",$this->barangay,$this->domDocument,$rec);
		$this->setDocNode("district",$this->district,$this->domDocument,$rec);
		$this->setDocNode("municipalityCity",$this->municipalityCity,$this->domDocument,$rec);
		$this->setDocNode("province",$this->province,$this->domDocument,$rec);

		$this->setDocNode("barangayID",$this->barangayID,$this->domDocument,$rec);
		$this->setDocNode("districtID",$this->districtID,$this->domDocument,$rec);
		$this->setDocNode("municipalityCityID",$this->municipalityCityID,$this->domDocument,$rec);
		$this->setDocNode("provinceID",$this->provinceID,$this->domDocument,$rec);
	}
	function parseDomDocument($domDoc){
		$ret = true;
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
		return $ret;
	}
	function getDomDocument(){
		return $this->domDocument;
	}
		
	//get
	function getLocationAddressID() {
		return $this->locationAddressID;
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

	function getBarangayID() {
		return $this->barangayID;
	}
	function getDistrictID() {
		return $this->districtID;
	}
	function getMunicipalityCityID() {
		return $this->municipalityCityID;
	}
	function getProvinceID() {		
		return $this->provinceID;
	}

	function getFullAddress(){
		$fullAddress = $this->number
		.putPreComma($this->street)
		.putPreComma($this->barangay);

		if($this->district!="" && $this->district!="no district" && $this->district!=0){
			$fullAddress .= putPreComma($this->district);
		}

		$fullAddress .= putPreComma($this->municipalityCity)
		.putPreComma($this->province);

		return $fullAddress;
	}
	//DB
	function insertRecord(){
		if(is_numeric($this->barangay)){
			$this->barangayID = $this->barangay;
		}
		if(is_numeric($this->district)){
			$this->districtID = $this->district;
		}
		if(is_numeric($this->municipalityCity)){
			$this->municipalityCityID = $this->municipalityCity;
		}
		if(is_numeric($this->province)){
			$this->provinceID = $this->province;
		}

		$sql = sprintf("insert into %s (".
			"number".
			", street".
			", barangayID".
			", district".
			", municipalityCity".
			", province".
			")".
			" values ('%s', '%s', '%s', '%s', '%s', '%s');"
			, LOCATIONADDRESS_TABLE
			, fixQuotes($this->number)
			, fixQuotes($this->street)
			, fixQuotes($this->barangayID)
			, fixQuotes($this->districtID)
			, fixQuotes($this->municipalityCityID)
			, fixQuotes($this->provinceID)
		);
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$locationAddressID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $locationAddressID;
		}
		return $ret;
	}

	function selectRecordFromTdID($tdID){
		$this->setDB();

		$sql = sprintf("SELECT propertyID, propertyType FROM %s WHERE tdID='%s';",TD_TABLE,$tdID);	
		$this->db->query($sql);

		if ($this->db->next_record()) {
			$propertyID = $this->db->f("propertyID");
			$propertyType = $this->db->f("propertyType");
		}

		switch($propertyType){
			case "Land":
				$sql = sprintf("SELECT afsID FROM %s WHERE propertyID='%s';",LAND_TABLE,$propertyID);
				break;
			case "ImprovementsBuildings":
				$sql = sprintf("SELECT afsID FROM %s WHERE propertyID='%s';",IMPROVEMENTSBUILDINGS_TABLE,$propertyID);
				break;
			case "Machineries":
				$sql = sprintf("SELECT afsID FROM %s WHERE propertyID='%s';",MACHINERIES_TABLE,$propertyID);
				break;
			case "PlantsTrees":
				$sql = sprintf("SELECT afsID FROM %s WHERE propertyID='%s';",PLANTSTREES_TABLE,$propertyID);
				break;
		}

		$this->db->query($sql);

		if ($this->db->next_record()) {
			$afsID = $this->db->f("afsID");
		}

		$sql = sprintf("SELECT odID FROM %s WHERE afsID='%s';",AFS_TABLE,$afsID);
		$this->db->query($sql);

		if ($this->db->next_record()) {
			$odID = $this->db->f("odID");
		}

		$sql = sprintf("SELECT locationAddressID FROM %s WHERE odID='%s';",LOCATION_TABLE,$odID);
		
		$this->db->query($sql);

		if ($this->db->next_record()) {
			$locationAddressID = $this->db->f("locationAddressID");
		}

		$this->selectRecord($locationAddressID);
	}
	
	function selectRecord($locationAddressID){
		if ($locationAddressID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE locationAddressID=%s;",
			LOCATIONADDRESS_TABLE, $locationAddressID);
		$this->db->query($sql);

		$company = new LocationAddress;
		if ($this->db->next_record()) {
			$this->locationAddressID = $this->db->f("locationAddressID");
			$this->number = $this->db->f("number");
			$this->street = $this->db->f("street");
			$this->barangayID = $this->db->f("barangayID");
			$this->districtID = $this->db->f("district");
			$this->municipalityCityID = $this->db->f("municipalityCity");
			$this->provinceID = $this->db->f("province");

			// convert IDs to text values

			//barangay
			$sql = sprintf("SELECT * FROM %s WHERE barangayID='%s';",
                 BARANGAY_TABLE, $this->barangayID);
            $this->db->query($sql);
            if($this->db->next_record()){
                $this->barangay = $this->db->f("description");
            }

			//district
			$sql = sprintf("SELECT * FROM %s WHERE districtID='%s';",
				 DISTRICT_TABLE, $this->districtID);
			$this->db->query($sql);
			if($this->db->next_record()){
				$this->district = $this->db->f("description");
			}

			//municipalityCity
			$sql = sprintf("SELECT * FROM %s WHERE municipalityCityID='%s';",
				 MUNICIPALITYCITY_TABLE, $this->municipalityCityID);
			$this->db->query($sql);
			if($this->db->next_record()){
				$this->municipalityCity = $this->db->f("description");
			}

			//province
			$sql = sprintf("SELECT * FROM %s WHERE provinceID='%s';",
				 PROVINCE_TABLE, $this->provinceID);
			$this->db->query($sql);
			if($this->db->next_record()){
				$this->province = $this->db->f("description");
			}

			$this->setDomDocument();
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}
	
	function deleteRecord($locationAddressID=""){
		$this->setDB();
		$this->db->beginTransaction();

		if ($locationAddress <> "") $this->selectLocationAddress($locationAddressID);
		$sql = sprintf("delete from %s where locationAddressID=%s;",
			LOCATIONADDRESS_TABLE, $this->locationAddressID);
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
		if(is_numeric($this->barangay)){
			$this->barangayID = $this->barangay;
		}
		if(is_numeric($this->district)){
			$this->districtID = $this->district;
		}
		if(is_numeric($this->municipalityCity)){
			$this->municipalityCityID = $this->municipalityCity;
		}
		if(is_numeric($this->province)){
			$this->provinceID = $this->province;
		}

		$sql = sprintf("update %s set ".
			"number = '%s'".
			", street = '%s'".
			", barangayID = '%s'".
			", district = '%s'".
			", municipalityCity = '%s'".
			", province = '%s'".
			" where locationAddressID = %s"
			, LOCATIONADDRESS_TABLE
			, fixQuotes($this->number)
			, fixQuotes($this->street)
			, fixQuotes($this->barangayID)
			, fixQuotes($this->districtID)
			, fixQuotes($this->municipalityCityID)
			, fixQuotes($this->provinceID)
			, $this->locationAddressID
		);
		//echo $sql;
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$locationAddressID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $this->locationAddressID;
		}
		return $ret;
	}
	
}
?>
