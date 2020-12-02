<?php
include_once "../includes/web/prepend.php";
include_once "../includes/collection/dues.php";
include_once "../includes/collection/Collections.php";

class PurgePayment {
    
    function PurgePayment(){
    }

    function main(){
		ini_set("error_reporting","E_ALL");
		ini_set("display_errors","1");

		$this->execute();
    } //main()

	function execute() {
		$collection = new Collections();
		if ($collection->purge()) echo("Purge successfully completed.<br>");
		else echo("Purge errors were encountered.<br>");
	}
} #end CancelPayment class

page_open(array("sess" => "rpts_Session",
				"auth" => "rpts_Challenge_Auth"
				//"perm" => "rpts_Perm"
));

$purgeObj = new PurgePayment();
$purgeObj->main();
page_close(); 
?>