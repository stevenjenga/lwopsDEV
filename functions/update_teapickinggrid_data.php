<?php
/*
Description: update_emp_data.php is used to update Mushroom Production data 
Using this page there function will effect accrordinly 
1) insert employee entry into mysql table
2) update employee data using employee id
3) delete employee data using employee id

It return xml data response to dhtmlx component

*/
require_once('../functions/functions.php');
global $errorLogger;
global $logger;

/* get request mode */
$mode = $_GET["!nativeeditor_status"]; 

/* id or row which was updated  */
$rowId = $_GET["gr_id"]; 
$newId = $_GET["gr_id"]; 
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $_GET);

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="iso-8859-1"?>'); 

switch($mode){
	case "inserted":
		$action = add_teaPicking();
	break;
	case "deleted":
		//$action = delete_teaPicking($rowId);
	break;
	default:
		$action = update_teaPicking($rowId);
	break;
}

echo "<data>";
echo "<action type='".$action[0]."' sid='".$action[1]."' tid='".$action[2]."'>".$action[3]."</action>";
echo "</data>";
?>