<?php
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/web/clibPDFWriter.php";
include_once "../includes/assessor/Barangay.php";

include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/OD.php";

include_once "../includes/assessor/eRPTSSettings.php";

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
class TDDetails{
	
	var $tpl;
	var $formArray;
	function TDDetails($http_post_vars,$sess,$odID,$ownerID,$afsID,$print){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "td.xml") ;
		$this->tpl->set_var("TITLE", "TD Details");
		
		// NCC Modification checked and implemented by K2 : November 21, 2005
		// details:
		//		- added "ypos", "landitems", and "plantitems" keys to $this->formArray in lines 70 to 72
		//		- deleted formArray keys for "kind[1-3]", "classification[1-3]", "marketValue[1-3]", "assessmentLevel[1-3]", "assessedValue[1-3]"
		
       	$this->formArray = array(
			"arpNumber" => "" // AFS
			,"taxDeclarationNumber" => "" // TD
			,"propertyIndexNumber" => "" // AFS
			,"ownerName" => "" // OD->Owner
			,"ownerAddress" => "" // OD->Owner
			,"administratorName" => ""
			,"administratorAddress" => ""
			,"numberStreet" => "" // LocationAddress
			,"barangay" => "" // LocationAddress
			,"municipalityCity" => "" // LocationAddress
			,"octTctNumber" => "" // Land
			,"surveyNumber" => "" // Land
			,"lotNumber" => "" // OD
			,"blockNumber" => "" // OD
			,"north" => "" // Land
			,"south" => "" // Land
			,"east" => "" // Land
			,"west" => "" // Land
			,"p" => 1 //propertyCounter
			,"ypos" => 470 //propertyCounter
			,"landitems" => "" // Property [L,P,B,M]
			,"plantitems" => "" // Property [L,P,B,M]			
			,"totalMarketValue" => 0  // Property [L,P,B,M]
			,"totalAssessedValue" => 0  // Property [L,P,B,M]
			,"totalAssessedValueInWords" => ""
			,"area" => "" // Land | or csv ImprovementsBuildings->areaOfGroundFloor
			,"unit" => "" // Land
			,"effectivity" => "" // AFS
			,"taxability" => "" // AFS
			,"isTaxable" => "" // AFS
			,"isExempt" => "" // AFS
			,"verifiedBy" => ""
			,"cityAssessor" => "" // TD
			,"cancelsTDNumber" => "" // TD
			,"memoranda" => "" // TD
			,"propertyType" => "" // TD
			,"kindOthers" => "" // to represent properties after the third one if it exists since the printout only has 3 lines
			,"othersCount" => 0
			,"othersMV" => 0
			,"othersAV" => 0
		);

