<?php
include_once "../includes/web/prepend.php";
include_once "../includes/web/clibPDFWriter.php";
include_once "../includes/collection/Receipt.php";
include_once "../includes/collection/Payment.php";
include_once "../includes/collection/Collection.php";

class PrintReport{
	var $tpl;
	var $formArray;
	var $db;

	function PrintReport($http_post_vars,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "report2Asoa.xml") ;
		$this->tpl->set_var("TITLE", "Record of Real Property Tax Collection");

		$this->formArray = array(
			"year" => date("Y")
			,"sheet1" => ""
			,"lgu" => ""
			,"startDate" => ""
			,"endDate" => ""
			,"rpuClass" => ""
			,"pages" => ""
			,"ypos" => ""
			,"datePaid" => ""
			,"taxpayerName" => ""
			,"startDate" => ""
			,"orNo" => ""
			,"barangay" => ""
			,"paidBasic" => ""
			,"discountBasic" => ""
			,"priorBasic" => ""
			,"penaltyBasic" => ""
			,"priorPenaltyBasic" => ""
			,"totalGrossBasic" => ""
			,"totalNetBasic" => ""
			,"paidSEF" => ""
			,"discountSEF" => ""

			,"sheet2" => ""
			,"priorSEF" => ""
			,"penaltySEF" => ""
			,"priorPenaltySEF" => ""
			,"totalGrossSEF" => ""
			,"totalNetSEF" => ""
			,"paidIdle" => ""
			,"priorIdle" => ""
			,"penaltyIdle" => ""
			,"totalIdle" => ""
			,"specialLevy" => ""
			,"totalNonCash" => ""
			,"grandTotalGross" => ""
			,"grandTotalNet" => "");

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function setDB(){
		$db = new DB_RPTS;
		return $db;
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
		$db = $this->setDB();

		$this->formArray["lguName"]="";

		$sql = "SELECT description from ".MUNICIPALITYCITY_TABLE." ";
		$sql.= " WHERE ".MUNICIPALITYCITY_TABLE.".municipalityCityID =";
		$sql.= " '".$this->formArray["municipalityCityID"]."';";

		$db->query($sql);
		if ($db->next_record()) $this->formArray["lguName"]=$db->f("description");

		$this->formArray["startDate"] = $this->formArray["startYY"]."-".$this->formArray["startMM"]."-01";
		$this->formArray["endDate"] = $this->formArray["endYY"]."-".$this->formArray["endMM"]."-01";

		$this->tpl->set_var("lgu",$this->formArray["lguName"]);
		$this->tpl->set_var("startDate",date("M. d, Y",strtotime($this->formArray["startDate"])));
		$this->tpl->set_var("endDate",date("M. d, Y",strtotime($this->formArray["endDate"])));
	}

