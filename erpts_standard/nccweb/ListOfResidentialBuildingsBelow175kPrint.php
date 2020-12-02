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
class ListOfResidentialBuildingsBelow175kPrint{
	
	var $tpl;
	var $formArray;
	var $sess;

	function ListOfResidentialBuildingsBelow175kPrint($http_post_vars,$sess,$formAction,$page=1){
		global $auth;
		//echo "username=>".$auth->auth["uname"];
		
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ListOfResidentialBuildingsBelow175kPrint.htm") ;
		$this->tpl->set_var("TITLE", "List of Residential Buildings with Market Value below Php 175,0000");
		
		$this->sess = $sess;

		$this->formArray = array(
			"formAction" => $formAction
		);

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}

		$this->formArray["page"] = $page;

		if($this->formArray["page"]==""){
			$this->formArray["page"] = 1;
		}
	}

	function filterArchives(){
		$condition = " AND ".OD_TABLE.".archive <> 'true'";
		$condition.= " GROUP BY ".OD_TABLE.".odID "; 
		$condition.= " ORDER BY ".AFS_TABLE.".propertyIndexNumber ASC";
		return $condition;
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
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function selectODRecords($condition){
		// improvementsBuildings ActualUses
		$this->formArray["reportCode"] = "RE";

		$sql = "SELECT "
				.OD_TABLE.".odID as odID, "
				.AFS_TABLE.".afsID as afsID, "
				.AFS_TABLE.".totalMarketValue as totalMarketValue, "
				.IMPROVEMENTSBUILDINGS_TABLE.".actualUse as actualUse, "
				.IMPROVEMENTSBUILDINGS_ACTUALUSES_TABLE.".reportCode as reportCode FROM "
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
				.IMPROVEMENTSBUILDINGS_ACTUALUSES_TABLE.".reportCode = '".$this->formArray["reportCode"]."' AND "
				.IMPROVEMENTSBUILDINGS_TABLE.".adjustedMarketValue < 175000 ";

		$sql .= $condition;

		$db = new DB_RPTS;
		$db->query($sql);
		while($db->next_record()){
			$odIDArray[] = $db->f("odID");
		}
		if(is_array($odIDArray)){
			$odIDArray = array_unique($odIDArray);
			return $odIDArray;
		}
		else{
			return false;
		}
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "view":
				$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");

				$condition = $this->filterArchives();

				$odRecords = new ODRecords;
				
				if($odIDArray = $this->selectODRecords($condition)){
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


				if (!is_array($odRecords->arrayList)){
					$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
					$this->tpl->set_var("message", "properties not found");
					$this->tpl->parse("NotFoundBlock", "NotFound", true);
					
					$this->tpl->set_block("rptsTemplate", "Report", "ReportBlock");
					$this->tpl->set_var("ReportBlock", "");
				}
				else {
						$list = $odRecords->getArrayList();
						$noneFound = true;

						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "ReportList", "ReportListBlock");

							foreach ($list as $key => $value){

								$afs = $this->getAFSDetails($value->getOdID());

								if(is_object($afs)){
									$this->tpl->set_var("effectivity", $afs->getEffectivity());
									$this->tpl->set_var("propertyIndexNumber", $afs->getPropertyIndexNumber());

									$landList = $afs->getLandArray();
									$plantsTreesList = $afs->getPlantsTreesArray();
									$machineriesList = $afs->getMachineriesArray();

									$kind = "";
									$class = "";
									$remarks = "";
									$actualUse = "";
									$actualUseReportCode = "";

									if(!is_array($improvementsBuildingsList)){
										$this->tpl->set_var("marketValue", number_format($afs->getTotalMarketValue()));
									}
									else{
										$kind = "Improvements/Buildings";
										$improvementsBuildings = $improvementsBuildingsList[0];

										$actualUse = $improvementsBuildings->getActualUse();

										$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
										$improvementsBuildingsActualUses->selectRecord($actualUse);

										$actualUse = $improvementsBuildingsActualUses->getDescription();
										$actualUseReportCode = $improvementsBuildingsActualUses->getReportCode();

										$remarks = $improvementsBuildings->getMemoranda();

										$marketValue=0;
										foreach($improvementsBuildingsList as $impBldg){
											$marketValue += $impBldg->getAdjustedMarketValue();
										}
										$this->tpl->set_var("marketValue", number_format($marketValue));
									}

									$this->tpl->set_var("kind", $kind);
									$this->tpl->set_var("actualUse", $actualUse);
									$this->tpl->set_var("actualUseReportCode", $actualUseReportCode);
									$this->tpl->set_var("remarks", $remarks);
								}

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
	
										$cAddress = ($oValue->companyArray[0]->addressArray) 		?$oValue->companyArray[0]->addressArray[0]->getFullAddress() : "no 	address";
	
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
										$ownersArrayList[] = $person->getFullName();
									}
								}
								if(is_array($oValue->companyArray)){
									foreach($oValue->companyArray as $company){
										$ownersArrayList[] = $company->getCompanyName();
									}
								}
								if(is_array($ownersArrayList)){
									$this->tpl->set_var("ownerNames", implode(",<br>",$ownersArrayList));
								}
								else{
									$this->tpl->set_var("ownerNames", "");
								}
								unset($ownersArrayList);

								$locationAddress = $value->locationAddress->getFullAddress();
								$this->tpl->set_var("location", $locationAddress);

								$noneFound = false;

								$this->tpl->parse("ReportListBlock", "ReportList", true);
							}
	
						
					}

					if($noneFound==true){
						$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
						$this->tpl->set_var("message", "properties not found");
						$this->tpl->parse("NotFoundBlock", "NotFound", true);
					
						$this->tpl->set_block("rptsTemplate", "Report", "ReportBlock");
						$this->tpl->set_var("ReportBlock", "");
					}
					else{
						$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
						$this->tpl->set_var("NotFoundBlock", "");
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


$obj = new ListOfResidentialBuildingsBelow175kPrint($HTTP_POST_VARS,$sess,$formAction,$page);
$obj->main();
?>
<?php page_close(); ?>
