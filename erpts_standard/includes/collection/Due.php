<?php

class Due
{
	//attributes
	var $dueID;
	var $tdID;
	var $dueType; // SET("Annual", "Q1", "Q2", "Q3", "Q4")
	var $dueDate;
	var $basicTax;
	var $basicTaxRate;
	var $sefTax;
	var $sefTaxRate;
	var $idleTax;
	var $idleTaxRate;

	// attributes not stored in the database table

	var $taxDue;
	var $initialNetDue;

	var $earlyPaymentDiscountPeriod;
	var $earlyPaymentDiscountPercentage;
	var $earlyPaymentDiscount;

	var $advancedPaymentDiscountPercentage;
	var $advancedPaymentDiscount;

	var $monthsOverDue;
	var $penaltyPercentage;
	var $penalty;

	var $domDocument;
	var $db;

	//constructor
	function Due() {
	
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}

	function setDueID($tempVar){
		$this->dueID = $tempVar;
	}
	function setTdID($tempVar){
		$this->tdID = $tempVar;
	}
	function setDueType($tempVar){
		$this->dueType = $tempVar;
	}
	function setDueDate($tempVar){
		$this->dueDate = $tempVar;
	}
	function setBasicTax($tempVar){
		$this->basicTax = $tempVar;
	}
	function setBasicTaxRate($tempVar){
		$this->basicTaxRate = $tempVar;
	}
	function setSefTax($tempVar){
		$this->sefTax = $tempVar;
	}
	function setSefTaxRate($tempVar){
		$this->sefTaxRate = $tempVar;
	}
	function setIdleTax($tempVar){
		$this->idleTax = $tempVar;
	}
	function setIdleTaxRate($tempVar){
		$this->idleTaxRate = $tempVar;
	}

	// non-db set methods

