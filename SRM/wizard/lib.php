<?php
defined('SYSTEM_CONTROL') or die (header('location: ../wizard'));
require_once 'helpers/DatabaseHandler.php';
$host = isset($_SESSION["srm_f62014_host"]) ? $_SESSION["srm_f62014_host"] : '';
    $user = isset($_SESSION["srm_f62014_user"]) ? $_SESSION["srm_f62014_user"] : '';
    $pass = isset($_SESSION["srm_f62014_pass"]) ? base64_decode($_SESSION["srm_f62014_pass"]) : '';
    $key = isset($_SESSION["srm_f62014_validate_key"]) ? $_SESSION["srm_f62014_validate_key"] : '';
    $db = isset($_SESSION["srm_f62014_db"]) ? $_SESSION["srm_f62014_db"] : '';
	
	// return to first page if required session not found
	if(!isset($url)) $url = "../../wizard/";
	if($key !== md5("srm_f62014_valid_1010"))
	{
		header("location: $url?id=0");
		exit();
	}
	// get instance from DatabaseHandler class
	$dbHandler = @new DatabaseHandler($host, $user, $pass, $db);
	if(!$dbHandler || $dbHandler->is_connection_failed()) 
	{
		header("location: $url?id=0");
		exit();
	}
	/*
		else if(!@$dbHandler->select_database($db))
		{
			header("location: $url?id=0");
			exit();
		}
	*/
	// validate sql statement
	function make_valide($sql)
	{
		if(get_magic_quotes_gpc()) $sql = stripslashes($sql);
		$sql = str_replace("'", '"',$sql);
		$sql = str_replace("\r\n"," ",$sql);
		$sql = str_replace("\n"," ",$sql);
		$sql = str_replace(";","",$sql);
		return $sql;
	}
?>