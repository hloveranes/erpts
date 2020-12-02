<?php
# Modified by Bia 
# added storeReceipt function to record corresponding collectionID for each paymentID - 07 Aug 2003
# added updateReceiptNum function to insert receipt no. into collection and payments - 11 Aug 2003
require_once("collection/Payment.php");
require_once("collection/StorableObject.php");

require_once("collection/BacktaxTD.php");
require_once("web/db_mysql.inc");


class Collections extends StorableObject{
    /** The $receiptDate attribute. Indicates the date payment is collected.
     ** @type date
     **/
    var $collectionDate;
    /** The $receiptNum. This is the number indicated on the RPT Receipt.
     ** once a unique receiptNum has been entered into the object, the receipt
     ** is considered final.
     ** @type identifier.
     **/
    var $receiptNum;
    /** The $oldReceiptNum attribute. This attribute indicates the previous receipt number
     ** @type string
     **/
    var $oldReceiptNum;
    /** The $rptopNum attribute. This number identifies the RPTOP associated with this receipt.
     ** The RPTOP contains the owner information that should be indicated on the receipt.
     ** @type string
     **/
    var $rptopNum;
    /** The $tdNum attribute. This attribute identifies the particular TD in the RPTOP that
     ** has tax dues. The TD contains the information
     ** @type identifier
     **/
    var $tdNum;
    /** The $payments attribute. This is an OrderedList of payments. All of these
     ** payments constitute the totality of the collected sum.
     ** @type PaymentList object
     **/
    var $payments=array();
    /** The $receiptSum attribute. This is the total collected amount from the Payee.
     ** @type currency
     **/
	
	# added variables + setter/getter methods for use in sql statements 
    var $collectionSum;
	var $collectionID;
	var $receivedFrom;
	var $kindOfPayment;
	var $checkNum;
	var $checkDate;
	var $oldReceiptDate;
	var $municipality;
	var $amnesty;
    
    
    function Collections(){
        $this->StorableObject();
    }
    /**  The setDate method. This method sets the date indicated when receipt
     **  was made. Also this is the date on the Official Receipt.
     **  @public
     **  @returns void
     **/
    function setCollectionDate($collectionDate){
        $this->collectionDate = $collectionDate;
    }
    function getCollectiontDate(){
        return $this->collectionDate;
    }
    /**  The setReceipt method. This method sets the receiptNum and indicates that
     **  the receipt is final and uneditable.
     **  @public
     **  @returns void
     **/
    function setcollectionNum($serialNum){
        $this->receiptNum = (string) $serialNum;
        $numPayments = count($this->payments);
        for ($ctr = 0; $ctr <$numPayments; $ctr++){
            $this->payments[$ctr]->setReceiptNum($this->getReceiptNum());
            $this->payments[$ctr]->store();
        }
    }
	
	function setReceiptNum($receiptNum){
		$this->receiptNum = $receiptNum;
	}
	
    function getReceiptNum(){
        return $this->receiptNum;
    }
    /**  The setOldReceiptNum method. This method sets the number indicating the
     **  serial number on the last receipt issued to this owner.
     **  @public
     **  @returns void
     **/
    function setOldReceiptNum($oldNum){
        $this->oldReceiptNum = $oldNum;
    }
    function getOldReceiptNum(){
        return $this->oldReceiptNum;
    }
    /**  The setRPTOPNum method. This method sets the number  of the RPTOP
     **  associated with the receipt.
     **  @public
     **  @returns void
     **/
    function setRPTOPNum($identifier){
        $this->rptopNum = $identifier;
    }
    function getRPTOPNum(){
        return $this->rptopNum;
    }
    /**  The setTDNum. This method sets the number indicating the TD
     **  associated with this recipt.
     **  @public
     **  @returns void
     **/
    function setTDNum($identifier){
        $this->tdNum = $identifier;
    }
    function getTDNum(){
        return $this->rptopNum;
    }
    /**  The setPayments method. This method sets the payments associated
     **  with the receipt.
     **  @public
     **  @returns void
     **/
    function setPayments($paymentsList){
        $this->payments = $paymentList;
    }
    /**  The addPayments method. This method adds a payment to the payments list
     **  @public
     **  @returns void
     **/
    function addPayment($paymentObject){
		array_push($this->payments, $paymentObject);
    }
    function getPayments(){
        return $this->payments;
    }
    /**  The setSum method. This method sets the sum of the payments collected.
     **  @public
     **  @returns void
     **/
    function setCollectionSum($currencyValue){
        $this->collectionSum = $currencyValue;
    }
    function getCollectionSum(){
        return $this->collectionSum;

    }
	
