<?php
class PlantsTreesActualUsesRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function PlantsTreesActualUsesRecords(){
	
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
	
	//DOM
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
		$domList = $this->domDocument->create_element("PlantsTreesActualUsesList");
		$domList = $this->domDocument->append_child($domList);
		if ($this->arrayList){
			//print_r($this->arrayList);
            foreach($this->arrayList as $key => $value){
				$domDoc = $value->getDomDocument();
				$this->appendToDomList($domList,$domDoc);
			}
		}
		else return false;
		return true;
	}
	function parseDomDocument($domDoc){
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//if ($child->tagname=="PlantsTreesActualUses") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$plantsTreesActualUses = new PlantsTreesActualUses;
					$plantsTreesActualUses->parseDomDocument($tempDomDoc);
					$this->arrayList[] = $plantsTreesActualUses;
				}
				$child = $child->next_sibling();
			}
		}
		else return false;
		return $this->setDomDocument();
	}
	
	//db
	function selectRecords($condition=""){
		//$sql = sprintf("select * from %s %s;",
		//		PLANTSTREES_ACTUALUSES_TABLE, $condition);

		$sql = sprintf("select 
			plantsTreesActualUsesID,
			code,
			reportCode,
			description,
			value as assessmentLevel,
			status			 
			from %s %s;",
			PLANTSTREES_ACTUALUSES_TABLE, $condition);

		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$plantsTreesActualUses = new PlantsTreesActualUses;
			$plantsTreesActualUses->selectRecord($this->db->f("plantsTreesActualUsesID"));
			$this->arrayList[] = $plantsTreesActualUses;
		}
		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
	}
	function searchRecords($searchKey,$fields,$limit){
		$condition = "where (";
		foreach($fields as $key => $value){
			if($key == 0) $condition = $condition.$value." like '%".$searchKey."%'";
			else $condition = $condition."or ".$value." like '%".$searchKey."%' ";
		}
		
		$sql = sprintf("select * from %s %s;",
				PLANTSTREES_ACTUALUSES_TABLE, $condition.") ".$limit);
		//echo $sql;
		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$plantsTreesActualUses = new PlantsTreesActualUses;
			$plantsTreesActualUses->selectRecord($this->db->f("plantsTreesActualUsesID"));
			$this->arrayList[] = $plantsTreesActualUses;
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
		$sql = sprintf("select count(*) as count from %s %s;",
				PLANTSTREES_ACTUALUSES_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}
	
	function countSearchRecords($searchKey,$fields){
		$condition = "where (";
		foreach($fields as $key => $value){
			if($key == 0) $condition = $condition.$value." like '%".$searchKey."%'";
			else $condition = $condition."or ".$value." like '%".$searchKey."%' ";
		}
		
		$sql = sprintf("select count(*) as count from %s %s;",
				PLANTSTREES_ACTUALUSES_TABLE, $condition.") ".$limit);
 		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}
	
	function deleteRecords($plantsTreesActualUsesIDArray=""){
		$plantsTreesActualUses = new PlantsTreesActualUses;
		$rows = 0;
		foreach ($plantsTreesActualUsesIDArray as $key => $value){
			if ($plantsTreesActualUses->deleteRecord($value)) $rows++;
		}
		return $rows;
	}
	
	function updateStatus($statusIDArray=""){
	    $rows = 0;
	    $this->selectRecords();
	    foreach($this->arrayList as $key => $value){
	        $value->status = "inactive";
	        $value->updateRecord();
	    }
	    foreach($statusIDArray as $key => $value){
	        $plantsTreesActualUses = new PlantsTreesActualUses;
	        $plantsTreesActualUses->selectRecord($value);
	        $plantsTreesActualUses->status = "active";
	        $plantsTreesActualUses->updateRecord();
	        $rows++;
	    }
	    return $rows;
	}
}
?>
