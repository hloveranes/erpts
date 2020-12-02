<?php 
# Setup PHPLIB in this Area
include_once "../includes/web/prepend.php";
include_once "../includes/records/LGU.php";

#####################################
# Define Interface Class
#####################################
class Home{
	
	var $tpl;
	function Home($sess){
		$this->sess = $sess;
		$this->tpl = new rpts_Template(getcwd(),"keep");

		$this->tpl->set_file("rptsTemplate", "home.htm") ;
		$this->tpl->set_var("TITLE", "Home");
	}
	function Main(){
		$this->tpl->set_var("Session", $this->sess->url(""));
		/*
		$db = new DB_Records;
		$sql = sprintf("select %s from %s order by LGUName;",
				"LGUID", LGU_TABLE);
		$db->query($sql);
		$this->tpl->set_block("rptsTemplate", "DBList", "DBListBlock");
		while ($db->next_record()) {
			$lgu = new LGU;
			$lgu->selectRecord($db->f("LGUID"));
			$this->tpl->set_var("lguName", $lgu->getLGUDB());
			$this->tpl->set_var("lguDB", $lgu->getLGUID());
			$this->tpl->parse("DBListBlock", "DBList", true);
		}*/
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
	,"perm" => "rpts_Perm"
	));
//*/
$obj = new Home($sess);
$obj->Main();
?>
<?php page_close(); ?>
