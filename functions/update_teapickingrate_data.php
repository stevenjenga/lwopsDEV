<?php
require_once('../functions/functions.php');

$mode = $_GET["!nativeeditor_status"]; 
$rowId = $_GET["gr_id"]; 

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="iso-8859-1"?>'); 

switch($mode){
	case "inserted":
		$action = add_teapickingrate();
	break;
	case "deleted":
		//$action = delete_teapickingrate($rowId);
	break;
	default:
		$action = update_teapickingrate($rowId);
	break;
}
echo "<data>";
echo "<action type='".$action[0]."' sid='".$action[1]."' tid='".$action[2]."'>".$action[3]."</action>";
echo "</data>";
?>