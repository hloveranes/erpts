<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/ImprovementsBuildingsDepreciation.php";
include("assessor/ImprovementsBuildingsDepreciationRecords.php";
include_once "../includes/assessor/eRPTSSettings.php";


#####################################
# Define Interface Class
#####################################
class ImprovementsBuildingsDepreciationList{
	
	var $tpl;
	var $formArray;
	function ImprovementsBuildingsDepreciationList($http_post_vars,$sess,$sortBy,$sortOrder){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ImprovementsBuildingsDepreciationListPrint.htm") ;
		$this->tpl->set_var("TITLE", "Buildings & Improvements Depreciation List");
		$this->tpl->set_var("Session", $this->sess->url(""));

		$this->formArray["sortBy"] = $sortBy;
		$this->formArray["sortOrder"] = $sortOrder;
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function sortBlocks(){
		$this->formArray["improvementsBuildingsDepreciationIDSortOrder"] = "ASC";
		$this->formArray["codeSortOrder"] = "ASC";
		$this->formArray["descriptionSortOrder"] = "ASC";
		$this->formArray["rangeSortOrder"] = "ASC";
		$this->formArray["rangeUpperBoundSortOrder"] = "ASC";
		$this->formArray["rangeLowerBoundSortOrder"] = "ASC";
		$this->formArray["assessmentLevelSortOrder"] = "ASC";
		$this->formArray["statusSortOrder"] = "ASC";

		switch($this->formArray["sortBy"]){
			case "improvementsBuildingsDepreciationID":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["improvementsBuildingsDepreciationIDSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["improvementsBuildingsDepreciationIDSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY improvementsBuildingsDepreciationID ".$this->formArray["sortOrder"];
				break;
			case "code":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["codeSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["codeSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY code ".$this->formArray["sortOrder"];
				break;
			case "description":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["descriptionSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["descriptionSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY description ".$this->formArray["sortOrder"];
				break;
			case "range":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["rangeSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["rangeSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY range ".$this->formArray["sortOrder"];
				break;
			case "rangeUpperBound":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["rangeUpperBoundSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["rangeUpperBoundSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY rangeUpperBound ".$this->formArray["sortOrder"];
				break;
			case "rangeLowerBound":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["rangeLowerBoundSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["rangeLowerBoundSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY rangeLowerBound ".$this->formArray["sortOrder"];
				break;
			case "assessmentLevel":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["assessmentLevelSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["assessmentLevelSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY assessmentLevel ".$this->formArray["sortOrder"];
				break;
			case "status":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["statusSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["statusSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY status ".$this->formArray["sortOrder"];
				break;
			default:
				$this->formArray["sortBy"] = "improvementsBuildingsDepreciationID";
				$this->formArray["sortOrder"] = "DESC";
				$condition = " ORDER BY improvementsBuildingsDepreciationID DESC";
				break;
		}
		return $condition;
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
    function getStatusCheck($isStatusActive){
        if($isStatusActive=="active"){
            return("checked");
        }
        else{
            return "";
        }
    }	
	
	function Main(){
		switch ($this->formArray["formAction"]){
			default:
				$this->tpl->set_var("msg", "");
		}

		$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php", "urn:Object");
		if (!$xmlStr = $eRPTSSettingsDetails->getERPTSSettingsDetails(1)){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "record not found");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$erptsSettings = new eRPTSSettings;
				$erptsSettings->parseDomDocument($domDoc);

				$this->formArray["eRPTSSettingsID"] = $erptsSettings->getERPTSSettingsID();
				$this->formArray["lguName"] = $erptsSettings->getLguName();
				$this->formArray["lguType"] = $erptsSettings->getLguType();
				$this->formArray["chiefExecutiveDesignation"] = 		$erptsSettings->getChiefExecutiveDesignation();
				$this->formArray["chiefExecutiveFirstName"] = $erptsSettings->getChiefExecutiveFirstName();
				$this->formArray["chiefExecutiveMiddleName"] = $erptsSettings->getChiefExecutiveMiddleName();
				$this->formArray["chiefExecutiveLastName"] = $erptsSettings->getChiefExecutiveLastName();

				$this->formArray["assessorDesignation"] = $erptsSettings->getAssessorDesignation();
				$this->formArray["assessorFirstName"] = $erptsSettings->getAssessorFirstName();
				$this->formArray["assessorMiddleName"] = $erptsSettings->getAssessorMiddleName();
				$this->formArray["assessorLastName"] = $erptsSettings->getAssessorLastName();

				$this->formArray["treasurerDesignation"] = $erptsSettings->getTreasurerDesignation();
				$this->formArray["treasurerFirstName"] = $erptsSettings->getTreasurerFirstName();
				$this->formArray["treasurerMiddleName"] = $erptsSettings->getTreasurerMiddleName();
				$this->formArray["treasurerLastName"] = $erptsSettings->getTreasurerLastName();
			}
		}

		$ImprovementsBuildingsDepreciationList = new SoapObject(NCCBIZ."ImprovementsBuildingsDepreciationList.php", "urn:Object");

		$condition = " WHERE status='active' ";
		$condition .= $this->sortBlocks();
		$this->tpl->set_var("activeInactive","(active ONLY)");

		if (!$xmlStr = $ImprovementsBuildingsDepreciationList->getImprovementsBuildingsDepreciationList(0,$condition)){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "database is empty");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
	 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$improvementsBuildingsDepreciationRecords = new ImprovementsBuildingsDepreciationRecords;
				$improvementsBuildingsDepreciationRecords->parseDomDocument($domDoc);
				$list = $improvementsBuildingsDepreciationRecords->getArrayList();
				$this->tpl->set_var("totalRecords",count($list));
				$this->tpl->set_block("rptsTemplate", "ImprovementsBuildingsDepreciationList", "ImprovementsBuildingsDepreciationListBlock");
				foreach ($list as $key => $listValue){
				    $this->tpl->set_var("improvementsBuildingsDepreciationID", $listValue->getImprovementsBuildingsDepreciationID());
				    $this->tpl->set_var("code", $listValue->getCode());
			        $this->tpl->set_var("description", $listValue->getDescription());
					$this->tpl->set_var("rangeLowerBound", $listValue->getRangeLowerBound());
					$this->tpl->set_var("rangeUpperBound", $listValue->getRangeUpperBound());
			        $this->tpl->set_var("value", $listValue->getValue());
			        $this->tpl->set_var("status", $listValue->getStatus());
			        $this->tpl->set_var("statusCheck", $this->getStatusCheck($listValue->getStatus()));
					$this->tpl->parse("ImprovementsBuildingsDepreciationListBlock", "ImprovementsBuildingsDepreciationList", true);
				}
			}
		}
		$this->setForm();
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
$improvementsBuildingsDepreciationList = new ImprovementsBuildingsDepreciationList($HTTP_POST_VARS,$sess,$sortBy,$sortOrder);
$improvementsBuildingsDepreciationList->Main();
?>
<?php page_close(); ?>
