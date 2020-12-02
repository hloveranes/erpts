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
include_once "../includes/assessor/TD.php";

include_once "../includes/assessor/Land.php";
include_once "../includes/assessor/LandClasses.php";
include_once "../includes/assessor/LandSubclasses.php";
include_once "../includes/assessor/LandActualUses.php";

include_once "../includes/assessor/PlantsTrees.php";
include_once "../includes/assessor/PlantsTreesClasses.php";
include_once "../includes/assessor/PlantsTreesActualUses.php";

#####################################
# Define Interface Class
#####################################
class PrintLandFAAS{
	
	var $tpl;
	var $formArray;
	function PrintLandFAAS($http_post_vars,$sess,$odID,$ownerID,$afsID,$print){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "landfaas.xml") ;
		$this->tpl->set_var("TITLE", "Print Land FAAS");
		
       	$this->formArray = array(
			"arpNumber" => ""
			,"propertyIndexNumber" => ""
			,"octTctNumber" => ""
			,"surveyNumber" => ""

			,"owner" => ""
			,"ownerAddress" => ""
			,"ownerAddress1" => ""
			,"ownerAddress2" => ""

			,"administrator" => ""
			,"adminAddress" => ""
			,"adminAddress1" => ""
			,"adminAddress2" => ""
			,"adminTelno" => ""

			,"number" => ""
			,"street" => ""
			,"barangay" => ""
			,"district" => ""
			,"cityMunicipality" => ""
			,"province" => ""

			,"north" => ""
			,"east" => ""
			,"south" => ""
			,"west" => ""

			,"classification1" => ""
			,"subClass1" => ""
			,"area1" => ""
			,"landActualUse1" => ""
			,"unitValue1" => ""
			,"landMrktVal1" => ""

			,"classification2" => ""
			,"subClass2" => ""
			,"area2" => ""
			,"landActualUse2" => ""
			,"unitValue2" => ""
			,"landMrktVal2" => ""

			,"classification3" => ""
			,"subClass3" => ""
			,"area3" => ""
			,"landActualUse3" => ""
			,"unitValue3" => ""
			,"landMrktVal3" => ""

			,"classification4" => ""
			,"subClass4" => ""
			,"area4" => ""
			,"landActualUse4" => ""
			,"unitValue4" => ""
			,"landMrktVal4" => ""

			,"classification5" => ""
			,"subClass5" => ""
			,"area5" => ""
			,"landActualUse5" => ""
			,"unitValue5" => ""
			,"landMrktVal5" => ""

			,"classification6" => ""
			,"subClass6" => ""
			,"area6" => ""
			,"landActualUse6" => ""
			,"unitValue6" => ""
			,"landMrktVal6" => ""

			,"classification7" => ""
			,"subClass7" => ""
			,"area7" => ""
			,"landActualUse7" => ""
			,"unitValue7" => ""
			,"landMrktVal7" => ""

			,"classification8" => ""
			,"subClass8" => ""
			,"area8" => ""
			,"landActualUse8" => ""
			,"unitValue8" => ""
			,"landMrktVal8" => ""

			,"classification9" => ""
			,"subClass9" => ""
			,"area9" => ""
			,"landActualUse9" => ""
			,"unitValue9" => ""
			,"landMrktVal9" => ""

			,"landTotal" => ""

			,"productClass1" => ""
			,"areaPlanted1" => ""
			,"totalNumber1" => ""
			,"nonFruit1" => ""
			,"fruit1" => ""
			,"age1" => ""
			,"unitPrice1" => ""
			,"plantMrktVal1" => ""

			,"productClass2" => ""
			,"areaPlanted2" => ""
			,"totalNumber2" => ""
			,"nonFruit2" => ""
			,"fruit2" => ""
			,"age2" => ""
			,"unitPrice2" => ""
			,"plantMrktVal2" => ""

			,"productClass3" => ""
			,"areaPlanted3" => ""
			,"totalNumber3" => ""
			,"nonFruit3" => ""
			,"fruit3" => ""
			,"age3" => ""
			,"unitPrice3" => ""
			,"plantMrktVal3" => ""

			,"productClass4" => ""
			,"areaPlanted4" => ""
			,"totalNumber4" => ""
			,"nonFruit4" => ""
			,"fruit4" => ""
			,"age4" => ""
			,"unitPrice4" => ""
			,"plantMrktVal4" => ""

			,"productClass5" => ""
			,"areaPlanted5" => ""
			,"totalNumber5" => ""
			,"nonFruit5" => ""
			,"fruit5" => ""
			,"age5" => ""
			,"unitPrice5" => ""
			,"plantMrktVal5" => ""

			,"productClass6" => ""
			,"areaPlanted6" => ""
			,"totalNumber6" => ""
			,"nonFruit6" => ""
			,"fruit6" => ""
			,"age6" => ""
			,"unitPrice6" => ""
			,"plantMrktVal6" => ""

			,"productClass7" => ""
			,"areaPlanted7" => ""
			,"totalNumber7" => ""
			,"nonFruit7" => ""
			,"fruit7" => ""
			,"age7" => ""
			,"unitPrice7" => ""
			,"plantMrktVal7" => ""

			,"productClass8" => ""
			,"areaPlanted8" => ""
			,"totalNumber8" => ""
			,"nonFruit8" => ""
			,"fruit8" => ""
			,"age8" => ""
			,"unitPrice8" => ""
			,"plantMrktVal8" => ""

			,"productClass9" => ""
			,"areaPlanted9" => ""
			,"totalNumber9" => ""
			,"nonFruit9" => ""
			,"fruit9" => ""
			,"age9" => ""
			,"unitPrice9" => ""
			,"plantMrktVal9" => ""

			,"plantTotal" => ""

			,"valAdjFacMrktVal1" => ""
			,"adjFacTxt1" => ""
			,"adjFacInt1" => ""
			,"adjustment1" => ""
			,"valueAdjustment1" => ""
			,"valAdjFacAdjMrktVal1" => ""

			,"valAdjFacMrktVal2" => ""
			,"adjFacTxt2" => ""
			,"adjFacInt2" => ""
			,"adjustment2" => ""
			,"valueAdjustment2" => ""
			,"valAdjFacAdjMrktVal2" => ""

			,"valAdjFacMrktVal3" => ""
			,"adjFacTxt3" => ""
			,"adjFacInt3" => ""
			,"adjustment3" => ""
			,"valueAdjustment3" => ""
			,"valAdjFacAdjMrktVal3" => ""

			,"valAdjFacMrktVal4" => ""
			,"adjFacTxt4" => ""
			,"adjFacInt4" => ""
			,"adjustment4" => ""
			,"valueAdjustment4" => ""
			,"valAdjFacAdjMrktVal4" => ""

			,"valAdjFacMrktVal5" => ""
			,"adjFacTxt5" => ""
			,"adjFacInt5" => ""
			,"adjustment5" => ""
			,"valueAdjustment5" => ""
			,"valAdjFacAdjMrktVal5" => ""

			,"valAdjFacMrktVal6" => ""
			,"adjFacTxt6" => ""
			,"adjFacInt6" => ""
			,"adjustment6" => ""
			,"valueAdjustment6" => ""
			,"valAdjFacAdjMrktVal6" => ""

			,"adjFacTotal" => ""
			,"valAdjFacTotal" => 0

			,"kind1" => ""
			,"propertyActualUse1" => ""
			,"propertyAdjMrktVal1" => ""
			,"level1" => ""
			,"assessedValue1" => ""

			,"kind2" => ""
			,"propertyActualUse2" => ""
			,"propertyAdjMrktVal2" => ""
			,"level2" => ""
			,"assessedValue2" => ""

			,"kind3" => ""
			,"propertyActualUse3" => ""
			,"propertyAdjMrktVal3" => ""
			,"level3" => ""
			,"assessedValue3" => ""

			,"kind4" => ""
			,"propertyActualUse4" => ""
			,"propertyAdjMrktVal4" => ""
			,"level4" => ""
			,"assessedValue4" => ""

			,"kind5" => ""
			,"propertyActualUse5" => ""
			,"propertyAdjMrktVal5" => ""
			,"level5" => ""
			,"assessedValue5" => ""

			,"propertyAdjMrktValTotal" => 0
			,"propertyTotal" => 0

			,"previousOwner" => ""
			,"taxability" => ""
			,"previousAssessedValue" => ""
			,"effectivity" => ""

			,"assessedBy" => ""
			,"dateAssessedBy" => ""

			,"recommendingApproval" => ""
			,"dateRecommendingApproval" => ""

			,"approvedBy" => ""
			,"dateApprovedBy" => ""

			,"memoranda" => ""

			,"previous1" => ""
			,"present1" => ""
			,"init1" => ""
			,"date1" => ""

			,"previous2" => ""
			,"present2" => ""
			,"init2" => ""
			,"date2" => ""

			,"previous3" => ""
			,"present3" => ""
			,"init3" => ""
			,"date3" => ""

		);

