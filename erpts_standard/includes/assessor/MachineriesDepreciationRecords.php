<?php
class MachineriesDepreciationRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function MachineriesDepreciationRecords(){
	
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
		$domList = $this->domDocument->create_element("MachineriesDepreciationList");
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
				//if ($child->tagname=="MachineriesDepreciation") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$machineriesDepreciation = new MachineriesDepreciation;
					$machineriesDepreciation->parseDomDocument($tempDomDoc);
					$this->arrayList[] = $machineriesDepreciation;
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
		//		MACHINERIES_DEPRECIATION_TABLE, $condition);

		$sql = sprintf("select 
			machineriesDepreciationID,
			code,
			reportCode,
			description,
			value as assessmentLevel,
			status			 
			from %s %s;",
			MACHINERIES_DEPRECIATION_TABLE, $condition);

		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$machineriesDepreciation = new MachineriesDepreciation;
			$machineriesDepreciation->selectRecord($this->db->f("machineriesDepreciationID"));
			$this->arrayList[] = $machineriesDepreciation;
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
				MACHINERIES_DEPRECIATION_TABLE, $condition.") ".$limit);
		//echo $sql;
		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$machineriesDepreciation = new MachineriesDepreciation;
			$machineriesDepreciation->selectRecord($this->db->f("machineriesDepreciationID"));
			$this->arrayList[] = $machineriesDepreciation;
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
				MACHINERIES_DEPRECIATION_TABLE, $condition);
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
				MACHINERIES_DEPRECIATION_TABLE, $condition.") ".$limit);
 		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}
	
	function deleteRecords($machineriesDepreciationIDArray=""){
		$machineriesDepreciation = new MachineriesDepreciation;
		$rows = 0;
		foreach ($machineriesDepreciationIDArray as $key => $value){
			if ($machineriesDepreciation->deleteRecord($value)) $rows++;
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
	        $machineriesDepreciation = new MachineriesDepreciation;
	        $machineriesDepreciation->selectRecord($value);
	        $machineriesDepreciation->status = "active";
	        $machineriesDepreciation->updateRecord();
	        $rows++;
	    }
	    return $rows;
	}
}
?>
