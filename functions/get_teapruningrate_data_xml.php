<?php
require_once('../functions/functions.php');
global $db;
global $logger;
global $errorLogger;

$rows = $db->query("select * from teapruningrate ");
$logger->debug('get_teapruningrate_data_xml.php (db)', $db->trace);

header("Content-type: text/xml");

echo('<?xml version="1.0" encoding="utf-8"?>'); 

echo '<rows id="0">';
echo  '	<head>		
		<column width="75" type="kenyaCurrency" align="right" sort="str">Rate Per Bush</column>		
		<column width="120" type="dhxCalendar" align="right" sort="str">Start Date</column>		
		<column width="120" type="dhxCalendar" align="right" sort="str">End Date</column>		
	</head>';
	
if($rows){
	foreach($rows as $row){
		
		/* create xml tag for grid's row */
		if($row['endDt']!=NULL){
			$endDate = date('M.d.Y',strtotime($row['endDt']));
		}else{
			$endDate="";
		}
			
		echo ("<row id='".$row['oid']."'>");	
		print("<cell><![CDATA[".number_format($row['ratePerBush'],2)."]]></cell>");
		print("<cell><![CDATA[".date('M.d.Y',strtotime($row['startDt']))."]]></cell>");
		print("<cell><![CDATA[".$endDate."]]></cell>");
		print("</row>");
	}
}else{
}
echo '</rows>';

?>