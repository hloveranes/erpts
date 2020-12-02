<?php
//include files
include_once "./TDRecords.php";
include_once "./TD.php";
include_once "./Owner.php";
class RPTOP
{
	//attributes
	var $rptopID;
	var $rptopNumber;
	var $rptopDate;
	var $owner;//Owner Object
	var $taxableYear;
	var $cityTreasurer;
	var $cityAssessor;
	var $tdArray;
	var $landTotalMarketValue;
	var $landTotalAssessedValue;
	var $plantTotalMarketValue;
	var $plantTotalAssessedValue;
	var $bldgTotalMarketValue;
	var $bldgTotalAssessedValue;
	var $machTotalMarketValue;
	var $machTotalAssessedValue;
	var $totalMarketValue;
	var $totalAssessedValue;
	var $dateCreated;
	var $createdBy;
	var $dateModified;
	var $modifiedBy;
    var $archive;
	var $domDocument;
	var $earliestYear = 1900;
	//constructor
	function RPTOP(){
	}
	
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}
		
	function setRptopID($tempVar){
		$this->rptopID = $tempVar;
	}
	function setRptopNumber($tempVar){
		$this->rptopNumber = $tempVar;
	}
	function setRptopdate($tempVar){
		$this->rptopDate = $tempVar;
	}
	function setOwner($tempVar){
		$this->owner = ($tempVar);
	}
	function setTaxableYear($tempVar){
		$this->taxableYear = $tempVar;
	}
	function setCityTreasurer($tempVar){
		$this->cityTreasurer = $tempVar;
	}
	function setCityAssessor($tempVar){
		$this->cityAssessor = $tempVar;
	}
	function setTdArray($tempVar){
		$this->tdArray[] = $tempVar;
	}
	function setLandTotalMarketValue ($tempVar) {
		$this->landTotalMarketValue = $tempVar;
	}
	function setLandTotalAssessedValue ($tempVar) {
		$this->landTotalAssessedValue = $tempVar;
	}
	function setPlantTotalMarketValue ($tempVar) {
		$this->plantTotalMarketValue = $tempVar;
	}
	function setPlantTotalPlantAssessedValue ($tempVar) {
		$this->plantTotalAssessedValue = $tempVar;
	}
	function setBldgTotalMarketValue ($tempVar) {
		$this->bldgTotalMarketValue = $tempVar;
	}
	function setBldgTotalAssessedValue ($tempVar) {
		$this->bldgTotalAssessedValue = $tempVar;
	}
	function setMachTotalMarketValue ($tempVar) {
		$this->machTotalMarketValue = $tempVar;
	}
	function setMachTotalAssessedValue ($tempVar) {
		$this->machTotalAssessedValue = $tempVar;
	}
	function setTotalMarketValue ($tempVar) {
		$this->totalMarketValue = $tempVar;
	}
	function setTotalAssessedValue ($tempVar) {
		$this->totalAssessedValue = $tempVar;
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
	function setArchive($tempVar){
		$this->archive = $tempVar;
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
	function setDocNode($elementName,$elementValue,$domDoc,$indexNode){
		$nodeName = "";
		$nodeText = "";
		$nodeName = $domDoc->create_element($elementName);
		$nodeName = $indexNode->append_child($nodeName);
		$nodeText = $domDoc->create_text_node(htmlentities($elementValue));
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
	function setDomDocument (){
		$this->domDocument = domxml_new_doc("1.0");
		$rec = $this->domDocument->create_element("RPTOP");
		$rec = $this->domDocument->append_child($rec);
		$this->setDocNode("rptopID",$this->rptopID,$this->domDocument,$rec);
		$this->setDocNode("rptopNumber",$this->rptopNumber,$this->domDocument,$rec);
		$this->setDocNode("rptopDate",$this->rptopDate,$this->domDocument,$rec);
		if (is_a($this->owner,Owner)&&($this->owner<>"")){
			$this->setObjectDocNode("owner",$this->owner,$this->domDocument,$rec,"Owner");
		}
		$this->setDocNode("taxableYear",$this->taxableYear,$this->domDocument,$rec);
		$this->setDocNode("cityTreasurer",$this->cityTreasurer,$this->domDocument,$rec);
		$this->setDocNode("cityAssessor",$this->cityAssessor,$this->domDocument,$rec);
		if (count($this->tdArray))
			$this->setArrayDocNode("tdArray",$this->tdArray,$rec);
		$this->setDocNode("landTotalMarketValue",$this->landTotalMarketValue,$this->domDocument,$rec);
		$this->setDocNode("landTotalAssessedValue",$this->landTotalAssessedValue,$this->domDocument,$rec);
		$this->setDocNode("plantTotalMarketValue",$this->plantTotalMarketValue,$this->domDocument,$rec);
		$this->setDocNode("plantTotalAssessedValue",$this->plantTotalAssessedValue,$this->domDocument,$rec);
		$this->setDocNode("bldgTotalMarketValue",$this->bldgTotalMarketValue,$this->domDocument,$rec);
		$this->setDocNode("bldgTotalAssessedValue",$this->bldgTotalAssessedValue,$this->domDocument,$rec);
		$this->setDocNode("machTotalMarketValue",$this->machTotalMarketValue,$this->domDocument,$rec);
		$this->setDocNode("machTotalAssessedValue",$this->machTotalAssessedValue,$this->domDocument,$rec);
		$this->setDocNode("totalMarketValue",$this->totalMarketValue,$this->domDocument,$rec);
		$this->setDocNode("totalAssessedValue",$this->totalAssessedValue,$this->domDocument,$rec);
		$this->setDocNode("dateCreated",$this->dateCreated,$this->domDocument,$rec);
		$this->setDocNode("createdBy",$this->createdBy,$this->domDocument,$rec);
		$this->setDocNode("dateModified",$this->dateModified,$this->domDocument,$rec);
		$this->setDocNode("modifiedBy",$this->modifiedBy,$this->domDocument,$rec);
		$this->setDocNode("archive",$this->archive,$this->domDocument,$rec);
	}
	
	function parseDomDocument($domDoc){
		//echo "<br>parsing<br>";
		$ret = true;
		if (is_object($domDoc)){
			$baseNode = $domDoc->document_element();
			if ($baseNode->has_child_nodes()){
				$child = $baseNode->first_child();
				while ($child){
					switch($child->tagname){
						case "owner":
							//echo "owner<br>";
							$ownerNode = $child->first_child();
							while ($ownerNode){
								//if ($ownerNode->tagname=="Owner") {
								if ($ownerNode->tagname) {
									$tempXmlStr = $domDoc->dump_node($ownerNode);
									$tempDomDoc = domxml_open_mem($tempXmlStr);
									$owner = new Owner;
									$ret = $owner->parseDomDocument($tempDomDoc);
									$this->owner = $owner;
								}
								$ownerNode = $ownerNode->next_sibling();
							}
							break;
						case "tdArray":
							$tdNode = $child->first_child();
							while ($tdNode){
								//if ($tdNode->tagname=="TD") {
								if ($tdNode->tagname) {
									$tempXmlStr = $domDoc->dump_node($tdNode);
									$tempDomDoc = domxml_open_mem($tempXmlStr);
									$td = new TD;
									$ret = $td->parseDomDocument($tempDomDoc);
									$this->setTdArray($td);
								}
								$tdNode = $tdNode->next_sibling();
							}
						break;	
						default:
							//eval("\$this->".$child->tagname."= \"".$child->get_content()."\";");

							// test varvars
							$varvar = $child->tagname;
							$this->$varvar = html_entity_decode($child->get_content());
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
	function getRptopID(){
		return $this->rptopID;
	}
	function getRptopNumber(){
		return $this->rptopNumber;
	}
	function getRptopdate(){
		return $this->rptopDate;
	}
	function getOwner(){
		return $this->owner;
	}
	function getTaxableYear(){
		return $this->taxableYear;
	}
	function getCityTreasurer(){
		return $this->cityTreasurer;
	}
	function getCityAssessor(){
		return $this->cityAssessor;
	}
	function getTdArray(){
		return $this->tdArray;
	}
	function getLandTotalMarketValue () {
		return $this->landTotalMarketValue;
	}
	function getLandTotalAssessedValue () {
		return $this->landTotalAssessedValue;
	}
	function getPlantTotalMarketValue () {
		return $this->plantTotalMarketValue;
	}
	function getPlantTotalPlantAssessedValue () {
		return $this->plantTotalAssessedValue;
	}
	function getBldgTotalMarketValue () {
		return $this->bldgTotalMarketValue;
	}
	function getBldgTotalAssessedValue () {
		return $this->bldgTotalAssessedValue;
	}
	function getMachTotalMarketValue () {
		return $this->machTotalMarketValue;
	}
	function getMachTotalAssessedValue () {
		return $this->machTotalAssessedValue;
	}
	function getTotalMarketValue () {
		return $this->totalMarketValue;
	}
	function getTotalAssessedValue () {
		return $this->totalAssessedValue;
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
	function getArchive(){
		return $this->archive;
	}
	function getEarliestYear(){
		return $this->earliestYear;
	}
	//DB functions
	function selectRecord($rptopID){
		if ($rptopID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM  %s WHERE rptopID=%s;",
			RPTOP_TABLE, $rptopID);
		$this->db->query($sql);
		//echo $sql;
		$rptop = new RPTOP;
		if ($this->db->next_record()) {
			foreach ($this->db->Record as $key => $value){
				switch ($key){
					default:
					$this->$key = $value;
				}
			}
			///*
			$sql = sprintf("SELECT ownerID FROM %s WHERE rptopID = %s;",
				OWNER_TABLE, $rptopID);
			$this->db->query($sql);
			//echo $sql;
			while ($this->db->next_record()) {
				$owner = new Owner;
				//echo test;
				$owner->selectRecord($this->db->f("ownerID"));
				$this->owner = $owner;
			}
			$sql = sprintf("SELECT * FROM  %s WHERE rptopID=%s;",
			RPTOPTD_TABLE, $rptopID);
			$this->setDB();
			//echo $sql;
			//*
			$this->db->query($sql);
			while ($this->db->next_record()) {
				$td = new TD;
				$td->selectRecord($this->db->f("tdID"));
				$this->tdArray[] = $td;
			}
			$this->setDomDocument();
			//*/
			/*
			$tdRecords = new TDRecords;
			$tdRecords->selectRecords($this->rptopID);
			$this->tdArray = $tdRecords->getArrayList();
			//*/	
			$this->setDomDocument();
			
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}
	
	function selectRecordForList($rptopID){
		if ($rptopID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM  %s WHERE rptopID=%s;",
			RPTOP_TABLE, $rptopID);
		$this->db->query($sql);
		//echo $sql;
		$rptop = new RPTOP;
		if ($this->db->next_record()) {
			foreach ($this->db->Record as $key => $value){
				switch ($key){
					default:
					$this->$key = $value;
				}
			}
			///*
			$sql = sprintf("SELECT ownerID FROM %s WHERE rptopID = %s;",
				OWNER_TABLE, $rptopID);
			$this->db->query($sql);
			//echo $sql;
			while ($this->db->next_record()) {
				$owner = new Owner;
				//echo test;
				$owner->selectRecord($this->db->f("ownerID"));
				$this->owner = $owner;
			}
			
			/*
			$sql = sprintf("SELECT * FROM  %s WHERE rptopID=%s;",
			RPTOPTD_TABLE, $rptopID);
			$this->setDB();
			//echo $sql;
			//*
			$this->db->query($sql);
			while ($this->db->next_record()) {
				$td = new TD;
				$td->selectRecord($this->db->f("tdID"));
				$this->tdArray[] = $td;
			}
			$this->setDomDocument();
			//*/
			/*
			$tdRecords = new TDRecords;
			$tdRecords->selectRecords($this->rptopID);
			$this->tdArray = $tdRecords->getArrayList();
			//*/	
			
			$this->setDomDocument();
			
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}

	function insertRecord(){
		$sql = sprintf("insert into %s (".
				" rptopNumber".
				", rptopDate".
				", taxableYear".
				", cityTreasurer".
				", cityAssessor".
				//", tdArray".
				", dateCreated".
				", createdBy".
				", dateModified".
				", modifiedBy".
				", archive".
				") ".
				"values (".
				"  '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".//, '%s'".
				");",
			RPTOP_TABLE
			, fixQuotes($this->rptopNumber)
			, fixQuotes($this->rptopDate)
			, fixQuotes($this->taxableYear)
			, fixQuotes($this->cityTreasurer)
			, fixQuotes($this->cityAssessor)
			//, fixQuotes($this->tdArray)
			, fixQuotes(time())
			, fixQuotes($this->createdBy)
			, fixQuotes(time())
			, fixQuotes($this->modifiedBy)
			, fixQuotes($this->archive)
			);
		//echo $sql;
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$rptopID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$owner = new Owner;
			$owner->insertRecord($rptopID,"rptop");
			$this->db->endTransaction();
			$ret = $rptopID;
		}
		return $ret;
	}
	
	function updateRecord(){
		$sql = sprintf("update %s set".
				" rptopNumber = '%s'".
				", rptopDate = '%s'".
				", taxableYear = '%s'".
				", cityTreasurer = '%s'".
				", cityAssessor = '%s'".
				", dateModified = '%s'".
				", modifiedBy = '%s'".
				", archive = '%s'".
			"where rptopID = '%s';"
			, RPTOP_TABLE
			, fixQuotes($this->rptopNumber)
			, fixQuotes($this->rptopDate)
			, fixQuotes($this->taxableYear)
			, fixQuotes($this->cityTreasurer)
			, fixQuotes($this->cityAssessor)
			, fixQuotes(time())
			, fixQuotes($this->modifiedBy)
			, fixQuotes($this->archive)
			, $this->rptopID
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
			$ret = $this->rptopID;
			$this->setDomDocument();
		}
		return $ret;
	}
	function updateRecordTotals(){
		$sql = sprintf("update %s set".
			" landTotalMarketValue = '%s'".
			", landTotalAssessedValue = '%s'".
			", plantTotalMarketValue = '%s'".
			", plantTotalAssessedValue = '%s'".
			", bldgTotalMarketValue = '%s'".
			", bldgTotalAssessedValue = '%s'".
			", machTotalMarketValue = '%s'".
			", machTotalAssessedValue = '%s'".
			", totalMarketValue = '%s'".
			", totalAssessedValue = '%s'".
			", dateModified = '%s'".
			", modifiedBy = '%s'".
			", archive = '%s'".
			" where rptopID = '%s';",
			RPTOP_TABLE
			, fixQuotes($this->landTotalMarketValue)
			, fixQuotes($this->landTotalAssessedValue)
			, fixQuotes($this->plantTotalMarketValue)
			, fixQuotes($this->plantTotalAssessedValue)
			, fixQuotes($this->bldgTotalMarketValue)
			, fixQuotes($this->bldgTotalAssessedValue)
			, fixQuotes($this->machTotalMarketValue)
			, fixQuotes($this->machTotalAssessedValue)
			, fixQuotes($this->totalMarketValue)
			, fixQuotes($this->totalAssessedValue)
			, fixQuotes(time())
			, fixQuotes($this->modifiedBy)
			, fixQuotes($this->archive)
			, $this->rptopID			
			);
		//echo $sql;
		//*
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
			$ret = $this->rptopID;
		}//*/
		return $ret;
	}
	
	function insertRptopTd($rptopID,$tdID){
		$sql = sprintf("SELECT * FROM  %s WHERE rptopID='%s' AND tdID='%s';",
			RPTOPTD_TABLE, $rptopID, $tdID);
		$this->setDB();
		$this->db->query($sql);
		//echo $sql;

		if (!$this->db->next_record()) {
			// if TD is archived, do NOT add it to RPTOP

			$sql = sprintf("SELECT * FROM %s WHERE archive != 'true' AND tdID='%s'",
				TD_TABLE, $tdID);

			$this->db->query($sql);

			if($this->db->next_record()){
				$sql = sprintf("insert into %s (rptopID,tdID) values ('%s', '%s');",
					RPTOPTD_TABLE, $rptopID, $tdID);
				//echo $sql."<br>";
				$this->db->beginTransaction();
				$this->db->query($sql);
				$rptopTdID = $this->db->insert_id();
				if ($this->db->Errno!=0) {
					$this->db->rollbackTransaction();
					$this->db->resetErrors();
					$ret = false;
				}
				else {
					$this->db->endTransaction();
					$ret = $rptopTdID;
				}
			}
			else{
				$ret = true;
			}
		}
		else {
			$ret = $this->db->f("rptoptdID");
		}
		return $ret;
	}
	
	function deleteRptopTd($rptopID,$tdID){
		$sql = sprintf("SELECT * FROM  %s WHERE rptopID='%s' AND tdID='%s';",
			RPTOPTD_TABLE, $rptopID, $tdID);
		$this->setDB();
		$this->db->query($sql);
		//echo $sql."<br>";
		if (!$this->db->next_record()) {
			$ret = true;
		}
		else{
			$rptopTdID = $this->db->f("rptoptdID");
			$sql = sprintf("delete from %s where rptopID = '%s' AND tdID = '%s';",
				RPTOPTD_TABLE, $rptopID, $tdID);
			//echo $sql."<br>";
			$this->db->beginTransaction();
			$this->db->query($sql);
			if ($this->db->Errno!=0) {
				$this->db->rollbackTransaction();
				$this->db->resetErrors();
				$ret = false;
			}
			else {
				$this->db->endTransaction();
				$ret = $rptopTdID;
			}
		}
		
		return $ret;
	}
	
	function deleteRecord($rptopID){
		$this->setDB();
		$this->db->beginTransaction();

		$this->selectRecord($rptopID);
		$sql = sprintf("delete from %s where rptopID=%s;",
			RPTOP_TABLE, $rptopID);
		$this->db->query($sql);
		$landRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $landRows;
		}
		return $ret;
	}
	
	function removeRecord($rptopID){
		$this->setDB();
		$this->db->beginTransaction();

		$this->selectRecord($rptopID);
		$sql = sprintf("update %s set afsID = '0' where rptopID=%s;",
			RPTOP_TABLE, $rptopID);
		$this->db->query($sql);
		$landRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $landRows;
		}
		return $ret;
	}
}
?>
