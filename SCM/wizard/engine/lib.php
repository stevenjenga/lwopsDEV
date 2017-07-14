<?php
/**
 * Smart Chart Maker 
 * @author		StarSoft
 * @copyright	Copyright (c) 2011 - 2014, StarSoft, Inc.
 * @link		http://mysqlreports.com
 * 
 * 
 */
error_reporting(E_ERROR  | E_PARSE);
require_once("config.php");
//initializing variables
if(!isset($tables_filters)||empty($tables_filters)) $tables_filters = array();
if(!isset($relationships)||empty($relationships)) $relationships = array();
if(!isset($debug_mode)) $debug_mode = false;
$pass = decode($pass);

//debugging function to be used on debugging mode
function debug($str)
{  
  if($_GET["debug_param_key"]== "on"&&$debug_mode == true) echo "<br/><font color = 'red'>$str</font>";
}
// decode any encoded info
function decode($encoded)
{
	return unserialize(base64_decode($encoded));
}

function query($query)
{
	global $host, $user, $pass, $db;
	if(!@mysql_connect($host, $user, $pass))
	{
		die("<center><B>Couldn't connect to MySQL</B></center>");
		return false;
	}
	if(!@mysql_select_db($db))
	{
		die("<center><B>Couldn't select database</B></center>");
		return false;
	}
	mysql_query("set character_set_server='utf8'");
	mysql_query("set names 'utf8'");
	if(function_exists('mysql_set_charset')) mysql_set_charset('utf8'); 
	if(!$result = @mysql_query($query))
	{
		debug("The sent Query : $query");
		$err = mysql_error();
		debug ("the error".$err);
		die("<center><B>No Data Found</B></center>");
		return false;
	}
	return $result;
}


// this function to extract tables name from relationships array and extract it in new array
function parse_relation($relationships)
{
	$relArr = array();
	$_relArr = array();
	$lastArray = array();
	$_lastArray = array();
	foreach($relationships as $key => $value) $relArr[] = explode('=', $value);
	foreach($relArr as $key => $value) $_relArr = array_merge($_relArr, $value);
	foreach($_relArr as $key => $value) $lastArray[] = explode('.', $value);
	foreach($lastArray as $key => $value) foreach($value as $k => $v) if($k === 0) $_lastArray[] = trim($v);
	$_lastArray = array_map('strtolower', $_lastArray);
	$_lastArray = array_unique($_lastArray);
	return $_lastArray;
}

// this function to extract table name from string
function get_tablename($field)
{
	$tables = explode('.', $field);
	$table = strtolower(trim(substr($tables[0], strpos($tables[0], '`'), strlen($tables[0]))));
	// $table = preg_replace('[\(]', '', $tables[0]);
	return $table;
}
//this function to make percentage ...
function set_sqlFunction_percentage($field)
{
	$table = get_tablename($field);
	$chunks = explode('(', $field);
	$sqlFunction = trim($chunks[0]);
	if($sqlFunction === "PERCENTAGE") {
		$field = "ROUND((((SUM(".$chunks[1].")/(SELECT (SUM(".$chunks[1].") FROM ".$table."))*100), 2)";
		return $field;
	}else return $field;
}
// ((SUM(`products`.`UnitsInStock`)/(SELECT (SUM(`products`.`UnitsInStock`)) FROM products))*100)

// this function use do decide if we want to use "Other" or not in pie and 3D pie
function use_other($values)
{
	$min = 0;
	foreach($values[0] as $key => $value)
	{
		$min += ($value * 0.03);
	}
	$arrayOfValues = array();
	foreach($values[0] as $key => $value)
	{
		if($value > $min) $arrayOfValues[$key] = $value;
		else $arrayOfValues['Other'] += $value;
	}
	return $arrayOfValues;
}

function prepare_name($name)
{
	$preparedName = trim($name);
	if($name[0] !== '`') $preparedName = '`'.$name;
	if($name[strlen($name)-1] !== '`') $preparedName .= '`';
	return $preparedName;
}

