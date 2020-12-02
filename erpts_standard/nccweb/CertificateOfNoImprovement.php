<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

include_once "../includes/assessor/Person.php";

include_once "../includes/assessor/User.php";
include_once "../includes/assessor/UserRecords.php";

include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/RPTOPRecords.php";

include_once "../includes/assessor/TD.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/Land.php";
include_once "../includes/assessor/PlantsTrees.php";
include_once "../includes/assessor/ImprovementsBuildings.php";
include_once "../includes/assessor/Machineries.php";

include_once "../includes/assessor/LandActualUses.php";
include_once "../includes/assessor/PlantsTreesActualUses.php";
include_once "../includes/assessor/ImprovementsBuildingsActualUses.php";
include_once "../includes/assessor/MachineriesActualUses.php";

#####################################
# Define Interface Class
#####################################
class CertificateOfNoImprovement{
	
	var $tpl;
	function CertificateOfNoImprovement($http_post_vars,$formArray,$formAction,$searchKey,$page,$sortKey,$sortOrder,$sess){
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

		$this->tpl->set_file("rptsTemplate", "CertificateOfNoImprovement.htm") ;
		$this->tpl->set_var("TITLE", "Certificate of No Improvement");

		if(is_array($formArray)){
			$this->formArray = $formArray;
		}
		else{
			$this->formArray["requestorName"] = "";
			$this->formArray["requestorLocation"] = "";
			$this->formArray["signatoryID"] = "";
			$this->formArray["designation"] = "";
			$this->formArray["orNumber"] = "";
			$this->formArray["orDate_month"] = "";
			$this->formArray["orDate_day"] = "";
			$this->formArray["orDate_year"] = "";
			$this->formArray["ownerType"] = "Person";
			$this->formArray["ownerTypeSelected"] = "Person";
			$this->formArray["ownerTypePerson_sel"] = "checked";
			$this->formArray["ownerTypeCompany_sel"] = "";

			$this->formArray["sortKey"] = "Person.lastName";
			$this->formArray["sortOrder"] = "asc";
		}

		$this->formArray["requestedByURL"] = "";
		$this->formArray["searchKey"] = "";
		$this->formArray["formAction"] = $formAction;
		$this->formArray["searchKey"] = $searchKey;

		if($sortKey!="") $this->formArray["sortKey"] = $sortKey;
		else $this->formArray["sortKey"] = "Person.lastName";

		if($sortOrder!="") $this->formArray["sortOrder"] = $sortOrder;
		else $this->formArray["sortOrder"] = "asc";

		if($page!="") $this->formArray["page"] = $page;
		else $this->formArray["page"] = 1;

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}

