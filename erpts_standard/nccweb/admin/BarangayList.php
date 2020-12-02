<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Barangay.php";
include("assessor/BarangayRecords.php";

include("assessor/District.php";

include_once "../includes/assessor/MunicipalityCity.php";
include_once "../includes/assessor/MunicipalityCityRecords.php";

#####################################
# Define Interface Class
#####################################
class BarangayList{
	
	var $tpl;
	var $formArray;
	function BarangayList($http_post_vars,$sess,$sortBy,$sortOrder,$hideInactive){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must be Super-User to access
		$pageType = "1%%%%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "BarangayList.htm") ;
		$this->tpl->set_var("TITLE", "Barangay List");
		$this->tpl->set_var("Session", $this->sess->url(""));

		$this->formArray["sortBy"] = $sortBy;
		$this->formArray["sortOrder"] = $sortOrder;
		$this->formArray["hideInactive"] = $hideInactive;
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function showHideInactive(){
		$this->tpl->set_block("rptsTemplate", "ShowInactiveOn", "ShowInactiveOnBlock");
		$this->tpl->set_block("rptsTemplate", "HideInactiveOn", "HideInactiveOnBlock");

		switch($this->formArray["hideInactive"]){
			case "false":
				$this->tpl->parse("ShowInactiveOnBlock", "ShowInactiveOn", true);
				$this->tpl->set_var("HideInactiveOnBlock", "");
				$condition = "";
				break;
			case "true":
			default:
				$this->formArray["hideInactive"] = "true";
				$this->tpl->set_var("ShowInactiveOnBlock", "");
				$this->tpl->parse("HideInactiveOnBlock", "HideInactiveOn", true);
				$condition = " WHERE ".BARANGAY_TABLE.".status='active' ";
				break;
		}
		return $condition;
	}

	function sortBlocks(){
		$this->sortBlockFields = array(
			  "barangayID" => "BarangayID"
			, "code" => "Code"
			, "description" => "Description"
			, "district" => "District"
			, "municipalityCity" => "MunicipalityCity"
			, "status" => "Status"
		);

		foreach($this->sortBlockFields as $tempVar=>$TempVar){
			$this->tpl->set_block("rptsTemplate", "Ascending".$TempVar, "Ascending".$TempVar."Block");
			$this->tpl->set_block("rptsTemplate", "Descending".$TempVar, "Descending".$TempVar."Block");

			$this->formArray[$tempVar."SortOrder"] = "ASC";

			switch($this->formArray["sortBy"]){
				case $tempVar:
					switch($this->formArray["sortOrder"]){
						case "ASC":
							$this->formArray[$tempVar."SortOrder"] = "DESC";
							$this->tpl->parse("Ascending".$TempVar."Block", "Ascending".$TempVar, true);
							$this->tpl->set_var("Descending".$TempVar."Block", "");
							break;
						case "DESC":
							$this->formArray[$tempVar."SortOrder"] = "ASC";
							$this->tpl->parse("Descending".$TempVar."Block", "Descending".$TempVar, true);
							$this->tpl->set_var("Ascending".$TempVar."Block", "");
							break;
						default:
							$this->formArray["sortOrder"] = "DESC";
							$this->tpl->parse("Descending".$TempVar."Block", "Descending".$TempVar, true);
							$this->tpl->set_var("Ascending".$TempVar."Block", "");
							break;
					}

					foreach($this->sortBlockFields as $key => $value){
						if($key!=$tempVar){
							$this->tpl->set_var("Ascending".$value."Block", "");
							$this->tpl->set_var("Descending".$value."Block", "");
						}
					}
				break;
			}
		}

		switch($this->formArray["sortBy"]){
			case "barangayID":
				$condition = " ORDER BY barangayID ".$this->formArray["sortOrder"];
				break;
			case "code":
				$condition = " ORDER BY code ".$this->formArray["sortOrder"];
				break;
			case "description":
				$condition = " ORDER BY description ".$this->formArray["sortOrder"];
				break;
			case "district":
				$condition = " ORDER BY district ".$this->formArray["sortOrder"];
				break;
			case "municipalityCity":
				$condition = " ORDER BY municipalityCity ".$this->formArray["sortOrder"];
				break;
			case "status":
				$condition = " ORDER BY status ".$this->formArray["sortOrder"];
				break;
			default:
				$this->formArray["sortBy"] = "barangayID";
				$this->formArray["sortOrder"] = "DESC";
				foreach($this->sortBlockFields as $key=>$value){
					if($key!=$this->formArray["sortBy"]){
						$this->tpl->set_var("Ascending".$value."Block", "");
						$this->tpl->set_var("Descending".$value."Block", "");
					}
					else{
						$this->tpl->set_var("Ascending".$value."Block", "");
						$this->tpl->parse("Descending".$value."Block", "Descending".$value, true);
					}
				}
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
			case "delete":
				if (count($this->formArray["barangayID"]) > 0) {
					$BarangayList = new SoapObject(NCCBIZ."BarangayList.php", "urn:Object");
					if (!$deletedRows = $BarangayList->deleteBarangay($this->formArray["barangayID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				break;
			case "activate":
			        $BarangayList = new SoapObject(NCCBIZ."BarangayList.php", "urn:Object");
			        if(!$activeRows = $BarangayList->updateStatus($this->formArray["status"])){
			            $this->tpl->set_var("msg", "All records have status made <i>inactive</i>");
                    }
                    else{
                        $this->tpl->set_var("msg", $activeRows." records have status made <i>active</i>");
                    }
			    break;
			case "cancel":
				header("location: BarangayList.php?".$this->sess->name."=".$this->sess->id);
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
		}
		$BarangayList = new SoapObject(NCCBIZ."BarangayList.php", "urn:Object");

		$condition = $this->showHideInactive();
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

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

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
$barangayList = new BarangayList($HTTP_POST_VARS,$sess,$sortBy,$sortOrder,$hideInactive);
$barangayList->Main();
?>
<?php page_close(); ?>
