<?php
require_once("collection/StorableObject.php");
class Payment extends StorableObject {
      /** The $amount attribute. This attribute is the total amount of payment
       ** applied to the specific TD identified by TDnum
       ** @type int
       **/
      var $amount;
      /** The $discount attribute. This attribute is the discount
       ** applied to the paid amount. i.e. amount = tax due * (1-discount+interest)
       ** @type int
       **/
      var $discount;
      /** The $interest attribute. This attribute is the interest
       ** applied to the paid amount. i.e. amount = tax due * (1-discount+interest)
       ** @type int
       **/
      var $interest;
      /** the $application attribute. Application specifies the type of payment
       ** whether full payment, or 1st, 2nd, 3rd, or 4th Qtr Installment
       ** it should take on the values of {'Annual','Q1','Q2','Q3','Q4')
       ** @type string
       **/
      var $application;
      /** the $dueType attribute. sets the component of the due being paid
       ** whether - basic, sef or penalty charges.
       ** @type string
       **/
      var $dueType;
      /** The $dueID attribute. dueID is the number of the specific Dues
       ** for which the entire $amount is being applied for. (Note: the dues
       ** contains the reference to the TD where payment will be applied.
       ** $type identifier
       **/
      var $dueID;
      /** The $paymentID attribute. paymentID is the number of the payment
       ** in the datebase
       ** $type identifier
       **/
      var $paymentID;
      /**
       **  METHODS
       **/
      var $receiptNum;


      function Payment($paytype,$receiptNum = 0){
          $this->StorableObject();
          $this->amount = 0.0;
          $this->receiptNum = $receiptNum; // 0 is a non-valid receipt Num
          $this->dueID = 0; // 0 is a non-valid dueID
      }
      /**  The setAmount method. This method sets the total value of the payment.
       **  $amount is computed as $basic + $penalty + $sef
       **  @public
       **  @returns void
       **/
      function setAmount($currencyValue){
          if($currencyValue < 0.0) $currencyValue = 0.0;
          $this->amount = $currencyValue;
      }
      /**  The getAmount method. This method returns the total amount of payment made.
       **  @public
       **  @returns double
       **/
      function getAmount(){
          return $this->amount;
      }
      /**  The setApplication method. This method sets the type of application of payment
       **  @public
       **  @returns void
       **/
      function setApplication($textValue){
          switch($textValue){
              case "Annual":
              case "Q1":
              case "Q2":
              case "Q3":
              case "Q4":
                   $this->application = $textValue;
                   break;
              default:
                   $this->application = "";
                   break;
          }
      }
      /**  The getApplication method. This method returns the type of payment made.
       **  @public
       **  @returns string
       **/
      function getApplication(){
          return $this->application;
      }
      /**  The setDueType method. Sets the amount of $dueType taxes incurred in the payment.
       **  @public
       **  @returns void
       **/
      function setDueType($stringValue){
          $this->dueType = $stringValue;
      }
      /**  The getDueType method. This method returns the total amount of dueType taxes paid.
       **  @public
       **  @returns double
       **/
      function getDueType(){
          return $this->dueType;
      }
      /**  The setDueID method. This method assigns this specific payment to this due
       **  @public
       **  @returns void
       **/
      function setDueID($identifier){
          $this->dueID = $identifier;
      }
      /**  The getDueID method. This method returns the $dueID associated with the payment.
       **  @public
       **  @returns identifier to the dueID
       **/
      function getDueID(){
          return $this->dueID;
      }
      /**  The setPaymentID method. This method sets unique identifier for the payment
       **  @public
       **  @returns identifier to the dueID
       **/
      function setPaymentID($identifier){
          $this->paymentID = $identifier;
      }
      /**  The getPaymentID method. This method returns unique identifier for the payment
       **  @public
       **  @returns identifier to the dueID
       **/
      function getPaymentID(){
          return $this->paymentID;
      }
      /**  The setReceiptNum method. This method sets the receipt number associated with the payment.
       **  @public
       **  @returns identifier to the dueID
       **/
      function setReceiptNum($identifier){
          $this->receiptNum = $identifier;
      }
      /**  The getReceiptNum method. This method returns the receipt number associated with the payment.
       **  @public
       **  @returns identifier to the dueID
       **/
      function getReceiptNum(){
          return $this->receiptNum;
      }
      function setDiscount($identifier){
          $this->discount = $identifier;
      }
      /**  The setDiscount method. This method returns the $discount associated with the payment.
       **  @public
       **  @returns identifier to the discount
       **/
      function getDiscount(){
          return $this->discount;
      }
      /**  The getDiscount method. This method sets discount for the payment
       **  @public
       **  @returns identifier to the discount
       **/

