<?php
include_once "./Receipt.php";

class Payment
{
	//attributes

	var $paymentID;

	var $tdID;
    var $dueID;
    var $dueType; // in reference to dueID

	var $backtaxTDID;
   
	var $taxDue;
    var $earlyPaymentDiscount;
	var $advancedPaymentDiscount;
    var $penalty;
	var $amnesty; // [true | false]
	var $balanceDue;
    var $amountPaid;

	var $dueDate;
	var $paymentDate;
	var $ownerID;

	var $status;

	// non database attributes
	
	var $tdNumber;

	var $receiptArray;

	var $basicReceipt; // Receipt
	var $sefReceipt; // Receipt
	var $idleReceipt; // Receipt

	var $propertyClassification; // reportCode from Property Actual Use

	var $domDocument;
	var $db;

	//constructor
	function Payment() {
	
	}

	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}

	function setPaymentID($tempVar){
		$this->paymentID = $tempVar;
	}

	function setTdID($tempVar){
		$this->tdID = $tempVar;
	}
	function setDueID($tempVar){
		$this->dueID = $tempVar;
	}
	function setDueType($tempVar){
		$this->dueType = $tempVar;
	}

	function setBacktaxTDID($tempVar){
		$this->backtaxTDID = $tempVar;
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

	function setDueDate($tempVar){
		$this->dueDate = $tempVar;
	}
	function setPaymentDate($tempVar){
		$this->paymentDate = $tempVar;
	}
	function setOwnerID($tempVar){
		$this->ownerID = $tempVar;
	}
	function setStatus($tempVar){
		$this->status = $tempVar;
	}

	// non-db attributes

	function setTDNumber($tempVar){
		$this->tdNumber = $tempVar;
	}

	function setReceiptArray($tempVar){
		$this->receiptArray[] = $tempVar;
	}

	function setBasicReceipt($tempVar){
		$this->basicReceipt = $tempVar;
	}
	function setSefReceipt($tempVar){
		$this->sefReceipt = $tempVar;
	}
	function setIdleReceipt($tempVar){
		$this->idleReceipt = $tempVar;
	}
	function setPropertyClassification($tempVar){
		$this->propertyClassification = $tempVar;
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
	function setObjectDocNode($elementName,$obj,$indexNode){
		if($elementName!=""){
			$list = $this->domDocument->create_element($elementName);
			$list = $indexNode->append_child($list);
		}
		if (is_object($obj)){
			$domTmp = $obj->getDomDocument();
			$nodeTmp = $domTmp->document_element();
			$nodeClone = $nodeTmp->clone_node(true);
			if($elementName!=""){
				$list->append_child($nodeClone);
			}
			else{
				$indexNode->append_child($nodeClone);
			}
		}
	}
	function setDomDocument() {
		$this->domDocument = domxml_new_doc("1.0");
		$rec = $this->domDocument->create_element("Payment");
		$rec = $this->domDocument->append_child($rec);

		$this->setDocNode("paymentID",$this->paymentID,$this->domDocument,$rec);

		$this->setDocNode("tdID",$this->tdID,$this->domDocument,$rec);
		$this->setDocNode("dueID",$this->dueID,$this->domDocument,$rec);
		$this->setDocNode("dueType",$this->dueType,$this->domDocument,$rec);

		$this->setDocNode("backtaxTDID",$this->backtaxTDID,$this->domDocument,$rec);
   
		$this->setDocNode("taxDue",$this->taxDue,$this->domDocument,$rec);
		$this->setDocNode("earlyPaymentDiscount",$this->earlyPaymentDiscount,$this->domDocument,$rec);
		$this->setDocNode("advancedPaymentDiscount",$this->advancedPaymentDiscount,$this->domDocument,$rec);
		$this->setDocNode("penalty",$this->penalty,$this->domDocument,$rec);
		$this->setDocNode("amnesty",$this->amnesty,$this->domDocument,$rec);
		$this->setDocNode("balanceDue",$this->balanceDue,$this->domDocument,$rec);
		$this->setDocNode("amountPaid",$this->amountPaid,$this->domDocument,$rec);

		$this->setDocNode("dueDate",$this->dueDate,$this->domDocument,$rec);
		$this->setDocNode("paymentDate",$this->paymentDate,$this->domDocument,$rec);
		$this->setDocNode("ownerID",$this->ownerID,$this->domDocument,$rec);
		$this->setDocNode("status",$this->status,$this->domDocument,$rec);
	}
	function parseDomDocument($domDoc){
		$ret = true;
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				if ($child->tagname=="receiptArray"){
					$receiptNode = $child->first_child();

					while ($receiptNode){
						//if ($addressNode->tagname=="address") {
						if ($receiptNode->tagname) {
							$tempXmlStr = $domDoc->dump_node($receiptNode);
							$tempDomDoc = domxml_open_mem($tempXmlStr);
							$receipt = new Receipt;
							$ret = $receipt->parseDomDocument($tempDomDoc);
							$this->setReceiptArray($receipt);
						}
						$receiptNode = $receiptNode->next_sibling();
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

	function getPaymentID(){
		return $this->paymentID;
	}

	function getTdID(){
		return $this->tdID;
	}
	function getDueID(){
		return $this->dueID;
	}
	function getDueType(){
		return $this->dueType;
	}

	function getBacktaxTDID(){
		return $this->backtaxTDID;
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

	function getDueDate(){
		return $this->dueDate;
	}
	function getPaymentDate(){
		return $this->paymentDate;
	}
	function getOwnerID(){
		return $this->ownerID;
	}
	function getStatus(){
		return $this->status;
	}

	// non database related attribute:

	function getTDNumber(){
		if($this->tdID!=""){
			$sql = "SELECT taxDeclarationNumber as tdNumber FROM ".TD_TABLE." WHERE tdID='".$this->tdID."'";
		}
		else if($this->backtaxTDID!=""){
			$sql = "SELECT tdNumber as tdNumber FROM ".BACKTAXTD_TABLE." WHERE backtaxTDID='".$this->backtaxTDID."'";
		}
		else{
			return false;
		}

		$this->setDB();
		$this->db->query($sql);
		if ($this->db->next_record()){
			$this->tdNumber = $this->db->f("tdNumber");
			return $this->tdNumber;
		}
	}

	function getReceiptArray(){
		return $this->receiptArray;
	}

	function getBasicReceipt(){
		return $this->basicReceipt;
	}
	function getSefReceipt(){
		return $this->sefReceipt;
	}
	function getIdleReceipt(){
		return $this->idleReceipt;
	}
	function getPropertyClassification(){
		return $this->propertyClassification;
	}

	//DB
	function selectRecord($paymentID){
		if ($paymentID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE paymentID=%s;",
			PAYMENT_TABLE, $paymentID);
			$this->db->query($sql);

		if ($this->db->next_record()) {
			//*

			$this->paymentID = $this->db->f("paymentID");

			$this->tdID = $this->db->f("tdID");
			$this->dueID = $this->db->f("dueID");
			$this->dueType = $this->db->f("dueType");

			$this->backtaxTDID = $this->db->f("backtaxTDID");
   
			$this->taxDue = $this->db->f("taxDue");
			$this->earlyPaymentDiscount = $this->db->f("earlyPaymentDiscount");
			$this->advancedPaymentDiscount = $this->db->f("advancedPaymentDiscount");
			$this->penalty = $this->db->f("penalty");
			$this->amnesty = $this->db->f("amnesty");
			$this->balanceDue = $this->db->f("balanceDue");
			$this->amountPaid = $this->db->f("amountPaid");

			$this->dueDate = $this->db->f("dueDate");
			$this->paymentDate = $this->db->f("paymentDate");
			$this->ownerID = $this->db->f("ownerID");
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
		$sql = sprintf("SELECT paymentID FROM %s %s;",
			PAYMENT_TABLE, $condition);
			$this->db->query($sql);

		if ($this->db->next_record()) {
			$paymentID = $this->db->f("paymentID");
			return $this->selectRecord($paymentID);
		}
	}

	function insertRecord(){
		$sql = sprintf("insert into %s (".
			"paymentID".
			", tdID".
			", dueID".
			", dueType".
			", backtaxTDID".   
			", taxDue".
			", earlyPaymentDiscount".
			", advancedPaymentDiscount".
			", penalty".
			", amnesty".
			", balanceDue".
			", amountPaid".
			", dueDate".
			", paymentDate".
			", ownerID".
			", status".
			") ".
			"values ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');"
			, PAYMENT_TABLE
			, fixQuotes($this->paymentID)
			, fixQuotes($this->tdID)
			, fixQuotes($this->dueID)
			, fixQuotes($this->dueType)
			, fixQuotes($this->backtaxTDID)
			, fixQuotes($this->taxDue)
			, fixQuotes($this->earlyPaymentDiscount)
			, fixQuotes($this->advancedPaymentDiscount)
			, fixQuotes($this->penalty)
			, fixQuotes($this->amnesty)
			, fixQuotes($this->balanceDue)
			, fixQuotes($this->amountPaid)
			, fixQuotes($this->dueDate)
			, fixQuotes($this->paymentDate)
			, fixQuotes($this->ownerID)
			, fixQuotes($this->status)
		);

		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);

		$paymentID = $this->db->insert_id();
		$this->paymentID = $paymentID;

		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $paymentID;
		}
		
		//echo $sql;
		return $ret;
	}
	
	function deleteRecord($paymentID){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($paymentID);
		$sql = sprintf("delete from %s where paymentID=%s;",
			PAYMENT_TABLE, $paymentID);
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
			" paymentID = '%s'".
			", tdID = '%s'".
			", dueID = '%s'".
			", dueType = '%s'".
			", backtaxTDID = '%s'".
			", taxDue = '%s'".
			", earlyPaymentDiscount = '%s'".
			", advancedPaymentDiscount = '%s'".
			", penalty = '%s'".
			", amnesty = '%s'".
			", balanceDue = '%s'".
			", amountPaid = '%s'".
			", dueDate = '%s'".
			", paymentDate = '%s'".
			", ownerID = '%s'".
			", status = '%s'".
			" where paymentID = '%s'"
			, PAYMENT_TABLE
			, fixQuotes($this->paymentID)
			, fixQuotes($this->tdID)
			, fixQuotes($this->dueID)
			, fixQuotes($this->dueType)
			, fixQuotes($this->backtaxTDID)
			, fixQuotes($this->taxDue)
			, fixQuotes($this->earlyPaymentDiscount)
			, fixQuotes($this->advancedPaymentDiscount)
			, fixQuotes($this->penalty)
			, fixQuotes($this->amnesty)
			, fixQuotes($this->balanceDue)
			, fixQuotes($this->amountPaid)
			, fixQuotes($this->dueDate)
			, fixQuotes($this->paymentDate)
			, fixQuotes($this->ownerID)
			, fixQuotes($this->status)
			, fixQuotes($this->paymentID)
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
			$ret = $this->paymentID;
		}
		return $ret;
	}
	
}
?>