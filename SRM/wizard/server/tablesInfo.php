<?php
	error_reporting(E_ERROR  | E_PARSE);
	session_start();
	define("SYSTEM_CONTROL", true);
	require_once "../lib.php";
	require_once "../helpers/safeValue.php";
	// this send json to client side in step_3.php with table and columns and column type
	if(isset($_POST["tablesInfo"]) && isset($_SESSION["srm_f62014_table"]))
	{
		foreach($_SESSION["srm_f62014_table"] as $key => $val)
		{		
			$val = clean_input($val);
			$tablesInfo[$val] = array();
			$result = $dbHandler->query("DESCRIBE `$val`", "ASSOC");
			foreach($result as $k => $value)
			{
				$type = (strpos($value["Type"], "(")) ? substr($value["Type"], 0, strpos($value["Type"], "(")) : $value["Type"];
				$type = strtolower($type);
				$tablesInfo[$val][$value["Field"]] = $type;
			}
		}
		$json = json_encode($tablesInfo);
		echo $json;
		exit();
	}