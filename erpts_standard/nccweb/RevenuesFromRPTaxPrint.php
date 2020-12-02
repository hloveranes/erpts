<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/web/clibPDFWriter.php";

include_once "../includes/assessor/Barangay.php";
include_once "../includes/assessor/BarangayRecords.php";
include_once "../includes/assessor/MunicipalityCity.php";
include_once "../includes/assessor/MunicipalityCityRecords.php";
include_once "../includes/assessor/Province.php";
include_once "../includes/assessor/ProvinceRecords.php";

include_once "../includes/assessor/OD.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/TD.php";
include_once "../includes/assessor/LocationAddress.php";

include_once "../includes/assessor/LandActualUses.php";
include_once "../includes/assessor/PlantsTreesActualUses.php";
include_once "../includes/assessor/ImprovementsBuildingsActualUses.php";
include_once "../includes/assessor/MachineriesActualUses.php";

include_once "../includes/assessor/eRPTSSettings.php";

include_once "../includes/collection/BacktaxTD.php";

include_once "../includes/collection/Payment.php";
include_once "../includes/collection/PaymentRecords.php";
include_once "../includes/collection/Collection.php";
include_once "../includes/collection/CollectionRecords.php";
include_once "../includes/collection/Receipt.php";
include_once "../includes/collection/ReceiptRecords.php";

#####################################
# Define Interface Class
#####################################
class RevenuesFromRPTaxPrint{
	
	var $tpl;
	var $formArray;

	function RevenuesFromRPTaxPrint($http_post_vars,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "eight.xml") ;
		$this->tpl->set_var("TITLE", "Revenues From Real Property Tax");

       	$this->formArray = array(
			"month" => ""
			,"year" => ""

			,"yposLine" => "460"

			,"pageNumber" => "1"
			,"totalPages" => ""

			,"collectionDate" => ""
			,"paidBasic" => ""
			,"priorBasic" => ""
			,"penaltyBasic" => ""
			,"discountBasic" => ""
			,"paidSEF" => ""
			,"priorSEF" => ""
			,"penaltySEF" => ""
			,"discountSEF" => ""
		);

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function formatCurrency($key){
		if($this->formArray[$key]!=""){
			$this->formArray[$key] = number_format($this->formArray[$key], 2, ".", ",");
		}
	}

