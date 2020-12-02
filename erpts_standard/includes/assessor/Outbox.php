<?php

class Outbox
{
	//attributes

	var $outboxID;
	var $ownerType;
	var $personCompanyID;
	var $messageType; // ('email' 'sms' 'fax')
	var $sendTo;
	var $message;
	var $createdBy;
	var $dateCreated;
	var $status; // ('sent' 'failed')

	//constructor

	function Outbox() {
	
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}

	function setOutboxID($tempVar){
		$this->outboxID = $tempVar;
	}
	function setOwnerType($tempVar){
		$this->ownerType = $tempVar;
	}
	function setPersonCompanyID($tempVar){
		$this->personCompanyID = $tempVar;
	}
	function setMessageType($tempVar){
		$this->messageType = $tempVar;
	}
	function setSendTo($tempVar){
		$this->sendTo = $tempVar;
	}
	function setMessage($tempVar){
		$this->message = $tempVar;
	}
	function setCreatedBy($tempVar){
		$this->createdBy = $tempVar;
	}
	function setDateCreated($tempVar){
		$this->dateCreated = $tempVar;
	}
	function setStatus($tempVar){
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
		$rec = $this->domDocument->create_element("Outbox");
		$rec = $this->domDocument->append_child($rec);

		$this->setDocNode("outboxID",$this->outboxID,$this->domDocument,$rec);
		$this->setDocNode("ownerType",$this->ownerType,$this->domDocument,$rec);
		$this->setDocNode("personCompanyID",$this->personCompanyID,$this->domDocument,$rec);
		$this->setDocNode("messageType",$this->messageType,$this->domDocument,$rec);
		$this->setDocNode("sendTo",$this->sendTo,$this->domDocument,$rec);
		$this->setDocNode("message",$this->message,$this->domDocument,$rec);
		$this->setDocNode("createdBy",$this->createdBy,$this->domDocument,$rec);
		$this->setDocNode("dateCreated",$this->dateCreated,$this->domDocument,$rec);
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

	function getOutboxID(){
		return $this->outboxID;
	}
	function getOwnerType(){
		return $this->ownerType;
	}
	function getPersonCompanyID(){
		return $this->personCompanyID;
	}
	function getMessageType(){
		return $this->messageType;
	}
	function getSendTo(){
		return $this->sendTo;
	}
	function getMessage(){
		return $this->message;
	}
	function getCreatedBy(){
		return $this->createdBy;
	}
	function getDateCreated(){
		return $this->dateCreated;
	}
	function getStatus(){
		return $this->status;
	}

	//DB
	function selectRecord($outboxID){
		if ($outboxID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE outboxID=%s;",
			OUTBOX_TABLE, $outboxID);
			$this->db->query($sql);
		$outbox = new Outbox;
		if ($this->db->next_record()) {
			//*

			$this->outboxID = $this->db->f("outboxID");
			$this->ownerType = $this->db->f("ownerType");
			$this->personCompanyID = $this->db->f("personCompanyID");
			$this->messageType = $this->db->f("messageType");
			$this->sendTo = $this->db->f("sendTo");
			$this->message = $this->db->f("message");
			$this->createdBy = $this->db->f("createdBy");
			$this->dateCreated = $this->db->f("dateCreated");
			$this->status	 = $this->db->f("status	");

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
			"outboxID".
			", ownerType".
			", personCompanyID".
			", messageType".
			", sendTo".
			", message".
			", createdBy".
			", dateCreated".
			", status".
			") ".
			"values ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');"
			, OUTBOX_TABLE
			, fixQuotes($this->outboxID)
			, fixQuotes($this->ownerType)
			, fixQuotes($this->personCompanyID)
			, fixQuotes($this->messageType)
			, fixQuotes($this->sendTo)
			, fixQuotes($this->message)
			, fixQuotes($this->createdBy)
			, fixQuotes($this->dateCreated)
			, fixQuotes($this->status)
		);
	
		$this->setDB();

		//$dummySQL = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		//$this->db->query($dummySQL);

		$this->db->beginTransaction();
		$this->db->query($sql);
		$outboxID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $outboxID;
		}
		
		//echo $sql;
		return $ret;
	}
	
	function deleteRecord($outboxID){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($outboxID);
		$sql = sprintf("delete from %s where outboxID=%s;",
			OUTBOX_TABLE, $outboxID);
		$this->db->query($sql);
		$outboxRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $outboxRows;
		}
		return $ret;
	}
	
	function updateRecord(){
		$sql = sprintf("update %s set".
			" ownerType = '%s'".
			", personCompanyID = '%s'".
			", messageType = '%s'".
			", sendTo = '%s'".
			", message = '%s'".
			", createdBy = '%s'".
			", dateCreated = '%s'".
			", status = '%s'".
			" where outboxID = '%s';",
			OUTBOX_TABLE
			, fixQuotes($this->ownerType)
			, fixQuotes($this->personCompanyID)
			, fixQuotes($this->messageType)
			, fixQuotes($this->sendTo)
			, fixQuotes($this->message)
			, fixQuotes($this->createdBy)
			, fixQuotes(time())
			, fixQuotes($this->status)
			, $this->outboxID
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
			$ret = $this->outboxID;
		}
		return $ret;
	}
	
}
?>
