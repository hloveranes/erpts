<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "./clibPDFWriter.php";

include_once "../assessor/eRPTSSettings.php";

include_once "../assessor/TD.php";

include_once "../collection/BacktaxTD.php";

include_once "../collection/Receipt.php";
include_once "../collection/Collection.php";
include_once "../collection/Payment.php";

include_once "../collection/PaymentRecords.php";
include_once "../collection/CollectionRecords.php";
include_once "../collection/ReceiptRecords.php";

#####################################
# Define Interface Class
#####################################
class RptCollectionByOwnerPrint{
	
	var $tpl;
	var $formArray;

	function RptCollectionByOwnerPrint($sess,$ownerIDArray){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->formArray = array(
			"ownerIDArray" => $ownerIDArray

			,"pageNumber" => 1
			,"cYPos" => 616
			,"stYPos" => 586
			,"gtYPos" => 566
			,"collectionLinesPerPage" => 44

			,"lguType" => ""
			,"lguName" => ""
			,"day" => ""
			,"month" => ""
			,"year" => ""

			,"ownerName" => ""
			,"taxDeclarationNumber" => ""
			,"datePaid" => ""
			,"orNumber" => ""
			,"basicTax" => "0.00"
			,"sefTax" => "0.00"
			,"total" => "0.00"

			,"stBasicTax" => "0.00"
			,"stSefTax" => "0.00"
			,"stTotal" => "0.00"

			,"gtBasicTax" => "0.00"
			,"gtSefTax" => "0.00"
			,"gtTotal" => "0.00"
			);

		$this->tpl->set_file("rptsTemplate", "rptCollectionByOwner.xml") ;
		$this->tpl->set_var("TITLE", "Collection of Real Property By Owner's Name");

	}

