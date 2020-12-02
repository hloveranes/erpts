<?php
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "./clibPDFWriter.php";
include_once "../assessor/Barangay.php";

include_once "../assessor/Address.php";
include_once "../assessor/Company.php";
include_once "../assessor/CompanyRecords.php";
include_once "../assessor/Person.php";
include_once "../assessor/PersonRecords.php";
include_once "../assessor/Owner.php";
include_once "../assessor/OwnerRecords.php";
include_once "../assessor/RPTOP.php";
include_once "../assessor/AFS.php";
include_once "../assessor/OD.php";

#####################################
# Define Interface Class
#####################################
class TDDetails{
	
	var $tpl;
	var $formArray;
	function TDDetails($http_post_vars,$sess,$tdID,$propertyID,$propertyType,$print){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "td.xml") ;
		$this->tpl->set_var("TITLE", "TD Details");
		
       	$this->formArray = array(
			"tdNumber" => ""
			, "propertyIndexNumber" => ""
			, "Owner" => ""
			, "Address" => ""
			, "administrator" => ""
			, "adminAddress" => ""
			, "location" => ""
			, "certificateOfTitleNumber" => ""
			, "cadastralLotNumber" => ""
			, "lotNumber" => ""
			, "blockNumber" => ""
			, "north" => ""
			, "south" => ""
			, "east" => ""
			, "west" => ""
			
			, "oLKind1" => ""
			, "oLKind2" => ""
			, "oLKind3" => ""
			, "oLKind4" => ""
			, "oLKind5" => ""
			, "oLKind6" => ""
			, "oLArea1" => ""
			, "oLArea2" => ""
			, "oLArea3" => ""
			, "oLArea4" => ""
			, "oLArea5" => ""
			, "oLArea6" => ""
			, "oLValue1" => ""
			, "oLValue2" => ""
			, "oLValue3" => ""
			, "oLValue4" => ""
			, "oLValue5" => ""
			, "oLValue6" => ""
			, "oLTotalValue" => ""
			, "lKind1" => ""
			, "lKind2" => ""
			, "lKind3" => ""
			, "lKind4" => ""
			, "lKind5" => ""
			, "lKind6" => ""
			, "lArea1" => ""
			, "lArea2" => ""
			, "lArea3" => ""
			, "lArea4" => ""
			, "lArea5" => ""
			, "lArea6" => ""
			, "lClass1" => ""
			, "lClass2" => ""
			, "lClass3" => ""
			, "lClass4" => ""
			, "lClass5" => ""
			, "lClass6" => ""
			, "lUnitValue1" => ""
			, "lUnitValue2" => ""
			, "lUnitValue3" => ""
			, "lUnitValue4" => ""
			, "lUnitValue5" => ""
			, "lUnitValue6" => ""
			, "lMarketValue1" => ""
			, "lMarketValue2" => ""
			, "lMarketValue3" => ""
			, "lMarketValue4" => ""
			, "lMarketValue5" => ""
			, "lMarketValue6" => ""
			, "lTotalMarketValue" => ""
			, "lTotalAdjMarketValue" => ""

			, "oPKind1" => ""
			, "oPKind2" => ""
			, "oPKind3" => ""
			, "oPKind4" => ""
			, "oPKind5" => ""
			, "oPKind6" => ""
			, "oPKind7" => ""
			, "oPKind8" => ""
			, "oPKind9" => ""
			, "oPQuantity1" => ""
			, "oPQuantity2" => ""
			, "oPQuantity3" => ""
			, "oPQuantity4" => ""
			, "oPQuantity5" => ""
			, "oPQuantity6" => ""
			, "oPQuantity7" => ""
			, "oPQuantity8" => ""
			, "oPQuantity9" => ""
			, "oPValue1" => ""
			, "oPValue2" => ""
			, "oPValue3" => ""
			, "oPValue4" => ""
			, "oPValue5" => ""
			, "oPValue6" => ""
			, "oPValue7" => ""
			, "oPValue8" => ""
			, "oPValue9" => ""
			, "oPTotalValue" => ""

			, "pKind1" => ""
			, "pQuantity1" => ""
			, "pUnitValue1" => ""
			, "pMarketValue1" => ""
			, "pKind2" => ""
			, "pQuantity2" => ""
			, "pUnitValue2" => ""
			, "pMarketValue2" => ""
			, "pKind3" => ""
			, "pQuantity3" => ""
			, "pUnitValue3" => ""
			, "pMarketValue3" => ""
			, "pKind4" => ""
			, "pQuantity4" => ""
			, "pUnitValue4" => ""
			, "pMarketValue4" => ""
			, "pKind5" => ""
			, "pQuantity5" => ""
			, "pUnitValue5" => ""
			, "pMarketValue5" => ""
			, "pKind6" => ""
			, "pQuantity6" => ""
			, "pUnitValue6" => ""
			, "pMarketValue6" => ""
			, "pKind7" => ""
			, "pQuantity7" => ""
			, "pUnitValue7" => ""
			, "pMarketValue7" => ""
			, "pKind8" => ""
			, "pQuantity8" => ""
			, "pUnitValue8" => ""
			, "pMarketValue8" => ""
			, "pKind9" => ""
			, "pQuantity9" => ""
			, "pUnitValue9" => ""
			, "pMarketValue9" => "xxx.xx"
			, "pTotalMarketValue" => ""
			, "pTotalAdjMarketValue" => ""

			, "oL2Kind1" => ""
			, "oL2Area1" => ""
			, "oL2Value1" => ""
			, "oL2Kind2" => ""
			, "oL2Area2" => ""
			, "oL2Value2" => ""
			, "oL2Kind3" => ""
			, "oL2Area3" => ""
			, "oL2Value3" => ""
			, "oL2Kind4" => ""
			, "oL2Area4" => ""
			, "oL2Value4" => ""
			, "oL2Kind5" => ""
			, "oL2Area5" => ""
			, "oL2Value5" => ""
			, "oL2TotalValue" => ""

			, "l2Kind1" => ""
			, "l2Area1" => ""
			, "l2UnitValue1" => ""
			, "l2Adjustment1" => ""
			, "l2MarketValue1" => ""
			, "l2Kind2" => ""
			, "l2Area2" => ""
			, "l2UnitValue2" => ""
			, "l2Adjustment2" => ""
			, "l2MarketValue2" => ""
			, "l2Kind3" => ""
			, "l2Area3" => ""
			, "l2UnitValue3" => ""
			, "l2Adjustment3" => ""
			, "l2MarketValue3" => ""
			, "l2Kind4" => ""
			, "l2Area4" => ""
			, "l2UnitValue4" => ""
			, "l2Adjustment4" => ""
			, "l2MarketValue4" => ""
			, "l2Kind5" => ""
			, "l2Area5" => ""
			, "l2UnitValue5" => ""
			, "l2Adjustment5" => ""
			, "l2MarketValue5" => ""
			, "l2TotalMarketValue" => ""

			, "oBDescription1" => ""
			, "oBFloorArea1" => ""
			, "oB1stStorey1" => ""
			, "oB2ndStorey1" => ""
			, "oB3rdStorey1" => ""
			, "oBRoof1" => ""
			, "oBMarketValue1" => ""
			, "oBDescription2" => ""
			, "oBFloorArea2" => ""
			, "oB1stStorey2" => ""
			, "oB2ndStorey2" => ""
			, "oB3rdStorey2" => ""
			, "oBRoof2" => ""
			, "oBMarketValue2" => ""
			, "oBDescription3" => ""
			, "oBFloorArea3" => ""
			, "oB1stStorey3" => ""
			, "oB2ndStorey3" => ""
			, "oB3rdStorey3" => ""
			, "oBRoof3" => ""
			, "oBMarketValue3" => ""
			, "oBTotalMarketValue" => ""

			, "bDescription1" => ""
			, "bFloorArea1" => ""
			, "b1stStorey1" => ""
			, "b2ndStorey1" => ""
			, "b3rdStorey1" => ""
			, "bRoof1" => ""
			, "bMarketValue1" => ""
			, "bDescription2" => ""
			, "bFloorArea2" => ""
			, "b1stStorey2" => ""
			, "b2ndStorey2" => ""
			, "b3rdStorey2" => ""
			, "bRoof2" => ""
			, "bMarketValue2" => ""
			, "bDescription3" => ""
			, "bFloorArea3" => ""
			, "b1stStorey3" => ""
			, "b2ndStorey3" => ""
			, "b3rdStorey3" => ""
			, "bRoof3" => ""
			, "bMarketValue3" => ""
			, "bTotalMarketValue" => ""

			, "oMDescription1" => ""
			, "oMDateOfOperation1" => ""
			, "oMOriginalCost1" => ""
			, "oMDepreciation1" => ""
			, "oMMarketValue1" => ""
			, "oMDescription2" => ""
			, "oMDateOfOperation2" => ""
			, "oMOriginalCost2" => ""
			, "oMDepreciation2" => ""
			, "oMMarketValue2" => ""
			, "oMDescription3" => ""
			, "oMDateOfOperation3" => ""
			, "oMOriginalCost3" => ""
			, "oMDepreciation3" => ""
			, "oMMarketValue3" => ""
			, "oMTotalMarketValue" => ""

			, "mDescription1" => ""
			, "mDateOfOperation1" => ""
			, "mOriginalCost1" => ""
			, "mDepreciation1" => ""
			, "mMarketValue1" => ""
			, "mDescription2" => ""
			, "mDateOfOperation2" => ""
			, "mOriginalCost2" => ""
			, "mDepreciation2" => ""
			, "mMarketValue2" => ""
			, "mDescription3" => ""
			, "mDateOfOperation3" => ""
			, "mOriginalCost3" => ""
			, "mDepreciation3" => ""
			, "mMarketValue3" => ""
			, "mTotalMarketValue" => ""

			, "propertyKind1" => ""
			, "propertyActualUse1" => ""
			, "propertyMarketValue1" => ""
			, "propertyAssessmentLevel1" => ""
			, "propertyAssessedValue1" => ""
			, "propertyKind2" => ""
			, "propertyActualUse2" => ""
			, "propertyMarketValue2" => ""
			, "propertyAssessmentLevel2" => ""
			, "propertyAssessedValue2" => ""
			, "propertyKind3" => ""
			, "propertyActualUse3" => ""
			, "propertyMarketValue3" => ""
			, "propertyAssessmentLevel3" => ""
			, "propertyAssessedValue3" => ""
			, "propertyKind4" => ""
			, "propertyActualUse4" => ""
			, "propertyMarketValue4" => ""
			, "propertyAssessmentLevel4" => ""
			, "propertyAssessedValue4" => ""

			, "totalMarketValue" => ""
			, "totalAssessedValue" => ""
			, "totalAssessedValueInWords" => ""

		);
	 	$this->formArray["tdID"] = $tdID;
        $this->formArray["propertyID"] = $propertyID;
        $this->formArray["propertyType"] = $propertyType;
		$this->formArray["print"] = $print;
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
		$this->setForm();
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, htmlentities($value));
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
						$ownerName = $personValue->getName();
					}
					else{
						$ownerName = $ownerName." , ".$personValue->getName();
					}
				}
			}
			else{
			}
			if (count($owner->companyArray)){
				foreach ($owner->companyArray as $companyKey => $companyValue){
					if ($ownerName == ""){
						$address = $companyValue->addressArray[0]->getFullAddress();
						$ownerName = $companyValue->getCompanyName();
					}
					else{
						$ownerName = $ownerName." , ".$companyValue->getCompanyName();
					}
					
				}
			}
			else{
			}
			$this->tpl->set_var("Owner",htmlentities($ownerName));
			$this->tpl->set_var("Address",htmlentities($address));
		//}
	}
	function displayODAFS($afsID){
		$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
		if (!$odID = $AFSDetails->getOdID($afsID)){
			echo ("get od id failed");
		}
		else{
			$ODDetails = new SoapObject(NCCBIZ."ODDetails.php", "urn:Object");
			if (!$xmlStr = $ODDetails->getOD($odID)){
				exit("xml failed");
			}
			else{
				//exit($xmlStr);
				if(!$domDoc = domxml_open_mem($xmlStr)) {
					echo "error open xml";
				}
				else {
					$od = new OD;
					$od->parseDomDocument($domDoc);
					if (is_object($od->locationAddress)){
						$this->tpl->set_var("location",htmlentities($od->locationAddress->getFullAddress()));
						//$this->tpl->set_var("numberStreet",htmlentities($od->locationAddress->getNumber()." ".$od->locationAddress->getStreet()));
						//$this->tpl->set_var("barangayDistrict",htmlentities($od->locationAddress->getBarangay().", ".$od->locationAddress->getDistrict()));
						//$this->tpl->set_var("municipalityCityProvince",htmlentities($od->locationAddress->getMunicipalityCity().", ".$od->locationAddress->getProvince()));
					}
					$this->tpl->set_var("lotNumber",htmlentities($od->getLotNumber()));
					$this->tpl->set_var("blockNumber",htmlentities($od->getBlockNumber()));
					$ODEncode = new SoapObject(NCCBIZ."ODEncode.php", "urn:Object");
					$this->formArray["ownerID"] = $ODEncode->getOwnerID($this->formArray["odID"]);
					$xmlStr = $od->owner->domDocument->dump_mem(true);
					if (!$xmlStr){
						echo "error xml";
					}
					else {
						//echo $xmlStr;
						if(!$domDoc = domxml_open_mem($xmlStr)) {
							echo "error open xml";
						}
						else {
							$this->displayOwnerList($domDoc);
						}
					}
				}	
			}
		}
	}
	
	function displayTDDetails($propertyType){
		$propertyID = $this->formArray["propertyID"];
		
		$TDDetails = new SoapObject(NCCBIZ."TDDetails.php", "urn:Object");
		if (!$xmlStr = $TDDetails->getTD("",$propertyID,$propertyType)){
			$this->tpl->set_var("tdNumber", htmlentities("enter TD"));
			$this->tpl->set_var("tdID", htmlentities(""));
			$this->tpl->set_var("propertyType", htmlentities($propertyType));
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_var("tdNumber", htmlentities("enter TD"));
				$this->tpl->set_var("tdID", htmlentities(""));
				$this->tpl->set_var("propertyType", htmlentities($propertyType));
			}
			else {
				$td = new TD;
				$td->parseDomDocument($domDoc);
				$this->tpl->set_var("tdNumber", htmlentities($td->getTaxDeclarationNumber()));
				foreach($td as $tdkey => $tdvalue){
					switch ($tdkey){
						case "provincialAssessor":
							if (is_a($tdvalue,Assessor)){
								$this->tpl->set_var("provincialAssessorID", htmlentities($tdvalue->getAssessorID()));
								$this->tpl->set_var("provincialAssessorName", htmlentities($tdvalue->getFullName()));
							}
							else {
								$this->tpl->set_var($tdkey, htmlentities(""));
							}
						break;
						case "provincialAssessorDate":
							if (true){
								list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$tdvalue);
								$this->tpl->set_var("pa_yearValue", htmlentities(removePreZero($dateArr["year"])));
								eval(MONTH_ARRAY);//$monthArray
								$this->tpl->set_var("pa_month", htmlentities($monthArray[removePreZero($dateArr["month"])]));
								$this->tpl->set_var("pa_dayValue", htmlentities(removePreZero($dateArr["day"])));
							}
							else {
								$this->tpl->set_var($tdkey, htmlentities(""));
							}
						break;
						case "cityMunicipalAssessor":
							if (is_a($tdvalue,Assessor)){
								$this->tpl->set_var("cityMunicipalAssessorID", htmlentities($tdvalue->getAssessorID()));
								$this->tpl->set_var("cityMunicipalAssessorName", htmlentities($tdvalue->getFullName()));
							}
							else {
								$this->tpl->set_var($tdkey, htmlentities(""));
							}
						break;
						case "cityMunicipalAssessorDate":
							if (true){
								list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$tdvalue);
								$this->tpl->set_var("cm_yearValue", htmlentities(removePreZero($dateArr["year"])));
								eval(MONTH_ARRAY);//$monthArray
								$this->tpl->set_var("cm_month", htmlentities($monthArray[removePreZero($dateArr["month"])]));
								$this->tpl->set_var("cm_dayValue", htmlentities(removePreZero($dateArr["day"])));
							}
							else {
								$this->tpl->set_var($tdkey, htmlentities(""));
							}
						break;
						case "enteredInRPARForBy":
							if (is_a($tdvalue,Assessor)){
								$this->tpl->set_var("enteredInRPARForByID", htmlentities($tdvalue->getAssessorID()));
								$this->tpl->set_var("enteredInRPARForByName", htmlentities($tdvalue->getFullName()));
							}
							else {
								$this->tpl->set_var($tdkey, htmlentities(""));
							}
						break;
						default:
						$this->tpl->set_var($tdkey, htmlentities($tdvalue));
					}
				}
			}
		}
	}
	function displayLand($land){
		if ($land){
			if (is_a($land->propertyAdministrator,Person)){
				
				$this->tpl->set_var("administrator", htmlentities($land->propertyAdministrator->getFullName()));
				if (is_a($land->propertyAdministrator->addressArray[0],"address"))
				$this->tpl->set_var("adminAddress", htmlentities($land->propertyAdministrator->addressArray[0]->getFullAddress()));
			}
			$this->tpl->set_var("propertyIndexNumber",htmlentities($land->getPropertyIndexNumber()));
			$this->tpl->set_var("north",htmlentities($land->getNorth()));
			$this->tpl->set_var("south",htmlentities($land->getSouth()));
			$this->tpl->set_var("east",htmlentities($land->getEast()));
			$this->tpl->set_var("west",htmlentities($land->getWest()));
			$this->tpl->set_var("lKind1",htmlentities($land->getKind()));
			$this->tpl->set_var("lArea1",htmlentities($land->getArea()));
			$this->tpl->set_var("lClass1",htmlentities($land->getClassification()));
			$this->tpl->set_var("lUnitValue1",htmlentities($land->getUnitValue()));
			$this->tpl->set_var("lMarketValue1",htmlentities($land->getMarketValue()));
			$this->tpl->set_var("lTotalMarketValue",htmlentities($land->getMarketValue()));
			$this->tpl->set_var("lTotalAdjMarketValue",htmlentities($land->getAdjustedMarketValue()));
			$this->displayODAFS($land->getAfsID());
			$this->displayTDDetails("Land");
		}
		else {
			echo "land empty";
		}
	}
	function displayPlantsTrees($plantsTrees){
		if ($plantsTrees){
			if (is_a($plantsTrees->propertyAdministrator,Person)){
				
				$this->tpl->set_var("administrator", htmlentities($plantsTrees->propertyAdministrator->getFullName()));
				if (is_a($plantsTrees->propertyAdministrator->addressArray[0],"address"))
				$this->tpl->set_var("adminAddress", htmlentities($plantsTrees->propertyAdministrator->addressArray[0]->getFullAddress()));
			}
			$this->tpl->set_var("propertyIndexNumber",htmlentities($plantsTrees->getPropertyIndexNumber()));
			$this->tpl->set_var("pKind1",htmlentities($plantsTrees->getKind()));
			$this->tpl->set_var("pQuantity1",htmlentities($plantsTrees->getTotalNumber()));
			$this->tpl->set_var("pUnitValue1",htmlentities($plantsTrees->getUnitPrice()));
			$this->tpl->set_var("pMarketValue1",htmlentities($plantsTrees->getMarketValue()));
			$this->tpl->set_var("pTotalMarketValue",htmlentities($plantsTrees->getMarketValue()));
			$this->tpl->set_var("pTotalAdjMarketValue",htmlentities($plantsTrees->getAdjustedMarketValue()));
			$this->displayODAFS($plantsTrees->getAfsID());
			$this->displayTDDetails("PlantsTrees");
		}
		else {
			echo "trees empty";
		}
	}
	function displayImprovementsBuildings($improvementsBuildings){
		if ($improvementsBuildings){
			if (is_a($improvementsBuildings->propertyAdministrator,Person)){
				
				$this->tpl->set_var("administrator", htmlentities($improvementsBuildings->propertyAdministrator->getFullName()));
				if (is_a($improvementsBuildings->propertyAdministrator->addressArray[0],"address"))
				$this->tpl->set_var("adminAddress", htmlentities($improvementsBuildings->propertyAdministrator->addressArray[0]->getFullAddress()));
			}
			$this->tpl->set_var("propertyIndexNumber",htmlentities($improvementsBuildings->getPropertyIndexNumber()));
			$this->tpl->set_var("bDescription1",htmlentities($improvementsBuildings->getKind()));
			$this->tpl->set_var("bFloorArea1",htmlentities($improvementsBuildings->getAreaOfGroundFloor()));
			$this->tpl->set_var("bRoof1",htmlentities($improvementsBuildings->getRoof()));
			$this->tpl->set_var("bMarketValue1",htmlentities($improvementsBuildings->getMarketValue()));
			$this->tpl->set_var("bTotalMarketValue",htmlentities($improvementsBuildings->getMarketValue()));
			$this->tpl->set_var("bTotalAdjMarketValue",htmlentities($improvementsBuildings->getAdjustedMarketValue()));
			$this->displayODAFS($improvementsBuildings->getAfsID());
			$this->displayTDDetails("ImprovementsBuildings");			
		}
		else {
			echo "bldg empty";
		}
	}
	function displayMachineries($machineries){
		if ($machineries){
			if (is_a($machineries->propertyAdministrator,Person)){
				
				$this->tpl->set_var("administrator", htmlentities($machineries->propertyAdministrator->getFullName()));
				if (is_a($machineries->propertyAdministrator->addressArray[0],"address"))
				$this->tpl->set_var("adminAddress", htmlentities($machineries->propertyAdministrator->addressArray[0]->getFullAddress()));
			}
			$this->tpl->set_var("propertyIndexNumber",htmlentities($machineries->getPropertyIndexNumber()));

			$this->tpl->set_var("mDescription1",htmlentities($machineries->getKind()));
			$this->tpl->set_var("mDateOfOperation1",htmlentities($machineries->getDateOfOperation()));
			$this->tpl->set_var("mOriginalCost1",htmlentities($machineries->getAcquisitionCost()));
			$this->tpl->set_var("mDepreciation1",htmlentities($machineries->getDepreciation()));
			$this->tpl->set_var("mMarketValue1",htmlentities($machineries->getMarketValue()));
			$this->tpl->set_var("mTotalMarketValue",htmlentities($machineries->getMarketValue()));
			$this->tpl->set_var("mTotalAdjMarketValue",htmlentities($machineries->getAdjustedMarketValue()));

			$this->displayODAFS($machineries->getAfsID());
			$this->displayTDDetails("Machineries");						
		}
		else {
			echo "machine empty";
		}
	}
	
	function Main(){
							
        $propertyType = $this->formArray["propertyType"];
	    $propertyID = $this->formArray["propertyID"];
	
        switch ($propertyType){
			case "Land":
                $LandDetails = new SoapObject(NCCBIZ."LandDetails.php", "urn:Object");
                if (!$xmlStr = $LandDetails->getLand($propertyID)){
                    echo ("xml failed");
                }
                else{
                    if(!$domDoc = domxml_open_mem($xmlStr)) {
						echo "error open xml";
                    }
                    else {
                        $land = new Land;
                        $land->parseDomDocument($domDoc);
                        $this->formArray["landTotalMarketValue"] += tofloat($land->getMarketValue());
                        $this->formArray["landTotalAssessedValue"] += tofloat($land->getAssessedValue());
                        $this->displayLand($land);
                    }
                }
                break;
			
			case "PlantsTrees":
                $PlantsTreesDetails = new SoapObject(NCCBIZ."PlantsTreesDetails.php", "urn:Object");
                if (!$xmlStr = $PlantsTreesDetails->getPlantsTrees($propertyID)){
                    echo ("xml failed");
                }
                else{
                    if(!$domDoc = domxml_open_mem($xmlStr)) {
						echo "error open xml";
                    }
                    else {
                        $plantsTrees = new PlantsTrees;
                        $plantsTrees->parseDomDocument($domDoc);
                        //$plantsTrees->selectRecord($propertyID);
                        $this->formArray["plantTotalMarketValue"] += tofloat($plantsTrees->getMarketValue());
                        $this->formArray["plantTotalAssessedValue"] += tofloat($plantsTrees->getAssessedValue());
                        $this->displayPlantsTrees($plantsTrees);
                    }
                }
                break;
                    
                case "ImprovementsBuildings":
                    $ImprovementsBuildingsDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsDetails.php", "urn:Object");
                    if (!$xmlStr = $ImprovementsBuildingsDetails->getImprovementsBuildings($propertyID)){
                        echo ("xml failed");
                    }
                    else{
                        if(!$domDoc = domxml_open_mem($xmlStr)) {
							echo "error open xml";
                        }
                        else {
                            $improvementsBuildings = new ImprovementsBuildings;
                            $improvementsBuildings->parseDomDocument($domDoc);
                            $this->formArray["bldgTotalMarketValue"] += tofloat($improvementsBuildings->getMarketValue());
                            $this->formArray["bldgTotalAssessedValue"] += tofloat($improvementsBuildings->getAssessedValue());
                            $this->displayImprovementsBuildings($improvementsBuildings);
                        }
                    }
                break;
                
                case "Machineries":
                    $MachineriesDetails = new SoapObject(NCCBIZ."MachineriesDetails.php", "urn:Object");
                    if (!$xmlStr = $MachineriesDetails->getMachineries($propertyID)){
                        echo ("xml failed");
                    }
                    else{
                        if(!$domDoc = domxml_open_mem($xmlStr)) {
							echo "error open xml";
                        }
                        else {
                            $machineries = new Machineries;
		                    $machineries->parseDomDocument($domDoc);
	                        $this->formArray["machTotalMarketValue"] += tofloat($machineries->getMarketValue());
	                        $this->formArray["machTotalAssessedValue"] += tofloat($machineries->getAssessedValue());
	                        $this->displayMachineries($machineries);
		                }
		            }
		        break;
		
                default:
					echo ("wrong property type");
		}
				
        //$this->setForm();
		
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
		header("location: ".$testpdf->pdfPath);
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

$tdDetails = new TDDetails($HTTP_POST_VARS,$sess,$tdID,$propertyID,$propertyType,$print);
$tdDetails->Main();
?>
<?php page_close(); ?>