	function setCollectionID($collectionID){
		$this->collectionID = $collectionID;
	}
	function getCollectionID(){
		return $this->collectionID;
	}
	
	function setReceivedFrom($receivedFrom){
		$this->receivedFrom = $receivedFrom;
	}
	function getReceivedFrom(){
		return $this->receivedFrom;
	}

	function setKindOfPayment($kindOfPayment){
		$this->kindOfPayment = $kindOfPayment;
	}
	function getKindOfPayment(){
		return $this->kindOfPayment;
	}
	
	function setCheckNum($checkNum){
		$this->checkNum = $checkNum;
	}
	function getCheckNum(){
		return $this->checkNum;
	}
	
	function setCheckDate($checkDate){
		$this->checkDate = $checkDate;
	}
	function getCheckDate(){
		return $this->checkDate;
	}
	
	function setOldReceiptDate($oldReceiptDate){
		$this->oldReceiptDate = $oldReceiptDate;
	}
	function getOldReceiptDate(){
		return $this->oldReceiptDate;
	}
	
	function setMunicipality($municipality){
		$this->municipality = $municipality;
	}
	function getMunicipality(){
		return $this->municipality;
	}
	
	function setAmnesty($value){
		$this->amnesty = $value;
	}
	function getAmnesty(){
		return $this->amnesty;
	}
	
    /** Database Functions **/
    /**  The 
	 method. This method stores the object into the database
     **  @public
     **  @returns void
     **/
    function storeRecord(){
          //create a DB object
          $rptsDB = new DB_RPTS;
          //if isStoredInDatabase then update
          if($this->isStoredInDatabase){
          	   if($this->updateRecord())
			   		return true;
			   else
			   		return false;
          }
          else{
		  	  // else use an insert statement
              // prepare SQL statement
			  $sqlinsert = sprintf("insert into %s (".
							"collectionDate".
							", collectionSum".
							", receiptNum".
							", receivedFrom".
							", kindOfPayment".
							", checkNum".
							", checkDate".
							", oldReceiptNum".
							", oldReceiptDate".
							", municipality".
							", amnesty".
							")".
							" values ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');"
							, collections
							, fixQuotes($this->collectionDate)
							, fixQuotes($this->collectionSum)
							, fixQuotes($this->receiptNum)
							, fixQuotes($this->receivedFrom)
							, fixQuotes($this->kindOfPayment)
							, fixQuotes($this->checkNum)
							, fixQuotes($this->checkDate)
							, fixQuotes($this->oldReceiptNum)
							, fixQuotes($this->oldReceiptDate)
							, fixQuotes($this->municipality)
							, fixQuotes($this->amnesty)
						);
              $queryID = $rptsDB->query($sqlinsert);
              if($queryID){
                  $this->collectionID = $rptsDB->insert_id();
				  // store the payments
				  if($this->storeByReceipt($this->collectionID)){
				      $this->isStoredInDatabase = true;
					  return true;
				  }else{
				  	  return false;
				  }
              }
              else{
                  return false;
              }
          }
    }
	