		$this->formArray["odID"] = $odID;
		$this->formArray["ownerID"] = $ownerID;
		$this->formArray["afsID"] = $afsID;
        
		$this->formArray["propertyID"] = $propertyID;
        $this->formArray["propertyType"] = $propertyType;
		$this->formArray["print"] = $print;

		$this->pl = 0;

		$this->valAdjFacTotal = 0;
		$this->propertyAdjMrktValTotal = 0;
		$this->propertyTotal = 0;

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

		$this->formatCurrency("landTotal");
		$this->formatCurrency("plantTotal");

		$this->formatCurrency("unitValue1");
		$this->formatCurrency("unitValue2");
		$this->formatCurrency("unitValue3");
		$this->formatCurrency("unitValue4");
		$this->formatCurrency("unitValue5");
		$this->formatCurrency("unitValue6");
		$this->formatCurrency("unitValue7");
		$this->formatCurrency("unitValue8");
		$this->formatCurrency("unitValue9");

		$this->formatCurrency("landMrktVal1");
		$this->formatCurrency("landMrktVal2");
		$this->formatCurrency("landMrktVal3");
		$this->formatCurrency("landMrktVal4");
		$this->formatCurrency("landMrktVal5");
		$this->formatCurrency("landMrktVal6");
		$this->formatCurrency("landMrktVal7");
		$this->formatCurrency("landMrktVal8");
		$this->formatCurrency("landMrktVal9");

