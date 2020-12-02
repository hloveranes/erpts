<?php
include_once "../web/prepend.php";

//includes
include_once "./Address.php";
include_once "./Person.php";
include_once "./Property.php";

//class
class ImprovementsBuildings extends Property
{
	//attributes
	var $landPin;
	var $foundation;
	var $columnsBldg;
	var $beams;
	var $trussFraming;
	var $roof;
	var $exteriorWalls;
	var $flooring;
	var $doors;
	var $ceiling;
	var $structuralTypes;
	var $buildingClassification;
	var $buildingPermit;
	var $buildingAge;
	var $cctNumber;
	var $numberOfStoreys;
	var $windows;
	var $stairs;
	var $partition;
	var $wallFinish;
	var $electrical;
	var $toiletAndBath;
	var $plumbingSewer;
	var $fixtures;
	var $dateConstructed;
	var $dateOccupied;
	var $dateCompleted;
	var $areaOfGroundFloor;
	var $totalBuildingArea;
	var $unitValue;
	var $buildingCoreAndAdditionalItems;
    var $addItems;
	var $depreciationRate;
	var $accumulatedDepreciation;
	var $depreciatedMarketValue;
	var $dateCreated;
	var $createdBy;
	var $dateModified;
	var $modifiedBy;
	
	//constructor
	function ImprovementsBuildings(){
		$this->propertyAdministrator = new Person;
	}
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	//methods
	//set
	function setLandPin($tempVar){
		$this->landPin = $tempVar;
	}
	function setFoundation($tempVar){
		$this->foundation = $tempVar;
	}
	function setColumnsBldg($tempVar){
		$this->columnsBldg = $tempVar;
	}
	function setBeams($tempVar){
		$this->beams = $tempVar;
	}
	function setTrussFraming($tempVar){
		$this->trussFraming = $tempVar;
	}
	function setRoof($tempVar){
		$this->roof = $tempVar;
	}
	function setExteriorWalls($tempVar){
		$this->exteriorWalls = $tempVar;
	}
	function setFlooring($tempVar){
		$this->flooring = $tempVar;
	}
	function setDoors($tempVar){
		$this->doors = $tempVar;
	}
	function setCeiling($tempVar){
		$this->ceiling = $tempVar;
	}
	function setStructuralTypes($tempVar){
		$this->structuralTypes = $tempVar;
	}
	function setBuildingClassification($tempVar){
		$this->buildingClassification = $tempVar;
	}
	function setBuildingPermit($tempVar){
		$this->buildingPermit = $tempVar;
	}
	function setBuildingAge($tempVar){
		$this->buildingAge = $tempVar;
	}
	function setCctNumber($tempVar){
		$this->cctNumber = $tempVar;
	}
	function setNumberOfStoreys($tempVar){
		$this->numberOfStoreys = $tempVar;
	}
	function setWindows($tempVar){
		$this->windows = $tempVar;
	}
	function setStairs($tempVar){
		$this->stairs = $tempVar;
	}
	function setPartition($tempVar){
		$this->partition = $tempVar;
	}
	function setWallFinish($tempVar){
		$this->wallFinish = $tempVar;
	}
	function setElectrical($tempVar){
		$this->electrical = $tempVar;
	}
	function setToiletAndBath($tempVar){
		$this->toiletAndBath = $tempVar;
	}
	function setPlumbingSewer($tempVar){
		$this->plumbingSewer = $tempVar;
	}
	function setFixtures($tempVar){
		$this->fixtures = $tempVar;
	}
	function setDateConstructed($tempVar){
		$this->dateConstructed = $tempVar;
	}
	function setDateOccupied($tempVar){
		$this->dateOccupied = $tempVar;
	}
	function setDateCompleted($tempVar){
		$this->dateCompleted = $tempVar;
	}
	function setAreaOfGroundFloor($tempVar){
		$this->areaOfGroundFloor = $tempVar;
	}
	function setTotalBuildingArea($tempVar){
		$this->totalBuildingArea = $tempVar;
	}
	function setUnitValue($tempVar){
		$this->unitValue = $tempVar;
	}
	function setBuildingCoreAndAdditionalItems($tempVar){
		$this->buildingCoreAndAdditionalItems = $tempVar;
	}
	function setAddItems($tempVar){
		$this->addItems = $tempVar;
	}
	function setDepreciationRate($tempVar){
		$this->depreciationRate = $tempVar;
	}
	function setAccumulatedDepreciation($tempVar){
		$this->accumulatedDepreciation = $tempVar;
	}
	function setDepreciatedMarketValue($tempVar){
		$this->depreciatedMarketValue = $tempVar;
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
		$rec = $this->domDocument->create_element("ImprovementsBuildings");
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
		$this->setDocNode("landPin",$this->landPin,$this->domDocument,$rec);
		$this->setDocNode("foundation",$this->foundation,$this->domDocument,$rec);
		$this->setDocNode("columnsBldg",$this->columnsBldg,$this->domDocument,$rec);
		$this->setDocNode("beams",$this->beams,$this->domDocument,$rec);
		$this->setDocNode("trussFraming",$this->trussFraming,$this->domDocument,$rec);
		$this->setDocNode("roof",$this->roof,$this->domDocument,$rec);
		$this->setDocNode("exteriorWalls",$this->exteriorWalls,$this->domDocument,$rec);
		$this->setDocNode("flooring",$this->flooring,$this->domDocument,$rec);
		$this->setDocNode("doors",$this->doors,$this->domDocument,$rec);
		$this->setDocNode("ceiling",$this->ceiling,$this->domDocument,$rec);
		$this->setDocNode("structuralTypes",$this->structuralTypes,$this->domDocument,$rec);
		$this->setDocNode("buildingClassification",$this->buildingClassification,$this->domDocument,$rec);
		$this->setDocNode("buildingPermit",$this->buildingPermit,$this->domDocument,$rec);
		$this->setDocNode("buildingAge",$this->buildingAge,$this->domDocument,$rec);
		$this->setDocNode("cctNumber",$this->cctNumber,$this->domDocument,$rec);
		$this->setDocNode("numberOfStoreys",$this->numberOfStoreys,$this->domDocument,$rec);
		$this->setDocNode("windows",$this->windows,$this->domDocument,$rec);
		$this->setDocNode("stairs",$this->stairs,$this->domDocument,$rec);
		$this->setDocNode("partition",$this->partition,$this->domDocument,$rec);
		$this->setDocNode("wallFinish",$this->wallFinish,$this->domDocument,$rec);
		$this->setDocNode("electrical",$this->electrical,$this->domDocument,$rec);
		$this->setDocNode("toiletAndBath",$this->toiletAndBath,$this->domDocument,$rec);
		$this->setDocNode("plumbingSewer",$this->plumbingSewer,$this->domDocument,$rec);
		$this->setDocNode("fixtures",$this->fixtures,$this->domDocument,$rec);
		$this->setDocNode("dateConstructed",$this->dateConstructed,$this->domDocument,$rec);
		$this->setDocNode("dateOccupied",$this->dateOccupied,$this->domDocument,$rec);
		$this->setDocNode("dateCompleted",$this->dateCompleted,$this->domDocument,$rec);
		$this->setDocNode("areaOfGroundFloor",$this->areaOfGroundFloor,$this->domDocument,$rec);
		$this->setDocNode("totalBuildingArea",$this->totalBuildingArea,$this->domDocument,$rec);
		$this->setDocNode("unitValue",$this->unitValue,$this->domDocument,$rec);
		$this->setDocNode("buildingCoreAndAdditionalItems",$this->buildingCoreAndAdditionalItems,$this->domDocument,$rec);
		$this->setDocNode("addItems",$this->addItems,$this->domDocument,$rec);
		$this->setDocNode("depreciationRate",$this->depreciationRate,$this->domDocument,$rec);
		$this->setDocNode("accumulatedDepreciation",$this->accumulatedDepreciation,$this->domDocument,$rec);
		$this->setDocNode("depreciatedMarketValue",$this->depreciatedMarketValue,$this->domDocument,$rec);
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

	function getLandPin(){
		return $this->landPin;
	}
	function getFoundation(){
		return $this->foundation;
	}
	function getColumnsBldg(){
		return $this->columnsBldg;
	}
	function getBeams(){
		return $this->beams;
	}
	function getTrussFraming(){
		return $this->trussFraming;
	}
	function getRoof(){
		return $this->roof;
	}
	function getExteriorWalls(){
		return $this->exteriorWalls;
	}
	function getFlooring(){
		return $this->flooring;
	}
	function getDoors(){
		return $this->doors;
	}
	function getCeiling(){
		return $this->ceiling;
	}
	function getStructuralTypes(){
		return $this->structuralTypes;
	}
	function getBuildingClassification(){
		return $this->buildingClassification;
	}
	function getBuildingPermit(){
		return $this->buildingPermit;
	}
	function getBuildingAge(){
		return $this->buildingAge;
	}
	function getCctNumber(){
		return $this->cctNumber;
	}
	function getNumberOfStoreys(){
		return $this->numberOfStoreys;
	}
	function getWindows(){
		return $this->windows;
	}
	function getStairs(){
		return $this->stairs;
	}
	function getPartition(){
		return $this->partition;
	}
	function getWallFinish(){
		return $this->wallFinish;
	}
	function getElectrical(){
		return $this->electrical;
	}
	function getToiletAndBath(){
		return $this->toiletAndBath;
	}
	function getPlumbingSewer(){
		return $this->plumbingSewer;
	}
	function getFixtures(){
		return $this->fixtures;
	}
	function getDateConstructed(){
		return $this->dateConstructed;
	}
	function getDateOccupied(){
		return $this->dateOccupied;
	}
	function getDateCompleted(){
		return $this->dateCompleted;
	}
	function getAreaOfGroundFloor(){
		return $this->areaOfGroundFloor;
	}
	function getTotalBuildingArea(){
		return $this->totalBuildingArea;
	}
	function getUnitValue(){
		return $this->unitValue;
	}
	function getBuildingCoreAndAdditionalItems(){
		return $this->buildingCoreAndAdditionalItems;
	}
	function getAddItems(){
		return $this->addItems;
	}
	function getDepreciationRate(){
		return $this->depreciationRate;
	}
	function getAccumulatedDepreciation(){
		return $this->accumulatedDepreciation;
	}
	function getDepreciatedMarketValue(){
		return $this->depreciatedMarketValue;
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
		marketValue = totalBuildingArea * unitValue
		accumulatedDepreciation = marketValue * (depreciationRate / 100)
		depreciatedMarketValue = marketValue - accumulatedDepreciation
		adjustedMarketValue = depreciatedMarketValue
		assessedValue = roundToNearestTen[adjustedMarketValue * (assessmentLevel/100)]
	*/

	function calculateMarketValue(){
		$this->totalBuildingArea = un_number_format($this->totalBuildingArea);
		$this->unitValue = un_number_format($this->unitValue);

		$this->marketValue = $this->totalBuildingArea * $this->unitValue;
	}
	function calculateAccumulatedDepreciation(){
		$this->marketValue = un_number_format($this->marketValue);
		$this->depreciationRate = un_number_format($this->depreciationRate);

		$this->accumulatedDepreciation = $this->marketValue * ($this->depreciationRate / 100);
	}
	function calculatedDepreciatedMarketValue(){
		$this->marketValue = un_number_format($this->marketValue);
		$this->accumulatedDepreciation = un_number_format($this->accumulatedDepreciation);

		$this->depreciatedMarketValue = $this->marketValue - $this->accumulatedDepreciation;
	}
	function calculateAdjustedMarketValue(){
		$this->depreciatedMarketValue = un_number_format($this->depreciatedMarketValue);

		$this->adjustedMarketValue = $this->depreciatedMarketValue;
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
			IMPROVEMENTSBUILDINGS_TABLE, $propertyID);
		$this->db->query($sql);
		//echo $sql;
		$improvementsBuildings = new ImprovementsBuildings;
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
				", marketValue".
				", buildingClassification".
				", kind".
				", areaOfGroundFloor".
				", dateCreated".
				", createdBy".
				", dateModified".
				", modifiedBy".
				") ".
				"values (".
				"  '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				");",
				IMPROVEMENTSBUILDINGS_TABLE
				, fixQuotes($this->afsID)
				, fixQuotes($this->marketValue)
				, fixQuotes($this->buildingClassification)
				, fixQuotes($this->kind)
				, fixQuotes($this->areaOfGroundFloor)
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
				, IMPROVEMENTSBUILDINGS_TABLE
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
				", foundation".
				", columnsBldg".
				", beams".
				", trussFraming".
				", roof".
				", exteriorWalls".
				", flooring".
				", doors".
				", ceiling".
				", structuralTypes".
				", buildingClassification".
				", buildingPermit".
				", buildingAge".
				", cctNumber".
				", numberOfStoreys".
				", windows".
				", stairs".
				", partition".
				", wallFinish".
				", electrical".
				", toiletAndBath".
				", plumbingSewer".
				", fixtures".
				", dateConstructed".
				", dateOccupied".
				", dateCompleted".
				", areaOfGroundFloor".
				", totalBuildingArea".
				", unitValue".
				", buildingCoreAndAdditionalItems".
				", addItems".
				", depreciationRate".
				", accumulatedDepreciation".
				", depreciatedMarketValue".
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
				", '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				", '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				", '%s', '%s', '%s'".
				");",
			IMPROVEMENTSBUILDINGS_TABLE
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
			, fixQuotes($this->foundation)
			, fixQuotes($this->columnsBldg)
			, fixQuotes($this->beams)
			, fixQuotes($this->trussFraming)
			, fixQuotes($this->roof)
			, fixQuotes($this->exteriorWalls)
			, fixQuotes($this->flooring)
			, fixQuotes($this->doors)
			, fixQuotes($this->ceiling)
			, fixQuotes($this->structuralTypes)
			, fixQuotes($this->buildingClassification)
			, fixQuotes($this->buildingPermit)
			, fixQuotes($this->buildingAge)
			, fixQuotes($this->cctNumber)
			, fixQuotes($this->numberOfStoreys)
			, fixQuotes($this->windows)
			, fixQuotes($this->stairs)
			, fixQuotes($this->partition)
			, fixQuotes($this->wallFinish)
			, fixQuotes($this->electrical)
			, fixQuotes($this->toiletAndBath)
			, fixQuotes($this->plumbingSewer)
			, fixQuotes($this->fixtures)
			, fixQuotes($this->dateConstructed)
			, fixQuotes($this->dateOccupied)
			, fixQuotes($this->dateCompleted)
			, fixQuotes($this->areaOfGroundFloor)
			, fixQuotes($this->totalBuildingArea)
			, fixQuotes($this->unitValue)
			, fixQuotes($this->buildingCoreAndAdditionalItems)
			, fixQuotes($this->addItems)
			, fixQuotes($this->depreciationRate)
			, fixQuotes($this->accumulatedDepreciation)
			, fixQuotes($this->depreciatedMarketValue)
			, fixQuotes(time())
			, fixQuotes($this->createdBy)
			, fixQuotes(time())
			, fixQuotes($this->modifiedBy)
			);

