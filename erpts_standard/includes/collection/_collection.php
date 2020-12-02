<?php

include_once "./payments.php";
include_once "./db_mysql.inc";

class Collection{
    /** The $payments attribute. This is an OrderedList of payments. All of these
     ** payments constitute the totality of the collected sum.
     ** @type PaymentList object
     **/
    var $payments=array();
    /** The $date attribute. Indicates the date payment is collected.
     ** @type date
     **/
    var $date;
    /** The $sum attribute. This is the total collected amount from the Payee.
     ** @type currency
     **/
    var $sum;
    /** The $receiptNum. This is the number indicated on the Official Receipt.
     ** once a unique receiptNum has been entered into the object, the collection
     ** is considered final.
     ** @type identifier.
     **/
    var $receiptNum;
    /** The $rptopNum attribute. This object identifier should contain the name of the owner
     ** paying for the tax dues. If paying by check, it should reflect the name on the check
     ** @type string
     **/
    var $rptopNum;
    /** The $tdNum attribute. This attribute is identifies the particular TD in the RPTOP that
     ** has tax dues.
     ** @type identifier
     **/
    var $tdNum;
    /** The $oldReceiptNum attribute. This attribute indicates the previous receipt number
     ** @type string
     **/
    var $oldReceiptNum;
    
