<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
        if (! defined('DIRECTACESS')) exit('No direct script access allowed');
	require_once "safeValue.php";
	require_once 'MysqlHandler.php';
	require_once 'MysqliHandler.php';
	require_once 'PDOHandler.php';
        

	class DatabaseHandler
	{
		
		protected	$link;		
		public $extension = '';
		
		public function __construct($host, $user, $pass, $db = '',$allow_debug=false, $extension = '')
		{       
			$extensions = array("mysqli","pdo","mysql");
			if(in_array(strtolower($extension), $extensions)) $this->extension = strtolower($extension);
			else $this->extension = "";  
               
			if(extension_loaded('mysqli') && function_exists('mysqli_stmt_get_result') && ($this->extension === '' || $this->extension === 'mysqli')) 
			{
				$this->link = new mysqliHandler($host, $user, $pass, $allow_debug);
				$selected_db_ok = true;
				if($db !== '') $selected_db_ok = $this->select_database($db);
				if($this->link === false || $selected_db_ok === false) $this->link = false;
			}
			else if(extension_loaded('pdo') && version_compare(PHP_VERSION, '5.1.0') >= 0 && ($this->extension === '' || $this->extension === 'pdo'))
			{
				if($db === '') 
				{
					if(extension_loaded('mysqli')) 
						return $this->link = new mysqliHandler($host, $user, $pass, $allow_debug);
					else
						return $this->link = new MysqlHandler($host, $user, $pass, $allow_debug);
				}
				else return $this->link = new pdoHandler($host, $user, $pass, $db, $allow_debug);
			}
			else
			{
				$this->link = new MysqlHandler($host, $user, $pass, $allow_debug
                                        );
				$selected_db_ok = true;
				if($db !== '') $selected_db_ok = $this->select_database($db);
				if($this->link === false || $selected_db_ok === false) $this->link = false;
			}
		}
		
		public function select_database($db)
		{
			return $this->link->select_database($db);
		}
		
		// this function make query to fetch data from database ( Like using SELECT & SHOW ), this function return array and not handler
		public function query($sqlStatement, $keyType = "NUM", $params = array(), $paramsType = '') // $keyType = ASSOC, NUM, BOTH
		{	
			if(extension_loaded('mysqli') && function_exists('mysqli_stmt_get_result') && ($this->extension === '' || $this->extension === 'mysqli')) 
			{
				if($paramsType !== '') $params =  array_merge(array($paramsType), $params);
				return $this->link->query($sqlStatement, $keyType, $params); // mysqli
			}
			else if(extension_loaded('pdo') && version_compare(PHP_VERSION, '5.1.0') >= 0 && ($this->extension === '' || $this->extension === 'pdo'))
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
			if(extension_loaded('mysqli') && function_exists('mysqli_stmt_get_result') && ($this->extension === '' || $this->extension === 'mysqli')) 
			{
				if($paramsType !== '') $params =  array_merge(array($paramsType), $params);
				return $this->link->command($sqlStatement, $params); // mysqli
			}
			else if(extension_loaded('pdo') && version_compare(PHP_VERSION, '5.1.0') >= 0 && ($this->extension === '' || $this->extension === 'pdo'))
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
                    $clean = array();
			foreach($array as $key => $value){
                            if(is_array($value)) 
                            $clean[$this->sanitize_values($key)] =$this->sanitize_array($value);
                            else
                            $clean[$this->sanitize_values($key)] = $this->sanitize_values($value);
                        }
			return $clean;
		}
		
		// this function to check if connection failed or succeeded
		public function is_connection_failed() // if connection failed return true
		{
			if($this->link === false) return true;
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
				$available_extensions[] = 'mysqli';
			if(extension_loaded('pdo') && version_compare(PHP_VERSION, '5.1.0') >= 0)
				$available_extensions[] = 'pdo';
			if(extension_loaded('mysql'))
				$available_extensions[] = 'Mysql';
				
			return $available_extensions;
		}
                
                
		
	}
	
?>