<?php
require_once('../functions/functions.php');
global $db;
global $logger;

$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $_GET);

$mode = $_GET["!nativeeditor_status"]; 
$rowId = $_GET["gr_id"]; 

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="iso-8859-1"?>'); 

switch($mode){
	case "inserted":
		$action = add_teaPruningRate();
	break;
	case "deleted":
		//$action = delete_teaPruningRate($rowId);
	break;
	default:
		$action = update_teaPruningRate($rowId);
	break;
}

/* output update results */
echo "<data>";
echo "<action type='".$action[0]."' sid='".$action[1]."' tid='".$action[2]."'>".$action[3]."</action>";
echo "</data>";
?>