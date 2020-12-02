<?php
include_once "./prepend.php";
include_once "../assessor/Owner.php";
include_once "../assessor/Assessor.php";
include_once "../assessor/TD.php";

include_once "../assessor/AFS.php";
include_once "../collection/dues.php";
include_once "../assessor/OD.php";
include_once "../assessor/ODHistory.php";
include_once "../assessor/ODHistoryRecords.php";
include_once "../collection/TDDetails.php";

class DuesDetails
{
	var $formArray;
	var $td;
	function DuesDetails($input,$rptopID){
		$this->tpl = new rpts_Template(getcwd());
		$this->tpl->set_file("rptsTemplate", "PayRPTOP2.htm") ;
		$this->tpl->set_var("TITLE", "Owner List");
		
	
	}
	
	function Main(){
	
	//$tdID = $_GET['tdID'];
	$tdID = 66;
	$TDDetails = new TDDetails;
	$tdHistoryArray = $TDDetails->getTDHistory($tdID);

		if (is_array($tdHistoryArray)) {
			foreach($tdHistoryArray as $item) {
				$tdID = $item->tdID;
				$yearDue = ($item->ceasesWithTheYear) ? $item->ceasesWithTheYear : date("Y");		
				
				$dues = new Dues($tdID,$yearDue);
				$paymentPeriod = $dues->getPaymentMode();
				$totalDue = $dues->getTotalDue($paymentPeriod);
				$basic = $dues->getBasic($paymentPeriod);
				print_r($dues);
				echo "<br>";
				
			}
		}
	
	
	

		//$this->getDues();
	}
}
page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
$duesDetails = new DuesDetails($HTTP_POST_VARS,$rptopID);
$duesDetails->Main();
page_close();
?>