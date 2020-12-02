<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/OD.php";
include_once "../includes/assessor/Address.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/AFS.php";
#####################################
# Define Interface Class
#####################################
class MergeBasket{
	
	var $tpl;
	var $formArray;
	var $person;
	
	function MergeBasket($sess,$mergeBasketCSV){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");
		$this->tpl->set_file("rptsTemplate", "MergeBasketConfirm.htm") ;
		$this->tpl->set_var("TITLE", "Merge Basket");

		$this->formArray["mergeBasketCSV"] = $mergeBasketCSV;
	}
	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main(){
		$this->tpl->set_var("Session", $this->sess->url(""));

		$this->formArray["mergeBasketArray"] = explode(",",$this->formArray["mergeBasketCSV"]);

		if(is_array($this->formArray["mergeBasketArray"])){
			$this->tpl->set_block("rptsTemplate", "NoODList", "NoODListBlock");
			$this->tpl->set_var("NoODListBlock", "");

			$this->tpl->set_block("rptsTemplate", "ODList", "ODListBlock");

			$this->tpl->set_var("totalInMergeBasket", count($this->formArray["mergeBasketArray"]));
			foreach($this->formArray["mergeBasketArray"] as $odID){
				$od = new OD;
				$od->selectRecord($odID);

				$owner = $od->owner;
				$ownerStr = "";
				if (is_array($owner->personArray)){
					foreach($owner->personArray as $pKey => $pValue){
						$ownerArray[] = $pValue->getFullName();
					}
				}
				if (is_array($owner->companyArray)){
					foreach($owner->companyArray as $cKey => $cValue){
						$ownerArray[] = $cValue->getCompanyName();
					}
				}

				if(is_object($od->locationAddress))
					$this->tpl->set_var("locationAddress", $od->locationAddress->getFullAddress());
				else
					$this->tpl->set_var("locationAddress", "");

				$this->tpl->set_var("landArea", number_format($od->getLandArea(), 2, '.', ','));

				$this->tpl->set_var("odID",$od->getOdID());

				if(is_array($ownerArray))
					$this->tpl->set_var("ownerName",implode(",",$ownerArray));
				else
					$this->tpl->set_var("ownerName","");
					
				$afs = new AFS;
				$afs->selectRecord("","",$odID,"");
				if(is_object($afs)){
					if($afs->getPropertyIndexNumber()!=""){
						$propertyIndexNumber = $afs->getPropertyIndexNumber();
					}
					else{
						$propertyIndexNumber = "";
					}
				}
				$this->tpl->set_var("propertyIndexNumber", $propertyIndexNumber);					

				$this->tpl->parse("ODListBlock", "ODList", true);				
				unset($ownerArray);
			}
		}
		else{
			$this->tpl->set_block("rptsTemplate", "ShowODList", "ShowODListBlock");
			$this->tpl->set_var("ShowODListBlock", "");

			$this->tpl->set_var("totalInMergeBasket", 0);
		}

		$this->setForm();
		$this->tpl->parse("templatePage", "rptsTemplate");
		$this->tpl->finish("templatePage");
		$this->tpl->p("templatePage");
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
	,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
//*/

$mergeBasket = new MergeBasket($sess,$mergeBasketCSV);
$mergeBasket->Main();


?>
<?php page_close(); ?>
