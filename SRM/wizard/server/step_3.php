<?php
	error_reporting(E_ERROR  | E_PARSE);
	session_start();
	require_once "sessionCleaner.php";
	require_once "../helpers/safeValue.php";
	// set selected table is session
	if(isset($_POST["selected_tables"]))
	{
		$_POST = clean_input_array($_POST);
		unsetSessionStartFromDataSource();
		$selecteTables = explode(",", $_POST["selected_tables"]); 
		//there is a change in the tables
		if((isset($_SESSION["srm_f62014_table"]) && ( count(array_diff($selecteTables, $_SESSION["srm_f62014_table"])) > 0 || count(array_diff($_SESSION["srm_f62014_table"], $selecteTables)) > 0 ))
			|| count($selecteTables) === 1)
		{
			unset($_SESSION['srm_f62014_relationships']);
		}
		
		if(is_array($selecteTables))
		{
			if(count($selecteTables) > 0 && $selecteTables[0] !== "" && !empty($selecteTables[0]) && $selecteTables[0] !== null && $selecteTables[0] !== "null")
			{
				$_SESSION["srm_f62014_table"] = $selecteTables;
				if(count($selecteTables) === 1) echo "success1";
				else echo "success2";
			}else{
				echo "error";
			}
		}else{
			echo "error";
		}
		
		exit();
	}
	// set selected relationship and filters is session
	if(isset($_POST["relationships"]) && isset($_POST['filters']))
	{
		// deal with filters
		$tables_filters = $_POST['filters'];
		if(get_magic_quotes_gpc()) $tables_filters = str_replace('\"','"', $_POST['filters']);
		$tables_filters =  explode(",", $tables_filters);
		
		if((!is_array($tables_filters)) || (is_array($tables_filters) && (count($tables_filters) <= 0 || empty($tables_filters[0]) 
			|| $tables_filters[0] === "" || $tables_filters[0] === null || $tables_filters[0] === "null")))
				$tables_filters = array();
				
		$_SESSION["srm_f62014_tables_filters"] = $tables_filters;
		// deal with relationships
		if(isset($_SESSION["srm_f62014_table"]) && is_array($_SESSION["srm_f62014_table"]) && count($_SESSION["srm_f62014_table"]) > 1)
		{
			$rel = explode(",", $_POST["relationships"]);
			if(is_array($rel) && count($rel) > 0 && !empty($rel[0]) && $rel[0] !== "" && $rel[0] !== null && $rel[0] !== "null")
			{
				$_SESSION["srm_f62014_relationships"] = $rel;
				echo "success";
			}else echo "error";
		}else{
			echo "success";
		}
		exit();
	}