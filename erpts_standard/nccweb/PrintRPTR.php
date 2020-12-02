<?php
# Setup PHPLIB in this Area
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
require_once('collection/Payment.php');
require_once('collection/dues.php');

include_once "../includes/collection/BacktaxTD.php";



include('web/clibPDFWriter.php');
require_once('collection/NumbersToWords.php');
?>
<?php
class RPTRPrint {
    var $errorMessages = array();
    /** these are the objects concerned
     **
     **/
    var $tpl;
    
    function RPTRPrint(){
		  $this->tpl = new Template(getcwd());
    }
    function main(){
       $this->showReceipt(false);
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
			$this->tpl->set_var("penalty", "");

			$assessedValue = $backtaxTD->getTotalAssessedValue();
			$subTotal = $backtaxTD->getTotalTaxDue();

			$this->tpl->set_var("assessedValue", number_format($assessedValue,2));
			$this->tpl->set_var("subTotal", number_format($subTotal,2));
			$this->tpl->set_var("fullPmt", number_format($subTotal,2));


			$this->tpl->set_var("grandTotal", number_format($subTotal,2));

			$this->tpl->parse("Properties", "Property", true);

			return $backtaxTD->getTotalTaxDue();

	}

    function setDetails(){
        global $sess;

        # set the RPTOP to get the owner's object and information
        # get it from POST if possible, otherwise from GET
       $rptopID = (isset($_POST['rptopID']))? $_POST['rptopID']:$_GET['rptopID'];
	   //$rptopID = 14;
       $rptop = new RPTOP;
       $rptop->selectRecord($rptopID);
	   $amountPaid = str_replace(",","",$_POST['amountPaid']);
	   
       $dateDue = $rptop->getTaxableYear(); # must be a usable format

        $formValues['datePaid'] = date("F j, Y");
		$pORDate = $_POST['prevORDate'];
		if($pORDate){
		list($pmonth,$pday,$pyear) = explode("-",$pORDate);
		$formValues['porMonth'] = date("F",mktime(0,0,0,$pmonth+1,0,0));
		$formValues['porYear'] = $pyear;
		$formValues['porDay'] = $pday;
		}else{
		$formValues['porMonth'] = "";
		$formValues['porYear'] = "";
		$formValues['porDay'] = "";
		}
		$formValues['orYear'] = substr($rptop->getTaxableYear(),2);
		$formValues['orMonth'] = date("F");
		$formValues['orDay'] = date("j");
		$formValues['taxableYear'] = $rptop->getTaxableYear();
        $formValues['rptopNum'] = $rptop->getRptopNumber();
		$formValues['prevORNum'] = $_POST['prevORNum'];
		$formValues['orNum'] = $_POST['receiptNo'];
		$formValues['kindOfPayment'] = $_POST['kindOfPayment'];
		$formValues['checkNumber'] = $_POST['checkNum'];
		$formValues['checkDate'] = $_POST['checkDate'];


		# set the specific TD (although this is in the RPTOP), hard to search for it.
        # get the tdID from POST or GET to initialize the TD
		$tdID = (isset($_POST['tdID']))? $_POST['tdID']:$_GET['tdID'];
		
		//$tdID = array(2,1);
		//$ownerID=5;
		$td = new TD();
		$ctr = 0;
		
		# $this->tpl->set_block('step3','PrintTDID','PrintTDIDs');
		//$this->tpl->set_block('step3','TDID','TDIDs');
		$this->tpl->set_block('receipt','Property','Properties');
		$this->tpl->set_block('Property','Owner','Owners');

		$n = 165;

		if(is_array($tdID))
		foreach($tdID as $key=>$id){
   			# set/pass tdIDs to form			
			$this->tpl->set_var(tdID,$id);
			//$this->tpl->parse('TDIDs','TDID','true');
			
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

	        $taxDue = new Dues($id,$dateDue);
		 	$paymentPeriod = $taxDue->getPaymentMode();



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

			$taxDue->resetPayments();
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

			$this->tpl->set_var("ypos", $n);
			$this->tpl->set_var("ypos1", $n-15);

			$n = $n-15;
			$this->tpl->set_var($taxValues);
			
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
			$this->tpl->set_var("ypos", $n);
			$this->tpl->set_var("ypos1", $n-15);

			$n = $n-15;

			$totalTaxDue += $this->displayBacktaxTD($ownerSwitch);
			$fullPmtTotal = $totalTaxDue;
			$total = $fullPmtTotal;

			$this->tpl->set_var("fullPmtTotal", number_format($fullPmtTotal,2));
		}

		# if amnesty checked/unchecked form will submit, set kind of payment and other details
		/*switch($formValues['kindOfPayment']){
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
		}*/
		# get totals in words
	

		$amountPaid = ($amountPaid) ? number_format($amountPaid,2) : number_format($total,2);
		$this->tpl->set_var("total", number_format($total,2));	
		$this->tpl->set_var("amountPaid", $amountPaid);
		$this->tpl->set_var("balance", $total - $amountPaid);

		$numToWords = new NumbersToWords();
		$totalInWords = $numToWords->num_to_string(number_format(str_replace(",","",$amountPaid),2));
		$this->tpl->set_var("totalInWords", $totalInWords);

		//$this->tpl->set_var("amnestyChecked", ($formValues['amnesty']=="Yes") ? " checked" : "");

		//if(!isset($_POST['printReceipt_x']))
         //  	$this->tpl->set_var("Session", $sess->url(""));
    } //setDetails()

   function showReceipt($preprinted){
	   //session_cache_limiter("nocache");
       if($preprinted){
            $this->tpl->set_file(array('step3' => 'PayRPTOP3.htm',
                                 'receipt' =>'or.xml'));
        }
        else {
            $this->tpl->set_file(array('receipt1' => 'PayRPTOP3.htm',
                                 'receipt' =>'or.xml'));
        }
		
        # get all the details from the page
        //if(isset($_POST['tdID']))
				
        $this->setDetails();
//        $this->tpl->set_var('ownerAddress',strip_tags($this->tpl->get("ownerAddress")));
      $this->tpl->parse('OUT','receipt');
        $this->tpl->finish('OUT');
		
      $rptrpdf = new PDFWriter;
      $rptrpdf->setOutputXML($this->tpl->get('OUT'),"string");
      $rptrpdf->writePDF("or.pdf");

		//$str = $this->tpl->get('OUT');
		//echo $str;
		
  // echo to browser
    // $this->tpl->p('OUT');
	  
		//header("location: ".$testpdf->pdfPath);
		
   }
  
   
}
# using session, reinstantiate the object otherwise create a new object

$RPTRReceipt = new RPTRPrint();
$RPTRReceipt->main();
?>