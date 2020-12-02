<?php
function buildLeftNav(){
	global $tpl;
	
	$tpl->set_file(array(teci_leftnav=>("leftnav.htm")));
	$tpl->set_block(teci_leftnav,LEFTNAV,leftnav);
	$tpl->parse(leftnav,LEFTNAV,true);
}

function abuildLeftNav(){
	global $tpl;
	
	$tpl->set_file(array(teci_leftnav=>("../leftnav.htm")));
	$tpl->set_block(teci_leftnav,LEFTNAV,leftnav);
	$tpl->parse(leftnav,LEFTNAV,true);
}

?>