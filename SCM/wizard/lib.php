<?php
/**
 * Smart Chart Maker 
 * @author		StarSoft
 * @copyright	Copyright (c) 2011 - 2014, StarSoft, Inc.
 * @link		http://mysqlreports.com
 * 
 * 
 */
require_once("shared.php");
require_once("check.php");
//connection parameters
$host = $_SESSION["ks_host"];
$user = $_SESSION["ks_user"];
$pass = $_SESSION["ks_pass"];
$db = $_SESSION["ks_db"];
$debug_mode = false;

function sql($query)
{
	global $host, $user, $pass, $db;
	
	if(!@mysql_connect($host, $user, $pass))
    {
        echo("<center><B>Couldn't connect to MySQL </B></center>");
        return false;
    }
	
    if(!@mysql_select_db($db))
    {
        echo("<center><B>Couldn't select databasehost </B></center>");
        return false;
    }
	
    if(!$result = @mysql_query($query))
    {
        
		echo("<center><B>Error in query");
		debug("<center><B>Error in query: Error# " . mysql_errno() . ": " . mysql_error()."</B></center>");
        return false;
    }
    return $result;
}

function query($query)
{
    global $host, $user, $pass, $db;
	
	if(!@mysql_connect($host, $user, $pass))
    {
        echo("<center><B>Couldn't connect to MySQL</B></center>");
        return false;
    }
	 
    if(!@mysql_select_db($db))
    {
        echo("<center><B>Couldn't select database</B></center>");
        return false;
    }
    if(!$result = @mysql_query($query))
    {
        echo("<center><B>Error in query");
		debug("<center><B>Error in query: Error# " . mysql_errno() . ": " . mysql_error()."</B></center>");
        return false;
    }
    return $result;
}

function debug($str)
 { 
    if($debug_mode == True)
	{
	   echo("<br><Font color = 'red'>$str</font>");	 
	}
 }






?>
