<?php
require_once('../functions/functions.php');
global $db;
global $logger;
global $errorLogger;

$rows = $db->query("select * from teablock");
$logger->debug('get_teablock_data_xml.php (db)', $db->trace);

header("Content-type: text/xml");

echo('<?xml version="1.0" encoding="utf-8"?>'); 

echo '<rows id="0">';
echo  '	<head>		
		<column width="150" type="ro" align="left" sort="str">Block Name</column>		
		<column width="75" type="ro" align="left" sort="str">Block Nbr</column>
		<column width="100" type="ro" align="right" sort="str">Size (m2)</column>		
		<column width="100" type="ro" align="right" sort="str">Nbr Of Bushed</column>		
		<column width="110" type="dhxCalendar" align="left" sort="str">Last Date Pruned</column>		
		<column width="110" type="ro" align="left" sort="str">Next Prun Date</column>		
	</head>';
	
if($rows){
	foreach($rows as $row){
		
		/* create xml tag for grid's row */
			
		echo ("<row id='".$row['oid']."'>");	
		print("<cell><![CDATA[".$row['name']."]]></cell>");
		print("<cell><![CDATA[".$row['blockNbr']."]]></cell>");
		print("<cell><![CDATA[".$row['blockSize']."]]></cell>");
		print("<cell><![CDATA[".$row['nbrOfBushes']."]]></cell>");
		print("<cell><![CDATA[".date('M.d.Y',strtotime($row['lastDatePruned']))."]]></cell>");
		print("<cell><![CDATA[".date('M.d.Y',strtotime($row['nextPruneDate']))."]]></cell>");
	
		print("</row>");
	}
}else{
}
echo '</rows>';

?>