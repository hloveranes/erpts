<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/ImprovementsBuildingsDepreciation.php";
include_once "../includes/assessor/ImprovementsBuildingsDepreciationRecords.php";

#####################################
# Define Interface Class
#####################################
class ImprovementsBuildingsDepreciationEncode{
	
	var $tpl;
	var $improvementsBuildingsDepreciation;
	var $statusListArray;
	var $sess;
	
	function ImprovementsBuildingsDepreciationEncode($http_post_vars,$improvementsBuildingsDepreciationID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ImprovementsBuildingsDepreciationEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Buildings & Improvements Depreciation");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");
		
		$this->formArray = array(
			"improvementsBuildingsDepreciationID" => $improvementsBuildingsDepreciationID
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
	        $ImprovementsBuildingsDepreciationList = new SoapObject(NCCBIZ."ImprovementsBuildingsDepreciationList.php", "urn:Object");
	        if (!$xmlStr = $ImprovementsBuildingsDepreciationList->getImprovementsBuildingsDepreciationList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $improvementsBuildingsDepreciationRecords = new ImprovementsBuildingsDepreciationRecords;
			        $improvementsBuildingsDepreciationRecords->parseDomDocument($domDoc);
			        $list = $improvementsBuildingsDepreciationRecords->getArrayList();
			        foreach ($list as $key => $improvementsBuildingsDepreciation){
			            if(strtoupper($this->formArray["code"])==strtoupper($improvementsBuildingsDepreciation->getCode())){
							if($this->formArray["improvementsBuildingsDepreciationID"]!=$improvementsBuildingsDepreciation->getImprovementsBuildingsDepreciationID()){
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
				$ImprovementsBuildingsDepreciationDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsDepreciationDetails.php", "urn:Object");
				if (!$xmlStr = $ImprovementsBuildingsDepreciationDetails->getImprovementsBuildingsDepreciationDetails($this->formArray["improvementsBuildingsDepreciationID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$improvementsBuildingsDepreciation = new ImprovementsBuildingsDepreciation;
						$improvementsBuildingsDepreciation->parseDomDocument($domDoc);
						$this->formArray["improvementsBuildingsDepreciationID"] = $improvementsBuildingsDepreciation->getImprovementsBuildingsDepreciationID();
						$this->formArray["code"] = $improvementsBuildingsDepreciation->getCode();
						$this->formArray["reportCode"] = $improvementsBuildingsDepreciation->getReportCode();
						$this->formArray["description"] = $improvementsBuildingsDepreciation->getDescription();
						$this->formArray["rangeLowerBound"] = $improvementsBuildingsDepreciation->getRangeLowerBound();
						$this->formArray["rangeUpperBound"] = $improvementsBuildingsDepreciation->getRangeUpperBound();
						$this->formArray["value"] = $improvementsBuildingsDepreciation->getValue();
						$this->formArray["status"] = $improvementsBuildingsDepreciation->getStatus();
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

				$ImprovementsBuildingsDepreciationEncode = new SoapObject(NCCBIZ."ImprovementsBuildingsDepreciationEncode.php", "urn:Object");
				if ($this->formArray["improvementsBuildingsDepreciationID"] <> ""){
					$ImprovementsBuildingsDepreciationDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsDepreciationDetails.php", "urn:Object");
					if (!$xmlStr = $ImprovementsBuildingsDepreciationDetails->getImprovementsBuildingsDepreciationDetails($this->formArray["improvementsBuildingsDepreciationID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$improvementsBuildingsDepreciation = new ImprovementsBuildingsDepreciation;
							$improvementsBuildingsDepreciation->parseDomDocument($domDoc);
							$improvementsBuildingsDepreciation->setImprovementsBuildingsDepreciationID($this->formArray["improvementsBuildingsDepreciationID"]);
							$improvementsBuildingsDepreciation->setCode($this->formArray["code"]);
							$improvementsBuildingsDepreciation->setReportCode($this->formArray["reportCode"]);
							$improvementsBuildingsDepreciation->setDescription($this->formArray["description"]);
							$improvementsBuildingsDepreciation->setRangeLowerBound($this->formArray["rangeLowerBound"]);
							$improvementsBuildingsDepreciation->setRangeUpperBound($this->formArray["rangeUpperBound"]);
							$improvementsBuildingsDepreciation->setValue($this->formArray["value"]);
							$improvementsBuildingsDepreciation->setStatus($this->formArray["status"]);
							$improvementsBuildingsDepreciation->setDomDocument();

							$doc = $improvementsBuildingsDepreciation->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $ImprovementsBuildingsDepreciationEncode->updateImprovementsBuildingsDepreciation($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $improvementsBuildingsDepreciation = new ImprovementsBuildingsDepreciation;
					$improvementsBuildingsDepreciation->setImprovementsBuildingsDepreciationID($this->formArray["improvementsBuildingsDepreciationID"]);
					$improvementsBuildingsDepreciation->setCode($this->formArray["code"]);
					$improvementsBuildingsDepreciation->setReportCode($this->formArray["reportCode"]);
					$improvementsBuildingsDepreciation->setDescription($this->formArray["description"]);
					$improvementsBuildingsDepreciation->setRangeLowerBound($this->formArray["rangeLowerBound"]);
					$improvementsBuildingsDepreciation->setRangeUpperBound($this->formArray["rangeUpperBound"]);
					$improvementsBuildingsDepreciation->setValue($this->formArray["value"]);
					$improvementsBuildingsDepreciation->setStatus($this->formArray["status"]);
					$improvementsBuildingsDepreciation->setDomDocument();
			
					$doc = $improvementsBuildingsDepreciation->getDomDocument();
					$xmlStr = $doc->dump_mem(true);

					if (!$ret = $ImprovementsBuildingsDepreciationEncode->saveImprovementsBuildingsDepreciation($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["improvementsBuildingsDepreciationID"] = $ret;

				header("location: ImprovementsBuildingsDepreciationClose.php".$this->sess->url("").$this->sess->add_query(array("improvementsBuildingsDepreciationID"=>$ret)));

				//header("location: ImprovementsBuildingsDepreciationEncode.php";
				exit;
				break;
			case "cancel":
				header("location: ImprovementsBuildingsDepreciationClose.php".$this->sess->url("").$this->sess->add_query(array("improvementsBuildingsDepreciationID"=>$ret)));				

				//header("location: ImprovementsBuildingsDepreciationList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "ImprovementsBuildingsDepreciationID", "ImprovementsBuildingsDepreciationIDBlock");
				$this->tpl->set_var("ImprovementsBuildingsDepreciationIDBlock", "");
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
$ImprovementsBuildingsDepreciationEncode = new ImprovementsBuildingsDepreciationEncode($HTTP_POST_VARS,$improvementsBuildingsDepreciationID,$formAction,$sess);
$ImprovementsBuildingsDepreciationEncode->Main();
?>

<?php //page_close(); ?>
