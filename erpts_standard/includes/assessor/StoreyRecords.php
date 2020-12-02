<?php
class StoreyRecords
{
	var $storeyList;
	var $domStoreyRecords;
	var $db;
	
	function StoreyRecords(){
	
	}
	
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	function setStoreyList($tempVar){
		$this->storeyList[] = $tempVar;
	}
	
	function getStoreyList(){
		return $this->storeyList;
	}
	
	function getDomStoreyRecords(){
		return $this->domStoreyRecords;
	}
	
	function appendToDomList($rootNode,$childNode){
		//$rootNode->append_child($childNode->document_element());

		// test clone_node()
		$nodeTmp = $childNode->document_element();
		$nodeClone = $nodeTmp->clone_node(true);
		$rootNode->append_child($nodeClone);
	}
		
	function setDomStoreyRecords(){
		$this->domStoreyRecords = domxml_new_doc("1.0");
		$domList = $this->domStoreyRecords->create_element("StoreyList");
		$domList = $this->domStoreyRecords->append_child($domList);
		foreach($this->storeyList as $key => $value){
			$domStorey = $value->getDomStorey();
			$this->appendToDomList($domList,$domStorey);
		}
		return true;
	}
	
	///*
	function parseDomStoreyRecords($domDoc){
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				if ($child->tagname=="Storey") {
					$tempXmlStr = $domDoc->dump_node($personNode);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$storey = new Storey;
					$this->setSetStoreyList($storey);
				}
				$child = $child->next_sibling();
			}
		}
		$this->setDomStoreyRecords();
		return true;
	}//*/
	
	function selectStoreyRecords($afsID=false){
		$condition = ($afsID) ? "where afsID = $afsID" : "";
		$sql = sprintf("select * from %s %s;",
				STOREY_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$storey = new Storey;
			$storey->selectStorey($this->db->f("storeyID"));
			$this->storeyList[] = $storey;
		}
		if(count($this->storeyList) > 0){
			$this->setDomStoreyRecords();
			return true;
		}
		else {
			return false;
		}
	}
	
	function deleteStoreyRecords($storeyIDArray=""){
		$storey = new Storey;
		$rows = 0;
		foreach ($storeyIDArray as $key => $value){
			if ($storey->deleteStorey($value)) $rows++;
		}
		return $rows;
	}
	
	function removeStoreyRecords($storeyIDArray=""){
		$storey = new Storey;
		$rows = 0;
		foreach ($storeyIDArray as $key => $value){
			if ($storey->removeStorey($value)) $rows++;
		}
		return $rows;
	}
}
?>