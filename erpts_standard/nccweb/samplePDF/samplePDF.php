<?php

include("web/clibPDFWriter.php";

class SamplePDF{
      function SamplePDF(){
               session_cache_limiter("nocache");
               $xmlFile = getcwd()."/samplePDF.xml";
               $pdfFile = "samplePDF.pdf";
               $testpdf = new PDFWriter;
               $testpdf->setOutputXML($xmlFile);

               $testpdf->writePDF($pdfFile,false);
      }
}
new SamplePDF;

?>
