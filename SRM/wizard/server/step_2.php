<?php
	error_reporting(E_ERROR  | E_PARSE);
	session_start();
	require_once "../helpers/DatabaseHandler.php";
	require_once "sessionCleaner.php";
	require_once "../helpers/safeValue.php";
	
	$is_form_valid = 1;
	$page_errors = "";
	// set connection in session
	if(isset($_POST["host"]) && isset($_POST["user"]) && isset($_POST["pass"]))
	{
		unsetAllSession();
		
		$host_name = $_POST["host"];
		$user_name = $_POST["user"];
		$password =  $_POST["pass"];
		if(empty($host_name) || $host_name === '')
		{
			$form_errors = "* Please enter host name.";
			$is_form_valid = 0;
		}
		if(empty($user_name) || $user_name === '')
		{
			$page_errors .= "* Please enter user name." ;
			$is_form_valid = 0;
		}
		if($is_form_valid === 1)
		{
			$dbHandler = @new DatabaseHandler($host_name, $user_name, $password);
			if(!$dbHandler || $dbHandler->is_connection_failed())
			{
				if(!empty($page_errors)) $page_errors .="<br>";
				$page_errors .= "* Unable to connect. Please enter valid host name, user name and password";
				echo $page_errors;
				exit();
			}else
			{
				// save data in the sessions
				$_SESSION['srm_f62014_host'] = clean_input($host_name);
				$_SESSION['srm_f62014_user'] = clean_input($user_name);
				$_SESSION['srm_f62014_pass'] = base64_encode($password);
				$_SESSION['srm_f62014_validate_key'] = md5("srm_f62014_valid_1010");
			}
			echo "success";
		}else echo $page_errors;
			
		exit();
	}
	// set database and data source in session
	if(isset($_POST['db']) && isset($_POST['dataSource']))
	{
		$_POST = clean_input_array($_POST);
		unsetSessionStartFromDB();
			
		$database_name = $_POST['db'];
		$data_source = $_POST['dataSource'];
		if(empty($database_name) || $database_name === '')
		{
			if(!empty($page_errors)) $page_errors .= "<br>";
			$page_errors .="* Please enter database name.";
			$is_form_valid = 0;
		}else{
			$dbHandler = @new DatabaseHandler($_SESSION["srm_f62014_host"], $_SESSION["srm_f62014_user"], base64_decode($_SESSION["srm_f62014_pass"], $database_name));
			if(!$dbHandler || $dbHandler->is_connection_failed())
			{
				if(!empty($page_errors)) $page_errors .="<br>";
				$page_errors .= "* Unable to connect. Please enter valid host name, user name, password and database";
				$is_form_valid = 0;
			}
			
			else if (!$dbHandler->select_database($database_name)) {
				$page_errors = "* Database Not Found (doesn't exists!).";
				$is_form_valid = 0;
			}
			
		}
		if($is_form_valid === 1)
		{
			$_SESSION['srm_f62014_db'] = $database_name;
			$_SESSION['srm_f62014_db_extension'] = $dbHandler->get_db_handler_type();
			$_SESSION['srm_f62014_datasource'] = $data_source;
			echo "success";
			exit();
		}else echo $page_errors;
		
		exit();
	}