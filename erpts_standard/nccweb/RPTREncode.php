<?php
# Setup PHPLIB in this Area
# Modified by Bia 
# added setApplication in recordReceipt to save $payments[2] to DB - 07 Aug 2003
# changed main recordReceipt; no need to go through recordReceipt
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/RPTOP.php";
include_once "../includes/assessor/RPTOPRecords.php";
include_once "../includes/assessor/AFS.php";
require_once('collection/Receipt.php');
require_once('collection/Collections.php');
require_once('collection/Payment.php');
require_once('collection/dues.php');
require_once('collection/NumbersToWords.php');

include_once "../includes/collection/BacktaxTD.php";

//require_once('web/clibPDFWriter.php');
?>
<?php
class RPTREncode {
    var $errorMessages = array();
    /** these are the objects concerned
     **
     **/
    var $tpl;
	var	$municipalityCityID;    
	
    function RPTREncode(){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $auth->auth["uid"];
		$this->user = $auth->auth;

		// must have atleast TM-EDIT access
		$pageType = "%%%1%%%%%%";
		if (!checkPerms($this->user["userType"],$pageType)){
			header("Location: Unauthorized.php".$this->sess->url(""));
			exit;
		}

		$this->tpl = new Template(getcwd());

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

    }
    function main(){
		#ini_set("error_reporting",E_ALL);
		#ini_set("display_errors",1);

		#Print OR copy (duplicate)

		if(isset($_POST['printReceipt_x'])) {
            $step=0;
			$this->showReceipt(false);
			return;
        }
		#Step 5
        else if(isset($_POST['closeReceipt'])){
            $step=5;
        }
		#Step 4
        else if($_POST['issueReceipt'] == 1){
			//$step=4;
			$step=5;
        }
		#Step 3
        else {
             $step=3;
        }



		$this->startTemplate($step);

		$this->execute($step);

		$this->endTemplate($step);


    } //main()

	function startTemplate($step) {
		global $sess;

		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;

        $this->tpl->set_file("step".$step,"PayRPTOP".$step.".htm");
		$this->tpl->set_var("Session", $sess->url(""));

		$this->tpl->set_var("uname", $this->user["uname"]);
		$this->tpl->set_var("today", date("F j, Y"));

        $this->tpl->set_var($_GET);
        $this->tpl->set_var($_POST);
	}
	
	function endTemplate($step) {
        $this->tpl->parse(OUT,"step".$step);
        $this->tpl->finish('OUT');
        $this->tpl->p('OUT');
	}
	
	function execute($step) {
		switch ($step) {
			case 3:
				$this->setDetails();
				break;
			case 4:
			case 5:
				$this->recordReceipt($_POST);
				//$this->issueReceipt($_POST['collectionID'],$step);
				$this->closeReceipt($_POST);
				break;
			default:
				$this->showReceipt(false);
		}
	}

