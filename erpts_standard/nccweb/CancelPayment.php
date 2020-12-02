<?php
include_once "../includes/web/prepend.php";
include_once "../includes/collection/Collections.php";
include_once "../includes/collection/dues.php";

class CancelPayment {
    var $tpl;
	var $formArray;
    
    function CancelPayment($input){
        $this->tpl = new Template(getcwd());

		$this->formArray = array();
		foreach ($input as $key=>$value) {
			$this->formArray[$key] = $value;
		}
    }

    function main(){
		ini_set("error_reporting","E_ALL");
		ini_set("display_errors","1");

		$this->startTemplate();

		if ($this->formArray[isSubmit]==1) $this->execute();
		$this->endTemplate();
    } //main()

	function startTemplate() {
		global $sess;
		
        $this->tpl->set_file(cancel,"CancelPayment.htm");
		$this->tpl->set_var("Session", $sess->url(""));
        $this->tpl->set_var($_GET);
        $this->tpl->set_var($_POST);
	}
	
	function endTemplate() {
        $this->tpl->parse(OUT,"cancel");
        $this->tpl->finish(OUT);
        $this->tpl->p(OUT);
	}
	
	function execute() {
		$receiptNum = $this->formArray[receiptNum];
		echo("receiptNum=$receiptNum<br>");

		$collection = new Collections();
		$collectionID = $collection->selectWhereReceiptNum($receiptNum);

		$collection->cancelRecord();
		echo("collectionID=$collectionID<br>");
	}
} #end CancelPayment class

page_open(array("sess" => "rpts_Session",
				"auth" => "rpts_Challenge_Auth"
				//"perm" => "rpts_Perm"
));

$cancelObj = new CancelPayment($HTTP_POST_VARS);
$cancelObj->main();
page_close(); 
?>