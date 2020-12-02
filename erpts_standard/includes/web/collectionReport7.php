<?php
include_once "./prepend.php";
require_once('collection/Receipt.php');
require_once('collection/Collection.php');
require_once('collection/Payment.php');
require_once('collection/Due.php');

include_once "../assessor/eRPTSSettings.php";

include('web/clibPDFWriter.php');

class CollectionReport{

	var $tpl;
	var $formArray;

	function CollectionReport($sess,$http_post_vars){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		#$this->tpl->set_file("rptsTemplate", "collectionReport1.htm") ;
		$this->tpl->set_file("rptsTemplate", "seven.xml") ;

		$this->formArray["year"] = "";

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function Main(){
		$eRPTSSettings = new eRPTSSettings;
		if($eRPTSSettings->selectRecord(1)){
			$this->tpl->set_var("lguType",strtoupper($eRPTSSettings->getLguType()));
			$this->tpl->set_var("lguName",strtoupper($eRPTSSettings->getLguName()));
		}		

		$dbPayment = new DB_RPTS;
		$dbTD = new DB_RPTS;
		$dbBacktaxTD = new DB_RPTS;
		$dbDue = new DB_RPTS;
		$dbPaymentTD = new DB_RPTS;
		$dbPaymentBacktaxTD = new DB_RPTS;
		$dbCollection = new DB_RPTS;

		// gather unique TD's and BacktaxTD's from Payments for year
		$sqlPayment = "SELECT paymentID, ".
			"tdID, ".
			"backtaxTDID ".
			"FROM Payment ".
			"WHERE status!='cancelled' ".
			"AND YEAR(paymentDate) LIKE '".$this->formArray["year"]."' ".
			"GROUP BY tdID, backtaxTDID ".
			"ORDER BY paymentID DESC ";

		$dbPayment->query($sqlPayment);
		if($dbPayment->nf()>0){
			while($dbPayment->next_record()){
				$year = "";
				$pageRecord = array(
					"propertyIndexNumber" => ""
					,"tdNumber" => ""
					,"paidBasic" => 0
					,"paidSef" => 0
					,"discount" => 0
					,"basicSef" => 0
					,"yearDel" => ""
					,"basicDel" => 0
					,"sefDel" => 0
					,"penalty" => 0
					,"totalDel" => 0
					,"totalAmount" => 0);

				if($dbPayment->f("backtaxTDID")!=0){
					// ------- start of BacktaxTD condition ------------------------- //

					// gather BacktaxTD details
					$sqlBacktaxTD = "SELECT tdNumber as tdNumber, ".
						"startYear as year ".
						"FROM BacktaxTD ".
						"WHERE ".
						"backtaxTDID = '".$dbPayment->f("backtaxTDID")."' ";

					$dbBacktaxTD->query($sqlBacktaxTD);
					if($dbBacktaxTD->next_record()){
						$pageRecord["tdNumber"] = $dbBacktaxTD->f("tdNumber");
						$year = $dbBacktaxTD->f("year");
					}

					// gather Payments for BacktaxTD for this year
					$sqlPaymentBacktaxTD = "SELECT * ".
						"FROM Payment WHERE ".
						"backtaxTDID='".$dbPayment->f("backtaxTDID")."' ".
						"AND YEAR(paymentDate) LIKE '".$this->formArray["year"]."' ".
						"AND status!='cancelled' ".
						"ORDER BY paymentID DESC ";

					$dbPaymentBacktaxTD->query($sqlPaymentBacktaxTD);

					if($dbPaymentBacktaxTD->nf()>0){
						while($dbPaymentBacktaxTD->next_record()){
							// gather Collections for Payment 
							$sqlCollection = "SELECT * ".
								"FROM Collection ".
								"WHERE paymentID='".$dbPaymentBacktaxTD->f("paymentID")."' ".
								"AND Collection.status!='cancelled' ".
								"ORDER BY collectionID DESC ";

							$dbCollection->query($sqlCollection);

							if($dbCollection->nf()>0){
								while($dbCollection->next_record()){
									switch($dbCollection->f("taxType")){
										case "basic":
											// paidBasic
											$paidBasic = 0;
											if($dbCollection->f("amnesty")!="true"){
												$paidBasic = $dbCollection->f("amountPaid") - $dbCollection->f("penalty");

												// penalty, basicDel and totalDel
												if($dbCollection->f("penalty")>0){
													$pageRecord["yearDel"] = $year;

													// basicDel
													$basicDel = 0;
													$basicDel = $dbCollection->f("taxDue");

													// penalty
													$penalty = 0;
													$penalty = $dbCollection->f("penalty");

													// totalDel
													$totalDel = $basicDel + $penalty;

													$pageRecord["basicDel"] += $basicDel;
													$pageRecord["penalty"] += $penalty;
													$pageRecord["totalDel"] += $totalDel;

													// totalAmount
													$pageRecord["totalAmount"] += $penalty;
												}
												
											}
											$paidBasic = $paidBasic + ($dbCollection->f("earlyPaymentDiscount") + $dbCollection->f("advancedPaymentDiscount"));

											// discount
											$discount = $dbCollection->f("earlyPaymentDiscount") + $dbCollection->f("advancedPaymentDiscount");

											// basicSef
											$basicSef = $paidBasic - $discount;

											$pageRecord["paidBasic"] += $paidBasic;
											$pageRecord["discount"] += $discount;
											$pageRecord["basicSef"] += $basicSef;

											// totalAmount
											$pageRecord["totalAmount"] += $basicSef;
											break;
										case "sef":
											// paidSef
											$paidSef = 0;
											if($dbCollection->f("amnesty")!="true"){
												$paidSef = $dbCollection->f("amountPaid") - $dbCollection->f("penalty");

												// penalty, sefDel and totalDel
												if($dbCollection->f("penalty")>0){
													$pageRecord["yearDel"] = $year;

													// sefDel
													$sefDel = 0;
													$sefDel = $dbCollection->f("taxDue");

													// penalty
													$penalty = 0;
													$penalty = $dbCollection->f("penalty");

													// totalDel
													$totalDel = $sefDel + $penalty;

													$pageRecord["sefDel"] += $sefDel;
													$pageRecord["penalty"] += $penalty;
													$pageRecord["totalDel"] += $totalDel;

													// totalAmount
													$pageRecord["totalAmount"] += $penalty;
												}
											}
											$paidSef = $paidSef + ($dbCollection->f("earlyPaymentDiscount") + $dbCollection->f("advancedPaymentDiscount"));

											// discount
											$discount = $dbCollection->f("earlyPaymentDiscount") + $dbCollection->f("advancedPaymentDiscount");

											// basicSef
											$basicSef = $paidSef - $discount;

											$pageRecord["paidSef"] += $paidSef;
											$pageRecord["discount"] += $discount;
											$pageRecord["basicSef"] += $basicSef;

											// totalAmount
											$pageRecord["totalAmount"] += $basicSef;
											break;
									}
								}
							}


						}
					}

					// ------- start of BacktaxTD condition ------------------------- //
				}
				else if($dbPayment->f("tdID")!=0){
					// ------- start of TD condition ------------------------- //

					// gather TD details
					$sqlTD = "SELECT AFS.propertyIndexNumber as propertyIndexNumber, ".
						"TD.taxDeclarationNumber as taxDeclarationNumber ".
						"FROM TD, AFS ".
						"WHERE ".
						"TD.afsID = AFS.afsID ".
						"AND TD.tdID='".$dbPayment->f("tdID")."' ".
						"AND TD.archive!='true' ".
						"AND AFS.archive!='true' ";

					$dbTD->query($sqlTD);
					if($dbTD->next_record()){
						$pageRecord["propertyIndexNumber"] = $dbTD->f("propertyIndexNumber");
						$pageRecord["tdNumber"] = $dbTD->f("taxDeclarationNumber");
					}

					// gather dueDate Year from Due
					$sqlDue = "SELECT YEAR(dueDate) as year ".
						"FROM Due ".
						"WHERE tdID='".$dbPayment->f("tdID")."' ".
						"AND dueType='Annual' ";

					$dbDue->query($sqlDue);
					if($dbDue->next_record()){
						$year = $dbDue->f("year");
					}

					// gather Payments for TD for this year
					$sqlPaymentTD = "SELECT * ".
						"FROM Payment WHERE ".
						"tdID='".$dbPayment->f("tdID")."' ".
						"AND YEAR(paymentDate) LIKE '".$this->formArray["year"]."' ".
						"AND status!='cancelled' ".
						"ORDER BY paymentID DESC ";

					$dbPaymentTD->query($sqlPaymentTD);

					if($dbPaymentTD->nf()>0){
						while($dbPaymentTD->next_record()){
							// gather Collections for Payment 
							$sqlCollection = "SELECT * ".
								"FROM Collection ".
								"WHERE paymentID='".$dbPaymentTD->f("paymentID")."' ".
								"AND Collection.status!='cancelled' ".
								"ORDER BY collectionID DESC ";

							$dbCollection->query($sqlCollection);

							if($dbCollection->nf()>0){
								while($dbCollection->next_record()){
									switch($dbCollection->f("taxType")){
										case "basic":
											// paidBasic
											$paidBasic = 0;
											if($dbCollection->f("amnesty")!="true"){
												$paidBasic = $dbCollection->f("amountPaid") - $dbCollection->f("penalty");

												// penalty, basicDel and totalDel
												if($dbCollection->f("penalty")>0){
													$pageRecord["yearDel"] = $year;

													// basicDel
													$basicDel = 0;
													$basicDel = $dbCollection->f("taxDue");

													// penalty
													$penalty = 0;
													$penalty = $dbCollection->f("penalty");

													// totalDel
													$totalDel = $basicDel + $penalty;

													$pageRecord["basicDel"] += $basicDel;
													$pageRecord["penalty"] += $penalty;
													$pageRecord["totalDel"] += $totalDel;

													// totalAmount
													$pageRecord["totalAmount"] += $penalty;
												}
												
											}
											$paidBasic = $paidBasic + ($dbCollection->f("earlyPaymentDiscount") + $dbCollection->f("advancedPaymentDiscount"));

											// discount
											$discount = $dbCollection->f("earlyPaymentDiscount") + $dbCollection->f("advancedPaymentDiscount");

											// basicSef
											$basicSef = $paidBasic - $discount;

											$pageRecord["paidBasic"] += $paidBasic;
											$pageRecord["discount"] += $discount;
											$pageRecord["basicSef"] += $basicSef;

											// totalAmount
											$pageRecord["totalAmount"] += $basicSef;
											break;
										case "sef":
											// paidSef
											$paidSef = 0;
											if($dbCollection->f("amnesty")!="true"){
												$paidSef = $dbCollection->f("amountPaid") - $dbCollection->f("penalty");

												// penalty, sefDel and totalDel
												if($dbCollection->f("penalty")>0){
													$pageRecord["yearDel"] = $year;

													// sefDel
													$sefDel = 0;
													$sefDel = $dbCollection->f("taxDue");

													// penalty
													$penalty = 0;
													$penalty = $dbCollection->f("penalty");

													// totalDel
													$totalDel = $sefDel + $penalty;

													$pageRecord["sefDel"] += $sefDel;
													$pageRecord["penalty"] += $penalty;
													$pageRecord["totalDel"] += $totalDel;

													// totalAmount
													$pageRecord["totalAmount"] += $penalty;
												}
											}
											$paidSef = $paidSef + ($dbCollection->f("earlyPaymentDiscount") + $dbCollection->f("advancedPaymentDiscount"));

											// discount
											$discount = $dbCollection->f("earlyPaymentDiscount") + $dbCollection->f("advancedPaymentDiscount");

											// basicSef
											$basicSef = $paidSef - $discount;

											$pageRecord["paidSef"] += $paidSef;
											$pageRecord["discount"] += $discount;
											$pageRecord["basicSef"] += $basicSef;

											// totalAmount
											$pageRecord["totalAmount"] += $basicSef;
											break;
									}
								}
							}


						}
					}

					// ------- end of TD condition ------------------------- //
				}

				$pageRecordArrayList[] = $pageRecord;
				unset($pageRecord);
			}

			if(is_array($pageRecordArrayList)){
				$ypos = 426;
				$decrementYposBy = 12;
				$linesPerPage = 24;

				$count = count($pageRecordArrayList);
				$numOfPages = ceil($count / $linesPerPage);
				$pageCtr = 1;
				$lineCtr = 1;
				$recordCtr = 1;

				$this->tpl->set_var("year", $this->formArray["year"]);
				$this->tpl->set_var("numOfPages", $numOfPages);

				$this->tpl->set_block("rptsTemplate", "Page", "PageBlock");
				$this->tpl->set_block("Page", "Row", "RowBlock");
				$this->tpl->set_block("Page", "Totals", "TotalsBlock");

				$totalsArray = array(
					"totalPaidBasic" => 0
					,"totalPaidSef" => 0
					,"totalDiscount" => 0
					,"totalBasicSef" => 0
					,"totalBasicDel" => 0
					,"totalSefDel" => 0
					,"totalPenalty" => 0
					,"totalTotalDel" => 0
					,"totalTotalAmount" => 0
				);

				foreach($pageRecordArrayList as $recordArray){
					$this->tpl->set_var("ypos",$ypos);
					$this->tpl->set_var("recordCtr", $recordCtr);

					// write values
					$totalsArray["totalPaidBasic"] += un_number_format($recordArray["paidBasic"]);
					$totalsArray["totalPaidSef"] += un_number_format($recordArray["paidSef"]);
					$totalsArray["totalDiscount"] += un_number_format($recordArray["discount"]);
					$totalsArray["totalBasicSef"] += un_number_format($recordArray["basicSef"]);
					$totalsArray["totalBasicDel"] += un_number_format($recordArray["basicDel"]);
					$totalsArray["totalSefDel"] += un_number_format($recordArray["sefDel"]);
					$totalsArray["totalPenalty"] += un_number_format($recordArray["penalty"]);
					$totalsArray["totalTotalDel"] += un_number_format($recordArray["totalDel"]);
					$totalsArray["totalTotalAmount"] += un_number_format($recordArray["totalAmount"]);

					foreach($recordArray as $key=>$value){
						switch($key){
							case "paidBasic":
							case "paidSef":
							case "discount":
							case "basicSef":
							case "basicDel":
							case "sefDel":
							case "penalty":
							case "totalDel":
							case "totalAmount":
								$value = formatCurrency($value);
								break;
						}
						$this->tpl->set_var($key,$value);
					}		

					$this->tpl->parse("RowBlock", "Row", true);

					if($recordCtr==(count($pageRecordArrayList)) || $lineCtr==$linesPerPage){
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

						$ypos = 426;
						$lineCtr=0;
						$pageCtr++;
					}
	
					$lineCtr++;
					$recordCtr++;
					$ypos = $ypos - $decrementYposBy;
				}

		        $this->tpl->parse("templatePage", "rptsTemplate");
		        $this->tpl->finish("templatePage");

			}
			else{
				exit("no collections to list for ".$this->formArray["year"]);
			}
		}
		else{
			exit("no collections to list for ".$this->formArray["year"]);
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
}
page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
$obj = new CollectionReport($sess,$HTTP_POST_VARS);
$obj->Main();
?>
<?php page_close(); ?>