	function storeByReceipt($collectionID){
		$rptsDB = new DB_RPTS;
		foreach($this->payments as $key=>$value){
			$paymentObj = $value;
			$dueID = $paymentObj->getDueID();
			$dueType = $paymentObj->getDueType();
			$application = $paymentObj->getApplication();
			# added application in query to make record unique
			$sqlselect = "SELECT paymentID FROM payments WHERE dueID='$dueID' AND dueType='$dueType' AND application = '$application'";
			$bwiset = $rptsDB->query($sqlselect);
			if ($rptsDB->next_record()) {
				$paymentID = $rptsDB->f("paymentID");
			}
			
			$sqlinsert = sprintf("insert into %s (".
							"collectionID".
							", paymentID".
							")".
							" values ('%s', '%s');"
							, collectionPayments
							, fixQuotes($collectionID)
							, fixQuotes($paymentID)
						);
			$queryID = $rptsDB->query($sqlinsert);
		}
		
		if($queryID){
			return true;
		}else{
			return false;
		}
	}
    /**  The deleteRecord method. This method deletes the object from the database
     **  @public
     **  @returns void
     **/
    function deleteRecord(){
          //create a db object
          $rptsDB = new DB_RPTS;
          //prepare an SQL delete statement

          // first delete the payments and receiptPayments entries
		  $sqlselect = "select paymentID from collectionPayments where collectionID=$this->collectionID;";
		  $rptsDB->query($sqlselect);
		  
		  $payment = new Payment();
		  while ($rptsDB->next_record()) {
		  	$payment->setPaymentID($rptsDB->f("paymentID"));
			$payment->selectRecord();
			$payment->deleteRecord();
		  }

          $sqldelete = "delete from collectionPayments 
                        where collectionID=$this->collectionID;";
		  //echo("$sqldelete<br>");
          $queryID = $rptsDB->query($sqldelete);

          // then delete the receipt
          $sqldelete = "delete from collections where collectionID = $this->collectionID";
		  //echo("$sqldelete<br>");
          $queryID = $rptsDB->query($sqldelete);

          if($queryID){
              return true;
          }
          else {
              return false;
          }
          
    }
	
	function updateReceiptNum(){
		$rptsDB = new DB_RPTS;
		# update receipt number of collection
		$sqlupdate= sprintf("update %s set".
					" receiptNum = '%s'".
					" where collectionID = '%s';"
					, collections
					, fixQuotes($this->receiptNum)
					, $this->collectionID
					);
		$queryID = $rptsDB->query($sqlupdate);
		
		if($queryID){
			# update receipt number of payments belonging to collection
			$sqlselect = sprintf("SELECT paymentID FROM %s WHERE collectionID = '%s';",
								  collectionPayments, $this->collectionID);
			$selectQueryID = $rptsDB->query($sqlselect);
			
			if($selectQueryID){
				$rptsDB2 = new DB_RPTS;
				while ($rptsDB->next_record()) {
					$sqlupdate = sprintf("update %s set".
								" receiptNum = '%s'".
								" where paymentID = '%s'"
								, payments
								, fixQuotes($this->receiptNum)
								, $rptsDB->f("paymentID")
								);
					//echo("$sqlupdate<br>");
					$updateQueryID = $rptsDB2->query($sqlupdate);
				} # end while
				
				if($updateQueryID){
					return true;
				}
				else{
					return false;
				}
			}else{
				return false;
			}
        }
        else {
              return false;
        }
	}
    /**  The updateRecord method. This method updates the object to the database
     **  @public
     **  @returns void
     **/
    function updateRecord(){
          //create a DB object
          $rptsDB = new DB_RPTS;
          //prepare an SQL update statement
		  $sqlupdate = sprintf("update %s set ".
				"collectionDate = '%s'".
				", collectionSum = '%s'".
				", receiptNum = '%s'".
				", oldReceiptNum = '%s'".
				", oldReceiptDate = '%s'".
				" where paymentID = %s"
				, collections
				, fixQuotes($this->collectionDate)
				, fixQuotes($this->collectionSum)
				, fixQuotes($this->receiptNum)
				, fixQuotes($this->oldReceiptNum)
				, fixQuotes($this->oldReceiptDate)
				, $this->collectionID
			);
          //query the database
          $queryID = $rptsDB->query($sqlupdate);
          if($queryID){
              /*foreach ($payments as $payment){
                  // update the payment object
                  $payment->update;
                  // update the assiocative table of payments
                  $sqldelete = "delete from collectionPayments";
              }*/
              return true;
          }
          else {
              return false;
          }
    }
    /**  The createRecord method. This method selects the object from the database
     **  @public
     **  @returns void
     **/
    function createRecord(){
          # create a DB object
          $rptsDB = new DB_RPTS;
          # prepare an SQL select statement
          # changed query statement; cannot obtain collectionID beforehand so use collectionDate, collectionSum
		  # receivedFrom & kindOfPayment for query -- enough na ba yan to make a collection unique? :) -- 26 aug 2003 -- NOT!
		  # added receiptNum in query 
		  $sqlselect = "SELECT * FROM collections WHERE collectionDate = '$this->collectionDate' AND collectionSum = '$this->collectionSum' ".
		               "AND receivedFrom = '$this->receivedFrom' AND kindOfPayment = '$this->kindOfPayment' AND receiptNum = '$this->receiptNum'";
          # query the database
          $rptsDB->query($sqlselect);
          if($rptsDB->next_record()){
              $this->collectionID = $rptsDB->f("collectionID");
              $this->collectionDate = $rptsDB->f("collectionDate");
			  $this->collectionSum = $rptsDB->f("collectionSum");
			  $this->receiptNum = $rptsDB->f("receiptNum");
			  $this->receivedFrom = $rptsDB->f("receivedFrom");
			  $this->kindOfPayment = $rptsDB->f("kindOfPayment");			  			  			  
			  $this->checkNum = $rptsDB->f("checkNum");
			  $this->checkDate = $rptsDB->f("checkDate");
			  $this->oldReceiptNum = $rptsDB->f("oldReceiptNum");
			  $this->oldReceiptDate = $rptsDB->f("oldReceiptDate");			  			  
              $this->municipality = $rptsDB->f("municipality");
              $this->amnesty = $rptsDB->f("amnesty");
			  
              # wala namang tdNum/tdID at rptopNum sa table 
			  # $this->rptopNum = $rptsDB->f("rptopNum");
              # $this->tdID = $rptsDB->f("tdID");
              /* create the payments list from an associative table */
              /*$sqlselect = "SELECT paymentID from payments where receiptNum = '$collectionID'";
              $rptsDB->query($sqlselect);
              while($rptsDB->next_record()){
                  $paymentID = $rptsDB->f("paymentID");
                  $payment = new Payment();
                  $payment->createByID($paymentID);
                  $this->addPayment($payment);
              }*/
			  $this->isStoredInDatabase = true;
			  return true;
          }
          else {
              return false;
          }
    }

