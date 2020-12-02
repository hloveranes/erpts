<?php
$server = new SoapServer("urn:Object");
$server->setClass('TestSoapAFS');
$server->handle();

class TestSoapAFS
{
    function TestSoapAFS()
    {
        $this->data = "hello from myObject";
    }
    
    function getDomDoc($domDoc)
    {
		return $domDoc;
    }
}
?>