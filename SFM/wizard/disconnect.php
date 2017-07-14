<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
define("DIRECTACESS", "true");
ob_start();
error_reporting(E_ERROR | E_PARSE);
session_start();
$_SESSION = array();
$params = session_get_cookie_params();
//delete the actual cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}
session_destroy();
require_once "lib.php";
$dbHandler->close_connection();
header("location: step_2.php");
ob_end_flush();
?>