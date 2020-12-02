<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

include_once "../includes/assessor/OD.php";
include_once "../includes/assessor/ODRecords.php";
include_once "../includes/assessor/AFS.php";
include_once "../includes/assessor/AFSRecords.php";

include_once "../includes/assessor/Barangay.php";
include_once "../includes/assessor/BarangayRecords.php";
include_once "../includes/assessor/District.php";
include_once "../includes/assessor/DistrictRecords.php";
include_once "../includes/assessor/MunicipalityCity.php";
include_once "../includes/assessor/MunicipalityCityRecords.php";
include_once "../includes/assessor/Province.php";
include_once "../includes/assessor/ProvinceRecords.php";

include_once "../includes/collection/Payment.php";
include_once "../includes/collection/PaymentRecords.php";

#####################################
# Define Interface Class
#####################################
class FinalDemandLetterOwnerList{
	
	var $tpl;
	function FinalDemandLetterOwnerList($http_post_vars,$formArray,$formAction,$searchKey,$page=1,$sess){
		global $auth;

		$this->formArray = $formArray;
		$this->formArray["formAction"] = $formAction;
		$this->formArray["searchKey"] = $searchKey;
		$this->formArray["page"] = $page;

		if($this->formArray["page"]=="") $this->formArray["page"] = 1;

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

		$this->tpl->set_file("rptsTemplate", "FinalDemandLetterOwnerList.htm") ;
		$this->tpl->set_var("TITLE", "Final Demand Letter - Owner List");
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
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
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

	function getSortedOwnerIDArray($ownerIDArray){
		$i=0;
		foreach($ownerIDArray as $ownerID){
			$ownerName = $this->getOwnerName($ownerID);
			$sortedOwnerIDArray[$ownerName.$i] = array(
				"ownerID" => $ownerID
				,"ownerName" => $ownerName
				);
			$i++;
		}
		ksort($sortedOwnerIDArray);
		reset($sortedOwnerIDArray);
		return $sortedOwnerIDArray;
	}

	function getSortedOwnerArrayListFromPayment(){
		$paymentRecords = new PaymentRecords;
		$condition = " WHERE status!='cancelled' ";
		$paymentRecords->selectRecords($condition);
		if(is_array($paymentRecords->arrayList)){
			foreach($paymentRecords->arrayList as $payment){
				$ownerIDArray[] = $payment->getOwnerID();
			}
			$ownerIDArrayUnique = array_unique($ownerIDArray);
			$sortedOwnerIDArray = $this->getSortedOwnerIDArray($ownerIDArrayUnique);
			return $sortedOwnerIDArray;
		}
		else{
			return false;
		}
	}
	
	function getSortedOwnerArrayListFromOwner(){
		$db = new DB_RPTS;
		$sql = "SELECT DISTINCT(Owner.ownerID) as ownerID FROM Owner, OD WHERE ".
				" Owner.odID = OD.odID AND OD.archive!='true' ";		
				
		$db->query($sql);
		while($db->next_record()){
			$ownerIDArray[] = $db->f("ownerID");
		}
		
		if(is_array($ownerIDArray)){
			$ownerIDArrayUnique = array_unique($ownerIDArray);
			$sortedOwnerIDArray = $this->getSortedOwnerIDArray($ownerIDArrayUnique);
			return $sortedOwnerIDArray;
		}
		else{
			return false;
		}
	}	
	
	function searchAndSortOwnerArrayListFromOwner(){
		$db = new DB_RPTS;
		// search ownerPerson
		$sql = "SELECT "
			."Owner.ownerID as ownerID FROM "
			."Owner, OwnerPerson, Person, OD "
			."WHERE "
			."Owner.ownerID=OwnerPerson.ownerID "
			."AND "
			."OwnerPerson.personID = Person.personID "
			."AND "
			."OD.odID = Owner.odID AND OD.archive!='true' AND "
			."("
			."Person.lastName LIKE '%".$this->formArray["searchKey"]."%' "
			."OR "
			."Person.firstName LIKE '%".$this->formArray["searchKey"]."%' "
			."OR "
			."Person.middleName LIKE '%".$this->formArray["searchKey"]."%' "
			.");";
			
		$db->query($sql);
		while($db->next_record()){
			$ownerIDArray[] = $db->f("ownerID");
		}

		// search ownerCompany
		$sql = "SELECT "
			."Owner.ownerID FROM "
			."Owner, OwnerCompany, Company, OD "
			."WHERE "
			."Owner.ownerID=OwnerCompany.ownerID "
			."AND "
			."OwnerCompany.companyID = Company.companyID "
			."AND "
			."OD.odID = Owner.odID AND OD.archive!='true' AND "
			."AND "
			."("
			."Company.companyName LIKE '%".$this->formArray["searchKey"]."%' "
			.");";

		$db->query($sql);
		while($db->next_record()){
			$ownerIDArray[] = $db->f("ownerID");
		}

		if(is_array($ownerIDArray)){
			$ownerIDArrayUnique = array_unique($ownerIDArray);
			$sortedOwnerIDArray = $this->getSortedOwnerIDArray($ownerIDArrayUnique);
			return $sortedOwnerIDArray;
		}
		else{
			return false;
		}
	}	

	function searchAndSortOwnerArrayListFromPayment(){
		$db = new DB_RPTS;
		// search ownerPerson
		$sql = "SELECT "
			.PAYMENT_TABLE.".ownerID as ownerID FROM "
			.PAYMENT_TABLE.", ".OWNER_PERSON_TABLE.", ".PERSON_TABLE." "
			."WHERE "
			.PAYMENT_TABLE.".ownerID=".OWNER_PERSON_TABLE.".ownerID "
			."AND "
			.OWNER_PERSON_TABLE.".personID = ".PERSON_TABLE.".personID "
			."AND "
			."("
			.PERSON_TABLE.".lastName LIKE '%".$this->formArray["searchKey"]."%' "
			."OR "
			.PERSON_TABLE.".firstName LIKE '%".$this->formArray["searchKey"]."%' "
			."OR "
			.PERSON_TABLE.".middleName LIKE '%".$this->formArray["searchKey"]."%' "
			.");";

		$db->query($sql);
		while($db->next_record()){
			$ownerIDArray[] = $db->f("ownerID");
		}

		// search ownerCompany
		$sql = "SELECT "
			.PAYMENT_TABLE.".ownerID FROM "
			.PAYMENT_TABLE.", ".OWNER_COMPANY_TABLE.", ".COMPANY_TABLE." "
			."WHERE "
			.PAYMENT_TABLE.".ownerID=".OWNER_COMPANY_TABLE.".ownerID "
			."AND "
			.OWNER_COMPANY_TABLE.".companyID = ".COMPANY_TABLE.".companyID "
			."AND "
			."("
			.COMPANY_TABLE.".companyName LIKE '%".$this->formArray["searchKey"]."%' "
			.");";

		$db->query($sql);
		while($db->next_record()){
			$ownerIDArray[] = $db->f("ownerID");
		}

		if(is_array($ownerIDArray)){
			$ownerIDArrayUnique = array_unique($ownerIDArray);
			$sortedOwnerIDArray = $this->getSortedOwnerIDArray($ownerIDArrayUnique);
			return $sortedOwnerIDArray;
		}
		else{
			return false;
		}
	}

	function Main(){
		switch($this->formArray["formAction"]){
			case "search":
				$sortedOwnerArrayList = $this->searchAndSortOwnerArrayListFromOwner();

				if(!is_array($sortedOwnerArrayList)){
					$this->tpl->set_block("rptsTemplate", "SearchResults", "SearchResultsBlock");
					$this->tpl->set_var("SearchResultsBlock", "");
					$this->tpl->set_block("rptsTemplate", "CurrentPageTotalPages", "CurrentPageTotalPages");
					$this->tpl->set_var("CurrentPageTotalPages", "");
				}
				else{
					$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
					$this->tpl->set_var("NotFoundBlock", "");

					// paging
					$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
					$count = count($sortedOwnerArrayList);

					$numOfPages = ceil($count / PAGE_BY);

					$listLowerLimit = ($this->formArray["page"]-1) * PAGE_BY;
					$listUpperLimit = $listLowerLimit + (PAGE_BY-1);

					for($i=1;$i<=$numOfPages;$i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("paged","selected");
							$this->tpl->set_var("pages",$i);
							$this->tpl->set_var("currentPage", $i);
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
						."&formAction=search&searchKey=".urlencode($this->formArray["searchKey"]);

					$previousURL = $previous
						."&formAction=search&searchKey=".urlencode($this->formArray["searchKey"]);

					$this->tpl->set_var("next",  $nextURL);
					$this->tpl->set_var("previous", $previousURL);
					$this->tpl->set_var("totalPages", $numOfPages);

					$this->tpl->set_block("rptsTemplate","NotFound","NotFoundBlock");
					$this->tpl->set_var("NotFoundBlock","");

					// listing

					$this->tpl->set_block("rptsTemplate", "OwnerList", "OwnerListBlock");

					$listCount = 0;
					foreach($sortedOwnerArrayList as $ownerArray){
						if($listCount >= $listLowerLimit && $listCount <= $listUpperLimit){
							$this->tpl->set_var("ownerID", $ownerArray["ownerID"]);
							$this->tpl->set_var("ownerName", $ownerArray["ownerName"]);
							$this->tpl->parse("OwnerListBlock", "OwnerList", true);
						}
						$listCount++;
					}


				}
				break;
			default:
				$sortedOwnerArrayList = $this->getSortedOwnerArrayListFromOwner();
				if(!is_array($sortedOwnerArrayList)){
					$this->tpl->set_block("rptsTemplate", "SearchResults", "SearchResultsBlock");
					$this->tpl->set_var("SearchResultsBlock", "");
				}
				else{
					$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
					$this->tpl->set_var("NotFoundBlock", "");

					// paging
					$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
					$count = count($sortedOwnerArrayList);

					$numOfPages = ceil($count / PAGE_BY);

					$listLowerLimit = ($this->formArray["page"]-1) * PAGE_BY;
					$listUpperLimit = $listLowerLimit + (PAGE_BY-1);

					for($i=1;$i<=$numOfPages;$i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("paged","selected");
							$this->tpl->set_var("pages",$i);
							$this->tpl->set_var("currentPage", $i);
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

					$nextURL = $next;

					$previousURL = $previous;

					$this->tpl->set_var("next",  $nextURL);
					$this->tpl->set_var("previous", $previousURL);
					$this->tpl->set_var("totalPages", $numOfPages);

					$this->tpl->set_block("rptsTemplate","NotFound","NotFoundBlock");
					$this->tpl->set_var("NotFoundBlock","");

					// listing

					$this->tpl->set_block("rptsTemplate", "OwnerList", "OwnerListBlock");

					$listCount = 0;
					foreach($sortedOwnerArrayList as $ownerArray){
						if($listCount >= $listLowerLimit && $listCount <= $listUpperLimit){
							$this->tpl->set_var("ownerID", $ownerArray["ownerID"]);
							$this->tpl->set_var("ownerName", $ownerArray["ownerName"]);
							$this->tpl->parse("OwnerListBlock", "OwnerList", true);
						}
						$listCount++;
					}


				}
				break;
		}


		$this->setForm();

		$this->setPageDetailPerms();
		
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
$finalDemandLetterOwnerList = new FinalDemandLetterOwnerList($HTTP_POST_VARS,$formArray,$formAction,$searchKey,$page,$sess);
$finalDemandLetterOwnerList->Main();
?>
<?php page_close(); ?>
