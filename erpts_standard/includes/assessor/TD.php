<?php
//include files
class TD
{
	//attributes
	/** The $tdID attribute. This is the primary key attribute/
     ** @type integer auto_increment
     **/
	var $tdID;
	/** The $propertyID attribute. This is foreign key attribute to the property/
     ** @type integer auto_increment
     **/

	var $afsID;

	var $propertyID;
	var $propertyType;
	var $taxDeclarationNumber;
	var $provincialAssessor;
	var $provincialAssessorDate;
	var $cityMunicipalAssessor;
	var $cityMunicipalAssessorDate;
	var $cancelsTDNumber;
	var $canceledByTDNumber;
	var $taxBeginsWithTheYear;
	var $ceasesWithTheYear;
	var $enteredInRPARForYear;
	var $enteredInRPARForBy;
	var $previousOwner;
	var $previousAssessedValue;
	var $memoranda;
	var $basicTax;
	var $sefTax;
	var $total;
	var $dateCreated;
	var $createdBy;
	var $dateModified;
	var $modifiedBy;
	var $archive;
	var $domDocument;
	var $db;
	
	//constructor
	/**  The TD method. This method is the constructor class.
     **  @public
     **  @returns void
     **/
	function TD(){

	}
	
	//methtds
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}
	function setTdID($tempVar){
		$this->tdID = $tempVar;
	}
	function setAfsID($tempVar){
		$this->afsID = $tempVar;
	}
	function setPropertyID($tempVar){
		$this->propertyID = $tempVar;
	}
	function setPropertyType($tempVar){
		$this->propertyType = $tempVar;
	}
	function setTaxDeclarationNumber($tempVar){
		$this->taxDeclarationNumber = $tempVar;
	}
	function setProvincialAssessor($tempVar){
		$this->provincialAssessor = $tempVar;
	}
	function setProvincialAssessorDate($tempVar){
		$this->provincialAssessorDate = $tempVar;
	}
	function setCityMunicipalAssessor($tempVar){
		$this->cityMunicipalAssessor = $tempVar;
	}
	function setCityMunicipalAssessorDate($tempVar){
		$this->cityMunicipalAssessorDate = $tempVar;
	}
	function setCancelsTDNumber($tempVar){
		$this->cancelsTDNumber = $tempVar;
	}
	function setCanceledByTDNumber($tempVar){
		$this->canceledByTDNumber = $tempVar;
	}
	function setTaxBeginsWithTheYear($tempVar){
		$this->taxBeginsWithTheYear = $tempVar;
	}
	function setCeasesWithTheYear($tempVar){
		$this->ceasesWithTheYear = $tempVar;
	}
	function setEnteredInRPARForYear($tempVar){
		$this->enteredInRPARForYear = $tempVar;
	}
	function setEnteredInRPARForBy($tempVar){
		$this->enteredInRPARForBy = $tempVar;
	}
	function setPreviousOwner($tempVar){
		$this->previousOwner = $tempVar;
	}
	function setPreviousAssessedValue($tempVar){
		$this->previousAssessedValue = $tempVar;
	}
	function setMemoranda($tempVar){
		$this->memoranda = $tempVar;
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
	
	//dom
	function setDocNode ($elementName,$elementValue,$domDoc,$indexNode){
		$nodeName = "";
		$nodeText = "";
		$nodeName = $domDoc->create_element($elementName);
		$nodeName = $indexNode->append_child($nodeName);

		$trans = get_html_translation_table(HTML_ENTITIES);
		$elementValue = strtr(htmlentities($elementValue), $trans);
		$elementValue = html_entity_to_alpha($elementValue);
	
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
		$rec = $this->domDocument->create_element("TD");
		$rec = $this->domDocument->append_child($rec);
		$this->setDocNode("tdID",$this->tdID,$this->domDocument,$rec);
		$this->setDocNode("afsID",$this->afsID,$this->domDocument,$rec);
		$this->setDocNode("propertyID",$this->propertyID,$this->domDocument,$rec);
		$this->setDocNode("propertyType",$this->propertyType,$this->domDocument,$rec);
		$this->setDocNode("taxDeclarationNumber",$this->taxDeclarationNumber,$this->domDocument,$rec);
		$this->setDocNode("provincialAssessor",$this->provincialAssessor,$this->domDocument,$rec);
		$this->setDocNode("provincialAssessorDate",$this->provincialAssessorDate,$this->domDocument,$rec);
		$this->setDocNode("cityMunicipalAssessor",$this->cityMunicipalAssessor,$this->domDocument,$rec);
		$this->setDocNode("cityMunicipalAssessorDate",$this->cityMunicipalAssessorDate,$this->domDocument,$rec);
		$this->setDocNode("cancelsTDNumber",$this->cancelsTDNumber,$this->domDocument,$rec);
		$this->setDocNode("canceledByTDNumber",$this->canceledByTDNumber,$this->domDocument,$rec);
		$this->setDocNode("taxBeginsWithTheYear",$this->taxBeginsWithTheYear,$this->domDocument,$rec);
		$this->setDocNode("ceasesWithTheYear",$this->ceasesWithTheYear,$this->domDocument,$rec);
		$this->setDocNode("enteredInRPARForYear",$this->enteredInRPARForYear,$this->domDocument,$rec);
		$this->setDocNode("enteredInRPARForBy",$this->enteredInRPARForBy,$this->domDocument,$rec);
		//$this->setObjectDocNode("previousOwner",$this->previousOwner,$this->domDocument,$rec,"Owner");
		$this->setDocNode("previousOwner",$this->previousOwner,$this->domDocument,$rec);
		$this->setDocNode("previousAssessedValue",$this->previousAssessedValue,$this->domDocument,$rec);
		$this->setDocNode("memoranda",$this->memoranda,$this->domDocument,$rec);
		$this->setDocNode("basicTax",$this->basicTax,$this->domDocument,$rec);
		$this->setDocNode("sefTax",$this->sefTax,$this->domDocument,$rec);
		$this->setDocNode("total",$this->total,$this->domDocument,$rec);
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
					//echo "parse->".$child->tagname."<br>";
					switch($child->tagname){
						/*
						case "previousOwner":
							//echo "previousOwner<br>";
							$previousOwnerNode = $child->first_child();
							while ($previousOwnerNode){
								//if ($previousOwnerNode->tagname=="Owner") {
								if ($previousOwnerNode->tagname) {
									$tempXmlStr = $domDoc->dump_node($previousOwnerNode);
									$tempDomDoc = domxml_open_mem($tempXmlStr);
									$previousOwner = new Owner;
									$ret = $previousOwner->parseDomDocument($tempDomDoc);
									$this->previousOwner = $previousOwner;
								}
								$previousOwnerNode = $previousOwnerNode->next_sibling();
							}
						break;
						*/
						default:
							//eval("\$this->".$child->tagname."= \"".$child->get_content()."\";");

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
	function getTdID(){
		return $this->tdID;
	}
	function getAfsID(){
		return $this->afsID;
	}
	function getPropertyID(){
		return $this->propertyID;
	}
	function getPropertyType(){
		return $this->propertyType;
	}
	function getTaxDeclarationNumber(){
		return $this->taxDeclarationNumber;
	}
	function getProvincialAssessor(){
		return $this->provincialAssessor;
	}
	function getProvincialAssessorDate(){
		return $this->provincialAssessorDate;
	}
	function getCityMunicipalAssessor(){
		return $this->cityMunicipalAssessor;
	}
	function getCityMunicipalAssessorDate(){
		return $this->cityMunicipalAssessorDate;
	}
	function getCancelsTDNumber(){
		return $this->cancelsTDNumber;
	}
	function getCanceledByTDNumber(){
		return $this->canceledByTDNumber;
	}
	function getTaxBeginsWithTheYear(){
		return $this->taxBeginsWithTheYear;
	}
	function getCeasesWithTheYear(){
		return $this->ceasesWithTheYear;
	}
	function getEnteredInRPARForYear(){
		return $this->enteredInRPARForYear;
	}
	function getEnteredInRPARForBy(){
		return $this->enteredInRPARForBy;
	}
	function getPreviousOwner(){
		return $this->previousOwner;
	}
	function getPreviousAssessedValue(){
		return $this->previousAssessedValue;
	}
	function getMemoranda(){
		return $this->memoranda;
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
    function getPropertyIndexNumber() {
		return $this->propertyID;
	}
	function getAssessedValue() {
		#return $this->total;

		$this->setDB();
		$sql = sprintf("SELECT totalAssessedValue FROM %s WHERE afsID='%s';",
			AFS_TABLE, fixQuotes($this->afsID));
		$this->db->query($sql);
		if($this->db->next_record()){
			$this->assessedValue = $this->db->f("totalAssessedValue");
		}

		return $this->assessedValue;
	}
	
	function getIdleStatus() {
		return false;
	}
	
	//db
	function checkTdID($afsID){
		$sql = sprintf("SELECT * FROM %s WHERE afsID=%s;",
			TD_TABLE, $afsID);
		$this->setDB();
		$this->db->query($sql);
		if ($this->db->next_record()) {
			$ret = $this->db->f("tdID");
		}
		else $ret = false;
		return $ret;
	}

	function checkAfsID($tdID){
		$sql = sprintf("SELECT afsID FROM %s WHERE tdID='%s';",TD_TABLE,$tdID);
		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()){
			$ret = $this->db->f("afsID");
		}
		else{
			$ret = false;
		}
		return $ret;
	}

	function selectRecord($tdID="", $afsID="", $propertyID="", $propertyType="", $year=""){
	
		$condition = "tdID = '".$tdID."'";
		if ($tdID=="") {
		    $condition = "";
			$condition = "afsID = '$afsID'";
			//$condition = "propertyID = '$propertyID' and propertyType = '$propertyType'";
			if (!$year=="") $condition = $condition." and (taxBeginsWithTheYear >= '$year' AND ceasesWithTheYear <= '$year')";
		}
		//echo $sql;
		$this->setDB();
		$sql = sprintf("SELECT * FROM  %s WHERE %s;",
			TD_TABLE, $condition);
		//echo $sql;
		$this->db->query($sql);
		//echo $sql."<br>";
		$td = new TD;
		if ($this->db->next_record()) {
			foreach ($this->db->Record as $key => $value){
				switch ($key){
					// mprevoiusOwner??
					//case "mpreviousOwner":
					//	$previousOwner = new Owner;
					//	if ($previousOwner->selectRecord($value)){
					//		$this->$key = $previousOwner;
					//	}
					//	else {
					//		$this->$key = "";
					//	}
					//break;
					default:
					$this->$key = $value;
				}
			}
			
			$this->setDomDocument();
			
			$ret = true;
		}
		else $ret = false;
		//print_r($td);
		return $ret;
	}

	function insertRecordForBuildup(){
		$sql = sprintf("insert into %s (".
			    "afsID". 
				", propertyID".
				", propertyType".
				", taxDeclarationNumber".
				", cancelsTDNumber".
				", taxBeginsWithTheYear".
				", ceasesWithTheYear".
				", previousAssessedValue".
				", memoranda".
				", dateCreated".
				", createdBy".
				", dateModified".
				", modifiedBy".
				", archive".
				")".
				" values (".
				"  '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				");",
				TD_TABLE
			    , fixQuotes($this->afsID)
				, fixQuotes($this->propertyID)
				, fixQuotes($this->propertyType)
				, fixQuotes($this->taxDeclarationNumber)
				, fixQuotes($this->cancelsTDNumber)
				, fixQuotes($this->taxBeginsWithTheYear)
				, fixQuotes($this->ceasesWithTheYear)
				, fixQuotes($this->previousAssessedValue)
				, fixQuotes($this->memoranda)
				, fixQuotes(time())
				, fixQuotes($this->createdBy)
				, fixQuotes(time())
				, fixQuotes($this->modifiedBy)
				, fixQuotes($this->archive)
				);
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$tdID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $tdID;
		}
		return $ret;
	}

	function insertRecord(){
		$sql = sprintf("insert into %s (".
			    "afsID".
				", propertyID".
				", propertyType".
				", taxDeclarationNumber".
				", provincialAssessor".
				", provincialAssessorDate".
				", cityMunicipalAssessor".
				", cityMunicipalAssessorDate".
				", cancelsTDNumber".
				", canceledByTDNumber".
				", taxBeginsWithTheYear".
				", ceasesWithTheYear".
				", enteredInRPARForYear".
				", enteredInRPARForBy".
				", previousOwner".
				", previousAssessedValue".
				", memoranda".
				", dateCreated".
				", createdBy".
				", dateModified".
				", modifiedBy".
				", archive".
				") ".
				"values (".
				"  '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				", '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				", '%s', '%s'".
				");",
			TD_TABLE
			, fixQuotes($this->afsID)
			, fixQuotes($this->propertyID)
			, fixQuotes($this->propertyType)
			, fixQuotes($this->taxDeclarationNumber)
			, fixQuotes($this->provincialAssessor)
			, fixQuotes($this->provincialAssessorDate)
			, fixQuotes($this->cityMunicipalAssessor)
			, fixQuotes($this->cityMunicipalAssessorDate)
			, fixQuotes($this->cancelsTDNumber)
			, fixQuotes($this->canceledByTDNumber)
			, fixQuotes($this->taxBeginsWithTheYear)
			, fixQuotes($this->ceasesWithTheYear)
			, fixQuotes($this->enteredInRPARForYear)
			, fixQuotes($this->enteredInRPARForBy)
			, fixQuotes($this->previousOwner) //->getOwnerID())
			, fixQuotes($this->previousAssessedValue)
			, fixQuotes($this->memoranda)
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
		$tdID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $tdID;
		}
		return $ret;
	}
	
	function updateRecord(){
		$sql = sprintf("update %s set".
			    " afsID = '%s'".
				", propertyID = '%s'".
				", propertyType = '%s'".
				", taxDeclarationNumber = '%s'".
				", provincialAssessor = '%s'".
				", provincialAssessorDate = '%s'".
				", cityMunicipalAssessor = '%s'".
				", cityMunicipalAssessorDate = '%s'".
				", cancelsTDNumber = '%s'".
				", canceledByTDNumber = '%s'".
				", taxBeginsWithTheYear = '%s'".
				", ceasesWithTheYear = '%s'".
				", enteredInRPARForYear = '%s'".
				", enteredInRPARForBy = '%s'".
				", previousOwner = '%s'".
				", previousAssessedValue = '%s'".
				", memoranda = '%s'".
				", dateModified = '%s'".
				", modifiedBy = '%s'".
				", archive = '%s'".
			"where tdID = '%s';"
			, TD_TABLE
			, fixQuotes($this->afsID)
			, fixQuotes($this->propertyID)
			, fixQuotes($this->propertyType)
			, fixQuotes($this->taxDeclarationNumber)
			, fixQuotes($this->provincialAssessor)
			, fixQuotes($this->provincialAssessorDate)
			, fixQuotes($this->cityMunicipalAssessor)
			, fixQuotes($this->cityMunicipalAssessorDate)
			, fixQuotes($this->cancelsTDNumber)
			, fixQuotes($this->canceledByTDNumber)
			, fixQuotes($this->taxBeginsWithTheYear)
			, fixQuotes($this->ceasesWithTheYear)
			, fixQuotes($this->enteredInRPARForYear)
			, fixQuotes($this->enteredInRPARForBy)
			, fixQuotes($this->previousOwner) //->getOwnerID())
			, fixQuotes($this->previousAssessedValue)
			, fixQuotes($this->memoranda)
			, fixQuotes(time())
			, fixQuotes($this->modifiedBy)
			, fixQuotes($this->archive)
			, $this->tdID
			);
		////echo $sql;
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
	
	function updateRecordTax(){
		$sql = sprintf("update %s set".
				" basicTax = '%s'".
				", sefTax = '%s'".
				", total = '%s'".
			"where tdID = '%s';"
			, TD_TABLE
			, fixQuotes($this->basicTax)
			, fixQuotes($this->sefTax)
			, fixQuotes($this->total)
			, $this->tdID
			);
		////echo $sql;
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

	function archiveRecord($tdID,$archiveValue,$userID){
		$sql = sprintf("update %s ".
			"  set ".
			"  archive = '%s'".
			", modifiedBy = '%s'".
			", dateModified = '%s'".
			" where tdID = '%s';",
			TD_TABLE
			, fixQuotes($archiveValue)
			, fixQuotes($userID)
			, fixQuotes(time())
			, fixQuotes($tdID)
		);

		$this->setDB();

		//$dummySQL = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		//$this->db->query($dummySQL);

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
	
	function deleteRecord($tdID){
		$this->setDB();
		$this->db->beginTransaction();

		$this->selectRecord($tdID);
		$sql = sprintf("delete from %s where tdID=%s;",
			TD_TABLE, $tdID);
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
	
	function removeRecord($tdID){
		$this->setDB();
		$this->db->beginTransaction();

		$this->selectRecord($tdID);
		$sql = sprintf("update %s set afsID = '0' where tdID=%s;",
			TD_TABLE, $tdID);
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
