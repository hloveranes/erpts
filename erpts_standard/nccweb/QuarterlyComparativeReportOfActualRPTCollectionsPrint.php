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

include_once "../includes/collection/BacktaxTD.php";

include_once "../includes/collection/Payment.php";
include_once "../includes/collection/PaymentRecords.php";
include_once "../includes/collection/Collection.php";
include_once "../includes/collection/CollectionRecords.php";
include_once "../includes/collection/Receipt.php";
include_once "../includes/collection/ReceiptRecords.php";
include_once "../includes/collection/Due.php";
include_once "../includes/collection/DueRecords.php";


#####################################
# Define Interface Class
#####################################
class QuarterlyComparativeReportOfActualRPTCollectionsPrint{
	
	var $tpl;
	var $formArray;

	function QuarterlyComparativeReportOfActualRPTCollectionsPrint($http_post_vars,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "six.xml") ;
		$this->tpl->set_var("TITLE", "Quarterly Comparative Report of the Actual Real Property Tax Collections");

       	$this->formArray = array(
			"quarter" => ""
			,"year" => ""

			,"ypos" => "615"
			,"pageNumber" => "1"
			,"totalPages" => "1"

			,"paidBasic" => "0.00"
			,"paidSEF" => "0.00"
			,"paidPenalty" => "0.00"

			,"basic" => "0.00"
			,"sef" => "0.00"
			,"penalty" => "0.00"

			,"startingYear" => ""
			,"endingYear" => ""

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
		$quarterEndingDateArray = array(
			"Q1" => "March 31"
			,"Q2" => "June 30"
			,"Q3" => "September 30"
			,"Q4" => "December 31"
		);

		$quarterBeginningDateArray = array(
			"Q1" => "January 1"
			,"Q2" => "April 1"
			,"Q3" => "July 1"
			,"Q4" => "October 1"
		);

		$this->formArray["quarterEndingDate"] = $quarterEndingDateArray[$this->formArray["quarter"]];
		$this->formArray["quarterBeginningDate"] = $quarterBeginningDateArray[$this->formArray["quarter"]];
	}

