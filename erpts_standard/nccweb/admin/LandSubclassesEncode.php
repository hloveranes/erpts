<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/LandSubclasses.php";
include_once "../includes/assessor/LandSubclassesRecords.php";

#####################################
# Define Interface Class
#####################################
class LandSubclassesEncode{
	
	var $tpl;
	var $landSubclasses;
	var $statusListArray;
	var $sess;
	
	function LandSubclassesEncode($http_post_vars,$landSubclassesID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "LandSubclassesEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Land Subclasses");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");
		
		$this->formArray = array(
			"landSubclassesID" => $landSubclassesID
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
	        $LandSubclassesList = new SoapObject(NCCBIZ."LandSubclassesList.php", "urn:Object");
	        if (!$xmlStr = $LandSubclassesList->getLandSubclassesList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $landSubclassesRecords = new LandSubclassesRecords;
			        $landSubclassesRecords->parseDomDocument($domDoc);
			        $list = $landSubclassesRecords->getArrayList();
			        foreach ($list as $key => $landSubclasses){
			            if(strtoupper($this->formArray["code"])==strtoupper($landSubclasses->getCode())){
							if($this->formArray["landSubclassesID"]!=$landSubclasses->getLandSubclassesID()){
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
				$LandSubclassesDetails = new SoapObject(NCCBIZ."LandSubclassesDetails.php", "urn:Object");
				if (!$xmlStr = $LandSubclassesDetails->getLandSubclassesDetails($this->formArray["landSubclassesID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$landSubclasses = new LandSubclasses;
						$landSubclasses->parseDomDocument($domDoc);
						$this->formArray["landSubclassesID"] = $landSubclasses->getLandSubclassesID();
						$this->formArray["code"] = $landSubclasses->getCode();
						$this->formArray["description"] = $landSubclasses->getDescription();
						$this->formArray["value"] = $landSubclasses->getValue();
						$this->formArray["status"] = $landSubclasses->getStatus();
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
				$LandSubclassesEncode = new SoapObject(NCCBIZ."LandSubclassesEncode.php", "urn:Object");
				if ($this->formArray["landSubclassesID"] <> ""){
					$LandSubclassesDetails = new SoapObject(NCCBIZ."LandSubclassesDetails.php", "urn:Object");
					if (!$xmlStr = $LandSubclassesDetails->getLandSubclassesDetails($this->formArray["landSubclassesID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$landSubclasses = new LandSubclasses;
							$landSubclasses->parseDomDocument($domDoc);
							$landSubclasses->setLandSubclassesID($this->formArray["landSubclassesID"]);
							$landSubclasses->setCode($this->formArray["code"]);
							$landSubclasses->setDescription($this->formArray["description"]);
							$landSubclasses->setValue($this->formArray["value"]);
							$landSubclasses->setStatus($this->formArray["status"]);
							$landSubclasses->setDomDocument();

							$doc = $landSubclasses->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $LandSubclassesEncode->updateLandSubclasses($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $landSubclasses = new LandSubclasses;
					$landSubclasses->setLandSubclassesID($this->formArray["landSubclassesID"]);
					$landSubclasses->setCode($this->formArray["code"]);
					$landSubclasses->setDescription($this->formArray["description"]);
					$landSubclasses->setValue($this->formArray["value"]);
					$landSubclasses->setStatus($this->formArray["status"]);
					$landSubclasses->setDomDocument();
			
					$doc = $landSubclasses->getDomDocument();
					$xmlStr = $doc->dump_mem(true);

					if (!$ret = $LandSubclassesEncode->saveLandSubclasses($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["landSubclassesID"] = $ret;

				header("location: LandSubclassesClose.php".$this->sess->url("").$this->sess->add_query(array("landSubclassesID"=>$ret)));

                //header("location: LandSubclassesEncode.php";
				exit;
				break;
			case "cancel":
				header("location: LandSubclassesClose.php".$this->sess->url("").$this->sess->add_query(array("landSubclassesID"=>$ret)));

				//header("location: LandSubclassesList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "LandSubclassesID", "LandSubclassesIDBlock");
				$this->tpl->set_var("LandSubclassesIDBlock", "");
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

$LandSubclassesEncode = new LandSubclassesEncode($HTTP_POST_VARS,$landSubclassesID,$formAction,$sess);
$LandSubclassesEncode->Main();
?>

<?php //page_close(); ?>
