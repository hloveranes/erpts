<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/PlantsTreesActualUses.php";
include_once "../includes/assessor/PlantsTreesActualUsesRecords.php";

#####################################
# Define Interface Class
#####################################
class PlantsTreesActualUsesEncode{
	
	var $tpl;
	var $plantsTreesActualUses;
	var $statusListArray;
	var $sess;
	
	function PlantsTreesActualUsesEncode($http_post_vars,$plantsTreesActualUsesID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "PlantsTreesActualUsesEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Plants & Trees Actual Uses");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");
		
		$this->formArray = array(
			"plantsTreesActualUsesID" => $plantsTreesActualUsesID
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
	        $PlantsTreesActualUsesList = new SoapObject(NCCBIZ."PlantsTreesActualUsesList.php", "urn:Object");
	        if (!$xmlStr = $PlantsTreesActualUsesList->getPlantsTreesActualUsesList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $plantsTreesActualUsesRecords = new PlantsTreesActualUsesRecords;
			        $plantsTreesActualUsesRecords->parseDomDocument($domDoc);
			        $list = $plantsTreesActualUsesRecords->getArrayList();
			        foreach ($list as $key => $plantsTreesActualUses){
			            if(strtoupper($this->formArray["code"])==strtoupper($plantsTreesActualUses->getCode())){
							if($this->formArray["plantsTreesActualUsesID"]!=$plantsTreesActualUses->getPlantsTreesActualUsesID()){
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
				$PlantsTreesActualUsesDetails = new SoapObject(NCCBIZ."PlantsTreesActualUsesDetails.php", "urn:Object");
				if (!$xmlStr = $PlantsTreesActualUsesDetails->getPlantsTreesActualUsesDetails($this->formArray["plantsTreesActualUsesID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$plantsTreesActualUses = new PlantsTreesActualUses;
						$plantsTreesActualUses->parseDomDocument($domDoc);
						$this->formArray["plantsTreesActualUsesID"] = $plantsTreesActualUses->getPlantsTreesActualUsesID();
						$this->formArray["code"] = $plantsTreesActualUses->getCode();
						$this->formArray["reportCode"] = $plantsTreesActualUses->getReportCode();
						$this->formArray["description"] = $plantsTreesActualUses->getDescription();
						$this->formArray["value"] = $plantsTreesActualUses->getValue();
						$this->formArray["status"] = $plantsTreesActualUses->getStatus();
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

				$PlantsTreesActualUsesEncode = new SoapObject(NCCBIZ."PlantsTreesActualUsesEncode.php", "urn:Object");
				if ($this->formArray["plantsTreesActualUsesID"] <> ""){
					$PlantsTreesActualUsesDetails = new SoapObject(NCCBIZ."PlantsTreesActualUsesDetails.php", "urn:Object");
					if (!$xmlStr = $PlantsTreesActualUsesDetails->getPlantsTreesActualUsesDetails($this->formArray["plantsTreesActualUsesID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$plantsTreesActualUses = new PlantsTreesActualUses;
							$plantsTreesActualUses->parseDomDocument($domDoc);
							$plantsTreesActualUses->setPlantsTreesActualUsesID($this->formArray["plantsTreesActualUsesID"]);
							$plantsTreesActualUses->setCode($this->formArray["code"]);
							$plantsTreesActualUses->setReportCode($this->formArray["reportCode"]);
							$plantsTreesActualUses->setDescription($this->formArray["description"]);
							$plantsTreesActualUses->setValue($this->formArray["value"]);
							$plantsTreesActualUses->setStatus($this->formArray["status"]);
							$plantsTreesActualUses->setDomDocument();

							$doc = $plantsTreesActualUses->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $PlantsTreesActualUsesEncode->updatePlantsTreesActualUses($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $plantsTreesActualUses = new PlantsTreesActualUses;
					$plantsTreesActualUses->setPlantsTreesActualUsesID($this->formArray["plantsTreesActualUsesID"]);
					$plantsTreesActualUses->setCode($this->formArray["code"]);
					$plantsTreesActualUses->setReportCode($this->formArray["reportCode"]);
					$plantsTreesActualUses->setDescription($this->formArray["description"]);
					$plantsTreesActualUses->setValue($this->formArray["value"]);
					$plantsTreesActualUses->setStatus($this->formArray["status"]);
					$plantsTreesActualUses->setDomDocument();
			
					$doc = $plantsTreesActualUses->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $PlantsTreesActualUsesEncode->savePlantsTreesActualUses($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["plantsTreesActualUsesID"] = $ret;

				header("location: PlantsTreesActualUsesClose.php".$this->sess->url("").$this->sess->add_query(array("plantsTreesActualUsesID"=>$ret)));
				
                //header("location: PlantsTreesActualUsesEncode.php";
				exit;
				break;
			case "cancel":
				header("location: PlantsTreesActualUsesClose.php".$this->sess->url("").$this->sess->add_query(array("plantsTreesActualUsesID"=>$ret)));
				
				//header("location: PlantsTreesActualUsesList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "PlantsTreesActualUsesID", "PlantsTreesActualUsesIDBlock");
				$this->tpl->set_var("PlantsTreesActualUsesIDBlock", "");
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
$PlantsTreesActualUsesEncode = new PlantsTreesActualUsesEncode($HTTP_POST_VARS,$plantsTreesActualUsesID,$formAction,$sess);
$PlantsTreesActualUsesEncode->Main();
?>

<?php //page_close(); ?>
