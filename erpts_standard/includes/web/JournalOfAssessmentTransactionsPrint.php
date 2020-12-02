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
include_once "../assessor/OD.php";
include_once "../assessor/ODRecords.php";
include_once "../assessor/AFS.php";
include_once "../assessor/AFSRecords.php";

include_once "../assessor/Barangay.php";
include_once "../assessor/BarangayRecords.php";
include_once "../assessor/District.php";
include_once "../assessor/DistrictRecords.php";
include_once "../assessor/MunicipalityCity.php";
include_once "../assessor/MunicipalityCityRecords.php";
include_once "../assessor/Province.php";
include_once "../assessor/ProvinceRecords.php";

include_once "../assessor/LandClasses.php";
include_once "../assessor/PlantsTreesClasses.php";
include_once "../assessor/ImprovementsBuildingsClasses.php";
include_once "../assessor/MachineriesClasses.php";

include_once "../assessor/eRPTSSettings.php";

include_once "../assessor/ODHistory.php";
include_once "../assessor/ODHistoryRecords.php";

#####################################
# Define Interface Class
#####################################
class JournalOfAssessmentTransactionsPrint{
	
	var $tpl;
	var $formArray;
	var $sess;

	function JournalOfAssessmentTransactionsPrint($http_post_vars,$sess,$formAction,$formArray,$page=1){
		global $auth;
		//echo "username=>".$auth->auth["uname"];

		$this->formArray = $formArray;
		
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "JournalOfAssessmentTransactionsPrint.htm") ;
		$this->tpl->set_var("TITLE", "Journal of Assessment Transactions");
		
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

