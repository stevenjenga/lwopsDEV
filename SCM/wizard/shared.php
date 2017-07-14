<?php
/**
 * Smart Chart Maker 
 * @author		StarSoft
 * @copyright	Copyright (c) 2011 - 2014, StarSoft, Inc.
 * @link		http://mysqlreports.com
 * 
 * 
 */
 
//Function used for validating user name, host name
function validate($var)
{
  if(empty($var)) return false;  
		  
  $specials = array('\\', "\0", "\n", "\r", "'", '"', "\x1a"," ","	","%","?","(",")","<",">","&","=","$");
  foreach($specials as $val)
  {
    if(strstr($var,$val)) return false;  
  }
  
  return true; 
  
}
//function used to encode a string
function encode($str)
{
  return base64_encode(serialize($str));
}

//function used to validate password
function validate_pass($str)
{
  $str = trim($str);
  if(strstr($str, " ")) return false;
  if(strlen($str) > 25) return false;
  return true;
}

function clean($var)
{
$var = trim($var);    
$specials = array('\\', "\0", "\n", "\r", "'", '"', "\x1a"," ","	","%","?","(",")","<",">","&","=","$");
$var = str_replace($specials, "", $var);
$var = strip_tags($var);
$var = mysql_escape_string($var);
return $var;
}

//function used to remove any special characters from a string
function remove_All_specialchars($str)
{
   $str = str_replace(' ', '-', $string); // Replaces all spaces    
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

//function used to secure an array from XSS and Sql injection
function clean_array($array)
{
	$arr = array();
	foreach($array as $k=>$v)
	{
		if(is_array($array[$k])) $arr[k] = clean($array[$k]);
		else{
			$k = strip_tags($k);
			$v = strip_tags($v);
			//check magic quote first
			$k = str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $k); 
			$v = str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $v); 
		}
		$arr[$k] = $v;
	}
	return $arr;
}

function print_array($array)
{
    $arr = array();
    foreach($array as $k=>$v)
	 {
	   if(is_array($array[$k])) 
	   {
             echo "$k is an array <br/>";
	     print_array($array[$k]);
	   }
	   else
	   {
	     echo "****$k : $v <br/>";
	   }
	  
	 }    
}
?>