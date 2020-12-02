<?php
//includes
include_once "../web/prepend.php";
include_once "./Address.php";
include_once "./Person.php";
include_once "./Property.php";

//class
class PlantsTrees extends Property
{
	//attributes
	var $landPin;
	var $surveyNumber;
	var $productClass;
	var $areaPlanted;
	var $totalNumber;
	var $nonFruitBearing;
	var $fruitBearing;
	var $age;
	var $unitPrice;
	var $adjustmentFactor;
	var $percentAdjustment;
	var $valueAdjustment;
	var $dateCreated;
	var $createdBy;
	var $dateModified;
	var $modifiedBy;
	var $domDocument;
	//var $db;
	//constructor
	function PlantsTrees(){
	}
	function setDB(){
		$this->db = new DB_RPTS;
	}
	//methods
	//set
	function setLandPin($tempVar){
		$this->landPin = $tempVar;
	}
	function setSurveyNumber($tempVar){
		$this->surveyNumber = $tempVar;
	}
	function setProductClass($tempVar){
		$this->productClass = $tempVar;
	}
	function setAreaPlanted($tempVar){
		$this->areaPlanted = $tempVar;
	}
	function setTotalNumber($tempVar){
		$this->totalNumber = $tempVar;
	}
	function setNonFruitBearing($tempVar){
		$this->nonFruitBearing = $tempVar;
	}
	function setFruitBearing($tempVar){
		$this->fruitBearing = $tempVar;
	}
	function setAge($tempVar){
		$this->age = $tempVar;
	}
	function setUnitPrice($tempVar){
		$this->unitPrice = $tempVar;
	}
	function setAdjustmentFactor($tempVar){
		$this->adjustmentFactor = $tempVar;
	}
	function setPercentAdjustment($tempVar){
		$this->percentAdjustment = $tempVar;
	}
	function setValueAdjustment($tempVar){
		$this->valueAdjustment = str_replace(',','',$tempVar);
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
		$rec = $this->domDocument->create_element("PlantsTrees");
		$rec = $this->domDocument->append_child($rec);
		$this->setDocNode("propertyID",$this->propertyID,$this->domDocument,$rec);
		$this->setDocNode("afsID",$this->afsID,$this->domDocument,$rec);
		$this->setDocNode("arpNumber",$this->arpNumber,$this->domDocument,$rec);
		$this->setDocNode("propertyIndexNumber",$this->propertyIndexNumber,$this->domDocument,$rec);
		$this->setObjectDocNode("propertyAdministrator",$this->propertyAdministrator,$this->domDocument,$rec,"Person");
		$this->setDocNode("verifiedBy",$this->verifiedBy,$this->domDocument,$rec);
		$this->setDocNode("plottingsBy",$this->plottingsBy,$this->domDocument,$rec);
		$this->setDocNode("notedBy",$this->notedBy,$this->domDocument,$rec);
		$this->setDocNode("marketValue",$this->marketValue,$this->domDocument,$rec);
		$this->setDocNode("kind",$this->kind,$this->domDocument,$rec);
		$this->setDocNode("actualUse",$this->actualUse,$this->domDocument,$rec);
		$this->setDocNode("adjustedMarketValue",$this->adjustedMarketValue,$this->domDocument,$rec);
		$this->setDocNode("assessmentLevel",$this->assessmentLevel,$this->domDocument,$rec);
		$this->setDocNode("assessedValue",$this->assessedValue,$this->domDocument,$rec);
		$this->setDocNode("previousOwner",$this->previousOwner,$this->domDocument,$rec);
		$this->setDocNode("previousAssessedValue",$this->previousAssessedValue,$this->domDocument,$rec);
		$this->setDocNode("taxability",$this->taxability,$this->domDocument,$rec);
		$this->setDocNode("effectivity",$this->effectivity,$this->domDocument,$rec);
		$this->setDocNode("appraisedBy",$this->appraisedBy,$this->domDocument,$rec);
		$this->setDocNode("appraisedByDate",$this->appraisedByDate,$this->domDocument,$rec);
		$this->setDocNode("recommendingApproval",$this->recommendingApproval,$this->domDocument,$rec);
		$this->setDocNode("recommendingApprovalDate",$this->recommendingApprovalDate,$this->domDocument,$rec);
		$this->setDocNode("approvedBy",$this->approvedBy,$this->domDocument,$rec);
		$this->setDocNode("approvedByDate",$this->approvedByDate,$this->domDocument,$rec);
		$this->setDocNode("memoranda",$this->memoranda,$this->domDocument,$rec);
		$this->setDocNode("postingDate",$this->postingDate,$this->domDocument,$rec);

		$this->setDocNode("landPin",$this->landPin,$this->domDocument,$rec);
		$this->setDocNode("surveyNumber",$this->surveyNumber,$this->domDocument,$rec);
		$this->setDocNode("productClass",$this->productClass,$this->domDocument,$rec);
		$this->setDocNode("areaPlanted",$this->areaPlanted,$this->domDocument,$rec);
		$this->setDocNode("totalNumber",$this->totalNumber,$this->domDocument,$rec);
		$this->setDocNode("nonFruitBearing",$this->nonFruitBearing,$this->domDocument,$rec);
		$this->setDocNode("fruitBearing",$this->fruitBearing,$this->domDocument,$rec);
		$this->setDocNode("age",$this->age,$this->domDocument,$rec);
		$this->setDocNode("unitPrice",$this->unitPrice,$this->domDocument,$rec);
		$this->setDocNode("adjustmentFactor",$this->adjustmentFactor,$this->domDocument,$rec);
		$this->setDocNode("percentAdjustment",$this->percentAdjustment,$this->domDocument,$rec);
		$this->setDocNode("valueAdjustment",$this->valueAdjustment,$this->domDocument,$rec);
		$this->setDocNode("dateCreated",$this->dateCreated,$this->domDocument,$rec);
		$this->setDocNode("createdBy",$this->createdBy,$this->domDocument,$rec);
		$this->setDocNode("dateModified",$this->dateModified,$this->domDocument,$rec);
		$this->setDocNode("modifiedBy",$this->modifiedBy,$this->domDocument,$rec);
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
						case "propertyAdministrator":
							//echo "location<br>";
							$propertyAdministratorNode = $child->first_child();
							while ($propertyAdministratorNode){
								//if ($propertyAdministratorNode->tagname=="Person") {
								if ($propertyAdministratorNode->tagname) {
									$tempXmlStr = $domDoc->dump_node($propertyAdministratorNode);
									$tempDomDoc = domxml_open_mem($tempXmlStr);
									$propertyAdministrator = new Person;
									$ret = $propertyAdministrator->parseDomDocument($tempDomDoc);
									$this->propertyAdministrator = $propertyAdministrator;
								}
								$propertyAdministratorNode = $propertyAdministratorNode->next_sibling();
							}
						break;	
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
	//get methods
	function getLandPin(){
		return $this->landPin;
	}
	function getSurveyNumber(){
		return $this->surveyNumber;
	}
	function getProductClass(){
		return $this->productClass;
	}
	function getAreaPlanted(){
		return $this->areaPlanted;
	}
	function getTotalNumber(){
		return $this->totalNumber;
	}
	function getNonFruitBearing(){
		return $this->nonFruitBearing;
	}
	function getFruitBearing(){
		return $this->fruitBearing;
	}
	function getAge(){
		return $this->age;
	}
	function getUnitPrice(){
		return $this->unitPrice;
	}
	function getAdjustmentFactor(){
		return $this->adjustmentFactor;
	}
	function getPercentAdjustment(){
		return $this->percentAdjustment;
	}
	function getValueAdjustment(){
		return $this->valueAdjustment;
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

	/* compute:
		marketValue = totalNumber * unitPrice
		adjustedMarketValue = marketValue * (percentAdjustment/100)
		valueAdjustment = marketValue * [(percentAdjustment-100)/100]
		assessedValue = roundToNearestTen[adjustedMarketValue * (assessmentLevel/100)]
	*/

	function calculateMarketValue(){
		$this->totalNumber = un_number_format($this->totalNumber);
		$this->unitPrice = un_number_format($this->unitPrice);

		$this->marketValue = $this->totalNumber * $this->unitPrice;
	}
	function calculateValueAdjustment(){
		$this->marketValue = un_number_format($this->marketValue);
		$this->percentAdjustment = un_number_format($this->percentAdjustment);

		$this->valueAdjustment = $this->marketValue * (($this->percentAdjustment-100)/100);
	}
	function calculateAdjustedMarketValue(){
		$this->marketValue = un_number_format($this->marketValue);
		$this->percentAdjustment = un_number_format($this->percentAdjustment);

		$this->adjustedMarketValue = $this->marketValue * ($this->percentAdjustment/100);
	}
	function calculateAssessedValue(){
		$this->adjustedMarketValue = un_number_format($this->adjustedMarketValue);
		$this->assessmentLevel = un_number_format($this->assessmentLevel);

		$this->assessedValue = roundToNearestTen($this->adjustedMarketValue * ($this->assessmentLevel/100));
	}

	//other methods
	function selectRecord($propertyID){
		if ($propertyID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM  %s WHERE propertyID=%s;",
			PLANTSTREES_TABLE, $propertyID);
		$this->db->query($sql);
		//echo $sql;
		$plantsTrees = new PlantsTrees;
		if ($this->db->next_record()) {
			foreach ($this->db->Record as $key => $value){
				switch ($key){
					case "propertyAdministrator":
						$propertyAdministrator = new Person;
						if ($propertyAdministrator->selectRecord($value)){
							$this->$key = $propertyAdministrator;
						}
						else {
							$this->$key = "";
						}
					break;
					default:
					$this->$key = $value;
				}
			}
			$this->setDomDocument();
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}

	function insertRecordForBuildup(){
	    $sql = sprintf("insert into %s (".
				"afsID".
				", totalNumber".
				", productClass".
				", kind".
				", unitPrice".
				", marketValue".
				", dateCreated".
				", createdBy".
				", dateModified".
				", modifiedBy".
				") ".
				"values (".
				"  '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				");"
                , PLANTSTREES_TABLE
                , fixQuotes($this->afsID)
				, fixQuotes($this->totalNumber)
				, fixQuotes($this->productClass)
			    , fixQuotes($this->kind)
			    , fixQuotes($this->unitPrice)
				, fixQuotes($this->marketValue)
				, fixQuotes(time())
				, fixQuotes($this->createdBy)
				, fixQuotes(time())
				, fixQuotes($this->modifiedBy)
			);

		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$propertyID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $propertyID;
		}
		return $ret;	
	}

	function updateRecordForBuildup(){
		$sql = sprintf("update %s set".
				" actualUse = '%s'".
				", assessmentLevel = '%s'".
				", assessedValue = '%s'".
				" where propertyID = '%s';"
				, PLANTSTREES_TABLE
				, fixQuotes($this->actualUse)
				, fixQuotes($this->assessmentLevel)
				, fixQuotes($this->assessedValue)
				, $this->propertyID
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
			$ret = $this->propertyID;
			$this->setDomDocument();
		}
		return $ret;
	}

	function insertRecord(){
		if ($this->propertyAdministrator->personID == ""){
			$this->propertyAdministrator->personID = $this->propertyAdministrator->insertRecord();
		}
		else {
			$this->propertyAdministrator->personID = $this->propertyAdministrator->updateRecord();
		}
		$sql = sprintf("insert into %s (".
				"afsID".
				", arpNumber".
				", propertyIndexNumber".
				", propertyAdministrator".
				", verifiedBy".
				", plottingsBy".
				", notedBy".
				", marketValue".
				", kind".
				", actualUse".
				", adjustedMarketValue".
				", assessmentLevel".
				", assessedValue".
				", previousOwner".
				", previousAssessedValue".
				", taxability".
				", effectivity".
				", appraisedBy".
				", appraisedByDate".
				", recommendingApproval".
				", recommendingApprovalDate".
				", approvedBy".
				", approvedByDate".
				", memoranda".
				", postingDate".
				
				", landPin".
				", surveyNumber".
				", productClass".
				", areaPlanted".
				", totalNumber".
				", nonFruitBearing".
				", fruitBearing".
				", age".
				", unitPrice".
				", adjustmentFactor".
				", percentAdjustment".
				", valueAdjustment".
				", dateCreated".
				", createdBy".
				", dateModified".
				", modifiedBy".
				") ".
				"values (".
				"  '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				", '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				", '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				", '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				");"
			, PLANTSTREES_TABLE
			, fixQuotes($this->afsID)
			, fixQuotes($this->arpNumber)
			, fixQuotes($this->propertyIndexNumber)
			, fixQuotes($this->propertyAdministrator->personID)
			, fixQuotes($this->verifiedBy)
			, fixQuotes($this->plottingsBy)
			, fixQuotes($this->notedBy)
			, fixQuotes($this->marketValue)
			, fixQuotes($this->kind)
			, fixQuotes($this->actualUse)
			, fixQuotes($this->adjustedMarketValue)
			, fixQuotes($this->assessmentLevel)
			, fixQuotes($this->assessedValue)
			, fixQuotes($this->previousOwner)
			, fixQuotes($this->previousAssessedValue)
			, fixQuotes($this->taxability)
			, fixQuotes($this->effectivity)
			, fixQuotes($this->appraisedBy)
			, fixQuotes($this->appraisedByDate)
			, fixQuotes($this->recommendingApproval)
			, fixQuotes($this->recommendingApprovalDate)
			, fixQuotes($this->approvedBy)
			, fixQuotes($this->approvedByDate)
			, fixQuotes($this->memoranda)
			, fixQuotes($this->postingDate)
			
			, fixQuotes($this->landPin)
			, fixQuotes($this->surveyNumber)
			, fixQuotes($this->productClass)
			, fixQuotes($this->areaPlanted)
			, fixQuotes($this->totalNumber)
			, fixQuotes($this->nonFruitBearing)
			, fixQuotes($this->fruitBearing)
			, fixQuotes($this->age)
			, fixQuotes($this->unitPrice)
			, fixQuotes($this->adjustmentFactor)
			, fixQuotes($this->percentAdjustment)
			, fixQuotes($this->valueAdjustment)
			, fixQuotes(time())
			, fixQuotes($this->createdBy)
			, fixQuotes(time())
			, fixQuotes($this->modifiedBy)
		);
		//echo $sql;
		
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$propertyID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $propertyID;
		}
		return $ret;
	}
	
	function updateRecord(){
		if ($this->propertyAdministrator->personID == ""){
			$this->propertyAdministrator->personID = $this->propertyAdministrator->insertRecord();
		}
		else {
			$this->propertyAdministrator->personID = $this->propertyAdministrator->updateRecord();
		}

		$sql = sprintf("update %s set".
				" afsID = '%s'".
				", arpNumber = '%s'".
				", propertyIndexNumber = '%s'".
				", propertyAdministrator = '%s'".
				", verifiedBy = '%s'".
				", plottingsBy = '%s'".
				", notedBy = '%s'".
				", marketValue = '%s'".
				", kind = '%s'".
				", actualUse = '%s'".
				", adjustedMarketValue = '%s'".
				", assessmentLevel = '%s'".
				", assessedValue = '%s'".
				", previousOwner = '%s'".
				", previousAssessedValue = '%s'".
				", taxability = '%s'".
				", effectivity = '%s'".
				", appraisedBy = '%s'".
				", appraisedByDate = '%s'".
				", recommendingApproval = '%s'".
				", recommendingApprovalDate = '%s'".
				", approvedBy = '%s'".
				", approvedByDate = '%s'".
				", memoranda = '%s'".
				", postingDate = '%s'".
				
				", landPin = '%s'".
				", surveyNumber = '%s'".
				", productClass = '%s'".
				", areaPlanted = '%s'".
				", totalNumber = '%s'".
				", nonFruitBearing = '%s'".
				", fruitBearing = '%s'".
				", age = '%s'".
				", unitPrice = '%s'".
				", adjustmentFactor = '%s'".
				", percentAdjustment = '%s'".
				", valueAdjustment = '%s'".
				", dateModified = '%s'".
				", modifiedBy = '%s'".
			"where propertyID = '%s';"
			, PLANTSTREES_TABLE
			, fixQuotes($this->afsID)
			, fixQuotes($this->arpNumber)
			, fixQuotes($this->propertyIndexNumber)
			, fixQuotes($this->propertyAdministrator->personID)
			, fixQuotes($this->verifiedBy)
			, fixQuotes($this->plottingsBy)
			, fixQuotes($this->notedBy)
			, fixQuotes($this->marketValue)
			, fixQuotes($this->kind)
			, fixQuotes($this->actualUse)
			, fixQuotes($this->adjustedMarketValue)
			, fixQuotes($this->assessmentLevel)
			, fixQuotes($this->assessedValue)
			, fixQuotes($this->previousOwner)
			, fixQuotes($this->previousAssessedValue)
			, fixQuotes($this->taxability)
			, fixQuotes($this->effectivity)
			, fixQuotes($this->appraisedBy)
			, fixQuotes($this->appraisedByDate)
			, fixQuotes($this->recommendingApproval)
			, fixQuotes($this->recommendingApprovalDate)
			, fixQuotes($this->approvedBy)
			, fixQuotes($this->approvedByDate)
			, fixQuotes($this->memoranda)
			, fixQuotes($this->postingDate)
			
			, fixQuotes($this->landPin)
			, fixQuotes($this->surveyNumber)
			, fixQuotes($this->productClass)
			, fixQuotes($this->areaPlanted)
			, fixQuotes($this->totalNumber)
			, fixQuotes($this->nonFruitBearing)
			, fixQuotes($this->fruitBearing)
			, fixQuotes($this->age)
			, fixQuotes($this->unitPrice)
			, fixQuotes($this->adjustmentFactor)
			, fixQuotes($this->percentAdjustment)
			, fixQuotes($this->valueAdjustment)
			, fixQuotes(time())
			, fixQuotes($this->modifiedBy)

			, $this->propertyID
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
			$ret = $this->propertyID;
			$this->setDomDocument();
		}
		return $ret;
	}
	
	function deleteRecord($propertyID){
		$this->setDB();
		$this->db->beginTransaction();

		$this->selectRecord($propertyID);
		$sql = sprintf("delete from %s where propertyID=%s;",
			PLANTSTREES_TABLE, $propertyID);
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
	
	function removeRecord($propertyID){
		$this->setDB();
		$this->db->beginTransaction();

		$this->selectRecord($propertyID);
		$sql = sprintf("update %s set afsID = '0' where propertyID=%s;",
			PLANTSTREES_TABLE, $propertyID);
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
