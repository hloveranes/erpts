<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/TD.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/collection/Due.php";
include_once "../includes/collection/DueRecords.php";
include_once "../includes/collection/TreasurySettings.php";

#####################################
# Define Interface Class
#####################################
class DueEncode{
	
	var $tpl;
	var $formArray;
	
	function DueEncode($http_post_vars, $dueID, $tdID, $rptopID, $sess){
		//global $HTTP_POST_VARS;
		global $auth;

		$this->sess = $sess;
		$this->userID = $auth->auth["uid"];

		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "DueEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Due");
		$this->formArray = array(
			"dueID" => $dueID
			, "tdID" => $tdID
			, "rptopID" => $rptopID
			, "afsID" => ""
			, "dueType" => ""
			, "taxableYear" => ""
			, "dueDate" => ""
			, "basicTax" => ""
			, "basicTaxRate" => ""
			, "sefTax" => ""
			, "sefTaxRate" => ""
			, "idleTax" => ""
			, "idleTaxRate" => ""
			, "taxDeclarationNumber" => ""
			, "effectivity" => ""
			, "dateDue_str" => ""
			, "assessedValue" => ""
			, "masterBasicTaxRate" => ""
			, "masterSEFTaxRate" => ""
			, "masterIdleTaxRate" => ""
			, "taxDue" => ""
			, "formAction" => ""
		);

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function initSelected($tempVar,$compareTo,$actionStr="selected"){
		if ($this->formArray[$tempVar] == $compareTo){
			$this->tpl->set_var($tempVar."_sel", $actionStr);
		}
		else{
			$this->tpl->set_var($tempVar."_sel", "");
		}
	}

	function formatCurrency($key){
		if($this->formArray[$key]=="")
			return false;

		if(is_numeric($this->formArray[$key]))
			$this->formArray[$key] = number_format(un_number_format($this->formArray[$key]), 2, ".", ",");
	}
	
