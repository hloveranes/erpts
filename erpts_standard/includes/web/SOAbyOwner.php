<?php 
# Setup PHPLIB in this Area
include_once "./prepend.php";
include_once "../collection/dues.php";

#####################################
# Define Interface Class
#####################################
class SOAbyOwner{
	
	var $tpl;
	var $formArray;
	var $sess;
	var $ownerID;
	var $properties[][];
	
	function SOAbyOwner($ownerID = 0){
		get the owner's ID;
	}
	// AFS---OD---Owner--*OwnerPerson---Person
	// AFS---OD---Owner--*OwnerCompany---Company
	function getSOA(){ // have to determine if person or company.
  		SELECT afsID from
  		    AFS, OD, Owner, OwnerPerson
  		    where AFS.odID = OD.odID and OD.odID = Owner.odID
			  and Owner.OwnerID = OwnerPerson.OwnerID and OwnerPerson.PersonID = ''
  		select all the owner's declaration with that owner
  		select all the AFS with that OD ID
  		for every afs {
  			search in lands
  			search in plantstrees
  			search in improvementsbuildings
  			search in machineries
  		}
  select all the current TD's for these properties
  select all the dues for these TDs
  select all the unpaid TD
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
$audit = new SOAbyOwner();
$audit->getSOA();


?>
<?php page_close(); ?>