		$this->formatCurrency("unitPrice1");
		$this->formatCurrency("unitPrice2");
		$this->formatCurrency("unitPrice3");
		$this->formatCurrency("unitPrice4");
		$this->formatCurrency("unitPrice5");
		$this->formatCurrency("unitPrice6");
		$this->formatCurrency("unitPrice7");
		$this->formatCurrency("unitPrice8");
		$this->formatCurrency("unitPrice9");

		$this->formatCurrency("plantMrktVal1");
		$this->formatCurrency("plantMrktVal2");
		$this->formatCurrency("plantMrktVal3");
		$this->formatCurrency("plantMrktVal4");
		$this->formatCurrency("plantMrktVal5");
		$this->formatCurrency("plantMrktVal6");
		$this->formatCurrency("plantMrktVal7");
		$this->formatCurrency("plantMrktVal8");
		$this->formatCurrency("plantMrktVal9");

		$this->formatCurrency("valueAdjustment1");
		$this->formatCurrency("valueAdjustment2");
		$this->formatCurrency("valueAdjustment3");
		$this->formatCurrency("valueAdjustment4");
		$this->formatCurrency("valueAdjustment5");
		$this->formatCurrency("valueAdjustment6");

		$this->formatCurrency("valAdjFacMrktVal1");
		$this->formatCurrency("valAdjFacMrktVal2");
		$this->formatCurrency("valAdjFacMrktVal3");
		$this->formatCurrency("valAdjFacMrktVal4");
		$this->formatCurrency("valAdjFacMrktVal5");
		$this->formatCurrency("valAdjFacMrktVal6");

