<?php
	session_start();
	define("SYSTEM_CONTROL", true);
	require_once("../lib.php");
	require_once "sessionCleaner.php";
	require_once "../helpers/safeValue.php";
	
	if(isset($_POST['selected_view']))
	{
		$selectedView = $_POST['selected_view'];
		if($selectedView === 'None')
		{
			unset($_SESSION['srm_f62014_view']);
			echo '';
			exit();
		}
		$listOfViews = array();
		$views = $dbHandler->query("SHOW FULL TABLES IN `$db` WHERE TABLE_TYPE LIKE 'VIEW'");
		foreach($views as $value) $listOfViews[] = $value[0];
		$numOfViews = $dbHandler->get_num_rows();
		if($numOfViews > 0 && in_array($selectedView, $listOfViews))
		{
			$_SESSION['srm_f62014_view'] = $selectedView;
			$sql = $dbHandler->query("SHOW CREATE VIEW `$db`.`" . $selectedView . '`');
			$sql = $sql[0][1];
			// $sql = substr($sql , stripos($sql, 'select'));
			$sql = stristr($sql , 'select');
			echo $sql;
		}else{
			echo '';
		}
		exit();
	}
	
	// validate and set sql statement in session
	if(isset($_POST["continue_sql"]) || isset($_POST['validate_sql']))
	{
		unsetSessionStartFromDataSource();
		$sql = (isset($_POST["continue_sql"])) ? make_valide($_POST['continue_sql']) : make_valide($_POST['validate_sql']);
		
		if(is_valid_select_sql($sql) !== true)
		{
			echo is_valid_select_sql($sql);
			exit();
		}
		
		//if(!empty($sql) && $sql !== '' && !strpos(strtolower($sql), 'order by')  && !strpos(strtolower($sql), 'group by') && !strpos(strtolower($sql),'limit'))
		if(!empty($sql) && $sql !== '' && !strpos(strtolower($sql), 'order by')   && !strpos(strtolower($sql),'limit'))
                {
			$result = $dbHandler->command($sql);
			if($result === false) echo " Invalid SQL statement ";
			else if($dbHandler->is_connection_failed()) echo " Invalid SQL statement ";
			else{
				$rows = $dbHandler->get_num_rows();
				$_SESSION['srm_f62014_sql'] = trim(str_replace(";","",$sql));
				echo "success|$rows";
			}
		}else if(empty($sql) || $sql === '') echo "Please enter SQL statement";
		else if(strpos(strtolower($sql), 'order by')) echo " 'Order By' is not allowed in the sql statement, sorting could be done visually in a next step!";
		// else if(strpos(strtolower($sql),'group by')) echo " 'group by' is not allowed in the sql statement, it could be done visually in a next step!";
		else if(strpos(strtolower($sql),'limit')) echo " 'limit' is not allowed in the sql statement";
		else echo " Invalid SQL statement ";
		exit();
	}
	
	function is_valid_select_sql($sql)
	{
		$sql = strtolower($sql);
		$must = array("select ", " from ");
		$forbidden = array("drop ", "delete ", "insert ", "update ", "describe ", "desc ", "show ", "create ");
		
		foreach($must as $value) if(!strstr($sql, $value)) return '\'' . $value . '\' must be used in sql statement';
		
		foreach($forbidden as $value) if(strstr($sql, $value)) return '\'' . $value . '\' is not allowed in the sql statement';
		
		return true;
	}