	function filterArchives(){
		//$condition = " AND ".OD_TABLE.".archive <> 'true'";
		$condition.= " GROUP BY ".OD_TABLE.".odID "; 
		$condition.= " ORDER BY ".OD_TABLE.".odID ASC";
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

	function initMasterAddressList($TempVar, $tempVar){
	    $getList = "get".$TempVar."List";
	    $getID = "get".$TempVar."ID";

		switch($tempVar){
			case "barangay":
				$propertyTable = BARANGAY_TABLE;
				break;
			case "district":
				$propertyTable = DISTRICT_TABLE;
				break;
			case "municipalityCity":
				$propertyTable = MUNICIPALITYCITY_TABLE;
				break;
			case "province":
				$propertyTable = PROVINCE_TABLE;
				break;
	   }
	
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		$TempVarList = new SoapObject(NCCBIZ.$TempVar."List.php", "urn:Object");
        if (!$xmlStr = $TempVarList->$getList(0, " WHERE ".$propertyTable.".status='active' ORDER BY description")){
			switch($tempVar){
				case "barangay":
				case "district":
				case "municipalityCity":
					$this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
					$this->tpl->set_var("JS".$TempVar."ListBlock", "");
					break;
		   }
		   $this->tpl->set_var($tempVar."ID", "");
           $this->tpl->set_var($tempVar, "empty ".$tempVar." list");
		   $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				switch($tempVar){
					case "barangay":
					case "district":
					case "municipalityCity":
						$this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
						$this->tpl->set_var("JS".$TempVar."ListBlock", "");
						break;
			    }
			    $this->tpl->set_var($tempVar."ID", "");
                $this->tpl->set_var($tempVar, "empty ".$tempVar." list");
		        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
			}
			else {
			    switch($tempVar){
			        case "barangay":
			   	       $this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
			           $tempVarRecords = new BarangayRecords;
                       $tempVarID = $getID;
			        break;
			        case "district":
			   	       $this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
			           $tempVarRecords = new DistrictRecords;
			           $tempVarID = $getID;
                    break;
                    case "municipalityCity":
			   	       $this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
                       $tempVarRecords = new MunicipalityCityRecords;
                       $tempVarID = $getID;
                    break;
                    case "province":
                       $tempVarRecords = new ProvinceRecords;
                       $tempVarID = $getID;
                    break;
			    }

				$tempVarRecords->parseDomDocument($domDoc);
				$list = $tempVarRecords->getArrayList();
				$i = 0;
				foreach ($list as $key => $value){
          			$this->tpl->set_var($tempVar."ID", $value->$tempVarID());

               		$this->tpl->set_var($tempVar, $value->getDescription());
			        $this->initSelected($tempVar,$value->$tempVarID());

			        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);

					switch($tempVar){
						case "barangay":
							$this->tpl->set_var("i", $i);
							$this->tpl->set_var("districtID", $value->getDistrictID());
							$this->tpl->parse("JS".$TempVar."ListBlock", "JS".$TempVar."List", true);
	  					    $i++;
						break;
						case "district":
							$this->tpl->set_var("i", $i);
							$this->tpl->set_var("municipalityCityID", $value->getMunicipalityCityID());
							$this->tpl->parse("JS".$TempVar."ListBlock", "JS".$TempVar."List", true);
	  					    $i++;
						break;
						case "municipalityCity":
							$this->tpl->set_var("i", $i);
							$this->tpl->set_var("provinceID", $value->getProvinceID());
							$this->tpl->parse("JS".$TempVar."ListBlock", "JS".$TempVar."List", true);
	  					    $i++;
						break;
					}
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

	function displayPrecedingOD(){
		$ODHistoryList = new SoapObject(NCCBIZ."ODHistoryList.php", "urn:Object");
		if (!$xmlStr = $ODHistoryList->getPrecedingODList($this->formArray["odID"])){
			$this->tpl->set_var("precedingUpdateCode", "");
			$this->tpl->set_var("precedingARPNumber", "");
			$this->tpl->set_var("precedingAssessedValue", "");
			$this->tpl->set_var("fromFirstOwner", "");
			$this->tpl->set_var("fromAndOthers","");
			$this->tpl->set_var("fromNone","");
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_var("precedingUpdateCode", "");
				$this->tpl->set_var("precedingARPNumber", "");
				$this->tpl->set_var("precedingAssessedValue", "");
				$this->tpl->set_var("fromFirstOwner", "");
				$this->tpl->set_var("fromAndOthers","");
				$this->tpl->set_var("fromNone","");
			}
			else{
				$odHistoryRecords = new ODHistoryRecords;
				$odHistoryRecords->parseDomDocument($domDoc);
				$arrayList = $odHistoryRecords->getArrayList();
				if(count($arrayList)){
					$value = $arrayList[0];
						$ODDetails = new SoapObject(NCCBIZ."ODDetails.php", "urn:Object");
						if(!$xmlStr = $ODDetails->getOD($value->getPreviousODID())){
							$this->tpl->set_var("precedingUpdateCode", "");
							$this->tpl->set_var("precedingARPNumber", "");
							$this->tpl->set_var("precedingAssessedValue", "");
							$this->tpl->set_var("fromFirstOwner", "");
							$this->tpl->set_var("fromAndOthers","");
							$this->tpl->set_var("fromNone","");
						}
						else{
							if(!$domDoc = domxml_open_mem($xmlStr)){
								$this->tpl->set_var("precedingUpdateCode", "");
								$this->tpl->set_var("precedingARPNumber", "");
								$this->tpl->set_var("precedingAssessedValue", "");
								$this->tpl->set_var("fromFirstOwner", "");
								$this->tpl->set_var("fromAndOthers","");
								$this->tpl->set_var("fromNone","");
							}
							else{
								$precedingOD = new OD;
								$precedingOD->parseDomDocument($domDoc);

								$precedingODID = $precedingOD->getOdID();
								$precedingAFS = $this->getAFSDetails($precedingODID);

								$this->tpl->set_var("precedingUpdateCode", $value->getTransactionCode());
								$this->tpl->set_var("precedingARPNumber", $precedingAFS->getARPNumber());
								$this->tpl->set_var("precedingAssessedValue", number_format($precedingAFS->getTotalAssessedValue(), 2, ".", ","));

								$oValue = $precedingOD->getOwner();

								if (count($oValue->personArray)){
									$firstOwner = $oValue->personArray[0]->getLastName();
									$firstOwner.= ", ";
									$firstOwner.= $oValue->personArray[0]->getFirstName();
									$firstOwner.= " ";
									$firstOwner.= substr($oValue->personArray[0]->getMiddleName(), 0, 1) . ".";
	
									$pAddress = ($oValue->personArray[0]->addressArray) ? 	$oValue->personArray[0]->addressArray[0]->getFullAddress() : "no address" ;
	
									$firstOwnerAddress = $pAddress;
									$firstOwnerTelephone = $oValue->personArray[0]->getTelephone();
	
									$this->tpl->set_var("fromFirstOwner", $firstOwner);
									$this->tpl->set_var("fromFirstOwnerAddress", $firstOwnerAddress);
									$this->tpl->set_var("fromFirstOwnerTelephone", $firstOwnerTelephone);
									$this->tpl->set_var("fromNone","");
								}
								if (count($oValue->companyArray)){
									if($firstOwner==""){
										$firstOwner = $oValue->companyArray[0]->getCompanyName();
	
										$cAddress = ($oValue->companyArray[0]->addressArray) 	?$oValue->companyArray[0]->addressArray[0]->getFullAddress() : "no address";
	
										$firstOwnerAddress = $cAddress;
										$firstOwnerTelephone = $oValue->companyArray[0]->getTelephone();
	
										$this->tpl->set_var("fromFirstOwner", $firstOwner);
										$this->tpl->set_var("fromFirstOwnerAddress", $firstOwnerAddress);
										$this->tpl->set_var("fromFirstOwnerTelephone", $firstOwnerTelephone);
										$this->tpl->set_var("fromNone","");
									}
								}
								if ($firstOwner!=""){
									$this->tpl->set_var("none","");
									if((count($oValue->personArray) + count($oValue->companyArray)) > 1){
										$this->tpl->set_var("fromAndOthers", "(and others)");
									}
									else{
										$this->tpl->set_var("fromAndOthers", "");
									}
								}
								else{
									$this->tpl->set_var("fromNone","-");
									$this->tpl->set_var("fromFirstOwner", "");
									$this->tpl->set_var("fromAndOthers", "");
									$this->tpl->set_var("fromFirstOwnerAddress", "");
									$this->tpl->set_var("fromFirstOwnerTelephone", "");
								}

							}
					}
				}
			}
		}	
	}

	function displaySucceedingOD(){
		$ODHistoryList = new SoapObject(NCCBIZ."ODHistoryList.php", "urn:Object");
		if (!$xmlStr = $ODHistoryList->getSucceedingODList($this->formArray["odID"])){
			$this->tpl->set_var("succeedingARPNumber", "");
			$this->tpl->set_var("succeedingUpdateCode", "");
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_var("succeedingARPNumber", "");
				$this->tpl->set_var("succeedingUpdateCode", "");
			}
			else{
				$odHistoryRecords = new ODHistoryRecords;
				$odHistoryRecords->parseDomDocument($domDoc);
				$arrayList = $odHistoryRecords->getArrayList();
				if(count($arrayList)){
					$value = $arrayList[0];
						$ODDetails = new SoapObject(NCCBIZ."ODDetails.php", "urn:Object");
						if(!$xmlStr = $ODDetails->getOD($value->getPresentODID())){
							$this->tpl->set_var("succeedingARPNumber", "");
							$this->tpl->set_var("succeedingUpdateCode", "");
						}
						else{
							if(!$domDoc = domxml_open_mem($xmlStr)){
								$this->tpl->set_var("succeedingARPNumber", "");
								$this->tpl->set_var("succeedingUpdateCode", "");
							}
							else{
								$succeedingOD = new OD;
								$succeedingOD->parseDomDocument($domDoc);

								$succeedingODID = $succeedingOD->getOdID();
								$succeedingAFS = $this->getAFSDetails($succeedingODID);

								$this->tpl->set_var("succeedingARPNumber", $succeedingAFS->getARPNumber());
								$this->tpl->set_var("succeedingUpdateCode", $value->getTransactionCode());
							}
						}
				}
			}
		}	
	}

	function setForm(){
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

		$this->formArray["todayYmd"] = date("Y-m-d");;
		$this->formArray["pageTotalLandArea"] = formatCurrency($this->formArray["pageTotalLandArea"]);

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function computeTotalLandArea($condition){
		$this->formArray["totalLandArea"] = 0;

		$db = new DB_RPTS;
		$sqmCondition = " AND ".LAND_TABLE.".unit LIKE 'square meters'";
		$haCondition = " AND ".LAND_TABLE.".unit LIKE 'hectares'";

		$sqlLand = "SELECT SUM(".LAND_TABLE.".area) as area FROM Land 
				  LEFT JOIN " . AFS ."
				  ON " . LAND_TABLE . ".afsID=" . AFS_TABLE . ".afsID
				  LEFT JOIN " . OD ."
				  ON " . AFS_TABLE . ".odID=" . OD_TABLE . ".odID

				  LEFT JOIN " . LOCATION_TABLE . "
				  ON " . OD_TABLE . ".odID = " . LOCATION_TABLE . ".odID

                  LEFT JOIN " . LOCATIONADDRESS_TABLE . "
                  ON " . LOCATION_TABLE . ".locationAddressID=" . LOCATIONADDRESS_TABLE . ".locationAddressID

                  LEFT JOIN " . BARANGAY_TABLE . "
                  ON " . BARANGAY_TABLE . ".barangayID=" . LOCATIONADDRESS_TABLE . ".barangayID 

				  LEFT JOIN " . DISTRICT_TABLE . "
				  ON " . DISTRICT_TABLE . ".districtID=" . LOCATIONADDRESS_TABLE . ".district 
				  LEFT JOIN " . MUNICIPALITYCITY_TABLE . "
				  ON " . MUNICIPALITYCITY_TABLE . ".municipalityCityID=" . LOCATIONADDRESS_TABLE . ".municipalityCity 
				  LEFT JOIN " . PROVINCE_TABLE . "
				  ON " . PROVINCE_TABLE . ".provinceID=" . LOCATIONADDRESS_TABLE . ".province";

        $sqlSQM = $sqlLand . $condition . $sqmCondition;
		$db->query($sqlSQM);
		while($db->next_record()){
			$this->formArray["totalLandArea"] += $db->f("area");
		}

        $sqlHA = $sqlLand . $condition . $haCondition;
		$db->query($sqlHA);
		while($db->next_record()){
			$this->formArray["totalLandArea"] += hectaresToSquareMeters($db->f("area"));
		}

		$this->formArray["totalLandArea"] = formatCurrency($this->formArray["totalLandArea"]);
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "view":
				ini_set("max_execution_time","420");
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

				$countLandAreaCondition = $condition;
				$condition .= $this->filterArchives();

				$odRecords = new ODRecords;

				// paging

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

				if($this->formArray["page"]==$numOfPages){
					$this->computeTotalLandArea($countLandAreaCondition);
				}
				else{
					$this->tpl->set_block("rptsTemplate", "TotalLandArea", "TotalLandAreaBlock");
					$this->tpl->set_var("TotalLandAreaBlock", "");
				}
				$this->formArray["pageTotalLandArea"] = 0;

				$this->formArray["transactionNumber"] = ($this->formArray["page"] * PAGE_BY) - (PAGE_BY-1);

				if ($this->formArray["page"] > 0){
					$initialLimit = ($this->formArray["page"]-1) * PAGE_BY;
					$condition .= " LIMIT ".$initialLimit.",".PAGE_BY;
				}

				// listing

				if (!$odRecords->selectRecords($condition)){
					$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
					$this->tpl->set_var("message", "properties not found");
					$this->tpl->parse("NotFoundBlock", "NotFound", true);
					
					$this->tpl->set_block("rptsTemplate", "Report", "ReportBlock");
					$this->tpl->set_var("ReportBlock", "");
				}
				else {
					$list = $odRecords->getArrayList();

					if (count($list)){
						$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
						$this->tpl->set_var("NotFoundBlock", "");

						$this->tpl->set_block("rptsTemplate", "ReportList", "ReportListBlock");

						//$this->formArray["totalLandArea"] = 0;

						foreach ($list as $key => $value){

							$this->formArray["odID"] = $value->getOdID();

							$this->tpl->set_var("odID", $value->getOdID());
							$afs = $this->getAFSDetails($value->getOdID());

							if(is_object($afs)){

								$this->tpl->set_var("propertyIndexNumber", $afs->getPropertyIndexNumber());
								$this->tpl->set_var("arpNumber", $afs->getArpNumber());

								$this->tpl->set_var("marketValue", number_format($afs->getTotalMarketValue(), 2, '.', ','));

								$this->tpl->set_var("assessedValue", number_format($afs->getTotalAssessedValue(), 2, '.', ','));

								$landList = $afs->getLandArray();
								$plantsTreesList = $afs->getPlantsTreesArray();
								$improvementsBuildingsList = $afs->getImprovementsBuildingsArray();
								$machineriesList = $afs->getMachineriesArray();

								$this->tpl->set_var("taxability", $afs->getTaxability());
								$this->tpl->set_var("effectivity", $afs->getEffectivity());

								$kind = "";
								$class = "";

								$this->tpl->set_var("landArea", "");

								if(count($landList)){
									$kind = "Land";
									$land = $landList[0];
									$class = $land->getClassification();

									// compute totalLandArea

									$unit = $land->getUnit();

									if($unit=="square meters"){
										$unit = "sqm.";
										$area = $land->getArea();
									}
									else if($unit=="hectares"){
										$unit = "ha.";
										$area = hectaresToSquareMeters($land->getArea());
									}

									$this->tpl->set_var("landArea", $land->getArea() . " " . $unit);

									$this->formArray["pageTotalLandArea"] += $area;
	
									$landClasses = new LandClasses;
									$landClasses->selectRecord($class);
									$class = $landClasses->getDescription();
								}
								else if(count($plantsTreesList)){
									$kind = "Land";
									$plantsTrees = $plantsTreesList[0];
	
									$class = $plantsTrees->getProductClass();
	
									$plantsTreesClasses = new PlantsTreesClasses;
									$plantsTreesClasses->selectRecord($class);
									$class = $plantsTreesClasses->getDescription();
								}
								else if(count($improvementsBuildingsList)){
									$kind = "Improvements/Buildings";
									$improvementsBuildings = $improvementsBuildingsList[0];
									$class = $improvementsBuildings->getBuildingClassification();
	
									$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
									$improvementsBuildingsClasses->selectRecord($class);
									$class = $improvementsBuildingsClasses->getDescription();
								}
								else if(count($machineriesList)){
									$kind = "Machineries";
									$machineries = $machineriesList[0];
									$class = $machineries->getKind();
								}
	
								$this->tpl->set_var("kind", $kind);
								$this->tpl->set_var("classification", $class);
	
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
									$this->tpl->set_var("firstOwnerTelephone", $firstOwnerTelephone);
								}
								if (count($oValue->companyArray)){
									if($firstOwner==""){
										$firstOwner = $oValue->companyArray[0]->getCompanyName();
	
										$cAddress = ($oValue->companyArray[0]->addressArray) 	?$oValue->companyArray[0]->addressArray[0]->getFullAddress() : "no address";
	
										$firstOwnerAddress = $cAddress;
										$firstOwnerTelephone = $oValue->companyArray[0]->getTelephone();
	
										$this->tpl->set_var("firstOwner", $firstOwner);
										$this->tpl->set_var("firstOwnerAddress", $firstOwnerAddress);
										$this->tpl->set_var("firstOwnerTelephone", $firstOwnerTelephone);
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

								if($this->formArray["filterByLocation"]=="true"){
									$locationAddress = $value->locationAddress->getNumber();
									$locationAddress.= " ";
									$locationAddress.= $value->locationAddress->getStreet();
								}
								else{
									$locationAddress = $value->locationAddress->getFullAddress();
								}

								$this->tpl->set_var("location", $locationAddress);

								$this->tpl->set_var("date", date("n/j/Y", $value->getDateCreated()));
								$this->tpl->set_var("transactionCode", $value->getTransactionCode());

								$this->displayPrecedingOD();
								//$this->displaySucceedingOD();

								$this->tpl->set_var("transactionNumber", $this->formArray["transactionNumber"]);

								$this->formArray["transactionNumber"]++;

								$this->tpl->parse("ReportListBlock", "ReportList", true);
							
							}

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


$journalOfAssessmentTransactionsPrint = new JournalOfAssessmentTransactionsPrint($HTTP_POST_VARS,$sess,$formAction,$formArray,$page);
$journalOfAssessmentTransactionsPrint->Main();
?>
<?php page_close(); ?>
