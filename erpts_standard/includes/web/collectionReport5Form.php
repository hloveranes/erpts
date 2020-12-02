<?php
include_once "./prepend.php";
require_once('collection/Receipt.php');
//require_once('collection/Collections.php');
require_once('collection/Payment.php');
//require_once('collection/dues.php');

page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));

$tpl=new rpts_Template();
$tpl->set_file(array(report=>"collectionReport5Form.htm"));

global $auth;

$this->sess = $sess;
$this->user = $auth->auth;
$this->formArray["uid"] = $auth->auth["uid"];
$this->user = $auth->auth;

$tpl->set_var("uname", $this->user["uname"]);
$tpl->set_var("today", date("F j, Y"));

// must have atleast TM-VIEW access
$pageType = "%%%%1%%%%%";
if (!checkPerms($this->user["userType"],$pageType)){
	header("Location: Unauthorized.php".$this->sess->url(""));
	exit;
}



$tpl->set_var("Session", $sess->url(""));
$tpl->pparse(report,report);

page_close();

?>
