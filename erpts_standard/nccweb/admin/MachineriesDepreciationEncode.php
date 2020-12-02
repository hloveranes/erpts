<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/MachineriesDepreciation.php";
include_once "../includes/assessor/MachineriesDepreciationRecords.php";

#####################################
# Define Interface Class
#####################################
class MachineriesDepreciationEncode{
	
	var $tpl;
	var $machineriesDepreciation;
	var $statusListArray;
	var $sess;
	
	function MachineriesDepreciationEncode($http_post_vars,$machineriesDepreciationID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "MachineriesDepreciationEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Machineries Depreciation");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");
		
		$this->formArray = array(
			"machineriesDepreciationID" => $machineriesDepreciationID
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
			$this->tpl->set_var("reportCode_desc", $reportCode["code"]."-".$reportCode["description"]);

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
	        $MachineriesDepreciationList = new SoapObject(NCCBIZ."MachineriesDepreciationList.php", "urn:Object");
	        if (!$xmlStr = $MachineriesDepreciationList->getMachineriesDepreciationList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $machineriesDepreciationRecords = new MachineriesDepreciationRecords;
			        $machineriesDepreciationRecords->parseDomDocument($domDoc);
			        $list = $machineriesDepreciationRecords->getArrayList();
			        foreach ($list as $key => $machineriesDepreciation){
			            if(strtoupper($this->formArray["code"])==strtoupper($machineriesDepreciation->getCode())){
							if($this->formArray["machineriesDepreciationID"]!=$machineriesDepreciation->getMachineriesDepreciationID()){
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
				$MachineriesDepreciationDetails = new SoapObject(NCCBIZ."MachineriesDepreciationDetails.php", "urn:Object");
				if (!$xmlStr = $MachineriesDepreciationDetails->getMachineriesDepreciationDetails($this->formArray["machineriesDepreciationID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$machineriesDepreciation = new MachineriesDepreciation;
						$machineriesDepreciation->parseDomDocument($domDoc);
						$this->formArray["machineriesDepreciationID"] = $machineriesDepreciation->getMachineriesDepreciationID();
						$this->formArray["code"] = $machineriesDepreciation->getCode();
						$this->formArray["reportCode"] = $machineriesDepreciation->getReportCode();
						$this->formArray["description"] = $machineriesDepreciation->getDescription();
						$this->formArray["value"] = $machineriesDepreciation->getValue();
						$this->formArray["status"] = $machineriesDepreciation->getStatus();
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

				$MachineriesDepreciationEncode = new SoapObject(NCCBIZ."MachineriesDepreciationEncode.php", "urn:Object");
				if ($this->formArray["machineriesDepreciationID"] <> ""){
					$MachineriesDepreciationDetails = new SoapObject(NCCBIZ."MachineriesDepreciationDetails.php", "urn:Object");
					if (!$xmlStr = $MachineriesDepreciationDetails->getMachineriesDepreciationDetails($this->formArray["machineriesDepreciationID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$machineriesDepreciation = new MachineriesDepreciation;
							$machineriesDepreciation->parseDomDocument($domDoc);
							$machineriesDepreciation->setMachineriesDepreciationID($this->formArray["machineriesDepreciationID"]);
							$machineriesDepreciation->setCode($this->formArray["code"]);
							$machineriesDepreciation->setReportCode($this->formArray["reportCode"]);
							$machineriesDepreciation->setDescription($this->formArray["description"]);
							$machineriesDepreciation->setValue($this->formArray["value"]);
							$machineriesDepreciation->setStatus($this->formArray["status"]);
							$machineriesDepreciation->setDomDocument();

							$doc = $machineriesDepreciation->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $MachineriesDepreciationEncode->updateMachineriesDepreciation($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $machineriesDepreciation = new MachineriesDepreciation;
					$machineriesDepreciation->setMachineriesDepreciationID($this->formArray["machineriesDepreciationID"]);
					$machineriesDepreciation->setCode($this->formArray["code"]);
					$machineriesDepreciation->setReportCode($this->formArray["reportCode"]);
					$machineriesDepreciation->setDescription($this->formArray["description"]);
					$machineriesDepreciation->setValue($this->formArray["value"]);
					$machineriesDepreciation->setStatus($this->formArray["status"]);
					$machineriesDepreciation->setDomDocument();
			
					$doc = $machineriesDepreciation->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $MachineriesDepreciationEncode->saveMachineriesDepreciation($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["machineriesDepreciationID"] = $ret;
				header("location: MachineriesDepreciationClose.php".$this->sess->url("").$this->sess->add_query(array("machineriesDepreciationID"=>$ret)));
                //header("location: MachineriesDepreciationEncode.php";
				exit;
				break;
			case "cancel":
				header("location: MachineriesDepreciationClose.php".$this->sess->url("").$this->sess->add_query(array("machineriesDepreciationID"=>$ret)));
				//header("location: MachineriesDepreciationList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "MachineriesDepreciationID", "MachineriesDepreciationIDBlock");
				$this->tpl->set_var("MachineriesDepreciationIDBlock", "");
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
$MachineriesDepreciationEncode = new MachineriesDepreciationEncode($HTTP_POST_VARS,$machineriesDepreciationID,$formAction,$sess);
$MachineriesDepreciationEncode->Main();
?>

<?php //page_close(); ?>
