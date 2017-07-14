<?php
require_once('../functions/functions.php');
global $db;
global $logger;
global $errorLogger;

$rows = $db->query("select activity,oid from expenseactivity ");
$logger->debug('get_expenseactivity_data_xml.php (db)', $db->trace);

header("Content-type: text/xml");

echo('<?xml version="1.0" encoding="utf-8"?>'); 

echo '<rows id="0">';
echo  '	<head>		
		<column width="200" type="ed" align="left" sort="str">Activity Name</column>		
	</head>';
	
if($rows){
	foreach($rows as $row){
		echo ("<row id='".$row['oid']."'>");	
		print("<cell><![CDATA[".$row['activity']."]]></cell>");
		print("</row>");
	}
}

echo '</rows>';

?>