<?php
include_once "./Person.php";
class User
{
	//attributes
	var $userID;
    var $userType;
	var $username;
	var $password;
	var $personID;
	var $dateCreated;
	var $dateModified;
	var $status;

	var $userTypeListArray;
	var $userTypeBitArray;
	var $userTypeDescriptions;
	
	var $domDocument;
	var $db;
	
	//constructor
	function User() {
	}
	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	function setUserID($tempVar) {
		$this->userID = $tempVar;
	}
	function setUserType($tempVar) {
		if(is_array($tempVar)){
			$this->userTypeBitArray = $tempVar;
			$this->userTypeListArray = $this->getUserTypeListArray();

			$this->userType = "";
			for($i=0 ; $i<count($this->userTypeListArray) ; $i++){
				if($this->userTypeBitArray[$i]==1){
					$this->userType .= "1";
				}
				else{
					$this->userType .= "0";
				}
			}
		}
		else{
			$this->userType = $tempVar;
		}
	}
	function setUsername($tempVar) {
		$this->username = $tempVar;
	}
	function setPassword($tempVar) {
		$this->password = $tempVar;
	}
	function setPersonID($tempVar) {
		$this->personID = $tempVar;
	}
	function setDateCreated($tempVar) {
		$this->dateCreated = $tempVar;
	}
	function setDateModified($tempVar) {
		$this->dateModified = $tempVar;
	}	
	function setStatus($tempVar){
		$this->status = $tempVar;
	}

