<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../assessor/Address.php";
include_once "../assessor/Company.php";
include_once "../assessor/CompanyRecords.php";
include_once "../assessor/Person.php";
include_once "../assessor/PersonRecords.php";
include_once "../assessor/Owner.php";
include_once "../assessor/OwnerRecords.php";
include_once "../assessor/RPTOP.php";
include_once "../assessor/RPTOPRecords.php";

#####################################
# Define Interface Class
#####################################
class RPTOPList{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function RPTOPList($sess,$http_post_vars){
		$this->tpl = new rpts_Template(getcwd());

		$this->tpl->set_file("rptsTemplate", "batchCollection.htm") ;
		$this->tpl->set_var("TITLE", "View SOA");		
		$this->sess = $sess;

		foreach ($http_post_vars as $key=>$value) {
			$this->formArray[$key] = $value;
		}
	}
	
	function Main(){
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
page_open(array("sess" => "rpts_Session",
	"auth" => "rpts_Challenge_Auth"
	//"perm" => "rpts_Perm"
	));
if(!$page) $page = 1;
$rptopList = new RPTOPList($sess,$HTTP_POST_VARS);
$rptopList->main();
?>
<?php page_close(); ?>