	function setAdvancedPaymentDiscountPercentage($tempVar){
		$this->advancedPaymentDiscountPercentage = $tempVar;
	}
	function setAdvancedPaymentDiscount($tempVar){
		$this->advancedPaymentDiscount = $tempVar;
	}
	function setEarlyPaymentDiscountPeriod($tempVar){
		$this->earlyPaymentDiscountPeriod = $tempVar;
	}
	function setEarlyPaymentDiscountPercentage($tempVar){
		$this->earlyPaymentDiscountPercentage = $tempVar;
	}
	function setEarlyPaymentDiscount($tempVar){
		$this->earlyPaymentDiscount = $tempVar;
	}
	function setMonthsOverDue($tempVar){
		$this->monthsOverDue = $tempVar;
	}
	function setPenaltyPercentage($tempVar){
		$this->penaltyPercentage = $tempVar;
	}
	function setPenalty($tempVar){
		$this->penalty = $tempVar;
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
		$rec = $this->domDocument->create_element("Due");
		$rec = $this->domDocument->append_child($rec);

		$this->setDocNode("dueID",$this->dueID,$this->domDocument,$rec);
		$this->setDocNode("tdID",$this->tdID,$this->domDocument,$rec);
		$this->setDocNode("dueType",$this->dueType,$this->domDocument,$rec);
		$this->setDocNode("dueDate",$this->dueDate,$this->domDocument,$rec);
		$this->setDocNode("basicTax",$this->basicTax,$this->domDocument,$rec);
		$this->setDocNode("basicTaxRate",$this->basicTaxRate,$this->domDocument,$rec);
		$this->setDocNode("sefTax",$this->sefTax,$this->domDocument,$rec);
		$this->setDocNode("sefTaxRate",$this->sefTaxRate,$this->domDocument,$rec);
		$this->setDocNode("idleTax",$this->idleTax,$this->domDocument,$rec);
		$this->setDocNode("idleTaxRate",$this->idleTaxRate,$this->domDocument,$rec);
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

	function getDueID(){
		return $this->dueID;
	}
	function getTdID(){
		return $this->tdID;
	}
	function getDueType(){
		return $this->dueType;
	}
	function getDueDate(){
		return $this->dueDate;
	}
	function getBasicTax(){
		return $this->basicTax;
	}
	function getBasicTaxRate(){
		return $this->basicTaxRate;
	}
	function getSefTax(){
		return $this->sefTax;
	}
	function getSefTaxRate(){
		return $this->sefTaxRate;
	}
	function getIdleTax(){
		return $this->idleTax;
	}
	function getIdleTaxRate(){
		return $this->idleTaxRate;
	}

	// non db get functions

	function getTaxDue(){
		return $this->basicTax + $this->sefTax + $this->idleTax;
	}
	function getInitialNetDue(){
		$discount = 0;
		if($this->advancedPaymentDiscount > 0){
			$discount = $this->advancedPaymentDiscount;
		}
		else if($this->earlyPaymentDiscount > 0){
			$discount = $this->earlyPaymentDiscount;
		}
		return (($this->basicTax + $this->sefTax + $this->idleTax) - ($discount)) + $this->penalty;
	}

	// non-db set methods

	function getAdvancedPaymentDiscountPercentage(){
		return $this->advancedPaymentDiscountPercentage;
	}
	function getAdvancedPaymentDiscount(){
		return $this->advancedPaymentDiscount;
	}
	function getEarlyPaymentDiscountPeriod(){
		return $this->earlyPaymentDiscountPeriod;
	}
	function getEarlyPaymentDiscountPercentage(){
		return $this->earlyPaymentDiscountPercentage;
	}
	function getEarlyPaymentDiscount(){
		return $this->earlyPaymentDiscount;
	}
	function getMonthsOverDue(){
		return $this->monthsOverDue;
	}
	function getPenaltyPercentage(){
		return $this->penaltyPercentage;
	}
	function getPenalty(){
		return $this->penalty;
	}

	// discount functions

	function getDiscountPeriodStart(){
		$discountPeriodStartArr = array("Annual"=>"January 1","Q1"=>"January 1","Q2"=>"April 1","Q3"=>"July 1","Q4"=>"October 1"); 
		$discountPeriodStart = $discountPeriodStartArr[$this->dueType] . ", " . date("Y", strtotime($this->dueDate));
		return strtotime($discountPeriodStart);
	}

	function getDiscountPeriodEnd(){
		$discountPeriodEndArr = array("Annual"=>"March 31","Q1"=>"March 31","Q2"=>"June 30","Q3"=>"September 30","Q4"=>"December 31"); 
		$discountPeriodEnd = $discountPeriodEndArr[$this->dueType] . ", " . date("Y", strtotime($this->dueDate));;
		return strtotime($discountPeriodEnd);
	}

	// calculate functions

	function calculateMonthOverDue($today=""){
		//$paid = 5;
		//$startYear = 1999;
		//$startQuarter = 1;

		$startYear = date("Y",strtotime($this->dueDate));// 2004

		//$startYear = 2005;
		$quarterArr = array("Annual"=>1,"Q1"=>1,"Q2"=>2,"Q3"=>3,"Q4"=>4); 
		// alxjvr:2005.12.07 $startQuarter = $quarterArr[$this->dueType]; // 1
		$startQuarter = $quarterArr[$this->dueType]; // 1
		$today = strtotime($today); // 2004-08-05

		$yearCalc = date("Y",$today);// 2004
		$monthCalc = date("n",$today);// 8
/*
		echo ' : startYear = '.$yearCalc.'<br>';
		echo ' : startQuarter = '.$startQuarter.'<br>';

		echo ' : yearCalc = '.$yearCalc.'<br>';
		echo ' : monthCalc = '.$monthCalc.'<br>';
*/
		$penalty = 0;
		$yearDiff = $yearCalc - $startYear;// 0

//		echo ' : yearDiff = '.$yearDiff.'<br>';

		$months = 0;

		/*

		echo "startYear:".$startYear."<br>";
		echo "quarterArr:".$quarterArr."<br>";
		echo "startQuarter:".$startQuarter."<br>";
		echo "today:".$today."<br>";
		echo "yearCalc:".$yearCalc."<br>";
		echo "monthCalc:".$monthCalc."<br>";
		echo "penalty:".$penalty."<br>";
		echo "yearDiff:".$yearDiff."<br>";
		echo "months:".$months."<br>";



		*/

		//alxjvr:2005.12.07 $months = ($yearDiff * 12) + ($monthCalc - (($startQuarter-1)*3));
		$months = ($yearDiff * 12) + $monthCalc;

		return $months;
	}

	//DB
	function selectRecord($dueID){
		if ($dueID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE dueID=%s;",
			DUE_TABLE, $dueID);
			$this->db->query($sql);

		if ($this->db->next_record()) {
			//*

			$this->dueID = $this->db->f("dueID");
			$this->tdID = $this->db->f("tdID");
			$this->dueType = $this->db->f("dueType");
			$this->dueDate = $this->db->f("dueDate");	
			$this->basicTax = $this->db->f("basicTax");
			$this->basicTaxRate = $this->db->f("basicTaxRate");
			$this->sefTax = $this->db->f("sefTax");
			$this->sefTaxRate = $this->db->f("sefTaxRate");
			$this->idleTax = $this->db->f("idleTax");
			$this->idleTaxRate = $this->db->f("idleTaxRate");

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
		$sql = sprintf("SELECT * FROM %s %s;",
			DUE_TABLE, $condition);
			$this->db->query($sql);

		if ($this->db->next_record()) {
			//*
			$this->dueID = $this->db->f("dueID");
			$this->tdID = $this->db->f("tdID");
			$this->dueType = $this->db->f("dueType");
			$this->dueDate = $this->db->f("dueDate");	
			$this->basicTax = $this->db->f("basicTax");
			$this->basicTaxRate = $this->db->f("basicTaxRate");
			$this->sefTax = $this->db->f("sefTax");
			$this->sefTaxRate = $this->db->f("sefTaxRate");
			$this->idleTax = $this->db->f("idleTax");
			$this->idleTaxRate = $this->db->f("idleTaxRate");

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
			"dueID".
			", tdID".
			", dueType".
			", dueDate".
			", basicTax".
			", basicTaxRate".
			", sefTax".
			", sefTaxRate".
			", idleTax".
			", idleTaxRate".
			") ".
			"values ('%s', '%s', '%s', '%s', '%s', '%s', '%s', %s, '%s', '%s');"
			, DUE_TABLE
			, fixQuotes($this->dueID)
			, fixQuotes($this->tdID)
		    , fixQuotes($this->dueType)	
			, toMysqlDate($this->dueDate)
			, fixQuotes($this->basicTax)
			, fixQuotes($this->basicTaxRate)
			, fixQuotes($this->sefTax)
			, fixQuotes($this->sefTaxRate)
			, fixQuotes($this->idleTax)
			, fixQuotes($this->idleTaxRate)
		);
	
		$this->setDB();

		$this->db->beginTransaction();
		$this->db->query($sql);
		$dueID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $dueID;
		}
		
		//echo $sql;
		return $ret;
	}
	
	function deleteRecord($dueID){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($dueID);
		$sql = sprintf("delete from %s where dueID=%s;",
			DUE_TABLE, $dueID);
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
			" dueID = '%s'".
			", tdID = '%s'".
			", dueType = '%s'".
			", dueDate = '%s'".
			", basicTax = '%s'".
			", basicTaxRate = '%s'".
			", sefTax = '%s'".
			", sefTaxRate = '%s'".
			", idleTax = '%s'".
			", idleTaxRate = '%s'".
			" where dueID = '%s';",
			DUE_TABLE
			, fixQuotes($this->dueID)
			, fixQuotes($this->tdID)
			, fixQuotes($this->dueType)
			, toMysqlDate($this->dueDate)
			, fixQuotes($this->basicTax)
			, fixQuotes($this->basicTaxRate)
			, fixQuotes($this->sefTax)
			, fixQuotes($this->sefTaxRate)
			, fixQuotes($this->idleTax)
			, fixQuotes($this->idleTaxRate)
			, fixQuotes($this->dueID)
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
			$ret = $this->dueID;
		}
		return $ret;
	}
	
}
?>
