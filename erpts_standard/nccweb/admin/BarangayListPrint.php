<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Barangay.php";
include("assessor/BarangayRecords.php";
include("assessor/District.php";

include_once "../includes/assessor/MunicipalityCity.php";
include_once "../includes/assessor/MunicipalityCityRecords.php";

include_once "../includes/assessor/eRPTSSettings.php";

#####################################
# Define Interface Class
#####################################
class BarangayList{
	
	var $tpl;
	var $formArray;
	function BarangayList($http_post_vars,$sess,$sortBy,$sortOrder){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "BarangayListPrint.htm") ;
		$this->tpl->set_var("TITLE", "Barangay List");
		$this->tpl->set_var("Session", $this->sess->url(""));

		$this->formArray["sortBy"] = $sortBy;
		$this->formArray["sortOrder"] = $sortOrder;
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function sortBlocks(){
		$this->formArray["barangayIDSortOrder"] = "ASC";
		$this->formArray["codeSortOrder"] = "ASC";
		$this->formArray["descriptionSortOrder"] = "ASC";
		$this->formArray["districtSortOrder"] = "ASC";
		$this->formArray["statusSortOrder"] = "ASC";

		switch($this->formArray["sortBy"]){
			case "barangayID":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["barangayIDSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["barangayIDSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY barangayID ".$this->formArray["sortOrder"];
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
			case "district":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["districtSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["districtSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY district ".$this->formArray["sortOrder"];
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
				$this->formArray["sortBy"] = "barangayID";
				$this->formArray["sortOrder"] = "DESC";
				$condition = " ORDER BY barangayID DESC";
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

    function getDistrict($districtID){
        $DistrictDetails = new SoapObject(NCCBIZ."DistrictDetails.php", "urn:Object");
        if(!$xmlStr = $DistrictDetails->getDistrictDetails($districtID)){
            $ret = "District DB empty";
        }
        else{
            if(!$domDoc = domxml_open_mem($xmlStr)){
                $ret = "error districtXmlDoc";
            }
            else{
                $district = new District;
                $district->parseDomDocument($domDoc);
				if($district->getCode()=="0"){
					$ret = "no district";
				}
				else{
	                $ret = $district->getDescription();
				}
			}
        }
        return $ret;
    }
	
    function getMunicipalityCityID($districtID){
        $DistrictDetails = new SoapObject(NCCBIZ."DistrictDetails.php", "urn:Object");
        if(!$xmlStr = $DistrictDetails->getDistrictDetails($districtID)){
            $ret = "District DB empty";
        }
        else{
            if(!$domDoc = domxml_open_mem($xmlStr)){
                $ret = "error districtXmlDoc";
            }
            else{
                $district = new District;
                $district->parseDomDocument($domDoc);
                $ret = $district->getMunicipalityCityID();
			}
        }
        return $ret;
    }

    function getMunicipalityCity($municipalityCityID){
        $MunicipalityCityDetails = new SoapObject(NCCBIZ."MunicipalityCityDetails.php", "urn:Object");
        if(!$xmlStr = $MunicipalityCityDetails->getMunicipalityCityDetails($municipalityCityID)){
            $ret = "MunicipalityCity DB empty";
        }
        else{
            if(!$domDoc = domxml_open_mem($xmlStr)){
                $ret = "error municipalityCityXmlDoc";
            }
            else{
                $municipalityCity = new MunicipalityCity;
                $municipalityCity->parseDomDocument($domDoc);
                $ret = $municipalityCity->getDescription();
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

		$BarangayList = new SoapObject(NCCBIZ."BarangayList.php", "urn:Object");

		$condition = " WHERE ".BARANGAY_TABLE.".status='active' ";
		$this->tpl->set_var("activeInactive","(active ONLY)");
		$condition .= $this->sortBlocks();

		if (!$xmlStr = $BarangayList->getBarangayList(0,$condition)){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "database is empty");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
	 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$barangayRecords = new BarangayRecords;
				$barangayRecords->parseDomDocument($domDoc);
				
				$list = $barangayRecords->getArrayList();
				$this->tpl->set_var("totalRecords",count($list));
				
				$this->tpl->set_block("rptsTemplate", "BarangayList", "BarangayListBlock");
				foreach ($list as $key => $value){
				    $this->tpl->set_var("barangayID", $value->getBarangayID());
				    $this->tpl->set_var("code", $value->getCode());				
				    $this->tpl->set_var("district", $this->getDistrict($value->getDistrictID()));

					$this->tpl->set_var("municipalityCity", $this->getMunicipalityCity($this->getMunicipalityCityID($value->getDistrictID())));

			        $this->tpl->set_var("description", $value->getDescription());
			        $this->tpl->set_var("status", $value->getStatus());
			        $this->tpl->set_var("statusCheck", $this->getStatusCheck($value->getStatus()));
					$this->tpl->parse("BarangayListBlock", "BarangayList", true);
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
$barangayList = new BarangayList($HTTP_POST_VARS,$sess,$sortBy,$sortOrder);
$barangayList->Main();
?>
<?php page_close(); ?>