		//echo $sql;
		$this->setDB();

//		$dummySql = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
//		$this->db->query($dummySql);

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
				", foundation = '%s'".
				", columnsBldg = '%s'".
				", beams = '%s'".
				", trussFraming = '%s'".
				", roof = '%s'".
				", exteriorWalls = '%s'".
				", flooring = '%s'".
				", doors = '%s'".
				", ceiling = '%s'".
				", structuralTypes = '%s'".
				", buildingClassification = '%s'".
				", buildingPermit = '%s'".
				", buildingAge = '%s'".
				", cctNumber = '%s'".
				", numberOfStoreys = '%s'".
				", windows = '%s'".
				", stairs = '%s'".
				", partition = '%s'".
				", wallFinish = '%s'".
				", electrical = '%s'".
				", toiletAndBath = '%s'".
				", plumbingSewer = '%s'".
				", fixtures = '%s'".
				", dateConstructed = '%s'".
				", dateOccupied = '%s'".
				", dateCompleted = '%s'".
				", areaOfGroundFloor = '%s'".
				", totalBuildingArea = '%s'".
				", unitValue = '%s'".
				", buildingCoreAndAdditionalItems = '%s'".
				", addItems = '%s'".
				", depreciationRate = '%s'".
				", accumulatedDepreciation = '%s'".
				", depreciatedMarketValue = '%s'".
				", dateModified = '%s'".
				", modifiedBy = '%s'".
			"where propertyID = '%s';"
			, IMPROVEMENTSBUILDINGS_TABLE
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
			, fixQuotes($this->foundation)
			, fixQuotes($this->columnsBldg)
			, fixQuotes($this->beams)
			, fixQuotes($this->trussFraming)
			, fixQuotes($this->roof)
			, fixQuotes($this->exteriorWalls)
			, fixQuotes($this->flooring)
			, fixQuotes($this->doors)
			, fixQuotes($this->ceiling)
			, fixQuotes($this->structuralTypes)
			, fixQuotes($this->buildingClassification)
			, fixQuotes($this->buildingPermit)
			, fixQuotes($this->buildingAge)
			, fixQuotes($this->cctNumber)
			, fixQuotes($this->numberOfStoreys)
			, fixQuotes($this->windows)
			, fixQuotes($this->stairs)
			, fixQuotes($this->partition)
			, fixQuotes($this->wallFinish)
			, fixQuotes($this->electrical)
			, fixQuotes($this->toiletAndBath)
			, fixQuotes($this->plumbingSewer)
			, fixQuotes($this->fixtures)
			, fixQuotes($this->dateConstructed)
			, fixQuotes($this->dateOccupied)
			, fixQuotes($this->dateCompleted)
			, fixQuotes($this->areaOfGroundFloor)
			, fixQuotes($this->totalBuildingArea)
			, fixQuotes($this->unitValue)
			, fixQuotes($this->buildingCoreAndAdditionalItems)
			, fixQuotes($this->addItems)
			, fixQuotes($this->depreciationRate)
			, fixQuotes($this->accumulatedDepreciation)
			, fixQuotes($this->depreciatedMarketValue)
			, fixQuotes(time())
			, fixQuotes($this->modifiedBy)
			, $this->propertyID
			);

		//echo $sql;
    		$this->setDB();

		$dummySql = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		$this->db->query($dummySql);

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
			IMPROVEMENTSBUILDINGS_TABLE, $propertyID);
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
			IMPROVEMENTSBUILDINGS_TABLE, $propertyID);
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
