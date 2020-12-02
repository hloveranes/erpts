<?php
//include files
include_once "../erpts_standard/includes/assessor/Address.php";
class Person
{
	//attributes
	var $personID;
	var $personType = "owner";
	var $lastName;
	var $firstName;
	var $middleName;
	var $gender;
	var $birthday;
	var $maritalStatus;
	var $tin;
	var $addressArray;//array
	//var $homeAddress;
	var $telephone;
	var $mobileNumber;
	var $email;
	var $domDocument;
	var $db;
	
	//constructor
	function Person() {
	
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	function setPersonID($tempVar) {
		$this->personID = $tempVar;
	}
	function setPersonType($tempVar) {
		$this->personType = $tempVar;
	}
	function setLastName($tempVar) {
		$this->lastName = $tempVar;
	}
	function setFirstName($tempVar) {
		$this->firstName = $tempVar;
	}
	function setMiddleName($tempVar) {
		$this->middleName = $tempVar;
	}
	function setGender($tempVar) {
		$this->gender = $tempVar;
	}
	function setBirthday($tempVar) {
		$this->birthday = $tempVar;
	}
	function setAge($tempVar) {
		$this->age = $tempVar;
	}
	function setMaritalStatus($tempVar) {
		$this->maritalStatus = $tempVar;
	}
	function setTin($tempVar) {
		$this->tin = $tempVar;
	}
	function setAddressArray($tempVar) {
		$this->addressArray[] = $tempVar;
	}
	//function setHomeAddress($tempVar) {
	//	$this->homeAddress = $tempVar;
	//}
	function setTelephone($tempVar) {
		$this->telephone = $tempVar;
	}
	function setMobileNumber($tempVar) {
		$this->mobileNumber = $tempVar;
	}
	function setEmail($tempVar) {
		$this->email = $tempVar;
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
		$rec = $this->domDocument->create_element("Person");
		$rec = $this->domDocument->append_child($rec);
		//$rec->set_attribute("personID",$this->personID);
		$this->setDocNode("personID",$this->personID,$this->domDocument,$rec);
		$this->setDocNode("personType",$this->personType,$this->domDocument,$rec);
		$this->setDocNode("lastName",$this->lastName,$this->domDocument,$rec);
		$this->setDocNode("firstName",$this->firstName,$this->domDocument,$rec);
		$this->setDocNode("middleName",$this->middleName,$this->domDocument,$rec);
		$this->setDocNode("gender",$this->gender,$this->domDocument,$rec);
		$this->setDocNode("birthday",$this->birthday,$this->domDocument,$rec);
		$this->setDocNode("maritalStatus",$this->maritalStatus,$this->domDocument,$rec);
		$this->setDocNode("tin",$this->tin,$this->domDocument,$rec);
		if (count($this->addressArray))
			$this->setArrayDocNode("addressArray",$this->addressArray,$rec);
		//$this->setObjectDocNode("addressArray",$this->addressArray,$this->domDocument,$rec);
		$this->setDocNode("telephone",$this->telephone,$this->domDocument,$rec);
		$this->setDocNode("mobileNumber",$this->mobileNumber,$this->domDocument,$rec);
		$this->setDocNode("email",$this->email,$this->domDocument,$rec);
	}
	function parseDomDocument($domDoc){
		$ret = true;
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				if ($child->tagname=="addressArray"){
					$addressNode = $child->first_child();

					while ($addressNode){
						//if ($addressNode->tagname=="address") {
						if ($addressNode->tagname) {
							$tempXmlStr = $domDoc->dump_node($addressNode);
							$tempDomDoc = domxml_open_mem($tempXmlStr);
							$address = new Address;
							$ret = $address->parseDomDocument($tempDomDoc);
							$this->setAddressArray($address);
						}
						$addressNode = $addressNode->next_sibling();
					}
				}
				else {
					//eval("\$this->".$child->tagname." = \"".$child->get_content()."\";");

					// test varvars
					$varvar = $child->tagname;

					$trans = array_flip(get_html_translation_table(HTML_ENTITIES));
					$childContent = strtr(html_entity_decode($child->get_content()), $trans);

					$this->$varvar = html_entity_decode($childContent);

					//$this->$varvar = html_entity_decode($child->get_content());
				}
				//eval("\$this->set".ucfirst($child->tagname)."(\"".$child->get_content()."\");");
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
	function getPersonID() {
		return $this->personID;
	}
	function getPersonType() {
		return $this->personType;
	}
	function getLastName() {
		return $this->lastName;
	}
	function getFirstName() {
		return $this->firstName;
	}
	function getMiddleName() {
		return $this->middleName;
	}

	/* 
		Modified by: JC
		Purpose    : Argao Version uses getProperName in line 252 
			     of PrintImprovementsBuildingsFAAS.php
		Description: Wrapper to getFullName() method
		
	
	*/
	function getProperName(){
		return $this->getFullName();
	}
	function getFullName(){
		//$fullName = $this->lastName .", ". $this->firstName ." ". $this->middleName;

		// NCC Modification checked and implemented by K2 : November 10, 2005
		// details:
		//		the modification comments out line 204 (above) and replaces it with line 211 (below)
		//         $fullName format: {firstName} {middleInitial}. {lastName}

		$fullName=$this->firstName." ".substr($this->middleName,0,1).". ".$this->lastName;
		return $fullName;
	}
	function getName(){
		$fullName = $this->firstName;
		$fullName.= " ";
		if($this->middleName!=""){
			$fullName.= substr($this->middleName, 0, 1) . ".";
		}
		$fullName.= " ";
		$fullName.= $this->lastName;

		return $fullName;
	}

	function getTitle(){
		switch($this->gender){
			case "male":
				$this->title = "Mr.";
				break;
			case "female":
				switch($this->maritalStatus){
					case "married":
						$this->title = "Mrs.";
						break;
					case "single":
					default:
						$this->title = "Ms.";
						break;
				}
				break;
			default:
				$this->title = "";
				break;
		}
		return $this->title;
	}

	function getGender() {
		return $this->gender;
	}
	function getBirthday() {
		if($this->birthday=="0000-00-00" || $this->birthday==""){
			$this->birthday = "";
		}
		return $this->birthday;
	}
	function getAge() {
		return $this->age;
	}
	function getMaritalStatus() {
		return $this->maritalStatus;
	}
	function getTin() {
		return $this->tin;
	}
	function getAddressArray() {
		return $this->addressArray;
	}
	//function getHomeAddress() {
	//	return $this->homeAddress;
	//}
	function getTelephone() {
		return $this->telephone;
	}
	function getMobileNumber() {
		return $this->mobileNumber;
	}
	function getEmail() {
		return $this->email;
	}

	//DB
	function selectRecord($personID){
		if ($personID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE personID=%s;",
			PERSON_TABLE, $personID);
		$this->db->query($sql);
		$person = new Person;
		if ($this->db->next_record()) {
			/*
			$this->personID = $this->db->f("personID");
			$this->lastName = $this->db->f("lastName");
			$this->firstName = $this->db->f("firstName");
			$this->middleName = $this->db->f("middleName");
			$this->gender = $this->db->f("gender");
			$this->birthday = $this->db->f("birthday");
			$this->maritalStatus = $this->db->f("maritalStatus");
			$this->tin = $this->db->f("tin");
			$this->telephone = $this->db->f("telephone");
			$this->mobileNumber = $this->db->f("mobileNumber");
			$this->email = $this->db->f("email");
			//*/
			foreach ($this->db->Record as $key => $value){
				$this->$key = $value;
			}
			$sql = sprintf("select a.addressID from %s as a, %s as b where a.personID = %s and a.addressID = b.addressID;"
				, PERSON_ADDRESS_TABLE
				, ADDRESS_TABLE
				, $this->personID
			);
			//echo $sql;
			$this->db->query($sql);
			while ($this->db->next_record()) {
				$address = new Address;
				$address->selectRecord($this->db->f("addressID"));
				$this->addressArray[] = $address;
			}
			$this->setDomDocument();
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}
	
	function insertRecord(){
		$sql = sprintf("insert into %s (".
			"personType".
			", lastName".
			", firstName".
			", middleName".
			", gender".
			", birthday".
			", maritalStatus".
			", tin".
			", telephone".
			", mobileNumber".
			", email".
			") ".
			"values ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s','%s','%s');"
			, PERSON_TABLE
			, fixQuotes($this->personType)
			, fixQuotes($this->lastName)
			, fixQuotes($this->firstName)
			, fixQuotes($this->middleName)
			, fixQuotes($this->gender)
			, toMysqlDate($this->birthday)
			, fixQuotes($this->maritalStatus)
			, fixQuotes($this->tin)
			, fixQuotes($this->telephone)
			, fixQuotes($this->mobileNumber)
			, fixQuotes($this->email)
		);
		//echo $sql;
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$personID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			foreach($this->addressArray as $key => $value){
			//$value = $this->addressArray;
				$addressID = $value->insertRecord();
				$sql = sprintf("insert into %s (".
					"personID".
					", addressID".
					")".
					" values (%s, %s);"
					, PERSON_ADDRESS_TABLE
					, $personID
					, $addressID
				);
				$this->db->beginTransaction();
				$this->db->query($sql);
				if ($this->db->Errno!=0) {
					$this->db->rollbackTransaction();
					$this->db->resetErrors();
					$ret = false;
				}
				else {
					$this->db->endTransaction();
				}
			}
			$ret = $personID;
		}
		return $ret;
	}
	
	function deleteRecord($personID){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($personID);
		$address = new Address;
		$address->selectRecord($this->addressArray[0]->addressID);
		$address->deleteRecord($this->addressArray[0]->addressID);
		$sql = sprintf("delete from %s where personID=%s;",
			PERSON_TABLE, $personID);
		$this->db->query($sql);
		$personRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $personRows;
		}
		return $ret;
	}
	
	function updateRecord(){
		
		$sql = sprintf("update %s set".
			" personType = '%s'".
			", lastName = '%s'".
			", firstName = '%s'".
			", middleName = '%s'".
			", gender = '%s'".
			", birthday = '%s'".
			", maritalStatus = '%s'".
			", tin = '%s'".
			", telephone = '%s'".
			", mobileNumber = '%s'".
			", email = '%s'".
			" where personID = '%s';",
			PERSON_TABLE
			, fixQuotes($this->personType)
			, fixQuotes($this->lastName)
			, fixQuotes($this->firstName)
			, fixQuotes($this->middleName)
			, fixQuotes($this->gender)
			, toMysqlDate($this->birthday)
			, fixQuotes($this->maritalStatus)
			, fixQuotes($this->tin)
			, fixQuotes($this->telephone)
			, fixQuotes($this->mobileNumber)
			, fixQuotes($this->email)
			, $this->personID
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
			foreach($this->addressArray as $key => $value){
			//$value = $this->addressArray;
				if ($value->addressID)
					$addressID = $value->updateRecord();
				else { 
					$addressID = $value->insertRecord();
					$sql = sprintf("insert into %s (".
						"personID".
						", addressID".
						")".
						" values (%s, %s);"
						, PERSON_ADDRESS_TABLE
						, $this->personID
						, $addressID
					);
					$this->db->beginTransaction();
					$this->db->query($sql);
					if ($this->db->Errno!=0) {
						$this->db->rollbackTransaction();
						$this->db->resetErrors();
						$ret = false;
					}
					else {
						$this->db->endTransaction();
					}
				}
			}
			$ret = $this->personID;
		}
		return $ret;
	}
	
	function removeOwnerPerson($ownerID, $personID){
		$this->setDB();
		$this->db->beginTransaction();

		$sql = sprintf("delete from %s where ownerID=%s and personID=%s;",
			OWNER_PERSON_TABLE, $ownerID, $personID);
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
}
?>
