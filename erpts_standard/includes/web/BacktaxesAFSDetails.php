<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/Address.php";
include_once "../assessor/LocationAddress.php";
include_once "../assessor/Company.php";
include_once "../assessor/CompanyRecords.php";
include_once "../assessor/Person.php";
include_once "../assessor/PersonRecords.php";
include_once "../assessor/Owner.php";
include_once "../assessor/OwnerRecords.php";
include_once "../assessor/AFS.php";
include_once "../assessor/TD.php";

include_once "../assessor/LandClasses.php";
include_once "../assessor/LandSubclasses.php";
include_once "../assessor/LandActualUses.php";

include_once "../assessor/PlantsTreesClasses.php";
include_once "../assessor/PlantsTreesActualUses.php";
include_once "../assessor/ImprovementsBuildingsClasses.php";
include_once "../assessor/ImprovementsBuildingsActualUses.php";
include_once "../assessor/MachineriesClasses.php";
include_once "../assessor/MachineriesActualUses.php";

include_once "../assessor/ODHistoryRecords.php";
include_once "../assessor/ODHistory.php";

include_once "../collection/BacktaxTD.php";
include_once "../collection/BacktaxTDRecords.php";


#####################################
# Define Interface Class
#####################################
class AFSDetails{
	
	var $tpl;
	var $formArray;
	
	function AFSDetails($http_post_vars,$sess,$afsID){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must have atleast TM-EDIT access
		$pageType = "%%%1%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "BacktaxesAFSDetails.htm") ;
		$this->tpl->set_var("TITLE", "TM : Manage Backtaxes Details");
		
		$this->formArray["afsID"] = $afsID;
		$this->formArray["landFormAction"] = "";
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
		$this->formArray["totalMarketValue"] = 0;
		$this->formArray["totalAssessedValue"] = 0;
	}
	
	function initCheckBox($checkboxName){
		$checked = "checked";
		if (!$this->formArray[$checkboxName]) $checked = "";
		$this->tpl->set_var($checkboxName, $checked);
	}
	
	function setForm(){
		$this->formArray["landTotalMarketValue"] = number_format($this->formArray["landTotalMarketValue"], 2, '.', ',');
		$this->formArray["plantTotalMarketValue"] = number_format($this->formArray["plantTotalMarketValue"], 2, '.', ',');
		$this->formArray["bldgTotalMarketValue"] = number_format($this->formArray["bldgTotalMarketValue"], 2, '.', ',');
		$this->formArray["machTotalMarketValue"] = number_format($this->formArray["machTotalMarketValue"], 2, '.', ',');
		$this->formArray["landTotalAssessedValue"] = number_format($this->formArray["landTotalAssessedValue"], 2, '.', ',');
		$this->formArray["plantTotalAssessedValue"] = number_format($this->formArray["plantTotalAssessedValue"], 2, '.', ',');
		$this->formArray["bldgTotalAssessedValue"] = number_format($this->formArray["bldgTotalAssessedValue"], 2, '.', ',');
		$this->formArray["machTotalAssessedValue"] = number_format($this->formArray["machTotalAssessedValue"], 2, '.', ',');
		$this->formArray["totalMarketValue"] = number_format($this->formArray["totalMarketValue"], 2, '.', ',');
		$this->formArray["totalAssessedValue"] = number_format($this->formArray["totalAssessedValue"], 2, '.', ',');

		foreach ($this->formArray as $key => $value){
			if ($key == "totalMarketValue" || $key == "totalAssessedValue"){
				$this->tpl->set_var($key, $value);
			}
			else $this->tpl->set_var($key, $value);
		}
		$checked = "checked";
		$this->initCheckBox("affidavitOfOwnership");
		$this->initCheckBox("barangayCertificate");
		$this->initCheckBox("landTagging");
	}

	function hideBlock($tempVar){
		$this->tpl->set_block("rptsTemplate", $tempVar, $tempVar."Block");
		$this->tpl->set_var($tempVar."Block", "");
	}

	function setPageDetailPerms(){
		// hide Blocks from Treasurer

		$this->hideBlock("RPUIdentificationEncodeLink");
		$this->hideBlock("TDEncodeLink");
		$this->hideBlock("AddLandLink");
		$this->hideBlock("AddPlantsTreesLink");
		$this->hideBlock("AddImprovementsBuildingsLink");
		$this->hideBlock("AddMachineriesLink");

		$this->tpl->set_var("ownerViewAccess","viewOnly");
		$this->tpl->set_var("removePropertyDisabled", "disabled");

		if(!checkPerms($this->user["userType"],"%%%1%%%%%%")){
			// hide Blocks if userType is not at least TM-Edit
			$this->hideBlock("TreasuryMaintenanceLink");
		}
		else{
			$this->hideBlock("TreasuryMaintenanceLinkText");
		}

	}

	function setLandListBlockPerms(){
		// hide from Treasurer
		$this->tpl->set_block("LandList", "EditLandLink", "EditLandLinkBlock");
		$this->tpl->set_var("EditLandLinkBlock", "<s>Edit</s>");
	}

	function setPlantsTreesListBlockPerms(){
		// hide from Treasurer
		$this->tpl->set_block("PlantsTreesList", "EditPlantsTreesLink", "EditPlantsTreesLinkBlock");
		$this->tpl->set_var("EditPlantsTreesLinkBlock", "<s>Edit</s>");
	}

	function setImprovementsBuildingsListBlockPerms(){
		// hide from Treasurer
		$this->tpl->set_block("ImprovementsBuildingsList", "EditImprovementsBuildingsLink", "EditImprovementsBuildingsLinkBlock");
		$this->tpl->set_var("EditImprovementsBuildingsLinkBlock", "<s>Edit</s>");
	}

	function setMachineriesListBlockPerms(){
		// hide from Treasurer
		$this->tpl->set_block("MachineriesList", "EditMachineriesLink", "EditMachineriesLinkBlock");
		$this->tpl->set_var("EditMachineriesLinkBlock", "<s>Edit</s>");
	}
	
