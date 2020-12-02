<?php
include_once "./prepend.php";
include_once "./clibPDFWriter.php";
include_once "../collection/Receipt.php";
include_once "../collection/Payment.php";
include_once "../collection/Due.php";
include_once "../collection/BacktaxTD.php";
include_once "../collection/TreasurySettings.php";

include_once "../assessor/eRPTSSettings.php";


class CollectionReport{

	var $tpl;
	var $formArray;

	function CollectionReport($sess,$http_post_vars){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		#$this->tpl->set_file("rptsTemplate", "collectionReport1.htm") ;
		$this->tpl->set_file("rptsTemplate", "five.xml") ;
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
		$dbDues = new DB_RPTS;

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
				"AND YEAR(Due.dueDate)  <= YEAR(NOW()) ".
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
			// verify whether each TD Record or BacktaxTD Record is delinquent by comparing it to Payment
			// if it is not in Payment it is considered delinquent 
			// if amountPaid is insufficient to amountDue, it is considered delinquent

	
			foreach($tdRecordArray as $recordArray){
				$basicAmountDelinquent = 0;
				$sefAmountDelinquent = 0;
				$penalty = 0;
				$totalDelinquent = 0;

				// find delinquent backtaxTD's
				if(is_array($recordArray["backtaxTD"])){
					foreach($recordArray["backtaxTD"] as $backtaxTDRecord){
						$basicAmountDelinquent = 0;
						$sefAmountDelinquent = 0;
						$penalty = 0;
						$totalDelinquent = 0;

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
							if($dbPaymentBacktaxTD->next_record()){
								// if amountPaid is less than balanceDue, it is delinquent
								if($dbPaymentBacktaxTD->f("amountPaid") < $dbPaymentBacktaxTD->f("balanceDue")){
									$paidBasic = ($backtaxTDRecord["basicRate"]/($backtaxTDRecord["basicRate"]+$backtaxTDRecord["sefRate"])) * $dbPaymentBacktaxTD->f("amountPaid") ;
									$paidSef = ($backtaxTDRecord["sefRate"]/($backtaxTDRecord["basicRate"]+$backtaxTDRecord["sefRate"])) * $dbPaymentBacktaxTD->f("amountPaid") ;
									$basicAmountDelinquent = $backtaxTDRecord["basicTax"] - $paidBasic;
									$sefAmountDelinquent = $backtaxTDRecord["sefTax"] - $paidSef;
									$backtaxTD = new BacktaxTD;
									$backtaxTD->selectRecord("",$backtaxTDRecord["backtaxTDID"],"");
									$backtaxTD->calculatePenalty(date("Y-m-d"));
									$penalty = $backtaxTD->getPenalties();
									$totalDelinquent = $basicAmountDelinquent + $sefAmountDelinquent + $penalty;

									$delinquentRecordArray[] = array(
										"propertyIndexNumber" => ""
										,"taxDeclarationNumber" => $backtaxTDRecord["tdNumber"]
										,"yearDelinquent" => $backtaxTDRecord["startYear"]
										,"basicAmountDelinquent" => $basicAmountDelinquent
										,"sefAmountDelinquent" => $sefAmountDelinquent
										,"penalty" => $penalty
										,"totalDelinquent" => $totalDelinquent
									);
								}
							}
						}
						else{
							$paidBasic = ($backtaxTDRecord["basicRate"]/($backtaxTDRecord["basicRate"]+$backtaxTDRecord["sefRate"])) * $backtaxTDRecord["paid"] ;
							$paidSef = ($backtaxTDRecord["sefRate"]/($backtaxTDRecord["basicRate"]+$backtaxTDRecord["sefRate"])) * $backtaxTDRecord["paid"] ;
							$basicAmountDelinquent = $backtaxTDRecord["basicTax"] - $paidBasic;
							$sefAmountDelinquent = $backtaxTDRecord["sefTax"] - $paidSef;
							$backtaxTD = new BacktaxTD;
							$backtaxTD->selectRecord("",$backtaxTDRecord["backtaxTDID"],"");
							$backtaxTD->calculatePenalty(date("Y-m-d"));
							$penalty = $backtaxTD->getPenalties();
							$totalDelinquent = $basicAmountDelinquent + $sefAmountDelinquent + $penalty;

							$delinquentRecordArray[] = array(
								"propertyIndexNumber" => ""
								,"taxDeclarationNumber" => $backtaxTDRecord["tdNumber"]
								,"yearDelinquent" => $backtaxTDRecord["startYear"]
								,"basicAmountDelinquent" => $basicAmountDelinquent
								,"sefAmountDelinquent" => $sefAmountDelinquent
								,"penalty" => $penalty
								,"totalDelinquent" => $totalDelinquent
							);
						}
					}
				
				}

				// find delinquent TD's
				if(is_array($recordArray["td"])){
					$tdRecord = $recordArray["td"];

					$basicAmountDelinquent = 0;
					$sefAmountDelinquent = 0;
					$penalty = 0;
					$totalDelinquent = 0;

					$sqlPaymentTD = "SELECT paymentID, ".
						"dueID, ".
						"dueType, ".
						"tdID, ".
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
							if($dbPaymentTD->f("dueType")=="Annual"){
								if($dbPaymentTD->f("amountPaid") < $dbPaymentTD->f("balanceDue")){
									$paidBasic = ($tdRecord["basicRate"]/($tdRecord["basicRate"]+$tdRecord["sefRate"])) * $dbPaymentTD->f("amountPaid");
									$paidSef = ($tdRecord["sefRate"]/($tdRecord["basicRate"]+$tdRecord["sefRate"])) * $dbPaymentTD->f("amountPaid");
									$basicAmountDelinquent = $tdRecord["basicTax"] - $paidBasic;
									$sefAmountDelinquent = $tdRecord["sefTax"] - $paidSef;

									$due = new Due;
									$due->selectRecord($tdRecord["dueID"]);
									$due = $this->computePenalty(date("Y-m-d"),$due);
									$penalty = $due->getPenalty();
									$totalDelinquent = $basicAmountDelinquent + $sefAmountDelinquent + $penalty;

									$delinquentRecordArray[] = array(
										"propertyIndexNumber" => $tdRecord["propertyIndexNumber"]
										,"taxDeclarationNumber" => $tdRecord["taxDeclarationNumber"]
										,"yearDelinquent" => date("Y",strtotime($tdRecord["dueDate"]))
										,"basicAmountDelinquent" => $basicAmountDelinquent
										,"sefAmountDelinquent" => $sefAmountDelinquent
										,"penalty" => $penalty
										,"totalDelinquent" => $totalDelinquent
									);
								}
								break;
							}
							else{
								$tmpPaidQuarterDues[] = $dbPaymentTD->f("dueID");
							}
						}

						if(is_array($tmpPaidQuarterDues)){
							// not all quarters have been paid if less than four
							if(count($tmpPaidQuarterDues) < 4){
								foreach($tmpPaidQuarterDues as $dueID){
									$sqlDueCondition .= " AND Due.dueID!='".$dueID."' ";
								}

								// grab unpaid quarterly dues that have not been paid before quarterly dueDate
								$sqlDues = "SELECT Due.dueID as dueID, ".
											"Due.dueType as dueType, ".
											"Due.tdID as tdID ".
											"FROM Due, TD, AFS ".
											"WHERE TD.afsID = AFS.afsID ".
											"AND AFS.archive != 'true' ".
											"AND TD.archive != 'true' ".
											"AND Due.dueType != 'Annual' ".
											"AND Due.tdID = '".$tdRecord["tdID"]."'".
											"AND TD.propertyType LIKE '".$this->formArray["classification"]."' ".
											"AND YEAR(Due.dueDate)  <= ".date("Y",strtotime($tdRecord["dueDate"]))." ".
											"AND Due.dueDate <= '".date("Y-m-d")."' ".
											$sqlDueCondition." ".
											"GROUP BY Due.tdID, Due.dueDate ".
											"ORDER BY Due.dueDate DESC";

								$dbDues->query($sqlDues);
								while($dbDues->next_record()){
									$due = new Due;
									$due->selectRecord($dbDues->f("dueID"));
									$basicAmountDelinquent += $due->getBasicTax();
									$sefAmountDelinquent += $due->getSefTax();
									$due = $this->computePenalty(date("Y-m-d"),$due);
									$penalty += $due->getPenalty();
								}
								$totalDelinquent = $basicAmountDelinquent + $sefAmountDelinquent + $penalty;

								$delinquentRecordArray[] = array(
									"propertyIndexNumber" => $tdRecord["propertyIndexNumber"]
									,"taxDeclarationNumber" => $tdRecord["taxDeclarationNumber"]
									,"yearDelinquent" => date("Y",strtotime($tdRecord["dueDate"]))
									,"basicAmountDelinquent" => $basicAmountDelinquent
									,"sefAmountDelinquent" => $sefAmountDelinquent
									,"penalty" => $penalty
									,"totalDelinquent" => $totalDelinquent
								);
							}

							unset($sqlDueCondition);
							unset($tmpPaidQuarterDues);
						}
					}
					else{
						$basicAmountDelinquent = $tdRecord["basicTax"];
						$sefAmountDelinquent = $tdRecord["sefTax"];

						$due = new Due;
						$due->selectRecord($tdRecord["dueID"]);
						$due = $this->computePenalty(date("Y-m-d"),$due);
						$penalty = $due->getPenalty();
						$totalDelinquent = $basicAmountDelinquent + $sefAmountDelinquent + $penalty;

						$delinquentRecordArray[] = array(
							"propertyIndexNumber" => $tdRecord["propertyIndexNumber"]
							,"taxDeclarationNumber" => $tdRecord["taxDeclarationNumber"]
							,"yearDelinquent" => date("Y",strtotime($tdRecord["dueDate"]))
							,"basicAmountDelinquent" => $basicAmountDelinquent
							,"sefAmountDelinquent" => $sefAmountDelinquent
							,"penalty" => $penalty
							,"totalDelinquent" => $totalDelinquent
						);
					}
				
				}

			}
		}

		// print page

		if(is_array($delinquentRecordArray)){
			$ypos = 615;
			$decrementYposBy = 12;
			$linesPerPage = 42;

			$count = count($delinquentRecordArray);
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
				"totalBasicAmountDelinquent" => 0
				,"totalSefAmountDelinquent" => 0
				,"totalPenalty" => 0
				,"totalTotalDelinquent" => 0
			);

			foreach($delinquentRecordArray as $recordArray){
				$this->tpl->set_var("ypos",$ypos);
				$this->tpl->set_var("recordCtr", $recordCtr);

				// write values
				$totalsArray["totalBasicAmountDelinquent"] += un_number_format($recordArray["basicAmountDelinquent"]);
				$totalsArray["totalSefAmountDelinquent"] += un_number_format($recordArray["sefAmountDelinquent"]);
				$totalsArray["totalPenalty"] += un_number_format($recordArray["penalty"]);
				$totalsArray["totalTotalDelinquent"] += un_number_format($recordArray["totalDelinquent"]);

				foreach($recordArray as $key=>$value){
					switch($key){
						case "basicAmountDelinquent":
						case "sefAmountDelinquent":
						case "penalty":
						case "totalDelinquent":
							$value = formatCurrency($value);
							break;
					}
					$this->tpl->set_var($key,$value);
				}		

				$this->tpl->parse("RowBlock", "Row", true);

				if($recordCtr==(count($delinquentRecordArray)) || $lineCtr==$linesPerPage){
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

					$ypos = 615;
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
			exit("no delinquent collectible records to display");
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
