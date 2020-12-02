<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/Person.php";
include_once "../assessor/PersonRecords.php";

include_once "../assessor/eRPTSSettings.php";

include_once "../assessor/User.php";
include_once "../assessor/UserRecords.php";

include_once "../assessor/RPTOP.php";


#####################################
# Define Interface Class
#####################################
class RPTOPEncode{
	
	var $tpl;
	var $formArray;
	var $rptop;

	function RPTOPEncode($http_post_vars,$rptopID="",$formAction="",$sess){
		global $auth;

		$this->sess = $sess;
		$this->userID = $auth->auth["uid"];

		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "RPTOPEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode RPTOP");
		
		$this->formArray = array(
			"rptopID" => $rptopID
			, "rptopNumber" => ""
			, "taxableYear" => ""
			, "cityAssessor" => ""
			, "citytreasurer" => ""
			, "cityAssessorID" => ""
			, "citytreasurerID" => ""
			, "formAction" => $formAction
			);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function initMasterAssessorList($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		/*

		$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php", "urn:Object");
		if(!$xmlStr = $eRPTSSettingsDetails->getERPTSSettingsDetails(1)){
			echo "blabla";
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				echo "blabla2";
			}
			else{
				$eRPTSSettings = new eRPTSSettings;
				$eRPTSSettings->parseDomDocument($domDoc);
				switch($tempVar){
					case "cityAssessor":
						$this->tpl->set_var("id",$eRPTSSettings->getAssessorFullName());
						$this->tpl->set_var("name",$eRPTSSettings->getAssessorFullName());

						$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
						$this->initSelected($tempVar."ID",$eRPTSSettings->getAssessorFullName());
						$this->tpl->parse($TempVar."ListBlock",$TempVar."List",true);
						break;
				}
			}
		}

		*/

		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
        if (!$xmlStr = $UserList->getUserList(0, " WHERE ".AUTH_USER_MD5_TABLE.".userType REGEXP '1$' AND ".AUTH_USER_MD5_TABLE.".status='enabled'")){
			// error xml

   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
			}
			else {
				$UserRecords = new UserRecords;
				$UserRecords->parseDomDocument($domDoc);
				$list = $UserRecords->getArrayList();
				foreach ($list as $key => $user){
					$person = new Person;
					$person->selectRecord($user->personID);
					$this->tpl->set_var("id",$user->personID);
					$this->tpl->set_var("name",$person->getFullName());
					$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
			        $this->initSelected($tempVar."ID",$user->personID);
			        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
				}
			}
		}
	}

	function initMasterTreasurerList($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		/*

		$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php", "urn:Object");
		if(!$xmlStr = $eRPTSSettingsDetails->getERPTSSettingsDetails(1)){
			// error xml
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				// error domDoc
			}
			else{
				$eRPTSSettings = new eRPTSSettings;
				$eRPTSSettings->parseDomDocument($domDoc);
				switch($tempVar){
					case "cityTreasurer":
						$this->tpl->set_var("id",$eRPTSSettings->getTreasurerFullName());
						$this->tpl->set_var("name",$eRPTSSettings->getTreasurerFullName());

						$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
						$this->initSelected($tempVar."ID",$eRPTSSettings->getTreasurerFullName());
						$this->tpl->parse($TempVar."ListBlock",$TempVar."List",true);
						break;
				}
			}
		}

		*/

		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
        if (!$xmlStr = $UserList->getUserList(0, " WHERE ".AUTH_USER_MD5_TABLE.".userType REGEXP '1$' AND ".AUTH_USER_MD5_TABLE.".status='enabled'")){
			// error xmlStr
   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
			}
			else {
				$UserRecords = new UserRecords;
				$UserRecords->parseDomDocument($domDoc);
				$list = $UserRecords->getArrayList();
				foreach ($list as $key => $user){
					$person = new Person;
					$person->selectRecord($user->personID);
					$this->tpl->set_var("id",$user->personID);
					$this->tpl->set_var("name",$person->getFullName());
					$this->formArray[$tempVar."ID"] = $this->formArray[$tempVar];
			        $this->initSelected($tempVar."ID",$user->personID);
			        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
				}
			}
		}
	}
	
	function initSelected($tempVar,$compareTo,$actionStr="selected"){
		if ($this->formArray[$tempVar] == $compareTo){
			$this->tpl->set_var($tempVar."_sel", $actionStr);
		}
		else{
			$this->tpl->set_var($tempVar."_sel", "");
		}
	}
	
	function setForm(){

		$startYear = 1990;
		$endYear = date("Y")+3;
		$this->tpl->set_block("rptsTemplate", "YearList", "YearListBlock");
		for($i = $endYear; $i>=$startYear; $i--){
			$this->tpl->set_var("year", $i);
			$this->initSelected("taxableYear",$i);
			$this->tpl->parse("YearListBlock", "YearList", true);
		}

		$this->initMasterAssessorList("CityAssessor", "cityAssessor");
		$this->initMasterTreasurerList("CityTreasurer", "cityTreasurer");

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "edit":
				$RPTOPDetails = new SoapObject(NCCBIZ."RPTOPDetails.php", "urn:Object");
				if (!$xmlStr = $RPTOPDetails->getRPTOP($this->formArray["rptopID"])){
					exit("xml failed");
				}
				else{
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "FORM", "FORMBlock");
						$this->tpl->set_var("FORMBlock", "error xmlDoc");
					}
					else {
						$rptop = new RPTOP;
						$rptop->parseDomDocument($domDoc);
						foreach($rptop as $key => $value){
							$this->formArray[$key] = $value;
						}
					}	
				}
				break;
			case "save":
				$RPTOPEncode = new SoapObject(NCCBIZ."RPTOPEncode.php", "urn:Object");
				if ($this->formArray["rptopID"] <> ""){
					$RPTOPDetails = new SoapObject(NCCBIZ."RPTOPDetails.php", "urn:Object");
					if (!$xmlStr = $RPTOPDetails->getRPTOPDetails($this->formArray["rptopID"])){
						$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {			
							$rptop = new RPTOP;
							$rptop->parseDomDocument($domDoc);
							//$rptop->selectRecord($this->formArray["rptopID"]);
							$rptop->setRptopID($this->formArray["rptopID"]);
							$rptop->setRptopNumber($this->formArray["rptopNumber"]);
							$rptop->setTaxableYear($this->formArray["taxableYear"]);
							$rptop->setCityAssessor($this->formArray["cityAssessorID"]);
							$rptop->setCityTreasurer($this->formArray["cityTreasurerID"]);
							$rptop->setCreatedBy($this->userID);
							$rptop->setModifiedBy($this->userID);
							$rptop->setDomDocument();
							
							$doc = $rptop->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							//echo $xmlStr;
							if (!$ret = $RPTOPEncode->updateRPTOP($xmlStr)){
								echo("error update");
							}
							header("location: RPTOPClose.php".$this->sess->url("").$this->sess->add_query(array("rptopID"=>$ret)));
							//header("location: RPTOPEncode.php".$this->sess->url("").$this->sess->add_query(array("rptopID"=>$ret,"formAction"=>"edit")));
							exit;
						}
					}
				}
				else {
					$rptop = new RPTOP;
					$rptop->setRptopNumber($this->formArray["rptopNumber"]);
					$rptop->setTaxableYear($this->formArray["taxableYear"]);
					$rptop->setCityAssessor($this->formArray["cityAssessorID"]);
					$rptop->setCityTreasurer($this->formArray["cityTreasurerID"]);
					$rptop->setCreatedBy($this->userID);
					$rptop->setModifiedBy($this->userID);
					$rptop->setDomDocument();
					//echo hello;
					$doc = $rptop->getDomDocument();
					$xmlStr =  $doc->dump_mem(true);
					//echo $xmlStr;
					if (!$ret = $RPTOPEncode->saveRPTOP($xmlStr)){
						echo("ret=".$ret);
					}
					$this->formArray["rptopID"] = $ret;
					header("location: RPTOPClose.php".$this->sess->url("").$this->sess->add_query(array("rptopID"=>$ret)));
					exit($ret);
				}
				break;
			case "cancel":
				header("location: RPTOPList.php";
				exit;
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "rptopID", "rptopIDBlock");
				$this->tpl->set_var("rptopIDBlock", "");
				$this->tpl->set_block("rptsTemplate", "ACK", "ACKBlock");
				$this->tpl->set_var("ACKBlock", "");
		}
		$this->setForm();
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("rptopID"=>$this->formArray["rptopID"],"ownerID" => $this->formArray["ownerID"])));
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
$rptopEncode = new RPTOPEncode($HTTP_POST_VARS,$rptopID,$formAction,$sess);
$rptopEncode->main();
?>
<?php page_close(); ?>
