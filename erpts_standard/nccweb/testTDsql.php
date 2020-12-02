<?	

include("web/prepend.php";


		$sql = "SELECT "
		    .TD_TABLE.".tdID as tdID, "
			.TD_TABLE.".afsID, "
			.AFS_TABLE.".odID, "
			.TD_TABLE.".taxDeclarationNumber as taxDeclarationNumber, "
			."(".TD_TABLE.".ceasesWithTheYear - ".TD_TABLE.".taxBeginsWithTheYear) as year, "
			."CONCAT(".PERSON_TABLE.".lastName,".PERSON_TABLE.".firstName,".PERSON_TABLE.".middleName) as PersonFullName, "
			.COMPANY_TABLE.".companyName "
			."FROM ".TD_TABLE." "
			."LEFT JOIN ".AFS_TABLE." "
			."ON ".TD_TABLE.".afsID = ".AFS_TABLE.".afsID "
            ."LEFT JOIN ".OWNER_TABLE." "
            ."ON ".AFS_TABLE.".odID = ".OWNER_TABLE.".odID "
            ."LEFT JOIN ".OWNER_PERSON_TABLE." "
            ."ON ".OWNER_TABLE.".ownerID = ".OWNER_PERSON_TABLE.".ownerID "
            ."LEFT JOIN ".PERSON_TABLE." "
            ."ON ".OWNER_PERSON_TABLE.".personID = ".PERSON_TABLE.".personID "
            ."LEFT JOIN ".OWNER_COMPANY_TABLE." "
            ."ON ".OWNER_TABLE.".ownerID = ".OWNER_COMPANY_TABLE.".ownerID "
            ."LEFT JOIN ".COMPANY_TABLE." "
            ."ON ".OWNER_COMPANY_TABLE.".companyID = ".COMPANY_TABLE.".companyID "
			."ORDER BY tdID DESC";


		echo $sql;


		

?>