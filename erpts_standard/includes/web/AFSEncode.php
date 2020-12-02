<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/Address.php";
include_once "../assessor/Company.php";
include_once "../assessor/CompanyRecords.php";
include_once "../assessor/Person.php";
include_once "../assessor/PersonRecords.php";
include_once "../assessor/Owner.php";
include_once "../assessor/OwnerRecords.php";
include_once "../assessor/OD.php";
include_once "../assessor/AFS.php";
#####################################
# Define Interface Class
#####################################
class AFSEncode{
	
	var $tpl;
	var $formArray;
	var $afs;
	
	function AFSEncode($http_post_vars,$afsID="",$odID="",$formAction="",$sess){
		global $auth;
//		echo "userID=>".$auth->auth["uid"];

		$this->sess = $sess;
		$this->userID = $auth->auth["uid"];

		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "AFSEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode AFS");
		
		$this->formArray = array(
			"afsID" => $afsID
			, "odID" => $odID
			, "propertyIndexNumber" => ""
			, "certificateOfTitleNumber" => ""
			, "cadastralLotNumber" => ""
			, "north" => ""
			, "south" => ""
			, "west" => ""
			, "east" => ""
			, "west" => ""
			, "lastName" => ""
			, "firstName" => ""
			, "middleName" => ""
			, "number" => ""
			, "street" => ""
			, "barangay" => ""
			, "district" => ""
			, "municipalityCity" => ""
			, "province" => ""
			, "telephone" => ""
			, "mobileNumber" => ""
			, "email" => ""
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
				$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
				if (!$xmlStr = $AFSDetails->getAFS($this->formArray["afsID"])){
					echo ("xml failed");
				}
				else{
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
						$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
					}
					else {
						$afs = new AFS;
						$afs->parseDomAFS($domDoc);
						foreach($afs as $key => $value){
							$this->formArray[$key] = $value;
						}
						//print_r($afs);
						//exit();
						$administrator = $afs->getAdministratorArray();
						foreach($administrator as $key =>$value){
							$this->formArray["lastName"] = $value->getLastName();
							$this->formArray["firstName"] = $value->getFirstName();
							$this->formArray["middleName"] = $value->getMiddleName();
							$this->formArray["number"] = $value->getNumber();
							$this->formArray["street"] = $value->getStreet();
							$this->formArray["barangay"] = $value->getBarangay();
							$this->formArray["district"] = $value->getDistrict();
							$this->formArray["municipalityCity"] = $value->getMunicipalityCity();
							$this->formArray["province"] = $value->getProvince();
							$this->formArray["telephone"] = $value->getTelephone();
						}
					}
				}
				break;
			case "save":
				$AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
				if ($this->formArray["afsID"] <> ""){
					$afs = new AFS;
					$afs->selectAFS($this->formArray["afsID"]);
					$afs->setOdID($this->formArray["odID"]);
					$afs->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
					$afs->setCertificateOfTitleNumber($this->formArray["certificateOfTitleNumber"]);
					$afs->setCadastralLotNumber($this->formArray["cadastralLotNumber"]);
					$afs->setNorth($this->formArray["north"]);
					$afs->setSouth($this->formArray["south"]);
					$afs->setEast($this->formArray["east"]);
					$afs->setWest($this->formArray["west"]);
					$afs->setCreatedBy($this->userID);
					$afs->setModifiedBy($this->userID);

					$person = new Person;
					$person->setPersonID($afs->getAdministrator());
					$person->setLastName($this->formArray["lastName"]);
					$person->setFirstName($this->formArray["firstName"]);
					$person->setMiddleName($this->formArray["middleName"]);
					$person->setNumber($this->formArray["number"]);
					$person->setStreet($this->formArray["street"]);
					$person->setBarangay($this->formArray["barangay"]);
					$person->setDistrict($this->formArray["district"]);
					$person->setMunicipalityCity($this->formArray["municipalityCity"]);
					$person->setProvince($this->formArray["province"]);
					$person->setTelephone($this->formArray["telephone"]);
					$person->setDom();
					$afs->setAdministratorArray($person);
					$afs->setDomAFS();
					
					$doc = $afs->getDomAFS();
					$xmlStr =  $doc->dump_mem();
					if (!$ret = $AFSEncode->updateAFS($xmlStr)){
						echo("error update");
					}
					header("location: AFSClose.php".$this->sess->url("").$this->sess->add_query(array("odID"=>$ret)));
					exit;
				}
				else {
					$afs = new AFS;
					$afs->setOdID($this->formArray["odID"]);
					$afs->setPropertyIndexNumber($this->formArray["propertyIndexNumber"]);
					$afs->setCertificateOfTitleNumber($this->formArray["certificateOfTitleNumber"]);
					$afs->setCadastralLotNumber($this->formArray["cadastralLotNumber"]);
					$afs->setNorth($this->formArray["north"]);
					$afs->setSouth($this->formArray["south"]);
					$afs->setEast($this->formArray["east"]);
					$afs->setWest($this->formArray["west"]);
					$afs->setCreatedBy($this->userID);
					$afs->setModifiedBy($this->userID);
					
					$adminAddress = new Address;
					$adminAddress->setNumber($this->formArray["number"]);
					$adminAddress->setStreet($this->formArray["street"]);
					$adminAddress->setBarangay($this->formArray["barangay"]);
					$adminAddress->setDistrict($this->formArray["district"]);
					$adminAddress->setMunicipalityCity($this->formArray["municipalityCity"]);
					$adminAddress->setProvince($this->formArray["province"]);
					$adminAddress->setDomDocument();
					
					$person = new Person;
					$person->setLastName($this->formArray["lastName"]);
					$person->setFirstName($this->formArray["firstName"]);
					$person->setMiddleName($this->formArray["middleName"]);
					$person->setTelephone($this->formArray["telephone"]);
					$person->setDomDocument();
					$afs->setAdministratorArray($person);
					$afs->setDomDocument();
			
					$doc = $afs->getDomDocument();
					$xmlStr =  $doc->dump_mem(true);
					if (!$ret = $AFSEncode->saveAFS($xmlStr)){
						echo("ret=".$ret);
					}
					$this->formArray["afsID"] = $ret;
					header("location: AFSClose.php".$this->sess->url("").$this->sess->add_query(array("afsID"=>$ret)));
					exit();
				}
				break;
			case "cancel":
				header("location: AFSList.php";
				exit;
				break;
			default:
				
				$this->tpl->set_block("rptsTemplate", "odID", "odIDBlock");
				$this->tpl->set_var("odIDBlock", "");
				$this->tpl->set_block("rptsTemplate", "ACK", "ACKBlock");
				$this->tpl->set_var("ACKBlock", "");
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
$afsEncode = new AFSEncode($HTTP_POST_VARS,$afsID,$odID,$formAction,$sess);
$afsEncode->Main();
?>
<?php page_close(); ?>