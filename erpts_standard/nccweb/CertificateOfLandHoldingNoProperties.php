<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

include_once "../includes/assessor/Person.php";

include_once "../includes/assessor/User.php";
include_once "../includes/assessor/UserRecords.php";

include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/RPTOPRecords.php";

include_once "../includes/assessor/TD.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/Land.php";
include_once "../includes/assessor/PlantsTrees.php";
include_once "../includes/assessor/ImprovementsBuildings.php";
include_once "../includes/assessor/Machineries.php";

include_once "../includes/assessor/LandActualUses.php";
include_once "../includes/assessor/PlantsTreesActualUses.php";
include_once "../includes/assessor/ImprovementsBuildingsActualUses.php";
include_once "../includes/assessor/MachineriesActualUses.php";

#####################################
# Define Interface Class
#####################################
class CertificateOfLandHoldingNoProperties{
	
	var $tpl;
	function CertificateOfLandHoldingNoProperties($http_post_vars,$formArray,$formAction,$searchKey,$page,$sess){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must have atleast AM-VIEW access
		$pageType = "%%1%%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "CertificateOfLandHoldingNoProperties.htm") ;
		$this->tpl->set_var("TITLE", "Certificate of Land Holding - without Properties");

		if(is_array($formArray)){
			$this->formArray = $formArray;
		}
		else{
				$this->formArray["requestorName"] = "";
			$this->formArray["requestorLocation"] = "";
			$this->formArray["signatoryID"] = "";
			$this->formArray["designation"] = "";
			$this->formArray["orNumber"] = "";
			$this->formArray["orDate_month"] = "";
			$this->formArray["orDate_day"] = "";
			$this->formArray["orDate_year"] = "";			
		}

		$this->formArray["requestedByURL"] = "";
		$this->formArray["searchKey"] = "";
		$this->formArray["formAction"] = $formAction;
		$this->formArray["searchKey"] = $searchKey;
		$this->formArray["page"] = $page;

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function hideBlock($tempVar){
		$this->tpl->set_block("rptsTemplate", $tempVar, $tempVar."Block");
		$this->tpl->set_var($tempVar."Block", "");
	}

	function setPageDetailPerms(){
		if(!checkPerms($this->user["userType"],"%1%%%%%%%%")){
			// hide Blocks if userType is not at least AM-Edit
			$this->hideBlock("TransactionsLink");
		}
		else{
			$this->hideBlock("TransactionsLinkText");
		}
	}

	function setForm(){
		$this->initMasterSignatoryList("Signatory", "signatory");

		$startYear = 1900;
		$endYear = date("Y");
		$this->tpl->set_block("rptsTemplate", "ReceiptDateYearList", "ReceiptDateYearListBlock");
		for($i = $endYear; $i >= $startYear; $i--){
			$this->initSelected("orDate_year", $i, "selected");
			$this->tpl->set_var("yearValue", $i);
			$this->tpl->parse("ReceiptDateYearListBlock", "ReceiptDateYearList", true);
		}
		
		eval(MONTH_ARRAY);//$monthArray

		$this->tpl->set_block("rptsTemplate", "ReceiptDateMonthList", "ReceiptDateMonthListBlock");
		foreach($monthArray as $key => $value){
			$this->initSelected("orDate_month", $key, "selected");
			$this->tpl->set_var("monthValue", $key);
			$this->tpl->set_var("month", $value);

			$this->tpl->parse("ReceiptDateMonthListBlock", "ReceiptDateMonthList", true);
		}

		$this->tpl->set_block("rptsTemplate", "ReceiptDateDayList", "ReceiptDateDayListBlock");
		for($i = 1; $i<=31; $i++){
			$this->initSelected("orDate_day", $i, "selected");
			$this->tpl->set_var("dayValue", $i);
			$this->tpl->parse("ReceiptDateDayListBlock", "ReceiptDateDayList", true);
		}

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
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

	function initMasterSignatoryList($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
        if (!$xmlStr = $UserList->getUserList(0, " WHERE ".AUTH_USER_MD5_TABLE.".userType REGEXP '1$' AND ".AUTH_USER_MD5_TABLE.".status='enabled'")){
			// error xmlStr
   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
			}
			else {
				$UserRecords = new UserRecords;
				$UserRecords->parseDomDocument($domDoc);
				$list = $UserRecords->getArrayList();
				foreach ($list as $key => $user){
					$person = new Person;
					$person->selectRecord($user->personID);
					$this->tpl->set_var("id",$user->personID);
					$this->tpl->set_var("name",$person->getFullName());
			        $this->initSelected($tempVar."ID",$user->personID);
			        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
				}
			}
		}
	}

	function sortRPTOPArrayListByOwner($rptopArrayList){
		// sort by Owner
		$o=0;
		foreach($rptopArrayList as $rptop){
			$ownerKey = "";
			$owner = $rptop->getOwner();

			if(is_array($owner->getPersonArray())){
				$rptopPersonArray = $owner->getPersonArray();

				foreach($rptopPersonArray as $person){
					$ownerKey .= $person->getLastName();
				}
			}
			if(is_array($owner->getCompanyArray())){
				$rptopCompanyArray = $owner->getCompanyArray();
				foreach($rptopCompanyArray as $company){
					$ownerKey .= $company->getCompanyName();
				}
			}
			$rptopSortedArrayList[$ownerKey.$o] = $rptop;
			$o++;
		}

		ksort($rptopSortedArrayList);
		reset($rptopSortedArrayList);

		return $rptopSortedArrayList;
	}

	function sortRPTOPOwner($owner){
		$ownerName = "";

		if(!is_object($owner)) return false;

		if(is_array($owner->getPersonArray())){
			$personArray = $owner->getPersonArray();
			$o=0;
			foreach($personArray as $person){
				$ownerArray[str_replace(" ", "",$person->getName()).$o] = $person->getName();
				$o++;
			}
		}
		if(is_array($owner->getCompanyArray())){
			$companyArray = $owner->getCompanyArray();
			$o=0;
			foreach($companyArray as $company){
				$ownerArray[str_replace(" ", "",$company->getCompanyName()).$o] = $company->getCompanyName();
				$o++;
			}
		}
		if(is_array($ownerArray)){
			ksort($ownerArray);
			reset($ownerArray);

			foreach($ownerArray as $name){
				if($ownerName!=""){
					$ownerName .= ", ";
				}
				$ownerName .= $name;
			}
			return $ownerName;
		}
		return false;
	}

	function getLandActualUsesText($landActualUsesID){
		$LandActualUsesDetails = new SoapObject(NCCBIZ."LandActualUsesDetails.php", "urn:Object");
		if(!$xmlStr = $LandActualUsesDetails->getLandActualUsesDetails($landActualUsesID)){
			return $landActualUsesID;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return $landActualUsesID;
			}
			else{
				$landActualUses = new LandActualUses;
				$landActualUses->parseDomDocument($domDoc);
				return $landActualUses->getDescription();
			}
		}
	}