    function displayBacktaxTD($ownerSwitch=false){
			$backtaxTDID = $_POST['backtaxTDCheckbox'];
			$backtaxTD = new BacktaxTD;
			$backtaxTD->selectRecord("",$backtaxTDID);

			// get parent TD

			$tdID = $backtaxTD->getTDID();

			if($ownerSwitch!=true){
				$rptopID = (isset($_POST['rptopID']))? $_POST['rptopID']:$_GET['rptopID'];
				$rptop = new RPTOP;
				$rptop->selectRecord($rptopID);

				$owner = $rptop->getOwner();
				$personArray = $owner->getPersonArray();
			   	if(is_array($personArray)){
			   	   	foreach ($personArray as $person){
						$ownerValues['ownerKey']="personID";
						$ownerValues['ownerScript']="PersonDetails.php";
						$ownerValues['ownerID'] = $person->getPersonID();
						$ownerValues['ownerName'] = $person->getLastName().", ".
	        		   		                        $person->getFirstName(). " ".
	               	    		                    $person->getMiddleName();
		        	
				       $this->tpl->set_var($ownerValues);
	   				   $this->tpl->parse('Owners','Owner','true');
		    		}
				}
											  
				$companyArray = $owner->getCompanyArray();
				if(is_array($companyArray)){
	   				foreach ($companyArray as $company){
						$ownerValues['cownerKey']="companyID";
						$ownerValues['cownerScript']="CompanyDetails.php";
						$ownerValues['cownerID'] = $company->getCompanyID();
		        		$ownerValues['cownerName'] = $company->getCompanyName();
					
				        $this->tpl->set_var($ownerValues);
	   				    $this->tpl->parse('Owners','Owner','true');
	       			}
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
				$this->tpl->set_var('receivedFrom', $receivedFrom);
			}

			$this->tpl->set_var("lotAddress", "");
			$this->tpl->set_var("idleStatus", "");
			$this->tpl->set_var("tdNum", "");
			$this->tpl->set_var("assessedValueLand", "");
			$this->tpl->set_var("assessedValueOthers", "");

			$this->tpl->set_var("num", "");
			$this->tpl->set_var("partialPmt", "");
			$this->tpl->set_var("fullPmt", "");
			$this->tpl->set_var("penalty", "");

			$assessedValue = $backtaxTD->getTotalAssessedValue();
			$subTotal = $backtaxTD->getTotalBasicTax() + $backtaxTD->getTotalSEFTax() + $backtaxTD->getTotalIdleTax();
			$grandTotal = $backtaxTD->getTotalTaxDue();

			$this->tpl->set_var("assessedValue", number_format($assessedValue,2));
			$this->tpl->set_var("subTotal", number_format($subTotal,2));

			$this->tpl->set_var("grandTotal", number_format($grandTotal,2));

			$this->tpl->parse("Properties", "Property", true);

			return $backtaxTD->getTotalTaxDue();

	}

	#Step 3
    function setDetails(){
        global $sess;

//		print_r($_POST);

        # set the RPTOP to get the owner's object and information
        # get it from POST if possible, otherwise from GET
        $rptopID = (isset($_POST['rptopID']))? $_POST['rptopID']:$_GET['rptopID'];
		
        $rptop = new RPTOP;
        $rptop->selectRecord($rptopID);

		$amountPaid = str_replace(",","",$_POST['totalTaxDue']);

		if($amountPaid==""){
			$amountPaid = str_replace(",", "", $_POST['amountPaid']);
		}

        $dateDue = $rptop->getTaxableYear(); # must be a usable format


        $formValues['datePaid'] = date("F j, Y");
		$formValues['taxableYear'] = $rptop->getTaxableYear();
        $formValues['rptopNum'] = $rptop->getRptopNumber();
		$formValues['amnesty'] = $_POST['amnesty'];


		$formValues['kindOfPayment'] = $_POST['kindOfPayment'];
		$formValues['checkNum'] = $_POST['checkNum'];
		$formValues['checkDate'] = $_POST['checkDate'];

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
			
			$td->selectRecord($id);

	        $tdNum = $td->getTaxDeclarationNumber();
			$afs = new AFS();
			$formValues['tdNum'] = $tdNum;
			
			$afs->selectRecord($td->getAfsID());
			$od = new OD();
			$od->selectRecord($afs->getOdID());
			$addr = $od->getLocationAddress();
			
			
			# get municipality/province and city(same for all tds)
			//$lotAddress = new LocationAddress;
			//$lotAddress->selectRecordFromTdID($id);


			//$formValues['province'] = $lotAddress->getProvince();
			//$formValues['city'] = $lotAddress->getMunicipalityCity();
			$formValues['city'] = $addr->getMunicipalityCity();
			$formValues['province'] = $addr->getProvince();
			$formValues['municipalityCityID'] = $addr->getMunicipalityCityID();

			# get location/ block and lot number OR Barangay
			#$formValues['lotAddress'] = $lotAddress->getFullAddress();
			$formValues['lotAddress'] = $addr->getNumber . " " . $addr->getStreet();
			if ($formValues['lotAddress']=="") $formValues['lotAddress'] = $addr->getBarangay();

        	$propertyType = $td->getPropertyType();
	        $propertyID = $td->getPropertyID();

			$assessedValue = number_format($td->getAssessedValue(),2,".","");
	    	$formAssessedValue = number_format($td->getAssessedValue(),2);

			# separate assessed value of land and others(plantsTrees, improvementsBuildings, machineries)
			if($propertyType == "Land"){
				$formValues['assessedValueLand'] = $formAssessedValue;
				$formValues['assessedValueOthers'] = "";
			}
			else{
				$formValues['assessedValueLand'] = "";
				$formValues['assessedValueOthers'] = $formAssessedValue;
			}

			$formValues['assessedValue'] = $formAssessedValue;
			$formValues['propertyType'] = $propertyType;

			# set the owner's List
			# we define the owner from the RPTOP
			$ownerSwitch = true;
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
						$ownerValues['cownerKey']="companyID";
						$ownerValues['cownerScript']="CompanyDetails.php";
						$ownerValues['cownerID'] = $company->getCompanyID();
		        		$ownerValues['cownerName'] = $company->getCompanyName();
					
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
			} //end if ($ctr > 0)
		
       		# tax dues are defined from TDNumber and taxableYear
        	# compute for taxes; to create dues obj pass tdID and due date (where due date is beginning of taxable year) -- 14 Aug 2003
		   //     $taxDue = new Dues($id,$dateDue,$assessedValue);	
	        $taxDue = new Dues();

   /*		    if(!$taxDue->create($id,$dateDue)){
       		    $taxDue->setBasic($assessedValue);
           		$taxDue->setSEF($assessedValue);
				# check if land is idle, if yes, set assessed value
				if($taxDue->getIdleStatus() == 1){
					$taxDue->setIdle($assessedValue);
					$idleStatus = 1;
				}else{
					$taxDue->setIdle(0);
					$idleStatus = 0;
				}
        	}
*/

			$dateDue = $td->getTaxBeginsWithTheYear();
			
						$taxDue = new Dues($id,$dateDue);
							if(!$taxDue->create($id,$dateDue)){
									$taxDue->setBasic($assessedValue);
									$taxDue->setSEF($assessedValue);
									$taxDue->setIsDiscount(0);
									# check if land is idle, if yes, set assessed value
									# getIdleStatus -- temporary function
									if($taxDue->getIdleStatus() == 1){
										#echo("idle<br>");
										$taxDue->setIdle($assessedValue);
									}
							}else{
								 $taxDue->setIsDiscount(($dateDue == date("Y")) && (date("n")<=$taxDue->discountPeriod) && ($taxDue->getPaymentMode()=="Annual"));							
							}
							
			
			$paymentPeriod= $_POST['paymentPeriod'];
			# set amnesty to object

			//$amnesty = $_POST['amnesty'];
			//$taxDue->setAmnesty($amnesty=="Yes");
		//	$taxDue->store();

			$subTotal=  $taxDue->getTotalDue($paymentPeriod) - $taxDue->getPenalty($paymentPeriod);
			$totalTaxDue = $taxDue->getTotalDue($paymentPeriod);
			$totalAmount =  $taxDue->getTotalDue($paymentPeriod);

	    //    $paymentPeriod= "Annual";
/*    	    if(isset($_POST['paymentPeriod'])){
        	    $paymentPeriod = $_POST['paymentPeriod'];
				
        	}*/
			$formValues['paymentPeriod'] = $paymentPeriod;

	        $this->tpl->set_var($formValues);

    	    ## Compute taxes and set the page values
			//$totalTaxDue = $taxDue->getTotalDue($paymentPeriod);

    	    $interest = $taxDue->getPctPenalty();
			if ($interest > 0 && $paymentPeriod!="Annual") $paymentPeriod="Annual";

        	$basic = $taxDue->getBalanceBasic($paymentPeriod);
	        $sef = $taxDue->getBalanceSEF($paymentPeriod);
			$idle = $taxDue->getBalanceIdle($paymentPeriod);
			
			$discount = $taxDue->getDiscount($basic+$sef);
			$penalty = $taxDue->getBalancePenalty($paymentPeriod);

			$taxValues['idleStatus'] = ($idleStatus == 0) ? "" : "(I)";
			$taxValues['basic'] = number_format($basic,2);
	        $taxValues['sef']   = number_format($sef,2);
    	    $taxValues['pd1185']= number_format(0.00,2);
	        $taxValues['subTotal'] = number_format($subTotal,2);

    	    $taxValues['periodTotal'] = number_format($basic+$sef+$idle,2);
	        $taxValues['interest'] = number_format($interest * 100.00,1)."%";
        	$taxValues['penalty'] = number_format(($interest*100),0);	
        	$taxValues['discount'] = number_format($discount * 100.00,1)."%";

    	    $taxValues['totBasic'] = number_format($basic*(1+$interest),2);
        	$taxValues['totSEF']  = number_format($sef*(1+$interest),2);
	        $taxValues['totPD1185'] = number_format(0,2);
    	    $taxValues['totSubTotal'] = number_format(round($totalTaxDue,2),2);
        	$taxValues['grandTotal'] = number_format($totalTaxDue,2);

			# further breakdown of basic tax for RPT Receipt
	        $taxValues['gf'] = number_format($basic * 0.7,2); // 70% of basic
    	    $taxValues['ib'] = number_format($basic * 0.15,2); // 15% of basic
        	$taxValues['cb'] = number_format($basic * 0.15,2); // 15% of basic for a total if 100%
	        $taxValues['totGF'] = number_format($basic * 0.7 * (1+$interest),2);
    	    $taxValues['totIB'] = number_format($basic * 0.15 * (1+$interest),2);
	        $taxValues['totCB'] = number_format($basic * 0.15 * (1+$interest),2);
        
			if($paymentPeriod == "Annual"){
				$this->tpl->set_var("fullPmt", $taxValues['subTotal']);
				$this->tpl->set_var("partialPmt", "");
				# get full payment total
				$fullPmtTotal += str_replace(",","",$taxValues['subTotal']);
				$this->tpl->set_var("fullPmtTotal", number_format($fullPmtTotal,2));
			}
			else{
				$this->tpl->set_var("partialPmt", $taxValues['subTotal']);
				$this->tpl->set_var("num", ceil(date("n")/3));

				$this->tpl->set_var("fullPmt", "");
				# get partial payment total

				$partialPmtTotal += str_replace(",","",$taxValues['subTotal']);
				$this->tpl->set_var("partialPmtTotal", number_format($partialPmtTotal,2));
			}
			
    	    $this->tpl->set_var($taxValues);
			$this->tpl->parse('Properties','Property','true');
			$ctr++;
			
			# get totals for penalty and grand total
			# $penaltyTotal += ($basic*$interest); -- removed bec penalty in percent
			$total += $totalTaxDue;

			# $this->tpl->set_var("penaltyTotal", number_format($penaltyTotal,2));	
   	    }# end foreach