	function writeTDQuery($propertyTypeStr){
		$firstChar = strtolower(substr($propertyTypeStr,0,1));
		$restOfTheString = substr($propertyTypeStr,1);
		$actualUseIDVar = $firstChar.$restOfTheString."ActualUsesID";

		$sql = "select Receipt.receiptNumber as receiptNumber".
			", Receipt.receiptDate as receiptDate".
			", Receipt.receivedFrom as receivedFrom".
			", Receipt.paymentMode as paymentMode".
			", Barangay.description as barangay".
			", Payment.dueDate as dueDate".
			", Payment.dueType as dueType".
			", Collection.taxType as taxType".
			", Collection.taxDue as taxDue".
			", Collection.amountPaid as amountPaid".
			", Collection.balanceDue as balanceDue".
			", Collection.amnesty as amnesty".
			", Collection.earlyPaymentDiscount as earlyPaymentDiscount".
			", Collection.advancedPaymentDiscount as advancedPaymentDiscount".
			", Collection.amountPaid as amountPaid".
			", Collection.penalty as penalty".
			", Collection.collectionID as collectionID".
			", Receipt.receiptID as receiptID ".
			", Payment.paymentID as paymentID ".
			", TD.tdID".
			", AFS.afsID".
			", OD.odID".
			", MunicipalityCity.description as municipalityCity ".
			" FROM Collection,MunicipalityCity".
			" INNER JOIN Receipt ON Receipt.receiptID = Collection.receiptID".
			" INNER JOIN Payment ON Payment.paymentID = Collection.paymentID".
			" INNER JOIN TD ON TD.tdID = Payment.tdID".
			" INNER JOIN AFS ON AFS.afsID = TD.afsID".
			" INNER JOIN ".$propertyTypeStr." ON AFS.afsID = ".$propertyTypeStr.".afsID".
			" INNER JOIN ".$propertyTypeStr."ActualUses ON ".$propertyTypeStr.".actualUse = ".$propertyTypeStr."ActualUses.".strtolower($propertyTypeStr)."ActualUsesID".		
			" INNER JOIN OD ON OD.odID = AFS.odID".
			" INNER JOIN Location ON Location.odID = OD.odID".
			" INNER JOIN LocationAddress ON LocationAddress.locationAddressID = Location.locationAddressID".
			" INNER JOIN Barangay ON Barangay.barangayID = LocationAddress.barangayID".
			" WHERE Receipt.receiptDate between '".$this->formArray["startDate"]."' AND '".$this->formArray["endDate"]."'".
			" AND LocationAddress.municipalityCity = MunicipalityCity.municipalityCityID ".
			" AND MunicipalityCity.municipalityCityID=".$this->formArray["municipalityCityID"]." ".
			" AND ".$propertyTypeStr."ActualUses.".$actualUseIDVar." = '".$this->formArray["actualUseID"]."' ".
			" AND Receipt.status != 'cancelled' ".
			" AND Collection.status != 'cancelled' ".
			" AND Payment.status != 'cancelled' ".
			" ORDER BY Receipt.receiptID ASC ";

		return $sql;
	}

	function writeBacktaxTDQuery($propertyTypeStr){
		$firstChar = strtolower(substr($propertyTypeStr,0,1));
		$restOfTheString = substr($propertyTypeStr,1);
		$actualUseIDVar = $firstChar.$restOfTheString."ActualUsesID";

		$sql = "select Receipt.receiptNumber as receiptNumber".
			", Receipt.receiptDate as receiptDate".
			", Receipt.receivedFrom as receivedFrom".
			", Receipt.paymentMode as paymentMode".
			", Barangay.description as barangay".
			", Payment.dueDate as dueDate".
			", Payment.dueType as dueType".
			", Collection.taxType as taxType".
			", Collection.taxDue as taxDue".
			", Collection.amountPaid as amountPaid".
			", Collection.balanceDue as balanceDue".
			", Collection.amnesty as amnesty".
			", Collection.earlyPaymentDiscount as earlyPaymentDiscount".
			", Collection.advancedPaymentDiscount as advancedPaymentDiscount".
			", Collection.amountPaid as amountPaid".
			", Collection.penalty as penalty".
			", Collection.collectionID as collectionID ".
			", Receipt.receiptID as receiptID ".
			", Payment.paymentID as paymentID ".
			", BacktaxTD.backtaxTDID".
			", AFS.afsID".
			", OD.odID".
			", MunicipalityCity.description as municipalityCity ".
			" FROM Collection,MunicipalityCity".
			" INNER JOIN Receipt ON Receipt.receiptID = Collection.receiptID".
			" INNER JOIN Payment ON Payment.paymentID = Collection.paymentID".
			" INNER JOIN BacktaxTD ON BacktaxTD.backtaxTDID = Payment.backtaxTDID".
			" INNER JOIN TD ON TD.tdID = BacktaxTD.tdID".
			" INNER JOIN AFS ON AFS.afsID = TD.afsID".
			" INNER JOIN ".$propertyTypeStr." ON AFS.afsID = ".$propertyTypeStr.".afsID".
			" INNER JOIN ".$propertyTypeStr."ActualUses ON ".$propertyTypeStr.".actualUse = ".$propertyTypeStr."ActualUses.".strtolower($propertyTypeStr)."ActualUsesID".		
			" INNER JOIN OD ON OD.odID = AFS.odID".
			" INNER JOIN Location ON Location.odID = OD.odID".
			" INNER JOIN LocationAddress ON LocationAddress.locationAddressID = Location.locationAddressID".
			" INNER JOIN Barangay ON Barangay.barangayID = LocationAddress.barangayID".
			" WHERE Receipt.receiptDate between '".$this->formArray["startDate"]."' AND '".$this->formArray["endDate"]."'".
			" AND LocationAddress.municipalityCity = MunicipalityCity.municipalityCityID ".
			" AND MunicipalityCity.municipalityCityID=".$this->formArray["municipalityCityID"]." ".
			" AND ".$propertyTypeStr."ActualUses.".$actualUseIDVar." = '".$this->formArray["actualUseID"]."' ".
			" AND Receipt.status != 'cancelled' ".
			" AND Collection.status != 'cancelled' ".
			" AND Payment.status != 'cancelled' ".
			" ORDER BY Receipt.receiptID ASC ";

		return $sql;
	}

