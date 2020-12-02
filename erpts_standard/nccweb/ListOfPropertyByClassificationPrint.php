<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/LocationAddress.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/OD.php";
include_once "../includes/assessor/ODRecords.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/AFSRecords.php";
include_once "../includes/assessor/TD.php";
include_once "../includes/assessor/TDRecords.php";

include_once "../includes/assessor/Barangay.php";
include_once "../includes/assessor/BarangayRecords.php";
include_once "../includes/assessor/District.php";
include_once "../includes/assessor/DistrictRecords.php";
include_once "../includes/assessor/MunicipalityCity.php";
include_once "../includes/assessor/MunicipalityCityRecords.php";
include_once "../includes/assessor/Province.php";
include_once "../includes/assessor/ProvinceRecords.php";

include_once "../includes/assessor/LandActualUses.php";
include_once "../includes/assessor/PlantsTreesActualUses.php";
include_once "../includes/assessor/ImprovementsBuildingsActualUses.php";
include_once "../includes/assessor/MachineriesActualUses.php";

include_once "../includes/assessor/eRPTSSettings.php";

include_once "../includes/assessor/ODHistory.php";
include_once "../includes/assessor/ODHistoryRecords.php";

#####################################
# Define Interface Class
#####################################
class ListOfPropertyByClassificationPrint{
	
	var $tpl;
	var $formArray;
	var $sess;

	function ListOfPropertyByClassificationPrint($http_post_vars,$sess,$formAction,$formArray,$page=1){
		global $auth;
		//echo "username=>".$auth->auth["uname"];

		$this->formArray = $formArray;
		
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ListOfPropertyByClassificationPrint.htm") ;
		$this->tpl->set_var("TITLE", "List of Property By Classification");
		
		$this->sess = $sess;

		$this->formArray["formAction"] = $formAction;

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}

		$this->formArray["barangayID"] = $this->formArray["barangay"];
		$this->formArray["districtID"] = $this->formArray["district"];
		$this->formArray["municipalityCityID"] = $this->formArray["municipalityCity"];
		$this->formArray["provinceID"] = $this->formArray["province"];

		$this->formArray["page"] = $page;

