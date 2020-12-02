<?php
# Setup PHPLIB in this Area
include("web/prepend.php";
include("assessor/User.php";
include("assessor/UserRecords.php";

#####################################
# Define Interface Class
#####################################
class UserList{
	
	var $tpl;
	var $formArray;
	function UserList($http_post_vars,$sess,$sortBy,$sortOrder,$hideDisabled){
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

		$this->tpl->set_file("rptsTemplate", "UserList.htm") ;
		$this->tpl->set_var("TITLE", "User List");
		$this->tpl->set_var("Session", $this->sess->url(""));

		$this->formArray["sortBy"] = $sortBy;
		$this->formArray["sortOrder"] = $sortOrder;
		$this->formArray["hideDisabled"] = $hideDisabled;
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function showHideDisabled(){
		$this->tpl->set_block("rptsTemplate", "ShowDisabledOn", "ShowDisabledOnBlock");
		$this->tpl->set_block("rptsTemplate", "HideDisabledOn", "HideDisabledOnBlock");

		switch($this->formArray["hideDisabled"]){
			case "false":
				$this->tpl->parse("ShowDisabledOnBlock", "ShowDisabledOn", true);
				$this->tpl->set_var("HideDisabledOnBlock", "");
				$condition = "";
				break;
			case "true":
			default:
				$this->formArray["hideDisabled"] = "true";
				$this->tpl->set_var("ShowDisabledOnBlock", "");
				$this->tpl->parse("HideDisabledOnBlock", "HideDisabledOn", true);
				$condition = " WHERE ".AUTH_USER_MD5_TABLE.".status='enabled' ";
				break;
		}
		return $condition;
	}

	function sortBlocks(){
		$this->sortBlockFields = array(
			  "userID" => "UserID"
			, "username" => "Username"
			, "fullName" => "FullName"
			, "userType" => "UserType"
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
			case "userID":
				$condition = " ORDER BY ".AUTH_USER_MD5_TABLE.".userID ".$this->formArray["sortOrder"];
				break;
			case "username":
				$condition = " ORDER BY ".AUTH_USER_MD5_TABLE.".username ".$this->formArray["sortOrder"];
				break;
			case "fullName":
				$condition = " ORDER BY fullName ".$this->formArray["sortOrder"];
				break;
			case "userType":
				$condition = " ORDER BY userType ".$this->formArray["sortOrder"];
				break;
			case "status":
				$condition = " ORDER BY ".AUTH_USER_MD5_TABLE.".status ".$this->formArray["sortOrder"];
				break;
			default:
				$this->formArray["sortBy"] = "userID";
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
			case "delete":
				if (count($this->formArray["userID"]) > 0) {
					$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
					if (!$deletedRows = $UserList->deleteUser($this->formArray["userID"])){
						$this->tpl->set_var("msg", "SOAP failed");
					}
					else{
						$this->tpl->set_var("msg", $deletedRows." records deleted");
					}
				}
				else $this->tpl->set_var("msg", "0 records deleted");
				break;
			case "enable":
			        $UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");
			        if(!$enabledRows = $UserList->updateStatus($this->formArray["status"])){
			            $this->tpl->set_var("msg", "All records have status <i>disabled</i>");
                    }
                    else{
                        $this->tpl->set_var("msg", $enabledRows." records have status <i>enabled</i>");
                    }
			    break;
			case "cancel":
				header("location: UserList.php";
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
		}
		$UserList = new SoapObject(NCCBIZ."UserList.php", "urn:Object");

		$condition = $this->showHideDisabled();
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
				$this->tpl->set_block("rptsTemplate", "UserList", "UserListBlock");
				foreach ($list as $key => $value){
				    $this->tpl->set_var("userID", $value->getUserID());
				    $this->tpl->set_var("userType", $value->getUserType());
			        $this->tpl->set_var("username", $value->getUsername());
			        $this->tpl->set_var("fullName", $value->getFullName());
			        $this->tpl->set_var("personID", $value->getPersonID());
			        $this->tpl->set_var("dateCreated", date("m-d-Y",$value->getDateCreated()));
			        $this->tpl->set_var("dateModified", $value->getDateModified());
					$this->tpl->set_var("status", $value->getStatus());
			        $this->tpl->set_var("statusCheck", $this->getStatusCheck($value->getStatus()));

					$userTypeListArray = $value->getUserTypeListArray();
					$userTypeBitArray = $value->getUserTypeBitArray($value->getUserType());

					$userTypeDescriptions = $value->getUserTypeDescriptions($userTypeListArray,$userTypeBitArray);

					$userTypeDescriptions = str_replace(",", ",<br>", $userTypeDescriptions);

					$this->tpl->set_var("userTypeDescriptions", $userTypeDescriptions);

					$this->tpl->parse("UserListBlock", "UserList", true);
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
$userList = new UserList($HTTP_POST_VARS,$sess,$sortBy,$sortOrder,$hideDisabled);
$userList->Main();
?>
<?php page_close(); ?>
