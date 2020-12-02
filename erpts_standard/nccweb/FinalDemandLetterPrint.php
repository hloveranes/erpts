<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/web/clibPDFWriter.php";

include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/Company.php";

include_once "../includes/assessor/eRPTSSettings.php";

#####################################
# Define Interface Class
#####################################
class FinalDemandLetterPrint{
	
	var $tpl;
	function FinalDemandLetterPrint($sess,$ownerID,$http_post_vars){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must have atleast TM-VIEW access
		$pageType = "%%%%1%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "finalDemandLetter.xml") ;
		$this->tpl->set_var("TITLE", "TM : Final Demand Letter");

		$this->formArray["ownerID"] = $ownerID;
		$this->formArray["date"] = date("F d, Y");

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function setForm(){
		$this->formArray["noticeDate"] = date("F d, Y", strtotime($this->formArray["noticeDate_year"]."-".putPreZero($this->formArray["noticeDate_month"])."-".putPreZero($this->formArray["noticeDate_day"])));
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, html_entity_to_alpha($value));
		}
	}

	function getOwnerName($ownerID){
		$address1 = "";
		$address2 = "";

		$db = new DB_RPTS;

		// person
		$sql = "SELECT "
			."Person.personID as personID "
			.",Person.firstName as firstName "
			.",Person.middleName as middleName "
			.", Person.lastName as lastName "
			."FROM"
			." ".PERSON_TABLE
			.", ".OWNER_PERSON_TABLE
			." WHERE"
			." ".PERSON_TABLE.".personID = ".OWNER_PERSON_TABLE.".personID"
			." AND"
			." ".OWNER_PERSON_TABLE.".ownerID = ".$ownerID;

		$db->query($sql);

		while($db->next_record()){
			if($db->f("middleName")!=""){
				$middleInitial = substr($db->f("middleName"),0,1) . ".";
				$fullName = $db->f("firstName")." ".$middleInitial." ".$db->f("lastName");
			}
			else{
				$fullName = $db->f("firstName")." ".$db->f("lastName");
			}

			$ownerNamesArray[] = $fullName;

			if($address1=="" && $address2==""){
				$personID = $db->f("personID");
				$person = new Person;
				$person->selectRecord($personID);

				$address = $person->addressArray[0];
				if (is_a($address,Address)){
					if($address->getNumber()!="" && $address->getNumber()!=" " && $address->getNumber()!="-" && $address->getNumber()!="--"){
						$this->formArray["address1"] = $address->getNumber();
					}
					if($address->getStreet()!="" && $address->getStreet()!=" " && $address->getStreet()!="-" && $address->getStreet()!="--"){
						if($this->formArray["address1"]!=""){
							$this->formArray["address1"] .= " ".$address->getStreet();
						}
						else{
							$this->formArray["address1"] = $address->getStreet();
						}
					}
					if($address->getBarangay()!="" && $address->getBarangay()!=" " && $address->getBarangay()!="-" && $address->getBarangay()!="--"){
						if($this->formArray["address1"]!=""){
							$this->formArray["address1"] .= ", ".$address->getBarangay();
						}
						else{
							$this->formArray["address1"] = $address->getBarangay();
						}						
					}
					if($address->getDistrict()!="" && $address->getDistrict()!=" " && $address->getDistrict()!="-" && $address->getDistrict()!="--"){
						if($this->formArray["address1"]!=""){
							$this->formArray["address1"] .= ", ".$address->getDistrict();
						}
						else{
							$this->formArray["address1"] = $address->getDistrict();
						}						
					}
					if($address->getMunicipalityCity()!="" && $address->getMunicipalityCity()!=" " && $address->getMunicipalityCity()!="-" && $address->getMunicipalityCity()!="--"){
						$this->formArray["address2"] = $address->getMunicipalityCity();
					}
					if($address->getProvince()!="" && $address->getProvince()!=" " && $address->getProvince()!="-" && $address->getProvince()!="--"){
						if($this->formArray["address2"]!=""){
							$this->formArray["address2"] .= ", ".$address->getProvince();
						}
						else{
							$this->formArray["address2"] = $address->getProvince();
						}	
					}
				}
			}
		}

		unset($db);

		$db = new DB_RPTS;

		// company
		$sql = "SELECT "
			."Company.companyID as companyID "
			.",Company.companyName as companyName "
			."FROM"
			." ".COMPANY_TABLE
			.", ".OWNER_COMPANY_TABLE
			." WHERE"
			." ".COMPANY_TABLE.".companyID = ".OWNER_COMPANY_TABLE.".companyID"
			." AND"
			." ".OWNER_COMPANY_TABLE.".ownerID = ".$ownerID;

		$db->query($sql);

		while($db->next_record()){
			$ownerNamesArray[] = $db->f("companyName");

			if($address1=="" && $address2==""){
				$companyID = $db->f("companyID");
				$company = new Company;
				$company->selectRecord($companyID);

				$address = $company->addressArray[0];
				if (is_a($address,Address)){
					if($address->getNumber()!="" && $address->getNumber()!=" " && $address->getNumber()!="-" && $address->getNumber()!="--"){
						$this->formArray["address1"] = $address->getNumber();
					}
					if($address->getStreet()!="" && $address->getStreet()!=" " && $address->getStreet()!="-" && $address->getStreet()!="--"){
						if($this->formArray["address1"]!=""){
							$this->formArray["address1"] .= " ".$address->getStreet();
						}
						else{
							$this->formArray["address1"] = $address->getStreet();
						}
					}
					if($address->getBarangay()!="" && $address->getBarangay()!=" " && $address->getBarangay()!="-" && $address->getBarangay()!="--"){
						if($this->formArray["address1"]!=""){
							$this->formArray["address1"] .= ", ".$address->getBarangay();
						}
						else{
							$this->formArray["address1"] = $address->getBarangay();
						}						
					}
					if($address->getDistrict()!="" && $address->getDistrict()!=" " && $address->getDistrict()!="-" && $address->getDistrict()!="--"){
						if($this->formArray["address1"]!=""){
							$this->formArray["address1"] .= ", ".$address->getDistrict();
						}
						else{
							$this->formArray["address1"] = $address->getDistrict();
						}						
					}
					if($address->getMunicipalityCity()!="" && $address->getMunicipalityCity()!=" " && $address->getMunicipalityCity()!="-" && $address->getMunicipalityCity()!="--"){
						$this->formArray["address2"] = $address->getMunicipalityCity();
					}
					if($address->getProvince()!="" && $address->getProvince()!=" " && $address->getProvince()!="-" && $address->getProvince()!="--"){
						if($this->formArray["address2"]!=""){
							$this->formArray["address2"] .= ", ".$address->getProvince();
						}
						else{
							$this->formArray["address2"] = $address->getProvince();
						}	
					}
				}
			}
		}

		if(is_array($ownerNamesArray)){
			sort($ownerNamesArray);
			reset($ownerNamesArray);
			return implode(", ",$ownerNamesArray);
		}
		else{
			return false;
		}
	}

	function setLguDetails(){
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
				$this->formArray["lguName"] = strtoupper($erptsSettings->getLguName());
				$this->formArray["lguType"] = strtoupper($erptsSettings->getLguType());
				$this->tpl->set_var("lguName", $this->formArray["lguName"]);
				$this->tpl->set_var("lguType", $this->formArray["lguType"]);
			}
		}
	}

	function Main(){
		$this->formArray["ownerName"] = $this->getOwnerName($this->formArray["ownerID"]);

		$this->setLguDetails();

		$this->setForm();

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));
	
		$this->tpl->set_var("Session", $this->sess->url(""));
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
$finalDemandLetterPrint = new FinalDemandLetterPrint($sess,$ownerID,$HTTP_POST_VARS);
$finalDemandLetterPrint->Main();
?>
<?php page_close(); ?>
