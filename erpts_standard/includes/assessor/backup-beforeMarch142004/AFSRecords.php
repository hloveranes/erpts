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
	
	var $searchArray;
	
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

		//print_r($this->arrayList);

		if (is_array($this->arrayList)){
			foreach($this->arrayList as $key => $value){
				$domOD = $value->getDomDocument();
				//echo $domOD;
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
				//if ($child->tagname=="OD") {
				if ($child->tagname) {
					$tempXmlStr = $domDoc->dump_node($child);
					$tempDomDoc = domxml_open_mem($tempXmlStr);
					$od = new OD;
					if ($od->parseDomDocument($tempDomDoc)) {
						$this->arrayList[] = $od;
					}
				}
				$child = $child->next_sibling();
			}
		}
		$ret = ($this->setDomDocument()) ? true : false;
		return $ret;
	}//*/
	
	function selectRecords($condition=""){

        $sql = "SELECT distinct (".AFS_TABLE.".afsID) as afsID, ".
			AFS_TABLE.".odID
			, CONCAT(".PERSON_TABLE.".lastName,".PERSON_TABLE.".firstName,".PERSON_TABLE.".middleName) as PersonFullName
            FROM ".AFS_TABLE."
            LEFT JOIN ".OWNER_TABLE."
            ON ".AFS_TABLE.".odID = ".OWNER_TABLE.".odID
            LEFT JOIN ".OWNER_PERSON_TABLE."
            ON ".OWNER_TABLE.".ownerID = ".OWNER_PERSON_TABLE.".ownerID
            LEFT JOIN ".PERSON_TABLE."
            ON ".OWNER_PERSON_TABLE.".personID = ".PERSON_TABLE.".personID
            LEFT JOIN ".OWNER_COMPANY_TABLE."
            ON ".OWNER_TABLE.".ownerID = ".OWNER_COMPANY_TABLE.".ownerID
            LEFT JOIN ".COMPANY_TABLE."
            ON ".OWNER_COMPANY_TABLE.".companyID = ".COMPANY_TABLE.".companyID";

		$sql = $sql . " " . $condition;

		$this->setDB();

		//$dummySql = sprintf("INSERT INTO dummySQL(queryString) VALUES('%s');",fixQuotes($sql));
		//$this->db->query($dummySql);

		$this->db->query($sql);

		while ($this->db->next_record()) {
			$idArray[] = $this->db->f("odID");
		}
		$idArray = array_unique($idArray);

		foreach($idArray as $key => $odID){
			$od = new OD;
			$od->selectRecord($odID);
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
	
	function searchRecords($searchKey,$fields,$limit=""){
        $this->setDB();

		if($limit!=""){
			$limit = str_replace("WHERE", "and", $limit);
		}

        $condition = " where(";
        foreach($fields as $key => $value){
            if(strpos($value, ".")>0){
		        $condition = $condition.$value." like '%".$searchKey."%'";
				if($key < count($fields)-1)
					$condition = $condition." or ";
            }
        }

        $sql = "SELECT distinct (".AFS_TABLE.".afsID) as afsID, ".
			AFS_TABLE.".odID as odID
			, CONCAT(".PERSON_TABLE.".lastName,".PERSON_TABLE.".firstName,".PERSON_TABLE.".middleName) as PersonFullName
            FROM ".AFS_TABLE."
            LEFT JOIN ".OWNER_TABLE."
            ON ".AFS_TABLE.".odID = ".OWNER_TABLE.".odID
            LEFT JOIN ".OWNER_PERSON_TABLE."
            ON ".OWNER_TABLE.".ownerID = ".OWNER_PERSON_TABLE.".ownerID
            LEFT JOIN ".PERSON_TABLE."
            ON ".OWNER_PERSON_TABLE.".personID = ".PERSON_TABLE.".personID
            LEFT JOIN ".OWNER_COMPANY_TABLE."
            ON ".OWNER_TABLE.".ownerID = ".OWNER_COMPANY_TABLE.".ownerID
            LEFT JOIN ".COMPANY_TABLE."
            ON ".OWNER_COMPANY_TABLE.".companyID = ".COMPANY_TABLE.".companyID";

        $sql = $sql . $condition . ") " . $limit;

		$this->db->query($sql);

		while ($this->db->next_record()) {
			$idArray[] = $this->db->f("odID");
		}
		$idArray = array_unique($idArray);

		foreach($idArray as $key => $odID){
			$od = new OD;
			$od->selectRecord($odID);
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
        $sql = "SELECT distinct (".AFS_TABLE.".afsID) as afsID, ".
			AFS_TABLE.".odID
			, CONCAT(".PERSON_TABLE.".lastName,".PERSON_TABLE.".firstName,".PERSON_TABLE.".middleName) as PersonFullName
            FROM ".AFS_TABLE."
            LEFT JOIN ".OWNER_TABLE."
            ON ".AFS_TABLE.".odID = ".OWNER_TABLE.".odID
            LEFT JOIN ".OWNER_PERSON_TABLE."
            ON ".OWNER_TABLE.".ownerID = ".OWNER_PERSON_TABLE.".ownerID
            LEFT JOIN ".PERSON_TABLE."
            ON ".OWNER_PERSON_TABLE.".personID = ".PERSON_TABLE.".personID
            LEFT JOIN ".OWNER_COMPANY_TABLE."
            ON ".OWNER_TABLE.".ownerID = ".OWNER_COMPANY_TABLE.".ownerID
            LEFT JOIN ".COMPANY_TABLE."
            ON ".OWNER_COMPANY_TABLE.".companyID = ".COMPANY_TABLE.".companyID";

		$sql = $sql . " " . $condition;

		$this->setDB();

		$this->db->query($sql);
		if($this->db->next_record()){
			$ret = $this->db->nf();
		}
		else{
			$ret = false;
		}
		return $ret;
	}
	
	function countSearchRecords($searchKey,$fields,$limit=""){
        $this->setDB();

		if($limit!=""){
			$limit = str_replace("WHERE", "and", $limit);
		}

        $condition = " where(";
        foreach($fields as $key => $value){
            if(strpos($value, ".")>0){
		        $condition = $condition.$value." like '%".$searchKey."%'";
				if($key < count($fields)-1)
					$condition = $condition." or ";
            }
        }

        $sql = "SELECT distinct (".AFS_TABLE.".afsID) as afsID, ".
			AFS_TABLE.".odID as odID
			, CONCAT(".PERSON_TABLE.".lastName,".PERSON_TABLE.".firstName,".PERSON_TABLE.".middleName) as PersonFullName
            FROM ".AFS_TABLE."
            LEFT JOIN ".OWNER_TABLE."
            ON ".AFS_TABLE.".odID = ".OWNER_TABLE.".odID
            LEFT JOIN ".OWNER_PERSON_TABLE."
            ON ".OWNER_TABLE.".ownerID = ".OWNER_PERSON_TABLE.".ownerID
            LEFT JOIN ".PERSON_TABLE."
            ON ".OWNER_PERSON_TABLE.".personID = ".PERSON_TABLE.".personID
            LEFT JOIN ".OWNER_COMPANY_TABLE."
            ON ".OWNER_TABLE.".ownerID = ".OWNER_COMPANY_TABLE.".ownerID
            LEFT JOIN ".COMPANY_TABLE."
            ON ".OWNER_COMPANY_TABLE.".companyID = ".COMPANY_TABLE.".companyID";

        $sql = $sql . $condition . ") " . $limit;

		$this->db->query($sql);
		if($this->db->next_record()){
			$ret = $this->db->nf();
		}
		else{
			$ret = false;
		}
		
		return $ret;
	}

	function archiveRecords($afsIDArray="",$archiveValue="",$userID=""){
		$afs = new AFS;
		$ret = false;
		foreach($afsIDArray as $key => $value){
			if($afs->archiveRecord($value,$archiveValue,$userID))
				$ret = true;
		}
		return $ret;
	}
	
	function deleteRecords($odIDArray=""){
		$od = new OD;
		$rows = 0;
		foreach ($odIDArray as $key => $value){
			if ($od->deleteRecord($value)) $rows++;
		}
		return $rows;
	}
}


/*

$fields = array(
    "arpNumber",
    "propertyIndexNumber",
    COMPANY_TABLE.".companyName",
    PERSON_TABLE.".lastName",
    PERSON_TABLE.".middleName",
    PERSON_TABLE.".firstName"
);

$page = 1;
if($page > 0){
  $page = ($page-1) * PAGE_BY;
  $condition = $page;
}

$fields = array(
	"arpNumber",
    "propertyIndexNumber",
    COMPANY_TABLE.".companyName",
    PERSON_TABLE.".lastName",
    PERSON_TABLE.".middleName",
    PERSON_TABLE.".firstName"
);
$afsRecords = new AFSRecords;

echo $afsRecords->searchRecords("roces",$fields,$condition);
echo "<br>";
print_r($afsRecords->searchArray);
echo "<br>";
print_r($afsRecords->arrayList);


*/
?>
