<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/MunicipalityCity.php";
include_once "../includes/assessor/MunicipalityCityRecords.php";

include_once "../includes/assessor/Province.php";
include_once "../includes/assessor/ProvinceRecords.php";

#####################################
# Define Interface Class
#####################################
class MunicipalityCityEncode{
	
	var $tpl;
	var $municipalityCity;
	var $statusListArray;
	var $sess;
	
	function MunicipalityCityEncode($http_post_vars,$municipalityCityID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "MunicipalityCityEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode MunicipalityCity");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");				
        		
		$this->formArray = array(
			"municipalityCityID" => $municipalityCityID
			, "code" => ""
			, "provinceID" => ""
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
        if (!$xmlStr = $TempVarList->$getList("", " ORDER BY description")){
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
		
        $this->initMasterAddressList("Province", "province");
	}

	function codeAlreadyExists(){
	        $MunicipalityCityList = new SoapObject(NCCBIZ."MunicipalityCityList.php", "urn:Object");
	        if (!$xmlStr = $MunicipalityCityList->getMunicipalityCityList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $municipalityCityRecords = new MunicipalityCityRecords;
			        $municipalityCityRecords->parseDomDocument($domDoc);
			        $list = $municipalityCityRecords->getArrayList();
			        foreach ($list as $key => $municipalityCity){
			            if(strtoupper($this->formArray["code"])==strtoupper($municipalityCity->getCode())){
							if($this->formArray["municipalityCityID"]!=$municipalityCity->getMunicipalityCityID()){
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
				$MunicipalityCityDetails = new SoapObject(NCCBIZ."MunicipalityCityDetails.php", "urn:Object");
				if (!$xmlStr = $MunicipalityCityDetails->getMunicipalityCityDetails($this->formArray["municipalityCityID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$municipalityCity = new MunicipalityCity;
						$municipalityCity->parseDomDocument($domDoc);
						$this->formArray["municipalityCityID"] = $municipalityCity->getMunicipalityCityID();
						$this->formArray["code"] = $municipalityCity->getCode();
						$this->formArray["provinceID"] = $municipalityCity->getProvinceID();
						$this->formArray["description"] = $municipalityCity->getDescription();
						$this->formArray["status"] = $municipalityCity->getStatus();
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
				$MunicipalityCityEncode = new SoapObject(NCCBIZ."MunicipalityCityEncode.php", "urn:Object");
				if ($this->formArray["municipalityCityID"] <> ""){
					$MunicipalityCityDetails = new SoapObject(NCCBIZ."MunicipalityCityDetails.php", "urn:Object");
					if (!$xmlStr = $MunicipalityCityDetails->getMunicipalityCityDetails($this->formArray["municipalityCityID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$municipalityCity = new MunicipalityCity;
							$municipalityCity->parseDomDocument($domDoc);
							$municipalityCity->setMunicipalityCityID($this->formArray["municipalityCityID"]);
							$municipalityCity->setCode($this->formArray["code"]);
							$municipalityCity->setProvinceID($this->formArray["provinceID"]);
							$municipalityCity->setDescription($this->formArray["description"]);
							$municipalityCity->setStatus($this->formArray["status"]);
							$municipalityCity->setDomDocument();
							
							$doc = $municipalityCity->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							
							if (!$ret = $MunicipalityCityEncode->updateMunicipalityCity($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $municipalityCity = new MunicipalityCity;
					$municipalityCity->setMunicipalityCityID($this->formArray["municipalityCityID"]);
					$municipalityCity->setCode($this->formArray["code"]);
					$municipalityCity->setProvinceID($this->formArray["provinceID"]);
					$municipalityCity->setDescription($this->formArray["description"]);
					$municipalityCity->setStatus($this->formArray["status"]);
					$municipalityCity->setDomDocument();
			
					$doc = $municipalityCity->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $MunicipalityCityEncode->saveMunicipalityCity($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["municipalityCityID"] = $ret;

				header("location: MunicipalityCityClose.php".$this->sess->url("").$this->sess->add_query(array("municipalityCityID"=>$ret)));
                //header("location: MunicipalityCityEncode.php?".$this->sess->name."=".$this->sess->id."&municipalityCityID=".$ret.".&formAction=edit");
				exit;
				break;
			case "cancel":
				header("location: MunicipalityCityClose.php".$this->sess->url("").$this->sess->add_query(array("municipalityCityID"=>$ret)));
				//header("location: MunicipalityCityList.php?".$this->sess->name."=".$this->sess->id."&municipalityCityID=".$ret.".&formAction=edit");
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "MunicipalityCityID", "MunicipalityCityIDBlock");
				$this->tpl->set_var("MunicipalityCityIDBlock", "");
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
$MunicipalityCityEncode = new MunicipalityCityEncode($HTTP_POST_VARS,$municipalityCityID,$formAction,$sess);
$MunicipalityCityEncode->Main();
?>

<?php //page_close(); ?>
