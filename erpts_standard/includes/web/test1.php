<?php
   include_once "./panachart.php";
    
    $k=0;
    
    $vCht4 = array(60,40,20,34,26,52,41,20,34,43,64,40);
    $vCht5 = array(12,21,12,27,14,23,21,5,29,23,12,29);
    $vCht6 = array(5,7,3,15,7,8,2,2,2,11,22,3);    
    $vLabels = array('Jan','Feb','Mar','Apr','May','Jun','Jul'
    ,'Aug','Sep','Oct','Nov','Dec');
        

    // AREA
    $iTime = microtime();
    $ochart = new chart(300,130,7, '#eeeeee');
    $ochart->setTitle("Area","#000000",3);
    $ochart->setPlotArea(SOLID,"#000000", '#ddddee');
    $ochart->setFormat(0,',','.');
    $ochart->addSeries($vCht4,'area','Series1', SOLID,'#000000', '#8888ff');
    $ochart->setXAxis('#000000', SOLID, 1, "");
    $ochart->setYAxis('#000000', SOLID, 1, "");
    $ochart->setLabels($vLabels, '#000000', 1, HORIZONTAL);
    $ochart->setGrid("#bbbbbb", DOTTED, "#bbbbbb", DOTTED);
    $ochart->plot("$k.png");    
    $vTime[$k] = microtime() - $iTime;
    
    // AREAS LINES
   $iTime = microtime(); $k++;
    $ochart1 = new chart(300,130,7, '#eeeeee');
    $ochart1->setTitle("Area & line","#000000",2);
    $ochart1->setPlotArea(SOLID,"#000000", '#ddeedd');
    $ochart1->setFormat(0,',','.');
    $ochart1->addSeries($vCht5,'area','Series1', SOLID,'#000000', '#ffffaa');
    $ochart1->addSeries($vCht6,'area','Series2', SOLID,'#000000', '#ffaaaa');
    $ochart1->addSeries($vCht4,'line','Series3', DASHED,'#000000', '#0000ff');
    $ochart1->addSeries($vCht4,'dot','Series4', SOLID,'#000000', '#0000ff');
    $ochart1->setXAxis('#000000', SOLID, 1, "");
    $ochart1->setYAxis('#000000', SOLID, 1, "");
    $ochart1->setLabels($vLabels, '#000000', 1, HORIZONTAL);
    $ochart1->setGrid("#bbbbbb", DOTTED, "#bbbbbb", DOTTED);
    $ochart1->plot("$k.png");    
    $vTime[$k] = microtime() - $iTime;
    
