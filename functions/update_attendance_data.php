<?php
require_once('../functions/functions.php');
global $db;
global $logger;
global $errorLogger;

$mode = $_GET["!nativeeditor_status"]; 
$rowId = $_GET["gr_id"]; 

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="iso-8859-1"?>'); 

if($mode=="updated")
{
	$action = update_attendance_row($rowId);
	$logger->debug("update_attendance==", $action);
}

/* output update results */
echo "<data>";
echo "<action type='".$action[0]."' sid='".$action[1]."' tid='".$action[2]."'>".$action[3]."</action>";
echo "</data>";

?>