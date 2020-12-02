<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/AssessmentSettings.php";

#####################################
# Define Interface Class
#####################################
class AssessmentSettingsEncode{
	var $tpl;

	function AssessmentSettingsEncode($http_post_vars,$sess,$formAction){
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

		$this->tpl->set_file("rptsTemplate", "AssessmentSettingsEncode.htm") ;
		$this->tpl->set_var("TITLE", "Assessment Settings");

		$this->formArray = array(
			"formAction" => $formAction
			,"message" => ""
		);

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
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

	function setForm(){
		if($this->formArray["autoCalculate"]=="true"){
			$this->formArray["autoCalculate_true_checked"] = "checked";
			$this->formArray["autoCalculate_false_checked"] = "";
		}
		else if($this->formArray["autoCalculate"]=="false"){
			$this->formArray["autoCalculate_true_checked"] = "";
			$this->formArray["autoCalculate_false_checked"] = "checked";
		}
		else{
			$this->formArray["autoCalculate_true_checked"] = "";
			$this->formArray["autoCalculate_false_checked"] = "";
		}

		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function Main(){
		$assessmentSettings = new AssessmentSettings;
		switch ($this->formArray["formAction"]){
			case "reset":
				// If AssessmentSettings Table doesn't exist, Create table and insert defaults
				$assessmentSettings->setAutoCalculate("true");

				if(!$assessmentSettings->tableExists()){
					$assessmentSettings->createTable();
					$assessmentSettings->insertRecord();
				}
				else{
					$assessmentSettings->updateRecord();
				}

				$this->formArray["message"] = "Variables reset to default values.";
				break;
			case "save":
				if($assessmentSettings->tableExists()){
					$assessmentSettings->setAutoCalculate($this->formArray["autoCalculate"]);

					if($assessmentSettings->updateRecord()){
						$this->formArray["message"] = "Assessment Settings saved.";
					}
					else{
						$this->formArray["message"] = "Error saving. Try clicking 'Reset' to restore defaults.";
					}
				}
				else{
					$this->formArray["message"] = "Error saving. Try clicking 'Reset' to restore defaults.";
				}
	
				break;
			default:
				// If AssessmentSettings Table doesn't exist, Create table and insert defaults from masterTables (upon installation)

				if(!$assessmentSettings->tableExists()){
					$assessmentSettings->createTable();
				}

				// If somehow no record exists in AssessmentSettings, Insert a Record (unlikely to occur)

				if(!$assessmentSettings->selectRecord()){
					$assessmentSettings->setAutoCalculate("true");
					$assessmentSettings->insertRecord();
				}

				// If somehow more than 1 record exists in Treasury Settings, delete all records and Insert Record (unlikely to occur)

				if($assessmentSettings->countRecord()>1){
					$assessmentSettings->deleteRecord();
					$assessmentSettings->setAutoCalculate("true");
					$assessmentSettings->insertRecord();
				}
		}

		if($assessmentSettings->selectRecord()){
			$this->formArray["autoCalculate"] = $assessmentSettings->getAutoCalculate();
		}
		else{
			$this->formArray["autoCalculate"] = "true";
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

$obj = new AssessmentSettingsEncode($HTTP_POST_VARS,$sess,$formAction);
$obj->Main();

?>
<?php page_close(); ?>
