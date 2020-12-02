<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/OD.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/TD.php";

include_once "../includes/assessor/LandClasses.php";
include_once "../includes/assessor/LandSubclasses.php";
include_once "../includes/assessor/LandActualUses.php";
include_once "../includes/assessor/PlantsTreesClasses.php";
include_once "../includes/assessor/PlantsTreesActualUses.php";
include_once "../includes/assessor/ImprovementsBuildingsClasses.php";
include_once "../includes/assessor/ImprovementsBuildingsActualUses.php";
include_once "../includes/assessor/MachineriesClasses.php";
include_once "../includes/assessor/MachineriesActualUses.php";

#####################################
# Define Interface Class
#####################################
class MergeOwnerPersonConfirm{
	
	var $tpl;
	function MergeOwnerPersonConfirm($sess,$http_post_vars){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must be Super-User to access
		$pageType = "1%%%%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "MergeOwnerPersonConfirm.htm") ;
		$this->tpl->set_var("TITLE", "Merge Owner Confirm");

		$this->formArray = array(
			"personID" => "" // array of personIDs
			, "formAction" => $formAction
		);

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	// AFS Functions

	function htmlProperty($label,$value){
		$str = "&nbsp;&nbsp;<b>".$label." :  </b>".$value."<br>";
		return $str;
	}

	function clearPropertyElements(){
		$this->tpl->set_var("odID","");
		$this->tpl->set_var("afsID","");
		$this->tpl->set_var("tdID","");
		$this->tpl->set_var("locationAddress","");
		$this->tpl->set_var("propertyIndexNumber","");
		$this->tpl->set_var("taxDeclarationNumber","");
		$this->tpl->set_var("propertyType","");
 
		$landElementsArray = array(
			"propertyID" => ""
			,"octTctNumber" => ""
			,"surveyNumber" => ""
			,"north" => ""
			,"south" => ""
			,"east" => ""
			,"west" => ""
			,"description" => ""
			,"classification" => ""
			,"subClass" => ""
			,"actualUse" => ""
			,"area" => "");

		foreach($landElementsArray as $landElementKey => $blank){
			$this->tpl->set_var("land[".$landElementKey."]",$this->htmlProperty($landElementKey,$blank));
		}

		$plantsTreesElementsArray = array(
			"propertyID" => ""
			,"surveyNumber" => ""
			,"kind" => ""
			,"productClass" => ""
			,"actualUse" => ""
			,"areaPlanted" => ""
			,"number" => "");

		foreach($plantsTreesElementsArray as $plantsTreesElementKey => $blank){
			$this->tpl->set_var("plantsTrees[".$plantsTreesElementKey."]",$this->htmlProperty($plantsTreesElementKey,$blank));
		}

		$improvementsBuildingsElementsArray = array(
			"propertyID" => ""
			,"foundation" => ""
			,"columnsBldg" => ""
			,"beams" => ""
			,"trussFraming" => ""
			,"roof" => ""
			,"kind" => ""
			,"buildingClassification" => ""
			,"actualUse" => "");

		foreach($improvementsBuildingsElementsArray as $improvementsBuildingsElementKey => $blank){
			$this->tpl->set_var("improvementsBuildings[".$improvementsBuildingsElementKey."]",$this->htmlProperty($improvementsBuildingsElementKey,$blank));
		}

		$machineriesElementsArray = array(
			"propertyID" => ""
			,"machineryDescription" => ""
			,"brand" => ""
			,"modelNumber" => ""
			,"capacity" => ""
			,"kind" => ""
			,"actualUse" => ""
			,"actualUse" => "");

		foreach($machineriesElementsArray as $machineriesElementKey => $blank){
			$this->tpl->set_var("machineries[".$machineriesElementKey."]",$this->htmlProperty($machineriesElementKey,$blank));
		}

		$this->tpl->set_var("landLabel","Land:<br>");
		$this->tpl->set_var("plantsTreesLabel","PlantsTrees:<br>");
		$this->tpl->set_var("improvementsBuildingsLabel","ImprovementsBuildings:<br>");
		$this->tpl->set_var("machineriesLabel","Machineries:<br>");
	}

	function displayLandList($landList){
        if (count($landList)){
			$land = $landList[0];

			$this->tpl->set_var("land[propertyID]",$this->htmlProperty("propertyID",$land->getPropertyID()));

			$this->tpl->set_var("land[octTctNumber]",$this->htmlProperty("octTctNumber",$land->getOctTctNumber()));
			$this->tpl->set_var("land[surveyNumber]",$this->htmlProperty("surveyNumber",$land->getSurveyNumber()));

			$this->tpl->set_var("land[north]",$this->htmlProperty("north",$land->getNorth()));
			$this->tpl->set_var("land[south]",$this->htmlProperty("south",$land->getSouth()));
			$this->tpl->set_var("land[east]",$this->htmlProperty("east",$land->getEast()));
			$this->tpl->set_var("land[west]",$this->htmlProperty("west",$land->getWest()));

			$this->tpl->set_var("land[description]",$this->htmlProperty("description",$land->getKind()));

			foreach($land as $lkey => $lvalue){
				if(is_numeric($lvalue)){
					switch($lkey){
						case "classification":
							$landClasses = new LandClasses;
							$landClasses->selectRecord($lvalue);
							$this->tpl->set_var("land[classification]", $this->htmlProperty("classification",$landClasses->getDescription()));
							break;
						case "subClass":
							$landSubclasses = new LandSubclasses;
							$landSubclasses->selectRecord($lvalue);
							$this->tpl->set_var("land[subClass]", $this->htmlProperty("subClass",$landSubclasses->getDescription()));
							break;
						case "actualUse":
							$landActualUses = new LandActualUses;
							$landActualUses->selectRecord($lvalue);
							$this->tpl->set_var("land[actualUse]", $this->htmlProperty("actualUse",$landActualUses->getDescription()));
							break;
						}
				}
			}

			$this->tpl->set_var("land[area]",$this->htmlProperty("area",$land->getArea()." ".$land->getUnit()));
		}
	}
	
	function displayPlantsTreesList($plantsTreesList){
		if (count($plantsTreesList)){
			$plantsTrees = $plantsTreesList[0];

			$this->tpl->set_var("plantsTrees[propertyID]",$this->htmlProperty("propertyID",$plantsTrees->getPropertyID()));

			$this->tpl->set_var("plantsTrees[surveyNumber]",$this->htmlProperty("surveyNumber",$plantsTrees->getSurveyNumber));
			$this->tpl->set_var("plantsTrees[kind]",$this->htmlProperty("kind",$plantsTrees->getKind()));

			foreach($plantsTrees as $lkey => $pvalue){
				if(is_numeric($pvalue)){
					switch($pkey){
						case "productClass":
							$plantsTreesClasses = new PlantsTreesClasses;
							$plantsTreesClasses->selectRecord($pvalue);
							$this->tpl->set_var("plantsTrees[productClass]", $plantsTreesClasses->getDescription());
							break;
						case "actualUse":
							$plantsTreesActualUses = new PlantsTreesActualUses;
							$plantsTreesActualUses->selectRecord($pvalue);
							$this->tpl->set_var("plantsTrees[actualUse]", $plantsTreesActualUses->getDescription());
							break;
					}
				}
			}

			$this->tpl->set_var("plantsTrees[areaPlanted]",$this->htmlProperty("areaPlanted",$plantsTrees->getAreaPlanted()));
			$this->tpl->set_var("plantsTrees[number]",$this->htmlProperty("number",$plantsTrees->getTotalNumber()));
		}
	}
	
	function displayImprovementsBuildingsList($improvementsBuildingsList){
		if (count($improvementsBuildingsList)){
			$improvementsBuildings = $improvementsBuildingsList[0];

			$this->tpl->set_var("improvementsBuildings[propertyID]",$this->htmlProperty("propertyID",$improvementsBuildings->getPropertyID()));

			$this->tpl->set_var("improvementsBuildings[foundation]",$this->htmlProperty("foundation",$improvementsBuildings->getFoundation()));
			$this->tpl->set_var("improvementsBuildings[columnsBldg]",$this->htmlProperty("columnsBldg",$improvementsBuildings->getColumnsBldg()));
			$this->tpl->set_var("improvementsBuildings[beams]",$this->htmlProperty("beams",$improvementsBuildings->getBeams()));
			$this->tpl->set_var("improvementsBuildings[trussFraming]",$this->htmlProperty("trussFraming",$improvementsBuildings->getTrussFraming()));
			$this->tpl->set_var("improvementsBuildings[roof]",$this->htmlProperty("roof",$improvementsBuildings->getRoof()));

			$this->tpl->set_var("{improvementsBuildings[kind]",$this->htmlProperty("kind",$improvementsBuildings->getKind()));

			foreach($improvementsBuildings as $ikey => $ivalue){
				if(is_numeric($ivalue)){
					switch($ikey){
						case "buildingClassification":
							$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
							$improvementsBuildingsClasses->selectRecord($ivalue);
							$this->tpl->set_var("improvementsBuildings[buildingClassification]", $this->htmlProperty("buildingClassification",$improvementsBuildingsClasses->getDescription()));
							break;
						case "actualUse":
							$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
							$improvementsBuildingsActualUses->selectRecord($ivalue);
							$this->tpl->set_var("improvementsBuildings[actualUse]", $this->htmlProperty("actualUse",$improvementsBuildingsActualUses->getDescription()));
							break;
					}
				}
			}

		}

	}
	
	function displayMachineriesList($machineriesList){
		if (count($machineriesList)){
			$machineries = $machineriesList[0];

			$this->tpl->set_var("{machineries[propertyID]}",$this->htmlProperty("propertyID",$machineries->getPropertyID()));
			$this->tpl->set_var("{machineries[machineryDescription]}",$this->htmlProperty("machineryDescription",$machineries->getMachineryDescription()));
			$this->tpl->set_var("{machineries[brand]}",$this->htmlProperty("brand",$machineries->getBrand()));
			$this->tpl->set_var("{machineries[modelNumber]}",$this->htmlProperty("modelNumber",$machineries->getModelNumber()));
			$this->tpl->set_var("{machineries[capacity]}",$this->htmlProperty("capacity",$machineries->getCapacity()));

			$this->tpl->set_var("{machineries[kind]}",$this->htmlProperty("kind",$machineries->getKind()));

			foreach($machineries as $mkey => $mvalue){
				if(is_numeric($mvalue)){
					switch($mkey){
						case "actualUse":
							$machineriesActualUses = new MachineriesActualUses;
							$machineriesActualUses->selectRecord($mvalue);
							$this->tpl->set_var("actualUse", $machineriesActualUses->getDescription());
							break;
					}
				}
			}

		}
	}

	// Start DB Functions

	function setDB(){
		$this->db = new DB_RPTS;
	}

	function runSQLDump($sqlArray){
		if(is_array($sqlArray)){
			foreach($sqlArray as $sql){
				$db = new DB_RPTS;
				$db->query($sql);
			}
		}
	}

	function selectRecords(){
		foreach($this->formArray["personID"] as $personID) {
			$person = new Person;
			$person->selectRecord($personID);
			$this->arrayList[] = $person;
		}
	}

	function displayRecords(){
		$this->selectRecords();

		$this->tpl->set_block("rptsTemplate", "OwnerPersonList", "OwnerPersonListBlock");
		$this->tpl->set_block("OwnerPersonList", "ODList", "ODListBlock");

		foreach($this->arrayList as $person) {
			$this->tpl->set_var("personID", $person->getPersonID());
			$this->tpl->set_var("lastName", $person->getLastName());
			$this->tpl->set_var("firstName", $person->getFirstName());
			$this->tpl->set_var("middleName", $person->getMiddleName());
			$this->tpl->set_var("gender", $person->getGender());
			$this->tpl->set_var("birthday", $person->getBirthday());
			$this->tpl->set_var("maritalStatus", $person->getMaritalStatus());
			$this->tpl->set_var("tin", $person->getTin());
			$this->tpl->set_var("telephone", $person->getTelephone());
			$this->tpl->set_var("mobileNumber", $person->getMobileNumber());
			$this->tpl->set_var("email", $person->getEmail());

			if(is_array($person->addressArray)){
				$address = $person->addressArray[0];
				$this->tpl->set_var("address", $address->getFullAddress());
			}

			// capture OD, AFS, and TD info

			$this->setDB();
			$sql = sprintf(
				"SELECT DISTINCT(Owner.odID) as odID".
				" FROM Owner,OwnerPerson ".
				" WHERE ".
				" Owner.ownerID = OwnerPerson.ownerID AND ".
				" OwnerPerson.personID = '%s' ",
				$person->getPersonID());
			$this->db->query($sql);	

			while ($this->db->next_record()) {
				$od = new OD;
				if($od->selectRecord($this->db->f("odID"))){
					$this->ODArray[] = $od;

					$this->tpl->set_var("odID",$od->getOdID());
					if(is_object($od->locationAddress)){
						$this->tpl->set_var("locationAddress",$od->locationAddress->getFullAddress());
					}
					else{
						$this->tpl->set_var("locationAddress","");
					}
					

					$afs = new AFS;
					if($afs->selectRecord("","",$od->getOdID(),"")){
						$this->tpl->set_var("afsID",$afs->getAfsID());
						$this->tpl->set_var("propertyIndexNumber", $afs->getPropertyIndexNumber());
						$this->tpl->set_var("arpNumber", $afs->getArpNumber());

						if(is_array($afs->landArray)){
							$this->displayLandList($afs->landArray);
						}
						if(is_array($afs->plantsTreesArray)){
							$this->displayPlantsTreesList($afs->plantsTreesArray);
						}
						if(is_array($afs->improvementsBuildingsArray)){
							$this->displayImprovementsBuildingsList($afs->improvementsBuildingsArray);
						}
						if(is_array($afs->machineriesArray)){
							$this->displayMachineriesList($afs->machineriesArray);
						}

						$td = new TD;
						if($td->selectRecord("",$afs->getAfsID(),"","","")){
							$this->tpl->set_var("tdID", $td->getTdID());
							$this->tpl->set_var("taxDeclarationNumber", $td->getTaxDeclarationNumber());
							$this->tpl->set_var("propertyType", $td->getPropertyType());							
						}
					}
					unset($td);
					unset($afs);
					unset($od);
					$this->tpl->parse("ODListBlock", "ODList", true);
				}
			}

			$this->tpl->parse("OwnerPersonListBlock", "OwnerPersonList", true);
			$this->tpl->set_var("ODListBlock", "");
			$this->clearPropertyElements();

			unset($this->ODArray);
			unset($this->AFSArray);
			unset($this->TDArray);
			unset($this->db);
		}
	}

	// End DB Functions

	function Main(){
		switch($this->formArray["formAction"]){
			case "rollback":
				$this->runSQLDump($this->formArray["rollbackSQL"]);
				break;
		}
		$this->clearPropertyElements();
		$this->displayRecords();

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->tpl->set_var("Session", $this->sess->url(""));
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
$obj = new MergeOwnerPersonConfirm($sess,$HTTP_POST_VARS);
$obj->Main();
?>
<?php page_close(); ?>
