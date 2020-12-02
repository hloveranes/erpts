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
include_once "../assessor/TD.php";
include_once "../assessor/TDRecords.php";

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
class ListOfTaxablePropertiesPrint{
	
	var $tpl;
	var $formArray;
	var $sess;

	function ListOfTaxablePropertiesPrint($http_post_vars,$sess,$formAction,$page){
		global $auth;
		//echo "username=>".$auth->auth["uname"];
		
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ListOfTaxablePropertiesPrint.htm") ;
		$this->tpl->set_var("TITLE", "List of Taxable Properties");
		
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
		$condition.= " ORDER BY ".OD_TABLE.".odID ASC";
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
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "view":
				$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");

				// paging

				$condition = " WHERE ";
				$condition.= " ".OD_TABLE.".odID=".AFS_TABLE.".odID ";
				$condition.= " AND ".AFS_TABLE.".taxability='Taxable' ";
				$condition.= $this->filterArchives();

			    $sqlCount = "SELECT COUNT(" . OD_TABLE . ".odID) as count FROM ";
				$sqlCount.= OD_TABLE.", ";
				$sqlCount.= AFS_TABLE." ";
				$sqlCount.= $condition;

				$dbCount = new DB_RPTS;
				$dbCount->query($sqlCount);
				if($dbCount->next_record()){
					$count = $dbCount->f("count");
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
				else{
					$this->tpl->set_block("rptsTemplate", "PageNavigationOne", "PageNavigationOneBlock");
					$this->tpl->set_var("PageNavigationOneBlock", "");
					$count = 0;
				}

				// listing


			    $sql = "SELECT " . OD_TABLE . ".odID as odID, ";
				$sql.= AFS_TABLE.".afsID as afsID FROM ";
				$sql.= OD_TABLE.", ";
				$sql.= AFS_TABLE." ";

				if ($this->formArray["page"] > 0){
					$initialLimit = ($this->formArray["page"]-1) * PAGE_BY;
					$condition .= " LIMIT ".$initialLimit.",".PAGE_BY;
				}

				$sql = $sql . $condition;

				$db = new DB_RPTS;
				$db->query($sql);

				$odRecords = new ODRecords;

				while($db->next_record()){
					$od = new OD;
					$od->selectRecord($db->f("odID"));
					$odRecords->arrayList[] = $od;
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

						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
							$this->tpl->set_var("NotFoundBlock", "");

							$this->tpl->set_block("rptsTemplate", "ReportList", "ReportListBlock");

							foreach ($list as $key => $value){

								$afs = $this->getAFSDetails($value->getOdID());

								if(is_object($afs)){
									
									$this->tpl->set_var("taxability", $afs->getTaxability());

									if($afs->getTaxability()=="Taxable"){

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

										$this->tpl->parse("ReportListBlock", "ReportList", true);

									}

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


$listOfTaxablePropertiesPrint = new ListOfTaxablePropertiesPrint($HTTP_POST_VARS,$sess,$formAction,$page);
$listOfTaxablePropertiesPrint->main();
?>
<?php page_close(); ?>
