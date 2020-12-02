<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/Person.php";
include_once "../assessor/ImprovementsBuildings.php";
#####################################
# Define Interface Class
#####################################
class ImprovementsBuildingsEncode{
	
	var $tpl;
	var $formArray;
	var $improvementsBuildings;
	
	function ImprovementsBuildingsEncode($http_post_vars,$afsID="",$improvementsBuildingsID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "ImprovementsBuildingsEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode ImprovementsBuildings");
		
		$this->formArray = array(
			"afsID" => $afsID
			, "improvementsBuildingsID" => $improvementsBuildingsID
			, "surveyNumber" => ""
			, "buildingClassification" => ""
			, "buildingPermit" => ""
			, "buildingAge" => ""
			, "dateOccupied" => ""
			, "dateCompleted" => ""
			, "areaOfGroundFloor" => ""
			, "totalBuildingArea" => ""
			, "marketValue" => ""
			, "assessmentLevel" => ""
			, "assessedValue" => ""
			, "purpose" => ""
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
				$ImprovementsBuildingsDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsDetails.php", "urn:Object");
				if (!$xmlStr = $ImprovementsBuildingsDetails->getImprovementsBuildings($this->formArray["improvementsBuildingsID"])){
					$this->tpl->set_block("rptsTemplate", "FORM", "FORMBlock");
					$this->tpl->set_var("FORMBlock", "error xmlDoc");
				}
				else{
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "FORM", "FORMBlock");
						$this->tpl->set_var("FORMBlock", "error xmlDoc");
					}
					else {
						$improvementsBuildings = new ImprovementsBuildings;
						$improvementsBuildings->parseDomImprovementsBuildings($domDoc);
						foreach($improvementsBuildings as $key => $value){
							$this->formArray[$key] = $value;
						}
					}
				}
				break;
			case "save":
				$ImprovementsBuildingsEncode = new SoapObject(NCCBIZ."ImprovementsBuildingsEncode.php", "urn:Object");
				if ($this->formArray["improvementsBuildingsID"] <> ""){
					$improvementsBuildings = new ImprovementsBuildings;
					$improvementsBuildings->selectImprovementsBuildings($this->formArray["improvementsBuildingsID"]);
					$improvementsBuildings->setImprovementsBuildingsID($this->formArray["improvementsBuildingsID"]);
					$improvementsBuildings->setAfsID($this->formArray["afsID"]);
					$improvementsBuildings->setSurveyNumber($this->formArray["surveyNumber"]);
					$improvementsBuildings->setBuildingClassification($this->formArray["buildingClassification"]);
					$improvementsBuildings->setBuildingPermit($this->formArray["buildingPermit"]);
					$improvementsBuildings->setBuildingAge($this->formArray["buildingAge"]);
					$improvementsBuildings->setDateOccupied($this->formArray["dateOccupied"]);
					$improvementsBuildings->setDateCompleted($this->formArray["dateCompleted"]);
					$improvementsBuildings->setAreaOfGroundFloor($this->formArray["areaOfGroundFloor"]);
					$improvementsBuildings->setTotalBuildingArea($this->formArray["totalBuildingArea"]);
					$improvementsBuildings->setMarketValue($this->formArray["marketValue"]);
					$improvementsBuildings->setAssessmentLevel($this->formArray["assessmentLevel"]);
					$improvementsBuildings->setAssessedValue($this->formArray["assessedValue"]);
					$improvementsBuildings->setPurpose($this->formArray["purpose"]);
					$improvementsBuildings->setDateAssessed($this->formArray["dateAssessed"]);
					$improvementsBuildings->setAssessor($this->formArray["assessor"]);
					$improvementsBuildings->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
					$improvementsBuildings->setDomImprovementsBuildings();
					
					$doc = $improvementsBuildings->getDomImprovementsBuildings();
					$xmlStr =  $doc->dump_mem();
					if (!$ret = $ImprovementsBuildingsEncode->updateImprovementsBuildings($xmlStr)){
						echo("error update");
					}
					header("location: ImprovementsBuildingsClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
					//exit($this->formArray["afsID"]);
				}
				else {
					$improvementsBuildings = new ImprovementsBuildings;
					$improvementsBuildings->setAfsID($this->formArray["afsID"]);
					$improvementsBuildings->setSurveyNumber($this->formArray["surveyNumber"]);
					$improvementsBuildings->setBuildingClassification($this->formArray["buildingClassification"]);
					$improvementsBuildings->setBuildingPermit($this->formArray["buildingPermit"]);
					$improvementsBuildings->setBuildingAge($this->formArray["buildingAge"]);
					$improvementsBuildings->setDateOccupied($this->formArray["dateOccupied"]);
					$improvementsBuildings->setDateCompleted($this->formArray["dateCompleted"]);
					$improvementsBuildings->setAreaOfGroundFloor($this->formArray["areaOfGroundFloor"]);
					$improvementsBuildings->setTotalBuildingArea($this->formArray["totalBuildingArea"]);
					$improvementsBuildings->setMarketValue($this->formArray["marketValue"]);
					$improvementsBuildings->setAssessmentLevel($this->formArray["assessmentLevel"]);
					$improvementsBuildings->setAssessedValue($this->formArray["assessedValue"]);
					$improvementsBuildings->setPurpose($this->formArray["purpose"]);
					$improvementsBuildings->setDateAssessed($this->formArray["dateAssessed"]);
					$improvementsBuildings->setAssessor($this->formArray["assessor"]);
					$improvementsBuildings->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
					$improvementsBuildings->setDomImprovementsBuildings();
			
					$doc = $improvementsBuildings->getDomImprovementsBuildings();
					$xmlStr =  $doc->dump_mem(true);
					if (!$ret = $ImprovementsBuildingsEncode->saveImprovementsBuildings($xmlStr)){
						echo("puke<br>");
					}
					$this->formArray["improvementsBuildingsID"] = $ret;
					header("location: ImprovementsBuildingsClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
					exit("improvementsBuildingsID = $ret"."<br>afsID=".$this->formArray["afsID"]);
				}
				break;
			case "cancel":
				header("location: ImprovementsBuildingsList.php";
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
$improvementsBuildingsEncode = new ImprovementsBuildingsEncode($HTTP_POST_VARS,$afsID,$improvementsBuildingsID,$formAction,$sess);
$improvementsBuildingsEncode->main();
?>
<?php page_close(); ?>