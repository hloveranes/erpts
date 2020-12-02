<?php

class DB_Transaction extends DB_Sql {
  var $Halt_On_Error = "report"; //extension property
  var $Auto_Free = false;
  
  //override the halt function by incorporating the $Halt_On_Error
  //property as a setting....
  function halt($msg) {
    switch ($this->Halt_On_Error) {
    case "no":
      return false;
      break;
    case "yes":
      printf("<b>Database error:</b> %s<br>\n", $msg);
      printf("<b>mySQL Error</b>: %s (%s)<br>\n",
        $this->Errno,
        $this->Error);
      die("Session halted.");
      break;
    case "report":
      printf("<b>Database error:</b> %s<br>\n", $msg);
      printf("<b>mySQL Error</b>: %s (%s)<br>\n",
        $this->Errno,
        $this->Error);
      return false;
    default: //if Halt_On_Error has an invalid value
      printf("<b>Database error:</b> %s<br>\n", $msg);
      printf("<b>mysQL Error</b>: %s (%s)<br>\n",
        $this->Errno,
        $this->Error);
      die("Session halted.");
     break;
    }
  }
  
  function beginTransaction(){
    return $this->query("BEGIN;");
  }
 
  function endTransaction(){
    return $this->query("COMMIT;");
  }
 
  function rollbackTransaction(){
    return $this->query("ROLLBACK;");
  }
 
  function resetErrors(){
    $this->Errno = 0;
    $this->Error="";
  }
 
  function formatDBString($DBString){
    if (is_string($DBString)){
      $DBString=str_replace("\'", "''", $DBString);
      $DBString=str_replace("\\", "", $DBString);
      $DBString=str_replace("\\n", "<br>", $DBString);
      return $DBString;
    } else {
      return "";
    }
  }
}

?>