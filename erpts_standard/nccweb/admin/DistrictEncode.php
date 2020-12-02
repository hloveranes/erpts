<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/District.php";
include_once "../includes/assessor/DistrictRecords.php";

include_once "../includes/assessor/MunicipalityCity.php";
include_once "../includes/assessor/MunicipalityCityRecords.php";

include_once "../includes/assessor/eRPTSSettings.php";

#####################################
# Define Interface Class
#####################################
class DistrictEncode{
	
	var $tpl;
	var $district;
	var $statusListArray;
	var $sess;
	
	function DistrictEncode($http_post_vars,$districtID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "DistrictEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode District");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");
		
		$this->formArray = array(
			"districtID" => $districtID
			, "code" => ""
			, "municipalityCityID" => ""
			, "description" => ""
			, "status" => ""
			,"formAction" => $formAction
		);
		
		$this->statusListArray = array(
		    "active" => "active",
		    "inactive" => "inactive"
		);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function initSelected($tempVar,$compareTo,$actionStr="checked"){
		if ($this->formArray[$tempVar] == $compareTo){
			$this->tpl->set_var($tempVar."_sel", $actionStr);
		}
		else{
			$this->tpl->set_var($tempVar."_sel", "");
		}
	}
	
	function initMasterAddressList($TempVar, $tempVar){
	    $getList = "get".$TempVar."List";
	    $getID = "get".$TempVar."ID";
	
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		$TempVarList = new SoapObject(NCCBIZ.$TempVar."List.php", "urn:Object");
        if (!$xmlStr = $TempVarList->$getList("", "ORDER BY description")){
           $this->tpl->set_var($tempVar."ID", "");
           $this->tpl->set_var($tempVar, "empty ".$tempVar." list");
		   $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
			    $this->tpl->set_var($tempVar."ID", "");
                $this->tpl->set_var($tempVar, "empty ".$tempVar." list");
		        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
			}
			else {
			    switch($tempVar){
			        case "barangay":
			           $tempVarRecords = new BarangayRecords;
                       $tempVarID = $getID;
			        break;
			        case "district":
			           $tempVarRecords = new DistrictRecords;
			           $tempVarID = $getID;
                    break;
                    case "municipalityCity":
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
				foreach ($list as $key => $value){
          			$this->tpl->set_var($tempVar."ID", $value->$tempVarID());
               		$this->tpl->set_var($tempVar, $value->getDescription());
			        $this->initSelected($tempVar."ID",$value->$tempVarID(),"selected");
			
			        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
				}
			}
		}
	
	}	
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
		$this->tpl->set_block("rptsTemplate", "StatusList", "StatusListBlock");
		
		foreach($this->statusListArray as $key => $value){
			$this->tpl->set_var("statusValue", $key);
			$this->tpl->set_var("status", $value);
			$this->initSelected("status",$key);
			$this->tpl->parse("StatusListBlock", "StatusList", true);
		}
		
        $this->initMasterAddressList("MunicipalityCity", "municipalityCity");
	}
	
	function getLGUType(){
	
		$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php", "urn:Object");
		if(!$xmlStr = $eRPTSSettingsDetails->getERPTSSettingsDetails(1)){
			// error xml
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// erro domDoc
			}
			else{
				$eRPTSSettings = new eRPTSSettings;
				$eRPTSSettings->parseDomDocument($domDoc);
				//echo $eRPTSSettings->getLGUType();
				return $eRPTSSettings->getLGUType();
			}
		}
	
	}

	function codeAlreadyExists(){
		// allow duplicates if LGU type is Province
		$lguType=$this->getLGUType();
		if($lguType=="Province"){
			return false;
		}
	
	        $DistrictList = new SoapObject(NCCBIZ."DistrictList.php", "urn:Object");
	        if (!$xmlStr = $DistrictList->getDistrictList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $districtRecords = new DistrictRecords;
			        $districtRecords->parseDomDocument($domDoc);
			        $list = $districtRecords->getArrayList();
			        foreach ($list as $key => $district){
			            if(strtoupper($this->formArray["code"])==strtoupper($district->getCode())){
							if($this->formArray["districtID"]!=$district->getDistrictID()){
								return true;
							}
                        }
				    }
			    }
		    }
    }
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "edit":
				$this->tpl->set_var("MessageBlock", "");
				$DistrictDetails = new SoapObject(NCCBIZ."DistrictDetails.php", "urn:Object");
				if (!$xmlStr = $DistrictDetails->getDistrictDetails($this->formArray["districtID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$district = new District;
						$district->parseDomDocument($domDoc);
						$this->formArray["districtID"] = $district->getDistrictID();
						$this->formArray["code"] = $district->getCode();
						$this->formArray["municipalityCityID"] = $district->getMunicipalityCityID();
						$this->formArray["description"] = $district->getDescription();
						$this->formArray["status"] = $district->getStatus();
					}
				}
				break;
			case "save":
			    if($this->codeAlreadyExists()==true){
			        $this->message = "Error. Cannot Save. Code already exists.";
		    	    $this->tpl->set_var("message", $this->message);	
					$this->tpl->parse("MessageBlock", "Message", true);
				    break;
			    }
				else{
					$this->tpl->set_var("MessageBlock", "");
				}
				$DistrictEncode = new SoapObject(NCCBIZ."DistrictEncode.php", "urn:Object");
				if ($this->formArray["districtID"] <> ""){
					$DistrictDetails = new SoapObject(NCCBIZ."DistrictDetails.php", "urn:Object");
					if (!$xmlStr = $DistrictDetails->getDistrictDetails($this->formArray["districtID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$district = new District;
							$district->parseDomDocument($domDoc);
							$district->setDistrictID($this->formArray["districtID"]);
							$district->setCode($this->formArray["code"]);
							$district->setMunicipalityCityID($this->formArray["municipalityCityID"]);
							$district->setDescription($this->formArray["description"]);
							$district->setStatus($this->formArray["status"]);
							$district->setDomDocument();

							$doc = $district->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $DistrictEncode->updateDistrict($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $district = new District;
					$district->setDistrictID($this->formArray["districtID"]);
					$district->setCode($this->formArray["code"]);
					$district->setMunicipalityCityID($this->formArray["municipalityCityID"]);
					$district->setDescription($this->formArray["description"]);
					$district->setStatus($this->formArray["status"]);
					$district->setDomDocument();
			
					$doc = $district->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $DistrictEncode->saveDistrict($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["districtID"] = $ret;
				header("location: DistrictClose.php".$this->sess->url("").$this->sess->add_query(array("districtID"=>$ret)));
				//header("location: DistrictEncode.php?".$this->sess->name."=".$this->sess->id."&districtID=".$ret.".&formAction=edit");
				exit;
				break;
			case "cancel":
				header("location: DistrictClose.php".$this->sess->url("").$this->sess->add_query(array("districtID"=>$ret)));
				//header("location: DistrictList.php?".$this->sess->name."=".$this->sess->id."&districtID=".$ret.".&formAction=edit");
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "DistrictID", "DistrictIDBlock");
				$this->tpl->set_var("DistrictIDBlock", "");
				$this->tpl->set_block("rptsTemplate", "ACK", "ACKBlock");
				$this->tpl->set_var("ACKBlock", "");
				$this->tpl->set_var("MessageBlock", "");
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

$DistrictEncode = new DistrictEncode($HTTP_POST_VARS,$districtID,$formAction,$sess);
$DistrictEncode->Main();

?>

<?php //page_close(); ?>
