<?php
include_once "./prepend.php";
require_once('collection/Receipt.php');
require_once('collection/Collections.php');
require_once('collection/Payment.php');
require_once('collection/dues.php');
include('web/clibPDFWriter.php');

class CollectionReport{

	var $tpl;
	var $formArray;

	function CollectionReport($sess,$http_post_vars){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		#$this->tpl->set_file("rptsTemplate", "collectionReport1.htm") ;
		$this->tpl->set_file("rptsTemplate", "reports2B2c.xml") ;
		$this->tpl->set_var("TITLE", "CollectionReport");
		$this->formArray['province'] = "";
		$this->formArray['municipality'] = "";
		$this->formArray['levyRate'] = 0;
		$this->formArray['noBgys'] = 0;		
		$this->formArray['yearYY'] = 2003;
		$this->formArray['monthEnd'] = 'March';
		$this->formArray['ypos'] = 430;		

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
		
	}
	
	function Main(){
		$db = new DB_RPTS;
		
		$sql =  " SELECT count( distinct barangayID ) as noBgys, MunicipalityCity.description as description, Province.description as province FROM MunicipalityCity".
				" INNER  JOIN LocationAddress ON LocationAddress.municipalityCity = MunicipalityCity.MunicipalityCityID".
				" INNER  JOIN Province ON LocationAddress.province = Province.provinceID".
				" WHERE MunicipalityCity.MunicipalityCityID = ".$this->formArray['municipalityCityID'].
				" GROUP  BY (MunicipalityCity.MunicipalityCityID )";

		$db->query($sql);
		if ($db->next_record()) {
			$this->formArray['municipality']=$db->f("description");
			$this->formArray['noBgys'] = $db->f("noBgys");
			$this->formArray['province'] = $db->f("province");
		}

		if($this->formArray['quarter']=="Q1"){
			$this->formArray['startDate'] = $this->formArray['yearYY']."-01-01-";
			$this->formArray['endDate'] = $this->formArray['yearYY']."-03-31";
			$this->formArray['monthEnd'] = "March";
		}elseif($this->formArray['quarter']=="Q2"){
			$this->formArray['startDate'] = $this->formArray['yearYY']."-04-01-";
			$this->formArray['endDate'] = $this->formArray['yearYY']."-06-30";
			$this->formArray['monthEnd'] = "June";
		}elseif($this->formArray['quarter']=="Q3"){
			$this->formArray['startDate'] = $this->formArray['yearYY']."-07-01-";
			$this->formArray['endDate'] = $this->formArray['yearYY']."-09-30";
			$this->formArray['monthEnd'] = "September";
		}elseif($this->formArray['quarter']=="Q4"){
			$this->formArray['startDate'] = $this->formArray['yearYY']."-10-01-";
			$this->formArray['endDate'] = $this->formArray['yearYY']."-12-31";
			$this->formArray['monthEnd'] = "December";
		}

 			
		/*$sql =	"SELECT  LandActualUses.description as ldesc FROM  LandActualUses ".
				" INNER  JOIN ImprovementsBuildingsActualUses ON LandActualUses.description = ImprovementsBuildingsActualUses.description".
				" INNER  JOIN MachineriesActualUses ON MachineriesActualUses.description = ImprovementsBuildingsActualUses.description".
				" LEFT  JOIN PlantsTreesActualUses ON PlantsTreesActualUses.description = ImprovementsBuildingsActualUses.description";

		$db->query($sql);*/
		
		$buff = array("Residential","Agricultural","Commercial","Industrial","Mineral","Timber","Special","Hospital","Scientific","Cultural","Other");
	
		$this->tpl->set_block("rptsTemplate","ROW","rBlk");

		for($i=0;$i<count($buff);$i++){
			$this->formArray['ldesc'] = $buff[$i];
			$this->formArray['specialLevy'] = 0;
			$this->formArray['totalSpecialLevy'] += $this->formArray['specialLevy'];

			$this->compute($buff[$i],"Land","Basic");
			$this->compute($buff[$i],"Machineries","Basic");
			$this->compute($buff[$i],"ImprovementsBuildings","Basic");
			$this->compute($buff[$i],"PlantsTrees","Basic");

			$this->formArray['paidBasic'] = number_format($this->paidBasicLand + $this->paidBasicImprovementsBuildings + $this->paidBasicMachineries + $this->paidBasicPlantsTrees,2);
			$this->formArray['discountBasic'] = number_format($this->discountBasicLand + $this->discountBasicImprovementsBuildings + $this->discountBasicMachineries + $this->discountBasicPlantsTrees,2);
			$this->formArray['priorBasic'] = number_format($this->priorBasicLand  + $this->priorBasicImprovementsBuildings + $this->priorBasicMachineries + $this->priorBasicPlantsTrees,2);
			$this->formArray['penaltyBasic'] = number_format($this->penaltyBasicLand  + $this->penaltyBasicImprovementsBuildings + $this->penaltyBasicMachineries + $this->penaltyBasicPlantsTrees,2);
			$this->formArray['priorPenaltyBasic'] = number_format($this->priorPenaltyBasicLand  + $this->priorPenaltyBasicImprovementsBuildings + $this->priorPenaltyBasicMachineries + $this->priorPenaltyBasicPlantsTrees,2);
			$this->formArray['totalGrossBasic'] = number_format($this->totalGrossBasicLand  + $this->totalGrossBasicImprovementsBuildings + $this->totalGrossBasicMachineries + $this->totalGrossBasicPlantsTrees,2);
			$this->formArray['totalNetBasic'] = number_format($this->totalNetBasicLand  + $this->totalNetBasicImprovementsBuildings + $this->totalNetBasicMachineries + $this->totalNetBasicPlantsTrees,2);

			$this->formArray['totalTotalNetBasic'] += number_format($this->formArray['totalNetBasic'],2);
			$this->formArray['totalPaidBasic'] += number_format($this->formArray['paidBasic'],2);
			$this->formArray['totalDiscountBasic'] += number_format($this->formArray['discountBasic'],2);
			$this->formArray['totalPriorBasic'] += number_format($this->formArray['priorBasic'],2);
			$this->formArray['totalPenaltyBasic'] += number_format($this->formArray['penaltyBasic'],2);
			$this->formArray['totalPriorPenaltyBasic'] += number_format($this->formArray['priorPenaltyBasic'],2);
			$this->formArray['totalTotalGrossBasic'] += number_format($this->formArray['totalGrossBasic'],2);
			
			$this->compute($buff[$i],"Land","Sef");
			$this->compute($buff[$i],"Machineries","Sef");
			$this->compute($buff[$i],"ImprovementsBuildings","Sef");
			$this->compute($buff[$i],"PlantsTrees","Sef");

			$this->formArray['paidSEF'] = number_format($this->paidSefLand + $this->paidSefImprovementsBuildings + $this->paidSefMachineries + $this->paidSefPlantsTrees,2);
			$this->formArray['discountSEF'] = number_format($this->discountSefLand + $this->discountSefImprovementsBuildings + $this->discountSefMachineries + $this->discountSefPlantsTrees,2);
			$this->formArray['priorSEF'] = number_format($this->priorSefLand  + $this->priorSefImprovementsBuildings + $this->priorSefMachineries + $this->priorSefPlantsTrees,2);
			$this->formArray['penaltySEF'] = number_format($this->penaltySefLand  + $this->penaltySefImprovementsBuildings + $this->penaltySefMachineries + $this->penaltySefPlantsTrees,2);
			$this->formArray['priorPenaltySEF'] = number_format($this->priorPenaltySefLand  + $this->priorPenaltySefImprovementsBuildings + $this->priorPenaltyBasicMachineries + $this->priorPenaltyBasicPlantsTrees,2);
			$this->formArray['totalGrossSEF'] = number_format($this->totalGrossSefLand  + $this->totalGrossSefImprovementsBuildings + $this->totalGrossSefMachineries + $this->totalGrossSefPlantsTrees,2);
			$this->formArray['totalNetSEF'] = number_format($this->totalNetSefLand  + $this->totalNetSefImprovementsBuildings + $this->totalNetSefMachineries + $this->totalNetSefPlantsTrees,2);

			$this->formArray['totalTotalNetSEF'] += number_format($this->formArray['totalNetSEF'],2);
			$this->formArray['totalPaidSEF'] += number_format($this->formArray['paidSEF'],2);
			$this->formArray['totalDiscountSEF'] += number_format($this->formArray['discountSEF'],2);
			$this->formArray['totalPriorSEF'] += number_format($this->formArray['priorSEF'],2);
			$this->formArray['totalPenaltySEF'] += number_format($this->formArray['penaltySEF'],2);
			$this->formArray['totalPriorPenaltySEF'] += number_format($this->formArray['priorPenaltySEF'],2);
			$this->formArray['totalTotalGrossSEF'] += number_format($this->formArray['totalGrossSEF'],2);


			$this->compute($buff[$i],"Land","Idle");
			$this->compute($buff[$i],"Machineries","Idle");
			$this->compute($buff[$i],"ImprovementsBuildings","Idle");
			$this->compute($buff[$i],"PlantsTrees","Idle");

			$this->formArray['paidIdle'] = number_format($this->paidIdleLand + $this->paidIdleImprovementsBuildings + $this->paidIdleMachineries + $this->paidIdlePlantsTrees,2);
			$this->formArray['discountIdle'] = number_format($this->discountIdleLand + $this->discountIdleImprovementsBuildings + $this->discountIdleMachineries + $this->discountIdlePlantsTrees,2);
			$this->formArray['priorIdle'] = number_format($this->priorIdleLand  + $this->priorIdleImprovementsBuildings + $this->priorIdleMachineries + $this->priorIdlePlantsTrees,2);
			$this->formArray['penaltyIdle'] = number_format($this->penaltyIdleLand  + $this->penaltyIdleImprovementsBuildings + $this->penaltyIdleMachineries + $this->penaltyIdlePlantsTrees,2);
			$this->formArray['priorPenaltyIdle'] = number_format($this->priorPenaltyIdleLand  + $this->priorPenaltyIdleImprovementsBuildings + $this->priorPenaltyBasicMachineries + $this->priorPenaltyBasicPlantsTrees,2);
			$this->formArray['totalGrossIdle'] = number_format($this->totalGrossIdleLand  + $this->totalGrossIdleImprovementsBuildings + $this->totalGrossIdleMachineries + $this->totalGrossIdlePlantsTrees,2);
			$this->formArray['totalIdle'] = number_format($this->totalNetIdleLand  + $this->totalNetIdleImprovementsBuildings + $this->totalNetIdleMachineries + $this->totalNetIdlePlantsTrees,2);

			$this->formArray['totalTotalNetIdle'] += number_format($this->formArray['totalNetIdle'],2);
			$this->formArray['totalPaidIdle'] += number_format($this->formArray['paidIdle'],2);
			$this->formArray['totalDiscountIdle'] += number_format($this->formArray['discountIdle'],2);
			$this->formArray['totalPriorIdle'] += number_format($this->formArray['priorIdle'],2);
			$this->formArray['totalPenaltyIdle'] += number_format($this->formArray['penaltyIdle'],2);
			$this->formArray['totalPriorPenaltyIdle'] += number_format($this->formArray['priorPenaltyIdle'],2);
			$this->formArray['totalTotalIdle'] += number_format($this->formArray['totalIdle'],2);


			$this->computeTotalNonCash($buff[$i],"Land");
			$this->computeTotalNonCash($buff[$i],"ImprovementBuildings");
			$this->computeTotalNonCash($buff[$i],"Machineries");
			$this->computeTotalNonCash($buff[$i],"PlantsTrees");

			$this->formArray['totalNonCash'] = number_format($this->totalNoncashLand  + $this->totalNoncashImprovementsBuildings + $this->totalNoncashMachineries + $this->totalNoncashPlantsTrees,2);
			$this->formArray['grandTotalNetColl'] = number_format($this->formArray['totalNetBasic'] + $this->formArray['totalNetSEF'] + $this->formArray['totalIdle'] + $this->formArray['totalNonCash'] + $this->formArray['specialLevy'],2);

			$this->formArray['totalTotalNonCash'] += number_format($this->formArray['totalNonCash'],2);
			$this->formArray['totalGrandTotalNetColl'] += number_format($this->formArray['grandTotalNetColl'],2);
			$this->formArray['ypos'] = $this->formArray['ypos'] - 10;			
			$this->tpl->set_var($this->formArray);
			$this->tpl->parse("rBlk","ROW",true);
		}
		$this->tpl->parse("templatePage", "rptsTemplate");
		$this->tpl->finish("templatePage");
		#$this->tpl->p("templatePage");	
		
				
       $rptrpdf = new PDFWriter;
       $rptrpdf->setOutputXML($this->tpl->get('templatePage'),"string");
       $rptrpdf->writePDF("collectionReport.pdf");

	}
	function compute($ldesc,$var,$var2){
		$db = new DB_RPTS;
	
		$sql = "SELECT sum(dues.".$var2.") as gross".$var2.", sum(payments.amount) as paid".$var2.", sum(payments.discount) as discount".$var2.", sum(payments.penalty) as penalty".$var2.",".
				" YEAR(dues.dueDate) as yearDue".
				" FROM payments".
				" INNER JOIN dues ON dues.dueID = payments.dueID".
				" INNER JOIN collectionPayments on payments.paymentID=collectionPayments.paymentID".
				" INNER JOIN collections on collectionPayments.collectionID=collections.collectionID".
				" INNER JOIN TD on dues.tdID = TD.tdID".
				" INNER JOIN $var on $var.afsID=TD.afsID".
				" INNER JOIN ".$var."ActualUses on ".$var.".actualUse=".strtolower($var)."ActualUsesID ".
				" WHERE payments.dueType='".strtolower($var2)."' AND ".$var."ActualUses.description = '$ldesc'".
				" AND collections.collectionDate BETWEEN '".$this->formArray['startDate']."' AND '".$this->formArray['endDate']."'".
				" AND collections.municipality = ".$this->formArray['municipalityCityID'].
				" GROUP BY YEAR(dues.dueDate)";
		

		$db->query($sql);

		switch($var2){

			case "Basic": 
					
				switch($var){
					case "Land":	
						$this->paidBasicLand=0;
						$this->discountBasicLand=0;
						$this->priorBasicLand=0;
						$this->penaltyBasicLand=0;
						$this->priorPenaltyBasicLand=0;
						$this->totalGrossBasicLand=0;
						$this->totalNetBasicLand=0;

						for ($j=0; $db->next_record(); $j++) {
							if ($db->f("yearDue")==date("Y")) {
								$this->paidBasicLand=$db->f("paidBasic");
								$this->discountBasicLand=$db->f("discountBasic");
								$this->penaltyBasicLand=$db->f("penaltyBasic");
							} else {
								$this->priorBasicLand +=$db->f("paidBasic");
								$this->priorPenaltyBasicLand +=$db->f("penaltyBasic");
							}
						}
						$this->totalGrossBasicLand = $this->paidBasicLand + $this->priorBasicLand + $this->penaltyBasicLand + $this->priorPenaltyBasicLand;
						$this->totalNetBasicLand = $this->paidBasicLand - $this->discountBasicLand + $this->priorBasicLand + $this->penaltyBasicLand + $this->priorPenaltyBasicLand;
					break;
					case "ImprovementsBuildings":
					$this->paidBasicImprovementsBuildings=0;
					$this->discountBasicImprovementsBuildings=0;
					$this->priorBasicImprovementsBuildings=0;
					$this->penaltyBasicImprovementsBuildings=0;
					$this->priorPenaltyBasicImprovementsBuildings=0;
					$this->totalGrossBasicImprovementsBuildings=0;
					$this->totalNetBasicImprovementsBuildings=0;

					for ($j=0; $db->next_record(); $j++) {
						if ($db->f("yearDue")==date("Y")) {
							$this->paidBasicImprovementsBuildings=$db->f("paidBasic");
							$this->discountBasicImprovementsBuildings=$db->f("discountBasic");
							$this->penaltyBasicImprovementsBuildings=$db->f("penaltyBasic");
						} else {
							$this->priorBasicImprovementsBuildings+=$db->f("paidBasic");
							$this->priorPenaltyBasicImprovementsBuildings+=$db->f("penaltyBasic");
						}
					}
					$this->totalGrossBasicImprovementsBuildings = $this->paidBasicImprovementsBuildings + $this->priorBasicImprovementsBuildings + $this->penaltyBasicImprovementsBuildings + $this->priorPenaltyBasicImprovementsBuildings;
					$this->totalNetBasicImprovementsBuildings = $this->paidBasicImprovementsBuildings - $this->discountBasicImprovementsBuildings + $this->priorBasicImprovementsBuildings + $this->penaltyBasicImprovementsBuildings + $this->priorPenaltyBasicImprovementsBuildings;
					break;
					case "Machineries":
		
					$this->paidBasicMachineries=0;
					$this->discountBasicMachineries=0;
					$this->priorBasicMachineries=0;
					$this->penaltyBasicMachineries=0;
					$this->priorPenaltyBasicMachineries=0;
					$this->totalGrossBasicMachineries=0;
					$this->totalNetBasicMachineries=0;
		
					for ($j=0; $db->next_record(); $j++) {
						if ($db->f("yearDue")==date("Y")) {
							$this->paidBasicMachineries=$db->f("paidBasic");
							$this->discountBasicMachineries=$db->f("discountBasic");
							$this->penaltyBasicMachineries=$db->f("penaltyBasic");
						} else {
							$this->priorBasicMachineries+=$db->f("paidBasic");
							$this->priorPenaltyBasicMachineries+=$db->f("penaltyBasic");
						}
					}
					$this->totalGrossBasicMachineries = $this->paidBasicMachineries + $this->priorBasicMachineries + $this->penaltyBasicMachineries + $this->priorPenaltyBasicMachineries;
					$this->totalNetBasicMachineries = $this->paidBasicMachineries - $this->discountBasicMachineries + $this->priorBasicMachineries + $this->penaltyBasicMachineries + $this->priorPenaltyBasicMachineries;

					break;
					case "PlantsTrees":
		
					$this->paidBasicPlantsTrees=0;
					$this->discountBasicPlantsTrees=0;
					$this->priorBasicPlantsTrees=0;
					$this->penaltyBasicPlantsTrees=0;
					$this->priorPenaltyBasicPlantsTrees=0;
					$this->totalGrossBasicPlantsTrees=0;
					$this->totalNetBasicPlantsTrees=0;
	
					for ($j=0; $db->next_record(); $j++) {
						if ($db->f("yearDue")==date("Y")) {
							$this->paidBasicPlantsTrees=$db->f("paidBasic");
							$this->discountBasicPlantsTrees=$db->f("discountBasic");
							$this->penaltyBasicPlantsTrees=$db->f("penaltyBasic");
						} else {
							$this->priorBasicPlantsTrees+=$db->f("paidBasic");
							$this->priorPenaltyBasicPlantsTrees+=$db->f("penaltyBasic");
						}
					}
					$this->totalGrossBasicPlantsTrees = $this->paidBasicPlantsTrees + $this->priorBasicPlantsTrees + $this->penaltyBasicPlantsTrees + $this->priorPenaltyBasicPlantsTrees;
					$this->totalNetBasicPlantsTrees = $this->paidBasicPlantsTrees - $this->discountBasicPlantsTrees + $this->priorBasicPlantsTrees + $this->penaltyBasicPlantsTrees + $this->priorPenaltyBasicPlantsTrees;
				break;
				}
			break;
			case "Sef": 
		
				switch($var){
					case "Land":	
					$this->paidSefLand=0;
					$this->discountSefLand=0;
					$this->priorSefLand=0;
					$this->penaltySefLand=0;
					$this->priorPenaltySefLand=0;
					$this->totalGrossSefLand=0;
					$this->totalNetSefLand=0;

					for ($j=0; $db->next_record(); $j++) {
						if ($db->f("yearDue")==date("Y")) {
							$this->paidSefLand=$db->f("paidSef");
							$this->discountSefLand=$db->f("discountSef");
							$this->penaltySefLand=$db->f("penaltySef");
						} else {
							$this->priorSefLand +=$db->f("paidSef");
							$this->priorPenaltySefLand +=$db->f("penaltySef");
						}
					}
					$this->totalGrossSefLand = $this->paidSefLand + $this->priorSefLand + $this->penaltySefLand + $this->priorPenaltySefLand;
					$this->totalNetSefLand = $this->paidSefLand - $this->discountSefLand + $this->priorSefLand + $this->penaltySefLand + $this->priorPenaltySefLand;
					break;
				
					case "ImprovementsBuildings":
					$this->paidSefImprovementsBuildings=0;
					$this->discountSefImprovementsBuildings=0;
					$this->priorSefImprovementsBuildings=0;
					$this->penaltySefImprovementsBuildings=0;
					$this->priorPenaltySefImprovementsBuildings=0;
					$this->totalGrossSefImprovementsBuildings=0;
					$this->totalNetSefImprovementsBuildings=0;
	
					for ($j=0; $db->next_record(); $j++) {
						if ($db->f("yearDue")==date("Y")) {
							$this->paidSefImprovementsBuildings=$db->f("paidSef");
							$this->discountSefImprovementsBuildings=$db->f("discountSef");
							$this->penaltySefImprovementsBuildings=$db->f("penaltySef");
						} else {
							$this->priorSefImprovementsBuildings+=$db->f("paidSef");
							$this->priorPenaltySefImprovementsBuildings+=$db->f("penaltySef");
						}
					}
					$this->totalGrossSefImprovementsBuildings = $this->paidSefImprovementsBuildings + $this->priorSefImprovementsBuildings + $this->penaltySefImprovementsBuildings + $this->priorPenaltySefImprovementsBuildings;
					$this->totalNetSefImprovementsBuildings = $this->paidSefImprovementsBuildings - $this->discountSefImprovementsBuildings + $this->priorSefImprovementsBuildings + $this->penaltySefImprovementsBuildings + $this->priorPenaltySefImprovementsBuildings;
					break;
				case "Machineries":
		
					$this->paidSefMachineries=0;
					$this->discountSefMachineries=0;
					$this->priorSefMachineries=0;
					$this->penaltySefMachineries=0;
					$this->priorPenaltySefMachineries=0;
					$this->totalGrossSefMachineries=0;
					$this->totalNetSefMachineries=0;

					for ($j=0; $db->next_record(); $j++) {
						if ($db->f("yearDue")==date("Y")) {
							$this->paidSefMachineries=$db->f("paidSef");
							$this->discountSefMachineries=$db->f("discountSef");
							$this->penaltySefMachineries=$db->f("penaltySef");
						} else {
							$this->priorSefMachineries+=$db->f("paidSef");
							$this->priorPenaltySefMachineries+=$db->f("penaltySef");
						}
					}
					$this->totalGrossSefMachineries = $this->paidSefMachineries + $this->priorSefMachineries + $this->penaltySefMachineries + $this->priorPenaltySefMachineries;
					$this->totalNetSefMachineries = $this->paidSefMachineries - $this->discountSefMachineries + $this->priorSefMachineries + $this->penaltySefMachineries + $this->priorPenaltySefMachineries;
					break;
					case "PlantsTrees":
		
					$this->paidSefPlantsTrees=0;
					$this->discountSefPlantsTrees=0;
					$this->priorSefPlantsTrees=0;
					$this->penaltySefPlantsTrees=0;
					$this->priorPenaltySefPlantsTrees=0;
					$this->totalGrossSefPlantsTrees=0;
					$this->totalNetSefPlantsTrees=0;
	
					for ($j=0; $db->next_record(); $j++) {
						if ($db->f("yearDue")==date("Y")) {
							$this->paidSefPlantsTrees=$db->f("paidSef");
							$this->discountSefPlantsTrees=$db->f("discountSef");
							$this->penaltySefPlantsTrees=$db->f("penaltySef");
						} else {
							$this->priorSefPlantsTrees+=$db->f("paidSef");
							$this->priorPenaltySefPlantsTrees+=$db->f("penaltySef");
						}
					}

					$this->totalGrossSefPlantsTrees = $this->paidSefPlantsTrees + $this->priorSefPlantsTrees + $this->penaltySefPlantsTrees + $this->priorPenaltySefPlantsTrees;
					$this->totalNetSefPlantsTrees = $this->paidSefPlantsTrees - $this->discountSefPlantsTrees + $this->priorSefPlantsTrees + $this->penaltySefPlantsTrees + $this->priorPenaltySefPlantsTrees;
					break;

				}		
			break;
			case "Idle" : 
		
				switch($var){
					case "Land":	
					$this->paidIdleLand=0;
					$this->discountIdleLand=0;
					$this->priorIdleLand=0;
					$this->penaltyIdleLand=0;
					$this->priorPenaltyIdleLand=0;
					$this->totalGrossIdleLand=0;
					$this->totalNetIdleLand=0;

					for ($j=0; $db->next_record(); $j++) {
						if ($db->f("yearDue")==date("Y")) {
							$this->paidIdleLand=$db->f("paidIdle");
							$this->discountIdleLand=$db->f("discountIdle");
							$this->penaltyIdleLand=$db->f("penaltyIdle");
						} else {
							$this->priorIdleLand +=$db->f("paidIdle");
							$this->priorPenaltyIdleLand +=$db->f("penaltyIdle");
						}
					}
					$this->totalGrossIdleLand = $this->paidIdleLand + $this->priorIdleLand + $this->penaltyIdleLand + $this->priorPenaltyIdleLand;
					$this->totalNetIdleLand = $this->paidIdleLand - $this->discountIdleLand + $this->priorIdleLand + $this->penaltyIdleLand + $this->priorPenaltyIdleLand;
					break;
					case "ImprovementsBuildings":
					$this->paidIdleImprovementsBuildings=0;
			$this->discountIdleImprovementsBuildings=0;
			$this->priorIdleImprovementsBuildings=0;
			$this->penaltyIdleImprovementsBuildings=0;
			$this->priorPenaltyIdleImprovementsBuildings=0;
			$this->totalGrossIdleImprovementsBuildings=0;
			$this->totalNetIdleImprovementsBuildings=0;

			for ($j=0; $db->next_record(); $j++) {
				if ($db->f("yearDue")==date("Y")) {
					$this->paidIdleImprovementsBuildings=$db->f("paidIdle");
					$this->discountIdleImprovementsBuildings=$db->f("discountIdle");
					$this->penaltyIdleImprovementsBuildings=$db->f("penaltyIdle");
				} else {
					$this->priorIdleImprovementsBuildings+=$db->f("paidIdle");
					$this->priorPenaltyIdleImprovementsBuildings+=$db->f("penaltyIdle");
				}
			}
			$this->totalGrossIdleImprovementsBuildings = $this->paidIdleImprovementsBuildings + $this->priorIdleImprovementsBuildings + $this->penaltyIdleImprovementsBuildings + $this->priorPenaltyIdleImprovementsBuildings;
			$this->totalNetIdleImprovementsBuildings = $this->paidIdleImprovementsBuildings - $this->discountIdleImprovementsBuildings + $this->priorIdleImprovementsBuildings + $this->penaltyIdleImprovementsBuildings + $this->priorPenaltyIdleImprovementsBuildings;
			break;
		case "Machineries":
		
			$this->paidIdleMachineries=0;
			$this->discountIdleMachineries=0;
			$this->priorIdleMachineries=0;
			$this->penaltyIdleMachineries=0;
			$this->priorPenaltyIdleMachineries=0;
			$this->totalGrossIdleMachineries=0;
			$this->totalNetIdleMachineries=0;

			for ($j=0; $db->next_record(); $j++) {
				if ($db->f("yearDue")==date("Y")) {
					$this->paidIdleMachineries=$db->f("paidIdle");
					$this->discountIdleMachineries=$db->f("discountIdle");
					$this->penaltyIdleMachineries=$db->f("penaltyIdle");
				} else {
					$this->priorIdleMachineries+=$db->f("paidIdle");
					$this->priorPenaltyIdleMachineries+=$db->f("penaltyIdle");
				}
			}
			$this->totalGrossIdleMachineries = $this->paidIdleMachineries + $this->priorIdleMachineries + $this->penaltyIdleMachineries + $this->priorPenaltyIdleMachineries;
			$this->totalNetIdleMachineries = $this->paidIdleMachineries - $this->discountIdleMachineries + $this->priorIdleMachineries + $this->penaltyIdleMachineries + $this->priorPenaltyIdleMachineries;

			break;
		case "PlantsTrees":
		
			$this->paidIdlePlantsTrees=0;
			$this->discountIdlePlantsTrees=0;
			$this->priorIdlePlantsTrees=0;
			$this->penaltyIdlePlantsTrees=0;
			$this->priorPenaltyIdlePlantsTrees=0;
			$this->totalGrossIdlePlantsTrees=0;
			$this->totalNetIdlePlantsTrees=0;

			for ($j=0; $db->next_record(); $j++) {
				if ($db->f("yearDue")==date("Y")) {
					$this->paidIdlePlantsTrees=$db->f("paidIdle");
					$this->discountIdlePlantsTrees=$db->f("discountIdle");
					$this->penaltyIdlePlantsTrees=$db->f("penaltyIdle");
				} else {
					$this->priorIdlePlantsTrees+=$db->f("paidIdle");
					$this->priorPenaltyIdlePlantsTrees+=$db->f("penaltyIdle");
				}
			}

			$this->totalGrossIdlePlantsTrees = $this->paidIdlePlantsTrees + $this->priorIdlePlantsTrees + $this->penaltyIdlePlantsTrees + $this->priorPenaltyIdlePlantsTrees;
			$this->totalNetIdlePlantsTrees = $this->paidIdlePlantsTrees - $this->discountIdlePlantsTrees + $this->priorIdlePlantsTrees + $this->penaltyIdlePlantsTrees + $this->priorPenaltyIdlePlantsTrees;

			break;

	}

		break;
	}
	
	}
	
