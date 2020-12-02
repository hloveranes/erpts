<?php
class Storey
{
	//attributes
	var $storeyID;
	var $improvementsBuildingsID;
	var $floorNumber;
	var $area;
	var $materials;
	var $value;
	var $foundation;
	var $columnsBeams;
	var	$trussFraming;
	var $roof;
	var $exteriorWall;
	var $flooring;
	var $doors;
	var $windows;
	var $stairs;
	var $wallFinish;
	var $electrical;
	var $toiletAndBath;
	var $plumbingSewer;
	var $fixtures;
	var $domStorey;
	var $db;
	
	//contructor
	function ImprovementsBuildings(){
	}
	function setDB(){
		$this->db = new DB_RPTS;
	}
	//methods
	//set methods
	function setStoreyID($tempVar){
		$this->storeyID = $tempVar;
	}
	function setImprovementsBuildingsID($tempVar){
		$this->improvementsBuildingsID = $tempVar;
	}
	function setFloorNumber($tempVar){
		$this->floorNumber = $tempVar;
	}
	function setArea($tempVar){
		$this->area = $tempVar;
	}
	function setMaterials($tempVar){
		$this->materials = $tempVar;
	}
	function setValue($tempVar){
		$this->value = $tempVar;
	}
	function setFoundation($tempVar){
		$this->foundation = $tempVar;
	}
	function setColumnsBeams($tempVar){
		$this->columnsBeams = $tempVar;
	}
	function setTrussFraming($tempVar){
		$this->trussFraming = $tempVar;
	}
	function setRoof($tempVar){
		$this->roof = $tempVar;
	}
	function setExteriorWall($tempVar){
		$this->exteriorWall = $tempVar;
	}
	function setFlooring($tempVar){
		$this->flooring = $tempVar;
	}
	function setDoors($tempVar){
		$this->doors = $tempVar;
	}
	function setWindows($tempVar){
		$this->windows = $tempVar;
	}
	function setStairs($tempVar){
		$this->stairs = $tempVar;
	}
	function setWallFinish($tempVar){
		$this->wallFinish = $tempVar;
	}
	function setElectrical($tempVar){
		$this->electrical = $tempVar;
	}
	function setToiletAndBath($tempVar){
		$this->toiletAndBath = $tempVar;
	}
	function setPlumbingSewer($tempVar){
		$this->plumbingSewer = $tempVar;
	}
	function setFixtures($tempVar){
		$this->fixtures = $tempVar;
	}
	function setDocNode ($elementName,$elementValue,$domDoc,$indexNode){
		$nodeName = "";
		$nodeText = "";
		$nodeName = $domDoc->create_element($elementName);
		$nodeName = $indexNode->append_child($nodeName);
		$nodeText = $domDoc->create_text_node($elementValue);
		$nodeText = $nodeName->append_child($nodeText);
	}
	
	function setDomStorey (){
		$this->domStorey = domxml_new_doc("1.0");
		$rec = $this->domStorey->create_element("Storey");
		$rec = $this->domStorey->append_child($rec);
		$rec->set_attribute("storeyID",$this->storeyID);	
		$this->setDocNode("storeyID",$this->storeyID,$this->domStorey,$rec);
		$this->setDocNode("improvementsBuildingsID",$this->improvementsBuildingsID,$this->domStorey,$rec);
		$this->setDocNode("floorNumber",$this->floorNumber,$this->domStorey,$rec);
		$this->setDocNode("area",$this->area,$this->domStorey,$rec);
		$this->setDocNode("materials",$this->materials,$this->domStorey,$rec);
		$this->setDocNode("value",$this->value,$this->domStorey,$rec);
		$this->setDocNode("foundation",$this->foundation,$this->domStorey,$rec);
		$this->setDocNode("columnsBeams",$this->columnsBeams,$this->domStorey,$rec);
		$this->setDocNode("trussFraming",$this->trussFraming,$this->domStorey,$rec);
		$this->setDocNode("roof",$this->roof,$this->domStorey,$rec);
		$this->setDocNode("exteriorWall",$this->exteriorWall,$this->domStorey,$rec);
		$this->setDocNode("flooring",$this->flooring,$this->domStorey,$rec);
		$this->setDocNode("doors",$this->doors,$this->domStorey,$rec);
		$this->setDocNode("windows",$this->windows,$this->domStorey,$rec);
		$this->setDocNode("stairs",$this->stairs,$this->domStorey,$rec);
		$this->setDocNode("wallFinish",$this->wallFinish,$this->domStorey,$rec);
		$this->setDocNode("electrical",$this->electrical,$this->domStorey,$rec);
		$this->setDocNode("toiletAndBath",$this->toiletAndBath,$this->domStorey,$rec);
		$this->setDocNode("plumbingSewer",$this->plumbingSewer,$this->domStorey,$rec);
		$this->setDocNode("fixtures",$this->fixtures,$this->domStorey,$rec);
	}
	