		// default sortKeys
		switch($this->formArray["ownerType"]){
			case "Company":
				$this->formArray["sortKey"] = "Company.companyName";
				break;
			case "Person":
			default:
				$this->formArray["sortKey"] = "Person.lastName";
				break;
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

	function setForm(){
		if($this->formArray["sortOrder"]=="asc"){
			$this->formArray["oppositeSortOrder"] = "desc";
		}
		else{
			$this->formArray["oppositeSortOrder"] = "asc";
		}

		$this->initMasterSignatoryList("Signatory", "signatory");

		$startYear = 1900;
		$endYear = date("Y");
		$this->tpl->set_block("rptsTemplate", "ReceiptDateYearList", "ReceiptDateYearListBlock");
		for($i = $endYear; $i >= $startYear; $i--){
			$this->initSelected("orDate_year", $i, "selected");
			$this->tpl->set_var("yearValue", $i);
			$this->tpl->parse("ReceiptDateYearListBlock", "ReceiptDateYearList", true);
		}
		
		eval(MONTH_ARRAY);//$monthArray

		$this->tpl->set_block("rptsTemplate", "ReceiptDateMonthList", "ReceiptDateMonthListBlock");
		foreach($monthArray as $key => $value){
			$this->initSelected("orDate_month", $key, "selected");
			$this->tpl->set_var("monthValue", $key);
			$this->tpl->set_var("month", $value);

			$this->tpl->parse("ReceiptDateMonthListBlock", "ReceiptDateMonthList", true);
		}

		$this->tpl->set_block("rptsTemplate", "ReceiptDateDayList", "ReceiptDateDayListBlock");
		for($i = 1; $i<=31; $i++){
			$this->initSelected("orDate_day", $i, "selected");
			$this->tpl->set_var("dayValue", $i);
			$this->tpl->parse("ReceiptDateDayListBlock", "ReceiptDateDayList", true);
		}

		switch($this->formArray["ownerType"]){
			case "Company":
				$this->formArray["ownerTypeSelected"] = "Company";
				$this->formArray["ownerTypeCompany_sel"] = "checked";
				$this->formArray["ownerTypePerson_sel"] = "";
				break;
			case "Person":
			default:
				$this->formArray["ownerType"] = "Person";
				$this->formArray["ownerTypeSelected"] = "Person";
				$this->formArray["ownerTypeCompany_sel"] = "";
				$this->formArray["ownerTypePerson_sel"] = "checked";
				break;
		}

		$this->formArray["urlEncodeSearchKey"] = urlencode($this->formArray["searchKey"]);
		$this->formArray["urlEncodeSortKey"] = urlencode($this->formArray["sortKey"]);

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
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

	function initMasterSignatoryList($TempVar,$tempVar){
		$this->tpl->set_block("rptsTemplate", $TempVar."List", $TempVar."ListBlock");

		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
        if (!$xmlStr = $UserList->getUserList(0, " WHERE ".AUTH_USER_MD5_TABLE.".userType REGEXP '1$' AND ".AUTH_USER_MD5_TABLE.".status='enabled'")){
			// error xmlStr
   	    }
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				// error domDoc
			}
			else {
				$UserRecords = new UserRecords;
				$UserRecords->parseDomDocument($domDoc);
				$list = $UserRecords->getArrayList();
				foreach ($list as $key => $user){
					$person = new Person;
					$person->selectRecord($user->personID);
					$this->tpl->set_var("id",$user->personID);
					$this->tpl->set_var("name",$person->getFullName());
			        $this->initSelected($tempVar."ID",$user->personID);
			        $this->tpl->parse($TempVar."ListBlock", $TempVar."List", true);
				}
			}
		}
	}

	function sortRPTOPArrayListByOwner($rptopArrayList){
		// sort by Owner
		$o=0;
		foreach($rptopArrayList as $rptop){
			$ownerKey = "";
			$owner = $rptop->getOwner();

			if(is_array($owner->getPersonArray())){
				$rptopPersonArray = $owner->getPersonArray();

				foreach($rptopPersonArray as $person){
					$ownerKey .= $person->getLastName();
				}
			}
			if(is_array($owner->getCompanyArray())){
				$rptopCompanyArray = $owner->getCompanyArray();
				foreach($rptopCompanyArray as $company){
					$ownerKey .= $company->getCompanyName();
				}
			}
			$rptopSortedArrayList[$ownerKey.$o] = $rptop;
			$o++;
		}

		ksort($rptopSortedArrayList);
		reset($rptopSortedArrayList);

		return $rptopSortedArrayList;
	}

