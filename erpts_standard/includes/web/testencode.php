<?php
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/Address.php";
include_once "../assessor/Company.php";
include_once "../assessor/CompanyRecords.php";
include_once "../assessor/Person.php";
include_once "../assessor/PersonRecords.php";
include_once "../assessor/Owner.php";
include_once "../assessor/OwnerRecords.php";
include_once "../assessor/RPTOP.php";
include_once "../assessor/RPTOPRecords.php";
include_once "../assessor/AFS.php";
require_once('collection/Receipt.php');
require_once('collection/Payment.php');
require_once('collection/dues.php');
require_once('web/clibPDFWriter.php');
?>
<?php
echo "Start test <br>\n";
$rptop = new RPTOP;
$rptop->selectRecord("55");
echo "RPTOP values<br>\n";
foreach ($rptop as $key=>$value){
        echo "$key = $value<br>\n";
}
$owner = $rptop->getOwner();
echo "Owner values<br>\n";
foreach ($owner as $key=>$value){
        echo "$key = $value<br>\n";
}
$personarray = $owner->personArray;
echo "Owner Person Array values<br>\n";
foreach ($personarray as $person){
        echo "Person values<br>\n";
        foreach ($person as $key=>$value){
                echo "$key = $value<br>\n";
        }
        $addressArray = $person->getAddressArray();
        echo "Address Array values<br>\n";
        foreach ($addressArray as $address){
                echo "Address values<br>\n";
                foreach ($address as $key=>$value){
                echo "$key = $value<br>\n";
                }
        }
}

$tdarray = $rptop->tdArray;
echo "RPTOP TD Array values<br>\n";
foreach ($tdarray as $td){
        echo "RPTOP TD Array values<br>\n";
        foreach ($td as $key=>$value){
                echo "$key = $value<br>\n";
        }
}

$td1 = new TD();
$td1->selectRecord("601");
$td2 = new TD();
$td2->selectRecord("600");
echo "TD1  values<br>\n";
foreach ($td1 as $key=>$value){
        echo "$key = $value<br>\n";
}
echo "TD2 values<br>\n";
foreach ($td2 as $key=>$value){
        echo "$key = $value<br>\n";
}

$propertyType = $td1->propertyType;
$property1 = new Land();
$property1->selectRecord($td1->propertyID);

echo "property1 values<br>\n";
foreach ($property1 as $key=>$value){
        echo "$key = $value<br>\n";
}

$afsID = $property1->getAfsID();
$afs = new AFS;
$afs->selectRecord($afsID);
echo "AFS values<br>\n";
foreach ($afs as $key=>$value){
        echo "$key = $value<br>\n";
}

$tdNum = $td1->getTaxDeclarationNumber();
$taxDue = new Dues();

$taxDue->create($tdNum,"2002-01-01");
echo "taxDue values<br>\n";
foreach ($taxDue as $key=>$value){
        echo "$key = $value<br>\n";
}
$dueDate = $taxDue->getDueDate();
$dueTime = strtotime($dueDate);
echo "TaxDue date $dueDate and time $dueTime <br>\n";
echo "End test <br>\n";
?>

