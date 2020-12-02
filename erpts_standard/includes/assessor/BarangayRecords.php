<?php
include_once "../web/prepend.php";
include_once "./Barangay.php";
class BarangayRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function BarangayRecords(){
	
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
		$domList = $this->domDocument->create_element("BarangayList");
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
				//if ($child->tagname=="Barangay") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$barangay = new Barangay;
					$barangay->parseDomDocument($tempDomDoc);
					$this->arrayList[] = $barangay;
				}
				$child = $child->next_sibling();
			}
		}
		else return false;
		return $this->setDomDocument();
	}
	
	//db
	function selectRecords($condition=""){

		$sql = "SELECT ".BARANGAY_TABLE.".barangayID as barangayID"
			.", ".BARANGAY_TABLE.".code as code"
			.", ".BARANGAY_TABLE.".description as description"
			.", ".BARANGAY_TABLE.".districtID as districtID"
			.", ".BARANGAY_TABLE.".status as status"
			.", ".DISTRICT_TABLE.".description as district"
			.", ".MUNICIPALITYCITY_TABLE.".description as municipalityCity"
			.", CONCAT(".DISTRICT_TABLE.".description, ".MUNICIPALITYCITY_TABLE.".description) as districtMunicipalityCity"
			." FROM ".BARANGAY_TABLE
			." LEFT JOIN ".DISTRICT_TABLE
			." ON ".BARANGAY_TABLE.".districtID = ".DISTRICT_TABLE.".districtID"
			." LEFT JOIN ".MUNICIPALITYCITY_TABLE
			." ON ".DISTRICT_TABLE.".municipalityCityID = ".MUNICIPALITYCITY_TABLE.".municipalityCityID";
		$sql = $sql." ".$condition;

		//$sql = sprintf("select * from %s %s;",
		//		BARANGAY_TABLE, $condition);

		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$barangay = new Barangay;
			$barangay->selectRecord($this->db->f("barangayID"));
			$this->arrayList[] = $barangay;
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
				BARANGAY_TABLE, $condition.") ".$limit);
		//echo $sql;
		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$barangay = new Barangay;
			$barangay->selectRecord($this->db->f("barangayID"));
			$this->arrayList[] = $barangay;
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
				BARANGAY_TABLE, $condition);
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
				BARANGAY_TABLE, $condition.") ".$limit);
 		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}
	
	function deleteRecords($barangayIDArray=""){
		$barangay = new Barangay;
		$rows = 0;
		foreach ($barangayIDArray as $key => $value){
			if ($barangay->deleteRecord($value)) $rows++;
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
	        $barangay = new Barangay;
	        $barangay->selectRecord($value);
	        $barangay->status = "active";
	        $barangay->updateRecord();
	        $rows++;
	    }
	    return $rows;
	}
}

/*
$barangayRecords = new BarangayRecords;
$barangayRecords->selectRecords();
print_r($barangayRecords->getArrayList());
//echo htmlentities($barangayRecords->domDocument->dump_mem());
*/

?>
