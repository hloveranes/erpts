<?
// SMS functions
include("config.inc");
include("functions.inc");

include_once "../includes/web/prepend.php";
include_once "../includes/assessor/Outbox.php";
include_once "../includes/assessor/OutboxRecords.php";

class SendMessage{
	function SendMessage($sess,$http_post_vars){
		global $auth;

		$this->sess = $sess;
		$this->user = $auth->auth;
		$this->formArray["uid"] = $this->user["uid"];
		$this->user = $auth->auth;

		$this->formArray = array(
			"ownerType" => ""
			,"id" => ""
			,"telephone" => ""
			,"mobileNumber" => ""
			,"email" => ""
			,"messageType" => ""
			,"sendTo" => ""
			,"message" => ""
		);

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	function Main(){
		//$messageSent = false;
		switch($this->formArray["messageType"]){
			case "email":
				$erptsSubject = "erpts mail";
				$messageSent = mail($this->formArray["sendTo"], $erptsSubject, $this->formArray["message"]);
				break;
			case "sms":
				$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".GLOBAL_SENDER."&to=".$this->formArray["sendTo"]."&text=".urlencode($this->formArray["message"]);
				$messageSent = http_send($URL,SENDSMS_PORT);
				break;
			case "fax":
				echo "duno how to send out a fax message. sorry :P";
				break;
			default:
				exit("Cannot send unknown message type. <a href='OwnerDetails.php".$this->sess->url("")."&ownerType=".$this->formArray["ownerType"]."&id=".$this->formArray["id"]."'>Click here</a> to go back.");
		}

		if($messageSent){
			echo("Message Sent! <a href='OwnerDetails.php".$this->sess->url("")."&ownerType=".$this->formArray["ownerType"]."&id=".$this->formArray["id"]."'>Click here</a> to go back.");
			$this->formArray["status"] = "sent";
		}
		else{
			echo("Your message failed to send. <a href='OwnerDetails.php".$this->sess->url("")."&ownerType=".$this->formArray["ownerType"]."&id=".$this->formArray["id"]."'>Click here</a> to go back");
			$this->formArray["status"] = "failed";
		}

		$outbox = new Outbox;
		$outbox->setOwnerType($this->formArray["ownerType"]);
		$outbox->setPersonCompanyID($this->formArray["id"]);
		$outbox->setMessageType($this->formArray["messageType"]);
		$outbox->setSendTo($this->formArray["sendTo"]);
		$outbox->setMessage($this->formArray["message"]);
		$outbox->setCreatedBy($this->user["uid"]);
		$outbox->setDateCreated(time());
		$outbox->setStatus($this->formArray["status"]);
		$outboxID = $outbox->insertRecord();

		exit;
	}
}

page_open(array("sess" => "rpts_Session"
	,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));

$sendMessage = new SendMessage($sess,$HTTP_POST_VARS);
$sendMessage->Main();

?>