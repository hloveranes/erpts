<?php

include("web/clibPDFWriter.php";
include("web/prepend.php";
class TestPDFWriter{
		
	  var $tpl;
	  var $formArray;
	  
      function TestPDFWriter(){
				session_cache_limiter("nocache");
                $this->tpl = new rpts_Template(getcwd(),"keep");
				$this->tpl->set_file("rptsTemplate", "or1.xml") ;
			    $this->formArray = array("orNumber"=>"","ownerName"=>"");
			    $this->formArray["orNumber"] = 2;
				//$this->formArray["ownerName"]= "mia";
/*				foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}*/
			   }
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, html_entity_to_alpha($value));
		}
	}		   
	
	function Main(){
		$this->setForm();
        $this->tpl->parse("templatePage", "rptsTemplate");
        $this->tpl->finish("templatePage");

		$testpdf = new PDFWriter;
        $testpdf->setOutputXML($this->tpl->get("templatePage"),"test");
        if(isset($this->formArray["print"])){
        	$testpdf->writePDF($name);//,$this->formArray["print"]);
        }
        else {
        	$testpdf->writePDF($name);
        }

		//header("location: ".$testpdf->pdfPath);
		exit;

    }
}

#####################################
# Define Procedures and Functions
#####################################

##########################################################
# Begin Program Script
##########################################################
//*
page_open(array("sess" => "rpts_Session"
	//,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/

$printLandFAAS = new TestPDFWriter;
$printLandFAAS->Main();
?>
<?php page_close(); ?>
