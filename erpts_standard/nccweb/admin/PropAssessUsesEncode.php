<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/PropAssessUses.php";

#####################################
# Define Interface Class
#####################################
class PropAssessUsesEncode{
	
	var $tpl;
	var $propAssessUses;
	var $statusListArray;
	var $sess;
	
	function PropAssessUsesEncode($http_post_vars,$propAssessUsesID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "PropAssessUsesEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Property Assesment Actual Uses");
		$this->tpl->set_var("Session", $this->sess->url(""));
		
		$this->formArray = array(
			"propAssessUsesID" => $propAssessUsesID
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
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "edit":
				$PropAssessUsesDetails = new SoapObject(NCCBIZ."PropAssessUsesDetails.php", "urn:Object");
				if (!$xmlStr = $PropAssessUsesDetails->getPropAssessUsesDetails($this->formArray["propAssessUsesID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$propAssessUses = new PropAssessUses;
						$propAssessUses->parseDomDocument($domDoc);
						$this->formArray["propAssessUsesID"] = $propAssessUses->getPropAssessUsesID();
						$this->formArray["code"] = $propAssessUses->getCode();
						$this->formArray["description"] = $propAssessUses->getDescription();
						$this->formArray["value"] = $propAssessUses->getValue();
						$this->formArray["status"] = $propAssessUses->getStatus();
					}
				}
				break;
			case "save":
				$PropAssessUsesEncode = new SoapObject(NCCBIZ."PropAssessUsesEncode.php", "urn:Object");
				if ($this->formArray["propAssessUsesID"] <> ""){
					$PropAssessUsesDetails = new SoapObject(NCCBIZ."PropAssessUsesDetails.php", "urn:Object");
					if (!$xmlStr = $PropAssessUsesDetails->getPropAssessUsesDetails($this->formArray["propAssessUsesID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$propAssessUses = new PropAssessUses;
							$propAssessUses->parseDomDocument($domDoc);
							$propAssessUses->setPropAssessUsesID($this->formArray["propAssessUsesID"]);
							$propAssessUses->setCode($this->formArray["code"]);
							$propAssessUses->setDescription($this->formArray["description"]);
							$propAssessUses->setValue($this->formArray["value"]);
							$propAssessUses->setStatus($this->formArray["status"]);
							$propAssessUses->setDomDocument();

							$doc = $propAssessUses->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $PropAssessUsesEncode->updatePropAssessUses($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $propAssessUses = new PropAssessUses;
					$propAssessUses->setPropAssessUsesID($this->formArray["propAssessUsesID"]);
					$propAssessUses->setCode($this->formArray["code"]);
					$propAssessUses->setDescription($this->formArray["description"]);
					$propAssessUses->setValue($this->formArray["value"]);
					$propAssessUses->setStatus($this->formArray["status"]);
					$propAssessUses->setDomDocument();
			
					$doc = $propAssessUses->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $PropAssessUsesEncode->savePropAssessUses($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["propAssessUsesID"] = $ret;
                header("location: PropAssessUsesEncode.php";
				exit;
				break;
			case "cancel":
				header("location: PropAssessUsesList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "PropAssessUsesID", "PropAssessUsesIDBlock");
				$this->tpl->set_var("PropAssessUsesIDBlock", "");
				$this->tpl->set_block("rptsTemplate", "ACK", "ACKBlock");
				$this->tpl->set_var("ACKBlock", "");
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
$PropAssessUsesEncode = new PropAssessUsesEncode($HTTP_POST_VARS,$propAssessUsesID,$formAction,$sess);
$PropAssessUsesEncode->Main();
?>

<?php //page_close(); ?>
