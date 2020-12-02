<?php
	 # changed tdNum and its setter/getter to tdID; added var $idle + setter/getter -- 14 Aug 2003
	 # removed strDueDate in update and used due date; removed strtotime validation in create -- 15 Aug 2003
	 # added updatePaidTaxes function which will be used to update dues(paid sef/basic/penalty/etc) -- 18 Aug 2003
	 # added select and modified updatePaidTaxes; added getBalance---, credit--- for idle and pd1185; modified getTotalDue -- 19 Aug 2003
     require_once("collection/StorableObject.php");
     require_once("collection/masterTables.php");
	 require_once("collection/Payment.php");
     class Dues{
         /** The $dueID attribute. This attribute is the identifier of the object
          ** in the database.
          ** @type identifier
          **/
         var $dueID;
         /** The $basic attribute. This attribute is the basic tax due from the
          ** specific TD.
          ** @type currency
          **/
         var $basic;
         /** The $penalty attribute. This attribute is the penalties due from
          ** non-payment of tax dues on or before the due date. It is computed at
          ** initialization of the due and should be updated for any modification
          ** @type currency
          **/
         var $penalty;
         /** The $pctPenalty attribute. This attribute is the computed percentage
          ** value of all tax dues that will be applied for all dues to compute
          ** the penalties.
          ** @type currency
          **/
         var $pctPenalty;
         /** The $sef attribute. This attribute is the Special Education Fund to
          ** collected as an additional surcharge for every real property tax payment.
          ** @type curreny
          **/
         var $sef;
         /** The $idle attribute. This attribute is collected as an additional
          ** surcharge for idle lands. Provided for the province of Iloilo
          ** @type currency
          **/
		 var $idle = 0.00;
		 /** The $tdNum attribute. This attribute is the number of the specific
          ** tax declaration (TD) that tax is due.
          ** @type identifier
          **/
		 var $tdID;
         /** The $dueDate attribute. This attribute is the specified date where
          ** the basic tax must be collected or penalties will be applied.
          ** This is stored as a Unix Timestamp.
          ** Note: The valid range of a timestamp is typically from
          ** Fri, 13 Dec 1901 20:45:54 GMT to Tue, 19 Jan 2038 03:14:07 GMT.
          ** (These are the dates that correspond to the minimum and maximum values
          ** for a 32-bit signed integer.)
          ** @type date
          **/
         var $dueDate;
         /** The $updateDate attribute. This attribute is the last date of reckoning
          ** or update when the values of the dues are computed and valid.
          ** This is stored as a Unix Timestamp.
          ** Note: The valid range of a timestamp is typically from
          ** Fri, 13 Dec 1901 20:45:54 GMT to Tue, 19 Jan 2038 03:14:07 GMT.
          ** (These are the dates that correspond to the minimum and maximum values
          ** for a 32-bit signed integer.)
          ** @type date
          **/
         var $updateDate;
         /** The $paidBasic attribute. This attribute holds the payments
          ** for basic dues.
          ** @type currency
          **/
         var $paidBasic = 0.00;
         /** The $paidSEF attribute. This attribute holds the payments
          ** for SEF dues.
          ** @type currency
          **/
         var $paidSEF = 0.00;
         /** The $paidPenalty. This attribute holds the payments
          ** for Penalties incurred.
          ** @type currency
          **/
         var $paidPenalty = 0.00;
		 var $paidQuarters= 0.00;
		 /** The $paidIdle. This attribute holds the payments
          ** for idle land dues.
          ** @type currency
          **/
		 var $paidIdle = 0.00;
		

         var $MONTH_OFFSET = 0;
		 var $amnesty;
		 var $idleStatus;

		 var $isDiscount = false;
		 var $discount = 0;
		 var $discountPercentage; #10% of total amount due
		 var $discountPeriod; # First 2 month of year
		 
		 var $idleStatus=false;
		 
		 # for testing only
		 function getIdleStatus(){
			return $this->idleStatus;
		 }
		 
		 function setIdleStatus($value) {
		 	$this->idleStatus=$value;
		 }
         
         /** The Dues method. This method is the constructor
          ** @public
          ** @returns void
		  ** Modified by: Mia
		  ** Date Modified: 2003 Sept 6
		  ** Comment: Provide way tp initialize class withput creating a new record in the dues table.
          **/
		 function Dues($tdID=0, $dueYear=0,$assessedValue=0.0 ){
		 	global $discountPercentage, $discountPeriod;

		 	//Initialize class without inserting row
		 	if ($tdID==0 && $dueYear==0) return;
			
			$this->discountPercentage = $discountPercentage;
			$this->discountPeriod = $discountPeriod;

		
		 	 // create the object from the database 
			 // if not then initialize and store a new object
		 	 if(!$this->create($tdID,$dueYear)){ // already in database
			 	// create a new entry in database;
		 	 	
             	// set value for attributes for storage to avoid errors in
             	//   blank assignments.
             	// dueID is set using the create function
             	$this->setTDID($tdID);
             	$this->setDueDate($dueYear);
             	$this->setBasic($assessedValue);
             	$this->setsef($assessedValue);
             	$this->setPenalty(0);
             	$this->setPaidBasic(0);
             	$this->setPaidSEF(0);
             	$this->setPaidPenalty(0);
             	$this->setPaidQuarters(0);
             	$this->setPaymentMode("Annual");
			 	$this->setAmnesty("No");
				if($this->getIdleStatus() == 1){
					$this->setIdle($assessedValue);
				}
			 	$this->store();
			 }
			 $this->computePenalty($this->getPaymentMode());
         }
         
         function make_node($parent,$name,$content) {
          # adds a new child node to parent node
          $parent->new_child($name,$content);

          # return the newly added child as a reference
          return $parent->lastchild();
         }
         function setDocNode(){
             $dueDOM = domxml_new_doc("1.0");
             $root = $dueDOM->create_element("dues");
             $root = $dueDOM->append_child($root);
             $node = $dueDOM->create_element("due");
             $dueNode = $root->append_child($node);
             foreach((array) $this as $attributeName => $value){
              $varType = gettype($value);
              if ($attributeName != "")
              switch($varType){
                  case 'array':
                       $node = $dueDOM->create_element($attributeName);
                       $node->set_attribute('attrType',$varType);
                       foreach($value as $key => $arrValue){
                           $arrVarType = gettype($arrValue);
                           $arrNode = $dueDOM->create_element("LUT");
                           $arrNode->set_attribute('attrType',$arrVarType);
                           $arrNode->set_attribute('attrKey',$key);
                           $arrNode->set_content($arrValue);
                           $node->append_child($arrNode);
                       }
                       $dueNode->append_child($node);
                       break;
                  default:
                       $node = $dueDOM->create_element($attributeName);
                       $node->set_content($value);
                       $node->set_attribute('attrType',$varType);
                       $dueNode->append_child($node);
                       break;
              }
             }
             return $dueDOM->dump_mem(true);
         }
         # assumes an XML document with a due root node
         function parseDOMDocument($xmlString){
             $dueDOM = domxml_open_mem($xmlString);
             $root = $dueDOM->document_element();
             $children = $root->child_nodes();
             # shift through the attributes
             foreach($children as $node){
                 $attrType = $node->get_attribute('attrType');
                 switch($attrType){
                     case '':
                          break;
                     case 'array':
                          $attrName = $node->node_name();
                          $entries = $node->child_nodes();
                          foreach($entries as $entry){
                              $key = $entry->get_attribute('key');
                              $entryType = $entry->get_attribute('attrType');
                              $entryValue = $entry->get_content();
                              settype($entryValue,$entryType);
                              $entryArray[$key]=$entryValue;
                          }
                          $varname = "\$this->".$attrName;
                          $$varname=$entryArray;
                          break;
                     default:
                          $attrName = $node->node_name();
                          $attrValue = $node->get_content();
                          settype($attValue,$attrType);

                          $varname = '$this->'.$attrName;
                          $$varname=$attrValue;
                          break;
                 }
             }
         }

         function setAmnesty($value){
              $this->amnesty = $value;
         }
         function getAmnesty(){
              return $this->amnesty;
         }

         function setPaymentMode($value){
              $this->paymentMode = $value;
         }
         function getPaymentMode(){
              return $this->paymentMode;
         }

         function setDueID($identifier){
              $this->dueID = $identifier;
         }
         function getDueID(){
              return $this->dueID;
         }
         function setIsDiscount($identifier){
              $this->isDiscount = $identifier;
         }
         function getIsDiscount(){
              return $this->isDiscount;
         }
         function setDiscount($value){
		 	$this->discount = $value * ($this->discountPercentage/100);
         }
         function getDiscount(){
              return $this->discount;
         }

         function setDiscountPercentage($value){
		 	$this->discountPercentage = $value;
         }
         function getDiscountPercentage(){
              return $this->discountPercentage;
         }

         /** The SetBasic method. This method sets the Basic Dues for the TaxDec
          ** The Basic due is a fixed value once set along with the due date.
          ** Further accounting will be reflected in the $basicBalance attribute.
          ** Should also set the $basicBalance once.
          ** @public
          ** @returns void
          **/
         function setBasic($currencyValue){
             global $pctRPTax;
             if($currencyValue > 0.00 && $this->basic == 0.0){
                 # compute for basic using the $currencyValue * tax rate;
                 $this->basic = $currencyValue * $pctRPTax;
             }
         }
         /** The getBasic method. This method returns basic tax due.
          ** if you want the current basic tax due, then use the getBasicBalance
          ** method.
          ** @public
          ** @returns double
          **/
         function getBasic($period = "Annual"){
             if($this->getPenalty() > 0.0) $period = "Annual";
             switch($period){
                 case 'Quarter':
				 	$value=$this->basic/4;
					break;
                 case 'Annual':
                 default:
                      $value = $this->basic;
             }
			 return round($value,2);
         }
		 /** The setSEF method. This method sets the SEF due for this TD collection.
          ** SEF is computed based on basic due.
          ** @public
          ** @returns void
          **/
         function setSEF($currencyValue){
             global $pctSEF;
             if($currencyValue > 0.00 && $this->sef == 0.0){
                 # compute for basic using the $currencyValue * tax rate;
                 $this->sef = $currencyValue * $pctSEF;
             }
         }
         /** The getSEF method. This method returns total SEF for this tax Due.
          ** If you want the remaining SEF due after payments use getBalanceSEF.
          ** @public
          ** @returns double
          **/
         function getSEF($period = "Annual"){
             if($this->getPenalty() > 0.0) $period = "Annual";
             switch($period){
                 case 'Quarter':
                      $value = $this->sef/4;
                      break;
                 case 'Annual':
                 default:
                      $value = $this->sef;
                      break;
             }
			 return round($value,2);
         }
		 function setIdle($currencyValue){
		 	global $pctIdle;
			# if var $idle is not reset, idle will always have value --> problem with Pay Taxes Step 3
			$this->idle = 0.0;
             if($currencyValue > 0.00 && $this->idle == 0.0){
                               # compute for basic using the $currencyValue * tax rate;
                 $this->idle = $currencyValue * $pctIdle;
             }
		 }

		 function getIdle($period = "Annual"){
             if($this->getPenalty() > 0.0) $period = "Annual";
             switch($period){
                 case 'Quarter':
                      $value = $this->idle/4;
                      break;
                 case 'Annual':
                 default:
                      $value = $this->idle;
                      break;
             }
			 return round($value,2);
		 }	
         /** The setTdID method. This method assigns the specific TDId for which
          ** tax is due. It should be set first before any other value can be
          ** computed.
          ** @public
          ** @returns void
          **/
         function setTdID($identifier){
             $this->tdID = $identifier;
         }
         /** The getTdID method. This method returns the TdID for this tax due.
          ** @public
          ** @returns identifier
          **/
         function getTdID(){
             return $this->tdID;
         }
         /** The setDueDate method. This method sets the due date for this tax.
          ** It is set only once and will not be changed again.
          ** @public
          ** @returns void
          **/
         function setDueDate($dueYear = 1900){
             if(isset($this->dueDate)){
                 return true;
             }
             else {
			 	$this->dueDate = mktime(0,0,0,1,1,$dueYear);
			 }
         }
         /** The getDueDate method. This method returns the due date for the basic
          ** taxes.
          ** @public
          ** @returns date
          **/
         function getDueDate(){
             return $this->dueDate;
			 # return date("Y-m-d",$this->dueDate);
         }
         /** The setupdateDate method. This method sets the date of validity of the
          ** balance values (balanceBasic, balanceSEF, balancePenalties).
          ** Maybe it should also update the three balances everytime.
          ** @public
          ** @returns void
          **/
         function setUpdateDate(){
             $this->updateDate=time();
         }
         /** The getUpDate method. This method returns the current date of last computation.
          ** @public
          ** @returns date
          **/
         function getUpdateDate(){
             return $this->updateDate;
         }
         /** The setPaidBasic method. This method sets the paidBasic.
          ** this is only here for compliance, you should use creditBasic to
          ** update the $paidBasic attribute
          ** @public
          ** @returns void
          **/
         function setPaidBasic($currencyValue){
         	$this->paidBasic = $currencyValue;
         }
         /** The creditBasic method. This method credits the corresponding currency
		  ** value to the balance of the paidBasic value.
          ** update the $paidBasic attribute
          ** @public
          ** @returns void
          **/
         function creditBasic($currencyValue){
         	$this->paidBasic += $currencyValue;
         }
         /** The getPaidBasic method. Returns the amount paid for basic dues.
          ** @public
          ** @returns currency
          **/
         function getPaidBasic(){
             return $this->paidBasic;
         }
         /** The setPaidSEF method. This method sets the paidSEF attribute.
          ** this is only here for compliance, you should use creditSEF to
          ** update the $paidSEF attribute
          ** @public
          ** @returns void
          **/
         function setPaidSEF($currencyValue){
         	$this->paidSEF = $currencyValue;
         }
         /** The creditSEF method. This method credits the corresponding currency
		  ** value to the balance of the paidSEF value.
          ** update the $paidSEF attribute
          ** @public
          ** @returns void
          **/
         function creditSEF($currencyValue){
         	$this->paidSEF += $currencyValue;
         }
         /** The getPaidSEF method. This method returns the amount paid for SEF
          ** so far.
          ** @public
          ** @returns currency
          **/
         function getPaidSEF(){
             return $this->paidSEF;
         }
         /** The setpaidPenalty method. This method sets the paid of penalties.
          ** this is only here for compliance, you should use creditPenalty to
          ** update the $paidPenalty attribute
          ** @public
          ** @returns void
          **/
         function setPaidPenalty($currencyValue){
         	$this->paidPenalty = $currencyValue;
         }
         function setPaidQuarters($currencyValue){
         	$this->paidQuarters = $currencyValue;
         }
         /** The creditPenalty method. This method credits the corresponding currency
		  ** value to the balance of the paidPenalty value.
          ** update the $paidPenalty attribute
          ** @public
          ** @returns void
          **/
         function creditPenalty($currencyValue){
         	$this->paidPenalty += $currencyValue;
         }
         /** The getPaidPenalty method. This method will return the amount paid
          ** so far for penalties.
          ** @public
          ** @returns currency
          **/
         function getPaidPenalty(){
             return $this->paidPenalty;
         }
         /** The setPaidIdle method. This method sets the paid of penalties.
          ** this is only here for compliance, you should use creditIdle to
          ** update the $paidIdle attribute
          ** @public
          ** @returns void
          **/
		 function setPaidIdle($currencyValue){
		 	$this->paidIdle = $currencyValue;
		 }
		 /** The creditIdle method. This method credits the corresponding currency
		  ** value to the balance of the paidIdle value.
          ** update the $paidIdle attribute
          ** @public
          ** @returns void
          **/
         function creditIdle($currencyValue){
         	$this->paidIdle += $currencyValue;
         }
         /** The getPaidIdle method. This method will return the amount paid
          ** so far for penalties.
          ** @public
          ** @returns currency
          **/
		 function getPaidIdle(){
		 	return $this->paidIdle;
		 }
		 /** The getTotalDue method. This method returns the sum of the balances
          ** balanceBasic + balancePenalty + balanceSEF.
          ** @public
          ** @returns double
          **/
         function getTotalDue($period = 'Annual'){

             $this->computePenalty($period);

			 if ($this->getPenalty()>0 && $period!="Annual") {
			 	$period="Annual";
				$this->computePenalty($period);

			 }



             $totalDue = $this->getBalanceBasic($period) + $this->getBalanceSEF($period) +
			 		$this->getBalanceIdle($period);

			#echo("balanceBasic=".$this->getBalanceBasic($period)."<br>");
			#echo("balanceSEF=".$this->getBalanceSEF($period)."<br>");
			#echo("1==>$totalDue<br>");
					
			if ($this->getAmnesty()=="Yes") {
				$this->setPctPenalty(0.0);
			} else {
				$totalDue += $this->getBalancePenalty($period);
			}
			

			 if ($this->getIsDiscount()) {
				$this->setDiscount($totalDue);
				$totalDue -= $this->getDiscount();
			 }

			#echo("2==>$totalDue<br>");
             return round($totalDue,2);
         }
         /** The getBalanceBasic method. This method returns the remaining basic tax due.
          ** @public
          ** @returns double
          **/
         function getBalanceBasic($period){

           	$startDate = getdate($this->dueDate);
           	$today = getdate();

           	if(($period == 'Quarter') and ($startDate['year'] >= $today['year'])){
                $currentQuarter = ceil($today['mon']/3);
			} else {
				$period = "Annual";
			}

		    switch($period){
                 case "Quarter":
					  $tempBasic = $this->basic*($currentQuarter/4);
                      break;
                 case "Annual":
                 default:
                      $tempBasic =  $this->basic;
                      break;
             }
             $balance = $tempBasic - $this->paidBasic;
             #echo("$balance = $tempBasic - $this->paidBasic<br>");
             return round($balance,2);
         }
         /** The getBalanceSEF method. This method returns the balance of SEF dues.
          ** @public
          ** @returns double
          **/
         function getBalanceSEF($period){
           	$startDate = getdate($this->dueDate);
           	$today = getdate();
           	if(($period == 'Quarter') and ($startDate['year'] >= $today['year'])){
                $currentQuarter = ceil($today['mon']/3);
			} else {
				$period = "Annual";
			}
			
		     switch($period){
                 case "Quarter":
                      $tempSEF = $this->sef*($currentQuarter/4);
                      break;
            	 case "Annual":
                 default:
                      $tempSEF = $this->sef;
                      break;
             }
			 $balance = $tempSEF - $this->paidSEF;
			 return round($balance,2);
         }

         /** The getBalancePenalty method. This method returns the balance of penalties
          ** @public
          ** @returns object
          **/
         function getBalancePenalty($period){
		 	 # $balance = ($this->penalty*($this->basic + $this->sef + $this->idle)) - $this->paidPenalty;
             switch($period){
                 case "Quarter":
                      $tempSEF = $this->sef/4;
                      break;
          		 case "Annual":
                 default:
                      $tempSEF = $this->sef;
                      break;
             }
			 $balance = $this->penalty - $this->paidPenalty;
             return round($balance,2);
         }

		 function getBalanceIdle($period){
           	$startDate = getdate($this->dueDate);
           	$today = getdate();
           	if(($period == 'Quarter') and ($startDate['year'] >= $today['year'])){
                $currentQuarter = ceil($today['mon']/3);
			} else {
				$period = "Annual";
			}

  		     switch($period){
                 case "Quarter":
                      $tempIdle = $this->idle*($currentQuarter/4);
                      break;
                 case 'Annual':
                 default:
                      $tempIdle = $this->idle;
                      break;
             }
             $balance = $this->idle - $this->paidIdle;
             return round($balance,2);
         }
		 function creditPd1185($currencyValue){
                 $this->paidPd1185 += $currencyValue;
         }
         /** The recomputePayments method. This method will reset the entire object and reapply payments
          ** to update the balances (basicBalance, sefBalance, penaltyBalance).
          ** returns the totalBalance();
          ** @public
          ** @returns double
          **/
         function reapplyPayments(){
         	# Recalculate all the balances based on all payments on this due
			# for this due
			#     reset all paid amounts to P0.00
			$this->resetPayments(0.0);
			# select all payments for this due
			$sqlSelect = "SELECT amount, dueType from payments where dueID = '$this->dueID'";
			$rptsDB = new DB_RPTS($sqlSelect);
      		while($rptsDB->next_record()){
      			$payment = $rptsDB->Record;
		 		switch ($payment['dueType']){
		 			case 'basic': $this->creditBasic($payment['amount']); break;
		 			case 'sef': $this->creditSEF($payment['amount']); break;
		 			case 'penalty': $this->creditPenalty($payment['amount']); break;
		 			case 'idle':$this->creditIdle($payment['amount']); break;
					default: break;
				}
			}
         }

         function setPenalty(){
             $this->computePenalty();
         }
         /** The getPenalty method. This method returns the total computed penalties
          ** based on the last updateDate.
          ** @public
          ** @returns object
          **/
         function getPenalty(){
             return $this->penalty;
         }
         /** The computePenalty method. This method returns the total computed penalties
          ** based on the specific quarter or annual payment and the payDate.
          ** @public
          ** @returns object
          **/
         function computePenalty($period = 'Annual', $payDate="now"){
             global $penaltyLUT, $monthOffset;

		 	# used mktime(timestamp format) instead of date format from $this->dueDate
           	$startDate = getdate($this->dueDate);
           	$today = getdate();
           	#$today = array(year=>2003, mon=>1); #For testing purposes
           	if(($period == 'Quarter') and ($startDate['year'] == $today['year'])){
           	    // must pay the quarter payments within the year
                # convert determine the amount of time transpired since due date
                $currentQuarter = ceil($today['mon']/3);
		 	    # determine the balance due for the quarter (actually quarter - 1)
	 	     	$expectedBalance = ($this->basic + $this->sef + $this->idle)*(($currentQuarter-1)/4);
	 	     	#echo("$expectedBalance = ($this->basic + $this->sef + $this->idle)*(($currentQuarter-1)/4)<br>");
		 	    # if the balance is the same or more then no penalty till now
		 	    $currentBalance = $this->paidBasic + $this->paidSEF + $this->paidIdle;
				#echo("$expectedBalance <= $currentBalance<br>");
		 	    if($expectedBalance <= $currentBalance) {
		           	$this->pctPenalty = 0;
        		   	$this->penalty = 0;
		 	        return 0.0;
		 	    }
		 	    else {
		 	    	# if not then compute penalty from the start
		 	        # treat the transaction as an annual payment
				}
            }
		 	$endDate = getdate(strtotime($payDate));
           	# count the years
           	$numYears = $today['year'] - $startDate['year'];
           	# count the months
           	$numMonths = $today['mon'] - $startDate['mon'];
           	$totalMonths = ($numYears*12) + $numMonths;
           	# limit to up to only 36 months of penalty increases
           	$totalMonths = ($totalMonths<36) ? $totalMonths : 36;
           	# set the pctPenalty value and compute for the penalty
           	$this->pctPenalty = $penaltyLUT[$totalMonths];
			$this->penalty = ($this->basic + $this->sef + $this->idle) * $this->pctPenalty;

			if($this->getAmnesty()=="Yes"){
				$this->resetPenalty();
			}

           	return $this->penalty;
			
         }
		 
		  /** The computePenalty method. This method returns the total computed penalties
          ** based on the specific quarter or annual payment and the payDate.
          ** @public
          ** @returns object
          **/
         function computePenalty2($period = 'Annual', $payDate="now"){
             global $penaltyLUT, $monthOffset;

		 	# used mktime(timestamp format) instead of date format from $this->dueDate
           	$startDate = getdate($this->dueDate);
           	$today = getdate();
           	#$today = array(year=>2003, mon=>1); #For testing purposes
           	if(($period == 'Quarter') and ($startDate['year'] == $today['year'])){
           	    // must pay the quarter payments within the year
                # convert determine the amount of time transpired since due date
                $currentQuarter = ceil($today['mon']/3);
		 	    # determine the balance due for the quarter (actually quarter - 1)
	 	     	$expectedBalance = ($this->basic + $this->sef + $this->idle)*(($currentQuarter-1)/4);
	 	     	#echo("$expectedBalance = ($this->basic + $this->sef + $this->idle)*(($currentQuarter-1)/4)<br>");
		 	    # if the balance is the same or more then no penalty till now
		 	    $currentBalance = $this->paidBasic + $this->paidSEF + $this->paidIdle;
				#echo("$expectedBalance <= $currentBalance<br>");
		 	    if($expectedBalance <= $currentBalance) {
		           	$this->pctPenalty = 0;
        		   	$this->penalty = 0;
		 	        return 0.0;
		 	    }
		 	    else {
		 	    	# if not then compute penalty from the start
		 	        # treat the transaction as an annual payment
				}
            }
		 	$endDate = getdate(strtotime($payDate));
           	# count the years
           	$numYears = $today['year'] - $startDate['year'];
           	# count the months
           	$numMonths = $today['mon'] - $startDate['mon'];
           	$totalMonths = ($numYears*12) + $numMonths;
           	# limit to up to only 36 months of penalty increases
           	$totalMonths = ($totalMonths<36) ? $totalMonths : 36;
           	# set the pctPenalty value and compute for the penalty
           	$this->pctPenalty = $penaltyLUT[$totalMonths];
			$this->penalty = ($this->basic + $this->sef + $this->idle) * $this->pctPenalty;

			if($this->getAmnesty()=="Yes"){
				$this->resetPenalty();
			}

           	return $this->penalty;
			
         }
		
         /** The setPctPenalty method. This method sets the percentage penalty for
          ** this tax due. Penalties should be computed
          ** @public
          ** @returns double
          **/
         function setPctPenalty($value){
             $this->pctPenalty = $value;
         }
         /** The getPctPenalty method. This method returns the percentage of penalty
          ** @public
          ** @returns object
          **/
         function getPctPenalty(){
             return $this->pctPenalty;
         }

		 /** The resetPenalty method. This method returns penalty to zero.
          ** Is reset when amnesty is declared.
          ** @public
          ** @returns void
          **/
		  ## Note: should just use the compute penalty function and set the
		  ## return value to O if amnesty
		 function resetPenalty(){
		    $this->pctPenalty = 0.0;
		 	$this->penalty = 0.0;
		 }
         ## Methods for Storable Objects
         function store(){
               //if isStoredInDatabase then use an update statement
               if($this->isStoredInDatabase){
			   	   return $this->update();
               }
               else{// else use an insert statement
                    //create a DB object
                    $rptsDB = new DB_RPTS;
                    //prepare SQL statement
                    $strUpDate = date("Y-m-d H:i:s",time()); // changed from $this->updateDate

                    $strDueDate = date("Y-m-d",$this->getDueDate());
                    $sqlinsert = "INSERT INTO dues
                         SET basic   = '$this->basic',
                             penalty = '$this->penalty',
                             sef     = '$this->sef',
                             idle     = '$this->idle',							 
                             tdID   = '$this->tdID',
                             dueDate = '$strDueDate',
                             currentDate  = '$strUpDate', 
							 paidBasic    = '$this->paidBasic',
                             paidSEF      = '$this->paidSEF',
                             paidPenalty  = '$this->paidPenalty',
							 paidIdle  = '$this->paidIdle',
                             paidQuarters = '$this->paidQuarters',
                             paymentMode  = '$this->paymentMode'";
                    // query the database
					$queryID = $rptsDB->query($sqlinsert);
                    if($queryID){
                        $this->dueID = $rptsDB->insert_id();
                        $this->isStoredInDatabase = true;
                        return true;
                    }
                    else{
                        return false;
                    }
               }
         }

		 function select(){
		 	   $rptsDB = new DB_RPTS;
			   $sqlselect = "SELECT * FROM dues WHERE dueID = '$this->dueID'";
			   $queryID = $rptsDB->query($sqlselect);
			   if($queryID){
			   	   if($rptsDB->next_record()){
					   $this->basic        = $rptsDB->f("basic");
					   $this->penalty      = $rptsDB->f("penalty");
					   $this->sef          = $rptsDB->f("sef");
					   $this->idle         = $rptsDB->f("idle");
					   $this->tdID         = $rptsDB->f("tdID");
					   $this->dueDate      = $rptsDB->f("dueDate");
					   $this->updateDate   = $rptsDB->f("currentDate");
					   $this->paidBasic    = $rptsDB->f("paidBasic");
					   $this->paidPenalty  = $rptsDB->f("paidPenalty");
					   $this->paidSEF      = $rptsDB->f("paidSEF");
					   $this->paidIdle     = $rptsDB->f("paidIdle");				 
					   $this->paymentMode  = $rptsDB->f("paymentMode");
					   $this->paidQuarters = $rptsDB->f("paidQuarters");
					   $this->isStoredInDatabase = true;
				   	   $this->setIsDiscount((substr($$this->dueDate,0,4) == date("Y")) && (date("n")<=$this->discountPeriod) && ($this->paymentMode=="Annual"));


					if($this->getIdleStatus() == 1){
						$this->setIdle($assessedValue);
					}
			  	   }
				   return true;
			  }else{
			       return false;
			  }
		 } 
         function delete(){
               //create a db object
               $rptsDB = new DB_RPTS;
               //prepare an SQL delete statement
               $sqldelete = "DELETE from DUES where dueID = '$this->dueID'";
               //query the database
               $queryID = $rptsDB->query($sqldelete);
               if($queryID){
                   $this->isStoredInDatabase = false;
                   return true;
               }
               else{
                   return false;
               }
         }
         function update(){
               //create a DB object
               $rptsDB = new DB_RPTS;
               // prepare an SQL update statement
               // programming option: it is decided to use direct access to attributes
               //                     when saving and creating the object from database
			   $strUpDate = date("Y-m-d H:i:s",time()); // changed from $this->updateDate


			   $sqlupdate = sprintf("update %s set ".
						"  basic = '%s'".
						", penalty = '%s'".
						", sef = '%s'".
						", idle = '%s'".
						", tdID = '%s'".
						", currentDate = '%s'".
						", paidBasic = '%s'".
						", paidSEF = '%s'".
						", paidPenalty = '%s'".
						", paidIdle = '%s'".
						", paidQuarters = '%s'".
						", paymentMode = '%s'".
						", amnesty = '%s'".
						" where dueID = %s"
						, dues
						, fixQuotes($this->basic)
						, fixQuotes($this->penalty)
						, fixQuotes($this->sef)
						, fixQuotes($this->idle)
						, fixQuotes($this->tdID)
						, fixQuotes($strUpDate)
						, fixQuotes($this->paidBasic)
						, fixQuotes($this->paidSEF)
						, fixQuotes($this->paidPenalty)
						, fixQuotes($this->paidIdle)
						, fixQuotes($this->paidQuarters)
						, fixQuotes($this->paymentMode)
						, $this->amnesty
						, $this->dueID
					);

               //query the database
			   //echo("$sqlupdate<br>");
               $queryID = $rptsDB->query($sqlupdate);
               if($queryID){
                   return true;
               }
               else{
                   return false;
               }
         }
		 
		 function updatePaidTaxes($collectionID){
			 $rptsDB = new DB_RPTS;
			 # get payments belonging to a collection
			 $sqlselect = "SELECT payments.dueID, payments.dueType, payments.amount, payments.application FROM collectionPayments ".
						  "INNER JOIN payments ON payments.paymentID = collectionPayments.paymentID ".
						  "WHERE collectionID = '$collectionID'";
          	 $queryID = $rptsDB->query($sqlselect);
			 $numRows = mysql_num_rows($queryID);
		
          	 if($queryID){
			    # get amount paid and payment type from each payment and use this
				# to update paid taxes in dues table
    			$flag = 0;
				$tempBasic = 0;
				$tempSEF = 0;
				$tempIdle = 0;
				$tempPd1185 = 0;
				$tempPenalty = 0;
				$tempPaidQuarters = 0;

				while($rptsDB->next_record()) {
					$ctr++;
					$application = $rptsDB->f('application');
					$dueType = $rptsDB->f('dueType');
					$dueID = $rptsDB->f('dueID');
					# if dueID is not equal to flag, then already going through next dueID; save data of previous dueID 
					# and reset all temp due types; ** NO fields in dues table for PD1185 and paidPD1185 yet.
					if(($dueID != $flag) && ($flag != 0) || ($numRows == $ctr)){
						$this->setDueID($flag);
						$this->select();
						$this->creditBasic($tempBasic);
						$this->creditSEF($tempSEF);
						$this->creditIdle($tempIdle);
						$this->creditPd1185($tempPd1185);
						$this->creditPenalty($tempPenalty);
						$this->paidQuarters = $tempPaidQuarters;
						$this->update();
						# reset temp vars
						$tempBasic = 0;
						$tempSEF = 0;
						$tempIdle = 0;
						$tempPd1185 = 0;
						$tempPenalty = 0;
						$tempPaidQuarters = 0;
					}
					
					# get payment application and use it to update paid quarters
					switch($application){
						case 'Q1':
							$tempPaidQuarters = 1;
							break;
						case 'Q2':
							$tempPaidQuarters = 2;
							break;
						case 'Q3':
							$tempPaidQuarters = 3;
							break;
						case 'Q4':
							$tempPaidQuarters = 4;
							break;
						case 'full':
						default:
							break;
					}

					# get amount for each type of payment
					switch($dueType){
						case 'basic':
							$tempBasic = $rptsDB->f("amount");
							break;
						case 'sef':
							$tempSEF = $rptsDB->f("amount");
							break;
						case 'idle':
							$tempIdle = $rptsDB->f("amount");
							break; 
						case 'pd1185':
							$tempPd1185 = $rptsDB->f("amount");
							break;
						case 'penalty':
							$tempPenalty = $rptsDB->f("amount");
							break;
						default:
							break;
					}# end of switch
					$flag = $dueID;
					$dueType = "";
					$dueID = 0; 
				}# end of while 
          	 }
          	 else {
              	return false;
          	 }
		 }
		// changed from $rptopDate
		// the create function enforces the assertion that all dues are drawn from the
		// the database in that if they were not there, they will be inserted and created
         function create($tdID, $taxableYear){
               //create a DB object
               $rptsDB = new DB_RPTS;
               //prepare an SQL select statement
               //verbosity is provided as a reference
               $sqlselect = "SELECT dueID, basic, penalty, sef, idle, tdID, YEAR(dueDate) as taxableYear,
                                    currentdate,paidBasic,paidSEF,paidPenalty, paidIdle,
                                    paymentMode, paidQuarters, amnesty 
                             FROM dues where tdID = '$tdID' and YEAR(dueDate) = '$taxableYear'";

			   //query the database
               $queryID = $rptsDB->query($sqlselect);
               //assert that there should only be one result
               if($rptsDB->next_record()){
                   $this->dueID = $rptsDB->f("dueID");
                   $this->basic      = $rptsDB->f("basic");
                   $this->penalty    = $rptsDB->f("penalty");
                   $this->sef        = $rptsDB->f("sef");
                   $this->idle        = $rptsDB->f("idle");
                   $this->tdID      = $rptsDB->f("tdID");
				   $this->setDueDate($rptsDB->f("taxableYear"));
                   $this->updateDate     = $rptsDB->f("currentDate");
                   $this->paidBasic   = $rptsDB->f("paidBasic");
                   $this->paidPenalty = $rptsDB->f("paidPenalty");
                   $this->paidSEF     = $rptsDB->f("paidSEF");
                   $this->paidIdle     = $rptsDB->f("paidIdle");				 
                   $this->paymentMode = $rptsDB->f("paymentMode");
                   $this->paidQuarters = $rptsDB->f("paidQuarters");
                   $this->amnesty = $rptsDB->f("amnesty");
                   $this->isStoredInDatabase = true;
				   $this->computePenalty($this->paymentMode);

				   // set Discount ON if ff condition is met:
				   if(($taxableYear == date("Y")) && (date("n")<=$this->discountPeriod) && ($this->paymentMode=="Annual")){
					   $isDiscount = true;
				   }
				   else{
					   $isDiscount = false;
				   }
				   
				   $this->setIsDiscount($isDiscount);

				   #$this->setIsDiscount($this->paymentMode=="Annual");
					if($this->getIdleStatus() == 1){
						$this->setIdle($assessedValue);
					}
				   return true;
               }
               else{ // due item was not found to be in the database
			   	   //echo("not found");
                   return false;
               }
         }
		
		function resetPayments() {
			$this->paidBasic = 0;
			$this->paidSEF = 0;
			$this->paidIdle = 0;
			$this->paidPenalty = 0;
		}
     }
?>
