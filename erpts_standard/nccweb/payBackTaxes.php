<?php
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/Assessor.php";
include_once "../includes/assessor/TD.php";

include_once "../includes/assessor/AFS.php";
include_once "../includes/collection/dues.php";
include_once "../includes/assessor/OD.php";
include_once "../includes/assessor/ODHistory.php";
include_once "../includes/assessor/ODHistoryRecords.php";
include_once "../includes/collection/TDDetails.php";

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