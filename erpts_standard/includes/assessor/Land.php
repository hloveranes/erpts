<?php
include_once "../web/prepend.php";

//includes
include_once "./Address.php";
include_once "./Person.php";
include_once "./Property.php";

//class
class Land extends Property
{
	//attributes
	var $octTctNumber;
	var $surveyNumber;
	var $north;
	var $east;
	var $south;
	var $west;
	var $boundaryDescription;
	var $classification;
	var $subClass;
	var $area;
	var $unit;
	var $unitValue;
	var $adjustmentFactor;
	var $percentAdjustment;
	var $valueAdjustment;
	var $idle;
	var $contested;
	var $dateCreated;
	var $createdBy;
	var $dateModified;
	var $modifiedBy;
	
	//constructor
	function Land(){
		$this->propertyAdministrator = new Person;
	}
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	//methods
	//set
	function setOctTctNumber($tempVar){
		$this->octTctNumber = $tempVar;
	}
	function setSurveyNumber($tempVar){
		$this->surveyNumber = $tempVar;
	}
	function setNorth($tempVar){
		$this->north = $tempVar;
	}
	function setEast($tempVar){
		$this->east = $tempVar;
	}
	function setSouth($tempVar){
		$this->south = $tempVar;
	}
	function setWest($tempVar){
		$this->west = $tempVar;
	}
	function setBoundaryDescription($tempVar){
		$this->boundaryDescription = $tempVar;
	}
	function setClassification($tempVar){
		$this->classification = $tempVar;
	}
	function setSubClass($tempVar){
		$this->subClass = $tempVar;
	}
	function setArea($tempVar){
		$this->area = $tempVar;
	}
	function setUnit($tempVar){
		$this->unit = $tempVar;
	}
	function setPercentAdjustment($tempVar){
		$this->percentAdjustment = $tempVar;
	}
	function setUnitValue($tempVar){
		$this->unitValue = $tempVar;
	}
	function setAdjustmentFactor($tempVar){
		$this->adjustmentFactor = $tempVar;
	}
	function setValueAdjustment($tempVar){
		$this->valueAdjustment = str_replace(',','',$tempVar);
	}
	function setIdle($tempVar){
		$this->idle = $tempVar;
	}
	function setContested($tempVar){
		$this->contested = $tempVar;
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
	function setObjectDocNode($elementName,$elementObject,$domDoc,$indexNode,$className){
		if (is_a($elementObject,$className)){
		$nodeName = "";
            if($nodeDomDoc = $elementObject->getDomDocument()){
				$nodeDomDoc = $elementObject->getDomDocument();
				$nodeObject = $nodeDomDoc->document_element();

				$nodeClone = $nodeObject->clone_node(true);
			
				$nodeName = $domDoc->create_element($elementName);
				$nodeName = $indexNode->append_child($nodeName);
				$nodeObject = $nodeName->append_child($nodeClone);
            }
		}
	}
	function setDomDocument(){
		$this->domDocument = domxml_new_doc("1.0");
		$rec = $this->domDocument->create_element("Land");
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
		//
		$this->setDocNode("octTctNumber",$this->octTctNumber,$this->domDocument,$rec);
		$this->setDocNode("surveyNumber",$this->surveyNumber,$this->domDocument,$rec);
		$this->setDocNode("north",$this->north,$this->domDocument,$rec);
		$this->setDocNode("east",$this->east,$this->domDocument,$rec);
		$this->setDocNode("south",$this->south,$this->domDocument,$rec);
		$this->setDocNode("west",$this->west,$this->domDocument,$rec);
		$this->setDocNode("boundaryDescription",$this->boundaryDescription,$this->domDocument,$rec);
		$this->setDocNode("classification",$this->classification,$this->domDocument,$rec);
		$this->setDocNode("subClass",$this->subClass,$this->domDocument,$rec);
		$this->setDocNode("area",$this->area,$this->domDocument,$rec);
		$this->setDocNode("unit",$this->unit,$this->domDocument,$rec);
		$this->setDocNode("unitValue",$this->unitValue,$this->domDocument,$rec);
		$this->setDocNode("adjustmentFactor",$this->adjustmentFactor,$this->domDocument,$rec);
		$this->setDocNode("percentAdjustment",$this->percentAdjustment,$this->domDocument,$rec);
		$this->setDocNode("valueAdjustment",$this->valueAdjustment,$this->domDocument,$rec);
		$this->setDocNode("idle",$this->idle,$this->domDocument,$rec);
		$this->setDocNode("contested",$this->contested,$this->domDocument,$rec);
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
							//echo "\$this->".$child->tagname."= \"".$child->get_content()."\";<br>";
							// test varvars
							$varvar = $child->tagname;

							$trans = array_flip(get_html_translation_table(HTML_ENTITIES));
							$childContent = strtr(html_entity_decode($child->get_content()), $trans);

							$this->$varvar = html_entity_decode($childContent);

							//$this->$varvar = $child->get_content();
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
	function getOctTctNumber(){
		return $this->octTctNumber;
	}
	function getSurveyNumber(){
		return $this->surveyNumber;
	}
	function getNorth(){
		return $this->north;
	}
	function getEast(){
		return $this->east;
	}
	function getSouth(){
		return $this->south;
	}
	function getWest(){
		return $this->west;
	}
	function getBoundaryDescription(){
		return $this->boundaryDescription;
	}
	function getClassification(){
		return $this->classification;
	}
	function getSubClass(){
		return $this->subClass;
	}
	function getArea(){
		return $this->area;
	}
	function getUnit(){
		return $this->unit;
	}
	function getPercentAdjustment(){
		return $this->percentAdjustment;
	}
	function getUnitValue(){
		return $this->unitValue;
	}
	function getAdjustmentFactor(){
		return $this->adjustmentFactor;
	}
	function getValueAdjustment(){
		return $this->valueAdjustment;
	}
	function getIdle(){
		return $this->idle;
	}
	function getContested(){
		return $this->contested;
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
		 marketValue = area * unitValue
		 valueAdjustment = marketValue * [(percentAdjustment-100)/100]
		 adjustedMarketValue = marketValue * (percentAdjustment/100)
		 assessedValue = roundToNearestTen[adjustedMarketValue * (assessmentLevel/100)]
	*/

	function calculateMarketValue(){
		$this->area = un_number_format($this->area);
		$this->unitValue = un_number_format($this->unitValue);

		$this->marketValue = $this->area * $this->unitValue;
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

	//db
	function selectRecord($propertyID){
		if ($propertyID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM  %s WHERE propertyID=%s;",
			LAND_TABLE, $propertyID);
		$this->db->query($sql);
		//echo $sql;
		$land = new Land;
		if ($this->db->next_record()) {
			/*
			$this->propertyID = $this->db->f("propertyID");
			$this->afsID = $this->db->f("afsID");
			$this->octTctNumber = $this->db->f("octTctNumber");
			$this->surveyNumber = $this->db->f("surveyNumber");
			$this->north = $this->db->f("north");
			$this->east = $this->db->f("east");
			$this->south = $this->db->f("south");
			$this->west = $this->db->f("west");
			$this->boundaryDescription = $this->db->f("boundaryDescription");
			$this->classification = $this->db->f("classification");
			$this->subClass = $this->db->f("subClass");
			$this->area = $this->db->f("area");
			$this->unitValue = $this->db->f("unitValue");
			$this->adjustmentFactor = $this->db->f("adjustmentFactor");
			$this->percentAdjustment = $this->db->f("percentAdjustment");
			$this->valueAdjustment = $this->db->f("valueAdjustment");
			$this->adjustedMarketValue = $this->db->f("adjustedMarketValue");
			$this->idle = $this->db->f("idle");
			$this->contested = $this->db->f("contested");
			$this->dateCreated = $this->db->f("dateCreated");
			$this->createdBy = $this->db->f("createdBy");
			$this->dateModified = $this->db->f("dateModified");
			$this->modifiedBy = $this->db->f("modifiedBy");
			//*/
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
				", kind".
				", classification".
				", area".
				", unit".
				", unitValue".
				", marketValue".
				", dateCreated".
				", createdBy".
				", dateModified".
				", modifiedBy".
				") ".
				"values (".
				"  '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				");"
                , LAND_TABLE
                , fixQuotes($this->afsID)
			    , fixQuotes($this->kind)
				, fixQuotes($this->classification)
			    , fixQuotes($this->area)
				, fixQuotes($this->unit)
			    , fixQuotes($this->unitValue)
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
				"where propertyID = '%s';"
				, LAND_TABLE
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
			$this->propertyAdministrator->setPersonType("propertyAdmin");
			$this->propertyAdministrator->personID = $this->propertyAdministrator->insertRecord();
		}
		else {
			$this->propertyAdministrator->setPersonType("propertyAdmin");
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
				", octTctNumber".
				", surveyNumber".
				", north".
				", east".
				", south".
				", west".
				", boundaryDescription".
				", classification".
				", subClass".
				", area".
				", unit".
				", unitValue".
				", adjustmentFactor".
				", percentAdjustment".
				", valueAdjustment".
				", idle".
				", contested".
				", dateCreated".
				", createdBy".
				", dateModified".
				", modifiedBy".
				") ".
				"values (".
				"  '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				", '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				", '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				", '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				", '%s', '%s', '%s', '%s', '%s', '%s'".
				");",
			LAND_TABLE
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
			, fixQuotes($this->octTctNumber)
			, fixQuotes($this->surveyNumber) 
			, fixQuotes($this->north)
			, fixQuotes($this->east)
			, fixQuotes($this->south)
			, fixQuotes($this->west)
			, fixQuotes($this->boundaryDescription)
			, fixQuotes($this->classification)
			, fixQuotes($this->subClass)
			, fixQuotes($this->area)
			, fixQuotes($this->unit)
			, fixQuotes($this->unitValue)
			, fixQuotes($this->adjustmentFactor)
			, fixQuotes($this->percentAdjustment)
			, fixQuotes($this->valueAdjustment)
			, fixQuotes($this->idle)
			, fixQuotes($this->contested)
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
			$this->propertyAdministrator->setPersonType("propertyAdmin");
			$this->propertyAdministrator->personID = $this->propertyAdministrator->insertRecord();
		}
		else {
			$this->propertyAdministrator->setPersonType("propertyAdmin");
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
				", octTctNumber = '%s'".
				", surveyNumber = '%s'".
				", north = '%s'".
				", east = '%s'".
				", south = '%s'".
				", west = '%s'".
				", boundaryDescription = '%s'".
				", classification = '%s'".
				", subClass = '%s'".
				", area = '%s'".
				", unit = '%s'".
				", unitValue = '%s'".
				", adjustmentFactor = '%s'".
				", percentAdjustment = '%s'".
				", valueAdjustment = '%s'".
				", idle = '%s'".
				", contested = '%s'".
				", dateModified = '%s'".
				", modifiedBy = '%s'".
			"where propertyID = '%s';"
			, LAND_TABLE
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
			, fixQuotes($this->octTctNumber)
			, fixQuotes($this->surveyNumber)
			, fixQuotes($this->north)
			, fixQuotes($this->east)
			, fixQuotes($this->south)
			, fixQuotes($this->west)
			, fixQuotes($this->boundaryDescription)
			, fixQuotes($this->classification)
			, fixQuotes($this->subClass)
			, fixQuotes($this->area)
			, fixQuotes($this->unit)
			, fixQuotes($this->unitValue)
			, fixQuotes($this->adjustmentFactor)
			, fixQuotes($this->percentAdjustment)
			, fixQuotes($this->valueAdjustment)
			, fixQuotes($this->idle)
			, fixQuotes($this->contested)
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
			LAND_TABLE, $propertyID);
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
			LAND_TABLE, $propertyID);
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