<?php
require_once('../functions/functions.php');
global $db;
/*  $db->where('active',1); */
$rows = $db->get('customer');

/* include XML Header (as response will be in xml format) */
header("Content-type: text/xml");

/* encoding may be different in your case */

echo('<?xml version="1.0" encoding="utf-8"?>'); 

/* start output of data */

echo '<rows id="0">';
echo  '	<head>
		<column width="200" type="ed" align="left" sort="str">Business Name</column>
		<column width="200" type="ed" align="left" sort="str">First Name</column>
		<column width="200" type="ed" align="left" sort="str">Last Name</column>
		<column width="200" type="ed" align="left" sort="ed">Store Name</column>
		<column width="100" type="dyn" align="left" sort="int">Mobile Nbr.</column>
		

	</head>';
	
if($rows){
	foreach($rows as $row){
		
		/* create xml tag for grid's row */
		
	
		
		echo ("<row id='".$row['oid']."'>");
		print("<cell><![CDATA[".$row['businessName']."]]></cell>");
		print("<cell><![CDATA[".$row['contactFirstName']."]]></cell>");
		print("<cell><![CDATA[".$row['contactLastName']."]]></cell>");
		print("<cell><![CDATA[".$row['storeNameNbr']."]]></cell>");
		print("<cell><![CDATA[".$row['mobileNbr']."]]></cell>");
	
		print("</row>");
	}
}else{
}
echo '</rows>';

?>