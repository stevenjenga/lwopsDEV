<?php

require_once('functions.php');

$mode = $_GET["!nativeeditor_status"]; 
$rowId = $_GET["gr_id"]; 

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="iso-8859-1"?>'); 

switch($mode){
	case "inserted":
		$action = add_FTEadvance();
	break;
	case "deleted":
		//$action = delete_eFTEadvance($rowId);
	break;
	default:
		$action = update_FTEadvance($rowId);
	break;
}	
/* output update results */
echo "<data>";
echo "<action type='".$action[0]."' sid='".$action[1]."' tid='".$action[2]."'>".$action[3]."</action>";
echo "</data>";
?>