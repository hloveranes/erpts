<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Person.php";

#####################################
# Define Interface Class
#####################################
class OwnerPersonList{
	
	var $tpl;
	function OwnerPersonList($sess,$sortKey,$sortOrder,$page){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		$this->formArray["sortKey"] = "TRIM(Person.lastName), TRIM(Person.firstName), TRIM(Person.middleName)";
		$this->formArray["sortOrder"] = "asc";
		$this->formArray["page"] = 1;
	
		//if($sortKey!="")
		//	$this->formArray["sortKey"] = $sortKey;
		if($sortOrder!="")
			$this->formArray["sortOrder"] = $sortOrder;

		if($page!=""){
			$this->formArray["page"] = $page;
		}

		// must be Super-User to access
		$pageType = "1%%%%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "OwnerPersonList.htm") ;
		$this->tpl->set_var("TITLE", "Owner Person List");
	}

	// Start DB Functions

	function setDB(){
		$this->db = new DB_RPTS;
	}
	function countRecords($condition=""){
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
	function selectRecords($condition=" ORDER BY TRIM(Person.lastName), TRIM(Person.firstName), TRIM(Person.middleName) ASC LIMIT 0,10"){
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
			$this->arrayList[] = $person;
		}
	}
	function displayPageNavigation(){
		$totalRecords = $this->countRecords();

		$totalPages = ceil($totalRecords/PAGE_BY);

		$prev = 1;
		$next = $totalPages;

		if($next > $this->formArray["page"] + 1){
			$next = $this->formArray["page"] + 1;
		}
		if($prev < $this->formArray["page"] - 1){
			$prev = $this->formArray["page"] - 1;
		}

		$this->tpl->set_var("totalPages",$totalPages);
		$this->tpl->set_var("next",$next);
		$this->tpl->set_var("prev",$prev);
		$this->tpl->set_var("page",$this->formArray["page"]);
		$this->tpl->set_var("sortKey",$this->formArray["sortKey"]);
		$this->tpl->set_var("sortOrder",$this->formArray["sortOrder"]);
	}
	function displayRecords(){
		$condition = "ORDER BY ".$this->formArray["sortKey"]. " ".$this->formArray["sortOrder"];

		if($this->formArray["page"] > 0){
			$this->formArray["page"] = ($this->formArray["page"]-1) * PAGE_BY;
		}

		$condition .= " LIMIT ".$this->formArray["page"].",".PAGE_BY;
	
		$this->selectRecords($condition);

		if($this->formArray["sortOrder"]=="asc"){
			$this->tpl->set_var("oppositeSortOrder", "desc");
		}
		else{
			$this->tpl->set_var("oppositeSortOrder", "asc");
		}

		$this->tpl->set_block("rptsTemplate", "OwnerPersonList", "OwnerPersonListBlock");

		foreach($this->arrayList as $person) {
			$this->tpl->set_var("personID", $person->getPersonID());
			$this->tpl->set_var("lastName", $person->getLastName());
			$this->tpl->set_var("firstName", $person->getFirstName());
			$this->tpl->set_var("middleName", $person->getMiddleName());
			$this->tpl->set_var("gender", $person->getGender());
			$this->tpl->set_var("birthday", $person->getBirthday());
			$this->tpl->set_var("maritalStatus", $person->getMaritalStatus());
			$this->tpl->set_var("tin", $person->getTin());
			$this->tpl->set_var("telephone", $person->getTelephone());
			$this->tpl->set_var("mobileNumber", $person->getMobileNumber());
			$this->tpl->set_var("email", $person->getEmail());

			if(is_array($person->addressArray)){
				$address = $person->addressArray[0];
				$this->tpl->set_var("address", $address->getFullAddress());
			}

			$this->tpl->parse("OwnerPersonListBlock", "OwnerPersonList", true);
		}
	}

	// End DB Functions

	function Main(){
		$this->displayPageNavigation();
		$this->displayRecords();

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
$obj = new OwnerPersonList($sess,$sortKey,$sortOrder,$page);
$obj->Main();
?>
<?php page_close(); ?>