		if($this->formArray["page"]==""){
			$this->formArray["page"] = 1;
		}
	}

	function filterDate(){
		$filterFromDate = $this->formArray["filterFrom_year"]
			."-"
			.putPreZero($this->formArray["filterFrom_month"])
			."-"
			.putPreZero($this->formArray["filterFrom_day"]);

		$filterToDate = $this->formArray["filterTo_year"]
			."-"
			.putPreZero($this->formArray["filterTo_month"])
			."-"
			.putPreZero($this->formArray["filterTo_day"])
			." 23:59:59";

		$filterFromTimeStr = strtotime($filterFromDate);
		$filterToTimeStr = strtotime($filterToDate);

		$condition = " ".OD_TABLE.".dateCreated >= ".$filterFromTimeStr."";
		$condition .= " AND ".OD_TABLE.".dateCreated <= ".$filterToTimeStr."";

		return $condition;
	}

	function filterArchives(){
		$condition = " AND ".OD_TABLE.".archive <> 'true'";
		$condition.= " GROUP BY ".OD_TABLE.".odID "; 
		$condition.= " ORDER BY ".OD_TABLE.".odID ASC";
		return $condition;
	}

	function filterLocationAddress(){
		$condition = "";

		if(is_numeric($this->formArray["provinceID"])){
			$condition .= LOCATIONADDRESS_TABLE.".province='".$this->formArray["provinceID"]."'";
		}
		if(is_numeric($this->formArray["municipalityCityID"])){
			if(is_numeric($this->formArray["provinceID"])){
				$condition .= " AND ";
			}
			$condition .= LOCATIONADDRESS_TABLE.".municipalityCity='".$this->formArray["municipalityCityID"]."'";
		}
		if(is_numeric($this->formArray["districtID"])){
			if(is_numeric($this->formArray["municipalityCityID"])){
				$condition .= " AND ";
			}
			$condition .= LOCATIONADDRESS_TABLE.".district='".$this->formArray["districtID"]."'";
		}
		if(is_numeric($this->formArray["barangayID"])){
			if(is_numeric($this->formArray["districtID"])){
				$condition .= " AND ";
			}
			$condition .= LOCATIONADDRESS_TABLE.".barangayID='".$this->formArray["barangayID"]."'";
		}

		if($this->formArray["provinceID"]=="" && $this->formArray["municipalityCityID"]=="" && $this->formArray["districtID"]=="" && $this->formArray["barangayID"]==""){
			$condition = LOCATIONADDRESS_TABLE.".province=''";
			$condition.= " AND ";
			$condition.= LOCATIONADDRESS_TABLE.".municipalityCity=''";
			$condition.= " AND ";
			$condition.= LOCATIONADDRESS_TABLE.".district=''";
			$condition.= " AND ";
			$condition.= LOCATIONADDRESS_TABLE.".barangayID=''";
		}

		return $condition;
	}

	function initLocationDetails($TempVar, $tempVar){

		$getDetails = "get".$TempVar."Details";

		$TempVarDetails = new SoapObject(NCCBIZ.$TempVar."Details.php", "urn:Object");
		if (!$xmlStr = $TempVarDetails->$getDetails($this->formArray[$tempVar."ID"])){
			// error xmlStr
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
			}
			else{
				switch($tempVar){
					case "barangay":
						$tempVarObject = new Barangay;
						break;
					case "district":
						$tempVarObject = new District;
						break;
					case "municipalityCity":
						$tempVarObject = new MunicipalityCity;
						break;
					case "province":
						$tempVarObject = new Province;
						break;
				}
				$tempVarObject->parseDomDocument($domDoc);
				$this->formArray[$tempVar] = $tempVarObject->getDescription();
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

	function getAFSDetails($odID){
		$AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
        $this->formArray["afsID"] = $AFSEncode->getAFSID($odID);

		if($this->formArray["afsID"]){
			$afs = new AFS;
			if($afs->selectRecord($this->formArray["afsID"])){
				return $afs;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	function setForm(){
		$this->tpl->set_var("formArray[filterByClassification]", $this->formArray["filterByClassification"]);
		$this->tpl->set_var("formArray[reportCode]", $this->formArray["reportCode"]);
		$this->tpl->set_var("formArray[filterByLocation]", $this->formArray["filterByLocation"]);
		$this->tpl->set_var("formArray[filterByDate]", $this->formArray["filterByDate"]);
		$this->tpl->set_var("formArray[province]", $this->formArray["province"]);
		$this->tpl->set_var("formArray[municipalityCity]", $this->formArray["municipalityCity"]);
		$this->tpl->set_var("formArray[district]", $this->formArray["district"]);
		$this->tpl->set_var("formArray[barangay]", $this->formArray["barangay"]);
		$this->tpl->set_var("formArray[filterFrom_month]", $this->formArray["filterFrom_month"]);
		$this->tpl->set_var("formArray[filterFrom_day]", $this->formArray["filterFrom_day"]);
		$this->tpl->set_var("formArray[filterFrom_year]", $this->formArray["filterFrom_year"]);
		$this->tpl->set_var("formArray[filterTo_month]", $this->formArray["filterTo_month"]);
		$this->tpl->set_var("formArray[filterTo_day]", $this->formArray["filterTo_day"]);
		$this->tpl->set_var("formArray[filterTo_year]", $this->formArray["filterTo_year"]);

		$this->initLocationDetails("Barangay", "barangay");
		$this->initLocationDetails("District", "district");
		$this->initLocationDetails("MunicipalityCity", "municipalityCity");
		$this->initLocationDetails("Province", "province");

		$this->formArray["reportCodeDescription"] = "";
		eval(REPORT_CODE_LIST);	
		foreach($reportCodeList as $key => $reportCode){
			if($reportCode["code"] == $this->formArray["reportCode"]){
				$this->formArray["reportCodeDescription"] = $reportCode["description"];
				break;
			}
		}


		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function filterByClassification($condition){
		$condition = str_replace("WHERE", "AND ", $condition);
		// landActualUses

		$sql = "SELECT "
				.OD_TABLE.".odID as odID, "
				.AFS_TABLE.".afsID as afsID, "
				.LAND_TABLE.".actualUse as actualUse FROM "
				.OD_TABLE.", "
				.LOCATION_TABLE.", "
				.LOCATIONADDRESS_TABLE.", "
				.BARANGAY_TABLE.", "
				.DISTRICT_TABLE.", "
				.MUNICIPALITYCITY_TABLE.", "
				.PROVINCE_TABLE.", "
				.AFS_TABLE.", "
				.LAND_TABLE.", "
				.LAND_ACTUALUSES_TABLE." WHERE "
				.OD_TABLE.".odID = ".AFS_TABLE.".odID AND "
				.AFS_TABLE.".afsID = ".LAND_TABLE.".afsID AND "
				.LAND_TABLE.".actualUse = ".LAND_ACTUALUSES_TABLE.".landActualUsesID AND "
				.OD_TABLE.".odID = ".LOCATION_TABLE.".odID AND "
				.LOCATION_TABLE.".odID = ".OD_TABLE.".odID AND "
				.LOCATIONADDRESS_TABLE.".locationAddressID = ".LOCATION_TABLE.".locationAddressID AND "
				.BARANGAY_TABLE.".barangayID = ".LOCATIONADDRESS_TABLE.".barangayID AND "
				.DISTRICT_TABLE.".districtID = ".LOCATIONADDRESS_TABLE.".district AND "
				.MUNICIPALITYCITY_TABLE.".municipalityCityID = ".LOCATIONADDRESS_TABLE.".municipalityCity AND "
				.PROVINCE_TABLE.".provinceID = ".LOCATIONADDRESS_TABLE.".province AND "
				.LAND_ACTUALUSES_TABLE.".reportCode = '".$this->formArray["reportCode"]."' ";
		$sql .= $condition;

		$dbLand = new DB_RPTS;
		$dbLand->query($sql);
		while($dbLand->next_record()){
			$odIDArray[] = $dbLand->f("odID");
		}

		// plantsTrees ActualUses

		$sql = "SELECT "
				.OD_TABLE.".odID as odID, "
				.AFS_TABLE.".afsID as afsID, "
				.PLANTSTREES_TABLE.".actualUse as actualUse FROM "
				.OD_TABLE.", "
				.LOCATION_TABLE.", "
				.LOCATIONADDRESS_TABLE.", "
				.BARANGAY_TABLE.", "
				.DISTRICT_TABLE.", "
				.MUNICIPALITYCITY_TABLE.", "
				.PROVINCE_TABLE.", "
				.AFS_TABLE.", "
				.PLANTSTREES_TABLE.", "
				.PLANTSTREES_ACTUALUSES_TABLE." WHERE "
				.OD_TABLE.".odID = ".AFS_TABLE.".odID AND "
				.AFS_TABLE.".afsID = ".PLANTSTREES_TABLE.".afsID AND "
				.PLANTSTREES_TABLE.".actualUse = ".PLANTSTREES_ACTUALUSES_TABLE.".plantsTreesActualUsesID AND "
				.OD_TABLE.".odID = ".LOCATION_TABLE.".odID AND "
				.LOCATION_TABLE.".odID = ".OD_TABLE.".odID AND "
				.LOCATIONADDRESS_TABLE.".locationAddressID = ".LOCATION_TABLE.".locationAddressID AND "
				.BARANGAY_TABLE.".barangayID = ".LOCATIONADDRESS_TABLE.".barangayID AND "
				.DISTRICT_TABLE.".districtID = ".LOCATIONADDRESS_TABLE.".district AND "
				.MUNICIPALITYCITY_TABLE.".municipalityCityID = ".LOCATIONADDRESS_TABLE.".municipalityCity AND "
				.PROVINCE_TABLE.".provinceID = ".LOCATIONADDRESS_TABLE.".province AND "
				.PLANTSTREES_ACTUALUSES_TABLE.".reportCode = '".$this->formArray["reportCode"]."' ";
		$sql .= $condition;

		$dbPlantsTrees = new DB_RPTS;
		$dbPlantsTrees->query($sql);
		while($dbPlantsTrees->next_record()){
			$odIDArray[] = $dbPlantsTrees->f("odID");
		}

		// improvementsBuildings ActualUses

		$sql = "SELECT "
				.OD_TABLE.".odID, "
				.AFS_TABLE.".afsID, "
				.IMPROVEMENTSBUILDINGS_TABLE.".actualUse FROM "
				.OD_TABLE.", "
				.LOCATION_TABLE.", "
				.LOCATIONADDRESS_TABLE.", "
				.BARANGAY_TABLE.", "
				.DISTRICT_TABLE.", "
				.MUNICIPALITYCITY_TABLE.", "
				.PROVINCE_TABLE.", "
				.AFS_TABLE.", "
				.IMPROVEMENTSBUILDINGS_TABLE.", "
				.IMPROVEMENTSBUILDINGS_ACTUALUSES_TABLE." WHERE "
				.OD_TABLE.".odID = ".AFS_TABLE.".odID AND "
				.AFS_TABLE.".afsID = ".IMPROVEMENTSBUILDINGS_TABLE.".afsID AND "
				.IMPROVEMENTSBUILDINGS_TABLE.".actualUse = ".IMPROVEMENTSBUILDINGS_ACTUALUSES_TABLE.".improvementsBuildingsActualUsesID AND "
				.OD_TABLE.".odID = ".LOCATION_TABLE.".odID AND "
				.LOCATION_TABLE.".odID = ".OD_TABLE.".odID AND "
				.LOCATIONADDRESS_TABLE.".locationAddressID = ".LOCATION_TABLE.".locationAddressID AND "
				.BARANGAY_TABLE.".barangayID = ".LOCATIONADDRESS_TABLE.".barangayID AND "
				.DISTRICT_TABLE.".districtID = ".LOCATIONADDRESS_TABLE.".district AND "
				.MUNICIPALITYCITY_TABLE.".municipalityCityID = ".LOCATIONADDRESS_TABLE.".municipalityCity AND "
				.PROVINCE_TABLE.".provinceID = ".LOCATIONADDRESS_TABLE.".province AND "
				.IMPROVEMENTSBUILDINGS_ACTUALUSES_TABLE.".reportCode = '".$this->formArray["reportCode"]."' ";
		$sql .= $condition;

		$dbImprovementsBuildings = new DB_RPTS;
		$dbImprovementsBuildings->query($sql);
		while($dbImprovementsBuildings->next_record()){
			$odIDArray[] = $dbImprovementsBuildings->f("odID");
		}

		// machineries ActualUses

		$sql = "SELECT "
				.OD_TABLE.".odID, "
				.AFS_TABLE.".afsID, "
				.MACHINERIES_TABLE.".actualUse FROM "
				.OD_TABLE.", "
				.LOCATION_TABLE.", "
				.LOCATIONADDRESS_TABLE.", "
				.BARANGAY_TABLE.", "
				.DISTRICT_TABLE.", "
				.MUNICIPALITYCITY_TABLE.", "
				.PROVINCE_TABLE.", "
				.AFS_TABLE.", "
				.MACHINERIES_TABLE.", "
				.MACHINERIES_ACTUALUSES_TABLE." WHERE "
				.OD_TABLE.".odID = ".AFS_TABLE.".odID AND "
				.AFS_TABLE.".afsID = ".MACHINERIES_TABLE.".afsID AND "
				.MACHINERIES_TABLE.".actualUse = ".MACHINERIES_ACTUALUSES_TABLE.".machineriesActualUsesID AND "
				.OD_TABLE.".odID = ".LOCATION_TABLE.".odID AND "
				.LOCATION_TABLE.".odID = ".OD_TABLE.".odID AND "
				.LOCATIONADDRESS_TABLE.".locationAddressID = ".LOCATION_TABLE.".locationAddressID AND "
				.BARANGAY_TABLE.".barangayID = ".LOCATIONADDRESS_TABLE.".barangayID AND "
				.DISTRICT_TABLE.".districtID = ".LOCATIONADDRESS_TABLE.".district AND "
				.MUNICIPALITYCITY_TABLE.".municipalityCityID = ".LOCATIONADDRESS_TABLE.".municipalityCity AND "
				.PROVINCE_TABLE.".provinceID = ".LOCATIONADDRESS_TABLE.".province AND "
				.MACHINERIES_ACTUALUSES_TABLE.".reportCode = '".$this->formArray["reportCode"]."' ";
		$sql .= $condition;

		$dbMachineries = new DB_RPTS;
		$dbMachineries->query($sql);
		while($dbMachineries->next_record()){
			$odIDArray[] = $dbMachineries->f("odID");
		}

		if(is_array($odIDArray)){
			$odIDArrayUnique = array_unique($odIDArray);
			return $odIDArrayUnique;
		}
		else{
			return false;
		}
	}

	function checkActualUseReportCode($landList,$plantsTreesList,$improvementsBuildingsList,$machineriesList){
		if(is_array($landList)){
			foreach($landList as $land){
				$landActualUses = new LandActualUses;
				$landActualUses->selectRecord($land->getActualUse());

				if($landActualUses->getReportCode()==$this->formArray["reportCode"]){
					return true;
				}
			}
		}

		if(is_array($plantsTreesList)){
			foreach($plantsTreesList as $plantsTrees){
				$plantsTreesActualUses = new PlantsTreesActualUses;
				$plantsTreesActualUses->selectRecord($plantsTrees->getActualUse());

				if($plantsTreesActualUses->getReportCode()==$this->formArray["reportCode"]){
					return true;
				}
			}
		}

		if(is_array($improvementsBuildingsList)){
			foreach($improvementsBuildingsList as $improvementsBuildings){
				$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
				$improvementsBuildingsActualUses->selectRecord($improvementsBuildings->getActualUse());

				if($improvementsBuildingsActualUses->getReportCode()==$this->formArray["reportCode"]){
					return true;
				}
			}
		}

		if(is_array($machineriesList)){
			foreach($machineriesList as $machineries){
				$machineriesActualUses = new MachineriesActualUses;
				$machineriesActualUses->selectRecord($machineries->getActualUse());

				if($machineriesActualUses->getReportCode()==$this->formArray["reportCode"]){
					return true;
				}
			}
		}

		return false;
	}

	function Main(){
		switch ($this->formArray["formAction"]){
			case "view":
				$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");

				$condition = "";

				if($this->formArray["filterByLocation"]=="true"){
					if($condition==""){
						$condition = " WHERE ";
					}
					$condition .= $this->filterLocationAddress();
				}
				else{
					$this->tpl->set_block("rptsTemplate", "FilterLocationDetails", "FilterLocationDetailsBlock");
					$this->tpl->set_var("FilterLocationDetailsBlock", "");
				}

				if($this->formArray["filterByDate"]=="true"){
					if($condition==""){
						$condition = " WHERE ";
					}
					else{
						$condition .= " AND ";
					}
					$condition .= $this->filterDate();
				}
				else{
					$this->tpl->set_block("rptsTemplate", "FilterDateDetails", "FilterDateDetailsBlock");
					$this->tpl->set_var("FilterDateDetailsBlock", "");
				}

				$condition .= $this->filterArchives();

				$odRecords = new ODRecords;

				if($this->formArray["filterByClassification"]=="true"){
					$odIDArray = $this->filterByClassification($condition);
					if(is_array($odIDArray)){
						$count = count($odIDArray);
						$numOfPages = ceil($count/ PAGE_BY);

						$pLowerLimit = ($this->formArray["page"]-1) * PAGE_BY;
						$pUpperLimit = $pLowerLimit + PAGE_BY;

						$this->tpl->set_var("currentPage",$this->formArray["page"]);
						$this->tpl->set_var("numOfPages",$numOfPages);
						$this->tpl->set_block("rptsTemplate", "PageListOne", "PageListOneBlock");
						for($p=1 ; $p<=$numOfPages ; $p++){
							$this->tpl->set_var("page",$p);
							$this->initSelected("page",$p);
							$this->tpl->parse("PageListOneBlock", "PageListOne", true);
						}
						
						for($p=$pLowerLimit ; $p<$pUpperLimit ; $p++){
							if($p < count($odIDArray)){
								$od = new OD;
								$od->selectRecord($odIDArray[$p]);
								$odRecords->arrayList[] = $od;
							}
						}
					}
					else{
						$this->tpl->set_block("rptsTemplate", "PageNavigationOne", "PageNavigationOneBlock");
						$this->tpl->set_var("PageNavigationOneBlock", "");
					}
				}
				else{
					if(!$count = $odRecords->countRecords($condition)){
						$this->tpl->set_block("rptsTemplate", "PageNavigationOne", "PageNavigationOneBlock");
						$this->tpl->set_var("PageNavigationOneBlock", "");
					}
					else{
						$numOfPages = ceil($count / PAGE_BY);
						$this->tpl->set_var("currentPage",$this->formArray["page"]);
						$this->tpl->set_var("numOfPages",$numOfPages);
						$this->tpl->set_block("rptsTemplate", "PageListOne", "PageListOneBlock");
						for($p=1 ; $p<=$numOfPages ; $p++){
							$this->tpl->set_var("page",$p);
							$this->initSelected("page",$p);
							$this->tpl->parse("PageListOneBlock", "PageListOne", true);
						}
					}

					$condition .= " LIMIT 0, 10";
					$odRecords->selectRecords($condition);
				}

				if (!is_array($odRecords->getArrayList())){
					$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
					$this->tpl->set_var("message", "properties not found");
					$this->tpl->parse("NotFoundBlock", "NotFound", true);
					
					$this->tpl->set_block("rptsTemplate", "Report", "ReportBlock");
					$this->tpl->set_var("ReportBlock", "");
				}
				else {
						$list = $odRecords->getArrayList();
						$count = 0;

						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "ReportList", "ReportListBlock");

							$noneFound = true;

							foreach ($list as $key => $value){

								$afs = $this->getAFSDetails($value->getOdID());

								if(is_object($afs)){

									$landList = $afs->getLandArray();
									$plantsTreesList = $afs->getPlantsTreesArray();
									$improvementsBuildingsList = $afs->getImprovementsBuildingsArray();
									$machineriesList = $afs->getMachineriesArray();

									$kind = "";
									$class = "";
									$remarks = "";
									$actualUse = "";
									$actualUseReportCode = "";

									if(is_array($landList)){
										$kind = "Land";
										$land = $landList[0];
										$actualUse = $land->getActualUse();

										$landActualUses = new LandActualUses;
										$landActualUses->selectRecord($actualUse);

										$actualUse = $landActualUses->getDescription();
										$actualUseReportCode = $landActualUses->getReportCode();

										$remarks = $land->getMemoranda();
									}
									else if(is_array($plantsTreesList)){
										$kind = "Land";
										$plantsTrees = $plantsTreesList[0];

										$actualUse = $plantsTrees->getActualUse();

										$plantsTreesActualUses = new PlantsTreesActualUses;
										$plantsTreesActualUses->selectRecord($actualUse);

										$actualUse = $plantsTreesActualUses->getDescription();
										$actualUseReportCode = $plantsTreesActualUses->getReportCode();

										$remarks = $plantsTrees->getMemoranda();
									}
									else if(is_array($improvementsBuildingsList)){
										$kind = "Improvements/Buildings";
										$improvementsBuildings = $improvementsBuildingsList[0];

										$actualUse = $improvementsBuildings->getActualUse();

										$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
										$improvementsBuildingsActualUses->selectRecord($actualUse);

										$actualUse = $improvementsBuildingsActualUses->getDescription();
										$actualUseReportCode = $improvementsBuildingsActualUses->getReportCode();

										$remarks = $improvementsBuildings->getMemoranda();
									}
									else if(is_array($machineriesList)){
										$kind = "Machineries";
										$machineries = $machineriesList[0];

										$actualUse = $machineries->getActualUse();

										$machineriesActualUses = new MachineriesActualUses;
										$machineriesActualUses->selectRecord($actualUse);

										$actualUse = $machineriesActualUses->getDescription();
										$actualUseReportCode = $machineriesActualUses->getReportCode();

										$remarks = $machineries->getMemoranda();
									}

									$this->tpl->set_var("kind", $kind);
									$this->tpl->set_var("actualUse", $actualUse);
									$this->tpl->set_var("actualUseReportCode", $actualUseReportCode);
									$this->tpl->set_var("remarks", $remarks);

									$this->tpl->set_var("taxability", $afs->getTaxability());

									$this->formArray["odID"] = $value->getOdID();
									$this->formArray["afsID"] = $afs->getAfsID();

									$td = new TD;
									if($td->selectRecord("", $this->formArray["afsID"])){
										$this->tpl->set_var("taxDeclarationNumber", $td->getTaxDeclarationNumber());
									}
									else{
										$this->tpl->set_var("taxDeclarationNumber",""); 
									}

									$this->tpl->set_var("area", $value->getLandArea());

									$this->tpl->set_var("propertyIndexNumber", $afs->getPropertyIndexNumber());

									$this->tpl->set_var("marketValue", number_format($afs->getTotalMarketValue()));
									$this->tpl->set_var("assessedValue", number_format($afs->getTotalAssessedValue(), 	2, '.', ','));

									$oValue = $value->owner;
	
									if (count($oValue->personArray)){
										$firstOwner = $oValue->personArray[0]->getLastName();
										$firstOwner.= ", ";
										$firstOwner.= $oValue->personArray[0]->getFirstName();
										$firstOwner.= " ";
										$firstOwner.= substr($oValue->personArray[0]->getMiddleName(), 0, 1) . ".";
	
										$pAddress = ($oValue->personArray[0]->addressArray) ? 	$oValue->personArray[0]->addressArray[0]->getFullAddress() : "no address" ;

										$firstOwnerAddress = $pAddress;
										$firstOwnerTelephone = $oValue->personArray[0]->getTelephone();
	
										$this->tpl->set_var("firstOwner", $firstOwner);
										$this->tpl->set_var("firstOwnerAddress", $firstOwnerAddress);
									}
									if (count($oValue->companyArray)){
										if($firstOwner==""){
											$firstOwner = $oValue->companyArray[0]->getCompanyName();

											$cAddress = ($oValue->companyArray[0]->addressArray) 	?$oValue->companyArray[0]->addressArray[0]->getFullAddress() : "no 	address";
	
											$firstOwnerAddress = $cAddress;
											$firstOwnerTelephone = $oValue->companyArray[0]->getTelephone();
	
											$this->tpl->set_var("firstOwner", $firstOwner);
											$this->tpl->set_var("firstOwnerAddress", $firstOwnerAddress);
										}
									}
									if ($firstOwner!=""){
										$this->tpl->set_var("none","");
										if((count($oValue->personArray) + count($oValue->companyArray)) > 1){
											$this->tpl->set_var("andOthers", "(and others)");
										}
										else{
											$this->tpl->set_var("andOthers", "");
										}
									}
									else{
										$this->tpl->set_var("none","none");
										$this->tpl->set_var("firstOwner", "");
										$this->tpl->set_var("andOthers", "");
										$this->tpl->set_var("firstOwnerAddress", "");
										$this->tpl->set_var("firstOwnerTelephone", "");
									}

									if(is_array($oValue->personArray)){
										foreach($oValue->personArray as $person){
											$ownerNamesArray[] = $person->getFullName();
										}
									}
									if(is_array($oValue->companyArray)){
										foreach($oValue->companyArray as $company){
											$ownerNamesArray[] = $company->getCompanyName();
										}
									}
									if(is_array($ownerNamesArray)){
										$this->tpl->set_var("ownerNames", implode(",<br>",$ownerNamesArray));
									}
									else{
										$this->tpl->set_var("ownerNames", "");
									}
									unset($ownerNamesArray);

									$locationAddress = $value->locationAddress->getFullAddress();

									$this->tpl->set_var("location", $locationAddress);

									$this->tpl->set_var("transactionCode", $value->getTransactionCode());
									$this->tpl->set_var("assessorsLotNo", $value->getLotNumber());

									$this->tpl->set_var("dateCreated", date('F j, Y, g:i a',$value->getDateCreated()));

									if($this->formArray["filterByClassification"]=="true"){
										$count++;

										if($this->checkActualUseReportCode($landList,$plantsTreesList,$improvementsBuildingsList,$machineriesList)){
											$noneFound = false;
											$this->tpl->parse("ReportListBlock", "ReportList", true);
										}
									}
									else{
										$noneFound = false;
										$this->tpl->set_block("rptsTemplate", "FilterClassificationDetails", "FilterClassificationDetailsBlock");
										$this->tpl->set_var("FilterClassificationDetailsBlock", "");

										$this->tpl->parse("ReportListBlock", "ReportList", true);
									}
								}
							}

							if($noneFound==true){
								$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
								$this->tpl->parse("NotFoundBlock", "NotFound", true);

								$this->tpl->set_block("rptsTemplate", "Report", "ReportBlock");
								$this->tpl->set_var("ReportBlock", "");
							}
							else{
								$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
								$this->tpl->set_var("NotFoundBlock", "");
							}	
					
					}
				}

				break;
			default:
				$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
				$this->tpl->set_var("message", "select a location to view report");
				$this->tpl->parse("NotFoundBlock", "NotFound", true);

				$this->tpl->set_block("rptsTemplate", "Report", "ReportBlock");
				$this->tpl->set_var("ReportBlock", "");
				break;
		}
		
        $this->setForm();
        $this->tpl->set_var("Session", $this->sess->url(""));
		$this->tpl->set_var("rpts_Session", $this->sess->id);
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
page_open(array("sess" => "rpts_Session"
	,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
	//global $auth;
	//print_r($auth);

$obj = new ListOfPropertyByClassificationPrint($HTTP_POST_VARS,$sess,$formAction,$formArray,$page);
$obj->main();
?>
<?php page_close(); ?>
