<?php
include_once "../web/prepend.php";
include_once "./District.php";
class DistrictRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function DistrictRecords(){
	
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
		$domList = $this->domDocument->create_element("DistrictList");
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
				//if ($child->tagname=="District") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$district = new District;
					$district->parseDomDocument($tempDomDoc);
					$this->arrayList[] = $district;
				}
				$child = $child->next_sibling();
			}
		}
		else return false;
		return $this->setDomDocument();
	}
	
	//db
	function selectRecords($condition=""){

		$sql = "SELECT ".DISTRICT_TABLE.".districtID as districtID"
			.", ".DISTRICT_TABLE.".code as code"
			.", ".DISTRICT_TABLE.".description as description"
			.", ".DISTRICT_TABLE.".municipalityCityID as municipalityCityID"
			.", ".DISTRICT_TABLE.".status as status"
			.", ".MUNICIPALITYCITY_TABLE.".description as municipalityCity"
			." FROM ".DISTRICT_TABLE
			." LEFT JOIN ".MUNICIPALITYCITY_TABLE
			." ON ".DISTRICT_TABLE.".municipalityCityID = ".MUNICIPALITYCITY_TABLE.".municipalityCityID";
		$sql = $sql." ".$condition;

		//$sql = sprintf("select * from %s %s;",
		//		DISTRICT_TABLE, $condition);

		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$district = new District;
			$district->selectRecord($this->db->f("districtID"));
			$this->arrayList[] = $district;
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
				DISTRICT_TABLE, $condition.") ".$limit);
		//echo $sql;
		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$district = new District;
			$district->selectRecord($this->db->f("districtID"));
			$this->arrayList[] = $district;
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
				DISTRICT_TABLE, $condition);
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
				DISTRICT_TABLE, $condition.") ".$limit);
 		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}
	
	function deleteRecords($districtIDArray=""){
		$district = new District;
		$rows = 0;
		foreach ($districtIDArray as $key => $value){
			if ($district->deleteRecord($value)) $rows++;
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
	        $district = new District;
	        $district->selectRecord($value);
	        $district->status = "active";
	        $district->updateRecord();
	        $rows++;
	    }
	    return $rows;
	}
}

/*
$districtRecords = new DistrictRecords;
$districtRecords->selectRecords();
print_r($districtRecords->getArrayList());
//echo htmlentities($districtRecords->domDocument->dump_mem());
//*/
?>