	function getPlantsTreesActualUsesText($plantsTreesActualUsesID){
		$PlantsTreesActualUsesDetails = new SoapObject(NCCBIZ."PlantsTreesActualUsesDetails.php", "urn:Object");
		if(!$xmlStr = $PlantsTreesActualUsesDetails->getPlantsTreesActualUsesDetails($plantsTreesActualUsesID)){
			return $plantsTreesActualUsesID;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return $plantsTreesActualUsesID;
			}
			else{
				$plantsTreesActualUses = new PlantsTreesActualUses;
				$plantsTreesActualUses->parseDomDocument($domDoc);
				return $plantsTrees->getDescription();
			}
		}
	}

	function getImprovementsBuildingsActualUsesText($improvementsBuildingsActualUsesID){
		$ImprovementsBuildingsActualUsesDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsActualUsesDetails.php", "urn:Object");
		if(!$xmlStr = $ImprovementsBuildingsActualUsesDetails->getImprovementsBuildingsActualUsesDetails($improvementsBuildingsActualUsesID)){
			return $improvementsBuildingsActualUsesID."xx";
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return $improvementsBuildingsActualUsesID."yy";
			}
			else{
				$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
				$improvementsBuildingsActualUses->parseDomDocument($domDoc);
				return $improvementsBuildingsActualUses->getDescription();
			}
		}
	}

	function getMachineriesActualUsesText($machineriesActualUsesID){
		$MachineriesActualUsesDetails = new SoapObject(NCCBIZ."MachineriesActualUsesDetails.php", "urn:Object");
		if(!$xmlStr = $MachineriesActualUsesDetails->getMachineriesActualUsesDetails($machineriesActualUsesID)){
			return $machineriesActualUsesID;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return $machineriesActualUsesID;
			}
			else{
				$machineriesActualUses = new MachineriesActualUses;
				$machineriesActualUses->parseDomDocument($domDoc);
				return $machineriesActualUses->getDescription();
			}
		}
	}

	function getTDNumberListLine($td){
		if(is_object($td)){
			$tdNumber = $td->getTaxDeclarationNumber();
			$propertyType = $td->getPropertyType();
			$afsID = $td->getAfsID();;

			// get classification
			$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
			if(!$xmlStr = $AFSDetails->getAFS($afsID)){
				$classification = "";
			}
			else{
				if(!$domDoc = domxml_open_mem($xmlStr)){
					$classification = "";
				}
				else{
					$afs = new AFS;
					$afs->parseDomDocument($domDoc);
					switch($propertyType){
						case "ImprovementsBuildings":
							$improvementsBuildingsArray = $afs->getImprovementsBuildingsArray();
							if(is_array($improvementsBuildingsArray)){
								$classification = $improvementsBuildingsArray[0]->getActualUse();
								if(is_numeric($classification)){
									$classification = $this->getImprovementsBuildingsActualUsesText($classification);
								}
							}
							break;
						case "Machineries":
							$machineriesArray = $afs->getMachineriesArray();
							if(is_array($machineriesArray)){
								$classification = $machineriesArray[0]->getActualUse();
								if(is_numeric($classification)){
									$classification = $this->getMachineriesActualUsesText($classification);
								}
							}
							break;
						case "Land":
						default:
							$landArray = $afs->getLandArray();
							$plantsTreesArray = $afs->getPlantsTreesArray();

							if(is_array($landArray)){
								$classification = $landArray[0]->getActualUse();
								if(is_numeric($classification)){
									$classification = $this->getLandActualUsesText($classification);
								}
							}
							else if(is_array($plantsTreesArray)){
								$classification = $plantsArray[0]->getActualUse();
								if(is_numeric($classification)){
									$classification = $this->getPlantsTreesActualUsesText($classification);
								}
							}
					}
				}
			}

			$tdNumberListLine = $tdNumber . " --- " . $propertyType . " --- " . $classification;
			return $tdNumberListLine;
		}
		return "";
	}
	
	function Main(){
		$this->setPageDetailPerms();

		switch($this->formArray["formAction"]){
			default:
		}

		$this->setForm();

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->tpl->set_var("Session", $this->sess->url(""));
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
//*
page_open(array("sess" => "rpts_Session"
	,"auth" => "rpts_Challenge_Auth"
	,"perm" => "rpts_Perm"
	));
//*/

if(!$page) $page = 1;

$obj = new CertificateOfLandHoldingNoProperties($HTTP_POST_VARS,$formArray,$formAction,$searchKey,$page,$sess);
$obj->Main();
?>
<?php page_close(); ?>