		$this->formatCurrency("valAdjFacAdjMrktVal1");
		$this->formatCurrency("valAdjFacAdjMrktVal2");
		$this->formatCurrency("valAdjFacAdjMrktVal3");
		$this->formatCurrency("valAdjFacAdjMrktVal4");
		$this->formatCurrency("valAdjFacAdjMrktVal5");
		$this->formatCurrency("valAdjFacAdjMrktVal6");
		
		$this->formatCurrency("propertyAdjMrktVal1");
		$this->formatCurrency("propertyAdjMrktVal2");
		$this->formatCurrency("propertyAdjMrktVal3");
		$this->formatCurrency("propertyAdjMrktVal4");
		$this->formatCurrency("propertyAdjMrktVal5");

		$this->formatCurrency("assessedValue1");
		$this->formatCurrency("assessedValue2");
		$this->formatCurrency("assessedValue3");
		$this->formatCurrency("assessedValue4");
		$this->formatCurrency("assessedValue5");

		$this->formatCurrency("valAdjFacTotal");
		$this->formatCurrency("propertyAdjMrktValTotal");
		$this->formatCurrency("propertyTotal");

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
		
		$ownerPersonName = "";
		$address = "";
		if (count($owner->personArray)){
			foreach($owner->personArray as $personKey =>$personValue){
				if ($ownerPersonName == ""){
					if(is_object($personValue->addressArray[0])){
						$address = $personValue->addressArray[0]->getFullAddress();
						$address1 = $personValue->addressArray[0]->getNumber();
						if($address1!="")
							$address1 .= " ";
						$address1 .= $personValue->addressArray[0]->getStreet();
						if($address1!="")
							$address1 .= ", ";
						$address1 .= $personValue->addressArray[0]->getBarangay();
						if($personValue->addressArray[0]->getDistrict()!="none" && $personValue->addressArray[0]->getDistrict()!="0" && $personValue->addressArray[0]->getDistrict()!="")
							$address2 = $personValue->addressArray[0]->getDistrict();							
						else
							$address2 = "";
						if($address2 != "")
							$address2 .= ", ";
						$address2 .= $personValue->addressArray[0]->getMunicipalityCity();
						if($address2 != "")
							$address2 .= ", ";
						$address2.= $personValue->addressArray[0]->getProvince();
					}

					$ownerPersonName = $personValue->getName();
				}
				else{
					$ownerPersonName = $ownerPersonName." , ".$personValue->getName();

					//$ownerPersonName = $ownerName." , ".$personValue->getName();
				}
			}
		}
		
		$ownerCompanyName = "";
		if (count($owner->companyArray)){
			foreach ($owner->companyArray as $companyKey => $companyValue){
				if ($ownerCompanyName == ""){
					if($address==""){
						if(is_object($companyValue->addressArray[0])){
							$address = $companyValue->addressArray[0]->getFullAddress();
							$address1 = $companyValue->addressArray[0]->getNumber();
							if($address1!="")
								$address1 .= " ";
							$address1.= $companyValue->addressArray[0]->getStreet();
							if($address1!="")
								$address1 .= ", ";
							$address1.= $companyValue->addressArray[0]->getBarangay();
							if($companyValue->addressArray[0]->getDistrict()!="none" && $companyValue->addressArray[0]->getDistrict()!="0" && $companyValue->addressArray[0]->getDistrict()!="")
								$address2 = $companyValue->addressArray[0]->getDistrict();							
							else
								$address2 = "";
							if($address2!="")
								$address2 .= ", ";
							$address2.= $companyValue->addressArray[0]->getMunicipalityCity();
							if($address2!="")
								$address2 .= ", ";
							$address2 .= $companyValue->addressArray[0]->getProvince();
						}
					}

					$ownerCompanyName = $companyValue->getCompanyName();
				}
				else{
					$ownerCompanyName = $ownerCompanyName." , ".$companyValue->getCompanyName();
				}
			}
		}

