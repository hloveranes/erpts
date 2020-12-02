<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/web/clibPDFWriter.php";

include_once "../includes/assessor/eRPTSSettings.php";
include_once "../includes/assessor/Barangay.php";

#####################################
# Define Interface Class
#####################################
class TaxRollPrint{
	
	var $tpl;
	var $formArray;

	function TaxRollPrint($sess,$barangayID){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->formArray = array(
			"barangayID" => $barangayID

			,"pageNumber" => 1
			,"trYPos" => 616
			,"stYPos" => 586
			,"gtYPos" => 566
			,"taxRollLinesPerPage" => 44

			,"lguType" => ""
			,"lguName" => ""
			,"month" => ""
			,"year" => ""
			,"barangay" => ""
			,"ownerName" => ""
			,"taxDeclarationNumber" => ""
			,"actualUse" => ""
			,"assessedValue" => "0.00"
			,"basicTax" => "0.00"
			,"sefTax" => "0.00"
			,"total" => "0.00"
			,"stAssessedValue" => "0.00"
			,"stBasicTax" => "0.00"
			,"stSefTax" => "0.00"
			,"stTotal" => "0.00"
			,"gtAssessedValue" => "0.00"
			,"gtBasicTax" => "0.00"
			,"gtSefTax" => "0.00"
			,"gtTotal" => "0.00"
			);

		$this->tpl->set_file("rptsTemplate", "taxRoll.xml") ;
		$this->tpl->set_var("TITLE", "Tax Roll");

	}

