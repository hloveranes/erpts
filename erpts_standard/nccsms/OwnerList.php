<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";

include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";

#####################################
# Define Interface Class
#####################################
class OwnerList{
	
	var $tpl;
	function OwnerList($http_post_vars,$ownerType,$searchKey,$page,$formAction,$sess){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "OwnerList.htm") ;
		$this->tpl->set_var("TITLE", "NCCSMS - Owner List");

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
		
		$this->formArray["ownerType"] = $ownerType;
		$this->formArray["person_sel"] = "";
		$this->formArray["company_sel"] = "";
		$this->formArray["searchKey"] = $searchKey;
		$this->formArray["page"] = $page;
		$this->formArray["formAction"] = $formAction;

		if($this->formArray["page"]=="") $this->formArray["page"]=1;
	}

	function hideBlock($tempVar){
		$this->tpl->set_block("rptsTemplate", $tempVar, $tempVar."Block");
		$this->tpl->set_var($tempVar."Block", "");
	}

	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function setDB(){
		$this->db = new DB_RPTS;		
	}

	function countPersonRecords($condition=""){
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

	function countCompanyRecords($condition=""){
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

	function selectPersonRecords($condition=""){
		$this->setDB();
		$sql = sprintf(
				"SELECT DISTINCT(OwnerPerson.personID) as personID".
				" FROM OwnerPerson,Person ".
				" WHERE OwnerPerson.personID = Person.personID ".
				" %s;",
				$condition);

		$this->db->query($sql);	

		$personRecords = new PersonRecords;
		
		while ($this->db->next_record()) {
			$person = new Person;
			$person->selectRecord($this->db->f("personID"));
			$personRecords->arrayList[] = $person;
		}

		if(is_array($personRecords->arrayList)){
			return $personRecords;
		}
		else{
			return false;
		}
	}

	function selectCompanyRecords($condition=""){
		$this->setDB();
		$sql = sprintf(
				"SELECT DISTINCT(OwnerCompany.companyID) as companyID".
				" FROM OwnerCompany,Company ".
				" WHERE OwnerCompany.companyID = Company.companyID ".
				" %s;",
				$condition);

		$this->db->query($sql);	

		$companyRecords = new CompanyRecords;
		
		while ($this->db->next_record()) {
			$company = new Company;
			$company->selectRecord($this->db->f("companyID"));
			$companyRecords->arrayList[] = $company;
		}

		if(is_array($companyRecords->arrayList)){
			return $companyRecords;
		}
		else{
			return false;
		}
	}

	function Main(){
		switch($this->formArray["formAction"]){
			case "search":
				$this->tpl->set_block("rptsTemplate", "InitialMessage", "InitialMessageBlock");
				$this->tpl->set_var("InitialMessageBlock", "");

				switch($this->formArray["ownerType"]){
					case "Person":
						$this->formArray["person_sel"] = "selected";

						$condition = " AND ";
						$condition .= " (Person.firstName LIKE '%".$this->formArray["searchKey"]."%' ";
						$condition .= " OR Person.lastName LIKE '%".$this->formArray["searchKey"]."%' ";
						$condition .= " OR Person.middleName LIKE '%".$this->formArray["searchKey"]."%') ";

						if(!$count = $this->countPersonRecords($condition)){
							$this->tpl->set_block("rptsTemplate", "SearchResults", "SearchResultsBlock");
							$this->tpl->set_var("SearchResultsBlock", "");
						}
						else{
							$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
							$this->tpl->set_var("NotFoundBlock", "");

							// paging

							$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
		
							$numOfPages = ceil($count / PAGE_BY);

							if($numOfPages < $this->formArray["page"]) $this->formArray["page"] = 1;

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
								."&formAction=search&ownerType=".urlencode($this->formArray["ownerType"])."&searchKey=".urlencode($this->formArray["searchKey"]);

							$previousURL = $previous
								."&formAction=search&ownerType=".urlencode($this->formArray["ownerType"])."&searchKey=".urlencode($this->formArray["searchKey"]);

							$this->tpl->set_var("next",  $nextURL);
							$this->tpl->set_var("previous", $previousURL);
							$this->tpl->set_var("totalPages", $numOfPages);

							$this->tpl->set_block("rptsTemplate","NotFound","NotFoundBlock");
							$this->tpl->set_var("NotFoundBlock","");

							// listing

							$condition .= " ORDER BY TRIM(Person.lastName), TRIM(Person.firstName), TRIM(Person.middleName)";
							$condition .= " LIMIT ".$listLowerLimit.", ".PAGE_BY;

							$personRecords = $this->selectPersonRecords($condition);

							$this->tpl->set_block("rptsTemplate", "OwnerList", "OwnerListBlock");
							foreach($personRecords->arrayList as $person){
								$this->tpl->set_var("id",$person->getPersonID());
								$this->tpl->set_var("ownerName",$person->getName());
								$this->tpl->parse("OwnerListBlock", "OwnerList", true);
							}
						}

						break;
					case "Company":
						$this->formArray["company_sel"] = "selected";

						$condition = " AND ";
						$condition .= " (Company.companyName LIKE '%".$this->formArray["searchKey"]."%') ";

						if(!$count = $this->countCompanyRecords($condition)){
							$this->tpl->set_block("rptsTemplate", "SearchResults", "SearchResultsBlock");
							$this->tpl->set_var("SearchResultsBlock", "");
						}
						else{
							$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
							$this->tpl->set_var("NotFoundBlock", "");

							// paging

							$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
		
							$numOfPages = ceil($count / PAGE_BY);

							if($numOfPages < $this->formArray["page"]) $this->formArray["page"] = 1;

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
								."&formAction=search&ownerType=".urlencode($this->formArray["ownerType"])."&searchKey=".urlencode($this->formArray["searchKey"]);

							$previousURL = $previous
								."&formAction=search&ownerType=".urlencode($this->formArray["ownerType"])."&searchKey=".urlencode($this->formArray["searchKey"]);

							$this->tpl->set_var("next",  $nextURL);
							$this->tpl->set_var("previous", $previousURL);
							$this->tpl->set_var("totalPages", $numOfPages);

							$this->tpl->set_block("rptsTemplate","NotFound","NotFoundBlock");
							$this->tpl->set_var("NotFoundBlock","");

							// listing

							$condition .= " ORDER BY Company.companyName ";
							$condition .= " LIMIT ".$listLowerLimit.", ".PAGE_BY;

							$companyRecords = $this->selectCompanyRecords($condition);

							$this->tpl->set_block("rptsTemplate", "OwnerList", "OwnerListBlock");
							foreach($companyRecords->arrayList as $company){
								$this->tpl->set_var("id",$company->getCompanyID());
								$this->tpl->set_var("ownerName",$company->getCompanyName());
								$this->tpl->parse("OwnerListBlock", "OwnerList", true);
							}
						}

						break;
				}

				break;
			default:
				$this->tpl->set_block("rptsTemplate", "SearchResults", "SearchResultsBlock");
				$this->tpl->set_var("SearchResultsBlock", "");

				$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
				$this->tpl->set_var("NotFoundBlock", "");
				break;
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
	//"perm" => "rpts_Perm"
	));
//*/
$obj = new OwnerList($HTTP_POST_VARS,$ownerType,$searchKey,$page,$formAction,$sess);
$obj->main();
?>
<?php page_close(); ?>
