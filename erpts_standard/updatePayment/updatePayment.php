<?
	if(!is_numeric($_GET["limit"])) $_GET["limit"] = 20;
?>

<form action="updatePayment.php" method="get">
Batch Limit: <input type="text" name="limit" value="<? echo $_GET["limit"]; ?>" size=3>
<input type="hidden" name="formAction" value="go">
<input type="submit" name="goBtn" value="Process Next Batch">
</form>
<?

if($_GET["formAction"]!="go") exit;

ini_set("max_execution_time",300);

include_once "../inlcudes/collection/Payment.php";
include_once "../inlcudes/collection/PaymentRecords.php";

//$condition = "WHERE Payment.propertyType IS NULL ";

$paymentRecords = new PaymentRecords;
$paymentRecords->selectRecords($condition);

echo "<hr>";

echo "count:";
echo count($paymentRecords->arrayList);
echo "<hr>";

$count = 0;

foreach($paymentRecords->arrayList as $payment){
	if(is_numeric($_GET["limit"])){
		if($count==$_GET["limit"]){
			exit;
		}
	}
	else{
		if($count==20){
			exit;
		}
	}
	$count++;

	$payment->setForeignAttributes();
	$payment->updateRecord();

	echo "<font face=verdana size=1>";
	echo "<br>";
	echo "#: ".$count;
	echo "<br>";
	echo "<b>paymentID</b>:".$payment->getPaymentID();
	echo "<br>";
	echo "<b>propertyType</b>:".$payment->getPropertyType();
	echo "<br>";
	echo "<b>propertyClassification</b>:".$payment->getPropertyClassification();
	echo "<br>";
	echo "<b>municipalityCity</b>:".$payment->getMunicipalityCity();
	echo "</font>";
	echo "<hr>";

	unset($payment);
}

/*
$payment = new Payment;
$payment->selectRecord(1);

//$payment->setForeignAttributes();
//$payment->updateRecord();

print_r($payment);
*/
?>