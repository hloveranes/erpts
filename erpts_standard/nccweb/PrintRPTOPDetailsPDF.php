<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

include_once "../includes/web/clibPDFWriter.php";

include_once "../includes/assessor/Barangay.php";

include_once "../includes/assessor/Address.php";

include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/LocationAddress.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/OD.php";

include_once "../includes/assessor/LandClasses.php";
include_once "../includes/assessor/LandSubclasses.php";
include_once "../includes/assessor/LandActualUses.php";

include_once "../includes/assessor/PlantsTreesClasses.php";
include_once "../includes/assessor/PlantsTreesActualUses.php";
include_once "../includes/assessor/ImprovementsBuildingsClasses.php";
include_once "../includes/assessor/ImprovementsBuildingsActualUses.php";
include_once "../includes/assessor/MachineriesClasses.php";
include_once "../includes/assessor/MachineriesActualUses.php";

include_once "../includes/assessor/eRPTSSettings.php";

include_once "../includes/collection/Due.php";

#####################################
# Define Interface Class
#####################################
class PrintRPTOPDetailsPDF{
	
	var $tpl;
	var $formArray;
	function PrintRPTOPDetailsPDF($http_post_vars,$sess,$rptopID){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "rptopDetails.xml") ;
		
		$this->tpl->set_var("TITLE", "Print RPTOP");

		$this->formArray["rptopID"] = $rptopID;
		
       	$this->formArray = array(
			"rptopID" => $rptopID

			, "rptopNumber" => ""

			, "lguType" => ""
			, "lguName" => ""

			,"province" => ""
			,"municipalityCity" => ""
			,"owner" => ""

			,"address1" => ""
			,"address2" => ""

			,"year" => ""

			,"arpNumber1" => ""
			,"arpNumber1a" => ""
			,"arpNumber1b" => ""
			,"pin1" => ""
			,"pin1a" => ""
			,"pin1b" => ""
			,"location1" => ""
			,"location1a" => ""
			,"location1b" => ""
			,"classification1" => ""
			,"area1" => ""
			,"lotNo1" => ""
			,"marketValue1" => ""
			,"assessedValue1" => ""
			,"basic1" => ""
			,"sef1" => ""
			,"totalTax1" => ""

			,"arpNumber2" => ""
			,"arpNumber2a" => ""
			,"arpNumber2b" => ""
			,"pin2" => ""
			,"pin2a" => ""
			,"pin2b" => ""
			,"location2" => ""
			,"location2a" => ""
			,"location2b" => ""
			,"classification2" => ""
			,"area2" => ""
			,"lotNo2" => ""
			,"marketValue2" => ""
			,"assessedValue2" => ""
			,"basic2" => ""
			,"sef2" => ""
			,"totalTax2" => ""

			,"arpNumber3" => ""
			,"arpNumber3a" => ""
			,"arpNumber3b" => ""
			,"pin3" => ""
			,"pin3a" => ""
			,"pin3b" => ""
			,"location3" => ""
			,"location3a" => ""
			,"location3b" => ""
			,"classification3" => ""
			,"area3" => ""
			,"lotNo3" => ""
			,"marketValue3" => ""
			,"assessedValue3" => ""
			,"basic3" => ""
			,"sef3" => ""
			,"totalTax3" => ""

			,"arpNumber4" => ""
			,"arpNumber4a" => ""
			,"arpNumber4b" => ""
			,"pin4" => ""
			,"pin4a" => ""
			,"pin4b" => ""
			,"location4" => ""
			,"location4a" => ""
			,"location4b" => ""
			,"classification4" => ""
			,"area4" => ""
			,"lotNo4" => ""
			,"marketValue4" => ""
			,"assessedValue4" => ""
			,"basic4" => ""
			,"sef4" => ""
			,"totalTax4" => ""

			,"arpNumber5" => ""
			,"arpNumber5a" => ""
			,"arpNumber5b" => ""
			,"pin5" => ""
			,"pin5a" => ""
			,"pin5b" => ""
			,"location5" => ""
			,"location5a" => ""
			,"location5b" => ""
			,"classification5" => ""
			,"area5" => ""
			,"lotNo5" => ""
			,"marketValue5" => ""
			,"assessedValue5" => ""
			,"basic5" => ""
			,"sef5" => ""
			,"totalTax5" => ""

			,"arpNumber6" => ""
			,"arpNumber6a" => ""
			,"arpNumber6b" => ""
			,"pin6" => ""
			,"pin6a" => ""
			,"pin6b" => ""
			,"location6" => ""
			,"location6a" => ""
			,"location6b" => ""
			,"classification6" => ""
			,"area6" => ""
			,"lotNo6" => ""
			,"marketValue6" => ""
			,"assessedValue6" => ""
			,"basic6" => ""
			,"sef6" => ""
			,"totalTax6" => ""

			,"totalMarketValue" => ""
			,"totalAssessedValue" => ""
			,"totalBasic" => ""
			,"totalSef" => ""
			,"totalTaxes" => ""
			//,"grandTotalBasic => ""
			
			,"municipalAssessor" => ""
			,"municipalTreasurer" => ""

		);

