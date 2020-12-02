<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/MunicipalityCity.php";
include("assessor/MunicipalityCityRecords.php";

include("assessor/Province.php";

#####################################
# Define Interface Class
#####################################
class MunicipalityCityList{
	
	var $tpl;
	var $formArray;
	function MunicipalityCityList($http_post_vars,$sess,$sortBy,$sortOrder,$hideInactive){
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

		$this->tpl->set_file("rptsTemplate", "MunicipalityCityList.htm") ;
		$this->tpl->set_var("TITLE", "Municipality/City List");
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
				$condition = " WHERE ".MUNICIPALITYCITY_TABLE.".status='active' ";
				break;
		}
		return $condition;
	}

	function sortBlocks(){
		$this->sortBlockFields = array(
			  "municipalityCityID" => "MunicipalityCityID"
			, "code" => "Code"
			, "description" => "Description"
			, "province" => "Province"
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
			case "municipalityCityID":
				$condition = " ORDER BY municipalityCityID ".$this->formArray["sortOrder"];
				break;
			case "code":
				$condition = " ORDER BY code ".$this->formArray["sortOrder"];
				break;
			case "description":
				$condition = " ORDER BY description ".$this->formArray["sortOrder"];
				break;
			case "province":
				$condition = " ORDER BY province ".$this->formArray["sortOrder"];
				break;
			case "status":
				$condition = " ORDER BY status ".$this->formArray["sortOrder"];
				break;
			default:
				$this->formArray["sortBy"] = "municipalityCityID";
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
			case "delete":
				if (count($this->formArray["municipalityCityID"]) > 0) {
					$MunicipalityCityList = new SoapObject(NCCBIZ."MunicipalityCityList.php", "urn:Object");
					if (!$deletedRows = $MunicipalityCityList->deleteMunicipalityCity($this->formArray["municipalityCityID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				break;
			case "activate":
			        $MunicipalityCityList = new SoapObject(NCCBIZ."MunicipalityCityList.php", "urn:Object");
			        if(!$activeRows = $MunicipalityCityList->updateStatus($this->formArray["status"])){
			            $this->tpl->set_var("msg", "All records have status made <i>inactive</i>");
                    }
                    else{
                        $this->tpl->set_var("msg", $activeRows." records have status made <i>active</i>");
                    }
			    break;
			case "cancel":
				header("location: MunicipalityCityList.php";
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
		}
		$MunicipalityCityList = new SoapObject(NCCBIZ."MunicipalityCityList.php", "urn:Object");

		$condition = $this->showHideInactive();
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
$municipalityCityList = new MunicipalityCityList($HTTP_POST_VARS,$sess,$sortBy,$sortOrder,$hideInactive);
$municipalityCityList->Main();
?>
<?php page_close(); ?>
