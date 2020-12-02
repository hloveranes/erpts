<?php
include ("AFS.php";

class TestAFS {
	var $afs1;
	var $afs2;
	var $land1;
	var $land2;
	var $building1;
	var $building2;
	var $storeys1;
	var $storeys2;
	var $machine1;
	var $plants1;
	var $domAFSList;
	
	var $afsArray = "";
	var $landArray = "";
	var $improvementsBuildingsArray = "";
	var $storeysArray = "";
	var $machineriesArray = "";
	var $plantstreesArray = "";
	
	var $afsMarker = "";
	var $objID = -1;
	var $arrID = "";
	var $childObjID;
	var $ownerObj;
	var $afsObj = "";
	var $landObj = "";
	var $improvementsbuildingsObj = "";
	var $storeysObj = "";
	var $machineriesObj = "";
	var $plantstreesObj = "";

	function TestAFS(){
	    $this->owner1 = new Owner;	
        $this->owner2 = new Owner;	
		$this->person1 = new Person;
		$this->person2 = new Person;
		
		$this->company1 = new Company;
		$this->company2 = new Company;
		$this->address1 = new Address;
		
		$this->afs1 = new AFS;
		$this->afs2 = new AFS;
		$this->land1 = new Land;
		$this->land2 = new Land;
		$this->building1 = new ImprovementsBuildings;
		$this->storeys1 = new Storeys;
		$this->building2 = new ImprovementsBuildings;
		$this->storeys2 = new Storeys;
		$this->plants1 = new PlantsTrees;
		$this->machine1 = new Machineries;
	}
	
	function appendToDomList($rootNode,$childNode){
		$rootNode->append_child($childNode->document_element());
	}
	
	function parseDoc($baseNode,$id){
		if ($baseNode->has_child_nodes()){
			$child = $baseNode->first_child();
			$idx = 0;
			$rootID = $id;
			while ($child){
				if ($child->has_child_nodes()){
					if ($child->has_attributes()){
						$attributeArray = $child->attributes();
						foreach ($attributeArray as $key => $value){
							$id = $idx;
							if ($child->tagname() == "AFS"){
								$this->objID++;
							}
							//echo "\n\$this->".strtolower($child->tagname())."Obj[".$id."] = new ".$child->tagname().";\n";
							//echo "\$this->".strtolower($child->tagname())."Obj[".$id."]->set".ucfirst($value->name)."(\"".$value->value."\");\n";
							eval("\$this->".strtolower($child->tagname())."Obj[\$id] = new ".$child->tagname().";");
							eval("\$this->".strtolower($child->tagname())."Obj[\$id]->set".ucfirst($value->name)."(\"".$value->value."\");");
						} 
					}
					$this->parseDoc($child,$id);
				}
				else{
					$parent = $child->parent_node();
					$grandparent = $baseNode->parent_node();
					$grandparentTagname = $grandparent->tagname();
					if ($child->node_type() <> "3"){
					}
					else{
						//echo "\$this->".strtolower($grandparentTagname)."Obj[".$id."]->set".ucfirst($parent->tagname)."(\"".$child->get_content()."\");\n";
						eval("\$this->".strtolower($grandparentTagname)."Obj[\$id]->set".ucfirst($parent->tagname)."(\"".$child->get_content()."\");");	
					}
				}
				$child = $child->next_sibling();
				$idx++;
			}
			if (eregi("Array",$baseNode->tagname())){
				$parent = $baseNode->parent_node();
				if ($baseNode->has_child_nodes()){
					$childx = $baseNode->first_child();
						eval("\$arr = \$this->".strtolower($childx->tagname)."Obj;");
						//echo "\n"."\$arr = \$this->".strtolower($childx->tagname)."Obj;"."\n";
						foreach ($arr as $key => $value){
							//echo "\$this->".strtolower($childx->tagname)."Obj[".$key."]->setDom".ucfirst($childx	->tagname)."();";
							//echo "\$this->".strtolower($parent->tagname())."Obj[".$rootID."]->set".ucfirst($baseNode->tagname)."(\$this->".strtolower($childx->tagname)."Obj[".$key."]);\n";
							eval("\$this->".strtolower($childx->tagname)."Obj[".$key."]->setDom".ucfirst($childx->tagname)."();");
							eval("\$this->".strtolower($parent->tagname())."Obj[".$rootID."]->set".ucfirst($baseNode->tagname)."(\$this->".strtolower($childx->tagname)."Obj[".$key."]);");
						}
				}
			}
		}
	}
	function main(){
		$this->address1->setNumber("10");
		$this->address1->setStreet("Emerald Ave.");
		$this->address1->setDomAddress();
		
		$this->person1->setPersonID("123456789");
	    $this->person1->setLastname("dela Gracia");	
	    $this->person1->setFirstname("Eden");
	    $this->person1->setMiddlename("Fullentes");
	    $this->person1->setGender("F");
	    $this->person1->setBirthday("07/31/2000");
	    $this->person1->setAge("20");
	    $this->person1->setMaritalStatus("Single");
	    $this->person1->setTelephoneNumber("6875183");
	    $this->person1->setMobileNumber("09172551956");
	    $this->person1->setDOMPerson();
	    
	    $this->person2->setPersonID("987654321");
	    $this->person2->setLastname("Baggins");	
	    $this->person2->setFirstname("Iris");
	    $this->person2->setMiddlename("");
	    $this->person2->setGender("F");
	    $this->person2->setBirthday("07/31/1600");
	    $this->person2->setAge("305");
	    $this->person2->setMaritalStatus("Single");
	    $this->person2->setTelephoneNumber("9999999");
	    $this->person2->setMobileNumber("09171111111");
		$this->person2->setDOMPerson();
	    
	    $this->company1->setCompanyID("11111111");
	    $this->company1->setCompanyName("k2 Interactive, Inc");
	    $this->company1->setTelephone("6875183");
	    $this->company1->setFax("6319297");
	    $this->company1->setAddressArray($this->address1);
		$this->company1->setDomCompany();
	    
	    $this->company2->setCompanyID("2222222");
	    $this->company2->setCompanyName("k2 Hong Kong");
	    $this->company2->setTelephone("31027-7600");
	    $this->company2->setFax("3102-0500");
	    $this->company2->setDomCompany();
	    
	
		$this->owner1->setPersonArray($this->person1);
        $this->owner1->setPersonArray($this->person2);
		$this->owner1->setDomOwner();
        
        $this->owner2->setCompanyArray($this->company1);
        $this->owner2->setCompanyArray($this->company2);
        $this->owner2->setDomOwner();
				
		$this->afs1->setAfsID("1");
		///*
		$this->afs1->setOdID("odID");
		$this->afs1->setNumberStreet("numberStreet");
		$this->afs1->setMunicipalityCityProvince("munucipalityCityProvince");
		$this->afs1->setLandArea("landArea");
		$this->afs1->setLotNumber("lotNumber");
		$this->afs1->setZoneNumber("zoneNumber");
		$this->afs1->setBlockNumber("blockNumber");
		$this->afs1->setPsd13("psd13");
		$this->afs1->setBarangay("barangay");
		//$this->afs1->setOwner("owner");
		//*/
		$this->afs1->setPropertyIndexnumber("1234567890");
		$this->afs1->setNorth("hilaga");
		$this->afs1->setSouth("timog");
		$this->afs1->setEast("silangan");
		$this->afs1->setwest("kanluran");
		
		$this->afs2->setAfsID("2");
		$this->afs2->setPropertyIndexnumber("0987654321");
		$this->afs2->setNorth("hilaga2");
		$this->afs2->setSouth("timog2");
		$this->afs2->setEast("silangan2");
		$this->afs2->setwest("kanluran2");
			
		$this->land1->setLandID("1");
		$this->land1->setSurveyNumber("11111111");
		$this->land1->setClassification("classification1");
		$this->land1->setSubClass("subclass1");
		$this->land1->setArea("area1");
		$this->land1->setActualUse("actualuse1");
		$this->land1->setUnitValue("univalue1");
		$this->land1->setMarketValue("marketvalue1");
		$this->land1->setAdjustmentFactor("adjustmentfactor1");
		$this->land1->setPercentAdjustment("percentadjustment1");
		$this->land1->setValueAdjustment("valueadjustment1");
		$this->land1->setAdjustedMarketValue("adjustedmarketvalue1");
		$this->land1->setKind("kind1");
		$this->land1->setAssessmentLevel("assessmentlevel1");
		$this->land1->setAssessedValue("assessedvalue1");
			
		$this->land2->setLandID("2");
		$this->land2->setSurveyNumber("22222222");
		$this->land2->setClassification("classification2");
		$this->land2->setSubClass("subclass2");
		$this->land2->setArea("area2");
		$this->land2->setActualUse("actualuse2");
		$this->land2->setUnitValue("univalue2");
		$this->land2->setMarketValue("marketvalue2");
		$this->land2->setAdjustmentFactor("adjustmentfactor2");
		$this->land2->setPercentAdjustment("percentadjustment2");
		$this->land2->setValueAdjustment("valueadjustment2");
		$this->land2->setAdjustedMarketValue("adjustedmarketvalue2");
		$this->land2->setKind("kind2");
		$this->land2->setAssessmentLevel("assessmentlevel2");
		$this->land2->setAssessedValue("assessedvalue2");
				
		$this->building1->setSurveyNumber("111222");
		$this->building1->setBuildingClassification("building class");
		$this->building1->setBuildingPermit("building permit");
		$this->building1->setBuildingAge("building age");
		$this->building1->setDateOccupied("05/02/2001");
		$this->building1->setDateCompleted("05/02/2002");
		$this->building1->setAreaOfGroundFloor("25sqm");
		$this->building1->setTotalBuildingArea("200sqm");
		$this->building1->setMarketValue("360,000");
		$this->building1->setAssessmentLevel("a");
		$this->building1->setAssessmentValue("200,000");
		$this->building1->setDateAssessed("12/10/2002");
		$this->building1->setAssessor("nelson");
		$this->building1->setDomImprovementsBuildings();
		
		$this->storeys1->setFloorNumber("1st");
		$this->storeys1->setArea("20sqm");
		$this->storeys1->setMaterials("wood");
		$this->storeys1->setValue("20,000");
		$this->storeys1->setFoundation("concrete");
		$this->storeys1->setColumnsBeams("steel");
		$this->storeys1->setTrussFraming("steel");
		$this->storeys1->setRoof("tiles");
		$this->storeys1->setExteriorWall("concrete");
		$this->storeys1->setFlooring("wood");
		$this->storeys1->setDoors("wood");
		$this->storeys1->setWindows("glass");
		$this->storeys1->setStairs("wood");
		$this->storeys1->setWallFinish("blah");
		$this->storeys1->setElectrical("electrical");
		$this->storeys1->setToiletAndBath("3");
		$this->storeys1->setPlumbingSewer("ergge");
		$this->storeys1->setFixtures("frefefre");
		
		$this->building2->setSurveyNumber("111222");
		$this->building2->setBuildingClassification("building class");
		$this->building2->setBuildingPermit("building permit");
		$this->building2->setBuildingAge("building age");
		$this->building2->setDateOccupied("05/02/2001");
		$this->building2->setDateCompleted("05/02/2002");
		$this->building2->setAreaOfGroundFloor("25sqm");
		$this->building2->setTotalBuildingArea("200sqm");
		$this->building2->setMarketValue("360,000");
		$this->building2->setAssessmentLevel("a");
		$this->building2->setAssessmentValue("200,000");
		$this->building2->setDateAssessed("12/10/2002");
		$this->building2->setAssessor("nelson");
		$this->building2->setDomImprovementsBuildings();
		
		$this->storeys2->setFloorNumber("2nd");
		$this->storeys2->setArea("20sqm22");
		$this->storeys2->setMaterials("222wood");
		$this->storeys2->setValue("20,000222");
		$this->storeys2->setFoundation("22concrete");
		$this->storeys2->setColumnsBeams("22steel");
		$this->storeys2->setTrussFraming("222steel");
		$this->storeys2->setRoof("22tiles");
		$this->storeys2->setExteriorWall("22concrete");
		$this->storeys2->setFlooring("222wood");
		$this->storeys2->setDoors("222wood");
		$this->storeys2->setWindows("2222glass");
		$this->storeys2->setStairs("2222wood");
		$this->storeys2->setWallFinish("2222blah");
		$this->storeys2->setElectrical("222electrical");
		$this->storeys2->setToiletAndBath("2223");
		$this->storeys2->setPlumbingSewer("222ergge");
		$this->storeys2->setFixtures("222frefefre");
		
		$this->plants1->setPlantsTreesID("treesID");
		$this->plants1->setProductClass("ProductClass");
		$this->plants1->setAreaPlanted("AreaPlanted");
		$this->plants1->setTotalNumber("TotalNumber");
		$this->plants1->setNonFruitBearing("NonFruitBearing");
		$this->plants1->setFruitBearing("Fruitbearing");
		$this->plants1->setAge("age");
		$this->plants1->setUnitPrice("UnitPrice");
		$this->plants1->setMarketValue("MarketValue");
		$this->plants1->setValueAdjustment("ValueAdjustment");
		$this->plants1->setAdjustedMarketValue("AdjustedMarketValue");
		$this->plants1->setAssessmentLevel("AssessmentLevel");
		$this->plants1->setAssessedValue("AssessedValue");

		$this->machine1->setMachineriesID("machineid001");
		$this->machine1->setDescription("desc");
		$this->machine1->setBrandAndModel("brand");
		$this->machine1->setCapacityHP("capacity");
		$this->machine1->setDateAcquired("date acquired");
		$this->machine1->setConditionWhenAcquired("condition");
		$this->machine1->setEstimatedEconomicLife("estimate");
		$this->machine1->setRemainingEconomicLife("remaining");
		$this->machine1->setDateOfInstallation("date installed");
		$this->machine1->setdateOfOperation("date of operation");
		$this->machine1->setRemarks("remarks");
		$this->machine1->setNumberOfUnits("number of units");
		$this->machine1->setFreightAcquisitionCost("freight cost");
		$this->machine1->setInsuranceAcquisitionCost("insurance");
		$this->machine1->setInstallationAcquisitionCost("intallation cost");
		$this->machine1->setOthers("others");
		$this->machine1->setMarketValue("mkt val");
		$this->machine1->setDepreciation("depreciation");
		$this->machine1->setDepreciatedMarketValue("depreciated mk val");
		$this->machine1->setAsessmentLevel("ass level");
		$this->machine1->setAssessedValue("ass value");
		
		$this->land1->setDomLand();
		$this->land2->setDomLand();
		$this->storeys1->setDomStoreys();
		$this->storeys2->setDomStoreys();
		$this->building2->setStoreysArray($this->storeys1);	
		$this->building2->setStoreysArray($this->storeys2);	
		$this->building1->setDomImprovementsBuildings();
		$this->building2->setDomImprovementsBuildings();
		$this->plants1->setDomPlantsTrees();
		$this->machine1->setDomMachineries();
		$this->afs1->setOwnerArray($this->owner1);
		$this->afs2->setOwnerArray($this->owner2);
		$this->afs1->setLandArray($this->land1);
		$this->afs1->setLandArray($this->land2);
		$this->afs2->setImprovementsBuildingsArray($this->building1);
		$this->afs2->setImprovementsBuildingsArray($this->building2);
		$this->afs2->setPlantsTreesArray($this->plants1);
		$this->afs2->setMachineriesArray($this->machine1);
		$this->afs1->setDomAFS();
		$this->afs2->setDomAFS();

		$this->domAFSList = domxml_new_doc("1.0");
		$domList = $this->domAFSList->create_element("AFSList");
		$domList = $this->domAFSList->append_child($domList);
		$this->afs1 = $this->afs1->getDomAFS();
		$this->afs2 = $this->afs2->getDomAFS();
		$this->appendToDomList($domList,$this->afs1);
		$this->appendToDomList($domList,$this->afs2);

		$xmlStr =  $this->domAFSList->dump_mem(true);
		//echo $xmlStr;
		
		$soapObj = new SoapObject(NCCBIZ."TestSoapAFS.php", "urn:Object");
		echo $soapObj->getData();		
		
		if(!$dom = domxml_open_mem($xmlStr)) {
			echo "Error while parsing the document\n";
			exit;
		}
		
		
		$root = $dom->document_element();
		$this->parseDoc($root,0);
		
		echo "afs - ";
		print_r($this->afsObj);
		/*
		echo "\n\nland - ";
		print_r($this->landObj);
		echo "\n\nbldg - ";
		print_r($this->improvementsbuildingsObj);
		echo "\n\nstorey - ";
		print_r($this->storeysObj);
		echo "\n\nmach - ";
		print_r($this->machineriesObj);
		echo "\n\nplants - ";
		print_r($this->plantstreesObj);
		//*/
		$domerx = domxml_new_doc("1.0");
		$domer = $domerx->create_element("AFSList2");
		$domer = $domerx->append_child($domer);
		foreach($this->afsObj as $key => $val){
			$val->setDomAFS();
			$this->appendToDomList($domer,$val->getDomAFS());
		}
		$xmlStr = $domerx->dump_mem(true);
		//echo $xmlStr;
	}
}
$testAFS = new TestAFS();
$testAFS->main();
?>