<?php 
# Setup PHPLIB in this Area

include_once "../includes/web/prepend.php";
include_once "../includes/assessor/LocationAddress.php";
//include_once "../includes/assessor/Company.php";
//include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
//include_once "../includes/assessor/Owner.php";
//include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/OD.php";

include_once "../includes/assessor/Barangay.php";
include_once "../includes/assessor/BarangayRecords.php";
include_once "../includes/assessor/District.php";
include_once "../includes/assessor/DistrictRecords.php";
include_once "../includes/assessor/MunicipalityCity.php";
include_once "../includes/assessor/MunicipalityCityRecords.php";
include_once "../includes/assessor/Province.php";
include_once "../includes/assessor/ProvinceRecords.php";


#####################################
# Define Interface Class
#####################################
class PropertyInfoEncode{
	
	var $tpl;
	var $formArray;
	var $od;
	
	function PropertyInfoEncode($http_post_vars,$odID="",$formAction="",$sess){
		global $auth;

		$this->sess = $sess;
		$this->userID = $auth->auth["uid"];

		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "PropertyInfoEncode.htm") ;
		$this->tpl->set_var("TITLE", "Encode PropertyInfo");
		
		$this->formArray = array(
			"odID" => $odID
			, "number" => ""
			, "street" => ""
			, "municipalityCity" => ""
			, "province" => ""
			, "houseTagNumber" => ""
			, "barangay" => ""
			, "district" => ""
			, "landArea" => ""
			, "houseTagnumber" => ""
			, "lotNumber" => ""
			, "zoneNumber" => ""
			, "blockNumber" => ""
			, "psd13" => ""
			, "formAction" => $formAction
			);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function initCheckBox($checkboxName){
		$checked = "checked";
		if (!$this->formArray[$checkboxName]) $checked = "";
		$this->tpl->set_var($checkboxName, $checked);
	}
	
	function initSelected($tempVar,$compareTo,$actionStr="selected"){
		if ($this->formArray[$tempVar] == $compareTo){
			$this->tpl->set_var($tempVar."_sel", $actionStr);
		}
		else{
			$this->tpl->set_var($tempVar."_sel", "");
		}
	}
	
