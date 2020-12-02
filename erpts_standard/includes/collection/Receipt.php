<?php
include_once "./Collection.php";

class Receipt
{
	//attributes

	var $receiptID;
	var $receiptNumber;
	var $receiptDate;
	var $paymentMode;
	var $checkNumber;
	var $dateOfCheck;
	var $draweeBank;
	var $receivedFrom;
	var $previousReceiptNumber;
	var $previousReceiptDate;
	var $cityTreasurer;
	var $deputyTreasurer;
	var $status;

	// collection attributes
	// defined here as well to fill up hidden fields in template

	var $paymentID;
	var $taxType;
	var $taxDue;
	var $advancedPaymentDiscount;
	var $earlyPaymentDiscount;
	var $penalty;
	var $amnesty;
	var $balanceDue;
	var $amountPaid;

	var $collectionArray; // collections

	var $domDocument;
	var $db;

	//constructor
	function Receipt() {
	
	}

	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}

	function setReceiptID($tempVar){
		$this->receiptID = $tempVar;
	}
	function setReceiptNumber($tempVar){
		$this->receiptNumber = $tempVar;
	}
	function setReceiptDate($tempVar){
		$this->receiptDate = $tempVar;
	}
	function setPaymentMode($tempVar){
		$this->paymentMode = $tempVar;
	}
	function setCheckNumber($tempVar){
		$this->checkNumber = $tempVar;
	}
	function setDateOfCheck($tempVar){
		$this->dateOfCheck = $tempVar;
	}
	function setDraweeBank($tempVar){
		$this->draweeBank = $tempVar;
	}
	function setReceivedFrom($tempVar){
		$this->receivedFrom = $tempVar;
	}
	function setPreviousReceiptNumber($tempVar){
		$this->previousReceiptNumber = $tempVar;
	}
	function setPreviousReceiptDate($tempVar){
		$this->previousReceiptDate = $tempVar;
	}
	function setCityTreasurer($tempVar){
		$this->cityTreasurer = $tempVar;
	}
	function setDeputyTreasurer($tempVar){
		$this->deputyTreasurer = $tempVar;
	}
	function setStatus($tempVar){
		$this->status = $tempVar;
	}

	function setPaymentID($tempVar){
		$this->paymentID = $tempVar;
	}
	function setTaxType($tempVar){
		$this->taxType = $tempVar;
	}
	function setTaxDue($tempVar){
		$this->taxDue = $tempVar;
	}
	function setAdvancedPaymentDiscount($tempVar){
		$this->advancedPaymentDiscount = $tempVar;
	}
	function setEarlyPaymentDiscount($tempVar){
		$this->earlyPaymentDiscount = $tempVar;
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

	function setCollectionArray($tempVar){
		$this->collectionArray[] = $tempVar;
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
		$rec = $this->domDocument->create_element("Receipt");
		$rec = $this->domDocument->append_child($rec);

		$this->setDocNode("receiptID",$this->receiptID,$this->domDocument,$rec);
		$this->setDocNode("receiptNumber",$this->receiptNumber,$this->domDocument,$rec);
		$this->setDocNode("receiptDate",$this->receiptDate,$this->domDocument,$rec);
		$this->setDocNode("paymentMode",$this->paymentMode,$this->domDocument,$rec);
		$this->setDocNode("checkNumber",$this->checkNumber,$this->domDocument,$rec);
		$this->setDocNode("dateOfCheck",$this->dateOfCheck,$this->domDocument,$rec);
		$this->setDocNode("draweeBank",$this->draweeBank,$this->domDocument,$rec);
		$this->setDocNode("receivedFrom",$this->receivedFrom,$this->domDocument,$rec);
		$this->setDocNode("previousReceiptNumber",$this->previousReceiptNumber,$this->domDocument,$rec);
		$this->setDocNode("previousReceiptDate",$this->previousReceiptDate,$this->domDocument,$rec);
		$this->setDocNode("cityTreasurer",$this->cityTreasurer,$this->domDocument,$rec);
		$this->setDocNode("deputyTreasurer",$this->deputyTreasurer,$this->domDocument,$rec);
		$this->setDocNode("status",$this->status,$this->domDocument,$rec);

		if(is_array($this->collectionArray)){
			$this->setArrayDocNode("collectionArray",$this->collectionArray,$rec);
		}
	}
	function parseDomDocument($domDoc){
		$ret = true;
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				if ($child->tagname=="collectionArray"){
					$collectionNode = $child->first_child();
					while ($collectionNode){
						//if ($collectionNode->tagname=="collection") {
						if ($collectionNode->tagname) {
							$tempXmlStr = $domDoc->dump_node($collectionNode);
							$tempDomDoc = domxml_open_mem($tempXmlStr);
							$collection = new Collection;
							$ret = $collection->parseDomDocument($tempDomDoc);
							$this->setCollectionArray($collection);
						}
						$collectionNode = $collectionNode->next_sibling();
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

	function getReceiptID(){
		return $this->receiptID;
	}
	function getReceiptNumber(){
		return $this->receiptNumber;
	}
	function getReceiptDate(){
		return $this->receiptDate;
	}
	function getPaymentMode(){
		return $this->paymentMode;
	}
	function getCheckNumber(){
		return $this->checkNumber;
	}
	function getDateOfCheck(){
		return $this->dateOfCheck;
	}
	function getDraweeBank(){
		return $this->draweeBank;
	}
	function getReceivedFrom(){
		return $this->receivedFrom;
	}
	function getPreviousReceiptNumber(){
		return $this->previousReceiptNumber;
	}
	function getPreviousReceiptDate(){
		return $this->previousReceiptDate;
	}
	function getCityTreasurer(){
		return $this->cityTreasurer;
	}
	function getDeputyTreasurer(){
		return $this->deputyTreasurer;
	}
	function getStatus(){
		return $this->status;
	}

	function getPaymentID(){
		return $this->paymentID;
	}
	function getTaxType(){
		return $this->taxType;
	}
	function getTaxDue(){
		return $this->taxDue;
	}
	function getAdvancedPaymentDiscount(){
		return $this->advancedPaymentDiscount;
	}
	function getEarlyPaymentDiscount(){
		return $this->earlyPaymentDiscount;
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

	function getCollectionArray(){
		return $this->collectionArray;
	}

	//DB
	function selectRecord($receiptID){
		if ($receiptID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE receiptID=%s;",
			RECEIPT_TABLE, $receiptID);
			$this->db->query($sql);

		if ($this->db->next_record()) {
			//*

			$this->receiptID = $this->db->f("receiptID");
			$this->receiptNumber = $this->db->f("receiptNumber");
			$this->receiptDate = $this->db->f("receiptDate");
			$this->paymentMode = $this->db->f("paymentMode");
			$this->checkNumber = $this->db->f("checkNumber");
			$this->dateOfCheck = $this->db->f("dateOfCheck");
			$this->draweeBank = $this->db->f("draweeBank");
			$this->receivedFrom = $this->db->f("receivedFrom");
			$this->previousReceiptNumber = $this->db->f("previousReceiptNumber");
			$this->previousReceiptDate = $this->db->f("previousReceiptDate");
			$this->cityTreasurer = $this->db->f("cityTreasurer");
			$this->deputyTreasurer = $this->db->f("deputyTreasurer");
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
		$sql = sprintf("SELECT receiptID FROM %s %s;",
			RECEIPT_TABLE, $condition);
			$this->db->query($sql);

		if ($this->db->next_record()) {
			$receiptID = $this->db->f("receiptID");
			return $this->selectRecord($receiptID);
		}
	}

	function insertRecord(){
		$sql = sprintf("insert into %s (".
			" receiptID".
			", receiptNumber".
			", receiptDate".
			", paymentMode".
			", checkNumber".
			", dateOfCheck".
			", draweeBank".
			", receivedFrom".
			", previousReceiptNumber".
			", previousReceiptDate".
			", cityTreasurer".
			", deputyTreasurer".
			", status".
			") ".
			"values ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');"
			, RECEIPT_TABLE
			, fixQuotes($this->receiptID)
			, fixQuotes($this->receiptNumber)
			, fixQuotes($this->receiptDate)
			, fixQuotes($this->paymentMode)
			, fixQuotes($this->checkNumber)
			, fixQuotes($this->dateOfCheck)
			, fixQuotes($this->draweeBank)
			, fixQuotes($this->receivedFrom)
			, fixQuotes($this->previousReceiptNumber)
			, fixQuotes($this->previousReceiptDate)
			, fixQuotes($this->cityTreasurer)
			, fixQuotes($this->deputyTreasurer)
			, fixQuotes($this->status)
		);

		$this->setDB();
		$this->db->beginTransaction();


		//$dummySQL = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		//$this->db->query($dummySQL);

		$this->db->query($sql);

		$receiptID = $this->db->insert_id();
		$this->receiptID = $receiptID;

		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $receiptID;
		}
		
		//echo $sql;
		return $ret;
	}
	
	function deleteRecord($receiptID){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($receiptID);
		$sql = sprintf("delete from %s where receiptID=%s;",
			RECEIPT_TABLE, $receiptID);
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
			" receiptID = '%s'".
			", receiptNumber = '%s'".
			", receiptDate = '%s'".
			", paymentMode = '%s'".
			", checkNumber = '%s'".
			", dateOfCheck = '%s'".
			", draweeBank = '%s'".
			", receivedFrom = '%s'".
			", previousReceiptNumber = '%s'".
			", previousReceiptDate = '%s'".
			", cityTreasurer = '%s'".
			", deputyTreasurer = '%s'".
			", status = '%s'".
			" where receiptID = '%s'"
			, RECEIPT_TABLE
			, fixQuotes($this->receiptID)
			, fixQuotes($this->receiptNumber)
			, fixQuotes($this->receiptDate)
			, fixQuotes($this->paymentMode)
			, fixQuotes($this->checkNumber)
			, fixQuotes($this->dateOfCheck)
			, fixQuotes($this->draweeBank)
			, fixQuotes($this->receivedFrom)
			, fixQuotes($this->previousReceiptNumber)
			, fixQuotes($this->previousReceiptDate)
			, fixQuotes($this->cityTreasurer)
			, fixQuotes($this->deputyTreasurer)
			, fixQuotes($this->status)
			, fixQuotes($this->receiptID)
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
			$ret = $this->receiptID;
		}
		return $ret;
	}
	
}
?>