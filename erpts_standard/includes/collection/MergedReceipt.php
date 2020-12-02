<?php

include_once "../web/prepend.php";

class MergedReceipt
{
	//attributes

	var $mergedReceiptID;
	var $basicReceiptAmount;
	var $basicReceiptNumber;
	var $basicPreviousReceiptNumber;
	var $basicPreviousReceiptDate;
	var $basicReceiptIDCSV;
	var $sefReceiptAmount;
	var $sefReceiptNumber;
	var $sefPreviousReceiptNumber;
	var $sefPreviousReceiptDate;
	var $sefReceiptIDCSV;
	var $idleReceiptAmount;
	var $idleReceiptNumber;
	var $idlePreviousReceiptNumber;
	var $idlePreviousReceiptDate;
	var $idleReceiptIDCSV;
	var $paymentMode;
	var $checkNumber;
	var $dateOfCheck;
	var $draweeBank;
	var $cityTreasurer;
	var $deputyTreasurer;
	var $receiptDate;
	var $receivedFrom;
	var $receivedFromName;
	var $status;
	var $dateCreated;
	var $createdBy;
	var $dateModified;
	var $modifiedBy;

	var $MERGEDRECEIPT_TABLE;

	var $domDocument;
	var $db;
	
	//constructor
	function MergedReceipt() {
		// in case constants.php was not configured with proper value for MERGEDRECEIPT_TABLE
		if(defined("MERGEDRECEIPT_TABLE")){
			$this->MERGEDRECEIPT_TABLE = MERGEDRECEIPT_TABLE;
		}
		else{
			$this->MERGEDRECEIPT_TABLE = "MergedReceipt";
		}

		// in case table was not manually created in the database
		$this->createTable();
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}

