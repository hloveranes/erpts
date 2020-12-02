<?php
//include files
include_once "./Address.php";

class Company
{
	//attributes
	var $companyID;
	var $companyName;
    var $tin;
	var $addressArray;
	var $telephone;
    var $fax;
	var $email;
	var $website;
    var $domDocument;
	var $db;

    //constructor
    function Company(){
    }
     
    //set
	function setDB(){
		$this->db = new DB_RPTS;
	}
	function setCompanyID($tempVar){
    	$this->companyID = $tempVar;
    }
    function setCompanyName($tempVar){
        $this->companyName = $tempVar;
    }
	function setTin($tempVar){
        $this->tin = $tempVar;
    }
	function setAddressArray($tempVar) {
		$this->addressArray[] = $tempVar;
	}
	function setTelephone($tempVar){
        $this->telephone = $tempVar;
    }
    function setFax($tempVar){
        $this->fax = $tempVar;
    }
	function setEmail($tempVar) {
		$this->email = $tempVar;
	}
	function setWebsite($tempVar) {
		$this->website = $tempVar;
	}
	
	function setDocNode($elementName,$elementValue,$domDoc,$indexNode){
		$nodeName = "";
		$nodeText = "";
		$nodeName = $domDoc->create_element($elementName);
		$nodeName = $indexNode->append_child($nodeName);

		$trans = get_html_translation_table(HTML_ENTITIES);
		$elementValue = strtr(htmlentities($elementValue), $trans);
		$nodeText = $domDoc->create_text_node($elementValue);

		//$nodeText = $domDoc->create_text_node(htmlentities($elementValue));
		$nodeText = $nodeName->append_child($nodeText);
	}
	  
	function setArrayDocNode($elementName,$arrayList,$indexNode){
		$list = $this->domDocument->create_element($elementName);
		$list = $indexNode->append_child($list);
		if (count($arrayList)){
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
	
	function setDomDocument(){
		$this->domDocument = domxml_new_doc("1.0");
		$rec = $this->domDocument->create_element("Company");
		$rec = $this->domDocument->append_child($rec);
		//$rec->set_attribute("companyID",$this->companyID);
		$this->setDocNode("companyID",$this->companyID,$this->domDocument,$rec);
		$this->setDocNode("companyName",$this->companyName,$this->domDocument,$rec);
   		$this->setDocNode("tin",$this->tin,$this->domDocument,$rec);
		if (count($this->addressArray))
			$this->setArrayDocNode("addressArray",$this->addressArray,$rec);
		$this->setDocNode("telephone",$this->telephone,$this->domDocument,$rec);
		$this->setDocNode("fax",$this->fax,$this->domDocument,$rec);
		$this->setDocNode("email",$this->email,$this->domDocument,$rec);
		$this->setDocNode("website",$this->website,$this->domDocument,$rec);
	}
    
	function parseDomDocument($domDoc){
		$ret = true;
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				if ($child->tagname=="addressArray"){
					$addressNode = $child->first_child();

					while ($addressNode){
						//if ($addressNode->tagname=="address") {
						if ($addressNode->tagname) {
							$tempXmlStr = $domDoc->dump_node($addressNode);
							$tempDomDoc = domxml_open_mem($tempXmlStr);
							$address = new Address;
							$ret = $address->parseDomDocument($tempDomDoc);
							$this->setAddressArray($address);
						}
						$addressNode = $addressNode->next_sibling();
					}
				}
				else {
					//eval("\$this->".$child->tagname." = \"".$child->get_content()."\";");

					// test varvars
					$varvar = $child->tagname;

					$trans = array_flip(get_html_translation_table(HTML_ENTITIES));
					$childContent = strtr(html_entity_decode($child->get_content()), $trans);

					$this->$varvar = html_entity_decode($childContent);

					//$this->$varvar = html_entity_decode($child->get_content());
				}
				//eval("\$this->set".ucfirst($child->tagname)."(\"".$child->get_content()."\");");
				$child = $child->next_sibling();
			}
		}
		$this->setDomDocument();
		return $ret;
	}
	function getDomDocument(){
		return $this->domDocument;
	}
	//get
	function getCompanyID(){
		return $this->companyID;
	}
	function getCompanyName(){
		return $this->companyName;
	}
    function getTin(){
    	return $this->tin;
    }
	function getAddressArray(){
    	return $this->addressArray;
    }
	function getTelephone(){
    	return $this->telephone;
    }
    function getFax(){
    	return $this->fax;
    }
	function getEmail() {
		return $this->email;
	}
	function getWebsite() {
		return $this->website;
	}