		$ownerName = $ownerPersonName;
		if($ownerCompanyName!=""){
			if($ownerPersonName==""){
				$ownerName = $ownerCompanyName;
			}
			else{
				$ownerName = $ownerPersonName . " , " . $ownerCompanyName;
			}
		}

		$this->formArray["owner"] = $ownerName;
		$this->formArray["ownerAddress1"] = $address1;
		$this->formArray["ownerAddress2"] = $address2;

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
						$this->formArray["cityMunicipality"] = $od->locationAddress->getMunicipalityCity();
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

	function displayLandList($landList){
		$landTotal = 0;
        if (count($landList)){
			$l = 0;
			foreach ($landList as $key => $land){
				if($this->pl==0){
					//$this->formArray["arpNumber"] = $land->getArpNumber();
					//$this->formArray["propertyIndexNumber"] = $land->getPropertyIndexNumber();
					$this->formArray["octTctNumber"] = $land->getOctTctNumber();
					$this->formArray["surveyNumber"] = $land->getSurveyNumber();

					$this->formArray["north"] = $land->getNorth();
					$this->formArray["east"] = $land->getEast();
					$this->formArray["south"] = $land->getSouth();
					$this->formArray["west"] = $land->getWest();

					//$this->formArray["taxability"] = $land->getTaxability();
					//$this->formArray["effectivity"] = $land->getEffectivity();

					$this->formArray["memoranda"] = $land->getMemoranda();

					if (is_a($land->propertyAdministrator,Person)){
						if($land->propertyAdministrator->getLastName()!=""){
							$this->formArray["administrator"] = $land->propertyAdministrator->getFullName();
						}
						if (is_a($land->propertyAdministrator->addressArray[0],"address")){
							$address1 = $land->propertyAdministrator->addressArray[0]->getNumber();

							if($address1!="")
								$address1 .= " ";

							$address1 .= $land->propertyAdministrator->addressArray[0]->getStreet();

							if($address1!="")
								$address1 .= ", ";

							$address1.= $land->propertyAdministrator->addressArray[0]->getBarangay();

							$address2 = $land->propertyAdministrator->addressArray[0]->getDistrict();

							if($address2!="")
								$address2 .= ", ";

							$address2 .= $land->propertyAdministrator->addressArray[0]->getMunicipalityCity();

							if($address2!="")
								$address2 .= ", ";

							$address2 .= $land->propertyAdministrator->addressArray[0]->getProvince();

							$this->formArray["adminAddress1"] = $address1;
							$this->formArray["adminAddress2"] = $address2;
						}
						$this->formArray["adminTelno"] = $land->propertyAdministrator->getTelephone();
					}

					// recommendingApproval
					if(is_numeric($land->recommendingApproval))
					{
						$recommendingApproval = new Person;
						$recommendingApproval->selectRecord($land->recommendingApproval);
						$this->formArray["recommendingApproval"] = $recommendingApproval->getFullName();
						$this->recommendingApproval = $recommendingApproval->getFullName();
					}
					else{
						$recommendingApproval = $land->recommendingApproval;
						$this->formArray["recommendingApproval"] = $recommendingApproval;
						$this->recommendingApproval = $recommendingApproval;
					}

					$this->formArray["dateRecommendingApproval"] = $land->getRecommendingApprovalDate();

					// approvedBy
					if(is_numeric($land->approvedBy))
					{
						$approvedBy = new Person;
						$approvedBy->selectRecord($land->approvedBy);
						$this->formArray["approvedBy"] = $approvedBy->getFullName();
						$this->approvedBy = $approvedBy->getFullName();
					}
					else{
						$approvedBy = $land->approvedBy;
						$this->formArray["approvedBy"] = $approvedBy;
						$this->approvedBy = $approvedBy;
					}
					$this->formArray["dateApprovedBy"] = $land->getApprovedByDate();

					// appraisedBy (assessedBy)
					if(is_numeric($land->appraisedBy))
					{
						$appraisedBy = new Person;
						$appraisedBy->selectRecord($land->appraisedBy);
						$this->formArray["assessedBy"] = $appraisedBy->getFullName();
						$this->appraisedBy = $appraisedBy->getFullName();
					}
					else{
						$appraisedBy = $land->appraisedBy;
						$this->formArray["assessedBy"] = $appraisedBy;
						$this->appraisedBy = $appraisedBy;
					}
					$this->formArray["dateAssessedBy"] = $land->getAppraisedByDate();
				}


				if($l < 9){

					// classification
					$landClasses = new LandClasses;
					if(is_numeric($land->getClassification())){
						$landClasses->selectRecord($land->getClassification());
						$this->formArray["classification".($l+1)] = $landClasses->getDescription();
					}
					else{
						$this->formArray["classification".($l+1)] = $land->getClassification();
					}

					// subClass
					$landSubclasses = new LandSubclasses;
					if(is_numeric($land->getSubClass())){
						$landSubclasses->selectRecord($land->getSubClass());
						$this->formArray["subClass".($l+1)] = $landSubclasses->getDescription();
					}
					else{
						$this->formArray["subClass".($l+1)] = $land->getSubClass();
					}

					$this->formArray["area".($l+1)] = $land->getArea()." ".$this->getUnit($land->getUnit);

					// actualUse
					$landActualUses = new LandActualUses;
					if(is_numeric($land->getActualUse())){
						$landActualUses->selectRecord($land->getActualUse());
						$this->formArray["landActualUse".($l+1)] = $landActualUses->getDescription();
					}
					else{
						$this->formArray["landActualUse".($l+1)] = $land->getActualUse();
					}

					$this->formArray["unitValue".($l+1)] = $land->getUnitValue();
					$this->formArray["landMrktVal".($l+1)] = $land->getMarketValue();
					$landTotal = $landTotal + toFloat($land->getMarketValue());
				}
				if($this->pl < 6){
					$this->formArray["valAdjFacMrktVal".($this->pl+1)] = $land->getMarketValue();
					$this->formArray["adjFacTxt".($this->pl+1)] = $land->getAdjustmentFactor();
					$this->formArray["adjFacInt".($this->pl+1)] = "L";
					$this->formArray["adjustment".($this->pl+1)] = $land->getPercentAdjustment();
					$this->formArray["valueAdjustment".($this->pl+1)] = $land->getValueAdjustment();
					$this->formArray["valAdjFacAdjMrktVal".($this->pl+1)] = $land->getAdjustedMarketValue();
					$this->formArray["valAdjFacTotal"] = $this->formArray["valAdjFacTotal"] + toFloat($land->getAdjustedMarketValue());
				}
				if($this->pl < 5){
					$this->formArray["kind".($this->pl+1)] = "Land";

					if(is_numeric($land->getActualUse())){
						$landActualUses->selectRecord($land->getActualUse());
						$this->formArray["propertyActualUse".($this->pl+1)] = $landActualUses->getDescription();
					}
					else{
						$this->formArray["propertyActualUse".($this->pl+1)] = $land->getActualUse();
					}

					$this->formArray["propertyAdjMrktVal".($this->pl+1)] = $land->getAdjustedMarketValue();
					$this->formArray["level".($this->pl+1)] = $land->getAssessmentLevel();
					$this->formArray["assessedValue".($this->pl+1)] = $land->getAssessedValue();
					$this->formArray["propertyAdjMrktValTotal"] = $this->formArray["propertyAdjMrktValTotal"] + toFloat($land->getAdjustedMarketValue());
					$this->formArray["propertyTotal"] = $this->formArray["propertyTotal"] + toFloat($land->getAssessedValue());
				}

				$l++;
				$this->pl++;
			}
		}
		$this->formArray["landTotal"] = $landTotal;
	}

