<!--
function isNumeric(sText)
{

	/* isNumeric method
	for (i = 0; i < sText.length; i++) { 
		sText.replace(',','');
	}
	var ValidChars = "0123456789.";
	var IsNumber=true;
	var Char;
	for (i = 0; i < sText.length && IsNumber == true; i++) { 
		Char = sText.charAt(i); 
		if (ValidChars.indexOf(Char) == -1) {
			IsNumber = false;
		}
	}
	return IsNumber;
	*/

	// isNaN method
	sText = unformatCurrency(num);
	if(isNaN(sText)){
		return = false;
	}
	return true;
}
function formatCurrency(num) {
	num = num.toString().replace(/\P|\,/g,'');
	if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10) cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
			num = num.substring(0,num.length-(4*i+3))+','+num.substring(num.length-(4*i+3));
	return (((sign)?'':'-') + num + '.' + cents);
}
function unformatCurrency(num) {
	for (i = 0; i < num.length; i++) { 
		num = num.replace(',','');
	}
	return num;
}
function roundToNearestTen(n){
	n = Math.round(n);
	m = n%10;
	if(m>=5){
	   n = n+(10-m);
	}
	else{
	   n = n-m;
	}
	return(n);
}
// -->
