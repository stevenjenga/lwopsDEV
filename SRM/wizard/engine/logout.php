<?php
/**
* Smart Report Maker
* Author : StarSoft 
*All copyrights are preserved to StarSoft
*http://mysqlreports.com/
*
*/
session_start();
error_reporting(E_ERROR  | E_PARSE);
session_destroy();  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
header("Location: login.php");

?>