<?
 Header('Content-Type: image/png');
 include_once "./prepend.php";
 include_once './panachart.php';

//$f=1;
 $db = new DB_RPTS;
// $db1 = new DB_RPTS;
 
// $db1->query("SELECT * FROM")

 $sql ="SELECT sum(AFS.totalMarketValue) as total , Barangay. description as description
       FROM AFS
	   LEFT  JOIN Location ON AFS.odID = Location.odID
	   LEFT  JOIN LocationAddress ON Location.locationAddressID = LocationAddress.locationAddressID
	   LEFT  JOIN Barangay ON LocationAddress.barangayID = Barangay.barangayID
	   WHERE AFS.archive !=  'true' 
	   GROUP  BY Barangay.barangayID ORDER BY Barangay.description;";
	   
$db->query($sql);
for($i=0;$db->next_record();$i++){
	$total +=  $db->f("total");
	$t[$i] = $db->f("total");
	$barangay[$i] = $db->f("description");
}
for($i=0;$i<count($t);$i++){
	$percentage[$i] =  ($t[$i]/$total) * 100;
	
} 
    
    $ochart = new chart(600,320,5, '#eeeeee'); //chart($width, $height, $margin, $backgroundColor)
    $ochart->setTitle('Percentage Distribution of Properties (Market Values)','#000000',2); //setTitle($title, $textColor, $font)
    $ochart->setPlotArea(SOLID,'#444444', '#dddddd'); //setPlotArea($style, $strokeColor, $fillColor)
    $ochart->setFormat(0,',','.');    //setFormat($numberOfDecimals, $thousandsSeparator, $decimalSeparator)
    $ochart->setXAxis('#000000', SOLID, 2, 'Barangay'); //setXAxis($color, $style, $font, $title)
    $ochart->setYAxis('#000000', SOLID, 2, 'Percentage Distribution (Market Values)'); //setYAxis($color, $style, $font, $title)
    $ochart->setLabels($barangay, '#000000', 1, VERTICAL); //setLabels(&$labels, $textColor, $font, $direction)
    $ochart->setGrid('#bbbbbb', DASHED, '#bbbbbb', DOTTED);   //setGrid($colorHorizontal, $styleHorizontal, $colorVertical, $styleVertical)     
    $ochart->addSeries($percentage,'bar','series1', SOLID,'#000000', '#0000ff'); //addSeries(&$values, $plotType, $title, $style, $strokeColor, $fillColor)   
	//$ochart->addSeries($t,'bar','series2', SOLID,'#000000', '#eeeeee'); //addSeries(&$values, $plotType, $title, $style, $strokeColor, $fillColor)   	
    $ochart->plot('graphs/0.png');      //plot($file)
	
	$ochart = new chart(600,320,5, '#eeeeee'); //chart($width, $height, $margin, $backgroundColor)
    $ochart->setTitle('Distribution of Properties (Market Values)','#000000',2); //setTitle($title, $textColor, $font)
    $ochart->setPlotArea(SOLID,'#444444', '#dddddd'); //setPlotArea($style, $strokeColor, $fillColor)
    $ochart->setFormat(0,',','.');    //setFormat($numberOfDecimals, $thousandsSeparator, $decimalSeparator)
    $ochart->setXAxis('#000000', SOLID, 2, 'Barangay'); //setXAxis($color, $style, $font, $title)
    $ochart->setYAxis('#000000', SOLID, 2, 'Distribution (Market Values)'); //setYAxis($color, $style, $font, $title)
    $ochart->setLabels($barangay, '#000000', 1, VERTICAL); //setLabels(&$labels, $textColor, $font, $direction)
    $ochart->setGrid('#bbbbbb', DASHED, '#bbbbbb', DOTTED);   //setGrid($colorHorizontal, $styleHorizontal, $colorVertical, $styleVertical)     
    $ochart->addSeries($t,'bar','series1', SOLID,'#000000', '#0000ff'); //addSeries(&$values, $plotType, $title, $style, $strokeColor, $fillColor)   
    $ochart->plot('graphs/1.png');      //plot($file)
	
	$out = fopen("viewGraphs.php", "w");
	//fwrite($out,"<a href='t.php'>Back</a><br>");
    fwrite($out, "<table cellspacing=5 cellpadding=4 border=0 align='center'>");
    for($i=0; $i<=1; $i++){ 
        $sout.='<tr><td><img border=0 src="graphs/'.$i.'.png"></td></tr>';
    }
    fwrite($out, "$sout\n");
    fwrite($out, '</table>');
    fclose($out);

?>
<script language="JavaScript">
	window.location="viewGraphs.php";
</script>