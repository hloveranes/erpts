<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/TD.php";

include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/User.php";
include_once "../includes/assessor/UserRecords.php";

include_once "../includes/assessor/eRPTSSettings.php";

#####################################
# Define Interface Class
#####################################
class TDEncode{
	
	var $tpl;
	var $formArray;
	var $td;
	
	function TDEncode($http_post_vars, $afsID, $propertyID="", $tdID="", $propertyType="",$formAction="",$sess){
		//global $HTTP_POST_VARS;
		global $auth;

		$this->sess = $sess;
		$this->userID = $auth->auth["uid"];

		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "TDEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode TD");
		$this->formArray = array(
			"afsID" => $afsID
			, "tdID" => $tdID
			, "propertyID" => $propertyID
			, "propertyType" => $propertyType
			, "taxDeclarationNumber" => ""
			, "provincialAssessor" => ""
			, "provincialAssessorDate" => ""
			, "cityMunicipalAssessor" => ""
			, "cityMunicipalAssessorDate" => ""
			, "cancelsTDNumber" => ""
			, "canceledByTDNumber" => ""
			, "taxBeginsWithTheYear" => ""
			, "ceasesWithTheYear" => ""
			, "enteredInRPARForYear" => ""
			, "enteredInRPARForBy" => ""
			, "previousOwner" => ""
			, "previousAssessedValue" => ""
			, "pa_month" => ""
			, "pa_day" => ""
			, "pa_year" => ""
			, "cm_month" => ""
			, "cm_day" => ""
			, "cm_year" => ""
			, "formAction" => $formAction
		);
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
			//echo $key." = ".$this->formArray[$key]."<br>";
		}
		
		//$this->formArray["taxBeginsWithTheYear"];
		$pa_dateStr = $this->formArray["pa_year"]."-".putPreZero($this->formArray["pa_month"])."-".putPreZero($this->formArray["pa_day"]);
		$this->formArray["provincialAssessorDate"] = $pa_dateStr;
		$cm_dateStr = $this->formArray["cm_year"]."-".putPreZero($this->formArray["cm_month"])."-".putPreZero($this->formArray["cm_day"]);
		$this->formArray["cityMunicipalAssessorDate"] = $cm_dateStr;
				
	}

	function initMasterSignatoryList($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php", "urn:Object");
		if(!$xmlStr = $eRPTSSettingsDetails->getERPTSSettingsDetails(1)){
			// error xml
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
			}
			else{
				$eRPTSSettings = new eRPTSSettings;
				$eRPTSSettings->parseDomDocument($domDoc);
				switch($tempVar){
					case "cityMunicipalAssessor":
					case "provincialAssessor":
					case "enteredInRPARForBy":
					
						$this->formArray["cityMunicipalAssessorID"] = $this->formArray["cityMunicipalAssessor"];
						$this->formArray["provincialAssessorID"] = $this->formArray["provincialAssessor"];
						$this->formArray["enteredInRPARForByID"] = $this->formArray["enteredInRPARForBy"];
						
						$this->tpl->set_var("id",$eRPTSSettings->getAssessorFullName());
						$this->tpl->set_var("name",$eRPTSSettings->getAssessorFullName());

						$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
						$this->initSelected($tempVar."ID",$eRPTSSettings->getAssessorFullName());
						$this->tpl->parse($TempVar."ListBlock",$TempVar."List",true);
						
						// provincialAssessor
						
						if($eRPTSSettings->getProvincialAssessorLastName()!=""){
							$this->formArray["cityMunicipalAssessorID"] = $this->formArray["cityMunicipalAssessor"];
							$this->formArray["provincialAssessorID"] = $this->formArray["provincialAssessor"];
							$this->formArray["enteredInRPARForByID"] = $this->formArray["enteredInRPARForBy"];

							$this->tpl->set_var("id",$eRPTSSettings->getProvincialAssessorFullName());
							$this->tpl->set_var("name",$eRPTSSettings->getProvincialAssessorFullName());

							$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
							$this->initSelected($tempVar."ID",$eRPTSSettings->getProvincialAssessorFullName());
							$this->tpl->parse($TempVar."ListBlock",$TempVar."List",true);
						}
						
						break;
				}
			}
		}

		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
        if (!$xmlStr = $UserList->getUserList(0, " WHERE (userType='Assessor' OR userType='Signatory') AND status='enabled'")){
           $this->tpl->set_var("id", "");
           $this->tpl->set_var("name", "empty list2");
		   $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
			    $this->tpl->set_var("", "");
                $this->tpl->set_var("name", "empty list");
		        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
			}
			else {
				$UserRecords = new UserRecords;
				$UserRecords->parseDomDocument($domDoc);
				$list = $UserRecords->getArrayList();
				foreach ($list as $key => $user){
					$person = new Person;
					$person->selectRecord($user->personID);
					$this->tpl->set_var("id",$user->personID);
					$this->tpl->set_var("name",$person->getFullName());
					$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
			        $this->initSelected($tempVar."ID",$user->personID);
			        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
				}
			}
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
		$startYear = 1900;
		$endYear = date("Y");
		$this->tpl->set_block("rptsTemplate", $type."YearList", $type."YearListBlock");
		for($i = $endYear; $i>=$startYear; $i--){
			$this->tpl->set_var($type."yearValue", $i);
			$this->initSelected($type."year",$i);
			$this->tpl->parse($type."YearListBlock", $type."YearList", true);
		}
		
		eval(MONTH_ARRAY);//$monthArray
		$this->tpl->set_block("rptsTemplate", $type."MonthList", $type."MonthListBlock");
		foreach($monthArray as $key => $value){
			$this->tpl->set_var($type."monthValue", $key);
			$this->tpl->set_var($type."month", $value);
			$this->initSelected($type."month",$key);
			$this->tpl->parse($type."MonthListBlock", $type."MonthList", true);
		}
		$this->tpl->set_block("rptsTemplate", $type."DayList", $type."DayListBlock");
		for($i = 1; $i<=28; $i++){
			$this->tpl->set_var($type."dayValue", $i);
			$this->initSelected($type."day",$i);
			$this->tpl->parse($type."DayListBlock", $type."DayList", true);
		}
	}
	function setForm(){
		$startYear = date("Y");
		$endYear = date("Y")+1;
		$this->tpl->set_block("rptsTemplate", "BeginYearList", "BeginYearListBlock");
		for($i = $endYear; $i>=$startYear; $i--){
			$this->tpl->set_var("beginYear", $i);
			$this->initSelected("taxBeginsWithTheYear",$i);
			$this->tpl->parse("BeginYearListBlock", "BeginYearList", true);
		}
		$startYear = date("Y")+1;
		$endYear = date("Y")+4;
		$this->tpl->set_block("rptsTemplate", "CeasesYearList", "CeasesYearListBlock");
		for($i = $endYear; $i>=$startYear; $i--){
			$this->tpl->set_var("ceaseYear", $i);
			$this->initSelected("ceasesWithTheYear",$i);
			$this->tpl->parse("CeasesYearListBlock", "CeasesYearList", true);
		}

		$this->initMasterSignatoryList("ProvincialAssessor", "provincialAssessor");
		$this->initMasterSignatoryList("CityMunicipalAssessor", "cityMunicipalAssessor");
		$this->initMasterSignatoryList("EnteredInRPARForBy", "enteredInRPARForBy");

		$this->setDateDropDown("pa_");
		$this->setDateDropDown("cm_");

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main(){
		//echo $this->formArray["formAction"];
		switch ($this->formArray["formAction"]){
			case "save":
				$TDEncode = new SoapObject(NCCBIZ."TDEncode.php", "urn:Object");
				if ($this->formArray["tdID"] <> ""){
					$TDDetails = new SoapObject(NCCBIZ."TDDetails.php", "urn:Object");
					if (!$xmlStr = $TDDetails->getTD($this->formArray["tdID"])){
						$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$td = new TD;
							$td->parseDomDocument($domDoc);
							$td->setTdID($this->formArray["tdID"]);
							$td->setAfsID($this->formArray["afsID"]);
							$td->setPropertyID($this->formArray["propertyID"]);
							$td->setPropertyType($this->formArray["propertyType"]);
							$td->setTaxDeclarationNumber($this->formArray["taxDeclarationNumber"]);
							$td->setProvincialAssessor($this->formArray["provincialAssessorID"]);
							$td->setProvincialAssessorDate($this->formArray["provincialAssessorDate"]);
							$td->setCityMunicipalAssessor($this->formArray["cityMunicipalAssessorID"]);
							$td->setCityMunicipalAssessorDate($this->formArray["cityMunicipalAssessorDate"]);
							$td->setCancelsTDNumber($this->formArray["cancelsTDNumber"]);
							$td->setCanceledByTDNumber($this->formArray["canceledByTDNumber"]);
							$td->setTaxBeginsWithTheYear($this->formArray["taxBeginsWithTheYear"]);
							$td->setCeasesWithTheYear($this->formArray["ceasesWithTheYear"]);
							$td->setEnteredInRPARForYear($this->formArray["enteredInRPARForYear"]);
							$td->setEnteredInRPARForBy($this->formArray["enteredInRPARForByID"]);
							$td->setPreviousOwner($this->formArray["previousOwner"]);
							$td->setPreviousAssessedValue($this->formArray["previousAssessedValue"]);
							$td->setCreatedBy($this->userID);
							$td->setModifiedBy($this->userID);
							$td->setDomDocument();

							$doc = $td->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							//exit($xmlStr);
							if (!$ret = $TDEncode->updateTD($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
					$td = new TD;
					$td->parseDomDocument($domDoc);
					//$td->setTdID($this->formArray["tdID"]);
					$td->setAfsID($this->formArray["afsID"]);
					$td->setPropertyID($this->formArray["propertyID"]);
					$td->setPropertyType($this->formArray["propertyType"]);
					$td->setTaxDeclarationNumber($this->formArray["taxDeclarationNumber"]);
					$td->setProvincialAssessor($this->formArray["provincialAssessorID"]);
					$td->setProvincialAssessorDate($this->formArray["provincialAssessorDate"]);
					$td->setCityMunicipalAssessor($this->formArray["cityMunicipalAssessorID"]);
					$td->setCityMunicipalAssessorDate($this->formArray["cityMunicipalAssessorDate"]);
					$td->setCancelsTDNumber($this->formArray["cancelsTDNumber"]);
					$td->setCanceledByTDNumber($this->formArray["canceledByTDNumber"]);
					$td->setTaxBeginsWithTheYear($this->formArray["taxBeginsWithTheYear"]);
					$td->setCeasesWithTheYear($this->formArray["ceasesWithTheYear"]);
					$td->setEnteredInRPARForYear($this->formArray["enteredInRPARForYear"]);
					$td->setEnteredInRPARForBy($this->formArray["enteredInRPARForByID"]);
					$td->setPreviousOwner($this->formArray["previousOwner"]);
					$td->setPreviousAssessedValue($this->formArray["previousAssessedValue"]);
					$td->setCreatedBy($this->userID);
					$td->setModifiedBy($this->userID);
					$td->setDomDocument();
					$doc = $td->getDomDocument();
				
					$xmlStr =  $doc->dump_mem(true);
					//echo $xmlStr;
					if (!$ret = $TDEncode->saveTD($xmlStr)){
						echo("Error saving");
					}
				}
				$this->formArray["propertyID"] = $ret;
				header("location: TDClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
				exit($ret);
				break;
			case "cancel":
				header("location: TDList.php";
				exit;
				break;
			default:
				if ($this->formArray["tdID"]){
					$TDDetails = new SoapObject(NCCBIZ."TDDetails.php", "urn:Object");
					if (!$xmlStr = $TDDetails->getTD($this->formArray["tdID"])){
						echo ("xml failed");
					}
					else{
						//echo $xmlStr;
						if(!$domDoc = domxml_open_mem($xmlStr)) {
							$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
							$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
						}
						else {
							$td = new TD;
							$td->parseDomDocument($domDoc);
							foreach($td as $key => $value){
								switch ($key){
									case "provincialAssessorDate":
										if (true){
											list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
											$this->formArray["pa_year"] = removePreZero($dateArr["year"]);
											$this->formArray["pa_month"] = removePreZero($dateArr["month"]);
											$this->formArray["pa_day"] = removePreZero($dateArr["day"]);
										}
										else {
											$this->formArray[$key] = "";
										}
									break;
									case "cityMunicipalAssessorDate":
										if (true){
											list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
											$this->formArray["cm_year"] = removePreZero($dateArr["year"]);
											$this->formArray["cm_month"] = removePreZero($dateArr["month"]);
											$this->formArray["cm_day"] = removePreZero($dateArr["day"]);
										}
										else {
											$this->formArray[$key] = "";
										}
									break;
									default:
										//echo $key."=>".$value."<br>";
										$this->formArray[$key] = $value;
								}
							}
						}
					}
				}
				$this->tpl->set_block("rptsTemplate", "odID", "odIDBlock");
				$this->tpl->set_var("odIDBlock", "");
				$this->tpl->set_block("rptsTemplate", "ACK", "ACKBlock");
				$this->tpl->set_var("ACKBlock", "");
		}
		$this->setForm();
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("tdID" => $this->formArray["tdID"],"propertyType" => $this->formArray["propertyType"],"propertyID" => $this->formArray["propertyID"],"afsID" => $this->formArray["afsID"])));
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
$tdEncode = new TDEncode($HTTP_POST_VARS,$afsID,$propertyID,$tdID,$propertyType,$formAction,$sess);
$tdEncode->Main();
?>
<?php page_close(); ?>
