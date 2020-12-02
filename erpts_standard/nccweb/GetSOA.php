<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/dues.php";

class GetSOA {
	var $ownerType;
	var $xmlSOA;
	var $xmlRoot;
	var $entityID;
	var $tdHistory;
	
	function GetSOA($entityID = 13, $ownerType = "Person"){
		$this->ownerType = $ownerType;
		$this->entityID = $entityID;
		$this->xmlSOA = domxml_new_doc("1.0");
		$node = $this->xmlSOA->create_element("TDHistory");
		$this->tdHistory = $this->xmlSOA->append_child($node);
	}
	function getTDHistory(){
		printf("getTDHistory(): Starting<br>\n");
		$propertyTypes= array("Land","PlantsTrees","ImprovementsBuildings","Machineries");
		$db = new DB_RPTS();
		for ($i = 0; $i<4; $i++){
			$sqlSelectTD = sprintf(
				"SELECT  tdID, taxDeclarationNumber, cancelsTDNumber
				 FROM TD LEFT JOIN Land using (propertyID) LEFT JOIN AFS using (AFSID)
			 		 LEFT JOIN OD using (ODID) LEFT JOIN Owner using (ODID)
					 LEFT JOIN OwnerPerson using (OwnerID) LEFT  JOIN %s
					 USING (PersonID)
				WHERE %s.%sID = '%s' and propertyType='%s' AND canceledByTDNumber=''
				order by tdID",$this->ownerType,
						   $this->ownerType,$this->ownerType,$this->entityID,
						   $propertyTypes[$i]);
             printf("getTDHistory(): $sqlSelectTD<br>\n");
    	     $db->query($sqlSelectTD);
    	     while($db->next_record()){
    	     	// get the individual TD's and get its information
    	     	$tdNum=$db->f("taxDeclarationNumber");
    	     	$tdID=$db->f("tdID");
    	     	printf("getTDHistory(): got onewith TD# %s (%s)<br>\n",$tdNum,$tdID);
    	     	$this->checkTD($tdNum,$this->tdHistory);
    	     }
		}
		printf("getTDHistory(): Done<br>\n");
	}
	function checkTD($tdNum = 0, &$xmlNode){
		printf("checkTD(): Starting<br>\n");
		// Get the TD Information
		$sqlSelectTD = "SELECT tdID, cancelsTDNumber, taxBeginsWithTheYear, ceasesWithTheYear
		                FROM TD
		                WHERE taxDeclarationNumber = '$tdNum'";
    	printf("checkTD(): $sqlSelectTD<br>\n");
		$dbTD = new DB_RPTS($sqlSelectTD);
		if($dbTD->next_record()){
			$tdID = $dbTD->f("tdID");
			$cancelsTD = $dbTD->f("cancelsTDNumber");
			$taxBegins = $dbTD->f("taxBeginsWithTheYear");
			$taxEnds = $dbTD->f("ceasesWithTheYear");
			if ($taxEnds == 0){ // TD is current and has no ending
			    $today = getdate();
			    $taxEnds = $today['year'];
			}
			// check if the TD still has unpaid dues
			$unpaidSinceFirst = false;
			$sqlSelectDues = "SELECT Year(dueDate) as dueYear from dues
				where tdID = '$tdID' and paidInFull = 0
				order by dueYear";
			printf("checkTD(): $sqlSelectDues<br>\n");
			$dbDues = new DB_RPTS($sqlSelectDues);
			if($dbDues->num_rows() > 0){
				// prepare a new node for this TD
				$node = $this->xmlSOA->create_element("TD");
				$node->set_attribute("Number", $tdNum);
				// attach node to xmlNode
                printf("checkTD(): Attaching a TDdues node<br>\n");
				$tdNode = $xmlNode->append_child($node);
            }
            else {
            	printf("checkTD(): found no dues<br>\n");
            }
            // get each unpaid due
			while ($dbDues->next_record()){
				$dueYear = $dbDues->f('dueYear');
				$due = new Dues($tdID,$dueYear);
				// attach to TD Node
				$dueNode = $this->xmlSOA->create_element("TaxDues");
				$dueNode->set_attribute("Year", $dueYear);
				$dueNode->set_attribute("Amount", $due->getTotalDue());
				if ($due->getPctPenalty() > 0.0)
				   $dueNode->set_attribute("PenaltyPerCent", $due->getPctPenalty());
				$newnode = $tdNode->append_child($dueNode);
				printf("checkTD(): Attaching a dues node<br>\n");
				if($dueYear == $taxBegins){
						$unpaidSinceFirst = true;
				}
			}
			// if first year dues are unpaid
			// check cancelled TD
			if($unpaidSinceFirst){
				$this->checkTD($cancelsTD,$tdNode);
			}
		}
		printf("checkTD(): Done<br>\n");
	}
	function getSOAxml(){
		return $this->xmlSOA;
	}
}
$mySOA = new GetSOA;
$mySOA->getTDHistory();
$doc = $mySOA->getSOAxml();
echo htmlentities($doc->dump_mem(true));

?>