	function getTaxpayerName($ownerID){
		$db = $this->setDB();
		$ownerNameArray = array();
		$ownerNameCtr=0;

		// person

		$sqlPerson = "SELECT Person.lastName as lastName, ".
			" Person.firstName as firstName, ".
			" Person.middleName as middleName ".
			" FROM Person, OwnerPerson ".
			" WHERE Person.personID = OwnerPerson.personID ".
			" AND OwnerPerson.ownerID='".$ownerID."' ".
			" ORDER BY Person.lastName ASC ";

		$db->query($sqlPerson);
		while($db->next_record()){
			if(trim($db->f("middleName"))!="" && trim($db->f("middleName"))!=" " && trim($db->f("middleName"))!="  " && trim($db->f("middleName"))!="-" && trim($db->f("middleName"))!="."){
				$fullName = $db->f("firstName")." ".strtoupper(substr($db->f("middleName"),0,1)).". ".$db->f("lastName");
			}
			else{
				$fullName = $db->f("firstName")." ".$db->f("lastName");
			}
			$ownerNameArray[$db->f("lastName").$ownerNameCtr] = $fullName;
			$ownerNameCtr++;
		}

		// company

		$sqlCompany = "SELECT Company.companyName as companyName ".
			" FROM Company, OwnerCompany ".
			" WHERE Company.companyId = OwnerCompany.companyID ".
			" AND OwnerCompany.ownerID='".$ownerID."' ".
			" ORDER BY Company.companyName ASC ";

		$db->query($sqlCompany);
		while($db->next_record()){
			$companyName = $db->f("companyName");
			$ownerNameArray[$db->f("companyName").$ownerNameCtr] = $companyName;
			$ownerNameCtr++;
		}

		if(is_array($ownerNameArray)){
			ksort($ownerNameArray);
			reset($ownerNameArray);
			$this->formArray["taxpayerName"] = implode(",",$ownerNameArray);
		}
		else{
			$this->formArray["taxpayerName"] = "";
		}
	}

