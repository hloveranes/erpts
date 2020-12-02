<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
#####################################
# Define Interface Class
#####################################
class PersonEncode{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function PersonEncode($http_post_vars,$searchKey,$formAction="",$sess,$ownerID="",$odID="",$page){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "PersonSearch.htm") ;
		$this->tpl->set_var("TITLE", "Person Search");
		
		$this->formArray = array(
			"formAction" => $formAction
			, "ownerID" => $ownerID
			, "odID" => $odID
			, "searchKey" => $searchKey
			, "page" => $page
		);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "search":
				$PersonList = new SoapObject(NCCBIZ."PersonList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
				if (!$count = $PersonList->getSearchCount($this->formArray["searchKey"])){
					$this->tpl->set_var("PagesBlock", "");
				}
				else{
					$numOfPages = ceil($count / PAGE_BY);
					for($i=1;$i<=$numOfPages;$i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("pages","");
							$this->tpl->set_var("paged",$i);
						}
						else{
							$this->tpl->set_var("pages",$i);
							$this->tpl->set_var("paged","");
						}
						$this->tpl->parse("PagesBlock", "Pages", true);
					}
				}
				if ($numOfPages == $this->formArray["page"]){
					$this->tpl->set_var("nextTxt", "");
				}
				else{
					$this->tpl->set_var("next", $this->formArray["page"]+1);
					$this->tpl->set_var("nextTxt", "next");
				}
				if ($this->formArray["page"] == 1){
					$this->tpl->set_var("previousTxt", "");
				}
				else {
					$this->tpl->set_var("previous", $this->formArray["page"]-1);
					$this->tpl->set_var("previousTxt", "previous");
				}
				$this->tpl->set_var("pageOf", $this->formArray["page"]." of ".$numOfPages);
				if (!$xmlStr = $PersonList->searchPerson($this->formArray["searchKey"],$this->formArray["page"])){
					$this->tpl->set_block("rptsTemplate", "Found", "FoundBlock");
					$this->tpl->set_var("FoundBlock", "");
				}
				else {
					if(!$domDoc = domxml_open_mem($xmlStr)) {
			 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
						$this->tpl->set_var("TableBlock", "error xmlDoc");
					}
					else {
						$personRecords = new PersonRecords;
						$personRecords->parseDomDocument($domDoc);
						$list = $personRecords->getArrayList();
						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "PersonList", "PersonListBlock");
							foreach ($list as $key => $value){
								$this->tpl->set_var("personID", $value->getPersonID());
								if (!$pname = $value->getFullName()){
									$pname = "none";
								}
								$this->tpl->set_var("fullName", $pname);
								$this->tpl->set_var("tin", $value->getTin());
								$this->tpl->set_var("telephone", $value->getTelephone());
								$this->tpl->set_var("mobileNumber", $value->getMobileNumber());
								$this->tpl->parse("PersonListBlock", "PersonList", true);
							}
							$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
							$this->tpl->set_var("NotFoundBlock", "");
						}
						else{
							$this->tpl->set_block("rptsTemplate", "Found", "FoundBlock");
							$this->tpl->set_var("FoundBlock", "");
						}
					}
				}
				break;
			case "add":
					//$owner = new Owner;
					//foreach($this->formArray["personID"] as $key => $value){
					//	$owner->deleteOwnerPerson($value);
					//	$owner->insertOwnerPerson($this->formArray["ownerID"],$value);
					//}
					//print_r($this->formArray["personID"]);
					$OwnerList = new SoapObject(NCCBIZ."OwnerList.php", "urn:Object");
					$OwnerList->addOwnerPerson($this->formArray["ownerID"],$this->formArray["personID"]);
					header("location: PersonSearchClose.php".$this->sess->url("").$this->sess->add_query(array("odID"=>$this->formArray["odID"])));
				break;
			default:
				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "");
				$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
				$this->tpl->set_var("NotFoundBlock", "");
		}
		$this->setForm();

		$this->tpl->set_var("Session", 
			$this->sess->url("")
			.$this->sess->add_query(array(
				"odID"=>$this->formArray["odID"]
                ,"ownerID"=>$this->formArray["ownerID"]
				,"afsID"=>$this->formArray["afsID"]
				,"searchKey"=>$this->formArray["searchKey"]
				,"formAction" => "search"
			))
		);

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
	//,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/
if(!$page) $page = 1;
$personEncode = new PersonEncode($HTTP_POST_VARS,$searchKey,$formAction,$sess,$ownerID,$odID,$page);
$personEncode->main();
?>

<?php page_close(); ?>
