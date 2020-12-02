<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/eRPTSSettings.php";

#####################################
# Define Interface Class
#####################################
class eRPTSSettingsEncode{
	
	var $tpl;
	function eRPTSSettingsEncode($http_post_vars,$sess,$formAction){
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

		$this->tpl->set_file("rptsTemplate", "eRPTSSettingsEncode.htm") ;
		$this->tpl->set_var("TITLE", "eRPTS Settings");

		$this->formArray = array(
			"lguName" => ""
			,"lguType" => ""
			,"chiefExecutiveDesignation" => ""
			,"chiefExecutiveFirstName" => ""
			,"chiefExecutiveMiddleName" => ""
			,"chiefExecutiveLastName" => ""
			,"assessorDesignation" => ""
			,"assessorFirstName" => ""
			,"assessorMiddleName" => ""
			,"assessorLastName" => ""
			,"treasurerDesignation" => ""
			,"treasurerFirstName" => ""
			,"treasurerMiddleName" => ""
			,"treasurerLastName" => ""

			,"provincialAssessorDesignation" => ""
			,"provincialAssessorFirstName" => ""
			,"provincialAssessorMiddleName" => ""
			,"provincialAssessorLastName" => ""

			,"provincialTreasurerDesignation" => ""
			,"provincialTreasurerFirstName" => ""
			,"provincialTreasurerMiddleName" => ""
			,"provincialTreasurerLastName" => ""

			,"ordinanceNo" => ""
			,"ordinanceDate" => ""
			,"formAction" => $formAction
		);

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
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
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}

		$this->tpl->set_block("rptsTemplate", "LguTypeList", "LguTypeListBlock");
		
        $this->lguTypeListArray[] = "City";
        $this->lguTypeListArray[] = "Municipality";
        $this->lguTypeListArray[] = "Province";
		
