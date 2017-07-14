<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    getTeaPickingData();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid($e->getMessage());
}
function getTeaPickingData(){
    global $db, $logger;
    
    if(isset($_GET['date'])){
        $date = $_GET['date'];
        $convertedDate = date('Y-m-d', strtotime($date));
    }
    else {
        $convertedDate = date('Y-m-d');
    }
    //select ACTIVE tea pickers only. ACTIVE = current role is TEA PICKER
    $sql = "SELECT teapicking.oid AS tpOid, CONCAT(employee.firstName,' ', employee.middleInitial, ' ', employee.lastName) AS employeeName, "
        . "attendanceDt, attendance.oid as aOid, weight, name AS blockNm, teaBlock_oid "
        . "FROM employee  "
        . "INNER JOIN attendance ON employee.oid = attendance.employeeOid "
        . "INNER JOIN teapicking ON teapicking.attendanceOid = attendance.oid  "
        . "INNER JOIN teaBlock ON teablock.oid = teapicking.teaBlock_oid "
        . "INNER JOIN (employeerole, employeeroletype) "
            . "ON (employee.oid = employeerole.employeeOid AND employeerole.employeeRoleTypeOid = employeeroletype.oid) "
        . "WHERE attendanceDt = '$convertedDate' AND employeeroletype.role = 'TEA PICKER' "    
        . "ORDER BY firstName, lastName";

    $rows = $db->query($sql);
    $logger->debug('getTeaPickingData()', $db->getLastQuery()); 

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 
    echo '<rows id="0">';
    echo  '	<head>
            <column width="120" type="ro" align="left" sort="str">Attendance Date</column>	
            <column width="140" type="ro" align="left" sort="str">Employee Name</column>	
            <column width="120" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Block'.getTeaBlocksList().'</column>		
            <column width="65" type="ed" align="right" sort="str">Weight Kg</column>
            <column width="50" align="middle" type="addTeaPickedBlockBtn" sort="str">Add New</column>
            <column width="0" align="middle" type="ro" sort="str">attOid</column>
        </head>';

    if($rows){
        foreach($rows as $row){
            /* create xml tag for grid's row */
            $qty= $row['weight'];
            if($row['weight']==""){
                $qty=0;
            }
            echo ("<row id='".$row['tpOid']."'>");
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['attendanceDt']))."]]></cell>");
            print("<cell><![CDATA[".$row['employeeName']."]]></cell>");
            print("<cell><![CDATA[".$row['blockNm']."]]></cell>");
            print("<cell><![CDATA[".$row['weight']."]]></cell>");
            print("<cell><![CDATA[".''."]]></cell>");
            print("<cell><![CDATA[".$row['aOid']."]]></cell>");
            print("</row>");
        }
    }
    else{
        throw new Exception("Employee attendance for selected date missing");
    }		
    echo '</rows>';
}