    function selectRecord(){
          # create a DB object
          $rptsDB = new DB_RPTS;
          # prepare an SQL select statement
          # changed query statement; cannot obtain collectionID beforehand so use collectionDate, collectionSum
		  # receivedFrom & kindOfPayment for query -- enough na ba yan to make a collection unique? :) -- 26 aug 2003 -- NOT!
		  # added receiptNum in query 
		  $sqlselect = "SELECT * FROM collections WHERE collectionID = '$this->collectionID'";
          # query the database
          $rptsDB->query($sqlselect);
          if($rptsDB->next_record()){
              $this->collectionID = $rptsDB->f("collectionID");
              $this->collectionDate = $rptsDB->f("collectionDate");
			  $this->collectionSum = $rptsDB->f("collectionSum");
			  $this->receiptNum = $rptsDB->f("receiptNum");
			  $this->receivedFrom = $rptsDB->f("receivedFrom");
			  $this->kindOfPayment = $rptsDB->f("kindOfPayment");			  			  			  
			  $this->checkNum = $rptsDB->f("checkNum");
			  $this->checkDate = $rptsDB->f("checkDate");
			  $this->oldReceiptNum = $rptsDB->f("oldReceiptNum");
			  $this->oldReceiptDate = $rptsDB->f("oldReceiptDate");			  			  
              $this->municipality = $rptsDB->f("municipality");
              $this->amnesty = $rptsDB->f("amnesty");
			  
              # wala namang tdNum/tdID at rptopNum sa table 
			  # $this->rptopNum = $rptsDB->f("rptopNum");
              # $this->tdID = $rptsDB->f("tdID");
              /* create the payments list from an associative table */
              /*$sqlselect = "SELECT paymentID from payments where receiptNum = '$collectionID'";
              $rptsDB->query($sqlselect);
              while($rptsDB->next_record()){
                  $paymentID = $rptsDB->f("paymentID");
                  $payment = new Payment();
                  $payment->createByID($paymentID);
                  $this->addPayment($payment);
              }*/
			  $this->isStoredInDatabase = true;
			  return true;
          }
          else {
              return false;
          }
    }
    function selectWhereReceiptNum($receiptNum){
          # create a DB object
          $rptsDB = new DB_RPTS;
          # prepare an SQL select statement
          # changed query statement; cannot obtain collectionID beforehand so use collectionDate, collectionSum
		  # receivedFrom & kindOfPayment for query -- enough na ba yan to make a collection unique? :) -- 26 aug 2003 -- NOT!
		  # added receiptNum in query 
		  $sqlselect = "SELECT * FROM collections WHERE receiptNum = '$receiptNum'";
          # query the database
          $rptsDB->query($sqlselect);
          if($rptsDB->next_record()){
              $this->collectionID = $rptsDB->f("collectionID");
              $this->collectionDate = $rptsDB->f("collectionDate");
			  $this->collectionSum = $rptsDB->f("collectionSum");
			  $this->receiptNum = $rptsDB->f("receiptNum");
			  $this->receivedFrom = $rptsDB->f("receivedFrom");
			  $this->kindOfPayment = $rptsDB->f("kindOfPayment");			  			  			  
			  $this->checkNum = $rptsDB->f("checkNum");
			  $this->checkDate = $rptsDB->f("checkDate");
			  $this->oldReceiptNum = $rptsDB->f("oldReceiptNum");
			  $this->oldReceiptDate = $rptsDB->f("oldReceiptDate");			  			  
              $this->municipality = $rptsDB->f("municipality");
              $this->amnesty = $rptsDB->f("amnesty");
			  $this->isStoredInDatabase = true;
			  return true;
          }
          else {
              return false;
          }
    }
	