	function setMergedReceiptID($tempVar){
		$this->mergedReceiptID = $tempVar;
	}
	function setBasicReceiptAmount($tempVar){
		$this->basicReceiptAmount = $tempVar;
	}
	function setBasicReceiptNumber($tempVar){
		$this->basicReceiptNumber = $tempVar;
	}
	function setBasicPreviousReceiptNumber($tempVar){
		$this->basicPreviousReceiptNumber = $tempVar;
	}
	function setBasicPreviousReceiptDate($tempVar){
		$this->basicPreviousReceiptDate = $tempVar;
	}
	function setBasicReceiptIDCSV($tempVar){
		$this->basicReceiptIDCSV = $tempVar;
	}
	function setSefReceiptAmount($tempVar){
		$this->sefReceiptAmount = $tempVar;
	}
	function setSefReceiptNumber($tempVar){
		$this->sefReceiptNumber = $tempVar;
	}
	function setSefPreviousReceiptNumber($tempVar){
		$this->sefPreviousReceiptNumber = $tempVar;
	}
	function setSefPreviousReceiptDate($tempVar){
		$this->sefPreviousReceiptDate = $tempVar;
	}
	function setSefReceiptIDCSV($tempVar){
		$this->sefReceiptIDCSV = $tempVar;
	}
	function setIdleReceiptAmount($tempVar){
		$this->idleReceiptAmount = $tempVar;
	}
	function setIdleReceiptNumber($tempVar){
		$this->idleReceiptNumber = $tempVar;
	}
	function setIdlePreviousReceiptNumber($tempVar){
		$this->idlePreviousReceiptNumber = $tempVar;
	}
	function setIdlePreviousReceiptDate($tempVar){
		$this->idlePreviousReceiptDate = $tempVar;
	}
	function setIdleReceiptIDCSV($tempVar){
		$this->idleReceiptIDCSV = $tempVar;
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
	function setCityTreasurer($tempVar){
		$this->cityTreasurer = $tempVar;
	}
	function setDeputyTreasurer($tempVar){
		$this->deputyTreasurer = $tempVar;
	}
	function setReceiptDate($tempVar){
		$this->receiptDate = $tempVar;
	}
	function setReceivedFrom($tempVar){
		$this->receivedFrom = $tempVar;
	}
	function setReceivedFromName($tempVar){
		$this->receivedFromName = $tempVar;
	}
	function setStatus($tempVar){
		$this->status = $tempVar;
	}
	function setDateCreated($tempVar){
		$this->dateCreated = $tempVar;
	}
	function setCreatedBy($tempVar){
		$this->createdBy = $tempVar;
	}
	function setDateModified($tempVar){
		$this->dateModified = $tempVar;
	}
	function setModifiedBy($tempVar){
		$this->modifiedBy = $tempVar;
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
		$rec = $this->domDocument->create_element("MergedReceipt");
		$rec = $this->domDocument->append_child($rec);

		$this->setDocNode("mergedReceiptID", $this->mergedReceiptID, $this->domDocument, $rec);
		$this->setDocNode("basicReceiptAmount", $this->basicReceiptAmount, $this->domDocument, $rec);
		$this->setDocNode("basicReceiptNumber", $this->basicReceiptNumber, $this->domDocument, $rec);
		$this->setDocNode("basicPreviousReceiptNumber", $this->basicPreviousReceiptNumber, $this->domDocument, $rec);
		$this->setDocNode("basicPreviousReceiptDate", $this->basicPreviousReceiptDate, $this->domDocument, $rec);
		$this->setDocNode("basicReceiptIDCSV", $this->basicReceiptIDCSV, $this->domDocument, $rec);
		$this->setDocNode("sefReceiptAmount", $this->sefReceiptAmount, $this->domDocument, $rec);
		$this->setDocNode("sefReceiptNumber", $this->sefReceiptNumber, $this->domDocument, $rec);
		$this->setDocNode("sefPreviousReceiptNumber", $this->sefPreviousReceiptNumber, $this->domDocument, $rec);
		$this->setDocNode("sefPreviousReceiptDate", $this->sefPreviousReceiptDate, $this->domDocument, $rec);
		$this->setDocNode("sefReceiptIDCSV", $this->sefReceiptIDCSV, $this->domDocument, $rec);
		$this->setDocNode("idleReceiptAmount", $this->idleReceiptAmount, $this->domDocument, $rec);
		$this->setDocNode("idleReceiptNumber", $this->idleReceiptNumber, $this->domDocument, $rec);
		$this->setDocNode("idlePreviousReceiptNumber", $this->idlePreviousReceiptNumber, $this->domDocument, $rec);
		$this->setDocNode("idlePreviousReceiptDate", $this->idlePreviousReceiptDate, $this->domDocument, $rec);
		$this->setDocNode("idleReceiptIDCSV", $this->idleReceiptIDCSV, $this->domDocument, $rec);
		$this->setDocNode("paymentMode", $this->paymentMode, $this->domDocument, $rec);
		$this->setDocNode("checkNumber", $this->checkNumber, $this->domDocument, $rec);
		$this->setDocNode("dateOfCheck", $this->dateOfCheck, $this->domDocument, $rec);
		$this->setDocNode("draweeBank", $this->draweeBank, $this->domDocument, $rec);
		$this->setDocNode("cityTreasurer", $this->cityTreasurer, $this->domDocument, $rec);
		$this->setDocNode("deputyTreasurer", $this->deputyTreasurer, $this->domDocument, $rec);
		$this->setDocNode("receiptDate", $this->receiptDate, $this->domDocument, $rec);
		$this->setDocNode("receivedFrom", $this->receivedFrom, $this->domDocument, $rec);
		$this->setDocNode("receivedFromName", $this->receivedFromName, $this->domDocument, $rec);
		$this->setDocNode("status", $this->status, $this->domDocument, $rec);
		$this->setDocNode("dateCreated", $this->dateCreated, $this->domDocument, $rec);
		$this->setDocNode("createdBy", $this->createdBy, $this->domDocument, $rec);
		$this->setDocNode("dateModified", $this->dateModified, $this->domDocument, $rec);
		$this->setDocNode("modifiedBy", $this->modifiedBy, $this->domDocument, $rec);
	}
	function parseDomDocument($domDoc){
		$ret = true;
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
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

	function getMergedReceiptID(){
		return $this->mergedReceiptID;
	}
	function getBasicReceiptAmount(){
		return $this->basicReceiptAmount;
	}
	function getBasicReceiptNumber(){
		return $this->basicReceiptNumber;
	}
	function getBasicPreviousReceiptNumber(){
		return $this->basicPreviousReceiptNumber;
	}
	function getBasicPreviousReceiptDate(){
		return $this->basicPreviousReceiptDate;
	}
	function getBasicReceiptIDCSV(){
		return $this->basicReceiptIDCSV;
	}
	function getSefReceiptAmount(){
		return $this->sefReceiptAmount;
	}
	function getSefReceiptNumber(){
		return $this->sefReceiptNumber;
	}
	function getSefPreviousReceiptNumber(){
		return $this->sefPreviousReceiptNumber;
	}
	function getSefPreviousReceiptDate(){
		return $this->sefPreviousReceiptDate;
	}
	function getSefReceiptIDCSV(){
		return $this->sefReceiptIDCSV;
	}
	function getIdleReceiptAmount(){
		return $this->idleReceiptAmount;
	}
	function getIdleReceiptNumber(){
		return $this->idleReceiptNumber;
	}
	function getIdlePreviousReceiptNumber(){
		return $this->idlePreviousReceiptNumber;
	}
	function getIdlePreviousReceiptDate(){
		return $this->idlePreviousReceiptDate;
	}
	function getIdleReceiptIDCSV(){
		return $this->idleReceiptIDCSV;
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
	function getCityTreasurer(){
		return $this->cityTreasurer;
	}
	function getDeputyTreasurer(){
		return $this->deputyTreasurer;
	}
	function getReceiptDate(){
		return $this->receiptDate;
	}
	function getReceivedFrom(){
		return $this->receivedFrom;
	}
	function getReceivedFromName(){
		return $this->receivedFromName;
	}
	function getStatus(){
		return $this->status;
	}
	function getDateCreated(){
		return $this->dateCreated;
	}
	function getCreatedBy(){
		return $this->createdBy;
	}
	function getDateModified(){
		return $this->dateModified;
	}
	function getModifiedBy(){
		return $this->modifiedBy;
	}

	//DB

	function tableExists(){
		$this->setDB();
		$tablesArray = $this->db->table_names();
		foreach($tablesArray as $key=>$table){
			if($table["table_name"]==$this->MERGEDRECEIPT_TABLE){
				return true;
			}
		}
		return false;
	}

	function createTable(){
		if($this->tableExists()){
			return false;
		}

		$sql = sprintf("CREATE TABLE %s (".
			"`mergedReceiptID` INT( 11 ) NOT NULL AUTO_INCREMENT ,".
			"`basicReceiptAmount` DOUBLE( 16, 2 ) NOT NULL ,".
			"`basicReceiptNumber` VARCHAR( 255 ) NOT NULL ,".
			"`basicPreviousReceiptNumber` VARCHAR( 255 ) NOT NULL ,".
			"`basicPreviousReceiptDate` DATE NOT NULL ,".
			"`basicReceiptIDCSV` VARCHAR( 255 ) NOT NULL ,".
			"`sefReceiptAmount` DOUBLE( 16, 2 ) NOT NULL ,".
			"`sefReceiptNumber` VARCHAR( 255 ) NOT NULL ,".
			"`sefPreviousReceiptNumber` VARCHAR( 255 ) NOT NULL ,".
			"`sefPreviousReceiptDate` DATE NOT NULL ,".
			"`sefReceiptIDCSV` VARCHAR( 255 ) NOT NULL ,".
			"`idleReceiptAmount` DOUBLE( 16, 2 ) NOT NULL ,".
			"`idleReceiptNumber` VARCHAR( 255 ) NOT NULL ,".
			"`idlePreviousReceiptNumber` VARCHAR( 255 ) NOT NULL ,".
			"`idlePreviousReceiptDate` DATE NOT NULL ,".
			"`idleReceiptIDCSV` VARCHAR( 255 ) NOT NULL ,".
			"`paymentMode` SET( 'cash', 'check', 'treasury note' ) NOT NULL ,".
			"`checkNumber` VARCHAR( 255 ) NOT NULL ,".
			"`dateOfCheck` DATE NOT NULL ,".
			"`draweeBank` VARCHAR( 255 ) NOT NULL ,".
			"`cityTreasurer` VARCHAR( 255 ) NOT NULL ,".
			"`deputyTreasurer` VARCHAR( 255 ) NOT NULL ,".
			"`receiptDate` DATE NOT NULL ,".
			"`receivedFrom` INT( 11 ) NOT NULL ,".
			"`receivedFromName` VARCHAR( 255 ) NOT NULL ,".
			"`status` VARCHAR( 32 ) NOT NULL ,".
			"`dateCreated` VARCHAR( 32 ) NOT NULL ,".
			"`createdBy` VARCHAR( 32 ) NOT NULL ,".
			"`dateModified` VARCHAR( 32 ) NOT NULL ,".
			"`modifiedBy` VARCHAR( 32 ) NOT NULL ,".
			"PRIMARY KEY ( `mergedReceiptID` ) ".
			");",
			$this->MERGEDRECEIPT_TABLE);

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
			$ret = true;
		}
		return $ret;
	}

	function countRecord(){
		$this->setDB();
		$sql = sprintf("SELECT COUNT(*) as count FROM %s;",
			SHARES_TABLE);

		$this->db->query($sql);

		if ($this->db->next_record()) {
			$ret = $this->db->f("count");
		}
		else $ret = false;
		return $ret;
	}

	function selectRecord($mergedReceiptID=""){
		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE mergedReceiptID='%s';",
			$this->MERGEDRECEIPT_TABLE,$mergedReceiptID);

		$this->db->query($sql);

		if ($this->db->next_record()) {
			//*
			$this->mergedReceiptID = $this->db->f("mergedReceiptID");
			$this->basicReceiptAmount = $this->db->f("basicReceiptAmount");
			$this->basicReceiptNumber = $this->db->f("basicReceiptNumber");
			$this->basicPreviousReceiptNumber = $this->db->f("basicPreviousReceiptNumber");
			$this->basicPreviousReceiptDate = $this->db->f("basicPreviousReceiptDate");
			$this->basicReceiptIDCSV = $this->db->f("basicReceiptIDCSV");
			$this->sefReceiptAmount = $this->db->f("sefReceiptAmount");
			$this->sefReceiptNumber = $this->db->f("sefReceiptNumber");
			$this->sefPreviousReceiptNumber = $this->db->f("sefPreviousReceiptNumber");
			$this->sefPreviousReceiptDate = $this->db->f("sefPreviousReceiptDate");
			$this->sefReceiptIDCSV = $this->db->f("sefReceiptIDCSV");
			$this->idleReceiptAmount = $this->db->f("idleReceiptAmount");
			$this->idleReceiptNumber = $this->db->f("idleReceiptNumber");
			$this->idlePreviousReceiptNumber = $this->db->f("idlePreviousReceiptNumber");
			$this->idlePreviousReceiptDate = $this->db->f("idlePreviousReceiptDate");
			$this->idleReceiptIDCSV = $this->db->f("idleReceiptIDCSV");
			$this->paymentMode = $this->db->f("paymentMode");
			$this->checkNumber = $this->db->f("checkNumber");
			$this->dateOfCheck = $this->db->f("dateOfCheck");
			$this->draweeBank = $this->db->f("draweeBank");
			$this->cityTreasurer = $this->db->f("cityTreasurer");
			$this->deputyTreasurer = $this->db->f("deputyTreasurer");
			$this->receiptDate = $this->db->f("receiptDate");
			$this->receivedFrom = $this->db->f("receivedFrom");
			$this->receivedFromName = $this->db->f("receivedFromName");
			$this->status = $this->db->f("status");
			$this->dateCreated = $this->db->f("dateCreated");
			$this->createdBy = $this->db->f("createdBy");
			$this->dateModified = $this->db->f("dateModified");
			$this->modifiedBy = $this->db->f("modifiedBy");

			//*/
			foreach ($this->db->Record as $key => $value){
				$this->$key = $value;
			}
			//$this->setDomDocument();
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}
	
	function insertRecord(){
		$sql = sprintf("insert into %s (".
			"basicReceiptAmount".
			",basicReceiptNumber".
			",basicPreviousReceiptNumber".
			",basicPreviousReceiptDate".
			",basicReceiptIDCSV".
			",sefReceiptAmount".
			",sefReceiptNumber".
			",sefPreviousReceiptNumber".
			",sefPreviousReceiptDate".
			",sefReceiptIDCSV".
			",idleReceiptAmount".
			",idleReceiptNumber".
			",idlePreviousReceiptNumber".
			",idlePreviousReceiptDate".
			",idleReceiptIDCSV".
			",paymentMode".
			",checkNumber".
			",dateOfCheck".
			",draweeBank".
			",cityTreasurer".
			",deputyTreasurer".
			",receiptDate".
			",receivedFrom".
			",receivedFromName".
			",status".
			",dateCreated".
			",createdBy".
			",dateModified".
			",modifiedBy".
			") ".
			"values ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',NOW(),'%s',NOW(),'%s');"
			, $this->MERGEDRECEIPT_TABLE
			, fixQuotes($this->basicReceiptAmount)
			, fixQuotes($this->basicReceiptNumber)
			, fixQuotes($this->basicPreviousReceiptNumber)
			, fixQuotes($this->basicPreviousReceiptDate)
			, fixQuotes($this->basicReceiptIDCSV)
			, fixQuotes($this->sefReceiptAmount)
			, fixQuotes($this->sefReceiptNumber)
			, fixQuotes($this->sefPreviousReceiptNumber)
			, fixQuotes($this->sefPreviousReceiptDate)
			, fixQuotes($this->sefReceiptIDCSV)
			, fixQuotes($this->idleReceiptAmount)
			, fixQuotes($this->idleReceiptNumber)
			, fixQuotes($this->idlePreviousReceiptNumber)
			, fixQuotes($this->idlePreviousReceiptDate)
			, fixQuotes($this->idleReceiptIDCSV)
			, fixQuotes($this->paymentMode)
			, fixQuotes($this->checkNumber)
			, fixQuotes($this->dateOfCheck)
			, fixQuotes($this->draweeBank)
			, fixQuotes($this->cityTreasurer)
			, fixQuotes($this->deputyTreasurer)
			, fixQuotes($this->receiptDate)
			, fixQuotes($this->receivedFrom)
			, fixQuotes($this->receivedFromName)
			, fixQuotes($this->status)
			, fixQuotes($this->createdBy)
			, fixQuotes($this->modifiedBy)
		);

		$this->setDB();

		$this->db->beginTransaction();
		$this->db->query($sql);
		$mergedReceiptID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $mergedReceiptID;
		}
		
		return $ret;
	}
	
	function deleteRecord(){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord();
		$sql = sprintf("delete from %s;",
			$this->MERGEDRECEIPT_TABLE);
		$this->db->query($sql);
		$affectedRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $affectedRows;
		}
		return $ret;
	}
	
