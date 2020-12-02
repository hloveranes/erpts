<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/LandClasses.php";
include_once "../includes/assessor/LandClassesRecords.php";

#####################################
# Define Interface Class
#####################################
class LandClassesEncode{
	
	var $tpl;
	var $landClasses;
	var $statusListArray;
	var $sess;
	
	function LandClassesEncode($http_post_vars,$landClassesID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "LandClassesEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Land Classes");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");
		
		$this->formArray = array(
			"landClassesID" => $landClassesID
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
	        $LandClassesList = new SoapObject(NCCBIZ."LandClassesList.php", "urn:Object");
	        if (!$xmlStr = $LandClassesList->getLandClassesList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $landClassesRecords = new LandClassesRecords;
			        $landClassesRecords->parseDomDocument($domDoc);
			        $list = $landClassesRecords->getArrayList();
			        foreach ($list as $key => $landClasses){
			            if(strtoupper($this->formArray["code"])==strtoupper($landClasses->getCode())){
							if($this->formArray["landClassesID"]!=$landClasses->getLandClassesID()){
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
				$LandClassesDetails = new SoapObject(NCCBIZ."LandClassesDetails.php", "urn:Object");
				if (!$xmlStr = $LandClassesDetails->getLandClassesDetails($this->formArray["landClassesID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$landClasses = new LandClasses;
						$landClasses->parseDomDocument($domDoc);
						$this->formArray["landClassesID"] = $landClasses->getLandClassesID();
						$this->formArray["code"] = $landClasses->getCode();
						$this->formArray["description"] = $landClasses->getDescription();
						$this->formArray["value"] = $landClasses->getValue();
						$this->formArray["status"] = $landClasses->getStatus();
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
				$LandClassesEncode = new SoapObject(NCCBIZ."LandClassesEncode.php", "urn:Object");
				if ($this->formArray["landClassesID"] <> ""){
					$LandClassesDetails = new SoapObject(NCCBIZ."LandClassesDetails.php", "urn:Object");
					if (!$xmlStr = $LandClassesDetails->getLandClassesDetails($this->formArray["landClassesID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$landClasses = new LandClasses;
							$landClasses->parseDomDocument($domDoc);
							$landClasses->setLandClassesID($this->formArray["landClassesID"]);
							$landClasses->setCode($this->formArray["code"]);
							$landClasses->setDescription($this->formArray["description"]);
							$landClasses->setValue($this->formArray["value"]);
							$landClasses->setStatus($this->formArray["status"]);
							$landClasses->setDomDocument();

							$doc = $landClasses->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $LandClassesEncode->updateLandClasses($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $landClasses = new LandClasses;
					$landClasses->setLandClassesID($this->formArray["landClassesID"]);
					$landClasses->setCode($this->formArray["code"]);
					$landClasses->setDescription($this->formArray["description"]);
					$landClasses->setValue($this->formArray["value"]);
					$landClasses->setStatus($this->formArray["status"]);
					$landClasses->setDomDocument();
			
					$doc = $landClasses->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $LandClassesEncode->saveLandClasses($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["landClassesID"] = $ret;

				header("location: LandClassesClose.php".$this->sess->url("").$this->sess->add_query(array("landClassesID"=>$ret)));
                // header("location: LandClassesEncode.php";
				exit;
				break;
			case "cancel":
				header("location: LandClassesClose.php".$this->sess->url("").$this->sess->add_query(array("landClassesID"=>$ret)));
				//header("location: LandClassesList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "LandClassesID", "LandClassesIDBlock");
				$this->tpl->set_var("LandClassesIDBlock", "");
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
$LandClassesEncode = new LandClassesEncode($HTTP_POST_VARS,$landClassesID,$formAction,$sess);
$LandClassesEncode->Main();
?>

<?php //page_close(); ?>
