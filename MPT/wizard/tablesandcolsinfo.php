<?php
	/**
	 * get columns and tables form selected database to use it in wizard
	**/
define("DIRECTACESS", "true");
require_once('../shared/shared.php');
$login->headerTo(false, "login.php?from=setconfig");
/* AJAX check [if not ajax will display this message] */
if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
	die('No direct script access allowed');
}
	/*
	ini_set('session.use_only_cookies', 1);	
	$cookieParams = session_get_cookie_params();
	session_set_cookie_params($cookieParams["lifetime"],$cookieParams["path"],$cookieParams["domain"],$cookieParams["secure"], true);
	session_start();
	session_regenerate_id();
	*/
	require_once '../tables/common/bll/helpers/DatabaseHandler.php'; 
	if(isset($_SESSION['PT_temp_dbConnected']) && $_SESSION['PT_temp_dbConnected'] === 'pt_con_verify')
	{
		$host = $_SESSION['pt_str_host'];
		$user = $_SESSION['pt_str_user'];
		$pass = base64_decode($_SESSION['pt_str_pass']);
		$db = $_SESSION['pt_str_db'];
		// --------------------------------------------
		
		$dbObject = new DatabaseHandler($host, $user, $pass, $db);
		$dbObject->select_database(strtolower($db));
		
		// ----------------------------------------------
		// to get tables list
		// SHOW FULL TABLES WHERE Table_Type != 'VIEW'
		// SHOW FULL TABLES WHERE Table_Type = 'BASE TABLE'
		$tables = $dbObject->query("SHOW FULL TABLES WHERE Table_Type = 'BASE TABLE'", 'ASSOC'); // 'Tables_in_'.$db		
		$arr = array();
		foreach($tables as $key => $value)
		{
			$table = $value['Tables_in_'.$db];
			
			$arr['tables'][] = $table;
			// "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '". $table ."'"
			$columns = $dbObject->query("SHOW COLUMNS FROM ". $table, 'ASSOC'); // 'COLUMN_NAME' , 'Field'
			$arr_columns = array();
			foreach($columns as $k => $val) $arr_columns[] = $val['Field'];
			$arr['columns'][$table] = $arr_columns;
		}
		echo json_encode($arr);
	}
        ?>