	function updateRecord(){
		$sql = sprintf("update %s set".
			" basicReceiptAmount = '%s'".
			", basicReceiptNumber = '%s'".
			", basicPreviousReceiptNumber = '%s'".
			", basicPreviousReceiptDate = '%s'".
			", basicReceiptIDCSV = '%s'".
			", sefReceiptAmount = '%s'".
			", sefReceiptNumber = '%s'".
			", sefPreviousReceiptNumber = '%s'".
			", sefPreviousReceiptDate = '%s'".
			", sefReceiptIDCSV = '%s'".
			", idleReceiptAmount = '%s'".
			", idleReceiptNumber = '%s'".
			", idlePreviousReceiptNumber = '%s'".
			", idlePreviousReceiptDate = '%s'".
			", idleReceiptIDCSV = '%s'".
			", paymentMode = '%s'".
			", checkNumber = '%s'".
			", dateOfCheck = '%s'".
			", draweeBank = '%s'".
			", cityTreasurer = '%s'".
			", deputyTreasurer = '%s'".
			", receiptDate = '%s'".
			", receivedFrom = '%s'".
			", receivedFromName = '%s'".
			", status = '%s'".
			", dateModified = NOW()".
			", modifiedBy = '%s'".
			" WHERE mergedReceiptID='%s' ".
			";",
			$this->MERGEDRECEIPT_TABLE
			, fixQuotes($this->basicReceiptAmount)
			, fixQuotes($this->basicReceiptNumber)
			, fixQuotes($this->basicPreviousReceiptNumber)
			, fixQuotes($this->basicPreviousReceiptDate)
			, fixQuotes($this->basicReceiptIDCSV)
			, fixQuotes($this->sefReceiptAmount)
			, fixQuotes($this->sefReceiptNumber)
			, fixQuotes($this->sefPreviousReceiptNumber)
			, fixQuotes($this->sefPreviousReceiptDate)
			, fixQuotes($this->sefReceiptIDCSV)
			, fixQuotes($this->idleReceiptAmount)
			, fixQuotes($this->idleReceiptNumber)
			, fixQuotes($this->idlePreviousReceiptNumber)
			, fixQuotes($this->idlePreviousReceiptDate)
			, fixQuotes($this->idleReceiptIDCSV)
			, fixQuotes($this->paymentMode)
			, fixQuotes($this->checkNumber)
			, fixQuotes($this->dateOfCheck)
			, fixQuotes($this->draweeBank)
			, fixQuotes($this->cityTreasurer)
			, fixQuotes($this->deputyTreasurer)
			, fixQuotes($this->receiptDate)
			, fixQuotes($this->receivedFrom)
			, fixQuotes($this->receivedFromName)
			, fixQuotes($this->status)
			, fixQuotes($this->modifiedBy)
			, fixQuotes($this->mergedReceiptID)
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
			$ret = true;
		}
		return $ret;
	}
	
}
?>