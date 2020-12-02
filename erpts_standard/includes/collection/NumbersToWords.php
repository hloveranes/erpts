<?php
/*-- 
This script is a conspired effort between Onslaught and Yawmark. 
It converts numeric values to english. 
--*/ 

/*-- 
basic rework of number_format with no arguments 
if you call number_format with a number that is too 
large, everything from a certian point will turn into zeros 
--*/ 
class NumbersToWords{
	
	var $flag = 1;	
	function NumbersToWords(){
	}
	
	function large_number_format($str) { 
		$working = strrev((string)$str); 
		$length = strlen((string)$str); 
		for ($cntr = 0; $cntr < $length; $cntr += 3) 
			$temp[]=substr($working,$cntr,3); 
			$temp = implode(',',$temp); 
			
		return (strrev($temp)); 
	} 
	
	/*-- converts whole numbers from 0 - 999 to "english" --*/ 
	function get_triad($int) { 
	/*-- 
	if the value passed is all zeros then return null, 
	else trim the any leading zeros from the value 
	--*/ 
		if ($int == '000' || $int == '00'){ 
			$int = '0';
			return null; 
		}
		else 
			$int=(int)$int; 
		
		$ret_str = null; 
		$temp = (string)$int; 
		$length = strlen($temp); 
		$single = array(0 => 'Zero', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 
						5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine'); 
		$teens = array(1 => 'Eleven', 2 => 'Twelve', 3 => 'Thirteen', 4 => 'Fourteen',5 => 'Fifteen', 
					   6 => 'Sixteen', 7 => 'Seventeen', 8 => 'Eighteen', 9 => 'Nineteen');
		$double = array(1 => 'Ten', 2 => 'Twenty', 3 => 'Thirty', 4 => 'Forty', 5 => 'Fifty', 
						6 => 'Sixty', 7 => 'Seventy', 8 => 'Eighty', 9 => 'Ninety'); 
		
		switch ($length) { 
			case 1: 
			/*-- $int < 1,000 --*/ 
				$ret_str .= $single[(int)$temp]; 
				break; 
			case 2: 
			/*-- tens / teens --*/ 
				if ((int)$temp > 10 && (int)$temp < 20) 
					$ret_str .= $teens[(int)substr($temp, 1)]; 
				else { 
					$ones = (int)substr($temp, 1) ? ' ' . $single[(int)substr($temp, 1)] : null; 
					$ret_str .= $double[(int)substr($temp, 0, 1)] . $ones; 
				} 
				break; 
			case 3: 
			/*-- hundreds --*/ 
				$ones = (int)substr($temp, 1); 
				$ones = ($ones > 0) ? ' ' . $this->get_triad((int)substr($temp, 1)) . ' ' : ''; 
				$ret_str .= $single[(int)substr($temp, 0, 1)] . ' hundred' . $ones; 
				break; 
			} 
			return $ret_str; 
		} 
	
	function num_to_string($value) {
		/*-- if the number is so large that it is in scientific notation, don't process --*/ 
		if (strstr((string)$value,'E+')) { 
			trigger_error('The number passed to num_to_string() is too large. Please pass it as a string value.', E_USER_NOTICE); 
		return null; 
		} 
	
		/*-- if any alphabetic characters passed, don't process --*/ 
		if (preg_match('![A-Z]!is',$value)) { 
			trigger_error('The value passed to num_to_string() must be numeric in nature.',E_USER_NOTICE); 
		return null; 
		} 
	
		/*-- convert to a string for manipulation --*/ 
		if (is_numeric($value)) 
			$value = (string)$value; 
	
		/*-- check for negative --*/ 
		if (strstr($value,'-')) { 
			$negative = true; 
			$value = str_replace('-','',$value); 
		} 
	
		/*-- check for a decimal --*/ 
		if (strstr($value,'.')) { 
			$temp = explode('.',$value); 
			$value = $temp[0];
			$double = $temp[1]; 
		} 
	
		/*-- handle numbers up to 10^65 --*/ 
		$multiple = array(0=>'', 1=>'thousand', 2=>'million', 3=>'billion', 4=>'trillion', 
						  5=>'quadrillion', 6=>'quintillion', 7=>'sextillion', 8=>'septillion', 9=>'octillion', 
					   	  10=>'nonillion', 11=>'decillion', 12=>'undecillion', 13=>'duodecillion', 
						  14=>'tredecillion', 15=>'quattuordecillion', 16=>'quindecillion', 17=>'sexdecillion', 
						  18=>'septendecillion', 19=>'octodecillion', 20=>'novemdecillion', 21=>'vigintillion'); 
	
		/*-- split the number into groups of three --*/ 
		$str = $this->large_number_format(str_replace(",","",$value));
		$str = explode(",",$str); 
	
		/*-- prevent array index errors if number too big --*/ 
		$counter = count($str); 
		if ($counter > count($multiple)) { 
			$error='The number you passed to num_to_string() is larger that 10<span style="font-size:x-small; '. 
			'vertical-align:super;">65</span>. This number is to large to return an english '. 
			'representation of it.<br />'; 
		trigger_error($error,E_USER_NOTICE); 
		return null; 
		} 
	
		/*-- assemble the output --*/
		for ($i = 0; $i < count($str); $i++) { 
			$counter--; 
			$temp = $this->get_triad((string)$str[$i]);
			$num .= ($temp) ? "$temp $multiple[$counter] " : " ";
		} 
	
		/*-- account for negative numbers --*/ 
		$num = ($negative) ? 'Negative '.$num : $num;
		
		if(($this->flag == 1) && (!($str[0] == 0))){ # append Pesos if number is > 0
			$num.= 'Pesos ';
		}
		
		/*-- handle decimal points --*/ 
		if ($double) {
			$length = strlen((string)$double);
			switch ($length) { 
				case 1:
				case 2:
				case 3: 						     # Tenths, Hundredths, Thousandths
					if(strlen($num) == 0)            # if cents only, no need for separator
						$seperator = ''; 
					else
						$seperator = ' and '; 
					$end=' Centavos'; 
					break; 
				default: 
					$seperator = ' point '; 
					$end=null; 
					break; 
			}
			$this->flag = 0; 
			$double = $this->num_to_string($double); 
			if ($double==' ') $double="zero";
			if(!$double)
				$num.="$double"; 				     # if no value, no need for suffix Pesos and Centavos
			else
				$num.="$seperator$double$end"; 
		} 
		return strtolower($num); 
	} 
	
}
?>
