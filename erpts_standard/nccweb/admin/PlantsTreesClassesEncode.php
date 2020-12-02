<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/PlantsTreesClasses.php";
include_once "../includes/assessor/PlantsTreesClassesRecords.php";

#####################################
# Define Interface Class
#####################################
class PlantsTreesClassesEncode{
	
	var $tpl;
	var $plantsTreesClasses;
	var $statusListArray;
	var $sess;
	
	function PlantsTreesClassesEncode($http_post_vars,$plantsTreesClassesID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "PlantsTreesClassesEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Plant & Tree Classes");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");
		
		$this->formArray = array(
			"plantsTreesClassesID" => $plantsTreesClassesID
			, "code" => ""
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
		$this->tpl->set_block("rptsTemplate", "StatusList", "StatusListBlock");
		
		foreach($this->statusListArray as $key => $value){
			$this->tpl->set_var("statusValue", $key);
			$this->tpl->set_var("status", $value);
			$this->initSelected("status",$key);
			$this->tpl->parse("StatusListBlock", "StatusList", true);
		}
	}

	function codeAlreadyExists(){
	        $PlantsTreesClassesList = new SoapObject(NCCBIZ."PlantsTreesClassesList.php", "urn:Object");
	        if (!$xmlStr = $PlantsTreesClassesList->getPlantsTreesClassesList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $plantsTreesClassesRecords = new PlantsTreesClassesRecords;
			        $plantsTreesClassesRecords->parseDomDocument($domDoc);
			        $list = $plantsTreesClassesRecords->getArrayList();
			        foreach ($list as $key => $plantsTreesClasses){
			            if(strtoupper($this->formArray["code"])==strtoupper($plantsTreesClasses->getCode())){
							if($this->formArray["plantsTreesClassesID"]!=$plantsTreesClasses->getPlantsTreesClassesID()){
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
				$PlantsTreesClassesDetails = new SoapObject(NCCBIZ."PlantsTreesClassesDetails.php", "urn:Object");
				if (!$xmlStr = $PlantsTreesClassesDetails->getPlantsTreesClassesDetails($this->formArray["plantsTreesClassesID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$plantsTreesClasses = new PlantsTreesClasses;
						$plantsTreesClasses->parseDomDocument($domDoc);
						$this->formArray["plantsTreesClassesID"] = $plantsTreesClasses->getPlantsTreesClassesID();
						$this->formArray["code"] = $plantsTreesClasses->getCode();
						$this->formArray["description"] = $plantsTreesClasses->getDescription();
						$this->formArray["value"] = $plantsTreesClasses->getValue();
						$this->formArray["status"] = $plantsTreesClasses->getStatus();
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

				$PlantsTreesClassesEncode = new SoapObject(NCCBIZ."PlantsTreesClassesEncode.php", "urn:Object");
				if ($this->formArray["plantsTreesClassesID"] <> ""){
					$PlantsTreesClassesDetails = new SoapObject(NCCBIZ."PlantsTreesClassesDetails.php", "urn:Object");
					if (!$xmlStr = $PlantsTreesClassesDetails->getPlantsTreesClassesDetails($this->formArray["plantsTreesClassesID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$plantsTreesClasses = new PlantsTreesClasses;
							$plantsTreesClasses->parseDomDocument($domDoc);
							$plantsTreesClasses->setPlantsTreesClassesID($this->formArray["plantsTreesClassesID"]);
							$plantsTreesClasses->setCode($this->formArray["code"]);
							$plantsTreesClasses->setDescription($this->formArray["description"]);
							$plantsTreesClasses->setValue($this->formArray["value"]);
							$plantsTreesClasses->setStatus($this->formArray["status"]);
							$plantsTreesClasses->setDomDocument();

							$doc = $plantsTreesClasses->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $PlantsTreesClassesEncode->updatePlantsTreesClasses($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $plantsTreesClasses = new PlantsTreesClasses;
					$plantsTreesClasses->setPlantsTreesClassesID($this->formArray["plantsTreesClassesID"]);
					$plantsTreesClasses->setCode($this->formArray["code"]);
					$plantsTreesClasses->setDescription($this->formArray["description"]);
					$plantsTreesClasses->setValue($this->formArray["value"]);
					$plantsTreesClasses->setStatus($this->formArray["status"]);
					$plantsTreesClasses->setDomDocument();
			
					$doc = $plantsTreesClasses->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $PlantsTreesClassesEncode->savePlantsTreesClasses($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["plantsTreesClassesID"] = $ret;

				header("location: PlantsTreesClassesClose.php".$this->sess->url("").$this->sess->add_query(array("plantsTreesClassesID"=>$ret)));
                //header("location: PlantsTreesClassesEncode.php";
				exit;
				break;
			case "cancel":
				header("location: PlantsTreesClassesClose.php".$this->sess->url("").$this->sess->add_query(array("plantsTreesClassesID"=>$ret)));
				//header("location: PlantsTreesClassesList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "PlantsTreesClassesID", "PlantsTreesClassesIDBlock");
				$this->tpl->set_var("PlantsTreesClassesIDBlock", "");
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
$PlantsTreesClassesEncode = new PlantsTreesClassesEncode($HTTP_POST_VARS,$plantsTreesClassesID,$formAction,$sess);
$PlantsTreesClassesEncode->Main();
?>

<?php //page_close(); ?>
