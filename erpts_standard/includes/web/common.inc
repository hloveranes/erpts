<?php
$monthArr = array("1"=>"January", "2"=>"February", "3"=>"March", "4"=>"April", "5"=>"May", "6"=>"June",
		"7"=>"July", "8"=>"August", "9"=>"September", "10"=>"October", "11"=>"November", "12"=>"December");

$landUnitArr = array("square meters","hectares");
/*
Filename: arachnid_common.inc
Author: Lenard R. Ignacio
Description: This include file contains functions accessible by other scripts.
*/

/*
Function name: toMysqlDate
Description: Converts datetime strings of the form timestamp into date
	strings of the form "Y-m-d" for mySql DATE.
Arguments:
	$strDateVal - the datetime string to be converted.
*/
function toMysqlDate($strDateVal){
	if($strDateVal!=""){
		$strYearVal = substr($strDateVal,0,4);
		if($strYearVal < 1970)
			return $strDateVal;
		else
			return date("Y-m-d",strtotime($strDateVal));
	}
	else
		return $strDateVal;
}

function putPreZero($strVal){
	if($strVal!="")
		if($strVal<10)
			$strVal = "0".$strVal;
	return $strVal;
}

function putPreComma($tempVar){
	$ret = ($tempVar) ?", $tempVar": "";
	return $ret;
}

function removePreZero($strVal){
	if($strVal!="")
		return $strVal * 1;
	else
		return $strVal;
}
$monthArray = array("01"=>"January", "02"=>"February", "03"=>"March", "04"=>"April", "05"=>"May", "06"=>"June",
		"07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December");
/*
Function name: toSlashDate
Description: Converts datetime strings of the form "yyyy-mm-dd hh:mm:ss" into date
	strings of the form "mm/dd/yyyy".
Arguments:
	$strDateVal - the datetime string to be converted.
*/
function toSlashDate($strDateVal) {
	$strDateTime = split(" ", $strDateVal);
	$strDate = split("-", $strDateTime[0]);
	return $strDate[1] . "/" . $strDate[2] . "/" . $strDate[0];
}

$mArray = array("January", "February", "March", "April", "May", "June",
		"July", "August", "September", "October", "November", "December");
/*
Function name: toWholeDate
Description: Converts datetime strings of the form "yyyy-mm-dd hh:mm:ss" into date
	strings of the form "Month dd, yyyy".
Arguments:
	$strDateVal - the datetime string to be converted.
*/
function toWholeDate($strDateVal) {
	global $mArray;

	$strDateTime = split(" ", $strDateVal);
	$strDate = split("-", $strDateTime[0]);
	return $mArray[intval($strDate[1])-1] . " " . $strDate[2] . ", " . $strDate[0];
}

/*
Function name: to3Date
Description: Converts datetime strings of the form "yyyy-mm-dd hh:mm:ss" into date
	strings of the form "Mon dd, yyyy".
Arguments:
	$strDateVal - the datetime string to be converted.
*/
function to3Date($strDateVal) {
	global $mArray;

	$strDateTime = split(" ", $strDateVal);
	$strDate = split("-", $strDateTime[0]);
	return substr($mArray[intval($strDate[1])-1],0,3) . " " . $strDate[2] . ", " . $strDate[0];
}

/*
Function name: toPesoFormat
Description: Converts numbers into equivalent peso formats.
Arguments:
	$strNumVal - the number to be formatted.
*/
function toPesoFormat($strNumVal) {
	return "P" . number_format($strNumVal, 2);
}

/*
Function name: fixQuotes
Description: Converts single quotes in strings into two single quotes.  This is used mostly
	for conversion of user input into SQL acceptable values.
Arguments:
	$strAux - the string to be fixed.
*/
function fixQuotes($strAux) {
	return str_replace("'", "''", stripslashes($strAux));
}

/*
Function name: fixHTML
Description: Makes strings HTML compatible.  For example, it replaces the carriage return
	with "<br>".
Arguments:
	$strAux - the string to be fixed.
*/
function fixHTML($strAux) {		
	$strAux = str_replace("\"", "&quot;", stripslashes($strAux));
	$strAux = str_replace("\n", "<br>", $strAux);
	return ($strAux);
}

