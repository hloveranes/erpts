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

include_once "../includes/assessor/LandClasses.php";
include_once "../includes/assessor/PlantsTreesClasses.php";
include_once "../includes/assessor/ImprovementsBuildingsClasses.php";
include_once "../includes/assessor/MachineriesClasses.php";

include_once "../includes/assessor/eRPTSSettings.php";

include_once "../includes/assessor/ODHistory.php";
include_once "../includes/assessor/ODHistoryRecords.php";

#####################################
# Define Interface Class
#####################################
class ListOfPropertiesForAuctionPrint{
	
	var $tpl;
	var $formArray;
	var $sess;

	function ListOfPropertiesForAuctionPrint($http_post_vars,$sess,$formAction,$formArray,$page=1){
		global $auth;
		//echo "username=>".$auth->auth["uname"];

		$this->formArray = $formArray;
		
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ListOfPropertiesForAuctionPrint.htm") ;
		$this->tpl->set_var("TITLE", "List of Properties for Auction");
		
		$this->sess = $sess;

		$this->formArray["formAction"] = $formAction;

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}

		$this->formArray["barangayID"] = $this->formArray["barangay"];
		$this->formArray["districtID"] = $this->formArray["district"];
		$this->formArray["municipalityCityID"] = $this->formArray["municipalityCity"];
		$this->formArray["provinceID"] = $this->formArray["province"];

		$this->formArray["ownerNames"] = "";

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

