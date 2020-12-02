<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../collection/dues.php";

#####################################
# Define Interface Class
#####################################
class DuesBuildup{
	
	var $tpl;
	var $formArray;
	var $sess;
	
	function DuesBuildup(){
	}
	function doBuildup(){
		$sqlSelectTD = "SELECT tdID , TD.propertyID , cancelsTDNumber ,
						canceledByTDNumber , taxBeginsWithTheYear ,
						ceasesWithTheYear, assessedValue
						FROM TD,Property
						WHERE TD.propertyID = Property.propertyID
						ORDER BY tdID ASC";
		$db1 = new DB_RPTS($sqlSelectTD);
		$ctr = 0;
		while($db1->next_record()){
			$td = $db1->Record;
			if ($td['canceledByTDNumber'] == NULL){
				$today = getdate();
				$td['ceasesWithTheYear'] = $today['year'];
			}
			for ($i = $td['taxBeginsWithTheYear'];$i<= $td['ceasesWithTheYear'];$i++){
				printf ("Making due for td#%s for year %s<br>\n",$td['tdID'],$i);
				new Dues($td['tdID'],$i,$td['assessedValue']);
				printf ("done<br>\n");
				$ctr++;
			}
		}
        printf("there should be $ctr records<br>\n");
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
$builder = new DuesBuildup();
$builder->doBuildup();


?>
<?php page_close(); ?>
