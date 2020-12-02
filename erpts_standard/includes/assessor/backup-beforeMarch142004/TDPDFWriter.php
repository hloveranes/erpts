<?php

require_once("web/clibPDFWriter.php";
require_once("web/template.inc");

class TDPDFWriter extends PDFWriter{
    /** extends PDF writer and redefines the setOutputXML to change the output of the PDF Writer
     **
     **/
    function setOutputXML($tdList){
        # check if the TDNum is a single value
        # if it is, then write only one (1) pdf file
        # else it is an array, then write several PDF files
        # the difference of writing one is in the number of times the PDF template
        # is used in the creation of the dom document

        # open the template
        $tpl = new template();
        
        # for every TD
        foreach($tdList as $td){
            # get all the TD values and set it
            $tdValues = array();
            $tdValues(
            $tpl->set_var($tdValues);
        
            # get all the OD values and set it
            $odValues = array();
            $tpl->set_var($odValues);

            # get all the Property values and set it
            $propertyValues = array();
            $tpl->set_var($propertyValues);
        }
        
    }

}

?>
