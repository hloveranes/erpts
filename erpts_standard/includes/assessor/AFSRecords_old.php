<?php
include_once "../web/prepend.php";
include_once "./Owner.php";
include_once "./OD.php";
include_once "./ODRecords.php";
include_once "./AFS.php";
class AFSRecords
{
	var $arrayList;
	var $domDocument;
	var $db;
	
	function AFSRecords(){
	
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
		$domList = $this->domDocument->create_element("ArrayList");
		$domList = $this->domDocument->append_child($domList);
		if (is_array($this->arrayList)){
			foreach($this->arrayList as $key => $value){
				$domOD = $value->getDomDocument();
				$this->appendToDomList($domList,$domOD);
			}
			$ret = true;
		}
		else{
			$ret = false;
		}
		return $ret;
	}
	
	///*
	function parseDomDocument($domDoc){
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//if ($child->tagname=="AFS") {
				if($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$afs = new AFS;
					if ($afs->parseDomDocument($tempDomDoc)) {
						$this->arrayList[] = $afs;
					}
				}
				$child = $child->next_sibling();
			}
		}
		$ret = ($this->setDomDocument()) ? true : false;
		return $ret;
	}//*/
	
	function selectRecords($condition=""){
		$sql = sprintf("select * from %s order by afsID desc %s;",
				AFS_TABLE, $condition);
		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$afs = new AFS;
			$afs->selectRecord($this->db->f("afsID"));
			$this->arrayList[] = $afs;
		}
		if(count($this->arrayList) > 0){
			$this->setDomDocument();
			return true;
		}
		else {
			return false;
		}
	}
	
	function searchRecords($searchKey,$fields,$limit=""){
		$condition = "where (";
		
		foreach($fields as $key => $value){
			if($key == 0) $condition = $condition.$value." like '%".$searchKey."%'";
			else $condition = $condition." or ".$value." like '%".$searchKey."%' ";
		}
		
		// figure out $sql FOR AFS;
		
		// $sql for OD
		
        $sql = "SELECT " . LOCATION_TABLE . ".odID as odID
                  FROM " . LOCATION_TABLE . "
                  LEFT JOIN " . LOCATIONADDRESS_TABLE . "
                  ON " . LOCATION_TABLE . ".locationAddressID=" . LOCATIONADDRESS_TABLE . ".locationAddressID
                  LEFT JOIN " . BARANGAY_TABLE . "
                  ON " . BARANGAY_TABLE . ".barangayID=" . LOCATIONADDRESS_TABLE . ".barangayID ";
        $sql = $sql . $condition . ") " . $limit;

		$this->setDB();
		$this->db->query($sql);
		while ($this->db->next_record()) {
			$afs = new AFS;
			$afs->selectRecord($this->db->f("afsID"));
			$this->arrayList[] = $od;
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
				AFS_TABLE, $condition);
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
			else $condition = $condition." or ".$value." like '%".$searchKey."%' ";
		}
		
		// figure out $sql for AFS.
		
        // $sql for OD
		
        $sql = "SELECT COUNT(" . LOCATION_TABLE . ".odID) as count
                  FROM " . LOCATION_TABLE . "
                  LEFT JOIN " . LOCATIONADDRESS_TABLE . "
                  ON " . LOCATION_TABLE . ".locationAddressID=" . LOCATIONADDRESS_TABLE . ".locationAddressID
                  LEFT JOIN " . BARANGAY_TABLE . "
                  ON " . BARANGAY_TABLE . ".barangayID=" . LOCATIONADDRESS_TABLE . ".barangayID ";
        $sql = $sql . $condition . ")";
		
		$this->setDB();
		$this->db->query($sql);
		if($this->db->next_record()) $ret = $this->db->f("count");
		else $ret = false;
		return $ret;
	}
	
	function deleteRecords($afsIDArray=""){
		$afs = new AFS;
		$rows = 0;
		foreach ($afsIDArray as $key => $value){
			if ($afs->deleteRecord($value)) $rows++;
		}
		return $rows;
	}
}
//$obj = new AFSRecords;
//$obj->selectRecords();
//echo $obj->domDocument->dunmp_mem();
?>
