<?
include_once "./prepend.php";
 include_once './panachart.php';

$tpl=new rpts_Template();
$tpl->set_file(array(report=>"Form.htm"));

$db = new DB_SelectLGU("erpts-test");
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

  
 $db = new DB_SelectLGU("erpts-test");

if($brgyID==0)
 $sql ="SELECT ".ucwords($classification)."ActualUses.code as description, sum( ".ucwords($classification).".marketValue ) as total
		FROM AFS
		INNER JOIN ".ucwords($classification)."
		USING ( afsID ) 
		INNER  JOIN ".ucwords($classification)."ActualUses ON ".ucwords($classification).".actualUse = ".ucwords($classification)."ActualUses.".$classification."ActualUsesID
		GROUP  BY ( ".$classification."ActualUsesID )";
else
 $sql ="SELECT ".ucwords($classification)."ActualUses.code as description, sum(  ".ucwords($classification).".marketValue ) as total 
		FROM AFS
		INNER  JOIN ".ucwords($classification)."
		USING ( afsID ) 
		INNER  JOIN ".ucwords($classification)."ActualUses ON ".ucwords($classification).".actualUse = ".ucwords($classification)."ActualUses.".$classification."ActualUsesID
		LEFT  JOIN Location ON AFS.odID = Location.odID
	   	LEFT  JOIN LocationAddress ON Location.locationAddressID = LocationAddress.locationAddressID
	   	LEFT  JOIN Barangay ON LocationAddress.barangayID = Barangay.barangayID
	   	WHERE AFS.archive !=  'true' AND Barangay.barangayID = $brgyID
		GROUP  BY ( ".$classification."ActualUsesID )";

$db->query($sql);
if($db->num_rows() >0){
	for($i=0;$db->next_record();$i++){
		$total +=  $db->f("total");
		$t[$i] = $db->f("total");
		$barangay[$i] = $db->f("description");
	}	
}
/*for($i=0;$i<count($t);$i++){
	$percentage[$i] =  ($t[$i]/$total) * 100;
	
}*/

    
    //$vCht4 = array(1,20,20,34,5,52,41,20,34,43,64,40);
   // $vCht5 = array(12,21,36,27,14,23,3,5,29,23,12,5);
   // $vCht6 = array(5,7,3,15,7,8,2,2,2,11,22,3);
   // $vLabels = array('Jan','Feb','Mar','Apr','May','Jun','Jul'
    //,'Aug','Sep','Oct','Nov','Dec');
  if(is_array($barangay)){ 
   $ochart = new chart(400,250,5, '#eeeeee'); //chart($width, $height, $margin, $backgroundColor)
    $ochart->setTitle('Statistics on Property Locations (By Classification: Market Value)','#000000',2); //setTitle($title, $textColor, $font)
    $ochart->setPlotArea(SOLID,'#444444', '#dddddd'); //setPlotArea($style, $strokeColor, $fillColor)
    $ochart->setFormat(0,',','.');    //setFormat($numberOfDecimals, $thousandsSeparator, $decimalSeparator)
    $ochart->setXAxis('#000000', SOLID, 1, 'Classification'); //setXAxis($color, $style, $font, $title)
    $ochart->setYAxis('#000000', SOLID, 2, 'Amount'); //setYAxis($color, $style, $font, $title)
    $ochart->setGrid('#bbbbbb', DASHED, '#bbbbbb', DOTTED);   //setGrid($colorHorizontal, $styleHorizontal, $colorVertical, $styleVertical)     
	$ochart->setLabels($barangay, '#000000', 1, VERTICAL); //setLabels(&$labels, $textColor, $font, $direction)	
    $ochart->addSeries($t,'bar','', SOLID,'#000000', '#0000ff'); //addSeries(&$values, $plotType, $title, $style, $strokeColor, $fillColor)   
    $ochart->plot('graphs/'.$brgyID.''.$classification.'img.png');      //plot($file)   
	
	$out = fopen("viewGraphs.php", "w");
	//fwrite($out,"<a href='t.php'>Back</a><br>");
    fwrite($out, "<table cellspacing=5 cellpadding=4 border=0 align='center'>");
	
  //  for($i=4; $i<=4; $i++){ 
        $sout.='<tr><td><img border=0 src="graphs/'.$brgyID.''.$classification.'img.png"></td></tr>';
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