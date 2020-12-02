<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/ImprovementsBuildingsClasses.php";
include("assessor/ImprovementsBuildingsClassesRecords.php";

#####################################
# Define Interface Class
#####################################
class ImprovementsBuildingsClassesList{
	
	var $tpl;
	var $formArray;
	function ImprovementsBuildingsClassesList($http_post_vars,$sess,$sortBy,$sortOrder,$hideInactive){
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

		$this->tpl->set_file("rptsTemplate", "ImprovementsBuildingsClassesList.htm") ;
		$this->tpl->set_var("TITLE", "Buildings & Improvements Classes List");
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
				$condition = " WHERE ".IMPROVEMENTSBUILDINGS_CLASSES_TABLE.".status='active' ";
				break;
		}
		return $condition;
	}

	function sortBlocks(){
		$this->sortBlockFields = array(
			  "improvementsBuildingsClassesID" => "ImprovementsBuildingsClassesID"
			, "code" => "Code"
			, "description" => "Description"
			, "range" => "Range"
			, "rangeUpperBound" => "RangeUpperBound"
			, "rangeLowerBound" => "RangeLowerBound"
			, "unitValue" => "UnitValue"
			, "type" => "Type"
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
			case "improvementsBuildingsClassesID":
				$condition = " ORDER BY improvementsBuildingsClassesID ".$this->formArray["sortOrder"];
				break;
			case "code":
				$condition = " ORDER BY code ".$this->formArray["sortOrder"];
				break;
			case "description":
				$condition = " ORDER BY description ".$this->formArray["sortOrder"];
				break;
			case "range":
				$condition = " ORDER BY range ".$this->formArray["sortOrder"];
				break;
			case "rangeUpperBound":
				$condition = " ORDER BY rangeUpperBound ".$this->formArray["sortOrder"];
				break;
			case "rangeLowerBound":
				$condition = " ORDER BY rangeLowerBound ".$this->formArray["sortOrder"];
				break;
			case "unitValue":
				$condition = " ORDER BY unitValue ".$this->formArray["sortOrder"];
				break;
			case "type":
				$condition = " ORDER BY type ".$this->formArray["sortOrder"];
				break;
			case "status":
				$condition = " ORDER BY status ".$this->formArray["sortOrder"];
				break;
			default:
				$this->formArray["sortBy"] = "improvementsBuildingsClassesID";
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

				$condition = " ORDER BY improvementsBuildingsClassesID DESC";
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
	
	function grey($str){
		$str = "<font color='#999999'>".$str."</font>";
		return $str;
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "delete":
				if (count($this->formArray["improvementsBuildingsClassesID"]) > 0) {
					$ImprovementsBuildingsClassesList = new SoapObject(NCCBIZ."ImprovementsBuildingsClassesList.php", "urn:Object");
					if (!$deletedRows = $ImprovementsBuildingsClassesList->deleteImprovementsBuildingsClasses($this->formArray["improvementsBuildingsClassesID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				break;
			case "activate":
			        $ImprovementsBuildingsClassesList = new SoapObject(NCCBIZ."ImprovementsBuildingsClassesList.php", "urn:Object");
			        if(!$activeRows = $ImprovementsBuildingsClassesList->updateStatus($this->formArray["status"])){
			            $this->tpl->set_var("msg", "All records have status made <i>inactive</i>");
                    }
                    else{
                        $this->tpl->set_var("msg", $activeRows." records have status made <i>active</i>");
                    }
			    break;
			case "cancel":
				header("location: ImprovementsBuildingsClassesList.php";
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
		}
		$ImprovementsBuildingsClassesList = new SoapObject(NCCBIZ."ImprovementsBuildingsClassesList.php", "urn:Object");

		$condition = $this->showHideInactive();
		$condition.= $this->sortBlocks();

		if (!$xmlStr = $ImprovementsBuildingsClassesList->getImprovementsBuildingsClassesList(0,$condition)){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "database is empty");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
	 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$improvementsBuildingsClassesRecords = new ImprovementsBuildingsClassesRecords;
				$improvementsBuildingsClassesRecords->parseDomDocument($domDoc);
				$list = $improvementsBuildingsClassesRecords->getArrayList();
				$this->tpl->set_block("rptsTemplate", "ImprovementsBuildingsClassesList", "ImprovementsBuildingsClassesListBlock");
				foreach ($list as $key => $listValue){
				    $this->tpl->set_var("improvementsBuildingsClassesID", $listValue->getImprovementsBuildingsClassesID());
				    $this->tpl->set_var("code", $listValue->getCode());
			        $this->tpl->set_var("description", $listValue->getDescription());

					if($listValue->getRangeLowerBound()==0 && $listValue->getRangeUpperBound()==0 && $listValue->getValue()!=0){
						$this->tpl->set_var("rangeLowerBound", $this->grey($listValue->getRangeLowerBound()));
						$this->tpl->set_var("rangeUpperBound", $this->grey($listValue->getRangeUpperBound()));
				        $this->tpl->set_var("value", $listValue->getValue());
					}
					else if(($listValue->getRangeLowerBound()!=0 || $listValue->getRangeUpperBound()!=0) && $listValue->getValue()==0){
						$this->tpl->set_var("rangeLowerBound", $listValue->getRangeLowerBound());
						$this->tpl->set_var("rangeUpperBound", $listValue->getRangeUpperBound());
				        $this->tpl->set_var("value", $this->grey($listValue->getValue()));
					}
					else{
						$this->tpl->set_var("rangeLowerBound", $this->grey($listValue->getRangeLowerBound()));
						$this->tpl->set_var("rangeUpperBound", $this->grey($listValue->getRangeUpperBound()));
				        $this->tpl->set_var("value", $listValue->getValue());
					}

					$this->tpl->set_var("type", $listValue->getType());
			        $this->tpl->set_var("status", $listValue->getStatus());
			        $this->tpl->set_var("statusCheck", $this->getStatusCheck($listValue->getStatus()));
					$this->tpl->parse("ImprovementsBuildingsClassesListBlock", "ImprovementsBuildingsClassesList", true);
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
$improvementsBuildingsClassesList = new ImprovementsBuildingsClassesList($HTTP_POST_VARS,$sess,$sortBy,$sortOrder,$hideInactive);
$improvementsBuildingsClassesList->Main();
?>
<?php page_close(); ?>
