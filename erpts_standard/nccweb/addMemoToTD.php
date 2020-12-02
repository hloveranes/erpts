<?php
//include files

include_once "../includes/web/prepend.php";

class addMemoToTD
{
	var $db;
	
	function addMemoToTD(){

	}

	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	function alterTable(){
		$sql = "ALTER TABLE `TD` ADD `memoranda` TEXT NOT NULL AFTER `previousAssessedValue`;";
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
			echo "the <i>memoranda</i> field already exists in the TD table! :)";
			$ret = false;
		}
		else {
			$this->db->endTransaction();

			echo "Works great! <i>memoranda</i> field successfully added on 'TD' table on 'nccbiz' database!";
			$ret = true;
		}
		return $ret;
	}
}

$addMemo = new addMemoToTD;
$addMemo->alterTable();

?>
