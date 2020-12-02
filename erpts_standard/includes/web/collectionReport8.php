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
		$this->tpl->set_file("rptsTemplate", "eight.xml") ;

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
		
	}
	
	function Main(){
		$db = new DB_RPTS;
		//$this->formArray['month']= 10; 		//ex Month january
		//$this->formArray['year']= 2003; 		//ex Month january
		/*$sql = "SELECT  DISTINCT payments.dueID FROM payments INNER  JOIN dues ON payments.dueID = dues.dueID
			WHERE MONTH( dues.dueDate )  =  '01'"; 		
			*/
			$sql = "SELECT sum( amount ) as amount , YEAR(dues.dueDate) as yearDue, sum( payments.penalty ) as penalty , sum( discount ) as discount, 
			collectionDate FROM collections INNER JOIN collectionPayments ON collections.collectionID = collectionPayments.collectionID INNER JOIN payments 
			ON collectionPayments.paymentID = payments.paymentID INNER JOIN dues ON payments.dueID = dues.dueID where 
			MONTH(collectionDate) = '".$this->formArray['month']."' AND YEAR(collectionDate) = '".$this->formArray['year']."'  GROUP BY ( collectionDate ) order by collectionDate desc;";
			$ypos = 460;
			$this->tpl->set_block("rptsTemplate","ROW","rBlk");
			$db->query($sql);
			if(count($db->num_rows())>0){
				for($i=0;$db->next_record();$i++){
					if ($db->f("yearDue")==date("Y")) {
						$this->tpl->set_var(currentYear,$db->f("amount"));						
						$this->tpl->set_var(prevYear,"0.00");
					}else{
						$this->tpl->set_var(prevYear,$db->f("amount"));
						$this->tpl->set_var(currentYear,"0.00");
					}
					$this->tpl->set_var($db->Record);
					$this->tpl->set_var(ypos,$ypos);

					$ypos = $ypos - 10;
					$this->tpl->parse("rBlk","ROW",true);
				}		
			}
		
		
		$this->tpl->parse("report","rptsTemplate");
		$this->tpl->finish("report");
//		$this->tpl->p("report");
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
