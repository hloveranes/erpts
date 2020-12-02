<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/AFS.php";

#####################################
# Define Interface Class
#####################################
class GISTechnicalDescriptionEncode{
	
	var $tpl;
	var $formArray;
	
	function GISTechnicalDescriptionEncode($http_post_vars, $afsID, $formAction="",$sess){
		//global $HTTP_POST_VARS;
		global $auth;

		$this->sess = $sess;
		$this->userID = $auth->auth["uid"];

		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "GISTechnicalDescriptionEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode GIS Technical Description");
		$this->formArray = array(
			"afsID" => $afsID
			, "cadastralLotNumber" => ""
			, "gisTechnicalDescription" => ""
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

	function hideBlock($tempVar){
		$this->tpl->set_block("rptsTemplate", $tempVar, $tempVar."Block");
		$this->tpl->set_var($tempVar."Block", "");
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
						$afs->setCadastralLotNumber($this->formArray["cadastralLotNumber"]);


						// convert $pointsArray to $gisTechnicalDescription string
						// separate each point with "-" and each pointRecord with ","

						$pointsArray = $this->formArray["pointsArray"];
						$pointID = 1;

						if(is_array($pointsArray)){
							for($pointID=1; $pointID<=count($pointsArray) ; $pointID++){
								$pointArray = array($pointID,$pointsArray[$pointID]["pointType"],$pointsArray[$pointID]["quadrant"],$pointsArray[$pointID]["bearingDeg"],$pointsArray[$pointID]["bearingMin"],$pointsArray[$pointID]["distance"]);

								$pointString = implode("-",$pointArray);

								$gisTechDescArray[$pointID] = $pointString;
							}

							$gisTechnicalDescription = implode(",",$gisTechDescArray);
							$this->formArray["gisTechnicalDescription"] = $gisTechnicalDescription;
						}

						$afs->setGISTechnicalDescription($this->formArray["gisTechnicalDescription"]);

						$afs->setDomDocument();
						$doc = $afs->getDomDocument();
						$xmlStr =  $doc->dump_mem(true);

						if (!$ret = $AFSEncode->updateAFS($xmlStr)){
							exit("error update");
						}

					}
				}

				header("location: GISTechnicalDescriptionClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$this->formArray["afsID"]))); 

				exit();
				break;
			case "del":
				// temporarily del points

				$delPointsArray = $this->formArray["pointsArray"];
				$pointID = 1;

				if(is_array($delPointsArray)){
					for($delPointID=1; $delPointID<=count($delPointsArray) ; $delPointID++){
						if($delPointID!=$this->formArray["delPointID"]){
							$pointsArray[$pointID]["pointType"] = $delPointsArray[$delPointID]["pointType"];
							$pointsArray[$pointID]["quadrant"] = $delPointsArray[$delPointID]["quadrant"];
							$pointsArray[$pointID]["bearingDeg"] = $delPointsArray[$delPointID]["bearingDeg"];
							$pointsArray[$pointID]["bearingMin"] = $delPointsArray[$delPointID]["bearingMin"];
							$pointsArray[$pointID]["distance"] = $delPointsArray[$delPointID]["distance"];
							$pointID++;
						}
					}

					if(is_array($pointsArray)){
						$this->tpl->set_block("rptsTemplate", "PointsList", "PointsListBlock");
						for($pointID=1; $pointID<=count($pointsArray) ; $pointID++){
							$this->tpl->set_var("pointID",$pointID);
							$this->tpl->set_var("pointType",$pointsArray[$pointID]["pointType"]);
							$this->tpl->set_var("quadrant",$pointsArray[$pointID]["quadrant"]);
							$this->tpl->set_var("bearingDeg",$pointsArray[$pointID]["bearingDeg"]);
							$this->tpl->set_var("bearingMin",$pointsArray[$pointID]["bearingMin"]);
							$this->tpl->set_var("distance", $pointsArray[$pointID]["distance"]);
							$this->tpl->parse("PointsListBlock", "PointsList", true);
						}
						$this->formArray["pointsExist"] = "true";
					}
					else{
						$this->formArray["pointsExist"] = "false";
						$this->hideBlock("PointsList");
					}
				}


				break; 
			case "add":
				// temporarily add points

				$pointsArray = $this->formArray["pointsArray"];
				$pointID = 1;

				if(is_array($pointsArray)){
					$this->tpl->set_block("rptsTemplate", "PointsList", "PointsListBlock");
					
					for($pointID=1; $pointID<=count($pointsArray) ; $pointID++){
						$this->tpl->set_var("pointID",$pointID);
						$this->tpl->set_var("pointType",$pointsArray[$pointID]["pointType"]);
						$this->tpl->set_var("quadrant",$pointsArray[$pointID]["quadrant"]);
						$this->tpl->set_var("bearingDeg",$pointsArray[$pointID]["bearingDeg"]);
						$this->tpl->set_var("bearingMin",$pointsArray[$pointID]["bearingMin"]);
						$this->tpl->set_var("distance", $pointsArray[$pointID]["distance"]);
						$this->tpl->parse("PointsListBlock", "PointsList", true);
					}

					$pointsArray[$pointID]["pointType"] = $this->formArray["pointType"];
					$pointsArray[$pointID]["quadrant"] = $this->formArray["quadrant"];
					$pointsArray[$pointID]["bearingDeg"] = $this->formArray["bearingDeg"];
					$pointsArray[$pointID]["bearingMin"] = $this->formArray["bearingMin"];
					$pointsArray[$pointID]["distance"] = $this->formArray["distance"];

					$this->tpl->set_var("pointID",$pointID);
					$this->tpl->set_var("pointType",$pointsArray[$pointID]["pointType"]);
					$this->tpl->set_var("quadrant",$pointsArray[$pointID]["quadrant"]);
					$this->tpl->set_var("bearingDeg",$pointsArray[$pointID]["bearingDeg"]);
					$this->tpl->set_var("bearingMin",$pointsArray[$pointID]["bearingMin"]);
					$this->tpl->set_var("distance", $pointsArray[$pointID]["distance"]);
					$this->tpl->parse("PointsListBlock", "PointsList", true);
				}
				else{
					$pointsArray[$pointID]["pointType"] = $this->formArray["pointType"];
					$pointsArray[$pointID]["quadrant"] = $this->formArray["quadrant"];
					$pointsArray[$pointID]["bearingDeg"] = $this->formArray["bearingDeg"];
					$pointsArray[$pointID]["bearingMin"] = $this->formArray["bearingMin"];
					$pointsArray[$pointID]["distance"] = $this->formArray["distance"];

					$this->tpl->set_block("rptsTemplate", "PointsList", "PointsListBlock");
					$this->tpl->set_var("pointID",$pointID);
					$this->tpl->set_var("pointType",$pointsArray[$pointID]["pointType"]);
					$this->tpl->set_var("quadrant",$pointsArray[$pointID]["quadrant"]);
					$this->tpl->set_var("bearingDeg",$pointsArray[$pointID]["bearingDeg"]);
					$this->tpl->set_var("bearingMin",$pointsArray[$pointID]["bearingMin"]);
					$this->tpl->set_var("distance", $pointsArray[$pointID]["distance"]);
					$this->tpl->parse("PointsListBlock", "PointsList", true);
				}
				$this->formArray["pointsExist"] = "true";
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
						$this->formArray["cadastralLotNumber"] = $afs->getCadastralLotNumber();
						$this->formArray["gisTechnicalDescription"] = $afs->getGISTechnicalDescription();

						if($this->formArray["gisTechnicalDescription"]==""){
							$this->formArray["pointsExist"] = "false";
							$this->hideBlock("PointsList");
						}
						else{
							$this->formArray["pointsExist"] = "true";

							// parse gisTechnicalDescription into $pointsArray
							// separate each pointRecord at "," and each point at "-"

							$gisTechDescArray = explode(",",$this->formArray["gisTechnicalDescription"]);
							foreach($gisTechDescArray as $pointString){
								$pointArray = explode("-",$pointString);
								$pointID = $pointArray[0];

								$pointsArray[$pointID]["pointType"] = $pointArray[1];
								$pointsArray[$pointID]["quadrant"] = $pointArray[2];
								$pointsArray[$pointID]["bearingDeg"] = $pointArray[3];
								$pointsArray[$pointID]["bearingMin"] = $pointArray[4];
								$pointsArray[$pointID]["distance"] = $pointArray[5];
							}

							if(is_array($pointsArray)){
								$this->tpl->set_block("rptsTemplate", "PointsList", "PointsListBlock");
					
								for($pointID=1; $pointID<=count($pointsArray) ; $pointID++){
									$this->tpl->set_var("pointID",$pointID);
									$this->tpl->set_var("pointType",$pointsArray[$pointID]["pointType"]);
									$this->tpl->set_var("quadrant",$pointsArray[$pointID]["quadrant"]);
									$this->tpl->set_var("bearingDeg",$pointsArray[$pointID]["bearingDeg"]);
									$this->tpl->set_var("bearingMin",$pointsArray[$pointID]["bearingMin"]);
									$this->tpl->set_var("distance", $pointsArray[$pointID]["distance"]);
									$this->tpl->parse("PointsListBlock", "PointsList", true);
								}
							}


						}
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

$gisTechnicalDescriptionEncode = new GISTechnicalDescriptionEncode($HTTP_POST_VARS,$afsID,$formAction,$sess);
$gisTechnicalDescriptionEncode->Main();
?>
<?php page_close(); ?>