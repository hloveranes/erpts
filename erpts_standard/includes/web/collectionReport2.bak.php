<?php
include_once "./prepend.php";
require_once('collection/Receipt.php');
//require_once('collection/Collections.php');
require_once('collection/Payment.php');
//require_once('collection/dues.php');
include('web/clibPDFWriter.php');

page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));

$db = new DB_RPTS;
$receiptNo=1;


$lguName="";
//if (!$municipalityCityID) $municipalityCityID=1;
$sql = "select description from MunicipalityCity where MunicipalityCityID=$municipalityCityID;";
//echo $sql."<br>";
$db->query($sql);
if ($db->next_record()) $lguName=$db->f("description");
//echo $lguName;
$startDate = "$startYY-$startMM-01";
$endDate = "$endYY-$endMM-01";

$rpuClass = $actualUse;
switch($propertyType){
	case 1:
		$sql = writeQuery("Land",$startDate,$endDate,$municipalityCityID,$rpuClass);
		$db->query("select description from LandActualUses where code = '$actualUse'");
		if ($db->next_record()) $rpuClassDesc=$db->f("description");
		break;
	case 2:
		$sql = writeQuery("ImprovementsBuildings",$startDate,$endDate,$municipalityCityID,$rpuClass);		
		$db->query("select description from ImprovementsBuildingsActualUses where code = '$actualUse'");
		if ($db->next_record()) $rpuClassDesc=$db->f("description");
		break;
	case 3:
		$sql = writeQuery("Machineries",$startDate,$endDate,$municipalityCityID,$rpuClass);		
		$db->query("select description from MachineriesActualUses where code = '$actualUse'");
		if ($db->next_record()) $rpuClassDesc=$db->f("description");
		break;
	case 4:
		$sql = writeQuery("PlantsTrees",$startDate,$endDate,$municipalityCityID,$rpuClass);		
		$db->query("select description from PlantsTreesActualUses where code = '$actualUse'");
		if ($db->next_record()) $rpuClassDesc=$db->f("description");
		break;
	default:
		break;
	
}

/*$sql = "select Receipt.receiptNumber as orNo".
			", Receipt.receiptDate as datePaid".
			", Collection.collectionID".
			", Receipt.receiptID".
			", Payment.paymentID".
			", Due.dueID".
			", TD.tdID".
			//", Owner.receivedFrom as taxpayerName".
			//", Barangay.description as barangay".
			//", TD.propertyType as propertyType".
			" FROM Collection".
			" INNER JOIN Receipt ON Receipt.receiptID = Collection.receiptID".
			" INNER JOIN Payment ON Payment.paymentID = Collection.paymentID".
			" INNER JOIN Due ON Due.dueID = Payment.dueID".
			" INNER JOIN TD ON TD.tdID = Due.tdID".
			//" INNER JOIN AFS ON AFS.afsID = TD.afsID".
			//" INNER JOIN OD ON OD.odID = AFS.odID".
			//" INNER JOIN Location ON Location.odID = OD.odID".
			//" INNER JOIN LocationAddress ON LocationAddress.locationAddressID = Location.locationAddressID".
			//" INNER JOIN Barangay ON Barangay.barangayID=LocationAddress.barangayID".

			" WHERE Receipt.receiptDate between '$startDate' AND '$endDate';";
			//" AND municipality=$municipalityCityID";

exit($sql."<br>");
//*/
#echo("----------<br>");
//exit($sql."<br>");
$db->query($sql);

