<?php
require_once('../functions/functions.php');
global $db;

//Get the previous (from NOW()) pay period oid
$sql = "SELECT oid, periodStartDate, periodEndDt FROM opsbiweeklycalendar WHERE periodEndDt <= NOW() ORDER BY opsbiweeklycalendar.periodStartDate DESC LIMIT 1";
$rows = $db->query($sql);
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);
if($rows){
	$parttimePayArray = array();
	foreach($rows as $row){
		$opsBiWeeklyCalendarOid = $row["oid"];
	}
}
$sql = "SELECT employeepayslip.oid, opsBiWeeklyCalendarOid, employeeOid, CONCAT(employee.firstName, ' ', employee.middleInitial, ' ', employee.lastName) AS employeeName, totalTeaWeight, teaPayRate, teaPay, totalParttimeHrs, parttimePayRate, parttimePay, otherDaysWorked, otherDaysPayRate, otherworkPay, medicalDeduction, NSSFdeduction, loanDeduction, otherDeduction, otherDeductionDescr, bonus FROM employeepayslip INNER JOIN employee ON employee.oid = employeepayslip.employeeOid WHERE opsBiWeeklyCalendarOid = $opsBiWeeklyCalendarOid ";

$rows = $db->query($sql);
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);

if($rows){
	header("Content-type: text/xml");
	echo('<?xml version="1.0" encoding="utf-8"?>'); 

	/* start output of data */
	echo '<rows id="0">';
	echo  '	<head>
			<column width="100" type="ro" align="right" sort="str" >Name</column>
			<column width="50" type="ro" align="right" sort="str" >Tea Wght</column>
			<column width="90" type="kenyaCurrency" align="right" sort="str" >Tea Rate</column>
			<column width="80" type="kenyaCurrency" align="right" sort="str" >Tea Pay</column>
			<column width="50" type="ro" align="right" sort="str" >PT Hrs</column>
			<column width="75" type="kenyaCurrency" align="right" sort="str" >PT Rate</column>
			<column width="80" type="kenyaCurrency" align="right" sort="str" >PT Pay</column>
			<column width="75" type="ro" align="right" sort="str" >Other Days Worked</column>
			<column width="75" type="kenyaCurrency" align="right" sort="str" >Other Days Rate</column>
			<column width="75" type="kenyaCurrency" align="right" sort="str" >Other Days Pay</column>
			<column width="80" type="kenyaCurrency" align="right" sort="str" >Deduction Medical</column>
			<column width="80" type="kenyaCurrency" align="right" sort="str" >Deduction NSSF</column>
			<column width="80" type="kenyaCurrency" align="right" sort="str" >Deduction Loans</column>
			<column width="60" type="ed" align="right" sort="str" >Deduction Other</column>
			<column width="80" type="ed" align="left" sort="str" >Other Description</column>
			<column width="80" type="kenyaCurrency" align="right" sort="str" >Bonus</column>
		</head>';
		
	if($rows){
		foreach($rows as $row){
			echo ("<row id='".$row['oid']."'>");
			print("<cell><![CDATA[".$row['employeeName']."]]></cell>");
			print("<cell><![CDATA[".$row['totalTeaWeight']."]]></cell>");
			print("<cell><![CDATA[".$row['teaPayRate']."]]></cell>");
			print("<cell><![CDATA[".$row['teaPay']."]]></cell>");
			print("<cell><![CDATA[".$row['totalParttimeHrs']."]]></cell>");
			print("<cell><![CDATA[".$row['parttimePayRate']."]]></cell>");
			print("<cell><![CDATA[".$row['parttimePay']."]]></cell>");
			print("<cell><![CDATA[".$row['otherDaysWorked']."]]></cell>");
			print("<cell><![CDATA[".$row['otherDaysPayRate']."]]></cell>");
			print("<cell><![CDATA[".$row['otherworkPay']."]]></cell>");
			print("<cell><![CDATA[".$row['medicalDeduction']."]]></cell>");
			print("<cell><![CDATA[".$row['NSSFdeduction']."]]></cell>");
			print("<cell><![CDATA[".$row['loanDeduction']."]]></cell>");
			print("<cell><![CDATA[".$row['otherDeduction']."]]></cell>");
			print("<cell><![CDATA[".$row['otherDeductionDescr']."]]></cell>");
			print("<cell><![CDATA[".$row['bonus']."]]></cell>");
			print("</row>");
		}
	}
	echo '</rows>';
}
else {
	loadErrorGrid("<b>NO PAYSLIP FOR PREVIOUS PAY PERIOD</b>");
}
?>