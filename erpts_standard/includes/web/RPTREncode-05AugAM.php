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
require_once('collection/NumbersToWords.php');
require_once('web/clibPDFWriter.php');
?>
<?php
class RPTREncode {
    var $errorMessages = array();
    /** these are the objects concerned
     **
     **/
    var $tpl;
    
    function RPTREncode(){
        $this->tpl = new Template(getcwd());
    }
    function main(){
		global $sess;
        if(isset($_POST['printReceipt_x'])) {
            $this->showReceipt(false);
        }
        else if(isset($_POST['recordReceipt'])){
	        $this->tpl->set_file(array(step5=>"PayRPTOP5.htm"));
			$this->tpl->set_var("Session", $sess->url(""));
            $this->recordReceipt($_POST);
	        $this->tpl->pparse(OUT,step5);
        }
        else if(isset($_POST['issueReceipt'])){
			$this->issueReceipt();
        }
        else {
             $this->showDetails();
        }
    }

    function showDetails(){
        $this->tpl->set_file('step3','PayRPTOP3.htm');
        $this->setDetails();
        $this->tpl->parse('OUT','step3');
        $this->tpl->finish('OUT');
        $this->tpl->p('OUT');
    }
	
    function issueReceipt(){
        global $sess;
        $this->tpl->set_file('step4','PayRPTOP4.htm');
		$this->tpl->set_var("Session", $sess->url(""));
        $this->closeReceipt();
        $this->tpl->parse('OUT','step4');
        $this->tpl->finish('OUT');
        $this->tpl->p('OUT');
    }
	
