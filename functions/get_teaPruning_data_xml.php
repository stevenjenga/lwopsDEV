<?php
require_once('functions.php');
global $db;

if(isset($_REQUEST['date'])){
	$date=$_REQUEST['date'];	
}
else{
	//use todays date
	$date=date('Y-m-d');
}

$sql = "SELECT teapruning.oid AS tpOid, employee.oid AS eOid, attendanceOid AS aOid, attendance.attendance_in, CONCAT(employee.firstName, ' ', employee.middleInitial, ' ', employee.lastName) AS employeeName, teaBlockOid, teaPruningRateOid, teapruningrate.ratePerBush AS pruningPayRate, nbrOfBushesPruned, date AS pruningDate, CONCAT(teablock.blockNbr, ' ', teablock.name) AS teaBlockName  
FROM teapruning 
INNER JOIN teablock ON teablock.oid = teapruning.teaBlockOid 
INNER JOIN attendance ON attendance.oid = teapruning.attendanceOid 
INNER JOIN employee ON employee.oid = attendance.employeeOid 
INNER JOIN teapruningrate ON teapruningrate.oid = teapruning.teaPruningRateOid
WHERE date = '$date' ";

$rows = $db->query($sql);
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);

$teaBlockObj =  $db->query("SELECT `oid`, `blockNbr`, `name` FROM `teablock`");
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME). "[blockNames]", $db->trace);
$teaBlockNameList = '';
if($teaBlockObj){
	foreach($teaBlockObj as $value){ 
		$id=$value["oid"];
		$blockNm = $value["blockNbr"]." - ".$value["name"];
		$teaBlockNameList.="<option value='".$id."'>".$blockNm."</option>";
	}
}

//list of employees in attendance on the selected date (today or date from date-picker)
$attendanceObj =  $db->query("SELECT employee.oid AS eOid, CONCAT(employee.firstName, ' ', employee.middleInitial, ' ', employee.lastName) AS employeeName, attendance.oid AS aOid, `employeeOid`, `attendanceDt`, `attendance_in` FROM `attendance` 
INNER JOIN employee ON employee.oid = attendance.employeeOid 
WHERE employee.active = 1 AND attendance.attendance_in = 1 AND attendance.attendanceDt = '$date'");
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME). "[inAttendance]", $db->trace);

$attendanceNameList = '';
if($attendanceObj){
	foreach($attendanceObj as $value){
		$id=$value['aOid'];
		$attendanceNameList.="<option value='".$id."'>".$value['employeeName']."</option>";
	}
}

$teaPruningRateObj =  $db->query("SELECT `oid`, `ratePerBush` FROM `teapruningrate` WHERE `endDt` IS NULL");
$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME). "[rates]", $db->trace);
$currentTeaPruningRate = '';
if($teaPruningRateObj){
	foreach($teaPruningRateObj as $value){
		$id=$value['oid'];
		$currentTeaPruningRate.="<option value='".$id."'>".$value['ratePerBush']."</option>";
	}
}

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="utf-8"?>'); 

/* start output of data */
echo '<rows id="0">';
echo  '	<head>
		<column width="100" type="ro" align="left" sort="str" >Pruning Date</column>
		<column width="150" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Employee Name'.$attendanceNameList.'</column>	
		<column width="150" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1">Tea Block Pruned'.$teaBlockNameList.'</column>
		<column width="120" type="ed" align="right" sort="str">Nbr of Bushes Pruned</column>		
		<column width="100" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1">Pay Rate/Bush'.$currentTeaPruningRate.'</column>
	</head>';
	
if($rows){
	foreach($rows as $row){
		echo ("<row id='".$row['tpOid']."'>");
		print("<cell><![CDATA[".date('M.d.Y', strtotime($row['pruningDate']))."]]></cell>");
		print("<cell><![CDATA[".$row['employeeName']."]]></cell>");
		print("<cell><![CDATA[".$row['teaBlockName']."]]></cell>");
	    print("<cell><![CDATA[".$row['nbrOfBushesPruned']."]]></cell>");		
		print("<cell><![CDATA[".number_format($row['pruningPayRate'],2)."]]></cell>");
		print("</row>");
	}
}
echo '</rows>';

?>