<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/web/clibPDFWriter.php";
include_once "../includes/assessor/Barangay.php";

include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/OD.php";

include_once "../includes/assessor/ODHistory.php";
include_once "../includes/assessor/ODHistoryRecords.php";

#####################################
# Define Interface Class
#####################################
class PrintMachineriesFAAS{
	
	var $tpl;
	var $formArray;
	function PrintMachineriesFAAS($http_post_vars,$sess,$odID,$ownerID,$afsID,$print){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "machfaas.xml") ;
		$this->tpl->set_var("TITLE", "Print Machineries FAAS");
		
       	$this->formArray = array(
			"arpNumber" => ""
			,"propertyIndexNumber" => ""

			,"owner" => ""
			,"ownerAddress" => ""
			,"ownerTelNo" => ""

			,"userAdmin" => ""
			,"userAdminAddress" => ""
			,"userAdminTelNo" => ""

			,"buildingOwner" => ""
			,"buildingPIN" => ""

			,"landOwner" => ""
			,"landPIN" => ""

			,"number" => ""
			,"street" => ""
			,"barangay" => ""
			,"district" => ""
			,"municipality" => ""
			,"city" => ""
			,"province" => ""

            // tbl1Desc1-9 (Description)

			,"tbl1Desc1" => ""
			,"tbl1Desc2" => ""
			,"tbl1Desc3" => ""
			,"tbl1Desc4" => ""
			,"tbl1Desc5" => ""
			,"tbl1Desc6" => ""
			,"tbl1Desc7" => ""
			,"tbl1Desc8" => ""
			,"tbl1Desc9" => ""

			//brandNo1-9 (Brand & Model No)

			,"brandNo1" => ""
			,"brandNo2" => ""
			,"brandNo3" => ""
			,"brandNo4" => ""
			,"brandNo5" => ""
			,"brandNo6" => ""
			,"brandNo7" => ""
			,"brandNo8" => ""
			,"brandNo9" => ""

			//capacity1-9 (Capacity)

			,"capacity1" => ""
			,"capacity2" => ""
			,"capacity3" => ""
			,"capacity4" => ""
			,"capacity5" => ""
			,"capacity6" => ""
			,"capacity7" => ""
			,"capacity8" => ""
			,"capacity9" => ""

			//dateAcq1-9 (Date Acquired)

			,"dateAcq1" => ""
			,"dateAcq2" => ""
			,"dateAcq3" => ""
			,"dateAcq4" => ""
			,"dateAcq5" => ""
			,"dateAcq6" => ""
			,"dateAcq7" => ""
			,"dateAcq8" => ""
			,"dateAcq9" => ""

			//condAcq1-9 (Condition when Acquired)

			,"condAcq1" => ""
			,"condAcq2" => ""
			,"condAcq3" => ""
			,"condAcq4" => ""
			,"condAcq5" => ""
			,"condAcq6" => ""
			,"condAcq7" => ""
			,"condAcq8" => ""
			,"condAcq9" => ""

			//lifeEst1-9 (Estimated Economic Life)

			,"lifeEst1" => ""
			,"lifeEst2" => ""
			,"lifeEst3" => ""
			,"lifeEst4" => ""
			,"lifeEst5" => ""
			,"lifeEst6" => ""
			,"lifeEst7" => ""
			,"lifeEst8" => ""
			,"lifeEst9" => ""

			//lifeRem1-9 (Remaining Life)

			,"lifeRem1" => ""
			,"lifeRem2" => ""
			,"lifeRem3" => ""
			,"lifeRem4" => ""
			,"lifeRem5" => ""
			,"lifeRem6" => ""
			,"lifeRem7" => ""
			,"lifeRem8" => ""
			,"lifeRem9" => ""

			//dateInst1-9 (Date of Installation)

			,"dateInst1" => ""
			,"dateInst2" => ""
			,"dateInst3" => ""
			,"dateInst4" => ""
			,"dateInst5" => ""
			,"dateInst6" => ""
			,"dateInst7" => ""
			,"dateInst8" => ""
			,"dateInst9" => ""

			//dateOper1-9 (Date of Operation)

			,"dateOper1" => ""
			,"dateOper2" => ""
			,"dateOper3" => ""
			,"dateOper4" => ""
			,"dateOper5" => ""
			,"dateOper6" => ""
			,"dateOper7" => ""
			,"dateOper8" => ""
			,"dateOper9" => ""

			//remarks1-9 (Remarks)

			,"remarks1" => ""
			,"remarks2" => ""
			,"remarks3" => ""
			,"remarks4" => ""
			,"remarks5" => ""
			,"remarks6" => ""
			,"remarks7" => ""
			,"remarks8" => ""
			,"remarks9" => ""

			//tbl2Desc1-9 (description)

			,"tbl2Desc1" => ""
			,"tbl2Desc2" => ""
			,"tbl2Desc3" => ""
			,"tbl2Desc4" => ""
			,"tbl2Desc5" => ""
			,"tbl2Desc6" => ""
			,"tbl2Desc7" => ""
			,"tbl2Desc8" => ""
			,"tbl2Desc9" => ""

			//units1-9 (no.of units)

			,"units1" => ""
			,"units2" => ""
			,"units3" => ""
			,"units4" => ""
			,"units5" => ""
			,"units6" => ""
			,"units7" => ""
			,"units8" => ""
			,"units9" => ""

			//acqCost1-9 (acquisition cost)

			,"acqCost1" => ""
			,"acqCost2" => ""
			,"acqCost3" => ""
			,"acqCost4" => ""
			,"acqCost5" => ""
			,"acqCost6" => ""
			,"acqCost7" => ""
			,"acqCost8" => ""
			,"acqCost9" => ""

			//freight1-9 (freight)

			,"freight1" => ""
			,"freight2" => ""
			,"freight3" => ""
			,"freight4" => ""
			,"freight5" => ""
			,"freight6" => ""
			,"freight7" => ""
			,"freight8" => ""
			,"freight9" => ""

			//insurnc1-9 (additional cost insurance)

			,"insurnc1" => ""
			,"insurnc2" => ""
			,"insurnc3" => ""
			,"insurnc4" => ""
			,"insurnc5" => ""
			,"insurnc6" => ""
			,"insurnc7" => ""
			,"insurnc8" => ""
			,"insurnc9" => ""

			//instaln1-9 (installation)

			,"instaln1" => ""
			,"instaln2" => ""
			,"instaln3" => ""
			,"instaln4" => ""
			,"instaln5" => ""
			,"instaln6" => ""
			,"instaln7" => ""
			,"instaln8" => ""
			,"instaln9" => ""

			//others1-9 (others)

			,"others1" => ""
			,"others2" => ""
			,"others3" => ""
			,"others4" => ""
			,"others5" => ""
			,"others6" => ""
			,"others7" => ""
			,"others8" => ""
			,"others9" => ""

			//mrktVal1-9 (market valule)

			,"mrktVal1" => ""
			,"mrktVal2" => ""
			,"mrktVal3" => ""
			,"mrktVal4" => ""
			,"mrktVal5" => ""
			,"mrktVal6" => ""
			,"mrktVal7" => ""
			,"mrktVal8" => ""
			,"mrktVal9" => ""

			//depr1-9 (depreciation)

			,"depr1" => ""
			,"depr2" => ""
			,"depr3" => ""
			,"depr4" => ""
			,"depr5" => ""
			,"depr6" => ""
			,"depr7" => ""
			,"depr8" => ""
			,"depr9" => ""

			//depMVal1-9 (depreciated market value)

			,"depMVal1" => ""
			,"depMVal2" => ""
			,"depMVal3" => ""
			,"depMVal4" => ""
			,"depMVal5" => ""
			,"depMVal6" => ""
			,"depMVal7" => ""
			,"depMVal8" => ""
			,"depMVal9" => ""

			,"totAcqCst" => ""
			,"totOthers" => ""
			,"totMrktVal" => ""

			//kind1-4 (kind)

			,"kind1" => ""
			,"kind2" => ""
			,"kind3" => ""
			,"kind4" => ""

			//marketValue1-4 (market value)

			,"marketValue1" => ""
			,"marketValue2" => ""
			,"marketValue3" => ""
			,"marketValue4" => ""

			//assessmentLevel1-4 (assessment level)

			,"assessmentLevel1" => ""
			,"assessmentLevel2" => ""
			,"assessmentLevel3" => ""
			,"assessmentLevel4" => ""

			//assessmentValue1-4 (assessed value)

			,"assessmentValue1" => ""
			,"assessmentValue2" => ""
			,"assessmentValue3" => ""
			,"assessmentValue4" => ""

			,"totalMarketValue" => ""
			,"totalAssessmentValue" => ""

			,"previousOwner" => ""
			,"taxability" => ""
			,"previousAssessedValue" => ""
			,"effectivity" => ""

			,"assessedBy" => ""
			,"dateAssessedBy" => ""

			,"cityAssessor" => ""
			,"dateCityAssessor" => ""
			,"provincialAssessor" => ""
			,"dateProvAssessor" => ""

			,"memoranda" => ""

			,"previous1" => "" // previous arpNumber
			,"previous2" => "" // previous assessment roll report number (leave blank)

			,"present1" => "" //  present arpNumber
			,"present2" => "" // present assessment roll report number (leave blank)

			,"initial1" => ""
			,"initial2" => ""

			,"postDate1" => ""
			,"postDate2" => ""

		);

