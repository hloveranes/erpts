<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/web/clibPDFWriter.php";

include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/User.php";
include_once "../includes/assessor/UserRecords.php";
include_once "../includes/assessor/eRPTSSettings.php";

#####################################
# Define Interface Class
#####################################
class NoticeOfAssessmentPrint{
	
	var $tpl;
	var $formArray;
	function NoticeOfAssessmentPrint($http_post_vars,$sess,$formAction,$formArray,$personID,$companyID){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "noticeOfAssessment.xml") ;
		$this->tpl->set_var("TITLE", "Notice of Assessment");

		$this->formArray = $formArray;
		$this->formArray["personIDArray"] = $personID;
		$this->formArray["companyIDArray"] = $companyID;

		$this->pageNumber = 1;
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
			}
		}
	}
	
	function setForm(){
		$this->setLguDetails();

		$this->formArray["date"] = date("F d, Y");

		$this->formArray["namesOfRepresentatives"] = strtoupper($this->formArray["namesOfRepresentatives"]);
		$this->formArray["signatory"] = strtoupper($this->formArray["signatory"]);

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key,$value);
		}
	}

	function getCompany($companyID){
		$company = new Company;
		if($company->selectRecord($companyID)){
			return $company;
		}
		else{
			return false;
		}
	}

	function getPerson($personID){
		$person = new Person;
		if($person->selectRecord($personID)){
			return $person;
		}
		else{
			return false;
		}
	}

	function getSignatory(){
		if(!$person = $this->getPerson($this->formArray["signatoryID"])){
			$this->formArray["signatory"] = "";
		}
		else{
			$this->formArray["signatory"] = $person->getName();
		}
	}

	function printCompanyOwners(){
		if(is_array($this->formArray["companyIDArray"])){
			$this->tpl->set_block("rptsTemplate", "Page", "PageBlock");
			foreach($this->formArray["companyIDArray"] as $companyID){
				if(!$company = $this->getCompany($companyID)){
					$this->tpl->set_var("ownerName","");
					$this->tpl->set_var("ownerAddress","");
				}
				else{
					$this->tpl->set_var("ownerName",strtoupper(ampersandToAnd($company->getCompanyName())));
					if(is_array($company->addressArray)){
						$address = $company->addressArray[0];
						$this->tpl->set_var("ownerAddress", strtoupper($address->getFullAddress()));
					}
					$this->tpl->set_var("pageNumber",$this->pageNumber);
					$this->tpl->parse("PageBlock", "Page", true);
					$this->pageNumber++;
				}
			}
		}
		else{
			exit("no owners selected");
		}
	}

	function printPersonOwners(){
		if(is_array($this->formArray["personIDArray"])){
			$this->tpl->set_block("rptsTemplate", "Page", "PageBlock");
			foreach($this->formArray["personIDArray"] as $personID){
				if(!$person = $this->getPerson($personID)){
					$this->tpl->set_var("ownerName","");
					$this->tpl->set_var("ownerAddress","");
				}
				else{
					$this->tpl->set_var("ownerName",strtoupper(ampersandToAnd($person->getName())));
					if(is_array($person->addressArray)){
						$address = $person->addressArray[0];
						$this->tpl->set_var("ownerAddress", strtoupper($address->getFullAddress()));
					}
					$this->tpl->set_var("pageNumber",$this->pageNumber);
					$this->tpl->parse("PageBlock", "Page", true);
					$this->pageNumber++;
				}
			}
		}
		else{
			exit("no owners selected");
		}
	}

	function Main(){
		$this->getSignatory();

		switch($this->formArray["ownerType"]){
			case "Company":
				$this->printCompanyOwners();
				break;
			case "Person":
			default:
				$this->printPersonOwners();
				break;
		}

		$this->setForm();

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
	//,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/

$noticeOfAssessmentPrint = new NoticeOfAssessmentPrint($http_post_vars,$sess,$formAction,$formArray,$personID,$companyID);
$noticeOfAssessmentPrint->Main();
?>
<?php page_close(); ?>