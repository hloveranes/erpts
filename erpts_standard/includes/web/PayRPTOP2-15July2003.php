<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";

include_once "../assessor/Barangay.php";

include_once "../assessor/Address.php";
include_once "../assessor/Company.php";
include_once "../assessor/CompanyRecords.php";
include_once "../assessor/Person.php";
include_once "../assessor/PersonRecords.php";
include_once "../assessor/Owner.php";
include_once "../assessor/OwnerRecords.php";
include_once "../assessor/RPTOP.php";
include_once "../assessor/AFS.php";

#####################################
# Define Interface Class
#####################################
class RPTOPDetails{
	
	var $tpl;
	var $formArray;
	function RPTOPDetails($http_post_vars,$sess,$rptopID){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd());

		$this->tpl->set_file("rptsTemplate", "PayRPTOP2.htm") ;
		$this->tpl->set_var("TITLE", "Owner List");
		$this->formArray = array(
			"cityAssessorName" => ""
			, "cityTreasurerName" => ""
		);
		$this->formArray["rptopID"] = $rptopID;
			
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
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
		$RPTOPDetails = new SoapObject(NCCBIZ."RPTOPDetails.php", "urn:Object");
		if (!$xmlStr = $RPTOPDetails->getRPTOP($this->formArray["rptopID"])){
			exit("xml failed");
		}
		else{
			//echo $xmlStr;
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
				$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
			}
			else {
				$rptop = new RPTOP;
				$rptop->parseDomDocument($domDoc);
				foreach($rptop as $key => $value){
					switch ($key){
						case "owner":
							//$RPTOPEncode = new SoapObject(NCCBIZ."RPTOPEncode.php", "urn:Object");
							if (is_a($value,"Owner")){
								$this->formArray["ownerID"] = $rptop->owner->getOwnerID();
								$xmlStr = $rptop->owner->domDocument->dump_mem(true);
								if (!$xmlStr){
									$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
									$this->tpl->set_var("OwnerListTableBlock", "");
								}
								else {
									if(!$domDoc = domxml_open_mem($xmlStr)) {
										$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
										$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
									}
									else {
										$this->displayOwnerList($domDoc);
									}
								}
							}
							else {
								$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
								$this->tpl->set_var("PersonListBlock", "");
								$this->tpl->set_block("rptsTemplate", "CompanyList", "CompanyListBlock");
								$this->tpl->set_var("CompanyListBlock", "");
							}
						break;
						case "tdArray":
							$this->tpl->set_block("rptsTemplate", "TDList", "TDListBlock");
							$tdCtr = 0;
							if (count($value)){
								$this->tpl->set_block("rptsTemplate", "TDDBEmpty", "TDDBEmptyBlock");
								$this->tpl->set_var("TDDBEmptyBlock", "");
								foreach($value as $tkey => $tvalue){
									$propertyType = $tvalue->getPropertyType();
									$propertyID = $tvalue->getPropertyID();
									switch ($propertyType){
										case "Land":
											$property = new Land;
										break;
										case "PlantsTrees":
											$property = new PlantsTrees;
										break;
										case "ImprovementsBuildings":
											$property = new ImprovementsBuildings;
										break;
										case "Machineries":
											$property = new Machineries;
										break;
										default:
									}
									if(is_object($property)) $property->selectRecord($propertyID);
						            $listValues['tdNum'] = $tvalue->getTaxDeclarationNumber();
						            $listValues['propertyIndexNumber'] = $property->getPropertyIndexNumber();
						            $listValues['assessedValue'] = number_format($property->getAssessedValue(),2);
						            $this->tpl->set_var($listValues);
									$this->tpl->set_var("ctr", $tdCtr);
									$this->tpl->set_var("tdID", $tvalue->getTdID());
                                    $this->tpl->parse("TDListBlock", "TDList", true);
									$tdCtr++;
								}
							}
							else {
								$this->tpl->set_var("TDListBlock", "");
							}
							$this->tpl->set_var("tdCtr", $tdCtr);
						break;
						default:
						$this->formArray[$key] = $value;
					}
				}
			}	
		}
		$this->setForm();
		$this->tpl->set_var("Session", $this->sess->url("").$this->sess->add_query(array("rptopID"=>$this->formArray["rptopID"],"ownerID" => $this->formArray["ownerID"])));
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
page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/
$ownerList = new RPTOPDetails($HTTP_POST_VARS,$sess,$rptopID);
$ownerList->main();
?>
<?php page_close(); ?>
