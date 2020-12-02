<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/MachineriesActualUses.php";
include("assessor/MachineriesActualUsesRecords.php";

#####################################
# Define Interface Class
#####################################
class MachineriesActualUsesList{
	
	var $tpl;
	var $formArray;
	function MachineriesActualUsesList($http_post_vars,$sess,$sortBy,$sortOrder,$hideInactive){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must be Super-User to access
		$pageType = "1%%%%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "MachineriesActualUsesList.htm") ;
		$this->tpl->set_var("TITLE", "Machineries Actual Uses List");
		$this->tpl->set_var("Session", $this->sess->url(""));

		$this->formArray["sortBy"] = $sortBy;
		$this->formArray["sortOrder"] = $sortOrder;
		$this->formArray["hideInactive"] = $hideInactive;
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function showHideInactive(){
		$this->tpl->set_block("rptsTemplate", "ShowInactiveOn", "ShowInactiveOnBlock");
		$this->tpl->set_block("rptsTemplate", "HideInactiveOn", "HideInactiveOnBlock");

		switch($this->formArray["hideInactive"]){
			case "false":
				$this->tpl->parse("ShowInactiveOnBlock", "ShowInactiveOn", true);
				$this->tpl->set_var("HideInactiveOnBlock", "");
				$condition = "";
				break;
			case "true":
			default:
				$this->formArray["hideInactive"] = "true";
				$this->tpl->set_var("ShowInactiveOnBlock", "");
				$this->tpl->parse("HideInactiveOnBlock", "HideInactiveOn", true);
				$condition = " WHERE ".MACHINERIES_ACTUALUSES_TABLE.".status='active' ";
				break;
		}
		return $condition;
	}

	function sortBlocks(){
		$this->sortBlockFields = array(
			  "machineriesActualUsesID" => "MachineriesActualUsesID"
			, "code" => "Code"
			, "reportCode" => "ReportCode"
			, "description" => "Description"
			, "assessmentLevel" => "AssessmentLevel"
			, "status" => "Status"
		);

		foreach($this->sortBlockFields as $tempVar=>$TempVar){
			$this->tpl->set_block("rptsTemplate", "Ascending".$TempVar, "Ascending".$TempVar."Block");
			$this->tpl->set_block("rptsTemplate", "Descending".$TempVar, "Descending".$TempVar."Block");

			$this->formArray[$tempVar."SortOrder"] = "ASC";

			switch($this->formArray["sortBy"]){
				case $tempVar:
					switch($this->formArray["sortOrder"]){
						case "ASC":
							$this->formArray[$tempVar."SortOrder"] = "DESC";
							$this->tpl->parse("Ascending".$TempVar."Block", "Ascending".$TempVar, true);
							$this->tpl->set_var("Descending".$TempVar."Block", "");
							break;
						case "DESC":
							$this->formArray[$tempVar."SortOrder"] = "ASC";
							$this->tpl->parse("Descending".$TempVar."Block", "Descending".$TempVar, true);
							$this->tpl->set_var("Ascending".$TempVar."Block", "");
							break;
						default:
							$this->formArray["sortOrder"] = "DESC";
							$this->tpl->parse("Descending".$TempVar."Block", "Descending".$TempVar, true);
							$this->tpl->set_var("Ascending".$TempVar."Block", "");
							break;
					}

					foreach($this->sortBlockFields as $key => $value){
						if($key!=$tempVar){
							$this->tpl->set_var("Ascending".$value."Block", "");
							$this->tpl->set_var("Descending".$value."Block", "");
						}
					}
				break;
			}
		}

		switch($this->formArray["sortBy"]){
			case "machineriesActualUsesID":
				$condition = " ORDER BY machineriesActualUsesID ".$this->formArray["sortOrder"];
				break;
			case "code":
				$condition = " ORDER BY code ".$this->formArray["sortOrder"];
				break;
			case "reportCode":
				$condition = " ORDER BY reportCode ".$this->formArray["sortOrder"];
				break;
			case "description":
				$condition = " ORDER BY description ".$this->formArray["sortOrder"];
				break;
			case "assessmentLevel":
				$condition = " ORDER BY assessmentLevel ".$this->formArray["sortOrder"];
				break;
			case "status":
				$condition = " ORDER BY status ".$this->formArray["sortOrder"];
				break;
			default:
				$this->formArray["sortBy"] = "machineriesActualUsesID";
				$this->formArray["sortOrder"] = "DESC";
				foreach($this->sortBlockFields as $key=>$value){
					if($key!=$this->formArray["sortBy"]){
						$this->tpl->set_var("Ascending".$value."Block", "");
						$this->tpl->set_var("Descending".$value."Block", "");
					}
					else{
						$this->tpl->set_var("Ascending".$value."Block", "");
						$this->tpl->parse("Descending".$value."Block", "Descending".$value, true);
					}
				}
				$condition = " ORDER BY machineriesActualUsesID DESC";
				break;
		}

		return $condition;
	}

	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
    function getStatusCheck($isStatusActive){
        if($isStatusActive=="active"){
            return("checked");
        }
        else{
            return "";
        }
    }	
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "delete":
				if (count($this->formArray["machineriesActualUsesID"]) > 0) {
					$MachineriesActualUsesList = new SoapObject(NCCBIZ."MachineriesActualUsesList.php", "urn:Object");
					if (!$deletedRows = $MachineriesActualUsesList->deleteMachineriesActualUses($this->formArray["machineriesActualUsesID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				break;
			case "activate":
			        $MachineriesActualUsesList = new SoapObject(NCCBIZ."MachineriesActualUsesList.php", "urn:Object");
			        if(!$activeRows = $MachineriesActualUsesList->updateStatus($this->formArray["status"])){
			            $this->tpl->set_var("msg", "All records have status made <i>inactive</i>");
                    }
                    else{
                        $this->tpl->set_var("msg", $activeRows." records have status made <i>active</i>");
                    }
			    break;
			case "cancel":
				header("location: MachineriesActualUsesList.php";
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
		}
		$MachineriesActualUsesList = new SoapObject(NCCBIZ."MachineriesActualUsesList.php", "urn:Object");

		$condition = $this->showHideInactive();
		$condition.= $this->sortBlocks();

		if (!$xmlStr = $MachineriesActualUsesList->getMachineriesActualUsesList(0,$condition)){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "database is empty");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
	 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$machineriesActualUsesRecords = new MachineriesActualUsesRecords;
				$machineriesActualUsesRecords->parseDomDocument($domDoc);
				$list = $machineriesActualUsesRecords->getArrayList();
				$this->tpl->set_block("rptsTemplate", "MachineriesActualUsesList", "MachineriesActualUsesListBlock");
				foreach ($list as $key => $listValue){
				    $this->tpl->set_var("machineriesActualUsesID", $listValue->getMachineriesActualUsesID());
				    $this->tpl->set_var("code", $listValue->getCode());
				    $this->tpl->set_var("reportCode", $listValue->getReportCode());
			        $this->tpl->set_var("description", $listValue->getDescription());
			        $this->tpl->set_var("value", $listValue->getValue());
			        $this->tpl->set_var("status", $listValue->getStatus());
			        $this->tpl->set_var("statusCheck", $this->getStatusCheck($listValue->getStatus()));
					$this->tpl->parse("MachineriesActualUsesListBlock", "MachineriesActualUsesList", true);
				}
			}
		}
		$this->setForm();

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

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
$machineriesActualUsesList = new MachineriesActualUsesList($HTTP_POST_VARS,$sess,$sortBy,$sortOrder,$hideInactive);
$machineriesActualUsesList->Main();
?>
<?php page_close(); ?>
