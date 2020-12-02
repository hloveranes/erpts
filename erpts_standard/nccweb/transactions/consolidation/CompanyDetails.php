<?php 
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/Address.php";
include("assessor/Company.php";
#####################################
# Define Interface Class
#####################################
class CompanyDetails{
	
	var $tpl;
	var $formArray;
	var $company;
	
	function CompanyDetails($companyID,$formAction,$sess,$odID){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "CompanyDetails.htm") ;
		$this->tpl->set_var("TITLE", "Company Details");
		$this->tpl->set_var("Session", $this->sess->url(""));
		
		$this->formArray = array(
			"companyID" => $companyID
			, "companyName" => ""
			, "odID" => $odID
			, "tin" => ""
			, "telephone" => ""
			, "fax" => ""
			, "number" => ""
			, "street" => ""
			, "barangay" => ""
			, "municipalityCity" => ""
			, "province" => ""
			, "email" => ""
			, "website" => ""
			,"formAction" => $formAction
		);
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main($referer=""){
		if ((!$referer) || !isset($referer)) $referer = "OwnerList.php";
		$this->tpl->set_var("referer", $referer);
		switch ($this->formArray["formAction"]){
			case "save" || "view" || "viewOnly":
				$this->tpl->set_var("referer", $referer);
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
				if($this->formArray["formAction"]=="viewOnly"){
					$this->tpl->set_block("rptsTemplate", "ViewOnly", "ViewOnlyBlock");
					$this->tpl->set_var("ViewOnlyBlock", "");
				}
				break;
			case "cancel":
				//header("location: CompanyList.php";
				exit;
				break;
			default:
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
$companyDetails = new CompanyDetails($companyID,$formAction,$sess,$odID);
$companyDetails->main($referer);
?>
<?php page_close(); ?>