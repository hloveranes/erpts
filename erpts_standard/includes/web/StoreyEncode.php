<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/Storey.php";
include_once "../assessor/ImprovementsBuildings.php";
#####################################
# Define Interface Class
#####################################
class StoreyEncode{
	
	var $tpl;
	var $formArray;
	var $storey;
	
	function StoreyEncode($http_post_vars,$afsID="",$improvementsBuildingsID="",$storeyID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "StoreyEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Storey");
		
		$this->formArray = array(
			"afsID" => $afsID
			, "improvementsBuildingsID" => $improvementsBuildingsID
			, "storeyID" => $storeyID
			, "floorNumber" => ""
			, "area" => ""
			, "materials" => ""
			, "value" => ""
			, "foundation" => ""
			, "columnsBeams" => ""
			, "trussFraming" => ""
			, "roof" => ""
			, "exteriorWall" => ""
			, "flooring" => ""
			, "doors" => ""
			, "windows" => ""
			, "stairs" => ""
			, "wallFinish" => ""
			, "electrical" => ""
			, "toiletAndBath" => ""
			, "plumbingSewer" => ""
			, "fixtures" => ""
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
				$StoreyDetails = new SoapObject(NCCBIZ."StoreyDetails.php", "urn:Object");
				if (!$xmlStr = $StoreyDetails->getStorey($this->formArray["storeyID"])){
					$this->tpl->set_block("rptsTemplate", "FORM", "FORMBlock");
					$this->tpl->set_var("FORMBlock", "error xmlDoc");
				}
				else{
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "FORM", "FORMBlock");
						$this->tpl->set_var("FORMBlock", "error xmlDoc");
					}
					else {
						$storey = new Storey;
						$storey->parseDomStorey($domDoc);
						foreach($storey as $key => $value){
							$this->formArray[$key] = $value;
						}
					}
				}
				break;
			case "save":
				$StoreyEncode = new SoapObject(NCCBIZ."StoreyEncode.php", "urn:Object");
				if ($this->formArray["storeyID"] <> ""){
					$storey = new Storey;
					$storey->selectStorey($this->formArray["storeyID"]);
					$storey->setStoreyID($this->formArray["storeyID"]);
					$storey->setImprovementsBuildingsID($this->formArray["improvementsBuildingsID"]);
					$storey->setFloorNumber($this->formArray["floorNumber"]);
					$storey->setArea($this->formArray["area"]);
					$storey->setMaterials($this->formArray["materials"]);
					$storey->setValue($this->formArray["value"]);
					$storey->setFoundation($this->formArray["foundation"]);
					$storey->setColumnsBeams($this->formArray["columnsBeams"]);
					$storey->setTrussFraming($this->formArray["trussFraming"]);
					$storey->setRoof($this->formArray["roof"]);
					$storey->setExteriorWall($this->formArray["exteriorWall"]);
					$storey->setFlooring($this->formArray["flooring"]);
					$storey->setDoors($this->formArray["doors"]);
					$storey->setWindows($this->formArray["windows"]);
					$storey->setStairs($this->formArray["stairs"]);
					$storey->setWallFinish($this->formArray["wallFinish"]);
					$storey->setElectrical($this->formArray["electrical"]);
					$storey->setToiletAndBath($this->formArray["toiletAndBath"]);
					$storey->setPlumbingSewer($this->formArray["plumbingSewer"]);
					$storey->setFixtures($this->formArray["fixtures"]);
					$storey->setDomStorey();
					
					$doc = $storey->getDomStorey();
					$xmlStr =  $doc->dump_mem();
					if (!$ret = $StoreyEncode->updateStorey($xmlStr)){
						echo("error update");
					}
					header("location: StoreyClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
					//exit($this->formArray["improvementsBuildingsID"]);
				}
				else {
					$storey = new Storey;
					$storey->setImprovementsBuildingsID($this->formArray["improvementsBuildingsID"]);
					$storey->setFloorNumber($this->formArray["floorNumber"]);
					$storey->setArea($this->formArray["area"]);
					$storey->setMaterials($this->formArray["materials"]);
					$storey->setValue($this->formArray["value"]);
					$storey->setFoundation($this->formArray["foundation"]);
					$storey->setColumnsBeams($this->formArray["columnsBeams"]);
					$storey->setTrussFraming($this->formArray["trussFraming"]);
					$storey->setRoof($this->formArray["roof"]);
					$storey->setExteriorWall($this->formArray["exteriorWall"]);
					$storey->setFlooring($this->formArray["flooring"]);
					$storey->setDoors($this->formArray["doors"]);
					$storey->setWindows($this->formArray["windows"]);
					$storey->setStairs($this->formArray["stairs"]);
					$storey->setWallFinish($this->formArray["wallFinish"]);
					$storey->setElectrical($this->formArray["electrical"]);
					$storey->setToiletAndBath($this->formArray["toiletAndBath"]);
					$storey->setPlumbingSewer($this->formArray["plumbingSewer"]);
					$storey->setFixtures($this->formArray["fixtures"]);
					$storey->setDomStorey();
			
					$doc = $storey->getDomStorey();
					$xmlStr =  $doc->dump_mem(true);
					if (!$ret = $StoreyEncode->saveStorey($xmlStr)){
						echo("puke<br>");
					}
					$this->formArray["storeyID"] = $ret;
					header("location: StoreyClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
					exit("storeyID = $ret"."<br>improvementsBuildingsID=".$this->formArray["improvementsBuildingsID"]);
				}
				break;
			case "cancel":
				header("location: StoreyList.php";
				exit;
				break;
			default:
				
				$this->tpl->set_block("rptsTemplate", "odID", "odIDBlock");
				$this->tpl->set_var("odIDBlock", "");
				$this->tpl->set_block("rptsTemplate", "ACK", "ACKBlock");
				$this->tpl->set_var("ACKBlock", "");
		}
		$this->setForm();
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"])));
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
$storeyEncode = new StoreyEncode($HTTP_POST_VARS,$afsID,$improvementsBuildingsID,$storeyID,$formAction,$sess);
$storeyEncode->main();
?>
<?php page_close(); ?>