$buffer=array();
for ($i=0; $db->next_record(); $i++) {
	foreach($db->Record as $k=>$v) {
		if (is_string($k)) {
			#echo("$k=>$v<br>");
			$buffer[$i][$k]=$v;
		}
	}
	#echo("----------<br>");
}
//print_r($buffer);
for ($i=0; $i<count($buffer); $i++) {
	$receiptNo=$buffer[$i][orNo];
	
	$ownerID = $buffer[$i][taxpayerName];
	$ownerName = getOwnerNameFromOwnerID($ownerID);
	$buffer[$i][taxpayerName] = $ownerName;	
	
	$buffer[$i][taxpayerName] = substr($buffer[$i][taxpayerName],0,10);
	
	//if($buffer[$i][propertyType] == Land){
		
	//}
	#BASIC
	$sql = "SELECT".
			" sum(Due.basicTax) as grossBasic".
			", sum(Collection.taxDue) as paidBasic".
			", (sum(Collection.earlyPaymentDiscount) + sum(Collection.advancedPaymentDiscount)) as discountBasic".
			", sum(Collection.penalty) as penaltyBasic,".
			" YEAR(Due.dueDate) as yearDue".

			" FROM Collection".
			" INNER JOIN Receipt ON Receipt.receiptID = Collection.receiptID".
			" INNER JOIN Payment ON Payment.paymentID = Collection.paymentID".
			" INNER JOIN Due ON Due.dueID = Payment.dueID".

			" WHERE Receipt.receiptNumber = '$receiptNo'".
			" AND Collection.taxType='basic' and Payment.status != 'cancelled'".
			" GROUP BY YEAR(Due.dueDate)";
	//echo("$sql<br>");
	//echo("----------<br>");
	$db->query($sql);

	$buffer[$i][paidBasic]=0;
	$buffer[$i][discountBasic]=0;
	$buffer[$i][priorBasic]=0;
	$buffer[$i][penaltyBasic]=0;
	$buffer[$i][priorPenaltyBasic]=0;
	$buffer[$i][totalGrossBasic]=0;
	$buffer[$i][totalNetBasic]=0;
	for ($j=0; $db->next_record(); $j++) {
		if ($db->f("yearDue")==date("Y")) {
			$buffer[$i][paidBasic]=$db->f("paidBasic");
			$buffer[$i][discountBasic]=$db->f("discountBasic");
			$buffer[$i][penaltyBasic]=$db->f("penaltyBasic");
		} else {
			$buffer[$i][priorBasic]+=$db->f("paidBasic");
			$buffer[$i][priorPenaltyBasic]+=$db->f("penaltyBasic");
		}
	}
	$buffer[$i][totalGrossBasic]=$buffer[$i][paidBasic] + $buffer[$i][priorBasic] + $buffer[$i][penaltyBasic] + $buffer[$i][priorPenaltyBasic];
	$buffer[$i][totalNetBasic]=$buffer[$i][paidBasic] - $buffer[$i][discountBasic] + $buffer[$i][priorBasic] + $buffer[$i][penaltyBasic] + $buffer[$i][priorPenaltyBasic];


	#SEF
	$sql = "SELECT".
			" sum(Due.sefTax) as grossSEF".
			", sum(Collection.taxDue) as paidSEF".
			", (sum(Collection.earlyPaymentDiscount) + sum(Collection.advancedPaymentDiscount)) as discountSEF".
			", sum(Collection.penalty) as penaltySEF,".
			" YEAR(Due.dueDate) as yearDue".

			" FROM Collection".
			" INNER JOIN Receipt ON Receipt.receiptID = Collection.receiptID".
			" INNER JOIN Payment ON Payment.paymentID = Collection.paymentID".
			" INNER JOIN Due ON Due.dueID = Payment.dueID".

			" WHERE Receipt.receiptNumber = '$receiptNo'".
			" AND Collection.taxType='sef' and Payment.status != 'cancelled'".
			" GROUP BY YEAR(Due.dueDate)";
	#echo("$sql<br>");
	#echo("----------<br>");
	$db->query($sql);

	$buffer[$i][paidSEF]=0;
	$buffer[$i][discountSEF]=0;
	$buffer[$i][priorSEF]=0;
	$buffer[$i][penaltySEF]=0;
	$buffer[$i][priorPenaltySEF]=0;
	$buffer[$i][totalGrossSEF]=0;
	$buffer[$i][totalNetSEF]=0;
	for ($j=0; $db->next_record(); $j++) {
		if ($db->f("yearDue")==date("Y")) {
			$buffer[$i][paidSEF]=$db->f("paidSEF");
			$buffer[$i][discountSEF]=$db->f("discountSEF");
			$buffer[$i][penaltySEF]=$db->f("penaltySEF");
		} else {
			$buffer[$i][priorSEF]+=$db->f("paidSEF");
			$buffer[$i][priorPenaltySEF]+=$db->f("penaltySEF");
		}
	}
	$buffer[$i][totalGrossSEF]=$buffer[$i][paidSEF] + $buffer[$i][priorSEF] + $buffer[$i][penaltySEF] + $buffer[$i][priorPenaltySEF];
	$buffer[$i][totalNetSEF]=$buffer[$i][paidSEF] - $buffer[$i][discountSEF] + $buffer[$i][priorSEF] + $buffer[$i][penaltySEF] + $buffer[$i][priorPenaltySEF];

	
	#IDLE LAND
	$sql = "SELECT".
			" sum(Due.idleTax) as grossIdle".
			", sum(Collection.taxDue) as paidIdle".
			", (sum(Collection.earlyPaymentDiscount) + sum(Collection.advancedPaymentDiscount)) as discountIdle".
			", sum(Collection.penalty) as penaltyIdle,".
			" YEAR(Due.dueDate) as yearDue".

			" FROM Collection".
			" INNER JOIN Receipt ON Receipt.receiptID = Collection.receiptID".
			" INNER JOIN Payment ON Payment.paymentID = Collection.paymentID".
			" INNER JOIN Due ON Due.dueID = Payment.dueID".

			" WHERE Receipt.receiptNumber = '$receiptNo'".
			" AND Collection.taxType='idle' and Payment.status != 'cancelled'".
			" GROUP BY YEAR(Due.dueDate)";
	#echo("$sql<br>");
	#echo("----------<br>");
	$db->query($sql);

	$buffer[$i][paidIdle]=0;
	$buffer[$i][priorIdle]=0;
	$buffer[$i][penaltyIdle]=0;
	$buffer[$i][totalGrossIdle]=0;
	$buffer[$i][totalNetIdle]=0;
	for ($j=0; $db->next_record(); $j++) {
		if ($db->f("yearDue")==date("Y")) {
			$buffer[$i][paidIdle]=$db->f("paidIdle");
			$buffer[$i][penaltyIdle]=$db->f("penaltyIdle");
		} else {
			$buffer[$i][priorPenaltyIdle]+=$db->f("penaltyIdle");
		}
	}
	$buffer[$i][totalIdle]=$buffer[$i][paidIdle] + $buffer[$i][priorIdle] + $buffer[$i][penaltyIdle];
	
	$buffer[$i][specialLevy] = 0;

	$sql = "SELECT sum(payments.amount) as paidTotal, sum(payments.penalty) as paidPenalty".
			" FROM collections".
			" INNER JOIN collectionPayments ON collectionPayments.collectionID = collections.collectionID".
			" INNER JOIN payments ON payments.paymentID = collectionPayments.paymentID".
			" INNER JOIN dues ON dues.dueID = payments.dueID".

			" WHERE payments.receiptNum = $receiptNo".
			" AND collections.kindOfPayment <> 'cash';";
	$db->query($sql);
	$buffer[$i][totalNonCash] = $db->f("paidTotal") + $db->f("paidPenalty");

	$buffer[$i][grandTotalGrossColl] = $buffer[$i][totalGrossBasic] + $buffer[$i][totalGrossSEF] + $buffer[$i][totalIdle] + $buffer[$i][specialLevy] + $buffer[$i][totalNonCash];
	$buffer[$i][grandTotalNetColl] = $buffer[$i][totalNetBasic] + $buffer[$i][totalNetSEF] + $buffer[$i][totalIdle] + $buffer[$i][specialLevy] + $buffer[$i][totalNonCash];
}


