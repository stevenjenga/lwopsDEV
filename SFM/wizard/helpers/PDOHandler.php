<?php
/**
 *   PHP MYSQL Form Maker 
 *   version 3.1.0
 *   All copyrights are preserved to StarSoft
 */
if (! defined('DIRECTACESS')) exit('No direct script access allowed');
	class PDOHandler
	{
	
		protected 	$host,
					$user, 
					$pass, 
					$db, 
					$link, 
					$debug = false,
					$numOfRows = '';
					
		protected $keyTypes = array("NUM", "ASSOC", "BOTH");
		
		
		public function __construct($host, $user, $pass, $db, $isDebug)
		{
			$this->is_debug($isDebug);
			$this->host = $host;
			$this->user = $user;
			$this->pass = $pass;
			$this->db = $db;
			$this->link = $this->connect();
		}
		
		
		private function connect()
		{
			$this->debug_mode('PDO::connect', 'info', 'Attempt connection');
			try{
				try{
					$connection = @new pdo('mysql:host='.$this->host.';dbname='.$this->db, $this->user, $this->pass, 
						array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				}catch(PDOException $ex){
					$connection = @new pdo('mysql:host='.$this->host.';dbname='.$this->db.';charset=UTF-8', $this->user, $this->pass);
				}
			}catch(PDOException $e){
				$this->debug_mode('PDO::connect', 'error', 'Connection failed: '.$e->getMessage());
				return false;
			}
			$this->debug_mode('PDO::connect', 'success', 'Connected successfully'); 
			$connection->query('SET FOREIGN_KEY_CHECKS = 0;');
			return $connection;
		}
		
		// this function select another database
		public function select_database($db)
		{
			// command function >> USE $db
			if($this->link->query('USE ' . $db)) 
			{
				$this->debug_mode('PDO::select_database', 'success', 'Select database successfully');
				return true;
			}else{
				$this->debug_mode('PDO::select_database', 'error', 'Select database failed');
				return false;
			}
		}
		
		// this function make query to fetch data from database ( Like using SELECT & SHOW ), this function return array and not handler
		public function query($sqlStatement, $keyType = "NUM", $params = array()) // $keyType = ASSOC, NUM, BOTH
		{
			$this->debug_mode('PDO::query', 'info', $sqlStatement);
			
			if($keyType === 'BOTH') $keyType = PDO::FETCH_BOTH; //PDO::FETCH_BOTH
			else if($keyType === 'ASSOC') $keyType = PDO::FETCH_ASSOC; //PDO::FETCH_ASSOC
			else $keyType = PDO::FETCH_NUM; //PDO::FETCH_NUM
			
			if ($this->link)
			{
				try{
					$query = @$this->link->prepare($sqlStatement);
					if($query && count($params) > 0)
					{
						$this->debug_mode('PDO::query', 'info', 'Query parameters: ' . implode($params, ', '));
						$result = @$query->execute($params);
					}else $result = @$query->execute();
					if(!$result)
					{
						if ($this->debug)
						{
							ob_start();
							var_dump($query->errorInfo());
							$str = ob_get_clean();
							$this->debug_mode('PDO::query', 'error', 'Query failed, '.$str.
								', check array of parameters it must be like that array(param1, param2, ...)');
						}
						return false;
					}else{
						$this->numOfRows = @$query->rowCount();
						$this->debug_mode('PDO::query', 'success', 'Query success : it returns '. $this->numOfRows . ' rows');
						
						$fetchedData = $query->fetchAll($keyType);
						
						$query->closeCursor();
						return $fetchedData;
					}
				}catch(PDOException $e){
					$this->debug_mode('PDO::query', 'error', 'Query failed: '.$e->getMessage());
					return false;
				}
			}
		}
		
		// this function make command to manipulate data ( Like using INSERT & UPDATE ), this function return true on success
		public function command($sqlStatement, $params = array())
		{
			$this->debug_mode('PDO::command', 'info', $sqlStatement);
			if ($this->link)
			{
				try{
					$query = @$this->link->prepare($sqlStatement);
					if($query && count($params) > 0)
					{
						$this->debug_mode('PDO::command', 'info', 'Command parameters: ' . implode($params, ', '));
						$result = @$query->execute($params);
					}else $result = @$query->execute();
					if(!$result)
					{
						if ($this->debug)
						{
							ob_start();
							var_dump($query->errorInfo());
							$str = ob_get_clean();
							$this->debug_mode('PDO::command', 'error', 'Command Failed, '.$str.
								', check array of parameters it must be like that array(param1, param2, ...);');
						}
						return false;
					}else{
						$this->numOfRows = @$query->rowCount();
						$this->debug_mode('PDO::command', 'success', 'Command success : it returns '. $this->numOfRows . ' rows');
						$query->closeCursor();
						return true;
					}
				}catch(PDOException $e){
					$this->debug_mode('PDO::command', 'error', 'Command failed: '.$e->getMessage());
					return false;
				}
			}
		}
		
		public function sanitize_values($string)
		{
			$cleaned_string = $string;
		
			$this->debug_mode('PDO::sanitize_values', 'info', 'Input string for the sanitize function : '. $string);
			if ($this->link)
			{
				$cleaned_string = (get_magic_quotes_gpc()) ? stripslashes($string) : $string;
				// $cleaned_string =  $this->link->quote($string);
                              $cleaned_string = str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $cleaned_string);
				
				$this->debug_mode('PDO::sanitize_values', 'success', 'Sanitized string : '. $cleaned_string);
			}
			return $cleaned_string;
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
				
				logging('	## ' . $functionName . ' ## ' . $msg);
			}
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
		
		// this function return database handler type
		public function get_db_handler_type()
		{
			return 'pdo';
		}
		
		// this function set debug mode
		public function is_debug($bool)
		{
			if($bool !== false) $bool = true;
			$this->debug = $bool;
		}
		
		// this function for close connection
		public function close_connection()
		{
			if ($this->link)
			{	
				$this->link = null;
			}
		}
	}