<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Barangay.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/AFS.php";
require_once("collection/dues.php";

#####################################
# Define Interface Class
#####################################
class RPTOPDetails{
	
	var $tpl;
	var $formArray;
	function RPTOPDetails($http_post_vars,$sess,$rptopID){
		$this->sess = $sess;

	}
	
	function Main(){

		$fp = fopen("batchCalculate.log", "w") or die("Couldn't create new file"); 
		$rptopID = (isset($_POST['rptopID']))? $_POST['rptopID']:$_GET['rptopID'];

		if(is_array($rptopID)){
			foreach($rptopID as $key=>$id){
				$RPTOPDetails = new SoapObject(NCCBIZ."RPTOPDetails.php", "urn:Object");
				if (!$xmlStr = $RPTOPDetails->getRPTOP($id)){
					exit("xml failed");
				}
				else{
					fwrite($fp,"\r\nrptopid: ".$id."\r\n");
					if(!$domDoc = domxml_open_mem($xmlStr)){
						echo "error xmlDoc";
					}
					else{
						$rptop = new RPTOP;
						$td = new TD();

						$rptop->parseDomDocument($domDoc);
						foreach($rptop as $key => $rvalue){
							if ($key == "tdArray") {
								$tdCtr = 0;

								if (count($rvalue)){
									foreach($rvalue as $tkey => $tvalue){			
										$td->selectRecord($tvalue->getTdID());
										$assessedValue = number_format($td->getAssessedValue(),2,".","");

										$taxDue = new Dues($tvalue->getTdID(), $rptop->getTaxableYear());
										$taxDue->setBasic($assessedValue);
										$taxDue->setSEF($assessedValue);
										$taxDue->setIdleStatus($idleStatus);

										if ($taxDue->getIdleStatus()) $taxDue->setIdle($assessedValue);
										else $taxDue->setIdle(0);

										$taxDue->store();

										echo $id;
										echo "=>";
										echo $tvalue->getTdID();
										echo "<br>";


										fwrite($fp,"TD: ".$tvalue->getTdID()."...PROCESSED COMPLETE\r\n");
										$tdCtr++;
									}
								}
							}							
						}	
					}
				}
			}

			header("Location: batchCalculateDone.php".$this->sess->url(""));
			exit;

		}
	}
}

#####################################
# Define Procedures and Functions
#####################################

##########################################################
# Begin Program Script
##########################################################
//*
page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/
$ownerList = new RPTOPDetails($HTTP_POST_VARS,$sess,$rptopID);
$ownerList->main();
?>
<?php page_close(); ?>
