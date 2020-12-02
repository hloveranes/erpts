<?php
	$f = fopen('mobile.txt','a');
	fwrite($f, $_REQUEST['sender']."\t".$_REQUEST['rptop']."\n");
	fclose($f);
	//echo $_REQUEST['sender'].' '.$_REQUEST['rptop']

	$db = mysql_connect("localhost","root","nesvita");
	$sql = "select rptopID, taxableYear from RPTOP where rptopNumber like '".$_REQUEST['rptop']."'";
	mysql_select_db("erpts_standard",$db);
	$rptops = mysql_query($sql,$db);
	$totaldues = 0;
	$totalpaid = 0;
	if ($rptop = mysql_fetch_assoc($rptops)) {
		$sql = "select tdID from RPTOPTD where rptopID = ".$rptop["rptopOD"];
		$rptoptds = mysql_query($sql,$db);
		while ($rptoptd = mysql_fetch_assoc($rptoptds)) {
			$sql = "select dueID, basicTax, sefTax from Due where tdID = ".$rptoptd["tdID"].
				   " and dueType like 'Q%' and year(dueDate) = ".date("Y");
			$dues = mysql_query($sql,$db);
			while ($due = mysql_fetch_assoc($dues)) {
				$totaldues += $due["basicTax"] + $due["sefTax"];

				$sql = "select amountPaid from Payment where dueID = ".$due["dueID"];
				$payments = mysql_query($sql,$db);
				while ($payment = mysql_fetch_assoc($payments)) {
					$totapaid += $due["basicTax"] + $due["sefTax"];

				}
				mysql_free_result($payments);
			}
			mysql_free_result($dues);
		}
		mysql_free_result($rptoptds);
	}
	mysql_free_result($rptops);
	mysql_close($db);
?>