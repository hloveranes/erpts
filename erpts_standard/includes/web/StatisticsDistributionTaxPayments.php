<?

 Header('Content-Type: image/png');
 include_once "./prepend.php";
 include_once('web/panachart.php');
 
 $tpl=new rpts_Template();
 $tpl->set_file(array(report=>"Form.htm"));

 $db = new DB_RPTS;//DB_SelectLGU("erpts-test");
// $tmpdb = new DB_SelectLGU("erpts-test");
 
 $db->query("SELECT * FROM Barangay ORDER BY description");
 $tpl->set_block(report,BRGY,bBlk);
 if($db->num_rows()>0){
	for($r=0;$db->next_record();$r++){
		$tpl->set_var(barangayID,$db->f("barangayID"));
		$tpl->set_var(barangayName,$db->f("description"));
		$tpl->parse(bBlk,BRGY,true);
	}
 }
$tpl->set_var(fileName,$PHP_SELF);

 if($isSubmit){
 
 if($brgyID==0){
 
$sql = "SELECT SUM( Collection.amountPaid )  AS amountPaid, Payment.paymentID AS paymentID, TD.tdID, ".ucwords($classification)."ActualUses.code as description
		FROM Collection
		INNER  JOIN Payment ON Payment.paymentID = Collection.paymentID
		INNER  JOIN TD
		USING ( tdID ) 
		INNER  JOIN AFS
		USING ( afsID ) 
		INNER  JOIN ".ucwords($classification)."
		USING ( afsID ) 
		INNER  JOIN ".ucwords($classification)."ActualUses ON ".ucwords($classification).".actualUse = ".ucwords($classification)."ActualUses.".$classification."ActualUsesID 
		WHERE Collection.status !=  'cancelled' AND Payment.tdID != 0
		GROUP  BY ( ".$classification."ActualUsesID )";
$db->query($sql);
for($i=0;$db->next_record();$i++){
$amount[$db->f("description")] = $db->f("amountPaid");
}

//td=0
$sql2 = "SELECT SUM( Collection.amountPaid )  AS amountPaid, Payment.paymentID AS paymentID, TD.tdID, ".ucwords($classification)."ActualUses.code as description
		FROM Collection
		INNER  JOIN Payment ON Payment.paymentID = Collection.paymentID
		INNER  JOIN BacktaxTD
		USING ( backtaxTDID ) 
		INNER JOIN TD
		USING (tdID)
		INNER  JOIN AFS
		USING ( afsID ) 
		INNER  JOIN ".ucwords($classification)."
		USING ( afsID ) 
		INNER  JOIN ".ucwords($classification)."ActualUses ON ".ucwords($classification).".actualUse = ".ucwords($classification)."ActualUses.".$classification."ActualUsesID
		WHERE Collection.status !=  'cancelled' AND Payment.tdID = 0
		GROUP  BY ( ".$classification."ActualUsesID )";
		
$db->query($sql2);
for($i=0;$db->next_record();$i++){
$amount2[$db->f("description")] = $db->f("amountPaid");
}
}else{
//start
$sql = "SELECT SUM( Collection.amountPaid )  AS amountPaid, Payment.paymentID AS paymentID, TD.tdID, ".ucwords($classification)."ActualUses.code as description
		FROM Collection
		INNER  JOIN Payment ON Payment.paymentID = Collection.paymentID
		INNER  JOIN TD
		USING ( tdID ) 
		INNER  JOIN AFS
		USING ( afsID ) 
		INNER  JOIN ".ucwords($classification)."
		USING ( afsID ) 
		INNER  JOIN ".ucwords($classification)."ActualUses ON ".ucwords($classification).".actualUse = ".ucwords($classification)."ActualUses.".$classification."ActualUsesID 
		INNER  JOIN Location
		ON AFS.odID = Location.odID
		INNER  JOIN LocationAddress
		USING ( locationAddressID ) 
		INNER  JOIN Barangay
		USING ( barangayID ) 
		WHERE Collection.status !=  'cancelled' AND Payment.tdID != 0 AND Barangay.barangayID = $brgyID
		GROUP  BY ( ".$classification."ActualUsesID )";
		
$db->query($sql);
for($i=0;$db->next_record();$i++){
$amount[$db->f("description")] = $db->f("amountPaid");
}

//td=0
$sql2 = "SELECT SUM( Collection.amountPaid )  AS amountPaid, Payment.paymentID AS paymentID, TD.tdID, ".ucwords($classification)."ActualUses.code as description
		FROM Collection
		INNER  JOIN Payment ON Payment.paymentID = Collection.paymentID
		INNER  JOIN BacktaxTD
		USING ( backtaxTDID ) 
		INNER JOIN TD
		USING (tdID)
		INNER  JOIN AFS
		USING ( afsID ) 
		INNER  JOIN ".ucwords($classification)."
		USING ( afsID ) 
		INNER  JOIN ".ucwords($classification)."ActualUses ON ".ucwords($classification).".actualUse = ".ucwords($classification)."ActualUses.".$classification."ActualUsesID
		INNER  JOIN Location
		ON AFS.odID = Location.odID
		INNER  JOIN LocationAddress
		USING ( locationAddressID ) 
		INNER  JOIN Barangay
		USING ( barangayID ) 
		WHERE Collection.status !=  'cancelled' AND Payment.tdID = 0 AND Barangay.barangayID = $brgyID
		GROUP  BY ( ".$classification."ActualUsesID )";

$db->query($sql2);
for($i=0;$db->next_record();$i++){
$amount2[$db->f("description")] = $db->f("amountPaid");
}
//end else

}

$newArr = array_merge_recursive($amount,$amount2);
//print_r($newArr);
$i=0;
foreach($newArr as $key=>$val){
	$bar[$i] = $key;
	 if(is_array($val)) {
	 	foreach($val as $k=>$v){
			$n += $v;
		}
		$am[$i] = $n ;
	 }else{
	 	$am[$i] = $val;
	 }
	 $total +=  $am[$i];
	$i++;
}

/*for($i=0;$i<count($am);$i++){
	$percentage[$i] =  ($am[$i]/$total) * 100;
	
}*/
	if(is_array($bar)){
		$ochart = new chart(400,250,5, '#eeeeee'); //chart($width, $height, $margin, $backgroundColor)
    	$ochart->setTitle('Statistics on Property Locations (By Classification: Tax Payment)','#000000',2); //setTitle($title, $textColor, $font)
    	$ochart->setPlotArea(SOLID,'#444444', '#dddddd'); //setPlotArea($style, $strokeColor, $fillColor)
    	$ochart->setFormat(0,',','.');    //setFormat($numberOfDecimals, $thousandsSeparator, $decimalSeparator)
    	$ochart->setXAxis('#000000', SOLID, 1, 'Classification'); //setXAxis($color, $style, $font, $title)
    	$ochart->setYAxis('#000000', SOLID, 2, 'Tax Payment'); //setYAxis($color, $style, $font, $title)
    	$ochart->setGrid('#bbbbbb', DASHED, '#bbbbbb', DOTTED);   //setGrid($colorHorizontal, $styleHorizontal, $colorVertical, $styleVertical)     
	
	    $ochart->setLabels($bar, '#000000', 1, VERTICAL); //setLabels(&$labels, $textColor, $font, $direction)
		$ochart->addSeries($am,'bar','', SOLID,'#000000', '#0000ff'); //addSeries(&$values, $plotType, $title, $style, $strokeColor, $fillColor)   
	//    $ochart->plot('');      //plot($file)   */
		 $ochart->plot('graphs/'.$brgyID.''.$classification.'imgTP.png'); 
		 $out = fopen("viewGraphs.php", "w");
	//fwrite($out,"<a href='t.php'>Back</a><br>");
    fwrite($out, "<table cellspacing=5 cellpadding=4 border=0 align='center'>");
	
  //  for($i=4; $i<=4; $i++){ 
        $sout.='<tr><td><img border=0 src="graphs/'.$brgyID.''.$classification.'imgTP.png"></td></tr>';
    //}
    fwrite($out, "$sout\n");
    fwrite($out, '</table>');
    fclose($out);
	}else{
	$out = fopen("viewGraphs.php", "w");
	fwrite($out,"<center>Error: Empty Values.Cannot generate graphs.<br></center>");
    fclose($out);
	}
?>
<script language="JavaScript">
	window.location="viewGraphs.php";
</script>
<?
}
else

$tpl->pparse(report,report);
?>