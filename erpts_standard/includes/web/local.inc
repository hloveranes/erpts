<?php
/*
 * Session Management for PHP3
 *
 * Copyright (c) 1998-2000 NetUSE AG
 *                    Boris Erdmann, Kristian Koehntopp
 *
 * $Id: local.inc,v 1.1.1.1 2003/06/13 03:44:41 ravage Exp $
 *
*/
class DB_address extends DB_Sql{
  var $Host     = "localhost";
  var $Database = "";
  var $User     = "root";
  var $Password = "palitanmoto";
}

class DB_Report extends DB_Transaction{
  var $Host     = "localhost";
  var $Database = "";
  var $User     = "root";
  var $Password = "palitanmoto";
  var $Halt_On_Error = "no"; //extension property
  
  function DB_Report($dbName){
	$curr = getcwd();
	$folders = explode("/",$curr);
	foreach ($folders as $folder) {
		if (substr($folder,0,5) == "erpts") break;
	}
	$this->Database = $folder;
  }
}

class DB_SelectLGU extends DB_Transaction{
  var $Host     = "localhost";
  var $Database = "";
  var $User     = "root";
  var $Password = "palitanmoto";
  var $Halt_On_Error = "no"; //extension property
  
  function DB_SelectLGU($lguName){
	$this->Database = $lguName;
  }

  function connect($Database = "", $Host = "", $User = "", $Password = "") {
    /* Handle defaults */
    if ("" == $Database)
      $Database = $this->Database;
    if ("" == $Host)
      $Host     = $this->Host;
    if ("" == $User)
      $User     = $this->User;
    if ("" == $Password)
      $Password = $this->Password;

    /* establish connection, select database */
    if ( 0 == $this->Link_ID ) {
    
      $this->Link_ID=mysql_pconnect($Host, $User, $Password);
      if (!$this->Link_ID) {
        $this->halt("pconnect($Host, $User, \$Password) failed.");
        return 0;
      }

      if (!@mysql_select_db($Database,$this->Link_ID)) {
        $this->halt("cannot use database ".$this->Database);
        return 0;
      }
    }
    
    return $this->Link_ID;
  }
}



class DB_rpts extends DB_Transaction {
  var $Host     = "localhost";
  var $Database = "";
  var $User     = "root";
  var $Password = "palitanmoto";
  var $Halt_On_Error = "no"; //extension property

  function setDatabase($database){
	$curr = getcwd();
	$folders = explode("/",$curr);
	foreach ($folders as $folder) {
		if (substr($folder,0,5) == "erpts") break;
	}
	$this->Database = $folder;
	mysql_close($this->LinkID);
	$this->LinkID = 0;
	$this->connect();
  }
}

class DB_Records extends DB_Transaction {
  var $Host     = "localhost";
  var $Database = "Records";
  var $User     = "root";
  var $Password = "palitanmoto";
  var $Halt_On_Error = "no"; //extension property

  function setDatabase($database){
	$this->Database = $database;
	mysql_close($this->LinkID);
	$this->LinkID = 0;
	$this->connect();
  }
}

class rpts_CT_Split_Sql extends CT_Split_Sql {
  var $database_class = DB_CLASS;         ## Which database to connect...
  var $database_table = "active_sessions_split"; ## and find our session data in this table.
  var $split_length = 4096;                    ## Split rows every 4096 bytes
}

class rpts_Session extends Session {
  var $classname = "rpts_Session";

  var $cookiename     = "";                ## defaults to classname
  var $magic          = "Hocuspocus";      ## ID seed
  var $mode           = "get";          ## We propagate session IDs with cookies
  var $fallback_mode  = "cookie";
  var $lifetime       = 1;                 ## 0 = do session cookies, else minutes
  var $that_class     = "rpts_CT_Split_Sql"; ## name of data storage container
  var $gc_probability = 5;  
  var $allowcache     = "nocache";

  function add_query($qarray) {
    global $PHP_SELF;
    global $QUERY_STRING;

    if ($this->mode == "get") {
      $sep_char = "&";
    } else {
      $sep_char = "?";
    }

    $qstring = "";
    while (list($k, $v) = each($qarray)) {
      $qstring .= $sep_char . urlencode($k) . "=" . urlencode($v);
      $sep_char = "&";
    }

    return $qstring;
  }
}

class rpts_Challenge_Auth extends Auth {
  var $classname      = "rpts_Challenge_Auth";

  var $lifetime       =  30;

  var $magic          = "Simsalabim";  ## Challenge seed
  var $database_class = DB_CLASS;
  var $database_table = "auth_user_md5";

  function auth_loginform() {
    global $sess;
    global $_PHPLIB;
    include($_PHPLIB["libdir"] . "crlogin.htm");
  }
  
  function auth_validatelogin() {
    global $username, $password;
	//echo $username."=>".$password;
    if(isset($username)) {
      $this->auth["uname"]=$username;        ## This provides access for "loginform.ihtml"
    }
    
    
    $uid = false;
    $this->db = new $this->database_class;
    $sql = sprintf("select userID, perms, userType ".
                             "        from %s ".
                             "       where username = '%s' ".
                             "         and password = '%s'".
			     "         and   status = 'enabled'"
			     ,
                          $this->database_table,
                          addslashes($username),
                          addslashes(md5($password)));
	$this->db->query($sql);
	
    while($this->db->next_record()) {
      $uid = $this->db->f("userID");
      $this->auth["perm"] = $this->db->f("perms");
	  $this->auth["uid"]=$this->db->f("userID");
	  $this->auth["userType"]=$this->db->f("userType");
    }

    return $uid;
  }
}

class rpts_Perm extends Perm {
  var $classname = "rpts_Perm";
  
  var $permissions = array(
                            "registrant" => 0,
                            "user"       => 1,
                            "admin"      => 2
                          );

  function perm_invalid($does_have, $must_have) {
    global $perm, $auth, $sess;
    global $_PHPLIB;
    
    include($_PHPLIB["libdir"] . "perminvalid.ihtml");
  }
}

class rpts_Template extends Template {
  var $classname = "rpts_Template";
  var $root = ".";
}

?>
