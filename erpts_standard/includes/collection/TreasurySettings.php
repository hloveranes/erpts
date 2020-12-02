<?php

include_once "../web/prepend.php";

class TreasurySettings
{
	//attributes

	var $penaltyLUT; //comma separated value (csv) to array
	var $annualDueDate;
	var $pctRPTax;
	var $pctSEF;
	var $pctIdle;
	var $discountPercentage;
	var $discountPeriod;
	var $advancedDiscountPercentage;
	var $q1AdvancedDiscountPercentage;

	var $domDocument;
	var $db;
	
	//constructor
	function TreasurySettings() {
	
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}

	function setPenaltyLUT($tempVar){
		if(is_array($tempVar)){
			$tempVar = arrayToCSV($tempVar);
		}
		$this->penaltyLUT = $tempVar;
	}
	function setAnnualDueDate($tempVar){
		$this->annualDueDate = $tempVar;
	}
	function setPctRPTax($tempVar){
		$this->pctRPTax = $tempVar;
	}
	function setPctSEF($tempVar){
		$this->pctSEF = $tempVar;
	}
	function setPctIdle($tempVar){
		$this->pctIdle = $tempVar;
	}
	function setDiscountPercentage($tempVar){
		$this->discountPercentage = $tempVar;
	}
	function setDiscountPeriod($tempVar){
		$this->discountPeriod = $tempVar;
	}
	function setAdvancedDiscountPercentage($tempVar){
		$this->advancedDiscountPercentage = $tempVar;
	}
	function setQ1AdvancedDiscountPercentage($tempVar){
		$this->q1AdvancedDiscountPercentage = $tempVar;
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
		$rec = $this->domDocument->create_element("TreasurySettings");
		$rec = $this->domDocument->append_child($rec);

		$this->setDocNode("penaltyLUT",$this->penaltyLUT,$this->domDocument,$rec);
		$this->setDocNode("annualDueDate",$this->annualDueDate,$this->domDocument,$rec);
		$this->setDocNode("pctRPTax",$this->pctRPTax,$this->domDocument,$rec);
		$this->setDocNode("pctSEF",$this->pctSEF,$this->domDocument,$rec);
		$this->setDocNode("pctIdle",$this->pctIdle,$this->domDocument,$rec);
		$this->setDocNode("discountPercentage",$this->discountPercentage,$this->domDocument,$rec);
		$this->setDocNode("discountPeriod",$this->discountPeriod,$this->domDocument,$rec);
		$this->setDocNode("advancedDiscountPercentage",$this->advancedDiscountPercentage,$this->domDocument,$rec);
		$this->setDocNode("q1AdvancedDiscountPercentage",$this->q1AdvancedDiscountPercentage,$this->domDocument,$rec);
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

	function getPenaltyLUT(){
		if(!is_array($this->penaltyLUT)){
			$this->penaltyLUT = csvToArray($this->penaltyLUT);
		}
		return $this->penaltyLUT;
	}
	function getAnnualDueDate(){
		return $this->annualDueDate;
	}
	function getPctRPTax(){
		return $this->pctRPTax;
	}
	function getPctSEF(){
		return $this->pctSEF;
	}
	function getPctIdle(){
		return $this->pctIdle;
	}
	function getDiscountPercentage(){
		return $this->discountPercentage;
	}
	function getDiscountPeriod(){
		return $this->discountPeriod;
	}
	function getAdvancedDiscountPercentage(){
		return $this->advancedDiscountPercentage;
	}
	function getQ1AdvancedDiscountPercentage(){
		return $this->q1AdvancedDiscountPercentage;
	}

	//DB

	function tableExists(){
		$this->setDB();
		$tablesArray = $this->db->table_names();
		foreach($tablesArray as $key=>$table){
			if($table["table_name"]==TREASURY_SETTINGS_TABLE){
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
			"penaltyLUT text NOT NULL,".
			"annualDueDate varchar(255) NOT NULL default '',".
			"pctRPTax varchar(255) NOT NULL default '',".
			"pctSEF varchar(255) NOT NULL default '',".
			"pctIdle varchar(255) NOT NULL default '',".
			"discountPercentage varchar(255) NOT NULL default '',".
			"discountPeriod varchar(255) NOT NULL default '',".
			"advancedDiscountPercentage varchar(255) NOT NULL default '',".
			"q1AdvancedDiscountPercentage varchar(255) NOT NULL default ''".
			");",
			TREASURY_SETTINGS_TABLE);

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
			TREASURY_SETTINGS_TABLE);

		$this->db->query($sql);

		if ($this->db->next_record()) {
			$ret = $this->db->f("count");
		}
		else $ret = false;
		return $ret;
	}

	function selectRecord(){
		$this->setDB();
		$sql = sprintf("SELECT * FROM %s;",
			TREASURY_SETTINGS_TABLE);

		$this->db->query($sql);

		if ($this->db->next_record()) {
			//*

			$this->penaltyLUT = $this->db->f("penaltyLUT");
			$this->annualDueDate = $this->db->f("annualDueDate");
			$this->pctRPTax = $this->db->f("pctRPTax");
			$this->pctSEF = $this->db->f("pctSEF");
			$this->pctIdle = $this->db->f("pctIdle");
			$this->discountPercentage = $this->db->f("discountPercentage");
			$this->discountPeriod = $this->db->f("discountPeriod");
			$this->advancedDiscountPercentage = $this->db->f("advancedDiscountPercentage");
			$this->q1AdvancedDiscountPercentage = $this->db->f("q1AdvancedDiscountPercentage");

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
			"penaltyLUT".
			", annualDueDate".
			", pctRPTax".
			", pctSEF".
			", pctIdle".
			", discountPercentage".
			", discountPeriod".
			", advancedDiscountPercentage".
			", q1AdvancedDiscountPercentage".
			") ".
			"values ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');"
			, TREASURY_SETTINGS_TABLE
			, fixQuotes($this->penaltyLUT)
			, fixQuotes($this->annualDueDate)
			, fixQuotes($this->pctRPTax)
			, fixQuotes($this->pctSEF)
			, fixQuotes($this->pctIdle)
			, fixQuotes($this->discountPercentage)
			, fixQuotes($this->discountPeriod)
			, fixQuotes($this->advancedDiscountPercentage)
			, fixQuotes($this->q1AdvancedDiscountPercentage)
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
			$ret = true;
		}
		return $ret;
	}
	
	function deleteRecord(){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord();
		$sql = sprintf("delete from %s;",
			TREASURY_SETTINGS_TABLE);
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
			" penaltyLUT = '%s'".
			", annualDueDate = '%s'".
			", pctRPTax = '%s'".
			", pctSEF = '%s'".
			", pctIdle = '%s'".
			", discountPercentage = '%s'".
			", discountPeriod = '%s'".
			", advancedDiscountPercentage = '%s'".
			", q1AdvancedDiscountPercentage = '%s'".
			";",
			TREASURY_SETTINGS_TABLE
			, fixQuotes($this->penaltyLUT)
			, fixQuotes($this->annualDueDate)
			, fixQuotes($this->pctRPTax)
			, fixQuotes($this->pctSEF)
			, fixQuotes($this->pctIdle)
			, fixQuotes($this->discountPercentage)
			, fixQuotes($this->discountPeriod)
			, fixQuotes($this->advancedDiscountPercentage)
			, fixQuotes($this->q1AdvancedDiscountPercentage)
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
