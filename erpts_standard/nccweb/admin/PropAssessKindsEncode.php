<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/PropAssessKinds.php";

#####################################
# Define Interface Class
#####################################
class PropAssessKindsEncode{
	
	var $tpl;
	var $propAssessKinds;
	var $statusListArray;
	var $sess;
	
	function PropAssessKindsEncode($http_post_vars,$propAssessKindsID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "PropAssessKindsEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Property Assessment Kinds");
		$this->tpl->set_var("Session", $this->sess->url(""));
		
		$this->formArray = array(
			"propAssessKindsID" => $propAssessKindsID
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
				$PropAssessKindsDetails = new SoapObject(NCCBIZ."PropAssessKindsDetails.php", "urn:Object");
				if (!$xmlStr = $PropAssessKindsDetails->getPropAssessKindsDetails($this->formArray["propAssessKindsID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$propAssessKinds = new PropAssessKinds;
						$propAssessKinds->parseDomDocument($domDoc);
						$this->formArray["propAssessKindsID"] = $propAssessKinds->getPropAssessKindsID();
						$this->formArray["code"] = $propAssessKinds->getCode();
						$this->formArray["description"] = $propAssessKinds->getDescription();
						$this->formArray["value"] = $propAssessKinds->getValue();
						$this->formArray["status"] = $propAssessKinds->getStatus();
					}
				}
				break;
			case "save":
				$PropAssessKindsEncode = new SoapObject(NCCBIZ."PropAssessKindsEncode.php", "urn:Object");
				if ($this->formArray["propAssessKindsID"] <> ""){
					$PropAssessKindsDetails = new SoapObject(NCCBIZ."PropAssessKindsDetails.php", "urn:Object");
					if (!$xmlStr = $PropAssessKindsDetails->getPropAssessKindsDetails($this->formArray["propAssessKindsID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$propAssessKinds = new PropAssessKinds;
							$propAssessKinds->parseDomDocument($domDoc);
							$propAssessKinds->setPropAssessKindsID($this->formArray["propAssessKindsID"]);
							$propAssessKinds->setCode($this->formArray["code"]);
							$propAssessKinds->setDescription($this->formArray["description"]);
							$propAssessKinds->setValue($this->formArray["value"]);
							$propAssessKinds->setStatus($this->formArray["status"]);
							$propAssessKinds->setDomDocument();

							$doc = $propAssessKinds->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $PropAssessKindsEncode->updatePropAssessKinds($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $propAssessKinds = new PropAssessKinds;
					$propAssessKinds->setPropAssessKindsID($this->formArray["propAssessKindsID"]);
					$propAssessKinds->setCode($this->formArray["code"]);
					$propAssessKinds->setDescription($this->formArray["description"]);
					$propAssessKinds->setValue($this->formArray["value"]);
					$propAssessKinds->setStatus($this->formArray["status"]);
					$propAssessKinds->setDomDocument();
			
					$doc = $propAssessKinds->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $PropAssessKindsEncode->savePropAssessKinds($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["propAssessKindsID"] = $ret;
                header("location: PropAssessKindsEncode.php";
				exit;
				break;
			case "cancel":
				header("location: PropAssessKindsList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "PropAssessKindsID", "PropAssessKindsIDBlock");
				$this->tpl->set_var("PropAssessKindsIDBlock", "");
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
$PropAssessKindsEncode = new PropAssessKindsEncode($HTTP_POST_VARS,$propAssessKindsID,$formAction,$sess);
$PropAssessKindsEncode->Main();
?>

<?php //page_close(); ?>
