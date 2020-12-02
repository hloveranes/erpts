<?php
include_once "../web/prepend.php";
include_once "../collection/BacktaxTD.php";

class BacktaxTDRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function BacktaxTDRecords(){
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
		$domList = $this->domDocument->create_element("BackTaxTDList");
		$domList = $this->domDocument->append_child($domList);
		if ($this->arrayList){
			foreach($this->arrayList as $key => $value){
				$domDocument = $value->getDomDocument();
				$this->appendToDomList($domList,$domDocument);
			}
		}
		return true;
	}
	
	///*
	function parseDomDocument($domDoc){
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//if ($child->tagname=="TD") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$backtaxTD = new BacktaxTD;
					$backtaxTD->parseDomDocument($tempDomDoc);
					//print_r($backtaxTD);
					$this->arrayList[] = $backtaxTD;
				}
				$child = $child->next_sibling();
			}
		}
		$this->setDomDocument();
        //print_r($this->arrayList);
		//$this->setDomDocumentRecords();
		return true;
	}//*/
	
	function selectRecords($tdID=false){
		$condition = ($tdID) ? "where tdID = $tdID" : "";
		$sql = sprintf("select * from %s %s order by startYear desc;",
				BACKTAXTD_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$backTaxTD = new BacktaxTD;
			$backTaxTD->selectRecord("",$this->db->f("backtaxTDID"));
			$this->arrayList[] = $backTaxTD;
		}
		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
	}
	
	function countRecords($condition=""){
		$condition = ($tdID) ? "where tdID = $tdID" : "";
		$sql = sprintf("select count(*) as count from %s %s",
				BACKTAXTD_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}        	

	function deleteRecords($backtaxTDIDArray=""){
		$backTaxTD = new BacktaxTD;
		$rows = 0;
		foreach ($backtaxTDIDArray as $key => $value){
			if ($backTaxTD->deleteRecord($value)) $rows++;
		}
		return $rows;
	}
}
?>