$tpl=new rpts_Template();
//$tpl->set_file(array(report=>"collectionReport2.htm"));
$tpl->set_file(array(report=>"report2Asoa.xml"));

$tpl->set_var(lgu,$lguName);
$tpl->set_var(startDate,$startDate);
$tpl->set_var(endDate,$endDate);
$tpl->set_var(rpuClass,$rpuClassDesc);
$ypos = 424;
$ypos1 = 416;

$yposx = 428;
$yposx1 = 420;
$iStart = 0;
$jStart = 0;
$rowPerPage = 16;
//echo count($buffer)."<br>";
//echo ceil(count($buffer)/$rowPerPage)."<br>";

$tpl->set_block(report,PAGE,pageBlk);
$tpl->set_block(PAGE,ROW,rowBlk);
$tpl->set_block(PAGE,ROW1,row1Blk);

$pages = ceil(count($buffer)/$rowPerPage);
$tpl->set_var("pages",$pages*2);

for ($h=1; $h<=$pages;$h++){
	$tpl->set_var("sheet1",($h-1)*2+1);
	$tpl->set_var("sheet2",($h-1)*2+2);
	for ($i=$iStart; $i<count($buffer)&&(floor($i/$h)<$rowPerPage); $i++) {
		$ypos = $ypos - 18;
		$ypos1 = $ypos1 - 18;
		$tpl->set_var($buffer[$i]);
		$tpl->set_var(ypos,$ypos);
		$tpl->set_var(ypos1,$ypos1);
		$tpl->parse(rowBlk,ROW,true);
	}
	$iStart = $i;
	#echo("row=".$i."<br>");

	
	for ($j=$jStart; $j<count($buffer)&&(floor($j/$h)<$rowPerPage); $j++) {
		$yposx = $yposx - 18;
		$yposx1 = $yposx1 - 18;
		$tpl->set_var($buffer[$j]);
		$tpl->set_var(ypos,$yposx);
		$tpl->set_var(ypos1,$yposx1);
		$tpl->parse(row1Blk,ROW1,true);
	}
	$jStart = $j;
	#echo("row1=".$i."<br>");
	$tpl->parse(pageBlk,PAGE,true);
	$tpl->set_var(rowBlk,"");
	$tpl->set_var(row1Blk,"");
	$ypos = 424;
	$ypos1 = 416;
	$yposx = 428;
	$yposx1 = 420;
}
#exit;