	  #Same as Penalties
      function getInterest(){ 
          return $this->interest;
      }
      /**  The getInterst method. This method sets interest for the payment
       **  @public
       **  @returns identifier to the interest
       **/
      function setInterest($identifier){
          $this->interest = $identifier;
      }
      /**  The setInterest method. This method returns the $interest associated with the payment.
       **  @public
       **  @returns identifier to the interest
       **/

      function storeRecord(){
          //if isStoredInDatabase then use an update statement
          if ($this->isStoredInDatabase){
              $this->updateRecord();
          }
          else{ // else use an insert statement
               if ($this->application == "") return false;
               //create a DB object
               $rptsDB = new DB_RPTS;
               //prepare SQL statement
               $sqlinsert = "INSERT INTO payments
                          SET amount      = $this->amount,
                              application = '$this->application',
                              dueType     = '$this->dueType',
                              dueID       = $this->dueID,
                              receiptNum  = '$this->receiptNum'";
               $queryID = $rptsDB->query($sqlinsert);
               if($queryID){
                   $this->paymentID = $rptsDB->insert_id();
                   $this->isStoredInDatabase = true;
                   return true;
               }
               else{
                   return false;
               }
          }
      }
      
      function deleteRecord(){
          if(!$this->isStoredInDatabase) return false;
          //create a db object
          $rptsDB = new DB_RPTS;
          //prepare an SQL delete statement
          $sqldelete = "DELETE FROM payments WHERE paymentID = '$this->paymentID'";
          echo "$sqldelete";
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
      function updateRecord(){
          if(!$this->isStoredInDatabase) return false;
          //create a DB object
          $rptsDB = new DB_RPTS;
          //prepare an SQL update statement
          $sqlupdate = "UPDATE payments set
                     amount      = $this->amount,
                     application = '$this->application',
                     dueType     = '$this->dueType',
                     receiptNum  = '$this->receiptNum',
                     dueID       = $this->dueID
                     WHERE paymentID = $this->paymentID";
          //query the database
          $queryID = $rptsDB->query($sqlupdate);
          if($queryID){
              $this->isStoredInDatabase = True;
              return true;
          }
          else {
              return false;
          }
      }
      function createRecord($paymentID){
          //create a DB object
          $rptsDB = new DB_RPTS;
          //prepare an SQL select statement
          $sqlselect = "select paymentID, application, penalty, sef, basic, dueID
                        FROM payments where paymentID = $paymentID";
          //query the database
          $rptsDB->query($sqlselect);
          if ($rptsDB->next_record()){
             $this->paymentID   = $rptsDB->f("paymentID");
             $this->amount      = $rptsDB->f("amount");
             $this->application = $rptsDB->f("application");
             $this->dueType     = $rptsDB->f("dueType");
             $this->receiptNum  = $rptsDB->f("receiptNum");
             $this->dueID       = $rptsDB->f("dueID");
             $this->isStoredInDatabase = true;
             return true;
          }
          else {
              // you tried to create a payment that did not exist
              // this should not happen
             return false;
          }
      }
}
?>
