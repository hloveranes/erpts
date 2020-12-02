<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/TD.php";

include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/User.php";
include_once "../includes/assessor/UserRecords.php";

include_once "../includes/assessor/eRPTSSettings.php";

include_once "../includes/assessor/ODHistory.php";
include_once "../includes/assessor/ODHistoryRecords.php";

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
			, "memoranda" => ""
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

	function getCancelsTDNumberArray(){
		// capture cancelsTDNumber from odHistory
		$ODHistoryList = new SoapObject(NCCBIZ."ODHistoryList.php", "urn:Object");
		$ODHistoryRecords = new ODHistoryRecords;

		if(!$xmlStr = $ODHistoryList->getPrecedingODList($this->formArray["odID"])){
			// error xml
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
			}
			else{
				$ODHistoryRecords->parseDomDocument($domDoc);
				$precedingODList = $ODHistoryRecords->arrayList;

				$AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
				$TDDetails = new SoapObject(NCCBIZ."TDDetails.php", "urn:Object");

				foreach($precedingODList as $key => $odHistory){
					$previousODID = $odHistory->getPreviousODID();
					$previousAFSID = $AFSEncode->getAfsID($previousODID);

					$precedingTDxml = $TDDetails->getTDFromAfsID($previousAFSID);
					$precedingTDdomDoc = domxml_open_mem($precedingTDxml);
					$precedingTD = new TD;
					$precedingTD->parseDomDocument($precedingTDdomDoc);

					$cancelsTDNumber[] = $precedingTD->taxDeclarationNumber;
				}

				return $cancelsTDNumber;
			}
		}
		return false;
	}

	function getCanceledByTDNumberArray(){
		$ODHistoryList = new SoapObject(NCCBIZ."ODHistoryList.php", "urn:Object");
		$ODHistoryRecords = new ODHistoryRecords;

		// capture canceledByTDNumber from odHistory
		if(!$xmlStr = $ODHistoryList->getSucceedingODList($this->formArray["odID"])){
			// error xml
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
			}
			else{
				$ODHistoryRecords->parseDomDocument($domDoc);
				$succeedingODList = $ODHistoryRecords->arrayList;

				$AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
				$TDDetails = new SoapObject(NCCBIZ."TDDetails.php", "urn:Object");

				foreach($succeedingODList as $key => $odHistory){
					$succeedingODID = $odHistory->getPresentODID();
					$succeedingAFSID = $AFSEncode->getAfsID($succeedingODID);

					$succeedingTDxml = $TDDetails->getTDFromAfsID($succeedingAFSID);
					$succeedingTDdomDoc = domxml_open_mem($succeedingTDxml);
					$succeedingTD = new TD;
					$succeedingTD->parseDomDocument($succeedingTDdomDoc);

					$canceledByTDNumber[] = $succeedingTD->taxDeclarationNumber;
				}

				return $canceledByTDNumber;
			}
		}

		return false;
	}

	function updateTDCanceledByTDNumber($td){
		// capture canceledByTDNumber from odHistory

		$canceledByTDNumber = $this->getCanceledByTDNumberArray();

		if(is_array($canceledByTDNumber)){
			$i=0;
			$td->canceledByTDNumber = "";
			foreach($canceledByTDNumber as $key => $tdNumber){
				if($i>0){
					$td->canceledByTDNumber .= ", ";
				}
				$td->canceledByTDNumber .= $tdNumber;
				$i++;
			}

			$td->setDomDocument();

			$domDoc = $td->getDomDocument();
			$xmlStr = $domDoc->dump_mem(true);

			$TDEncode = new SoapObject(NCCBIZ."TDEncode.php", "urn:Object");
			$TDEncode->updateTD($xmlStr);
		}

		return $td;
	}

	function updateTDCancelsTDNumber($td){
		// capture cancelsTDNumber from odHistory
		$cancelsTDNumber = $this->getCancelsTDNumberArray();

		if(is_array($cancelsTDNumber) > 0){
			$i=0;
			$td->cancelsTDNumber = "";
			foreach($cancelsTDNumber as $key => $tdNumber){
				if($i>0){
					$td->cancelsTDNumber .= ", ";
				}
				$td->cancelsTDNumber .= $tdNumber;
				$i++;
			}

			$td->setDomDocument();
			$domDoc = $td->getDomDocument();
			$xmlStr = $domDoc->dump_mem(true);

			$TDEncode = new SoapObject(NCCBIZ."TDEncode.php", "urn:Object");
			$TDEncode->updateTD($xmlStr);
		}

		return $td;
	}

	function initMasterSignatoryList($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		// commented out: March 16, 2004:
		// recommended that approval lists come ONLY out of the Users table and not out of eRPTSSettings

		/* Begin of Comment out

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

						// provincialAssessor

						if($eRPTSSettings->getProvincialAssessorLastName()!=""){
					
							$this->formArray["cityMunicipalAssessorID"] = $this->formArray["cityMunicipalAssessor"];
							$this->formArray["provincialAssessorID"] = $this->formArray["provincialAssessor"];
							$this->formArray["enteredInRPARForByID"] = $this->formArray["enteredInRPARForBy"];

							$this->tpl->set_var("id",$eRPTSSettings->getAssessorFullName());
							$this->tpl->set_var("name",$eRPTSSettings->getAssessorFullName());

							$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
							$this->initSelected($tempVar."ID",$eRPTSSettings->getAssessorFullName());
							$this->tpl->parse($TempVar."ListBlock",$TempVar."List",true);
						
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
		*/ 
		// End of Comment out : March 16, 2004

		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
        if (!$xmlStr = $UserList->getUserList(0, " WHERE ".AUTH_USER_MD5_TABLE.".userType REGEXP '1$' AND ".AUTH_USER_MD5_TABLE.".status='enabled'")){
	       // error xml
   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
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
		$startYear = 1900;
		$endYear = date("Y")+10;
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

		$this->setDateDropDown("pa_");
		$this->setDateDropDown("cm_");

		$this->initMasterSignatoryList("ProvincialAssessor", "provincialAssessor");
		$this->initMasterSignatoryList("CityMunicipalAssessor", "cityMunicipalAssessor");
		$this->initMasterSignatoryList("EnteredInRPARForBy", "enteredInRPARForBy");

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
							$td->setMemoranda($this->formArray["memoranda"]);
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
					$td->setMemoranda($this->formArray["memoranda"]);
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

							if($td->getCancelsTDNumber()==""){
								$td = $this->updateTDCancelsTDNumber($td);
							}
							if($td->getCanceledByTDNumber()==""){
								$td = $this->updateTDCanceledByTDNumber($td);
							}

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
									case "propertyType":
										// so it wont go to the default loop. so that propertyType can refresh from the GET input
										break;
									default:
										//echo $key."=>".$value."<br>";
										$this->formArray[$key] = $value;
								}
							}
						}
					}
				}
				else{
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

							$this->formArray["taxDeclarationNumber"] = $afs->getARPNumber();
							$this->formArray["odID"] = $afs->getOdID();

							// default cancelsTDNumber and canceledByTDNumber

							$cancelsTDNumberArray = $this->getCancelsTDNumberArray();
							if(is_array($cancelsTDNumberArray)){
								$this->formArray["cancelsTDNumber"] = implode(", ",$cancelsTDNumberArray);
							}

							$canceledByTDNumberArray = $this->getCanceledByTDNumberArray();
							if(is_array($canceledByTDNumberArray)){
								$this->formArray["canceledByTDNumber"] = implode(", ",$canceledByTDNumberArray);
							}

							// default memoranda from properties

							$this->formArray["memoranda"] = "";

							if(is_array($afs->landArray)){
								if(is_object($afs->landArray[0])){
									if($afs->landArray[0]->memoranda!=""){
										$this->formArray["memoranda"] .= "Land Memo:\n".$afs->landArray[0]->memoranda;
									}
								}
							}
							if(is_array($afs->plantsTreesArray)){
								if(is_object($afs->plantsTreesArray[0])){
									if($afs->plantsTreesArray[0]->memoranda!=""){
										$this->formArray["memoranda"] .= "\nPlants Trees Memo:\n". $afs->plantsTreesArray[0]->memoranda;
									}
								}
							}
							if(is_array($afs->improvementsBuildingsArray)){
								if(is_object($afs->improvementsBuildingsArray[0])){
									if($afs->improvementsBuildingsArray[0]->memoranda!=""){
										$this->formArray["memoranda"] .= "\nImprovements/Buildings Memo:\n". $afs->improvementsBuildingsArray[0]->memoranda;
									}
								}
							}
							if(is_array($afs->machineriesArray)){
								if(is_object($afs->machineriesArray[0])){
									if($afs->machineriesArray[0]->memoranda!=""){
										$this->formArray["memoranda"] .= "\nMachineries Memo:\n". $afs->machineriesArray[0]->memoranda;
									}
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