		if($total > $totalTaxDue){
			$totalTaxDue = $total;
		}

		// if backtaxTDCheckbox is checked
		if($_POST['backtaxTDCheckbox'] && $_POST['backtaxTDCheckbox']!=""){
			$totalTaxDue += $this->displayBacktaxTD($ownerSwitch);
			$fullPmtTotal = $totalTaxDue;
			$this->tpl->set_var("fullPmtTotal", number_format($fullPmtTotal,2));
		}

		$balance = number_format($totalTaxDue - $amountPaid,2);
		// we got some weird "-0.00" bug
		if($balance=="-0.00"){
			$balance = "0.00";
		}
		$this->tpl->set_var("balance", $balance);




		
		# if amnesty checked/unchecked form will submit, set kind of payment and other details
		switch($formValues['kindOfPayment']){
			case 'check':
				$this->tpl->set_var("selectedCheck","selected");
				$this->tpl->set_var("disabledOn","");
				$this->tpl->set_var("checkNum",$formValues['checkNum']);
				$this->tpl->set_var("checkDate",$formValues['checkDate']);
				break;
			case 'treasury note':
				$this->tpl->set_var("selectedTNote","selected");
				$this->tpl->set_var("disabledOn","disabled");
				$this->tpl->set_var("checkNum","");
				$this->tpl->set_var("checkDate","");
				break;
			case 'cash':
			default:
				$this->tpl->set_var("selectedCash","selected");
				$this->tpl->set_var("disabledOn","disabled");
				$this->tpl->set_var("checkNum","");
				$this->tpl->set_var("checkDate","");								
				break;
		}
		# get totals in words
		$amountPaid = ($amountPaid) ? $amountPaid : $total;
		$this->tpl->set_var("total", $amountPaid);	
		$this->tpl->set_var("amountPaid", number_format($amountPaid,2));

		
		$numToWords = new NumbersToWords();
		$totalInWords = $numToWords->num_to_string(number_format($amountPaid,2));
		$this->tpl->set_var("totalInWords", $totalInWords);
		$this->tpl->set_var("amnestyChecked", ($formValues['amnesty']=="Yes") ? " checked" : "");

