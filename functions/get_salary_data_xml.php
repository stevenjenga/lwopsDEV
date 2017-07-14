<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

$rows = $db->query("SELECT D1.oid as oid, D1.employeeOid, D1.employeetype, ROUND(D1.amount,2) AS amount, D1.salarytype, 
D1.effectivetDt, D1.endDt, D2.firstName,D2.middleInitial,D2.lastName ,
D3.type as EmployeeType ,D3.description as EmployeeDes ,D4.type as SaleryType ,D4.description as SaleryDes 
FROM salary D1 
INNER JOIN employee D2 ON(D2.oid=D1.employeeOid) 
INNER JOIN employeetype D3 ON(D3.type=D1.employeetype) inner join salarytype D4 ON(D4.type=D1.salarytype) 
ORDER BY D2.firstName,D2.lastName,D1.effectivetDt");
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[sql1]", $db->trace);

$employeeObj=  $db->query("select * from employee order by firstName,lastName ");
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[sql2]", $db->trace);

$salaryTypeObj=  $db->query("select * from salarytype order by description");
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[sql3]", $db->trace);

$employeeTypeObj=  $db->query("select * from employeetype");
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[sql4]", $db->trace);

$createOptionEmployeeName= '';
$createOptionSalaryTypeName= '';
$createOptionEmployeeTypeName='';
if($employeeObj){
	foreach($employeeObj as $value){
	  $id=$value["oid"];	
	 $createOptionEmployeeName.="<option value='".$id."'>".$value['firstName']." ".$value['lastName']."</option>";		
	}
}

if($salaryTypeObj){
	foreach($salaryTypeObj as $value){
		$id=$value['type'];
		$createOptionSalaryTypeName.="<option value='".$id."'>".$value['description']."</option>";
	}
}

if($employeeTypeObj){
	foreach($employeeTypeObj as $value){
		$id=$value['type'];
		$createOptionEmployeeTypeName.="<option value='".$id."'>".$value['description']."</option>";
	}
}


header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="utf-8"?>'); 

/* start output of data */
echo '<rows id="0">';
echo  '	<head>
		<column width="100" type="ro" align="left" sort="str">First Name</column>	
		<column width="50" type="ro" align="left" sort="str">Initial</column>
		<column width="100" type="ro" align="left" sort="str">Last Name</column>
		<column width="150" type="coro"  text="" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Employee Type'.$createOptionEmployeeTypeName.'</column>
		<column width="140" type="kenyaCurrency" align="right" sort="str">Amount</column>
		<column width="120" type="coro" text="" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Salary Type'.$createOptionSalaryTypeName.'</column>
		<column width="120" type="dhxCalendar" align="left" sort="str">Effective Date</column>
		<column width="120" type="dhxCalendar" align="left" sort="str">End Date</column>
		<column width="0" type="ro" align="left" sort="str">empOid</column>
		<column width="0" type="ro" align="left" sort="str">endDtEditFlag</column>
		<column width="0" type="ro" align="left" sort="str">employeeType</column>
	</head>';
	
if($rows){
	foreach($rows as $row){
		
		$endDt='';
		if(isset($row['endDt'])) 
			$endDt = date('M.d.Y', strtotime($row['endDt']));
		else
			$endDt = '';
		
		echo ("<row id='".$row['oid']."'>");
		print("<cell><![CDATA[".$row['firstName']."]]></cell>");
		print("<cell><![CDATA[".$row['middleInitial']."]]></cell>");
		print("<cell><![CDATA[".$row['lastName']."]]></cell>");
		print("<cell><![CDATA[".$row['EmployeeDes']."]]></cell>");
		print("<cell><![CDATA[".$row['amount']."]]></cell>");
		print("<cell><![CDATA[".$row['SaleryDes']."]]></cell>");
		print("<cell><![CDATA[".date('M.d.Y', strtotime($row['effectivetDt']))."]]></cell>");
		print("<cell><![CDATA[".$endDt."]]></cell>");
		print("<cell><![CDATA[".$row['employeeOid']."]]></cell>");
		print("<cell><![CDATA[0]]></cell>");
		print("<cell><![CDATA[".$row['employeetype']."]]></cell>");

		print("</row>");
	}
}else{
}
echo '</rows>';

?>