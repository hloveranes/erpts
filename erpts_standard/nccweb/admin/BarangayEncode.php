<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Barangay.php";
include_once "../includes/assessor/BarangayRecords.php";

include_once "../includes/assessor/District.php";
include_once "../includes/assessor/DistrictRecords.php";

include_once "../includes/assessor/MunicipalityCity.php";
include_once "../includes/assessor/MunicipalityCityRecords.php";

include_once "../includes/assessor/eRPTSSettings.php";

#####################################
# Define Interface Class
#####################################
class BarangayEncode{
	
	var $tpl;
	var $barangay;
	var $statusListArray;
	var $sess;
	
	function BarangayEncode($http_post_vars,$barangayID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "BarangayEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Barangay");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");
		
		$this->formArray = array(
			"barangayID" => $barangayID
			, "code" => ""
			, "districtID" => ""
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

					// if District Code is '0' dont print District

					if($value->getCode()!="0"){
						$this->tpl->set_var($tempVar, $value->getDescription()." - ");
					}
					else{
						$this->tpl->set_var($tempVar, "");
					}

					$this->tpl->set_var("municipalityCity", $this->getMunicipalityCity($value->getMunicipalityCityID()));


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

        $this->initMasterAddressList("District", "district");
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
			
	        $BarangayList = new SoapObject(NCCBIZ."BarangayList.php", "urn:Object");
	        if (!$xmlStr = $BarangayList->getBarangayList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $barangayRecords = new BarangayRecords;
			        $barangayRecords->parseDomDocument($domDoc);
			        $list = $barangayRecords->getArrayList();
			        foreach ($list as $key => $barangay){
			            if(strtoupper($this->formArray["code"])==strtoupper($barangay->getCode())){
							if($this->formArray["barangayID"]!=$barangay->getBarangayID()){
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
				$BarangayDetails = new SoapObject(NCCBIZ."BarangayDetails.php", "urn:Object");
				if (!$xmlStr = $BarangayDetails->getBarangayDetails($this->formArray["barangayID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$barangay = new Barangay;
						$barangay->parseDomDocument($domDoc);
						$this->formArray["barangayID"] = $barangay->getBarangayID();
						$this->formArray["code"] = $barangay->getCode();
						$this->formArray["districtID"] = $barangay->getDistrictID();
						$this->formArray["description"] = $barangay->getDescription();
						$this->formArray["status"] = $barangay->getStatus();
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
				$BarangayEncode = new SoapObject(NCCBIZ."BarangayEncode.php", "urn:Object");
				if ($this->formArray["barangayID"] <> ""){
					$BarangayDetails = new SoapObject(NCCBIZ."BarangayDetails.php", "urn:Object");
					if (!$xmlStr = $BarangayDetails->getBarangayDetails($this->formArray["barangayID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$barangay = new Barangay;
							$barangay->parseDomDocument($domDoc);
							$barangay->setBarangayID($this->formArray["barangayID"]);
							$barangay->setCode($this->formArray["code"]);
							$barangay->setDistrictID($this->formArray["districtID"]);
							$barangay->setDescription($this->formArray["description"]);
							$barangay->setStatus($this->formArray["status"]);
							$barangay->setDomDocument();

							$doc = $barangay->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							//echo htmlentities($xmlStr);
							//exit;
							if (!$ret = $BarangayEncode->updateBarangay($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $barangay = new Barangay;
					$barangay->setBarangayID($this->formArray["barangayID"]);
					$barangay->setCode($this->formArray["code"]);
					$barangay->setDistrictID($this->formArray["districtID"]);
					$barangay->setDescription($this->formArray["description"]);
					$barangay->setStatus($this->formArray["status"]);
					$barangay->setDomDocument();
			
					$doc = $barangay->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $BarangayEncode->saveBarangay($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["barangayID"] = $ret;

				header("location: BarangayClose.php".$this->sess->url("").$this->sess->add_query(array("barangayID"=>$ret)));
                //header("location: BarangayEncode.php?".$this->sess->name."=".$this->sess->id."&barangayID=".$ret.".&formAction=edit");
				exit($ret);
				break;
			case "cancel":
				//header("location: BarangayList.php??".$this->sess->name."=".$this->sess->id."&barangayID=".$ret.".&formAction=edit");
				header("location: BarangayClose.php".$this->sess->url("").$this->sess->add_query(array("barangayID"=>$ret)));
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "BarangayID", "BarangayIDBlock");
				$this->tpl->set_var("BarangayIDBlock", "");
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
$BarangayEncode = new BarangayEncode($HTTP_POST_VARS,$barangayID,$formAction,$sess);
$BarangayEncode->Main();
?>

<?php //page_close(); ?>