	function setvar($key,$value,$formatCurrency=false){
		$this->formArray[$key] = $value;
		if($formatCurrency){
			$value = formatCurrency($value);
		}
		$this->tpl->set_var($key,html_entity_to_alpha($value));
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, html_entity_to_alpha($value));
		}
	}

	function displayPageHeading(){
		$eRPTSSettings = new eRPTSSettings;
		if($eRPTSSettings->selectRecord(1)){
			$this->tpl->set_var("lguType",strtoupper($eRPTSSettings->getLguType()));
			$this->tpl->set_var("lguName",strtoupper($eRPTSSettings->getLguName()));
		}

		$this->tpl->set_var("monthYearString", date("F - Y",strtotime($this->formArray["year"]."-".$this->formArray["month"]."-01")));
	}

	function filterPaymentsByDate($year,$month,$day){
		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php", "urn:Object");
		$condition = "WHERE ".PAYMENT_TABLE.".status!='cancelled' ";
		$condition.= "AND (".PAYMENT_TABLE.".paymentDate LIKE '".$year."-".$month."-".$day."') ";
		$condition.= "ORDER BY ".PAYMENT_TABLE.".paymentDate";

		if(!$xmlStr = $PaymentList->getPaymentList($condition)){
			return false;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return false;
			}
			else{
				$paymentRecords = new PaymentRecords;
				$paymentRecords->parseDomDocument($domDoc);
				return $paymentRecords;
			}
		}
	}

	function getDayArrayFromMonthYear(){
		for($d=1 ; $d<=31 ; $d++){
			if($d < 10){
				$dayArray[] = "0".$d;
			}
			else{
				$dayArray[] = $d;
			}
			switch($this->formArray["month"]){
				case "02":
					if(($this->formArray["year"] % 4)==0){
						if($d==29) return $dayArray;	
					}
					else{
						if($d==28) return $dayArray;
					}
					break;
				case "04":
				case "06":
				case "09":
				case "11":
					if($d==30) return $dayArray;
				case "01":
				case "03":
				case "05":
				case "07":
				case "08":
				case "10":
				case "12":
				default:
					if($d==31) return $dayArray;
			}
		}
		return false;
	}

	function computeIncrementValues($collection,$yearType,$taxType){
		$discount = 0;
		$penalty = 0;
		$paid = 0;

		if($collection->getAmountPaid() > 0){
			if($collection->getAmountPaid() < $collection->getBalanceDue()){
				if($collection->getAmnesty()=="true"){
					$discount = $collection->getEarlyPaymentDiscount() + $collection->getAdvancedPaymentDiscount();
					$penalty = 0;
					$paid = $collection->getAmountPaid();
				}
				else{
					$discount = $collection->getEarlyPaymentDiscount() + $collection->getAdvancedPaymentDiscount();
					$penalty = $collection->getPenalty();
					$paid = $collection->getAmountPaid() - $collection->getPenalty();
					if($paid < 0){
						$penalty = $penalty + $paid;
						$paid = 0;
					}
				}
			}
			else{
				if($collection->getAmnesty()=="true"){
					$discount = $collection->getEarlyPaymentDiscount() + $collection->getAdvancedPaymentDiscount();
					$penalty = 0;
					$paid = $collection->getAmountPaid();
				}
				else{
					$discount = $collection->getEarlyPaymentDiscount() + $collection->getAdvancedPaymentDiscount();
					$penalty = $collection->getPenalty();
					$paid = $collection->getAmountPaid() - $collection->getPenalty();
				}
			}
		}
		else{
			$paid = 0;
			$discount = 0;
			$penalty = 0;
		}

		switch($taxType){
			case "basic":
				if($yearType=="prior"){
					$this->formArray["priorBasic".$suffixKey] += $paid;
					$this->formArray["priorPenaltyBasic".$suffixKey] += $penalty;

					// penaltyBasic combines priorPenaltyBasic value
					$this->formArray["penaltyBasic".$suffixKey] += $penalty;

					$this->formArray["totalNetBasic".$suffixKey] += $paid + $penalty;
					$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $penalty;
				}
				// yearType = 'current'
				else{
					$this->formArray["paidBasic".$suffixKey] += $paid + $discount;

					$this->formArray["discountBasic".$suffixKey] += $discount;
					$this->formArray["penaltyBasic".$suffixKey] += $penalty;

					// removed discount from computing for totalNet and grandTotalNet
					// $this->formArray["totalNetBasic".$suffixKey] += $paid + $discount + $penalty;
					// $this->formArray["grandTotalNetCol".$suffixKey] += $paid + $discount + $penalty;
					
					$this->formArray["totalNetBasic".$suffixKey] += $paid + $penalty;
					$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $penalty;
				}
				break;
			case "sef":
				if($yearType=="prior"){
					$this->formArray["priorSEF".$suffixKey] += $paid;
					$this->formArray["priorPenaltySEF".$suffixKey] += $penalty;

					// penaltySEF combines priorPenaltySEF value
					$this->formArray["penaltySEF".$suffixKey] += $penalty;

					$this->formArray["totalNetSEF".$suffixKey] += $paid + $penalty;
					$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $penalty;
				}
				// yearType = 'current'
				else{
					$this->formArray["paidSEF".$suffixKey] += $paid + $discount;
					$this->formArray["discountSEF".$suffixKey] += $discount;
					$this->formArray["penaltySEF".$suffixKey] += $penalty;

					// removed discount from computing for totalNet and grandTotalNet
					// $this->formArray["totalNetSEF".$suffixKey] += $paid + $discount + $penalty;
					// $this->formArray["grandTotalNetCol".$suffixKey] += $paid + $discount + $penalty;

					$this->formArray["totalNetSEF".$suffixKey] += $paid + $penalty;
					$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $penalty;
				}
				break;
			case "idle":
				if($yearType=="prior"){
					$this->formArray["priorIdle".$suffixKey] += $paid;
					$this->formArray["penaltyIdle".$suffixKey] += $penalty;

					$this->formArray["totalIdle".$suffixKey] += $paid + $penalty;
					$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $penalty;
				}
				// yearType = 'current'
				else{
					$this->formArray["paidIdle"] += $paid;
					$this->formArray["penaltyIdle".$suffixKey] += $penalty;

					$this->formArray["totalIdle".$suffixKey] += $paid + $penalty;
					$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $penalty;
				}
				break;
		}
	}


	function incrementValues($payment){
		$CollectionList = new SoapObject(NCCBIZ."CollectionList.php", "urn:Object");
		$condition = "WHERE ".COLLECTION_TABLE.".paymentID='".$payment->getPaymentID()."' AND ".COLLECTION_TABLE.".status!='cancelled'";

		if($xmlStr = $CollectionList->getCollectionList($condition)){
			if($domDoc = domxml_open_mem($xmlStr)){
				$collectionRecords = new CollectionRecords;
				$collectionRecords->parseDomDocument($domDoc);
				if(is_array($collectionRecords->getArrayList())){
					$list = $collectionRecords->getArrayList();

					foreach($list as $collection){
						switch($collection->getTaxType()){
							case "basic":
								$dueDateYear = date("Y",strtotime($payment->getDueDate()));
								if($dueDateYear < $this->formArray["year"]){
									$this->computeIncrementValues($collection,"prior","basic");
								}
								else{
									$this->computeIncrementValues($collection,"current","basic");
								}
								break;
							case "sef":
								$dueDateYear = date("Y",strtotime($payment->getDueDate()));
								if($dueDateYear < $this->formArray["year"]){
									$this->computeIncrementValues($collection,"prior","sef");
								}
								else{
									$this->computeIncrementValues($collection,"current","sef");
								}
								break;
							case "idle":
								$dueDateYear = date("Y",strtotime($payment->getDueDate()));
								if($dueDateYear < $this->formArray["year"]){
									$this->computeIncrementValues($collection,"prior","idle");
								}
								else{
									$this->computeIncrementValues($collection,"current","idle");
								}
							break;
						}
					}
				}
			}
		}
	}


	function Main(){
		$this->displayPageHeading();

		$this->tpl->set_block("rptsTemplate","Page","PageBlock");
		$this->tpl->set_var("pageNumber",1);

		$this->tpl->set_block("Page","Row","RowBlock");
		$this->tpl->set_block("Page", "Totals", "TotalsBlock");

		$this->formArray["dayArray"] = $this->getDayArrayFromMonthYear();

		$totalsArray = array(
			"totalPaidBasic" => 0
			,"totalPriorBasic" => 0
			,"totalPenaltyBasic" => 0
			,"totalDiscountBasic" => 0
			,"totalPaidSEF" => 0
			,"totalPriorSEF" => 0
			,"totalPenaltySEF" => 0
			,"totalDiscountSEF" => 0
		);

		if(is_array($this->formArray["dayArray"])){
			foreach($this->formArray["dayArray"] as $day){
				if($this->paymentRecords = $this->filterPaymentsByDate($this->formArray["year"],$this->formArray["month"],$day)){
					if(is_array($this->paymentRecords->getArrayList())){
						$list = $this->paymentRecords->getArrayList();
						$list2 = $list;
						$merged = array_merge($list,$list2);

						$this->formArray["paidBasic"] = 0.00;
						$this->formArray["priorBasic"] = 0.00;
						$this->formArray["penaltyBasic"] = 0.00;
						$this->formArray["discountBasic"] = 0.00;
						$this->formArray["paidSEF"] = 0.00;
						$this->formArray["priorSEF"] = 0.00;
						$this->formArray["penaltySEF"] = 0.00;
						$this->formArray["discountSEF"] = 0.00;
						
						foreach($list as $payment){
							$this->incrementValues($payment);
						}

						$totalsArray["totalPaidBasic"] += un_number_format($this->formArray["paidBasic"]);
						$totalsArray["totalPriorBasic"] += un_number_format($this->formArray["priorBasic"]);
						$totalsArray["totalPenaltyBasic"] += un_number_format($this->formArray["penaltyBasic"]);
						$totalsArray["totalDiscountBasic"] += un_number_format($this->formArray["discountBasic"]);
						$totalsArray["totalPaidSEF"] += un_number_format($this->formArray["paidSEF"]);
						$totalsArray["totalPriorSEF"] += un_number_format($this->formArray["priorSEF"]);
						$totalsArray["totalPenaltySEF"] += un_number_format($this->formArray["penaltySEF"]);
						$totalsArray["totalDiscountSEF"] += un_number_format($this->formArray["discountSEF"]);

						$this->tpl->set_var("collectionDate", date("M d, Y",strtotime($this->formArray["year"]."-".$this->formArray["month"]."-".$day)));
						$this->tpl->set_var("paidBasic", formatCurrency($this->formArray["paidBasic"]));
						$this->tpl->set_var("priorBasic", formatCurrency($this->formArray["priorBasic"]));
						$this->tpl->set_var("penaltyBasic", formatCurrency($this->formArray["penaltyBasic"]));
						$this->tpl->set_var("discountBasic", formatCurrency($this->formArray["discountBasic"]));
						$this->tpl->set_var("paidSEF", formatCurrency($this->formArray["paidSEF"]));
						$this->tpl->set_var("priorSEF", formatCurrency($this->formArray["priorSEF"]));
						$this->tpl->set_var("penaltySEF", formatCurrency($this->formArray["penaltySEF"]));
						$this->tpl->set_var("discountSEF", formatCurrency($this->formArray["discountSEF"]));
						$this->tpl->set_var("yposLine",$this->formArray["yposLine"]);

						$this->tpl->parse("RowBlock","Row",true);
						$this->formArray["yposLine"] = $this->formArray["yposLine"] - 10;

						if($this->formArray["yposLine"]<70){
							// new page
							$this->tpl->set_var("TotalsBlock", "");

							$this->tpl->set_var("pageNumber",$this->formArray["pageNumber"]);
							$this->tpl->parse("PageBlock","Page",true);
							$this->tpl->set_var("RowBlock","");
							$this->tpl->set_var("TotalsBlock", "");

							$this->formArray["yposLine"] = 460;
							$this->formArray["pageNumber"]++;
						}
					}
				}
			}
		}

		$this->tpl->set_var("totalPages",$this->formArray["pageNumber"]);

		// last page

		// print totals:
		foreach($totalsArray as $key=>$value){
			$value = formatCurrency($value);
			$this->tpl->set_var($key,$value);
		}		
		$this->tpl->parse("TotalsBlock", "Totals", true);

		if($this->formArray["yposLine"]==460){
			if(($this->formArray["pageNumber"]-1) >= 1){
				$this->tpl->set_var("totalPages",$this->formArray["pageNumber"]-1);
			}
			else{
				$this->tpl->set_var("pageNumber",1);
				$this->tpl->set_var("totalPages",1);
				$this->tpl->parse("PageBlock","Page",true);
				$this->tpl->set_var("RowBlock","");
				$this->tpl->set_var("TotalsBlock", "");
			}
		}
		else if($this->formArray["yposLine"] < 460 && $this->formArray["yposLine"] >= 70){
			$this->tpl->set_var("pageNumber",$this->formArray["pageNumber"]);
			$this->tpl->parse("PageBlock","Page",true);
			$this->tpl->set_var("RowBlock","");
			$this->tpl->set_var("TotalsBlock", "");
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

#####################################
# Define Procedures and Functions
#####################################

##########################################################
# Begin Program Script
##########################################################
//*
page_open(array("sess" => "rpts_Session"
	//,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/

$revenuesFromRPTaxPrint = new RevenuesFromRPTaxPrint($HTTP_POST_VARS,$sess);
$revenuesFromRPTaxPrint->Main();
?>
<?php page_close(); ?>