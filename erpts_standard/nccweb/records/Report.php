<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/records/LGU.php";

#####################################
# Define Interface Class
#####################################
class SummaryReport{
	
	var $tpl;
	function SummaryReport($sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "SummaryReport.htm") ;
		$this->tpl->set_var("TITLE", "SummaryReport");
	}

	function Main(){
		global $DBid;
		$this->tpl->set_var("Session", $this->sess->url(""));
			
		$this->subRETaxableRealPropertyUnits = 0;
		$this->subRETaxableLandArea = 0;
		$this->subAGTaxableRealPropertyUnits = 0;
		$this->subAGTaxableLandArea = 0;
		$this->subCOTaxableRealPropertyUnits = 0;
		$this->subCOTaxableLandArea = 0;
		$this->subINTaxableRealPropertyUnits = 0;
		$this->subINTaxableLandArea = 0;
		$this->subMITaxableRealPropertyUnits = 0;
		$this->subMITaxableLandArea = 0;
		$this->subTITaxableRealPropertyUnits = 0;
		$this->subTITaxableLandArea = 0;
		$this->subSPTaxableRealPropertyUnits = 0;
		$this->subSPTaxableLandArea = 0;
		$this->subHOTaxableRealPropertyUnits = 0;
		$this->subHOTaxableLandArea = 0;
		$this->subSCTaxableRealPropertyUnits = 0;
		$this->subSCTaxableLandArea = 0;
		$this->subCUTaxableRealPropertyUnits = 0;
		$this->subCUTaxableLandArea = 0;
		$this->subOTTaxableRealPropertyUnits = 0;
		$this->subOTTaxableLandArea = 0;
		$this->subGOExemptRealPropertyUnits = 0;
		$this->subGOExemptLandArea = 0;
		$this->subRLExemptRealPropertyUnits = 0;
		$this->subRLExemptLandArea = 0;
		$this->subCHExemptRealPropertyUnits = 0;
		$this->subCHExemptLandArea = 0;
		$this->subEDExemptRealPropertyUnits = 0;
		$this->subEDExemptLandArea = 0;
		$this->subOTExemptRealPropertyUnits = 0;
		$this->subOTExemptLandArea = 0;
		
		$this->subRETaxableLandMarketValue = 0;
		$this->subRETaxableLandAssessedValue = 0;
		$this->subAGTaxableLandMarketValue = 0;
		$this->subAGTaxableLandAssessedValue = 0;
		$this->subCOTaxableLandMarketValue = 0;
		$this->subCOTaxableLandAssessedValue = 0;
		$this->subINTaxableLandMarketValue = 0;
		$this->subINTaxableLandAssessedValue = 0;
		$this->subMITaxableLandMarketValue = 0;
		$this->subMITaxableLandAssessedValue = 0;
		$this->subTITaxableLandMarketValue = 0;
		$this->subTITaxableLandAssessedValue = 0;
		$this->subSPTaxableLandMarketValue = 0;
		$this->subSPTaxableLandAssessedValue = 0;
		$this->subHOTaxableLandMarketValue = 0;
		$this->subHOTaxableLandAssessedValue = 0;
		$this->subSCTaxableLandMarketValue = 0;
		$this->subSCTaxableLandAssessedValue = 0;
		$this->subCUTaxableLandMarketValue = 0;
		$this->subCUTaxableLandAssessedValue = 0;
		$this->subOTTaxableLandMarketValue = 0;
		$this->subOTTaxableLandAssessedValue = 0;
		$this->subGOExemptLandMarketValue = 0;
		$this->subGOExemptLandAssessedValue = 0;
		$this->subRLExemptLandMarketValue = 0;
		$this->subRLExemptLandAssessedValue = 0;
		$this->subCHExemptLandMarketValue = 0;
		$this->subCHExemptLandAssessedValue = 0;
		$this->subEDExemptLandMarketValue = 0;
		$this->subEDExemptLandAssessedValue = 0;
		$this->subOTExemptLandMarketValue = 0;
		$this->subOTExemptLandAssessedValue = 0;
		
		$this->subRETaxableBldgLessMarketValue = 0;
		$this->subRETaxableBldgLessAssessedValue = 0;
		$this->subAGTaxableBldgLessMarketValue = 0;
		$this->subAGTaxableBldgLessAssessedValue = 0;
		$this->subCOTaxableBldgLessMarketValue = 0;
		$this->subCOTaxableBldgLessAssessedValue = 0;
		$this->subINTaxableBldgLessMarketValue = 0;
		$this->subINTaxableBldgLessAssessedValue = 0;
		$this->subMITaxableBldgLessMarketValue = 0;
		$this->subMITaxableBldgLessAssessedValue = 0;
		$this->subTITaxableBldgLessMarketValue = 0;
		$this->subTITaxableBldgLessAssessedValue = 0;
		$this->subSPTaxableBldgLessMarketValue = 0;
		$this->subSPTaxableBldgLessAssessedValue = 0;
		$this->subHOTaxableBldgLessMarketValue = 0;
		$this->subHOTaxableBldgLessAssessedValue = 0;
		$this->subSCTaxableBldgLessMarketValue = 0;
		$this->subSCTaxableBldgLessAssessedValue = 0;
		$this->subCUTaxableBldgLessMarketValue = 0;
		$this->subCUTaxableBldgLessAssessedValue = 0;
		$this->subOTTaxableBldgLessMarketValue = 0;
		$this->subOTTaxableBldgLessAssessedValue = 0;
		$this->subGOExemptBldgLessMarketValue = 0;
		$this->subGOExemptBldgLessAssessedValue = 0;
		$this->subRLExemptBldgLessMarketValue = 0;
		$this->subRLExemptBldgLessAssessedValue = 0;
		$this->subCHExemptBldgLessMarketValue = 0;
		$this->subCHExemptBldgLessAssessedValue = 0;
		$this->subEDExemptBldgLessMarketValue = 0;
		$this->subEDExemptBldgLessAssessedValue = 0;
		$this->subOTExemptBldgLessMarketValue = 0;
		$this->subOTExemptBldgLessAssessedValue = 0;
		
		$this->subRETaxableBldgOverMarketValue = 0;
		$this->subRETaxableBldgOverAssessedValue = 0;
		$this->subAGTaxableBldgOverMarketValue = 0;
		$this->subAGTaxableBldgOverAssessedValue = 0;
		$this->subCOTaxableBldgOverMarketValue = 0;
		$this->subCOTaxableBldgOverAssessedValue = 0;
		$this->subINTaxableBldgOverMarketValue = 0;
		$this->subINTaxableBldgOverAssessedValue = 0;
		$this->subMITaxableBldgOverMarketValue = 0;
		$this->subMITaxableBldgOverAssessedValue = 0;
		$this->subTITaxableBldgOverMarketValue = 0;
		$this->subTITaxableBldgOverAssessedValue = 0;
		$this->subSPTaxableBldgOverMarketValue = 0;
		$this->subSPTaxableBldgOverAssessedValue = 0;
		$this->subHOTaxableBldgOverMarketValue = 0;
		$this->subHOTaxableBldgOverAssessedValue = 0;
		$this->subSCTaxableBldgOverMarketValue = 0;
		$this->subSCTaxableBldgOverAssessedValue = 0;
		$this->subCUTaxableBldgOverMarketValue = 0;
		$this->subCUTaxableBldgOverAssessedValue = 0;
		$this->subOTTaxableBldgOverMarketValue = 0;
		$this->subOTTaxableBldgOverAssessedValue = 0;
		$this->subGOExemptBldgOverMarketValue = 0;
		$this->subGOExemptBldgOverAssessedValue = 0;
		$this->subRLExemptBldgOverMarketValue = 0;
		$this->subRLExemptBldgOverAssessedValue = 0;
		$this->subCHExemptBldgOverMarketValue = 0;
		$this->subCHExemptBldgOverAssessedValue = 0;
		$this->subEDExemptBldgOverMarketValue = 0;
		$this->subEDExemptBldgOverAssessedValue = 0;
		$this->subOTExemptBldgOverMarketValue = 0;
		$this->subOTExemptBldgOverAssessedValue = 0;
		
		$this->subRETaxableMachMarketValue = 0;
		$this->subRETaxableMachAssessedValue = 0;
		$this->subAGTaxableMachMarketValue = 0;
		$this->subAGTaxableMachAssessedValue = 0;
		$this->subCOTaxableMachMarketValue = 0;
		$this->subCOTaxableMachAssessedValue = 0;
		$this->subINTaxableMachMarketValue = 0;
		$this->subINTaxableMachAssessedValue = 0;
		$this->subMITaxableMachMarketValue = 0;
		$this->subMITaxableMachAssessedValue = 0;
		$this->subTITaxableMachMarketValue = 0;
		$this->subTITaxableMachAssessedValue = 0;
		$this->subSPTaxableMachMarketValue = 0;
		$this->subSPTaxableMachAssessedValue = 0;
		$this->subHOTaxableMachMarketValue = 0;
		$this->subHOTaxableMachAssessedValue = 0;
		$this->subSCTaxableMachMarketValue = 0;
		$this->subSCTaxableMachAssessedValue = 0;
		$this->subCUTaxableMachMarketValue = 0;
		$this->subCUTaxableMachAssessedValue = 0;
		$this->subOTTaxableMachMarketValue = 0;
		$this->subOTTaxableMachAssessedValue = 0;
		$this->subGOExemptMachMarketValue = 0;
		$this->subGOExemptMachAssessedValue = 0;
		$this->subRLExemptMachMarketValue = 0;
		$this->subRLExemptMachAssessedValue = 0;
		$this->subCHExemptMachMarketValue = 0;
		$this->subCHExemptMachAssessedValue = 0;
		$this->subEDExemptMachMarketValue = 0;
		$this->subEDExemptMachAssessedValue = 0;
		$this->subOTExemptMachMarketValue = 0;
		$this->subOTExemptMachAssessedValue = 0;
		
		$this->subRETaxableOtherMarketValue = 0;
		$this->subRETaxableOtherAssessedValue = 0;
		$this->subAGTaxableOtherMarketValue = 0;
		$this->subAGTaxableOtherAssessedValue = 0;
		$this->subCOTaxableOtherMarketValue = 0;
		$this->subCOTaxableOtherAssessedValue = 0;
		$this->subINTaxableOtherMarketValue = 0;
		$this->subINTaxableOtherAssessedValue = 0;
		$this->subMITaxableOtherMarketValue = 0;
		$this->subMITaxableOtherAssessedValue = 0;
		$this->subTITaxableOtherMarketValue = 0;
		$this->subTITaxableOtherAssessedValue = 0;
		$this->subSPTaxableOtherMarketValue = 0;
		$this->subSPTaxableOtherAssessedValue = 0;
		$this->subHOTaxableOtherMarketValue = 0;
		$this->subHOTaxableOtherAssessedValue = 0;
		$this->subSCTaxableOtherMarketValue = 0;
		$this->subSCTaxableOtherAssessedValue = 0;
		$this->subCUTaxableOtherMarketValue = 0;
		$this->subCUTaxableOtherAssessedValue = 0;
		$this->subOTTaxableOtherMarketValue = 0;
		$this->subOTTaxableOtherAssessedValue = 0;
		$this->subGOExemptOtherMarketValue = 0;
		$this->subGOExemptOtherAssessedValue = 0;
		$this->subRLExemptOtherMarketValue = 0;
		$this->subRLExemptOtherAssessedValue = 0;
		$this->subCHExemptOtherMarketValue = 0;
		$this->subCHExemptOtherAssessedValue = 0;
		$this->subEDExemptOtherMarketValue = 0;
		$this->subEDExemptOtherAssessedValue = 0;
		$this->subOTExemptOtherMarketValue = 0;
		$this->subOTExemptOtherAssessedValue = 0;
		
		$this->totalRETaxableMarketValue = 0;
		$this->totalRETaxableAssessedValue = 0;
		$this->totalAGTaxableMarketValue = 0;
		$this->totalAGTaxableAssessedValue = 0;
		$this->totalCOTaxableMarketValue = 0;
		$this->totalCOTaxableAssessedValue = 0;
		$this->totalINTaxableMarketValue = 0;
		$this->totalINTaxableAssessedValue = 0;
		$this->totalMITaxableMarketValue = 0;
		$this->totalMITaxableAssessedValue = 0;
		$this->totalTITaxableMarketValue = 0;
		$this->totalTITaxableAssessedValue = 0;
		$this->totalSPTaxableMarketValue = 0;
		$this->totalSPTaxableAssessedValue = 0;
		$this->totalHOTaxableMarketValue = 0;
		$this->totalHOTaxableAssessedValue = 0;
		$this->totalSCTaxableMarketValue = 0;
		$this->totalSCTaxableAssessedValue = 0;
		$this->totalCUTaxableMarketValue = 0;
		$this->totalCUTaxableAssessedValue = 0;
		$this->totalOTTaxableMarketValue = 0;
		$this->totalOTTaxableAssessedValue = 0;
		$this->totalGOExemptMarketValue = 0;
		$this->totalGOExemptAssessedValue = 0;
		$this->totalRLExemptMarketValue = 0;
		$this->totalRLExemptAssessedValue = 0;
		$this->totalCHExemptMarketValue = 0;
		$this->totalCHExemptAssessedValue = 0;
		$this->totalEDExemptMarketValue = 0;
		$this->totalEDExemptAssessedValue = 0;
		$this->totalOTExemptMarketValue = 0;
		$this->totalOTExemptAssessedValue = 0;
		
		$this->totalTaxableRealPropertyUnits = 0;
		$this->totalTaxableLandArea = 0;
		$this->totalTaxableLandMarketValue = 0;
		$this->totalTaxableLandAssessedValue = 0;
		$this->totalTaxableBldgLessMarketValue = 0;
		$this->totalTaxableBldgLessAssessedValue = 0;
		$this->totalTaxableBldgOverMarketValue = 0;
		$this->totalTaxableBldgOverAssessedValue = 0;
		$this->totalTaxableMachMarketValue = 0;
		$this->totalTaxableMachAssessedValue = 0;	
		$this->totalTaxableOtherMarketValue = 0;
		$this->totalTaxableOtherAssessedValue = 0;
		$this->totalTaxableMarketValue = 0;
		$this->totalTaxableAssessedValue = 0;
		
		$this->totalExemptRealPropertyUnits = 0;
		$this->totalExemptLandArea = 0;
		$this->totalExemptLandMarketValue = 0;
		$this->totalExemptLandAssessedValue = 0;
		$this->totalExemptBldgLessMarketValue = 0;
		$this->totalExemptBldgLessAssessedValue = 0;
		$this->totalExemptBldgOverMarketValue = 0;
		$this->totalExemptBldgOverAssessedValue = 0;
		$this->totalExemptMachMarketValue = 0;
		$this->totalExemptMachAssessedValue = 0;
		$this->totalExemptOtherMarketValue = 0;
		$this->totalExemptOtherAssessedValue = 0;
		$this->totalExemptMarketValue = 0;
		$this->totalExemptAssessedValue = 0;
		
		$this->totalRealPropertyUnits = 0;
		$this->totalLandArea = 0;
		$this->totalLandMarketValue = 0;
		$this->totalLandAssessedValue = 0;
		$this->totalBldgLessMarketValue = 0;
		$this->totalBldgLessAssessedValue = 0;
		$this->totalBldgOverMarketValue = 0;
		$this->totalBldgOverAssessedValue = 0;
		$this->totalMachMarketValue = 0;
		$this->totalMachAssessedValue = 0;
		$this->totalOtherMarketValue = 0;
		$this->totalOtherAssessedValue = 0;
		$this->totalMarketValue = 0;
		$this->totalAssessedValue = 0;
		
		$this->tpl->set_block("rptsTemplate", "DBList", "DBListBlock");
		$ctr = 1;
		foreach ($DBid as $key => $value){
			$lgu = new LGU;
			$lgu->selectRecord($value);
			$this->dbName = $lgu->getLGUDB();
			if ($ctr == 1) $this->tpl->set_var("dbs", $lgu->getLGUName());
			else $this->tpl->set_var("dbs", " - ".$lgu->getLGUName());
			$this->tpl->parse("DBListBlock", "DBList", true);
			$ctr++;
		
			$sql = "SELECT a.code, b.actualUse, count(b.propertyID) as rpu, sum( b.assessedValue ) as assessedValue, sum( b.marketValue ) as marketValue, sum(area) as area".
					" FROM LandActualUses a".
					" LEFT  JOIN Land b ON a.landActualUsesID = b.actualUse".
					" GROUP  BY a.code;";
			$this->computeProperty("Land",$sql);
			$sql = "SELECT a.code, b.actualUse, count(b.propertyID), sum( b.assessedValue ) as assessedValue, sum( b.marketValue ) as marketValue".
					" FROM ImprovementsBuildingsActualUses a".
					" LEFT  JOIN ImprovementsBuildings b ON a.improvementsBuildingsActualUsesID = b.actualUse AND b.marketValue <= 175000 AND b.assessedValue <= 175000".
					" GROUP  BY a.code;";
			$this->computeProperty("BldgLess",$sql);
			$sql = "SELECT a.code, b.actualUse, count(b.propertyID), sum( b.assessedValue ) as assessedValue, sum( b.marketValue ) as marketValue".
					" FROM ImprovementsBuildingsActualUses a".
					" LEFT  JOIN ImprovementsBuildings b ON a.improvementsBuildingsActualUsesID = b.actualUse AND b.marketValue > 175000 AND b.assessedValue > 175000".
					" GROUP  BY a.code;";
			$this->computeProperty("BldgOver",$sql);
			$sql = "SELECT a.code, b.actualUse, count(b.propertyID), sum( b.assessedValue ) as assessedValue, sum( b.marketValue ) as marketValue".
					" FROM MachineriesActualUses a".
					" LEFT  JOIN Machineries b ON a.machineriesActualUsesID = b.actualUse".
					" GROUP  BY a.code;";
			$this->computeProperty("Mach",$sql);
		}
		$this->tpl->set_var("RETaxable_RealPropertyUnits", $this->checkNumericFormat($this->subRETaxableRealPropertyUnits));
		$this->tpl->set_var("RETaxable_LandArea", $this->checkNumericFormat($this->subRETaxableLandArea));
		$this->tpl->set_var("AGTaxable_RealPropertyUnits", $this->checkNumericFormat($this->subAGTaxableRealPropertyUnits));
		$this->tpl->set_var("AGTaxable_LandArea", $this->checkNumericFormat($this->subAGTaxableLandArea));
		$this->tpl->set_var("COTaxable_RealPropertyUnits", $this->checkNumericFormat($this->subCOTaxableRealPropertyUnits));
		$this->tpl->set_var("COTaxable_LandArea", $this->checkNumericFormat($this->subCOTaxableLandArea));
		$this->tpl->set_var("INTaxable_RealPropertyUnits", $this->checkNumericFormat($this->subINTaxableRealPropertyUnits));
		$this->tpl->set_var("INTaxable_LandArea", $this->checkNumericFormat($this->subINTaxableLandArea));
		$this->tpl->set_var("MITaxable_RealPropertyUnits", $this->checkNumericFormat($this->subMITaxableRealPropertyUnits));
		$this->tpl->set_var("MITaxable_LandArea", $this->checkNumericFormat($this->subMITaxableLandArea));
		$this->tpl->set_var("TITaxable_RealPropertyUnits", $this->checkNumericFormat($this->subTITaxableRealPropertyUnits));
		$this->tpl->set_var("TITaxable_LandArea", $this->checkNumericFormat($this->subTITaxableLandArea));
		$this->tpl->set_var("SPTaxable_RealPropertyUnits", $this->checkNumericFormat($this->subSPTaxableRealPropertyUnits));
		$this->tpl->set_var("SPTaxable_LandArea", $this->checkNumericFormat($this->subSPTaxableLandArea));
		$this->tpl->set_var("HOTaxable_RealPropertyUnits", $this->checkNumericFormat($this->subHOTaxableRealPropertyUnits));
		$this->tpl->set_var("HOTaxable_LandArea", $this->checkNumericFormat($this->subHOTaxableLandArea));
		$this->tpl->set_var("SCTaxable_RealPropertyUnits", $this->checkNumericFormat($this->subSCTaxableRealPropertyUnits));
		$this->tpl->set_var("SCTaxable_LandArea", $this->checkNumericFormat($this->subSCTaxableLandArea));
		$this->tpl->set_var("CUTaxable_RealPropertyUnits", $this->checkNumericFormat($this->subCUTaxableRealPropertyUnits));
		$this->tpl->set_var("CUTaxable_LandArea", $this->checkNumericFormat($this->subCUTaxableLandArea));
		$this->tpl->set_var("OTTaxable_RealPropertyUnits", $this->checkNumericFormat($this->subOTTaxableRealPropertyUnits));
		$this->tpl->set_var("OTTaxable_LandArea", $this->checkNumericFormat($this->subOTTaxableLandArea));
		$this->tpl->set_var("GOExempt_RealPropertyUnits", $this->checkNumericFormat($this->subGOExemptRealPropertyUnits));
		$this->tpl->set_var("GOExempt_LandArea", $this->checkNumericFormat($this->subGOExemptLandArea));
		$this->tpl->set_var("RLExempt_RealPropertyUnits", $this->checkNumericFormat($this->subRLExemptRealPropertyUnits));
		$this->tpl->set_var("RLExempt_LandArea", $this->checkNumericFormat($this->subRLExemptLandArea));
		$this->tpl->set_var("CHExempt_RealPropertyUnits", $this->checkNumericFormat($this->subCHExemptRealPropertyUnits));
		$this->tpl->set_var("CHExempt_LandArea", $this->checkNumericFormat($this->subCHExemptLandArea));
		$this->tpl->set_var("EDExempt_RealPropertyUnits", $this->checkNumericFormat($this->subEDExemptRealPropertyUnits));
		$this->tpl->set_var("EDExempt_LandArea", $this->checkNumericFormat($this->subEDExemptLandArea));
		$this->tpl->set_var("OTExempt_RealPropertyUnits", $this->checkNumericFormat($this->subOTExemptRealPropertyUnits));
		$this->tpl->set_var("OTExempt_LandArea", $this->checkNumericFormat($this->subOTExemptLandArea));
		
		$this->tpl->set_var("RETaxable_LandMV", $this->checkNumericFormat($this->subRETaxableLandMarketValue));
		$this->tpl->set_var("RETaxable_LandAV", $this->checkNumericFormat($this->subRETaxableLandAssessedValue));
		$this->tpl->set_var("AGTaxable_LandMV", $this->checkNumericFormat($this->subAGTaxableLandMarketValue));
		$this->tpl->set_var("AGTaxable_LandAV", $this->checkNumericFormat($this->subAGTaxableLandAssessedValue));
		$this->tpl->set_var("COTaxable_LandMV", $this->checkNumericFormat($this->subCOTaxableLandMarketValue));
		$this->tpl->set_var("COTaxable_LandAV", $this->checkNumericFormat($this->subCOTaxableLandAssessedValue));
		$this->tpl->set_var("INTaxable_LandMV", $this->checkNumericFormat($this->subINTaxableLandMarketValue));
		$this->tpl->set_var("INTaxable_LandAV", $this->checkNumericFormat($this->subINTaxableLandAssessedValue));
		$this->tpl->set_var("MITaxable_LandMV", $this->checkNumericFormat($this->subMITaxableLandMarketValue));
		$this->tpl->set_var("MITaxable_LandAV", $this->checkNumericFormat($this->subMITaxableLandAssessedValue));
		$this->tpl->set_var("TITaxable_LandMV", $this->checkNumericFormat($this->subTITaxableLandMarketValue));
		$this->tpl->set_var("TITaxable_LandAV", $this->checkNumericFormat($this->subTITaxableLandAssessedValue));
		$this->tpl->set_var("SPTaxable_LandMV", $this->checkNumericFormat($this->subSPTaxableLandMarketValue));
		$this->tpl->set_var("SPTaxable_LandAV", $this->checkNumericFormat($this->subSPTaxableLandAssessedValue));
		$this->tpl->set_var("HOTaxable_LandMV", $this->checkNumericFormat($this->subHOTaxableLandMarketValue));
		$this->tpl->set_var("HOTaxable_LandAV", $this->checkNumericFormat($this->subHOTaxableLandAssessedValue));
		$this->tpl->set_var("SCTaxable_LandMV", $this->checkNumericFormat($this->subSCTaxableLandMarketValue));
		$this->tpl->set_var("SCTaxable_LandAV", $this->checkNumericFormat($this->subSCTaxableLandAssessedValue));
		$this->tpl->set_var("CUTaxable_LandMV", $this->checkNumericFormat($this->subCUTaxableLandMarketValue));
		$this->tpl->set_var("CUTaxable_LandAV", $this->checkNumericFormat($this->subCUTaxableLandAssessedValue));
		$this->tpl->set_var("OTTaxable_LandMV", $this->checkNumericFormat($this->subOTTaxableLandMarketValue));
		$this->tpl->set_var("OTTaxable_LandAV", $this->checkNumericFormat($this->subOTTaxableLandAssessedValue));
		$this->tpl->set_var("GOExempt_LandMV", $this->checkNumericFormat($this->subGOExemptLandMarketValue));
		$this->tpl->set_var("GOExempt_LandAV", $this->checkNumericFormat($this->subGOExemptLandAssessedValue));
		$this->tpl->set_var("RLExempt_LandMV", $this->checkNumericFormat($this->subRLExemptLandMarketValue));
		$this->tpl->set_var("RLExempt_LandAV", $this->checkNumericFormat($this->subRLExemptLandAssessedValue));
		$this->tpl->set_var("CHExempt_LandMV", $this->checkNumericFormat($this->subCHExemptLandMarketValue));
		$this->tpl->set_var("CHExempt_LandAV", $this->checkNumericFormat($this->subCHExemptLandAssessedValue));
		$this->tpl->set_var("EDExempt_LandMV", $this->checkNumericFormat($this->subEDExemptLandMarketValue));
		$this->tpl->set_var("EDExempt_LandAV", $this->checkNumericFormat($this->subEDExemptLandAssessedValue));
		$this->tpl->set_var("OTExempt_LandMV", $this->checkNumericFormat($this->subOTExemptLandMarketValue));
		$this->tpl->set_var("OTExempt_LandAV", $this->checkNumericFormat($this->subOTExemptLandAssessedValue));
		
		$this->tpl->set_var("RETaxable_BldgLessMV", $this->checkNumericFormat($this->subRETaxableBldgLessMarketValue));
		$this->tpl->set_var("RETaxable_BldgLessAV", $this->checkNumericFormat($this->subRETaxableBldgLessAssessedValue));
		$this->tpl->set_var("AGTaxable_BldgLessMV", $this->checkNumericFormat($this->subAGTaxableBldgLessMarketValue));
		$this->tpl->set_var("AGTaxable_BldgLessAV", $this->checkNumericFormat($this->subAGTaxableBldgLessAssessedValue));
		$this->tpl->set_var("COTaxable_BldgLessMV", $this->checkNumericFormat($this->subCOTaxableBldgLessMarketValue));
		$this->tpl->set_var("COTaxable_BldgLessAV", $this->checkNumericFormat($this->subCOTaxableBldgLessAssessedValue));
		$this->tpl->set_var("INTaxable_BldgLessMV", $this->checkNumericFormat($this->subINTaxableBldgLessMarketValue));
		$this->tpl->set_var("INTaxable_BldgLessAV", $this->checkNumericFormat($this->subINTaxableBldgLessAssessedValue));
		$this->tpl->set_var("MITaxable_BldgLessMV", $this->checkNumericFormat($this->subMITaxableBldgLessMarketValue));
		$this->tpl->set_var("MITaxable_BldgLessAV", $this->checkNumericFormat($this->subMITaxableBldgLessAssessedValue));
		$this->tpl->set_var("TITaxable_BldgLessMV", $this->checkNumericFormat($this->subTITaxableBldgLessMarketValue));
		$this->tpl->set_var("TITaxable_BldgLessAV", $this->checkNumericFormat($this->subTITaxableBldgLessAssessedValue));
		$this->tpl->set_var("SPTaxable_BldgLessMV", $this->checkNumericFormat($this->subSPTaxableBldgLessMarketValue));
		$this->tpl->set_var("SPTaxable_BldgLessAV", $this->checkNumericFormat($this->subSPTaxableBldgLessAssessedValue));
		$this->tpl->set_var("HOTaxable_BldgLessMV", $this->checkNumericFormat($this->subHOTaxableBldgLessMarketValue));
		$this->tpl->set_var("HOTaxable_BldgLessAV", $this->checkNumericFormat($this->subHOTaxableBldgLessAssessedValue));
		$this->tpl->set_var("SCTaxable_BldgLessMV", $this->checkNumericFormat($this->subSCTaxableBldgLessMarketValue));
		$this->tpl->set_var("SCTaxable_BldgLessAV", $this->checkNumericFormat($this->subSCTaxableBldgLessAssessedValue));
		$this->tpl->set_var("CUTaxable_BldgLessMV", $this->checkNumericFormat($this->subCUTaxableBldgLessMarketValue));
		$this->tpl->set_var("CUTaxable_BldgLessAV", $this->checkNumericFormat($this->subCUTaxableBldgLessAssessedValue));
		$this->tpl->set_var("OTTaxable_BldgLessMV", $this->checkNumericFormat($this->subOTTaxableBldgLessMarketValue));
		$this->tpl->set_var("OTTaxable_BldgLessAV", $this->checkNumericFormat($this->subOTTaxableBldgLessAssessedValue));
		$this->tpl->set_var("GOExempt_BldgLessMV", $this->checkNumericFormat($this->subGOExemptBldgLessMarketValue));
		$this->tpl->set_var("GOExempt_BldgLessAV", $this->checkNumericFormat($this->subGOExemptBldgLessAssessedValue));
		$this->tpl->set_var("RLExempt_BldgLessMV", $this->checkNumericFormat($this->subRLExemptBldgLessMarketValue));
		$this->tpl->set_var("RLExempt_BldgLessAV", $this->checkNumericFormat($this->subRLExemptBldgLessAssessedValue));
		$this->tpl->set_var("CHExempt_BldgLessMV", $this->checkNumericFormat($this->subCHExemptBldgLessMarketValue));
		$this->tpl->set_var("CHExempt_BldgLessAV", $this->checkNumericFormat($this->subCHExemptBldgLessAssessedValue));
		$this->tpl->set_var("EDExempt_BldgLessMV", $this->checkNumericFormat($this->subEDExemptBldgLessMarketValue));
		$this->tpl->set_var("EDExempt_BldgLessAV", $this->checkNumericFormat($this->subEDExemptBldgLessAssessedValue));
		$this->tpl->set_var("OTExempt_BldgLessMV", $this->checkNumericFormat($this->subOTExemptBldgLessMarketValue));
		$this->tpl->set_var("OTExempt_BldgLessAV", $this->checkNumericFormat($this->subOTExemptBldgLessAssessedValue));
		
		$this->tpl->set_var("RETaxable_BldgOverMV", $this->checkNumericFormat($this->subRETaxableBldgOverMarketValue));
		$this->tpl->set_var("RETaxable_BldgOverAV", $this->checkNumericFormat($this->subRETaxableBldgOverAssessedValue));
		$this->tpl->set_var("AGTaxable_BldgOverMV", $this->checkNumericFormat($this->subAGTaxableBldgOverMarketValue));
		$this->tpl->set_var("AGTaxable_BldgOverAV", $this->checkNumericFormat($this->subAGTaxableBldgOverAssessedValue));
		$this->tpl->set_var("COTaxable_BldgOverMV", $this->checkNumericFormat($this->subCOTaxableBldgOverMarketValue));
		$this->tpl->set_var("COTaxable_BldgOverAV", $this->checkNumericFormat($this->subCOTaxableBldgOverAssessedValue));
		$this->tpl->set_var("INTaxable_BldgOverMV", $this->checkNumericFormat($this->subINTaxableBldgOverMarketValue));
		$this->tpl->set_var("INTaxable_BldgOverAV", $this->checkNumericFormat($this->subINTaxableBldgOverAssessedValue));
		$this->tpl->set_var("MITaxable_BldgOverMV", $this->checkNumericFormat($this->subMITaxableBldgOverMarketValue));
		$this->tpl->set_var("MITaxable_BldgOverAV", $this->checkNumericFormat($this->subMITaxableBldgOverAssessedValue));
		$this->tpl->set_var("TITaxable_BldgOverMV", $this->checkNumericFormat($this->subTITaxableBldgOverMarketValue));
		$this->tpl->set_var("TITaxable_BldgOverAV", $this->checkNumericFormat($this->subTITaxableBldgOverAssessedValue));
		$this->tpl->set_var("SPTaxable_BldgOverMV", $this->checkNumericFormat($this->subSPTaxableBldgOverMarketValue));
		$this->tpl->set_var("SPTaxable_BldgOverAV", $this->checkNumericFormat($this->subSPTaxableBldgOverAssessedValue));
		$this->tpl->set_var("HOTaxable_BldgOverMV", $this->checkNumericFormat($this->subHOTaxableBldgOverMarketValue));
		$this->tpl->set_var("HOTaxable_BldgOverAV", $this->checkNumericFormat($this->subHOTaxableBldgOverAssessedValue));
		$this->tpl->set_var("SCTaxable_BldgOverMV", $this->checkNumericFormat($this->subSCTaxableBldgOverMarketValue));
		$this->tpl->set_var("SCTaxable_BldgOverAV", $this->checkNumericFormat($this->subSCTaxableBldgOverAssessedValue));
		$this->tpl->set_var("CUTaxable_BldgOverMV", $this->checkNumericFormat($this->subCUTaxableBldgOverMarketValue));
		$this->tpl->set_var("CUTaxable_BldgOverAV", $this->checkNumericFormat($this->subCUTaxableBldgOverAssessedValue));
		$this->tpl->set_var("OTTaxable_BldgOverMV", $this->checkNumericFormat($this->subOTTaxableBldgOverMarketValue));
		$this->tpl->set_var("OTTaxable_BldgOverAV", $this->checkNumericFormat($this->subOTTaxableBldgOverAssessedValue));
		$this->tpl->set_var("GOExempt_BldgOverMV", $this->checkNumericFormat($this->subGOExemptBldgOverMarketValue));
		$this->tpl->set_var("GOExempt_BldgOverAV", $this->checkNumericFormat($this->subGOExemptBldgOverAssessedValue));
		$this->tpl->set_var("RLExempt_BldgOverMV", $this->checkNumericFormat($this->subRLExemptBldgOverMarketValue));
		$this->tpl->set_var("RLExempt_BldgOverAV", $this->checkNumericFormat($this->subRLExemptBldgOverAssessedValue));
		$this->tpl->set_var("CHExempt_BldgOverMV", $this->checkNumericFormat($this->subCHExemptBldgOverMarketValue));
		$this->tpl->set_var("CHExempt_BldgOverAV", $this->checkNumericFormat($this->subCHExemptBldgOverAssessedValue));
		$this->tpl->set_var("EDExempt_BldgOverMV", $this->checkNumericFormat($this->subEDExemptBldgOverMarketValue));
		$this->tpl->set_var("EDExempt_BldgOverAV", $this->checkNumericFormat($this->subEDExemptBldgOverAssessedValue));
		$this->tpl->set_var("OTExempt_BldgOverMV", $this->checkNumericFormat($this->subOTExemptBldgOverMarketValue));
		$this->tpl->set_var("OTExempt_BldgOverAV", $this->checkNumericFormat($this->subOTExemptBldgOverAssessedValue));
		
		$this->tpl->set_var("RETaxable_MachMV", $this->checkNumericFormat($this->subRETaxableMachMarketValue));
		$this->tpl->set_var("RETaxable_MachAV", $this->checkNumericFormat($this->subRETaxableMachAssessedValue));
		$this->tpl->set_var("AGTaxable_MachMV", $this->checkNumericFormat($this->subAGTaxableMachMarketValue));
		$this->tpl->set_var("AGTaxable_MachAV", $this->checkNumericFormat($this->subAGTaxableMachAssessedValue));
		$this->tpl->set_var("COTaxable_MachMV", $this->checkNumericFormat($this->subCOTaxableMachMarketValue));
		$this->tpl->set_var("COTaxable_MachAV", $this->checkNumericFormat($this->subCOTaxableMachAssessedValue));
		$this->tpl->set_var("INTaxable_MachMV", $this->checkNumericFormat($this->subINTaxableMachMarketValue));
		$this->tpl->set_var("INTaxable_MachAV", $this->checkNumericFormat($this->subINTaxableMachAssessedValue));
		$this->tpl->set_var("MITaxable_MachMV", $this->checkNumericFormat($this->subMITaxableMachMarketValue));
		$this->tpl->set_var("MITaxable_MachAV", $this->checkNumericFormat($this->subMITaxableMachAssessedValue));
		$this->tpl->set_var("TITaxable_MachMV", $this->checkNumericFormat($this->subTITaxableMachMarketValue));
		$this->tpl->set_var("TITaxable_MachAV", $this->checkNumericFormat($this->subTITaxableMachAssessedValue));
		$this->tpl->set_var("SPTaxable_MachMV", $this->checkNumericFormat($this->subSPTaxableMachMarketValue));
		$this->tpl->set_var("SPTaxable_MachAV", $this->checkNumericFormat($this->subSPTaxableMachAssessedValue));
		$this->tpl->set_var("HOTaxable_MachMV", $this->checkNumericFormat($this->subHOTaxableMachMarketValue));
		$this->tpl->set_var("HOTaxable_MachAV", $this->checkNumericFormat($this->subHOTaxableMachAssessedValue));
		$this->tpl->set_var("SCTaxable_MachMV", $this->checkNumericFormat($this->subSCTaxableMachMarketValue));
		$this->tpl->set_var("SCTaxable_MachAV", $this->checkNumericFormat($this->subSCTaxableMachAssessedValue));
		$this->tpl->set_var("CUTaxable_MachMV", $this->checkNumericFormat($this->subCUTaxableMachMarketValue));
		$this->tpl->set_var("CUTaxable_MachAV", $this->checkNumericFormat($this->subCUTaxableMachAssessedValue));
		$this->tpl->set_var("OTTaxable_MachMV", $this->checkNumericFormat($this->subOTTaxableMachMarketValue));
		$this->tpl->set_var("OTTaxable_MachAV", $this->checkNumericFormat($this->subOTTaxableMachAssessedValue));
		$this->tpl->set_var("GOExempt_MachMV", $this->checkNumericFormat($this->subGOExemptMachMarketValue));
		$this->tpl->set_var("GOExempt_MachAV", $this->checkNumericFormat($this->subGOExemptMachAssessedValue));
		$this->tpl->set_var("RLExempt_MachMV", $this->checkNumericFormat($this->subRLExemptMachMarketValue));
		$this->tpl->set_var("RLExempt_MachAV", $this->checkNumericFormat($this->subRLExemptMachAssessedValue));
		$this->tpl->set_var("CHExempt_MachMV", $this->checkNumericFormat($this->subCHExemptMachMarketValue));
		$this->tpl->set_var("CHExempt_MachAV", $this->checkNumericFormat($this->subCHExemptMachAssessedValue));
		$this->tpl->set_var("EDExempt_MachMV", $this->checkNumericFormat($this->subEDExemptMachMarketValue));
		$this->tpl->set_var("EDExempt_MachAV", $this->checkNumericFormat($this->subEDExemptMachAssessedValue));
		$this->tpl->set_var("OTExempt_MachMV", $this->checkNumericFormat($this->subOTExemptMachMarketValue));
		$this->tpl->set_var("OTExempt_MachAV", $this->checkNumericFormat($this->subOTExemptMachAssessedValue));
		
		$this->tpl->set_var("RETaxable_OtherMV", $this->checkNumericFormat($this->subRETaxableOtherMarketValue));
		$this->tpl->set_var("RETaxable_OtherAV", $this->checkNumericFormat($this->subRETaxableOtherAssessedValue));
		$this->tpl->set_var("AGTaxable_OtherMV", $this->checkNumericFormat($this->subAGTaxableOtherMarketValue));
		$this->tpl->set_var("AGTaxable_OtherAV", $this->checkNumericFormat($this->subAGTaxableOtherAssessedValue));
		$this->tpl->set_var("COTaxable_OtherMV", $this->checkNumericFormat($this->subCOTaxableOtherMarketValue));
		$this->tpl->set_var("COTaxable_OtherAV", $this->checkNumericFormat($this->subCOTaxableOtherAssessedValue));
		$this->tpl->set_var("INTaxable_OtherMV", $this->checkNumericFormat($this->subINTaxableOtherMarketValue));
		$this->tpl->set_var("INTaxable_OtherAV", $this->checkNumericFormat($this->subINTaxableOtherAssessedValue));
		$this->tpl->set_var("MITaxable_OtherMV", $this->checkNumericFormat($this->subMITaxableOtherMarketValue));
		$this->tpl->set_var("MITaxable_OtherAV", $this->checkNumericFormat($this->subMITaxableOtherAssessedValue));
		$this->tpl->set_var("TITaxable_OtherMV", $this->checkNumericFormat($this->subTITaxableOtherMarketValue));
		$this->tpl->set_var("TITaxable_OtherAV", $this->checkNumericFormat($this->subTITaxableOtherAssessedValue));
		$this->tpl->set_var("SPTaxable_OtherMV", $this->checkNumericFormat($this->subSPTaxableOtherMarketValue));
		$this->tpl->set_var("SPTaxable_OtherAV", $this->checkNumericFormat($this->subSPTaxableOtherAssessedValue));
		$this->tpl->set_var("HOTaxable_OtherMV", $this->checkNumericFormat($this->subHOTaxableOtherMarketValue));
		$this->tpl->set_var("HOTaxable_OtherAV", $this->checkNumericFormat($this->subHOTaxableOtherAssessedValue));
		$this->tpl->set_var("SCTaxable_OtherMV", $this->checkNumericFormat($this->subSCTaxableOtherMarketValue));
		$this->tpl->set_var("SCTaxable_OtherAV", $this->checkNumericFormat($this->subSCTaxableOtherAssessedValue));
		$this->tpl->set_var("CUTaxable_OtherMV", $this->checkNumericFormat($this->subCUTaxableOtherMarketValue));
		$this->tpl->set_var("CUTaxable_OtherAV", $this->checkNumericFormat($this->subCUTaxableOtherAssessedValue));
		$this->tpl->set_var("OTTaxable_OtherMV", $this->checkNumericFormat($this->subOTTaxableOtherMarketValue));
		$this->tpl->set_var("OTTaxable_OtherAV", $this->checkNumericFormat($this->subOTTaxableOtherAssessedValue));
		$this->tpl->set_var("GOExempt_OtherMV", $this->checkNumericFormat($this->subGOExemptOtherMarketValue));
		$this->tpl->set_var("GOExempt_OtherAV", $this->checkNumericFormat($this->subGOExemptOtherAssessedValue));
		$this->tpl->set_var("RLExempt_OtherMV", $this->checkNumericFormat($this->subRLExemptOtherMarketValue));
		$this->tpl->set_var("RLExempt_OtherAV", $this->checkNumericFormat($this->subRLExemptOtherAssessedValue));
		$this->tpl->set_var("CHExempt_OtherMV", $this->checkNumericFormat($this->subCHExemptOtherMarketValue));
		$this->tpl->set_var("CHExempt_OtherAV", $this->checkNumericFormat($this->subCHExemptOtherAssessedValue));
		$this->tpl->set_var("EDExempt_OtherMV", $this->checkNumericFormat($this->subEDExemptOtherMarketValue));
		$this->tpl->set_var("EDExempt_OtherAV", $this->checkNumericFormat($this->subEDExemptOtherAssessedValue));
		$this->tpl->set_var("OTExempt_OtherMV", $this->checkNumericFormat($this->subOTExemptOtherMarketValue));
		$this->tpl->set_var("OTExempt_OtherAV", $this->checkNumericFormat($this->subOTExemptOtherAssessedValue));
		
		$this->tpl->set_var("RETaxable_TotalMV", $this->checkNumericFormat($this->totalRETaxableMarketValue));
		$this->tpl->set_var("RETaxable_TotalAV", $this->checkNumericFormat($this->totalRETaxableAssessedValue));
		$this->tpl->set_var("AGTaxable_TotalMV", $this->checkNumericFormat($this->totalAGTaxableMarketValue));
		$this->tpl->set_var("AGTaxable_TotalAV", $this->checkNumericFormat($this->totalAGTaxableAssessedValue));
		$this->tpl->set_var("COTaxable_TotalMV", $this->checkNumericFormat($this->totalCOTaxableMarketValue));
		$this->tpl->set_var("COTaxable_TotalAV", $this->checkNumericFormat($this->totalCOTaxableAssessedValue));
		$this->tpl->set_var("INTaxable_TotalMV", $this->checkNumericFormat($this->totalINTaxableMarketValue));
		$this->tpl->set_var("INTaxable_TotalAV", $this->checkNumericFormat($this->totalINTaxableAssessedValue));
		$this->tpl->set_var("MITaxable_TotalMV", $this->checkNumericFormat($this->totalMITaxableMarketValue));
		$this->tpl->set_var("MITaxable_TotalAV", $this->checkNumericFormat($this->totalMITaxableAssessedValue));
		$this->tpl->set_var("TITaxable_TotalMV", $this->checkNumericFormat($this->totalTITaxableMarketValue));
		$this->tpl->set_var("TITaxable_TotalAV", $this->checkNumericFormat($this->totalTITaxableAssessedValue));
		$this->tpl->set_var("SPTaxable_TotalMV", $this->checkNumericFormat($this->totalSPTaxableMarketValue));
		$this->tpl->set_var("SPTaxable_TotalAV", $this->checkNumericFormat($this->totalSPTaxableAssessedValue));
		$this->tpl->set_var("HOTaxable_TotalMV", $this->checkNumericFormat($this->totalHOTaxableMarketValue));
		$this->tpl->set_var("HOTaxable_TotalAV", $this->checkNumericFormat($this->totalHOTaxableAssessedValue));
		$this->tpl->set_var("SCTaxable_TotalMV", $this->checkNumericFormat($this->totalSCTaxableMarketValue));
		$this->tpl->set_var("SCTaxable_TotalAV", $this->checkNumericFormat($this->totalSCTaxableAssessedValue));
		$this->tpl->set_var("CUTaxable_TotalMV", $this->checkNumericFormat($this->totalCUTaxableMarketValue));
		$this->tpl->set_var("CUTaxable_TotalAV", $this->checkNumericFormat($this->totalCUTaxableAssessedValue));
		$this->tpl->set_var("OTTaxable_TotalMV", $this->checkNumericFormat($this->totalOTTaxableMarketValue));
		$this->tpl->set_var("OTTaxable_TotalAV", $this->checkNumericFormat($this->totalOTTaxableAssessedValue));
		$this->tpl->set_var("GOExempt_TotalMV", $this->checkNumericFormat($this->totalGOExemptMarketValue));
		$this->tpl->set_var("GOExempt_TotalAV", $this->checkNumericFormat($this->totalGOExemptAssessedValue));
		$this->tpl->set_var("RLExempt_TotalMV", $this->checkNumericFormat($this->totalRLExemptMarketValue));
		$this->tpl->set_var("RLExempt_TotalAV", $this->checkNumericFormat($this->totalRLExemptAssessedValue));
		$this->tpl->set_var("CHExempt_TotalMV", $this->checkNumericFormat($this->totalCHExemptMarketValue));
		$this->tpl->set_var("CHExempt_TotalAV", $this->checkNumericFormat($this->totalCHExemptAssessedValue));
		$this->tpl->set_var("EDExempt_TotalMV", $this->checkNumericFormat($this->totalEDExemptMarketValue));
		$this->tpl->set_var("EDExempt_TotalAV", $this->checkNumericFormat($this->totalEDExemptAssessedValue));
		$this->tpl->set_var("OTExempt_TotalMV", $this->checkNumericFormat($this->totalOTExemptMarketValue));
		$this->tpl->set_var("OTExempt_TotalAV", $this->checkNumericFormat($this->totalOTExemptAssessedValue));
		
		$this->tpl->set_var("Taxable_RealPropertyUnits", $this->checkNumericFormat($this->totalTaxableRealPropertyUnits));
		$this->tpl->set_var("Taxable_LandArea", $this->checkNumericFormat($this->totalTaxableLandArea));
		$this->tpl->set_var("Taxable_LandMV", $this->checkNumericFormat($this->totalTaxableLandMarketValue));
		$this->tpl->set_var("Taxable_LandAV", $this->checkNumericFormat($this->totalTaxableLandAssessedValue));
		$this->tpl->set_var("Taxable_BldgLessMV", $this->checkNumericFormat($this->totalTaxableBldgLessMarketValue));
		$this->tpl->set_var("Taxable_BldgLessAV", $this->checkNumericFormat($this->totalTaxableBldgLessAssessedValue));
		$this->tpl->set_var("Taxable_BldgOverMV", $this->checkNumericFormat($this->totalTaxableBldgOverMarketValue));
		$this->tpl->set_var("Taxable_BldgOverAV", $this->checkNumericFormat($this->totalTaxableBldgOverAssessedValue));
		$this->tpl->set_var("Taxable_MachMV", $this->checkNumericFormat($this->totalTaxableMachMarketValue));
		$this->tpl->set_var("Taxable_MachAV", $this->checkNumericFormat($this->totalTaxableMachAssessedValue));
		$this->tpl->set_var("Taxable_OtherMV", $this->checkNumericFormat($this->totalTaxableOtherMarketValue));
		$this->tpl->set_var("Taxable_OtherAV", $this->checkNumericFormat($this->totalTaxableOtherAssessedValue));
		$this->tpl->set_var("Taxable_TotalMV", $this->checkNumericFormat($this->totalTaxableMarketValue));
		$this->tpl->set_var("Taxable_TotalAV", $this->checkNumericFormat($this->totalTaxableAssessedValue));
		
		$this->tpl->set_var("Exempt_RealPropertyUnits", $this->checkNumericFormat($this->totalExemptRealPropertyUnits));
		$this->tpl->set_var("Exempt_LandArea", $this->checkNumericFormat($this->totalExemptLandArea));
		$this->tpl->set_var("Exempt_LandMV", $this->checkNumericFormat($this->totalExemptLandMarketValue));
		$this->tpl->set_var("Exempt_LandAV", $this->checkNumericFormat($this->totalExemptLandAssessedValue));
		$this->tpl->set_var("Exempt_BldgLessMV", $this->checkNumericFormat($this->totalExemptBldgLessMarketValue));
		$this->tpl->set_var("Exempt_BldgLessAV", $this->checkNumericFormat($this->totalExemptBldgLessAssessedValue));
		$this->tpl->set_var("Exempt_BldgOverMV", $this->checkNumericFormat($this->totalExemptBldgOverMarketValue));
		$this->tpl->set_var("Exempt_BldgOverAV", $this->checkNumericFormat($this->totalExemptBldgOverAssessedValue));
		$this->tpl->set_var("Exempt_MachMV", $this->checkNumericFormat($this->totalExemptMachMarketValue));
		$this->tpl->set_var("Exempt_MachAV", $this->checkNumericFormat($this->totalExemptMachAssessedValue));
		$this->tpl->set_var("Exempt_OtherMV", $this->checkNumericFormat($this->totalExemptOtherMarketValue));
		$this->tpl->set_var("Exempt_OtherAV", $this->checkNumericFormat($this->totalExemptOtherAssessedValue));
		$this->tpl->set_var("Exempt_TotalMV", $this->checkNumericFormat($this->totalExemptMarketValue));
		$this->tpl->set_var("Exempt_TotalAV", $this->checkNumericFormat($this->totalExemptAssessedValue));
		
		$this->tpl->set_var("TOTAL_RealPropertyUnits", $this->checkNumericFormat($this->totalRealPropertyUnits));
		$this->tpl->set_var("TOTAL_LandArea", $this->checkNumericFormat($this->totalLandArea));
		$this->tpl->set_var("TOTAL_LandMV", $this->checkNumericFormat($this->totalLandMarketValue));
		$this->tpl->set_var("TOTAL_LandAV", $this->checkNumericFormat($this->totalLandAssessedValue));
		$this->tpl->set_var("TOTAL_BldgLessMV", $this->checkNumericFormat($this->totalBldgLessMarketValue));
		$this->tpl->set_var("TOTAL_BldgLessAV", $this->checkNumericFormat($this->totalBldgLessAssessedValue));
		$this->tpl->set_var("TOTAL_BldgOverMV", $this->checkNumericFormat($this->totalBldgOverMarketValue));
		$this->tpl->set_var("TOTAL_BldgOverAV", $this->checkNumericFormat($this->totalBldgOverAssessedValue));
		$this->tpl->set_var("TOTAL_MachMV", $this->checkNumericFormat($this->totalMachMarketValue));
		$this->tpl->set_var("TOTAL_MachAV", $this->checkNumericFormat($this->totalMachAssessedValue));
		$this->tpl->set_var("TOTAL_OtherMV", $this->checkNumericFormat($this->totalOtherMarketValue));
		$this->tpl->set_var("TOTAL_OtherAV", $this->checkNumericFormat($this->totalOtherAssessedValue));
		$this->tpl->set_var("TOTAL_TotalMV", $this->checkNumericFormat($this->totalMarketValue));
		$this->tpl->set_var("TOTAL_TotalAV", $this->checkNumericFormat($this->totalAssessedValue));
		
		$this->tpl->parse("templatePage", "rptsTemplate");
		$this->tpl->finish("templatePage");
		$this->tpl->p("templatePage");
	}
	function checkNumericFormat($numero){
		$numero = (is_numeric($numero)) ? number_format($numero, 0, '.', ','): $numero;
		return $numero;
	}
	
	function computeProperty($column,$sql){
		$db = new DB_SelectLGU($this->dbName);
		$db->query($sql);
		while ($db->next_record()) {
			$code = $db->f("code");
			switch ($code){
				case "RE":
					$this->totalRETaxableMarketValue += $db->f("marketValue");
					eval('$this->totalTaxable'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subRETaxable'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalRETaxableAssessedValue += $db->f("assessedValue");
					eval('$this->totalTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subRETaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalTaxableMarketValue += $db->f("marketValue");
					$this->totalTaxableAssessedValue += $db->f("assessedValue");
					break;
				case "AG":
					$this->totalAGTaxableMarketValue += $db->f("marketValue");
					eval('$this->totalTaxable'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subAGTaxable'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalAGTaxableAssessedValue += $db->f("assessedValue");
					eval('$this->totalTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subAGTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalTaxableMarketValue += $db->f("marketValue");
					$this->totalTaxableAssessedValue += $db->f("assessedValue");
					break;
				case "CO":
					$this->totalCOTaxableMarketValue += $db->f("marketValue");
					eval('$this->totalTaxable'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subCOTaxable'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalCOTaxableAssessedValue += $db->f("assessedValue");
					eval('$this->totalTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subCOTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalTaxableMarketValue += $db->f("marketValue");
					$this->totalTaxableAssessedValue += $db->f("assessedValue");
					break;
				case "IN":
					$this->totalINTaxableMarketValue += $db->f("marketValue");
					eval('$this->totalTaxable'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subINTaxable'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalINTaxableAssessedValue += $db->f("assessedValue");
					eval('$this->totalTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subINTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalTaxableMarketValue += $db->f("marketValue");
					$this->totalTaxableAssessedValue += $db->f("assessedValue");
					break;
				case "MI":
					$this->totalMITaxableMarketValue += $db->f("marketValue");
					eval('$this->totalTaxable'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subMITaxable'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalMITaxableAssessedValue += $db->f("assessedValue");
					eval('$this->totalTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subMITaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalTaxableMarketValue += $db->f("marketValue");
					$this->totalTaxableAssessedValue += $db->f("assessedValue");
					break;
				case "TI":
					$this->totalTITaxableMarketValue += $db->f("marketValue");
					eval('$this->totalTaxable'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subTITaxable'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalTITaxableAssessedValue += $db->f("assessedValue");
					eval('$this->totalTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subTITaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalTaxableMarketValue += $db->f("marketValue");
					$this->totalTaxableAssessedValue += $db->f("assessedValue");
					break;
				case "SP":
					$this->totalSPTaxableMarketValue += $db->f("marketValue");
					eval('$this->totalTaxable'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subSPTaxable'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalSPTaxableAssessedValue += $db->f("assessedValue");
					eval('$this->totalTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subSPTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalTaxableMarketValue += $db->f("marketValue");
					$this->totalTaxableAssessedValue += $db->f("assessedValue");
					break;
				case "HO":
					$this->totalHOTaxableMarketValue += $db->f("marketValue");
					eval('$this->totalTaxable'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subHOTaxable'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalHOTaxableAssessedValue += $db->f("assessedValue");
					eval('$this->totalTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subHOTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalTaxableMarketValue += $db->f("marketValue");
					$this->totalTaxableAssessedValue += $db->f("assessedValue");
					break;
				case "SC":
					$this->totalSCTaxableMarketValue += $db->f("marketValue");
					eval('$this->totalTaxable'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subSCTaxable'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalSCTaxableAssessedValue += $db->f("assessedValue");
					eval('$this->totalTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subSCTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalTaxableMarketValue += $db->f("marketValue");
					$this->totalTaxableAssessedValue += $db->f("assessedValue");
					break;
				case "CU":
					$this->totalCUTaxableMarketValue += $db->f("marketValue");
					eval('$this->totalTaxable'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subCUTaxable'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalCUTaxableAssessedValue += $db->f("assessedValue");
					eval('$this->totalTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subCUTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalTaxableMarketValue += $db->f("marketValue");
					$this->totalTaxableAssessedValue += $db->f("assessedValue");
					break;
				case "OTX":
					$this->totalOTTaxableMarketValue += $db->f("marketValue");
					eval('$this->totalTaxable'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subOTTaxable'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalOTTaxableAssessedValue += $db->f("assessedValue");
					eval('$this->totalTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subOTTaxable'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalTaxableMarketValue += $db->f("marketValue");
					$this->totalTaxableAssessedValue += $db->f("assessedValue");
					break;
				case "GO":
					$this->totalGOExemptMarketValue += $db->f("marketValue");
					eval('$this->totalExempt'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subGOExempt'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalGOExemptAssessedValue += $db->f("assessedValue");
					eval('$this->totalExempt'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subGOExempt'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalExemptMarketValue += $db->f("marketValue");
					$this->totalExemptAssessedValue += $db->f("assessedValue");
					break;
				case "RL":
					$this->totalRLExemptMarketValue += $db->f("marketValue");
					eval('$this->totalExempt'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subRLExempt'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalRLExemptAssessedValue += $db->f("assessedValue");
					eval('$this->totalExempt'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subRLExempt'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalExemptMarketValue += $db->f("marketValue");
					$this->totalExemptAssessedValue += $db->f("assessedValue");
					break;
				case "CH":
					$this->totalCHExemptMarketValue += $db->f("marketValue");
					eval('$this->totalExempt'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subCHExempt'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalCHExemptAssessedValue += $db->f("assessedValue");
					eval('$this->totalExempt'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subCHExempt'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalExemptMarketValue += $db->f("marketValue");
					$this->totalExemptAssessedValue += $db->f("assessedValue");
					break;
				case "ED":
					$this->totalEDExemptMarketValue += $db->f("marketValue");
					eval('$this->totalExempt'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subEDExempt'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalEDExemptAssessedValue += $db->f("assessedValue");
					eval('$this->totalExempt'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subEDExempt'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalExemptMarketValue += $db->f("marketValue");
					$this->totalExemptAssessedValue += $db->f("assessedValue");
					break;
				case "OTE":
					$this->totalOTExemptMarketValue += $db->f("marketValue");
					eval('$this->totalExempt'.$column.'MarketValue += $db->f("marketValue");');
					eval('$this->subOTExempt'.$column.'MarketValue += $db->f("marketValue");');
					$this->totalOTExemptAssessedValue += $db->f("assessedValue");
					eval('$this->totalExempt'.$column.'AssessedValue += $db->f("assessedValue");');
					eval('$this->subOTExempt'.$column.'AssessedValue += $db->f("assessedValue");');
					$this->totalExemptMarketValue += $db->f("marketValue");
					$this->totalExemptAssessedValue += $db->f("assessedValue");
					break;
			}
			if($column == "Land"){
				switch ($code){
					case "RE":
					case "AG":
					case "CO":
					case "IN":
					case "MI":
					case "TI":
					case "SP":
					case "HO":
					case "SC":
					case "CU":
					case "OTX":
						$this->totalTaxableRealPropertyUnits += $db->f("rpu");
						$this->totalTaxableLandArea += $db->f("area");
						eval('$this->sub'.$code.'TaxableRealPropertyUnits += $db->f("rpu");');
						eval('$this->sub'.$code.'TaxableLandArea += $db->f("area");');
						break;
					case "GO":
					case "RL":
					case "CH":
					case "ED":
					case "OTE":
						$this->totalExemptRealPropertyUnits += $db->f("rpu");
						$this->totalExemptLandArea += $db->f("area");
						eval('$this->sub'.$code.'ExemptRealPropertyUnits += $db->f("rpu");');
						eval('$this->sub'.$code.'ExemptLandArea += $db->f("area");');
						break;
				}
				$this->totalRealPropertyUnits += $db->f("rpu");
				$this->totalLandArea += $db->f("area");
			}
			eval('$this->total'.$column.'MarketValue += $db->f("marketValue");');
			eval('$this->total'.$column.'AssessedValue += $db->f("assessedValue");');
			$this->totalMarketValue += $db->f("marketValue");
			$this->totalAssessedValue += $db->f("assessedValue");
		}
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
$obj = new SummaryReport($sess);
$obj->Main();
?>
<?php page_close(); ?>