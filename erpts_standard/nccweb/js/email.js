<!--
function checkEmail(email) {
	var ss1,ss2;
	
	ss1=email;
	ss2=ss1.split(" ");
	if (ss2.length>1) {
		return false;
	}
	ss2=ss1.split("@");
	if (ss2.length!=2) {
		return false;
	}

	ss1=ss2[1].split(".");
	if (ss1.length<2) {
		return false;
	}
	return true;
}
// -->