function stripCommas($strAux) {
	return str_replace(",", "", $strAux);
}

function tofloat($strAux){
	$strAux = stripCommas($strAux);
	return (float) $strAux;
}

function roundToNearestTen($n){
	$n = round($n);
	$m = $n % 10;
	if($m>=5){
	   $n = $n+(10-$m);
	}
	else{
	   $n = $n-$m;
	}
	return($n);
}

function roundUpNearestFiveCent($n){
	$n = un_number_format($n);

	$n = round($n,2);
	$n = number_format($n, 2, ".", "");

	$nArr = explode(".",$n);

	$int = $nArr[0];
	$dec = $nArr[1];
	$m = $dec % 5;
	if($m>0){
		$dec = $dec+(5-$m);
	}

	$n = $int.".".$dec;
	return $n;
}

function un_number_format($n){
	$n = str_replace(",", "", $n);
	return($n);
}
function formatCurrency($f){
	if(is_numeric($f))
		$f = number_format(un_number_format($f), 2, ".", ",");
	return $f;
}
/*
Function name: html_entity_to_alpha
Description: Replaces special characters / html entities with its alpha value. For example : ñ turns to n.
Arguments:
	$strAux - the string to be fixed.
*/

function html_entity_to_alpha($strAux){
	$arr = array(
		"&Agrave;" => "A"	// À
		,"&Aacute;" => "A"	// Á
		,"&Acirc;" => "A"	// Â
		,"&Atilde;" => "A"	// Ã
		,"&Auml;" => "A"	// Ä
		,"&Aring;" => "A"	// Å
		,"&AElig;" => "AE"	// Æ
		,"&Ccedil;" => "C"	// Ç
		,"&Egrave;" => "E"	// È
		,"&Eacute;" => "E"	// É
		,"&Ecirc;" => "E"	// Ê 
		,"&Euml;" => "E"	// Ë 
		,"&Igrave;" => "I"	// Ì 
		,"&Iacute;" => "I"	// Í 
		,"&Icirc;" => "I"	// Î 
		,"&Iuml;" => "I"	// Ï 
		,"&ETH;" => "D"		// Ð 
		,"&Ntilde;" => "N"	// Ñ 
		,"&Ograve;" => "O"	// Ò 
		,"&Oacute;" => "O"	// Ó 
		,"&Ocirc;" => "O"	// Ô 
		,"&Otilde;" => "O"	// Õ 
		,"&Ouml;" => "O"	// Ö 
		,"&times;" => "x"	// × 
		,"&Oslash;" => "0"	// Ø 
		,"&Ugrave;" => "U"	// Ù 
		,"&Uacute;" => "U"	// Ú 
		,"&Ucirc;" => "U"	// Û 
		,"&Uuml;" => "U"	// Ü 
		,"&Yacute;" => "Y"	// Ý 
		,"&THORN;" => "b"	// Þ 
		,"&szlig;" => "B"	// ß 
		,"&agrave;" => "a"	// à 
		,"&aacute;" => "a"	// á 
		,"&acirc;" => "a"	// â 
		,"&atilde;" => "a"	// ã 
		,"&auml;" => "a"	// ä 
		,"&aring;" => "a"	// å 
		,"&aelig;" => "ae"	// æ 
		,"&ccedil;" => "c"	// ç 
		,"&egrave;" => "e"	// è 
		,"&eacute;" => "e"	// é 
		,"&ecirc;" => "e"	// ê 
		,"&euml;" => "e"	// ë 
		,"&igrave;" => "i"	// ì 
		,"&iacute;" => "i"	// í 
		,"&icirc;" => "i"	// î 
		,"&iuml;" => "i"	// ï 
		,"&eth;" => "o"		// ð 
		,"&ntilde;" => "n"	// ñ 
		,"&ograve;" => "o"	// ò 
		,"&oacute;" => "o"	// ó 
		,"&ocirc;" => "o"	// ô 
		,"&otilde;" => "o"	// õ 
		,"&ouml;" => "o"	// ö 
		,"&divide;" => "/"	// ÷ 
		,"&oslash;" => "o"	// ø 
		,"&ugrave;" => "u"	// ù 
		,"&uacute;" => "u"	// ú 
		,"&ucirc;" => "u"	// û 
		,"&uuml;" => "u"	// ü 
		,"&yacute;" => "y"	// ý 
		,"&thorn;" => "b"	// þ 
		,"&yuml;" => "y"	// ÿ 
		,"&amp;" => "and"	// & 
	);

	if(is_string($strAux)){
		$strAux = htmlentities($strAux);
		$strAux = strtr($strAux, $arr);
	}

	return $strAux;
}


