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

#####################################
# Define Interface Class
#####################################
class AssessmentRollReport{
	
	var $tpl;
	var $formArray;
	var $sess;

	function AssessmentRollReport($http_post_vars,$sess,$formAction,$province,$municipalityCity,$district,$barangay){
		global $auth;
		//echo "username=>".$auth->auth["uname"];
		
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "AssessmentRollReport.htm") ;
		$this->tpl->set_var("TITLE", "Assessment Roll Report");
		
		$this->sess = $sess;

		$this->formArray = array(
			"province" => $province
			, "municipalityCity" => $municipalityCity
			, "district" => $district
			, "barangay" => $barangay
			, "formAction" => $formAction
		);

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}

		$this->formArray["barangayID"] = $this->formArray["barangay"];
		$this->formArray["districtID"] = $this->formArray["district"];
		$this->formArray["municipalityCityID"] = $this->formArray["municipalityCity"];
		$this->formArray["provinceID"] = $this->formArray["province"];
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

		if($condition!=""){
			$condition = " WHERE ".$condition;
		}

		return $condition;
	}

	function filterArchives(){
		$condition = " AND ".OD_TABLE.".archive <> 'true'";
		$condition.= " GROUP BY ".OD_TABLE.".odID "; 
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

		$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
		if (!$xmlStr = $AFSDetails->getAFS($this->formArray["afsID"])){
			// error xml
			return false;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
				return false;
			}
			else {
				$afs = new AFS;
				$afs->parseDomDocument($domDoc);
				return $afs;
			}
		}
	}

	function setForm(){
        // barangay Listbox	
        $this->initMasterAddressList("Barangay", "barangay");
        // district Listbox	
        $this->initMasterAddressList("District", "district");
        // municipality/city Listbox	
        $this->initMasterAddressList("MunicipalityCity", "municipalityCity");
        // province Listbox	
        $this->initMasterAddressList("Province", "province");

		$this->initLocationDetails("Barangay", "barangay");
		$this->initLocationDetails("District", "district");
		$this->initLocationDetails("MunicipalityCity", "municipalityCity");
		$this->initLocationDetails("Province", "province");

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "view":
				$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");

				$condition = $this->filterLocationAddress();
				$condition.= $this->filterArchives();

				if (!$xmlStr = $ODList->getODList(0,$condition)){
					$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
					$this->tpl->set_var("message", "properties not found");
					$this->tpl->parse("NotFoundBlock", "NotFound", true);
					
					$this->tpl->set_block("rptsTemplate", "Report", "ReportBlock");
					$this->tpl->set_var("ReportBlock", "");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
						$this->tpl->set_var("message", "properties not found");
						$this->tpl->parse("NotFoundBlock", "NotFound", true);

						$this->tpl->set_block("rptsTemplate", "Report", "ReportBlock");
						$this->tpl->set_var("ReportBlock", "");
					}
					else {
						$odRecords = new ODRecords;
						$odRecords->parseDomDocument($domDoc);
						$list = $odRecords->getArrayList();

						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
							$this->tpl->set_var("NotFoundBlock", "");

							$this->tpl->set_block("rptsTemplate", "ReportList", "ReportListBlock");
							$this->tpl->set_var("ReportListBlock", "");

							$this->tpl->set_block("rptsTemplate", "Report", "ReportBlock");
							$this->tpl->set_var("ReportBlock", "");

							foreach ($list as $key => $value){
								$this->tpl->set_var("odID", $value->getOdID());
								$afs = $this->getAFSDetails($value->getOdID());

								$this->tpl->set_var("propertyIndexNumber", $afs->getPropertyIndexNumber());
								$this->tpl->set_var("arpNumber", $afs->getArpNumber());

								$this->tpl->set_var("assessedValue", number_format($afs->getTotalAssessedValue(), 2, '.', ','));

								$landList = $afs->getLandArray();
								$plantsTreesList = $afs->getPlantsTreesArray();
								$improvementsBuildingsList = $afs->getImprovementsBuildingsArray();
								$machineriesList = $afs->getMachineriesArray();

								$this->tpl->set_var("taxability", $afs->getTaxability());
								$this->tpl->set_var("effectivity", $afs->getEffectivity());

								$kind = "";
								$class = "";

								if(count($landList)){
									$kind = "Land";
									$land = $landList[0];
									$class = $land->getClassification();

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
								$this->tpl->set_var("class", $class);

								$oValue = $value->owner;

								if (count($oValue->personArray)){
									$firstOwner = $oValue->personArray[0]->getLastName();
									$firstOwner.= ", ";
									$firstOwner.= $oValue->personArray[0]->getFirstName();
									$firstOwner.= " ";
									$firstOwner.= substr($oValue->personArray[0]->getMiddleName(), 0, 1) . ".";

									$pAddress = ($oValue->personArray[0]->addressArray) ? $oValue->personArray[0]->addressArray[0]->getFullAddress() : "no address" ;

									$firstOwnerAddress = $pAddress;
									$firstOwnerTelephone = $oValue->personArray[0]->getTelephone();

									$this->tpl->set_var("firstOwner", $firstOwner);
									$this->tpl->set_var("firstOwnerAddress", $firstOwnerAddress);
									$this->tpl->set_var("firstOwnerTelephone", $firstOwnerTelephone);
								}
								if (count($oValue->companyArray)){
									if($firstOwner==""){
										$firstOwner = $oValue->companyArray[0]->getCompanyName();

										$cAddress = ($oValue->companyArray[0]->addressArray) ?$oValue->companyArray[0]->addressArray[0]->getFullAddress() : "no address";

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
										$this->tpl->set_var("andOthers", "...");
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

								$locationAddress = $value->locationAddress->getNumber();
								$locationAddress.= " ";
								$locationAddress.= $value->locationAddress->getStreet();

								$this->tpl->set_var("locationAddress", $locationAddress);


								//$this->tpl->parse("ReportListBlock", "ReportList", true);
							}
	
						}
						
					}
				}

				break;
			default:

				$totalCount = 0;

				$this->tpl->set_var("totalEntries", "000");

				$this->tpl->set_var("dateOfLastRPARPrintAttempt", "0000-00-00");

				$this->tpl->set_var("countUntilDateOfLastRPARPrintAttempt", "000");

				$this->tpl->set_var("countSinceDateOfLastRPARPrintAttempt", "000");



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


$assessmentRollReport = new AssessmentRollReport($HTTP_POST_VARS,$sess,$formAction,$province,$municipalityCity,$district,$barangay);
$assessmentRollReport->Main();
?>
<?php page_close(); ?>
