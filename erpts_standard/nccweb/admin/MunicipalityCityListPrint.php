<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/MunicipalityCity.php";
include("assessor/MunicipalityCityRecords.php";
include("assessor/Province.php";
include_once "../includes/assessor/eRPTSSettings.php";

#####################################
# Define Interface Class
#####################################
class MunicipalityCityList{
	
	var $tpl;
	var $formArray;
	function MunicipalityCityList($http_post_vars,$sess,$sortBy,$sortOrder){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "MunicipalityCityListPrint.htm") ;
		$this->tpl->set_var("TITLE", "MunicipalityCity List");
		$this->tpl->set_var("Session", $this->sess->url(""));

		$this->formArray["sortBy"] = $sortBy;
		$this->formArray["sortOrder"] = $sortOrder;
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function sortBlocks(){
		$this->formArray["municipalityCityIDSortOrder"] = "ASC";
		$this->formArray["codeSortOrder"] = "ASC";
		$this->formArray["descriptionSortOrder"] = "ASC";
		$this->formArray["provinceSortOrder"] = "ASC";
		$this->formArray["statusSortOrder"] = "ASC";

		switch($this->formArray["sortBy"]){
			case "municipalityCityID":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["municipalityCityIDSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["municipalityCityIDSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY municipalityCityID ".$this->formArray["sortOrder"];
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
			case "province":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["provinceSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["provinceSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY province ".$this->formArray["sortOrder"];
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
				$this->formArray["sortBy"] = "municipalityCityID";
				$this->formArray["sortOrder"] = "DESC";
				$condition = " ORDER BY municipalityCityID DESC";
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

    function getProvince($provinceID){
        $ProvinceDetails = new SoapObject(NCCBIZ."ProvinceDetails.php", "urn:Object");
        if(!$xmlStr = $ProvinceDetails->getProvinceDetails($provinceID)){
            $ret = "District DB empty";
        }
        else{
            if(!$domDoc = domxml_open_mem($xmlStr)){
                $ret = "error provinceXmlDoc";
            }
            else{
                $province = new Province;
                $province->parseDomDocument($domDoc);
                $ret = $province->getDescription();
			}
        }
        return $ret;
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

		$MunicipalityCityList = new SoapObject(NCCBIZ."MunicipalityCityList.php", "urn:Object");
		
		$condition = " WHERE ".MUNICIPALITYCITY_TABLE.".status='active' ";
		$this->tpl->set_var("activeInactive","(active ONLY)");
		$condition .= $this->sortBlocks();

		if (!$xmlStr = $MunicipalityCityList->getMunicipalityCityList(0,$condition)){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "database is empty");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
	 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$municipalityCityRecords = new MunicipalityCityRecords;
				$municipalityCityRecords->parseDomDocument($domDoc);
				$list = $municipalityCityRecords->getArrayList();
				$this->tpl->set_var("totalRecords", count($list));
				$this->tpl->set_block("rptsTemplate", "MunicipalityCityList", "MunicipalityCityListBlock");
				foreach ($list as $key => $value){
				    $this->tpl->set_var("municipalityCityID", $value->getMunicipalityCityID());
				    $this->tpl->set_var("code", $value->getCode());
   				    $this->tpl->set_var("province", $this->getProvince($value->getProvinceID()));				
			        $this->tpl->set_var("description", $value->getDescription());
			        $this->tpl->set_var("status", $value->getStatus());
			        $this->tpl->set_var("statusCheck", $this->getStatusCheck($value->getStatus()));
					$this->tpl->parse("MunicipalityCityListBlock", "MunicipalityCityList", true);
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
$municipalityCityList = new MunicipalityCityList($HTTP_POST_VARS,$sess,$sortBy,$sortOrder);
$municipalityCityList->Main();
?>
<?php page_close(); ?>