		// filter properties with transactionCode as "AU"
		$condition.= " AND ".OD_TABLE.".transactionCode = 'AU' ";

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

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function displayPrecedingOD(){
		$ODHistoryList = new SoapObject(NCCBIZ."ODHistoryList.php", "urn:Object");
		if (!$xmlStr = $ODHistoryList->getPrecedingODList($this->formArray["odID"])){
			$this->tpl->set_var("precedingUpdateCode", "");
			$this->tpl->set_var("precedingARPNumber", "");
			$this->tpl->set_var("precedingAssessedValue", "");
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_var("precedingUpdateCode", "");
				$this->tpl->set_var("precedingARPNumber", "");
				$this->tpl->set_var("precedingAssessedValue", "");
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
						}
						else{
							if(!$domDoc = domxml_open_mem($xmlStr)){
								$this->tpl->set_var("precedingUpdateCode", "");
								$this->tpl->set_var("precedingARPNumber", "");
								$this->tpl->set_var("precedingAssessedValue", "");
							}
							else{
								$precedingOD = new OD;
								$precedingOD->parseDomDocument($domDoc);

								$precedingODID = $precedingOD->getOdID();
								$precedingAFS = $this->getAFSDetails($precedingODID);

								$this->tpl->set_var("precedingUpdateCode", $value->getTransactionCode());
								$this->tpl->set_var("precedingARPNumber", $precedingAFS->getARPNumber());
								$this->tpl->set_var("precedingAssessedValue", number_format($precedingAFS->getTotalAssessedValue(), 2, ".", ","));

								// get previous owner of Auctioned property

								$owner = $precedingOD->owner;

								if(is_array($owner->personArray)){
									foreach($owner->personArray as $p){
										$ownerNamesArray[] = $p->getLastName() . ", " . $p->getFirstName() . " ". substr($p->getMiddleName(),0,1) . ".";
									}
								}

								if(is_array($owner->companyArray)){
									foreach($owner->companyArray as $c){
										$ownerNamesArray[] = $c->getCompanyName();
									}
								}

								if(is_array($ownerNamesArray)){
									$ownerNamesString = implode("<br>",$ownerNamesArray);
									unset($ownerNamesArray);
									$this->tpl->set_var("ownerNames",$ownerNamesString);
								}
								else{
									$this->tpl->set_var("ownerNames","");
								}

							}
					}
				}
			}
		}	
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

							foreach ($list as $key => $value){

								$afs = $this->getAFSDetails($value->getOdID());

								if(is_object($afs)){
									
									$this->tpl->set_var("taxability", $afs->getTaxability());

//									if($afs->getTaxability()=="Taxable"){

										$this->formArray["odID"] = $value->getOdID();
										$this->formArray["afsID"] = $afs->getAfsID();

										$this->displayPrecedingOD();

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

										$landList = $afs->getLandArray();
										$plantsTreesList = $afs->getPlantsTreesArray();
										$improvementsBuildingsList = $afs->getImprovementsBuildingsArray();
										$machineriesList = $afs->getMachineriesArray();

										$kind = "";
										$class = "";
										$remarks = "";

										if(count($landList)){
											$kind = "Land";
											$land = $landList[0];
											$class = $land->getClassification();

											$landClasses = new LandClasses;
											$landClasses->selectRecord($class);
											$class = $landClasses->getDescription();

											$remarks = $land->getMemoranda();
										}
										else if(count($plantsTreesList)){
											$kind = "Land";
											$plantsTrees = $plantsTreesList[0];

											$class = $plantsTrees->getProductClass();
	
											$plantsTreesClasses = new PlantsTreesClasses;
											$plantsTreesClasses->selectRecord($class);
											$class = $plantsTreesClasses->getDescription();

											$remarks = $plantsTrees->getMemoranda();
										}
										else if(count($improvementsBuildingsList)){
											$kind = "Improvements/Buildings";
											$improvementsBuildings = $improvementsBuildingsList[0];
											$class = $improvementsBuildings->getBuildingClassification();
	
											$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
											$improvementsBuildingsClasses->selectRecord($class);
											$class = $improvementsBuildingsClasses->getDescription();

											$remarks = $improvementsBuildings->getMemoranda();
										}
										else if(count($machineriesList)){
											$kind = "Machineries";
											$machineries = $machineriesList[0];
											$class = $machineries->getKind();

											$remarks = $machineries->getMemoranda();
										}

										$this->tpl->set_var("kind", $kind);
										$this->tpl->set_var("classification", $class);
										$this->tpl->set_var("remarks", $remarks);

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
											//$this->tpl->set_var("firstOwnerTelephone", $firstOwnerTelephone);
										}
										if (count($oValue->companyArray)){
											if($firstOwner==""){
												$firstOwner = $oValue->companyArray[0]->getCompanyName();
	
											$cAddress = ($oValue->companyArray[0]->addressArray) 	?$oValue->companyArray[0]->addressArray[0]->getFullAddress() : "no 	address";
	
												$firstOwnerAddress = $cAddress;
												$firstOwnerTelephone = $oValue->companyArray[0]->getTelephone();
	
												$this->tpl->set_var("firstOwner", $firstOwner);
												$this->tpl->set_var("firstOwnerAddress", $firstOwnerAddress);
												//$this->tpl->set_var("firstOwnerTelephone", $firstOwnerTelephone);
											}
										}
										if ($firstOwner!=""){
											$this->tpl->set_var("none","");
											if((count($oValue->personArray) + count($oValue->companyArray)) > 1){
												$this->tpl->set_var("andOthers", "(and others)");

												if(is_array($oValue->personArray)){
													foreach($oValue->personArray as $p){
														$ownerNamesArray[] = $p->getLastName() . ", " . $p->getFirstName() . " " . substr($p->getMiddleName(),0,1) . ".";
													}
												}
												if(is_array($oValue->companyArray)){
													foreach($oValue->companyArray as $c){
														$ownerNamesArray[] = $c->getCompanyName();
													}
												}
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

										$this->tpl->set_var("transactionCode", $value->getTransactionCode());
										$this->tpl->set_var("assessorsLotNo", $value->getLotNumber());

										$this->tpl->set_var("dateCreated", date('F j, Y, g:i a',$value->getDateCreated()));

										$this->tpl->parse("ReportListBlock", "ReportList", true);

//									}

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


$listOfPropertiesForAuctionPrint = new ListOfPropertiesForAuctionPrint($HTTP_POST_VARS,$sess,$formAction,$formArray,$page);
$listOfPropertiesForAuctionPrint->Main();
?>
<?php page_close(); ?>
