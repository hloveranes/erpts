<?php
//include files

include_once "./prepend.php";

class addGISTechnicalDescription
{
	var $db;
	
	function addGISTechnicalDescription(){

	}

	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	function alterTable(){
		$sql = "ALTER TABLE `AFS` ADD `gisTechnicalDescription` LONGTEXT AFTER `cadastralLotNumber` ;";
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$tdID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();

			echo "Error.";
			echo "<br>";
			echo "Either this is a genuine mySQL error, or <br>";
			echo "the <i>memoranda</i> field `gisTechnicalDescription` already exists in the AFS table! :)";
			$ret = false;
		}
		else {
			$this->db->endTransaction();

			echo "Works great! '<i>`gisTechnicalDescription`</i>' field successfully added on 'AFS' table on 'nccbiz' database!";
			$ret = true;
		}
		return $ret;
	}
}

$addGISTechnicalDescription = new addGISTechnicalDescription;
$addGISTechnicalDescription->alterTable();

?>
