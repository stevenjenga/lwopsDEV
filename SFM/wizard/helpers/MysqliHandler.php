<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
if (! defined('DIRECTACESS')) exit('No direct script access allowed');
	class MysqliHandler
	{
		
		protected 	$host,
					$user, 
					$pass, 
					$db, 
					$link, 
					$debug = false, 
					$numOfRows = '';
		
		public function __construct($host, $user, $pass, $isDebug)
		{
			$this->is_debug($isDebug);
			$this->host = $host;
			$this->user = $user;
			$this->pass = $pass;
			$this->link = $this->connect();
		}
		
		private function connect()
		{
			$this->debug_mode('Mysqli::connect', 'info', 'Attempt connection');
			$connection = @new mysqli($this->host, $this->user, $this->pass);
			if($connection->connect_errno || $connection->error !== '')
			{
				$this->debug_mode('Mysqli::connect', 'error', 'Connection failed '.$connection->connect_error);
				$this->errorMsg = $connection->connect_error;
				return false;
			}
			$this->debug_mode('Mysqli::connect', 'success', 'Connected successfully');
			return $connection;
		}
		
		public function select_database($db)
		{
			$this->db = $db;
			if(!@$this->link->select_db($this->db))
			{
				$this->debug_mode('Mysqli::select_database', 'error', 'Can\'t select database: '.$this->link->connect_error); // $this->errorMsg
				return false;
			}else{
				$this->debug_mode('Mysqli::select_database', 'success', 'Select database successfully');
				$this->link->query('SET FOREIGN_KEY_CHECKS = 0;');
				return true;
			}		
		}
		
		// this function make query to fetch data from database ( Like using SELECT & SHOW ), this function return array and not handler
		public function query($sqlStatement, $keyType = "NUM", $params = array()) // $keyType = ASSOC, NUM, BOTH
		{	
		    $this->debug_mode('Mysqli::query', 'info', $sqlStatement);
			if ($this->link)
			{
				if($keyType === "ASSOC") $keyType = MYSQL_ASSOC;
				else if($keyType === "BOTH") $keyType = MYSQL_BOTH;
				else $keyType = MYSQL_NUM;
				
				$this->link->set_charset('utf8');
				$stmt = $this->link->prepare($sqlStatement);
				if(!$stmt)
				{
					$this->debug_mode('Mysqli::query', 'error', 'Query failed, '.$this->link->error);
					return false;
				}
				
				// this for each to make all items in the params array have new referance to use it in call_user_func_array ...				
				foreach ($params as $key => $value) $parameters[$key] = &$params[$key];
				
				if( count($params) > 0 && isset($params[0]))
				{
					$this->debug_mode('Mysqli::query', 'info', 'Query parameters: ' . implode($params, ', '));
					/*
						this function do : 
						------------------
						if i have function like that 
						function x($z1, $z2){}
						and i want to get the value from array and put it into this arguments(parameters) here we use
						call_user_func_array(function if it not in class or if it in class array(object, function),array but make sure all 
						items in this array have reference) and it will bind array value into function arguments ..
						
						array(type, value, value, .....)
						like >> array('is', 1, 'mohamed'); types : i >> integer, s >> string, d >> double, b >> blob
						
					*/
					
					$bindparam = @call_user_func_array(array($stmt, "bind_param"), $parameters);
					if(!$bindparam)
					{
						$this->debug_mode('Mysqli::query', 'error', 'Query failed, '.$this->link->error);
						$this->debug_mode('Mysqli::query', 'error', 'Query failed, check array of parameters it must be like that array(types, param)');
						return false;
					}
				}
				
				$exec =  @$stmt->execute();
				if(!$exec)
				{
					$this->debug_mode('Mysqli::query', 'error', 'Query failed, '.$this->link->error);
					return false;
				}
				
				$result = $stmt->get_result();
				
				if(!$result)
				{
					$this->debug_mode('Mysqli::query', 'error', 'Query failed, '.$this->link->error);
					return false;
				}else{
					$this->numOfRows = @$result->num_rows;
					$this->debug_mode('Mysqli::query', 'success', 'Query success : it returns '. $this->numOfRows . ' rows');
					$fetchedData = $this->get_result($result, $keyType);
									  
					return $fetchedData;
				}
			}			
		}

		public function command($sqlStatement, $params = array())
		{	
		    $this->debug_mode('Mysqli::command', 'info', $sqlStatement);
			if ($this->link)
			{				
				$this->link->set_charset('utf8');
				$stmt = $this->link->prepare($sqlStatement);
				if(!$stmt)
				{
					$this->debug_mode('Mysqli::command', 'error', 'Command failed '.$this->link->error);
					return false;
				}
				
				// this for each to make all items in the params array have new referance to use it in call_user_func_array ...
				foreach ($params as $key => $value) $parameters[$key] = &$params[$key];
				
				if( count($params) > 0 && isset($params[0]))
				{
					$this->debug_mode('Mysqli::command', 'info', 'Command parameters: ' . implode($params, ', '));
					/*
						this function do : 
						------------------
						if i have function like that 
						function x($z1, $z2){}
						and i want to get the value from array and put it into this arguments(parameters) here we use
						call_user_func_array(function if it not in class or if it in class array(object, function),array but make sure all 
						items in this array have reference) and it will bind array value into function arguments ..
						
						array(type, value, value, .....)
						like >> array('is', 1, 'mohamed'); types : i >> integer, s >> string, d >> double, b >> blob
						
					*/
					
					$bindparam = @call_user_func_array(array($stmt, "bind_param"), $parameters);
					if(!$bindparam)
					{
						$this->debug_mode('Mysqli::command', 'error', 'Command failed '.$this->link->error);
						$this->debug_mode('Mysqli::command', 'error', 'Command failed check array of parameters it must be like that array(types, param)');
						return false;
					}
				}
				
				$exec =  @$stmt->execute();
				if(!$exec)
				{
					$this->debug_mode('Mysqli::command', 'error', 'Command failed '.$this->link->error);
					return false;
				}else{
					$result = $stmt->get_result();
					$this->numOfRows = @$stmt->affected_rows or @$result->num_rows;
					$this->debug_mode('Mysqli::command', 'success', 'Command success : it returns '. $this->numOfRows . ' rows');
					return true;
				}
			}			
		}
		
		private function get_result($result, $keyType)
		{
			$fetchedData = array();
			while($row = $result->fetch_array($keyType)) $fetchedData[] = $row;	   
			return $fetchedData;		
		}
		
		public function sanitize_values($string)
		{
			$cleaned_string = $string;
		
			$this->debug_mode('Mysqli::sanitize_values', 'info', 'Input string for the sanitize function : '. $string);
			if ($this->link)
			{
				$cleaned_string = (get_magic_quotes_gpc()) ? stripslashes($string) : $string;
				$cleaned_string =  $this->link->real_escape_string($string);
				
				$this->debug_mode('Mytsqli::sanitize_values', 'success', 'sanitized string : '. $cleaned_string);
			}
			return $cleaned_string;
		}
		
		// this function to check if connection failed or succeeded
		public function is_connection_failed() // if connection failed return true
		{
			if($this->link === false) return true;
			else return false;
		}
		
		// this function return number of rows for current query
		public function get_num_rows()
		{
			return $this->numOfRows;
		}
                
                
		
		// this function display what's happened while object of this class start actions ( Just work when debug = true )
		private function debug_mode($functionName , $type, $msg)
		{
			if($this->debug)
			{
				$color = "black"; // by default
				if($type === "error") $color = "red"; // error
				else if($type === "success") $color = "green"; // success
				else if($type === "info") $color = "blue"; // info
				
				//echo "$functionName :   $msg . ";
				logging('	## ' . $functionName . ' ## ' . $msg);
				
			}
		}
		
		// this function return database handler type
		public function get_db_handler_type()
		{
			return 'mysqli';
		}
		
		// this function set debug mode
		public function is_debug($bool)
		{
			if($bool === true) $this->debug = true;
			else $this->debug = false;
		}
		
		// this function for close connection
		public function close_connection()
		{
			if ($this->link)
			{				
				$this->link->close();
				$this->link = null;
			}
		}
	}
?>