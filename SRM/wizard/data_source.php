<?php
	defined('SYSTEM_CONTROL') or die (header('location: ../wizard'));
	require_once("lib.php");
	if(isset($_SESSION['srm_f62014_validate_key']) && $_SESSION['srm_f62014_validate_key'] === md5("srm_f62014_valid_1010") && isset($_SESSION['srm_f62014_datasource']))
	{
		// handle what user selected in data source and display what user expect
		if($_SESSION['srm_f62014_datasource'] === "sql") require_once "step_3_sql.php";
		else require_once "step_3.php";
	}