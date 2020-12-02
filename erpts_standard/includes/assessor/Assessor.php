<?php
//include files
include_once "./Person.php";

class Assessor extends Person
{
	//attributes
	var $assessorID;
	var $position;
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
	
	function setAssessorID($tempVar) {
		$this->assessorID = $tempVar;
	}
	function setPersonID($tempVar) {
		$this->personID = $tempVar;
	}
	function setPosition($tempVar) {
		$this->position = $tempVar;
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
		$rec = $this->domDocument->create_element("Assessor");
		$rec = $this->domDocument->append_child($rec);
		$this->setDocNode("assessorID",$this->assessorID,$this->domDocument,$rec);
		$this->setDocNode("personID",$this->personID,$this->domDocument,$rec);
		$this->setDocNode("lastName",$this->lastName,$this->domDocument,$rec);
		$this->setDocNode("firstName",$this->firstName,$this->domDocument,$rec);
		$this->setDocNode("middleName",$this->middleName,$this->domDocument,$rec);
		$this->setDocNode("gender",$this->gender,$this->domDocument,$rec);
		$this->setDocNode("birthday",$this->birthday,$this->domDocument,$rec);
		$this->setDocNode("maritalStatus",$this->maritalStatus,$this->domDocument,$rec);
		$this->setDocNode("tin",$this->tin,$this->domDocument,$rec);
		if (count($this->addressArray))
			$this->setArrayDocNode("addressArray",$this->addressArray,$rec);
		$this->setDocNode("telephone",$this->telephone,$this->domDocument,$rec);
		$this->setDocNode("mobileNumber",$this->mobileNumber,$this->domDocument,$rec);
		$this->setDocNode("email",$this->email,$this->domDocument,$rec);
		$this->setDocNode("position",$this->position,$this->domDocument,$rec);
	}
	function parseDomDocument($domDoc){
		$ret = true;
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//if ($child->tagname=="addressArray"){
				if ($child->tagname){
					$addressNode = $child->first_child();
					while ($addressNode){
						//if ($addressNode->tagname=="Address") {
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

				// test varvars
				//$varvar = $child->tagname;
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
	function getAssessorID() {
		return $this->assessorID;
	}
	function getPersonID() {
		return $this->personID;
	}
	function getPosition() {
		return $this->position;
	}
	
	//DB
	function selectRecord($assessorID){
		if ($assessorID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT a.*,b.* FROM %s as a, %s as b WHERE b.assessorID=%s AND a.personID = b.personID;",
			PERSON_TABLE, ASSESSOR_TABLE, $assessorID);
		//echo $sql;
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
		if ($this->personID = Person::insertRecord()){
		$sql = sprintf("insert into %s (".
			"personID".
			", position".
			") ".
			"values ('%s', '%s');"
			, ASSESSOR_TABLE
			, fixQuotes($this->personID)
			, fixQuotes($this->position)
		);
		//echo $sql;
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$assessorID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $assessorID;
		}
		}
		else $ret = false;
		return $ret;
	}
	
	function deleteRecord($assessorID){
		//$person = new Person;
		//$person->deleteRecord($this->personID);
		//$address = new Address;
		//$address->deleteRecord($this->addressArray[0]->addressID);
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($assessorID);
		$sql = sprintf("delete from %s where assessorID=%s",
			ASSESSOR_TABLE, $assessorID);
		//echo $sql;
		$this->db->query($sql);
		$assessorRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $assessorRows;
		}
		return $ret;
	}
	
	function updateRecord(){
		if ($this->personID = Person::updateRecord()){
			$sql = sprintf("update %s set".
				" personID = '%s'".
				", position = '%s'".
				" where personID = '%s';",
				ASSESSOR_TABLE
				, fixQuotes($this->personID)
				, fixQuotes($this->position)
				, $this->assessorID
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
				$ret = $this->assessorID;
			}
		}
		else $ret = false;
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
