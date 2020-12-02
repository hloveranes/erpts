<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/Address.php";
include_once "../assessor/Person.php";
include_once "../assessor/Assessor.php";
include_once "../assessor/AssessorRecords.php";
include_once "../assessor/Land.php";
#####################################
# Define Interface Class
#####################################
class LandDetails{
	
	var $tpl;
	var $formArray;
	var $land;
	var $assessorList;
	
	function LandDetails($http_post_vars,$afsID="",$propertyID="",$formAction="",$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "LandDetails.htm") ;
		$this->tpl->set_var("TITLE", "Encode Land");
		
		$this->formArray = array(
			"afsID" => $afsID
			, "propertyID" => $propertyID
			, "arpNumber" => ""
			, "propertyIndexNumber" => ""
			, "propertyAdministrator" => ""
			, "personID" => ""
			, "lastName" => ""
			, "firstName" => ""
			, "middleName" => ""
			, "gender" => ""
			, "birth_month" => date("n")
			, "birth_day" => date("j")
			, "birth_year" => date("Y")
			, "maritalStatus" => ""
			, "tin" => ""
			, "addressID" => ""
			, "number" => ""
			, "street" => ""
			, "barangay" => ""
			, "district" => ""
			, "municipalityCity" => ""
			, "province" => ""
			, "telephone" => ""
			, "mobileNumber" => ""
			, "email" => ""
			, "verifiedByID" => ""
			, "verifiedBy" => ""
			, "verifiedByName" => ""
			, "plottingsByID" => ""
			, "plottingsBy" => ""
			, "plottingsByName" => ""
			, "notedByID" => ""
			, "notedBy" => ""
			, "notedByName" => ""
			, "marketValue" => ""
			, "kind" => ""
			, "actualUse" => ""
			, "adjustedMarketValue" => ""
			, "assessmentLevel" => ""
			, "assessedValue" => ""
			, "previousOwner" => ""
			, "previousAssessedValue" => ""
			, "taxability" => ""
			, "effectivity" => ""
			, "appraisedByID" => ""
			, "appraisedBy" => ""
			, "appraisedByName" => ""
			, "appraisedByDate" => ""
			, "recommendingApprovalID" => ""
			, "recommendingApproval" => ""
			, "recommendingApprovalName" => ""
			, "recommendingApprovalDate" => ""
			, "approvedByID" => ""
			, "approvedBy" => ""
			, "approvedByName" => ""
			, "approvedByDate" => ""
			, "memoranda" => ""
			, "postingDate" => ""
			, "octTctNumber" => ""
			, "surveyNumber" => ""
			, "north" => ""
			, "east" => ""
			, "south" => ""
			, "west" => ""
			, "classification" => ""
			, "subClass" => ""
			, "area" => ""
			, "unitValue" => ""
			, "adjustmentFactor" => ""
			, "percentAdjustment" => ""
			, "valueAdjustment" => ""
			//, "ve_month" => date("n")
			//, "ve_day" => date("j")
			//, "ve_year" => date("Y")
			//, "pl_month" => date("n")
			//, "pl_day" => date("j")
			//, "pl_year" => date("Y")
			//, "no_month" => date("n")
			//, "no_day" => date("j")
			//, "no_year" => date("Y")
			, "as_month" => date("n")
			, "as_day" => date("j")
			, "as_year" => date("Y")
			, "re_month" => date("n")
			, "re_day" => date("j")
			, "re_year" => date("Y")
			, "av_month" => date("n")
			, "av_day" => date("j")
			, "av_year" => date("Y")
			, "formAction" => $formAction
		);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
			//echo $key." = ".$this->formArray[$key]."<br>";
		}
		
		$as_dateStr = $this->formArray["as_year"]."-".putPreZero($this->formArray["as_month"])."-".putPreZero($this->formArray["as_day"]);
		$this->formArray["appraisedByDate"] = $as_dateStr;
		$re_dateStr = $this->formArray["re_year"]."-".putPreZero($this->formArray["re_month"])."-".putPreZero($this->formArray["re_day"]);
		$this->formArray["recommendingApprovalDate"] = $re_dateStr;
		$av_dateStr = $this->formArray["av_year"]."-".putPreZero($this->formArray["av_month"])."-".putPreZero($this->formArray["av_day"]);
		$this->formArray["approvedByDate"] = $av_dateStr;
		
		$AssessorList = new SoapObject(NCCBIZ."AssessorList.php", "urn:Object");
		if (!$xmlStr = $AssessorList->getAssessorList()){
			$this->tpl->set_block("rptsTemplate", "Dropdown", "DropdownBlock");
			$this->tpl->set_var("DropdownBlock", "page not found");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
	 			$this->tpl->set_block("rptsTemplate", "Dropdown", "DropdownBlock");
				$this->tpl->set_var("DropdownBlock", "error xmlDoc");
			}
			else {
				$assessorRecords = new AssessorRecords;
				$assessorRecords->parseDomDocument($domDoc);
				$this->assessorList = $assessorRecords->getArrayList();
			}
		}
	}
	
	function getAssessor($assessorID){
		$ret = false;
		if (count($this->assessorList)){
			foreach($this->assessorList as $key => $value){
				$ret = ($value->getAssessorID()==$assessorID)? $value : false;
				if ($ret) break;
			}
		}
		//echo "ret=".$ret;
		return $ret;
	}
	function initSelected($tempVar,$compareTo,$actionStr="selected"){
		if ($this->formArray[$tempVar] == $compareTo){
			$this->tpl->set_var($tempVar."_sel", $actionStr);
		}
		else{
			$this->tpl->set_var($tempVar."_sel", "");
		}
	}
	
	function setDateDropDown($type){
		$startYear = 1900;
		$endYear = date("Y");
		$this->tpl->set_block("rptsTemplate", $type."YearList", $type."YearListBlock");
		for($i = $startYear; $i<=$endYear; $i++){
			$this->tpl->set_var($type."yearValue", $i);
			$this->initSelected($type."year",$i);
			$this->tpl->parse($type."YearListBlock", $type."YearList", true);
		}
		
		eval(MONTH_ARRAY);//$monthArray
		$this->tpl->set_block("rptsTemplate", $type."MonthList", $type."MonthListBlock");
		foreach($monthArray as $key => $value){
			$this->tpl->set_var($type."monthValue", $key);
			$this->tpl->set_var($type."month", $value);
			$this->initSelected($type."month",$key);
			$this->tpl->parse($type."MonthListBlock", $type."MonthList", true);
		}
		$this->tpl->set_block("rptsTemplate", $type."DayList", $type."DayListBlock");
		for($i = 1; $i<=28; $i++){
			$this->tpl->set_var($type."dayValue", $i);
			$this->initSelected($type."day",$i);
			$this->tpl->parse($type."DayListBlock", $type."DayList", true);
		}
	}
	
	function setDateDisplay($type){
		$this->tpl->set_var($type."yearValue", $this->formArray[$type."year"]);
		eval(MONTH_ARRAY);//$monthArray
		$this->tpl->set_var($type."month", $monthArray[$this->formArray[$type."month"]]);
		$this->tpl->set_var($type."dayValue", $this->formArray[$type."day"]);
	}
	function setForm(){
		/*
		if (count($this->assessorList)){
			$this->tpl->set_block("rptsTemplate", "verifiedBy", "verifiedByBlock");
			$this->tpl->set_block("rptsTemplate", "plottingsBy", "plottingsByBlock");
			$this->tpl->set_block("rptsTemplate", "notedBy", "notedByBlock");
			$this->tpl->set_block("rptsTemplate", "appraisedBy", "appraisedByBlock");
			$this->tpl->set_block("rptsTemplate", "recommendingApproval", "recommendingApprovalBlock");
			$this->tpl->set_block("rptsTemplate", "approvedBy", "approvedByBlock");
			foreach ($this->assessorList as $key => $value){
				$this->tpl->set_var("id", $value->getAssessorID());
				$this->tpl->set_var("name", $value->getFullName());
				$this->initSelected("verifiedByID",$value->getAssessorID());
				$this->initSelected("plottingsByID",$value->getAssessorID());
				$this->initSelected("notedByID",$value->getAssessorID());
				$this->initSelected("appraisedByID",$value->getAssessorID());
				$this->initSelected("recommendingApprovalID",$value->getAssessorID());
				$this->initSelected("approvedByID",$value->getAssessorID());
				$this->tpl->parse("verifiedByBlock", "verifiedBy", true);
				$this->tpl->parse("plottingsByBlock", "plottingsBy", true);
				$this->tpl->parse("notedByBlock", "notedBy", true);
				$this->tpl->parse("appraisedByBlock", "appraisedBy", true);
				$this->tpl->parse("recommendingApprovalBlock", "recommendingApproval", true);
				$this->tpl->parse("approvedByBlock", "approvedBy", true);
			}
		}
		else{
			$this->tpl->set_block("rptsTemplate", "ODList", "ODListBlock");
			$this->tpl->set_var("ODListBlock", "huh");
		}
		*/
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
		//$this->setDateDropDown("ve_");
		//$this->setDateDropDown("pl_");
		//$this->setDateDropDown("no_");
		$this->setDateDisplay("as_");
		$this->setDateDisplay("re_");
		$this->setDateDisplay("av_");
	}
	
	function Main(){
		$LandDetails = new SoapObject(NCCBIZ."LandDetails.php", "urn:Object");
		if (!$xmlStr = $LandDetails->getLand($this->formArray["propertyID"])){
			echo ("xml failed");
		}
		else{
			//echo $xmlStr;
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
				$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
			}
			else {
				$land = new Land;
				$land->parseDomDocument($domDoc);
				foreach($land as $key => $value){
					switch ($key){
						case "propertyAdministrator":
							if (is_a($value,Person)){
								list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value->getBirthday());
								$this->formArray["personID"] = $value->getPersonID();
								$this->formArray["lastName"] = $value->getLastName();
								$this->formArray["firstName"] = $value->getFirstName();
								$this->formArray["middleName"] = $value->getMiddleName();
								$this->formArray["gender"] = $value->getGender();
								$this->formArray["birth_year"] = removePreZero($dateArr["year"]);
								$this->formArray["birth_month"] = removePreZero($dateArr["month"]);
								$this->formArray["birth_day"] = removePreZero($dateArr["day"]);
								$this->formArray["maritalStatus"] = $value->getMaritalStatus();
								$this->formArray["tin"] = $value->getTin();
								$this->formArray["addressID"] = $value->addressArray[0]->getAddressID();
								$this->formArray["number"] = $value->addressArray[0]->getNumber();
								$this->formArray["street"] = $value->addressArray[0]->getStreet();
								$this->formArray["barangay"] = $value->addressArray[0]->getBarangay();
								$this->formArray["district"] = $value->addressArray[0]->getDistrict();
								$this->formArray["municipalityCity"] = $value->addressArray[0]->getMunicipalityCity();
								$this->formArray["province"] = $value->addressArray[0]->getProvince();
								$this->formArray["telephone"] = $value->getTelephone();
								$this->formArray["mobileNumber"] = $value->getMobileNumber();
								$this->formArray["email"] = $value->getEmail();
							}
							else {
								$this->formArray[$key] = "";
							}
						break;
						case "verifiedBy":
							if (is_a($value,Assessor)){
								$this->formArray["verifiedByID"] = $value->getAssessorID();
								$this->formArray["verifiedByName"] = $value->getFullName();
							}
							else {
								$this->formArray[$key] = "";
							}
						break;
						case "plottingsBy":
							if (is_a($value,Assessor)){
								$this->formArray["plottingsByID"] = $value->getAssessorID();
								$this->formArray["plottingsByName"] = $value->getFullName();
							}
							else {
								$this->formArray[$key] = "";
							}
						break;
						case "notedBy":
							if (is_a($value,Assessor)){
								$this->formArray["notedByID"] = $value->getAssessorID();
								$this->formArray["notedByName"] = $value->getFullName();
							}
							else {
								$this->formArray[$key] = "";
							}
						break;
						case "appraisedBy":
							if (is_a($value,Assessor)){
								$this->formArray["appraisedByID"] = $value->getAssessorID();
								$this->formArray["appraisedByName"] = $value->getFullName();
							}
							else {
								$this->formArray[$key] = "";
							}
						break;
						case "appraisedByDate":
							if (true){
								list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
								$this->formArray["as_year"] = removePreZero($dateArr["year"]);
								$this->formArray["as_month"] = removePreZero($dateArr["month"]);
								$this->formArray["as_day"] = removePreZero($dateArr["day"]);
							}
							else {
								$this->formArray[$key] = "";
							}
						break;
						case "recommendingApproval":
							if (is_a($value,Assessor)){
								$this->formArray["recommendingApprovalID"] = $value->getAssessorID();
								$this->formArray["recommendingApprovalName"] = $value->getFullName();
							}
							else {
								$this->formArray[$key] = "";
							}
						break;
						case "recommendingApprovalDate":
							if (true){
								list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
								$this->formArray["re_year"] = removePreZero($dateArr["year"]);
								$this->formArray["re_month"] = removePreZero($dateArr["month"]);
								$this->formArray["re_day"] = removePreZero($dateArr["day"]);
							}
							else {
								$this->formArray[$key] = "";
							}
						case "approvedBy":
							if (is_a($value,Assessor)){
								$this->formArray["approvedByID"] = $value->getAssessorID();
								$this->formArray["approvedByName"] = $value->getFullName();
							}
							else {
								$this->formArray[$key] = "";
							}
						break;
						case "approvedByDate":
							if (true){
								list($dateArr["year"],$dateArr["month"],$dateArr["day"]) = explode("-",$value);
								$this->formArray["av_year"] = removePreZero($dateArr["year"]);
								$this->formArray["av_month"] = removePreZero($dateArr["month"]);
								$this->formArray["av_day"] = removePreZero($dateArr["day"]);
							}
							else {
								$this->formArray[$key] = "";
							}
						break;
						default:
							$this->formArray[$key] = $value;
					}
				}
			}
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
$landEncode = new LandDetails($HTTP_POST_VARS,$afsID,$propertyID,$formAction,$sess);
$landEncode->main();
?>
<?php page_close(); ?>