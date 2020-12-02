<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/User.php";
include("assessor/UserRecords.php";
include_once "../includes/assessor/eRPTSSettings.php";

#####################################
# Define Interface Class
#####################################
class UserList{
	
	var $tpl;
	var $formArray;
	function UserList($http_post_vars,$sess,$sortBy,$sortOrder){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "UserListPrint.htm") ;
		$this->tpl->set_var("TITLE", "User List");
		$this->tpl->set_var("Session", $this->sess->url(""));

		$this->formArray["sortBy"] = $sortBy;
		$this->formArray["sortOrder"] = $sortOrder;
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function sortBlocks(){

		$this->formArray["userIDSortOrder"] = "ASC";
		$this->formArray["usernameSortOrder"] = "ASC";
		$this->formArray["fullNameSortOrder"] = "ASC";
		$this->formArray["userTypeSortOrder"] = "ASC";
		$this->formArray["statusSortOrder"] = "ASC";

		switch($this->formArray["sortBy"]){
			case "userID":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["userIDSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["userIDSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY ".AUTH_USER_MD5_TABLE.".userID ".$this->formArray["sortOrder"];
				break;
			case "username":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["usernameSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["usernameSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY ".AUTH_USER_MD5_TABLE.".username ".$this->formArray["sortOrder"];
				break;
			case "fullName":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["fullNameSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["fullNameSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY fullName ".$this->formArray["sortOrder"];
				break;
			case "userType":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["userTypeSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["userTypeSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY userType ".$this->formArray["sortOrder"];
				break;
			case "status":
				switch($this->formArray["sortOrder"]){
					case "ASC":
						$this->formArray["statusSortOrder"] = "DESC";
						break;
					case "DESC":
						$this->formArray["statusSortOrder"] = "ASC";
						break;
					default:
						$this->formArray["sortOrder"] = "DESC";
						break;
				}
				$condition = " ORDER BY status ".$this->formArray["sortOrder"];
				break;
			default:
				$this->formArray["sortBy"] = "userID";
				$this->formArray["sortOrder"] = "DESC";
				$condition = " ORDER BY ".AUTH_USER_MD5_TABLE.".userID DESC";
				break;
		}
		return $condition;
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

    function getStatusCheck($status){
        if($status=="enabled"){
            return("checked");
        }
        else{
            return "";
        }
    }	
	
	function Main(){
		switch ($this->formArray["formAction"]){
			default:
				$this->tpl->set_var("msg", "");
		}

		$eRPTSSettingsDetails = new SoapObject(NCCBIZ."eRPTSSettingsDetails.php", "urn:Object");
		if (!$xmlStr = $eRPTSSettingsDetails->getERPTSSettingsDetails(1)){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "record not found");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
				$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$erptsSettings = new eRPTSSettings;
				$erptsSettings->parseDomDocument($domDoc);

				$this->formArray["eRPTSSettingsID"] = $erptsSettings->getERPTSSettingsID();
				$this->formArray["lguName"] = $erptsSettings->getLguName();
				$this->formArray["lguType"] = $erptsSettings->getLguType();
				$this->formArray["chiefExecutiveDesignation"] = 		$erptsSettings->getChiefExecutiveDesignation();
				$this->formArray["chiefExecutiveFirstName"] = $erptsSettings->getChiefExecutiveFirstName();
				$this->formArray["chiefExecutiveMiddleName"] = $erptsSettings->getChiefExecutiveMiddleName();
				$this->formArray["chiefExecutiveLastName"] = $erptsSettings->getChiefExecutiveLastName();

				$this->formArray["assessorDesignation"] = $erptsSettings->getAssessorDesignation();
				$this->formArray["assessorFirstName"] = $erptsSettings->getAssessorFirstName();
				$this->formArray["assessorMiddleName"] = $erptsSettings->getAssessorMiddleName();
				$this->formArray["assessorLastName"] = $erptsSettings->getAssessorLastName();

				$this->formArray["treasurerDesignation"] = $erptsSettings->getTreasurerDesignation();
				$this->formArray["treasurerFirstName"] = $erptsSettings->getTreasurerFirstName();
				$this->formArray["treasurerMiddleName"] = $erptsSettings->getTreasurerMiddleName();
				$this->formArray["treasurerLastName"] = $erptsSettings->getTreasurerLastName();
			}
		}

		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
		$condition = " WHERE status='enabled' ";
		$this->tpl->set_var("activeInactive","(enabled ONLY)");
		$condition .= $this->sortBlocks();
		if (!$xmlStr = $UserList->getUserList(0,$condition)){
			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
			$this->tpl->set_var("TableBlock", "database is empty");
		}
		else {
			if(!$domDoc = domxml_open_mem($xmlStr)) {
	 			$this->tpl->set_block("rptsTemplate", "Table", "TableBlock");
				$this->tpl->set_var("TableBlock", "error xmlDoc");
			}
			else {
				$userRecords = new UserRecords;
				$userRecords->parseDomDocument($domDoc);
				$list = $userRecords->getArrayList();

				$this->tpl->set_var("totalRecords", count($list));
				$this->tpl->set_block("rptsTemplate", "UserList", "UserListBlock");
				foreach ($list as $key => $value){
				    $this->tpl->set_var("userID", $value->getUserID());
				    $this->tpl->set_var("userType", $value->getUserType());

					$userTypeListArray = $value->getUserTypeListArray();
					$userTypeBitArray = $value->getUserTypeBitArray($value->getUserType());

					$userTypeDescriptions = $value->getUserTypeDescriptions($userTypeListArray,$userTypeBitArray);

					$userTypeDescriptions = str_replace(",", ",<br>", $userTypeDescriptions);

					$this->tpl->set_var("userTypeDescriptions", $userTypeDescriptions);


			        $this->tpl->set_var("username", $value->getUsername());
			        $this->tpl->set_var("fullName", $value->getFullName());
			        $this->tpl->set_var("personID", $value->getPersonID());
			        $this->tpl->set_var("dateCreated", date("m-d-Y",$value->getDateCreated()));
			        $this->tpl->set_var("dateModified", date("m-d-Y",$value->getDateModified()));
					$this->tpl->set_var("status", $value->getStatus());
			        $this->tpl->set_var("statusCheck", $this->getStatusCheck($value->getStatus()));
					$this->tpl->parse("UserListBlock", "UserList", true);
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
$userList = new UserList($HTTP_POST_VARS,$sess,$sortBy,$sortOrder);
$userList->Main();
?>
<?php page_close(); ?>