    function Collection(){
    }
    /**  The setPayments method. This method sets the payments associated
     **  with the collection.
     **  @public
     **  @returns void
     **/
    function setPayments($paymentsList){
    }
    function getPayments(){
    }
    /**  The setDate method. This method sets the date indicated when collection
     **  was made. Also this is the date on the Official Receipt.
     **  @public
     **  @returns void
     **/
    function setDate($collectionDate){
    }
    function getDate(){
    }
    /**  The setSum method. This method sets the sum of the payments collected.
     **  @public
     **  @returns void
     **/
    function setSum($currencyValue){
    }
    function getSum(){
    }
    /**  The setReceipt method. This method sets the receiptNum and indicates that
     **  the collection is final and uneditable.
     **  @public
     **  @returns void
     **/
    function setReceiptNum($serialNum){
    }
    function getReceiptNum(){
    }
    /**  The setReceivedFrom method. This method sets the name of the Payee indicated
     **  as received from on the receipt.
     **  @public
     **  @returns void
     **/
    function setReceivedFrom($payeeName){
    }
    function getReceivedFrom(){
    }
    /**  The set method. This method sets the kind of payment made whether 'check'
     **  'cash', or treasury note.
     **  @public
     **  @returns void
     **/
    function setKindOfPayment($paymentkind){
    }
    function getKindOfPayment(){
    }
    /**  The set CheckNum method. This method sets the number on the check payment
     **  should only be set if $kindOfPayment == 'check';
     **  @public
     **  @returns void
     **/
    function setCheckNum($serialNum){
    }
    function getCheckNum(){
    }
    /**  The setCheckDate method. This method sets the date on the check payment
     **  should only be set if $kindOfPayment == 'check';
     **  @public
     **  @returns void
     **/
    function setCheckDate($aDate){
    }
    function getCheckDate(){
    }
    /**  The setOldReceiptDate method. This method sets the date indicating the
     **  date on the last receipt issued to this owner.
     **  @public
     **  @returns void
     **/
    function setOldReceiptDate($oldDate){
    }
    function getOldReceiptDate(){
    }
    /**  The setOldReceiptNum method. This method sets the number indicating the
     **  serial number on the last receipt issued to this owner.
     **  @public
     **  @returns void
     **/
    function setOldReceiptNum($oldNum){
    }
    function getOldReceiptNum(){
    }
    /**  The setMunicipality method. This method sets the identifier to which
     **  municipality the collection is being made.
     **  @public
     **  @returns void
     **/
    function setMunicipality(){
    }
    function getMunicipality(){
    }
    function store(){
          //create a DB object
          $rptsDB = new DB_RTPS;
          //if isStoredInDatabase then update
          if($this->isStoredInDatabase){
              if (update()){
                 $this->payments->storeByCollection($this->collectionID);
                 return true;
              }
              else{
                  return false;
              }
          }
          else{
          // else use an insert statement
          // prepare SQL statement
          $sqlinsert="INSERT INTO collections
                      SET collectionDate=$this->date,
                          collectionSum = $this->sum,
                          receiptNum = $this->receiptNum,
                          receivedFrom = $this->receivedFrom,
                          kindOfPayment = $this->kindOfPayment,
                          checkNum = $this->checkNum,
                          checkDate = $this->checkDate,
                          oldReceiptNum = $this->oldReceiptNum,
                          oldReceiptDate = $this->oldReciptDate,
                          municipality = $this->municipality";
          $queryID = $rptsDB->query($sqlinsert);
          if($queryID){
              $this->collectionID = $rptsDB->insert_id();
              // store the payments
              $this->payments->storeByCollection($this->collectionID);
              return true;
          }
          else{
              return false;
          }
    }
    
    function delete(){
          //create a db object
          $rptsDB = new DB_RTPS;
          //prepare an SQL delete statement
          // first delete the payments
          $sqldelete = "DELETE from PAYMENTS
                        where paymentID in (select paymentID
                                            from collectionPayments
                                            where collectionID=$this->collectionID)";
          $queryID = $rptsDB->query($sqldelete);
          // delete the collectionPayments entries
          $sqldelete = "DELETE from CollectionPayments
                        where collectionID=$this->collectionID";
          $queryID = $rptsDB->query($sqldelete);
          // then delete the collection
          $sqldelete = "DELETE FROM collections WHERE collectionID = $this->collectionID";
          //query the database
          $queryID = $rptsDB->query($sqldelete);
          if($queryID){
              return true;
          }
          else {
              return false
          }
          
    }
    function update(){
          //create a DB object
          $rptsDB = new DB_RTPS;
          //prepare an SQL update statement
          $sqlupdate = "UPDATE collections
                        set collectionDate = $this->collectionDate,
                            collectionSum = $this->sum,
                            receiptNum = $this->receiptNum,
                            receivedFrom = $this->receviedFrom,
                            kindOfPayment = $this->kindOfPayment,
                            checkNum = $this->checkNum,
                            checkDate = $this->checkDate,
                            oldReceiptNum = $this->oldReceiptNum,
                            oldReceptDate = $this->oldReceiptDate
                        WHERE collectionID = $collectionID ;";
          //query the database
          $queryID = $rptsDB->query($sqlupdate);
          if($queryID){
              $this->payments->storeByCollection($this->collectionID);
              return true;
          }
          else {
              return false;
          }
    }
    function create($collectionID){
          //create a DB object
          $rptsDB = new DB_RTPS;
          //prepare an SQL select statement
          $sqlselect = "SELECT collectionDate, collectionSum, receiptNum, receivedFrom, kindOfPayment, checkNum, CheckDate,
		  				oldReceiptNum, oldReceiptDate,municipality FROM collections where collectionID = $collectionID";
          //query the database
          $rptsDB->query($sqlselect);
          if($rptsDB->next_record()){
              $this->collectionID = $collectionID;
              setSum($rptsDB->f("collectionSum"));
              setReceiptNum($rptsDB->f("receiptNum"));
              setReceivedFrom($rptsDB->f("receivedFrom"));
              setKindOfPayment($rptsDB->f("kindOfPayment"));
              if(getKindOfPayment() == "check"){
                  setCheckNum($rptsDB->f("checkNum"));
                  setCheckDate($rptsDB->f("checkDate"));
              }
              setOldReceiptNum($rptsDB->f("oldReceiptNum"));
              setMunicipality($rptsDB->f("municipality"));
              $this->payments = PaymentsList::createByCollection($collectionID);
          }
          else {
              return false;
          }

    }
}

?>

