<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/assessor/LocationAddress.php";
include_once "../includes/assessor/Company.php";
include_once "../includes/assessor/CompanyRecords.php";
include_once "../includes/assessor/Person.php";
include_once "../includes/assessor/PersonRecords.php";
include_once "../includes/assessor/Owner.php";
include_once "../includes/assessor/OwnerRecords.php";
include_once "../includes/assessor/OD.php";
include_once "../includes/assessor/ODRecords.php";

#####################################
# Define Interface Class
#####################################
class ODList{
	
	var $tpl;
	var $formArray;
	var $sess;

	function ODList($http_post_vars,$sess,$odID,$page,$searchKey,$formAction,$sortBy,$sortOrder,$viewArchives){
		global $auth;
//		echo "username=>".$auth->auth["uname"];
//		echo "userID=>".$auth->auth["uid"];

		$this->formArray["uid"] = $auth->auth["uid"];
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "ODList.htm") ;
		$this->tpl->set_var("TITLE", "OD List");
		
		$this->sess = $sess;
		$this->formArray["odID"] = $odID;

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}

	
	function setForm(){
		foreach ($this->formArray as $key => $value){
			$this->tpl->set_var($key, $value);
		}
	}
	
	function Main(){
		switch ($this->formArray["formAction"]){
			case "cancel":
				header("location: ODList.php";
				exit;
				break;
			default:
				$this->tpl->set_var("msg", "");
				$ODList = new SoapObject(NCCBIZ."ODList.php", "urn:Object");
				$this->tpl->set_block("rptsTemplate", "Pages", "PagesBlock");
                $this->tpl->set_block("rptsTemplate", "NotFound", "NotFoundBlock");
                $this->tpl->set_var("NotFoundBlock", "");

				if (!$count = $ODList->getODCount($condition)){
					$this->tpl->set_var("PagesBlock", "");
	                $this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
	                $this->tpl->set_var("PageNavigatorBlock", "");
				}
				else{
					$numOfPages = ceil($count / PAGE_BY);
					for($i=1;$i<=$numOfPages;$i++){
						if ($i==$this->formArray["page"]){
							$this->tpl->set_var("pages","");
							$this->tpl->set_var("pagesUrl","");
							$this->tpl->set_var("paged",$i);
						}
						else{
							$this->tpl->set_var("pages",$i);
						    $this->tpl->set_var("pagesUrl",$i);	
							$this->tpl->set_var("paged","");
						}
						$this->tpl->parse("PagesBlock", "Pages", true);
					}
				}
				if ($numOfPages == $this->formArray["page"] || $numOfPages==""){
					$this->tpl->set_var("nextTxt", "");
				}
				else{
					$this->tpl->set_var("next", $this->formArray["page"]+1);
					$this->tpl->set_var("nextTxt", "next");
				}
				if ($this->formArray["page"] == 1){
					$this->tpl->set_var("previousTxt", "");
				}
				else {
					$this->tpl->set_var("previous", $this->formArray["page"]-1);
					$this->tpl->set_var("previousTxt", "previous");
				}
				if($numOfPages==""){
					$this->tpl->set_var("pageOf", "");
				}
				else{
					$this->tpl->set_var("pageOf", $this->formArray["page"]." of ".$numOfPages);
				}

				if (!$xmlStr = $ODList->getODList(0,$condition)){
					$this->tpl->set_block("rptsTemplate", "ODTable", "ODTableBlock");
					$this->tpl->set_var("ODTableBlock", "");

					$this->tpl->set_var("PagesBlock", "");
	                $this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
	                $this->tpl->set_var("PageNavigatorBlock", "");
					$this->tpl->set_block("rptsTemplate", "ArchiveButton", "ArchiveButtonBlock");
					$this->tpl->set_var("ArchiveButtonBlock", "");
					$this->tpl->set_block("rptsTemplate", "UnArchiveButton", "UnArchiveButtonBlock");
					$this->tpl->set_var("UnArchiveButtonBlock", "");
				}
				else {
					echo $xmlStr;
					exit;
					if(!$domDoc = domxml_open_mem($xmlStr)) {
						$this->tpl->set_block("rptsTemplate", "ODListTable", "ODListTableBlock");
						$this->tpl->set_var("ODListTableBlock", "");

						$this->tpl->set_var("PagesBlock", "");
		                $this->tpl->set_block("rptsTemplate", "PageNavigator", "PageNavigatorBlock");
			            $this->tpl->set_var("PageNavigatorBlock", "");
						$this->tpl->set_block("rptsTemplate", "ArchiveButton", "ArchiveButtonBlock");
						$this->tpl->set_var("ArchiveButtonBlock", "");
						$this->tpl->set_block("rptsTemplate", "UnArchiveButton", "UnArchiveButtonBlock");
						$this->tpl->set_var("UnArchiveButtonBlock", "");
					}
					else {
						$odRecords = new ODRecords;
						$odRecords->parseDomDocument($domDoc);
						$list = $odRecords->getArrayList();
						if (count($list)){
							$this->tpl->set_block("rptsTemplate", "ODDBEmpty", "ODDBEmptyBlock");
							$this->tpl->set_var("ODDBEmptyBlock", "");	
							$this->tpl->set_block("rptsTemplate", "ODList", "ODListBlock");
							$this->tpl->set_block("ODList", "PersonList", "PersonListBlock");
							$this->tpl->set_block("ODList", "CompanyList", "CompanyListBlock");
							foreach ($list as $key => $value){
								//print_r($value);
								//echo "<br>";
								$this->tpl->set_var("odID", $value->getOdID());
								$oValue = $value->owner;
								$pOwnerStr = "";
								if (count($oValue->personArray)){
									foreach($oValue->personArray as $pKey => $pValue){
										$this->tpl->set_var("personID",$pValue->getPersonID());
										$this->tpl->set_var("OwnerPerson",$pValue->getFullName());
										$this->tpl->parse("PersonListBlock", "PersonList", true);
									}
								}
								if (count($oValue->companyArray)){
									foreach($oValue->companyArray as $cKey => $cValue){
										$this->tpl->set_var("companyID",$cValue->getCompanyID());
										$this->tpl->set_var("OwnerCompany",$cValue->getCompanyName());
										$this->tpl->parse("CompanyListBlock", "CompanyList", true);
									}
								}
								if (count($oValue->personArray) || count($oValue->companyArray)){
									$this->tpl->set_var("none","");
								}
								else{
									$this->tpl->set_var("none","none");
								}
								//*/
								//if (method_exists($value->locationAddress,$value->locationAddress->getFullAddress()))
								if ($value->locationAddress <> "")
								$this->tpl->set_var("locationAddress", $value->locationAddress->getFullAddress());
								$this->tpl->set_var("landArea", number_format($value->getLandArea(), 2, '.', ','));
								$this->tpl->parse("ODListBlock", "ODList", true);
								$this->tpl->set_var("PersonListBlock", "");
								$this->tpl->set_var("CompanyListBlock", "");
							}
						}
						else{
							$this->tpl->set_block("rptsTemplate", "ODList", "ODListBlock");
							$this->tpl->set_var("ODListBlock", "huh");
						}
					}
				}
		}
		
        $this->setForm();
        $this->tpl->set_var("Session", $this->sess->url(""));
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
page_open(array("sess" => "rpts_Session"
	,"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
	//global $auth;
	//print_r($auth);
		
if(!$page) $page = 1;
$odList = new ODList($HTTP_POST_VARS,$sess,$odID,$page,$searchKey,$formAction,$sortBy,$sortOrder,$viewArchives);
$odList->main();
?>
<?php page_close(); ?>
