<?php
//include files
include_once "./TreasurySettings.php";

class BacktaxTD
{
	var $backtaxTDID;
	var $tdID;
	var $tdNumber;
	var $startYear;
	var $endYear;
	var $startQuarter;
	var $assessedValue;
	var $basicRate;
	var $sefRate;
	var $basicTax;
	var $sefTax;
	var $idleTax;
	var $penalties;
	var $paid;
	var $balance;
	var $paidStatus;
	var $total;
	var $dateCreated;
	var $createdBy;
	var $dateModified;
	var $modifiedBy;
	var $domDocument;
	var $db;
	var $quarterDue = Array(1=>"3",2=>"6",3=>"9",4=>"12");
	
	function TD(){

	}
	
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}

	function setBacktaxTDID($tempVar){
		$this->backtaxTDID = $tempVar;
	}
	function setTDID($tempVar){
		$this->tdID = $tempVar;
	}
	function setTdNumber($tempVar){
		$this->tdNumber = $tempVar;
	}
	function setStartYear($tempVar){
		$this->startYear = $tempVar;
	}
	function setEndYear($tempVar){
		$this->endYear = $tempVar;
	}
	function setStartQuarter($tempVar){
		$this->startQuarter = $tempVar;
	}
	function setAssessedValue($tempVar){
		$this->assessedValue = stripCommas($tempVar);
	}
	function setBasicRate($tempVar){
		$this->basicRate = stripCommas($tempVar);
	}
	function setSefRate($tempVar){
		$this->sefRate = stripCommas($tempVar);
	}
	function setBasicTax($tempVar){
		$this->basicTax = stripCommas($tempVar);
	}
	function setSefTax($tempVar){
		$this->sefTax = stripCommas($tempVar);
	}
	function setIdleTax($tempVar){
		$this->idleTax = stripCommas($tempVar);
	}
	function setPenalties($tempVar){
		$this->penalties = stripCommas($tempVar);
	}
	function setPaid($tempVar){
		$this->paid = stripCommas($tempVar);
	}
	function setBalance($tempVar){
		$this->balance = stripCommas($tempVar);
	}
	function setPaidStatus($tempVar){
		$this->paidStatus = $tempVar;
	}
	function setTotal($tempVar){
		$this->total = stripCommas($tempVar);
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
	//dom
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
	function setObjectDocNode($elementName,$elementObject,$domDoc,$indexNode,$className){
		//echo "class->".get_class($elementObject)."=".$className."<br>";
		if (is_a($elementObject,$className)){
			$nodeName = "";
			$nodeDomDoc = $elementObject->getDomDocument();
			$nodeObject = $nodeDomDoc->document_element();

			$nodeClone = $nodeObject->clone_node(true);
			
			$nodeName = $domDoc->create_element($elementName);
			$nodeName = $indexNode->append_child($nodeName);
			$nodeObject = $nodeName->append_child($nodeClone);
		}
	}
	function setDomDocument(){
		$this->domDocument = domxml_new_doc("1.0");
		$rec = $this->domDocument->create_element("BacktaxTD");
		$rec = $this->domDocument->append_child($rec);

		$this->setDocNode("backtaxTDID",$this->backtaxTDID,$this->domDocument,$rec);
		$this->setDocNode("tdID", $this->tdID, $this->domDocument, $rec);
		$this->setDocNode("tdNumber", $this->tdNumber, $this->domDocument, $rec);
		$this->setDocNode("startYear", $this->startYear, $this->domDocument, $rec);
		$this->setDocNode("endYear", $this->endYear, $this->domDocument, $rec);
		$this->setDocNode("startQuarter", $this->startQuarter, $this->domDocument, $rec);
		$this->setDocNode("assessedValue", $this->assessedValue, $this->domDocument, $rec);
		$this->setDocNode("basicRate", $this->basicRate, $this->domDocument, $rec);
		$this->setDocNode("sefRate", $this->sefRate, $this->domDocument, $rec);
		$this->setDocNode("basicTax", $this->basicTax, $this->domDocument, $rec);
		$this->setDocNode("sefTax", $this->sefTax, $this->domDocument, $rec);
		$this->setDocNode("idleTax", $this->idleTax, $this->domDocument, $rec);
		$this->setDocNode("penalties", $this->penalties, $this->domDocument, $rec);
		$this->setDocNode("paid", $this->paid, $this->domDocument, $rec);
		$this->setDocNode("balance", $this->balance, $this->domDocument, $rec);
		$this->setDocNode("paidStatus", $this->paidStatus, $this->domDocument, $rec);
		$this->setDocNode("total", $this->total, $this->domDocument, $rec);
		$this->setDocNode("dateCreated",$this->dateCreated,$this->domDocument,$rec);
		$this->setDocNode("createdBy",$this->createdBy,$this->domDocument,$rec);
		$this->setDocNode("dateModified",$this->dateModified,$this->domDocument,$rec);
		$this->setDocNode("modifiedBy",$this->modifiedBy,$this->domDocument,$rec);
	}
	
	function parseDomDocument($domDoc){
		$ret = true;
		if (is_object($domDoc)){
			$baseNode = $domDoc->document_element();
			if ($baseNode->has_child_nodes()){
				$child = $baseNode->first_child();
				while ($child){
					switch($child->tagname){
						default:
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
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}

	function getDomDocument(){
		return $this->domDocument;
	}

	//get

	function getBacktaxTDID(){
		return $this->backtaxTDID;
	}
	function getTDID(){
		return $this->tdID;
	}
	function getTdNumber(){
		$retVal = ($this->tdNumber == "")?"none":$this->tdNumber;
		return $retVal;
	}
	function getStartYear(){
		return $this->startYear;
	}
	function getEndYear(){
		return $this->endYear;
	}
	function getStartQuarter(){
		return $this->startQuarter;
	}
	function getAssessedValue(){
		return $this->assessedValue;
	}
	function getBasicRate(){
		return $this->basicRate;
	}
	function getSefRate(){
		return $this->sefRate;
	}
	function getBasicTax(){
		return $this->basicTax;
	}
	function getSefTax(){
		return $this->sefTax;
	}
	function getIdleTax(){
		return $this->idleTax;
	}
	function getPenalties(){
		return $this->penalties;
	}
	function getPaid(){
		return $this->paid;
	}
	function getBalance(){
		return $this->balance;
	}
	function getPaidStatus(){
		return $this->paidStatus;
	}
	function getTotal(){
		return $this->total;
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
	
	function getTotalTaxes(){
		$totalTaxes = 0;
		$totalTaxes += $this->basicTax;
		$totalTaxes += $this->sefTax;
		//$totalTaxes += $this->penalties;
		$totalTaxes += $this->idleTax;
		return $totalTaxes;
	}


	function getTotalTaxDue(){
		$totalTaxDue = 0;
		$totalTaxDue += $this->basicTax;
		$totalTaxDue += $this->sefTax;
		$totalTaxDue += $this->penalties;
		$totalTaxDue += $this->idleTax;

		$totalTaxDue = $totalTaxDue - $this->paid;

		// to zero out the -0 and the -0.01 etc..

		if($totalTaxDue<0) $totalTaxDue = 0;
		else if($totalTaxDue=="-0") $totalTaxDue = 0;

		return $totalTaxDue;
	}

	function calculateMonthOverDue($today=""){
		//$paid = 5;
		//$startYear = 1999;
		//$startQuarter = 1;

		switch($this->startQuarter){
			case 2:
				$dueDate = $this->startYear."-06-30";
				break;
			case 3:
				$dueDate = $this->startYear."-09-30";
				break;
			case 4:
				$dueDate = $this->startYear."-12-31";
				break;
			default:
				$dueDate = $this->startYear."-03-31";
				break;
		}

		$startYear = $this->startYear;

		$startQuarter = $this->startQuarter;
		$today = strtotime($today); // 2004-08-05
		$yearCalc = date("Y",$today);// 2004
		$monthCalc = date("n",$today);// 8
		$penalty = 0;
		$yearDiff = $yearCalc - $startYear;// 0

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


		$months = ($yearDiff * 12) + ($monthCalc - (($startQuarter-1)*3));
		return $months;
	}


	function calculatePenalty($penaltyComputeDate){
		// if() added September 23 2005
		// do not calculate penalties if encoded value is greater than 0
		if($this->penalties > 0){
			return true;
		}

		// initialize penaltyLUTArray
		$treasurySettings = new TreasurySettings;
		$treasurySettings->selectRecord();

		$penaltyLUTArray = $treasurySettings->getPenaltyLUT();
		$this->penaltyLUTArray = $treasurySettings->getPenaltyLUT();

		switch($this->startQuarter){
			case 2:
				$dueDate = $this->startYear."-06-30";
				break;
			case 3:
				$dueDate = $this->startYear."-09-30";
				break;
			case 4:
				$dueDate = $this->startYear."-12-31";
				break;
			default:
				$dueDate = $this->startYear."-".$treasurySettings->getAnnualDueDate();
				break;
		}

		if(strtotime($penaltyComputeDate) > strtotime($dueDate." 23:59:59")){
			// count months

			// numYears = today[year] - dueDate[year]
			$numYears = date("Y",strtotime($penaltyComputeDate)) - date("Y",strtotime($dueDate));
			// numMonths = today[month] - dueDate[month]
			$numMonths = date("n",strtotime($penaltyComputeDate)) - date("n",strtotime($dueDate));
			// totalMonths = (numYears*12) + numMonths

			$totalMonths = $this->calculateMonthOverDue(date("Y-m-d",strtotime($penaltyComputeDate)));

			//echo $totalMonths;
			//echo "<br>";

			// associate penaltyPercentage

			if($totalMonths >= 36) { //alxjvr:2005.12.07 count($this->penaltyLUTArray)-1){
				$penaltyPercentage = 0.72;
			}
			else{			
				$penaltyPercentage = $totalMonths * 0.02; //alxjvr:2005.12.07 $this->penaltyLUTArray[$totalMonths-1];
			}

			$taxDue = $this->basicTax + $this->sefTax + $this->idleTax;
			$penalty = $taxDue * $penaltyPercentage;
		}
		else{
			$penalty = 0;
		}
		$this->penalties = $penalty;
		return true;
	}	

	/*

	function calculatePenalty($paydeyt=""){
		//$paid = 5;
		//$startYear = 1999;
		//$startQuarter = 1;
		$paydeyt = strtotime($paydeyt);
		$yearCalc = date("Y",$paydeyt);
		$monthCalc = date("n",$paydeyt);
		$penalty = 0;

//		$yearDiff = strtotime($paydeyt) - strtotime($this->startYear);
		$yearDiff = $yearCalc - $this->startYear;


		//echo "paydeyt = ".$paydeyt."<br>";
		//echo "startYear = ".$startYear."<br>";
		//echo "startQuarter = ".$startQuarter."<br>";
		//echo "yearCalc = ".$yearCalc."<br>";
		//echo "monthCalc = ".$monthCalc."<br>";
		//echo "yearDiff = ".$yearDiff."<br>";
		if ($yearDiff > 0){
			if ($yearDiff <= 3){
				$months = ($yearDiff * ((4-($this->startQuarter-1))*3)) + $monthCalc;
				//echo "months formula : ($yearDiff * ((4-($startQuarter-1))*3)) + $monthCalc<br>";
				//echo "months = ".$months;
				$penalty = ($this->sefTax + $this->basicTax) * (0.02 * $months);
			}
			else{
				$penalty = (($this->sefTax + $this->basicTax) - $this->paid) * 0.72;
			}
			$this->penalties = $penalty;
		}
		else {
			$this->penalties = 0;
		}
		//echo "<br>penalty = ".$penalty;
		return true;
	}

	*/

	

	//db

	function selectRecord($tdID="",$backtaxTDID="",$startYear=""){
		if($backtaxTDID!=""){
			$condition = " backtaxTDID = '".$backtaxTDID."'";
		}
		else{
			$condition = " tdID = '".$tdID."'";
			if($startYear!=""){
				$condition .= " AND startYear = '".$startYear."' ";
			}
		}
		$this->setDB();

		$sql = sprintf("SELECT * FROM  %s WHERE %s;",
			BACKTAXTD_TABLE, $condition);

		//$dummySQL = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		//$this->db->query($dummySQL);

		$this->db->query($sql);

		if ($this->db->next_record()) {
			$this->backtaxTDID = $this->db->f("backtaxTDID");
			$this->tdID = $this->db->f("tdID");
			$this->tdNumber = $this->db->f("tdNumber");
			$this->startYear = $this->db->f("startYear");
			$this->endYear = $this->db->f("endYear");
			$this->startQuarter = $this->db->f("startQuarter");
			$this->assessedValue = $this->db->f("assessedValue");
			$this->basicRate = $this->db->f("basicRate");
			$this->sefRate = $this->db->f("sefRate");
			$this->basicTax = $this->db->f("basicTax");
			$this->sefTax = $this->db->f("sefTax");
			$this->idleTax = $this->db->f("idleTax");
			$this->penalties = $this->db->f("penalties");
			$this->paid = $this->db->f("paid");
			$this->balance = $this->db->f("balance");
			$this->paidStatus = $this->db->f("paidStatus");
			$this->total = $this->db->f("total");
			$this->dateCreated = $this->db->f("dateCreated");
			$this->createdBy = $this->db->f("createdBy");
			$this->dateModified = $this->db->f("dateModified");
			$this->modifiedBy = $this->db->f("modifiedBy");
			$this->setDomDocument();
			
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}

	function insertRecord(){
		$this->total = $this->getTotalTaxes();
		$sql = sprintf("insert into %s (".
			    "tdID".
				", tdNumber".
				", startYear".
				", endYear".
				", startQuarter".
				", assessedValue".
				", basicRate".
				", sefRate".
				", basicTax".
				", sefTax".
				", idleTax".
				", penalties".
				", paid".
				", balance".
				", total".
				", paidStatus".
				", dateCreated".
				", createdBy".
				", dateModified".
				", modifiedBy".
				") ".
				"values (".
				"'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				");",
			BACKTAXTD_TABLE
			, fixQuotes($this->tdID)
			, fixQuotes($this->tdNumber)
			, fixQuotes($this->startYear)
			, fixQuotes($this->endYear)
			, fixQuotes($this->startQuarter)
			, fixQuotes($this->assessedValue)
			, fixQuotes($this->basicRate)
			, fixQuotes($this->sefRate)
			, fixQuotes($this->basicTax)
			, fixQuotes($this->sefTax)
			, fixQuotes($this->idleTax)
			, fixQuotes($this->penalties)
			, fixQuotes($this->paid)
			, fixQuotes($this->balance)
			, fixQuotes($this->total)
			, fixQuotes($this->paidStatus)
			, fixQuotes(time())
			, fixQuotes($this->createdBy)
			, fixQuotes(time())
			, fixQuotes($this->modifiedBy)
			);
		// echo $sql;
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$backtaxTDID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $backtaxTDID;
		}
		return $ret;
	}
	
	function updateRecord(){
		$this->total = $this->getTotalTaxes();
		$sql = sprintf("update %s set".
				"  tdID = '%s'".
				", tdNumber = '%s'".
				", startYear = '%s'".
				", endYear = '%s'".
				", startQuarter = '%s'".
				", assessedValue = '%s'".
				", basicRate = '%s'".
				", sefRate = '%s'".
				", basicTax = '%s'".
				", sefTax = '%s'".
				", idleTax = '%s'".
				", penalties = '%s'".
				", paid = '%s'".
				", balance = '%s'".
				", total = '%s'".
				", paidStatus = '%s'".
				", dateModified = '%s'".
				", modifiedBy = '%s'".
				" where backtaxTDID = '%s';"
			, BACKTAXTD_TABLE
			, fixQuotes($this->tdID)
			, fixQuotes($this->tdNumber)
			, fixQuotes($this->startYear)
			, fixQuotes($this->endYear)
			, fixQuotes($this->startQuarter)
			, fixQuotes($this->assessedValue)
			, fixQuotes($this->basicRate)
			, fixQuotes($this->sefRate)
			, fixQuotes($this->basicTax)
			, fixQuotes($this->sefTax)
			, fixQuotes($this->idleTax)
			, fixQuotes($this->penalties)
			, fixQuotes($this->paid)
			, fixQuotes($this->balance)
			, fixQuotes($this->total)
			, fixQuotes($this->paidStatus)
			, fixQuotes(time())
			, fixQuotes($this->modifiedBy)
			, fixQuotes($this->backtaxTDID)

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
			$ret = $this->tdID;
			$this->setDomDocument();
		}
		return $ret;
	}

	function updatePaidStatus($paidStatus){
		$sql = sprintf("update %s set".
				"  paidStatus = '%s'".
				" where backtaxTDID = '%s';"
			, BACKTAXTD_TABLE
			, fixQuotes($paidStatus)
			, fixQuotes($this->backtaxTDID)

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
			$ret = $this->backtaxTDID;
			$this->setDomDocument();
		}
		return $ret;
	}

	function deleteRecord($backtaxTDID){
		$this->setDB();
		$this->db->beginTransaction();

		//$this->selectRecord($backtaxTDID);
		$sql = sprintf("delete from %s where backtaxTDID=%s;",
			BACKTAXTD_TABLE, $backtaxTDID);
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
