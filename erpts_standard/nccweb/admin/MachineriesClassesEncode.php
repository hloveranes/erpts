<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/MachineriesClasses.php";
include_once "../includes/assessor/MachineriesClassesRecords.php";

#####################################
# Define Interface Class
#####################################
class MachineriesClassesEncode{
	
	var $tpl;
	var $machineriesClasses;
	var $statusListArray;
	var $sess;
	
	function MachineriesClassesEncode($http_post_vars,$machineriesClassesID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "MachineriesClassesEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Machineries Classes");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");
		
		$this->formArray = array(
			"machineriesClassesID" => $machineriesClassesID
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
	        $MachineriesClassesList = new SoapObject(NCCBIZ."MachineriesClassesList.php", "urn:Object");
	        if (!$xmlStr = $MachineriesClassesList->getMachineriesClassesList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $machineriesClassesRecords = new MachineriesClassesRecords;
			        $machineriesClassesRecords->parseDomDocument($domDoc);
			        $list = $machineriesClassesRecords->getArrayList();
			        foreach ($list as $key => $machineriesClasses){
			            if(strtoupper($this->formArray["code"])==strtoupper($machineriesClasses->getCode())){
							if($this->formArray["machineriesClassesID"]!=$machineriesClasses->getMachineriesClassesID()){
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
				$MachineriesClassesDetails = new SoapObject(NCCBIZ."MachineriesClassesDetails.php", "urn:Object");
				if (!$xmlStr = $MachineriesClassesDetails->getMachineriesClassesDetails($this->formArray["machineriesClassesID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$machineriesClasses = new MachineriesClasses;
						$machineriesClasses->parseDomDocument($domDoc);
						$this->formArray["machineriesClassesID"] = $machineriesClasses->getMachineriesClassesID();
						$this->formArray["code"] = $machineriesClasses->getCode();
						$this->formArray["description"] = $machineriesClasses->getDescription();
						$this->formArray["value"] = $machineriesClasses->getValue();
						$this->formArray["status"] = $machineriesClasses->getStatus();
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

				$MachineriesClassesEncode = new SoapObject(NCCBIZ."MachineriesClassesEncode.php", "urn:Object");
				if ($this->formArray["machineriesClassesID"] <> ""){
					$MachineriesClassesDetails = new SoapObject(NCCBIZ."MachineriesClassesDetails.php", "urn:Object");
					if (!$xmlStr = $MachineriesClassesDetails->getMachineriesClassesDetails($this->formArray["machineriesClassesID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$machineriesClasses = new MachineriesClasses;
							$machineriesClasses->parseDomDocument($domDoc);
							$machineriesClasses->setMachineriesClassesID($this->formArray["machineriesClassesID"]);
							$machineriesClasses->setCode($this->formArray["code"]);
							$machineriesClasses->setDescription($this->formArray["description"]);
							$machineriesClasses->setValue($this->formArray["value"]);
							$machineriesClasses->setStatus($this->formArray["status"]);
							$machineriesClasses->setDomDocument();

							$doc = $machineriesClasses->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $MachineriesClassesEncode->updateMachineriesClasses($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $machineriesClasses = new MachineriesClasses;
					$machineriesClasses->setMachineriesClassesID($this->formArray["machineriesClassesID"]);
					$machineriesClasses->setCode($this->formArray["code"]);
					$machineriesClasses->setDescription($this->formArray["description"]);
					$machineriesClasses->setValue($this->formArray["value"]);
					$machineriesClasses->setStatus($this->formArray["status"]);
					$machineriesClasses->setDomDocument();
			
					$doc = $machineriesClasses->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $MachineriesClassesEncode->saveMachineriesClasses($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["machineriesClassesID"] = $ret;

				header("location: MachineriesClassesClose.php".$this->sess->url("").$this->sess->add_query(array("machineriesClassesID"=>$ret)));

                //header("location: MachineriesClassesEncode.php";
				exit;
				break;
			case "cancel":
				header("location: MachineriesClassesClose.php".$this->sess->url("").$this->sess->add_query(array("machineriesClassesID"=>$ret)));
				//header("location: MachineriesClassesList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "MachineriesClassesID", "MachineriesClassesIDBlock");
				$this->tpl->set_var("MachineriesClassesIDBlock", "");
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
$MachineriesClassesEncode = new MachineriesClassesEncode($HTTP_POST_VARS,$machineriesClassesID,$formAction,$sess);
$MachineriesClassesEncode->Main();
?>

<?php //page_close(); ?>
