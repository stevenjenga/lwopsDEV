<?php
if (! defined('DIRECTACESS')) exit('No direct script access allowed');
	/**
	 * this file create the logic of (single) pivot table
	**/
	require_once 'helpers/DatabaseHandler.php';
	
	class CsingleP extends DatabaseHandler
	{
		
		private 
			// prerequisite (variables) to continue ..
			$prerequisite_done,
			$errors_array,
			// database params
			$host,
			$user,
			$pass,
			$db,
			// column settings
			$Ctable,
			$Cfield,
			$Calias,
			$CfieldFunction,
			// row settings
			$Rtable,
			$Rfield,
			$Ralias,
			// grid settings
			$Gtable,
			$Gcol,
			$Gfunc,
			// numeric value
			$IsNumeric,
			// relationships
			$relationships,
			// database connection
			$dbHandler,
			// maximum number of columns
			$maxColumns,
			$AllowColsPagination,
			$columnPerPage,
			// maximum number of records
			$maxRecordPerPage,
			$AllowRowsPagination, 
			$recordPerPage;
			
			// returned data from this class
			// tableHeader_array: table header array
			public $tableHeader_array = array(); 
			// maxTableHeader_array: table header according Max columns array
			public $maxTableHeader_array = array();
			// num_Columns: total number of columns		
			public $num_Columns = 0;
			// table body sql without limit: table body array
			public $tbodySqlWithoutLimit = ''; 
			// maxTableHeader_array: table body array according pagination limit
			public $TableBodyPaginationLimit_array = array();
			// num_Columns: total number of columns		
			public $num_records = 0;
			
		public function __construct()
		{
			$this->prerequisite_done = true;
			$this->errors_array = array();
			$this->init();
			// check every thing fine
			$this->is_prerequisite_done();
			// decode database password
			$this->pass = base64_decode($this->pass);
			logging('####################################################################################');
			logging('## Establishing database connection');
			parent::__construct($this->host, $this->user, $this->pass, $this->db, true);
			logging('####################################################################################' . "\r\n");
			// check everything is going fine
			if($this->is_connection_failed())
			{
				$this->prerequisite_done = false;
				$this->errors_array['Database'] = 'Error establishing database connection!';
			}
			// check everything is going fine
			$this->is_prerequisite_done();
			
			// make table header array
			$this->get_tableHeader();
			
			
			// check everything is going fine
			$this->is_prerequisite_done();
			
			// make table body array
			$this->get_tableBody();
			
			// check everything is going fine
			$this->is_prerequisite_done();
		}
		
		// assign config.php variables to class properties
		public function init()
		{
			global 	$host, $user, $pass, $db,
					$Ctable, $Cfield, $Calias, $CfieldFunction,
					$Rtable, $Rfield, $Ralias,
					$Gtable, $Gcol, $Gfunc,
					$IsNumeric, 
					$relationships,
					$maxColumns, $AllowColsPagination, $columnPerPage,
					$maxRecordPerPage, $AllowRowsPagination, $recordPerPage;
					
			$this->host = $this->validate_data($host, 'string');
			$this->user = $this->validate_data($user, 'string');
			$this->pass = $this->validate_data($pass, 'string');
			$this->db = $this->validate_data($db, 'string');
			
			$this->Ctable = $this->validate_data($Ctable, 'string', true);
			$this->Cfield = $this->validate_data($Cfield, 'string', true);
			$this->Calias = $this->validate_data($Calias, 'string');
			$this->CfieldFunction = $this->validate_data($CfieldFunction, 'string');
			
			$this->Rtable = $this->validate_data($Rtable, 'string', true);
			$this->Rfield = $this->validate_data($Rfield, 'string', true);
			$this->Ralias = $this->validate_data($Ralias, 'string');
			
			$this->Gtable = $this->validate_data($Gtable, 'string', true);
			$this->Gcol = $this->validate_data($Gcol, 'string', true);
			$this->Gfunc = $this->validate_data($Gfunc, 'string');
			
			$this->IsNumeric = $this->validate_data($IsNumeric, 'boolean');
			
			$this->relationships = $this->validate_data($relationships, 'array');
			
			$this->maxColumns = $this->validate_data($maxColumns, 'numeric');
			$this->AllowColsPagination = $this->validate_data($AllowColsPagination, 'boolean');
			$this->columnPerPage = $this->validate_data($columnPerPage, 'numeric');
			
			$this->maxRecordPerPage = $this->validate_data($maxRecordPerPage, 'numeric');
			$this->AllowRowsPagination = $this->validate_data($AllowRowsPagination, 'boolean');
			$this->recordPerPage = $this->validate_data($recordPerPage, 'numeric');
		}
		
		// to validate data(variable values) that will assign from config.php to class properties
		public function validate_data($data, $dataType, $is_db_constant = false)
		{
			// declare variable if isn't declared
			if(!isset($data))
			{
				if($dataType === 'array')
				{
					$this->prerequisite_done = false;
					$this->errors_array['UndefinedVariable'] = 'uninitialized variables missed!';
					$data = array();
				}
				else if($dataType === 'boolean')
				{
					$this->prerequisite_done = false;
					$this->errors_array['UndefinedVariable'] = 'uninitialized variables missed!';
					$data = false;
				}
				else if($dataType === 'numeric')
				{
					$this->prerequisite_done = false;
					$this->errors_array['UndefinedVariable'] = 'uninitialized variables missed!';
					$data = 0;
				}
				else if($dataType === 'string')
				{
					$this->prerequisite_done = false;
					$this->errors_array['UndefinedVariable'] = 'uninitialized variables missed!';
					$data = '';
				}
			}
			// validating and cleaning data(variables values) from config.php to assign it to class properties
			if(is_array($data))
			{
				$data_array = array();
				foreach($data as $key => $value)
				{
					$key = preg_replace('/[;\'"\\/]/', '', $key);
					$value = preg_replace('/[;\'"\\/]/', '', $value);
					$data_array[$key] = $value;
				}
				$data = $data_array;
			}
			else if(is_bool($data))
			{
				if($data !== true)
					$data = false;
			}
			else if(is_numeric($data))
				$data = intval($data);
			else
				$data = preg_replace('/[;\'"\\/]/', '', $data);
			
			// make database constants (tables name and columns name) like `table name`
			if($is_db_constant && !is_array($data))
			{
				$dbConstant = trim($data);
				if($dbConstant[0] !== '`')
					$data = '`'.$dbConstant;
				if($dbConstant[strlen($dbConstant)-1] !== '`')
					$data .= '`';					
			}
			
			return $data;
		}
		
		// to check if prerequisite_done = false >>> exit script
		public function is_prerequisite_done()
		{
			if(!$this->prerequisite_done)
			{
				foreach($this->errors_array as $value)
				{
					logging('####################################################################################');
					logging('## Error cause ## ' . $value);
					logging('####################################################################################' . "\r\n");
				}
				
				echo '
					<link href="../common/bootstrap/css/bootstrapmodified.css" rel="stylesheet" type="text/css" />
					<link rel="stylesheet" href="../common/alertify/themes/alertify.default.css" />
					<link rel="stylesheet" href="../common/alertify/themes/alertify.core.css" />
					<script src="../common/js/jquery-1.9.1.js"></script>
					<script src="../common/bootstrap/js/bootstrap.js"></script>
					<script src="../common/alertify/lib/alertify.min.js"></script>
					<div class="container" style="position: relative;top: 10px;">
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<div>
								<strong>Error! </strong> Something is gone wrong!.
							</div>
						</div>
					</div>';
				
				send_log_info();
				
				exit();
			}
		}
		
		// to create table header array
		public function get_tableHeader()
		{
			$sql = "SELECT DISTINCT {$this->CfieldFunction}({$this->Cfield}) as `theader` FROM {$this->Ctable} ORDER BY `theader`";
			logging('####################################################################################');
			logging('## to get table header array');
			$result = $this->query($sql, 'ASSOC');
			logging('####################################################################################' . "\r\n");
			if(is_array($result))
			{
				foreach($result as $key => $value)
				{
					$this->tableHeader_array[] = $value['theader'];
					if(($key + 1) <= $this->maxColumns)
						$this->maxTableHeader_array[] = $value['theader'];
				}
			
				$this->num_Columns = count($this->tableHeader_array);
			}
			else
			{
				$this->prerequisite_done = false;
				$this->errors_array['DatabaseWrongColumn'] = '(get_tableHeader()) there is wrong table/column name in config.php!';
			}
		}
		
		
		
		// this function will generate sql that's represent the core of pivot table logic
		public function pivotTable_logic()
		{
			$sql = '';
			foreach($this->tableHeader_array as $value)
			{	
				// handle function when user set it to count change it to sum and set value to 1 (line: 246, 247)
				$function = $this->Gfunc;
				if($this->Gfunc === 'count') 
					$function = 'sum';
				
				// set value to 1 if use chose count function after change it to sum (line: 239, 240)
				$if_value = $this->Gtable.'.'.$this->Gcol;
				if($this->Gfunc === 'count') 
					$if_value = 1;
					
				// create pivot condition like function(count, min, max ..)(if x = z and set value for it is setted or null)
				$sql .= ", {$function}(if({$this->CfieldFunction}({$this->Ctable}.{$this->Cfield}) = '{$this->sanitize_values($value)}', {$if_value}, null)) as `theader_{$this->mk_valid_alias($value)}`";	
			}
			
			return $sql;
		}
		
		// to create table body array
		public function get_tableBody()
		{
			$sql = "SELECT {$this->Rtable}.{$this->Rfield} as 'tbody' {$this->pivotTable_logic()} FROM ";
			$sql_count = "SELECT count( DISTINCT {$this->Rtable}.{$this->Rfield} ) as 'records_number' FROM ";
			// get all tables used in this query even in relationships
			$tables_array = array();
			$tables_array[0] = strtolower(trim($this->Ctable));
			$tables_array[1] = strtolower(trim($this->Rtable));
			$tables_array[2] = strtolower(trim($this->Gtable));
			// this used in sql query to set relationships if is setted
			$relationships_string = '';
			// check validation of relationships and make sure it's not empty
			if(is_array($this->relationships) && count($this->relationships) > 0)
			{
				// complete list of all tables used in this query (line: 207, 208, 209, 210)
				foreach($this->relationships as $value)
				{
					foreach(explode('=', $value) as $val)
						$tables_array[] = strtolower(trim(reset(explode('.', $val))));
				}
				// convert relationships to string to use it in sql query
				$relationships_string = 'WHERE ' . implode(' AND ', $this->relationships);
			}
			$tables_array = array_unique($tables_array);
			// to use this in sql query
			$tables_string = implode(', ', $tables_array);
			$sql .= "{$tables_string} {$relationships_string} GROUP BY `tbody`";
			$sql_count .= "{$tables_string} {$relationships_string}";
			
			logging('####################################################################################');
			logging('## to get records number');
			$recordsNumber_array = $this->query($sql_count, 'ASSOC');
			logging('####################################################################################' . "\r\n");
			
			if(is_array($recordsNumber_array))
			{
				$this->num_records = $recordsNumber_array[0]['records_number'];			
				$this->sqlWithoutLimit = $sql;
			}
			else
			{
				$this->prerequisite_done = false;
				$this->errors_array['DatabaseWrongColumn'] = '(get_tableBody()) there is wrong table/column name in config.php!';
			}
		}
		
		// make valid alias from special character
		public function mk_valid_alias($alias)
		{
			return preg_replace('/[;\'"\\/ ]/', '', $alias);
		}
		
		// this function apply pagination on table body
		public function get_tableBodyLimit($limit = false)
		{
			if(is_array($limit) && count($limit) > 0)
			{
				if(isset($limit[0]) && isset($limit[1]))
				{
					$start = $limit[0];
					$end = $limit[1];
					$limit = " LIMIT {$start}, {$end}";
					logging('####################################################################################');
					logging('## to get table body ( Using pagination - LIMIT )');
					$this->TableBodyPaginationLimit_array = $this->query($this->sqlWithoutLimit . $limit, "ASSOC");
					logging('####################################################################################');
					if(!is_array($this->TableBodyPaginationLimit_array))
					{
						$this->prerequisite_done = false;
						$this->errors_array['DatabaseWrongColumn'] = '(get_tableBody()) there is wrong table/column name in config.php!';
					}
				}
				else
				{
					$this->prerequisite_done = false;
					$this->errors_array['LIMIT'] = 'Unexpected error in records pagination system!';
				}
			}
			else
			{
				logging('####################################################################################');
				logging('## to get table body ( Get all records )');
				$this->TableBodyPaginationLimit_array = $this->query($this->sqlWithoutLimit, "ASSOC");
				logging('####################################################################################');
				if(!is_array($this->TableBodyPaginationLimit_array))
				{
					$this->prerequisite_done = false;
					$this->errors_array['DatabaseWrongColumn'] = '(get_tableBody()) there is wrong table/column name in config.php!';
				}
			}
		}
		
		// this function set columns pagination system
		public function columns_pagination($is_mobile = false)
		{
			/*
				case: 1
				if is mobile device rows must be 5 event columns per page > 5 or equal 0
				case: 2
				if AllowColsPagination = true and columns per page = 0 :: we will force user to use max columns 
				number
				case: 3
				else use column per page (what user expected)
			*/
			global $AllowColsPagination;
			if($is_mobile)
			{
				if($this->columnPerPage > 5 || $this->columnPerPage === 0) // case: 1
				{
					$columnPerPage = 5;
					$this->AllowColsPagination = true;
				}else // case: 3
					$columnPerPage = $this->columnPerPage;
			}
			else
			{
				if($this->AllowColsPagination === true && $this->columnPerPage === 0) // case: 2
					$columnPerPage = $this->maxColumns;
				else // case: 3
					$columnPerPage = $this->columnPerPage;
			}
			
			$AllowColsPagination = $this->AllowColsPagination;
			
			return $columnPerPage;
		}
		
		// return warning message when columns number > max columns number
		public function return_maxCols_warning()
		{
			// make columns pagination on display warning message if columns number greater than $maxColumns
			$warningmsg = '';
			if($this->num_Columns > $this->maxColumns)
			{
				$warningmsg = '
					<div class="alert alert-danger alert-dismissable">
						 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						 <div>
							<strong>Warning!</strong> You must know that number of columns is greater than maximum number of  columns,
							So columns that after maximum number of  columns it removed by default.
						</div>
						<div>
							<strong>The solution!</strong> go to config.php file and open it in any editor and change $maxColumns to accept more columns
						</div>
					</div>';
			}
			return $warningmsg;
		}
		
		// this function set records pagination system
		public function records_pagination()
		{
			/*	
				case: 1
				because number of number of all records > max records per page :: we force pagination system even 
				user doesn't allow records pagination
				case: 2
				because number of AllowRowsPagination = true and records per page >  max records per page :: we force pagination system even user doesn't allow records pagination
				case: 3
				AllowRowsPagination = true and (number of all records and records per page) < max records per 
				page :: user will get pagination system as he/she expected
				
			*/
			global $AllowRowsPagination;
			if($this->AllowRowsPagination === false && $this->num_records > $this->maxRecordPerPage) // case: 1
			{
				$this->AllowRowsPagination = true;
				$recordPerPage = $this->maxRecordPerPage;
			}
			else if($this->recordPerPage > $this->maxRecordPerPage) // case: 2
				$recordPerPage = $this->maxRecordPerPage;
			else // case: 3
				$recordPerPage = $this->recordPerPage;
			
			$AllowRowsPagination = $this->AllowRowsPagination;
			
			return $recordPerPage;
		}
		
		// print output in html formate
		// html header
		public function print_html_tableHeader()
		{
			echo '<tr><th class="essential persist"></th>';
			foreach($this->maxTableHeader_array as $key => $value)
			{
				$class = ($key < 5) ? 'essential' : 'optional';
				if($value === null) $value = 'Null';
				else if($value === '') $value = ' ';
				$key = $key + 1;
				echo "<th class='{$class}' headers='pivot-table-mediaTableCol-{$key}'>{$value}</th>"; 
			}
			echo '</tr>';
		}
		// html body
		public function print_html_tableBody($limit = false)
		{
			$this->get_tableBodyLimit($limit);
			foreach($this->TableBodyPaginationLimit_array as $key => $value)
			{
				echo '<tr>';
				echo "<td class='essential' style='text-align: left;' headers='pivot-table-mediaTableCol-0'>{$value['tbody']}</td>";
				foreach($this->maxTableHeader_array as $k => $val) 
				{
					$class = ($k < 5) ? 'essential' : 'optional';
					$k = $k+1;
					if($value["theader_{$this->mk_valid_alias($val)}"] === null)
					{
						if($this->IsNumeric) 
							echo "<td class='{$class}' style='text-align: center;' headers='pivot-table-mediaTableCol-{$k}'>0</td>";
						else 
							echo "<td class='{$class}' style='text-align: center;' headers='pivot-table-mediaTableCol-{$k}'></td>";
					}
					else
					{
						echo "<td class='{$class}' style='text-align: center;'  headers='pivot-table-mediaTableCol-{$k}'>
						{$value['theader_'.$this->mk_valid_alias($val)]}</td>";
					}
				}
				echo '</tr>';
			}
		}
	}
	
	$CsingleP = new CsingleP();