<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "./clibPDFWriter.php";

include_once "../assessor/Person.php";

include_once "../assessor/User.php";
include_once "../assessor/UserRecords.php";

include_once "../assessor/Address.php";
include_once "../assessor/Company.php";
include_once "../assessor/CompanyRecords.php";
include_once "../assessor/Person.php";
include_once "../assessor/PersonRecords.php";
include_once "../assessor/Owner.php";
include_once "../assessor/OwnerRecords.php";
include_once "../assessor/RPTOP.php";
include_once "../assessor/RPTOPRecords.php";

include_once "../assessor/TD.php";
include_once "../assessor/AFS.php";
include_once "../assessor/Land.php";
include_once "../assessor/PlantsTrees.php";
include_once "../assessor/ImprovementsBuildings.php";
include_once "../assessor/Machineries.php";

include_once "../assessor/LandActualUses.php";
include_once "../assessor/PlantsTreesActualUses.php";
include_once "../assessor/ImprovementsBuildingsActualUses.php";
include_once "../assessor/MachineriesActualUses.php";

include_once "../assessor/eRPTSSettings.php";

#####################################
# Define Interface Class
#####################################
class CertificateOfLandHoldingPrint{
	
	var $tpl;
	var $formArray;
	function CertificateOfLandHoldingPrint($sess,$formAction,$formArray,$personCompanyID){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "landHolding1.xml") ;
		$this->tpl->set_var("TITLE", "Certificate of Land Holding");

