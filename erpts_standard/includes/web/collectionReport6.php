<?php
include_once "./prepend.php";
require_once('collection/Receipt.php');
require_once('collection/Collections.php');
require_once('collection/Payment.php');
require_once('collection/dues.php');
include('web/clibPDFWriter.php');

class CollectionReport{

	var $tpl;
	var $formArray;

	function CollectionReport($sess,$http_post_vars){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		#$this->tpl->set_file("rptsTemplate", "collectionReport1.htm") ;
		$this->tpl->set_file("rptsTemplate", "six.xml") ;

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
		
	}
	
	function Main(){
		$db = new DB_RPTS;
		$startDate = array();
		$endDate = array();
		$db->query("SELECT DISTINCT YEAR(dues.dueDate) as dueYear FROM dues");
		
		for($i=0;$db->next_record();$i++){		
				
						$startDate[$i][0] = $db->f("dueYear")."-01-01";
						$endDate[$i][0] = $db->f("dueYear")."-03-31";
						$startDate[$i][1] = $db->f("dueYear")."-04-01";
						$endDate[$i][1] = $db->f("dueYear")."-06-30";
						$startDate[$i][2] = $db->f("dueYear")."-07-01";
						$endDate[$i][2] = $db->f("dueYear")."-09-30";
						$startDate[$i][3] = $db->f("dueYear")."-10-01";
						$endDate[$i][3] = $db->f("dueYear")."-12-31";
							
		}

		$ypos = 625;
		$this->tpl->set_block("rptsTemplate","ROW","rBlk");
		for($i=0;$i<count($startDate);$i++){
			for($j=0;$j<count($startDate[$i]);$j++){

				$sql = "SELECT sum( basic )  AS basic, sum( sef )  AS sef, sum( penalty )  AS penalty, sum( paidBasic )  AS paidBasic, 
				sum(paidSEF) as paidSEF,sum( paidPenalty )  AS paidPenalty FROM dues WHERE dues.dueDate between '".$startDate[$i][$j]."' AND '".
				$endDate[$i][$j]."' GROUP  BY (dues.dueDate) "; 
			
				$db->query($sql);			
					if($db->next_record()){
						$this->tpl->set_var($db->Record);
						list($year[$i][$j],$month[$i][$j],$day[$i][$j]) = explode("-",$startDate[$i][$j]);
						if($month[$i][$j] == '01'){
							$quarter = $year[$i][$j]." Quarter 1 ";
						}elseif($month[$i][$j] == '04'){
							$quarter = $year[$i][$j]." Quarter 2 ";
						}elseif($month[$i][$j] == '07'){
							$quarter = $year[$i][$j]." Quarter 3 ";
						}elseif($month[$i][$j] == '10'){
							$quarter = $year[$i][$j]." Quarter 3 ";
						}
					
					}
			
					$this->tpl->set_var(quarter,$quarter);
					$this->tpl->set_var(ypos,$ypos);
					$ypos = $ypos - 4;

			}			

			$this->tpl->parse("rBlk","ROW",true);
		}
				
		$this->tpl->parse('report','rptsTemplate');
        $this->tpl->finish('report');
	//	$this->tpl->p('report');
		
      $rptrpdf = new PDFWriter;
       $rptrpdf->setOutputXML($this->tpl->get('report'),"string");
       $rptrpdf->writePDF("collectionReport2.pdf");

	}

}
page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
$obj = new CollectionReport($sess,$HTTP_POST_VARS);
$obj->Main();
?>
<?php page_close(); ?>