		foreach($this->lguTypeListArray as $key => $value){
			$this->tpl->set_var("lguType", $value);
			$this->initSelected("lguType",$value);
			$this->tpl->parse("LguTypeListBlock", "LguTypeList", true);
		}
	}

	function Main(){
		switch ($this->formArray["formAction"]){
			case "save":
				$eRPTSSettingsEncode = new SoapObject(NCCBIZ."eRPTSSettingsEncode.php", "urn:Object");
				if ($this->formArray["eRPTSSettingsID"] <> ""){
					$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php", "urn:Object");
					if (!$xmlStr = $eRPTSSettingsDetails->geteRPTSSettingsDetails($this->formArray["eRPTSSettingsID"])){
						exit("record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$erptsSettings = new eRPTSSettings;
							$erptsSettings->parseDomDocument($domDoc);
							$erptsSettings->setERPTSSettingsID($this->formArray["eRPTSSettingsID"]);

							$erptsSettings->setLguName($this->formArray["lguName"]);
							$erptsSettings->setLguType($this->formArray["lguType"]);
							$erptsSettings->setChiefExecutiveDesignation($this->formArray["chiefExecutiveDesignation"]);
							$erptsSettings->setChiefExecutiveFirstName($this->formArray["chiefExecutiveFirstName"]);
							$erptsSettings->setChiefExecutiveMiddleName($this->formArray["chiefExecutiveMiddleName"]);
							$erptsSettings->setChiefExecutiveLastName($this->formArray["chiefExecutiveLastName"]);

							$erptsSettings->setAssessorDesignation($this->formArray["assessorDesignation"]);
							$erptsSettings->setAssessorFirstName($this->formArray["assessorFirstName"]);
							$erptsSettings->setAssessorMiddleName($this->formArray["assessorMiddleName"]);
							$erptsSettings->setAssessorLastName($this->formArray["assessorLastName"]);

							$erptsSettings->setTreasurerDesignation($this->formArray["treasurerDesignation"]);
							$erptsSettings->setTreasurerFirstName($this->formArray["treasurerFirstName"]);
							$erptsSettings->setTreasurerMiddleName($this->formArray["treasurerMiddleName"]);
							$erptsSettings->setTreasurerLastName($this->formArray["treasurerLastName"]);

							$erptsSettings->setProvincialAssessorDesignation($this->formArray["provincialAssessorDesignation"]);
							$erptsSettings->setProvincialAssessorFirstName($this->formArray["provincialAssessorFirstName"]);
							$erptsSettings->setProvincialAssessorMiddleName($this->formArray["provincialAssessorMiddleName"]);
							$erptsSettings->setProvincialAssessorLastName($this->formArray["provincialAssessorLastName"]);

							$erptsSettings->setProvincialTreasurerDesignation($this->formArray["provincialTreasurerDesignation"]);
							$erptsSettings->setProvincialTreasurerFirstName($this->formArray["provincialTreasurerFirstName"]);
							$erptsSettings->setProvincialTreasurerMiddleName($this->formArray["provincialTreasurerMiddleName"]);
							$erptsSettings->setProvincialTreasurerLastName($this->formArray["provincialTreasurerLastName"]);
							$erptsSettings->setOrdinanceNo($this->formArray["ordinanceNo"]);
							$erptsSettings->setOrdinanceDate($this->formArray["ordinanceDate"]);

							$erptsSettings->setDomDocument();

							$doc = $erptsSettings->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);

							if (!$ret = $eRPTSSettingsEncode->updateERPTSSettings($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
   				    $erptsSettings = new eRPTSSettings;
					$erptsSettings->setLguName($this->formArray["lguName"]);
					$erptsSettings->setLguType($this->formArray["lguType"]);

					$erptsSettings->setChiefExecutiveDesignation($this->formArray["chiefExecutiveDesignation"]);
					$erptsSettings->setChiefExecutiveFirstName($this->formArray["chiefExecutiveFirstName"]);
					$erptsSettings->setChiefExecutiveMiddleName($this->formArray["chiefExecutiveMiddleName"]);
					$erptsSettings->setChiefExecutiveLastName($this->formArray["chiefExecutiveLastName"]);

					$erptsSettings->setAssessorDesignation($this->formArray["assessorDesignation"]);
					$erptsSettings->setAssessorFirstName($this->formArray["assessorFirstName"]);
					$erptsSettings->setAssessorMiddleName($this->formArray["assessorMiddleName"]);
					$erptsSettings->setAssessorLastName($this->formArray["assessorLastName"]);

					$erptsSettings->setTreasurerDesignation($this->formArray["treasurerDesignation"]);
					$erptsSettings->setTreasurerFirstName($this->formArray["treasurerFirstName"]);
					$erptsSettings->setTreasurerMiddleName($this->formArray["treasurerMiddleName"]);
					$erptsSettings->setTreasurerLastName($this->formArray["treasurerLastName"]);

					$erptsSettings->setProvincialAssessorDesignation($this->formArray["provincialAssessorDesignation"]);
					$erptsSettings->setProvincialAssessorFirstName($this->formArray["provincialAssessorFirstName"]);
					$erptsSettings->setProvincialAssessorMiddleName($this->formArray["provincialAssessorMiddleName"]);
					$erptsSettings->setProvincialAssessorLastName($this->formArray["provincialAssessorLastName"]);

					$erptsSettings->setProvincialTreasurerDesignation($this->formArray["provincialTreasurerDesignation"]);
					$erptsSettings->setProvincialTreasurerFirstName($this->formArray["provincialTreasurerFirstName"]);
					$erptsSettings->setProvincialTreasurerMiddleName($this->formArray["provincialTreasurerMiddleName"]);
					$erptsSettings->setProvincialTreasurerLastName($this->formArray["provincialTreasurerLastName"]);
					
					$erptsSettings->setOrdinanceNo($this->formArray["ordinanceNo"]);
					$erptsSettings->setOrdinanceDate($this->formArray["ordinanceDate"]);

					$erptsSettings->setDomDocument();
			
					$doc = $erptsSettings->getDomDocument();
					$xmlStr = $doc->dump_mem(true);
					
					if (!$ret = $eRPTSSettingsEncode->saveERPTSSettings($xmlStr)){
                        exit("error save");
					}
				}
				
				$this->formArray["eRPTSSettingsID"] = $ret;

				break;
			default:
				$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php", "urn:Object");

				if (!$xmlStr = $eRPTSSettingsDetails->getERPTSSettingsDetails(1)){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$erptsSettings = new eRPTSSettings;
						$erptsSettings->parseDomDocument($domDoc);

						$this->formArray["eRPTSSettingsID"] = $erptsSettings->getERPTSSettingsID();
						$this->formArray["lguName"] = $erptsSettings->getLguName();
						$this->formArray["lguType"] = $erptsSettings->getLguType();
						$this->formArray["chiefExecutiveDesignation"] = 		$erptsSettings->getChiefExecutiveDesignation();
						$this->formArray["chiefExecutiveFirstName"] = $erptsSettings->getChiefExecutiveFirstName();
						$this->formArray["chiefExecutiveMiddleName"] = $erptsSettings->getChiefExecutiveMiddleName();
						$this->formArray["chiefExecutiveLastName"] = $erptsSettings->getChiefExecutiveLastName();

						$this->formArray["assessorDesignation"] = $erptsSettings->getAssessorDesignation();
						$this->formArray["assessorFirstName"] = $erptsSettings->getAssessorFirstName();
						$this->formArray["assessorMiddleName"] = $erptsSettings->getAssessorMiddleName();
						$this->formArray["assessorLastName"] = $erptsSettings->getAssessorLastName();

						$this->formArray["treasurerDesignation"] = $erptsSettings->getTreasurerDesignation();
						$this->formArray["treasurerFirstName"] = $erptsSettings->getTreasurerFirstName();
						$this->formArray["treasurerMiddleName"] = $erptsSettings->getTreasurerMiddleName();
						$this->formArray["treasurerLastName"] = $erptsSettings->getTreasurerLastName();

						$this->formArray["provincialAssessorDesignation"] = $erptsSettings->getProvincialAssessorDesignation();
						$this->formArray["provincialAssessorFirstName"] = $erptsSettings->getProvincialAssessorFirstName();
						$this->formArray["provincialAssessorMiddleName"] = $erptsSettings->getProvincialAssessorMiddleName();
						$this->formArray["provincialAssessorLastName"] = $erptsSettings->getProvincialAssessorLastName();

						$this->formArray["provincialTreasurerDesignation"] = $erptsSettings->getProvincialTreasurerDesignation();
						$this->formArray["provincialTreasurerFirstName"] = $erptsSettings->getProvincialTreasurerFirstName();
						$this->formArray["provincialTreasurerMiddleName"] = $erptsSettings->getProvincialTreasurerMiddleName();
						$this->formArray["provincialTreasurerLastName"] = $erptsSettings->getProvincialTreasurerLastName();
						$this->formArray["ordinanceNo"] = $erptsSettings->getOrdinanceNo();
						$this->formArray["ordinanceDate"] = $erptsSettings->getOrdinanceDate();
					}
				}
		}

		$this->setForm();

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
$obj = new eRPTSSettingsEncode($HTTP_POST_VARS,$sess,$formAction);
$obj->Main();
?>
<?php page_close(); ?>
