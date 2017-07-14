<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
error_reporting(0);
if (!defined('DIRECTACESS'))
    exit('No direct script access allowed');
require_once 'helpers/DatabaseHandler.php';
$host = isset($_SESSION["sfm_f314_host"]) ? $_SESSION["sfm_f314_host"] : '';
$user = isset($_SESSION["sfm_f314_user"]) ? $_SESSION["sfm_f314_user"] : '';
$pass = isset($_SESSION["sfm_f314_pass"]) ? $_SESSION["sfm_f314_pass"] : '';
$db = isset($_SESSION["sfm_f314_db"]) ? $_SESSION["sfm_f314_db"] : '';
if ($host === '' || $user === '' || $db === '')
    header("location: step_2.php");
$dbHandler = new DatabaseHandler($host, $user, base64_decode($pass), $db, false);
if (!$dbHandler || $dbHandler->is_connection_failed())
    header("location: step_2.php");
if (!$dbHandler->select_database($db))
    header("location: step_2.php");
?>
