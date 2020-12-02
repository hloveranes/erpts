<?php
//			********************************
#				dbpaging v 1.1
#				Created by Liv Castillo 
#				K2 Inter[a]ctive Inc. 
#				Copyright 2001
//			*********************************
/*
Instructions:
	1. Save this file into your php include_path (check your php.ini where you specified your include path).
	2. Include this file to your prepend.inc  (MAKE SURE THAT YOU INCLUDE THIS FILE BEFORE YOUR LOCAL.INC)
	3. Modify your local.inc to extend this class instead of DB_Sql

Format:
$Variable -- will be an instantiation of your db class
$Variable->query(sql statement, page number, number of records per page); 

Added Features:
num_page() - returns the number of pages returned by the query 

Note:
if you don't add any parameters for the page number and the number of records per page, the funtion
will just execute the sql statement
*/

class DB_Paging extends DB_Sql {
var $records= ""; //this will hold the records of a given page
var $pageNo = ""; //variable that will store the page number that the user requested
var $RecPage = ""; //variable that will hold the number of records per page
var $MaxRec = ""; //variable that will store the number of records returned by the query 
var $Ctr = ""; //counts the number of records shown in next_record()
var $NumPage = ""; //number of pages 

	function query($strQuery,$page=0,$Recs=0){
		//check sql statement
		if ($strQuery==""){
			return false;
		}
		$temp = DB_Sql::query($strQuery);

		$this->pageNo=((!isset($page)) || ($page==0)) ? 0 : ($page-1);
		$this->RecPage=$Recs;

		$this->MaxRec = DB_Sql::num_rows();
		if ($this->RecPage!=0) 
			$this->NumPage=ceil($this->MaxRec/$this->RecPage);
		
		if ($this->RecPage!=0 && $this->pageNo!=0)
			DB_Sql::seek($this->RecPage * $this->pageNo);

		$this->Ctr=0;
		
		return $temp;
	}


	function next_record(){ 
		if ($this->RecPage!=0){
			$this->Ctr++;
			if (($this->pageNo>$this->NumPage) || ($this->Ctr > $this->RecPage)){
				return false;
			}
		}
	
		return DB_Sql::next_record();
	}	

	function num_rows(){
		return $this->MaxRec;
	}
	
	
	#this function prints the number of pages 
	function num_page(){
		return $this->NumPage;
	}
}
?>