	function retreivePaymentIDs($collectionID) {
		  $buffer = array();
          $rptsDB = new DB_RPTS;
		  $sqlselect = "select paymentID from collectionPayments where collectionID=$collectionID;";
          $rptsDB->query($sqlselect);
          while ($rptsDB->next_record()){
		  	$buffer[] = $rptsDB->f("paymentID");
			#echo("paymentID=".$rptsDB->f("paymentID")."<br>");
          }

		  return $buffer;
	}
	
	function cancelPayment($collectionID,$paymentID) {
          $rptsDB = new DB_RPTS;
		  $sqlinsert = sprintf("insert into cancelledCollectionPayments (collectionID,paymentID) values (%d, %d);", $collectionID, $paymentID);
          $rptsDB->query($sqlselect);

		  $sqldelete = sprintf("delete from collectionPayments where collectionID=%d;",$collectionID);
          $rptsDB->query($sqldelete);
	}
	function copyPayment($collectionID,$paymentID) {
          $rptsDB = new DB_RPTS;
		  $sqlinsert = sprintf("insert into cancelledCollectionPayments (collectionID,paymentID) values (%d, %d);", $collectionID, $paymentID);
		  #echo("$sqlinsert<br>");
          $rptsDB->query($sqlinsert);
	}
	
	function cancelCollection() {
			 $rptsDB = new DB_RPTS;

			  $sqlinsert = sprintf("insert into cancelledCollections (".
			  				"collectionID".
							", collectionDate".
							", collectionSum".
							", receiptNum".
							", receivedFrom".
							", kindOfPayment".
							", checkNum".
							", checkDate".
							", oldReceiptNum".
							", oldReceiptDate".
							", municipality".
							", amnesty".
							")".
							" values (%d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');"
							, $this->getCollectionID()
							, fixQuotes($this->collectionDate)
							, fixQuotes($this->collectionSum)
							, fixQuotes($this->receiptNum)
							, fixQuotes($this->receivedFrom)
							, fixQuotes($this->kindOfPayment)
							, fixQuotes($this->checkNum)
							, fixQuotes($this->checkDate)
							, fixQuotes($this->oldReceiptNum)
							, fixQuotes($this->oldReceiptDate)
							, fixQuotes($this->municipality)
							, fixQuotes($this->amnesty)
						);
              $queryID = $rptsDB->query($sqlinsert);
			  
			  if ($queryID) {
			  	$this->deleteRecord();
			  }
			  
			  return false;
	}
	function copyCollection() {
			 $rptsDB = new DB_RPTS;

			  $sqlinsert = sprintf("insert into cancelledCollections (".
			  				"dateCancelled".
			  				", collectionID".
							", collectionDate".
							", collectionSum".
							", receiptNum".
							", receivedFrom".
							", kindOfPayment".
							", checkNum".
							", checkDate".
							", oldReceiptNum".
							", oldReceiptDate".
							", municipality".
							", amnesty".
							")".
							" values ('%s', %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');"
							, date("Y-m-d H:i:s")
							, $this->getCollectionID()
							, fixQuotes($this->collectionDate)
							, fixQuotes($this->collectionSum)
							, fixQuotes($this->receiptNum)
							, fixQuotes($this->receivedFrom)
							, fixQuotes($this->kindOfPayment)
							, fixQuotes($this->checkNum)
							, fixQuotes($this->checkDate)
							, fixQuotes($this->oldReceiptNum)
							, fixQuotes($this->oldReceiptDate)
							, fixQuotes($this->municipality)
							, fixQuotes($this->amnesty)
						);
		   	  #echo("$sqlinsert<br>");
              $queryID = $rptsDB->query($sqlinsert);
	}
	
