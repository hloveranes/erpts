<?php
//includes
include_once "../web/prepend.php";
include_once "./Address.php";
include_once "./Person.php";
include_once "./Property.php";

//class
class Machineries extends Property
{
	//attributes
	var $buildingPin;
	var $landPin;
	var $machineryDescription;
	var $brand;
	var $modelNumber;
	var $capacity;
	var $dateAcquired;
	var $conditionWhenAcquired;
	var $estimatedEconomicLife;
	var $remainingEconomicLife;
	var $dateOfInstallation;
	var $dateOfOperation;
	var $remarks;
	var $numberOfUnits;
	var $acquisitionCost;
	var $freightCost;
	var $insuranceCost;
	var $installationCost;
	var $othersCost;
	var $depreciation;
	var $totalDepreciation;
	var $depreciatedMarketValue;
	var $dateCreated;
	var $createdBy;
	var $dateModified;
	var $modifiedBy;
	var $domDocument;
	//var $db;
	//constructor
	function Machineries(){
	}
	function setDB(){
		$this->db = new DB_RPTS;
	}
	//methods
	//set
	function setBuildingPin($tempVar){
		$this->buildingPin = $tempVar;
	}
	function setLandPin($tempVar){
		$this->landPin = $tempVar;
	}
	function setMachineryDescription($tempVar){
		$this->machineryDescription = $tempVar;
	}
	function setBrand($tempVar){
		$this->brand = $tempVar;
	}
	function setModelNumber($tempVar){
		$this->modelNumber = $tempVar;
	}
	function setCapacity($tempVar){
		$this->capacity = $tempVar;
	}
	function setDateAcquired($tempVar){
		$this->dateAcquired = $tempVar;
	}
	function setConditionWhenAcquired($tempVar){
		$this->conditionWhenAcquired = $tempVar;
	}
	function setEstimatedEconomicLife($tempVar){
		$this->estimatedEconomicLife = $tempVar;
	}
	function setRemainingEconomicLife($tempVar){
		$this->remainingEconomicLife = $tempVar;
	}
	function setDateOfInstallation($tempVar){
		$this->dateOfInstallation = $tempVar;
	}
	function setDateOfOperation($tempVar){
		$this->dateOfOperation = $tempVar;
	}
	function setRemarks($tempVar){
		$this->remarks = $tempVar;
	}
	function setNumberOfUnits($tempVar){
		$this->numberOfUnits = $tempVar;
	}
	function setAcquisitionCost($tempVar){
		$this->acquisitionCost = $tempVar;
	}
	function setFreightCost($tempVar){
		$this->freightCost = $tempVar;
	}
	function setInsuranceCost($tempVar){
		$this->insuranceCost = $tempVar;
	}
	function setInstallationCost($tempVar){
		$this->installationCost = $tempVar;
	}
	function setOthersCost($tempVar){
		$this->othersCost = $tempVar;
	}
	function setDepreciation($tempVar){
		$this->depreciation = $tempVar;
	}
	function setTotalDepreciation($tempVar){
		$this->totalDepreciation = $tempVar;
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
		$rec = $this->domDocument->create_element("Machineries");
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
		
		$this->setDocNode("buildingPin",$this->buildingPin,$this->domDocument,$rec);
		$this->setDocNode("landPin",$this->landPin,$this->domDocument,$rec);
		$this->setDocNode("machineryDescription",$this->machineryDescription,$this->domDocument,$rec);
		$this->setDocNode("brand",$this->brand,$this->domDocument,$rec);
		$this->setDocNode("modelNumber",$this->modelNumber,$this->domDocument,$rec);
		$this->setDocNode("capacity",$this->capacity,$this->domDocument,$rec);
		$this->setDocNode("dateAcquired",$this->dateAcquired,$this->domDocument,$rec);
		$this->setDocNode("conditionWhenAcquired",$this->conditionWhenAcquired,$this->domDocument,$rec);
		$this->setDocNode("estimatedEconomicLife",$this->estimatedEconomicLife,$this->domDocument,$rec);
		$this->setDocNode("remainingEconomicLife",$this->remainingEconomicLife,$this->domDocument,$rec);
		$this->setDocNode("dateOfInstallation",$this->dateOfInstallation,$this->domDocument,$rec);
		$this->setDocNode("dateOfOperation",$this->dateOfOperation,$this->domDocument,$rec);
		$this->setDocNode("remarks",$this->remarks,$this->domDocument,$rec);
		$this->setDocNode("numberOfUnits",$this->numberOfUnits,$this->domDocument,$rec);
		$this->setDocNode("acquisitionCost",$this->acquisitionCost,$this->domDocument,$rec);
		$this->setDocNode("freightCost",$this->freightCost,$this->domDocument,$rec);
		$this->setDocNode("insuranceCost",$this->insuranceCost,$this->domDocument,$rec);
		$this->setDocNode("installationCost",$this->installationCost,$this->domDocument,$rec);
		$this->setDocNode("othersCost",$this->othersCost,$this->domDocument,$rec);
		$this->setDocNode("depreciation",$this->depreciation,$this->domDocument,$rec);
		$this->setDocNode("totalDepreciation",$this->totalDepreciation,$this->domDocument,$rec);
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
	function getBuildingPin(){
		return $this->buildingPin;
	}
	function getLandPin(){
		return $this->landPin;
	}
	function getMachineryDescription(){
		return $this->machineryDescription;
	}
	function getBrand(){
		return $this->brand;
	}
	function getModelNumber(){
		return $this->modelNumber;
	}
	function getCapacity(){
		return $this->capacity;
	}
	function getDateAcquired(){
		return $this->dateAcquired;
	}
	function getConditionWhenAcquired(){
		return $this->conditionWhenAcquired;
	}
	function getEstimatedEconomicLife(){
		return $this->estimatedEconomicLife;
	}
	function getRemainingEconomicLife(){
		return $this->remainingEconomicLife;
	}
	function getDateOfInstallation(){
		return $this->dateOfInstallation;
	}
	function getDateOfOperation(){
		return $this->dateOfOperation;
	}
	function getRemarks(){
		return $this->remarks;
	}
	function getNumberOfUnits(){
		return $this->numberOfUnits;
	}
	function getAcquisitionCost(){
		return $this->acquisitionCost;
	}
	function getFreightCost(){
		return $this->freightCost;
	}
	function getInsuranceCost(){
		return $this->insuranceCost;
	}
	function getInstallationCost(){
		return $this->installationCost;
	}
	function getOthersCost(){
		return $this->othersCost;
	}
	function getTotalDepreciation(){
		return $this->totalDepreciation;
	}
	function getDepreciation(){
		return $this->depreciation;
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
		marketValue = (acquisitionCost
						+ freightCost
						+ insuranceCost
						+ installationCost
						+ othersCost)
					  * numberOfUnitss
		depreciatedMarketValue = marketValue - totalDepreciation
		adjustedMarketValue = depreciatedMarketValue
		assessedValue = roundToNearestTen[adjustedMarketValue * (assessmentLevel/100)]
	*/

	function calculateMarketValue(){
		$this->acquisitionCost = un_number_format($this->acquisitionCost);
		$this->freightCost = un_number_format($this->freightCost);
		$this->insuranceCost = un_number_format($this->insuranceCost);
		$this->installationCost = un_number_format($this->installationCost);
		$this->othersCost = un_number_format($this->othersCost);
		$this->numberOfUnits = un_number_format($this->numberOfUnits);

		$this->marketValue = ($this->acquisitionCost + $this->freightCost + $this->insuranceCost + $this->installationCost + $this->othersCost) * $this->numberOfUnits;
	}
	function calculateDepreciatedMarketValue(){
		$this->marketValue = un_number_format($this->marketValue);
		$this->totalDepreciation = un_number_format($this->totalDepreciation);

		$this->depreciatedMarketValue = $this->marketValue - $this->totalDepreciation;
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

	//other methods
	function selectRecord($propertyID){
		if ($propertyID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM  %s WHERE propertyID=%s;",
			MACHINERIES_TABLE, $propertyID);
		$this->db->query($sql);
		//echo $sql;
		$machineries = new Machineries;
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
				", kind".
				", dateOfOperation".
				", acquisitionCost".
				", depreciation".
				", totalDepreciation".
				", marketValue".
				", dateCreated".
				", createdBy".
				", dateModified".
				", modifiedBy".
				") ".
				"values (".
				"  '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".
				");"
                , MACHINERIES_TABLE
                , fixQuotes($this->afsID)
			    , fixQuotes($this->kind)
			    , fixQuotes($this->dateOfOperation)
			    , fixQuotes($this->acquisitionCost)
				, fixQuotes($this->depreciation)
				, fixQuotes($this->totalDepreciation)
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
				, MACHINERIES_TABLE
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
				
				", buildingPin".
				", landPin".
				", machineryDescription".
				", brand".
				", modelNumber".
				", capacity".
				", dateAcquired".
				", conditionWhenAcquired".
				", estimatedEconomicLife".
				", remainingEconomicLife".
				", dateOfInstallation".
				", dateOfOperation".
				", remarks".
				", numberOfUnits".
				", acquisitionCost".
				", freightCost".
				", insuranceCost".
				", installationCost".
				", othersCost".
				", depreciation".
				", totalDepreciation".
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
				", '%s'".
				");"
			, MACHINERIES_TABLE
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
			, fixQuotes($this->buildingPin)
			, fixQuotes($this->landPin)
			, fixQuotes($this->machineryDescription)
			, fixQuotes($this->brand)
			, fixQuotes($this->modelNumber)
			, fixQuotes($this->capacity)
			, fixQuotes($this->dateAcquired)
			, fixQuotes($this->conditionWhenAcquired)
			, fixQuotes($this->estimatedEconomicLife)
			, fixQuotes($this->remainingEconomicLife)
			, fixQuotes($this->dateOfInstallation)
			, fixQuotes($this->dateOfOperation)
			, fixQuotes($this->remarks)
			, fixQuotes($this->numberOfUnits)
			, fixQuotes($this->acquisitionCost)
			, fixQuotes($this->freightCost)
			, fixQuotes($this->insuranceCost)
			, fixQuotes($this->installationCost)
			, fixQuotes($this->othersCost)
			, fixQuotes($this->depreciation)
			, fixQuotes($this->totalDepreciation)
			, fixQuotes($this->depreciatedMarketValue)
			, fixQuotes(time())
			, fixQuotes($this->createdBy)
			, fixQuotes(time())
			, fixQuotes($this->modifiedBy)
			);
		//echo $sql;
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$landID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $landID;
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
				
				", buildingPin = '%s'".
				", landPin = '%s'".
				", machineryDescription = '%s'".
				", brand = '%s'".
				", modelNumber = '%s'".
				", capacity = '%s'".
				", dateAcquired = '%s'".
				", conditionWhenAcquired = '%s'".
				", estimatedEconomicLife = '%s'".
				", remainingEconomicLife = '%s'".
				", dateOfInstallation = '%s'".
				", dateOfOperation = '%s'".
				", remarks = '%s'".
				", numberOfUnits = '%s'".
				", acquisitionCost = '%s'".
				", freightCost = '%s'".
				", insuranceCost = '%s'".
				", installationCost = '%s'".
				", othersCost = '%s'".
				", depreciation = '%s'".
				", totalDepreciation = '%s'".
				", depreciatedMarketValue = '%s'".
				", dateModified = '%s'".
				", modifiedBy = '%s'".
			"where propertyID = '%s';"
			, MACHINERIES_TABLE
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
			, fixQuotes($this->buildingPin)
			, fixQuotes($this->landPin)
			, fixQuotes($this->machineryDescription)
			, fixQuotes($this->brand)
			, fixQuotes($this->modelNumber)
			, fixQuotes($this->capacity)
			, fixQuotes($this->dateAcquired)
			, fixQuotes($this->conditionWhenAcquired)
			, fixQuotes($this->estimatedEconomicLife)
			, fixQuotes($this->remainingEconomicLife)
			, fixQuotes($this->dateOfInstallation)
			, fixQuotes($this->dateOfOperation)
			, fixQuotes($this->remarks)
			, fixQuotes($this->numberOfUnits)
			, fixQuotes($this->acquisitionCost)
			, fixQuotes($this->freightCost)
			, fixQuotes($this->insuranceCost)
			, fixQuotes($this->installationCost)
			, fixQuotes($this->othersCost)
			, fixQuotes($this->depreciation)
			, fixQuotes($this->totalDepreciation)
			, fixQuotes($this->depreciatedMarketValue)
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
			MACHINERIES_TABLE, $propertyID);
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
			MACHINERIES_TABLE, $propertyID);
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
