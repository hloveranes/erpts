<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "./clibPDFWriter.php";

include_once "../assessor/Person.php";

include_once "../assessor/User.php";
include_once "../assessor/UserRecords.php";

#####################################
# Define Interface Class
#####################################
class CertificateOfLandHoldingPrint{
	
	var $tpl;
	var $formArray;
	function CertificateOfLandHoldingPrint($sess,$formAction,$formArray,$nameList){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "landHolding2.xml") ;
		$this->tpl->set_var("TITLE", "Certificate of Land Holding - without Properties");

		$this->formArray = $formArray;
		$this->formArray["nameListArray"] = $nameList;
		$this->formArray["formAction"] = $formAction;

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
		$this->formArray["date"] = date("F d, Y");

		if($this->formArray["orDate_year"]!="" && $this->formArray["orDate_month"]!="" && $this->formArray["orDate_day"]!=""){
			$this->formArray["orDate"] = date("F d, Y", strtotime($this->formArray["orDate_year"]."-".putPreZero($this->formArray["orDate_month"])."-".putPreZero($this->formArray["orDate_day"])));
		}
		else{
			$this->formArray["orDate"] = "";
		}

		foreach($this->formArray as $key => $value){
			$this->tpl->set_var($key,$value);
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

	function Main(){
		$this->getSignatory();

		if(is_array($this->formArray["nameListArray"])){
			$this->tpl->set_block("rptsTemplate", "Page", "PageBlock");
			foreach($this->formArray["nameListArray"] as $nameList){
				$this->tpl->set_var("pageNumber", $this->pageNumber);

				$this->tpl->set_var("nameList", $nameList);
				$this->tpl->parse("PageBlock", "Page", true);
				$this->pageNumber++;
			}
		}
		else{
			exit("no persons/companies to issue to certificate to");
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

$certificateOfLandHoldingPrint = new CertificateOfLandHoldingPrint($sess,$formAction,$formArray,$nameList);
$certificateOfLandHoldingPrint->Main();
?>
<?php page_close(); ?>