	function displayValues($collectionArray,$yearType){
		$discount = 0;
		$penalty = 0;
		$paid = 0;

		if($collectionArray["amountPaid"] > 0){
			if($collectionArray["amountPaid"] < $collectionArray["balanceDue"]){
				if($collectionArray["amnesty"]=="true"){
					$discount = $collectionArray["earlyPaymentDiscount"] + $collectionArray["advancedPaymentDiscount"];
					$penalty = 0;
					$paid = $collectionArray["amountPaid"];
				}
				else{
					$discount = $collectionArray["earlyPaymentDiscount"] + $collectionArray["advancedPaymentDiscount"];
					$penalty = $collectionArray["penalty"];
					$paid = $collectionArray["amountPaid"] - $collectionArray["penalty"];
					if($paid < 0){
						$penalty = $penalty + $paid;
						$paid = 0;
					}
				}
			}
			else{
				if($collectionArray["amnesty"]=="true"){
					$discount = $collectionArray["earlyPaymentDiscount"] + $collectionArray["advancedPaymentDiscount"];
					$penalty = 0;
					$paid = $collectionArray["amountPaid"];
				}
				else{
					$discount = $collectionArray["earlyPaymentDiscount"] + $collectionArray["advancedPaymentDiscount"];
					$penalty = $collectionArray["penalty"];
					$paid = $collectionArray["amountPaid"] - $collectionArray["penalty"];;
				}
			}
		}
		else{
			$paid = 0;
			$discount = 0;
			$penalty = 0;
		}

		// gross paid includes the discount value
		// net paid will deduct the discount value
		if($discount > 0){
			if($paid > 0){
				// current year column is gross paid
				// gross paid
				$paid = $paid + $discount;
			}
		}

		switch($collectionArray["taxType"]){
			case "basic":
				if($yearType=="prior"){
					$this->tpl->set_var("priorBasic",formatCurrency($paid));
					$this->tpl->set_var("priorPenaltyBasic",$penalty);

					$this->tpl->set_var("totalGrossBasic", formatCurrency($paid + $penalty));
					$this->tpl->set_var("totalNetBasic", formatCurrency($paid + $penalty));

					$this->formArray["grandTotalGross"] += $paid + $penalty;
					$this->formArray["grandTotalNet"] += $paid + $penalty;
				}
				// yearType = 'current'
				else{
					$this->tpl->set_var("paidBasic", formatCurrency($paid));
					$this->tpl->set_var("discountBasic", formatCurrency($discount));

					$this->tpl->set_var("penaltyBasic", formatCurrency($penalty));

					$this->tpl->set_var("totalGrossBasic", formatCurrency($paid + $penalty));
					$this->tpl->set_var("totalNetBasic", formatCurrency(($paid + $penalty)-$discount));

					$this->formArray["grandTotalGross"] += $paid + $penalty;
					$this->formArray["grandTotalNet"] += ($paid + $penalty) - $discount;
				}
				break;
			case "sef":
				if($yearType=="prior"){
					$this->tpl->set_var("priorSEF",formatCurrency($paid));
					$this->tpl->set_var("priorPenaltySEF",$penalty);

					$this->tpl->set_var("totalGrossSEF", formatCurrency($paid + $penalty));
					$this->tpl->set_var("totalNetSEF", formatCurrency($paid + $penalty));

					$this->formArray["grandTotalGross"] += $paid + $penalty;
					$this->formArray["grandTotalNet"] += $paid + $penalty;
				}
				// yearType = 'current'
				else{
					$this->tpl->set_var("paidSEF", formatCurrency($paid));
					$this->tpl->set_var("discountSEF", formatCurrency($discount));

					$this->tpl->set_var("penaltySEF", formatCurrency($penalty));

					$this->tpl->set_var("totalGrossSEF", formatCurrency($paid + $penalty));
					$this->tpl->set_var("totalNetSEF", formatCurrency(($paid + $penalty)-$discount));

					$this->formArray["grandTotalGross"] += $paid + $penalty;
					$this->formArray["grandTotalNet"] += ($paid + $penalty) - $discount;
				}
				break;
			case "idle":
				if($yearType=="prior"){
					$this->tpl->set_var("priorIdle", formatCurrency($paid));
					$this->tpl->set_var("penaltyIdle", formatCurrency($penalty));

					$this->tpl->set_var("totalIdle", formatCurrency($paid + $penalty));

					$this->formArray["grandTotalGross"] += $paid + $penalty;
					$this->formArray["grandTotalNet"] += $paid + $penalty;
				}
				// yearType = 'current'
				else{
					if($discount > 0){
						$paid = $paid - $discount;
					}
					$this->tpl->set_var("paidIdle", formatCurrency($paid));
					$this->tpl->set_var("penaltyIdle", formatCurrency($penalty));

					$this->tpl->set_var("totalIdle", formatCurrency($paid + $penalty));

					$this->formArray["grandTotalGross"] += $paid + $penalty;
					$this->formArray["grandTotalNet"] += $paid + $penalty;
				}
				break;
		}
	}

