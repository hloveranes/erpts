<?php

include("web/clibPDFWriter.php";

class TestPDFWriter{

      function TestPDFWriter(){
               session_cache_limiter("nocache");
               $filename = getcwd()."/officialrptr.xml";
               if (isset($_GET['xmlfile']))
                  $filename = getcwd()."/".$_GET['xmlfile'];
               if (isset($_GET['name']))
                  $name = $_GET['name'];
               else
                   $name = "rpts.pdf";
               $testpdf = new PDFWriter;
               $testpdf->setOutputXML($filename);
               
               if(isset($_GET['print'])){
                   $testpdf->writePDF($name,$_GET['print']);
               }
               else {
                   $testpdf->writePDF($name);
               }
      }
}
new TestPDFWriter;

?>
