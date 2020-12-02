<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/MachineriesActualUses.php";
include_once "../includes/assessor/MachineriesActualUsesRecords.php";

#####################################
# Define Interface Class
#####################################
class MachineriesActualUsesEncode{
	
	var $tpl;
	var $machineriesActualUses;
	var $statusListArray;
	var $sess;
	
	function MachineriesActualUsesEncode($http_post_vars,$machineriesActualUsesID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "MachineriesActualUsesEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Machineries Actual Uses");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");
		
		$this->formArray = array(
			"machineriesActualUsesID" => $machineriesActualUsesID
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
	        $MachineriesActualUsesList = new SoapObject(NCCBIZ."MachineriesActualUsesList.php", "urn:Object");
	        if (!$xmlStr = $MachineriesActualUsesList->getMachineriesActualUsesList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $machineriesActualUsesRecords = new MachineriesActualUsesRecords;
			        $machineriesActualUsesRecords->parseDomDocument($domDoc);
			        $list = $machineriesActualUsesRecords->getArrayList();
			        foreach ($list as $key => $machineriesActualUses){
			            if(strtoupper($this->formArray["code"])==strtoupper($machineriesActualUses->getCode())){
							if($this->formArray["machineriesActualUsesID"]!=$machineriesActualUses->getMachineriesActualUsesID()){
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
				$MachineriesActualUsesDetails = new SoapObject(NCCBIZ."MachineriesActualUsesDetails.php", "urn:Object");
				if (!$xmlStr = $MachineriesActualUsesDetails->getMachineriesActualUsesDetails($this->formArray["machineriesActualUsesID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$machineriesActualUses = new MachineriesActualUses;
						$machineriesActualUses->parseDomDocument($domDoc);
						$this->formArray["machineriesActualUsesID"] = $machineriesActualUses->getMachineriesActualUsesID();
						$this->formArray["code"] = $machineriesActualUses->getCode();
						$this->formArray["reportCode"] = $machineriesActualUses->getReportCode();
						$this->formArray["description"] = $machineriesActualUses->getDescription();
						$this->formArray["value"] = $machineriesActualUses->getValue();
						$this->formArray["status"] = $machineriesActualUses->getStatus();
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

				$MachineriesActualUsesEncode = new SoapObject(NCCBIZ."MachineriesActualUsesEncode.php", "urn:Object");
				if ($this->formArray["machineriesActualUsesID"] <> ""){
					$MachineriesActualUsesDetails = new SoapObject(NCCBIZ."MachineriesActualUsesDetails.php", "urn:Object");
					if (!$xmlStr = $MachineriesActualUsesDetails->getMachineriesActualUsesDetails($this->formArray["machineriesActualUsesID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$machineriesActualUses = new MachineriesActualUses;
							$machineriesActualUses->parseDomDocument($domDoc);
							$machineriesActualUses->setMachineriesActualUsesID($this->formArray["machineriesActualUsesID"]);
							$machineriesActualUses->setCode($this->formArray["code"]);
							$machineriesActualUses->setReportCode($this->formArray["reportCode"]);
							$machineriesActualUses->setDescription($this->formArray["description"]);
							$machineriesActualUses->setValue($this->formArray["value"]);
							$machineriesActualUses->setStatus($this->formArray["status"]);
							$machineriesActualUses->setDomDocument();

							$doc = $machineriesActualUses->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $MachineriesActualUsesEncode->updateMachineriesActualUses($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $machineriesActualUses = new MachineriesActualUses;
					$machineriesActualUses->setMachineriesActualUsesID($this->formArray["machineriesActualUsesID"]);
					$machineriesActualUses->setCode($this->formArray["code"]);
					$machineriesActualUses->setReportCode($this->formArray["reportCode"]);
					$machineriesActualUses->setDescription($this->formArray["description"]);
					$machineriesActualUses->setValue($this->formArray["value"]);
					$machineriesActualUses->setStatus($this->formArray["status"]);
					$machineriesActualUses->setDomDocument();
			
					$doc = $machineriesActualUses->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $MachineriesActualUsesEncode->saveMachineriesActualUses($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["machineriesActualUsesID"] = $ret;
				header("location: MachineriesActualUsesClose.php".$this->sess->url("").$this->sess->add_query(array("machineriesActualUsesID"=>$ret)));
                //header("location: MachineriesActualUsesEncode.php";
				exit;
				break;
			case "cancel":
				header("location: MachineriesActualUsesClose.php".$this->sess->url("").$this->sess->add_query(array("machineriesActualUsesID"=>$ret)));
				//header("location: MachineriesActualUsesList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "MachineriesActualUsesID", "MachineriesActualUsesIDBlock");
				$this->tpl->set_var("MachineriesActualUsesIDBlock", "");
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
$MachineriesActualUsesEncode = new MachineriesActualUsesEncode($HTTP_POST_VARS,$machineriesActualUsesID,$formAction,$sess);
$MachineriesActualUsesEncode->Main();
?>

<?php //page_close(); ?>
