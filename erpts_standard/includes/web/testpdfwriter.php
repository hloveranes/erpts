<?php

include("web/clibPDFWriter.php";
class TestPDFWriter{

      function TestPDFWriter(){
               session_cache_limiter("nocache");
               $testpdf = new PDFWriter;
               $testpdf->setOutputXML("C:/Sites/rpts/nccweb/rptreceipt.xml");
               $testpdf->writePDF("rptr.pdf");
      }
}

new TestPDFWriter;

?>
