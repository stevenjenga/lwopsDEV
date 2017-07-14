<?php
error_reporting(E_ERROR  | E_PARSE);
ini_set( 'magic_quotes_gpc', 0 );
session_start();
if(!isset($_SESSION['ks_chv2_Login_key']) || $_SESSION['ks_chv2_Login_key'] != "1701Abbb Connect Success")
header("Location:step_2.php");
$_GET = array();
?>