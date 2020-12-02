<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/collection/Shares.php";

#####################################
# Define Interface Class
#####################################
class SharesEncode{
	var $tpl;

	function SharesEncode($http_post_vars,$sess,$formAction){
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

		$this->tpl->set_file("rptsTemplate", "SharesEncode.htm") ;
		$this->tpl->set_var("TITLE", "Shares");

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

	function setDateDropDown($type){
		eval(MONTH_ARRAY);//$monthArray
		$this->tpl->set_block("rptsTemplate", $type."MonthList", $type."MonthListBlock");
		foreach($monthArray as $key => $value){
			$this->tpl->set_var($type."monthValue", $key);
			$this->tpl->set_var($type."month", $value);
			$this->initSelected($type."month",$key);
			$this->tpl->parse($type."MonthListBlock", $type."MonthList", true);
		}
		$this->tpl->set_block("rptsTemplate", $type."DayList", $type."DayListBlock");
		for($i = 1; $i<=31; $i++){
			$this->tpl->set_var($type."dayValue", $i);
			$this->initSelected($type."day",$i);
			$this->tpl->parse($type."DayListBlock", $type."DayList", true);
		}
	}

	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

	function Main(){
		$shares = new Shares;
		switch ($this->formArray["formAction"]){
			case "reset":
				// If Shares Table doesn't exist, Create table and insert defaults
				$shares->setProvincialCityShare(0);
				$shares->setMunicipalShare(0);
				$shares->setBarangayShare(0);

				if(!$shares->tableExists()){
					$shares->createTable();
					$shares->insertRecord();
				}
				else{
					$shares->updateRecord();
				}

				$this->formArray["message"] = "Variables reset to default values.";
				break;
			case "save":
				if($shares->tableExists()){
					$shares->setProvincialCityShare($this->formArray["provincialCityShare"]);
					$shares->setMunicipalShare($this->formArray["municipalShare"]);
					$shares->setBarangayShare($this->formArray["barangayShare"]);

					if($shares->updateRecord()){
						$this->formArray["message"] = "Shares saved.";
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
				// If Shares Table doesn't exist, Create table and insert defaults
				if(!$shares->tableExists()){
					$shares->createTable();
				}

				// If somehow no record exists in Shares, Insert a Record (unlikely to occur)

				if(!$shares->selectRecord()){
					$shares->setProvincialCityShare(0);
					$shares->setMunicipalShare(0);
					$shares->setBarangayShare(0);
					$shares->insertRecord();
				}

				// If somehow more than 1 record exists in Treasury Settings, delete all records and Insert Record (unlikely to occur)

				if($shares->countRecord()>1){
					$shares->deleteRecord();
					$shares->setProvincialCityShare(0);
					$shares->setMunicipalShare(0);
					$shares->setBarangayShare(0);
					$shares->insertRecord();
				}
		}

		if($shares->selectRecord()){
			$this->formArray["provincialCityShare"] = $shares->getProvincialCityShare();
			$this->formArray["municipalShare"] = $shares->getMunicipalShare();
			$this->formArray["barangayShare"] = $shares->getBarangayShare();
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

$obj = new SharesEncode($HTTP_POST_VARS,$sess,$formAction);
$obj->Main();

?>
<?php page_close(); ?>
