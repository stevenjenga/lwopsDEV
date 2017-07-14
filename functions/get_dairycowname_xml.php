<?php
require_once('../functions/functions.php');
global $db;
/*  $db->where('active',1); */

$rows = $db->query("select oid ,name from dairycowname ");

/* include XML Header (as response will be in xml format) */
header("Content-type: text/xml");

/* encoding may be different in your case */

echo('<?xml version="1.0" encoding="utf-8"?>'); 

/* start output of data */

echo '<rows id="0">';
echo  '	<head>		
		<column width="100" type="ro" align="left" sort="str">Cow Name</column>		
	</head>';
	
if($rows){
	foreach($rows as $row){
		
		/* create xml tag for grid's row */
			
		echo ("<row id='".$row['oid']."'>");	
		print("<cell><![CDATA[".$row['name']."]]></cell>");
		print("</row>");
	}
}else{
}
echo '</rows>';

?>