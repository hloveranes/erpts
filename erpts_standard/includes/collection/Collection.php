<?php

class Collection
{
	//attributes

	var $collectionID;
	var $paymentID;
	var $receiptID;
	var $taxType;
	var $taxDue;
	var $earlyPaymentDiscount;
	var $advancedPaymentDiscount;
	var $penalty;
	var $amnesty;
	var $balanceDue;
	var $amountPaid;
	var $status;

	var $domDocument;
	var $db;

	//constructor
	function Collection() {
	
	}

	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}

	function setCollectionID($tempVar){
		$this->collectionID = $tempVar;
	}
	function setPaymentID($tempVar){
		$this->paymentID = $tempVar;
	}
	function setReceiptID($tempVar){
		$this->receiptID = $tempVar;
	}
	function setTaxType($tempVar){
		$this->taxType = $tempVar;
	}
	function setTaxDue($tempVar){
		$this->taxDue = $tempVar;
	}
	function setEarlyPaymentDiscount($tempVar){
		$this->earlyPaymentDiscount = $tempVar;
	}
	function setAdvancedPaymentDiscount($tempVar){
		$this->advancedPaymentDiscount = $tempVar;
	}
	function setPenalty($tempVar){
		$this->penalty = $tempVar;
	}
	function setAmnesty($tempVar){
		$this->amnesty = $tempVar;
	}
	function setBalanceDue($tempVar){
		$this->balanceDue = $tempVar;
	}
	function setAmountPaid($tempVar){
		$this->amountPaid = $tempVar;
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
		$rec = $this->domDocument->create_element("Collection");
		$rec = $this->domDocument->append_child($rec);

		$this->setDocNode("collectionID",$this->collectionID,$this->domDocument,$rec);
		$this->setDocNode("paymentID",$this->paymentID,$this->domDocument,$rec);
		$this->setDocNode("receiptID",$this->receiptID,$this->domDocument,$rec);
		$this->setDocNode("taxType",$this->taxType,$this->domDocument,$rec);
		$this->setDocNode("taxDue",$this->taxDue,$this->domDocument,$rec);
		$this->setDocNode("earlyPaymentDiscount",$this->earlyPaymentDiscount,$this->domDocument,$rec);
		$this->setDocNode("advancedPaymentDiscount",$this->advancedPaymentDiscount,$this->domDocument,$rec);
		$this->setDocNode("penalty",$this->penalty,$this->domDocument,$rec);
		$this->setDocNode("amnesty",$this->amnesty,$this->domDocument,$rec);
		$this->setDocNode("balanceDue",$this->balanceDue,$this->domDocument,$rec);
		$this->setDocNode("amountPaid",$this->amountPaid,$this->domDocument,$rec);
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

	function getCollectionID(){
		return $this->collectionID;
	}
	function getPaymentID(){
		return $this->paymentID;
	}
	function getReceiptID(){
		return $this->receiptID;
	}
	function getTaxType(){
		return $this->taxType;
	}
	function getTaxDue(){
		return $this->taxDue;
	}
	function getEarlyPaymentDiscount(){
		return $this->earlyPaymentDiscount;
	}
	function getAdvancedPaymentDiscount(){
		return $this->advancedPaymentDiscount;
	}
	function getPenalty(){
		return $this->penalty;
	}
	function getAmnesty(){
		return $this->amnesty;
	}
	function getBalanceDue(){
		return $this->balanceDue;
	}
	function getAmountPaid(){
		return $this->amountPaid;
	}
	function getStatus(){
		return $this->status;
	}

	//DB
	function selectRecord($collectionID){
		if ($collectionID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE collectionID=%s;",
			COLLECTION_TABLE, $collectionID);
			$this->db->query($sql);

		if ($this->db->next_record()) {
			//*

			$this->collectionID = $this->db->f("collectionID");
			$this->paymentID = $this->db->f("paymentID");
			$this->receiptID = $this->db->f("receiptID");
			$this->taxType = $this->db->f("taxType");
			$this->taxDue = $this->db->f("taxDue");
			$this->earlyPaymentDiscount = $this->db->f("earlyPaymentDiscount");
			$this->advancedPaymentDiscount = $this->db->f("advancedPaymentDiscount");
			$this->penalty = $this->db->f("penalty");
			$this->amnesty = $this->db->f("amnesty");
			$this->balanceDue = $this->db->f("balanceDue");
			$this->amountPaid = $this->db->f("amountPaid");
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

	function selectRecordFromCondition($condition){
		if ($condition=="") return;

		$this->setDB();
		$sql = sprintf("SELECT collectionID FROM %s %s;",
			COLLECTION_TABLE, $condition);
			$this->db->query($sql);

		if ($this->db->next_record()) {
			$collectionID = $this->db->f("collectionID");
			return $this->selectRecord($collectionID);
		}
	}

	function insertRecord(){
		$sql = sprintf("insert into %s (".
			"collectionID".
			", paymentID".
			", receiptID".
			", taxType".
			", taxDue".
			", earlyPaymentDiscount".
			", advancedPaymentDiscount".
			", penalty".
			", amnesty".
			", balanceDue".
			", amountPaid".
			", status".
			") ".
			"values ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');"
			, COLLECTION_TABLE
			, fixQuotes($this->collectionID)
			, fixQuotes($this->paymentID)
			, fixQuotes($this->receiptID)
			, fixQuotes($this->taxType)
			, fixQuotes($this->taxDue)
			, fixQuotes($this->earlyPaymentDiscount)
			, fixQuotes($this->advancedPaymentDiscount)
			, fixQuotes($this->penalty)
			, fixQuotes($this->amnesty)
			, fixQuotes($this->balanceDue)
			, fixQuotes($this->amountPaid)
			, fixQuotes($this->status)
		);

		$this->setDB();

		$this->db->beginTransaction();
		$this->db->query($sql);
		$collectionID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $collectionID;
		}
		
		//echo $sql;
		return $ret;
	}
	
	function deleteRecord($collectionID){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($collectionID);
		$sql = sprintf("delete from %s where collectionID=%s;",
			COLLLECTION_TABLE, $collectionID);
		$this->db->query($sql);
		$dueRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $dueRows;
		}
		return $ret;
	}
	
	function updateRecord(){		
		$sql = sprintf("update %s set".
			" collectionID = '%s'".
			", paymentID = '%s'".
			", receiptID = '%s'".
			", taxType = '%s'".
			", taxDue = '%s'".
			", earlyPaymentDiscount = '%s'".
			", advancedPaymentDiscount = '%s'".
			", penalty = '%s'".
			", amnesty = '%s'".
			", balanceDue = '%s'".
			", amountPaid = '%s'".
			", status = '%s'".
			" where collectionID = '%s'"
			, COLLECTION_TABLE
			, fixQuotes($this->collectionID)
			, fixQuotes($this->paymentID)
			, fixQuotes($this->receiptID)
			, fixQuotes($this->taxType)
			, fixQuotes($this->taxDue)
			, fixQuotes($this->earlyPaymentDiscount)
			, fixQuotes($this->advancedPaymentDiscount)
			, fixQuotes($this->penalty)
			, fixQuotes($this->amnesty)
			, fixQuotes($this->balanceDue)
			, fixQuotes($this->amountPaid)
			, fixQuotes($this->status)
			, fixQuotes($this->collectionID)
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
			$ret = $this->collectionID;
		}
		return $ret;
	}
	
}
?>