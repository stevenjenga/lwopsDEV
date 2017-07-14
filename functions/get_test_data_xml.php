<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once('../functions/functions.php');
global $db;
global $logger;
global $errorLogger;

//include XML Header (as response will be in xml format)
header("Content-type: text/xml");
//encoding may be different in your case
echo('<?xml version="1.0" encoding="utf-8"?>'); 
echo '<rows id="0">';

$sql = "SELECT  * from employee";
$rows = $db->query($sql);
$logger->debug('get_emp_data_xml', $db->trace);
	
if($rows){
	foreach($rows as $row){
		// echo ("<row id='".$row['book_id']."'>");
		// print("<cell><![CDATA[".$row['first']."]]></cell>");
		// print("<cell><![CDATA[".$row['title']."]]></cell>");
		// print("<cell><![CDATA[".$row['author']."]]></cell>");
		// print("<cell><![CDATA[".$row['price']."]]></cell>");
		// print("<cell><![CDATA[".$row['instore']."]]></cell>");
		// print("<cell><![CDATA[".$row['shipping']."]]></cell>");
		// print("<cell><![CDATA[".$row['bestseller']."]]></cell>");
		// print("<cell><![CDATA[".gmdate("m/d/Y",strtotime($row['pub_date']))."]]></cell>");
		echo ("<row id='".$row['oid']."'>");
		print("<cell><![CDATA[".$row['firstName']."]]></cell>");
		print("<cell><![CDATA[".$row['middleInitial']."]]></cell>");
		print("<cell><![CDATA[".$row['lastName']."]]></cell>");
		print("<cell><![CDATA[".$row['role']."]]></cell>");
		print("<cell><![CDATA[".$row['nationalID']."]]></cell>");
		print("<cell><![CDATA[".$row['mobileNbr']."]]></cell>");
		print("<cell><![CDATA[".$row['resident']."]]></cell>");
		print("<cell><![CDATA[".date('M.d.Y', strtotime($row['startDt']))."]]></cell>");
		print("</row>");
	}
}else{
//error occurs
	// echo mysql_errno().": ".mysql_error()." at ".__LINE__." line in ".__FILE__." file<br>";
}

echo '</rows>';

?>