<?php

	/*
		this file will used from (setconfig.php) this engine handle the logic of whole wizard and generate new table
	*/

	/*	:: User clicked disconnect btn in setconfig.php
		End connection with database
	*/
if (! defined('DIRECTACESS')) exit('No direct script access allowed');
	if(isset($_POST['connection']) && $_POST['connection'] === 'false')
	{
		if(isset($_SESSION['PT_temp_dbConnected']) && isset($_SESSION['pt_str_host']) && isset($_SESSION['pt_str_user']) 
			&& isset($_SESSION['pt_str_pass']) && isset($_SESSION['pt_str_db']))
		{
			unset(
				$_SESSION['PT_temp_dbConnected'],
				$_SESSION['pt_str_host'],
				$_SESSION['pt_str_user'],
				$_SESSION['pt_str_pass'],
				$_SESSION['pt_str_db']
			);
		}
		if(isset($_SESSION['PT_temp_dbConnected']) && isset($_SESSION['pt_str_host']) && isset($_SESSION['pt_str_user']) 
			&& isset($_SESSION['pt_str_pass']) && isset($_SESSION['pt_str_db']) && $_SESSION['PT_temp_dbConnected'] = 'pt_con_verify')
		{
			echo 'error_in_disconnect';
			exit();
		}
		echo 'success_in_disconnect';
		exit();
	}

	/*	:: User clicked connect btn in setconfig.php
		Establishing connection to database
	*/
	if(isset($_POST['dbName']) && isset($_POST['dbUser']) && isset($_POST['dbPass']) && isset($_POST['dbHost']))
	{
		$db = strtolower($_POST['dbName']);
		$user = $_POST['dbUser'];
		$pass = base64_encode($_POST['dbPass']);
		$host = $_POST['dbHost'];
		
		if($db === '' || $user === '')
		{
			echo 'empty_data';
			exit();
		}
		if($host === '') $host = 'localhost';
		
		$dbObject = new DatabaseHandler($host, $user, base64_decode($pass), $db);
		if(!$dbObject || $dbObject->is_connection_failed()) {
			echo 'error_connection';
			exit();
		} else if(!$dbObject->select_database($db)) {
			echo 'error_connection';
			exit();
		}else{
			$_SESSION['PT_temp_dbConnected'] = 'pt_con_verify';
			
			$_SESSION['pt_str_host'] = $host;
			$_SESSION['pt_str_user'] = $user;
			$_SESSION['pt_str_pass'] = $pass;
			$_SESSION['pt_str_db'] = $db;
			
			echo 'connection_success';
			exit();
		}
	}

	/*
		this will trigger when user set/change [columns:: table, field] to get if this column is date or not
		:: So we can use date functions on it (IF DATE)
	*/
	if(isset($_POST['table']) && isset($_POST['column']) && isset($_SESSION['PT_temp_dbConnected']) && $_SESSION['PT_temp_dbConnected'] = 'pt_con_verify')
	{
		if($_POST['table'] !== '' || $_POST['column'] !== '')
		{
			$table = $_POST['table'];
			$column = $_POST['column'];
			
			$host = $_SESSION['pt_str_host'];
			$user = $_SESSION['pt_str_user'];
			$pass = $_SESSION['pt_str_pass'];
			$db = $_SESSION['pt_str_db'];
			$dbObj = new DatabaseHandler($host, $user, base64_decode($pass), $db);
			
			$columnData = $dbObj->query('SHOW FIELDS FROM '.$table.' where Field = ?', 'ASSOC', array($column), 's');
			if(stristr($columnData[0]['Type'], 'date') !== false)
			{
				echo 'date';
				exit();
			}else{
				echo 'not_date';
				exit();
			}
		}else{
			echo 'not_valide_data';
			exit();
		}
	}

	/*
		:: User click generate in setconfig.php
		Generating pivot table
	*/
	if(isset($_POST['tableName']) && isset($_POST['protected']) && isset($_POST['levels']) && 
		isset($_POST['colsTable']) && isset($_POST['colsField']) && isset($_POST['colsAlias']) && isset($_POST['colsFunc']) && 
		isset($_POST['rowsTable']) && isset($_POST['rowsField']) && isset($_POST['rowsAlias']) && 
		isset($_POST['gridTable']) && isset($_POST['gridField']) && isset($_POST['gridFunc']) && 
		isset($_POST['isNumeric']) && isset($_POST['allowRowsPagination']) && isset($_POST['recordPerPage']) && isset($_POST['maxRecordsPerPage']) &&
		isset($_POST['allowColsPagination']) && isset($_POST['columnPerPage']) && isset($_POST['maxCols']) && isset($_POST['relationship'])
		)
	{
	
		if(!isset($_SESSION['PT_temp_dbConnected']) || $_SESSION['PT_temp_dbConnected'] !== 'pt_con_verify') 
		{
			echo 'error_connection';
			exit();
		}

		$XPost = clean_array($_POST);

		$tableName = $XPost['tableName'];
		$isProtected = $XPost['protected'];
		$levels = $XPost['levels'];
		
		$colsTable = $XPost['colsTable'];
		$colsField = $XPost['colsField'];
		$colsAlias = $XPost['colsAlias'];
		$colsFunc = $XPost['colsFunc'];
		
		$rowsTable = $XPost['rowsTable'];
		$rowsField = $XPost['rowsField'];
		$rowsAlias = $XPost['rowsAlias'];
		
		$gridTable = $XPost['gridTable'];
		$gridField = $XPost['gridField'];
		$gridFunc = $XPost['gridFunc'];
		
		$relationship = ($XPost['relationship'] !== 'null') ? $XPost['relationship'] : '';
		
		$isNumeric = $XPost['isNumeric'];
		
		$allowRowsPagination = $XPost['allowRowsPagination'];
		$recordPerPage = $XPost['recordPerPage'];
		$maxRecordsPerPage = 1000;//$XPost['maxRecordsPerPage'];
		
		$allowColsPagination = $XPost['allowColsPagination'];
		$columnPerPage = $XPost['columnPerPage'];
		$maxCols = 100;//$XPost['maxCols'];
		
		if(	$tableName === '' && $isProtected === '' && $levels === '' && $colsTable === '' && $colsField === '' && $rowsTable === '' &&
			$rowsField === '' && $gridTable === '' && $gridField === '' && $isNumeric === '' && $allowRowsPagination === '' &&
			$allowColsPagination === '' )
		{
			echo 'empty_data';
			exit();
		}
		
		$_SESSION['PT_folder_setting_tableName'] = $tableName;
		$_SESSION['pt_bool_protected'] = $isProtected;
		$_SESSION['pt_str_Levels'] = $levels;
		
		$_SESSION['pt_str_Ctable'] = $colsTable;
		$_SESSION['pt_str_Cfield'] = $colsField;
		$_SESSION['pt_str_Calias'] = $colsAlias;
		$_SESSION['pt_str_CfieldFunction'] = $colsFunc;
		
		$_SESSION['pt_str_Rtable'] = $rowsTable;
		$_SESSION['pt_str_Rfield'] = $rowsField;
		$_SESSION['pt_str_Ralias'] = $rowsAlias;
		
		$_SESSION['pt_bool_IsNumeric'] = $isNumeric;
		
		$_SESSION['pt_str_Gtable'] = $gridTable;
		$_SESSION['pt_str_Gcol'] = $gridField;
		$_SESSION['pt_str_Gfunc'] = $gridFunc;
		
		$_SESSION['pt_arr_relationships'] = $relationship;
		
		$_SESSION['pt_bool_AllowRowsPagination'] = $allowRowsPagination;
		$_SESSION['pt_int_recordPerPage'] = $recordPerPage;
		$_SESSION['pt_int_maxRecordPerPage'] = $maxRecordsPerPage;
		
		$_SESSION['pt_bool_AllowColsPagination'] = $allowColsPagination;
		$_SESSION['pt_int_columnPerPage'] = $columnPerPage;
		$_SESSION['pt_int_maxColumns'] = $maxCols;
		
		$folderName = preg_replace('/[ ]/', '_', $tableName);
		$folderName = preg_replace('/[^a-z0-9_]/i', '', $folderName);
		
		if (is_writable('../tables')) 
		{
			$folderPath = "../tables/$folderName";
			if(!is_dir($folderPath))
			{
				mkdir($folderPath, 0755);
				$allowed_keys = array("pt_str_host", "pt_str_user", "pt_str_pass", "pt_str_db",
		"pt_bool_protected", "pt_str_Levels", "pt_str_Ctable", "pt_str_Cfield", "pt_str_Calias", "pt_str_CfieldFunction",
		"pt_str_Rtable", "pt_str_Rfield", "pt_str_Ralias", "pt_bool_IsNumeric", "pt_str_Gtable", "pt_str_Gcol", "pt_str_Gfunc",
		"pt_arr_relationships", "pt_bool_AllowRowsPagination", "pt_int_recordPerPage", "pt_int_maxRecordPerPage",
		"pt_bool_AllowColsPagination", "pt_int_columnPerPage", "pt_int_maxColumns");
				$data = "<?php\r\n";
                                $data .= 'if (! defined("DIRECTACESS")) exit("No direct script access allowed"); '."\n";
				foreach($_SESSION as $key => $val)
				{
					if(in_array($key,$allowed_keys))
					{ 
                                            
						if(preg_match('/pt/i', $key)){
                                                      
							$data .= valide_key($key) . ' = ' . valide_val($key, $val) . ";\r\n";
                                                }
                                        }
				}
				$data .= '$maintainance_email = ""' . ";\r\n";
				$data .= '?>';
				$filePath = $folderPath . '/config.php';
				$file = fopen($filePath, 'w+') or exit("Unable to open file!");
				if ($file) {
                                       
					fwrite($file, $data);
					fclose($file);
				}else{
					echo 'error_file';
					exit();
				}
				
				$copyLog = copy('../tables/common/table.php', "$folderPath/index.php");
				if (!$copyLog) {
					echo "error_copy";
					exit();
				}
				
			}else{
			
				echo 'table_already_exists';
				exit();
			
			}		
		}else{
				echo "error_folder";
				exit();
		}
		
		foreach($_SESSION as $key => $value)
		{
			if(!in_array($key, array("pt_str_host", "pt_str_user", "pt_str_pass", "pt_str_db", "PT_Login_discard_after", 
				"PT_Login_username", "PT_Login_password", "PT_temp_dbConnected", "css", "PT_Login_validLogin")))
				unset($_SESSION[$key]);
		}
		
		echo 'verified_data';
		exit();
	}

	/*
		:: User click delete..
		Delete exists pivot table
	*/
	if(isset($_POST['folderName']))
	{
		if($_POST['folderName'] != 'common')
		{
		 	$folderName = $_POST['folderName'];
			$pvTableName = preg_replace('/[^a-z0-9_]/i', '', $folderName);
			$dir = '../tables/'.$pvTableName;
			rm_folder($dir);
			exit();
		}
	}

	/*
		remove the entire directory
	*/
	function rm_folder($dir)
	{
		if(is_dir($dir))
		{
			$folderContent = scandir($dir);
			if(is_array($folderContent))
			{
				foreach ($folderContent as $key => $val) {
					if($val !== '.' && $val !== '..' && $val !== ' ')
					{	
						if(filetype($dir."/".$val) !== 'dir') unlink($dir."/".$val);
						
					}
				}
			}
			rmdir($dir);
		}
	}

	/*
		these functions handling data type of each variable before generating [config.php]
	*/
	function valide_key($key)
	{
		
		$key = substr($key, (strripos($key, '_')+1));
			
		return '$'.$key;
	}
	function valide_val($key, $val)
	{
		if(stristr($key, 'str') !== false)
		{
			if($val !== '') $val = '"'.$val.'"';
			else $val = '""';
		}
		if(stristr($key, 'int') !== false)
		{
			$val = (int) $val;
			if($val === '') $val = 0;
		}
		if(stristr($key, 'bool') !== false)
		{
			
			if($val === 'true') $val = 'true';
			else if($val === 'false') $val = 'false';
			else $val = 'false';
		}
		if(stristr($key, 'arr') !== false)
		{
			if($val !== '')
			{
				$arr = explode(',', $val);
				$val = 'array(';
				foreach($arr as $k => $v) 
				{
				
					if($k !== 0) $val .= ', ';
					$val .= '"'.$v.'"';
				}
				$val .= ')';
			}else{
				$val = 'array()';
			}
		}
		return $val;
	}