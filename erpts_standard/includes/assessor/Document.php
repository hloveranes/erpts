<?php
class Document
{
    var $lastName;
    var $firstName;
    var $pin;
	//var $domDoc;
    
    function Document()
    {
        $this->lastName = "none";
		$this->firstName = "none";
		$this->pin = "0";
    }
    function setFirstName($fname)
    {
        $this->firstName = $fname;
    }
    function setLastName($lname)
    {
        $this->lastName = $lname;
    }
    function setPin($p)
    {
        $this->pin = $p;
    }
    function showOwner()
    {
        echo $this->firstName ." ". $this->lastName ." owns property with PIN# ". $this->pin ."<br>";
    }
	function sendXML($doc)
	{
		$rootelement = $doc->document_element();
		$rec = $doc->create_element("record");
		$rec = $rootelement->append_child($rec);
		$rec->set_attribute("pin",$this->pin);	
		$fname = $doc->create_element("firstname");
		$fname = $rec->append_child($fname);
		$fnametxt = $doc->create_text_node($this->firstName);
		$fnametxt = $fname->append_child($fnametxt);
		$lname = $doc->create_element("lastname");
		$lname = $rec->append_child($lname);
		$lnametxt = $doc->create_text_node($this->lastName);
		$lnametxt = $lname->append_child($lnametxt);
		$xmlStr = $doc->dump_mem(true);
		//echo $xmlStr;
		//return $xmlStr;
	}
}
?>