//*************************************************************
// this function converts an amount into alpha words
// with the words PESOS and CENTAVOS.  Pass it a float.
// Example:  P3.77 = Three Pesos and Seventy Seven Centavos
// works up to 999,999,999.99 pesos - Great for checks
//*************************************************************

function makewords($numval)
{
$moneystr = "";
// handle the millions
$milval = (integer)($numval / 1000000);
if($milval > 0)
  {
  $moneystr = getwords($milval) . " Million";
  }

// handle the thousands
$workval = $numval - ($milval * 1000000); // get rid of millions
$thouval = (integer)($workval / 1000);
if($thouval > 0)
  {
  $workword = getwords($thouval);
  if ($moneystr == "")
    {
    $moneystr = $workword . " Thousand";
    }
  else
    {
    $moneystr .= " " . $workword . " Thousand";
    }
  }

// handle all the rest of the dollars
$workval = $workval - ($thouval * 1000); // get rid of thousands
$tensval = (integer)($workval);
if ($moneystr == "")
  {
  if ($tensval > 0)
    {
    $moneystr = getwords($tensval);
    }
  else
    {
    $moneystr = "Zero";
    }
  }
else // non zero values in hundreds and up
  {
  $workword = getwords($tensval);
  $moneystr .= " " . $workword;
  }

// plural or singular 'dollar'
$workval = (integer)($numval);
if ($workval == 1)
  {
  $moneystr .= " Peso ";
  }
else
  {
  $moneystr .= " Pesos ";
  }

// do the pennies - use printf so that we get the
// same rounding as printf
$workstr = sprintf("%3.2f",$numval); // convert to a string
$intstr = substr($workstr,strlen - 2, 2);
$workint = (integer)($intstr);
if ($workint == 0)
  {
  $moneystr .= "";
  }
else
  {
  $moneystr .= " And ";
  $moneystr .= getwords($workint);
  }

if($workint == 0){
  $moneystr .= "";
}
else if ($workint == 1)
  {
  $moneystr .= " Centavo";
  }
else
  {
  $moneystr .= " Centavos";
  }

// prefix "Only"

$moneystr .= " Only";

// done - let's get out of here!
return $moneystr;
}

//*************************************************************
// this function creates word phrases in the range of 1 to 999.
// pass it an integer value
//*************************************************************
function getwords($workval)
{
$numwords = array(
  1 => "One",
  2 => "Two",
  3 => "Three",
  4 => "Four",
  5 => "Five",
  6 => "Six",
  7 => "Seven",
  8 => "Eight",
  9 => "Nine",
  10 => "Ten",
  11 => "Eleven",
  12 => "Twelve",
  13 => "Thirteen",
  14 => "Fourteen",
  15 => "Fifteen",
  16 => "Sixteen",
  17 => "Seventeen",
  18 => "Eightteen",
  19 => "Nineteen",
  20 => "Twenty",
  30 => "Thirty",
  40 => "Forty",
  50 => "Fifty",
  60 => "Sixty",
  70 => "Seventy",
  80 => "Eighty",
  90 => "Ninety");

// handle the 100's
$retstr = "";
$hundval = (integer)($workval / 100);
if ($hundval > 0)
  {
  $retstr = $numwords[$hundval] . " Hundred";
  }

// handle units and teens
$workstr = "";
$tensval = $workval - ($hundval * 100); // dump the 100's
if (($tensval < 20) && ($tensval > 0))// do the teens
  {
  $workstr = $numwords[$tensval];
  }
else // got to break out the units and tens
  {
  $tempval = ((integer)($tensval / 10)) * 10; // dump the units
  $workstr = $numwords[$tempval]; // get the tens
  $unitval = $tensval - $tempval; // get the unit value
  if ($unitval > 0)
    {
    $workstr .= " " . $numwords[$unitval];
    }
  }

// join all the parts together and leave
if ($workstr != "")
  {
  if ($retstr != "")
    {
    $retstr .= " " . $workstr;
    }
  else
    {
    $retstr = $workstr;
    }
  }
return $retstr;
}