	function displayOwnerList($domDoc){
		$ownerRecords = new OwnerRecords;
		$ownerRecords->parseDomDocument($domDoc);
		$list = $ownerRecords->getArrayList();
		foreach ($list as $key => $value){
			if (count($value->personArray)){
				$this->tpl->set_block("rptsTemplate", "OwnerDBEmpty", "OwnerDBEmptyBlock");
				$this->tpl->set_var("OwnerDBEmptyBlock", "");
				$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
				foreach($value->personArray as $personKey =>$personValue){
					$this->tpl->set_var("personID", $personValue->getPersonID());
					if (!$pname = $personValue->getFullName()){
						$pname = "none";
					}
					$this->tpl->set_var("fullName", $pname);
					$pAddress = ($personValue->addressArray) ?$personValue->addressArray[0]->getFullAddress() : "";
					$this->tpl->set_var("address", $pAddress);
					$this->tpl->set_var("telephone", $personValue->getTelephone());
					$this->tpl->parse("PersonListBlock", "PersonList", true);
				}
			}
			else{
				$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
				$this->tpl->set_var("PersonListBlock", "");
			}
			if (count($value->companyArray)){
				$this->tpl->set_block("rptsTemplate", "OwnerDBEmpty", "OwnerDBEmptyBlock");
				$this->tpl->set_var("OwnerDBEmptyBlock", "");
				$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
				foreach ($value->companyArray as $companyKey => $companyValue){
					$this->tpl->set_var("companyID", $companyValue->getCompanyID());
					if (!$cname = $companyValue->getCompanyName()){
						$cname = "none";
					}
					$this->tpl->set_var("companyName", $cname);
					$cAddress = ($companyValue->addressArray) ?$companyValue->addressArray[0]->getFullAddress() : "";	
					$this->tpl->set_var("address", $cAddress);
					$this->tpl->set_var("telephone", $companyValue->getTelephone());
					$this->tpl->parse("CompanyListBlock", "CompanyList", true);
				}
			}
			else{
				$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
				$this->tpl->set_var("CompanyListBlock", "");	
			}
			//if (!count($value->companyArray)&&count($value->personArray)){
			//	$this->tpl->set_block("rptsTemplate", "OwnerDBEmpty", "OwnerDBEmptyBlock");
			//	$this->tpl->set_var("OwnerDBEmptyBlock", "");
			//}
		}
	}

	function displayRPUIdentification($afs){
		$this->tpl->set_block("rptsTemplate", "RPUIdentificationTable", "RPUIdentificationTableBlock");
		$this->tpl->set_block("rptsTemplate", "RPUIdentificationDBEmpty", "RPUIdentificationDBEmptyBlock");

		if($afs->arpNumber=="" && $afs->propertyIndexNumber==""){
			$this->tpl->set_var("RPUIdentificationTableBlock", "");
			$this->tpl->parse("RPUIdentificationDBEmptyBlock", "RPUIdentificationDBEmpty", true);
		}
		else{
			$this->tpl->set_var("RPUIdentificationDBEmptyBlock", "");
	
			$this->tpl->set_var("arpNumber", $afs->arpNumber);
			$this->tpl->set_var("propertyIndexNumber", $afs->propertyIndexNumber);
			$this->tpl->set_var("taxability", $afs->taxability);
			$this->tpl->set_var("effectivity", $afs->effectivity);

			$this->tpl->parse("RPUIdentificationTableBlock", "RPUIdentificationTable", true);
		}
	}

