<?php

include_once "./prepend.php";

class MigratePINS
{
	//attributes

	//constructor
	function MigratePINS() {
	
	}

	function Main(){

		// get AFS id's where propertyIndexNumber does not exist in the AFS TABLE
		if(!$afsIDArray = $this->getAFSList("WHERE propertyIndexNumber IS NULL || propertyIndexNumber = ''")){
			echo ("PIN Migration complete.");
			exit();
			return false;
		}
		else{

			// loop through PROPERTY TABLES (LAND, PLANTS, IMPROVEMENTSBUILDINGS, MACHINERIES)
			// and look for propertyIndexNumber for the corresponding AFS record

			foreach($afsIDArray as $key => $afsID){
				if($propertyPinArray = $this->getPropertyPINArray($afsID)){
					foreach($propertyPinArray as $pKey => $oldPIN){
						if($oldPIN != "" || $oldPIN != NULL){
							if($this->updatePIN($afsID, $oldPIN)){
								echo "afsID : <b>".$afsID."</b>";
								echo " | ";
								echo "PIN: <b>";
								echo $oldPIN;
								echo "</b>";
								echo " | ";
								echo "<font color='#0000ff'>success</font>";
								echo "<hr>";
							}
							else{
								echo "afsID : <b>".$afsID."</b> ";
								echo " | ";
								echo "PIN: <b>";
								echo $oldPIN;
								echo "</b>";
								echo " | ";
								echo "<font color='#ff0000'>error update</font>";
								echo "<hr>";
							}
							break;
						}
						$updated = false;
					}
					unset($propertyPinArray);
				}	
				else{
					echo "afsID : <b>".$afsID."</b>";
					echo " | ";
					echo "PIN: <b>no Pin to migrate</b>";
					echo " | ";
					echo "<font color='#009900'>Manually encode. </font>";
					echo "<hr>";
				}
			}
			
		}
	}


	//methods
	//set
	function setDB(){
		$this->db = new DB_RPTS;
	}

	function getAFSList($condition){
		$sql = "SELECT afsID FROM ".AFS_TABLE." ".$condition;

		$this->setDB();
		$this->db->query($sql);

		while ($this->db->next_record()) {
			$idArray[] = $this->db->f("afsID");
		}

		if(is_array($idArray)){
			return $idArray;
		}
		else{
			return false;
		}
	}

	function getPropertyPINArray($afsID){
		$landPinArray = $this->getLandPINArray($afsID);
		$plantsTreesPinArray = $this->getPlantsTreesPINArray($afsID);
		$improvementsBuildingsPinArray = $this->getImprovementsBuildingsPINArray($afsID);
		$machineriesPinArray = $this->getMachineriesPINArray($afsID);

		$propertyPinArray = array();

		if($landPinArray){
			$propertyPinArray = array_merge($propertyPinArray, $landPinArray);
		}
		if($plantsTreesPinArray){
			$propertyPinArray = array_merge($propertyPinArray, $plantsTreesPinArray);
		}
		if($improvementsBuildingsPinArray){
			$propertyPinArray = array_merge($propertyPinArray, $improvementsBuildingsPinArray);
		}
		if($machineriesPinArray){
			$propertyPinArray = array_merge($propertyPinArray, $machineriesPinArray);
		}

		if(count($propertyPinArray) > 0){
			return $propertyPinArray;
		}
		else{
			return false;
		}
	}

	function getLandPINArray($afsID){
		$condition = " WHERE afsID = '".$afsID."'";
		$sql = "SELECT propertyIndexNumber FROM ".LAND_TABLE. " ".$condition;

		$this->setDB();
		$this->db->query($sql);

		while ($this->db->next_record()) {
			$landPinArray[] = $this->db->f("propertyIndexNumber");
		}

		if(is_array($landPinArray)){
			return $landPinArray;
		}
		else{
			return false;
		}
	}

	function getPlantsTreesPINArray($afsID){
		$condition = " WHERE afsID = '".$afsID."'";
		$sql = "SELECT propertyIndexNumber FROM ".PLANTSTREES_TABLE. " ".$condition;

		$this->setDB();
		$this->db->query($sql);

		while ($this->db->next_record()) {
			$plantsTreesPinArray[] = $this->db->f("propertyIndexNumber");
		}

		if(is_array($plantsTreesPinArray)){
			return $plantsTreesPinArray;
		}
		else{
			return false;
		}
	}

	function getMachineriesPINArray($afsID){
		$condition = " WHERE afsID = '".$afsID."'";
		$sql = "SELECT propertyIndexNumber FROM ".MACHINERIES_TABLE. " ".$condition;

		$this->setDB();
		$this->db->query($sql);

		while ($this->db->next_record()) {
			$machineriesPinArray[] = $this->db->f("propertyIndexNumber");
		}

		if(is_array($machineriesPinArray)){
			return $machineriesPinArray;
		}
		else{
			return false;
		}
	}

	function getImprovementsBuildingsPINArray($afsID){
		$condition = " WHERE afsID = '".$afsID."'";
		$sql = "SELECT propertyIndexNumber FROM ".IMPROVEMENTSBUILDINGS_TABLE. " ".$condition;

		$this->setDB();
		$this->db->query($sql);

		while ($this->db->next_record()) {
			$improvementsBuildingsPinArray[] = $this->db->f("propertyIndexNumber");
		}

		if(is_array($improvementsBuildingsPinArray)){
			return $improvementsBuildingsPinArray;
		}
		else{
			return false;
		}
	}

	function updatePIN($afsID, $PIN){
		$sql = "UPDATE ".AFS_TABLE." SET propertyIndexNumber = '".fixQuotes($PIN)."' WHERE afsID = '".$afsID."'";

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
			$ret = true;
		}

		return $ret;
	}
}

$migratePINS = new MigratePINS;
$migratePINS->Main();
?>