	function filterPaymentsByCurrentQuarter($year){
		$paymentEndingDate = date("Y-m-d", strtotime($this->formArray["quarterEndingDate"]." ".$year));
		$paymentBeginningDate = date("Y-m-d", strtotime($this->formArray["quarterBeginningDate"]." ".$year));

		$PaymentList = new SoapObject(NCCBIZ."PaymentList.php", "urn:Object");
		$condition = "WHERE ".PAYMENT_TABLE.".status!='cancelled' AND (".PAYMENT_TABLE.".paymentDate >= '".$paymentBeginningDate."' AND ".PAYMENT_TABLE.".paymentDate <= '".$paymentEndingDate."')";

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

	function computeIncrementValues($collection,$taxType){
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
				$this->formArray["paidBasic".$suffixKey] += $paid;
				$this->formArray["discountBasic".$suffixKey] += $discount;
				$this->formArray["paidPenalty".$suffixKey] += $penalty;

				$this->formArray["totalNetBasic".$suffixKey] += $paid + $discount + $penalty;
				$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $discount + $penalty;
				break;
			case "sef":
				$this->formArray["paidSEF".$suffixKey] += $paid;
				$this->formArray["discountSEF".$suffixKey] += $discount;
				$this->formArray["paidPenalty".$suffixKey] += $penalty;

				$this->formArray["totalNetSEF".$suffixKey] += $paid + $discount + $penalty;
				$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $discount + $penalty;
				break;
			case "idle":
				$this->formArray["paidIdle"] += $paid;
				$this->formArray["paidPenalty".$suffixKey] += $penalty;

				$this->formArray["totalIdle".$suffixKey] += $paid + $penalty;
				$this->formArray["grandTotalNetCol".$suffixKey] += $paid + $penalty;
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
								$this->computeIncrementValues($collection,"basic");
								break;
							case "sef":
								$this->computeIncrementValues($collection,"sef");
								break;
							case "idle":
								$this->computeIncrementValues($collection,"idle");
								break;
						}
					}
				}
			}
		}
	}

	function getStartingYear(){
		$sql = "SELECT * FROM ".DUE_TABLE." ORDER BY dueDate ASC LIMIT 1;";
		$db = new DB_RPTS;
		$db->query($sql);
		if($db->next_record()){
			$dueDate = $db->f("dueDate");
			$startingYear = date("Y",strtotime($dueDate));
			return $startingYear;
		}
		return false;
	}

	function getEndingYear(){
		$sql = "SELECT * FROM ".DUE_TABLE." ORDER BY dueDate DESC LIMIT 1;";
		$db = new DB_RPTS;
		$db->query($sql);
		if($db->next_record()){
			$dueDate = $db->f("dueDate");
			$endingYear = date("Y",strtotime($dueDate));
			return $endingYear;
		}
		return false;
	}

	function getCollectionTargetsForCurrentQuarter($year){
		$conditionQuarterEndingDate = date("Y-m-d", strtotime($this->formArray["quarterEndingDate"]." ".$year));
		$conditionQuarterBeginningDate = date("Y-m-d", strtotime($this->formArray["quarterBeginningDate"]." ".$year));

		$sql = "SELECT * FROM ".DUE_TABLE." WHERE dueDate >= '".$conditionQuarterBeginningDate."' AND dueDate <= '".$conditionQuarterEndingDate."';";

		$db = new DB_RPTS;
		$db->query($sql);

		$dueRecords = new DueRecords;

		$dueRecords = new DueRecords;

		while($db->next_record()){
			$due = new Due;
			$due->selectRecord($db->f("dueID"));
			$dueRecords->arrayList[] = $due;
		}

		if(is_array($dueRecords->arrayList)){
			foreach($dueRecords->arrayList as $due){
				if($due->getDueType()!="Q1"){
					$this->formArray["basic"] += $due->getBasicTax();
					$this->formArray["sef"] += $due->getSefTax();
					$this->formArray["idle"] += $due->getIdleTax();
				}
			}
		}

	}

	function Main(){
		$this->tpl->set_block("rptsTemplate","Page","PageBlock");
		$this->tpl->set_block("Page", "Row", "RowBlock");
		$this->tpl->set_var("pageNumber",1);

		$this->displayPageHeading();

		// assume starting year is based on the oldest dueDate found in Due table
		if(!$this->formArray["startingYear"] = $this->getStartingYear()){
			exit("no starting year or no dues available");
		}

		// assume ending year is based on the latest (most recent) dueDate found in Due table
		if(!$this->formArray["endingYear"] = $this->getEndingYear()){
			exit("no ending year or no dues available");
		}

		$year = $this->formArray["year"];

		$this->formArray["paidBasic"] = 0.00;
		$this->formArray["paidSEF"] = 0.00;
		$this->formArray["paidPenalty"] = 0.00;
		$this->formArray["basic"] = 0.00;
		$this->formArray["sef"] = 0.00;
		$this->formArray["penalty"] = 0.00;

		// grab actual payments
		if($this->paymentRecords = $this->filterPaymentsByCurrentQuarter($year)){
			if(is_array($this->paymentRecords->getArrayList())){
				$list = $this->paymentRecords->getArrayList();
				foreach($list as $payment){
					$this->incrementValues($payment);
				}
			}
		}

		// grab collection targets
		// duno if this is right but here goes
		$this->getCollectionTargetsForCurrentQuarter($year);

		$this->tpl->set_var("quarter",$this->formArray["quarter"]."-".$year);
		$this->tpl->set_var("ypos",$this->formArray["ypos"]);

		$this->tpl->set_var("paidBasic",$this->formArray["paidBasic"]);
		$this->tpl->set_var("paidSEF",$this->formArray["paidSEF"]);
		$this->tpl->set_var("paidPenalty",$this->formArray["paidPenalty"]);
		$this->tpl->set_var("basic",$this->formArray["basic"]);
		$this->tpl->set_var("sef",$this->formArray["sef"]);
		$this->tpl->set_var("penalty",$this->formArray["penalty"]);

		$this->tpl->parse("RowBlock", "Row", true);

		$this->formArray["ypos"] = $this->formArray["ypos"] - 10;

		if($this->formArray["ypos"]<55){
			$this->tpl->set_var("pageNumber",$this->formArray["pageNumber"]);
			$this->tpl->parse("PageBlock", "Page", true);
			$this->tpl->set_var("RowBlock","");

			$this->formArray["pageNumber"]++;
			$this->formArray["ypos"] = 615;
		}

		if($this->formArray["ypos"]==615){
			if(($this->formArray["pageNumber"]-1) >= 1){
				$this->tpl->set_var("totalPages",$this->formArray["pageNumber"]-1);
			}
			else{
				$this->tpl->set_var("pageNumber",1);
				$this->tpl->set_var("totalPages",1);
				$this->tpl->parse("PageBlock","Page",true);
				$this->tpl->set_var("RowBlock","");
			}
		}
		else if($this->formArray["ypos"] < 615 && $this->formArray["ypos"] >= 55){
			$this->tpl->set_var("pageNumber",$this->formArray["pageNumber"]);
			$this->tpl->set_var("totalPages",$this->formArray["pageNumber"]);
			$this->tpl->parse("PageBlock","Page",true);
			$this->tpl->set_var("RowBlock","");
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

$quarterlyComparativeReportOfActualRPTCollectionsPrint = new QuarterlyComparativeReportOfActualRPTCollectionsPrint($HTTP_POST_VARS,$sess);
$quarterlyComparativeReportOfActualRPTCollectionsPrint->Main();














?>
<?php page_close(); ?>