//if ($i==0) {
//	$tpl->set_var(rowBlk,"<tr><td colspan=\"27\">No records yet.</td></tr>");
//}

$tpl->set_var(startDate,$startDate);
$tpl->set_var(endDate,$endDate);
$tpl->set_var("Session", $sess->url(""));
//$tpl->pparse(report,report);

///*

		$tpl->parse('report','report');
        $tpl->finish('report');
		
       $rptrpdf = new PDFWriter;
	   //exit($tpl->get('report'));
       $rptrpdf->setOutputXML($tpl->get('report'),"string");
       $rptrpdf->writePDF("collectionReport2.pdf");
//*/
page_close();

function writeQuery($var,$startDate,$endDate,$municipalityCityID,$rpuClass){
		$sql = "select Receipt.receiptNumber as orNo".
			", Receipt.receiptDate as datePaid".
			", Receipt.receivedFrom as taxpayerName".
			", Barangay.description as barangay".
			", Collection.collectionID".
			", Receipt.receiptID".
			", Payment.paymentID".
			", Due.dueID".
			", TD.tdID".
			", AFS.afsID".
			", OD.odID".
			", MunicipalityCity.description".
			//", Owner.receivedFrom as taxpayerName".
			//", Barangay.description as barangay".
			//", TD.propertyType as propertyType".
			" FROM Collection,MunicipalityCity".
			" INNER JOIN Receipt ON Receipt.receiptID = Collection.receiptID".
			" INNER JOIN Payment ON Payment.paymentID = Collection.paymentID".
			" INNER JOIN Due ON Due.dueID = Payment.dueID".
			" INNER JOIN TD ON TD.tdID = Due.tdID".
			" INNER JOIN AFS ON AFS.afsID = TD.afsID".
			" INNER JOIN $var ON AFS.afsID = ".$var.".afsID".
			" INNER JOIN ".$var."ActualUses ON $var.actualUse = ".$var."ActualUses.".strtolower($var)."ActualUsesID".		
			" INNER JOIN OD ON OD.odID = AFS.odID".
			" INNER JOIN Location ON Location.odID = OD.odID".
			" INNER JOIN LocationAddress ON LocationAddress.locationAddressID = Location.locationAddressID".
			" INNER JOIN Barangay ON Barangay.barangayID = LocationAddress.barangayID".

			" WHERE Receipt.receiptDate between '$startDate' AND '$endDate'".
			" AND MunicipalityCity.municipalityCityID=".$municipalityCityID." AND ".$var."ActualUses.code = '$rpuClass'  and Payment.status != 'cancelled';";

/*		$sql = "select distinct collections.receiptNum as orNo
			, collections.collectionDate as datePaid
			, collections.receivedFrom as taxpayerName, ".
			"Barangay.description as barangay".
			" FROM collections".
			" INNER JOIN collectionPayments ON collectionPayments.collectionID = collections.collectionID".
			" INNER JOIN payments ON payments.paymentID = collectionPayments.paymentID".
			" INNER JOIN dues ON dues.dueID = payments.dueID".
			" INNER JOIN TD ON TD.tdID = dues.tdID".
			" INNER JOIN AFS ON AFS.afsID = TD.afsID".
			" INNER JOIN $var ON AFS.afsID = ".$var.".afsID".
			" INNER JOIN ".$var."ActualUses ON $var.actualUse = ".$var."ActualUses.".strtolower($var)."ActualUsesID".		
			" INNER JOIN OD ON OD.odID = AFS.odID".
			" INNER JOIN Location ON Location.odID = OD.odID".
			" INNER JOIN LocationAddress ON LocationAddress.locationAddressID = Location.locationAddressID".
			" INNER JOIN Barangay ON Barangay.barangayID=LocationAddress.barangayID".

			" WHERE collections.collectionDate between '$startDate' AND '$endDate'".
			" AND municipality=$municipalityCityID AND ".$var."ActualUses.code = '$rpuClass'";
*/
			//exit($sql);
			return $sql;
}