	function parseDomStorey($domDoc){
		$baseNode = $domDoc->document_element();
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			while ($child){
				//eval("\$this->set".ucfirst($child->tagname)."(\"".$child->get_content()."\");");

				// test varvars
				$varvar = $child->tagname;
				$this->$varvar = $child->get_content();

				$child = $child->next_sibling();
			}
		}
		$this->setDomStorey();
	}
	//get methods
	function getStoreyID(){
		return $this->storeyID;
	}
	function getImprovementsBuildingsID(){
		return $this->improvementsBuildingsID;
	}
	function getFloorNumber(){
		return $this->floorNumber;
	}
	function getArea(){
		return $this->area;
	}
	function getMaterials()	{
		return $this->materials;
	}
	function getValue()	{
		return $this->value;
	}
	function getFoundation(){
		return $this->foundation;
	}
	function getColumnsBeams(){
		return $this->columnsBeams;
	}
	function getTrussFraming(){
		return $this->trussFraming;
	}
	function getRoof(){
		return $this->roof;
	}
	function getExteriorWall(){
		return $this->exteriorWall;
	}
	function getFlooring(){
		return $this->flooring;
	}
	function getDoors(){
		return $this->doors;
	}
	function getWindows(){
		return $this->windows;
	}
	function getStairs(){
		return $this->stairs;
	}
	function getWallFinish(){
		return $this->wallFinish;
	}
	function getElectrical(){
		return $this->electrical;
	}
	function getToiletAndBath(){
		return $this->toiletAndBath;
	}
	function getPlumbingSewer(){
		return $this->plumbingSewer;
	}
	function getFixtures(){
		return $this->fixtures;
	}
	function getDomStorey(){
		return $this->domStorey;
	}	
	//others
	function selectStorey($storeyID){
		if ($storeyID=="") return;

		$this->setDB();
		$sql = sprintf("SELECT * FROM %s WHERE storeyID=%s;",
			STOREY_TABLE, $storeyID);
		$this->db->query($sql);
		
		$storey = new Storey;
		if ($this->db->next_record()) {
			$this->storeyID = $this->db->f("storeyID");
			$this->improvementsBuildingsID = $this->db->f("improvementsBuildingsID");
			$this->floorNumber = $this->db->f("floorNumber");
			$this->area = $this->db->f("area");
			$this->materials = $this->db->f("materials");
			$this->value = $this->db->f("value");
			$this->foundation = $this->db->f("foundation");
			$this->columnsBeams = $this->db->f("columnsBeams");
			$this->trussFraming = $this->db->f("trussFraming");
			$this->roof = $this->db->f("roof");
			$this->exteriorWall = $this->db->f("exteriorWall");
			$this->flooring = $this->db->f("flooring");
			$this->doors = $this->db->f("doors");
			$this->windows = $this->db->f("windows");
			$this->stairs = $this->db->f("stairs");
			$this->wallFinish = $this->db->f("wallFinish");
			$this->electrical = $this->db->f("electrical");
			$this->toiletAndBath = $this->db->f("toiletAndBath");
			$this->plumbingSewer = $this->db->f("plumbingSewer");
			$this->fixtures = $this->db->f("fixtures");
			$this->setDomStorey();
			$ret = true;
		}
		else $ret = false;
		return $ret;
	}

	function insertStorey($improvementsBuildingsID=""){
		$sql = sprintf("insert into %s (".
			"improvementsBuildingsID, floorNumber, ".
			"area, materials, ".
			"value, foundation, ".
			"columnsBeams, trussFraming, ".
			"roof, exteriorWall, ".
			"flooring, doors, ".
			"windows, stairs, ".
			"wallFinish, electrical, ".
			"toiletAndBath, plumbingSewer, ".
			"fixtures".
			") ".
			"values ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', ".
			"'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ".
			");",
			STOREY_TABLE,
			$this->improvementsBuildingsID, fixQuotes($this->floorNumber),
			fixQuotes($this->area), fixQuotes($this->materials),
			fixQuotes($this->value), fixQuotes($this->foundation),
			fixQuotes($this->columnsBeams), fixQuotes($this->trussFraming),
			fixQuotes($this->roof), fixQuotes($this->exteriorWall),
			fixQuotes($this->flooring), fixQuotes($this->doors),
			fixQuotes($this->windows), fixQuotes($this->stairs),
			fixQuotes($this->wallFinish), fixQuotes($this->electrical),
			fixQuotes($this->toiletAndBath), fixQuotes($this->plumbingSewer),
			fixQuotes($this->fixtures)
			);
		//echo $sql;
		$this->setDB();
		$this->db->beginTransaction();
		$this->db->query($sql);
		$storeyID = $this->db->insert_id();
		if ($this->db->Errno!=0) {
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$ret = $storeyID;
		}
		return $ret;
	}
	
	function updateStorey(){
		$sql = sprintf("update %s set ".
			"improvementsBuildingsID = '%s', floorNumber = '%s', ".
			"area = '%s', materials = '%s', ".
			"value = '%s', foundation = '%s', ".
			"columnsBeams = '%s', trussFraming = '%s', ".
			"roof = '%s', exteriorWall = '%s', ".
			"flooring = '%s', doors = '%s', ".
			"windows = '%s', stairs = '%s', ".
			"wallFinish = '%s', electrical = '%s', ".
			"toiletAndBath = '%s', plumbingSewer = '%s', ".
			"fixtures = '%s'".
			"where storeyID = '%s';",
			STOREY_TABLE,
			fixQuotes($this->improvementsBuildingsID), fixQuotes($this->floorNumber),
			fixQuotes($this->area), fixQuotes($this->materials),
			fixQuotes($this->value), fixQuotes($this->foundation),
			fixQuotes($this->columnsBeams), fixQuotes($this->trussFraming),
			fixQuotes($this->roof), fixQuotes($this->exteriorWall),
			fixQuotes($this->flooring), fixQuotes($this->doors),
			fixQuotes($this->windows), fixQuotes($this->stairs),
			fixQuotes($this->wallFinish), fixQuotes($this->electrical),
			fixQuotes($this->toiletAndBath), fixQuotes($this->plumbingSewer),
			fixQuotes($this->fixtures),
			$this->storeyID			
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
			$ret = $this->storeyID;
		}
		return $ret;
	}
	
		function deleteStorey($storeyID){
		$this->setDB();
		$this->db->beginTransaction();

		$this->selectStorey($storeyID);
		$sql = sprintf("delete from %s where storeyID=%s;",
			STOREY_TABLE, $storeyID);
		$this->db->query($sql);
		$storeyRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$returnRows = array($$storeyRows => $storeyRows);
			$ret = $returnRows;
		}
		return $ret;
	}
	
	function removeStorey($storeyID){
		$this->setDB();
		$this->db->beginTransaction();

		$this->selectStorey($storeyID);
		$sql = sprintf("update %s set improvementsBuildingsID = '0' where storeyID=%s;",
			STOREY_TABLE, $storeyID);
		$this->db->query($sql);
		$storeyRows = $this->db->affected_rows();
		
		if ($this->db->Errno != 0) {
			$errno = $this->db->Errno;
			$this->db->rollbackTransaction();
			$this->db->resetErrors();
			$ret = false;
		}
		else {
			$this->db->endTransaction();
			$returnRows = array($$storeyRows => $storeyRows);
			$ret = $returnRows;
		}
		return $ret;
	}
}
?>