		$this->formArray["odID"] = $odID;
		$this->formArray["ownerID"] = $ownerID;
		$this->formArray["afsID"] = $afsID;
		$this->formArray["print"] = $print;

	}
	
	function formatCurrency($key){
		if($this->formArray[$key]=="")
			return false;

		if(is_numeric($this->formArray[$key]))
			$this->formArray[$key] = number_format(un_number_format($this->formArray[$key]), 2, ".", ",");
	}
	
	function setForm(){
		// NCC Modification checked and implemented by K2 : November 21, 2005
		// details:
		//	- added formatCurrency() lines for marketValue and assessedValue 4, 5, and 6 in lines 118 to 123
		//  - commented out lines 111 to 124		
		//	- added if() for "landitems" || "plantitems" in line 130
		/*
		$this->formatCurrency("marketValue1");
		$this->formatCurrency("assessedValue1");
		$this->formatCurrency("marketValue2");
		$this->formatCurrency("assessedValue2");
		$this->formatCurrency("marketValue3");
		$this->formatCurrency("assessedValue3");
		$this->formatCurrency("marketValue4");
		$this->formatCurrency("assessedValue4");
		$this->formatCurrency("marketValue5");
		$this->formatCurrency("assessedValue5");
		$this->formatCurrency("marketValue6");
		$this->formatCurrency("assessedValue6");
		*/				
		
		$this->formatCurrency("totalMarketValue");
		$this->formatCurrency("totalAssessedValue");

		foreach ($this->formArray as $key => $value){
			if ($key == "landitems" || $key == "plantitems") {
				$this->tpl->set_var($key, $value);
			}
			else {			
				$this->tpl->set_var($key, html_entity_to_alpha($value));
			}
		}
	}

	function displayLandList($landList){
		if(count($landList)){
			// NCC Modification checked and implemented by K2 : November 21, 2005
			// details:			
			//	added lines 145 to 151 with lines 146 and 147 commented out
			
			$items = '';
			//$offset = 470;
			//$fp = fopen("/home/site/log/td.log","w+");

			$mv = 0;
			$al = 0;
			$av = 0;
			
			foreach($landList as $lkey => $land){
				// classification
				$landClasses = new LandClasses;
				if(is_numeric($land->getClassification())){
					$landClasses->selectRecord($land->getClassification());
					$landClassesDescription = $landClasses->getDescription();
					$landClassesCode = $landClasses->getCode();
				}
				else{
					$landClassesDescription = $land->getClassification();
					$landClassesCode = $land->getClassification();
				}

				/* just in case subClass and actualUse needs to be drawn from land

				// subClass
				$landSubclasses = new LandSubclasses;
				if(is_numeric($land->getSubClass())){
					$landSubclasses->selectRecord($land->getSubClass());
					$landSubclassesDescription = $landSubclasses->getDescription();
					$landSubclassesCode = $landSubclasses->getCode();
				}
				else{
					$landSubclassesDescription = $land->getSubClass();
					$landSubclassesCode = $land->getSubClass();
				}
				// actualUse
				$landActualUses = new LandActualUses;
				if(is_numeric($land->getActualUse())){
					$landActualUses->selectRecord($land->getActualUse());
					$landActualUsesDescription = $landActualUses->getDescription();
					$landActualUsesCode = $landActualUses->getCode();
					$landActualUsesReportCode = $landActualUses->getReportCode();
				}
				else{
					$landActualUsesDescription = $land->getActualUse();
					$landActualUsesCode = $land->getActualUse();
					$landActualUsesReportCode = $landActualUses->getReportCode();
				}
				*/
				
				// NCC Modification checked and implemented by K2 : November 21, 2005
				// details:	
				//		- changed `if($this->formArray["p"] <= 3)` to `if(...<=10)` in line 200
				//		- opted not to comment out if() line as done in NCC version
				//		- added lines 201 to 228 
				//		- added lines 255 to 275 commenting out lines 273 and 274
				if($this->formArray["p"] <= 10){
					$lvl = number_format($land->getAssessmentLevel(),2);
					if ($al <> $lvl) {
						if ($av > 0) {
							$this->formArray["ypos"] -= 13;
							$offset = $this->formArray["ypos"];

							$items .= "<textitem xpos=\"25\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"left\">"."Land"."</textitem>";
							$items .= "<textitem xpos=\"115\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"9\" align=\"left\">".$ld."</textitem>";
							$items .= "<textitem xpos=\"337\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".number_format($mv,2)."</textitem>";
							// danny : changed $al to $lvl and added '%' suffix in xml
							$items .= "<textitem xpos=\"430\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".$lvl."%</textitem>";
							$items .= "<textitem xpos=\"558\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".number_format($av,2)."</textitem>";

							$offsetx = $offset - 3;
							$items .= "<lineitem x1=\"25\" y1=\"".$offsetx."\" x2=\"105\" y2=\"".$offsetx."\">blurb</lineitem>";
							$items .= "<lineitem x1=\"115\" y1=\"".$offsetx."\" x2=\"228\" y2=\"".$offsetx."\">blurb</lineitem>";
							$items .= "<lineitem x1=\"244\" y1=\"".$offsetx."\" x2=\"337\" y2=\"".$offsetx."\">blurb</lineitem>";
							$items .= "<lineitem x1=\"358\" y1=\"".$offsetx."\" x2=\"445\" y2=\"".$offsetx."\">blurb</lineitem>";
							$items .= "<lineitem x1=\"457\" y1=\"".$offsetx."\" x2=\"558\" y2=\"".$offsetx."\">blurb</lineitem>";
						}

						$av = 0;
						$mv = 0;
						// danny = changed `$al = $lvl` back to 0 .. don't understand why $al's need to be compared.
						$al = 0;
					}

					$ld = $landClassesDescription;
					$mv += $land->getAdjustedMarketValue();
					$av += un_number_format($land->getAssessedValue());
					
					
					$p = $this->formArray["p"];

					$this->formArray["kind".$p] = $land->getKind();
					$this->formArray["classification".$p] = $landClassesDescription;

					$this->formArray["marketValue".$p] = formatCurrency($land->getMarketValue());
					$this->formArray["assessmentLevel".$p] = $land->getAssessmentLevel();
					$this->formArray["assessedValue".$p] = formatCurrency($land->getAssessedValue());
				}
				else if($this->formArray["p"] > 10){
					$this->formArray["othersCount"]++;

					$this->formArray["othersMV"] += toFloat($land->getMarketValue());
					$this->formArray["othersAV"] += toFloat($land->getAssessedValue());

					$this->formArray["kindOthers"] = "Plus ".$this->formArray["othersCount"]." other(s): P".formatCurrency($this->formArray["othersMV"])." (MV), P".formatCurrency($this->formArray["othersAV"])." (AV)";

					/*
					if($this->formArray["kindOthers"]!="") $this->formArray["kindOthers"] .= "; ";
					if($this->formArray["kindOthers"]==""){
						$this->formArray["kindOthers"] = "Others: ";
					}
					$this->formArray["kindOthers"] .= $land->getKind();
					$this->formArray["kindOthers"] .= " MV=P".formatCurrency($land->getMarketValue());
					$this->formArray["kindOthers"] .= " AV=P".formatCurrency($land->getAssessedValue());
					*/
				}

				$this->formArray["totalMarketValue"] += toFloat($land->getMarketValue());
				$this->formArray["totalAssessedValue"] += toFloat($land->getAssessedValue());
				$this->formArray["p"]++;
			}
			
			if ($av > 0) {
				$this->formArray["ypos"] -= 13;
				$offset = $this->formArray["ypos"];

				$items .= "<textitem xpos=\"25\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"left\">"."Land"."</textitem>";
				$items .= "<textitem xpos=\"115\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"9\" align=\"left\">".$ld."</textitem>";
				$items .= "<textitem xpos=\"337\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".number_format($mv,2)."</textitem>";
				$items .= "<textitem xpos=\"430\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".$lvl."%</textitem>";
				$items .= "<textitem xpos=\"558\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".number_format($av,2)."</textitem>";

				$offsetx = $offset - 3;
				$items .= "<lineitem x1=\"25\" y1=\"".$offsetx."\" x2=\"105\" y2=\"".$offsetx."\">blurb</lineitem>";
				$items .= "<lineitem x1=\"115\" y1=\"".$offsetx."\" x2=\"228\" y2=\"".$offsetx."\">blurb</lineitem>";
				$items .= "<lineitem x1=\"244\" y1=\"".$offsetx."\" x2=\"337\" y2=\"".$offsetx."\">blurb</lineitem>";
				$items .= "<lineitem x1=\"358\" y1=\"".$offsetx."\" x2=\"445\" y2=\"".$offsetx."\">blurb</lineitem>";
				$items .= "<lineitem x1=\"457\" y1=\"".$offsetx."\" x2=\"558\" y2=\"".$offsetx."\">blurb</lineitem>";
			}

			//fwrite($fp,$items."\r\n");
			//fclose($fp);
			$this->formArray["landitems"] = $items;	
		}
	}

	function displayPlantsTreesList($plantsTreesList){
		if(count($plantsTreesList)){
			// NCC Modification checked and implemented by K2 : November 21, 2005
			// details:			
			//	added lines 286 to 292 with line 288 commented out
						
			$items = '';
			$offset = 410;
			//$fp = fopen("/home/site/log/tdplants.log","w+");

			$mv = 0;
			$al = 0;
			$av = 0;
						
			foreach($plantsTreesList as $pkey => $plantsTrees){
				// productClass
				$plantsTreesClasses = new PlantsTreesClasses;
				if(is_numeric($plantsTrees->getProductClass())){
					$plantsTreesClasses->selectRecord($plantsTrees->getProductClass());
					$plantsTreesClassesDescription = $plantsTreesClasses->getDescription();
					$plantsTreesClassesCode = $plantsTreesClasses->getCode();
				}
				else{
					$plantsTreesClassesDescription = $plantsTrees->getProductClass();
					$plantsTreesClassesCode = $plantsTrees->getProductClass();
				}
				
				// NCC Modification checked and implemented by K2 : November 21, 2005
				// details:			
				//	added lines 310 to 317				
				$plantAU = new PlantsTreesActualUses;
				if(is_numeric($plantsTrees->getActualUse())){
					$plantAU->selectRecord($plantsTrees->getActualUse());
					$plantActualUse = htmlentities($plantAU->getDescription());
				}
				else{
					$plantActualUse = $plantsTrees->getActualUse();
				}				

				/* just in case actualUse needs to be drawn from plantsTrees

				// actualUse
				$plantsTreesActualUses = new PlantsTreesActualUses;
				if(is_numeric($plantsTrees->getActualUse())){
					$plantsTreesActualUses->selectRecord($plantsTrees->getActualUse());
					$plantsTreesActualUsesDescription = $plantsTreesActualUses->getDescription();
					$plantsTreesActualUsesCode = $plantsTreesActualUses->getCode();
				}
				else{
					$plantsTreesActualUsesDescription = $plantsTrees->getActualUse();
					$plantsTreesActualUsesCode = $plantsTrees->getActualUse();
				}
				*/
				
				// NCC Modification checked and implemented by K2 : November 21, 2005
				// details:			
				//		- changed `if($this->formArray["p"] <= 3)` to `if(...<=10)` in line xx
				//		- added lines 341 to 368
				//		- added lines 394 to 412		

				if($this->formArray["p"] <= 10){
					$lvl = number_format($plantsTrees->getAssessmentLevel(),2);
					if ($al <> $lvl) {
						if ($av > 0) {
							$this->formArray["ypos"] -= 13;
							$offset = $this->formArray["ypos"];

							$plantitems .= "<textitem xpos=\"25\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"left\">"."Plants/Trees"."</textitem>";
							$plantitems .= "<textitem xpos=\"115\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"9\" align=\"left\">".$ld."</textitem>";
							$plantitems .= "<textitem xpos=\"337\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".number_format($mv,2)."</textitem>";
							// danny : changed $al to $lvl and added '%' suffix in xml
							$plantitems .= "<textitem xpos=\"430\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".$lvl."%</textitem>";
							$plantitems .= "<textitem xpos=\"558\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".number_format($av,2)."</textitem>";

							$offsetx = $offset - 3;
							$plantitems .= "<lineitem x1=\"25\" y1=\"".$offsetx."\" x2=\"105\" y2=\"".$offsetx."\">blurb</lineitem>";
							$plantitems .= "<lineitem x1=\"115\" y1=\"".$offsetx."\" x2=\"228\" y2=\"".$offsetx."\">blurb</lineitem>";
							$plantitems .= "<lineitem x1=\"244\" y1=\"".$offsetx."\" x2=\"337\" y2=\"".$offsetx."\">blurb</lineitem>";
							$plantitems .= "<lineitem x1=\"358\" y1=\"".$offsetx."\" x2=\"445\" y2=\"".$offsetx."\">blurb</lineitem>";
							$plantitems .= "<lineitem x1=\"457\" y1=\"".$offsetx."\" x2=\"558\" y2=\"".$offsetx."\">blurb</lineitem>";
						}

						$av = 0;
						$mv = 0;
						// danny = changed `$al = $lvl` back to 0 .. don't understand why $al's need to be compared.
						$al = 0;
					}

					$ld = $plantActualUse;
					$mv += $plantsTrees->getAdjustedMarketValue();
					$av += un_number_format($plantsTrees->getAssessedValue());
					
					$p = $this->formArray["p"];

					$this->formArray["kind".$p] = $plantsTrees->getKind();
					$this->formArray["classification".$p] = $plantsTreesClassesDescription;

					$this->formArray["marketValue".$p] = un_number_format($plantsTrees->getMarketValue());
					$this->formArray["assessmentLevel".$p] = un_number_format($plantsTrees->getAssessmentLevel());
					$this->formArray["assessedValue".$p] = un_number_format($plantsTrees->getAssessedValue());
				}
				else if($this->formArray["p"] > 10){
					$this->formArray["othersCount"]++;

					$this->formArray["othersMV"] += toFloat($plantsTrees->getMarketValue());
					$this->formArray["othersAV"] += toFloat($plantsTrees->getAssessedValue());

					$this->formArray["kindOthers"] = "Plus ".$this->formArray["othersCount"]." other(s): P".formatCurrency($this->formArray["othersMV"])." (MV), P".formatCurrency($this->formArray["othersAV"])." (AV)";

					/*
					if($this->formArray["kindOthers"]!="") $this->formArray["kindOthers"] .= "; ";
					if($this->formArray["kindOthers"]==""){
						$this->formArray["kindOthers"] = "Others: ";
					}
					$this->formArray["kindOthers"] .= $plantsTrees->getKind();
					$this->formArray["kindOthers"] .= " MV=P".formatCurrency($plantsTrees->getMarketValue());
					$this->formArray["kindOthers"] .= " AV=P".formatCurrency($plantsTrees->getAssessedValue());
					*/
				}

				$this->formArray["totalMarketValue"] += toFloat($plantsTrees->getMarketValue());
				$this->formArray["totalAssessedValue"] += toFloat($plantsTrees->getAssessedValue());
				$this->formArray["p"]++;
			}
			
			if ($av > 0) {
				$this->formArray["ypos"] -= 13;
				$offset = $this->formArray["ypos"];

				$plantitems .= "<textitem xpos=\"25\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"left\">"."Plants/Trees"."</textitem>";
				$plantitems .= "<textitem xpos=\"115\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"9\" align=\"left\">".$ld."</textitem>";
				$plantitems .= "<textitem xpos=\"337\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".number_format($mv,2)."</textitem>";
				// danny : changed $al to $lvl and added '%' suffix in xml
				$plantitems .= "<textitem xpos=\"430\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".$lvl."%</textitem>";
				$plantitems .= "<textitem xpos=\"558\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".number_format($av,2)."</textitem>";

				$offsetx = $offset - 3;
				$plantitems .= "<lineitem x1=\"25\" y1=\"".$offsetx."\" x2=\"105\" y2=\"".$offsetx."\">blurb</lineitem>";
				$plantitems .= "<lineitem x1=\"115\" y1=\"".$offsetx."\" x2=\"228\" y2=\"".$offsetx."\">blurb</lineitem>";
				$plantitems .= "<lineitem x1=\"244\" y1=\"".$offsetx."\" x2=\"337\" y2=\"".$offsetx."\">blurb</lineitem>";
				$plantitems .= "<lineitem x1=\"358\" y1=\"".$offsetx."\" x2=\"445\" y2=\"".$offsetx."\">blurb</lineitem>";
				$plantitems .= "<lineitem x1=\"457\" y1=\"".$offsetx."\" x2=\"558\" y2=\"".$offsetx."\">blurb</lineitem>";
			}

			$this->formArray["plantitems"] = $plantitems;
			

		}
	}

	function displayImprovementsBuildingsList($improvementsBuildingsList){
		if(count($improvementsBuildingsList)){
			foreach($improvementsBuildingsList as $bkey => $improvementsBuildings){

				// buildingClassification
				$improvementsBuildingsClasses = new ImprovementsBuildingsClasses;
				if(is_numeric($improvementsBuildings->getBuildingClassification())){
					$improvementsBuildingsClasses->selectRecord($improvementsBuildings->getBuildingClassification());
					$improvementsBuildingsClassesDescription = $improvementsBuildingsClasses->getDescription();
					$improvementsBuildingsClassesCode = $improvementsBuildingsClasses->getCode();
				}
				else{
					$improvementsBuildingsClassesDescription = $improvementsBuildings->getBuildingClassification();
					$improvementsBuildingsClassesCode = $improvementsBuildings->getBuildingClassification();
				}

				/* just in case actualUse needs to be drawn from improvementsBuildings

				// actualUse
				$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
				if(is_numeric($improvementsBuildings->getActualUse())){
					$improvementsBuildingsActualUses->selectRecord($improvementsBuildings->getActualUse());
					$improvementsBuildingsActualUsesDescription = $improvementsBuildingsActualUses->getDescription();
					$improvementsBuildingsActualUsesCode = $improvementsBuildingsActualUses->getCode();
				}
				else{
					$improvementsBuildingsActualUsesDescription = $improvementsBuildings->getActualUse();
					$improvementsBuildingsActualUsesCode = $improvementsBuildings->getActualUse();
				}

				*/
				
				// NCC Modification checked and implemented by K2 : November 21, 2005
				// details:		
				//		- changed `if($this->formArray["p"] <= 3)` to `if(...<=10)` in line xx
				//		- added lines 459 to 473
				//		- added line 505				

				if($this->formArray["p"] <= 10){
					$p = $this->formArray["p"];
					
 					$this->formArray["ypos"] -= 13;
					$offset = $this->formArray["ypos"];

					$items .= "<textitem xpos=\"25\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"left\">".$improvementsBuildings->getKind()."</textitem>";
					$items .= "<textitem xpos=\"115\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"9\" align=\"left\">".$improvementsBuildingsClassesDescription."</textitem>";
					$items .= "<textitem xpos=\"337\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".number_format($improvementsBuildings->getMarketValue(),2)."</textitem>";
					$items .= "<textitem xpos=\"430\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".number_format($improvementsBuildings->getAssessmentLevel(),2)."</textitem>";
					$items .= "<textitem xpos=\"558\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".$improvementsBuildings->getAssessedValue()."</textitem>";

					$offsetx = $offset - 3;
					$items .= "<lineitem x1=\"25\" y1=\"".$offsetx."\" x2=\"105\" y2=\"".$offsetx."\">blurb</lineitem>";
					$items .= "<lineitem x1=\"115\" y1=\"".$offsetx."\" x2=\"228\" y2=\"".$offsetx."\">blurb</lineitem>";
					$items .= "<lineitem x1=\"244\" y1=\"".$offsetx."\" x2=\"337\" y2=\"".$offsetx."\">blurb</lineitem>";
					$items .= "<lineitem x1=\"358\" y1=\"".$offsetx."\" x2=\"445\" y2=\"".$offsetx."\">blurb</lineitem>";
					$items .= "<lineitem x1=\"457\" y1=\"".$offsetx."\" x2=\"558\" y2=\"".$offsetx."\">blurb</lineitem>";

					$this->formArray["kind".$p] = $improvementsBuildings->getKind();
					$this->formArray["classification".$p] = $improvementsBuildingsClassesDescription;

					$this->formArray["marketValue".$p] = un_number_format($improvementsBuildings->getMarketValue());
					$this->formArray["assessmentLevel".$p] = un_number_format($improvementsBuildings->getAssessmentLevel());
					$this->formArray["assessedValue".$p] = un_number_format($improvementsBuildings->getAssessedValue());
				}
				else if($this->formArray["p"] > 3){
					if($this->formArray["kindOthers"]!="") $this->formArray["kindOthers"] .= "; ";
					if($this->formArray["kindOthers"]==""){
						$this->formArray["kindOthers"] = "Others: ";
					}
					$this->formArray["kindOthers"] .= $improvementsBuildings->getKind();
					$this->formArray["kindOthers"] .= " MV=P".formatCurrency($improvementsBuildings->getMarketValue());
					$this->formArray["kindOthers"] .= " AV=P".formatCurrency($improvementsBuildings->getAssessedValue());
				}

				$this->formArray["totalMarketValue"] += toFloat($improvementsBuildings->getMarketValue());
				$this->formArray["totalAssessedValue"] += toFloat($improvementsBuildings->getAssessedValue());
				$this->formArray["p"]++;

				// added October182005 to fill up 'area' field for BuildingFAAS TD printouts:
				// comma separates areaofgroundfloor

				if($this->formArray["area"]!=""){
					$this->formArray["area"] .= ", ";
				}
				$this->formArray["area"] .= $improvementsBuildings->getAreaOfGroundFloor();
			}
			
			$this->formArray["landitems"] = $items;

		}
	}

	function displayMachineriesList($machineriesList){
		if(count($machineriesList)){
			foreach($machineriesList as $mkey => $machineries){
				// "kind" is assumed to be treated as "classes" for machineries

				$machineriesClasses = new MachineriesClasses;
				if(is_numeric($machineries->getKind())){
					$machineriesClasses->selectRecord($machineries->getKind());
					$machineriesClassesDescription = $machineriesClasses->getDescription();
					$machineriesClassesCode = $machineriesClasses->getCode();
				}
				else{
					$machineriesClassesDescription = $machineries->getKind();
					$machineriesClassesCode = $machineries->getActualUse();
				}

				// "classification" is assumed to be treated as "actualUse" for machineries
				$machineriesActualUses = new MachineriesActualUses;
				if(is_numeric($machineries->getActualUse())){
					$machineriesActualUses->selectRecord($machineries->getActualUse());
					$machineriesActualUsesDescription = $machineriesActualUses->getDescription();
					$machineriesActualUsesCode = $machineriesActualUses->getCode();
				}
				else{
					$machineriesActualUsesDescription = $machineries->getActualUse();
					$machineriesActualUsesCode = $machineries->getActualUse();
				}
				
				// NCC Modification checked and implemented by K2 : November 21, 2005
				// details:		
				//		- changed `if($this->formArray["p"] <= 3)` to `if(...<=10)` in line xx
				//		- added lines 547 to 561
				//		- added line 585				

				if($this->formArray["p"] <= 10){
					$p = $this->formArray["p"];
					
 					$this->formArray["ypos"] -= 12;
					$offset = $this->formArray["ypos"];

					$items .= "<textitem xpos=\"40\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"left\">".$machineriesClassesDescription."</textitem>";
					$items .= "<textitem xpos=\"146\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"9\" align=\"left\">".$machineriesActualUsesDescription."</textitem>";
					$items .= "<textitem xpos=\"337\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".number_format($machineries->getMarketValue(),2)."</textitem>";
					$items .= "<textitem xpos=\"430\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".number_format($machineries->getAssessmentLevel(),2)."</textitem>";
					$items .= "<textitem xpos=\"558\" ypos=\"".$offset."\" font=\"Helvetica\" size=\"10\" align=\"right\">".$machineries->getAssessedValue()."</textitem>";

					$offsetx = $offset - 3;
					$items .= "<lineitem x1=\"40\" y1=\"".$offsetx."\" x2=\"120\" y2=\"".$offsetx."\">blurb</lineitem>";
					$items .= "<lineitem x1=\"147\" y1=\"".$offsetx."\" x2=\"220\" y2=\"".$offsetx."\">blurb</lineitem>";
					$items .= "<lineitem x1=\"244\" y1=\"".$offsetx."\" x2=\"337\" y2=\"".$offsetx."\">blurb</lineitem>";
					$items .= "<lineitem x1=\"358\" y1=\"".$offsetx."\" x2=\"445\" y2=\"".$offsetx."\">blurb</lineitem>";
					$items .= "<lineitem x1=\"457\" y1=\"".$offsetx."\" x2=\"558\" y2=\"".$offsetx."\">blurb</lineitem>";
					
					$this->formArray["kind".$p] = $machineriesClassesDescription;
					$this->formArray["classification".$p] = $machineriesActualUsesDescription;

					$this->formArray["marketValue".$p] = un_number_format($machineries->getMarketValue());
					$this->formArray["assessmentLevel".$p] = un_number_format($machineries->getAssessmentLevel());
					$this->formArray["assessedValue".$p] = un_number_format($machineries->getAssessedValue());
				}
				else if($this->formArray["p"] > 3){
					if($this->formArray["kindOthers"]!="") $this->formArray["kindOthers"] .= "; ";
					if($this->formArray["kindOthers"]==""){
						$this->formArray["kindOthers"] = "Others: ";
					}
					$this->formArray["kindOthers"] .= $machineriesClassesDescription;
					$this->formArray["kindOthers"] .= " MV=P".formatCurrency($machineries->getMarketValue());
					$this->formArray["kindOthers"] .= " AV=P".formatCurrency($machineries->getAssessedValue());
				}

				$this->formArray["totalMarketValue"] += toFloat($machineries->getMarketValue());
				$this->formArray["totalAssessedValue"] += toFloat($machineries->getAssessedValue());
				$this->formArray["p"]++;
			}
			
			$this->formArray["landitems"] = $items;
		}
	}

	function displayLandDetails($landList){
        if (count($landList)){
			$land = $landList[0];

			$this->formArray["propertyID"] = $land->getPropertyID();
			$this->formArray["north"] = $land->getNorth();
			$this->formArray["south"] = $land->getSouth();
			$this->formArray["east"] = $land->getEast();
			$this->formArray["west"] = $land->getWest();

			$this->formArray["octTctNumber"] = $land->getOctTctNumber();
			$this->formArray["surveyNumber"] = $land->getSurveyNumber();

			// format textbox for octTctNumber (maxlength for first line is:13)
			if(strlen($this->formArray["octTctNumber"])<=13){
				$spaceDifference = 13 - strlen($this->formarray["octTctNumber"]);
				for($spaceCount=0 ; $spaceCount < $spaceDifference ; $spaceCount++){
					$this->formArray["octTctNumber"] = " ".$this->formArray["octTctNumber"];
				}
			}
			// format textbox for surveyNumber (maxlength for first line is:15)
			if(strlen($this->formArray["surveyNumber"])<=15){
				$spaceDifference = 15 - strlen($this->formarray["surveyNumber"]);
				for($spaceCount=0 ; $spaceCount < $spaceDifference ; $spaceCount++){
					$this->formArray["surveyNumber"] = " ".$this->formArray["surveyNumber"];
				}
			}

			if (is_a($land->propertyAdministrator,Person)){
				$this->formArray["administratorName"] = $land->propertyAdministrator->getFullName();

				if(is_array($land->propertyAdministrator->addressArray)){
					$adminAddress = $land->propertyAdministrator->addressArray[0]->getNumber();
					$adminAddress.= " ".$land->propertyAdministrator->addressArray[0]->getStreet();
					$adminAddress.= " ".$land->propertyAdministrator->addressArray[0]->getBarangay();
					$adminAddress.= " ".$land->propertyAdministrator->addressArray[0]->getDistrict();
					$adminAddress.= " ".$land->propertyAdministrator->addressArray[0]->getMunicipalityCity();
					$adminAddress.= " ".$land->propertyAdministrator->addressArray[0]->getProvince();
					$this->formArray["administratorAddress"] = $adminAddress;
				}
			}

			if(is_numeric($land->getVerifiedBy())){
				$verifiedBy = new Person;
				$verifiedBy->selectRecord($land->getVerifiedBy());
				$this->formArray["verifiedBy"] = $verifiedBy->getFullName();
			}
			else{
				$this->formArray["verifiedBy"] = $land->getVerifiedBy();
			}


			// modified October 18 2005 :
			// totals land area for land-stripping 
			// if all are hectares, total in hectares
			// if all are square meters, total in square meters
			// if units are mixed, total in hectares

			$this->formArray["area"] = "";
			$this->formArray["unit"] = "";
			$i=0;

			$lUnit = "";
			$lStartUnit = "";
			foreach($landList as $lvalue){
				$lTotalInSQM = 0;
				$lTotalInHA = 0;
				if($lStartUnit==""){
					$lStartUnit = $lvalue->getUnit();
				}
				else{
					if($lStartUnit!=$lvalue->getUnit()) $lTotalUnitsAre = "mixed";
					else $lTotalUnitsAre = $lStartUnit;
				}

				$lAreaInSQM = 0;
				if($lvalue->getUnit()=="hectares"){
					$lAreaInSQM = $lvalue->getArea() * 10000;
					$lAreaInHA = $lvalue->getArea();
				}
				else{
					// sqm
					$lAreaInSQM = $lvalue->getArea();
					$lAreaInHA = $lvalue->getArea() / 10000;
				}
				$lTotalAreaInSQM += $lAreaInSQM;
				$lTotalAreaInHA += $lAreaInHA;
			}
			switch($lTotalUnitsAre){
				case "hectares":
					$this->formArray["area"] = number_format($lTotalAreaInHA, 4, '.', ',');
					$this->formArray["unit"] = "ha.";
					break;
				case "square meters":
				case "mixed":
				default:
					$this->formArray["area"] = number_format($lTotalAreaInSQM, 2, '.', ',');
					$this->formArray["unit"] = "sqm.";
					break;
			}			
		}
	}

	function displayOwnerList($domDoc){
		$owner = new Owner;
		$owner->parseDomDocument($domDoc);

		$ownerName = "";
		if (is_array($owner->personArray)){
			foreach($owner->personArray as $personKey =>$personValue){
				if ($ownerName == ""){
					if(is_object($personValue->addressArray[0])){
						$address = $personValue->addressArray[0]->getFullAddress();
					}
					$ownerName = $personValue->getName();
				}
				else{
					$ownerName = $ownerName." , ".$personValue->getName();
				}
			}
		}
		else{
		}

		if (is_array($owner->companyArray)){
			foreach ($owner->companyArray as $companyKey => $companyValue){
				if ($ownerName == ""){
					if(is_object($companyValue->addressArray[0])){
						$address = $companyValue->addressArray[0]->getFullAddress();
					}
					$ownerName = $companyValue->getCompanyName();
				}
				else{
					$ownerName = $ownerName." , ".$companyValue->getCompanyName();
				}
			}
		}
		else{
		}
		
		$this->formArray["ownerName"] = $ownerName;
		$this->formArray["ownerAddress"] = $address;

		// wordwrapping for ownerName

		if(strlen($this->formArray["ownerName"]) > 84){
			$this->formArray["ownerName"] = wordwrap($this->formArray["ownerName"],94, "\n", 1);
			$this->tpl->set_var("ownerName_fontSize", 7);
		}
		else if(strlen($this->formArray["ownerName"]) > 40){
			$this->formArray["ownerName"] = wordwrap($this->formArray["ownerName"],42, "\n", 1);
			$this->tpl->set_var("ownerName_fontSize", 9);
		}
		else{
			$this->formArray["ownerName"] = "\n".$this->formArray["ownerName"];
			$this->tpl->set_var("ownerName_fontSize", 10);
		}

		// wordwrapping for ownerAddress
		if(strlen($this->formArray["ownerAddress"]) > 84){
			$this->formArray["ownerAddress"] = wordwrap($this->formArray["ownerAddress"],62, "\n", 1);
			$this->tpl->set_var("ownerAddress_fontSize", 7);
		}
		else if(strlen($this->formArray["ownerAddress"]) > 36){
			$this->formArray["ownerAddress"] = wordwrap($this->formArray["ownerAddress"],42, "\n", 1);
			$this->tpl->set_var("ownerAddress_fontSize", 9);
		}
		else{
			$this->formArray["ownerAddress"] = "\n".$this->formArray["ownerAddress"];
			$this->tpl->set_var("ownerAddress_fontSize", 10);
		}
	}

	function displayODAFS($afsID){
		$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
		if (!$odID = $AFSDetails->getOdID($afsID)){
			echo ("get od id failed");
		}
		else{
			$ODDetails = new SoapObject(NCCBIZ."ODDetails.php", "urn:Object");
			if (!$xmlStr = $ODDetails->getOD($odID)){
				exit("xml failed");
			}
			else{
				//exit($xmlStr);
				if(!$domDoc = domxml_open_mem($xmlStr)) {
					echo "error open xml";
				}
				else {
					$od = new OD;
					$od->parseDomDocument($domDoc);

					if (is_object($od->locationAddress)){
						$this->formArray["location"] = $od->locationAddress->getFullAddress();
						if($od->locationAddress->getNumber()!="" && $od->locationAddress->getNumber()!="--" && $od->locationAddress->getNumber()!=" "){
							$this->formArray["numberStreet"] = $od->locationAddress->getNumber();
						}
						if($od->locationAddress->getStreet()!="" && $od->locationAddress->getStreet()!="--" && $od->locationAddress->getStreet()!=" "){
							$this->formArray["numberStreet"] .= " " . $od->locationAddress->getStreet();
						}
						$this->formArray["barangay"] = $od->locationAddress->getBarangay();
						$this->formArray["municipalityCity"] = $od->locationAddress->getMunicipalityCity();
					}

					$this->formArray["lotNumber"] = $od->getLotNumber();
					$this->formArray["blockNumber"] = $od->getBlockNumber();

					// format textbox for lotNumber (maxlength for first line is:19)
					if(strlen($this->formArray["lotNumber"])<=19){
						$spaceDifference = 19 - strlen($this->formarray["lotNumber"]);
						for($spaceCount=0 ; $spaceCount < $spaceDifference ; $spaceCount++){
							$this->formArray["lotNumber"] = " ".$this->formArray["lotNumber"];
						}
					}
					// format textbox for blockNumber (maxlength for first line is:19)
					if(strlen($this->formArray["blockNumber"])<=19){
						$spaceDifference = 19 - strlen($this->formarray["blockNumber"]);
						for($spaceCount=0 ; $spaceCount < $spaceDifference ; $spaceCount++){
							$this->formArray["blockNumber"] = " ".$this->formArray["blockNumber"];
						}
					}

					$ODEncode = new SoapObject(NCCBIZ."ODEncode.php", "urn:Object");
					$this->formArray["ownerID"] = $ODEncode->getOwnerID($this->formArray["odID"]);
					$xmlStr = $od->owner->domDocument->dump_mem(true);
					if (!$xmlStr){
						echo "error xml";
					}
					else {
						//echo $xmlStr;
						if(!$domDoc = domxml_open_mem($xmlStr)) {
							echo "error open xml";
						}
						else {
							$this->displayOwnerList($domDoc);
						}
					}
				}	
			}
		}
	}

	function displayTDDetails(){
		$afsID = $this->formArray["afsID"];
		
		$TDDetails = new SoapObject(NCCBIZ."TDDetails.php", "urn:Object");
		if (!$xmlStr = $TDDetails->getTD("",$afsID,"","")){
			// error xml
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
			}
			else {
				$td = new TD;
				$td->parseDomDocument($domDoc);

				$this->formArray["taxDeclarationNumber"] = $td->getTaxDeclarationNumber();
				$this->formArray["memoranda"] = $td->getMemoranda();
				$this->formArray["cancelsTDNumber"] = $td->getCancelsTDNumber();

				//cityMunicipalAssessor
				if(is_numeric($td->getCityMunicipalAssessor())){
					$cityMunicipalAssessor = new Person;
					$cityMunicipalAssessor->selectRecord($td->cityMunicipalAssessor);
					$this->formArray["cityAssessor"] = $cityMunicipalAssessor->getFullName();
				}
				else{
					$this->formArray["cityAssessor"] = $td->getCityMunicipalAssessor;
				}

				$this->formArray["propertyType"] = $td->getPropertyType();
			}
		}
	}
	
	function Main(){
		$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
		if (!$xmlStr = $AFSDetails->getAFS($this->formArray["afsID"])){
			exit("afs not found");
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				exit("error xmlDoc");
			}
			else {
				$afs = new AFS;
				$afs->parseDomDocument($domDoc);

				$this->formArray["propertyIndexNumber"] = $afs->getPropertyIndexNumber();
				$this->formArray["arpNumber"] = $afs->getArpNumber();
				$this->formArray["effectivity"] = $afs->getEffectivity();
				if($afs->getTaxability()=="Taxable"){
					$this->formArray["isTaxable"] = "X";
					$this->formArray["isExempt"] = "  ";
				}
				else if($afs->getTaxability()=="Exempt"){
					$this->formArray["isExempt"] = "X";
					$this->formArray["isTaxable"] = "  ";
				}

				$this->displayODAFS($this->formArray["afsID"]);
				$this->displayTDDetails();

				// if propertyType is "Land", grab Land values plus PlantsTrees values
				// if propertyType is "ImprovementsBuildings" or "Machineries", system should later on grab
				// "Land" from another AFS from based on bldg->landPin or mach->landPin field
				// still needs to be resolved whether to do it this way or not

				switch($this->formArray["propertyType"]){
					case "Land":
						$landList = $afs->getLandArray();
						$plantsTreesList = $afs->getPlantsTreesArray();

						if(is_array($landList)){
							$this->displayLandDetails($landList);
							$this->displayLandList($landList);
						}
						if(is_array($plantsTreesList)){
							$this->displayPlantsTreesList($plantsTreesList);
						}

						break;
					case "ImprovementsBuildings":
						$improvementsBuildingsList = $afs->getImprovementsBuildingsArray();
						if(is_array($improvementsBuildingsList)){
							$this->displayImprovementsBuildingsList($improvementsBuildingsList);
						}
						break;
					case "Machineries":
						$machineriesList = $afs->getMachineriesArray();
						if(is_array($machineriesList)){
							$this->displayMachineriesList($machineriesList);
						}
						break;
				}

				// UNCOMMENT LINES TO GRAB totalMarketValue and totalAssessedValue from AFS object instead of 
				// computing from each property:

				//$this->formArray["totalMarketValue"] = $afs->getTotalMarketValue();
				//$this->formArray["totalAssessedValue"] = $afs->getTotalAssessedValue();

				$this->formArray["totalAssessedValueInWords"] = makewords($this->formArray["totalAssessedValue"]);

			}
		}
				
        $this->setForm();

        $this->tpl->parse("templatePage", "rptsTemplate");
        $this->tpl->finish("templatePage");

		$testpdf = new PDFWriter;
        $testpdf->setOutputXML($this->tpl->get("templatePage"),"test");
        if(isset($this->formArray["print"])){
        	$testpdf->writePDF($name);//,$this->formArray["print"]);
        }
        else {
        	$testpdf->writePDF($name);
        }		
//		header("location: ".$testpdf->pdfPath);
		exit;
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

$tdDetails = new TDDetails($http_post_vars,$sess,$odID,$ownerID,$afsID,$print);
$tdDetails->Main();
?>
<?php page_close(); ?>
