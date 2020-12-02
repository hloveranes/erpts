<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/PlantsTreesActualUses.php";
include("assessor/PlantsTreesActualUsesRecords.php";
include("assessor/eRPTSSettings.php";

#####################################
# Define Interface Class
#####################################
class PlantsTreesActualUsesList{
	
	var $tpl;
	var $formArray;
	function PlantsTreesActualUsesList($http_post_vars,$sess,$sortBy,$sortOrder){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "PlantsTreesActualUsesListPrint.htm") ;
		$this->tpl->set_var("TITLE", "Plants & Trees Actual Uses List");
		$this->tpl->set_var("Session", $this->sess->url(""));

		$this->formArray["sortBy"] = $sortBy;
		$this->formArray["sortOrder"] = $sortOrder;
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function sortBlocks(){
		$this->formArray["plantsTreesActualUsesIDSortOrder"] = "ASC";
		$this->formArray["codeSortOrder"] = "ASC";
		$this->formArray["descriptionSortOrder"] = "ASC";
		$this->formArray["assessmentLevelSortOrder"] = "ASC";
		$this->formArray["statusSortOrder"] = "ASC";

		switch($this->formArray["sortBy"]){
			case "plantsTreesActualUsesID":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["plantsTreesActualUsesIDSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["plantsTreesActualUsesIDSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY plantsTreesActualUsesID ".$this->formArray["sortOrder"];
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
				$this->formArray["sortBy"] = "plantsTreesActualUsesID";
				$this->formArray["sortOrder"] = "DESC";
				$condition = " ORDER BY plantsTreesActualUsesID DESC";
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

		$PlantsTreesActualUsesList = new SoapObject(NCCBIZ."PlantsTreesActualUsesList.php", "urn:Object");

		$condition = " WHERE status='active' ";
		$condition .= $this->sortBlocks();
		$this->tpl->set_var("activeInactive","(active ONLY)");

		if (!$xmlStr = $PlantsTreesActualUsesList->getPlantsTreesActualUsesList(0,$condition)){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "database is empty");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
	 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$plantsTreesActualUsesRecords = new PlantsTreesActualUsesRecords;
				$plantsTreesActualUsesRecords->parseDomDocument($domDoc);
				$list = $plantsTreesActualUsesRecords->getArrayList();
				$this->tpl->set_var("totalRecords",count($list));
				$this->tpl->set_block("rptsTemplate", "PlantsTreesActualUsesList", "PlantsTreesActualUsesListBlock");
				foreach ($list as $key => $listValue){
				    $this->tpl->set_var("plantsTreesActualUsesID", $listValue->getPlantsTreesActualUsesID());
				    $this->tpl->set_var("code", $listValue->getCode());
			        $this->tpl->set_var("description", $listValue->getDescription());
			        $this->tpl->set_var("value", $listValue->getValue());
			        $this->tpl->set_var("status", $listValue->getStatus());
			        $this->tpl->set_var("statusCheck", $this->getStatusCheck($listValue->getStatus()));
					$this->tpl->parse("PlantsTreesActualUsesListBlock", "PlantsTreesActualUsesList", true);
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
$plantsTreesActualUsesList = new PlantsTreesActualUsesList($HTTP_POST_VARS,$sess,$sortBy,$sortOrder);
$plantsTreesActualUsesList->Main();
?>
<?php page_close(); ?>
