<?php
//include files

include_once "./LocationAddress.php";
include_once "./Owner.php";
class OD
{
	//attributes
	var $odID;
	var $owner;//Owner Object
	var $locationAddress;//LocationAddress Object
	var $landArea;
	var $houseTagNumber;
	var $lotNumber;
	var $blockNumber;
	var $zoneNumber;
	var $psd13;
	var $affidavitOfOwnership;
	var $barangayCertificate;
	var $landTagging;
	var $dateCreated;
	var $createdBy;
	var $dateModified;
	var $modifiedBy;
	var $archive;

	var $transactionCode;

	var $oldODArray;
	var $domDocument;

	//constructor
	function OD(){
		//$this->locationAddress = new LocationAddress;
		//$this->owner = new Owner;
	}
	
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}
		
	function setOdID($tempVar){
		$this->odID = $tempVar;
	}
	function setOwner($tempVar){
		$this->owner = ($tempVar);
	}
	function setLocationAddress($tempVar){
		$this->locationAddress = $tempVar;
	}
	function setLandArea($tempVar){
		$this->landArea = $tempVar;
	}
	function setHouseTagNumber($tempVar){
		$this->houseTagNumber = $tempVar;
	}
	function setLotNumber($tempVar){
		$this->lotNumber = $tempVar;}
	
	function setBlockNumber($tempVar){
		$this->blockNumber = $tempVar;
	}
	function setZoneNumber($tempVar){
		$this->zoneNumber = $tempVar;
	}
	function setPsd13($tempVar){
		$this->psd13 = $tempVar;
	}
	function setAffidavitOfOwnership($tempVar){
		$this->affidavitOfOwnership = ($tempVar);
	}
	function setBarangayCertificate($tempVar){
		$this->barangayCertificate = ($tempVar);
	}
	function setLandTagging($tempVar){
		$this->landTagging = ($tempVar);
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
	function setTransactionCode($tempVar){
		$this->transactionCode = $tempVar;
	}
	function setOldODArray($tempVar){
		$this->oldODArray[] = $tempVar;
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
	function setArrayDocNode2 ($elementName,$childName,$arrayList,$indexNode){
		$list = $this->domDocument->create_element($elementName);
		$list = $indexNode->append_child($list);
		if (is_array($arrayList)){
			foreach ($arrayList as $key => $value){
				//echo $key."=>".$value."<br>";
				$nodeName = "";
				$nodeText = "";
				$nodeName = $this->domDocument->create_element($childName);
				$nodeName = $list->append_child($nodeName);
				$nodeText = $this->domDocument->create_text_node(htmlentities($value));
				$nodeText = $nodeName->append_child($nodeText);
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
	function setDomDocument (){
		$this->domDocument = domxml_new_doc("1.0");
		$rec = $this->domDocument->create_element("OD");
		$rec = $this->domDocument->append_child($rec);
		$this->setDocNode("odID",$this->odID,$this->domDocument,$rec);
		//if (count($this->ownerArray)) $this->setArrayDocNode("ownerArray",$this->ownerArray,"getDomDocument",$rec);
		if (is_a($this->locationAddress,LocationAddress)&&($this->locationAddress<>"")){
			//print_r($this->locationAddress);
			//echo $this->locationAddress->domDocument->dump_mem(true);
			$this->setObjectDocNode("locationAddressArray",$this->locationAddress,$this->domDocument,$rec,"LocationAddress");
		}
		if (is_a($this->owner,Owner)&&($this->owner<>"")){
			$this->setObjectDocNode("ownerArray",$this->owner,$this->domDocument,$rec,"Owner");
		}
		//if (count($this->locationAddress)) $this->setArrayDocNode("locationAddress",$this->locationAddress,"getDomDocument",$rec);
		$this->setDocNode("landArea",$this->landArea,$this->domDocument,$rec);
		$this->setDocNode("houseTagNumber",$this->houseTagNumber,$this->domDocument,$rec);
		$this->setDocNode("lotNumber",$this->lotNumber,$this->domDocument,$rec);
		$this->setDocNode("blockNumber",$this->blockNumber,$this->domDocument,$rec);
		$this->setDocNode("zoneNumber",$this->zoneNumber,$this->domDocument,$rec);
		$this->setDocNode("psd13",$this->psd13,$this->domDocument,$rec);
		$this->setDocNode("affidavitOfOwnership",$this->affidavitOfOwnership,$this->domDocument,$rec);
		$this->setDocNode("barangayCertificate",$this->barangayCertificate,$this->domDocument,$rec);
		$this->setDocNode("landTagging",$this->landTagging,$this->domDocument,$rec);
		$this->setDocNode("dateCreated",$this->dateCreated,$this->domDocument,$rec);
		$this->setDocNode("createdBy",$this->createdBy,$this->domDocument,$rec);
		$this->setDocNode("dateModified",$this->dateModified,$this->domDocument,$rec);
		$this->setDocNode("modifiedBy",$this->modifiedBy,$this->domDocument,$rec);
		$this->setDocNode("archive",$this->archive,$this->domDocument,$rec);
		$this->setDocNode("transactionCode",$this->transactionCode,$this->domDocument,$rec);
		if (count($this->oldODArray))
			$this->setArrayDocNode2("oldODArray","oldOD",$this->oldODArray,$rec);
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
						case "ownerArray":
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
						case "locationAddressArray":
							//echo "locationAddress<br>";
							$locationAddressNode = $child->first_child();

							while ($locationAddressNode){
								//if ($locationAddressNode->tagname=="locationAddress") {
								if ($locationAddressNode->tagname) {
									$tempXmlStr = $domDoc->dump_node($locationAddressNode);
									$tempDomDoc = domxml_open_mem($tempXmlStr);
									$locationAddress = new LocationAddress;
									$ret = $locationAddress->parseDomDocument($tempDomDoc);
									$this->locationAddress = $locationAddress;
								}
								$locationAddressNode = $locationAddressNode->next_sibling();
							}

							break;
						case "oldODArray":
							$oldODNode = $child->first_child();
							
							while ($oldODNode){
								if ($oldODNode->tagname) {
									$this->oldODArray[] = html_entity_decode($oldODNode->get_content());
								}
								$oldODNode = $oldODNode->next_sibling();
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
	//get
	function getOdID(){
		return $this->odID;
	}
	function getLocationAddress(){
		return $this->locationAddress;
	}
	function getLandArea(){
		return $this->landArea;
	}
	function getHouseTagNumber(){
		return $this->houseTagNumber;
	}
	function getLotNumber(){
		return $this->lotNumber;
	}	
	function getZoneNumber(){
		return $this->zoneNumber;
	}	
	function getBlockNumber(){
		return $this->blockNumber;
	}
	function getPsd13(){
		return $this->psd13;
	}
	function getAffidavitOfOwnership(){
		return $this->affidavitOfOwnership;
	}
	function getBarangayCertificate(){
		return $this->barangayCertificate;
	}	
	function getLandTagging(){
		return $this->landTagging;
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
	function getTransactionCode(){
		return $this->transactionCode;
	}
	function getOwnerArray(){
		return $this->ownerArray;
	}
	function getOwner(){
		return $this->owner;
	}
	function getOldODArray(){
		return $this->oldODArray;
	}
	
	//DB functions
	function selectRecord($odID){
		if ($odID=="") return;
		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE odID=%s;",
			OD_TABLE, $odID);
		$this->db->query($sql);
		if ($this->db->next_record()) {
			$this->setOdID($this->db->f("odID"));
			$this->setLandArea($this->db->f("landArea"));
			$this->setHouseTagNumber($this->db->f("houseTagNumber"));
			$this->setLotNumber($this->db->f("lotNumber"));
			$this->setZoneNumber($this->db->f("zoneNumber"));
			$this->setBlockNumber($this->db->f("blockNumber"));
			$this->setPsd13($this->db->f("psd13"));
			$this->setAffidavitOfOwnership($this->db->f("affidavitOfOwnership"));
			$this->setBarangayCertificate($this->db->f("barangayCertificate"));
			$this->setLandTagging($this->db->f("landTagging"));
			$this->setDateCreated($this->db->f("dateCreated"));
			$this->setCreatedBy($this->db->f("createdBy"));
			$this->setDateModified($this->db->f("dateModified"));
			$this->setModifiedBy($this->db->f("modifiedBy"));
			$this->setArchive($this->db->f("archive"));
			$this->setTransactionCode($this->db->f("transactionCode"));

			$sql = sprintf("SELECT ownerID FROM %s WHERE odID = %s;",
				OWNER_TABLE, $this->odID);
			$this->db->query($sql);
			while ($this->db->next_record()) {
				$owner = new Owner;
				$owner->selectRecord($this->db->f("ownerID"));
				$this->owner = $owner;
			}
			$sql = sprintf("SELECT locationAddressID FROM %s WHERE odID = %s;",
				LOCATION_TABLE, $this->odID);
			$this->db->query($sql);
			while ($this->db->next_record()) {
				$locationAddress = new LocationAddress;
				$locationAddress->selectRecord($this->db->f("locationAddressID"));
				$this->locationAddress = $locationAddress;
			}
			$sql = sprintf("SELECT previousOdID FROM %s WHERE presentOdID = %s;",
				ODHISTORY_TABLE, $this->odID);
			$this->db->query($sql);
			while ($this->db->next_record()) {
				$this->oldODArray[] = $this->db->f("previousOdID");
			}
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
		
	}

	function insertRecordForBuildup(){
		$sql = sprintf("insert into %s (".
			"lotNumber".
			", blockNumber".
			", dateCreated".
			", createdBy".
			", dateModified".
			", modifiedBy".
			", archive".
			", transactionCode".
			") values ('%s','%s','%s','%s','%s','%s','%s','%s');",
			OD_TABLE
			, fixQuotes($this->lotNumber)
			, fixQuotes($this->blockNumber)
			, fixQuotes(time())
			, fixQuotes($this->createdBy)
			, fixQuotes(time())
			, fixQuotes($this->modifiedBy)
			, fixQuotes($this->archive)
			, fixQuotes($this->transactionCode)
		);
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$odID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$owner = new Owner;
			$owner->insertRecord($odID,"od");
			if (is_a($this->locationAddress,LocationAddress)){
				$locationAddressID = $this->locationAddress->insertRecord();
				$sql = sprintf("insert into %s (".
					"odID".
					", locationAddressID".
					") values ('%s', '%s');",
					LOCATION_TABLE
					, fixQuotes($odID)
					, fixQuotes($locationAddressID)
				);
				$this->db->beginTransaction();
				$this->db->query($sql);
				$locationID = $this->db->insert_id();
				if ($this->db->Errno!=0) {
					$this->db->rollbackTransaction();
					$this->db->resetErrors();
					$ret = false;
				}
				else {
					$this->db->endTransaction();
				}
			}
			$ret = $odID;
		}
		return $ret;
	}
	
	function insertRecord(){
		$sql = sprintf("insert into %s (".
			" landArea".
			", houseTagNumber".
			", lotNumber".
			", zoneNumber".
			", blockNumber".
			", psd13".
			", affidavitOfOwnership".
			", barangayCertificate".
			", landTagging".
			", dateCreated".
			", createdBy".
			", dateModified".
			", modifiedBy".
			", archive".
			", transactionCode".
			") values ('%s','%s','%s','%s','%s','%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
			OD_TABLE
			, fixQuotes($this->landArea)
			, fixQuotes($this->houseTagNumber)
			, fixQuotes($this->lotNumber)
			, fixQuotes($this->zoneNumber)
			, fixQuotes($this->blockNumber)
			, fixQuotes($this->psd13)
			, fixQuotes($this->affidavitOfOwnership)
			, fixQuotes($this->barangayCertificate)
			, fixQuotes($this->landTagging)
			, fixQuotes(time())
			, fixQuotes($this->createdBy)
			, fixQuotes(time())
			, fixQuotes($this->modifiedBy)
			, fixQuotes($this->archive)
			, fixQuotes($this->transactionCode)
		);
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$odID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$owner = new Owner;
			$this->newOwnerID = $owner->insertRecord($odID,"od");

			if (is_a($this->locationAddress,LocationAddress)){
				$locationAddressID = $this->locationAddress->insertRecord();
				$sql = sprintf("insert into %s (".
					"odID".
					", locationAddressID".
					") values ('%s', '%s');",
					LOCATION_TABLE
					, fixQuotes($odID)
					, fixQuotes($locationAddressID)
				);
				$this->db->beginTransaction();
				$this->db->query($sql);
				$locationID = $this->db->insert_id();
				if ($this->db->Errno!=0) {
					$this->db->rollbackTransaction();
					$this->db->resetErrors();
					$ret = false;
				}
				else {
					$this->db->endTransaction();
				}
			}
			foreach ($this->oldODArray as $key => $value){
				$sql = sprintf("insert into %s (".
					"previousOdID".
					", presentOdID".
					", transactionCode".
					") values ('%s', '%s', '%s');",
					ODHISTORY_TABLE
					, fixQuotes($value)
					, fixQuotes($odID)
					, fixQuotes($this->transactionCode)
				);
				$this->db->beginTransaction();
				$this->db->query($sql);
				$locationID = $this->db->insert_id();
				if ($this->db->Errno!=0) {
					$this->db->rollbackTransaction();
					$this->db->resetErrors();
					$ret = false;
				}
				else {
					$this->db->endTransaction();
				}
			}
			$ret = $odID;
		}
		return $ret;
	}

	function updateRecord(){
		$sql = sprintf("update %s ".
			"set landArea = '%s'".
			", houseTagNumber = '%s'".
			", lotNumber = '%s'".
			", zoneNumber = '%s'".
			", blockNumber = '%s'".
			", psd13 = '%s'".
			", affidavitOfOwnership = '%s'".
			", barangayCertificate = '%s'".
			", landTagging = '%s'".
			", dateModified = '%s'".
			", modifiedBy = '%s'".
			", archive = '%s'".
			" where odID = '%s';",
			OD_TABLE
			, fixQuotes($this->landArea)
			, fixQuotes($this->houseTagNumber)
			, fixQuotes($this->lotNumber)
			, fixQuotes($this->zoneNumber)
			, fixQuotes($this->blockNumber)
			, fixQuotes($this->psd13)
			, fixQuotes($this->affidavitOfOwnership)
			, fixQuotes($this->barangayCertificate)
			, fixQuotes($this->landTagging)
			, fixQuotes(time())
			, fixQuotes($this->modifiedBy)
			, fixQuotes($this->archive)
			, $this->odID);
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
			if (is_a($this->locationAddress,LocationAddress)){
				$locationAddressID = $this->locationAddress->updateRecord();
			}
			$ret = $this->odID;
		}
		return $ret;
	}
	
	function deleteOD(){
		
	}

	function cancelRecord($odID,$archiveValue,$userID,$transactionCode){
		$sql = sprintf("update %s ".
			"  set ".
			"  transactionCode = '%s'".
			", archive = '%s'".
			", modifiedBy = '%s'".
			", dateModified = '%s'".
			" where odID = '%s';",
			OD_TABLE
			, fixQuotes($transactionCode)
			, fixQuotes($archiveValue)
			, fixQuotes($userID)
			, fixQuotes(time())
			, fixQuotes($odID)
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

	function archiveRecord($odID,$archiveValue,$userID){
		$sql = sprintf("update %s ".
			"  set ".
			"  archive = '%s'".
			", modifiedBy = '%s'".
			", dateModified = '%s'".
			" where odID = '%s';",
			OD_TABLE
			, fixQuotes($archiveValue)
			, fixQuotes($userID)
			, fixQuotes(time())
			, fixQuotes($odID)
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
	
}

?>