// this function return values array
function get_values($useOther = false)
{
	global $fields, $table, $tables_Y_axis, $relationships, $tables_filters, $group_by;
	$_table = array();
	foreach ($table as $k => $val) $_table[] = prepare_name($val);
	$table = $_table;
	$arrayOfValues = array();
	for($i = 0;$i < count($tables_Y_axis); $i++)
	{
		$SQLstatement = 'SELECT ' . $fields[0] . ', ';
		$chunks = explode(',', $tables_Y_axis[$i]);
		if(isset($relationships) && is_array($relationships) && count($relationships) > 1 && $chunks[(count($chunks)-2)] === 'DISTINCT')
		{
			$fields[$i+1] = str_replace('(', '( DISTINCT ', $fields[$i+1]);
		}
		$fields[$i+1] = set_sqlFunction_percentage($fields[$i+1]);
		$SQLstatement .= $fields[$i+1] . ' ';
		if(isset($chunks[(count($chunks)-1)]) && $chunks[(count($chunks)-1)] !== '')
		{
			$num_of_rel = explode('|', $chunks[(count($chunks)-1)]);
			$rel_string = '';
			$rel_array = array();
			foreach($num_of_rel as $k => $val)
			{
				if($k !== 0) $rel_string .= ' AND ';
				$rel_string .= $relationships[$val];
				$rel_array[] = $relationships[$val];
			}
			$tableOfField = get_tablename($fields[$i+1]);
			$tablesOfRel = parse_relation($rel_array);
			$tablesOfRel[] = $tableOfField;
			$tables = array_map('strtolower', $tablesOfRel);
			$tables = array_unique($tablesOfRel);
			$tableOfGroupBy = get_tablename($group_by);
			if(is_array($tables_filters) && count($tables_filters) > 0)
			{
				foreach ($tables_filters as $k => $val) $tables[] = get_tablename($val);
			}
			$tables = array_unique($tables);
			if(!in_array($tableOfGroupBy, $tables)) $tables[] = $tableOfGroupBy;
			$tables = implode(", ", $tables);
			
			$SQLstatement .= 'FROM ' . $tables;
			$SQLstatement .= ' WHERE ' . $rel_string;
			
			if(is_array($tables_filters) && count($tables_filters) > 0)
			{
				if(count($relationships) > 0) $SQLstatement .= " AND";
				else $SQLstatement .= " WHERE"; 
				$filters = '';
				foreach($tables_filters as $key => $val)
				{
					$newVal = str_replace("\\", " ", $val);
					$newVal = str_replace("<->"," ",$newVal);
					$filters .= " ($newVal) AND";
				}
				$filters = substr($filters, 0, strlen($filters)-3);
				$SQLstatement .= $filters;
			}
			if (!empty($group_by))
			{
				$SQLstatement .= " GROUP BY (" . $group_by . ")";
			}
		}else{
			// we must make sql statement without any relationships except that's how must use  it
			
			$tableOfField = get_tablename($fields[$i+1]);
			$tableOfGroupBy = get_tablename($group_by);
			$rel = '';
			$tables = array();
			if(is_array($tables_filters) && count($tables_filters) > 0)
			{
				foreach ($tables_filters as $k => $val)	$tables[] = get_tablename($val);
				$tables = array_unique($tables);

				if(!in_array($tableOfField, $tables)) $tableOfField .= ', ' . implode(', ', $tables);
				else $tableOfField = implode(', ', $tables);
			}
			if(!in_array($tableOfGroupBy, $table))
			{
				$tableOfField = implode(', ', $table);
				$rel = ' WHERE ' . implode(" AND ", $relationships) . ' ';
			}
			$SQLstatement .= 'FROM ' . $tableOfField . $rel;
			if(count($tables_filters) > 0)
			{
				if($rel === '' || empty($rel)) $SQLstatement .= " WHERE"; 
				else  $SQLstatement .= " AND";
				$filters = '';
				foreach($tables_filters as $key => $val)
				{
					$newVal = str_replace("\\", " ", $val);
					$newVal = str_replace("<->"," ",$newVal);
					$filters .= " ($newVal) AND";
				}
				$filters = substr($filters, 0, strlen($filters)-3);
				$SQLstatement .= $filters;
			}
			if (!empty($group_by))
			{
				$SQLstatement .= " GROUP BY (" . $group_by . ")";
			}
		}
		$result = query($SQLstatement);
		$arrayOfEachSeries = array();
		while($row = mysql_fetch_row($result))
		{
			$arrayOfEachSeries[preg_replace('/[\'\"\\\><&|`\/\[\];]/', '',$row[0])] = ($row[1] !== null && $row[1] !== '') ? $row[1] : "0";
		}
		$arrayOfValues[] = $arrayOfEachSeries;
	}
	if($useOther === true) $arrayOfValues = use_other($arrayOfValues);
	return $arrayOfValues;
}

function grouping_diff_index($arr1 , $arr2)
{
	$i = 0;
	foreach ($arr1 as $key=>$val)
	{
		if($val != $arr2[$key]) return $i;
		$i++;
	}
	return -1;
}
?>
