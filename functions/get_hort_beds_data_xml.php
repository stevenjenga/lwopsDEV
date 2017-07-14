<?php
require_once('../functions/functions.php');
global $db;

if(isset($_REQUEST['date']) ){
$date=$_REQUEST['date'];	
}else{
	$date=date('Y-m-d');
}

$sql = "SELECT oid, identifier, type, length, width FROM horticulturebed  ORDER BY identifier, type";
$rows = $db->query($sql);
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="utf-8"?>'); 

/* start output of data */
echo '<rows id="0">';
echo  '	<head>
		<column width="75" type="ed" align="middle" sort="str" >Number</column>
		<column width="75" type="ed" align="middle" sort="str">Type</column>
		<column width="50" type="ed" align="right" sort="str" >Length (m)</column>
		<column width="50" type="ed" align="right" sort="str">Width (m)</column>
	</head>';
	
if($rows){
	foreach($rows as $row){
		echo ("<row id='".$row['oid']."'>");
		print("<cell><![CDATA[".$row['identifier']."]]></cell>");
	    print("<cell><![CDATA[".$row['type']."]]></cell>");
	    print("<cell><![CDATA[".$row['length']."]]></cell>");		
		print("<cell><![CDATA[".$row['width']."]]></cell>");		
		print("</row>");
	}
}
else{}
echo '</rows>';

?>