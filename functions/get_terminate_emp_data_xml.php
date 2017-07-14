<?php
require_once('../functions/functions.php');
global $db;
global $logger;
global $errorLogger;

$rows = $db->get('employee');
$logger->debug('get_emp_data_xml', $db->trace);

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="utf-8"?>'); 

/* start output of data */
echo '<rows id="0">';
echo  '	<head>
		<column width="100" type="edtxt" align="left" sort="str">First Name</column>
		<column width="50" type="edtxt" align="left" sort="str">Initial</column>
		<column width="100" type="edtxt" align="left" sort="str">Last Name</column>
		<column width="100" type="edtxt" align="left" sort="ed">National ID</column>
		<column width="120" type="dyn" align="left" sort="int">Mobile Nbr.</column>
		<column width="75" type="ch" align="left" sort="str">Resident?</column>
		<column width="50" type="ch" align="left" sort="str">Active</column>
		<column width="120" type="dhxCalendar" align="left" sort="date">Hire Date</column>
		<column width="120" type="dhxCalendar" align="left" sort="date">Termination Date</column>	
	</head>';
	
if($rows){
	foreach($rows as $row){
		if(!is_null($row['terminationDt'])){
			$terminateDate=date('M.d.Y', strtotime($row['terminationDt']));
		}
		else{
		  $terminateDate='';
		}				
		echo ("<row id='".$row['oid']."'>");
		print("<cell><![CDATA[".$row['firstName']."]]></cell>");
		print("<cell><![CDATA[".$row['middleInitial']."]]></cell>");
		print("<cell><![CDATA[".$row['lastName']."]]></cell>");
		print("<cell><![CDATA[".$row['nationalID']."]]></cell>");
		print("<cell><![CDATA[".$row['mobileNbr']."]]></cell>");
		print("<cell><![CDATA[".$row['resident']."]]></cell>");
		print("<cell><![CDATA[".$row['active']."]]></cell>");
		print("<cell><![CDATA[".date('M.d.Y', strtotime($row['startDt']))."]]></cell>");
		print("<cell><![CDATA[$terminateDate]]></cell>");	
		print("</row>");
	}
}
echo '</rows>';

?>