		if(!isset($_POST['printReceipt_x']))
           	$this->tpl->set_var("Session", $sess->url(""));
    } //setDetails()
	
    function issueReceipt($collectionID,$step=4){
		#Step 4
		$this->tpl->set_var('paymentPeriod', $_POST['paymentPeriod']);
		$this->tpl->set_var('rptopID', $_POST['rptopID']);
		$this->tpl->set_var('rptopNum', $_POST['rptopNum']);
		$this->tpl->set_var('prevORNum', $_POST['prevORNum']);
		$this->tpl->set_var('prevORDate', $_POST['prevORDate']);
		$this->tpl->set_var('collectionID', $_POST['collectionID']);
		$this->tpl->set_block('step'.$step,'TDID','TDIDs');
		$tdID = $_POST['tdID'];
		if(is_array($tdID))
			foreach($tdID as $key=>$id){
				# set/pass tdIDs to form			
				$this->tpl->set_var(tdID,$id);
				$this->tpl->parse('TDIDs','TDID','true');
			}
        #$this->closeReceipt();
    } //issueReceipt()
	
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
    } //validateInfo()

	#Step 4
    function recordReceipt($varValues){
   	    # create receipt object
        $collections = new Collections();
        # set the details of the receipt
        $collections->setOldReceiptNum($varValues['prevORNum']);
        $collections->setRPTOPNum($varValues['rptopNum']);
        $tdID = $varValues['tdID'];
		
		$amountPaid = $varValues['amountPaid'];	
		$isAmnesty = (isset($varValues['amnesty'])) ? "Yes" : "No";

		$proceed=true;		

			// insert backtaxTD record as a payment
			// and FLAG backtaxTD as PAID!!! ;)

			if($_POST["backtaxTDCheckbox"]){

				$backtaxTDID = $_POST['backtaxTDCheckbox'];
				$backtaxTD = new BacktaxTD;
				$backtaxTD->selectRecord("",$backtaxTDID);

				$assessedValue = $backtaxTD->getTotalAssessedValue();

				$paymentPeriod = $_POST['paymentPeriod'];

				$application = $paymentPeriod;

				$penalty = $backtaxTD->getTotalPenalties();
				$totalTaxDue = $backtaxTD->getTotalTaxDue();
				$totalTaxes = $backtaxTD->getTotalTaxes();

				$amountPaid = str_replace(",","",$amountPaid);

				if($totalTaxDue > $amountPaid){
					// payment is partial

					$totalPaid = $backtaxTD->getTotalPaid() + $amountPaid;

					$backtaxTD->setTotalPaid($totalPaid);
					$backtaxTD->updateRecord();

					// FLAG paidStatus as "" (NOT YET FULLY PAID) for backtaxTDRecord
					$backtaxTD->updatePaidStatus("");

					$amountPaid = 0;
				}
				else if($totalTaxDue <= $amountPaid){
					// payment is full or exceeding full to payoff successive TD's

					// FLAG paidStatus as PAID for backtaxTDRecord

					$backtaxTD->updatePaidStatus("PAID");

					$backtaxTD->setTotalPaid($totalTaxes);
					$backtaxTD->updateRecord();

					$amountPaid = $amountPaid - $totalTaxDue;
				}



				//Partial payment handler??

				$basic = $backtaxTD->getTotalBasicTax();
				$sef = $backtaxTD->getTotalSEFTax();
				$idle = $backtaxTD->getTotalIdleTax();
				$discount = 0;

				# record the payments for each receipt 
				# recomputed instead of getting values from $_POST
				# used createRecord 

				$payments[0] = new Payment("sef");
				$payments[0]->setApplication($application);
				$payments[0]->createRecord("000");
				$payments[0]->setAmount($sef);			
				$payments[0]->setDiscount("0");
				$payments[0]->setPenalty("0");
				$payments[0]->setDueID("000");
				$payments[0]->setDueType("backtaxTDID-sef,backtaxTDID=".$backtaxTD->getBacktaxTDID());
				$payments[0]->setReceiptNum($varValues['receiptNo']);
				$payments[0]->storeRecord();

				$collections->addPayment($payments[0]);
				
				$payments[1] = new Payment("basic");
				$payments[1]->setApplication($application);
				$payments[1]->createRecord("000");
				$payments[1]->setAmount($basic); 			
				$payments[1]->setDiscount("0");
				$payments[1]->setPenalty("0");
				$payments[1]->setDueID("000");
				$payments[1]->setDueType("backtaxTD-basic,backtaxTDID=".$backtaxTD->getBacktaxTDID());
				$payments[1]->setReceiptNum($varValues['receiptNo']);
				$payments[1]->storeRecord();
				$collections->addPayment($payments[1]);
				
				$payments[2] = new Payment("idle");
				$payments[2]->setApplication($application);
				$payments[2]->createRecord("000");
				$payments[2]->setAmount($idle);
				$payments[2]->setDiscount("0");
				$payments[2]->setPenalty("0");
				$payments[2]->setDueID("000");
				$payments[2]->setDueType("backtaxTD-idle,backtaxTDID=".$backtaxTD->getBacktaxTDID());
				$payments[2]->setReceiptNum($varValues['receiptNo']);
				$payments[2]->storeRecord();
				$collections->addPayment($payments[2]);
				
				$payments[3] = new Payment("penalty");
				$payments[3]->setApplication($application);
				$payments[3]->createRecord("0");
				$payments[3]->setAmount($penalty);
				$payments[3]->setDiscount("0");
				$payments[3]->setPenalty("0");
				$payments[3]->setDueID("000");
				$payments[3]->setDueType("backtaxTD-penalty,backtaxTDID=".$backtaxTD->getBacktaxTDID());
				$payments[3]->setReceiptNum($varValues['receiptNo']);
				$payments[3]->storeRecord();
				$collections->addPayment($payments[3]);
				
				$payments[4] = new Payment("pd1185");
				$payments[4]->setApplication($application);
				$payments[4]->createRecord("000");
				$payments[4]->setAmount("0");
				$payments[4]->setDiscount("0");
				$payments[4]->setPenalty("0");
				$payments[4]->setDueID("000");
				$payments[4]->setDueType("backtaxTD-pd1185,backtaxTDID=".$backtaxTD->getBacktaxTDID());
				$payments[4]->setReceiptNum($varValues['receiptNo']);
				$payments[4]->storeRecord();
				$collections->addPayment($payments[4]);

				//$taxDue->reapplyPayments();
				//$taxDue->store();

				//print_r($payments);

				if (!$proceed) break;
			}

		if(is_array($tdID))

			foreach($tdID as $key=>$id){
				$td = new TD();
				$td->selectRecord($id);

				# get assessed value and use it to compute taxes -- 07 Aug 2003
				$propertyType = $td->getPropertyType();
				$propertyID = $td->getPropertyID();
				
				$assessedValue = number_format($td->getAssessedValue(),2,".","");
				$tdNum = $td->getTaxDeclarationNumber();

				$collections->setTDNum($tdNum);
				# get the specific due by using the tdNum and the date on the RPTOP
				$rptop = new RPTOP();
				# changed to taxableYear & selected record using rptopID instead of rptopNum

				if($rptop->selectRecord($varValues['rptopID'])){
					$dueDate = $rptop->getTaxableYear();
				}
				else {
					# did not find due date in POST
					// if there is no valid RPTOP provided, then just use the dueDate
					$dueDate = $varValues['dueDate'];
				}

				$dueDate = $td->getTaxBeginsWithTheYear();


				$taxDue = new Dues($id,$dueDate);
				/*$taxDue = new Dues();*/
				if(!$taxDue->create($id,$dueDate)){
       		    $taxDue->setBasic($assessedValue);
           		$taxDue->setSEF($assessedValue);
				# check if land is idle, if yes, set assessed value
				if($taxDue->getIdleStatus() == 1){
					$taxDue->setIdle($assessedValue);
					$idleStatus = 1;
				}else{
					$taxDue->setIdle(0);
					$idleStatus = 0;
				}
        		}
				$paymentPeriod = $taxDue->getPaymentMode();

				if ($taxDue->getPctPenalty()>0 && $paymentPeriod!="Annual") 	$paymentPeriod="Annual";
				$application = $paymentPeriod;

				if($application=="Quarter"){
					$application = "Q".ceil(date("n")/3);
					$taxDue->setPaidQuarters(ceil(date("n")/3));
				}

				#echo("b=$basic<br>s=$sef<br>i=$idle");

				# if amnesty declared, no interest on late payments, set penalty to 0

				if(isset($varValues['amnesty']) || $taxDue->getIsDiscount()){
					$taxDue->setAmnesty("Yes");
					$taxDue->resetPenalty();
					$interest=0;
				} else {
					$taxDue->setAmnesty("No");
					$interest = $taxDue->getPctPenalty();
				}				

				$penalty = $taxDue->getBalancePenalty($paymentPeriod);
				$totalTaxDue = $taxDue->getTotalDue($paymentPeriod);

				//Partial payment handler

					$basic = $taxDue->getBalanceBasic($paymentPeriod);
					$sef = $taxDue->getBalanceSEF($paymentPeriod);
					$idle = $taxDue->getBalanceIdle($paymentPeriod);
					$discount = $taxDue->getDiscount();

					$discountSEF = ($taxDue->getIsDiscount()) ? ($sef * $taxDue->getDiscountPercentage()/100) : 0;
					$discountBasic = ($taxDue->getIsDiscount()) ? ($basic * $taxDue->getDiscountPercentage()/100) : 0;
			
					if (str_replace(",","",$amountPaid) < $totalTaxDue) {
						$basic = round(str_replace(",","",$amountPaid) * (($basic-$discountBasic)/$totalTaxDue),2);
						$sef = round(str_replace(",","",$amountPaid) * (($sef-$discountSEF)/$totalTaxDue),2);
						$idle = round(str_replace(",","",$amountPaid) * ($idle/$totalTaxDue),2);
						$penalty = round(str_replace(",","",$amountPaid) * ($penalty/$totalTaxDue),2);
						$proceed = false;
					}				
					
							

				# record the payments for each receipt 
				# recomputed instead of getting values from $_POST
				# used createRecord 

				$payments[0] = new Payment("sef");
				$payments[0]->setApplication($application);
				$payments[0]->createRecord($taxDue->getDueID());
				$payments[0]->setAmount($sef);			
				$payments[0]->setDiscount($discountSEF);
				$payments[0]->setPenalty($sef * $interest);
				$payments[0]->setDueID($taxDue->getDueID());
				$payments[0]->setDueType("sef");
				$payments[0]->setReceiptNum($varValues['receiptNo']);
				$payments[0]->storeRecord();
				$collections->addPayment($payments[0]);
				
				# $gfTotal = ($basic*0.7)*(1+interest);
				# $ibTotal = ($basic*0.15)*(1+interest);
				# $cbTotal = ($basic*0.15)*(1+interest);
				$payments[1] = new Payment("basic");
				$payments[1]->setApplication($application);
				$payments[1]->createRecord($taxDue->getDueID());
				$payments[1]->setAmount($basic); 			

				$payments[1]->setDiscount($discountBasic);
				$payments[1]->setPenalty($basic * $interest);
				$payments[1]->setDueID($taxDue->getDueID());
				$payments[1]->setDueType("basic");
				$payments[1]->setReceiptNum($varValues['receiptNo']);
				$payments[1]->storeRecord();
				$collections->addPayment($payments[1]);
				
				$payments[2] = new Payment("idle");
				$payments[2]->setApplication($application);
				$payments[2]->createRecord($taxDue->getDueID());
				$payments[2]->setAmount($idle);
				$payments[2]->setDiscount(0);
				$payments[2]->setPenalty($idle * $interest);
				$payments[2]->setDueID($taxDue->getDueID());
				$payments[2]->setDueType("idle");
				$payments[2]->setReceiptNum($varValues['receiptNo']);
				$payments[2]->storeRecord();
				$collections->addPayment($payments[2]);
				
				$payments[3] = new Payment("penalty");
				$payments[3]->setApplication($application);
				$payments[3]->createRecord($taxDue->getDueID());
				$payments[3]->setAmount($penalty);
				$payments[3]->setDiscount(0);
				$payments[3]->setPenalty(0);
				$payments[3]->setDueID($taxDue->getDueID());
				$payments[3]->setDueType("penalty");
				$payments[3]->setReceiptNum($varValues['receiptNo']);
				$payments[3]->storeRecord();
				$collections->addPayment($payments[3]);
				
				$payments[4] = new Payment("pd1185");
				$payments[4]->setApplication($application);
				$payments[4]->createRecord($taxDue->getDueID());
				$payments[4]->setAmount(round(0,2));
				$payments[4]->setDiscount(0);
				$payments[4]->setPenalty(0);
				$payments[4]->setDueID($taxDue->getDueID());
				$payments[4]->setDueType("pd1185");
				$payments[4]->setReceiptNum($varValues['receiptNo']);
#				print_r($payments);
				$payments[4]->storeRecord();
				$collections->addPayment($payments[4]);

				$taxDue->reapplyPayments();
				$taxDue->store();

				if (!$proceed) break;
				
			}# end foreach

			//*

			
			// get parent TD

			//$tdID = $backtaxTD->getTDID();

			//*/

			
				# set collection details and save to db; no receipt number yet
				# format date to db date YYYY-MM-DD
				list($month, $day, $year) = explode("-",$varValues['checkDate']);
				list($oldReceiptMonth ,$oldReceiptDay , $oldReceiptYear) = explode("-",$varValues['prevORDate']);
				$collections->setCollectionDate(date("Y-m-d"));
				$collections->setCollectionSum($varValues['collectionSum']);
				$collections->setReceivedFrom($varValues['receivedFrom']);
				$collections->setKindOfPayment($varValues['kindOfPayment']);
				$collections->setCheckNum($varValues['checkNum']);
				$collections->setCheckDate($year."-".$month."-".$day);
				$collections->setOldReceiptNum($varValues['prevORNum']);
				$collections->setOldReceiptDate($oldReceiptYear."-".$oldReceiptMonth."-".$oldReceiptDay);		
				$collections->setMunicipality($varValues['municipalityCityID']);
				$collections->setAmnesty($isAmnesty);
				$collections->createRecord();
				$collections->storeRecord();
				# get collection id and use it to close receipt
				$collectionID = $collections->getCollectionID();
				$_POST['collectionID'] = $collectionID;

    } //recordReceipt
	
	function closeReceipt($varValues){
		#Step 5
		$this->tpl->set_var('paymentPeriod', $varValues['paymentPeriod']);
		$this->tpl->set_var('rptopID', $varValues['rptopID']);
		$this->tpl->set_var('rptopNum', $varValues['rptopNum']);
		$this->tpl->set_var('prevORNum', $varValues['prevORNum']);
		$this->tpl->set_var('prevORDate', $varValues['prevORDate']);
		$this->tpl->set_block('step5','TDID','TDIDs');
		$tdID = $varValues['tdID'];
		if(is_array($tdID)){
			foreach($tdID as $key=>$id){
				# set/pass tdIDs to form			
				$this->tpl->set_var(tdID,$id);
				$this->tpl->parse('TDIDs','TDID','true');
			}}
		# get collectionID and use it to update payments made in dues table, update receiptNum in collections and payments table
		$collections = new Collections();
		$collections->setCollectionID($varValues['collectionID']);
		$collections->setReceiptNum($varValues['receiptNo']);
		$collections->updateReceiptNum();
    } //closeReceipt()

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
    } //showReceipt()
} //end class

# using session, reinstantiate the object otherwise create a new object
if(!isset($_POST['printReceipt_x'])){
    page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
}

$RPTRForm = new RPTREncode();
$RPTRForm->main();

if(!isset($_POST['printReceipt_x']))
page_close(); 
?>
