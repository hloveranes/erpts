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
		$sqlSelectTD = "SELECT tdID , propertyID , propertyType, cancelsTDNumber ,
						canceledByTDNumber , taxBeginsWithTheYear ,
						ceasesWithTheYear
						FROM TD
						ORDER BY tdID ASC";
		$db1 = new DB_RPTS($sqlSelectTD);
		$db2 = new DB_RPTS();
		$ctr = 0;
		while($db1->next_record()){
			$td = $db1->Record;
			$sqlProperty = sprintf("select assessedValue from %s where propertyID = '%s'",
			    $td['propertyType'],$td['tdID']);
           		 printf("$sqlProperty<br>\n");
			$db2->query($sqlProperty);
			if($db2->next_record()){
				$td['assessedValue'] = $db2->f("assessedValue");
				printf("Assessed Value is %s<br>\n",$td['assessedValue']);
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
