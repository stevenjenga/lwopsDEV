<?php
/**
* Smart Report Maker
* Author : StarSoft 
*All copyrights are preserved to StarSoft
*http://mysqlreports.com/
*
*/
//if (! defined('DIRECTACESS')) exit('No direct script access allowed');
	class MysqlHandler
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
			$this->debug_mode('Mysql::connect', 'info', '#Attempt connection');
			$connection = @mysql_connect($this->host, $this->user, $this->pass);
			if($this->debug){
				
				$this->debug_mode('connect', 'info', $str);
			}
			if(!$connection)
			{
				$this->debug_mode('connect', 'error', '#connection failed: '.mysql_error());
				return false;
			}
			$this->debug_mode('connect', 'success', '#connected successfully'); 
			return $connection;	
		}
		
		// this function select database
		public function select_database($db)
		{
			$this->db = $db;
			if(!mysql_select_db($this->db))
			{
				$this->debug_mode('connect', 'error', '#can\'t select database: '.mysql_error());
				return false;
			}
			$this->debug_mode('Select_database', 'success', '#select database successfully');
			return true;
		}
		
		// this function make query to fetch data from database ( Like using SELECT & SHOW ), this function return array and not handler
		public function query($sqlStatement, $keyType = "NUM", $params = array()) // $keyType = MYSQL_ASSOC, MYSQL_NUM, MYSQL_BOTH
		{
			$this->debug_mode('Query Function', 'info', $sqlStatement);
			
			if($keyType === "ASSOC") $keyType = MYSQL_ASSOC;
			else if($keyType === "BOTH") $keyType = MYSQL_BOTH;
			else $keyType = MYSQL_NUM;
		
			if ($this->link)
			{
				// set UTF-8 Default character set ..
				mysql_query("set character_set_server='utf8'");
				mysql_query("set names 'utf8'");
				if(function_exists('mysql_set_charset')) mysql_set_charset('utf8');
				
				if(count($params) > 0) $result = @mysql_query($this->bind_params($sqlStatement, $params));
				else $result = $result = @mysql_query($sqlStatement);
				
				if(!$result)
				{
					$this->debug_mode('query', 'error', '#Query Failed<br/>'.mysql_error());
					return false;
				}else{
					$this->numOfRows = @mysql_num_rows($result);
					$this->debug_mode('query', 'success', '#Query success: it returns'.$this->numOfRows.' rows!');
				
					// convert returned handler from database to array of values
					$fetchedData = $this->get_result($result, $keyType);
									  
					return $fetchedData;
				}
			}
		}
		
		
		// this function take handler from query and return array of fetched values ( retrieve data from database )
		private function get_result($result, $keyType)
		{ 
			$fetchedData = array();
			while($row = @mysql_fetch_array($result, $keyType)) $fetchedData[] = $row;
			return $fetchedData;
		}
		
		public function command($sqlStatement, $params = array())
		{
			$this->debug_mode('Command Function', 'info', $sqlStatement);

			if ($this->link)
			{
				// set UTF-8 Default character set ..
				mysql_query("set character_set_server='utf8'");
				mysql_query("set names 'utf8'");
				if(function_exists('mysql_set_charset')) mysql_set_charset('utf8');
				
				if(count($params) > 0) $result = @mysql_query($this->bind_params($sqlStatement, $params));
				else $result = $result = @mysql_query($sqlStatement); // query SQL Statement
				if($result){
					$this->numOfRows = mysql_affected_rows();
					$this->debug_mode('command', 'success', "#command success: it affects ". $this->numOfRows . " rows");
					return true;
				}else{
					return false;
				}
			}
		}
		
		public function sanitize_values($string)
		{
			$cleaned_string = $string;
			
			$this->debug_mode('sanitize_values', 'info', "##input string for the sanitize function: ". $string );
			
			$cleaned_string = (get_magic_quotes_gpc()) ? stripslashes($string) : $string;
			$cleaned_string = (function_exists('mysql_real_escape_string')) ? mysql_real_escape_string($string) :  mysql_escape_string($string);
			
			$this->debug_mode('sanitize_values', 'success', "#sanitized string: ". $cleaned_string );
			
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
				
				logging("\n ## DbHandler->MySQL : ".$msg);
				
			}
		}
		
		// array(types, params, ...)
		private function bind_params($sql, $array)
		{
			$arrayOfargs = $array;
			$arrayOfargs = array_slice($arrayOfargs, 1);
			
			$arrayofparams = array();
			$arrayofparams[0] = $sql;

			$typeOfParams = $array[0];
			$typeOfParams = str_split($typeOfParams);
			
			foreach($typeOfParams as $key => $value)
			{
				$length = 0;
				if($value === 's') $value = '\'%s\'';
				else if($value === 'i') $value = '%d';
				else if($value === 'd') $value = '%f';
				
				$arrayofparams[0] = substr_replace($arrayofparams[0], $value, strpos($arrayofparams[0], '?'), 1);
			}
			
			$arrayOfParams = array_merge($arrayofparams, $arrayOfargs);
			$sqlStatement = call_user_func_array("sprintf", $arrayOfParams);
			return $sqlStatement;
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
			return 'mysql';
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
				mysql_close($this->link);
				$this->link = null;
			}
		}
	}	