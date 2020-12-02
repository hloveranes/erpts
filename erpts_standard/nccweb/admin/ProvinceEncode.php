<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Province.php";
include_once "../includes/assessor/ProvinceRecords.php";

#####################################
# Define Interface Class
#####################################
class ProvinceEncode{
	
	var $tpl;
	var $province;
	var $statusListArray;
	var $sess;
	
	function ProvinceEncode($http_post_vars,$provinceID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ProvinceEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Province");
		$this->tpl->set_var("Session", $this->sess->url(""));

        $this->tpl->set_block("rptsTemplate", "Message", "MessageBlock");				
		
		$this->formArray = array(
			"provinceID" => $provinceID
			, "code" => ""
			, "description" => ""
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
	        $ProvinceList = new SoapObject(NCCBIZ."ProvinceList.php", "urn:Object");
	        if (!$xmlStr = $ProvinceList->getProvinceList()){
	            return false;
	        }
		    else {
		        if(!$domDoc = domxml_open_mem($xmlStr)) {
		            return false;
			    }
			    else {
			        $provinceRecords = new ProvinceRecords;
			        $provinceRecords->parseDomDocument($domDoc);
			        $list = $provinceRecords->getArrayList();
			        foreach ($list as $key => $province){
			            if(strtoupper($this->formArray["code"])==strtoupper($province->getCode())){
							if($this->formArray["provinceID"]!=$province->getProvinceID()){
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
				$ProvinceDetails = new SoapObject(NCCBIZ."ProvinceDetails.php", "urn:Object");
				if (!$xmlStr = $ProvinceDetails->getProvinceDetails($this->formArray["provinceID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$province = new Province;
						$province->parseDomDocument($domDoc);
						$this->formArray["provinceID"] = $province->getProvinceID();
						$this->formArray["code"] = $province->getCode();
						$this->formArray["description"] = $province->getDescription();
						$this->formArray["status"] = $province->getStatus();
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
				$ProvinceEncode = new SoapObject(NCCBIZ."ProvinceEncode.php", "urn:Object");
				if ($this->formArray["provinceID"] <> ""){
					$ProvinceDetails = new SoapObject(NCCBIZ."ProvinceDetails.php", "urn:Object");
					if (!$xmlStr = $ProvinceDetails->getProvinceDetails($this->formArray["provinceID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$province = new Province;
							$province->parseDomDocument($domDoc);
							$province->setProvinceID($this->formArray["provinceID"]);
							$province->setCode($this->formArray["code"]);
							$province->setDescription($this->formArray["description"]);
							$province->setStatus($this->formArray["status"]);
							$province->setDomDocument();

							$doc = $province->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $ProvinceEncode->updateProvince($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $province = new Province;
					$province->setProvinceID($this->formArray["provinceID"]);
					$province->setCode($this->formArray["code"]);
					$province->setDescription($this->formArray["description"]);
					$province->setStatus($this->formArray["status"]);
					$province->setDomDocument();
			
					$doc = $province->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $ProvinceEncode->saveProvince($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["provinceID"] = $ret;

				header("location: ProvinceClose.php".$this->sess->url("").$this->sess->add_query(array("provinceID"=>$ret)));
                //header("location: ProvinceEncode.php";
				exit;
				break;
			case "cancel":
				header("location: ProvinceClose.php".$this->sess->url("").$this->sess->add_query(array("provinceID"=>$ret)));
				//header("location: ProvinceList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "ProvinceID", "ProvinceIDBlock");
				$this->tpl->set_var("ProvinceIDBlock", "");
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
$ProvinceEncode = new ProvinceEncode($HTTP_POST_VARS,$provinceID,$formAction,$sess);
$ProvinceEncode->Main();
?>

<?php //page_close(); ?>
