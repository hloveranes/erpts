<?php
include_once "../includes/web/prepend.php";
include_once "../includes/web/clibPDFWriter.php";
include_once "../includes/collection/Receipt.php";
include_once "../includes/collection/Payment.php";
include_once "../includes/collection/Due.php";
include_once "../includes/collection/BacktaxTD.php";
include_once "../includes/collection/TreasurySettings.php";

include_once "../includes/assessor/eRPTSSettings.php";


class CollectionReport{

	var $tpl;
	var $formArray;

	function CollectionReport($sess,$http_post_vars){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "nine.xml") ;
		$this->tpl->set_var("TITLE", "CollectionReport");

		$this->formArray["classification"] = "";

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}	
	}

	function getTreasurySettings(){
		$treasurySettings = new TreasurySettings;
		$treasurySettings->selectRecord();
		return $treasurySettings;
	}

	function getPenaltyLUTArray(){
		$treasurySettings = $this->getTreasurySettings();
		$penaltyLUTArray = $treasurySettings->getPenaltyLUT();
		$this->formArray["penaltyLUTArray"] = $treasurySettings->getPenaltyLUT();
		return $penaltyLUTArray;
	}

	function computePenalty($penaltyComputeDate,$due){
		// compute Penalty as of $penaltyComputeDate
		// check if today is exceeding dueDate and compute penalty

		$totalMonths=0;

		if(strtotime($penaltyComputeDate) > strtotime($due->getDueDate())){
			// count months

			// numYears = today[year] - dueDate[year]
			$numYears = date("Y",strtotime($penaltyComputeDate)) - date("Y",strtotime($due->getDueDate()));
			// numMonths = today[month] - dueDate[month]
			$numMonths = date("n",strtotime($penaltyComputeDate)) - date("n",strtotime($due->getDueDate()));
			// totalMonths = (numYears*12) + numMonths

			$totalMonths = $due->calculateMonthOverDue(date("Y-m-d",strtotime($penaltyComputeDate)));

			// associate penaltyPercentage

			$penaltyLUTArray = $this->getPenaltyLUTArray();

			if($totalMonths >= count($penaltyLUTArray)){
				$penaltyPercentage = 0.72;
			}
			else{			
				$penaltyPercentage = $penaltyLUTArray[$totalMonths];
			}

			$penalty = $due->getTaxDue() * $penaltyPercentage;

			$due->setMonthsOverDue($totalMonths);
			$due->setPenaltyPercentage($penaltyPercentage);
			$due->setPenalty($penalty);
		}
		else{
			$due->setMonthsOverDue(0);
			$due->setPenaltyPercentage(0.00);
			$due->setPenalty(0.00);
		}

		return $due;
	}


	function Main(){
		$eRPTSSettings = new eRPTSSettings;
		if($eRPTSSettings->selectRecord(1)){
			$this->tpl->set_var("lguType",strtoupper($eRPTSSettings->getLguType()));
			$this->tpl->set_var("lguName",strtoupper($eRPTSSettings->getLguName()));
		}

		$dbTD = new DB_RPTS;
		$dbBacktaxTD = new DB_RPTS;
		$dbPaymentBacktaxTD = new DB_RPTS;
		$dbPaymentTD = new DB_RPTS;
		$dbCollectionBacktaxTD = new DB_RPTS;
		$dbCollectionTD = new DB_RPTS;
		$dbDue = new DB_RPTS;

		// gather TD's

		$sql = "SELECT Due.dueID as dueID, ".
				"Due.tdID as tdID, ".
				"Due.dueType as dueType, ".
				"Due.dueDate as dueDate, ".
				"Due.basicTax as basicTax, ".
				"Due.basicTaxRate as basicTaxRate, ".
				"Due.sefTax as sefTax, ".
				"Due.sefTaxRate as sefTaxRate, ".
				"Due.idleTax as idleTax, ".
				"Due.idleTaxRate as idleTaxRate, ".
				"TD.afsID as afsID, ".
				"TD.propertyType as propertyType, ".
				"TD.taxDeclarationNumber as taxDeclarationNumber, ".
				"AFS.odID as odID, ".
				"AFS.arpNumber as arpNumber, ".
				"AFS.propertyIndexNumber as propertyIndexNumber, ".
				"AFS.taxability as taxability, ".
				"AFS.effectivity as effectivity, ".
				"AFS.totalMarketValue as totalMarketValue, ".
				"AFS.totalAssessedValue as totalAssessedValue ".
				"FROM Due, TD, AFS ".
				"WHERE Due.tdID = TD.tdID ".
				"AND TD.afsID = AFS.afsID ".
				"AND AFS.archive != 'true' ".
				"AND TD.archive != 'true' ".
				"AND Due.dueType = 'Annual' ".
				"AND TD.propertyType LIKE '".$this->formArray["classification"]."' ".
				"GROUP BY Due.tdID, YEAR(Due.dueDate) ".
				"ORDER BY Due.dueDate DESC";

		$dbTD->query($sql);
		if($dbTD->nf() > 0){
			// gather BacktaxTD's
			while($dbTD->next_record()){
				$sqlBacktaxTD = "SELECT backtaxTDID, ".
					"tdID, ".
					"tdNumber, ".
					"startYear, ".
					"endYear, ".
					"startQuarter, ".
					"assessedValue, ".
					"basicRate, ".
					"sefRate, ".
					"basicTax, ".
					"sefTax, ".
					"idleTax, ".
					"penalties, ".
					"paid, ".
					"balance, ".
					"total ".
					"FROM BacktaxTD ".
					"WHERE tdID='".$dbTD->f("tdID")."' ".
					"ORDER BY startYear ASC ";

				$dbBacktaxTD->query($sqlBacktaxTD);
				if($dbBacktaxTD->nf() > 0){
					while($dbBacktaxTD->next_record()){
						$backtaxTDRecordArray[] = $dbBacktaxTD->Record;
					}
				}

				$tdRecordArray[] = array(
					"td" => $dbTD->Record
					,"backtaxTD" => $backtaxTDRecordArray
				);

				unset($backtaxTDRecordArray);
			}
		}

		if(is_array($tdRecordArray)){
			foreach($tdRecordArray as $recordArray){
				// gather backtaxTD details
				if(is_array($recordArray["backtaxTD"])){
					foreach($recordArray["backtaxTD"] as $backtaxTDRecord){
						$paidBasic = 0;
						$paidSEF = 0;
						$paidPenalty = 0;
						$totalTaxCollected = 0;
						$basic = 0;
						$sef = 0;
						$penalty = 0;
						$totalCollectible = 0;

						// get totalTaxCollected

						$sqlPaymentBacktaxTD = "SELECT paymentID, ".
							"dueType, ".
							"backtaxTDID, ".
							"taxDue, ".
							"earlyPaymentDiscount, ".
							"advancedPaymentDiscount, ".
							"penalty, ".
							"amnesty, ".
							"balanceDue, ".
							"amountPaid, ".
							"dueDate, ".
							"paymentDate ".
							"FROM Payment ".
							"WHERE backtaxTDID='".$backtaxTDRecord["backtaxTDID"]."' ".
							"AND status!='cancelled'";

						$dbPaymentBacktaxTD->query($sqlPaymentBacktaxTD);
						if($dbPaymentBacktaxTD->nf() > 0){
							while($dbPaymentBacktaxTD->next_record()){
								$sqlCollectionBacktaxTD = "SELECT * ".
									"FROM Collection ".
									"WHERE paymentID='".$dbPaymentBacktaxTD->f("paymentID")."' ".
									"AND status!='cancelled' ";

								$dbCollectionBacktaxTD->query($sqlCollectionBacktaxTD);
								if($dbCollectionBacktaxTD->nf() > 0){
									while($dbCollectionBacktaxTD->next_record()){
										switch($dbCollectionBacktaxTD->f("taxType")){
											case "basic":
												if($dbCollectionBacktaxTD->f("amnesty")!="true"){
													$paidBasic += ($dbCollectionBacktaxTD->f("amountPaid") - $dbCollectionBacktaxTD->f("penalty"));
													$paidPenalty += $dbCollectionBacktaxTD->f("penalty");
													$totalTaxCollected += $dbCollectionBacktaxTD->f("amountPaid");
												}
												else{
													$paidBasic += ($dbCollectionBacktaxTD->f("amountPaid"));
													$totalTaxCollected += $paidBasic;
												}
												break;
											case "sef":
												if($dbCollectionBacktaxTD->f("amnesty")!="true"){
													$paidSEF += ($dbCollectionBacktaxTD->f("amountPaid") - $dbCollectionBacktaxTD->f("penalty"));
													$paidPenalty += $dbCollectionBacktaxTD->f("penalty");
													$totalTaxCollected += $dbCollectionBacktaxTD->f("amountPaid");
												}
												else{
													$paidSEF += ($dbCollectionBacktaxTD->f("amountPaid"));
													$totalTaxCollected += $paidSEF;
												}
												break;
										}
									}
								}
							}
						}

						// get totalCollectible

						$basic = $backtaxTDRecord["basicTax"];
						$sef = $backtaxTDRecord["sefTax"];

						$backtaxTD = new BacktaxTD;
						$backtaxTD->selectRecord("",$backtaxTDRecord["backtaxTDID"],"");
						$backtaxTD->calculatePenalty(date("Y-m-d"));
						$penalty = $backtaxTD->getPenalties();

						$totalCollectible = $basic + $sef + $penalty;

						$lineRecordArray[] = array(
							"propertyIndexNumber" => "TD#:".$backtaxTDRecord["tdNumber"]." (".$backtaxTDRecord["startYear"].")"
							,"tdNumber" => $backtaxTDRecord["tdNumber"]
							,"paidBasic" => $paidBasic
							,"paidSEF" => $paidSEF
							,"paidPenalty" => $paidPenalty
							,"totalTaxCollected" => $totalTaxCollected
							,"basic" => $basic
							,"sef" => $sef
							,"penalty" => $penalty
							,"totalCollectible" => $totalCollectible
						);
					}
				
				}

				$paidBasic = 0;
				$paidSEF = 0;
				$paidPenalty = 0;
				$totalTaxCollected = 0;
				$basic = 0;
				$sef = 0;
				$penalty = 0;
				$totalCollectible = 0;

				// gather TD details
				if(is_array($recordArray["td"])){
					$tdRecord = $recordArray["td"];

					// get totalTaxCollected

					$sqlPaymentTD = "SELECT paymentID, ".
						"dueType, ".
						"backtaxTDID, ".
						"taxDue, ".
						"earlyPaymentDiscount, ".
						"advancedPaymentDiscount, ".
						"penalty, ".
						"amnesty, ".
						"balanceDue, ".
						"amountPaid, ".
						"dueDate, ".
						"paymentDate ".
						"FROM Payment ".
						"WHERE tdID='".$tdRecord["tdID"]."' ".
						"AND status!='cancelled'";

					$dbPaymentTD->query($sqlPaymentTD);
					if($dbPaymentTD->nf() > 0){
						while($dbPaymentTD->next_record()){
							$sqlCollectionTD = "SELECT * ".
								"FROM Collection ".
								"WHERE paymentID='".$dbPaymentTD->f("paymentID")."' ".
								"AND status!='cancelled' ";

							$dbCollectionTD->query($sqlCollectionTD);
							if($dbCollectionTD->nf() > 0){
								while($dbCollectionTD->next_record()){
									switch($dbCollectionTD->f("taxType")){
										case "basic":
											if($dbCollectionTD->f("amnesty")!="true"){
												$paidBasic += ($dbCollectionTD->f("amountPaid") - $dbCollectionTD->f("penalty"));
												$paidPenalty += $dbCollectionTD->f("penalty");
												$totalTaxCollected += $dbCollectionTD->f("amountPaid");
											}
											else{
												$paidBasic += ($dbCollectionTD->f("amountPaid"));
												$totalTaxCollected += $paidBasic;
											}
											break;
										case "sef":
											if($dbCollectionTD->f("amnesty")!="true"){
												$paidSEF += ($dbCollectionTD->f("amountPaid") - $dbCollectionTD->f("penalty"));
												$paidPenalty += $dbCollectionTD->f("penalty");
												$totalTaxCollected += $dbCollectionTD->f("amountPaid");
											}
											else{
												$paidSEF += ($dbCollectionTD->f("amountPaid"));
												$totalTaxCollected += $paidSEF;
											}
											break;
									}
								}
							}
						}
					}

					// get totalCollectible

					$due = new Due;
					if($due->selectRecord($tdRecord["dueID"])){
						$basic = $due->getBasicTax();
						$sef = $due->getSefTax();

						$due = $this->computePenalty(date("Y-m-d"),$due);
						$penalty = $due->getPenalty();

						$totalCollectible = $basic + $sef + $penalty;
					}

					$lineRecordArray[] = array(
						"propertyIndexNumber" => $tdRecord["propertyIndexNumber"]
						,"tdNumber" => $tdRecord["taxDeclarationNumber"]
						,"paidBasic" => $paidBasic
						,"paidSEF" => $paidSEF
						,"paidPenalty" => $paidPenalty
						,"totalTaxCollected" => $totalTaxCollected
						,"basic" => $basic
						,"sef" => $sef
						,"penalty" => $penalty
						,"totalCollectible" => $totalCollectible
					);

				}

			}
		}

		// print page

		if(is_array($lineRecordArray)){
			$ypos = 400;
			$decrementYposBy = 12;
			$linesPerPage = 20;

			$count = count($lineRecordArray);
			$numOfPages = ceil($count / $linesPerPage);
			$pageCtr = 1;
			$lineCtr = 1;
			$recordCtr = 1;

			$this->tpl->set_var("classification", $this->formArray["classification"]);
			$this->tpl->set_var("numOfPages", $numOfPages);

			$this->tpl->set_block("rptsTemplate", "Page", "PageBlock");
			$this->tpl->set_block("Page", "Row", "RowBlock");
			$this->tpl->set_block("Page", "Totals", "TotalsBlock");

			$totalsArray = array(
				"totalPaidBasic" => 0
				,"totalPaidSEF" => 0
				,"totalPaidPenalty" => 0
				,"totalTotalTaxCollected" => 0
				,"totalBasic" => 0
				,"totalSef" => 0
				,"totalPenalty" => 0
				,"totalTotalCollectible" => 0
			);

			foreach($lineRecordArray as $recordArray){
				$this->tpl->set_var("ypos",$ypos);
				$this->tpl->set_var("recordCtr", $recordCtr);

				// tally totals
				$totalsArray["totalPaidBasic"] += un_number_format($recordArray["paidBasic"]);
				$totalsArray["totalPaidSEF"] += un_number_format($recordArray["paidSEF"]);
				$totalsArray["totalPaidPenalty"] += un_number_format($recordArray["paidPenalty"]);
				$totalsArray["totalTotalTaxCollected"] += un_number_format($recordArray["totalTaxCollected"]);
				$totalsArray["totalBasic"] += un_number_format($recordArray["basic"]);
				$totalsArray["totalSef"] += un_number_format($recordArray["sef"]);
				$totalsArray["totalPenalty"] += un_number_format($recordArray["penalty"]);
				$totalsArray["totalTotalCollectible"] += un_number_format($recordArray["totalCollectible"]);

				// write values
				foreach($recordArray as $key=>$value){
					switch($key){
						case "paidBasic":
						case "paidSEF":
						case "paidPenalty":
						case "totalTaxCollected":
						case "basic":
						case "sef":
						case "penalty":
						case "totalCollectible":
							$value = formatCurrency($value);
							break;
					}
					$this->tpl->set_var($key,$value);
				}		

				$this->tpl->parse("RowBlock", "Row", true);

				if($recordCtr==(count($lineRecordArray)) || $lineCtr==$linesPerPage){
					if($pageCtr==$numOfPages){
						foreach($totalsArray as $key=>$value){
							$value = formatCurrency($value);
							$this->tpl->set_var($key,$value);
						}		
						$this->tpl->parse("TotalsBlock", "Totals", true);
					}
					else{
						$this->tpl->set_var("TotalsBlock", "");
					}

					$this->tpl->set_var("page", $pageCtr);
					$this->tpl->parse("PageBlock", "Page", true);
					$this->tpl->set_var("RowBlock", "");
					$this->tpl->set_var("TotalsBlock", "");

					$ypos = 400;
					$lineCtr=0;
					$pageCtr++;
				}

				$lineCtr++;
				$recordCtr++;
				$ypos = $ypos - $decrementYposBy;
			}

	        $this->tpl->parse("templatePage", "rptsTemplate");
	        $this->tpl->finish("templatePage");

			$testpdf = new PDFWriter;
	        $testpdf->setOutputXML($this->tpl->get("templatePage"),"test");
	        if(isset($this->formArray["print"])){
	        	$testpdf->writePDF($name);//,$this->formArray["print"]);
	        }
	        else {
	        	$testpdf->writePDF($name);
	        }

		}
		else{
			exit("no records to display");
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
