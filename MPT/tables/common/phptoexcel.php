<?php
	/**
	 * this file used to export pivot table as Excel file
	**/
	ob_start();
        define("DIRECTACESS", "true");
	ini_set('memory_limit','1024M');
	ini_set('max_execution_time','600');
	//require_once('../../shared/shared.php');
      //  $login->headerTo(false, "../../wizard/login.php?from=setconfig");
	if(isset($_POST['location']) && !empty($_POST['location']))
	{
		// get where to export pivot table
		$cwd = str_replace('0_X_SLASH_X_0', DIRECTORY_SEPARATOR, $_POST['location']);

		require_once $cwd . '/config.php';
		
	
		require_once 'phpexcel/PHPExcel.php';
		require_once 'bll/phpexcel.php';
		require_once 'bll/csinglep.php';
		
		// Generate Excel file from pivot table process depend on phpexcel class
		$obj_PhpToExcel->setTableHeader($CsingleP->tableHeader_array);
		
		// handle pivot table body and make sure it valid to rendering operation
		$CsingleP->get_tableBodyLimit();
		
		$tableBody_array = array();
		foreach($CsingleP->TableBodyPaginationLimit_array as $key => $value)
		{
			$row_array = array();
			foreach($value as $val)
			{
				if(empty($val) && $IsNumeric === true)
					$val = 0;
				$row_array[] = $val;
			}
			
			$tableBody_array[] = $row_array;
		}
		
		$obj_PhpToExcel->setTableData($tableBody_array);
		
		// handle totals and make sure it valid to rendering operation
		$eachColumn = array();
		foreach($tableBody_array as $value)
		{
			foreach($value as $key => $val)
			{
				if($key === 0)
					continue;
				else {
					if(!isset($eachColumn[$key]))
						$eachColumn[$key] = array();
					
					$eachColumn[$key][] = floatval($val);
				}
			}
		}

		$gfunc = $_POST["func"];
		$total = array("Total");
		foreach($eachColumn as $value)
		{
			if($gfunc == 'max')
				$total[] = max($value);
			else if($gfunc == 'min')
				$total[] = min($value);
			if($gfunc == 'sum' || $gfunc == 'count' || $gfunc == 'avg')
				$total[] = array_sum($value);
		}

		$obj_PhpToExcel->setTableTotal($total);
		
		$style = (isset($_POST['style'])) ? $_POST['style'] : 'blue';
		
		$obj_PhpToExcel->execute($cwd . '/index.php', $style);		
	}