<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";

include_once "../collection/BacktaxTD.php";
include_once "../collection/BacktaxTDRecords.php";

#####################################
# Define Interface Class
#####################################
class BacktaxesTDEncode{
	
	var $tpl;
	var $formArray;
	var $td;
	
	function BacktaxesTDEncode($http_post_vars, $backtaxTDID, $tdID="", $afsID="", $formAction="",$sess){
		//global $HTTP_POST_VARS;
		global $auth;

		$this->sess = $sess;
		$this->userID = $auth->auth["uid"];

		$this->tpl = new rpts_Template(getcwd(),"keep");
		if ($backtaxTDID <> ""){
			$this->tpl->set_file("rptsTemplate", "BacktaxesEncode.htm");
		}
		else{
			$this->tpl->set_file("rptsTemplate", "BacktaxesEncode2.htm");
		}
		$this->tpl->set_var("TITLE", "Encode Backtaxes");

		$this->formArray = array(
			"backtaxTDID" => $backtaxTDID
			, "tdID" => $tdID
			, "tdNumber" => ""
			, "startYear" => ""
			, "endYear" => ""
			, "startQuarter" => ""
			, "assessedValue" => ""
			, "basicRate" => ""
			, "sefRate" => ""
			, "basicTax" => ""
			, "sefTax" => ""
			, "idleTax" => ""
			, "penalties" => ""
			, "paid" => ""
			, "balance" => ""
			, "paidStatus" => ""
			, "total" => ""
			, "formAction" => $formAction
		);

		$this->formArray["afsID"] = $afsID;

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
	
	function setForm(){
		$startQuarter = 1;
		$endQuarter = 4;
		$this->tpl->set_block("rptsTemplate", "StartQuarterList", "StartQuarterListBlock");
		for($i = $startQuarter; $i<=$endQuarter; $i++){
			$this->formArray["startQuarterValue"] = $this->formArray["startQuarter"];
			$this->tpl->set_var("startQuarterValue", $i);
			$this->initSelected("startQuarterValue",$i);
			$this->tpl->parse("StartQuarterListBlock", "StartQuarterList", true);
		}
		$startYear = date("Y")-1;
		$endYear = 1950;
		for($i = $startYear; $i>=$endYear; $i--){
			$yearList[] = $i;
		}
		$backtaxTDYearlist = $this->getBacktaxTDYearList();
		$yearList = array_diff($yearList,$backtaxTDYearlist);
		if ($this->formArray["startYear"]<>"") $yearList[] = $this->formArray["startYear"];
		rsort($yearList);
		//print_r($yearList);
		$this->tpl->set_block("rptsTemplate", "StartYearList", "StartYearListBlock");
		foreach($yearList as $key => $value){
			$this->formArray["startYearValue"] = $this->formArray["startYear"];
			$this->tpl->set_var("startYearValue", $value);
			$this->initSelected("startYearValue",$value);
			$this->tpl->parse("StartYearListBlock", "StartYearList", true);
		}
		if ($this->formArray["backtaxTDID"] == ""){
			$startYear = date("Y")-1;
			$endYear = 1950;
			$this->tpl->set_block("rptsTemplate", "EndYearList", "EndYearListBlock");
			for($i = $startYear; $i>=$endYear; $i--){
				$this->formArray["endYearValue"] = $this->formArray["endYear"];
				$this->tpl->set_var("endYearValue", $i);
				$this->initSelected("endYearValue",$i);
				$this->tpl->parse("EndYearListBlock", "EndYearList", true);
			}
		}
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function getBacktaxTDYearList(){
		$arr = array();
		$BacktaxTDDetails = new SoapObject(NCCBIZ."BacktaxTDDetails.php", "urn:Object");
		if (!$xmlStr = $BacktaxTDDetails->getBacktaxTDList($this->formArray["tdID"])){
			
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				
			}
			else {
				$backtaxTDRecords = new BacktaxTDRecords;
				$backtaxTDRecords->parseDomDocument($domDoc);

				$backTaxTDList = $backtaxTDRecords->getArrayList();
				if(count($backTaxTDList)){
					foreach ($backTaxTDList as $key => $val){
						$arr[] = $val->getStartYear();
					}
				}
				else{
				}
			}
		}
		return $arr;
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "save":
				$BacktaxTDEncode = new SoapObject(NCCBIZ."BacktaxTDEncode.php", "urn:Object");
				if ($this->formArray["backtaxTDID"] <> ""){
					$BacktaxTDDetails = new SoapObject(NCCBIZ."BacktaxTDDetails.php", "urn:Object");
					if (!$xmlStr = $BacktaxTDDetails->getBacktaxTD2($this->formArray["backtaxTDID"])){
						$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$backtaxTD = new BacktaxTD;
							$backtaxTD->parseDomDocument($domDoc);
							$backtaxTD->setBacktaxTDID($this->formArray["backtaxTDID"]);
							$backtaxTD->setTDID($this->formArray["tdID"]);
							$backtaxTD->setTdNumber($this->formArray["tdNumber"]);
							$backtaxTD->setStartYear($this->formArray["startYear"]);
							$backtaxTD->setEndYear($this->formArray["startYear"]);
							$backtaxTD->setStartQuarter($this->formArray["startQuarter"]);
							$backtaxTD->setAssessedValue($this->formArray["assessedValue"]);
							$backtaxTD->setBasicRate($this->formArray["basicRate"]);
							$backtaxTD->setSefRate($this->formArray["sefRate"]);
							$backtaxTD->setBasicTax($this->formArray["basicTax"]);
							$backtaxTD->setSefTax($this->formArray["sefTax"]);
							$backtaxTD->setIdleTax($this->formArray["idleTax"]);
							$backtaxTD->setPenalties($this->formArray["penalties"]);
							$backtaxTD->setPaid($this->formArray["paid"]);
							$backtaxTD->setBalance($this->formArray["balance"]);
							$backtaxTD->setModifiedBy($this->userID);
							//$backtaxTD->setPaidStatus($this->formArray["paidStatus"]);
							//$backtaxTD->setTotal($this->formArray["total"]);

							$backtaxTD->setDomDocument();

							$doc = $backtaxTD->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);


							if (!$ret = $BacktaxTDEncode->updateBacktaxTD($xmlStr)){
								exit("error update");
							}

						}
					}
				}
				else {
					$startYear = $this->formArray["startYear"];
					//print_r($startYear);
					//exit;
					///*
					$endYear = $this->formArray["endYear"];
					//echo($startYear."->".$endYear);
					sort($startYear,SORT_NUMERIC);
					//print_r($startYear);
					//exit;
					foreach ($startYear as $key => $value){
					//for ($i = $startYear; $i<=$endYear; $i++){
						//echo $i."<br>";
						///*
						$backtaxTD = new BacktaxTD;
						$backtaxTD ->selectRecord($this->formArray["backtaxTDID"]);
						//$backtaxTD->parseDomDocument($domDoc);

						$backtaxTD->setBacktaxTDID($this->formArray["backtaxTDID"]);
						$backtaxTD->setTDID($this->formArray["tdID"]);
						$backtaxTD->setTdNumber($this->formArray["tdNumber"]);
						$backtaxTD->setStartYear($value);
						$backtaxTD->setEndYear($value);
						$quarter = ($key == 0)?$this->formArray["startQuarter"]:1;
						$backtaxTD->setStartQuarter($quarter);
						$backtaxTD->setAssessedValue($this->formArray["assessedValue"]);
						$backtaxTD->setBasicRate($this->formArray["basicRate"]);
						$backtaxTD->setSefRate($this->formArray["sefRate"]);
						$backtaxTD->setBasicTax($this->formArray["basicTax"]);
						$backtaxTD->setSefTax($this->formArray["sefTax"]);
						$backtaxTD->setIdleTax($this->formArray["idleTax"]);
						$backtaxTD->setPenalties($this->formArray["penalties"]);
						$paid = ($key == 0)?$this->formArray["paid"]:0;
						$backtaxTD->setPaid($paid);
						$backtaxTD->setBalance($backtaxTD->getTotalTaxDue());
						$backtaxTD->setCreatedBy($this->userID);
						//$backtaxTD->setPaidStatus($this->formArray["paidStatus"]);
						//$backtaxTD->setTotal($this->formArray["total"]);
	
						$backtaxTD->setDomDocument();
						$doc = $backtaxTD->getDomDocument();
	
						$xmlStr =  $doc->dump_mem(true);
						//echo $i." - ".$xmlStr."<br>";
						if (!$ret = $BacktaxTDEncode->saveBacktaxTD($xmlStr)){
							echo("Error saving");
						}
						
					}//*/
				}
				//exit;
				$this->formArray["backtaxTDID"] = $ret;

				header("location: BacktaxTDClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));

				exit($ret);
				break;
			default:
				if ($this->formArray["backtaxTDID"]){
					$BacktaxTDDetails = new SoapObject(NCCBIZ."BacktaxTDDetails.php", "urn:Object");
					if (!$xmlStr = $BacktaxTDDetails->getBacktaxTD2($this->formArray["backtaxTDID"])){
						echo ("xml failed");
					}
					else{
						//echo $xmlStr;
						if(!$domDoc = domxml_open_mem($xmlStr)) {
							//
						}
						else {
							$backtaxTD = new BacktaxTD;
							$backtaxTD->parseDomDocument($domDoc);
							foreach($backtaxTD as $key => $value){
								switch ($key){
									default:
										$this->formArray[$key] = $value;
								}
							}
						}
					}
				}
		}
		$this->setForm();
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("tdID" => $this->formArray["tdID"],"afsID" => $this->formArray["afsID"])));
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
$backtaxesTDEncode = new BacktaxesTDEncode($HTTP_POST_VARS,$backtaxTDID,$tdID,$afsID,$formAction,$sess);
$backtaxesTDEncode->Main();
?>
<?php page_close(); ?>
