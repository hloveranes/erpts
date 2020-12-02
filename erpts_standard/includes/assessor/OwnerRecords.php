<?php
class OwnerRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function OwnerRecords(){
	
	}
		
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	function setArrayList($tempVar){
		$this->arrayList[] = $tempVar;
	}
	
	function getArrayList(){
		return $this->arrayList;
	}
	
	function getDomDocument(){
		return $this->domDocument;
	}
	
	function appendToDomList($rootNode,$childNode){
		//$rootNode->append_child($childNode->document_element());

		// test clone_node()
		$nodeTmp = $childNode->document_element();
		$nodeClone = $nodeTmp->clone_node(true);
		$rootNode->append_child($nodeClone);
	}
		
	function setDomDocument(){
		$this->domDocument = domxml_new_doc("1.0");
		$domList = $this->domDocument->create_element("ArrayList");
		$domList = $this->domDocument->append_child($domList);
		foreach($this->arrayList as $key => $value){
			$domOwner = $value->getDomDocument();
			$this->appendToDomList($domList,$domOwner);
		}
		return true;
	}
	
	///*
	function parseDomDocument($domDoc){
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//if ($child->tagname=="Owner") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$owner = new Owner;
					$owner->parseDomDocument($tempDomDoc);
					$this->setArrayList($owner);
				}
				$child = $child->next_sibling();
			}
		}
		$this->setDomDocument();
		return true;
	}//*/
	
	function selectRecord($ownerID){
		$sql = sprintf("select ownerID from %s where ownerID=%s",
				 OWNER_TABLE, $ownerID);
		$this->setDB();
		$this->db->query($sql);
		if ($this->db->next_record()) {
			$ownerID = $this->db->f("ownerID");
			$owner = new Owner;
			$owner->selectRecord($ownerID);
			$this->arrayList[] = $owner;
			$this->setDomDocument();
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}
	
	function selectRecords($condition=""){
		$sql = sprintf("select * from %s %s;",
				OWNER_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$owner = new Owner;
			$owner->selectRecord($this->db->f("ownerID"));
			$this->arrayList[] = $owner;
		}
		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			$ret = true;
		}
		else {
			$ret = false;
		}
		return $ret;
	}
	
	function deleteRecords($ownerIDArray=""){
		$owner = new Owner;
		$rows = 0;
		foreach ($ownerIDArray as $key => $value){
			if ($owner->deleteOwner($value)) $rows++;
		}
		return $rows;
	}
	
	function removeOwnerPersonRecords($ownerID, $personIDArray=""){
		$person = new Person;
		$rows = 0;
		if (count($personIDArray)){
			foreach ($personIDArray as $key => $value){
				if ($person->removeOwnerPerson($ownerID,$value)) $rows++;
			}
		}
		return $rows;
	}
	
	function removeOwnerCompanyRecords($ownerID, $companyIDArray=""){
		$rows = 0;
		if (count($companyIDArray)){
			foreach ($companyIDArray as $key => $value){
				$company = new Company;
				if ($company->removeOwnerCompany($ownerID,$value)) $rows++;
			}
		}
		return $rows;
	}	

	// use the following functions for RPTOPBatchEncode functions
	// added March 02, 2004

	// bypasses xml for faster processing

	function getOwnerRPTOPArray($id,$type,$year){
		// id refers to either personID or companyID
		// depending on type which is either Person or Company
		// filtered by year

		if($id=="") return false;
		if($type=="") return false;
		if($year=="") return false;

		$db = new DB_RPTS;

		switch($type){
			case "Person":
				$sql = sprintf("SELECT ".RPTOP_TABLE.".rptopID as rptopID, ".RPTOP_TABLE.".rptopNumber as rptopNumber FROM ".RPTOP_TABLE.", ".OWNER_TABLE.", ".OWNER_PERSON_TABLE." WHERE ".RPTOP_TABLE.".rptopID = ".OWNER_TABLE.".rptopID AND ".OWNER_TABLE.".ownerID = ".OWNER_PERSON_TABLE.".ownerID AND ".OWNER_PERSON_TABLE.".personID='%s' AND ".RPTOP_TABLE.".taxableYear>='%s'",$id,$year);
				break;
			case "Company":
				$sql = sprintf("SELECT ".RPTOP_TABLE.".rptopID, ".RPTOP_TABLE.".rptopNumber FROM ".RPTOP_TABLE.", ".OWNER_TABLE.", ".OWNER_COMPANY_TABLE." WHERE ".RPTOP_TABLE.".rptopID = ".OWNER_TABLE.".rptopID AND ".OWNER_TABLE.".ownerID = ".OWNER_COMPANY_TABLE.".ownerID AND ".OWNER_COMPANY_TABLE.".companyID='%s' AND ".RPTOP_TABLE.".taxableYear>='%s'",$id,$year);
				break;
		}

		$db->query($sql);

		if($db->next_record()) {
			$ownerRPTOP["rptopID"] = $db->f("rptopID");
			$ownerRPTOP["rptopNumber"] = $db->f("rptopNumber");
			return $ownerRPTOP;
		}
		else{
			return false;
		}
	}

	function getOwnerTDYear($id,$type,$year){
		// id refers to either personID or companyID
		// depending on type which is either Person or Company
		// filtered by year

		if($id=="") return false;
		if($type=="") return false;
		if($year=="") return false;

		$db = new DB_RPTS;

		switch($type){
			case "Person":
				$sql = sprintf("SELECT DISTINCT(".TD_TABLE.".taxBeginsWithTheYear) as taxBeginsWithTheYear FROM ".TD_TABLE." ,".AFS_TABLE.", ".OD_TABLE.", ".OWNER_TABLE.", ".OWNER_PERSON_TABLE." WHERE ".TD_TABLE.".afsID = ".AFS_TABLE.".afsID AND ".AFS_TABLE.".odID = ".OD_TABLE.".odID AND ".OD_TABLE.".odID = ".OWNER_TABLE.".odID AND ".OWNER_TABLE.".ownerID = ".OWNER_PERSON_TABLE.".ownerID AND ".OWNER_PERSON_TABLE.".personID = '%s' AND ".TD_TABLE.".taxBeginsWithTheYear = '%s'",$id,$year);
				break;
			case "Company":
				$sql = sprintf("SELECT DISTINCT(".TD_TABLE.".taxBeginsWithTheYear) as taxBeginsWithTheYear FROM ".TD_TABLE." ,".AFS_TABLE.", ".OD_TABLE.", ".OWNER_TABLE.", ".OWNER_COMPANY_TABLE." WHERE ".TD_TABLE.".afsID = ".AFS_TABLE.".afsID AND ".AFS_TABLE.".odID = ".OD_TABLE.".odID AND ".OD_TABLE.".odID = ".OWNER_TABLE.".odID AND ".OWNER_TABLE.".ownerID = ".OWNER_COMPANY_TABLE.".ownerID AND ".OWNER_COMPANY_TABLE.".companyID = '%s' AND ".TD_TABLE.".taxBeginsWithTheYear = '%s'",$id,$year);
				break;
		}

		$db->query($sql);

		if($db->next_record()) {
			$taxBeginsWithTheYear = $db->f("taxBeginsWithTheYear");
			return $taxBeginsWithTheYear;
		}
		else{
			return false;
		}
	}

	function getOwnerTDArray($id,$type,$year){
		// id refers to either personID or companyID
		// depending on type which is either Person or Company
		// filtered by year

		if($id=="") return false;
		if($type=="") return false;
		if($year=="") return false;

		$db = new DB_RPTS;

		switch($type){
			case "Person":
				$sql = sprintf("SELECT DISTINCT(".TD_TABLE.".tdID) as tdID, ".TD_TABLE.".taxDeclarationNumber as taxDeclarationNumber, ".TD_TABLE.".taxBeginsWithTheYear as taxBeginsWithTheYear FROM ".TD_TABLE.", ".AFS_TABLE.", ".OD_TABLE.", ".OWNER_TABLE.", ".OWNER_PERSON_TABLE." WHERE ".TD_TABLE.".afsID = ".AFS_TABLE.".afsID AND ".AFS_TABLE.".odID = ".OD_TABLE.".odID AND ".OD_TABLE.".odID = ".OWNER_TABLE.".odID AND ".OWNER_TABLE.".ownerID = ".OWNER_PERSON_TABLE.".ownerID AND ".OWNER_PERSON_TABLE.".personID = '%s' AND TD.taxBeginsWithTheYear='%s'", $id,$year);
				break;
			case "Company":
				$sql = sprintf("SELECT DISTINCT(".TD_TABLE.".tdID), ".TD_TABLE.".taxDeclarationNumber, ".TD_TABLE.".taxBeginsWithTheYear FROM ".TD_TABLE.", ".AFS_TABLE.", ".OD_TABLE.", ".OWNER_TABLE.", ".OWNER_COMPANY_TABLE." WHERE ".TD_TABLE.".afsID = ".AFS_TABLE.".afsID AND ".AFS_TABLE.".odID = ".OD_TABLE.".odID AND ".OD_TABLE.".odID = ".OWNER_TABLE.".odID AND ".OWNER_TABLE.".ownerID = ".OWNER_COMPANY_TABLE.".ownerID AND ".OWNER_COMPANY_TABLE.".companyID = '%s' AND TD.taxBeginsWithTheYear='%s'", $id,$year);
				break;
		}

		$db->query($sql);

		while ($db->next_record()) {
			$ownerTD["tdID"] = $db->f("tdID");
			$ownerTD["taxDeclarationNumber"] = $db->f("taxDeclarationNumber");
			$ownerTD["taxBeginsWithTheYear"] = $db->f("taxBeginsWithTheYear");

			$key = $ownerTD["tdID"];
			$ownerTDArray[$key] = $ownerTD;
			unset($ownerTD);
		}

		// key sort

		if(is_array($ownerTDArray)){
			ksort($ownerTDArray);
			reset($ownerTDArray);
			return $ownerTDArray;
		}
		else{
			return false;
		}
	}

	function getOwnerNameArray($year){
		$this->setDB();

		// gather ownerPersons

		$sql = "SELECT DISTINCT ".PERSON_TABLE.".personID as personID, ".PERSON_TABLE.".firstName as firstName, ".PERSON_TABLE.".lastName as lastName, ".PERSON_TABLE.".middleName as middleName FROM ".OWNER_TABLE.", ".OWNER_PERSON_TABLE.", Person WHERE ".OWNER_TABLE.".ownerID = ".OWNER_PERSON_TABLE.".ownerID AND ".OWNER_PERSON_TABLE.".personID = ".PERSON_TABLE.".personID ORDER BY ".PERSON_TABLE.".lastName";
		$this->db->query($sql);

		while ($this->db->next_record()) {
			$personNames["id"] = $this->db->f("personID");
			$personNames["ownerName"] = $this->db->f("lastName").", ".$this->db->f("firstName")." ".$this->db->f("middleName");
			$personNames["type"] = "Person";

			// check if owner has TDs
			//if($personNames["ownerTDArray"] = $this->getOwnerTDArray($this->db->f("personID"), "Person", $year)){

				if($personNames["tdYear"] = $this->getOwnerTDYear($this->db->f("personID"), "Person", $year)){

					// check if owner has RPTOP for $year
					// if false, append to ownerNameArray
	
					if(!$personNames["ownerRPTOPArray"] = $this->getOwnerRPTOPArray($this->db->f("personID"), "Person", $year)){
						$key = $this->db->f("lastName").$this->db->f("firstName").$this->db->f("middleName").$personNames["id"];
						$ownerNameArray[$key] = $personNames;
					}

				}

			//}
			unset($personNames);
		}

		// gather ownerCompanies

		$sql = "SELECT DISTINCT ".COMPANY_TABLE.".companyID as companyID, ".COMPANY_TABLE.".companyName FROM ".OWNER_TABLE.", ".OWNER_COMPANY_TABLE.", ".COMPANY_TABLE." WHERE ".OWNER_TABLE.".ownerID = ".OWNER_COMPANY_TABLE.".ownerID AND ".OWNER_COMPANY_TABLE.".companyID = ".COMPANY_TABLE.".companyID";

		$this->db->query($sql);

		while ($this->db->next_record()) {
			$companyNames["id"] = $this->db->f("companyID");
			$companyNames["ownerName"] = $this->db->f("companyName");
			$companyNames["type"] = "Company";

			// conditions commented out for faster processing:

			// check if owner has TDs
			//if($companyNames["ownerTDArray"] = $this->getOwnerTDArray($this->db->f("companyID"), "Company", $year)){

				if($companyNames["tdYear"] = $this->getOwnerTDYear($this->db->f("companyID"), "Company", $year)){

					// check if owner has RPTOP for particular tdArray of year
					// if false, append to ownerNameArray
				
					if(!$companyNames["ownerRPTOPArray"] = $this->getOwnerRPTOPArray($this->db->f("personID"), "Person", $year)){
						$key = $companyNames["ownerName"].$companyNames["id"];
						$ownerNameArray[$key] = $companyNames;
					}

				}
			//}
			unset($companyNames);
		}

		// key sort

		if(is_array($ownerNameArray)){
			ksort($ownerNameArray);
			reset($ownerNameArray);

			return $ownerNameArray;
		}
		else{
			return false;
		}
	}

}
?>