<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PlantsTrees.php";
#####################################
# Define Interface Class
#####################################
class PlantsTreesEncode{
	
	var $tpl;
	var $formArray;
	var $plantsTrees;
	
	function PlantsTreesEncode($http_post_vars,$afsID="",$plantsTreesID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PlantsTreesEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode PlantsTrees");
		
		$this->formArray = array(
			"afsID" => $afsID
			, "plantsTreesID" => $plantsTreesID
			, "surveyNumber" => ""
			, "productClass" => ""
			, "areaPlanted" => ""
			, "totalNumber" => ""
			, "nonFruitBearing" => ""
			, "fruitBearing" => ""
			, "age" => ""
			, "unitPrice" => ""
			, "marketValue" => ""
			, "valueAdjustment" => ""
			, "adjustedMarketValue" => ""
			, "kind" => ""
			, "actualUse" => ""
			, "assessmentLevel" => ""
			, "assessedValue" => ""
			, "dateAssessed" => ""
			, "assessor" => ""
			, "propertyIndexNumber" => ""
			, "formAction" => $formAction
		);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "edit":
				$PlantsTreesDetails = new SoapObject(NCCBIZ."PlantsTreesDetails.php", "urn:Object");
				if (!$xmlStr = $PlantsTreesDetails->getPlantsTrees($this->formArray["plantsTreesID"])){
					$this->tpl->set_block("rptsTemplate", "FORM", "FORMBlock");
					$this->tpl->set_var("FORMBlock", "error xmlDoc");
				}
				else{
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "FORM", "FORMBlock");
						$this->tpl->set_var("FORMBlock", "error xmlDoc");
					}
					else {
						$plantsTrees = new PlantsTrees;
						$plantsTrees->parseDomPlantsTrees($domDoc);
						foreach($plantsTrees as $key => $value){
							$this->formArray[$key] = $value;
						}
					}
				}
				break;
			case "save":
				$PlantsTreesEncode = new SoapObject(NCCBIZ."PlantsTreesEncode.php", "urn:Object");
				if ($this->formArray["plantsTreesID"] <> ""){
					$plantsTrees = new PlantsTrees;
					$plantsTrees->selectPlantsTrees($this->formArray["plantsTreesID"]);
					$plantsTrees->setPlantsTreesID($this->formArray["plantsTreesID"]);
					$plantsTrees->setAfsID($this->formArray["afsID"]);
					$plantsTrees->setSurveyNumber($this->formArray["surveyNumber"]);
					$plantsTrees->setProductClass($this->formArray["productClass"]);
					$plantsTrees->setAreaPlanted($this->formArray["areaPlanted"]);
					$plantsTrees->setTotalNumber($this->formArray["totalNumber"]);
					$plantsTrees->setNonFruitBearing($this->formArray["nonFruitBearing"]);
					$plantsTrees->setFruitBearing($this->formArray["fruitBearing"]);
					$plantsTrees->setAge($this->formArray["age"]);
					$plantsTrees->setUnitPrice($this->formArray["unitPrice"]);
					$plantsTrees->setMarketValue($this->formArray["marketValue"]);
					$plantsTrees->setValueAdjustment($this->formArray["valueAdjustment"]);
					$plantsTrees->setAdjustedMarketValue($this->formArray["adjustedMarketValue"]);
					$plantsTrees->setKind($this->formArray["kind"]);
					$plantsTrees->setActualUse($this->formArray["actualUse"]);
					$plantsTrees->setAssessmentLevel($this->formArray["assessmentLevel"]);
					$plantsTrees->setAssessedValue($this->formArray["assessedValue"]);
					$plantsTrees->setDateAssessed($this->formArray["dateAssessed"]);
					$plantsTrees->setAssessor($this->formArray["assessor"]);
					$plantsTrees->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
					$plantsTrees->setDomPlantsTrees();
					
					$doc = $plantsTrees->getDomPlantsTrees();
					$xmlStr =  $doc->dump_mem();
					if (!$ret = $PlantsTreesEncode->updatePlantsTrees($xmlStr)){
						echo("error update");
					}
					header("location: PlantsTreesClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
					//exit($this->formArray["afsID"]);
				}
				else {
					$plantsTrees = new PlantsTrees;
					$plantsTrees->setAfsID($this->formArray["afsID"]);
					$plantsTrees->setSurveyNumber($this->formArray["surveyNumber"]);
					$plantsTrees->setProductClass($this->formArray["productClass"]);
					$plantsTrees->setAreaPlanted($this->formArray["areaPlanted"]);
					$plantsTrees->setTotalNumber($this->formArray["totalNumber"]);
					$plantsTrees->setNonFruitBearing($this->formArray["nonFruitBearing"]);
					$plantsTrees->setFruitBearing($this->formArray["fruitBearing"]);
					$plantsTrees->setAge($this->formArray["age"]);
					$plantsTrees->setUnitPrice($this->formArray["unitPrice"]);
					$plantsTrees->setMarketValue($this->formArray["marketValue"]);
					$plantsTrees->setValueAdjustment($this->formArray["valueAdjustment"]);
					$plantsTrees->setAdjustedMarketValue($this->formArray["adjustedMarketValue"]);
					$plantsTrees->setKind($this->formArray["kind"]);
					$plantsTrees->setActualUse($this->formArray["actualUse"]);
					$plantsTrees->setAssessmentLevel($this->formArray["assessmentLevel"]);
					$plantsTrees->setAssessedValue($this->formArray["assessedValue"]);
					$plantsTrees->setDateAssessed($this->formArray["dateAssessed"]);
					$plantsTrees->setAssessor($this->formArray["assessor"]);
					$plantsTrees->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
					$plantsTrees->setDomPlantsTrees();
			
					$doc = $plantsTrees->getDomPlantsTrees();
					$xmlStr =  $doc->dump_mem(true);
					if (!$ret = $PlantsTreesEncode->savePlantsTrees($xmlStr)){
						echo("ret=".$ret."<br>");
					}
					$this->formArray["plantsTreesID"] = $ret;
					header("location: PlantsTreesClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
					exit("plantsTreesID = $ret"."<br>afsID=".$this->formArray["afsID"]);
				}
				break;
			case "cancel":
				header("location: PlantsTreesList.php";
				exit;
				break;
			default:
				
				$this->tpl->set_block("rptsTemplate", "odID", "odIDBlock");
				$this->tpl->set_var("odIDBlock", "");
				$this->tpl->set_block("rptsTemplate", "ACK", "ACKBlock");
				$this->tpl->set_var("ACKBlock", "");
		}
		$this->setForm();
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("odID"=>$this->formArray["odID"],"ownerID" => $this->formArray["ownerID"])));
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
$plantsTreesEncode = new PlantsTreesEncode($HTTP_POST_VARS,$afsID,$plantsTreesID,$formAction,$sess);
$plantsTreesEncode->main();
?>
<?php page_close(); ?>