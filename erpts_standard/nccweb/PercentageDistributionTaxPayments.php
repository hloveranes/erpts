<?
 Header('Content-Type: image/png');
 include_once "../includes/web/prepend.php";
 include_once "../includes/web/panachart.php";
 
 $db = new DB_RPTS;//DB_SelectLGU("erpts-test");
 $tmpdb = new DB_RPTS;//DB_SelectLGU("erpts-test");
 
$sql = "SELECT SUM( Collection.amountPaid )  AS amountPaid, Payment.paymentID AS paymentID, TD.tdID, description".
		" FROM Collection".
		" INNER  JOIN Payment ON Payment.paymentID = Collection.paymentID".
		" INNER  JOIN TD".
		" USING ( tdID )".
		" INNER  JOIN AFS".
		" USING ( afsID )".
		" INNER  JOIN Location".
		" USING ( odID )".
		" INNER  JOIN LocationAddress".
		" USING ( locationAddressID )".
		" INNER  JOIN Barangay".
		" USING ( barangayID )".
		" WHERE Collection.status !=  'cancelled' AND Payment.tdID != 0".
		" GROUP  BY Barangay.barangayID";
//echo $sql;
$db->query($sql);
for($i=0;$db->next_record();$i++){
	$amount[$db->f("description")] = $db->f("amountPaid");
	//echo $db->f("amountPaid")."<br>";
}

//td=0
$sql2 = "SELECT SUM( Collection.amountPaid )  AS amountPaid, Payment.paymentID AS paymentID, TD.tdID, description".
		" FROM Collection".
		" INNER  JOIN Payment ON Payment.paymentID = Collection.paymentID".
		" INNER  JOIN BacktaxTD".
		" USING ( backtaxTDID )".
		" INNER JOIN TD".
		" USING (tdID)".
		" INNER  JOIN AFS".
		" USING ( afsID )".
		" INNER  JOIN Location".
		" USING ( odID )".
		" INNER  JOIN LocationAddress".
		" USING ( locationAddressID )".
		" INNER  JOIN Barangay".
		" USING ( barangayID )".
		" WHERE Collection.status !=  'cancelled' AND Payment.tdID = 0".
		" GROUP  BY Barangay.barangayID";
//echo "<br>".$sql2;	
$db->query($sql2);
//print_r($db);
for($i=0;$db->next_record();$i++){
	$amount2[$db->f("description")] = $db->f("amountPaid");
	//echo $db->f("amountPaid")."<br>";
}

//$arr = array_values(array_intersect($desc1,$desc2));
$newArr = array_merge($amount,$amount2);
var_dump($newArr);
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

for($i=0;$i<count($am);$i++){
	$percentage[$i] =  ($am[$i]/$total) * 100;
	
}

	$ochart = new chart(600,320,5, '#eeeeee'); //chart($width, $height, $margin, $backgroundColor)
    $ochart->setTitle('Percentage Distribution of Properties (Tax Payment)','#000000',2); //setTitle($title, $textColor, $font)
    $ochart->setPlotArea(SOLID,'#444444', '#dddddd'); //setPlotArea($style, $strokeColor, $fillColor)
    $ochart->setFormat(0,',','.');    //setFormat($numberOfDecimals, $thousandsSeparator, $decimalSeparator)
    $ochart->setXAxis('#000000', SOLID, 1, 'Barangay'); //setXAxis($color, $style, $font, $title)
    $ochart->setYAxis('#000000', SOLID, 2, 'Tax Payment'); //setYAxis($color, $style, $font, $title)
    $ochart->setLabels($bar, '#000000', 1, VERTICAL); //setLabels(&$labels, $textColor, $font, $direction)
    $ochart->setGrid('#bbbbbb', DASHED, '#bbbbbb', DOTTED);   //setGrid($colorHorizontal, $styleHorizontal, $colorVertical, $styleVertical)     
    $ochart->addSeries($percentage,'bar','', SOLID,'#000000', '#0000ff'); //addSeries(&$values, $plotType, $title, $style, $strokeColor, $fillColor)   
    $ochart->plot('graphs/2.png');      //plot($file)   */
	
	$ochart = new chart(600,320,5, '#eeeeee'); //chart($width, $height, $margin, $backgroundColor)
    $ochart->setTitle(' Distribution of Properties (Tax Payment)','#000000',2); //setTitle($title, $textColor, $font)
    $ochart->setPlotArea(SOLID,'#444444', '#dddddd'); //setPlotArea($style, $strokeColor, $fillColor)
    $ochart->setFormat(0,',','.');    //setFormat($numberOfDecimals, $thousandsSeparator, $decimalSeparator)
    $ochart->setXAxis('#000000', SOLID, 1, 'Barangay'); //setXAxis($color, $style, $font, $title)
    $ochart->setYAxis('#000000', SOLID, 2, 'Tax Payment'); //setYAxis($color, $style, $font, $title)
    $ochart->setLabels($bar, '#000000', 1, VERTICAL); //setLabels(&$labels, $textColor, $font, $direction)
    $ochart->setGrid('#bbbbbb', DASHED, '#bbbbbb', DOTTED);   //setGrid($colorHorizontal, $styleHorizontal, $colorVertical, $styleVertical)     
    $ochart->addSeries($am,'bar','', SOLID,'#000000', '#0000ff'); //addSeries(&$values, $plotType, $title, $style, $strokeColor, $fillColor)   
	 $ochart->plot('graphs/3.png');      //plot($file)   */
	
	$out = fopen("viewGraphs.php", "w");
//	fwrite($out,"<a href='t.php'>Back</a><br>");
    fwrite($out, "<table cellspacing=5 cellpadding=4 border=0 align='center'>");
    for($i=2; $i<=3; $i++){ 
        $sout.='<tr><td><img border=0 src="graphs/'.$i.'.png"></td></tr>';
    }
    fwrite($out, "$sout\n");
    fwrite($out, '</table>');
    fclose($out);
?>
<script language="JavaScript">
	window.location="viewGraphs.php";
</script>