// userType Permissions!!!


function checkPerms($userPerms,$pagePerms){
	$checkPerms = true;
	for($i=0 ; $i<10 ; $i++){
		$userbit = substr($userPerms,$i,1);
		$pagebit = substr($pagePerms,$i,1);

		// if user is Super User, Bit 1 should be 1

		//echo "u:".$userbit;
		//echo " ?= p:".$pagebit;

		if($i==0){
			if($userbit==1){
				$checkPerms = true;
				//echo 'true';
				break;
			}
		}

		if($pagebit!='%'){
			if($pagebit==$userbit){
				$checkPerms = true;
				//echo 'true';
			}
			else{
				$checkPerms = false;
				//echo 'false';
				break;
			}
		}
		else{
			$checkPerms = true;
			//echo 'true';
		}

		//echo "<br>";

	}
	return $checkPerms;
}

// Convert Arrays into Comma Separated Values and vice-versa.
// Used in particular to store and retrieve $penaltyLUT in TreasurySettings

function arrayToCSV($arrayValue){
	if(is_array($arrayValue)){
		$stringValue = implode(",", $arrayValue);
		return $stringValue;
	}
}

function csvToArray($stringValue){
	$arrayValue = explode(",", $stringValue);
	return $arrayValue;
}

// convert '&' to 'and' for xml

function ampersandToAnd($str){
	$str = str_replace("&", "and", $str);
	return $str;
}

// Get date difference between two given strtime dates
// $returntype: s = seconds, m = minutes, h = hours, d = days
// int date_diff(int start_timestr, int end_timestr[, string return_type])

function getDateDifference($start_timestr, $end_timestr, $returntype="d"){
   switch($returntype){
	case "s":
		$calc = 1;
		break;
	case "m":
		$calc = 60;
		break;
	case "h":
		$calc = (60*60);
		break;
	case "d":
	default:
		$calc = (60*60*24);
		break;
   }

   $hr_1 = date("H",$start_timestr);
   $mi_1 = date("i",$start_timestr);
   $se_1 = date("s",$start_timestr);
   $yy_1 = date("Y",$start_timestr);
   $mm_1 = date("m",$start_timestr);
   $dd_1 = date("d",$start_timestr);

   $hr_2 = date("H",$end_timestr);
   $mi_2 = date("i",$end_timestr);
   $se_2 = date("s",$end_timestr);
   $yy_2 = date("Y",$end_timestr);
   $mm_2 = date("m",$end_timestr);
   $dd_2 = date("d",$end_timestr);

   if($start_timestr >= $end_timestr){
	return 0;
   }
   else if(($yy_1 < 1970 || $yy_1 > 2037) || ($yy_2 < 1970 || $yy_2 > 2037)){
	   return 0;
   }
   else{
	   $start_stamp = mktime($hr_1,$mi_1,$se_1,$mm_1,$dd_1,$yy_1);
	   $end_date_stamp = mktime($hr_2,$mi_2,$se_2,$mm_2,$dd_2,$yy_2);
	   $difference = round(($end_date_stamp-$start_stamp)/$calc);
	   if($difference=="-0") $difference=0;
	   return $difference;
   }

}

// Get "only days" text. e.g. if number of days is 1, return "only a day" or if days is 2 or more say "only 2 days".
function getOnlyDays($dayInt){
	if($dayInt==0){
		return "less than a day";
	}
	else if($dayInt==1){
		return "only a day";
	}
	else{
		return "only ".$dayInt." days";
	}
}

// Convert hectares to square meters

function hectaresToSquareMeters($hectareValue){
	$squareMeterValue = $hectareValue * 10000;
	return $squareMeterValue;
}

?>