	function Main(){
		$db = $this->setDB();
		$this->displayPageHeading();

		switch($this->formArray["propertyType"]){
			case 1:
				// Land
				$propertyTypeStr = "Land";

				$firstChar = strtolower(substr($propertyTypeStr,0,1));
				$restOfTheString = substr($propertyTypeStr,1);
				$actualUseIDVar = $firstChar.$restOfTheString."ActualUsesID";

				$sqlDescription = "SELECT * FROM ".LAND_ACTUALUSES_TABLE." WHERE ".$actualUseIDVar."='".$this->formArray["actualUseID"]."';";
				break;
			case 2:
				// ImprovementsBuildings
				$propertyTypeStr = "ImprovementsBuildings";

				$firstChar = strtolower(substr($propertyTypeStr,0,1));
				$restOfTheString = substr($propertyTypeStr,1);
				$actualUseIDVar = $firstChar.$restOfTheString."ActualUsesID";

				$sqlDescription = "SELECT * FROM ".IMPROVEMENTSBUILDINGS_ACTUALUSES_TABLE." WHERE ".$actualUseIDVar."='".$this->formArray["actualUseID"]."';";
				break;
			case 3:
				// Machineries
				$propertyTypeStr = "Machineries";

				$firstChar = strtolower(substr($propertyTypeStr,0,1));
				$restOfTheString = substr($propertyTypeStr,1);
				$actualUseIDVar = $firstChar.$restOfTheString."ActualUsesID";

				$sqlDescription = "SELECT * FROM ".MACHINERIES_ACTUALUSES_TABLE." WHERE ".$actualUseIDVar."='".$this->formArray["actualUseID"]."';";
				break;
			case 4:
				// PlantsTrees
				$propertyTypeStr = "PlantsTrees";

				$firstChar = strtolower(substr($propertyTypeStr,0,1));
				$restOfTheString = substr($propertyTypeStr,1);
				$actualUseIDVar = $firstChar.$restOfTheString."ActualUsesID";

				$sqlDescription = "SELECT * FROM ".PLANTSTREES_ACTUALUSES_TABLE." WHERE ".$actualUseIDVar."='".$this->formArray["actualUseID"]."';";
				break;
			default:
				break;
		}

		$db->query($sqlDescription);
		if ($db->next_record()){
			$this->formArray["actualUse"] = $db->f("code");
			$this->formArray["rpuClassDesc"] = $db->f("description");
			$this->formArray["rpuClass"] = $this->formArray["actualUse"];
		}

		$sqlTD = $this->writeTDQuery($propertyTypeStr);
		$sqlBacktaxTD = $this->writeBacktaxTDQuery($propertyTypeStr);

		$collectionCtr = 0;

		$db->query($sqlTD);

		$this->collectionArrayList = array();

		while($db->next_record()){
			$this->collectionArrayList[$db->f("receiptID")."-".$db->f("collectionID")."-".$collectionCtr] = $db->Record;
			$collectionCtr++;
		}

		$db->query($sqlBacktaxTD);
		while($db->next_record()){
			$this->collectionArrayList[$db->f("receiptID")."-".$db->f("collectionID")."-".$collectionCtr] = $db->Record;
			$collectionCtr++;
		}

		ksort($this->collectionArrayList);
		reset($this->collectionArrayList);

		if(is_array($this->collectionArrayList)){
			$this->tpl->set_block("rptsTemplate","PAGE","PageBlock");
			$this->tpl->set_block("PAGE","Sheet1Row","Sheet1RowBlock");
			$this->tpl->set_block("PAGE","Sheet2Row","Sheet2RowBlock");

			$sheet1RowYpos1 = 403;
			$sheet1RowYpos2a = 406;
			$sheet1RowYpos2b = 398;

			$sheet2RowYpos1 = 410;
			$sheet2RowYpos2 = 402;

			$decrementYPosBy = 18;

			$iStart = 0;
			$jStart = 0;

			$rowsPerPage = 16;

			$pages = ceil(count($this->collectionArrayList)/$rowsPerPage);
			$this->tpl->set_var("pages",$pages*2);

			$rowCtr = 0;
			$pageCtr = 0;

			$sheet1Ctr = 1;
			$sheet2Ctr = 2;

			$collectionCtr = 0;

			foreach($this->collectionArrayList as $collectionArray){
				$this->tpl->set_var("paidBasic", formatCurrency(0));
				$this->tpl->set_var("discountBasic", formatCurrency(0));
				$this->tpl->set_var("priorBasic", formatCurrency(0));
				$this->tpl->set_var("priorPenaltyBasic", formatCurrency(0));
				$this->tpl->set_var("paidBasic", formatCurrency(0));
				$this->tpl->set_var("discountBasic", formatCurrency(0));
				$this->tpl->set_var("penaltyBasic", formatCurrency(0));
				$this->tpl->set_var("totalGrossBasic", formatCurrency(0));
				$this->tpl->set_var("totalNetBasic", formatCurrency(0));

				$this->tpl->set_var("paidSEF", formatCurrency(0));
				$this->tpl->set_var("discountSEF", formatCurrency(0));
				$this->tpl->set_var("priorSEF", formatCurrency(0));
				$this->tpl->set_var("priorPenaltySEF", formatCurrency(0));
				$this->tpl->set_var("paidSEF", formatCurrency(0));
				$this->tpl->set_var("discountSEF", formatCurrency(0));
				$this->tpl->set_var("penaltySEF", formatCurrency(0));
				$this->tpl->set_var("totalGrossSEF", formatCurrency(0));
				$this->tpl->set_var("totalNetSEF", formatCurrency(0));

				$this->tpl->set_var("paidIdle", formatCurrency(0));
				$this->tpl->set_var("priorIdle", formatCurrency(0));
				$this->tpl->set_var("penaltyIdle", formatCurrency(0));
				$this->tpl->set_var("totalIdle", formatCurrency(0));

				$this->tpl->set_var("specialLevy", formatCurrency(0));

				$this->tpl->set_var("totalNonCash", formatCurrency(0));

				$this->tpl->set_var("grandTotalGross", formatCurrency(0));
				$this->tpl->set_var("grandTotalNet", formatCurrency(0));

				$this->tpl->set_var("sheet1RowYpos1", $sheet1RowYpos1);
				$this->tpl->set_var("sheet1RowYpos2a", $sheet1RowYpos2a);
				$this->tpl->set_var("sheet1RowYpos2b", $sheet1RowYpos2b);

				$this->tpl->set_var("sheet2RowYpos1", $sheet2RowYpos1);
				$this->tpl->set_var("sheet2RowYpos2", $sheet2RowYpos2);

				$this->tpl->set_var("orNo", $collectionArray["receiptNumber"]);
				$this->tpl->set_var("datePaid", date("m-d-Y",strtotime($collectionArray["receiptDate"])));
				$this->tpl->set_var("barangay", $collectionArray["barangay"]);

				$this->formArray["periodCovered"] = $collectionArray["dueType"]."-".date("Y",strtotime($collectionArray["dueDate"]));
				
				if($collectionArray["dueType"]=="Annual"){
					$this->tpl->set_var("periodCovered","");
					$this->tpl->set_var("periodCoveredLineA", $collectionArray["dueType"]);
					$this->tpl->set_var("periodCoveredLineB", date("Y",strtotime($collectionArray["dueDate"])));
				}
				else{
					$this->tpl->set_var("periodCovered",$this->formArray["periodCovered"]);
					$this->tpl->set_var("periodCoveredLineA", "");
					$this->tpl->set_var("periodCoveredLineB", "");
				}

				$this->getTaxpayerName($collectionArray["receivedFrom"]);
				if(strlen($this->formArray["taxpayerName"])<=11){
					$this->tpl->set_var("taxpayerName", $this->formArray["taxpayerName"]);
					$this->tpl->set_var("taxpayerNameLineA", "");
					$this->tpl->set_var("taxpayerNameLineB", "");
				}
				else{
					$this->tpl->set_var("taxpayerName", "");
					$this->tpl->set_var("taxpayerNameLineA", substr($this->formArray["taxpayerName"],0,12));
					$this->tpl->set_var("taxpayerNameLineB", substr($this->formArray["taxpayerName"],12));
				}

				if($collectionArray["paymentMode"]=="cash"){
					$dueDateYear = date("Y",strtotime($collectionArray["dueDate"]));
					if($dueDateYear < $this->formArray["year"]){
						$this->displayValues($collectionArray,"prior");
					}
					else{
						$this->displayValues($collectionArray,"current");
					}
				}
				else{
					$this->tpl->set_var("totalNonCash", formatCurrency($collectionArray["amountPaid"]));
					$this->formArray["grandTotalGross"] += $collectionArray["amountPaid"];
					$this->formArray["grandTotalNet"] += $collectionArray["amountPaid"];
				}

				$this->tpl->set_var("grandTotalGross", formatCurrency($this->formArray["grandTotalGross"]));
				$this->tpl->set_var("grandTotalNet", formatCurrency($this->formArray["grandTotalNet"]));

				$this->tpl->parse("Sheet1RowBlock", "Sheet1Row", true);
				$this->tpl->parse("Sheet2RowBlock", "Sheet2Row", true);

				$this->formArray["grandTotalGross"] = 0;
				$this->formArray["grandTotalNet"] = 0;

				$sheet1RowYpos1 = $sheet1RowYpos1 - $decrementYPosBy;
				$sheet1RowYpos2a = $sheet1RowYpos2a - $decrementYPosBy;
				$sheet1RowYpos2b = $sheet1RowYpos2b - $decrementYPosBy;
				$sheet2RowYpos1 = $sheet2RowYpos1 - $decrementYPosBy;
				$sheet2RowYpos2 = $sheet2RowYpos2 - $decrementYPosBy;

				if($collectionCtr==count($this->collectionArrayList)-1 || ($rowCtr==($rowsPerPage-1))){
					$this->tpl->set_var("pages", $pages*2);
					$this->tpl->set_var("sheet1", $sheet1Ctr);
					$this->tpl->set_var("sheet2", $sheet2Ctr);

					$this->tpl->parse("PageBlock", "PAGE", true);
					$this->tpl->set_var("Sheet1RowBlock", "");
					$this->tpl->set_var("Sheet2RowBlock", "");

					$rowCtr=-1;
					$pageCtr++;
					$sheet1Ctr = $sheet1Ctr + 2;
					$sheet2Ctr = $sheet2Ctr + 2;

					$sheet1RowYpos1 = 403;
					$sheet1RowYpos2a = 406;
					$sheet1RowYpos2b = 398;

					$sheet2RowYpos1 = 410;
					$sheet2RowYpos2 = 402;
				}

				$collectionCtr++;
				$rowCtr++;
			}

			$this->tpl->set_var("rpuClass", $this->formArray["rpuClass"]);
			$this->tpl->set_var("rpuClassDesc", $this->formArray["rpuClassDesc"]);

	        $this->tpl->parse("templatePage", "rptsTemplate");
	        $this->tpl->finish("templatePage");

			$testpdf = new PDFWriter;
	        $testpdf->setOutputXML($this->tpl->get("templatePage"),"test");
        	$testpdf->writePDF($name);

		}
		else{
			exit("no collections to display for this query");
		}

	}
}

$printReport = new PrintReport($HTTP_POST_VARS,$sess);
$printReport->Main();

?>