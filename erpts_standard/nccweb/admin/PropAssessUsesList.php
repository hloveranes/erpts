<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/PropAssessUses.php";
include("assessor/PropAssessUsesRecords.php";

#####################################
# Define Interface Class
#####################################
class PropAssessUsesList{
	
	var $tpl;
	var $formArray;
	function PropAssessUsesList($http_post_vars,$sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "PropAssessUsesList.htm") ;
		$this->tpl->set_var("TITLE", "Property Assessment Actual Uses List");
		$this->tpl->set_var("Session", $this->sess->url(""));
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
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
				if (count($this->formArray["propAssessUsesID"]) > 0) {
					$PropAssessUsesList = new SoapObject(NCCBIZ."PropAssessUsesList.php", "urn:Object");
					if (!$deletedRows = $PropAssessUsesList->deletePropAssessUses($this->formArray["propAssessUsesID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				break;
			case "activate":
			        $PropAssessUsesList = new SoapObject(NCCBIZ."PropAssessUsesList.php", "urn:Object");
			        if(!$activeRows = $PropAssessUsesList->updateStatus($this->formArray["status"])){
			            $this->tpl->set_var("msg", "All records have status made <i>inactive</i>");
                    }
                    else{
                        $this->tpl->set_var("msg", $activeRows." records have status made <i>active</i>");
                    }
			    break;
			case "cancel":
				header("location: PropAssessUsesList.php";
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
		}
		$PropAssessUsesList = new SoapObject(NCCBIZ."PropAssessUsesList.php", "urn:Object");
		if (!$xmlStr = $PropAssessUsesList->getPropAssessUsesList()){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "database is empty");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
	 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$propAssessUsesRecords = new PropAssessUsesRecords;
				$propAssessUsesRecords->parseDomDocument($domDoc);
				$list = $propAssessUsesRecords->getArrayList();
				$this->tpl->set_block("rptsTemplate", "PropAssessUsesList", "PropAssessUsesListBlock");
				foreach ($list as $key => $listValue){
				    $this->tpl->set_var("propAssessUsesID", $listValue->getPropAssessUsesID());
				    $this->tpl->set_var("code", $listValue->getCode());
			        $this->tpl->set_var("description", $listValue->getDescription());
			        $this->tpl->set_var("value", $listValue->getValue());
			        $this->tpl->set_var("status", $listValue->getStatus());
			        $this->tpl->set_var("statusCheck", $this->getStatusCheck($listValue->getStatus()));
					$this->tpl->parse("PropAssessUsesListBlock", "PropAssessUsesList", true);
				}
			}
		}
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
$propAssessUsesList = new PropAssessUsesList($HTTP_POST_VARS,$sess);
$propAssessUsesList->Main();
?>
<?php page_close(); ?>
