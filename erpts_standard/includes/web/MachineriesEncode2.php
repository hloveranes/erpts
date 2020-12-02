<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/Person.php";
include_once "../assessor/Machineries.php";
#####################################
# Define Interface Class
#####################################
class MachineriesEncode{
	
	var $tpl;
	var $formArray;
	var $machineries;
	
	function MachineriesEncode($http_post_vars,$afsID="",$machineriesID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "MachineriesEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Machineries");
		
		$this->formArray = array(
			"afsID" => $afsID
			, "machineriesID" => $machineriesID
			, "surveyNumber" => ""
			, "description" => ""
			, "brandAndModel" => ""
			, "capacityHP" => ""
			, "dateAcquired" => ""
			, "conditionWhenAcquired" => ""
			, "estimatedEconomicLife" => ""
			, "remainingEconomicLife" => ""
			, "dateOfInstallation" => ""
			, "dateOfOperation" => ""
			, "remarks" => ""
			, "numberOfUnits" => ""
			, "freightAcquisitionCost" => ""
			, "insuranceAcquisitionCost" => ""
			, "installationAcquisitionCost" => ""
			, "others" => ""
			, "marketValue" => ""
			, "depreciation" => ""
			, "depreciatedMarketValue" => ""
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
				$MachineriesDetails = new SoapObject(NCCBIZ."MachineriesDetails.php", "urn:Object");
				if (!$xmlStr = $MachineriesDetails->getMachineries($this->formArray["machineriesID"])){
					$this->tpl->set_block("rptsTemplate", "FORM", "FORMBlock");
					$this->tpl->set_var("FORMBlock", "error xmlDoc");
				}
				else{
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "FORM", "FORMBlock");
						$this->tpl->set_var("FORMBlock", "error xmlDoc");
					}
					else {
						$machineries = new Machineries;
						$machineries->parseDomMachineries($domDoc);
						foreach($machineries as $key => $value){
							$this->formArray[$key] = $value;
						}
					}
				}
				break;
			case "save":
				$MachineriesEncode = new SoapObject(NCCBIZ."MachineriesEncode.php", "urn:Object");
				if ($this->formArray["machineriesID"] <> ""){
					$machineries = new Machineries;
					$machineries->selectMachineries($this->formArray["machineriesID"]);
					$machineries->setMachineriesID($this->formArray["machineriesID"]);
					$machineries->setAfsID($this->formArray["afsID"]);
					$machineries->setSurveyNumber($this->formArray["surveyNumber"]);
					$machineries->setDescription($this->formArray["description"]);
					$machineries->setBrandAndModel($this->formArray["brandAndModel"]);
					$machineries->setCapacityHP($this->formArray["capacityHP"]);
					$machineries->setDateAcquired($this->formArray["dateAcquired"]);
					$machineries->setConditionWhenAcquired($this->formArray["conditionWhenAcquired"]);
					$machineries->setEstimatedEconomicLife($this->formArray["estimatedEconomicLife"]);
					$machineries->setRemainingEconomicLife($this->formArray["remainingEconomicLife"]);
					$machineries->setDateOfInstallation($this->formArray["dateOfInstallation"]);
					$machineries->setDateOfOperation($this->formArray["dateOfOperation"]);
					$machineries->setRemarks($this->formArray["remarks"]);
					$machineries->setNumberOfUnits($this->formArray["numberOfUnits"]);
					$machineries->setFreightAcquisitionCost($this->formArray["freightAcquisitionCost"]);
					$machineries->setInsuranceAcquisitionCost($this->formArray["insuranceAcquisitionCost"]);
					$machineries->setInstallationAcquisitionCost($this->formArray["installationAcquisitionCost"]);
					$machineries->setOthers($this->formArray["others"]);
					$machineries->setMarketValue($this->formArray["marketValue"]);
					$machineries->setDepreciation($this->formArray["depreciation"]);
					$machineries->setDdepreciatedMarketValue($this->formArray["depreciatedMarketValue"]);
					$machineries->setAssessmentLevel($this->formArray["assessmentLevel"]);
					$machineries->setAssessedValue($this->formArray["assessedValue"]);
					$machineries->setDateAssessed($this->formArray["dateAssessed"]);
					$machineries->setAssessor($this->formArray["assessor"]);
					$machineries->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
					$machineries->setDomMachineries();
					
					$doc = $machineries->getDomMachineries();
					$xmlStr =  $doc->dump_mem();
					if (!$ret = $MachineriesEncode->updateMachineries($xmlStr)){
						echo("error update");
					}
					header("location: MachineriesClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
					//exit($this->formArray["afsID"]);
				}
				else {
					$machineries = new Machineries;
					$machineries->setAfsID($this->formArray["afsID"]);
					$machineries->setSurveyNumber($this->formArray["surveyNumber"]);
					$machineries->setDescription($this->formArray["description"]);
					$machineries->setBrandAndModel($this->formArray["brandAndModel"]);
					$machineries->setCapacityHP($this->formArray["capacityHP"]);
					$machineries->setDateAcquired($this->formArray["dateAcquired"]);
					$machineries->setConditionWhenAcquired($this->formArray["conditionWhenAcquired"]);
					$machineries->setEstimatedEconomicLife($this->formArray["estimatedEconomicLife"]);
					$machineries->setRemainingEconomicLife($this->formArray["remainingEconomicLife"]);
					$machineries->setDateOfInstallation($this->formArray["dateOfInstallation"]);
					$machineries->setDateOfOperation($this->formArray["dateOfOperation"]);
					$machineries->setRemarks($this->formArray["remarks"]);
					$machineries->setNumberOfUnits($this->formArray["numberOfUnits"]);
					$machineries->setFreightAcquisitionCost($this->formArray["freightAcquisitionCost"]);
					$machineries->setInsuranceAcquisitionCost($this->formArray["insuranceAcquisitionCost"]);
					$machineries->setInstallationAcquisitionCost($this->formArray["installationAcquisitionCost"]);
					$machineries->setOthers($this->formArray["others"]);
					$machineries->setMarketValue($this->formArray["marketValue"]);
					$machineries->setDepreciation($this->formArray["depreciation"]);
					$machineries->setDepreciatedMarketValue($this->formArray["depreciatedMarketValue"]);
					$machineries->setAssessmentLevel($this->formArray["assessmentLevel"]);
					$machineries->setAssessedValue($this->formArray["assessedValue"]);
					$machineries->setDateAssessed($this->formArray["dateAssessed"]);
					$machineries->setAssessor($this->formArray["assessor"]);
					$machineries->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
					$machineries->setDomMachineries();
			
					$doc = $machineries->getDomMachineries();
					$xmlStr =  $doc->dump_mem(true);
					
					if (!$ret = $MachineriesEncode->saveMachineries($xmlStr)){
						echo("ret=".$ret."<br>");
					}
					//echo $xmlStr;
					$this->formArray["machineriesID"] = $ret;
					header("location: MachineriesClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
					exit("machineriesID = $ret"."<br>afsID=".$this->formArray["afsID"]);
				}
				break;
			case "cancel":
				header("location: MachineriesList.php";
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
$machineriesEncode = new MachineriesEncode($HTTP_POST_VARS,$afsID,$machineriesID,$formAction,$sess);
$machineriesEncode->main();
?>
<?php page_close(); ?>