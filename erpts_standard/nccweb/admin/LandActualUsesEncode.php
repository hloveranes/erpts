<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/LandActualUses.php";
include_once "../includes/assessor/LandActualUsesRecords.php";

#####################################
# Define Interface Class
#####################################
class LandActualUsesEncode{
	
	var $tpl;
	var $landActualUses;
	var $statusListArray;
	var $sess;
	
	function LandActualUsesEncode($http_post_vars,$landActualUsesID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "LandActualUsesEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Land Actual Uses");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");
		
		$this->formArray = array(
			"landActualUsesID" => $landActualUsesID
			, "code" => ""
			, "reportCode" => ""
			, "description" => ""
			, "value" => ""
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
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}

		$this->tpl->set_block("rptsTemplate", "ReportCodeList", "ReportCodeListBlock");

		eval(REPORT_CODE_LIST);	
		foreach($reportCodeList as $key => $reportCode){
			$this->tpl->set_var("reportCode", $reportCode["code"]);
			$this->tpl->set_var("reportCode_desc", $reportCode["description"]." (".$reportCode["code"].")");

			$this->initSelected("reportCode",$reportCode["code"], "selected");
			$this->tpl->parse("ReportCodeListBlock", "ReportCodeList", true);
		}



		$this->tpl->set_block("rptsTemplate", "StatusList", "StatusListBlock");
		
		foreach($this->statusListArray as $key => $value){
			$this->tpl->set_var("statusValue", $key);
			$this->tpl->set_var("status", $value);
			$this->initSelected("status",$key);
			$this->tpl->parse("StatusListBlock", "StatusList", true);
		}
	}

	function codeAlreadyExists(){
	        $LandActualUsesList = new SoapObject(NCCBIZ."LandActualUsesList.php", "urn:Object");
	        if (!$xmlStr = $LandActualUsesList->getLandActualUsesList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $landActualUsesRecords = new LandActualUsesRecords;
			        $landActualUsesRecords->parseDomDocument($domDoc);
			        $list = $landActualUsesRecords->getArrayList();
			        foreach ($list as $key => $landActualUses){
			            if(strtoupper($this->formArray["code"])==strtoupper($landActualUses->getCode())){
							if($this->formArray["landActualUsesID"]!=$landActualUses->getLandActualUsesID()){
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
				$LandActualUsesDetails = new SoapObject(NCCBIZ."LandActualUsesDetails.php", "urn:Object");
				if (!$xmlStr = $LandActualUsesDetails->getLandActualUsesDetails($this->formArray["landActualUsesID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$landActualUses = new LandActualUses;
						$landActualUses->parseDomDocument($domDoc);
						$this->formArray["landActualUsesID"] = $landActualUses->getLandActualUsesID();
						$this->formArray["code"] = $landActualUses->getCode();
						$this->formArray["reportCode"] = $landActualUses->getReportCode();
						$this->formArray["description"] = $landActualUses->getDescription();
						$this->formArray["value"] = $landActualUses->getValue();
						$this->formArray["status"] = $landActualUses->getStatus();
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
				$LandActualUsesEncode = new SoapObject(NCCBIZ."LandActualUsesEncode.php", "urn:Object");
				if ($this->formArray["landActualUsesID"] <> ""){
					$LandActualUsesDetails = new SoapObject(NCCBIZ."LandActualUsesDetails.php", "urn:Object");
					if (!$xmlStr = $LandActualUsesDetails->getLandActualUsesDetails($this->formArray["landActualUsesID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$landActualUses = new LandActualUses;
							$landActualUses->parseDomDocument($domDoc);
							$landActualUses->setLandActualUsesID($this->formArray["landActualUsesID"]);
							$landActualUses->setCode($this->formArray["code"]);
							$landActualUses->setReportCode($this->formArray["reportCode"]);
							$landActualUses->setDescription($this->formArray["description"]);
							$landActualUses->setValue($this->formArray["value"]);
							$landActualUses->setStatus($this->formArray["status"]);
							$landActualUses->setDomDocument();

							$doc = $landActualUses->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $LandActualUsesEncode->updateLandActualUses($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $landActualUses = new LandActualUses;
					$landActualUses->setLandActualUsesID($this->formArray["landActualUsesID"]);
					$landActualUses->setCode($this->formArray["code"]);
					$landActualUses->setReportCode($this->formArray["reportCode"]);
					$landActualUses->setDescription($this->formArray["description"]);
					$landActualUses->setValue($this->formArray["value"]);
					$landActualUses->setStatus($this->formArray["status"]);
					$landActualUses->setDomDocument();
			
					$doc = $landActualUses->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $LandActualUsesEncode->saveLandActualUses($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["landActualUsesID"] = $ret;
				header("location: LandActualUsesClose.php".$this->sess->url("").$this->sess->add_query(array("landActualUsesID"=>$ret)));
                //header("location: LandActualUsesEncode.php";
				exit;
				break;
			case "cancel":
				header("location: LandActualUsesClose.php".$this->sess->url("").$this->sess->add_query(array("landActualUsesID"=>$ret)));
				//header("location: LandActualUsesList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "LandActualUsesID", "LandActualUsesIDBlock");
				$this->tpl->set_var("LandActualUsesIDBlock", "");
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
$LandActualUsesEncode = new LandActualUsesEncode($HTTP_POST_VARS,$landActualUsesID,$formAction,$sess);
$LandActualUsesEncode->Main();
?>

<?php //page_close(); ?>