		$this->formArray["pageNumber"] = 1;

		$this->tdPagingArray["tdPageNumber"] = 1;
		$this->tdPagingArray["tdCount"] = 0;
		$this->tdPagingArray["tdTotalPages"] = 1;
		$this->tdPagingArray["tdPageBy"] = 6;
	}

	function formatCurrency($key){
		if($this->formArray[$key]!=""){
			$this->formArray[$key] = number_format($this->formArray[$key], 2, ".", ",");
		}
	}
	
	function setForm(){

		$this->formatCurrency("marketValue1");
		$this->formatCurrency("assessedValue1");
		$this->formatCurrency("basic1");
		$this->formatCurrency("sef1");
		$this->formatCurrency("totalTax1");

		$this->formatCurrency("marketValue2");
		$this->formatCurrency("assessedValue2");
		$this->formatCurrency("basic2");
		$this->formatCurrency("sef2");
		$this->formatCurrency("totalTax2");

		$this->formatCurrency("marketValue3");
		$this->formatCurrency("assessedValue3");
		$this->formatCurrency("basic3");
		$this->formatCurrency("sef3");
		$this->formatCurrency("totalTax3");

		$this->formatCurrency("marketValue4");
		$this->formatCurrency("assessedValue4");
		$this->formatCurrency("basic4");
		$this->formatCurrency("sef4");
		$this->formatCurrency("totalTax4");

		$this->formatCurrency("marketValue5");
		$this->formatCurrency("assessedValue5");
		$this->formatCurrency("basic5");
		$this->formatCurrency("sef5");
		$this->formatCurrency("totalTax5");

		$this->formatCurrency("marketValue6");
		$this->formatCurrency("assessedValue6");
		$this->formatCurrency("basic6");
		$this->formatCurrency("sef6");
		$this->formatCurrency("totalTax6");

		$this->formatCurrency("totalMarketValue");
		$this->formatCurrency("totalAssessedValue");
		$this->formatCurrency("totalBasic");
		$this->formatCurrency("totalSef");
		$this->formatCurrency("totalTaxes");
		//$this->formatCurrency("grandTotalBasic");
		
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, html_entity_to_alpha($value));
		}
	}

	function resetTDPageRecords(){
		for($i=1 ; $i<=6 ; $i++){
			$this->formArray["arpNumber".$i] = "";
			$this->formArray["arpNumber".$i."a"] = "";
			$this->formArray["arpNumber".$i."b"] = "";
			$this->formArray["location".$i] = "";
			$this->formArray["location".$i."a"] = "";
			$this->formArray["location".$i."b"] = "";
			$this->formArray["area".$i] = "";
			$this->formArray["lotNo".$i] = "";
			$this->formArray["pin".$i] = "";
			$this->formArray["pin".$i."a"] = "";
			$this->formArray["pin".$i."b"] = "";
			$this->formArray["classification".$i] = "";
			$this->formArray["marketValue".$i] = "";
			$this->formArray["assessedValue".$i] = "";
			$this->formArray["basic".$i] = "";
			$this->formArray["sef".$i] = "";
			$this->formArray["totalTax".$i] = "";
		}
	}

	function displayLGUName(){
		$eRPTSSettings = new eRPTSSettings;
		$eRPTSSettings->selectRecord(1);

		$this->formArray["lguType"] = strtoupper($eRPTSSettings->getLguType());
		$this->formArray["lguName"] = strtoupper($eRPTSSettings->getLguName());
	}


	function displayOwnerList($domDoc){
		$owner = new Owner;
		$owner->parseDomDocument($domDoc);

		$oValue = $owner;
	
		if (count($oValue->personArray)){

			$firstOwner = $oValue->personArray[0]->getTitle();
			$firstOwner .= " ";
			$firstOwner .= $oValue->personArray[0]->getName();

			if(is_object($oValue->personArray[0]->addressArray[0])){
				$number = $oValue->personArray[0]->addressArray[0]->getNumber();
				$street = $oValue->personArray[0]->addressArray[0]->getStreet();
				$barangay = $oValue->personArray[0]->addressArray[0]->getBarangay();
				$district = $oValue->personArray[0]->addressArray[0]->getDistrict();
				$municipalityCity = $oValue->personArray[0]->addressArray[0]->getMunicipalityCity();
				$province = $oValue->personArray[0]->addressArray[0]->getProvince();
			}
	
		}
		if (count($oValue->companyArray)){
			if($firstOwner==""){
				$firstOwner = $oValue->companyArray[0]->getCompanyName();

				if(is_object($oValue->companyArray[0]->addressArray[0])){
					$number = $oValue->companyArray[0]->addressArray[0]->getNumber();
					$street = $oValue->companyArray[0]->addressArray[0]->getStreet();
					$barangay = $oValue->companyArray[0]->addressArray[0]->getBarangay();
					$district = $oValue->companyArray[0]->addressArray[0]->getDistrict();
					$municipalityCity = $oValue->companyArray[0]->addressArray[0]->getMunicipalityCity();
					$province = $oValue->companyArray[0]->addressArray[0]->getProvince();
				}
			}
		}

		if($number!=""){
			$address2 = $number;
		}
		if($street!=""){
			$address2 .= " ".$street;
		}		
		if($address2!=""){
			$address2.= ", ".$barangay;
		}					
		else{
			$address2 .= $barangay;
		}
		if($municipalityCity!=""){
			$address2.= ", ".$municipalityCity;
		}
		if($address2!=""){
			$address2.= ", ".$province;
		}

		if($district != "" &&  $district !="no district"){
			$address2 = $district." , ".$address2;
		}

		$this->formArray["owner"] = $firstOwner;

		$this->formArray["address1"] = $address1;
		$this->formArray["address2"] = $address2;
	}


	function Main(){
		$this->displayLGUName();

		$RPTOPDetails = new SoapObject(NCCBIZ."RPTOPDetails.php", "urn:Object");
		if (!$xmlStr = $RPTOPDetails->getRPTOP($this->formArray["rptopID"])){
			exit("xml failed");
		}
		else{
			//echo($xmlStr);
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				exit("error xmlDoc");
			}
			else {
				$rptop = new RPTOP;
				$rptop->parseDomDocument($domDoc);
				//print_r($rptop);
				foreach($rptop as $key => $value){
					switch ($key){
						case "owner":
							//$RPTOPEncode = new SoapObject(NCCBIZ."RPTOPEncode.php", "urn:Object");
							if (is_a($value,"Owner")){
								$this->formArray["ownerID"] = $rptop->owner->getOwnerID();
								$xmlStr = $rptop->owner->domDocument->dump_mem(true);
								if (!$xmlStr){
									// xml failed
								}
								else {
									if(!$domDoc = domxml_open_mem($xmlStr)) {
										// error domdoc
									}
									else {
										$this->displayOwnerList($domDoc);
									}
								}
							}
						break;
						case "cityAssessor":
							if(is_numeric($value)){
								$cityAssessor = new Person;
								$cityAssessor->selectRecord($value);
								$this->formArray["municipalAssessor"] = $cityAssessor->getName();
							}
							else {
								$cityAssessor = $value;
								$this->formArray["municipalAssessor"] = $cityAssessor;
							}
						break;
						case "cityTreasurer":
							if(is_numeric($value)){
								$cityTreasurer = new Person;
								$cityTreasurer->selectRecord($value);
								$this->formArray["municipalTreasurer"] = $cityTreasurer->getName();
							}
							else {
								$cityTreasurer = $value;
								$this->formArray["municipalTreasurer"] = $cityTreasurer;
							}
							break;
						case "tdArray":
							$tdCtr = 1;
							$tdContinuousCtr = 1;

							if (count($value)){
								$this->tdPagingArray["tdCount"] = count($value);

								$this->tdPagingArray["tdPageRecordsCounter"] = 1;
								$this->tdPagingArray["tdTotalPages"] = ceil($this->tdPagingArray["tdCount"]/$this->tdPagingArray["tdPageBy"]);
								$this->tdPagingArray["tdPageNumber"] = 1;

								$this->tpl->set_block("rptsTemplate", "Page", "PageBlock");

								$this->tpl->set_block("Page", "FirstPageText", "FirstPageTextBlock");
								$this->tpl->set_block("Page", "ContinuedFromPreviousPageText", "ContinuedFromPreviousPageTextBlock");
								$this->tpl->set_block("Page", "ContinuedNextPageText", "ContinuedNextPageTextBlock");
								$this->tpl->set_block("Page", "Totals", "TotalsBlock");

								foreach($value as $tkey => $tvalue){
									$this->formArray["arpNumber".$tdCtr] = $tvalue->getTaxDeclarationNumber();

									// word wrap arpNumber
									if(strlen($this->formArray["arpNumber".$tdCtr]) > 13){
										$this->formArray["arpNumber".$tdCtr."a"] = substr($this->formArray["arpNumber".$tdCtr], 0,12);
										$this->formArray["arpNumber".$tdCtr."b"] = substr($this->formArray["arpNumber".$tdCtr], 12);
										$this->formArray["arpNumber".$tdCtr] = "";
									}

									$this->formArray["afsID"] = $tvalue->getAfsID();

									$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
									if (!$xmlStr = $AFSDetails->getAFS($tvalue->getAfsID())){
										// xml failed
									}
									else{
										if(!$domDoc = domxml_open_mem($xmlStr)) {
											// error domDoc
										}
										else {
											$afs = new AFS;
											$afs->parseDomDocument($domDoc);

											$this->formArray["odID"] = $afs->getOdID();

											$od = new OD;
											$od->selectRecord($this->formArray["odID"]);

											$locationNumber = $od->locationAddress->getNumber();
											$locationStreet = $od->locationAddress->getStreet();
											$locationBarangay = $od->locationAddress->getBarangay();
											$locationDistrict = $od->locationAddress->getDistrict();
											$locationMunicipalityCity = $od->locationAddress->getMunicipalityCity();
											$locationProvince = $od->locationAddress->getProvince();

											$this->formArray["location".$tdCtr] = $locationNumber . " " . $locationStreet . " " . $locationBarangay;

											// word wrap location
											if(strlen($this->formArray["location".$tdCtr]) > 26){
												$this->formArray["location".$tdCtr."a"] = $locationNumber . " " . $locationStreet;
												$this->formArray["location".$tdCtr."b"] = $locationBarangay;
												$this->formArray["location".$tdCtr] = "";
											}

											$this->formArray["province"] = $locationProvince;
											$this->formArray["municipalityCity"] = strtoupper($locationMunicipalityCity);

											$this->formArray["area".$tdCtr] = $od->getLandArea();
											$this->formArray["lotNo".$tdCtr] = $od->getLotNumber();

											$this->formArray["pin".$tdCtr] = $afs->getPropertyIndexNumber();

											// word wrap pin
											if(strlen($this->formArray["pin".$tdCtr]) > 13){
												$this->formArray["pin".$tdCtr."a"] = substr($this->formArray["pin".$tdCtr], 0,12);
												$this->formArray["pin".$tdCtr."b"] = substr($this->formArray["pin".$tdCtr], 12);
												$this->formArray["pin".$tdCtr] = "";
											}

											$landList = $afs->getLandArray();
											$plantsTreesList = $afs->getPlantsTreesArray();
											$improvementsBuildingsList = $afs->getImprovementsBuildingsArray();
											$machineriesList = $afs->getMachineriesArray();

											$kind = "";
											$actualUse = "";

											if(count($landList)){
												$kind = "Land";
												$land = $landList[0];

												$actualUse = $land->getActualUse();

												$landActualUses = new LandActualUses;
												$landActualUses->selectRecord($actualUse);

												$actualUse = $landActualUses->getDescription();
												$actualUseReportCode = $landActualUses->getReportCode();
											}
											else if(count($plantsTreesList)){
												$kind = "Land";
												$plantsTrees = $plantsTreesList[0];
	
												$actualUse = $plantsTrees->getActualUse();

												$plantsTreesActualUses = new PlantsTreesActualUses;
												$plantsTreesActualUses->selectRecord($actualUse);

												$actualUse = $plantsTreesActualUses->getDescription();
												$actualUseReportCode = $plantsTreesActualUses->getReportCode();
											}
											else if(count($improvementsBuildingsList)){
												$kind = "Improvements/Buildings";
												$improvementsBuildings = $improvementsBuildingsList[0];

												$actualUse = $improvementsBuildings->getActualUse();

												$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
												$improvementsBuildingsActualUses->selectRecord($actualUse);

												$actualUse = $improvementsBuildingsActualUses->getDescription();
												$actualUseReportCode = $improvementsBuildingsActualUses->getReportCode();
											}
											else if(count($machineriesList)){
												$kind = "Machineries";
												$machineries = $machineriesList[0];

												$actualUse = $machineries->getActualUse();

												$machineriesActualUses = new MachineriesActualUses;
												$machineriesActualUses->selectRecord($actualUse);

												$actualUse = $machineriesActualUses->getDescription();
												$actualUseReportCode = $machineriesActualUses->getReportCode();
											}

											eval(REPORT_CODE_LIST);	
											foreach($reportCodeList as $key => $reportCode){
												if($reportCode["code"] == $actualUseReportCode){
													$reportCodeDescription = $reportCode["description"];
													break;
												}
											}

											$this->formArray["classification".$tdCtr] = $reportCodeDescription;

					$this->formArray["landTotalMarketValue"] += $afs->getLandTotalMarketValue();
											$this->formArray["landTotalAssessedValue"] += $afs->getLandTotalAssessedValue();
											$this->formArray["plantTotalMarketValue"] += $afs->getPlantTotalMarketValue();
											$this->formArray["plantTotalAssessedValue"] += $afs->getPlantTotalAssessedValue();
											$this->formArray["bldgTotalMarketValue"] += $afs->getBldgTotalMarketValue();
											$this->formArray["bldgTotalAssessedValue"] += $afs->getBldgTotalAssessedValue();
											$this->formArray["machTotalMarketValue"] += $afs->getMachTotalMarketValue();
											$this->formArray["machTotalAssessedValue"] += $afs->getMachTotalAssessedValue();
											$this->formArray["marketValue".$tdCtr] += $afs->getTotalMarketValue();
											$this->formArray["assessedValue".$tdCtr] += $afs->getTotalAssessedValue();

											$this->formArray["totalMarketValue"] += $this->formArray["marketValue"];
					$this->formArray["totalAssessedValue"] += $this->formArray["assessedValue"];


	// grab Due from tdID
									
	$this->formArray["totalTaxDue"] = 0.00;
	
	$DueDetails = new SoapObject(NCCBIZ."DueDetails.php", "urn:Object");
									
	if (!$xmlStr = $DueDetails->getDueFromTdID($tvalue->getTdID())){
		$this->formArray["basic".$tdCtr] = "";
		$this->formArray["sef".$tdCtr] ="";
		$this->formArray["totalTax".$tdCtr] = "";
		
		$this->formArray["totalBasic"] += 0;
		$this->formArray["totalSef"] += 0;
		$this->formArray["totalTaxes"] += 0;
		}
	else{
	if(!$domDoc = domxml_open_mem($xmlStr)) {
		$this->formArray["basic".$tdCtr] = "";
		$this->formArray["sef".$tdCtr] ="";
		$this->formArray["totalTax".$tdCtr] = "";
		
		$this->formArray["totalBasic"] += 0;
		$this->formArray["totalSef"] += 0;
		$this->formArray["totalTaxes"] += 0;
		}
		else {
	$due = new Due;
	$due->parseDomDocument($domDoc);
		
	$this->formArray["basic".$tdCtr] = $due->getBasicTax();
		$this->formArray["sef".$tdCtr] = $due->getSEFTax();
		$this->formArray["totalTax".$tdCtr] = $due->getTaxDue();
		
	//WRONG CODE -------------------------------------------------->
		//$this->formArray["totalBasic"] += $due->getBasicTax();
		//$this->formArray["totalSef"] += $due->getSEFTax();
		//$this->formArray["totalTaxes"] += $due->getTaxDue();	
	//------------------------------------------------------------->	

			}
		}


	}
}

	$this->formArray["totalMarketValue"] = $this->formArray["landTotalMarketValue"]
			+ $this->formArray["plantTotalMarketValue"]
			+ $this->formArray["bldgTotalMarketValue"]
			+ $this->formArray["machTotalMarketValue"];
	$this->formArray["totalAssessedValue"] = $this->formArray["landTotalAssessedValue"]
			+ $this->formArray["plantTotalAssessedValue"]
			+ $this->formArray["bldgTotalAssessedValue"]
			+ $this->formArray["machTotalAssessedValue"];
	//NEW CODE - Argao----Added on 03152008-------------------------------------------->
	//Computes Grand Totals on Basic, SEF and Total-----By CHT
	$this->formArray["totalBasic"] = ($this->formArray["totalAssessedValue"])*.01;
	$this->formArray["totalSef"] = ($this->formArray["totalAssessedValue"])*.01;
	$this->formArray["totalTaxes"] = $this->formArray["totalBasic"] 
			+ $this->formArray["totalSef"];							
	//--------------------------------------------------------------------------------->

	if($this->tdPagingArray["tdPageRecordsCounter"]==$this->tdPagingArray["tdPageBy"]){
										// if 6
										$this->setForm();
										$this->resetTDPageRecords();
										$this->tpl->set_var("tdPageNumber",$this->tdPagingArray["tdPageNumber"]);
										$this->tpl->set_var("tdTotalPages",$this->tdPagingArray["tdTotalPages"]);

										if($this->tdPagingArray["tdPageNumber"] > 1){
											$this->tpl->set_var("FirstPageTextBlock", "");
											$this->tpl->parse("ContinuedFromPreviousPageTextBlock","ContinuedFromPreviousPageText", true);
										}
										else if($this->tdPagingArray["tdPageNumber"]==1){
											$this->tpl->parse("FirstPageTextBlock", "FirstPageText", true);
											$this->tpl->set_var("ContinuedFromPreviousPageTextBlock","");
										}

										if($this->tdPagingArray["tdTotalPages"] > 1 && $this->tdPagingArray["tdPageNumber"] < $this->tdPagingArray["tdTotalPages"]){
											$this->tpl->parse("ContinuedNextPageTextBlock","ContinuedNextPageText", true);
										}
										else if($this->tdPagingArray["tdTotalPages"]==1){
											$this->tpl->set_var("ContinuedNextPageTextBlock","");
										}

										if($this->tdPagingArray["tdTotalPages"]==$this->tdPagingArray["tdPageNumber"]){
											$this->tpl->parse("TotalsBlock","Totals", true);
										}
										else{
											$this->tpl->set_var("TotalsBlock", "");
										}

										$this->tpl->parse("PageBlock","Page",true);

										$this->tpl->set_var("FirstPageTextBlock", "");
										$this->tpl->set_var("ContinuedFromPreviousPageTextBlock","");
										$this->tpl->set_var("ContinuedNextPageTextBlock","");
										$this->tpl->set_var("TotalsBlock", "");

										$this->tdPagingArray["tdPageNumber"]++;
										$this->formArray["pageNumber"]++;

										// reset counter
										$this->tdPagingArray["tdPageRecordsCounter"] = 0;
										$tdCtr=0;
									}
									else if($tdContinuousCtr==$this->tdPagingArray["tdCount"]){
										// if this is the last record, and count is still not 6

										$this->setForm();
										$this->resetTDPageRecords();
										$this->tpl->set_var("tdPageNumber",$this->tdPagingArray["tdPageNumber"]);
										$this->tpl->set_var("tdTotalPages",$this->tdPagingArray["tdTotalPages"]);

										if($this->tdPagingArray["tdPageNumber"] > 1){
											$this->tpl->set_var("FirstPageTextBlock", "");
											$this->tpl->parse("ContinuedFromPreviousPageTextBlock","ContinuedFromPreviousPageText", true);
										}
										else if($this->tdPagingArray["tdPageNumber"]==1){
											$this->tpl->parse("FirstPageTextBlock", "FirstPageText", true);
											$this->tpl->set_var("ContinuedFromPreviousPageTextBlock","");
										}

										if($this->tdPagingArray["tdTotalPages"] > 1 && $this->tdPagingArray["tdPageNumber"] < $this->tdPagingArray["tdTotalPages"]){
											$this->tpl->parse("ContinuedNextPageTextBlock","ContinuedNextPageText", true);
										}
										else if($this->tdPagingArray["tdTotalPages"]==1){
											$this->tpl->set_var("ContinuedNextPageTextBlock","");
										}

										if($this->tdPagingArray["tdTotalPages"]==$this->tdPagingArray["tdPageNumber"]){
											$this->tpl->parse("TotalsBlock","Totals", true);
										}
										else{
											$this->tpl->set_var("TotalsBlock", "");
										}

										$this->tpl->parse("PageBlock","Page",true);

										$this->tpl->set_var("FirstPageTextBlock", "");
										$this->tpl->set_var("ContinuedFromPreviousPageTextBlock","");
										$this->tpl->set_var("ContinuedNextPageTextBlock","");
										$this->tpl->set_var("TotalsBlock", "");

										$this->tdPagingArray["tdPageNumber"]++;
										$this->formArray["pageNumber"]++;
									}

									$tdCtr++;
									$tdContinuousCtr++;

									$this->tdPagingArray["tdPageRecordsCounter"]++;
								}
							}

						break;
						default:
						$this->formArray[$key] = $value;
					}
				}

				unset($rptop);

			}	
		}

		$this->tpl->set_block("rptsTemplate","Totals","TotalsBlock");
		$this->tpl->set_var("TotalsBlock","");

		//$this->setForm();
	
        $this->tpl->parse("templatePage", "rptsTemplate");
        $this->tpl->finish("templatePage");

//		print_r($this->tpl->get("templatePage"));
//		exit;

		$testpdf = new PDFWriter;
        $testpdf->setOutputXML($this->tpl->get("templatePage"),"test");
        if(isset($this->formArray["print"])){
        	$testpdf->writePDF($name);//,$this->formArray["print"]);
        }
        else {
        	$testpdf->writePDF($name);
        }

		//header("location: ".$testpdf->pdfPath);

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

$printRPTOPDetailsPDF = new PrintRPTOPDetailsPDF($http_post_vars,$sess,$rptopID);
$printRPTOPDetailsPDF->Main();
?>
<?php page_close(); ?>
