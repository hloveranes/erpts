<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";

include_once "../assessor/LocationAddress.php";
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
class ODDetails{
	
	var $tpl;
	var $formArray;
	function ODDetails($http_post_vars,$sess,$odID){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ODDetails.htm") ;
		$this->tpl->set_var("TITLE", "Owner List");
		
		$this->formArray["odID"] = $odID;
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function initCheckBox($checkboxName){
		$checked = "checked";
		if (!$this->formArray[$checkboxName]) $checked = "";
		$this->tpl->set_var($checkboxName, $checked);
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
		$checked = "checked";
		$this->initCheckBox("affidavitOfOwnership");
		$this->initCheckBox("barangayCertificate");
		$this->initCheckBox("landTagging");
	}
	
	function displayOwnerList($domDoc){
		$owner = new Owner;
		$owner->parseDomDocument($domDoc);
		//$list = $owner->getArrayList();
		//foreach ($list as $key => $value){
			if (count($owner->personArray)){
				$this->tpl->set_block("rptsTemplate", "PersonDBEmpty", "PersonDBEmptyBlock");
				$this->tpl->set_var("PersonDBEmptyBlock", "");
				$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
				foreach($owner->personArray as $personKey =>$personValue){
					$this->tpl->set_var("personID", $personValue->getPersonID());
					if (!$pname = $personValue->getFullName()){
						$pname = "none";
					}
					$this->tpl->set_var("fullName", $pname);
					$this->tpl->set_var("tin", $personValue->getTin());
					$this->tpl->set_var("telephone", $personValue->getTelephone());
					$this->tpl->set_var("mobileNumber", $personValue->getMobileNumber());
					$this->tpl->parse("PersonListBlock", "PersonList", true);
				}
			}
			else{
				$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
				$this->tpl->set_var("PersonListBlock", "");
			}
			if (count($owner->companyArray)){
				$this->tpl->set_block("rptsTemplate", "CompanyDBEmpty", "CompanyDBEmptyBlock");
				$this->tpl->set_var("CompanyDBEmptyBlock", "");
				$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
				//print_r($value->companyArray);
				foreach ($owner->companyArray as $companyKey => $companyValue){
					$this->tpl->set_var("companyID", $companyValue->getCompanyID());
					if (!$cname = $companyValue->getCompanyName()){
						$cname = "none";
					}
					$this->tpl->set_var("companyName", $cname);
					$this->tpl->set_var("tin", $companyValue->getTin());
					$this->tpl->set_var("telephone", $companyValue->getTelephone());
					$this->tpl->set_var("fax", $companyValue->getFax());
					$this->tpl->parse("CompanyListBlock", "CompanyList", true);
				}
			}
			else{
				$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
				$this->tpl->set_var("CompanyListBlock", "");	
			}
		//}
	}
	
	function Main(){
		//echo $this->formArray["formAction"];
		switch ($this->formArray["formAction"]){
			case "delete":
				if (count($this->formArray["personID"]) > 0) {
					$PersonList = new SoapObject(NCCBIZ."PersonList.php", "urn:Object");
					if (!$deletedRows = $PersonList->deleteRecord($this->formArray["personID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				if (count($this->formArray["companyID"]) > 0) {
					$CompanyList = new SoapObject(NCCBIZ."CompanyList.php", "urn:Object");
					if (!$deletedRows = $CompanyList->deleteRecord($this->formArray["companyID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				header("location: ODDetails.php".$this->sess->url("").$this->sess->add_query(array("odID"=>$this->formArray["odID"])));
				exit;
				break;				
			case "remove":
				if (count($this->formArray["personID"])) {
					$OwnerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");
					if (!$deletedRows = $OwnerList->removeOwnerPerson($this->formArray["ownerID"],$this->formArray["personID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				if (count($this->formArray["companyID"]) > 0) {
					$OwnerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");
					if (!$deletedRows = $OwnerList->removeOwnerCompany($this->formArray["ownerID"],$this->formArray["companyID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				header("location: ODDetails.php".$this->sess->url("").$this->sess->add_query(array("odID"=>$this->formArray["odID"])));
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
		}
		$ODDetails = new SoapObject(NCCBIZ."ODDetails.php", "urn:Object");
		if (!$xmlStr = $ODDetails->getOD($this->formArray["odID"])){
			exit("xml failed");
		}
		else{
			//exit($xmlStr);
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
				$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
			}
			else {
				$od = new OD;
				$od->parseDomDocument($domDoc);
				foreach($od as $key => $value){
					if ($key == "locationAddress"&&is_object($value)){
						foreach($value as $lkey => $lvalue){
							$this->formArray[$lkey] = $lvalue;
						}
					}
					else $this->formArray[$key] = $value;
				}

				$this->formArray["landArea"] = number_format($od->getLandArea(), 4, '.', ',');
				
				$ODEncode = new SoapObject(NCCBIZ."ODEncode.php", "urn:Object");
				$this->formArray["ownerID"] = $ODEncode->getOwnerID($this->formArray["odID"]);
				//$OwnerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");
				$xmlStr = $od->owner->domDocument->dump_mem(true);
				if (!$xmlStr){
					//exit(print_r($OwnerList));
					$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
					$this->tpl->set_var("OwnerListTableBlock", "");
				}
				else {
					//echo $xmlStr;
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
						$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
					}
					else {
						$this->displayOwnerList($domDoc);
					}
				}
			}	
		}
		$AFSEncode = new SoapObject(NCCBIZ."AFSEncode.php", "urn:Object");
		if(!$afsID = $AFSEncode->getAfsID($this->formArray["odID"])){
			//$this->tpl->set_block("rptsTemplate", "AFSDetails", "AFSDetailsBlock");
			//$this->tpl->set_var("AFSDetailsBlock", "");
			//echo "1afsID=".$afsID."=>".$this->formArray["odID"];
			$afs = new AFS;
			$afs->setOdID($this->formArray["odID"]);
			$afs->setDomDocument();
			$doc = $afs->getDomDocument();
			$xmlStr =  $doc->dump_mem(true);
			//echo $xmlStr;
			if (!$afsID = $AFSEncode->saveAFS($xmlStr)){
						echo("ret=".$afsID);
			}
			//echo "<br>afsID=".$afsID;
		}
		else{
			//echo "2afsID=".$afsID."=>".$this->formArray["odID"];
			//$this->tpl->set_block("rptsTemplate", "AFSEncode", "AFSEncodeBlock");
			//$this->tpl->set_var("AFSEncodeBlock", "");
		}
		$this->formArray["afsID"] = $afsID;
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
$ownerList = new ODDetails($HTTP_POST_VARS,$sess,$odID);
$ownerList->main();
?>
<?php page_close(); ?>
