<?php
require_once('functions.php');
global $db;
global $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadOtherWorkGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadOtherWorkGrid(){
    global $db,$logger;
    $logger->debug('loadOtherWorkGrid()', $_GET);
    $sql = "SELECT otherworkassigned.oid AS wOid, attendanceDt, CONCAT(employee.firstName,' ', employee.middleInitial, ' ', "
        . "employee.lastName) AS employeeName, attendanceOid, otherworkassigned.lineOfBusinessOid, department, hours, description, remarks, "
        . "TIME_FORMAT(startTm,'%H:%i') AS startTm, TIME_FORMAT(endTm,'%H:%i')AS endTm "
        . "FROM otherworkassigned "
        . "INNER JOIN (employee, attendance, salary) "
            . "ON ( employee.oid = attendance.employeeOid "
            . "AND attendance.oid = otherworkassigned.attendanceOid "
            . "AND salary.employeeOid = employee.oid )"
        . "INNER JOIN lineofbusiness ON lineofbusiness.oid = otherworkassigned.lineOfBusinessOid "
        . "WHERE salary.employeetype ='C' ";

    if(isset($_GET['date'])){
        $date= $_GET['date'];
        $convertDate= date('Y-m-d', strtotime($date));
    }
    else {
        $date= date('Y-m-d');
        $convertDate= $date; 
    }
    $sql .= "AND attendanceDt ='$convertDate' ORDER BY employee.firstName, employee.middleInitial, employee.lastName";
    $rows = $db->query($sql);
    $logger->debug('loadOtherWorkGrid()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    echo '<rows id="0">';
    echo  '	<head>
            <column width="120" type="ro" align="left" sort="str" >Date</column>
            <column width="140" type="ro" align="left" sort="str">Employee Name</column>
            <column width="70" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Start Time'.getOtherClockList().'</column>	
            <column width="70" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">End Time'.getOtherClockList().'</column>	
            <column width="50" type="ro" align="right" sort="str">Hours</column>
            <column width="300" type="ed" align="left" sort="str">Description of Work Done</column>		
            <column width="200" type="coro" text="some text" filter="true" align="left" editable="false" auto="true" sort="str" xmlcontent="1">Department'.getLOBnamesList().'</column>
            <column width="300" type="ed" align="left" sort="str">Remarks</column>	
            <column width="50" align="middle" type="addOtherWorkBtn" sort="str">Add New</column>
            <column width="0" align="middle" type="ro" sort="str">attOid</column>
        </head>';

    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['wOid']."'>");
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['attendanceDt']))."]]></cell>");
            print("<cell><![CDATA[".$row['employeeName']."]]></cell>");
            print("<cell><![CDATA[".$row['startTm']."]]></cell>");		
            print("<cell><![CDATA[".$row['endTm']."]]></cell>");
            print("<cell><![CDATA[".$row['hours']."]]></cell>");
            print("<cell><![CDATA[".$row['description']."]]></cell>");
            print("<cell><![CDATA[".$row['department']."]]></cell>");
            print("<cell><![CDATA[".$row['remarks']."]]></cell>");
            print("<cell><![CDATA[".''."]]></cell>");
            print("<cell><![CDATA[".$row['attendanceOid']."]]></cell>");
            print("</row>");
        }
    }		
    echo '</rows>';
}