	function initMasterAddressList($TempVar, $tempVar){
	    $getList = "get".$TempVar."List";
	    $getID = "get".$TempVar."ID";

		switch($tempVar){
			case "barangay":
				$propertyTable = BARANGAY_TABLE;
				break;
			case "district":
				$propertyTable = DISTRICT_TABLE;
				break;
			case "municipalityCity":
				$propertyTable = MUNICIPALITYCITY_TABLE;
				break;
			case "province":
				$propertyTable = PROVINCE_TABLE;
				break;
	   }
	
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		$TempVarList = new SoapObject(NCCBIZ.$TempVar."List.php", "urn:Object");
        if (!$xmlStr = $TempVarList->$getList(0, " WHERE ".$propertyTable.".status='active' ORDER BY description")){
			switch($tempVar){
				case "barangay":
				case "district":
				case "municipalityCity":
					$this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
					$this->tpl->set_var("JS".$TempVar."ListBlock", "");
					break;
		   }
		   $this->tpl->set_var($tempVar."ID", "");
           $this->tpl->set_var($tempVar, "empty ".$tempVar." list");
		   $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				switch($tempVar){
					case "barangay":
					case "district":
					case "municipalityCity":
						$this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
						$this->tpl->set_var("JS".$TempVar."ListBlock", "");
						break;
			    }
			    $this->tpl->set_var($tempVar."ID", "");
                $this->tpl->set_var($tempVar, "empty ".$tempVar." list");
		        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
			}
			else {
			    switch($tempVar){
			        case "barangay":
			   	       $this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
			           $tempVarRecords = new BarangayRecords;
                       $tempVarID = $getID;
			        break;
			        case "district":
			   	       $this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
			           $tempVarRecords = new DistrictRecords;
			           $tempVarID = $getID;
                    break;
                    case "municipalityCity":
			   	       $this->tpl->set_block("rptsTemplate", "JS".$TempVar."List", "JS".$TempVar."ListBlock");
                       $tempVarRecords = new MunicipalityCityRecords;
                       $tempVarID = $getID;
                    break;
                    case "province":
                       $tempVarRecords = new ProvinceRecords;
                       $tempVarID = $getID;
                    break;
			    }

				$tempVarRecords->parseDomDocument($domDoc);
				$list = $tempVarRecords->getArrayList();
				$i = 0;
				foreach ($list as $key => $value){
          			$this->tpl->set_var($tempVar."ID", $value->$tempVarID());
               		$this->tpl->set_var($tempVar, $value->getDescription());
			        $this->initSelected($tempVar,$value->getDescription());
			        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);

					switch($tempVar){
						case "barangay":
							$this->tpl->set_var("i", $i);
							$this->tpl->set_var("districtID", $value->getDistrictID());
							$this->tpl->parse("JS".$TempVar."ListBlock", "JS".$TempVar."List", true);
	  					    $i++;
						break;
						case "district":
							$this->tpl->set_var("i", $i);
							$this->tpl->set_var("municipalityCityID", $value->getMunicipalityCityID());
							$this->tpl->parse("JS".$TempVar."ListBlock", "JS".$TempVar."List", true);
	  					    $i++;
						break;
						case "municipalityCity":
							$this->tpl->set_var("i", $i);
							$this->tpl->set_var("provinceID", $value->getProvinceID());
							$this->tpl->parse("JS".$TempVar."ListBlock", "JS".$TempVar."List", true);
	  					    $i++;
						break;
					}
				}
			}
		}
	
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
		
        // barangay Listbox	
        $this->initMasterAddressList("Barangay", "barangay");
        // district Listbox	
        $this->initMasterAddressList("District", "district");
        // municipality/city Listbox	
        $this->initMasterAddressList("MunicipalityCity", "municipalityCity");
        // province Listbox	
        $this->initMasterAddressList("Province", "province");
		
		$checked = "checked";
		$this->initCheckBox("affidavitOfOwnership");
		$this->initCheckBox("barangayCertificate");
		$this->initCheckBox("landTagging");
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "edit":
				$ODDetails = new SoapObject(NCCBIZ."ODDetails.php", "urn:Object");
				if (!$xmlStr = $ODDetails->getOD($this->formArray["odID"])){
					exit("xml failed");
				}
				else{
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
							else {
								$this->formArray[$key] = $value;
							}
						}
						$ODEncode = new SoapObject(NCCBIZ."ODEncode.php", "urn:Object");
						$this->formArray["ownerID"] = $ODEncode->getOwnerID($this->formArray["odID"]);
						$OwnerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");
						if (!$xmlStr = $OwnerList->getOwnerList($this->formArray["ownerID"])){
							//exit(print_r($OwnerList));
							$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
							$this->tpl->set_var("OwnerListTableBlock", "");
						}
						else {
							if(!$domDoc = domxml_open_mem($xmlStr)) {
								$this->tpl->set_block("rptsTemplate", "OwnerListTable", "OwnerListTableBlock");
								$this->tpl->set_var("OwnerListTableBlock", "error xmlDoc");
							}
							else {
							}
						}
					}	
				}
				break;
			case "save":
				$PropertyInfoEncode = new SoapObject(NCCBIZ."PropertyInfoEncode.php", "urn:Object");
				if ($this->formArray["odID"] <> ""){
					if (!$xmlStr = $PropertyInfoEncode->getPropertyInfoDetails($this->formArray["odID"])){
						$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "record not found");
					}
					else {
						if(!$domDoc = domxml_open_mem($xmlStr)) {
			 				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
							$this->tpl->set_var("TableBlock", "error xmlDoc");
						}
						else {
							$od = new OD;
							$od->parseDomDocument($domDoc);
							$locationAddress =  $od->locationAddress;
							if (is_a($locationAddress,LocationAddress)){
								$locationAddress->setLocationAddressID($this->formArray["locationAddressID"]);
								$locationAddress->setNumber($this->formArray["number"]);
								$locationAddress->setStreet($this->formArray["street"]);
								$locationAddress->setBarangay($this->formArray["barangay"]);
								$locationAddress->setDistrict($this->formArray["district"]);
								$locationAddress->setMunicipalityCity($this->formArray["municipalityCity"]);
								$locationAddress->setProvince($this->formArray["province"]);
								$locationAddress->setDomDocument();
							}
							$od->setOdID($this->formArray["odID"]);
							$od->setlocationAddress($locationAddress);
							$od->setHouseTagNumber($this->formArray["houseTagNumber"]);
							$od->setLandArea($this->formArray["landArea"]);
							$od->setLotNumber($this->formArray["lotNumber"]);
							$od->setZoneNumber($this->formArray["zoneNumber"]);
							$od->setBlockNumber($this->formArray["blockNumber"]);
							$od->setPsd13($this->formArray["psd13"]);
							$od->setAffidavitOfOwnership($this->formArray["affidavitOfOwnership"]);
							$od->setBarangayCertificate($this->formArray["barangayCertificate"]);
							$od->setLandTagging($this->formArray["landTagging"]);
							$od->setCreatedBy($this->userID);
							$od->setModifiedBy($this->userID);
							$od->setDomDocument();
					
							$doc = $od->getDomDocument();
							$xmlStr =  $doc->dump_mem(true);
							if (!$ret = $PropertyInfoEncode->updatePropertyInfo($xmlStr)){
								echo("error update");
							}
							header("location: PropertyInfoClose.php".$this->sess->url("").$this->sess->add_query(array("odID"=>$ret)));
							exit;
						}
					}
				}
				else {
					$locationAddress = new LocationAddress;
					$locationAddress->setNumber($this->formArray["number"]);
					$locationAddress->setStreet($this->formArray["street"]);
					$locationAddress->setBarangay($this->formArray["barangay"]);
					$locationAddress->setDistrict($this->formArray["district"]);
					$locationAddress->setMunicipalityCity($this->formArray["municipalityCity"]);
					$locationAddress->setProvince($this->formArray["province"]);
					$locationAddress->setDomDocument();
					
					$od = new OD;
					$od->setlocationAddress($locationAddress);
					$od->setHouseTagNumber($this->formArray["houseTagNumber"]);
					$od->setLandArea($this->formArray["landArea"]);
					$od->setLotNumber($this->formArray["lotNumber"]);
					$od->setZoneNumber($this->formArray["zoneNumber"]);
					$od->setBlockNumber($this->formArray["blockNumber"]);
					$od->setPsd13($this->formArray["psd13"]);
					$od->setAffidavitOfOwnership($this->formArray["affidavitOfOwnership"]);
					$od->setBarangayCertificate($this->formArray["barangayCertificate"]);
					$od->setLandTagging($this->formArray["landTagging"]);
					$od->setCreatedBy($this->userID);
					$od->setModifiedBy($this->userID);
					$od->setDomDocument();
					//echo hello;
					$doc = $od->getDomDocument();
					$xmlStr =  $doc->dump_mem(true);
					if (!$ret = $PropertyInfoEncode->savePropertyInfo($xmlStr)){
						//echo("ret=".$ret);
					}
					$this->formArray["odID"] = $ret;
					header("location: PropertyInfoClose.php".$this->sess->url("").$this->sess->add_query(array("odID"=>$ret)));
					//echo $PropertyInfoEncode->getPropertyInfoDetails($ret);
					exit($ret);
				}
				break;
			case "cancel":
				header("location: PropertyInfoList.php";
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
$odEncode = new PropertyInfoEncode($HTTP_POST_VARS,$odID,$formAction,$sess);
$odEncode->Main();
?>
<?php page_close(); ?>