	function sortRPTOPOwner($owner){
		$ownerName = "";

		if(!is_object($owner)) return false;

		if(is_array($owner->getPersonArray())){
			$personArray = $owner->getPersonArray();
			$o=0;
			foreach($personArray as $person){
				$ownerArray[str_replace(" ", "",$person->getName()).$o] = $person->getName();
				$o++;
			}
		}
		if(is_array($owner->getCompanyArray())){
			$companyArray = $owner->getCompanyArray();
			$o=0;
			foreach($companyArray as $company){
				$ownerArray[str_replace(" ", "",$company->getCompanyName()).$o] = $company->getCompanyName();
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

			$tdNumberListLine = $tdNumber . " --- <b>" . $propertyType . "</b> --- " . $classification;
			return $tdNumberListLine;
		}
		return "";
	}

	function getSearchCondition(){
		switch($this->formArray["ownerType"]){
			case "Company":
				$condition = " Company.companyName LIKE '%".fixQuotes($this->formArray["searchKey"])."%' ";
				break;
			case "Person":
			default:
				$condition = " Person.lastName LIKE '%".fixQuotes($this->formArray["searchKey"])."%' OR ";
				$condition.= " Person.firstName LIKE '%".fixQuotes($this->formArray["searchKey"])."%' OR ";
				$condition.= " Person.middleName LIKE '%".fixQuotes($this->formArray["searchKey"])."%'";
				break;
		}
		return $condition;
	}

	function getSearchCount(){
		$condition = $this->getSearchCondition();
		switch($this->formArray["ownerType"]){
			case "Company":
				$count = $this->countCompanyRecords($condition);
				break;
			case "Person":
			default:
				$count = $this->countPersonRecords($condition);
				break;
		}

		if($count){
			if($count < 1) $count = false;
		}
		return $count;
	}

	function getSearchList(){
		$condition = " AND (".$this->getSearchCondition().") ";
		$condition .= " ORDER BY ".$this->formArray["sortKey"]." ".$this->formArray["sortOrder"];

		if($this->formArray["page"] > 0){
			$limit = ($this->formArray["page"]-1) * PAGE_BY;
		}
		$condition .= " LIMIT ".$limit.",".PAGE_BY;

		switch($this->formArray["ownerType"]){
			case "Company":
				$arrayList = $this->selectCompanyRecords($condition);
				break;
			case "Person":
			default:
				$arrayList = $this->selectPersonRecords($condition);
				break;
		}

		if(!is_array($arrayList)){
			return false;
		}
		return $arrayList;
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

	function countCompanyRecords($condition=""){
		if($condition!=""){
			$condition = " AND (".$condition.")";
		}

		$this->setDB();
		$sql = sprintf(
				"SELECT COUNT(DISTINCT(OwnerCompany.companyID)) as count".
				" FROM OwnerCompany,Company ".
				" WHERE OwnerCompany.companyID = Company.companyID ".
				" %s;",
				$condition);

		$this->db->query($sql);
		if($this->db->next_record()){
			$count = $this->db->f("count");
			return $count;
		}
		else{
			return false;
		}
	}
	function selectCompanyRecords($condition=" ORDER BY Company.companyName ASC LIMIT 0,10"){
		$this->setDB();
		$sql = sprintf(
				"SELECT DISTINCT(OwnerCompany.companyID) as companyID".
				" FROM OwnerCompany,Company ".
				" WHERE OwnerCompany.companyID = Company.companyID ".
				" %s;",
				$condition);

		$this->db->query($sql);	

		while ($this->db->next_record()) {
			$company = new Company;
			$company->selectRecord($this->db->f("companyID"));
			$companyArrayList[] = $company;
		}

		return $companyArrayList;
	}

	function countPersonRecords($condition=""){
		if($condition!=""){
			$condition = " AND (".$condition.")";
		}

		$this->setDB();
		$sql = sprintf(
				"SELECT COUNT(DISTINCT(OwnerPerson.personID)) as count".
				" FROM OwnerPerson,Person ".
				" WHERE OwnerPerson.personID = Person.personID ".
				" %s;",
				$condition);

		$this->db->query($sql);
		if($this->db->next_record()){
			$count = $this->db->f("count");
			return $count;
		}
		else{
			return false;
		}
	}
	function selectPersonRecords($condition=" ORDER BY Person.lastName ASC LIMIT 0,10"){
		$this->setDB();
		$sql = sprintf(
				"SELECT DISTINCT(OwnerPerson.personID) as personID".
				" FROM OwnerPerson,Person ".
				" WHERE OwnerPerson.personID = Person.personID ".
				" %s;",
				$condition);

		$this->db->query($sql);	
		
		while ($this->db->next_record()) {
			$person = new Person;
			$person->selectRecord($this->db->f("personID"));
			$personArrayList[] = $person;
		}
		return $personArrayList;
	}

	function setDB(){
		$this->db = new DB_RPTS;
	}

	function Main(){
		$this->setPageDetailPerms();

		switch($this->formArray["formAction"]){
			case "search":
				$this->tpl->set_block("rptsTemplate", "JSSelectPageOneOption", "JSSelectPageOneOptionBlock");

				$this->formArray["requestedByURL"] = "&formArray[signatoryID]=" . urlencode($this->formArray["signatoryID"])
					. "&formArray[requestorLocation]=" . urlencode($this->formArray["requestorLocation"])
					. "&formArray[requestorName]=" . urlencode($this->formArray["requestorName"])
					. "&formArray[designation]=" . urlencode($this->formArray["designation"])
					. "&formArray[orNumber]=" . urlencode($this->formArray["orNumber"])
					. "&formArray[orDate_month]=" . urlencode($this->formArray["orDate_month"])
					. "&formArray[orDate_day]=" . urlencode($this->formArray["orDate_day"])
					. "&formArray[orDate_year]=" . urlencode($this->formArray["orDate_year"]);

				$this->tpl->set_block("rptsTemplate","SearchInstructions","SearchInstructionsBlock");
				$this->tpl->set_var("SearchInstructionsBlock","");

				// paging
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				if (!$count = $this->getSearchCount()){
					$this->tpl->set_var("PagesBlock", "");
					$numOfPages = 1;
					$this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
					$this->tpl->set_var("PageNavigatorBlock", "");

					$this->tpl->set_var("JSSelectPageOneOptionBlock", "");
				}
				else{
					$this->tpl->parse("JSSelectPageOneOptionBlock", "JSSelectPageOneOption", true);
					$numOfPages = ceil($count / PAGE_BY);
					for($i=1;$i<=$numOfPages;$i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("paged","selected");
							$this->tpl->set_var("pages",$i);
						}
						else{
							$this->tpl->set_var("paged","");
							$this->tpl->set_var("pages",$i);
						}
						$this->tpl->parse("PagesBlock", "Pages", true);
					}

					if($this->formArray["page"]==1){
						$previous = 1;
					}
					else{
						$previous = $this->formArray["page"]-1;
					}
	
					if($this->formArray["page"]==$numOfPages){
						$next = $numOfPages;
					}
					else{
						$next = $this->formArray["page"] + 1;
					}

					$nextURL = $next
						. "&formAction=search&searchKey=" . urlencode($this->formArray["searchKey"])
						. $this->formArray["requestedByURL"];

					$previousURL = $previous
						. "&formAction=search&searchKey=" . urlencode($this->formArray["searchKey"])
						. $this->formArray["requestedByURL"];

					$this->tpl->set_var("next",  $nextURL);
					$this->tpl->set_var("previous", $previousURL);
					$this->tpl->set_var("totalPages", $numOfPages);

					$this->tpl->set_block("rptsTemplate","NotFound","NotFoundBlock");
					$this->tpl->set_var("NotFoundBlock","");
				}

				// listing
				if(!$arrayList = $this->getSearchList()){
					$this->tpl->set_block("rptsTemplate", "SearchResults", "SearchResultsBlock");
					$this->tpl->set_var("SearchResultsBlock", "");
				}
				else{
					if(!is_array($arrayList)){
						$this->tpl->set_block("rptsTemplate", "SearchResults", "SearchResultsBlock");
						$this->tpl->set_var("SearchResultsBlock", "");
					}
					else{
						$this->tpl->set_block("rptsTemplate", "List", "ListBlock");
						foreach($arrayList as $owner){
							switch($this->formArray["ownerType"]){
								case "Company":
									$ownerName = $owner->getCompanyName();
									$personCompanyID = $owner->getCompanyID();
									break;
								case "Person":
								default:
									$ownerName = $owner->getName();
									$personCompanyID = $owner->getPersonID();
									break;
							}
							$this->tpl->set_var("ownerName", $ownerName);
							$this->tpl->set_var("personCompanyID", $personCompanyID);

							$tdNumberList = "";
							$tdArray = $this->getTDArrayFromOwner($personCompanyID);
							if(is_array($tdArray)){
								foreach($tdArray as $td){
									if($tdNumberList!=""){
										$tdNumberList .= "<br>";
									}
									$tdNumberList .= $this->getTDNumberListLine($td);
								}
							}

							$this->tpl->set_var("tdNumberList",$tdNumberList);
							$this->tpl->parse("ListBlock", "List", true);
						}

					}
				}

				break;

			default:
				$this->tpl->set_block("rptsTemplate","SearchResults","SearchResultsBlock");
				$this->tpl->set_block("rptsTemplate","NotFound","NotFoundBlock");
				$this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
				$this->tpl->set_block("rptsTemplate", "NoPropertiesLink", "NoPropertiesLinkBlock");

				$this->tpl->set_block("rptsTemplate", "JSSelectPageOneOption", "JSSelectPageOneOptionBlock");
				$this->tpl->set_var("JSSelectPageOneOptionBlock", "");

				$this->tpl->set_var("SearchResultsBlock","");
				$this->tpl->set_var("NotFoundBlock","");
				$this->tpl->set_var("PageNavigatorBlock","");
				$this->tpl->set_var("NoPropertiesLinkBlock","");
		}

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

if(!$page) $page = 1;

$obj = new CertificateOfNoImprovement($HTTP_POST_VARS,$formArray,$formAction,$searchKey,$page,$sortKey,$sortOrder,$sess);
$obj->Main();
?>
<?php page_close(); ?>
