<?
require_once("custom.rptop.phc");
require_once("web/prepend.php";
require_once("HTML/Template/ITX.php";

page_open(array("sess" => "rpts_Session"
	,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));


global $auth;
global $sess;

//print_r($sess);
$sessionvar= $sess->url("");

$user=$auth->auth;
	
$tpl=new HTML_Template_ITX(".");
$tpl->loadTemplatefile("rptopsearch.htm");

$tpl->setVariable("lastName",$_REQUEST['lastName']);
$tpl->setVariable("firstName",$_REQUEST['firstName']);
$tpl->setVariable("midName",$_REQUEST['midName']);

$tpl->setCurrentBlock("RPTOPLIST");

$tpl->setVariable("uname",$user["uname"]);
$tpl->setVariable("today", date("F j, Y"));
$tpl->setVariable("session",$sessionvar);
$tpl->setVariable("ownerName", $_POST['ownerName']);

if($_REQUEST['lastName']<>"" || $_REQUEST['firstName']<>"" || $_REQUEST['midName']<>""){
	$start=$_REQUEST['startpage'];
	$numrecs=$_REQUEST['numberofrecords'];
	echo $numrecs;
	$rptops=new RPTOPS($_REQUEST['lastName'],$_REQUEST['firstName'],$_REQUEST['midName'], $start, $numrecs);
	while(!$rptops->EOL()){
		$rptop=$rptops->fetchRPTOP();
		$record=$rptop->toArray();
		foreach($record as $k=>$field){
			$tpl->setVariable($k,$field);
		}
		$tpl->setVariable("Session",$sessionvar);
		$tpl->setVariable("rptopDetailsLinkLabel","Edit");
		$rptops->fetchNext();	
		$tpl->parseCurrentBlock();
	}	
}else{
	$templatevars=array("tdnumber"=>"", "pin"=>"", "afsid"=>"", 
			"location"=>"","year"=>"","Session"=>$sessionvar,
			"afsDetailsLinkLabel"=>"Edit");
		
	foreach($templatevars as $tempvar){
		$tpl->setVariable($tempvar);
		$tpl->parseCurrentBlock();
	}		
}




$tpl->show();

page_close();
?>
