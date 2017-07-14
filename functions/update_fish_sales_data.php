<?php

require_once('../functions/functions.php');

$mode = $_GET["!nativeeditor_status"]; 
$rowId = $_GET["gr_id"]; //id or row which was updated 

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="iso-8859-1"?>'); 

switch($mode){
	case "inserted":
		$action = add_fishsales();
	break;
	case "deleted":
		//$action = delete_fishsales($rowId);
	break;
	default:
		$action = update_fishsales($rowId);
	break;
}	
/* output update results */
echo "<data>";
echo "<action type='".$action[0]."' sid='".$action[1]."' tid='".$action[2]."'/>";
echo "</data>";
?>