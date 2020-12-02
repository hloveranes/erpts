<?php

include_once "./TreasurySettings.php";

/** the following values are provided as default **/
/** The $penaltyLUT is a globally available array of penalty values
 ** it is essentially a lookup table of permonth penalties.
 **/
$penaltyLUT = array(0.00,0.02,0.04,0.06,0.08,
                    0.10,0.12,0.14,0.16,0.18,
                    0.20,0.22,0.24,0.26,0.28,
                    0.30,0.32,0.34,0.36,0.38,
                    0.40,0.42,0.44,0.46,0.48,
                    0.50,0.52,0.54,0.56,0.58,
                    0.60,0.62,0.64,0.66,0.68,
                    0.70,0.72,0.72);

/** 
The $annualDueDate determines whether penalty calculations start after January 01 or January 31, it has
been defaulted to January 31 here.
*/

$annualDueDate = "01-31";

/** The $pctRPTax is the percentage value of the assessed value that is
 ** the resulting Real Property Tax. i.e. assessed value * pctRPTax = Real Property Tax
 ** Sec. 233. Rates of Levy. - A province or city or a municipality within the Metropolitan
 ** Manila Area shall fix a uniform rate of basic real property tax applicable to their respective
 ** localities as follows:
 **  a.	In the case of a province, at the rate not exceeding one percent (1%) of the assessed value of real property; and
 **  b.	In the case of a city or a municipality within the Metropolitan Manila Area, at the rate not exceeding two percent
 **      (2%) of the assessed value of real property.
 **/
$pctRPTax = 0.02;
/** The $pctSEF is the percentage value of the assessed value that is
 ** the resulting SEF  i.e. assessed value * pctSEF = SEF tax
 ** Sec. 235. Additional Levy on Real Property for the Special Education Fund.
 ** - A province or city, or a municipality within the Metropolitan Manila Area,
 ** may levy and collect an annual tax of one percent (1%) on the assessed value
 ** of real property which shall be in addition to the basic real property tax.
 ** The proceeds thereof shall exclusively accrue to the Special Education Fund (SEF).
 **/
$pctSEF = 0.01;
/** The $pctIdle is the percentage value of the assessed value that is
 ** the resulting idle land tax  i.e. assessed value * pctIdle = Idle land tax
 **/


$pctIdle = 0.01;

$discountPercentage = 10; 
$discountPeriod = "03-31";

$advancedDiscountPercentage = 20;
$q1AdvancedDiscountPercentage = 10;


// Match Defaults against TreasurySettings values in database:
// and make sure $_POST["formAction"] is not "reset" in TreasurySettings admin

$treasurySettings = new TreasurySettings;
if($treasurySettings->selectRecord() && $_POST["formAction"]!="reset"){
	$penaltyLUT = $treasurySettings->getPenaltyLUT();
	$pctRPTax = $treasurySettings->getPctRPTax();
	$pctSEF = $treasurySettings->getPctSEF();
	$pctIdle = $treasurySettings->getPctIdle();
	$discountPercentage = $treasurySettings->getDiscountPercentage();
	$discountPeriod = $treasurySettings->getDiscountPeriod();
}

## create a function to set these tables and master values from the database
function setMasterValues(){
	global $penaltyLUT, $pctRPTax, $pctSEF, $pctIdle, $discountPercentage, $discountPeriod, $advancedDiscountPercentage;
}

?>