	///*
	function selectRecord($companyID){
		if ($companyID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE companyID=%s;",
			COMPANY_TABLE, $companyID);
		$this->db->query($sql);
		$company = new Company;
		if ($this->db->next_record()) {
			$companyID = $this->db->f("companyID");
			$this->setCompanyID($this->db->f("companyID"));
			$this->setCompanyName($this->db->f("companyName"));
			$this->setTin($this->db->f("tin"));
			$this->setTelephone($this->db->f("telephone"));
			$this->setFax($this->db->f("fax"));
			$this->setEmail($this->db->f("email"));
			$this->setWebsite($this->db->f("website"));
			$sql = sprintf("select a.addressID from %s as a, %s as b where a.companyID = %s and a.addressID = b.addressID;"
				, COMPANY_ADDRESS_TABLE
				, ADDRESS_TABLE
				, $this->companyID
			);
			$this->db->query($sql);
			while ($this->db->next_record()) {
				$address = new Address;
				$address->selectRecord($this->db->f("addressID"));
				$this->addressArray[] = $address;
			}
			$this->setDomDocument();
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}
	
	function insertRecord(){
		$sql = sprintf("insert into %s (".
			"companyName".
			", tin".
			", telephone".
			", fax".
			", email".
			", website".
			")".
			" values ('%s','%s','%s', '%s', '%s', '%s');",
			COMPANY_TABLE
			, fixQuotes($this->companyName)
			, fixQuotes($this->tin)
			, fixQuotes($this->telephone)
			, fixQuotes($this->fax)
			, fixQuotes($this->email)
			, fixQuotes($this->website)
		);
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$companyID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			foreach($this->addressArray as $key => $value){
				$addressID = $value->insertRecord();
				$sql = sprintf("insert into %s (".
					"companyID".
					", addressID".
					")".
					" values (%s, %s);"
					, COMPANY_ADDRESS_TABLE
					, $companyID
					, $addressID
				);
				$this->db->beginTransaction();
				$this->db->query($sql);
				if ($this->db->Errno!=0) {
					$this->db->rollbackTransaction();
					$this->db->resetErrors();
					$ret = false;
				}
				else {
					$this->db->endTransaction();
				}
			}
			$ret = $companyID;
		}
		return $ret;
	}
	
	function deleteRecord($companyID){
		$this->setDB();
		$this->db->beginTransaction();

		$this->selectRecord($companyID);
		$sql = sprintf("delete from %s where companyID=%s;",
			COMPANY_TABLE, $companyID);
		$this->db->query($sql);
		$companyRows = $this->db->affected_rows();
		//$addressCompanyRows = $this->deleteAddressCompany();

		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $companyRows;
		}
		return $ret;
	}
	
	function updateRecord(){
		$sql = sprintf("update %s set".
			" companyName = '%s'".
			", tin = '%s'".
			", telephone = '%s'".
			", fax = '%s'".
			", email = '%s'".
			", website = '%s'".
			" where companyID = '%s'".
			";",
			COMPANY_TABLE
			, fixQuotes($this->companyName)
			, fixQuotes($this->tin)
			, fixQuotes($this->telephone)
			, fixQuotes($this->fax)
			, fixQuotes($this->email)
			, fixQuotes($this->website)
			, $this->companyID
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
			foreach($this->addressArray as $key => $value){
				$addressID = $value->updateRecord();
			}
			$ret = $this->companyID;
		}
		return $ret;
	}
	
	function removeOwnerCompany($ownerID, $companyID){
		$this->setDB();
		$this->db->beginTransaction();
		$sql = sprintf("delete from %s where ownerID=%s and companyID=%s;",
			OWNER_COMPANY_TABLE, $ownerID, $companyID);
		$this->db->query($sql);
		$rows = $this->db->affected_rows();
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $rows;
		}
		return $ret;
	}	
}
?>
