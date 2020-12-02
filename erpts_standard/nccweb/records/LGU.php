<?php
//include files

include_once "../includes/web/prepend.php";

class LGU
{
	//attributes
	var $LGUID;
	var $LGUName;
	var $LGUBiz;
	var $LGUDB;
	var $LGUusername;
	var $LGUpassword;
	var $domDocument;
	var $db;
	
	//constructor
	function LGU(){
	
	}
	//methods
	//set
	function setLGUID($tempVar) {
		$this->LGUID = $tempVar;
	}
	function setLGUName($tempVar) {
		$this->LGUName = $tempVar;
	}
	function setLGUBiz ($tempVar) {
		$this->LGUBiz = $tempVar;
	}
	function setLGUusername ($tempVar) {
		$this->LGUusername = $tempVar;
	}
	function setLGUpassword ($tempVar) {
		$this->LGUpassword = $tempVar;
	}
	
	function setDocNode($elementName,$elementValue,$domDoc,$indexNode){
		$nodeName = "";
		$nodeText = "";
		$nodeName = $domDoc->create_element($elementName);
		$nodeName = $indexNode->append_child($nodeName);
		$nodeText = $domDoc->create_text_node(htmlentities($elementValue));
		$nodeText = $nodeName->append_child($nodeText);
	}
	
	function setDomDocument(){
		$this->domDocument = domxml_new_doc("1.0");
		$rec = $this->domDocument->create_element("LGU");
		$rec = $this->domDocument->append_child($rec);
		$this->setDocNode("LGUID",$this->LGUID,$this->domDocument,$rec);
		$this->setDocNode("LGUName",$this->LGUName,$this->domDocument,$rec);
		$this->setDocNode("LGUBiz",$this->LGUBiz,$this->domDocument,$rec);
		$this->setDocNode("LGUDB",$this->LGUDB,$this->domDocument,$rec);
		$this->setDocNode("LGUusername",$this->LGUusername,$this->domDocument,$rec);
		$this->setDocNode("LGUpassword",$this->LGUpassword,$this->domDocument,$rec);
	}
	function parseDomDocument($domDoc){
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				switch($child->tagname){
					default:
						$varvar = $child->tagname;
						$this->$varvar = html_entity_decode($child->get_content());
				}
				$child = $child->next_sibling();
			}
		}
		$this->setDomDocument();
	}
	function getDomDocument(){
		return $this->domDocument;
	}
	//get
	function getLGUID() {
		return $this->LGUID;
	}
	function getLGUName() {
		return $this->LGUName;
	}
	function getLGUBiz () {
		return $this->LGUBiz;
	}
	function getLGUDB () {
		return $this->LGUDB;
	}
	function getLGUusername () {
		return $this->LGUusername;
	}
	function getLGUpassword () {
		return $this->LGUpassword;
	}
		
	function selectRecord($LGUID,$limit=""){
		if ($LGUID=="") return;
		$db = new DB_Records;
		
		$sql = sprintf("SELECT * FROM %s WHERE LGUID=%s %s;",
			LGU_TABLE, $LGUID, $limit);
		//echo $sql;
		$db->query($sql);

		if ($db->next_record()) {
			$this->LGUID = $db->f("LGUID");
			$this->LGUName = $db->f("LGUName");
			$this->LGUBiz = $db->f("LGUBiz");
			$this->LGUDB = $db->f("LGUDB");
			$this->LGUusername = $db->f("LGUusername");
			$this->LGUpassword = $db->f("LGUpassword");
			
			//$this->setDomDocument();
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}

	function insertRecord(){
		if(count($this->administratorArray)){
			foreach($this->administratorArray as $key => $value){
				$personID = $value->insertRecord();
			}
		}
		$sql = sprintf("insert into %s (".
			"LGUName".
			", LGUBiz".
			", LGUDB".
			", LGUusername".
			", LGUpassword".
			") ".
			"values ('%s', '%s', '%s', '%s', '%s'".
			");",
			AFS_TABLE
			, fixQuotes($this->LGUName)
			, fixQuotes($this->LGUBiz)
			, fixQuotes($this->LGUDB)
			, fixQuotes($this->LGUusername)
			, fixQuotes($this->LGUpassword)
			);
		//echo $sql;
		$db = new DB_Records;
		$db->beginTransaction();
		$db->query($sql);
		$afsID = $db->insert_id();
		if ($db->Errno!=0) {
			$db->rollbackTransaction();
			$db->resetErrors();
			$ret = false;
		}
		else {
			$db->endTransaction();
			$ret = $afsID;
		}
		return $ret;
	}
	
	function updateRecord(){
		$sql = sprintf("update %s set".
			" LGUName = '%s'".
			", LGUBiz = '%s'".
			", LGUDB = '%s'".
			", LGUusername = '%s'".
			", LGUpassword = '%s'".
			" where LGUID = '%s';",
			AFS_TABLE
			, fixQuotes($this->LGUName)
			, fixQuotes($this->LGUBiz)
			, fixQuotes($this->LGUDB)
			, fixQuotes($this->LGUusername)
			, fixQuotes($this->LGUpassword)
			, $this->LGUID			
			);
		//echo $sql;
		//*
		$db = new DB_Records;
		$db->beginTransaction();
		$db->query($sql);
		if ($db->Errno!=0) {
			$db->rollbackTransaction();
			$db->resetErrors();
			$ret = false;
		}
		else {
			$db->endTransaction();
			$ret = $this->afsID;
		}//*/
		return $ret;
	}
}
?>