    function setDetails(){
        global $sess;
        $this->tpl->set_var($_GET);
        $this->tpl->set_var($_POST);

        # set the RPTOP to get the owner's object and information
        # get it from POST if possible, otherwise from GET
        $rptopID = (isset($_POST['rptopID']))? $_POST['rptopID']:$_GET['rptopID'];
        $rptop = new RPTOP;
        $rptop->selectRecord($rptopID);
        $dateDue = $rptop->getTaxableYear()."-01-01"; # must be a usable format
        $formValues['datePaid'] = date("F j, Y");
		$formValues['taxableYear'] = $rptop->getTaxableYear();
        $formValues['rptopNum'] = $rptop->getRptopNumber();
		
		# set the specific TD (although this is in the RPTOP), hard to search for it.
        # get the tdID from POST or GET to initialize the TD
		$tdID = (isset($_POST['tdID']))? $_POST['tdID']:$_GET['tdID'];
		$td = new TD();
		$ctr = 0;
		
		# $this->tpl->set_block('step3','PrintTDID','PrintTDIDs');
		$this->tpl->set_block('step3','TDID','TDIDs');
		$this->tpl->set_block('step3','Property','Properties');
		$this->tpl->set_block('Property','Owner','Owners');
		
		if(is_array($tdID))
		foreach($tdID as $key=>$id){
   			# set/pass tdIDs to form			
			$this->tpl->set_var(tdID,$id);
			$this->tpl->parse('TDIDs','TDID','true');
			# $this->tpl->parse('PrintTDIDs','PrintTDID','true');	
			
			$td->selectRecord($id);
	        $tdNum = $td->getTaxDeclarationNumber();
			$formValues['tdNum'] = $tdNum;
			# get municipality/province and city(same for all tds)
			$lotAddress = new LocationAddress;
			$lotAddress->selectRecordFromTdID($id);
			$formValues['province'] = $lotAddress->getProvince();
			$formValues['city'] = $lotAddress->getMunicipalityCity();
			# get location/ block and lot number OR Barangay
			#$formValues['lotAddress'] = $lotAddress->getFullAddress();
			$formValues['lotAddress'] = $lotAddress->getNumber . " " . $lotAddress->getStreet();
			if ($formValues['lotAddress']=="") $formValues['lotAddress'] = $lotAddress->getBarangay();
			# we define the property from the TD
        	$propertyType = $td->getPropertyType();
	        $propertyID = $td->getPropertyID();
    	    switch ($propertyType){
				case "Land":
					$property = new Land;
					break;
				case "PlantsTrees":
					$property = new PlantsTrees;
					break;
				case "ImprovementsBuildings":
					$property = new ImprovementsBuildings;
					break;
				case "Machineries":
					$property = new Machineries;
			        break;
				default:
				    echo "cannot be! $propertyType";
				    break;
			}
			if(is_object($property)) {
    	        $property->selectRecord($propertyID); 
				$assessedValue = number_format($property->getAssessedValue(),2,".","");
		    	$formAssessedValue = number_format($property->getAssessedValue(),2);
				# separate assessed value of land and others(plantsTrees, improvementsBuildings, machineries)
				if($propertyType == "Land"){
					$formValues['assessedValueLand'] = $formAssessedValue;
					$formValues['assessedValueOthers'] = "";
				}
				else{
					$formValues['assessedValueLand'] = "";
					$formValues['assessedValueOthers'] = $formAssessedValue;
				}
			}
			$formValues['assessedValue'] = $formAssessedValue;
			$formValues['propertyType'] = $propertyType;

			# set the owner's List
			# we define the owner from the RPTOP
			if($ctr > 0){
				$ownerValues['ownerName'] = "";
				$ownerValues['ownerAddress'] = "";
				$this->tpl->set_var($ownerValues);
				$this->tpl->parse(Owners,Owner,false);
			}
			else{
			$owner = $rptop->getOwner();
		   	$personArray = $owner->getPersonArray();
	   		if(is_array($personArray))
	   	    	foreach ($personArray as $person){
					$ownerValues['ownerKey']="personID";
					$ownerValues['ownerScript']="PersonDetails.php";
					$ownerValues['ownerID'] = $person->getPersonID();
					$ownerValues['ownerName'] = $person->getLastName().", ".
        	   	    	                        $person->getFirstName(). " ".
            	   	    	                    $person->getMiddleName();
		        	
					/*$addressArray = $person->getAddressArray();
	    		    $address = $addressArray[0];
    	    		$ownerValues['ownerAddress'] = $address->getNumber()." ".
        	    		                           $address->getStreet()."<br>".
            	  		                           $address->getBarangay().", ".
                	   		                       $address->getMunicipalityCity()."<br>".
                    	   		                   $address->getProvince();*/
					
			       $this->tpl->set_var($ownerValues);
    			   $this->tpl->parse('Owners','Owner','true');
  	    		}
											  
				$companyArray = $owner->getCompanyArray();
	
			if(is_array($companyArray))
    			foreach ($companyArray as $company){
					$ownerValues['ownerKey']="companyID";
					$ownerValues['ownerScript']="CompanyDetails.php";
					$ownerValues['ownerID'] = $company->getCompanyID();
	        		$ownerValues['ownerName'] = $company->getCompanyName();
					
    	       		/*$addressArray = $company->getAddressArray();
		    	    $address = $addressArray[0];
    		    	$ownerValues['ownerAddress'] = $address->getNumber()." ".
        	        	                           $address->getStreet()."<br>".
           		        	                       $address->getBarangay().", ".
               		        	                   $address->getMunicipalityCity()."<br> ".
                   		        	               $address->getProvince();
	                 */
			        $this->tpl->set_var($ownerValues);
    			    $this->tpl->parse('Owners','Owner','true');
        		}
				
				if(is_array($personArray)){
					if(count($personArray) > 1){
						$receivedFrom = $personArray[0]->getFirstName(). " ".
            	   	    	            $personArray[0]->getMiddleName()." ".			
										$personArray[0]->getLastName(). " et al.";
					}
					else{
						$receivedFrom = $personArray[0]->getFirstName(). " ".
            	   	    	            $personArray[0]->getMiddleName()." ".			
										$personArray[0]->getLastName();
					}
				}
				else if(is_array($companyArray)){
					if(count($companyArray) > 1){
						$receivedFrom = $companyArray[0]->getCompanyName(). " et al.";
					}
					else{
						$receivedFrom = $companyArray[0]->getCompanyName();
					}
				}
				$formValues['receivedFrom'] = $receivedFrom;
			}
		
        	# tax dues are defined from TDNumber and taxableYear
        	# compute for taxes
	        $taxDue = new Dues();
    	    if($taxDue->create($tdNum,$dateDue) == false){
        	    $taxDue->setBasic($assessedValue);
            	$taxDue->setSEF($assessedValue);
	            $taxDue->setDueDate($dateDue);
    	        $taxDue->setUpdateDate();
        	}
	        $paymentPeriod= "Annual";
    	    if(isset($_POST['paymentPeriod'])){
        	    $paymentPeriod = $_POST['paymentPeriod'];
        	}
	        switch($paymentPeriod){
    	            case 'Annual':
        	             $this->tpl->set_var("checkedAnnual","checked");
        	             $this->tpl->set_var("selectedAnnual","selected");
						 $this->tpl->set_var("paymentPeriod",$paymentPeriod);
            	         break;
	                case 'Q1':
    	                 $this->tpl->set_var("checkedQ1","checked");
        	             $this->tpl->set_var("selectedQ1","selected");
						 $this->tpl->set_var("num","1");
 						 $this->tpl->set_var("paymentPeriod",$paymentPeriod);
        	             break;
            	    case 'Q2':
	                     $this->tpl->set_var("checkedQ2","checked");
        	             $this->tpl->set_var("selectedQ2","selected");
						 $this->tpl->set_var("num","2");
 						 $this->tpl->set_var("paymentPeriod",$paymentPeriod);
    	                 break;
        	        case 'Q3':
            	         $this->tpl->set_var("checkedQ3","checked");
        	             $this->tpl->set_var("selectedQ3","selected");
						 $this->tpl->set_var("num","3");
 						 $this->tpl->set_var("paymentPeriod",$paymentPeriod);
                	     break;
	                case 'Q4':
    	                 $this->tpl->set_var("checkedQ4","checked");
        	             $this->tpl->set_var("selectedQ4","selected");
						 $this->tpl->set_var("num","4");
						 $this->tpl->set_var("paymentPeriod",$paymentPeriod);
        	             break;
            	    default:
                	     break;
        	}
	        $this->tpl->set_var($formValues);
    	    ## Compute taxes and set the page values
        	$basic = $taxDue->getBasic($paymentPeriod);
	        $sef = $taxDue->getSEF($paymentPeriod);
    	    $interest = $taxDue->computePenalty($paymentPeriod);
        	$taxValues['basic'] = number_format($basic,2);
	        $taxValues['sef']   = number_format($sef,2);
    	    $taxValues['pd1185']= number_format(0.00,2);
	        $taxValues['subTotal'] = number_format($basic+$sef,2);
    	    $taxValues['periodTotal'] = number_format($basic+$sef,2);
        	$taxValues['discount'] = "0.0%";
	        $taxValues['interest'] = number_format($interest * 100.00,1)."%";
    	    $taxValues['totBasic'] = number_format($basic*(1+$interest),2);
        	$taxValues['totSEF']  = number_format($sef*(1+$interest),2);
	        $taxValues['totPD1185'] = number_format(0,2);
    	    $taxValues['totSubTotal'] = number_format(($basic + $sef)*(1+$interest),2);
        	$taxValues['grandTotal'] = number_format(($basic + $sef)*(1+$interest),2);
        	$taxValues['penalty'] = number_format($basic*$interest,2);
			# further breakdown of basic tax for RPT Receipt
	        $taxValues['gf'] = number_format($basic * 0.7,2); // 70% of basic
    	    $taxValues['ib'] = number_format($basic * 0.15,2); // 15% of basic
        	$taxValues['cb'] = number_format($basic * 0.15,2); // 15% of basic for a total if 100%
	        $taxValues['totGF'] = number_format($basic * 0.7 * (1+$interest),2);
    	    $taxValues['totIB'] = number_format($basic * 0.15 * (1+$interest),2);
	        $taxValues['totCB'] = number_format($basic * 0.15 * (1+$interest),2);
        
			if($paymentPeriod == "Annual"){
				$this->tpl->set_var("fullPmt", $taxValues['basic']);
				$this->tpl->set_var("partialPmt", "");
				# get full payment total
				$fullPmtTotal += $basic;
				$this->tpl->set_var("fullPmtTotal", number_format($fullPmtTotal,2));
			}
			else{
				$this->tpl->set_var("partialPmt", $taxValues['basic']);
				$this->tpl->set_var("fullPmt", "");
				# get partial payment total
				$partialPmtTotal += $basic;
				$this->tpl->set_var("partialPmtTotal", number_format($partialPmtTotal,2));
			}
			
    	    $this->tpl->set_var($taxValues);
			$this->tpl->parse('Properties','Property','true');
			$ctr++;
			
			# get totals for penalty and grand total
			$penaltyTotal += ($basic*$interest);
			$total += (($basic + $sef)*(1+$interest));
			$this->tpl->set_var("penaltyTotal", number_format($penaltyTotal,2));	
			$this->tpl->set_var("total", number_format($total,2));	
   	    }# end foreach
		
		# get totals in words
		$numToWords = new NumbersToWords();
		$totalInWords = $numToWords->num_to_string(number_format($total,2));
		$this->tpl->set_var("totalInWords", $totalInWords);

		if(!isset($_POST['printReceipt_x']))
           	$this->tpl->set_var("Session", $sess->url(""));
    }
	