	function setForm(){
		$this->formatCurrency("assessedValue");
		$this->formatCurrency("basicTax");
		$this->formatCurrency("sefTax");
		$this->formatCurrency("idleTax");
		$this->formatCurrency("taxDue");

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function setDues(){
		$dueArray[0] = new Due;

		$this->formArray["dueType"] = "Annual";
		$dueArray[0]->setDueID($this->formArray["dueID"]);
		$dueArray[0]->setTdID($this->formArray["tdID"]);
		$dueArray[0]->setDueType($this->formArray["dueType"]);
		$dueArray[0]->setDueDate($this->formArray["dueDate"]);
		$dueArray[0]->setBasicTax(un_number_format($this->formArray["basicTax"]));
		$dueArray[0]->setBasicTaxRate($this->formArray["basicTaxRate"]);
		$dueArray[0]->setSefTax(un_number_format($this->formArray["sefTax"]));
		$dueArray[0]->setSefTaxRate($this->formArray["sefTaxRate"]);
		$dueArray[0]->setIdleTax(un_number_format($this->formArray["idleTax"]));
		$dueArray[0]->setIdleTaxRate($this->formArray["idleTaxRate"]);
		$dueArray[0]->setDomDocument();

		// set Quarter Dues

		$dueIDArray = array(
			"Annual" => ""
			,"Q1" => ""
			,"Q2" => ""
			,"Q3" => ""
			,"Q4" => "");

		$DueList = new SoapObject(NCCBIZ."DueList.php", "urn:Object");
		if (!$xmlStr = $DueList->getDueList($this->formArray["tdID"],date("Y",strtotime($this->formArray["dueDate"])))){
			// error xmlStr
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
			}
			else {
				//print_r(htmlspecialchars($xmlStr));
				//exit;

				$dueRecords = new DueRecords;
				$dueRecords->parseDomDocument($domDoc);

				foreach($dueRecords->getArrayList() as $due){
					foreach($due as $dueKey=>$dueValue){
						switch($dueKey){
							case "dueType":
								$dueIDArray[$dueValue] = $due->getDueID();
								break;
						}
					}
				}
			}
		}

		$dueArray[1] = new Due;
		$dueArray[1]->setDueID($dueIDArray["Q1"]);
		$dueArray[1]->setTdID($this->formArray["tdID"]);
		$dueArray[1]->setDueType("Q1");
		$dueArray[1]->setDueDate(date("Y",strtotime($this->formArray["dueDate"]))."-03-31"); // March 31
		$dueArray[1]->setBasicTax(roundUpNearestFiveCent(un_number_format($this->formArray["basicTax"])/4));
		$dueArray[1]->setBasicTaxRate($this->formArray["basicTaxRate"]);
		$dueArray[1]->setSefTax(roundUpNearestFiveCent(un_number_format($this->formArray["sefTax"])/4));
		$dueArray[1]->setSefTaxRate($this->formArray["sefTaxRate"]);
		$dueArray[1]->setIdleTax(roundUpNearestFiveCent(un_number_format($this->formArray["idleTax"])/4));
		$dueArray[1]->setIdleTaxRate($this->formArray["idleTaxRate"]);
		$dueArray[1]->setDomDocument();

		$dueArray[2] = new Due;
		$dueArray[2]->setDueID($dueIDArray["Q2"]);
		$dueArray[2]->setTdID($this->formArray["tdID"]);
		$dueArray[2]->setDueType("Q2");
		$dueArray[2]->setDueDate(date("Y",strtotime($this->formArray["dueDate"]))."-06-30"); // June 30
		$dueArray[2]->setBasicTax(roundUpNearestFiveCent(un_number_format($this->formArray["basicTax"])/4));
		$dueArray[2]->setBasicTaxRate($this->formArray["basicTaxRate"]);
		$dueArray[2]->setSefTax(roundUpNearestFiveCent(un_number_format($this->formArray["sefTax"])/4));
		$dueArray[2]->setSefTaxRate($this->formArray["sefTaxRate"]);
		$dueArray[2]->setIdleTax(roundUpNearestFiveCent(un_number_format($this->formArray["idleTax"])/4));
		$dueArray[2]->setIdleTaxRate($this->formArray["idleTaxRate"]);
		$dueArray[2]->setDomDocument();

		$dueArray[3] = new Due;
		$dueArray[3]->setDueID($dueIDArray["Q3"]);
		$dueArray[3]->setTdID($this->formArray["tdID"]);
		$dueArray[3]->setDueType("Q3");
		$dueArray[3]->setDueDate(date("Y",strtotime($this->formArray["dueDate"]))."-09-30"); // Sept 30
		$dueArray[3]->setBasicTax(roundUpNearestFiveCent(un_number_format($this->formArray["basicTax"])/4));
		$dueArray[3]->setBasicTaxRate($this->formArray["basicTaxRate"]);
		$dueArray[3]->setSefTax(roundUpNearestFiveCent(un_number_format($this->formArray["sefTax"])/4));
		$dueArray[3]->setSefTaxRate($this->formArray["sefTaxRate"]);
		$dueArray[3]->setIdleTax(roundUpNearestFiveCent(un_number_format($this->formArray["idleTax"])/4));
		$dueArray[3]->setIdleTaxRate($this->formArray["idleTaxRate"]);
		$dueArray[3]->setDomDocument();

		$dueArray[4] = new Due;
		$dueArray[4]->setDueID($dueIDArray["Q4"]);
		$dueArray[4]->setTdID($this->formArray["tdID"]);
		$dueArray[4]->setDueType("Q4");
		$dueArray[4]->setDueDate(date("Y",strtotime($this->formArray["dueDate"]))."-12-31"); // Dec 31
		$dueArray[4]->setBasicTax(roundUpNearestFiveCent(un_number_format($this->formArray["basicTax"])/4));
		$dueArray[4]->setBasicTax(un_number_format($this->formArray["basicTax"])-($dueArray[4]->getBasicTax())*3);
		$dueArray[4]->setSefTax(roundUpNearestFiveCent(un_number_format($this->formArray["sefTax"])/4));
		$dueArray[4]->setSefTax(un_number_format($this->formArray["sefTax"])-($dueArray[4]->getSefTax())*3);
		$dueArray[4]->setIdleTax(roundUpNearestFiveCent(un_number_format($this->formArray["idleTax"])/4));
		$dueArray[4]->setIdleTax(un_number_format($this->formArray["idleTax"])-($dueArray[4]->getIdleTax())*3);
		$dueArray[4]->setBasicTaxRate($this->formArray["basicTaxRate"]);
		$dueArray[4]->setSefTaxRate($this->formArray["sefTaxRate"]);
		$dueArray[4]->setIdleTaxRate($this->formArray["idleTaxRate"]);
		$dueArray[4]->setDomDocument();

		return $dueArray;
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "save":
				$DueEncode = new SoapObject(NCCBIZ."DueEncode.php", "urn:Object");
				if ($this->formArray["dueID"] != ""){
					$DueDetails = new SoapObject(NCCBIZ."DueDetails.php", "urn:Object");
					if (!$xmlStr = $DueDetails->getDue($this->formArray["dueID"])){
						$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$dueArray = $this->setDues();

							foreach($dueArray as $due){
								$doc = $due->getDomDocument();
								$xmlStr =  $doc->dump_mem(true);

								if (!$ret = $DueEncode->updateDue($xmlStr)){
									exit("error update");
								}
								unset($doc);
								unset($xmlStr);
							}
						}
					}
				}
				else {
					$dueArray = $this->setDues();

					foreach($dueArray as $due){
						$doc = $due->getDomDocument();
						$xmlStr =  $doc->dump_mem(true);

						if (!$ret = $DueEncode->saveDue($xmlStr)){
							exit("error saving");
						}
						unset($doc);
						unset($xmlStr);
					}
				}

