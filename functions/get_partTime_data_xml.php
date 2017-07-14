<?php
require_once('functions.php');
global $db,$logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadParttimelGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadParttimelGrid(){
    global $db,$logger;
    
    $sql = "SELECT parttimedetail.attendanceOid AS aOid, attendance.attendanceDt, parttimedetail.oid AS pOid, 
    CONCAT(employee.firstName, ' ', employee.lastName) AS employeeName, employee.oid AS empOid, hours,  TIME_FORMAT(startTm,'%H:%i') AS startTm,
    TIME_FORMAT(endTm,'%H:%i')AS endTm, allocatedBy, remarks, workDescription, parttimedetail.lineOfBussinessOid, department 
    FROM parttimedetail
    INNER JOIN attendance ON attendance.oid = parttimedetail.attendanceOid
    INNER JOIN lineofbusiness ON lineofbusiness.oid = parttimedetail.lineOfBussinessOid 
    INNER JOIN employee ON parttimedetail.employeeOid = employee.oid 
    INNER JOIN salary ON salary.employeeOid = employee.oid 
    WHERE (salary.salarytype IN ('D', 'H', 'W', 'M') AND salary.endDt IS NULL) ";

    if(isset($_GET['date'])){
        $date= $_GET['date'];
        $convertedDate= date('Y-m-d', strtotime($date));
        $sql .= "AND attendanceDt = '$convertedDate' ORDER BY employeeName";
    }
    else {
        $sql .= "AND attendanceDt = CURRENT_DATE ORDER BY employeeName";
    }

    $rows = $db->query($sql);
    $logger->debug("loadParttimelGrid()", $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    echo '<rows id="0">';
    echo  '	<head>
            <column width="120" type="ed" align="left" sort="str">Date</column>	
            <column width="140" type="ro" align="left" sort="str">Employee Name</column>	
            <column width="70" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Start Time'.getParttimeClockList().'</column>	
            <column width="70" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">End Time'.getParttimeClockList().'</column>	
            <column width="45" type="ro" align="right" sort="str">Tot Hours</column>
            <column width="250" type="ed" align="left" sort="str">Desription of Work Done</column>
            <column width="200" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Allocated By'.getSupervisorNamesList().'</column>			
            <column width="200" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">LOB'.getLOBnamesList().'</column>	
            <column width="250" type="ed" align="left" sort="str">Remarks</column>	
            <column width="50" align="middle" type="addParttimeBtn" sort="str">Add New</column>
            <column width="0" align="middle" type="ro" sort="str">empOid</column>
            <column width="0" align="middle" type="ro" sort="str">aOid</column>
        </head>';

    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['pOid']."'>");
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['attendanceDt']))."]]></cell>");		
            print("<cell><![CDATA[".$row['employeeName']."]]></cell>");
            print("<cell><![CDATA[".$row['startTm']."]]></cell>");		
            print("<cell><![CDATA[".$row['endTm']."]]></cell>");
            print("<cell><![CDATA[".$row['hours']."]]></cell>");
            print("<cell><![CDATA[".$row['workDescription']."]]></cell>");
            print("<cell><![CDATA[".$row['allocatedBy']."]]></cell>");
            print("<cell><![CDATA[".$row['department']."]]></cell>");
            print("<cell><![CDATA[".$row['remarks']."]]></cell>");
            print("<cell><![CDATA[".''."]]></cell>");
            print("<cell><![CDATA[".$row['empOid']."]]></cell>");
            print("<cell><![CDATA[".$row['aOid']."]]></cell>");
            print("</row>");
        }
    }
    echo '</rows>';
}