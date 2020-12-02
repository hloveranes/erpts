<?php


include("../web/template.inc");
include("Assessor.php";

class TestAssessor{

    var $tpl;
    var $assessorDude;
    var $formArray;
    
    function TestAssessor($http_post_vars, $formAction){

        $this->assessorDude = new Assessor();
        
        $this->tpl = new Template(getcwd(), "keep");
        $this->tpl->set_file("testAssessorTemplate", "testAssessor.htm");
        $this->tpl->set_var("TITLE", "Test Assessor");

        // loads all form elements from $http_post_vars into $formArray[]

		$this->formArray = array(
			"myAssessorId" => ""
			, "myPersonId" => ""
			, "myPosition" => ""
			, "myLastName" => ""
			, "myFirstName" => ""
			, "myMiddleName" => ""
			, "myPosition" => ""
			, "myGender" => ""
			, "myBirthday" => ""
		    , "myMaritalStatus" => ""
            , "myTin" => ""
            , "myAddressID" => ""
            , "myNumber" => ""
            , "myStreet" => ""
            , "myBarangay" => ""
            , "myDistrict" => ""
            , "myMunicipalityCity" => ""
            , "myProvince" => ""
            , "myTelephone" => ""
            , "myMobileNumber" => ""
            , "myEmail" => ""
            , "myPosition" => ""
		    , "formAction" => $formAction	
		);
		
		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
		
	    // echo $this->formArray["myAssessorId"];
	    // echo $this->formArray["myPersonId"];	
	    // echo $this->formArray["myPosition"];
	    // echo $this->formArray["formAction"];
			
        //foreach ($this->formArray as $v) {
        //        echo "Current value of formArray[]: $v <br>";
        //}
        
    }
    
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}

    function showParseInfo($child){
        $assessorDudeInfo .= "->";
        $assessorDudeInfo .= $child->tagname;
        $assessorDudeInfo .= ":<b>";
        $assessorDudeInfo .= $child->get_content();	
        $assessorDudeInfo .= "</b><br>";
        $child = $child->next_sibling();
        return($assessorDudeInfo);
    }
    
    
	
	function parseMyDom($domObj){
	    $baseNode = $domObj->document_element();
	    $assessorDudeInfo = $baseNode->tagname;
	    $assessorDudeInfo .= "<br>";
	    
	    if($baseNode->has_child_nodes()){
	        $child = $baseNode->first_child();
	
            while($child){

                $assessorDudeInfo .= $this->showParseInfo($child);
                if($child->tagname=="addressArray")
                {
                 $myAddressArray = $child->first_child();
                 $assessorDudeInfo .= "-" . $this->showParseInfo($myAddressArray);
                 if($myAddressArray->has_child_nodes()){
                     $myAddressChild = $myAddressArray->first_child();
                     while($myAddressChild){
                         $assessorDudeInfo .= "---" . $this->showParseInfo($myAddressChild);
                         $myAddressChild = $myAddressChild->next_sibling();
                     }

                 }
                }
                
                $child = $child->next_sibling();
                
            }
        }

	    return($assessorDudeInfo);
	
	}
	
    function main(){

        switch($this->formArray["formAction"]){
            case "clear":
                 $this->tpl->set_var("myAssessorId", "");
                 $this->tpl->set_var("myPersonId", "");
                 $this->tpl->set_var("myLastName", "");
                 $this->tpl->set_var("myFirstName", "");
                 $this->tpl->set_var("myMiddleName", "");

                 $this->tpl->set_var("myPosition", "");
                 $this->tpl->set_var("myGender", "");
                 $this->tpl->set_var("myBirthday", "");
                 $this->tpl->set_var("myMaritalStatus", "");
                 $this->tpl->set_var("myTin", "");
                 $this->tpl->set_var("myAddressID", "");
                 $this->tpl->set_var("myNumber", "");
                 $this->tpl->set_var("myStreet", "");
                 $this->tpl->set_var("myBarangay", "");
                 $this->tpl->set_var("myDistrict", "");
                 $this->tpl->set_var("myMunicipalityCity", "");
                 $this->tpl->set_var("myProvince", "");
                 $this->tpl->set_var("myTelephone", "");
                 $this->tpl->set_var("myMobileNumber", "");
                 $this->tpl->set_var("myEmail", "");
                 $this->tpl->set_var("myPosition", "");

                 $this->tpl->set_block("testAssessorTemplate", "myXMLentries");
                 $this->tpl->set_var("myXMLentries", "");
                 $this->tpl->set_var("myXML", "");
            break;

            case "submit":

                 $this->assessorDude->setAssessorID($this->formArray["myAssessorId"]);
                 $this->assessorDude->setPersonID($this->formArray["myPersonId"]);
                 $this->assessorDude->setLastName($this->formArray["myLastName"]);
                 $this->assessorDude->setFirstName($this->formArray["myFirstName"]);
                 $this->assessorDude->setMiddleName($this->formArray["myMiddleName"]);
                 
                 $this->assessorDude->setPosition($this->formArray["myPosition"]);
                 $this->assessorDude->setGender($this->formArray["myGender"]);
                 $this->assessorDude->setBirthday($this->formArray["myBirthday"]);
                 $this->assessorDude->setMaritalStatus($this->formArray["myMaritalStatus"]);
                 $this->assessorDude->setTin($this->formArray["myTin"]);
                 
                 $myAddress = new Address;
                 $myAddress->setAddressID($this->formArray["myAddressID"]);
                 $myAddress->setNumber($this->formArray["myNumber"]);
                 $myAddress->setStreet($this->formArray["myStreet"]);
                 $myAddress->setBarangay($this->formArray["myBarangay"]);
                 $myAddress->setDistrict($this->formArray["myDistrict"]);
                 $myAddress->setMunicipalityCity($this->formArray["myMunicipalityCity"]);
                 $myAddress->setProvince($this->formArray["myProvince"]);
                 
                 $this->assessorDude->setTelephone($this->formArray["myTelephone"]);
                 $this->assessorDude->setMobileNumber($this->formArray["myMobileNumber"]);
                 $this->assessorDude->setEmail($this->formArray["myEmail"]);
                 $this->assessorDude->setPosition($this->formArray["myPosition"]);

                 $myAddress->setDomDocument();

                 $this->assessorDude->setAddressArray($myAddress);
                 
                 $this->assessorDude->setDomDocument();
                 $domObj = $this->assessorDude->getDomDocument();
                 
                 $assessorDudeInfo = $this->parseMyDom($domObj);

                 $this->tpl->set_var("myAssessorId", $this->formArray["myAssessorId"]);
                 $this->tpl->set_var("myPersonId", $this->formArray["myPersonId"]);
                 $this->tpl->set_var("myLastName", $this->formArray["myLastName"]);
                 $this->tpl->set_var("myFirstName", $this->formArray["myFirstName"]);
                 $this->tpl->set_var("myMiddleName", $this->formArray["myMiddleName"]);

                 $this->tpl->set_var("myPosition", $this->formArray["myPosition"]);
                 $this->tpl->set_var("myGender", $this->formArray["myGender"]);
                 $this->tpl->set_var("myBirthday", $this->formArray["myBirthday"]);
                 $this->tpl->set_var("myMaritalStatus", $this->formArray["myMaritalStatus"]);
                 $this->tpl->set_var("myTin", $this->formArray["myTin"]);
                 $this->tpl->set_var("myAddressID", $this->formArray["myAddressID"]);
                 $this->tpl->set_var("myNumber", $this->formArray["myNumber"]);
                 $this->tpl->set_var("myStreet", $this->formArray["myStreet"]);
                 $this->tpl->set_var("myBarangay", $this->formArray["myBarangay"]);
                 $this->tpl->set_var("myDistrict", $this->formArray["myDistrict"]);
                 $this->tpl->set_var("myMunicipalityCity", $this->formArray["myMunicipalityCity"]);
                 $this->tpl->set_var("myProvince", $this->formArray["myProvince"]);
                 $this->tpl->set_var("myTelephone", $this->formArray["myTelephone"]);
                 $this->tpl->set_var("myMobileNumber", $this->formArray["myMobileNumber"]);
                 $this->tpl->set_var("myEmail", $this->formArray["myEmail"]);
                 $this->tpl->set_var("myPosition", $this->formArray["myPosition"]);

                 $this->tpl->set_block("testAssessorTemplate", "myXMLentries");
                 
                 $this->tpl->set_var("myParsedXML", "".$assessorDudeInfo."".$myAddressString."");
                 $this->tpl->set_var("myXML", htmlentities($domObj->dump_mem(true)));

            break;
            
            default:
            
                 $this->tpl->set_var("myAssessorId", "fill in the blank");
                 $this->tpl->set_var("myPersonId", "fill in the blank");
                 $this->tpl->set_var("myLastName", "fill in the blank");
                 $this->tpl->set_var("myFirstName", "fill in the blank");
                 $this->tpl->set_var("myMiddleName", "fill in the blank");

                 $this->tpl->set_var("myPosition", "fill in the blank");
                 $this->tpl->set_var("myGender", "fill in the blank");
                 $this->tpl->set_var("myBirthday", "fill in the blank");
                 $this->tpl->set_var("myMaritalStatus", "fill in the blank");
                 $this->tpl->set_var("myTin", "fill in the blank");
                 $this->tpl->set_var("myAddressID", "fill in the blank");
                 $this->tpl->set_var("myNumber", "fill in the blank");
                 $this->tpl->set_var("myStreet", "fill in the blank");
                 $this->tpl->set_var("myBarangay", "fill in the blank");
                 $this->tpl->set_var("myDistrict", "fill in the blank");
                 $this->tpl->set_var("myMunicipalityCity", "fill in the blank");
                 $this->tpl->set_var("myProvince", "fill in the blank");
                 $this->tpl->set_var("myTelephone", "fill in the blank");
                 $this->tpl->set_var("myMobileNumber", "fill in the blank");
                 $this->tpl->set_var("myEmail", "fill in the blank");
                 $this->tpl->set_var("myPosition", "fill in the blank");

                 $this->tpl->set_block("testAssessorTemplate", "myXMLentries");
                 $this->tpl->set_var("myXMLentries", "");
                 $this->tpl->set_var("myXML", "");
                 
        }
        
        $this->tpl->parse("PrinttestAssessorTemplate", "testAssessorTemplate");
        $this->tpl->finish("PrinttestAssessorTemplate");
        $this->tpl->p("PrinttestAssessorTemplate");

    }


}

$testAssessor = new TestAssessor($HTTP_POST_VARS, $formAction);
$testAssessor->main();

?>
