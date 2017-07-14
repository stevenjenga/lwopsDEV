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

$mode = $_GET["!nativeeditor_status"]; 
/* get request mode */

$rowId = $_GET["gr_id"]; 

/* id or row which was updated  */

$newId = $_GET["gr_id"]; 

/* will be used for insert operation
include XML Header (as response will be in xml format) */

header("Content-type: text/xml");

/* encoding may differ in your case */

echo('<?xml version="1.0" encoding="iso-8859-1"?>'); 

if($mode=="inserted")
{	
	$action = add_mushroomprod();
}
elseif($mode=="updated")
{
$action = update_mushroomprod();
}else
{
	$action = delete_mushroomprod();
}

/* output update results */
echo "<data>";
echo "<action type='".$action[0]."' sid='".$action[1]."' tid='".$action[2]."'/>";
echo "</data>";
?>