/*    // BAR
    $iTime = microtime(); $k++;
    $ochart = new chart(300,130,7, '#eeeeee');
    $ochart->setTitle("Bar plot","#000000",2);
    $ochart->setPlotArea(SOLID,"#aaaaaa", '#ffffff');
    $ochart->setFormat(0,',','.');
    $ochart->addSeries($vCht5,'bar','Series1', SOLID,'#444444', '#aa4444');
    $ochart->setXAxis('#000000', SOLID, 1, "");
    $ochart->setYAxis('#000000', SOLID, 1, "");
    $ochart->setLabels($vLabels, '#000000', 1, HORIZONTAL);
    $ochart->setGrid("#cccccc", DASHED, "", DOTTED);
    $ochart->plot("$k.png");    
    $vTime[$k] = microtime() - $iTime;
    
    // MULTIPLE BAR
    $iTime = microtime(); $k++;
    $ochart = new chart(300,130,7, '#ccdddd');
    $ochart->setTitle("Multiple bar plot","#000000",2);
    $ochart->setPlotArea(SOLID,"#aaaaaa", '#eeffff');
    $ochart->setFormat(0,',','.');
    $ochart->addSeries($vCht4,'bar','Series1', SOLID,'#444444', '#4444dd');
    $ochart->addSeries($vCht5,'bar','Series2', SOLID,'#444444', '#cc4444');
    $ochart->addSeries($vCht6,'bar','Series3', SOLID,'#444444', '#44dd44');
    $ochart->setXAxis('#000000', SOLID, 1, "");
    $ochart->setYAxis('#000000', SOLID, 1, "");
    $ochart->setLabels($vLabels, '#000000', 1, HORIZONTAL);
    $ochart->setGrid("#cccccc", SOLID, "", DOTTED);
    $ochart->plot("$k.png");        
    $vTime[$k] = microtime() - $iTime;

    // BAR LINE
    $iTime = microtime(); $k++;
    $ochart = new chart(300,130,7, '#000088');
    $ochart->setTitle("Bar & line","#ffffff",3);
    $ochart->setPlotArea(SOLID,"", '#000088');
    $ochart->setFormat(0,',','.');
    $ochart->addSeries($vCht5,'bar','Series1', SOLID,'#000000', '#bbbb00');
    $ochart->addSeries($vCht4,'line','Series2', LARGE_SOLID,'#ffffff', '#bbbb00');
    $ochart->setXAxis('#ffffff', SOLID, 1, "");
    $ochart->setYAxis('#ffffff', SOLID, 1, "");
    $ochart->setLabels($vLabels, '#ffffff', 1, HORIZONTAL);
    $ochart->setGrid("#7777bb", SOLID, "7777bb", DOTTED);
    $ochart->plot("$k.png");    
    $vTime[$k] = microtime() - $iTime;

    // STEP & DOT
    $iTime = microtime(); $k++;
    $ochart = new chart(300,130,7, '#eeeeee');
    $ochart->setTitle("Step & dot","#444444",3);
    $ochart->setPlotArea(SOLID,"444444", '#bbeeff');
    $ochart->setFormat(0,',','.');
    $ochart->addSeries($vCht4,'step','Series1', SOLID,'#000000', '#99ccff');
    $ochart->addSeries($vCht4,'dot','Series2', SOLID,'#0000ff', '#ffffff');
    $ochart->addSeries($vCht5,'step','Series3', DASHED,'#000000', '#66aadd');    
    $ochart->setXAxis('#444444', MEDIUM_SOLID, 1, "");
    $ochart->setYAxis('#444444', SOLID, 1, "");
    $ochart->setLabels($vLabels, '#444444', 1, HORIZONTAL);
    $ochart->setGrid("#7777bb", DOTTED, "#7777bb", DOTTED);
    $ochart->plot("$k.png");    
    $vTime[$k] = microtime() - $iTime;
    
    // LINE
    $iTime = microtime(); $k++;
    $ochart = new chart(300,130,5, '#eeeeee');
    $ochart->setTitle("Lines plot","#000000",2);
    $ochart->setPlotArea(SOLID,"#444444", '#dddddd');
    $ochart->setFormat(0,',','.');
    $ochart->addSeries($vCht4,'line','Series1', SOLID,'#ff0000', '#ffcccc');            
    $ochart->setXAxis('#000000', SOLID, 2, "");
    $ochart->setYAxis('#000000', SOLID, 2, "");
    $ochart->setLabels($vLabels, '#000000', 1, VERTICAL);
    $ochart->setGrid("#bbbbbb", DASHED, "#bbbbbb", DOTTED);    
    $ochart->setLabels($vLabels, '#000000',1, 0);
    $ochart->plot("$k.png");
    $vTime[$k] = microtime() - $iTime;
    
    // LINES & DOTS
    $iTime = microtime(); $k++;
    $ochart = new chart(300,130,5, '#ffffdd');
    $ochart->setTitle("Lines & dots","#000000",2);
    $ochart->setPlotArea(SOLID,"#444444", '#eeeedd');
    $ochart->setFormat(0,',','.');
    $ochart->addSeries($vCht4,'line','Series1', SOLID,'#00aa00', '#ccffcc');            
    $ochart->addSeries($vCht4,'dot','Series2', SOLID,'#00aa00', '#ccffcc');
    $ochart->setXAxis('#000000', SOLID, 1, "");
    $ochart->setYAxis('#000000', SOLID, 1, "Y axis");
    $ochart->setLabels($vLabels, '#000000', 1, VERTICAL);
    $ochart->setGrid("#bbbbbb", 0, "", DOTTED);
    $ochart->plot("$k.png");
    $vTime[$k] = microtime() - $iTime;
    
    // MULTIPLE LINES
    $iTime = microtime(); $k++;
    $ochart = new chart(300,130,5, '#ffdddd');
    $ochart->setTitle("Multiple line series","#000000",2);
    $ochart->setPlotArea(SOLID,"#444444", '#ddeeee');
    $ochart->setFormat(0,',','.');
    $ochart->addSeries($vCht4,'line','Series1', SOLID,'#00aa00', '#ccffcc');            
    $ochart->addSeries($vCht4,'dot','Series2', SOLID,'#00aa00', '#ccffcc');
    $ochart->addSeries($vCht5,'line','Series3', SOLID,'#0000aa', '#ccccff');
    $ochart->setXAxis('#000000', SOLID, 2, "");
    $ochart->setYAxis('#000000', SOLID, 2, "");
    $ochart->setLabels($vLabels, '#000000', 1, VERTICAL);
    $ochart->setGrid("#bbbbbb", DASHED, "#bbbbbb", DOTTED);    
    $ochart->setLabels($vLabels, '#000000',1, 0);
    $ochart->plot("$k.png");
    $vTime[$k] = microtime() - $iTime;
    
    // IMPULS
    $iTime = microtime(); $k++;
    $ochart = new chart(300,130,5, '#eeeeee');
    $ochart->setTitle("Impuls plot","#000000",2);
    $ochart->setPlotArea(SOLID,"#444444", '#dddddd');
    $ochart->setFormat(0,',','.');
    $ochart->addSeries($vCht4,'impuls','Series1', SOLID,'#000000', '#0000ff');
    $ochart->setXAxis('#000000', SOLID, 1, "X Axis");
    $ochart->setYAxis('#000000', SOLID, 1, "");
    $ochart->setLabels($vLabels, '#000000', 1, VERTICAL);
    $ochart->setGrid("#bbbbbb", DASHED, "#bbbbbb", DOTTED);
    $ochart->plot("$k.png");    
    $vTime[$k] = microtime() - $iTime;

    // IMPULS & DOTS
    $iTime = microtime(); $k++;
    $ochart = new chart(300,130,5, '#eeeeee');
    $ochart->setTitle("Impuls & dots plot","#0000ff",2);
    $ochart->setPlotArea(SOLID,"#444444", '#dddddd');
    $ochart->setFormat(0,',','.');
    $ochart->addSeries($vCht4,'impuls','Series1', SOLID,'#000000', '#0000ff');
    $ochart->addSeries($vCht4,'dot','Series2', SOLID,'#000000', '#0000ff');
    $ochart->setXAxis('#000000', SOLID, 1, "X Axis");
    $ochart->setYAxis('#000000', SOLID, 1, "");
    $ochart->setLabels($vLabels, '#000000', 1, VERTICAL);
    $ochart->setGrid("#bbbbbb", DOTTED, "", DOTTED);
    $ochart->plot("$k.png");    
    $vTime[$k] = microtime() - $iTime;
    
    // IMPULS LINE & DOTS
    $iTime = microtime(); $k++;
    $ochart = new chart(300,130,7, '#bbeebb');
    $ochart->setTitle("Impuls, line & dot","#004400",2);
    $ochart->setPlotArea(SOLID,"#888888", '#bbbbbb');
    $ochart->setFormat(0,',','.');
    $ochart->addSeries($vCht4,'impuls','Series1', SOLID,'#000000', '#ffff00');
    $ochart->addSeries($vCht4,'line','Series2', SOLID,'#ff0000', '#ffff00');
    $ochart->addSeries($vCht4,'dot','Series3', SOLID,'#ff0000', '#ffff00');
    $ochart->setXAxis('#006600', MEDIUM_SOLID, 1, "");
    $ochart->setYAxis('#006600', SOLID, 5, "Y Axis");
    $ochart->setLabels($vLabels, '#000000', 1, HORIZONTAL);
    $ochart->plot("$k.png");
    $vTime[$k] = microtime() - $iTime;
 */   
    $out = fopen("test2.php", "w");
    fwrite($out, '<font face="sans-serif" size=2 color="#00bb22">');
    fwrite($out, '<b>PanaChart Examples</b></font> - ');
    fwrite($out, '<a href="./index.php?SEC=source"><font face="sans-serif" size=2>');
    fwrite($out, 'Examples source code</font></a>');
    fwrite($out, '<table cellspacing=3 cellpadding=0 border=0>');
    for($i=0; $i<=1; $i++){
        if($i%2 == 0){
            if($i>0){
                fwrite($out, "$sout\n");
                fwrite($out, "$stim\n");
            }
            $sout='<tr>'; $stim='<tr>';
        }
        $sout.='<td><img border=0 src="'.$i.'.png"></td>';
        $stim.='<td><font size=2>'.number_format($vTime[$i], 3, '.',',').' sec.</font></td>';
        if($i%2 == 1){
            $simg.='</tr>'; $stim.='</tr>';
        }                
    }
    fwrite($out, "$sout\n");
    fwrite($out, "$stim\n");
    
    fwrite($out, '</table>');
    fclose($out);
?>
 