	//DOM
	function setDocNode($elementName,$elementValue,$domDoc,$indexNode){
		$nodeName = "";
		$nodeText = "";
		$nodeName = $domDoc->create_element($elementName);
		$nodeName = $indexNode->append_child($nodeName);
		$nodeText = $domDoc->create_text_node(htmlentities($elementValue));
		$nodeText = $nodeName->append_child($nodeText);
	}
	function setArrayDocNode($elementName,$arrayList,$indexNode){
		$list = $this->domDocument->create_element($elementName);
		$list = $indexNode->append_child($list);
		if (is_array($arrayList)){
			foreach ($arrayList as $key => $value){
                $domTmp = $value->getDomDocument();
				//$list->append_child($domTmp->document_element());

				// test clone_node()
				$nodeTmp = $domTmp->document_element();
				$nodeClone = $nodeTmp->clone_node(true);
				$list->append_child($nodeClone);
			}
		}
	}
	function setObjectDocNode($elementName,$elementObject,$domDoc,$indexNode){
		$nodeName = "";
		$nodeDomDoc = $elementObject->getDomDocument();
		$nodeObject = $nodeDomDoc->document_element();

		$nodeClone = $nodeObject->clone_node(true);
			
		$nodeName = $domDoc->create_element($elementName);
		$nodeName = $indexNode->append_child($nodeName);
		$nodeObject = $nodeName->append_child($nodeClone);
	}
	function setDomDocument() {
		$this->domDocument = domxml_new_doc("1.0");
		$rec = $this->domDocument->create_element("User");
		$rec = $this->domDocument->append_child($rec);
		//$rec->set_attribute("barangayID",$this->barangayID);
		$this->setDocNode("userID",$this->userID,$this->domDocument,$rec);
		$this->setDocNode("userType",$this->userType,$this->domDocument,$rec);
		$this->setDocNode("username",$this->username,$this->domDocument,$rec);
		$this->setDocNode("password",$this->password,$this->domDocument,$rec);
	    $this->setDocNode("personID",$this->personID,$this->domDocument,$rec);
	    $this->setDocNode("dateCreated",$this->dateCreated,$this->domDocument,$rec);
	    $this->setDocNode("dateModified",$this->dateModified,$this->domDocument,$rec);
		$this->setDocNode("status",$this->status,$this->domDocument,$rec);
	}
	function parseDomDocument($domDoc){
		$ret = true;
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//eval("\$this->".$child->tagname." = \"".$child->get_content()."\";");
				//eval("\$this->set".ucfirst($child->tagname())."(\"".$child->get_content()."\");");
				
				// test varvars
				$varvar = $child->tagname;
				$this->$varvar = html_entity_decode($child->get_content());

				$child = $child->next_sibling();
			}
		}
		$this->setDomDocument();
		return $ret;
	}
	function getDomDocument() {
		return $this->domDocument;
	}
	
	//get	

	function getUserID() {
		return $this->userID;
	}
	function getUserType() {
		return $this->userType;
	}
	function getUsername() {
		return $this->username;
	}
	function getPassword() {
		return $this->password;
	}
	function getPersonID() {
		return $this->personID;
	}
	function getFullName(){
		$person = new Person;
		$person->selectRecord($this->personID);
		return $person->getFullName();
	}
	function getDateCreated() {
		return $this->dateCreated;
	}
	function getDateModified() {
		return $this->dateModified;
	}
	function getStatus(){
		return $this->status;
	}

	function getUserTypeListArray(){
		unset($this->userTypeListArray);

        $this->userTypeListArray[0] = "Super User";
		$this->userTypeListArray[1] = "AM - Edit Access";
		$this->userTypeListArray[2] = "AM - View Access";
		$this->userTypeListArray[3] = "TM - Edit Access";
		$this->userTypeListArray[4] = "TM - View Access";
		$this->userTypeListArray[5] = "RM (A) - Edit Access";
		$this->userTypeListArray[6] = "RM (A) - Report Access";
		$this->userTypeListArray[7] = "RM (T) - Edit Access";
		$this->userTypeListArray[8] = "RM (T) - Report Access";
		$this->userTypeListArray[9] = "Signatory";

		return $this->userTypeListArray;
	}

	function getUserTypeBitArray($userType){
		$this->userTypeListArray = $this->getUserTypeListArray();
		unset($this->userTypeBitArray);
		foreach($this->userTypeListArray as $key=>$value){
			$this->userTypeBitArray[] = substr($userType,$key,1);
		}
		return $this->userTypeBitArray;
	}

	function getUserTypeDescriptions($userTypeListArray="",$userTypeBitArray="",$userType=""){
		if(!is_array($userTypeListArray)){
			$userTypeListArray = $this->getUserTypeListArray();
		}
		if(!is_array($userTypeBitArray)){
			if($userType==""){
				$userType = $this->userType;
			}
			$userTypeBitArray = $this->getUserTypeBitArray($userType);
		}

		$this->userTypeDescriptions = "";

		for($i=0 ; $i<=count($userTypeListArray) ; $i++){
			if($userTypeBitArray[$i]==1){
				if($this->userTypeDescriptions != ""){
					$this->userTypeDescriptions .= ", ";
				}
				$this->userTypeDescriptions .= $userTypeListArray[$i];
			}
		}

		return $this->userTypeDescriptions;
	}
	
	//DB
	function selectRecord($userID){
		if ($userID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE userID='%s';",
			AUTH_USER_MD5_TABLE, $userID);
			$this->db->query($sql);
		$user = new User;
		if ($this->db->next_record()) {
			//*
			$this->userID = $this->db->f("userID");
			$this->userType = $this->db->f("userType");
			$this->username = $this->db->f("username");
			$this->password = $this->db->f("password");
			$this->personID = $this->db->f("personID");
			$this->dateCreated = $this->db->f("dateCreated");
			$this->dateModified = $this->db->f("dateModified");
			$this->status = $this->db->f("status");
			//*/
			foreach ($this->db->Record as $key => $value){
				$this->$key = $value;
			}
			$this->setDomDocument();
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}
	
	function insertRecord(){
		$sql = sprintf("insert into %s (".
			"userType".
			", username".
			", password".
			", personID".
			", dateCreated".
			", dateModified".
			", status".
			") ".
			"values ('%s', '%s', '%s', '%s', '%s', '%s', '%s');"
			, AUTH_USER_MD5_TABLE
			, fixQuotes($this->userType)
			, fixQuotes($this->username)
			, fixQuotes($this->password)
			, fixQuotes($this->personID)
			, fixQuotes(time())
			, fixQuotes(time())
			, fixQuotes($this->status)
		);
		
		//echo $sql;
		
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$userID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $userID;
		}
		
		//echo $sql;
		return $ret;
	}
	
	function deleteRecord($userID){
		$this->setDB();
		$this->db->beginTransaction();
		$this->selectRecord($userID);
		$sql = sprintf("delete from %s where userID=%s;",
			AUTH_USER_MD5_TABLE, $userID);
		$this->db->query($sql);
		$userRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $userRows;
		}
		return $ret;
	}
	
	function updateRecord(){
		
		$sql = sprintf("update %s set".
			" userType = '%s'".
			", username = '%s'".
			", password = '%s'".
			", personID = '%s'".
			", dateModified = '%s'".
			", status = '%s'".
			" where userID = '%s';",
			AUTH_USER_MD5_TABLE
			, fixQuotes($this->userType)
			, fixQuotes($this->username)
			, fixQuotes($this->password)
			, fixQuotes($this->personID)
			, fixQuotes(time())
			, fixQuotes($this->status)
			, $this->userID
		);
		//echo $sql;
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $this->userID;
		}
		return $ret;
	}
	
}
?>