	function formatCurrency($key){
		if($this->formArray[$key]!=""){
			$this->formArray[$key] = number_format($this->formArray[$key], 2, ".", ",");
		}
	}

	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, html_entity_to_alpha($value));
		}
	}

	function getBarangay(){
		$barangay = new Barangay;
		$barangay->selectRecord($this->formArray["barangayID"]);
		$this->formArray["barangay"] = $barangay->getDescription();
	}

	function getLGUName(){
		$eRPTSSettings = new eRPTSSettings;
		$eRPTSSettings->selectRecord(1);

		$this->formArray["lguType"] = strtoupper($eRPTSSettings->getLguType());
		$this->formArray["lguName"] = strtoupper($eRPTSSettings->getLguName());
	}

	function displayPageHeading(){
		$this->getLGUName();
		$this->getBarangay();

		$this->formArray["month"] = date("F");
		$this->formArray["year"] = date("Y");

		$this->tpl->set_var("lguType", $this->formArray["lguType"]);
		$this->tpl->set_var("lguName", $this->formArray["lguName"]);

		$this->tpl->set_var("month", $this->formArray["month"]);
		$this->tpl->set_var("year", $this->formArray["year"]);

		$this->tpl->set_var("barangay", $this->formArray["barangay"]);
	}

	function getOwnerName($ownerID){
		$db = new DB_RPTS;

		// person
		$sql = "SELECT "
			."Person.firstName as firstName "
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
		}

		unset($db);

		$db = new DB_RPTS;

		// company
		$sql = "SELECT "
			."Company.companyName "
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

	function getActualUseSQL($actualUseTable,$propertyTable,$actualUseIDField,$afsID){
		$sql = "SELECT"
			." ".$actualUseTable.".code as actualUse"
			." FROM"
			." ".$actualUseTable.", ".$propertyTable.""
			." WHERE"
			." ".$propertyTable.".afsID = ".$afsID
			." AND"
			." ".$propertyTable.".actualUse = ".$actualUseTable.".".$actualUseIDField." LIMIT 1;";

		return $sql;
	}

	function getActualUse($afsID,$propertyType){
		$db = new DB_RPTS;
		switch($propertyType){
			case "ImprovementsBuildings":
				$propertyTable = IMPROVEMENTSBUILDINGS_TABLE;
				$actualUseTable = IMPROVEMENTSBUILDINGS_ACTUALUSES_TABLE;
				$actualUseIDField = "improvementsBuildingsActualUsesID";
				$sql = $this->getActualUseSQL($actualUseTable,$propertyTable,$actualUseIDField,$afsID);
				$db->query($sql);
				if(!$db->next_record()) return false;
				break;
			case "Machineries":
				$propertyTable = MACHINERIES_TABLE;
				$actualUseTable = MACHINERIES_ACTUALUSES_TABLE;
				$actualUseIDField = "machineriesActualUsesID";
				$sql = $this->getActualUseSQL($actualUseTable,$propertyTable,$actualUseIDField,$afsID);
				$db->query($sql);
				if(!$db->next_record()) return false;
				break;
			case "Land":
			default:
				// Land
				$propertyTable = LAND_TABLE;
				$actualUseTable = LAND_ACTUALUSES_TABLE;
				$actualUseIDField = "landActualUsesID";
				$sql = $this->getActualUseSQL($actualUseTable,$propertyTable,$actualUseIDField,$afsID);
				$db->query($sql);
				if(!$db->next_record()){
					// PlantsTrees
					$propertyTable = PLANTSTREES_TABLE;
					$actualUseTable = PLANTSTREES_ACTUALUSES_TABLE;
					$actualUseIDField = "plantsTreesActualUsesID";
					$sql = $this->getActualUseSQL($actualUseTable,$propertyTable,$actualUseIDField,$afsID);
					$db->query($sql);
					if(!$db->next_record()) return false;
				}
		}
		return $db->f("actualUse");		
	}

	function getTaxRollArrayList(){
		$db = new DB_RPTS;
		$db2 = new DB_RPTS;
		$db3 = new DB_RPTS;

		// filter rptopID by location
		// and sort by owner

		$sql = "SELECT Owner.ownerID as ownerID, Owner.rptopID as rptopID"
				." FROM Owner"
				." WHERE Owner.rptopID!=''";

		$db->query($sql);
		while($db->next_record()){
			$sql = "SELECT RPTOPTD.tdID as tdID "
					.",TD.taxDeclarationNumber as taxDeclarationNumber "
					.",TD.propertyType as propertyType "
					.", AFS.afsID as afsID "
					.", AFS.totalAssessedValue as totalAssessedValue "
					.", Barangay.description as barangay "
					."FROM RPTOPTD, TD, AFS, Location, LocationAddress, Barangay "
					."WHERE "
					."TD.tdID = RPTOPTD.tdID "
					."AND TD.afsID = AFS.afsID "
					."AND AFS.odID = Location.odID "
					."AND LocationAddress.locationAddressID = Location.locationAddressID "
					."AND LocationAddress.barangayID = Barangay.barangayID "
					."AND Barangay.barangayID = ".$this->formArray["barangayID"]." "
					."AND RPTOPTD.rptopID = ".$db->f("rptopID");
			$db2->query($sql);
			$i=0;
			while($db2->next_record()){
				$basicTax = "";
				$sefTax = "";

				$sql = "SELECT"
						." Due.basicTax as basicTax"
						.", Due.sefTax as sefTax"
						." FROM Due"
						." WHERE"
						." Due.dueType='Annual'"
						." AND Due.tdID=".$db2->f("tdID");
				$db3->query($sql);

				while($db3->next_record()){
					$basicTax += $db3->f("basicTax");
					$sefTax += $db3->f("sefTax");
				}

				if($basicTax!="" && $sefTax!=""){
					$ownerName = $this->getOwnerName($db->f("ownerID"));
					$taxRollRecordArray = array(
						"barangay" => $db2->f("barangay")
						,"tdID" => $db2->f("tdID")
						,"ownerName" => $ownerName
						,"taxDeclarationNumber" => $db2->f("taxDeclarationNumber")
						,"actualUse" => $this->getActualUse($db2->f("afsID"),$db2->f("propertyType"))
						,"assessedValue" => $db2->f("totalAssessedValue")
						,"basicTax" => $basicTax
						,"sefTax" => $sefTax
						,"total" => $basicTax + $sefTax
					);
					$taxRollArrayList[trim($ownerName).$i] = $taxRollRecordArray;
					$i++;
				}
			}
		}

		if(is_array($taxRollArrayList)){
			ksort($taxRollArrayList);
			reset($taxRollArrayList);
			return $taxRollArrayList;
		}
		else{
			return false;
		}
	}

	function Main(){
		$this->displayPageHeading();

		$this->tpl->set_block("rptsTemplate", "Page", "PageBlock");
		$this->tpl->set_block("Page", "TaxRollList", "TaxRollListBlock");
		$this->tpl->set_block("Page", "GrandTotal", "GrandTotalBlock");

		$taxRollArrayList = $this->getTaxRollArrayList();

		if(!is_array($taxRollArrayList)){
			exit("no results found for the selected barangay in tax roll or empty database");
		}

		$trLineCounter = 0;
		$trCount = count($taxRollArrayList);

		$numOfPages = ceil($trCount / $this->formArray["taxRollLinesPerPage"]);

		foreach($taxRollArrayList as $key => $value){
			$keyArray[] = $key;
		}

		for($taxRollCounter=0 ; $taxRollCounter <= $trCount ; $taxRollCounter++){
			if(($trLineCounter==$this->formArray["taxRollLinesPerPage"]) || ($taxRollCounter==$trCount)){
				$this->formArray["stYPos"] = $this->formArray["trYPos"] - 30;
				$this->formArray["gtYPos"] = $this->formArray["stYPos"] - 20;

				$this->tpl->set_var("stYPos", $this->formArray["stYPos"]);
				$this->tpl->set_var("gtYPos", $this->formArray["gtYPos"]);

				$this->tpl->set_var("stAssessedValue", formatCurrency($this->formArray["stAssessedValue"]));
				$this->tpl->set_var("stBasicTax", formatCurrency($this->formArray["stBasicTax"]));
				$this->tpl->set_var("stSefTax", formatCurrency($this->formArray["stSefTax"]));
				$this->tpl->set_var("stTotal", formatCurrency($this->formArray["stTotal"]));

				if($this->formArray["pageNumber"]<$numOfPages){
					$this->tpl->set_var("GrandTotalBlock", "");
				}
				else{
					$this->tpl->set_var("gtAssessedValue", formatCurrency($this->formArray["gtAssessedValue"]));
					$this->tpl->set_var("gtBasicTax", formatCurrency($this->formArray["gtBasicTax"]));
					$this->tpl->set_var("gtSefTax", formatCurrency($this->formArray["gtSefTax"]));
					$this->tpl->set_var("gtTotal", formatCurrency($this->formArray["gtTotal"]));

					$this->tpl->parse("GrandTotalBlock", "GrandTotal", false);
				}

				$this->tpl->set_var("pageNumber",$this->formArray["pageNumber"]);
				$this->tpl->parse("PageBlock", "Page", true);
				$this->tpl->set_var("TaxRollListBlock", "");
				$this->formArray["pageNumber"]++;
				$this->formArray["trYPos"] = 616;
				$trLineCounter=0;
			}

			$taxRollRecordArray = $taxRollArrayList[$keyArray[$taxRollCounter]];

			if(strlen($taxRollRecordArray["ownerName"]) > 20){
				$this->tpl->set_var("ownerName", substr($taxRollRecordArray["ownerName"],0,25)."-");
				$this->tpl->set_var("ownerName2", substr($taxRollRecordArray["ownerName"],25));
				$trYpos2 = $this->formArray["trYPos"] - 12;
			}
			else{
				$this->tpl->set_var("ownerName", $taxRollRecordArray["ownerName"]);
				$this->tpl->set_var("ownerName2", "");
				$trYpos2=0;
			}

			$this->tpl->set_var("taxDeclarationNumber", $taxRollRecordArray["taxDeclarationNumber"]);
			$this->tpl->set_var("actualUse", $taxRollRecordArray["actualUse"]);
			$this->tpl->set_var("assessedValue", formatCurrency($taxRollRecordArray["assessedValue"]));
			$this->tpl->set_var("basicTax", formatCurrency($taxRollRecordArray["basicTax"]));
			$this->tpl->set_var("sefTax", formatCurrency($taxRollRecordArray["sefTax"]));
			$this->tpl->set_var("total", formatCurrency($taxRollRecordArray["total"]));

			$this->formArray["stAssessedValue"] += $taxRollRecordArray["assessedValue"];
			$this->formArray["stBasicTax"] += $taxRollRecordArray["basicTax"];
			$this->formArray["stSefTax"] += $taxRollRecordArray["sefTax"];
			$this->formArray["stTotal"] += $taxRollRecordArray["total"];

			$this->formArray["gtAssessedValue"] += $taxRollRecordArray["assessedValue"];
			$this->formArray["gtBasicTax"] += $taxRollRecordArray["basicTax"];
			$this->formArray["gtSefTax"] += $taxRollRecordArray["sefTax"];
			$this->formArray["gtTotal"] += $taxRollRecordArray["total"];

			$this->tpl->set_var("trYPos", $this->formArray["trYPos"]);
			$this->tpl->set_var("trYPos2", $trYpos2);

			$this->formArray["trYPos"] -= 12;
			if($trYpos2>0){
				$this->formArray["trYPos"] -= 12;
			}
			$this->tpl->parse("TaxRollListBlock", "TaxRollList", true);
			
			$trLineCounter++;

		}



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

$taxRollPrint = new TaxRollPrint($sess,$barangayID);
$taxRollPrint->Main();
?>
<?php page_close(); ?>