		$this->formArray["odID"] = $odID;
		$this->formArray["ownerID"] = $ownerID;
		$this->formArray["afsID"] = $afsID;
        
		$this->formArray["propertyID"] = $propertyID;
        $this->formArray["propertyType"] = $propertyType;
		$this->formArray["print"] = $print;

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function formatCurrency($key){
		if($this->formArray[$key]!=""){
			$this->formArray[$key] = number_format(toFloat($this->formArray[$key]), 2, ".", ",");
		}
	}
	
	function setForm(){
		$this->formatCurrency("totAcqCst");
		$this->formatCurrency("totOthers");
		$this->formatCurrency("totMrktVal");

		$this->formatCurrency("marketValue1");
		$this->formatCurrency("marketValue1");
		$this->formatCurrency("marketValue1");
		$this->formatCurrency("marketValue1");

		$this->formatCurrency("assessmentValue1");
		$this->formatCurrency("assessmentValue2");
		$this->formatCurrency("assessmentValue3");
		$this->formatCurrency("assessmentValue4");

		$this->formatCurrency("totalMarketValue");
		$this->formatCurrency("totalAssessmentValue");

		$this->formatCurrency("previousAssessedValue");

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, html_entity_to_alpha($value));
		}
	}

	function displayTD($afsID){
		$TDDetails = new SoapObject(NCCBIZ."TDDetails.php", "urn:Object");
		if (!$xmlStr = $TDDetails->getTDFromAfsID($this->formArray["afsID"])){
			// xml failed
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
			}
			else {
				$td = new TD;
				$td->parseDomDocument($domDoc);
				
				$this->formArray["previousOwner"] = $td->getPreviousOwner();
				$this->formArray["previousAssessedValue"] = $td->getPreviousAssessedValue();
			}
		}
	}

	function displayOwnerList($domDoc){
		$owner = new Owner;
		$owner->parseDomDocument($domDoc);
			$ownerName = "";
			if (count($owner->personArray)){
				foreach($owner->personArray as $personKey =>$personValue){
					if ($ownerName == ""){
						$address = $personValue->addressArray[0]->getFullAddress();

						$address1 = $personValue->addressArray[0]->getNumber();
						if($address1!="")
							$address1 .= " ";
						$address1 .= $personValue->addressArray[0]->getStreet();
						if($address1!="")
							$address1 .= ", ";
						$address1 .= $personValue->addressArray[0]->getBarangay();

						$address2 = $personValue->addressArray[0]->getDistrict();
						if($address2!="")
							$address2 .= ", ";
						$address2 .= $personValue->addressArray[0]->getMunicipalityCity();
						if($address2!="")
							$address2 .= ", ";
						$address2 .= $personValue->addressArray[0]->getProvince();

						$ownerName = $personValue->getProperName();
						$telNo = $personValue->getTelephone();
					}
					else{
						$ownerName = $ownerName." , ".$personValue->getProperName();
						$telNo = $personValue->getTelephone();
					}
				}
			}

			if (count($owner->companyArray)){
				foreach ($owner->companyArray as $companyKey => $companyValue){
					if ($ownerName == ""){
						$address = $companyValue->addressArray[0]->getFullAddress();

						$address1 = $companyValue->addressArray[0]->getNumber();
						if($address1!="")
							$address1 .= " ";
						$address1 .= $companyValue->addressArray[0]->getStreet();
						if($address1!="")
							$address1 .= ", ";
						$address1 .= $companyValue->addressArray[0]->getBarangay();

						$address2 = $companyValue->addressArray[0]->getDistrict();
						if($address2!="")
							$address2 .= ", ";
						$address2 .= $companyValue->addressArray[0]->getMunicipalityCity();
						if($address2!="")
							$address2 .= ", ";
						$address2 .= $companyValue->addressArray[0]->getProvince();

						$ownerName = $companyValue->getCompanyName();
						$telNo = $companyValue->getTelephone();
					}
					else{
						$ownerName = $ownerName." , ".$companyValue->getCompanyName();
						$telNo = $personValue->getTelephone();
					}
				}
			}

		$this->formArray["owner"] = $ownerName;
		$this->formArray["ownerAddress"] = $address;
		$this->formArray["ownerTelNo"] = $telNo;
	}

	function displayLandPINDetails(){
		// attempt to capture AFS with associated landPIN
		$afs = new AFS;
		if($afs->selectRecord("","","","WHERE ".AFS_TABLE.".propertyIndexNumber = '".fixQuotes($this->formArray["landPIN"])."'")){

			// attempt to capture first landOwner name
			$od = new OD;
			if($od->selectRecord($afs->getOdID())){
				if(is_object($od->owner)){
					if(is_array($od->owner->personArray)){
						$personArray = $od->owner->personArray;
						$landOwnerPerson = $personArray[0];
						$this->formArray["landOwner"] = $landOwnerPerson->getFullName();
					}
					else if(is_array($od->owner->companyArray)){
						$companyArray = $od->owner->companyArray;
						$landOwnerCompany = $companyArray[0];
						$this->formArray["landOwner"] = $landOwnerCompany->getCompanyName();
					}
				}
			}

		}
		else{
			// danny : November 24, 2005 : commented out line that blanks out $this->formArray["landPIN"]
			//$this->formArray["landPIN"] = "";
			$this->formArray["landOwner"] = "";
		}
	}

	function displayBuildingPINDetails(){
		// attempt to capture AFS with associated buildingPIN
		$afs = new AFS;
		if($afs->selectRecord("","","","WHERE ".AFS_TABLE.".propertyIndexNumber = '".fixQuotes($this->formArray["buildingPIN"])."'")){

			// attempt to capture first buildingOwner name
			$od = new OD;
			if($od->selectRecord($afs->getOdID())){
				if(is_object($od->owner)){
					if(is_array($od->owner->personArray)){
						$personArray = $od->owner->personArray;
						$buildingOwnerPerson = $personArray[0];
						$this->formArray["buildingOwner"] = $buildingOwnerPerson->getFullName();
					}
					else if(is_array($od->owner->companyArray)){
						$companyArray = $od->owner->companyArray;
						$buildingOwnerCompany = $companyArray[0];
						$this->formArray["buildingOwner"] = $buildingOwnerCompany->getCompanyName();
					}
				}
			}

		}
		else{
			// danny : November 24, 2005 : commented out line that blanks out $this->formArray["buildingPIN"]
			//$this->formArray["buildingPIN"] = "";
			$this->formArray["buildingOwner"] = "";
		}
	}

	function displayODAFS($afsID){
		$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
		if (!$odID = $AFSDetails->getOdID($afsID)){
			exit("get od id failed");
		}
		else{
			$ODDetails = new SoapObject(NCCBIZ."ODDetails.php", "urn:Object");
			if (!$xmlStr = $ODDetails->getOD($odID)){
				exit("xml failed");
			}
			else{
				//exit($xmlStr);
				if(!$domDoc = domxml_open_mem($xmlStr)) {
					exit("error open xml");
				}
				else {
					$od = new OD;
					$od->parseDomDocument($domDoc);
					if (is_object($od->locationAddress)){
						$this->formArray["number"] = $od->locationAddress->getNumber();
						$this->formArray["street"] = $od->locationAddress->getStreet();
						$this->formArray["barangay"] = $od->locationAddress->getBarangay();
						$this->formArray["district"] = $od->locationAddress->getDistrict();

						// NCC Modification checked and implemented by K2 : November 10, 2005
						// details:
						//		commented out line 585, added line 586 
						//		changed "city" to "municipality"

						// $this->formArray["city"] = $od->locationAddress->getMunicipalityCity();
						$this->formArray["municipality"] = $od->locationAddress->getMunicipalityCity();
						$this->formArray["province"] = $od->locationAddress->getProvince();
					}

					$ODEncode = new SoapObject(NCCBIZ."ODEncode.php", "urn:Object");
					$this->formArray["ownerID"] = $ODEncode->getOwnerID($this->formArray["odID"]);
					$xmlStr = $od->owner->domDocument->dump_mem(true);
					if (!$xmlStr){
						exit("error xml");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
							exit("error open xml");
						}
						else {
							$this->displayOwnerList($domDoc);
						}
					}
				}	
			}
		}
	}

	function displayMachineriesList($machineriesList){

		$totAcqCst = 0;
		$totOthers = 0;
		$totMrktVal = 0;

		$totalMarketValue = 0;
		$totalAssessmentValue = 0;

        if (count($machineriesList)){
			$i = 0;
			foreach ($machineriesList as $key => $machineries){
				if($i==0){
					// $this->formArray["arpNumber"] = $machineries->getArpNumber();
					// $this->formArray["propertyIndexNumber"] = $machineries->getPropertyIndexNumber();

					//this->formArray["taxability"] = $machineries->getTaxability();
					//$this->formArray["effectivity"] = $machineries->getEffectivity();

					$this->formArray["buildingPIN"] = $machineries->getBuildingPin();
					$this->formArray["landPIN"] = $machineries->getLandPin();
					$this->displayLandPINDetails();
					$this->displayBuildingPINDetails();

					$this->formArray["memoranda"] = $machineries->getMemoranda();

					if (is_a($machineries->propertyAdministrator,Person)){
						if($machineries->propertyAdministrator->getLastName()){
							$this->formArray["userAdmin"] = $machineries->propertyAdministrator->getFullName();
						}
						if (is_a($machineries->propertyAdministrator->addressArray[0],"address")){
							$address1 = $machineries->propertyAdministrator->addressArray[0]->getNumber();
							if($address1!="")
								$address1 .= " ";
							$address1.= $machineries->propertyAdministrator->addressArray[0]->getStreet();
							if($address1!="")
								$address1 .= ", ";
							$address1.= $machineries->propertyAdministrator->addressArray[0]->getBarangay();
							
							$address2 = $machineries->propertyAdministrator->addressArray[0]->getDistrict();
							if($address2!="")
								$address2 .= ", ";
							$address2.= $machineries->propertyAdministrator->addressArray[0]->getMunicipalityCity();
							if($address2!="")
								$address2 .= ", ";
							$address2.= $machineries->propertyAdministrator->addressArray[0]->getProvince();

							$this->formArray["userAdminAddress"] = $address1." ".$address2;
						}
						$this->formArray["userAdminTelNo"] = $machineries->propertyAdministrator->getTelephone();
					}

					// recommendingApproval
					if(is_numeric($machineries->recommendingApproval))
					{
						$recommendingApproval = new Person;
						$recommendingApproval->selectRecord($machineries->recommendingApproval);
						$this->formArray["cityAssessor"] = $recommendingApproval->getFullName();
						$this->recommendingApproval = $recommendingApproval->getFullName();
					}
					else{
						$recommendingApproval = $machineries->recommendingApproval;
						$this->formArray["cityAssessor"] = $recommendingApproval;
						$this->recommendingApproval = $recommendingApproval;
					}

					$this->formArray["dateCityAssessor"] = $machineries->getRecommendingApprovalDate();

					// approvedBy
					if(is_numeric($machineries->approvedBy))
					{
						$approvedBy = new Person;
						$approvedBy->selectRecord($machineries->approvedBy);
						$this->formArray["provincialAssessor"] = $approvedBy->getFullName();
						$this->approvedBy = $approvedBy->getFullName();
					}
					else{
						$approvedBy = $land->approvedBy;
						$this->formArray["provincialAssessor"] = $approvedBy;
						$this->approvedBy = $approvedBy;
					}
					$this->formArray["dateProvAssessor"] = $machineries->getApprovedByDate();

					// appraisedBy (assessedBy)
					if(is_numeric($machineries->appraisedBy))
					{
						$appraisedBy = new Person;
						$appraisedBy->selectRecord($machineries->appraisedBy);
						$this->formArray["assessedBy"] = $appraisedBy->getFullName();
						$this->appraisedBy = $appraisedBy->getFullName();
					}
					else{
						$appraisedBy = $machineries->appraisedBy;
						$this->formArray["assessedBy"] = $appraisedBy;
						$this->appraisedBy = $appraisedBy;
					}
					$this->formArray["dateAssessedBy"] = $machineries->getAppraisedByDate();

				}
				if($i < 9){
					$this->formArray["tbl1Desc".($i+1)] = $machineries->machineryDescription;
					$this->formArray["tbl2Desc".($i+1)] = $machineries->machineryDescription;
					$this->formArray["brandNo".($i+1)] = $machineries->brand." ".$machineries->modelNumber;
					$this->formArray["capacity".($i+1)] = $machineries->capacity;
					$this->formArray["dateAcquired".($i+1)] = $machineries->dateAcquired;
					$this->formArray["condAcq".($i+1)] = $machineries->conditionWhenAcquired;
					$this->formArray["lifeEst".($i+1)] = $machineries->estimatedEconomicLife;
					$this->formArray["lifeRem".($i+1)] = $machineries->remainingEconomicLife;
					$this->formArray["dateInst".($i+1)] = $machineries->dateOfInstallation;
					$this->formArray["dateOper".($i+1)] = $machineries->dateOfOperation;
					$this->formArray["remarks".($i+1)] = $machineries->remarks;
					$this->formArray["units".($i+1)] = $machineries->numberOfUnits;

					// NCC Modification checked and implemented by K2 : November 10, 2005
					// details:
					//		formatCurrency() removed for variables in lines 726 to 733
					$this->formArray["acqCost".($i+1)] = $machineries->acquisitionCost;
					$this->formArray["freight".($i+1)] = $machineries->freightCost;
					$this->formArray["insurnc".($i+1)] = $machineries->insuranceCost;
					$this->formArray["instaln".($i+1)] = $machineries->installationCost;
					$this->formArray["others".($i+1)] = $machineries->othersCost;
					$this->formArray["mrktVal".($i+1)] = $machineries->marketValue;
					$this->formArray["depr".($i+1)] = $machineries->depreciation;
					$this->formArray["depMVal".($i+1)] = $machineries->depreciatedMarketValue;

					$totAcqCst = $totAcqCst + toFloat($machineries->acquisitionCost);
					$totOthers = $totOthers + toFloat($machineries->othersCost);
					$totMrktVal = $totMrktVal + toFloat($machineries->marketValue);

					$totalMarketValue = $totMrktVal;
					$totalAssessmentValue = $totalAssessmentValue + toFloat($machineries->assessedValue);
				}
				if($i < 4){
					// NCC Modification checked and implemented by K2 : November 10, 2005
					// details:
					//		formatCurrency() removed for variables in lines 747 and 749 (marketValue, assessedValue)
					$this->formArray["kind".($i+1)] = $machineries->kind;
					$this->formArray["marketValue".($i+1)] = $machineries->marketValue;
					$this->formArray["assessmentLevel".($i+1)] = $machineries->assessmentLevel;
					$this->formArray["assessmentValue".($i+1)] = $machineries->assessedValue;
				}
				$i++;
			}
		}
		$this->formArray["totAcqCst"] = $totAcqCst;
		$this->formArray["totOthers"] = $totOthers;
		$this->formArray["totMrktVal"] = $totMrktVal;
		$this->formArray["totalMarketValue"] = $totalMarketValue;
		$this->formArray["totalAssessmentValue"] = $totalAssessmentValue;
	}

	function displayPostingSummary($afs){
		// previous
		$presentODID = $afs->odID;
		$condition = sprintf("WHERE presentODID='%s'",fixQuotes($presentODID));

		$odHistoryRecords = new ODHistoryRecords;
		if($odHistoryRecords->selectRecords($condition)){
			$odHistory = $odHistoryRecords->arrayList[0];
			$previousODID = $odHistory->previousODID;

			$previousAFS = new AFS;
			if($previousAFS->selectRecord("","",$previousODID,"")){
				$this->formArray["previous1"] = $previousAFS->arpNumber;
			}
		}

		// present
		$this->formArray["present1"] = $afs->arpNumber;
	}

	function Main(){
		$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
		if (!$xmlStr = $AFSDetails->getAFS($this->formArray["afsID"])){
			exit("afs not found");
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				exit("error xmlDoc");
			}
			else {
				$afs = new AFS;
				$afs->parseDomDocument($domDoc);

				$this->formArray["arpNumber"] = $afs->arpNumber;
				$this->formArray["propertyIndexNumber"] = $afs->propertyIndexNumber;

				$this->formArray["taxability"] = $afs->taxability;
				$this->formArray["effectivity"] = $afs->effectivity;

				$this->displayODAFS($this->formArray["afsID"]);

				$this->displayTD($this->formArray["afsID"]);

				$this->displayPostingSummary($afs);

				$machineriesList = $afs->getMachineriesArray();

				if(count($machineriesList)){
					$this->displayMachineriesList($machineriesList);
				}
			}
		}

		$this->setForm();
		
        $this->tpl->parse("templatePage", "rptsTemplate");
        $this->tpl->finish("templatePage");

		//echo $this->tpl->get("templatePage");
		//exit;

		$testpdf = new PDFWriter;
        $testpdf->setOutputXML($this->tpl->get("templatePage"),"test");
        if(isset($this->formArray["print"])){
        	$testpdf->writePDF($name);//,$this->formArray["print"]);
        }
        else {
        	$testpdf->writePDF($name);
        }		
//		header("location: ".$testpdf->pdfPath);
		exit;

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

$printMachineriesFAAS = new PrintMachineriesFAAS($HTTP_POST_VARS,$sess,$odID,$ownerID,$afsID,$print);
$printMachineriesFAAS->Main();
?>
<?php page_close(); ?>