    function validateInfo(){
        # check if RPTOP Exists
        # check if TD belongs to RPTOP
        # check if TD Exists
        # check if basic tax = basic[gf] + basic[ib] + basic[cb]
        # check if basic tax is accurate
        # check if sef is accurate
        $this->errorMessages['sefMsg'] = "SEF does not compute properly";
        # check if pd1185 is accurate
        # check if receipt number is unique
        $this->errorMessages['receiptNumberMsg'] = "Old Receipt Number is not Unique";
        # check for duplicate payments on same td for same period for same payment mode
        # show errors if any
        return false;
    }
    function recordReceipt($varValues){
        # create receipt object
        $receipt = new Receipt();
        # set the details of the receipt
        $receipt->setOldReceiptNum($varValues['oldReceiptNum']);
        $receipt->setRPTOPNum($varValues['rptopNum']);
        $receipt->setTDNum($varValues['tdNum']);
        # get the specific due by using the tdNum and the date on the RPTOP
        $taxDue = new Dues();
        $rptop = new RPTOP();
        if($rptop->selectRecord($varValues['rptopNum'])){
            $dueDate = $rptop->getRptopDate();
        }
        else {
            // if there is no valid RPTOP provided, then just use the dueDate
            $dueDate = $varValue['dueDate'];
        }
        $taxDue->create($tdNum,$dueDate,true); # create by date and true if it exists.
        $taxDue->store();
        # record the payments for each receipt
        $payments[0] = new Payment("sef");
        $payments[0]->setAmount($varValues['sefTotal']);
        $payments[0]->setDueType("sef");
        $payments[0]->setDiscount($varValues['discount']);
        $payments[0]->setInterest($varValues['interest']);
        $payments[0]->setDueID($taxDue->getDueID());
        $payments[0]->setReceiptNum($receipt->getReceiptNum());
        $payments[0]->storeRecord();
        $receipt->addPayment($payments[0]);
        $payments[1] = new Payment("basic");
        $payments[1]->setDueType("basic");
        $payments[1]->setAmount($varValues['gfTotal'] + $varValues['ibTotal'] + $varValues['cbTotal']);
        $payments[1]->setDiscount($varValues['discount']);
        $payments[1]->setInterest($varValues['interest']);
        $payments[1]->setDueID($taxDue->getDueID());
        $payments[1]->setReceiptNum($receipt->getReceiptNum());
        $payments[1]->storeRecord();
        $receipt->addPayment($payments[1]);
        $payments[2] = new Payment("pd1185");
        $payments[2]->setDueType("pd1185");
        $payments[2]->setAmount($varValues['pd1185Total']);
        $payments[2]->setDueID($taxDue->getDueID());
        $payments[2]->setReceiptNum($receipt->getReceiptNum());
        $payments[2]->storeRecord();
        $receipt->addPayment($payments[2]);
        # store the receipt
        $receipt->storeRecord();
    }
    function closeReceipt(){
        # create receipt object
        $receipt = new Receipt();
        # set the details of the receipt
        $receipt->setOldReceiptNum($varValues['oldReceiptNum']);
        $receipt->setRPTOPNum($varValues['rptopNum']);
        $receipt->setTDNum($varValues['tdNum']);

        # assign the receipt number to close the receipt
        $receipt->setReceiptNum($_POST['receiptNum']);
        #
        $receipt->storeRecord();
    }
   function showReceipt($preprinted){
        if($preprinted){
            $this->tpl->set_file(array('step3' => 'PayRPTOP3.htm',
                                 'receipt' =>'pprptreceipt.xml'));
        }
        else {
            $this->tpl->set_file(array('step3' => 'PayRPTOP3.htm',
                                 'receipt' =>'rptreceipt.xml'));
        }
        # get all the details from the page
        $this->setDetails();
        $this->tpl->set_var('ownerAddress',strip_tags($this->tpl->get("ownerAddress")));
        $this->tpl->parse('OUT','receipt');
        $this->tpl->finish('OUT');
        $rptrpdf = new PDFWriter;
        $rptrpdf->setOutputXML($this->tpl->get("OUT"),"string");
        $rptrpdf->writePDF("rptr.pdf");
        // echo to browser
        // $tpl->p('OUT');
    }
}
# using session, reinstantiate the object otherwise create a new object
if(!isset($_POST['printReceipt_x'])){
    page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
}
$RPTRForm = new RPTREncode();
$RPTRForm->main();
?>
<?php
if(!isset($_POST['printReceipt_x']))
page_close(); ?>
