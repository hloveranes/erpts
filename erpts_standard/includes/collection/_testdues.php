<?php

require_once("dues.php");

class TestDues {

      function TestDues(){

          $due1 = new Dues();
          $duesXML = $due1->setDOMDocument();
          $due1->setUpDate();
          $dueDOM=domxml_open_mem($duesXML);
          $root=$dueDOM->document_element();
          $dueXML = $root->dump_node($root->first_child());
          $due1->parseDOMDocument($dueXML);
          $dueXML = $due1->setDOMDocument();
          echo $dueXML;
      }
      
}

new TestDues();

?>
