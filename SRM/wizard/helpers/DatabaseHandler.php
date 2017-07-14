<?php
	require_once 'MysqlHandler.php';
	require_once 'MysqliHandler.php';
	require_once 'PDOHandler.php';

	class DatabaseHandler
	{
		
		protected	$link,
					$debug = false;
		
		public $extension = '';
		
		public function __construct($host, $user, $pass, $db = '', $extension = '')
		{
			$this->extension = $extension;
			if(extension_loaded('mysqli') && function_exists('mysqli_stmt_get_result') && ($this->extension === '' || $this->extension === 'Mysqli')) 
			{
				$this->link = new MysqliHandler($host, $user, $pass, $this->debug);
				$selected_db_ok = true;
				if($db !== '') $selected_db_ok = $this->select_database($db);
				if($this->link !== false && $selected_db_ok !== false) return true;
				else return false;
			}
			else if(extension_loaded('pdo') && version_compare(PHP_VERSION, '5.1.0') >= 0 && ($this->extension === '' || $this->extension === 'PDO'))
			{
				if($db === '') 
				{
					if(extension_loaded('mysqli')) 
						return $this->link = new MysqliHandler($host, $user, $pass, $this->debug);
					else
						return $this->link = new MysqlHandler($host, $user, $pass, $this->debug);
				}
				else return $this->link = new PDOHandler($host, $user, $pass, $db, $this->debug);
			}
			else
			{
				$this->link = new MysqlHandler($host, $user, $pass, $this->debug);
				$selected_db_ok = true;
				if($db !== '') $selected_db_ok = $this->select_database($db);
				if($this->link !== false && $selected_db_ok !== false) return true;
				else return false;
			}
		}
		
		public function select_database($db)
		{
			return $this->link->select_database($db);
		}
		
		// this function make query to fetch data from database ( Like using SELECT & SHOW ), this function return array and not handler
		public function query($sqlStatement, $keyType = "NUM", $params = array(), $paramsType = '') // $keyType = ASSOC, NUM, BOTH
		{	
			if(extension_loaded('mysqli') && function_exists('mysqli_stmt_get_result') && ($this->extension === '' || $this->extension === 'Mysqli')) 
			{
				if($paramsType !== '') $params =  array_merge(array($paramsType), $params);
				return $this->link->query($sqlStatement, $keyType, $params); // mysqli
			}
			else if(extension_loaded('pdo') && version_compare(PHP_VERSION, '5.1.0') >= 0 && ($this->extension === '' || $this->extension === 'PDO'))
			{
				return $this->link->query($sqlStatement, $keyType, $params); // pdo
			}
			else
			{
				if($paramsType !== '') $params =  array_merge(array($paramsType), $params);
				return $this->link->query($sqlStatement, $keyType, $params); // mysql
			}
		}

		public function command($sqlStatement, $params = array(), $paramsType = '')
		{	
			if(extension_loaded('mysqli') && function_exists('mysqli_stmt_get_result') && ($this->extension === '' || $this->extension === 'Mysqli')) 
			{
				if($paramsType !== '') $params =  array_merge(array($paramsType), $params);
				return $this->link->command($sqlStatement, $params); // mysqli
			}
			else if(extension_loaded('pdo') && version_compare(PHP_VERSION, '5.1.0') >= 0 && ($this->extension === '' || $this->extension === 'PDO'))
			{
				return $this->link->command($sqlStatement, $params); // pdo
			}
			else
			{
				if($paramsType !== '') $params =  array_merge(array($paramsType), $params);
				return $this->link->command($sqlStatement, $params); // mysql
			}
		}
		
		// sanitize string
		public function sanitize_values($string)
		{
			return $this->link->sanitize_values($string);
		}
		
		// sanitize array
		public function sanitize_array($array)
		{
			foreach($array as $key => $value) $array[$key] = $this->sanitize_values($value);
			return $array;
		}
		
		// this function to check if connection failed or succeeded
		public function is_connection_failed() // if connection failed return true
		{
			return $this->link->is_connection_failed();
		}
		
		// this function return number of rows for current query
		public function get_num_rows()
		{
			return $this->link->get_num_rows();
		}
		
		// this function return database handler type
		public function get_db_handler_type()
		{
			return $this->link->get_db_handler_type();
		}
		
		// this function for close connection
		public function close_connection()
		{
			$this->link->close_connection();
		}
		
		public function available_extensions()
		{
			$available_extensions = array();
			if(extension_loaded('mysqli') && function_exists('mysqli_stmt_get_result')) 
				$available_extensions[] = 'Mysqli';
			if(extension_loaded('pdo') && version_compare(PHP_VERSION, '5.1.0') >= 0)
				$available_extensions[] = 'PDO';
			if(extension_loaded('mysql'))
				$available_extensions[] = 'Mysql';
				
			return $available_extensions;
		}
		
	}	
?>