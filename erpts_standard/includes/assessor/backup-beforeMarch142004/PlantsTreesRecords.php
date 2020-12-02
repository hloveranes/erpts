<?php
class PlantsTreesRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function PlantsTreesRecords(){
	
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
		$domList = $this->domDocument->create_element("PlantsTreesList");
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
				//if ($child->tagname=="PlantsTrees") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$plantsTrees = new PlantsTrees;
					$plantsTrees->parseDomDocument($tempDomDoc);
					$this->setArrayList($plantsTrees);
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
				PLANTSTREES_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$plantsTrees = new PlantsTrees;
			$plantsTrees->selectRecord($this->db->f("propertyID"));
			$this->arrayList[] = $plantsTrees;
		}
		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
	}
	
	function deleteRecords($plantsTreesIDArray=""){
		$plantsTrees = new PlantsTrees;
		$rows = 0;
		foreach ($plantsTreesIDArray as $key => $value){
			if ($plantsTrees->deleteRecord($value)) $rows++;
		}
		return $rows;
	}
	
	function removeRecords($plantsTreesIDArray=""){
		$plantsTrees = new PlantsTrees;
		$rows = 0;
		foreach ($plantsTreesIDArray as $key => $value){
			if ($plantsTrees->removeRecord($value)) $rows++;
		}
		return $rows;
	}
}
?>