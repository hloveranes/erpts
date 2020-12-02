<?php
if (udm_api_version() >= 0) {
   print  "Total number of urls in database: ".udm_get_doc_count($udm)."<br>\n";
   }
else echo udm_api_version();
?>