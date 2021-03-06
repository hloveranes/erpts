<?php

$curr = getcwd();
$folders = explode("/",$curr);
foreach ($folders as $folder) {
	if (substr($folder,0,5) == "erpts") break;
}

//define('NCCBIZ','http://localhost/'.$folder.'/nccbiz/');

define('MYSQLDBHOST', 'localhost');
define('MYSQLDBUSER', 'root');
define('MYSQLDBPWD', 'palitanmoto');
define('MYSQLDBNAME', $folder);

define('NCCBIZ','http://localhost/'.$folder.'/nccbiz/');
#echo NCCBIZ.'<br>';
define('PAGE_BY',10);
define('DB_CLASS', 'DB_rpts');
define('LGU_TABLE', 'LGU');
define('OD_TABLE', 'OD');
define('ODHISTORY_TABLE', 'ODHistory');
define('TD_TABLE', 'TD');
define('RPTOP_TABLE', 'RPTOP');
define('RPTOPTD_TABLE', 'RPTOPTD');
define('AFS_TABLE', 'AFS');
define('LOCATION_TABLE', 'Location');
define('PROPERTY_TABLE', 'Property');
define('ASSESSOR_TABLE', 'Assessor');
define('IMPROVEMENTSBUILDINGS_TABLE', 'ImprovementsBuildings');
define('STOREY_TABLE', 'Storey');
define('MACHINERIES_TABLE', 'Machineries');
define('PLANTSTREES_TABLE', 'PlantsTrees');
define('LAND_TABLE', 'Land');
define('OWNER_TABLE', 'Owner');
define('OWNER_COMPANY_TABLE', 'OwnerCompany');
define('OWNER_PERSON_TABLE', 'OwnerPerson');
define('ADDRESS_TABLE', 'Address');
define('COMPANY_TABLE', 'Company');
define('COMPANY_ADDRESS_TABLE', 'CompanyAddress');
define('PERSON_TABLE', 'Person');
define('PERSON_ADDRESS_TABLE', 'PersonAddress');

define('BARANGAY_TABLE', 'Barangay');
define('DISTRICT_TABLE', 'District');
define('MUNICIPALITYCITY_TABLE', 'MunicipalityCity');
define('PROVINCE_TABLE', 'Province');

define('LANDCLASSES_TABLE', 'LandClasses');
define('LAND_ACTUALUSES_TABLE', 'LandActualUses');
define('LANDSUBCLASSES_TABLE', 'LandSubclasses');

define('PLANTSTREESCLASSES_TABLE', 'PlantsTreesClasses');
define('PLANTSTREES_ACTUALUSES_TABLE', 'PlantsTreesActualUses');

define('IMPROVEMENTSBUILDINGS_CLASSES_TABLE', 'ImprovementsBuildingsClasses');
define('IMPROVEMENTSBUILDINGS_ACTUALUSES_TABLE', 'ImprovementsBuildingsActualUses');
define('IMPROVEMENTSBUILDINGS_DEPRECIATION_TABLE', 'ImprovementsBuildingsDepreciation');

define('MACHINERIES_CLASSES_TABLE', 'MachineriesClasses');
define('MACHINERIES_ACTUALUSES_TABLE', 'MachineriesActualUses');
define('MACHINERIES_DEPRECIATION_TABLE', 'MachineriesDepreciation');

define('PROPASSESSKINDS_TABLE', 'PropAssessKinds');
define('PROPASSESSUSES_TABLE', 'PropAssessUses');

define('LOCATIONADDRESS_TABLE', 'LocationAddress');

define('MONTH_ARRAY', '$monthArray = array("1"=>"January", "2"=>"February", "3"=>"March", "4"=>"April", "5"=>"May", "6"=>"June","7"=>"July", "8"=>"August", "9"=>"September", "10"=>"October", "11"=>"November", "12"=>"December");');
define('MARITAL_STATUS_ARRAY', '$maritalStatusArray = array("single"=>"single", "married"=>"married", "others"=>"others");');

define('AUTH_USER_MD5_TABLE', 'auth_user_md5');

define('ERPTS_SETTINGS_TABLE', 'eRPTSSettings');
define('TREASURY_SETTINGS_TABLE','TreasurySettings');
define('ASSESSMENT_SETTINGS_TABLE','AssessmentSettings');

define('DUE_TABLE','Due');
define('BACKTAXTD_TABLE', 'BacktaxTD');
define('PAYMENT_TABLE','Payment');
define('RECEIPT_TABLE','Receipt');
define('COLLECTION_TABLE','Collection');

define('REPORT_CODE_LIST', '
	$reportCodeList = array(
		0 => array("code" => "AG", "description" => "Agricultural"),
		6 => array("code" => "CH", "description" => "Charitable"),
		3 => array("code" => "CO", "description" => "Commercial"),
		7 => array("code" => "CU", "description" => "Cultural"),
		8 => array("code" => "ED", "description" => "Educational"),
		4 => array("code" => "IN", "description" => "Industrial"),
		9 => array("code" => "GO", "description" => "Government"),
		10 => array("code" => "HO", "description" => "Hospital"),
		1 => array("code" => "MI", "description" => "Mineral"),
		14 => array("code" => "OTX", "description" => "Others - Taxable"),
		15 => array("code" => "OTE", "description" => "Others- Exempt"),
		2 => array("code" => "RE", "description" => "Residential"),
		11 => array("code" => "RL", "description" => "Religious"),
		12 => array("code" => "SC", "description" => "Scientific"),
		5 => array("code" => "SP", "description" => "Special"),
		13 => array("code" => "TI", "description" => "Timber"))
	;');


define('OUTBOX_TABLE', 'Outbox');

// maximum number of days allowed before a new transaction can be made for a property
define('TRANSACTION_MAX_DAYDIFFERENCE',30);

?>
