<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";

include_once "../assessor/OD.php";
include_once "../assessor/ODRecords.php";
include_once "../assessor/AFS.php";
include_once "../assessor/AFSRecords.php";

include_once "../assessor/Barangay.php";
include_once "../assessor/BarangayRecords.php";
include_once "../assessor/District.php";
include_once "../assessor/DistrictRecords.php";
include_once "../assessor/MunicipalityCity.php";
include_once "../assessor/MunicipalityCityRecords.php";
include_once "../assessor/Province.php";
include_once "../assessor/ProvinceRecords.php";

#####################################
# Define Interface Class
#####################################
class ListOfRPUsCancelled{
	
	var $tpl;
	function ListOfRPUsCancelled($sess){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must have atleast AM-VIEW access
		$pageType = "%%1%%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ListOfRPUsCancelled.htm") ;
		$this->tpl->set_var("TITLE", "List of RPUs Cancelled");
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
			        $this->initSelected($tempVar,$value->$tempVarID());

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

	function hideBlock($tempVar){
		$this->tpl->set_block("rptsTemplate", $tempVar, $tempVar."Block");
		$this->tpl->set_var($tempVar."Block", "");
	}

	function setPageDetailPerms(){
		if(!checkPerms($this->user["userType"],"%1%%%%%%%%")){
			// hide Blocks if userType is not at least AM-Edit
			$this->hideBlock("TransactionsLink");
		}
		else{
			$this->hideBlock("TransactionsLinkText");
		}
	}

	function initSelected($tempVar,$compareTo,$actionStr="selected"){
		if ($this->formArray[$tempVar] == $compareTo){
			$this->tpl->set_var($tempVar."_sel", $actionStr);
		}
		else{
			$this->tpl->set_var($tempVar."_sel", "");
		}
	}

	function setDateDropDown($type){
		$startYear = 1970;
		$endYear = date("Y");
		$this->tpl->set_block("rptsTemplate", $type."YearList", $type."YearListBlock");
		for($i = $endYear; $i>=$startYear; $i--){
			$this->tpl->set_var($type."yearValue", $i);
			$this->initSelected($type."year",$i);
			$this->tpl->parse($type."YearListBlock", $type."YearList", true);
		}
		
		eval(MONTH_ARRAY);//$monthArray
		$this->tpl->set_block("rptsTemplate", $type."MonthList", $type."MonthListBlock");
		foreach($monthArray as $key => $value){
			$this->tpl->set_var($type."monthValue", $key);
			$this->tpl->set_var($type."month", $value);
			$this->initSelected($type."month",$key);
			$this->tpl->parse($type."MonthListBlock", $type."MonthList", true);
		}

		$currentMonth = date("n");
		$currentYear = date("Y");
		$maxDaysForMonth = 31;
		switch($currentMonth){
			case "2":
				if(($currentYear % 4) > 0) $maxDaysForMonth = 28;
				else $maxDaysForMonth = 29;
			case "4":
			case "6":
			case "9":
			case "11":
				$maxDaysForMonth = 30;
				break;
			default:
				$maxDaysForMonth = 31;
		}

		$this->tpl->set_block("rptsTemplate", $type."DayList", $type."DayListBlock");
		for($i = 1; $i<=$maxDaysForMonth; $i++){
			$this->tpl->set_var($type."dayValue", $i);
			$this->initSelected($type."day",$i);
			$this->tpl->parse($type."DayListBlock", $type."DayList", true);
		}
	}

	function setForm(){
        // barangay Listbox	
        $this->initMasterAddressList("Barangay", "barangay");
        // district Listbox	
        $this->initMasterAddressList("District", "district");
        // municipality/city Listbox	
        $this->initMasterAddressList("MunicipalityCity", "municipalityCity");
        // province Listbox	
        $this->initMasterAddressList("Province", "province");

		$this->setDateDropDown("filterFrom_");
		$this->setDateDropDown("filterTo_");

		$this->formArray["dayToday"] = date("j");
		$this->formArray["monthToday"] = date("n");

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function setDB(){
		$this->db = new DB_RPTS;
	}

	function Main(){

		$sql = "SELECT COUNT(".OD_TABLE.".odID) as count ";
		$sql.=" FROM ".OD_TABLE." WHERE ";
		$sql.=" ".OD_TABLE.".transactionCode LIKE 'AU' ";
		$sql.= " AND ".OD_TABLE.".archive !=  'true'";

		$this->setDB();

		$this->db->query($sql);

		if ($this->db->next_record()) {
			$count = $this->db->f("count");
		}
		else{
			$count = "0";
		}

		$this->tpl->set_var("totalPropertiesForAuction", $count);

		$this->setPageDetailPerms();

		$this->setForm();
		
		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->tpl->set_var("Session", $this->sess->url(""));
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
	,"perm" => "rpts_Perm"
	));
//*/
$listOfRPUsCancelled = new ListOfRPUsCancelled($sess);
$listOfRPUsCancelled->Main();
?>
<?php page_close(); ?>
