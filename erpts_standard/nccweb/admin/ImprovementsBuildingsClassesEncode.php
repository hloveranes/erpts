<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/ImprovementsBuildingsClasses.php";
include_once "../includes/assessor/ImprovementsBuildingsClassesRecords.php";


#####################################
# Define Interface Class
#####################################
class ImprovementsBuildingsClassesEncode{
	
	var $tpl;
	var $improvementsBuildingsClasses;
	var $statusListArray;
	var $sess;
	
	function ImprovementsBuildingsClassesEncode($http_post_vars,$improvementsBuildingsClassesID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ImprovementsBuildingsClassesEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Buildings & Improvements Classes");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");
		
		$this->formArray = array(
			"improvementsBuildingsClassesID" => $improvementsBuildingsClassesID
			, "code" => ""
			, "description" => ""
			, "rangeLowerBound" => "0"
			, "rangeUpperBound" => "0"
			, "value" => "0"
			, "type" => ""
			, "status" => ""
			,"formAction" => $formAction
		);
		
		$this->statusListArray = array(
		    "active" => "active",
		    "inactive" => "inactive"
		);

		$this->typeListArray = array(
		    "B" => "Building",
		    "I" => "Improvement"
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

		$this->tpl->set_block("rptsTemplate", "TypeList", "TypeListBlock");
		
		foreach($this->typeListArray as $key => $value){
			$this->tpl->set_var("typeValue", $key);
			$this->tpl->set_var("type", $value);
			$this->initSelected("type",$key);
			$this->tpl->parse("TypeListBlock", "TypeList", true);
		}
	}

	function codeAlreadyExists(){
	        $ImprovementsBuildingsClassesList = new SoapObject(NCCBIZ."ImprovementsBuildingsClassesList.php", "urn:Object");
	        if (!$xmlStr = $ImprovementsBuildingsClassesList->getImprovementsBuildingsClassesList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $improvementsBuildingsClassesRecords = new ImprovementsBuildingsClassesRecords;
			        $improvementsBuildingsClassesRecords->parseDomDocument($domDoc);
			        $list = $improvementsBuildingsClassesRecords->getArrayList();
			        foreach ($list as $key => $improvementsBuildingsClasses){
			            if(strtoupper($this->formArray["code"])==strtoupper($improvementsBuildingsClasses->getCode())){
							if($this->formArray["improvementsBuildingsClassesID"]!=$improvementsBuildingsClasses->getImprovementsBuildingsClassesID()){
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
				$ImprovementsBuildingsClassesDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsClassesDetails.php", "urn:Object");
				if (!$xmlStr = $ImprovementsBuildingsClassesDetails->getImprovementsBuildingsClassesDetails($this->formArray["improvementsBuildingsClassesID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
						$improvementsBuildingsClasses->parseDomDocument($domDoc);
						$this->formArray["improvementsBuildingsClassesID"] = $improvementsBuildingsClasses->getImprovementsBuildingsClassesID();
						$this->formArray["code"] = $improvementsBuildingsClasses->getCode();
						$this->formArray["description"] = $improvementsBuildingsClasses->getDescription();
						$this->formArray["rangeLowerBound"] = $improvementsBuildingsClasses->getRangeLowerBound();
						$this->formArray["rangeUpperBound"] = $improvementsBuildingsClasses->getRangeUpperBound();
						$this->formArray["value"] = $improvementsBuildingsClasses->getValue();
						$this->formArray["type"] = $improvementsBuildingsClasses->getType();
						$this->formArray["status"] = $improvementsBuildingsClasses->getStatus();
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

				$ImprovementsBuildingsClassesEncode = new SoapObject(NCCBIZ."ImprovementsBuildingsClassesEncode.php", "urn:Object");
				if ($this->formArray["improvementsBuildingsClassesID"] <> ""){
					$ImprovementsBuildingsClassesDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsClassesDetails.php", "urn:Object");
					if (!$xmlStr = $ImprovementsBuildingsClassesDetails->getImprovementsBuildingsClassesDetails($this->formArray["improvementsBuildingsClassesID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
							$improvementsBuildingsClasses->parseDomDocument($domDoc);
							$improvementsBuildingsClasses->setImprovementsBuildingsClassesID($this->formArray["improvementsBuildingsClassesID"]);
							$improvementsBuildingsClasses->setCode($this->formArray["code"]);
							$improvementsBuildingsClasses->setDescription($this->formArray["description"]);
							$improvementsBuildingsClasses->setRangeLowerBound($this->formArray["rangeLowerBound"]);
							$improvementsBuildingsClasses->setRangeUpperBound($this->formArray["rangeUpperBound"]);
							$improvementsBuildingsClasses->setValue($this->formArray["value"]);
							$improvementsBuildingsClasses->setType($this->formArray["type"]);
							$improvementsBuildingsClasses->setStatus($this->formArray["status"]);
							$improvementsBuildingsClasses->setDomDocument();

							$doc = $improvementsBuildingsClasses->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $ImprovementsBuildingsClassesEncode->updateImprovementsBuildingsClasses($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
					$improvementsBuildingsClasses->setImprovementsBuildingsClassesID($this->formArray["improvementsBuildingsClassesID"]);
					$improvementsBuildingsClasses->setCode($this->formArray["code"]);
					$improvementsBuildingsClasses->setDescription($this->formArray["description"]);
					$improvementsBuildingsClasses->setRangeLowerBound($this->formArray["rangeLowerBound"]);
					$improvementsBuildingsClasses->setRangeUpperBound($this->formArray["rangeUpperBound"]);
					$improvementsBuildingsClasses->setValue($this->formArray["value"]);
					$improvementsBuildingsClasses->setType($this->formArray["type"]);
					$improvementsBuildingsClasses->setStatus($this->formArray["status"]);
					$improvementsBuildingsClasses->setDomDocument();
			
					$doc = $improvementsBuildingsClasses->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $ImprovementsBuildingsClassesEncode->saveImprovementsBuildingsClasses($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["improvementsBuildingsClassesID"] = $ret;
				header("location: ImprovementsBuildingsClassesClose.php".$this->sess->url("").$this->sess->add_query(array("improvementsBuildingsClassesID"=>$ret)));
				//header("location: ImprovementsBuildingsClassesEncode.php";
				exit;
				break;
			case "cancel":
				header("location: ImprovementsBuildingsClassesClose.php".$this->sess->url("").$this->sess->add_query(array("improvementsBuildingsClassesID"=>$ret)));
				//header("location: ImprovementsBuildingsClassesList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "ImprovementsBuildingsClassesID", "ImprovementsBuildingsClassesIDBlock");
				$this->tpl->set_var("ImprovementsBuildingsClassesIDBlock", "");
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
$ImprovementsBuildingsClassesEncode = new ImprovementsBuildingsClassesEncode($HTTP_POST_VARS,$improvementsBuildingsClassesID,$formAction,$sess);
$ImprovementsBuildingsClassesEncode->Main();
?>

<?php //page_close(); ?>
