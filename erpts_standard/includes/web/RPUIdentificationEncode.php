<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/AFS.php";

#####################################
# Define Interface Class
#####################################
class RPUIdentificationEncode{
	
	var $tpl;
	var $formArray;
	
	function RPUIdentificationEncode($http_post_vars, $afsID, $formAction="",$sess){
		//global $HTTP_POST_VARS;
		global $auth;

		$this->sess = $sess;
		$this->userID = $auth->auth["uid"];

		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "RPUIdentificationEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode RPU Identification");
		$this->formArray = array(
			"afsID" => $afsID
			, "arpNumber" => ""
			, "propertyIndexNumber" => ""
			, "taxability" => ""
			, "effectivity" => ""
			, "formAction" => $formAction
		);
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function initSelected($tempVar,$compareTo,$actionStr="selected"){
		if ($this->formArray[$tempVar] == $compareTo){
			$this->tpl->set_var($tempVar."_sel", $actionStr);
		}
		else{
			$this->tpl->set_var($tempVar."_sel", "");
		}
	}

	function setForm(){
		$effectivityStartYear = 1900;
		$effectivityEndYear = date("Y")+10;
		$this->tpl->set_block("rptsTemplate", "EffectivityList", "EffectivityListBlock");
		for($i = $effectivityEndYear; $i>=$effectivityStartYear; $i--){
			$this->tpl->set_var("effectivityYear", $i);
			$this->initSelected("effectivity",$i);
			$this->tpl->parse("EffectivityListBlock", "EffectivityList", true);
		}

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "save":
				$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
				if (!$xmlStr = $AFSDetails->getAFS($this->formArray["afsID"])){
					exit("error xml");
				}
				else{
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						exit("error domDoc");
					}
					else {
						$AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
		
						$afs = new AFS;
						$afs->parseDomDocument($domDoc);

						$afs->setArpNumber($this->formArray["arpNumber"]);
						$afs->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
						$afs->setTaxability($this->formArray["taxability"]);
						$afs->setEffectivity($this->formArray["effectivity"]);

						$afs->setDomDocument();
						$doc = $afs->getDomDocument();
						$xmlStr =  $doc->dump_mem(true);

						if (!$ret = $AFSEncode->updateAFS($xmlStr)){
							exit("error update");
						}

					}
				}

				header("location: RPUIdentificationClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"]))); 

				exit();
				break;
			default:
				$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
				
				$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
				if (!$xmlStr = $AFSDetails->getAFS($this->formArray["afsID"])){
					exit("error xml");
				}
				else{
					//echo $xmlStr;
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						exit("error domDoc");
					}
					else {
						$afs = new AFS;
						$afs->parseDomDocument($domDoc);

						$this->formArray["afsID"] = $afs->getAfsID();
						$this->formArray["arpNumber"] = $afs->getArpNumber();
						$this->formArray["taxability"] = $afs->getTaxability();
						$this->formArray["effectivity"] = $afs->getEffectivity();
						$this->formArray["propertyIndexNumber"] = $afs->getPropertyIndexNumber();
					}
				}

				break;
		}
		$this->setForm();

		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("afsID" => $this->formArray["afsID"])));

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
	//"perm" => "rpts_Perm"
	));
//*/

$rpuIdentificationEncode = new RPUIdentificationEncode($HTTP_POST_VARS,$afsID,$formAction,$sess);
$rpuIdentificationEncode->Main();
?>
<?php page_close(); ?>