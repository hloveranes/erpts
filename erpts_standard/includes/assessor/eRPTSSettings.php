<?php

include_once "../web/prepend.php";

class eRPTSSettings
{
	//attributes

	var $eRPTSSettingsID;
	var $lguName;
	var $lguType;

	var $chiefExecutiveDesignation;
	var $chiefExecutiveFirstName;
	var $chiefExecutiveMiddleName;
	var $chiefExecutiveLastName;

	var $assessorDesignation;
	var $assessorFirstName;
	var $assessorMiddleName;
	var $assessorLastName;

	var $treasurerDesignation;
	var $treasurerFirstName;
	var $treasurerMiddleName;
	var $treasurerLastName;

	var $provincialAssessorDesignation;
	var $provincialAssessorFirstName;
	var $provincialAssessorMiddleName;
	var $provincialAssessorLastName;

	var $provincialTreasurerDesignation;
	var $provincialTreasurerFirstName;
	var $provincialTreasurerMiddleName;
	var $provincialTreasurerLastName;
	
	var $ordinanceNo;  // RC 20091007 Added for standardization
	var $ordinanceDate;

	var $domDocument;
	var $db;
	
	//constructor
	function eRPTSSettings() {
	
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}

	function setERPTSSettingsID($tempVar){
		$this->eRPTSSettingsID = $tempVar;
	}
	function setLguName($tempVar){
		$this->lguName = $tempVar;
	}
	function setLguType($tempVar){
		$this->lguType = $tempVar;
	}
	function setChiefExecutiveDesignation($tempVar){
		$this->chiefExecutiveDesignation = $tempVar;
	}
	function setChiefExecutiveFirstName($tempVar){
		$this->chiefExecutiveFirstName = $tempVar;
	}
	function setChiefExecutiveMiddleName($tempVar){
		$this->chiefExecutiveMiddleName = $tempVar;
	}
	function setChiefExecutiveLastName($tempVar){
		$this->chiefExecutiveLastName = $tempVar;
	}
	function setAssessorDesignation($tempVar){
		$this->assessorDesignation = $tempVar;
	}
	function setAssessorFirstName($tempVar){
		$this->assessorFirstName = $tempVar;
	}
	function setAssessorMiddleName($tempVar){
		$this->assessorMiddleName = $tempVar;
	}
	function setAssessorLastName($tempVar){
		$this->assessorLastName = $tempVar;
	}
	function setTreasurerDesignation($tempVar){
		$this->treasurerDesignation = $tempVar;
	}
	function setTreasurerFirstName($tempVar){
		$this->treasurerFirstName = $tempVar;
	}
	function setTreasurerMiddleName($tempVar){
		$this->treasurerMiddleName = $tempVar;
	}
	function setTreasurerLastName($tempVar){
		$this->treasurerLastName = $tempVar;
	}
	function setProvincialAssessorDesignation($tempVar){
		$this->provincialAssessorDesignation = $tempVar;
	}
	function setProvincialAssessorFirstName($tempVar){
		$this->provincialAssessorFirstName = $tempVar;
	}
	function setProvincialAssessorLastName($tempVar){
		$this->provincialAssessorLastName = $tempVar;
	}
	function setProvincialAssessorMiddleName($tempVar){
		$this->provincialAssessorMiddleName = $tempVar;
	}
	function setProvincialTreasurerDesignation($tempVar){
		$this->provincialTreasurerDesignation = $tempVar;
	}
	function setProvincialTreasurerFirstName($tempVar){
		$this->provincialTreasurerFirstName = $tempVar;
	}
	function setProvincialTreasurerLastName($tempVar){
		$this->provincialTreasurerLastName = $tempVar;
	}
	function setProvincialTreasurerMiddleName($tempVar){
		$this->provincialTreasurerMiddleName = $tempVar;
	}
	function setOrdinanceNo($tempVar){  //RC 20091007 Added for standardization
		$this->ordinanceNo = $tempVar;
	}
	function setOrdinanceDate($tempVar){  //RC 20091007 Added for standardization
		$this->ordinanceDate = $tempVar;
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
		$rec = $this->domDocument->create_element("eRPTSSettings");
		$rec = $this->domDocument->append_child($rec);

		$this->setDocNode("eRPTSSettingsID",$this->eRPTSSettingsID,$this->domDocument,$rec);
		$this->setDocNode("lguName",$this->lguName,$this->domDocument,$rec);
		$this->setDocNode("lguType",$this->lguType,$this->domDocument,$rec);
		$this->setDocNode("chiefExecutiveDesignation",$this->chiefExecutiveDesignation,$this->domDocument,$rec);
		$this->setDocNode("chiefExecutiveFirstName",$this->chiefExecutiveFirstName,$this->domDocument,$rec);
		$this->setDocNode("chiefExecutiveMiddleName",$this->chiefExecutiveMiddleName,$this->domDocument,$rec);
		$this->setDocNode("chiefExecutiveLastName",$this->chiefExecutiveLastName,$this->domDocument,$rec);

		$this->setDocNode("assessorDesignation",$this->assessorDesignation,$this->domDocument,$rec);
		$this->setDocNode("assessorFirstName",$this->assessorFirstName,$this->domDocument,$rec);
		$this->setDocNode("assessorMiddleName",$this->assessorMiddleName,$this->domDocument,$rec);
		$this->setDocNode("assessorLastName",$this->assessorLastName,$this->domDocument,$rec);

		$this->setDocNode("treasurerDesignation",$this->treasurerDesignation,$this->domDocument,$rec);
		$this->setDocNode("treasurerFirstName",$this->treasurerFirstName,$this->domDocument,$rec);
		$this->setDocNode("treasurerMiddleName",$this->treasurerMiddleName,$this->domDocument,$rec);
		$this->setDocNode("treasurerLastName",$this->treasurerLastName,$this->domDocument,$rec);

		$this->setDocNode("provincialAssessorDesignation",$this->provincialAssessorDesignation,$this->domDocument,$rec);
		$this->setDocNode("provincialAssessorFirstName",$this->provincialAssessorFirstName,$this->domDocument,$rec);
		$this->setDocNode("provincialAssessorMiddleName",$this->provincialAssessorMiddleName,$this->domDocument,$rec);
		$this->setDocNode("provincialAssessorLastName",$this->provincialAssessorLastName,$this->domDocument,$rec);

		$this->setDocNode("provincialTreasurerDesignation",$this->provincialTreasurerDesignation,$this->domDocument,$rec);
		$this->setDocNode("provincialTreasurerFirstName",$this->provincialTreasurerFirstName,$this->domDocument,$rec);
		$this->setDocNode("provincialTreasurerMiddleName",$this->provincialTreasurerMiddleName,$this->domDocument,$rec);
		$this->setDocNode("provincialTreasurerLastName",$this->provincialTreasurerLastName,$this->domDocument,$rec);

		$this->setDocNode("ordinanceNo",$this->ordinanceNo,$this->domDocument,$rec);  // RC 20091007
		$this->setDocNode("ordinanceDate",$this->ordinanceDate,$this->domDocument,$rec);  // RC 20091007
		}
	function parseDomDocument($domDoc){
		$ret = true;
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
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
	function getERPTSSettingsID(){
		return $this->eRPTSSettingsID;
	}
	function getLguName(){
		return $this->lguName;
	}
	function getLguType(){
		return $this->lguType;
	}
	function getChiefExecutiveDesignation(){
		return $this->chiefExecutiveDesignation;
	}
	function getChiefExecutiveFirstName(){
		return $this->chiefExecutiveFirstName;
	}
	function getChiefExecutiveMiddleName(){
		return $this->chiefExecutiveMiddleName;
	}
	function getChiefExecutiveLastName(){
		return $this->chiefExecutiveLastName;
	}
	function getAssessorDesignation(){
		return $this->assessorDesignation;
	}
	function getAssessorFirstName(){
		return $this->assessorFirstName;
	}
	function getAssessorMiddleName(){
		return $this->assessorMiddleName;
	}
	function getAssessorLastName(){
		return $this->assessorLastName;
	}
	function getTreasurerDesignation(){
		return $this->treasurerDesignation;
	}
	function getTreasurerFirstName(){
		return $this->treasurerFirstName;
	}
	function getTreasurerMiddleName(){
		return $this->treasurerMiddleName;
	}
	function getTreasurerLastName(){
		return $this->treasurerLastName;
	}
	function getProvincialAssessorDesignation(){
		return $this->provincialAssessorDesignation;
	}
	function getProvincialAssessorFirstName(){
		return $this->provincialAssessorFirstName;
	}
	function getProvincialAssessorMiddleName(){
		return $this->provincialAssessorMiddleName;
	}
	function getProvincialAssessorLastName(){
		return $this->provincialAssessorLastName;
	}
	function getProvincialTreasurerDesignation(){
		return $this->provincialTreasurerDesignation;
	}
	function getProvincialTreasurerFirstName(){
		return $this->provincialTreasurerFirstName;
	}
	function getProvincialTreasurerMiddleName(){
		return $this->provincialTreasurerMiddleName;
	}
	function getProvincialTreasurerLastName(){
		return $this->provincialTreasurerLastName;
	}
	function getOrdinanceNo(){  //RC 20091007 Added for standardization
		return $this->ordinanceNo;
	}
	function getOrdinanceDate(){  //RC 20091007 Added for standardization
		return $this->ordinanceDate;
	}
	
	function getChiefExecutiveFullName(){
		$fullName = $this->chiefExecutiveLastName .", ". $this->chiefExecutiveFirstName ." ". $this->chiefExecutiveMiddleName;
		return $fullName;
	}
	function getAssessorFullName(){
		$fullName = $this->assessorFirstName ."  ". $this->assessorMiddleName ." ". $this->assessorLastName;
		return $fullName;
	}
	function getTreasurerFullName(){
		$fullName = $this->treasurerFirstName ."  ". $this->treasurerMiddleName ." ". $this->treasurerLastName;
		return $fullName;
	}
	function getProvincialAssessorFullName(){
		$fullName = $this->provincialAssessorFirstName. "  ". $this->provincialAssessorMiddleName . " ". $this->provincialAssessorLastName;
		return $fullName;
	}
	function getProvincialTreasurerFullName(){
		$fullName = $this->provincialTreasurerFirstName. "  ". $this->provincialAssessorMiddleName . " ". $this->provincialTreasurerLastName;
		return $fullName;
	}

	//DB
	function selectRecord($eRPTSSettingsID=1){
		if ($eRPTSSettingsID==""){
			return;
		}

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE eRPTSSettingsID=%s;",
			ERPTS_SETTINGS_TABLE, $eRPTSSettingsID);

		$this->db->query($sql);
		$erptsSettings = new eRPTSSettings;
		if ($this->db->next_record()) {
			//*

			$this->eRPTSSettingsID = $this->db->f("eRPTSSettingsID");
			$this->lguName = $this->db->f("lguName");
			$this->lguType = $this->db->f("lguType");
			$this->chiefExecutiveDesignation = $this->db->f("chiefExecutiveDesignation");
			$this->chiefExecutiveFirstName = $this->db->f("chiefExecutiveFirstName");
			$this->chiefExecutiveMiddleName = $this->db->f("chiefExecutiveMiddleName");
			$this->chiefExecutiveLastName = $this->db->f("chiefExecutiveLastName");

			$this->assessorDesignation = $this->db->f("assessorDesignation");
			$this->assessorFirstName = $this->db->f("assessorFirstName");
			$this->assessorMiddleName = $this->db->f("assessorMiddleName");
			$this->assessorLastName = $this->db->f("assessorLastName");

			$this->treasurerDesignation = $this->db->f("treasurerDesignation");
			$this->treasurerFirstName = $this->db->f("treasurerFirstName");
			$this->treasurerMiddleName = $this->db->f("treasurerMiddleName");
			$this->treasurerLastName = $this->db->f("treasurerLastName");

			$this->provincialAssessorDesignation = $this->db->f("provincialAssessorDesignation");
			$this->provincialAssessorFirstName = $this->db->f("provincialAssessorFirstName");
			$this->provincialAssessorMiddleName = $this->db->f("provincialAssessorMiddleName");
			$this->provincialAssessorLastName = $this->db->f("provincialAssessorLastName");

			$this->provincialTreasurerDesignation = $this->db->f("provincialTreasurerDesignation");
			$this->provincialTreasurerFirstName = $this->db->f("provincialTreasurerFirstName");
			$this->provincialTreasurerMiddleName = $this->db->f("provincialTreasurerMiddleName");
			$this->provincialTreasurerLastName = $this->db->f("provincialTreasurerLastName");

			$this->ordinanceNo = $this->db->f("ordinanceNo");
			$this->ordinanceDate = $this->db->f("ordinanceDate");
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
			"lguName".
			", lguType".
			", chiefExecutiveDesignation".
			", chiefExecutiveFirstName".
			", chiefExecutiveMiddleName".
			", chiefExecutiveLastName".
			", assessorDesignation".
			", assessorFirstName".
			", assessorMiddleName".
			", assessorLastName".
			", treasurerDesignation".
			", treasurerFirstName".
			", treasurerMiddleName".
			", treasurerLastName".
			", provincialAssessorDesignation".
			", provincialAssessorFirstName".
			", provincialAssessorMiddleName".
			", provincialAssessorLastName".
			", provincialTreasurerDesignation".
			", provincialTreasurerFirstName".
			", provincialTreasurerMiddleName".
			", provincialTreasurerLastName".
			", ordinanceNo".
			", ordinanceDate".
			") ".
			"values ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');"
			, ERPTS_SETTINGS_TABLE

			, fixQuotes($this->eRPTSSettingsID)
			, fixQuotes($this->lguName)
			, fixQuotes($this->lguType)
			, fixQuotes($this->chiefExecutiveDesignation)
			, fixQuotes($this->chiefExecutiveFirstName)
			, fixQuotes($this->chiefExecutiveMiddleName)
			, fixQuotes($this->chiefExecutiveLastName)
			, fixQuotes($this->assessorDesignation)
			, fixQuotes($this->assessorFirstName)
			, fixQuotes($this->assessorMiddleName)
			, fixQuotes($this->assessorLastName)
			, fixQuotes($this->treasurerDesignation)
			, fixQuotes($this->treasurerFirstName)
			, fixQuotes($this->treasurerMiddleName)
			, fixQuotes($this->treasurerLastName)
			, fixQuotes($this->provincialAssessorDesignation)
			, fixQuotes($this->provincialAssessorFirstName)
			, fixQuotes($this->provincialAssessorMiddleName)
			, fixQuotes($this->provincialAssessorLastName)
			, fixQuotes($this->provincialTreasurerDesignation)
			, fixQuotes($this->provincialTreasurerFirstName)
			, fixQuotes($this->provincialTreasurerMiddleName)
			, fixQuotes($this->provincialTreasurerLastName)
			, fixQuotes($this->ordinanceNo)
			, fixQuotes($this->ordinanceDate)
		);
		
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$eRPTSSettingsID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $eRPTSSettingsID;
		}
		return $ret;
	}
	
	function deleteRecord($eRPTSSettingsID){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($eRPTSSettingsID);
		$sql = sprintf("delete from %s where eRPTSSettingsID=%s;",
			ERPTS_SETTINGS_TABLE, $eRPTSSettingsID);
		$this->db->query($sql);
		$eRPTSSettingsRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $eRPTSSettings;
		}
		return $ret;
	}
	
	function updateRecord(){
		
		$sql = sprintf("update %s set".
			" lguName = '%s'".
			", lguType = '%s'".
			", chiefExecutiveDesignation = '%s'".
			", chiefExecutiveFirstName = '%s'".
			", chiefExecutiveMiddleName = '%s'".
			", chiefExecutiveLastName = '%s'".
			", assessorDesignation = '%s'".
			", assessorFirstName = '%s'".
			", assessorMiddleName = '%s'".
			", assessorLastName = '%s'".
			", treasurerDesignation = '%s'".
			", treasurerFirstName = '%s'".
			", treasurerMiddleName = '%s'".
			", treasurerLastName = '%s'".
			", provincialAssessorDesignation = '%s'".
			", provincialAssessorFirstName = '%s'".
			", provincialAssessorMiddleName = '%s'".
			", provincialAssessorLastName = '%s'".
			", provincialTreasurerDesignation = '%s'".
			", provincialTreasurerFirstName = '%s'".
			", provincialTreasurerMiddleName = '%s'".
			", provincialTreasurerLastName = '%s'".
			", ordinanceNo = '%s'".
			", ordinanceDate = '%s'".
			" where eRPTSSettingsID = '%s';",
			ERPTS_SETTINGS_TABLE
			, fixQuotes($this->lguName)
			, fixQuotes($this->lguType)
			, fixQuotes($this->chiefExecutiveDesignation)
			, fixQuotes($this->chiefExecutiveFirstName)
			, fixQuotes($this->chiefExecutiveMiddleName)
			, fixQuotes($this->chiefExecutiveLastName)
			, fixQuotes($this->assessorDesignation)
			, fixQuotes($this->assessorFirstName)
			, fixQuotes($this->assessorMiddleName)
			, fixQuotes($this->assessorLastName)
			, fixQuotes($this->treasurerDesignation)
			, fixQuotes($this->treasurerFirstName)
			, fixQuotes($this->treasurerMiddleName)
			, fixQuotes($this->treasurerLastName)
			, fixQuotes($this->provincialAssessorDesignation)
			, fixQuotes($this->provincialAssessorFirstName)
			, fixQuotes($this->provincialAssessorMiddleName)
			, fixQuotes($this->provincialAssessorLastName)
			, fixQuotes($this->provincialTreasurerDesignation)
			, fixQuotes($this->provincialTreasurerFirstName)
			, fixQuotes($this->provincialTreasurerMiddleName)
			, fixQuotes($this->provincialTreasurerLastName)
			, fixQuotes($this->ordinanceNo)
			, fixQuotes($this->ordinanceDate)

			, $this->eRPTSSettingsID
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
			$ret = $this->eRPTSSettingsID;
		}
		return $ret;
	}
	
}
?>
