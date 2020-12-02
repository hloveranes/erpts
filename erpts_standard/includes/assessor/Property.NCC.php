<?php
class Property
{
	//attributes
	var $propertyID;
	var $afsID;
	var $arpNumber;
	var $propertyIndexNumber;
	var $propertyAdministrator;
	//var $verifiedByID;
	//var $verifiedBy;
	//var $plottingsByID;
	var $plottingsBy;
	//var $notedByID;
	var $notedBy;
	var $marketValue;
	var $kind;
	var $actualUse;
	var $valueAdjustment;
	var $adjustedMarketValue;
	var $assessmentLevel;
	var $assessedValue;
	var $previousOwner;
	var $previousAssessedValue;
	var $taxability;
	var $effectivity;
	//var $appraisedByID;
	var $appraisedBy;
	var $appraisedByDate;
	//var $recommendingApprovalID;
	var $recommendingApproval;
	var $recommendingApprovalDate;
	//var $approvedByID;
	var $approvedBy;
	var $approvedByDate;
	var $memoranda;
	var $postingDate;
	var $domDocument;
	//var $db;
	//constructor
	function Property(){
	}
	
	//db
	function setDB(){
		$this->db = new DB_RPTS;
	}
	
	//set
	function setPropertyID($tempVar){
		$this->propertyID = $tempVar;
	}
	function setAfsID($tempVar){
		$this->afsID = $tempVar;
	}
	function setArpNumber($tempVar){
		$this->arpNumber = $tempVar;
	}
	function setPropertyIndexNumber($tempVar){
		$this->propertyIndexNumber = $tempVar;
	}
	function setPropertyAdministrator($tempVar){
		$this->propertyAdministrator = $tempVar;
	}
	function setVerifiedByID($tempVar){
		$this->verifiedByID = $tempVar;
	}
	function setVerifiedBy($tempVar){
		$this->verifiedBy = $tempVar;
	}
	function setPlottingsByID($tempVar){
		$this->plottingsByID = $tempVar;
	}
	function setPlottingsBy($tempVar){
		$this->plottingsBy = $tempVar;
	}
	function setNotedByID($tempVar){
		$this->notedByID = $tempVar;
	}
	function setNotedBy($tempVar){
		$this->notedBy = $tempVar;
	}
	function setMarketValue($tempVar){
		$this->marketValue = str_replace(',','',$tempVar);
	}
	function setKind($tempVar){
		$this->kind = $tempVar;
	}
	function setActualUse($tempVar){
		$this->actualUse = $tempVar;
	}
	function setAdjustedMarketValue($tempVar){
		$this->adjustedMarketValue = str_replace(',','',$tempVar);
	}
	function setValueAdjustment($tempVar){
		$this->valueAdjustment = str_replace(',','',$tempVar);
	}
	function setAssessmentLevel($tempVar){
		$this->assessmentLevel = $tempVar;
	}
	function setAssessedValue($tempVar){
		$this->assessedValue = str_replace(',','',$tempVar);
	}
	function setPreviousOwner($tempVar){
		$this->previousOwner = $tempVar;
	}
	function setPreviousAssessedValue($tempVar){
		$this->previousAssessedValue = $tempVar;
	}
	function setTaxability($tempVar){
		$this->taxability = $tempVar;
	}
	function setEffectivity($tempVar){
		$this->effectivity = $tempVar;
	}
	//function setAppraisedByID($tempVar){
	//	$this->appraisedByID = $tempVar;
	//}
	function setAppraisedBy($tempVar){
		$this->appraisedBy = $tempVar;
	}
	function setAppraisedByDate($tempVar){
		$this->appraisedByDate = $tempVar;
	}
	function setRecommendingApproval($tempVar){
		$this->recommendingApproval = $tempVar;
	}
	function setRecommendingApprovalID($tempVar){
		$this->recommendingApprovalID = $tempVar;
	}
	function setRecommendingApprovalDate($tempVar){
		$this->recommendingApprovalDate = $tempVar;
	}
	function setApprovedByID($tempVar){
		$this->approvedByID = $tempVar;
	}
	function setApprovedBy($tempVar){
		$this->approvedBy = $tempVar;
	}
	function setApprovedByDate($tempVar){
		$this->approvedByDate = $tempVar;
	}
	function setMemoranda($tempVar){
		$this->memoranda = $tempVar;
	}
	function setPostingDate($tempVar){
		$this->postingDate = $tempVar;
	}
	
	//dom
	function setDomProperty (){
	}
	function parseDomDocument(){
	}
	function getDomDocument(){
	}
	
	//get
	function getPropertyID(){
		return $this->propertyID;
	}
	function getAfsID(){
		return $this->afsID;
	}
	function getArpNumber(){
		return $this->arpNumber;
	}
	function getPropertyIndexNumber(){
		return $this->propertyIndexNumber;
	}
	function getPropertyAdministrator(){
		return $this->propertyAdministrator;
	}
	function getVerifiedByID(){
		return $this->verifiedByID;
	}
	function getVerifiedBy(){
		return $this->verifiedBy;
	}
	function getPlottingsByID(){
		return $this->plottingsByID;
	}
	function getPlottingsBy(){
		return $this->plottingsBy;
	}
	function getNotedByID(){
		return $this->notedByID;
	}
	function getNotedBy(){
		return $this->notedBy;
	}
	function getMarketValue(){
		return $this->marketValue;
	}
	function getKind(){
		return $this->kind;
	}
	function getActualUse(){
		return $this->actualUse;
	}
	function getAdjustedMarketValue(){
		return $this->adjustedMarketValue;
	}
	function getValueAdjustment(){
		return $this->valueAdjustment;
	}
	function getAssessmentLevel(){
		return $this->assessmentLevel;
	}
	function getAssessedValue(){
		//if is_numeric($this->assessedValue) 
			return number_format($this->assessedValue, 2, '.', ',');
		//else 
		//	return $this->assessedValue;
	}
	function getPreviousOwner(){
		return $this->previousOwner;
	}
	function getPreviousAssessedValue(){
		return $this->previousAssessedValue;
	}
	function getTaxability(){
		return $this->taxability;
	}
	function getEffectivity(){
		return $this->effectivity;
	}
	//function getAppraisedBy(){
	//	return $this->appraisedBy;
	//}
	function getAppraisedByDate(){
		return $this->appraisedByDate;
	}
	function getRecommendingApproval(){
		return $this->recommendingApproval;
	}
	function getRecommendingApprovalDate(){
		return $this->recommendingApprovalDate;
	}
	function getApprovedBy(){
		return $this->approvedBy;
	}
	function getApprovedByDate(){
		return $this->approvedByDate;
	}
	function getMemoranda(){
		return $this->memoranda;
	}
	function getPostingDate(){
		return $this->postingDate;
	}

	//db methods
	function selectRecord(){
	}
	function insertRecord(){
	}
	function updateRecord(){
	}
	function deleteRecord(){
	}
}
?>