	function updateTDCancelsTDNumber($td){
		$ODHistoryList = new SoapObject(NCCBIZ."ODHistoryList.php", "urn:Object");
		$ODHistoryRecords = new ODHistoryRecords;

		// capture cancelsTDNumber from odHistory

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

				if(count($cancelsTDNumber) > 0){
					$i=0;
					$td->cancelsTDNumber = "";
					foreach($cancelsTDNumber as $key => $tdNumber){
						if($i>0){
							$td->cancelsTDNumber .= ", ";
						}
						$td->cancelsTDNumber .= $tdNumber;
						$i++;
					}
				}

				$td->setDomDocument();
				$domDoc = $td->getDomDocument();
				$xmlStr = $domDoc->dump_mem(true);

				$TDEncode = new SoapObject(NCCBIZ."TDEncode.php", "urn:Object");
				$TDEncode->updateTD($xmlStr);

			}
		}

		return $td;
	}

	function updateTDCanceledByTDNumber($td){
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

				if(count($canceledByTDNumber) > 0){
					$i=0;
					$td->canceledByTDNumber = "";
					foreach($canceledByTDNumber as $key => $tdNumber){
						if($i>0){
							$td->canceledByTDNumber .= ", ";
						}
						$td->canceledByTDNumber .= $tdNumber;
						$i++;
					}
				}

				$td->setDomDocument();

				$domDoc = $td->getDomDocument();
				$xmlStr = $domDoc->dump_mem(true);

				$TDEncode = new SoapObject(NCCBIZ."TDEncode.php", "urn:Object");
				$TDEncode->updateTD($xmlStr);

			}
		}

		return $td;
	}

	function displayBacktaxTD(){
		$BacktaxTDDetails = new SoapObject(NCCBIZ."BacktaxTDDetails.php", "urn:Object");
		if (!$xmlStr = $BacktaxTDDetails->getBacktaxTDList($this->formArray["tdID"])){
			$this->tpl->set_block("rptsTemplate", "BacktaxesTable", "BacktaxesTableBlock");
			$this->tpl->set_var("BacktaxesTableBlock", "");
		}
		else{
			//echo $xmlStr;
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_block("rptsTemplate", "BacktaxesTable", "BacktaxesTableBlock");
				$this->tpl->set_var("BacktaxesTableBlock", "");
			}
			else {
				$backtaxTDRecords = new BacktaxTDRecords;
				$backtaxTDRecords->parseDomDocument($domDoc);

				$backTaxTDList = $backtaxTDRecords->getArrayList();
				$this->tpl->set_block("rptsTemplate", "BacktaxesList", "BacktaxesListBlock");
				$this->tpl->set_block("rptsTemplate", "BacktaxesDBEmpty", "BacktaxesDBEmptyBlock");
				if(count($backTaxTDList)){
					$this->tpl->set_var("BacktaxesDBEmptyBlock", "");
					foreach ($backTaxTDList as $key => $val){
						$this->tpl->set_var("backtaxTDID", $val->getBacktaxTDID());
						$this->tpl->set_var("tdNumber", $val->getTdNumber());
						$this->tpl->set_var("startYear", $val->getStartYear());
						$this->tpl->set_var("endYear", $val->getEndYear());
						$this->tpl->set_var("startQuarter", $val->getStartQuarter());
						$this->tpl->set_var("assessedValue", number_format($val->getAssessedValue(),2));
						$this->tpl->set_var("basicRate", number_format($val->getBasicRate(),2));
						$this->tpl->set_var("sefRate", number_format($val->getSEFRate(),2));
						$this->tpl->set_var("basicTax", number_format($val->getBasicTax(),2));
						$this->tpl->set_var("sefTax", number_format($val->getSEFTax(),2));
						$this->tpl->set_var("idleTax", number_format($val->getIdleTax(),2));
						$this->tpl->set_var("penalties", number_format($val->getPenalties(),2));
						$this->tpl->set_var("paid", number_format($val->getPaid(),2));
						$this->tpl->set_var("balance", number_format($val->getBalance(),2));
						$this->tpl->set_var("total", number_format($val->getTotal(),2));
						$totalBacktaxesDue = 0;
						$totalBacktaxesDue += $val->getBasicTax();
						$totalBacktaxesDue += $val->getSefTax();
						$totalBacktaxesDue += $val->getIdleTax();
						$totalBacktaxesDue += $val->getPenalties();
					$this->tpl->parse("BacktaxesListBlock", "BacktaxesList", true);
					}
				}
				else{
					$this->tpl->set_var("BacktaxesListBlock", "");
				}
				$this->tpl->set_var("total", number_format($totalBacktaxesDue,2));
			}
		}
	}

	function displayTD($afsID){
		$this->tpl->set_block("rptsTemplate", "TDTable", "TDTableBlock");
		$this->tpl->set_block("rptsTemplate", "TDDBEmpty", "TDDBEmptyBlock");

		$TDDetails = new SoapObject(NCCBIZ."TDDetails.php", "urn:Object");
		if (!$xmlStr = $TDDetails->getTDFromAfsID($this->formArray["afsID"])){
			$this->tpl->set_var("tdID", "");
			$this->tpl->set_var("TDTableBlock", "");
			$this->tpl->parse("TDDBEmptyBlock", "TDDBEmpty", true);
		}
		else{
			//echo $xmlStr;
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_var("tdID", "");
				$this->tpl->set_var("TDTableBlock", "");
				$this->tpl->parse("TDDBEmptyBlock", "TDDBEmpty", true);
			}
			else {
				$td = new TD;
				$td->parseDomDocument($domDoc);

				// update Cancels/CanceledBy TDNumber

				$td = $this->updateTDCancelsTDNumber($td);
				$td = $this->updateTDCanceledByTDNumber($td);
				
				$this->formArray["tdID"] = $td->tdID;
				$this->formArray["taxDeclarationNumber"] = $td->taxDeclarationNumber;

				//provincialAssessor
				if(is_numeric($td->provincialAssessor)){
					$provincialAssessor = new Person;
					$provincialAssessor->selectRecord($td->provincialAssessor);
					$this->formArray["provincialAssessor"] = $provincialAssessor->getFullName();
				}
				else{
					$this->formArray["provincialAssessor"] = $td->provincialAssessor;
				}

				//provincialAssessorDate
				if($td->provincialAssessorDate){
					list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$td->provincialAssessorDate);
					
					$this->formArray["pa_yearValue"] = removePreZero($dateArr["year"]);
					eval(MONTH_ARRAY); //$monthArray
					$this->formArray["pa_month"] = $monthArray[removePreZero($dateArr["month"])];

					$this->formArray["pa_dayValue"] = removePreZero($dateArr["day"]);
				}
				else {
					$this->formArray["pa_yearValue"] = "";
					$this->formArray["pa_month"] = "";
					$this->formArray["pa_dayValue"] = "";
				}

				//cityMunicipalAssessor
				if(is_numeric($td->cityMunicipalAssessor)){
					$cityMunicipalAssessor = new Person;
					$cityMunicipalAssessor->selectRecord($td->cityMunicipalAssessor);
					$this->formArray["cityMunicipalAssessor"] = $cityMunicipalAssessor->getFullName();
				}
				else{
					$this->formArray["cityMunicipalAssessor"] = $td->cityMunicipalAssessor;
				}

				//cityMunicipalAssessorDate
				if($td->cityMunicipalAssessorDate){
					list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$td->cityMunicipalAssessorDate);
					
					$this->formArray["cm_yearValue"] = removePreZero($dateArr["year"]);
					eval(MONTH_ARRAY); //$monthArray
					$this->formArray["cm_month"] = $monthArray[removePreZero($dateArr["month"])];

					$this->formArray["cm_dayValue"] = removePreZero($dateArr["day"]);
				}
				else {
					$this->formArray["cm_yearValue"] = "";
					$this->formArray["cm_month"] = "";
					$this->formArray["cm_dayValue"] = "";
				}

				$this->formArray["cancelsTDNumber"] = $td->cancelsTDNumber;
				$this->formArray["canceledByTDNumber"] = $td->canceledByTDNumber;
				$this->formArray["taxBeginsWithTheYear"] = $td->taxBeginsWithTheYear;
				$this->formArray["ceasesWithTheYear"] = $td->ceasesWithTheYear;

				//enteredInRPARForBy
				if(is_numeric($td->enteredInRPARForBy)){
					$enteredInRPARForBy = new Person;
					$enteredInRPARForBy->selectRecord($td->enteredInRPARForBy);
					$this->formArray["enteredInRPARForBy"] = $enteredInRPARForBy->getFullName();
				}
				else{
					$this->formArray["enteredInRPARForBy"] = $td->enteredInRPARForBy;
				}

				$this->formArray["enteredInRPARForYear"] = $td->enteredInRPARForYear;
				$this->formArray["previousOwner"] = $td->previousOwner;
				$this->formArray["previousAssessedValue"] = $td->previousAssessedValue;

				$this->tpl->set_var("TDDBEmptyBlock", "");
				$this->tpl->parse("TDTableBlock", "TDTable", true);
			}
		}
	}

	function hideProperty($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar, $TempVar."Block");
		$this->tpl->set_var($TempVar."Block", "");

		$this->tpl->set_block("rptsTemplate", "default".$TempVar."List", "default".$TempVar."ListBlock");
		$this->tpl->set_var("default".$TempVar."ListBlock", "");

		$this->tpl->set_block("rptsTemplate", "toggle".$TempVar."List", "toggle".$TempVar."ListBlock");
		$this->tpl->set_var("toggle".$TempVar."ListBlock", "");
		$this->tpl->set_var($tempVar."Ctr", 0);

		$this->tpl->set_block("rptsTemplate", $TempVar."Totals", $TempVar."TotalsBlock");
		$this->tpl->set_var($TempVar."TotalsBlock", "");

		$this->formArray[$tempVar."TotalMarketValue"] = 0;
		$this->formArray[$tempVar."TotalAssessedValue"] = 0;

	}

	function displayLandPlantsTrees($landList,$plantsTreesList){
		//land
		if(count($landList)){
			$this->displayLandList($landList);
		}
		else{
			$this->tpl->set_var("landCtr", 0);
			$this->tpl->set_block("rptsTemplate", "defaultLandList", "defaultLandListBlock");
			$this->tpl->set_var("defaultLandListBlock", "");
			$this->tpl->set_block("rptsTemplate", "toggleLandList", "toggleLandListBlock");
			$this->tpl->set_var("toggleLandListBlock", "");
			$this->tpl->set_block("rptsTemplate", "LandList", "LandListBlock");
			$this->tpl->set_var("LandListBlock", "");
		}

		//plantsTrees
		if(count($plantsTreesList)){
			$this->displayPlantsTreesList($plantsTreesList);
		}
		else{
			$this->tpl->set_var("plantsTreesCtr", 0);
			$this->tpl->set_block("rptsTemplate", "defaultPlantsTreesList", "defaultPlantsTreesListBlock");
			$this->tpl->set_var("defaultPlantsTreesListBlock", "");
			$this->tpl->set_block("rptsTemplate", "togglePlantsTreesList", "togglePlantsTreesListBlock");
			$this->tpl->set_var("togglePlantsTreesListBlock", "");
			$this->tpl->set_block("rptsTemplate", "PlantsTreesList", "PlantsTreesListBlock");
			$this->tpl->set_var("PlantsTreesListBlock", "");
		}
	}

	function displayImprovementsBuildingsMachineries($improvementsBuildingsList,$machineriesList){
		//improvementsBuildings
		if(count($improvementsBuildingsList)){
			$this->displayImprovementsBuildingsList($improvementsBuildingsList);
		}
		else{
			$this->tpl->set_var("improvementsBuildingsCtr", 0);
			$this->tpl->set_block("rptsTemplate", "defaultImprovementsBuildingsList", "defaultImprovementsBuildingsListBlock");
			$this->tpl->set_var("defaultImprovementsBuildingsListBlock", "");
			$this->tpl->set_block("rptsTemplate", "toggleImprovementsBuildingsList", "toggleImprovementsBuildingsListBlock");
			$this->tpl->set_var("toggleImprovementsBuildingsListBlock", "");
			$this->tpl->set_block("rptsTemplate", "ImprovementsBuildingsList", "ImprovementsBuildingsListBlock");
			$this->tpl->set_var("ImprovementsBuildingsListBlock", "");
		}
				
		//machineries
		if(count($machineriesList)){
			$this->displayMachineriesList($machineriesList);
		}
		else{
			$this->tpl->set_var("machineriesCtr", 0);
			$this->tpl->set_block("rptsTemplate", "defaultMachineriesList", "defaultMachineriesListBlock");
			$this->tpl->set_var("defaultMachineriesListBlock", "");
			$this->tpl->set_block("rptsTemplate", "toggleMachineriesList", "toggleMachineriesListBlock");
			$this->tpl->set_var("toggleMachineriesListBlock", "");
			$this->tpl->set_block("rptsTemplate", "MachineriesList", "MachineriesListBlock");
			$this->tpl->set_var("MachineriesListBlock", "");
		}
	}

	function displayDetails($value){
        //print_r($value);
		foreach($value as $lkey => $lvalue){
			switch ($lkey){
				case "propertyAdministrator":
					if (is_a($lvalue,Person)){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue->getBirthday());
						$this->tpl->set_var("personID", $lvalue->getPersonID());
						$this->tpl->set_var("lastName", $lvalue->getLastName());
						$this->tpl->set_var("firstName", $lvalue->getFirstName());
						$this->tpl->set_var("middleName", $lvalue->getMiddleName());
						$this->tpl->set_var("gender", $lvalue->getGender());
						$this->tpl->set_var("birth_year", removePreZero($dateArr["year"]));
						$this->tpl->set_var("birth_month", removePreZero($dateArr["month"]));
						$this->tpl->set_var("birth_day", removePreZero($dateArr["day"]));
						$this->tpl->set_var("maritalStatus", $lvalue->getMaritalStatus());
						$this->tpl->set_var("tin", $lvalue->getTin());
						if (is_a($lvalue->addressArray[0],"address")){
						$this->tpl->set_var("addressID", $lvalue->addressArray[0]->getAddressID());
						$this->tpl->set_var("number", $lvalue->addressArray[0]->getNumber());
						$this->tpl->set_var("street", $lvalue->addressArray[0]->getStreet());
						$this->tpl->set_var("barangay", $lvalue->addressArray[0]->getBarangay());
						$this->tpl->set_var("district", $lvalue->addressArray[0]->getDistrict());
						$this->tpl->set_var("municipalityCity", $lvalue->addressArray[0]->getMunicipalityCity());
						$this->tpl->set_var("province", $lvalue->addressArray[0]->getProvince());
						}
						$this->tpl->set_var("telephone", $lvalue->getTelephone());
						$this->tpl->set_var("mobileNumber", $lvalue->getMobileNumber());
						$this->tpl->set_var("email", $lvalue->getEmail());
					}
					else {
						$this->tpl->set_var($lkey, "");
					}
				break;
				case "verifiedBy":
					if(is_numeric($lvalue))
					{
						$verifiedBy = new Person;
						$verifiedBy->selectRecord($lvalue);
						$this->tpl->set_var("verifiedByID", $verifiedBy->getPersonID());
						$this->tpl->set_var("verifiedByName", $verifiedBy->getFullName());
					}
					else{
						$verifiedBy = $lvalue;
						$this->tpl->set_var("verifiedByID", $verifiedBy);
						$this->tpl->set_var("verifiedByName", $verifiedBy);
					}
				break;
				case "plottingsBy":
					if(is_numeric($lvalue))
					{
						$plottingsBy = new Person;
						$plottingsBy->selectRecord($lvalue);
						$this->tpl->set_var("plottingsByID", $plottingsBy->getPersonID());
						$this->tpl->set_var("plottingsByName", $plottingsBy->getFullName());
					}
					else{
						$plottingsBy = $lvalue;
						$this->tpl->set_var("plottingsByID", $plottingsBy);
						$this->tpl->set_var("plottingsByName", $plottingsBy);
					}
				break;
				case "notedBy":
					if(is_numeric($lvalue))
					{
						$notedBy = new Person;
						$notedBy->selectRecord($lvalue);
						$this->tpl->set_var("notedByID", $notedBy->getPersonID());
						$this->tpl->set_var("notedByName", $notedBy->getFullName());
					}
					else{
						$notedBy = $lvalue;
						$this->tpl->set_var("notedByID", $notedBy);
						$this->tpl->set_var("notedByName", $notedBy);
					}
				break;
				case "appraisedBy":
					if(is_numeric($lvalue))
					{
						$appraisedBy = new Person;
						$appraisedBy->selectRecord($lvalue);
						$this->tpl->set_var("appraisedByID", $appraisedBy->getPersonID());
						$this->tpl->set_var("appraisedByName", $appraisedBy->getFullName());
					}
					else{
						$appraisedBy = $lvalue;
						$this->tpl->set_var("appraisedByID", $appraisedBy);
						$this->tpl->set_var("appraisedByName", $appraisedBy);
					}
				break;
				case "appraisedByDate":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("as_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("as_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("as_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->tpl->set_var("as_yearValue", "");
						$this->tpl->set_var("as_month", "");
						$this->tpl->set_var("as_dayValue", "");
					}
				break;
				case "recommendingApproval":
					if(is_numeric($lvalue))
					{
						$recommendingApproval = new Person;
						$recommendingApproval->selectRecord($lvalue);
						$this->tpl->set_var("recommendingApprovalID", $recommendingApproval->getPersonID());
						$this->tpl->set_var("recommendingApprovalName", $recommendingApproval->getFullName());
					}
					else{
						$recommendingApproval = $lvalue;
						$this->tpl->set_var("recommendingApprovalID", $recommendingApproval);
						$this->tpl->set_var("recommendingApprovalName", $recommendingApproval);
					}
				break;
				case "recommendingApprovalDate":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("re_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("re_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("re_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->tpl->set_var("re_yearValue", "");
						$this->tpl->set_var("re_month", "");
						$this->tpl->set_var("re_dayValue", "");
					}
				break;
				case "approvedBy":
					if(is_numeric($lvalue))
					{
						$approvedBy = new Person;
						$approvedBy->selectRecord($lvalue);
						$this->tpl->set_var("approvedByID", $approvedBy->getPersonID());
						$this->tpl->set_var("approvedByName", $approvedBy->getFullName());
					}
					else {
						$approvedBy = $lvalue;
						$this->tpl->set_var("approvedByID", $approvedBy);
						$this->tpl->set_var("approvedByName", $approvedBy);
					}
				break;
				case "approvedByDate":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("av_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("av_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("av_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->tpl->set_var("av_yearValue", "");
						$this->tpl->set_var("av_month", "");
						$this->tpl->set_var("av_dayValue", "");
				}
				break;
				case "dateConstructed":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("dc_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("dc_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("dc_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				case "dateOccupied":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("do_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("do_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("do_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				case "dateCompleted":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("dm_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("dm_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("dm_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				case "dateAcquired":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("da_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("da_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("da_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				case "dateOfInstallation":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("di_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("di_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("di_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				case "dateOfOperation":
					if (true){
						list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$lvalue);
						$this->tpl->set_var("do_yearValue", removePreZero($dateArr["year"]));
						eval(MONTH_ARRAY);//$monthArray
						$this->tpl->set_var("do_month", $monthArray[removePreZero($dateArr["month"])]);
						$this->tpl->set_var("do_dayValue", removePreZero($dateArr["day"]));
					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				case "propertyID":
					if (true){
						//echo $lvalue."=>".get_class($value)."<br>";
						switch (get_class($value)){
							case "land":
								$propertyType = "Land";
							break;
							case "improvementsbuildings":
								$propertyType = "ImprovementsBuildings";
							break;
							case "plantstrees":
								$propertyType = "PlantsTrees";
							break;
							case "machineries":
								$propertyType = "Machineries";
							break;
						}
						$this->tpl->set_var($lkey,$lvalue);

					}
					else {
						$this->formArray[$key] = "";
					}
				break;
				case "arpNumber":
					$lvalue = ($lvalue) ? $lvalue : "";
					$this->tpl->set_var($lkey,$lvalue);
				break;
				case "adjustedMarketValue":
				case "valueAdjustment":
				case "marketValue":
					$this->tpl->set_var($lkey, number_format($lvalue, 2, '.', ','));
				break;
				default:
					if ($lkey <> "") {
						eval('$tmpval = $value->get'.ucfirst($lkey).'();');
						//echo '$tmpval = $value->get'.ucfirst($lkey).'();<br>';
						$this->tpl->set_var($lkey,$tmpval);
					}
			}				
		}
	}
	function displayLandList($landList){
		$this->tpl->set_block("rptsTemplate", "LandDBEmpty", "LandDBEmptyBlock");
		$this->tpl->set_var("LandDBEmptyBlock", "");
		$this->tpl->set_block("rptsTemplate", "defaultLandList", "defaultLandListBlock");
		$this->tpl->set_block("rptsTemplate", "toggleLandList", "toggleLandListBlock");
		//echo $this->formArray["totalMarketValue"];
        if (count($landList)){
			//$this->tpl->set_block("rptsTemplate", "hideLandList", "hideLandListBlock");
			$this->tpl->set_block("rptsTemplate", "LandList", "LandListBlock");
			$i = 0;
			$totalMarketValue = 0;
			$totalAssessedValue = 0;
			foreach ($landList as $key => $value){
				$totalMarketValue += tofloat($value->getAdjustedMarketValue());
				$totalAssessedValue += tofloat($value->getAssessedValue());
				$this->displayDetails($value);
				foreach($value as $lkey => $lvalue){
					if(is_numeric($lvalue)){
						switch($lkey){
							case "classification":
								$landClasses = new LandClasses;
								$landClasses->selectRecord($lvalue);
								$this->tpl->set_var("classification", $landClasses->getDescription());
								break;
							case "subClass":
								$landSubclasses = new LandSubclasses;
								$landSubclasses->selectRecord($lvalue);
								$this->tpl->set_var("subClass", $landSubclasses->getDescription());
								break;
							case "actualUse":
								$landActualUses = new LandActualUses;
								$landActualUses->selectRecord($lvalue);
								$this->tpl->set_var("actualUse", $landActualUses->getDescription());
								break;
						}
					}
				}

				$this->tpl->set_var("ctr",$i);
				$this->tpl->parse("defaultLandListBlock", "defaultLandList", true);
				$this->tpl->parse("toggleLandListBlock", "toggleLandList", true);
				//$this->tpl->parse("hideLandListBlock", "hideLandList", true);

				$this->setLandListBlockPerms();
				$this->tpl->parse("LandListBlock", "LandList", true);
				$i++;
			}
			$this->formArray["totalMarketValue"] += $totalMarketValue;
			$this->formArray["totalAssessedValue"] += $totalAssessedValue;
			$this->formArray["landTotalMarketValue"] = $totalMarketValue;
			$this->formArray["landTotalAssessedValue"] = $totalAssessedValue;
			$this->tpl->set_var("landCtr", $i);
		}
		else {
			$this->tpl->set_var("defaultLandListBlock", "");
			$this->tpl->set_var("toggleLandListBlock", "");
		}
	}
	
	function displayPlantsTreesList($plantsTreesList){
		$this->tpl->set_block("rptsTemplate", "PlantsTreesDBEmpty", "PlantsTreesDBEmptyBlock");
		$this->tpl->set_var("PlantsTreesDBEmptyBlock", "");
		$this->tpl->set_block("rptsTemplate", "defaultPlantsTreesList", "defaultPlantsTreesListBlock");
		$this->tpl->set_block("rptsTemplate", "togglePlantsTreesList", "togglePlantsTreesListBlock");
		if (count($plantsTreesList)){
			//$this->tpl->set_block("rptsTemplate", "hidePlantsTreesList", "hidePlantsTreesListBlock");
			$this->tpl->set_block("rptsTemplate", "PlantsTreesList", "PlantsTreesListBlock");
			$i = 0;
			$totalMarketValue = 0;
			$totalAssessedValue = 0;
			foreach ($plantsTreesList as $key => $value){
				$totalMarketValue += tofloat($value->getAdjustedMarketValue());
				$totalAssessedValue += tofloat($value->getAssessedValue());
				$this->displayDetails($value);

				foreach($value as $lkey => $lvalue){
					if(is_numeric($lvalue)){
						switch($lkey){
							case "productClass":
								$plantsTreesClasses = new PlantsTreesClasses;
								$plantsTreesClasses->selectRecord($lvalue);
								$this->tpl->set_var("productClass", $plantsTreesClasses->getDescription());
								break;
							case "actualUse":
								$plantsTreesActualUses = new PlantsTreesActualUses;
								$plantsTreesActualUses->selectRecord($lvalue);
								$this->tpl->set_var("actualUse", $plantsTreesActualUses->getDescription());
								break;
						}
					}
				}

				$this->tpl->set_var("ctr",$i);
				$this->tpl->parse("defaultPlantsTreesListBlock", "defaultPlantsTreesList", true);
				$this->tpl->parse("togglePlantsTreesListBlock", "togglePlantsTreesList", true);
				//$this->tpl->parse("hidePlantsTreesListBlock", "hidePlantsTreesList", true);

				$this->setPlantsTreesListBlockPerms();
				$this->tpl->parse("PlantsTreesListBlock", "PlantsTreesList", true);
				$i++;
			}
			$this->formArray["totalMarketValue"] += $totalMarketValue;
			$this->formArray["totalAssessedValue"] += $totalAssessedValue;
			$this->formArray["plantTotalMarketValue"] = $totalMarketValue;
			$this->formArray["plantTotalAssessedValue"] = $totalAssessedValue;
			$this->tpl->set_var("plantsTreesCtr", $i);
		}
		else {
			$this->tpl->set_var("defaultPlantsTreesListBlock", "");
			$this->tpl->set_var("togglePlantsTreesListBlock", "");
		}
	}
	
	function displayImprovementsBuildingsList($improvementsBuildingsList){
		$this->tpl->set_block("rptsTemplate", "ImprovementsBuildingsDBEmpty", "ImprovementsBuildingsDBEmptyBlock");
		$this->tpl->set_var("ImprovementsBuildingsDBEmptyBlock", "");
		$this->tpl->set_block("rptsTemplate", "defaultImprovementsBuildingsList", "defaultImprovementsBuildingsListBlock");
		$this->tpl->set_block("rptsTemplate", "toggleImprovementsBuildingsList", "toggleImprovementsBuildingsListBlock");
		if (count($improvementsBuildingsList)){
			//$this->tpl->set_block("rptsTemplate", "hideImprovementsBuildingsList", "hideImprovementsBuildingsListBlock");
			$this->tpl->set_block("rptsTemplate", "ImprovementsBuildingsList", "ImprovementsBuildingsListBlock");
			$i = 0;
			$totalMarketValue = 0;
			$totalAssessedValue = 0;
			foreach ($improvementsBuildingsList as $key => $value){
				$totalMarketValue += tofloat($value->getAdjustedMarketValue());
				$totalAssessedValue += tofloat($value->getAssessedValue());
				$this->displayDetails($value);

				foreach($value as $lkey => $lvalue){
					if(is_numeric($lvalue)){
						switch($lkey){
							case "buildingClassification":
								$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
								$improvementsBuildingsClasses->selectRecord($lvalue);
								$this->tpl->set_var("buildingClassification", $improvementsBuildingsClasses->getDescription());
								break;
							case "actualUse":
								$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
								$improvementsBuildingsActualUses->selectRecord($lvalue);
								$this->tpl->set_var("actualUse", $improvementsBuildingsActualUses->getDescription());
								break;
						}
					}
				}

				$this->tpl->set_var("ctr",$i);
				$this->tpl->parse("defaultImprovementsBuildingsListBlock", "defaultImprovementsBuildingsList", true);
				$this->tpl->parse("toggleImprovementsBuildingsListBlock", "toggleImprovementsBuildingsList", true);
				//$this->tpl->parse("hideImprovementsBuildingsListBlock", "hideImprovementsBuildingsList", true);

				$this->setImprovementsBuildingsListBlockPerms();
				$this->tpl->parse("ImprovementsBuildingsListBlock", "ImprovementsBuildingsList", true);
				$i++;
			}
				$this->formArray["totalMarketValue"] += $totalMarketValue;
				$this->formArray["totalAssessedValue"] += $totalAssessedValue;
				$this->formArray["bldgTotalMarketValue"] = $totalMarketValue;
				$this->formArray["bldgTotalAssessedValue"] = $totalAssessedValue;
				$this->tpl->set_var("improvementsBuildingsCtr", $i);
		}
		else {
			$this->tpl->set_var("defaultImprovementsBuildingsListBlock", "");
			$this->tpl->set_var("toggleImprovementsBuildingsListBlock", "");
		}
	}
	
	function displayMachineriesList($machineriesList){
		$this->tpl->set_block("rptsTemplate", "MachineriesDBEmpty", "MachineriesDBEmptyBlock");
		$this->tpl->set_var("MachineriesDBEmptyBlock", "");
		$this->tpl->set_block("rptsTemplate", "defaultMachineriesList", "defaultMachineriesListBlock");
		$this->tpl->set_block("rptsTemplate", "toggleMachineriesList", "toggleMachineriesListBlock");
		if (count($machineriesList)){
			//$this->tpl->set_block("rptsTemplate", "hideMachineriesList", "hideMachineriesListBlock");
			$this->tpl->set_block("rptsTemplate", "MachineriesList", "MachineriesListBlock");
			$i = 0;
			$totalMarketValue = 0;
			$totalAssessedValue = 0;
			foreach ($machineriesList as $key => $value){
				$totalMarketValue += tofloat($value->getAdjustedMarketValue());
				$totalAssessedValue += tofloat($value->getAssessedValue());
				$this->displayDetails($value);

				foreach($value as $lkey => $lvalue){
					if(is_numeric($lvalue)){
						switch($lkey){
							//case "kind":
							//	$machineriesClasses = new MachineriesClasses;
							//	$machineriesClasses->selectRecord($lvalue);
							//	$this->tpl->set_var("kind", $machineriesClasses->getDescription());
							//	break;
							case "actualUse":
								$machineriesActualUses = new MachineriesActualUses;
								$machineriesActualUses->selectRecord($lvalue);
								$this->tpl->set_var("actualUse", $machineriesActualUses->getDescription());
								break;
						}
					}
				}

				$this->tpl->set_var("ctr",$i);
				$this->tpl->parse("defaultMachineriesListBlock", "defaultMachineriesList", true);
				$this->tpl->parse("toggleMachineriesListBlock", "toggleMachineriesList", true);
				//$this->tpl->parse("hideMachineriesListBlock", "hideMachineriesList", true);

				$this->setMachineriesListBlockPerms();
				$this->tpl->parse("MachineriesListBlock", "MachineriesList", true);
				$i++;
			}
			$this->formArray["totalMarketValue"] += $totalMarketValue;
			$this->formArray["totalAssessedValue"] += $totalAssessedValue;
			$this->formArray["machTotalMarketValue"] = $totalMarketValue;
			$this->formArray["machTotalAssessedValue"] = $totalAssessedValue;
			$this->tpl->set_var("machineriesCtr", $i);
		}
		else {
			$this->tpl->set_var("defaultMachineriesListBlock", "");
			$this->tpl->set_var("toggleMachineriesListBlock", "");
		}
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "remove":
				if (count($this->formArray["landID"])) {
					//print_r($this->formArray["landID"]);
					$LandList = new SoapObject(NCCBIZ."LandList.php", "urn:Object");
					if (!$deletedRows = $LandList->removeLand($this->formArray["landID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				if (count($this->formArray["plantsTreesID"])) {
					//print_r($this->formArray["plantsTreesID"]);
					$PlantsTreesList = new SoapObject(NCCBIZ."PlantsTreesList.php", "urn:Object");
					if (!$deletedRows = $PlantsTreesList->removePlantsTrees($this->formArray["plantsTreesID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				if (count($this->formArray["machineriesID"])) {
					//print_r($this->formArray["machineriesID"]);
					$MachineriesList = new SoapObject(NCCBIZ."MachineriesList.php", "urn:Object");
					if (!$deletedRows = $MachineriesList->removeMachineries($this->formArray["machineriesID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				if (count($this->formArray["improvementsBuildingsID"])) {
					//print_r($this->formArray["improvementsBuildingsID"]);
					$ImprovementsBuildingsList = new SoapObject(NCCBIZ."ImprovementsBuildingsList.php", "urn:Object");
					if (!$deletedRows = $ImprovementsBuildingsList->removeImprovementsBuildings($this->formArray["improvementsBuildingsID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				if (count($this->formArray["storeyID"])) {
					//print_r($this->formArray["storeyID"]);
					$StoreyList = new SoapObject(NCCBIZ."StoreyList.php", "urn:Object");
					if (!$deletedRows = $StoreyList->removeStorey($this->formArray["storeyID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				header("location: BacktaxesAFSDetails.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
				exit;
				break;
			case "delBacktax":
				if (count($this->formArray["backtaxTDID"])) {
					//print_r($this->formArray["backtaxTDID"]);
					$BacktaxTDEncode = new SoapObject(NCCBIZ."BacktaxTDEncode.php", "urn:Object");
					if (!$deletedRows = $BacktaxTDEncode->deleteBacktax($this->formArray["backtaxTDID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				header("location: BacktaxesAFSDetails.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
		}
		$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
		if (!$xmlStr = $AFSDetails->getAFS($this->formArray["afsID"])){
			$this->tpl->set_block("rptsTemplate", "AFSTable", "AFSTableBlock");
			$this->tpl->set_var("AFSTableBlock", "afs not found");
		}
		else{
			//echo $xmlStr;
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
				$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
			}
			else {
				$afs = new AFS;
				$afs->parseDomDocument($domDoc);
				//print_r($afs);

				foreach($afs as $key => $value){
					$this->formArray[$key] = $value;
                    $this->formArray["totalMarketValue"] = 0;
                    $this->formArray["totalAssessedValue"] = 0;
                }

				// RPU Identification Numbers

				$this->displayRPUIdentification($afs);

				$landList = $afs->getLandArray();
				$plantsTreesList = $afs->getPlantsTreesArray();
				$improvementsBuildingsList = $afs->getImprovementsBuildingsArray();
				$machineriesList = $afs->getMachineriesArray();

				if(count($landList)){
					$hideTD = false;
					$this->formArray["propertyType"] = "Land";
					$this->displayLandPlantsTrees($landList,$plantsTreesList);
					$this->hideProperty('ImprovementsBuildings', 'improvementsBuildings');
					$this->hideProperty('Machineries', 'machineries');
				}
				else if(count($plantsTreesList)){
					$hideTD = false;
					$this->formArray["propertyType"] = "Land";
					$this->displayLandPlantsTrees($landList,$plantsTreesList);
					$this->hideProperty('ImprovementsBuildings', 'improvementsBuildings');
					$this->hideProperty('Machineries', 'machineries');
			    }
				else if(count($improvementsBuildingsList)){
					$hideTD = false;
					$this->formArray["propertyType"] = "ImprovementsBuildings";
					$this->displayImprovementsBuildingsMachineries($improvementsBuildingsList,$machineriesList);
					$this->hideProperty('Land', 'land');
					$this->hideProperty('PlantsTrees', 'plantsTrees');
				}
				else if(count($machineriesList)){
					$hideTD = false;
					$this->formArray["propertyType"] = "Machineries";
					$this->displayImprovementsBuildingsMachineries($improvementsBuildingsList,$machineriesList);
					$this->hideProperty('Land', 'land');
					$this->hideProperty('PlantsTrees', 'plantsTrees');
				}
				else{
					$hideTD = true;
					$this->displayLandPlantsTrees($landList,$plantsTreesList);
					$this->displayImprovementsBuildingsMachineries($improvementsBuildingsList,$machineriesList);

					$this->formArray["landTotalMarketValue"] = 0;
					$this->formArray["landTotalAssessedValue"] = 0;
					$this->formArray["plantTotalMarketValue"] = 0;
					$this->formArray["plantTotalAssessedValue"] = 0;
					$this->formArray["bldgTotalMarketValue"] = 0;
					$this->formArray["bldgTotalAssessedValue"] = 0;
					$this->formArray["machTotalMarketValue"] = 0;
					$this->formArray["machTotalAssessedValue"] = 0;
				}

				if($hideTD==false){
					// Display TD
					$this->displayTD($afs->afsID);
					$this->displayBacktaxTD();
				}
				else{
					// Hide TD
					$this->tpl->set_block("rptsTemplate", "DeclarationOfProperty", "DeclarationOfPropertyBlock");
					$this->tpl->set_var("DeclarationOfPropertyBlock", "");
				}

				$ODDetails = new SoapObject(NCCBIZ."ODDetails.php", "urn:Object");
				if (!$xmlStr = $ODDetails->getOD($this->formArray["odID"])){
					exit("xml failed");
				}
				else{
					//echo $xmlStr;
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
						$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
					}
					else {
						$od = new OD;
						$od->parseDomDocument($domDoc);
						foreach($od as $key => $value){
							if ($key == "locationAddress"&&is_object($value)){
								foreach($value as $lkey => $lvalue){
									$this->formArray[$lkey] = $lvalue;
								}
							}
							else $this->formArray[$key] = $value;
						}
						
						$ODEncode = new SoapObject(NCCBIZ."ODEncode.php", "urn:Object");
						$this->formArray["ownerID"] = $ODEncode->getOwnerID($this->formArray["odID"]);
						$OwnerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");
						if (!$xmlStr = $OwnerList->getOwnerList($this->formArray["ownerID"])){
							//exit(print_r($OwnerList));
							$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
							$this->tpl->set_var("OwnerListTableBlock", "");
						}
						else {
							if(!$domDoc = domxml_open_mem($xmlStr)) {
								$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
								$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
							}
							else {
								$this->displayOwnerList($domDoc);
							}
						}
					}	
				}
			}
		}

		$AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
		$afs = new AFS;

		$afs->selectRecord($this->formArray["afsID"]);

		$afs->setAfsID($this->formArray["afsID"]);
		$afs->setLandTotalMarketValue($this->formArray["landTotalMarketValue"]);
		$afs->setLandTotalAssessedValue($this->formArray["landTotalAssessedValue"]);
		$afs->setPlantTotalMarketValue($this->formArray["plantTotalMarketValue"]);
		$afs->setPlantTotalPlantAssessedValue($this->formArray["plantTotalAssessedValue"]);
		$afs->setBldgTotalMarketValue($this->formArray["bldgTotalMarketValue"]);
		$afs->setBldgTotalAssessedValue($this->formArray["bldgTotalAssessedValue"]);
		$afs->setMachTotalMarketValue($this->formArray["machTotalMarketValue"]);
		$afs->setMachTotalAssessedValue($this->formArray["machTotalAssessedValue"]);
		$afs->setTotalMarketValue($this->formArray["totalMarketValue"]);
		$afs->setTotalAssessedValue($this->formArray["totalAssessedValue"]);
		$afs->setDomDocument();
		$doc = $afs->getDomDocument();
		$xmlStr =  $doc->dump_mem(true);
		//print_r($AFSEncode);
		//echo $xmlStr;
		if (!$ret = $AFSEncode->updateAFS($xmlStr)){
			echo("ret=".$ret);
		}
		//echo $ret;
		$this->setForm();
		$this->setPageDetailPerms();

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
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
//exit($formAction);
$ownerList = new AFSDetails($HTTP_POST_VARS,$sess,$afsID,$type);
$ownerList->main();
?>
<?php page_close(); ?>
