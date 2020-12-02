<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/Address.php";
include_once "../assessor/LocationAddress.php";
include_once "../assessor/Company.php";
include_once "../assessor/Owner.php";
include_once "../assessor/OwnerRecords.php";
#####################################
# Define Interface Class
#####################################
class CompanyEncode{
	
	var $tpl;
	var $formArray;
	var $company;
	
	function CompanyEncode($http_post_vars,$companyID="",$formAction="",$sess,$ownerID="",$odID,$locID,$parentURL){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "CompanyEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode Company or Group");
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("ownerID"=>$ownerID)));
		
		$this->formArray = array(
			"companyID" => $companyID
			, "companyName" => ""
			, "tin" => ""
			, "telephone" => ""
			, "fax" => ""
			, "addressID" => ""
			, "number" => ""
			, "street" => ""
			, "barangay" => ""
			, "district" => ""
			, "municipalityCity" => ""
			, "province" => ""
			, "email" => ""
			, "website" => ""
			, "formAction" => $formAction
			, "ownerID" => $ownerID
			, "odID" => $odID
			, "locID" => $locID
			, "parentURL" => $parentURL
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
				$CompanyDetails = new SoapObject(NCCBIZ."CompanyDetails.php", "urn:Object");
				if (!$xmlStr = $CompanyDetails->getCompanyDetails($this->formArray["companyID"])){
					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
					$this->tpl->set_var("TableBlock", "record not found");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
	 					$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$company = new Company;
						$company->parseDomDocument($domDoc);
						
						$this->formArray["companyID"] = $company->getCompanyID();
						$this->formArray["companyName"] = $company->getCompanyName();
						$this->formArray["tin"] = $company->getTin();
						$this->formArray["telephone"] = $company->getTelephone();
						$this->formArray["fax"] = $company->getFax();
						$address = $company->addressArray[0];
						if (is_a($address,Address)){
							$this->formArray["addressID"] = $address->getAddressID();
							$this->formArray["number"] = $address->getNumber();
							$this->formArray["street"] = $address->getStreet();
							$this->formArray["barangay"] = $address->getBarangay();
							$this->formArray["district"] = $address->getDistrict();
							$this->formArray["municipalityCity"] = $address->getMunicipalitycity();
							$this->formArray["province"] = $address->getProvince();
						}
						$this->formArray["email"] = $company->getEmail();
						$this->formArray["website"] = $company->getWebsite();
					}
				}
				break;
			case "save":
				$CompanyEncode = new SoapObject(NCCBIZ."CompanyEncode.php", "urn:Object");
				if ($this->formArray["companyID"] <> ""){
					$CompanyDetails = new SoapObject(NCCBIZ."CompanyDetails.php", "urn:Object");
					if (!$xmlStr = $CompanyDetails->getCompanyDetails($this->formArray["companyID"])){
						$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$company = new Company;
							$company->parseDomDocument($domDoc);
							$address = $company->addressArray[0];
							if (is_a($address,Address)){
								$address->setAddressID($this->formArray["addressID"]);
								$address->setNumber($this->formArray["number"]);
								$address->setStreet($this->formArray["street"]);
								$address->setBarangay($this->formArray["barangay"]);
								$address->setDistrict($this->formArray["district"]);
								$address->setMunicipalityCity($this->formArray["municipalityCity"]);
								$address->setProvince($this->formArray["province"]);
								$address->setDomDocument();
							}
							//$company->selectRecord($this->formArray["companyID"]);
							$company->setCompanyID($this->formArray["companyID"]);
							$company->setCompanyName($this->formArray["companyName"]);
							$company->setTin($this->formArray["tin"]);
							$company->setTelephone($this->formArray["telephone"]);
							$company->setFax($this->formArray["fax"]);
							$company->setAddressArray($address);
							$company->setEmail($this->formArray["email"]);
							$company->setWebsite($this->formArray["website"]);
							$company->setDomDocument();
					
							$doc = $company->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $CompanyEncode->updateCompany($xmlStr)){
								exit("error update");
							}
						}
					}
				}
				else {
					$address = new Address;
					$address->setNumber($this->formArray["number"]);
					$address->setStreet($this->formArray["street"]);
					$address->setBarangay($this->formArray["barangay"]);
					$address->setDistrict($this->formArray["district"]);
					$address->setMunicipalityCity($this->formArray["municipalityCity"]);
					$address->setProvince($this->formArray["province"]);
					$address->setDomDocument();
					
					$company = new Company;
					$company->setCompanyID($this->formArray["companyID"]);
					$company->setCompanyName($this->formArray["companyName"]);
					$company->setTelephone($this->formArray["telephone"]);
					$company->setFax($this->formArray["fax"]);
					$company->setTin($this->formArray["tin"]);
					$company->setAddressArray($address);
					$company->setEmail($this->formArray["email"]);
					$company->setWebsite($this->formArray["website"]);
					$company->setDomDocument();
			
					$doc = $company->getDomDocument();
					$xmlStr =  $doc->dump_mem(true);
					if (!$ret = $CompanyEncode->saveCompany($xmlStr,$this->formArray["ownerID"])){
						exit("error save");
					}
				}
				$this->formArray["companyID"] = $ret;
				//echo $ret;
				//}
				header("location: CompanyClose.php?parentURL=".urlencode($this->formArray["parentURL"]));
				exit;
				//*/
				//else echo "tumpak!";
				break;
			case "cancel":
				header("location: CompanyList.php";
				exit;
				break;
			default:
				if ($this->formArray["locID"]){
					$ODDetails = new SoapObject(NCCBIZ."ODDetails.php", "urn:Object");
					if (!$xmlStr = $ODDetails->getLocation($this->formArray["locID"])){
						exit("xml failed");
					}
					else{
						if(!$domDoc = domxml_open_mem($xmlStr)) {
						}
						else {
							$loc = new LocationAddress;
							$loc->parseDomDocument($domDoc);
							foreach($loc as $key => $value){
								$this->formArray[$key] = $value;
							}
						}	
					}
				}
				$this->tpl->set_block("rptsTemplate", "companyID", "companyIDBlock");
				$this->tpl->set_var("companyIDBlock", "");
				$this->tpl->set_block("rptsTemplate", "ACK", "ACKBlock");
				$this->tpl->set_var("ACKBlock", "");
		}
		//*/
		$this->setForm();
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
$companyEncode = new CompanyEncode($HTTP_POST_VARS,$companyID,$formAction,$sess,$ownerID,$odID,$locID,$parentURL);
$companyEncode->main();
?>

<?php page_close(); ?>