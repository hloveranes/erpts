<?
include("web/prepend.php";
include("assessor/User.php";
include("assessor/UserRecords.php";


$userRecords = new UserRecords;
if ($userRecords->selectRecords()){
	if(!$domDoc = $userRecords->getDomDocument()){
		echo "blah";
	}
	else {
		$xmlStr = $domDoc->dump_mem(true);
	}
}

$domDoc = domxml_open_mem($xmlStr);

$userRecords = new UserRecords;
$userRecords->parseDomDocument($domDoc);
$list = $userRecords->getArrayList();
foreach ($list as $key => $value){
    echo $value->getUserID();
	echo $value->getUserType();
	echo $value->getUsername();
	echo $value->getFullName();
	echo $value->getPersonID();
	echo $value->getDateCreated();
	echo $value->getDateModified();
	echo $value->getStatus();
	echo $value->getStatus();
}


?>