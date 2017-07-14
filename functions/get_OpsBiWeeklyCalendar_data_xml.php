<?php
require_once('../functions/functions.php');
global $db;
global $logger;
global $errorLogger;

if(isset($_GET['date'])){
	$date= $_GET['date'];
	$convertedDate = date('Y-m-d', strtotime($date));	
}
else $convertedDate = date('Y-m-d');
	
$sql = "SELECT oid, `periodStartDate`, `periodEndDt`, `payDate`, 0 AS flag FROM `opsbiweeklycalendar` WHERE periodEndDt < '$convertedDate' ORDER BY payDate";
$rows = $db->query($sql);
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="utf-8"?>'); 

echo '<rows id="0">';
echo  '	<head>		
		<column width="80" type="ro" align="right" sort="str">Period Start</column>	
		<column width="80" type="ro" align="left" sort="str">Period End</column>		
		<column width="50" type="ra" align="left" sort="str"></column>
	</head>';
	
if($rows){
	foreach($rows as $row){
		echo ("<row id='".$row['oid']."'>");
		print("<cell><![CDATA[".date('M.d.Y', strtotime($row['periodStartDate']))."]]></cell>");
		print("<cell><![CDATA[".date('M.d.Y', strtotime($row['periodEndDt']))."]]></cell>");
		print("<cell><![CDATA[".$row['flag']."]]></cell>");
		print("</row>");
	}
}
echo '</rows>';

?>