<?php
require_once('../functions/functions.php');
global $db;
/*  $db->where('active',1); */

$rows = $db->query("select month from opsmonth ");

/* include XML Header (as response will be in xml format) */
header("Content-type: text/xml");

/* encoding may be different in your case */

echo('<?xml version="1.0" encoding="utf-8"?>'); 

/* start output of data */

echo '<rows id="0">';
echo  '	<head>		
		<column width="*" type="ro" align="left" sort="str">Month</column>		
	</head>';
	
if($rows){
	foreach($rows as $row){
		
		/* create xml tag for grid's row */
			
		echo ("<row id='".$row['month']."'>");	
		print("<cell><![CDATA[".$row['month']."]]></cell>");
		print("</row>");
	}
}else{
}
echo '</rows>';

?>