<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/MachineriesClasses.php";
include("assessor/MachineriesClassesRecords.php";

#####################################
# Define Interface Class
#####################################
class MachineriesClassesList{
	
	var $tpl;
	var $formArray;
	function MachineriesClassesList($http_post_vars,$sess,$sortBy,$sortOrder,$hideInactive){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "MachineriesClassesList.htm") ;
		$this->tpl->set_var("TITLE", "Machineries Classes List");
		$this->tpl->set_var("Session", $this->sess->url(""));

		$this->formArray["sortBy"] = $sortBy;
		$this->formArray["sortOrder"] = $sortOrder;
		$this->formArray["hideInactive"] = $hideInactive;
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
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
				$condition = " WHERE ".MACHINERIES_CLASSES_TABLE.".status='active' ";
				break;
		}
		return $condition;
	}

	function sortBlocks(){
		$this->sortBlockFields = array(
			  "machineriesClassesID" => "MachineriesClassesID"
			, "code" => "Code"
			, "description" => "Description"
			, "unitValue" => "UnitValue"
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
			case "machineriesClassesID":
				$condition = " ORDER BY machineriesClassesID ".$this->formArray["sortOrder"];
				break;
			case "code":
				$condition = " ORDER BY code ".$this->formArray["sortOrder"];
				break;
			case "description":
				$condition = " ORDER BY description ".$this->formArray["sortOrder"];
				break;
			case "unitValue":
				$condition = " ORDER BY unitValue ".$this->formArray["sortOrder"];
				break;
			case "status":
				$condition = " ORDER BY status ".$this->formArray["sortOrder"];
				break;
			default:
				$this->formArray["sortBy"] = "machineriesClassesID";
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

				$condition = " ORDER BY machineriesClassesID DESC";
				break;
		}
		return $condition;
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
				if (count($this->formArray["machineriesClassesID"]) > 0) {
					$MachineriesClassesList = new SoapObject(NCCBIZ."MachineriesClassesList.php", "urn:Object");
					if (!$deletedRows = $MachineriesClassesList->deleteMachineriesClasses($this->formArray["machineriesClassesID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				break;
			case "activate":
			        $MachineriesClassesList = new SoapObject(NCCBIZ."MachineriesClassesList.php", "urn:Object");
			        if(!$activeRows = $MachineriesClassesList->updateStatus($this->formArray["status"])){
			            $this->tpl->set_var("msg", "All records have status made <i>inactive</i>");
                    }
                    else{
                        $this->tpl->set_var("msg", $activeRows." records have status made <i>active</i>");
                    }
			    break;
			case "cancel":
				header("location: MachineriesClassesList.php";
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
		}
		$MachineriesClassesList = new SoapObject(NCCBIZ."MachineriesClassesList.php", "urn:Object");
		$condition = $this->showHideInactive();
		$condition.= $this->sortBlocks();
		if (!$xmlStr = $MachineriesClassesList->getMachineriesClassesList(0,$condition)){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "database is empty");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
	 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$machineriesClassesRecords = new MachineriesClassesRecords;
				$machineriesClassesRecords->parseDomDocument($domDoc);
				$list = $machineriesClassesRecords->getArrayList();
				$this->tpl->set_block("rptsTemplate", "MachineriesClassesList", "MachineriesClassesListBlock");
				foreach ($list as $key => $listValue){
				    $this->tpl->set_var("machineriesClassesID", $listValue->getMachineriesClassesID());
				    $this->tpl->set_var("code", $listValue->getCode());
			        $this->tpl->set_var("description", $listValue->getDescription());
			        $this->tpl->set_var("value", $listValue->getValue());
			        $this->tpl->set_var("status", $listValue->getStatus());
			        $this->tpl->set_var("statusCheck", $this->getStatusCheck($listValue->getStatus()));
					$this->tpl->parse("MachineriesClassesListBlock", "MachineriesClassesList", true);
				}
			}
		}
		$this->setForm();
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
$machineriesClassesList = new MachineriesClassesList($HTTP_POST_VARS,$sess,$sortBy,$sortOrder,$hideInactive);
$machineriesClassesList->Main();
?>
<?php page_close(); ?>
