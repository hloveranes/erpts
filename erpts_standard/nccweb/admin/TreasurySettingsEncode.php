<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/masterTables.php";
include_once "../includes/collection/TreasurySettings.php";

#####################################
# Define Interface Class
#####################################
class TreasurySettingsEncode{
	var $tpl;

	function TreasurySettingsEncode($http_post_vars,$sess,$formAction,$masterTables){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;
		$this->masterTables = $masterTables;

		// must be Super-User to access
		$pageType = "1%%%%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "TreasurySettingsEncode.htm") ;
		$this->tpl->set_var("TITLE", "Treasury Settings");

		$this->formArray = array(
			"formAction" => $formAction
			,"message" => ""
			,"cutOff" => ""
		);

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}

		if($this->formArray["discountPeriod_month"] != "" && $this->formArray["discountPeriod_month"]!=""){
			$dateStr = putPreZero($this->formArray["discountPeriod_month"])."-".putPreZero($this->formArray["discountPeriod_day"]);
			$this->formArray["discountPeriod"] = $dateStr;
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

	function setDateDropDown($type){
		eval(MONTH_ARRAY);//$monthArray
		$this->tpl->set_block("rptsTemplate", $type."MonthList", $type."MonthListBlock");
		foreach($monthArray as $key => $value){
			$this->tpl->set_var($type."monthValue", $key);
			$this->tpl->set_var($type."month", $value);
			$this->initSelected($type."month",$key);
			$this->tpl->parse($type."MonthListBlock", $type."MonthList", true);
		}
		$this->tpl->set_block("rptsTemplate", $type."DayList", $type."DayListBlock");
		for($i = 1; $i<=31; $i++){
			$this->tpl->set_var($type."dayValue", $i);
			$this->initSelected($type."day",$i);
			$this->tpl->parse($type."DayListBlock", $type."DayList", true);
		}
	}

	function setForm(){
		$discountPeriodArray = explode("-",$this->formArray["discountPeriod"]);
		$this->formArray["discountPeriod_month"] = $discountPeriodArray[0];
		$this->formArray["discountPeriod_day"] = $discountPeriodArray[1];

		$this->setDateDropDown("discountPeriod_");

		if($this->formArray["annualDueDate"]=="01-01"){
			$this->tpl->set_var("annualDueDate_jan01_selected","checked");
			$this->tpl->set_var("annualDueDate_jan31_selected","");
		}
		else{
			$this->tpl->set_var("annualDueDate_jan01_selected","");			$this->tpl->set_var("annualDueDate_jan31_selected","checked");
		}

		$this->formArray["cutOff"] = $this->formArray["annualDueDate"];

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function showPenaltyLUTList(){
		$this->tpl->set_block("rptsTemplate","PenaltyLUTList", "PenaltyLUTListBlock");

		$i=1;

		$col1Array = array_slice($this->formArray["penaltyLUT"],0,12);
		$col2Array = array_slice($this->formArray["penaltyLUT"],12,24);
		$col3Array = array_slice($this->formArray["penaltyLUT"],24,36);
		$col4Array = array_slice($this->formArray["penaltyLUT"],36,count($this->formArray["penaltyLUT"]));

		$col1 = 1;
		$col2 = 13;
		$col3 = 25;
		$col4 = 37;

		for($i=0 ; $i<=12 ; $i++){
			if($col1<=12){
				$this->tpl->set_var("col1_penaltyMonth",$col1.":");

				$col1_penaltyPercent = $col1Array[$i]*100;

				// create percent value into an input field
				$col1_penaltyPercent = sprintf("<input type='text' name='penaltyLUT[%s]' value='%s' size=4 style='text-align:right'>",$col1-1,$col1Array[$i]);
				$this->tpl->set_var("col1_penaltyPercent",$col1_penaltyPercent);
			}
			else{
				$this->tpl->set_var("col1_penaltyMonth","");
				$this->tpl->set_var("col1_penaltyPercent","");
			}

			if($col2<=24){
				$this->tpl->set_var("col2_penaltyMonth",$col2.":");

				$col2_penaltyPercent = $col2Array[$i]*100;

				// create percent value into an input field
				$col2_penaltyPercent = sprintf("<input type='text' name='penaltyLUT[%s]' value='%s' size=4 style='text-align:right'>",$col2-1,$col2Array[$i]);
				$this->tpl->set_var("col2_penaltyPercent",$col2_penaltyPercent);
			}
			else{
				$this->tpl->set_var("col2_penaltyMonth","");
				$this->tpl->set_var("col2_penaltyPercent","");
			}

			if($col3<=36){
				$this->tpl->set_var("col3_penaltyMonth",$col3.":");

				$col3_penaltyPercent = $col3Array[$i]*100;

				// create percent value into an input field
				$col3_penaltyPercent = sprintf("<input type='text' name='penaltyLUT[%s]' value='%s' size=4 style='text-align:right'>",$col3-1,$col3Array[$i]);
				$this->tpl->set_var("col3_penaltyPercent",$col3_penaltyPercent);
			}
			else{
				$this->tpl->set_var("col3_penaltyMonth","");
				$this->tpl->set_var("col3_penaltyPercent","");
			}

			if($col4<=count($this->formArray["penaltyLUT"])){
				$this->tpl->set_var("col4_penaltyMonth",$col4.":");

				$col4_penaltyPercent = $col4Array[$i]*100;

				// create percent value into an input field
				$col4_penaltyPercent = sprintf("<input type='text' name='penaltyLUT[%s]' value='%s' size=4 style='text-align:right'>",$col4-1,$col4Array[$i]);
				$this->tpl->set_var("col4_penaltyPercent",$col4_penaltyPercent);
			}
			else{
				$this->tpl->set_var("col4_penaltyMonth","");
				$this->tpl->set_var("col4_penaltyPercent","");
			}

			$this->tpl->parse("PenaltyLUTListBlock", "PenaltyLUTList", true);

			$col1++;
			$col2++;
			$col3++;
			$col4++;
		}

	}

	function Main(){
		$treasurySettings = new TreasurySettings;
		switch ($this->formArray["formAction"]){
			case "reset":
				// If TreasurySettings Table doesn't exist, Create table and insert defaults from masterTables
				$treasurySettings->setPenaltyLUT($this->masterTables["penaltyLUT"]);
				$treasurySettings->setAnnualDueDate($this->masterTables["annualDueDate"]);
				$treasurySettings->setPctRPTax($this->masterTables["pctRPTax"]);
				$treasurySettings->setPctSEF($this->masterTables["pctSEF"]);
				$treasurySettings->setPctIdle($this->masterTables["pctIdle"]);
				$treasurySettings->setDiscountPercentage($this->masterTables["discountPercentage"]);
				$treasurySettings->setDiscountPeriod($this->masterTables["discountPeriod"]);
				$treasurySettings->setAdvancedDiscountPercentage($this->masterTables["advancedDiscountPercentage"]);
				$treasurySettings->setQ1AdvancedDiscountPercentage($this->masterTables["q1AdvancedDiscountPercentage"]);

				if(!$treasurySettings->tableExists()){
					$treasurySettings->createTable();
					$treasurySettings->insertRecord();
				}
				else{
					$treasurySettings->updateRecord();
				}

				$this->formArray["message"] = "Variables reset to default values.";
				break;
			case "save":
				if($treasurySettings->tableExists()){
					ksort($this->formArray["penaltyLUT"]);
					reset($this->formArray["penaltyLUT"]);

					$treasurySettings->setPenaltyLUT($this->formArray["penaltyLUT"]);
					$treasurySettings->setAnnualDueDate($this->formArray["annualDueDate"]);
					$treasurySettings->setPctRPTax($this->formArray["pctRPTax"]);
					$treasurySettings->setPctSEF($this->formArray["pctSEF"]);
					$treasurySettings->setPctIdle($this->formArray["pctIdle"]);
					$treasurySettings->setDiscountPercentage($this->formArray["discountPercentage"]);
					$treasurySettings->setDiscountPeriod($this->formArray["discountPeriod"]);
					$treasurySettings->setAdvancedDiscountPercentage($this->formArray["advancedDiscountPercentage"]);
					$treasurySettings->setQ1AdvancedDiscountPercentage($this->formArray["q1AdvancedDiscountPercentage"]);

					if($treasurySettings->updateRecord()){
						$this->formArray["message"] = "Treasury Settings saved.";
					}
					else{
						$this->formArray["message"] = "Error saving. Try clicking 'Reset' to restore defaults.";
					}
				}
				else{
					$this->formArray["message"] = "Error saving. Try clicking 'Reset' to restore defaults.";
				}
	
				break;
			default:
				// If TreasurySettings Table doesn't exist, Create table and insert defaults from masterTables (upon installation)

				if(!$treasurySettings->tableExists()){
					$treasurySettings->createTable();
				}

				// If somehow no record exists in Treasury Settings, Insert a Record (unlikely to occur)

				if(!$treasurySettings->selectRecord()){
					$treasurySettings->setPenaltyLUT($this->masterTables["penaltyLUT"]);
					$treasurySettings->setAnnualDueDate($this->masterTables["annualDueDate"]);
					$treasurySettings->setPctRPTax($this->masterTables["pctRPTax"]);
					$treasurySettings->setPctSEF($this->masterTables["pctSEF"]);
					$treasurySettings->setPctIdle($this->masterTables["pctIdle"]);
					$treasurySettings->setDiscountPercentage($this->masterTables["discountPercentage"]);
					$treasurySettings->setDiscountPeriod($this->masterTables["discountPeriod"]);
					$treasurySettings->setAdvancedDiscountPercentage($this->masterTables["advancedDiscountPercentage"]);
					$treasurySettings->setQ1AdvancedDiscountPercentage($this->masterTables["q1AdvancedDiscountPercentage"]);
					$treasurySettings->insertRecord();
				}

				// If somehow more than 1 record exists in Treasury Settings, delete all records and Insert Record (unlikely to occur)

				if($treasurySettings->countRecord()>1){
					$treasurySettings->deleteRecord();
					$treasurySettings->setPenaltyLUT($this->masterTables["penaltyLUT"]);
					$treasurySettings->setAnnualDueDate($this->masterTables["annualDueDate"]);
					$treasurySettings->setPctRPTax($this->masterTables["pctRPTax"]);
					$treasurySettings->setPctSEF($this->masterTables["pctSEF"]);
					$treasurySettings->setPctIdle($this->masterTables["pctIdle"]);
					$treasurySettings->setDiscountPercentage($this->masterTables["discountPercentage"]);
					$treasurySettings->setDiscountPeriod($this->masterTables["discountPeriod"]);
					$treasurySettings->setAdvancedDiscountPercentage($this->masterTables["advancedDiscountPercentage"]);
					$treasurySettings->setQ1AdvancedDiscountPercentage($this->masterTables["q1AdvancedDiscountPercentage"]);
					$treasurySettings->insertRecord();
				}
		}

		if($treasurySettings->selectRecord()){
			$this->formArray["penaltyLUT"] = $treasurySettings->getPenaltyLUT();
			$this->formArray["annualDueDate"] = $treasurySettings->getAnnualDueDate();
			$this->formArray["pctRPTax"] = $treasurySettings->getPctRPTax();
			$this->formArray["pctSEF"] = $treasurySettings->getPctSEF();
			$this->formArray["pctIdle"] = $treasurySettings->getPctIdle();
			$this->formArray["discountPercentage"] = $treasurySettings->getDiscountPercentage();
			$this->formArray["discountPeriod"] = $treasurySettings->getDiscountPeriod();
			$this->formArray["advancedDiscountPercentage"] = $treasurySettings->getAdvancedDiscountPercentage();
			$this->formArray["q1AdvancedDiscountPercentage"] = $treasurySettings->getQ1AdvancedDiscountPercentage();
		}
		else{
			foreach($this->masterTables as $key=>$value){
				$this->formArray[$key] = $value;
			}
		}
		$this->showPenaltyLUTList();

		$this->setForm();

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->tpl->set_var("Session", $this->sess->url(""));
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
	,"perm" => "rpts_Perm"
	));
//*/

$masterTables = array(
	"penaltyLUT" => $penaltyLUT
	,"annualDueDate" => $annualDueDate
	,"pctRPTax" => $pctRPTax
	,"pctSEF" => $pctSEF
	,"pctIdle" => $pctIdle
	,"discountPercentage" => $discountPercentage
	,"discountPeriod" => $discountPeriod
	,"advancedDiscountPercentage" => $advancedDiscountPercentage
	,"q1AdvancedDiscountPercentage" => $q1AdvancedDiscountPercentage);

$obj = new TreasurySettingsEncode($HTTP_POST_VARS,$sess,$formAction,$masterTables);
$obj->Main();

?>
<?php page_close(); ?>
