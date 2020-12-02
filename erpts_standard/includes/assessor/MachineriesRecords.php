<?php
class MachineriesRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function MachineriesRecords(){
	
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
		$domList = $this->domDocument->create_element("MachineriesList");
		$domList = $this->domDocument->append_child($domList);
		foreach($this->arrayList as $key => $value){
			$domDocument = $value->getDomDocument();
			$this->appendToDomList($domList,$domDocument);
		}
		return true;
	}
	
	///*
	function parseDomDocument($domDoc){
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//if ($child->tagname=="Machineries") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$machineries = new Machineries;
					$machineries->parseDomDocument($tempDomDoc);
					$this->setArrayList($machineries);
				}
				$child = $child->next_sibling();
			}
		}
		$this->setDomDocument();
		return true;
	}//*/
	
	function selectRecords($afsID=false){
		$condition = ($afsID) ? "where afsID = $afsID" : "";
		$sql = sprintf("select * from %s %s;",
				MACHINERIES_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$machineries = new Machineries;
			$machineries->selectRecord($this->db->f("propertyID"));
			$this->arrayList[] = $machineries;
		}
		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
	}
	
	function deleteRecords($machineriesIDArray=""){
		$machineries = new Machineries;
		$rows = 0;
		foreach ($machineriesIDArray as $key => $value){
			if ($machineries->deleteRecord($value)) $rows++;
		}
		return $rows;
	}
	
	function removeRecords($machineriesIDArray=""){
		$machineries = new Machineries;
		$rows = 0;
		foreach ($machineriesIDArray as $key => $value){
			if ($machineries->removeRecord($value)) $rows++;
		}
		return $rows;
	}
}
?>