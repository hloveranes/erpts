<?php
include_once "../includes/web/prepend.php";
require_once('collection/Receipt.php');
//require_once('collection/Collection.php');
require_once('collection/Payment.php');
//require_once('collection/Due.php');

page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));

$tpl=new rpts_Template();
$tpl->set_file(array(report=>"collectionReport2Form.htm"));

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


$tpl->set_block(report,LGUBLK,lguBlk);

$db = new DB_RPTS;

$sql="select * from MunicipalityCity order by description;";
$db->query($sql);
for ($i=0; $db->next_record(); $i++) {
	$tpl->set_var($db->Record);
	$tpl->parse(lguBlk,LGUBLK,true);
}
if($municipalityCityID){
	$tpl->set_var("selected_municipalityCityID_".$municipalityCityID,"selected");
}else{
	$tpl->set_var("selected_municipalityCityID_".$municipalityCityID,"");
}
if($startMM){
	$tpl->set_var("selected_startMM_".$startMM,"selected");
}else{
	$tpl->set_var("selected_startMM_".startMM,"");
}
if($endMM){
	$tpl->set_var("selected_endMM_".$endMM,"selected");
}else{
	$tpl->set_var("selected_endMM_".$endMM,"");
}
if($propertyType){
	switch($propertyType){
		case 1:	getActualUses("Land",$tpl);
				break;
		case 2: getActualUses("ImprovementsBuildings",$tpl);
				break;
		case 3: getActualUses("Machineries",$tpl);
				break;
		case 4: getActualUses("PlantsTrees",$tpl);
				break;
		default :
			break;
	}
	$tpl->set_var("selected".$propertyType,"selected");
	$tpl->set_var(startYear,$startYY);
	$tpl->set_var(endYear,$endYY);
}else{
	$tpl->set_var(startYear,date("Y"));
	$tpl->set_var(endYear,date("Y"));
	 //$tpl->set_block(report,ACTUALUSE,aBlk);
	 //$db->query("Select * from LandActualUses");
	 getActualUses("Land",$tpl);
}

$tpl->set_var("Session", $sess->url(""));
$tpl->pparse(report,report);

page_close();

function getActualUses($var,&$tpl){
	if($var=="") return;
	$db = new DB_RPTS;
	
	$sql = "SELECT * FROM ".$var."ActualUses ORDER BY ".$var."ActualUses.description ASC ";

	$tpl->set_block(report,ACTUALUSE,aBlk);
	$db->query($sql);

	$firstChar = strtolower(substr($var,0,1));
	$restOfTheString = substr($var,1);

	$keyVar = $firstChar.$restOfTheString."ActualUsesID";

	while($db->next_record()){

		foreach($db->Record as $key=>$value){
			
			switch($key){
				case "description":
					$tpl->set_var(actualUseDesc,$value);
					break;
				case "code":
					$tpl->set_var(actualUseCode,$value);
					break;
				case $keyVar:
					$tpl->set_var(actualUseID,$value);
					break;
				default: break;
			}
			//echo "$key=>$value <br>";
		}
		$tpl->parse(aBlk,ACTUALUSE,true);
	}

}
?>