	function cancelRecord() {
        $rptsDB = new DB_RPTS;

        $sqlselect = "select payments.paymentID from payments 
  						inner join collectionPayments on payments.paymentID=collectionPayments.paymentID 
                        where collectionPayments.collectionID =$this->collectionID";
		#echo("$sqlselect<br>");
        $rptsDB->query($sqlselect);

		$payment = new Payment();

		$dueArr = array();
		while ($rptsDB->next_record()) {
			$payment->setPaymentID($rptsDB->f("paymentID"));
			$payment->selectRecord();
			$payment->copyRecord();


			// if Payment is BacktaxTD, FLAG BacktaxTD paidStatus as '' for UNPAID

			if($strstr=strstr($payment->dueType, ",")){
				$backtaxTDID = strstr($strstr, "=");
				$backtaxTDID = str_replace("=", "", $backtaxTDID);

				$backtaxTD = new BacktaxTD;
				$backtaxTD->selectRecord("",$backtaxTDID);
				$backtaxTD->setBacktaxTDID($backtaxTDID);
				$backtaxTD->setTotalPaid(0);
				$backtaxTD->updatePaidStatus("");
				$backtaxTD->updateRecord();
			}
			
			$dueID=$payment->getDueID();
			if (!in_array($dueID,$dueArr)) $dueArr[]=$dueID;
			$this->copyPayment($this->getCollectionID(),$rptsDB->f("paymentID"));
		}

		#echo("dueID=$dueID<br>");
		$due = new Dues();
		foreach ($dueArr as $dueID) {
			$due->setDueID($dueID);
			$due->select();
			$due->resetPayments();
			$due->store();
		}

		$this->copyCollection();
		$this->deleteRecord();
	}
	
	function purge() {
        $rptsDB = new DB_RPTS;
        $rptsDB2 = new DB_RPTS;

		$sqlselect = "SELECT collectionID FROM collections WHERE receiptNum = '' OR receiptNum is NULL;";
        $rptsDB->query($sqlselect);
		$due = new Dues();
        while ($rptsDB->next_record()){
			$collectionID = $rptsDB->f("collectionID");
            $this->collectionID = $collectionID;
			$this->isStoredInDatabase = true;

	        $sqlselect2 = "select payments.paymentID, payments.dueID from payments 
  						inner join collectionPayments on payments.paymentID=collectionPayments.paymentID 
                        where collectionPayments.collectionID =$collectionID";
			#echo("$sqlselect2<br>");
        	$rptsDB2->query($sqlselect2);

			$payment = new Payment();

			while ($rptsDB2->next_record()) {

				$payment->setPaymentID($rptsDB2->f("paymentID"));
				$payment->selectRecord();

				// if Payment is BacktaxTD, FLAG BacktaxTD paidStatus as '' for false / UNPAID

				if($strstr=strstr($payment->dueType, ",")){
					$backtaxTDID = strstr($strstr, "=");
					$backtaxTDID = str_replace("=", "", $backtaxTDID);

					$backtaxTD = new BacktaxTD;
					$backtaxTD->selectRecord("",$backtaxTDID);
					$backtaxTD->setBacktaxTDID($backtaxTDID);
					$backtaxTD->setTotalPaid(0);
					$backtaxTD->updatePaidStatus("");
					$backtaxTD->updateRecord();
				}

				$dueID = $rptsDB2->f("dueID");
				$due->setDueID($dueID);
				$due->select();
				$due->resetPayments();
				$due->store();
			}

			if (!$this->deleteRecord()) {
				return false;
			}
        }
		
		return true;
	}
}

?>