	function computeTotalNonCash($ldesc,$var){
		
		$db = new DB_RPTS;
		
		$sql = "SELECT sum(payments.amount) as paidTotal, sum(payments.penalty) as paidPenalty".
			" FROM collections".
			" INNER JOIN collectionPayments ON collectionPayments.collectionID = collections.collectionID".
			" INNER JOIN payments ON payments.paymentID = collectionPayments.paymentID".
			" INNER JOIN dues ON dues.dueID = payments.dueID".
			" INNER JOIN TD on dues.tdID = TD.tdID".
			" INNER JOIN $var on $var.afsID=TD.afsID".
			" INNER JOIN ".$var."ActualUses on ".$var.".actualUse=".strtolower($var)."ActualUsesID ".
			" WHERE ".$var."ActualUses.description = '$ldesc'".
			" AND collections.kindOfPayment <> 'cash' AND collections.municipality=".$this->formArray['municipalityCityID'].
			" AND collections.collectionDate BETWEEN '".$this->formArray['startDate']."' AND '".$this->formArray['endDate']."'";
				
			$db->query($sql);

			switch($var){
				case "Land":
						$this->totalNonCashLand = 0;
						$this->totalNonCashLand = $db->f("paidTotal") + $db->f("paidPenalty");		
					break;
				case "ImprovementsBuildings":
						$this->totalNonCashImprovementsBuildings = 0;
						$this->totalNonCashImprovementsBuildings = $db->f("paidTotal") + $db->f("paidPenalty");
					break;
				case "Machineries":
					$this->totalNonCashMachineries = 0;
					$this->totalNonCashMachineries = $db->f("paidTotal") + $db->f("paidPenalty");
					break;
				case "PlantsTrees":
					$this->totalNonCashPlantsTrees = 0;
					$this->totalNonCashPlantsTrees = $db->f("paidTotal") + $db->f("paidPenalty");
					break;
			}
		}
	
}
page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
$obj = new CollectionReport($sess,$HTTP_POST_VARS);
$obj->Main();
?>
<?php page_close(); ?>