				$this->formArray["dueID"] = $ret;
				header("location: DueClose.php".$this->sess->url("").$this->sess->add_query(array("rptopID"=>$this->formArray["rptopID"])));
				exit($ret);
				break;
			default:
				// grab current tax rates from TreasurySettings
				$treasurySettings = new TreasurySettings;
				$treasurySettings->selectRecord();
				
				$this->formArray["masterBasicTaxRate"] = $treasurySettings->getPctRPTax();
				$this->formArray["masterSEFTaxRate"] = $treasurySettings->getPctSEF();
				$this->formArray["masterIdleTaxRate"] = $treasurySettings->getPctIdle();
				$this->formArray["discountPeriod"] = $treasurySettings->getDiscountPeriod();
			
				$TDDetails = new SoapObject(NCCBIZ."TDDetails.php", "urn:Object");
				if (!$xmlStr = $TDDetails->getTD($this->formArray["tdID"])){
					// xml failed
				}
				else{
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						// domDoc empty
					}
					else {
						$td = new TD;
						$td->parseDomDocument($domDoc);
						$this->formArray["afsID"] = $td->getAfsID();
						$this->formArray["taxDeclarationNumber"] = $td->getTaxDeclarationNumber();
						$this->formArray["taxBeginsWithTheYear"] = $td->getTaxBeginsWithTheYear();
					}
				}
				unset($xmlStr);
				unset($domDoc);

				$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
				if (!$xmlStr = $AFSDetails->getAFS($this->formArray["afsID"])){
					// xml failed
				}
				else{
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						// domDoc empty
					}
					else {
						$afs = new AFS;
						$afs->parseDomDocument($domDoc);
						$this->formArray["assessedValue"] = $afs->getTotalAssessedValue();
						$this->formArray["taxability"] = $afs->getTaxability();
						$this->formArray["effectivity"] = $afs->getEffectivity();
						$this->formArray["propertyType"] = $td->getPropertyType();
						$this->formArray["idle"] = "No";
						if($td->getPropertyType()=="Land"){
							if(is_array($afs->landArray)){
								// if land is stripped
								if((count($afs->landArray)>1)){
									foreach($afs->landArray as $land){
										if($land->getIdle()=="Yes"){
											$this->formArray["idle"] = "Yes";
											break;
										}
									}
								}
								else{
									$this->formArray["idle"] = $afs->landArray[0]->getIdle();
								}													
							}
						}

						if($this->formArray["idle"]==""){
							$this->formArray["idle"] = "No";
						}

					}
				}			
			
				if ($this->formArray["dueID"]!=""){
					$DueDetails = new SoapObject(NCCBIZ."DueDetails.php", "urn:Object");
					if (!$xmlStr = $DueDetails->getDue($this->formArray["dueID"])){
						echo ("xml failed");
					}
					else{
						//echo $xmlStr;
						if(!$domDoc = domxml_open_mem($xmlStr)) {
							echo ("error xmlDoc");
						}
						else {
							$due = new Due;
							$due->parseDomDocument($domDoc);
							foreach($due as $key => $value){
								switch ($key){
									default:
										$this->formArray[$key] = $value;
								}
							}

							$this->formArray["dueDate_str"] = date("F d, Y",strtotime($this->formArray["dueDate"]));
							$this->formArray["taxDue"] = $due->getTaxDue();						
						}
					}
				}
				else{
					// select RPTOP taxable year from rptopID

					$RPTOPDetails = new SoapObject(NCCBIZ."RPTOPDetails.php", "urn:Object");

					if (!$xmlStr = $RPTOPDetails->getRPTOP($this->formArray["rptopID"])){
						exit("xml failed");
					}
					else{
						if(!$domDoc = domxml_open_mem($xmlStr)) {
							exit("error domDoc");
						}
						else {
							$rptop = new RPTOP;
							$rptop->parseDomDocument($domDoc);
							$this->formArray["taxableYear"] = $rptop->getTaxableYear();
						}
					}

					// display default Due details

					$this->formArray["dueDate"] = date("Y-n-d",strtotime($this->formArray["taxableYear"]."-".$treasurySettings->getAnnualDueDate()));
					$this->formArray["dueDate_str"] = date("F d, Y",strtotime($this->formArray["dueDate"]));
				
					$this->formArray["basicTaxRate"] = $this->formArray["masterBasicTaxRate"];
					$this->formArray["sefTaxRate"] = $this->formArray["masterSEFTaxRate"];
					$this->formArray["idleTaxRate"] = $this->formArray["masterIdleTaxRate"];

					$this->formArray["basicTax"] = un_number_format($this->formArray["assessedValue"]) * $this->formArray["basicTaxRate"];

					$this->formArray["sefTax"] = un_number_format($this->formArray["assessedValue"]) * $this->formArray["sefTaxRate"];

					// if land->idle is "Yes", compute idleTax, otherwise set idleTax to zero
										
					if($this->formArray["propertyType"]=="Land"){
						if($this->formArray["idle"]=="Yes"){
							$this->formArray["idleTax"] = un_number_format($this->formArray["assessedValue"]) * $this->formArray["idleTaxRate"];
						}
						else{
							$this->formArray["idleTax"] = "0.00";
						}
					}

					// if afs->taxability is "Exempt", reset computations to zero.
					if($this->formArray["taxability"]=="Exempt"){
						$this->formArray["basicTax"] = 0.00;
						$this->formArray["sefTax"] = 0.00;
						$this->formArray["idleTax"] = 0.00;
					}

					$this->formArray["taxDue"] = $this->formArray["basicTax"] + $this->formArray["sefTax"] + $this->formArray["idleTax"];
				}
		}		

		$this->setForm();
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("dueID" => $this->formArray["dueID"],"tdID" => $this->formArray["tdID"],"rptopID" => $this->formArray["rptopID"])));
		$this->tpl->parse("templatePage", "rptsTemplate");
		$this->tpl->finish("templatePage");
		$this->tpl->p("templatePage");
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
	,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/

$dueEncode = new DueEncode($HTTP_POST_VARS, $dueID, $tdID, $rptopID, $sess);
$dueEncode->Main();
?>
<?php page_close(); ?>
