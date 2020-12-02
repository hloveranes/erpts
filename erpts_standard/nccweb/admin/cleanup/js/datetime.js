//Date & Time Functions
var monthStr=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
var days=new Array(31,29,31,30,31,30,31,31,30,31,30,31);
var date=new Date();

//var day=date.getDate();
//var month=date.getMonth();
//var year=date.getYear();

function clearCombo(obj) {
	for (i = obj.length; i>=0; i--)
		obj.options.remove(i)
}
function buildMonth(obj,mm) {
	//alert(mm);
	for (i = 1; i <= 12; i++) {
		obj.options[i-1] = new Option();
		obj.options[i-1].value = i;
		obj.options[i-1].text = monthStr[i-1];
	}
	if (mm=="" || typeof(mm)=="undefined") 
		obj.options[month-1].selected=true;
	else
		obj.options[mm-1].selected=true;
}
function buildDay(obj,lastday,dd) {
	
	
	for (i = 1; i <= lastday; i++) {
		obj.options[i-1] = new Option();
		obj.options[i-1].value = i;
		obj.options[i-1].text = i;
		
		
	}
	
	if (dd=="" || typeof(dd)=="undefined") {
		//obj.options[6].selected=true;
		obj.options[day-1].selected=true;
	}
	else {
		
		obj.options[dd-1].selected=true;
	}
}

function buildYear(obj,offset,extend,yy) {
	for (i = (year-offset); i <= (year+extend); i++) {
		obj.options[i-(year-offset)] = new Option();
		obj.options[i-(year-offset)].value = i;
		obj.options[i-(year-offset)].text = i;
	}

	if (yy=="" || typeof(yy)=="undefined"){
		obj.options[offset].selected=true;
	}
	else{
		obj.options[(yy-year+offset)].selected=true;
	}
}
function rebuildDay(iform) {
	buffer=iform.dd.value;
	clearCombo(iform.dd);
	lastday=days[iform.mm.value-1];
	if (iform.mm.value==2 && iform.yy.value%4!=0) {
		lastday=lastday-1;
	}
	buildDay(iform.dd,lastday);
	iform.dd.options[buffer-1].selected=true;
}

function rebuildDay2(iform,mm,dd,yy) {
	buffer=eval("iform."+dd+".value");
	clearCombo(eval("iform."+dd));
	lastday=days[eval("iform."+mm+".value")-1];
	if (eval("iform."+mm+".value")==2 && eval("iform."+yy+".value")%4!=0) {
		lastday=lastday-1;
	}
	buildDay(eval("iform."+dd),lastday);
	eval("iform."+dd+".options[buffer-1].selected=true");
}

function buildHour(obj,limit,interval,thisHour) {
	for (i=0,j=0;j<=limit;i++,j=j+interval) {
		val=j;
		if (val<10)
			val="0"+val;

		obj.options[i] = new Option();
		obj.options[i].value = val;
		obj.options[i].text = val;

		if ((j==parseInt(thisHour)) || ((j<parseInt(thisHour)) && (parseInt(thisHour)<(j+interval))))
			obj.options[i].selected=true;
		else
			obj.options[i].selected=false;
	}
}
function buildMinute(obj,limit,interval,thisMinute) {
	for (i=0,j=0;j<=limit;i++,j=j+interval) {
		val=j;
		if (val<10)
			val="0"+val;

		obj.options[i] = new Option();
		obj.options[i].value = val;
		obj.options[i].text = val;

		if ((j==parseInt(thisMinute)) || ((j<parseInt(thisMinute)) && (parseInt(thisMinute)<(j+interval))))
			obj.options[i].selected=true;
		else 
			obj.options[i].selected=false;
	}
}

function buildMonth2(obj,mm) {
	//alert(mm);
	for (i = 1; i <= 12; i++) {
		obj.options[i] = new Option();
		obj.options[i].value = i;
		obj.options[i].text = monthStr[i-1];
	}
	if (typeof(mm)=="undefined") 
		obj.options[month].selected=true;
	else
		if (mm!=0)
			obj.options[mm].selected=true;
}
function buildDay2(obj,lastday,dd) {
	for (i = 1; i <= lastday; i++) {
		obj.options[i] = new Option();
		obj.options[i].value = i;
		obj.options[i].text = i;
	}
	
	if (typeof(dd)=="undefined") {
		obj.options[day].selected=true;
	}
	else {
		if (dd!=0)
		obj.options[dd].selected=true;
	}
}

function buildYear2(obj,offset,extend,yy) {
	for (i = (year-offset); i <= (year+extend); i++) {
		obj.options[i-(year-offset)+1] = new Option();
		obj.options[i-(year-offset)+1].value = i;
		obj.options[i-(year-offset)+1].text = i;
	}

	if (typeof(yy)=="undefined"){
		obj.options[offset+1].selected=true;
	}
	else{
		if (yy!=0)
			obj.options[(yy-year+offset)+1].selected=true;
	}
}

function rebuildDay3(iform,mm,dd,yy) {
	buffer=eval("iform."+dd+".value");
	clearCombo2(eval("iform."+dd));
	lastday=days[eval("iform."+mm+".value")-1];
	if (eval("iform."+mm+".value")==2 && eval("iform."+yy+".value")%4!=0) {
		lastday=lastday-1;
	}
	buildDay2(eval("iform."+dd),lastday);
	eval("iform."+dd+".options[buffer].selected=true");
}

function clearCombo2(obj) {
	for (i = obj.length; i>0; i--)
		obj.options.remove(i)
}
