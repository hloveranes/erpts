<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/ImprovementsBuildingsActualUses.php";
include_once "../includes/assessor/ImprovementsBuildingsActualUsesRecords.php";

#####################################
# Define Interface Class
#####################################
class ImprovementsBuildingsActualUsesEncode{
	
	var $tpl;
	var $improvementsBuildingsActualUses;
	var $statusListArray;
	var $sess;
	
	function ImprovementsBuildingsActualUsesEncode($http_post_vars,$improvementsBuildingsActualUsesID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ImprovementsBuildingsActualUsesEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Buildings & Improvements Actual Uses");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");
		
		$this->formArray = array(
			"improvementsBuildingsActualUsesID" => $improvementsBuildingsActualUsesID
			, "code" => ""
			, "reportCode" => ""
			, "description" => ""
			, "rangeLowerBound" => ""
			, "rangeUpperBound" => ""
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
	        $ImprovementsBuildingsActualUsesList = new SoapObject(NCCBIZ."ImprovementsBuildingsActualUsesList.php", "urn:Object");
	        if (!$xmlStr = $ImprovementsBuildingsActualUsesList->getImprovementsBuildingsActualUsesList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $improvementsBuildingsActualUsesRecords = new ImprovementsBuildingsActualUsesRecords;
			        $improvementsBuildingsActualUsesRecords->parseDomDocument($domDoc);
			        $list = $improvementsBuildingsActualUsesRecords->getArrayList();
			        foreach ($list as $key => $improvementsBuildingsActualUses){
			            if(strtoupper($this->formArray["code"])==strtoupper($improvementsBuildingsActualUses->getCode())){
							if($this->formArray["improvementsBuildingsActualUsesID"]!=$improvementsBuildingsActualUses->getImprovementsBuildingsActualUsesID()){
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
				$ImprovementsBuildingsActualUsesDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsActualUsesDetails.php", "urn:Object");
				if (!$xmlStr = $ImprovementsBuildingsActualUsesDetails->getImprovementsBuildingsActualUsesDetails($this->formArray["improvementsBuildingsActualUsesID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
						$improvementsBuildingsActualUses->parseDomDocument($domDoc);
						$this->formArray["improvementsBuildingsActualUsesID"] = $improvementsBuildingsActualUses->getImprovementsBuildingsActualUsesID();
						$this->formArray["code"] = $improvementsBuildingsActualUses->getCode();
						$this->formArray["reportCode"] = $improvementsBuildingsActualUses->getReportCode();
						$this->formArray["description"] = $improvementsBuildingsActualUses->getDescription();
						$this->formArray["rangeLowerBound"] = $improvementsBuildingsActualUses->getRangeLowerBound();
						$this->formArray["rangeUpperBound"] = $improvementsBuildingsActualUses->getRangeUpperBound();
						$this->formArray["value"] = $improvementsBuildingsActualUses->getValue();
						$this->formArray["status"] = $improvementsBuildingsActualUses->getStatus();
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

				$ImprovementsBuildingsActualUsesEncode = new SoapObject(NCCBIZ."ImprovementsBuildingsActualUsesEncode.php", "urn:Object");
				if ($this->formArray["improvementsBuildingsActualUsesID"] <> ""){
					$ImprovementsBuildingsActualUsesDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsActualUsesDetails.php", "urn:Object");
					if (!$xmlStr = $ImprovementsBuildingsActualUsesDetails->getImprovementsBuildingsActualUsesDetails($this->formArray["improvementsBuildingsActualUsesID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
							$improvementsBuildingsActualUses->parseDomDocument($domDoc);
							$improvementsBuildingsActualUses->setImprovementsBuildingsActualUsesID($this->formArray["improvementsBuildingsActualUsesID"]);
							$improvementsBuildingsActualUses->setCode($this->formArray["code"]);
							$improvementsBuildingsActualUses->setReportCode($this->formArray["reportCode"]);
							$improvementsBuildingsActualUses->setDescription($this->formArray["description"]);
							$improvementsBuildingsActualUses->setRangeLowerBound($this->formArray["rangeLowerBound"]);
							$improvementsBuildingsActualUses->setRangeUpperBound($this->formArray["rangeUpperBound"]);
							$improvementsBuildingsActualUses->setValue($this->formArray["value"]);
							$improvementsBuildingsActualUses->setStatus($this->formArray["status"]);
							$improvementsBuildingsActualUses->setDomDocument();

							$doc = $improvementsBuildingsActualUses->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $ImprovementsBuildingsActualUsesEncode->updateImprovementsBuildingsActualUses($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
					$improvementsBuildingsActualUses->setImprovementsBuildingsActualUsesID($this->formArray["improvementsBuildingsActualUsesID"]);
					$improvementsBuildingsActualUses->setCode($this->formArray["code"]);
					$improvementsBuildingsActualUses->setReportCode($this->formArray["reportCode"]);
					$improvementsBuildingsActualUses->setDescription($this->formArray["description"]);
					$improvementsBuildingsActualUses->setRangeLowerBound($this->formArray["rangeLowerBound"]);
					$improvementsBuildingsActualUses->setRangeUpperBound($this->formArray["rangeUpperBound"]);
					$improvementsBuildingsActualUses->setValue($this->formArray["value"]);
					$improvementsBuildingsActualUses->setStatus($this->formArray["status"]);
					$improvementsBuildingsActualUses->setDomDocument();
			
					$doc = $improvementsBuildingsActualUses->getDomDocument();
					$xmlStr = $doc->dump_mem(true);

					if (!$ret = $ImprovementsBuildingsActualUsesEncode->saveImprovementsBuildingsActualUses($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["improvementsBuildingsActualUsesID"] = $ret;

				header("location: ImprovementsBuildingsActualUsesClose.php".$this->sess->url("").$this->sess->add_query(array("improvementsBuildingsActualUsesID"=>$ret)));

				//header("location: ImprovementsBuildingsActualUsesEncode.php";
				exit;
				break;
			case "cancel":
				header("location: ImprovementsBuildingsActualUsesClose.php".$this->sess->url("").$this->sess->add_query(array("improvementsBuildingsActualUsesID"=>$ret)));				

				//header("location: ImprovementsBuildingsActualUsesList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "ImprovementsBuildingsActualUsesID", "ImprovementsBuildingsActualUsesIDBlock");
				$this->tpl->set_var("ImprovementsBuildingsActualUsesIDBlock", "");
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
$ImprovementsBuildingsActualUsesEncode = new ImprovementsBuildingsActualUsesEncode($HTTP_POST_VARS,$improvementsBuildingsActualUsesID,$formAction,$sess);
$ImprovementsBuildingsActualUsesEncode->Main();
?>

<?php //page_close(); ?>