	function formatCurrency($key){
		if($this->formArray[$key]!=""){
			$this->formArray[$key] = number_format($this->formArray[$key], 2, ".", ",");
		}
	}

	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, html_entity_to_alpha($value));
		}
	}

	function getLGUName(){
		$eRPTSSettings = new eRPTSSettings;
		$eRPTSSettings->selectRecord(1);

		$this->formArray["lguType"] = strtoupper($eRPTSSettings->getLguType());
		$this->formArray["lguName"] = strtoupper($eRPTSSettings->getLguName());
	}

	function displayPageHeading(){
		$this->getLGUName();

		$this->formArray["day"] = date("d");
		$this->formArray["month"] = date("F");
		$this->formArray["year"] = date("Y");

		$this->formArray["date"] = date("F d, Y");

		$this->tpl->set_var("lguType", $this->formArray["lguType"]);
		$this->tpl->set_var("lguName", $this->formArray["lguName"]);

		$this->tpl->set_var("date", $this->formArray["date"]);
	}

	function getOwnerName($ownerID){
		$db = new DB_RPTS;

		// person
		$sql = "SELECT "
			."Person.firstName as firstName "
			.",Person.middleName as middleName "
			.", Person.lastName as lastName "
			."FROM"
			." ".PERSON_TABLE
			.", ".OWNER_PERSON_TABLE
			." WHERE"
			." ".PERSON_TABLE.".personID = ".OWNER_PERSON_TABLE.".personID"
			." AND"
			." ".OWNER_PERSON_TABLE.".ownerID = ".$ownerID;

		$db->query($sql);

		while($db->next_record()){
			if($db->f("middleName")!=""){
				$middleInitial = substr($db->f("middleName"),0,1) . ".";
				$fullName = $db->f("firstName")." ".$middleInitial." ".$db->f("lastName");
			}
			else{
				$fullName = $db->f("firstName")." ".$db->f("lastName");
			}

			$ownerNamesArray[] = $fullName;
		}

		unset($db);

		$db = new DB_RPTS;

		// company
		$sql = "SELECT "
			."Company.companyName "
			."FROM"
			." ".COMPANY_TABLE
			.", ".OWNER_COMPANY_TABLE
			." WHERE"
			." ".COMPANY_TABLE.".companyID = ".OWNER_COMPANY_TABLE.".companyID"
			." AND"
			." ".OWNER_COMPANY_TABLE.".ownerID = ".$ownerID;

		$db->query($sql);

		while($db->next_record()){
			$ownerNamesArray[] = $db->f("companyName");
		}

		if(is_array($ownerNamesArray)){
			sort($ownerNamesArray);
			reset($ownerNamesArray);
			return implode(", ",$ownerNamesArray);
		}
		else{
			return false;
		}
	}

	function getSortedOwnerIDArray(){
		$i=0;
		foreach($this->formArray["ownerIDArray"] as $ownerID){
			$sortedOwnerIDArray[$this->getOwnerName($ownerID).$i] = $ownerID;
			$i++;
		}
		ksort($sortedOwnerIDArray);
		reset($sortedOwnerIDArray);
		return $sortedOwnerIDArray;
	}

	function getPaymentRecordsOwnerID($ownerID){
		$condition = " WHERE ownerID=".$ownerID." AND status!='cancelled' ORDER BY paymentDate ASC";

		$paymentRecords = new PaymentRecords;
		$paymentRecords->selectRecords($condition);

		if(is_array($paymentRecords->arrayList)){
			return $paymentRecords;
		}
		else{
			return false;
		}
	}

	function getCollectionRecordsFromPaymentID($paymentID){
		$condition = " WHERE paymentID=".$paymentID." AND status!='cancelled' AND taxType!='idle' ";

		$collectionRecords = new CollectionRecords;
		$collectionRecords->selectRecords($condition);

		if(is_array($collectionRecords->arrayList)){
			return $collectionRecords;
		}
		else{
			return false;
		}
	}

	function getTDNumberFromPayment($tdID,$backtaxTDID){
		$tdNumber = "";

		if($tdID!="" && $tdID!="0"){
			$td = new TD;
			$td->selectRecord($tdID);
			$tdNumber = $td->getTaxDeclarationNumber();
		}
		else if($backtaxTDID!="" && $backtaxTDID!="0"){
			$backtaxTD = new BacktaxTD;
			$backtaxTD->selectRecord("",$backtaxTDID);
			$tdNumber = $backtaxTD->getTdNumber();
		}

		return $tdNumber;
	}

	function getCollectionArrayList(){
		$sortedOwnerIDArray = $this->getSortedOwnerIDArray();

		foreach($sortedOwnerIDArray as $ownerID){
			$ownerName = $this->getOwnerName($ownerID);
			$paymentRecords = $this->getPaymentRecordsOwnerID($ownerID);

			if(is_array($paymentRecords->arrayList)){
				foreach($paymentRecords->arrayList as $payment){
					$paymentID = $payment->getPaymentID();

					$paymentDate = $payment->getPaymentDate();
					$taxDeclarationNumber = $this->getTDNumberFromPayment($payment->getTdID(),$payment->getBacktaxTDID());

					$collectionRecords = $this->getCollectionRecordsFromPaymentID($paymentID);

					if(is_array($collectionRecords->arrayList)){
						foreach($collectionRecords->arrayList as $collection){
							$receipt = new Receipt;
							$receiptID = $collection->getReceiptID();
							$receipt->selectRecord($receiptID);

							$receiptNumber = $receipt->getReceiptNumber();

							$basicTax = 0;
							$sefTax = 0;
							
							switch($collection->getTaxType()){
								case "basic":
									$basicTax = $collection->getAmountPaid();
									break;
								case "sef":
									$sefTax = $collection->getAmountPaid();
									break;
							}

							$total = $basicTax + $sefTax;

							$collectionRecordArray = array(
								"ownerName" => $ownerName
								,"taxDeclarationNumber" => $taxDeclarationNumber
								,"datePaid" => $paymentDate
								,"orNumber" => $receiptNumber
								,"basicTax" => $basicTax
								,"sefTax" => $sefTax
								,"total" => $total
							);

							$collectionArrayList[] = $collectionRecordArray;
						}
					}
				}
			}

		}

		if(is_array($collectionArrayList)){
			return $collectionArrayList;
		}
		else{
			return false;
		}
	}

	function Main(){
		$this->displayPageHeading();

		$this->tpl->set_block("rptsTemplate", "Page", "PageBlock");
		$this->tpl->set_block("Page", "CollectionList", "CollectionListBlock");
		$this->tpl->set_block("Page", "GrandTotal", "GrandTotalBlock");

		$collectionArrayList = $this->getCollectionArrayList();

		if(!is_array($collectionArrayList)){
			exit("no results found for the selected owner in collection list or empty database");
		}

		$lineCounter = 0;
		$continuousLineCounter = 0;
		$count = count($collectionArrayList);

		$numOfPages = ceil($count / $this->formArray["collectionLinesPerPage"]);

//		foreach($collectionArrayList as $key => $value){
//			$keyArray[] = $key;
//		}

		$tmpOwnerName = "";
		for($collectionCounter=0 ; $collectionCounter <= $count ; $collectionCounter++){
			if(($lineCounter==$this->formArray["collectionLinesPerPage"]) || ($collectionCounter==$count)){
				$this->formArray["stYPos"] = $this->formArray["cYPos"] - 30;
				$this->formArray["gtYPos"] = $this->formArray["stYPos"] - 20;

				$this->tpl->set_var("stYPos", $this->formArray["stYPos"]);
				$this->tpl->set_var("gtYPos", $this->formArray["gtYPos"]);

				$this->tpl->set_var("stBasicTax", formatCurrency($this->formArray["stBasicTax"]));
				$this->tpl->set_var("stSefTax", formatCurrency($this->formArray["stSefTax"]));
				$this->tpl->set_var("stTotal", formatCurrency($this->formArray["stTotal"]));

				if($this->formArray["pageNumber"]<$numOfPages){
					$this->tpl->set_var("GrandTotalBlock", "");
				}
				else{
					$this->tpl->set_var("gtBasicTax", formatCurrency($this->formArray["gtBasicTax"]));
					$this->tpl->set_var("gtSefTax", formatCurrency($this->formArray["gtSefTax"]));
					$this->tpl->set_var("gtTotal", formatCurrency($this->formArray["gtTotal"]));

					$this->tpl->parse("GrandTotalBlock", "GrandTotal", false);
				}

				$this->tpl->set_var("pageNumber",$this->formArray["pageNumber"]);
				$this->tpl->parse("PageBlock", "Page", true);
				$this->tpl->set_var("CollectionListBlock", "");
				$this->formArray["pageNumber"]++;
				$this->formArray["cYPos"] = 616;
				$lineCounter=0;
			}

			$collectionRecordArray = $collectionArrayList[$collectionCounter];

			if($tmpOwnerName!=$collectionRecordArray["ownerName"]){
				$ownerName = $collectionRecordArray["ownerName"];
			}
			else{
				$ownerName = "''";
			}

			if(strlen($ownerName)>22){
				$this->tpl->set_var("ownerName", substr($ownerName,0,22)."-");
				$this->tpl->set_var("ownerName2", substr($ownerName,22));
				$cYPos2 = $this->formArray["cYPos"] - 12;
			}
			else{
				$this->tpl->set_var("ownerName", $ownerName);
				$this->tpl->set_var("ownerName2", "");
				$cYPos2=0;
			}

			$tmpOwnerName = $collectionRecordArray["ownerName"];
			
			$this->tpl->set_var("taxDeclarationNumber", $collectionRecordArray["taxDeclarationNumber"]);
			$this->tpl->set_var("datePaid", $collectionRecordArray["datePaid"]);
			$this->tpl->set_var("orNumber", $collectionRecordArray["orNumber"]);
			$this->tpl->set_var("basicTax", formatCurrency($collectionRecordArray["basicTax"]));
			$this->tpl->set_var("sefTax", formatCurrency($collectionRecordArray["sefTax"]));
			$this->tpl->set_var("total", formatCurrency($collectionRecordArray["total"]));

			$this->formArray["stBasicTax"] += $collectionRecordArray["basicTax"];
			$this->formArray["stSefTax"] += $collectionRecordArray["sefTax"];
			$this->formArray["stTotal"] += $collectionRecordArray["total"];

			$this->formArray["gtBasicTax"] += $collectionRecordArray["basicTax"];
			$this->formArray["gtSefTax"] += $collectionRecordArray["sefTax"];
			$this->formArray["gtTotal"] += $collectionRecordArray["total"];

			$this->tpl->set_var("cYPos", $this->formArray["cYPos"]);
			$this->tpl->set_var("cYPos2", $cYPos2);

			$this->formArray["cYPos"] -= 12;

			if($cYPos2>0){
				$this->formArray["cYPos"] -= 12;
				$lineCounter++;
			}
			$this->tpl->set_var("i", $continuousLineCounter+1);

			$this->tpl->parse("CollectionListBlock", "CollectionList", true);
			
			$lineCounter++;
			$continuousLineCounter++;

		}

        $this->tpl->parse("templatePage", "rptsTemplate");
        $this->tpl->finish("templatePage");

//		exit;

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

//$ownerIDArray = array("10591");

$rptCollectionByOwnerPrint = new RptCollectionByOwnerPrint($sess,$ownerIDArray);
$rptCollectionByOwnerPrint->Main();

?>
<?php page_close(); ?>