function getOwnerNameFromOwnerID($ownerID){
	$dbPerson = new DB_RPTS;
	$dbCompany = new DB_RPTS;
	$ownerName = "";
		
	$sqlPerson = "SELECT ".
		" OwnerPerson.ownerID, ".
		" Person.personID AS personID, Person.lastName AS lastName, ".
		" Person.middleName AS middleName, Person.firstName ".
		" FROM Person, OwnerPerson ".
		" WHERE Person.personID = OwnerPerson.personID AND OwnerPerson.ownerID ='".$ownerID."' ".
		" GROUP BY Person.personID ";
			
	$sqlCompany = "SELECT ".
		" OwnerCompany.ownerID, ".
		" Company.companyID AS companyID, ".
		" Company.companyName AS companyName ".
		" FROM Company, OwnerCompany ".
		" WHERE Company.companyID = OwnerCompany.companyID AND OwnerCompany.ownerID ='".$ownerID."' ".
		" GROUP BY Company.companyID ";
		
	$dbPerson->query($sqlPerson);
	while($dbPerson->next_record()){
		$fullName = $dbPerson->f("firstName");
		$fullName.= " ";
		if($dbPerson->f("middleName")!=""){
			$fullName.= substr($dbPerson->f("middleName"), 0, 1) . ".";
		}
		$fullName.= " ";
		$fullName.= $dbPerson->f("lastName");
		
		$personNameArray[] = $fullName;
	}
	
	$dbCompany->query($sqlCompany);
	while($dbCompany->next_record()){
		$companyName = $dbCompany->f("companyName");
		$companyNameArray[] = $company;
	}	
	
	if(is_array($personNameArray)){
		foreach($personNameArray as $fullName){
			if($ownerName!=""){
				$ownerName .= ", ";
			}
			$ownerName .= $fullName;
		}
	}
	
	if(is_array($companyNameArray)){
		foreach($companyNameArray as $companyName){
			if($ownerName!=""){
				$ownerName .= ", ";
			}
			$ownerName .= $companyName; 
		}
	}
	return $ownerName;	
}
?>