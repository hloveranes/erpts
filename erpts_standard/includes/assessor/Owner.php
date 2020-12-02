<?php
include_once "./Address.php";
include_once "./Person.php";
include_once "./PersonRecords.php";
include_once "./Company.php";
include_once "./CompanyRecords.php";

class Owner
{
	//attributes
	var $ownerID;
	var $odID;
	var $rptopID;
	var $companyArray;
	var $personArray;
	var $domDocument;

	//constructor
	function Owner(){

	}
	
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}
		
	function setOwnerID($tempVar) {
		$this->ownerID = $tempVar;
	}
	
	function setRptopID($tempVar) {
		$this->rptopID = $tempVar;
	}
	
	function setPersonArray ($tempVar) {
		$this->personArray[] = $tempVar;
	}
	
	function setCompanyArray ($tempVar) {
		$this->companyArray[] = $tempVar;
	}
	  
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
	  
	function setArrayDocNode ($elementName,$arrayList,$indexNode){
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
		
	function setDomDocument (){
		$this->domDocument = domxml_new_doc("1.0");
		$rec = $this->domDocument->create_element("Owner");
		$rec = $this->domDocument->append_child($rec);
	    $rec->set_attribute("ownerID",$this->ownerID);	
		$this->setDocNode("ownerID",$this->ownerID,$this->domDocument,$rec);
		if (count($this->personArray))
			$this->setArrayDocNode("personArray",$this->personArray,$rec);
		if (count($this->companyArray))
			$this->setArrayDocNode("companyArray",$this->companyArray,$rec);
	}
	
	function parseDomDocument($domDoc){
		//echo $domDoc->dump_mem(true);
		$ret = true;
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				switch($child->tagname){
					case "personArray":
						$personNode = $child->first_child();
						while ($personNode){
							if ($personNode->tagname=="Person") {
							//if ($personNode->tagname) {
								$tempXmlStr = $domDoc->dump_node($personNode);
								$tempDomDoc = domxml_open_mem($tempXmlStr);
								$person = new Person;
								$ret = $person->parseDomDocument($tempDomDoc);
								$this->setPersonArray($person);
							}
							$personNode = $personNode->next_sibling();
						}
						break;
					case "companyArray":
						$companyNode = $child->first_child();
						while ($companyNode){
							if ($companyNode->tagname=="Company") {
							//if ($companyNode->tagname) {
								$tempXmlStr = $domDoc->dump_node($companyNode);
								$tempDomDoc = domxml_open_mem($tempXmlStr);
								$company = new Company;
								$ret = $company->parseDomDocument($tempDomDoc);
								$this->setCompanyArray($company);
							}
							$companyNode = $companyNode->next_sibling();
						}
						break;						
					default:
						//eval("\$this->".$child->tagname." = \"".$child->get_content()."\";");
	
						// test varvars
						$varvar = $child->tagname;

						$trans = array_flip(get_html_translation_table(HTML_ENTITIES));
						$childContent = strtr(html_entity_decode($child->get_content()), $trans);

						$this->$varvar = html_entity_decode($childContent);

						//$this->$varvar = html_entity_decode($child->get_content());
				}
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
	
	function getOwnerID () {
		return $this->ownerID;
	}

	function getRptopID () {
		return $this->rptopID;
	}
	
	function getPersonArray () {
		return $this->personArray;
	}
	
	function getPersonIDArray () {
		$arr = "";
		foreach ($this->personArray as $key => $value){
			$arr[] = $value->getPersonID();
		}
		return $arr;
	}
	
	function getCompanyArray () {
		return $this->companyArray;
	}
	
	function getCompanyIDArray () {
		$arr = "";
		foreach ($this->companyArray as $key => $value){
			$arr[] = $value->getCompanyID();
		}
		return $arr;
	}
	function selectRecord1($ownerID){
		if ($ownerID=="") return;
		$this->setDB();
		
		$sql = "SELECT Owner.ownerID as ownerID,Owner.rptopID as rptopID,OwnerPerson.personID as personID FROM Owner inner join OwnerPerson on Owner.ownerID=OwnerPerson.ownerID inner join PersonAddress 
				on OwnerPerson.personID=PersonAddress.personID inner join Address on PersonAddress.addressID=Address.addressID 
				where Owner.ownerID=5 ";//and municipalityCity='$municipalityCity'
				
		$this->db->query($sql);
		if ($this->db->next_record()) {
			$this->ownerID = $this->db->f("ownerID");
			$this->rptopID = $this->db->f("rptopID");
			$sql = sprintf("SELECT personID FROM %s WHERE ownerID=%s;",
				OWNER_PERSON_TABLE, $ownerID);
			$this->db->query($sql);
			while ($this->db->next_record()) {
				$person = new Person;
				if ($person->selectRecord($this->db->f("personID"))) $this->setPersonArray($person);
			}
			$sql = sprintf("SELECT companyID FROM %s WHERE ownerID=%s;",
				OWNER_COMPANY_TABLE, $ownerID);
			$this->db->query($sql);
			while ($this->db->next_record()) {
				$company = new Company;
				if ($company->selectRecord($this->db->f("companyID")))	$this->setCompanyArray($company);
			}
			//print_r($this);
			$this->setDomDocument();
			$ret = true;
		}
		else $ret = false;
		return	$ret;
	}

	//DB functions
	function selectRecord($ownerID){
		if ($ownerID=="") return;
		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE ownerID=%s;",
			OWNER_TABLE, $ownerID);

			

		$this->db->query($sql);
		if ($this->db->next_record()) {
			$this->ownerID = $this->db->f("ownerID");
			$this->rptopID = $this->db->f("rptopID");
			$sql = sprintf("SELECT personID FROM %s WHERE ownerID=%s;",
				OWNER_PERSON_TABLE, $ownerID);
			$this->db->query($sql);
			while ($this->db->next_record()) {
				$person = new Person;
				if ($person->selectRecord($this->db->f("personID"))) $this->setPersonArray($person);
			}
			$sql = sprintf("SELECT companyID FROM %s WHERE ownerID=%s;",
				OWNER_COMPANY_TABLE, $ownerID);
			$this->db->query($sql);
			while ($this->db->next_record()) {
				$company = new Company;
				if ($company->selectRecord($this->db->f("companyID")))	$this->setCompanyArray($company);
			}
			//print_r($this);
			$this->setDomDocument();
			$ret = true;
		}
		else $ret = false;
		return	$ret;
	}
	
	function insertRecord($id,$doc){
		$sql = sprintf("insert into %s (".$doc."ID) values ('%s');",
			OWNER_TABLE, $id);
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$ownerID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $ownerID;
		}
		return $ret;
	}
	
	function insertRecordRptop($rptopID){
		$sql = sprintf("insert into %s (rptopID) values ('%s');",
			OWNER_TABLE, $rptopID);
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$ownerID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $ownerID;
		}
		return $ret;
	}
	
	function insertOwnerCompany($ownerID,$companyID){
		$sql = sprintf("insert into %s (ownerID,companyID) values ('%s', '%s');",
			OWNER_COMPANY_TABLE, $ownerID, $companyID);
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$ownerCompanyID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $ownerCompanyID;
		}
		return $ret;
	}
	
	function insertOwnerPerson($ownerID,$personID){
		$sql = sprintf("insert into %s (ownerID,personID) values ('%s', '%s');",
			OWNER_PERSON_TABLE, $ownerID, $personID);
		//echo $sql;
		$this->setDB();

		$this->db->beginTransaction();
		$this->db->query($sql);
		$ownerPersonID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $ownerPersonID;
		}
		return $ret;
	}
	
	function selectOwnerPerson($personID){
		$sql = sprintf("select ownerID from %s where personID = '%s';",
			OWNER_PERSON_TABLE, $personID);
		$this->setDB();
		$this->db->query($sql);
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$ret[] = $this->db->f("ownerID");
		}
		return	$ret;
	}
	
	function selectOwnerCompany($companyID){
		$sql = sprintf("select ownerID from %s where companyID = '%s';",
			OWNER_COMPANY_TABLE, $companyID);
		$this->setDB();
		$this->db->query($sql);
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$ret[] = $this->db->f("ownerID");
		}
		return	$ret;
	}
	
	function selectODPerson($ownerID){
		$sql = sprintf("select odID from %s where ownerID = '%s';",
			OWNER_TABLE, $ownerID);
		//echo $sql;
		$this->setDB();
		$this->db->query($sql);
		if ($this->db->next_record()) {
			$odID = $this->db->f("odID");
			//$sql = sprintf("select presentODID from %s where previousODID = '%s';",
			//ODHistory, $odID);
			////echo $sql;
			//$this->db->query($sql);
			//if ($this->db->next_record()) {
			//	$ret = false;
			//}
			//else
			$ret = $odID;
		}
		else $ret = false;
		return	$ret;
	}
	function selectODCompany($ownerID){
		$sql = sprintf("select odID from %s where ownerID = '%s';",
			OWNER_TABLE, $ownerID);
		//echo $sql;
		$this->setDB();
		$this->db->query($sql);
		if ($this->db->next_record()) {
			$odID = $this->db->f("odID");
			//$sql = sprintf("select presentODID from %s where previousODID = '%s';",
			//ODHistory, $odID);
			//echo $sql;
			//$this->db->query($sql);
			//if ($this->db->next_record()) {
			//	$ret = false;
			//}
			//else
			 $ret = $odID;
		}
		else $ret = false;
		return	$ret;
	}
	
	function deleteOwnerCompany($companyID){
		$this->setDB();
		$this->db->beginTransaction();

		$this->selectRecord($this->ownerID);
		$sql = sprintf("delete from %s where ownerID=%s and companyID=%s;",
			OWNER_COMPANY_TABLE, $this->ownerID, $companyID);
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
	
	function deleteOwnerPerson($personID){
		$this->setDB();
		$this->db->beginTransaction();

		$this->selectRecord($this->ownerID);
		$sql = sprintf("delete from %s where ownerID=%s and personID=%s;",
			OWNER_PERSON_TABLE, $this->ownerID, $personID);
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
	
	function deleteRecord($ownerID){
		$this->setDB();
		$this->db->beginTransaction();

		$this->selectRecord($ownerID);
		$sql = sprintf("delete from %s where ownerID=%s;",
			OWNER_TABLE, $ownerID);
		$this->db->query($sql);
		$ownerRows = $this->db->affected_rows();

		$companyRows = 0;
		foreach ($this->companyArray as $key => $value){
			$companyRows = $companyRows + $value->deleteRecord();
		}
		$ownerCompanyRows = $this->deleteOwnerCompany();

		$personRows = 0;
		foreach ($this->personArray as $key => $value){
			$personRows = $personRows + $value->deleteRecord();
		}
		$ownerPersonRows = $this->deleteOwnerPerson();

		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$returnRows = array($$companyRows => $companyRows, $$ownerCompanyRows => $ownerCompanyRows,
				$$personRows => $personRows, $$ownerPersonRows => $ownerPersonRows, $$ownerRows => $ownerRows);
			$ret = $returnRows;
		}
		return $ret;
	}	
}
?>