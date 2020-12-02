var TimeOutODMenu = null;
var TimeOutAFSMenu = null;
var TimeOutFAASMenu = null;
var TimeOutTDMenu = null;
var TimeOutRPTOPMenu = null;

function ShowODMenu(){
	MM_showHideLayers('od','','show','afs','','hide','faas','','hide','td','','hide','rptop','','hide'); 
}
function ClearODMenuTimer(){
	window.clearTimeout(TimeOutODMenu);
}
function TriggerODMenuTimer(){
	TimeOutODMenu = window.setTimeout('HideODMenu();',500); 
}
function HideODMenu(){
	MM_showHideLayers('od','','hide');
	ClearODMenuTimer();
}

function ShowAFSMenu(){
	MM_showHideLayers('od','','hide','afs','','show','faas','','hide','td','','hide','rptop','','hide'); 
}
function ClearAFSMenuTimer(){
	window.clearTimeout(TimeOutAFSMenu);
}
function TriggerAFSMenuTimer(){
	TimeOutAFSMenu = window.setTimeout('HideAFSMenu();',500); 
}
function HideAFSMenu(){
	MM_showHideLayers('afs','','hide');
	ClearAFSMenuTimer();
}

function ShowFAASMenu(){
	MM_showHideLayers('od','','hide','afs','','hide','faas','','show','td','','hide','rptop','','hide'); 
}
function ClearFAASMenuTimer(){
	window.clearTimeout(TimeOutFAASMenu);
}
function TriggerFAASMenuTimer(){
	TimeOutFAASMenu = window.setTimeout('HideFAASMenu();',500); 
}
function HideFAASMenu(){
	MM_showHideLayers('faas','','hide');
	ClearFAASMenuTimer();
}

function ShowTDMenu(){
	MM_showHideLayers('od','','hide','afs','','hide','faas','','hide','td','','show','rptop','','hide'); 
}
function ClearTDMenuTimer(){
	window.clearTimeout(TimeOutTDMenu);
}
function TriggerTDMenuTimer(){
	TimeOutTDMenu = window.setTimeout('HideTDMenu();',500); 
}
function HideTDMenu(){
	MM_showHideLayers('td','','hide');
	ClearTDMenuTimer();
}

function ShowRPTOPMenu(){
	MM_showHideLayers('od','','hide','afs','','hide','faas','','hide','td','','hide','rptop','','show'); 
}
function ClearRPTOPMenuTimer(){
	window.clearTimeout(TimeOutRPTOPMenu);
}
function TriggerRPTOPMenuTimer(){
	TimeOutRPTOPMenu = window.setTimeout('HideRPTOPMenu();',500); 
}
function HideRPTOPMenu(){
	MM_showHideLayers('rptop','','hide');
	ClearRPTOPMenuTimer();
}

function HideMenu(){
	MM_showHideLayers('od','','hide','afs','','hide','faas','','hide','td','','hide','rptop','','hide');
}