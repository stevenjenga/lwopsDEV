<?php
require_once('../functions/functions.php');
global $db;
global $logger;
global $errorLogger;

if(isset($_REQUEST['date']) ){
	$date=$_REQUEST['date'];	
}
else{
	$date=date('Y-m-d');
}

if(isset($_REQUEST['date']) ){
	$rows = $db->query("SELECT * FROM mushroomproduction WHERE DATE(harvestDt)='$date' ORDER BY oid desc ");
}
else{
	$rows = $db->query("SELECT * FROM mushroomproduction ORDER BY oid desc ");
}
$logger->debug('get_mushroom_prod_data_xml.php (rows)', $db->trace);

/* include XML Header (as response will be in xml format) */
header("Content-type: text/xml");

/* encoding may be different in your case */

echo('<?xml version="1.0" encoding="utf-8"?>'); 

/* start output of data */

echo '<rows id="0">';
echo  '	<head>
		<column width="100" type="dhxCalendar" align="left" sort="str">Harvest Date</column>
		<column width="75" type="ed" align="right" sort="str">Room Nbr</column>
		<column width="75" type="ed"  align="right" sort="str">Crop Nbr</column>
		<column width="75" type="ed" align="right" sort="str">Harvested Weight</column>
	</head>';
	
if($rows){
	foreach($rows as $row){
		
		/* create xml tag for grid's row */
		
		echo ("<row id='".$row['oid']."'>");
		print("<cell><![CDATA[".date('M.d.Y', strtotime($row['harvestDt']))."]]></cell>");
		print("<cell><![CDATA[".$row['roomNbr']."]]></cell>");
		print("<cell><![CDATA[".$row['cropNbr']."]]></cell>");
		print("<cell><![CDATA[".$row['harvestedWeight']."]]></cell>");
		print("</row>");
	}
}else{
}
echo '</rows>';

?>