	function displayPlantsTreesList($plantsTreesList){
		$plantTotal = 0;
        if (count($plantsTreesList)){
			$p = 0;
			foreach ($plantsTreesList as $key => $plantsTrees){
				if($this->pl==0){
					//$this->formArray["arpNumber"] = $plantsTrees->getArpNumber();
					//$this->formArray["propertyIndexNumber"] = $plantsTrees->getPropertyIndexNumber();
					$this->formArray["surveyNumber"] = $plantsTrees->getSurveyNumber();

					//$this->formArray["taxability"] = $plantsTrees->getTaxability();
					//$this->formArray["effectivity"] = $plantsTrees->getEffectivity();

					$this->formArray["memoranda"] = $plantsTrees->getMemoranda();

					if (is_a($plantsTrees->propertyAdministrator,Person)){
						$this->formArray["administrator"] = $plantsTrees->propertyAdministrator->getFullName();
						if (is_a($plantsTrees->propertyAdministrator->addressArray[0],"address")){
							$address1 = $plantsTrees->propertyAdministrator->addressArray[0]->getNumber();
							$address1.= " ".$plantsTrees->propertyAdministrator->addressArray[0]->getStreet();
							$address1.= ", ".$plantsTrees->propertyAdministrator->addressArray[0]->getBarangay();
							
							$address2 = $plantsTrees->propertyAdministrator->addressArray[0]->getDistrict();
							$address2.= ", ".$plantsTrees->propertyAdministrator->addressArray[0]->getMunicipalityCity();
							$address2.= ", ".$plantsTrees->propertyAdministrator->addressArray[0]->getProvince();

							$this->formArray["adminAddress1"] = $address1;
							$this->formArray["adminAddress2"] = $address2;
						}
						$this->formArray["adminTelno"] = $plantsTrees->propertyAdministrator->getTelephone();
					}

					if($this->recommendingApproval==""){
						if(is_numeric($plantsTrees->recommendingApproval))
						{
							$recommendingApproval = new Person;
							$recommendingApproval->selectRecord($plantsTrees->recommendingApproval);
							$this->formArray["recommendingApproval"] = $recommendingApproval->getFullName();
							$this->recommendingApproval = $recommendingApproval->getFullName();
						}
						else{
							$recommendingApproval = $land->recommendingApproval;
							$this->formArray["recommendingApproval"] = $recommendingApproval;
							$this->recommendingApproval = $recommendingApproval;
						}
					}

					$this->formArray["dateRecommendingApproval"] = $plantsTrees->getRecommendingApprovalDate();

					if($this->approvedBy==""){
						if(is_numeric($plantsTrees->approvedBy))
						{
							$approvedBy = new Person;
							$approvedBy->selectRecord($plantsTrees->approvedBy);
							$this->formArray["approvedBy"] = $approvedBy->getFullName();
							$this->approvedBy = $approvedBy->getFullName();
						}
						else{
							$approvedBy = $approvedBy->recommendingApproval;
							$this->formArray["approvedBy"] = $approvedBy;
							$this->approvedBy = $approvedBy;
						}
					}

					$this->formArray["dateApprovedBy"] = $plantsTrees->getApprovedByDate();
				}
				if($p < 9){
					// productClass
					$plantsTreesClasses = new PlantsTreesClasses;
					if(is_numeric($plantsTrees->getProductClass())){
						$plantsTreesClasses->selectRecord($plantsTrees->getProductClass());
						$this->formArray["productClass".($p+1)] = $plantsTreesClasses->getDescription();
					}
					else{
						$this->formArray["productClass".($p+1)] = $plantsTrees->getProductClass();
					}

					$this->formArray["areaPlanted".($p+1)] = $plantsTrees->getAreaPlanted();
					$this->formArray["totalNumber".($p+1)] = $plantsTrees->getTotalNumber();
					$this->formArray["nonFruit".($p+1)] = $plantsTrees->getNonFruitBearing();
					$this->formArray["fruit".($p+1)] = $plantsTrees->getFruitBearing();
					$this->formArray["age".($p+1)] = $plantsTrees->getAge();
					$this->formArray["unitPrice".($p+1)] = $plantsTrees->getUnitPrice();
					$this->formArray["plantMrktVal".($p+1)] = $plantsTrees->getMarketValue();
					$plantTotal = $plantTotal + toFloat($plantsTrees->getMarketValue());
				}
				if($this->pl < 6){
					$this->formArray["valAdjFacMrktVal".($this->pl+1)] = $plantsTrees->getMarketValue();
					$this->formArray["adjFacTxt".($this->pl+1)] = $plantsTrees->getAdjustmentFactor();
					$this->formArray["adjFacInt".($this->pl+1)] = "P";
					$this->formArray["adjustment".($this->pl+1)] = $plantsTrees->getPercentAdjustment();
					$this->formArray["valueAdjustment".($this->pl+1)] = $plantsTrees->getValueAdjustment();
					$this->formArray["valAdjFacAdjMrktVal".($this->pl+1)] = $plantsTrees->getAdjustedMarketValue();
					$this->formArray["valAdjFacTotal"] = $this->formArray["valAdjFacTotal"] + toFloat($plantsTrees->getAdjustedMarketValue());
				}
				if($this->pl < 5){
					$this->formArray["kind".($this->pl+1)] = $plantsTrees->getKind();

					// actualUse

					$plantsTreesActualUses = new PlantsTreesActualUses;
					if(is_numeric($plantsTrees->getActualUse())){
						$plantsTreesActualUses->selectRecord($plantsTrees->getActualUse());
						$this->formArray["propertyActualUse".($this->p+1)] = $plantsTreesActualUses->getDescription();
					}
					else{
						$this->formArray["propertyActualUse".($this->p+1)] = $plantsTrees->getActualUse();
					}

					$this->formArray["propertyAdjMrktVal".($this->pl+1)] = $plantsTrees->getAdjustedMarketValue();
					$this->formArray["level".($this->pl+1)] = $plantsTrees->getAssessmentLevel();
					$this->formArray["assessedValue".($this->pl+1)] = $plantsTrees->getAssessedValue();
					$this->formArray["propertyAdjMrktValTotal"] = $this->formArray["propertyAdjMrktValTotal"] + toFloat($plantsTrees->getAdjustedMarketValue());
					$this->formArray["propertyTotal"] = $this->formArray["propertyTotal"] + toFloat($plantsTrees->getAssessedValue());
				}
				$p++;
				$this->pl++;
			}
		}
		$this->formArray["plantTotal"] = $plantTotal;
	}

	function getUnit($unit){
		switch($unit){
			case "square meters":
				$ret = "sq.m";
				break;
			case "hectares":
				$ret = "ha.";
				break;
			default:
				$ret = "";
				break;
		}
		return $ret;
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

				$landList = $afs->getLandArray();

				if(count($landList)){
					$this->displayLandList($landList);
				}

				$plantsTreesList = $afs->getPlantsTreesArray();

				if(count($plantsTreesList)){
					$this->displayPlantsTreesList($plantsTreesList);
				}
			}
		}

		$this->setForm();
		
        $this->tpl->parse("templatePage", "rptsTemplate");
        $this->tpl->finish("templatePage");

		$testpdf = new PDFWriter;
        $testpdf->setOutputXML($this->tpl->get("templatePage"),"test");
        if(isset($this->formArray["print"])){
        	$testpdf->writePDF($name);//,$this->formArray["print"]);
        }
        else {
        	$testpdf->writePDF($name);
        }

		//header("location: ".$testpdf->pdfPath);
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
	//,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/

$printLandFAAS = new PrintLandFAAS($HTTP_POST_VARS,$sess,$odID,$ownerID,$afsID,$print);
$printLandFAAS->Main();
?>
<?php page_close(); ?>