		$this->formArray = $formArray;
		$this->formArray["personCompanyIDArray"] = $personCompanyID;
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
				$this->tpl->set_var("lguName", $this->formArray["lguName"]);
				$this->tpl->set_var("lguType", $this->formArray["lguType"]);
			}
		}
	}
	
	function setForm(){
		$this->formArray["date"] = date("F d, Y");
		$this->formArray["orDate"] = date("F d, Y", strtotime($this->formArray["orDate_year"]."-".putPreZero($this->formArray["orDate_month"])."-".putPreZero($this->formArray["orDate_day"])));
		$this->formArray["dateIssued"] = date("jS \d\a\y of F, Y");

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

	function sortRPTOPOwner($owner){
		$ownerName = "";

		if(!is_object($owner)) return false;

		if(is_array($owner->getPersonArray())){
			$personArray = $owner->getPersonArray();
			$o=0;
			foreach($personArray as $person){
				$ownerArray[str_replace(" ", "",$person->getName()).$o] = " ".$person->getName();
				$o++;
			}
		}
		if(is_array($owner->getCompanyArray())){
			$companyArray = $owner->getCompanyArray();
			$o=0;
			foreach($companyArray as $company){
				$ownerArray[str_replace(" ", "",$company->getCompanyName()).$o] = " ".$company->getCompanyName();
				$o++;
			}
		}
		if(is_array($ownerArray)){
			ksort($ownerArray);
			reset($ownerArray);

			foreach($ownerArray as $name){
				if($ownerName!=""){
					$ownerName .= ", ";
				}
				$ownerName .= $name;
			}
			return $ownerName;
		}
		return false;
	}

	function getLandActualUsesText($landActualUsesID){
		$LandActualUsesDetails = new SoapObject(NCCBIZ."LandActualUsesDetails.php", "urn:Object");
		if(!$xmlStr = $LandActualUsesDetails->getLandActualUsesDetails($landActualUsesID)){
			return $landActualUsesID;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return $landActualUsesID;
			}
			else{
				$landActualUses = new LandActualUses;
				$landActualUses->parseDomDocument($domDoc);
				return $landActualUses->getDescription();
			}
		}
	}

	function getPlantsTreesActualUsesText($plantsTreesActualUsesID){
		$PlantsTreesActualUsesDetails = new SoapObject(NCCBIZ."PlantsTreesActualUsesDetails.php", "urn:Object");
		if(!$xmlStr = $PlantsTreesActualUsesDetails->getPlantsTreesActualUsesDetails($plantsTreesActualUsesID)){
			return $plantsTreesActualUsesID;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return $plantsTreesActualUsesID;
			}
			else{
				$plantsTreesActualUses = new PlantsTreesActualUses;
				$plantsTreesActualUses->parseDomDocument($domDoc);
				return $plantsTrees->getDescription();
			}
		}
	}

	function getImprovementsBuildingsActualUsesText($improvementsBuildingsActualUsesID){
		$ImprovementsBuildingsActualUsesDetails = new SoapObject(NCCBIZ."ImprovementsBuildingsActualUsesDetails.php", "urn:Object");
		if(!$xmlStr = $ImprovementsBuildingsActualUsesDetails->getImprovementsBuildingsActualUsesDetails($improvementsBuildingsActualUsesID)){
			return $improvementsBuildingsActualUsesID."xx";
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return $improvementsBuildingsActualUsesID."yy";
			}
			else{
				$improvementsBuildingsActualUses = new ImprovementsBuildingsActualUses;
				$improvementsBuildingsActualUses->parseDomDocument($domDoc);
				return $improvementsBuildingsActualUses->getDescription();
			}
		}
	}

	function getMachineriesActualUsesText($machineriesActualUsesID){
		$MachineriesActualUsesDetails = new SoapObject(NCCBIZ."MachineriesActualUsesDetails.php", "urn:Object");
		if(!$xmlStr = $MachineriesActualUsesDetails->getMachineriesActualUsesDetails($machineriesActualUsesID)){
			return $machineriesActualUsesID;
		}
		else{
			if(!$domDoc = domxml_open_mem($xmlStr)){
				return $machineriesActualUsesID;
			}
			else{
				$machineriesActualUses = new MachineriesActualUses;
				$machineriesActualUses->parseDomDocument($domDoc);
				return $machineriesActualUses->getDescription();
			}
		}
	}

	function getTDNumberListLine($td){
		if(is_object($td)){
			$tdNumber = $td->getTaxDeclarationNumber();
			$propertyType = $td->getPropertyType();
			$afsID = $td->getAfsID();;

			// get classification
			$AFSDetails = new SoapObject(NCCBIZ."AFSDetails.php", "urn:Object");
			if(!$xmlStr = $AFSDetails->getAFS($afsID)){
				$classification = "";
			}
			else{
				if(!$domDoc = domxml_open_mem($xmlStr)){
					$classification = "";
				}
				else{
					$afs = new AFS;
					$afs->parseDomDocument($domDoc);
					switch($propertyType){
						case "ImprovementsBuildings":
							$improvementsBuildingsArray = $afs->getImprovementsBuildingsArray();
							if(is_array($improvementsBuildingsArray)){
								$classification = $improvementsBuildingsArray[0]->getActualUse();
								if(is_numeric($classification)){
									$classification = $this->getImprovementsBuildingsActualUsesText($classification);
								}
							}
							break;
						case "Machineries":
							$machineriesArray = $afs->getMachineriesArray();
							if(is_array($machineriesArray)){
								$classification = $machineriesArray[0]->getActualUse();
								if(is_numeric($classification)){
									$classification = $this->getMachineriesActualUsesText($classification);
								}
							}
							break;
						case "Land":
						default:
							$landArray = $afs->getLandArray();
							$plantsTreesArray = $afs->getPlantsTreesArray();

							if(is_array($landArray)){
								$classification = $landArray[0]->getActualUse();
								if(is_numeric($classification)){
									$classification = $this->getLandActualUsesText($classification);
								}
							}
							else if(is_array($plantsTreesArray)){
								$classification = $plantsArray[0]->getActualUse();
								if(is_numeric($classification)){
									$classification = $this->getPlantsTreesActualUsesText($classification);
								}
							}
					}
				}
			}

			$tdNumberListLine = "\t \t \t \t \t " . $tdNumber . " --- " . $propertyType . " --- " . $classification;
			return $tdNumberListLine;
		}
		return "";
	}

	function getTDArrayFromOwner($personCompanyID){
		switch($this->formArray["ownerType"]){
			case "Company":
				$tdArray = $this->getTDArrayFromCompany($personCompanyID);
				break;
			case "Person":
			default:
				$tdArray = $this->getTDArrayFromPerson($personCompanyID);
				break;
		}

		return $tdArray;
	}

	function getTDArrayFromPerson($personID){
		$this->setDB();
		$sql = sprintf(
			"SELECT DISTINCT(Owner.odID) as odID".
			" FROM Owner,OwnerPerson ".
			" WHERE ".
			" Owner.ownerID = OwnerPerson.ownerID AND ".
			" OwnerPerson.personID = '%s' ",
			$personID);

		$this->db->query($sql);	

		while ($this->db->next_record()) {
			$od = new OD;
			if($od->selectRecord($this->db->f("odID"))){
				$this->ODArray[] = $od;

				$afs = new AFS;
				if($afs->selectRecord("","",$od->getOdID(),"")){
					$td = new TD;
					if($td->selectRecord("",$afs->getAfsID(),"","","")){
						$tdArray[] = $td;
					}
				}
			}
		}

		if(!is_array($tdArray)) $tdArray=false;

		return $tdArray;
	}

	function getTDArrayFromCompany($companyID){
		$this->setDB();
		$sql = sprintf(
			"SELECT DISTINCT(Owner.odID) as odID".
			" FROM Owner,OwnerCompany ".
			" WHERE ".
			" Owner.ownerID = OwnerCompany.ownerID AND ".
			" OwnerCompany.companyID = '%s' ",
			$companyID);

		$this->db->query($sql);	

		while ($this->db->next_record()) {
			$od = new OD;
			if($od->selectRecord($this->db->f("odID"))){
				$this->ODArray[] = $od;

				$afs = new AFS;
				if($afs->selectRecord("","",$od->getOdID(),"")){
					$td = new TD;
					if($td->selectRecord("",$afs->getAfsID(),"","","")){
						$tdArray[] = $td;
					}
				}
			}
		}

		if(!is_array($tdArray)) $tdArray=false;

		return $tdArray;
	}

	function setDB(){
		$this->db = new DB_RPTS;
	}

	function Main(){
		$this->getSignatory();

		if(is_array($this->formArray["personCompanyIDArray"])){
			$this->tpl->set_block("rptsTemplate", "Page", "PageBlock");
			foreach($this->formArray["personCompanyIDArray"] as $personCompanyID){
				$this->tpl->set_var("pageNumber", $this->pageNumber);

				switch($this->formArray["ownerType"]){
					case "Company":
						$company = new Company;
						$company->selectRecord($personCompanyID);
						$nameList = $company->getCompanyName();
						break;
					case "Person":
					default:
						$person = new Person;
						$person->selectRecord($personCompanyID);
						$nameList = $person->getName();
						break;
				}

				$this->tpl->set_var("nameList", $nameList);

				$tdNumberList = "";

				$tdArray = $this->getTDArrayFromOwner($personCompanyID);

				if(is_array($tdArray)){
					foreach($tdArray as $td){
						if($tdNumberList!=""){
							$tdNumberList .= "\n";
						}
						$tdNumberList .= $this->getTDNumberListLine($td);
					}
				}

				$this->tpl->set_var("tdNumberList",$tdNumberList);

				$this->tpl->parse("PageBlock", "Page", true);
				$this->pageNumber++;
			}
		}
		else{
			exit("no owners selected");
		}

		$this->setLguDetails();
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

$certificateOfLandHoldingPrint = new CertificateOfLandHoldingPrint($sess,$formAction,$formArray,$personCompanyID);
$certificateOfLandHoldingPrint->Main();
?>
<?php page_close(); ?>