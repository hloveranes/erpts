<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";

include_once "../includes/assessor/Outbox.php";
include_once "../includes/assessor/OutboxRecords.php";

include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/Address.php";

#####################################
# Define Interface Class
#####################################
class OutboxList{
	
	var $tpl;
	function OutboxList($sess,$page){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "OutboxList.htm") ;
		$this->tpl->set_var("TITLE", "NCCSMS - Outbox");

		$this->formArray["page"] = $page;
		if($this->formArray["page"]=="") $this->formArray["page"] = 1;
	}

	function hideBlock($tempVar){
		$this->tpl->set_block("rptsTemplate", $tempVar, $tempVar."Block");
		$this->tpl->set_var($tempVar."Block", "");
	}

	function setPageDetailPerms(){
		if(!checkPerms($this->user["userType"],"%1%%%%%%%%")){
			// hide Blocks if userType is not at least AM-Edit
			$this->tpl->set_var("ownerViewAccess","viewOnly");
		}
		else{
			$this->tpl->set_var("ownerViewAccess","view");
		}
	}

	function getOwnerName($ownerType,$id){
		$ownerName = "";
		switch($ownerType){
			case "Person":
				$person = new Person;
				$person->selectRecord($id);
				$ownerName = $person->getName();
				$this->tpl->set_var("openWin", "PersonDetails.php".$this->sess->url("")."&personID=".$id."&formAction=viewOnly");
				break;
			case "Company":
				$company = new Company;
				$company->selectRecord($id);
				$ownerName = $company->getCompanyName();
				$this->tpl->set_var("openWin", "CompanyDetails.php".$this->sess->url("")."&companyID=".$id."&formAction=viewOnly");
				break;
		}
		return $ownerName;
	}

	function Main(){
		$outboxRecords = new OutboxRecords;
		$condition = "";

		if(!$count = $outboxRecords->countRecords($condition)){
			$this->tpl->set_block("rptsTemplate", "OutboxList", "OutboxListBlock");
			$this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
			$this->tpl->set_var("OutboxListBlock", "");
			$this->tpl->set_var("PageNavigatorBlock", "");
		}
		else{
			$this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
			$this->tpl->set_var("NotFoundBlock", "");

			// paging
			$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");

			$numOfPages = ceil($count / PAGE_BY);

			//if($numOfPages < $this->formArray["page"]) $this->formArray["page"] = 1;
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

			// listing

			$condition .= " ORDER BY outboxID DESC";
			$condition .= " LIMIT ".$listLowerLimit.", ".PAGE_BY;

			$outboxRecords->selectRecords($condition);

			if(is_array($outboxRecords->arrayList)){
				$this->tpl->set_block("rptsTemplate", "OutboxList", "OutboxListBlock");
				foreach($outboxRecords->arrayList as $outbox){
					$this->tpl->set_var("outboxID", $outbox->getOutboxID());
					$this->tpl->set_var("ownerName", $this->getOwnerName($outbox->getOwnerType(),$outbox->getPersonCompanyID()));
					$this->tpl->set_var("sendTo", $outbox->getSendTo());
					$this->tpl->set_var("messageType", $outbox->getMessageType());
					$this->tpl->set_var("message", substr($outbox->getMessage(),0,200));
					$this->tpl->set_var("sendDate", date("d/m/Y",$outbox->getDateCreated()));
					$this->tpl->set_var("sendTime", date("H:i:s",$outbox->getDateCreated()));
					$this->tpl->set_var("status", $outbox->getStatus());
					$this->tpl->parse("OutboxListBlock", "OutboxList", true);
				}
			}
		}

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

		$this->setPageDetailPerms();
		
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
$obj = new OutboxList($sess,$page);
$obj->Main();
?>
<?php page_close(); ?>

