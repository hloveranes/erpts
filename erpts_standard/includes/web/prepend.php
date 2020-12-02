<?php
/*
 * Session Management for PHP3
 *
 * Copyright (c) 1998-2000 NetUSE AG
 /*                    Boris Erdmann, Kristian Koehntopp
 *
 * $Id: prepend.php,v 1.1.1.1 2003/06/13 03:44:42 ravage Exp $
 *
 */ 

if (!isset($_PHPLIB) or !is_array($_PHPLIB)) {
# Aren't we nice? We are prepending this everywhere 
# we require or include something so you can fake
# include_path  when hosted at provider that sucks.
  $_PHPLIB["libdir"] = ""; 
}

#require($_PHPLIB["libdir"] . "db_mysql.inc");  /* Change this to match your database. */
#require($_PHPLIB["libdir"] . "ct_split_mysql.inc");    /* Change this to match your data storage container */
require($_PHPLIB["libdir"] . "common.inc");
require($_PHPLIB["libdir"] . "constants.php");
require($_PHPLIB["libdir"] . "setup.inc");
require($_PHPLIB["libdir"] . "session.inc");
require($_PHPLIB["libdir"] . "auth.inc");
require($_PHPLIB["libdir"] . "perm.inc");
require($_PHPLIB["libdir"] . "db_mysql.inc");
require($_PHPLIB["libdir"] . "tr_rpts.inc");
require($_PHPLIB["libdir"] . "ct_split_mysql.inc");
require($_PHPLIB["libdir"] . "page.inc");      /* Required, contains the page management functions. */
require($_PHPLIB["libdir"] . "template.inc");  /* Required, contains the template management functions. */
require($_PHPLIB["libdir"] . "local.inc");
?>
