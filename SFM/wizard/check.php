<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
if (! defined('DIRECTACESS')) exit('No direct script access allowed');
sec_session_start();
check_connection_status();
function sec_session_start(){
ini_set('session.use_only_cookies', 1);	
	session_start();
	session_regenerate_id();
}
function check_connection_status(){
global $_SESSION;
if(!array_key_exists('sfm_f314_connected',$_SESSION) || $_SESSION["sfm_f314_connected"]!= md5("connected_successfully"))
  header("Location: ../index.php");
}








?>