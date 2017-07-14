<?php
require_once('functions.php');
global $db;
global $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));

    $date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
    $logger->debug('$date', ['date'=>$date]);
    loadAttendanceGrid($date);
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadAttendanceGrid($dt){
    global $db;
    global $logger; 

    $date = '';
    if(isset($dt)){
    	$date = date('Y-m-d', strtotime($dt));
    }
    else {
        $date = getMaxAttendanceDt();
        $logger->debug("DATE", ['date'=>$date]);
    }

    $sql = "SELECT CONCAT(firstName, ' ', middleInitial, ' ', lastName) AS employeeName, attendanceDt, attendance_in, attendance.oid as aid "
        . "FROM attendance "
        . "LEFT JOIN employee ON employee.oid = attendance.employeeOid "
        . "WHERE attendanceDt = '".$date."' AND employee.active='1' "
        . "ORDER BY firstName ASC, middleInitial ASC, lastName ASC";

    $rows = $db->query($sql);
    $logger->debug("loadAttendanceGrid()", $db->getLastQuery());

    if($rows){
        loadGrid($rows, $date);
    }
    else{// auto insert attendance rows if there are none for the selected date, then fetch and display
        $db->where('attendanceDt', $date);
        $check = $db->has('attendance');
        $logger->debug("loadAttendanceGrid(1)", $db->getLastQuery());

        if(!$check){ 
            $employeeList = $db->query("SELECT oid from employee WHERE active = 1 AND startDt <= '".$date."'");
            $logger->debug("loadAttendanceGrid(2)", $db->getLastQuery());
            insertEmmployeeAttendance($employeeList,$date);
        }
        $rows = $db->query($sql);
        loadGrid($rows, $date);
    }		
}

function insertEmmployeeAttendance($employeeList,$date){
    global $db;
    global $logger;
    
    if ($employeeList) {
        $db->startTransaction();
        foreach($employeeList as $empid){
            $data=array(
                    'employeeOid'=> $empid['oid'],
                    'attendance_in'=> 1,
                    'attendanceDt'=> $date
                    );
            $db->insert("attendance",$data);

            if ($db->getLastErrno() != 0){
                $db->rollback();
                throw new Exception($db->getLastError());
            }
        }
        $db->commit();
    }
    $logger->debug("loadAttendanceGrid(3)", $db->getLastQuery());    
}

function loadGrid($rows, $date){
    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    echo '<rows id="0">';
    echo  '	<head>		
            <column width="200" type="ro" align="right" sort="str">Employee Name</column>		
            <column width="91" type="ch" align="right" sort="str">- Present? - (as of '.date("M d", strtotime($date)).')</column>		
        </head>';

    foreach($rows as $row){
        echo ("<row id='".$row['aid']."'>");
        print("<cell><![CDATA[".$row['employeeName']."]]></cell>");
        print("<cell><![CDATA[".$row['attendance_in']."]]></cell>");
        print("</row>");
    }
    echo '</rows>';
}
function getMaxAttendanceDt(){
    global $db, $logger;

    $sql = "SELECT DATE(MAX(attendanceDt)) AS maxDate, DATE_ADD(DATE(MAX(attendanceDt)), INTERVAL 1 DAY) AS nextDate "
        . "FROM attendance ";
    $rows = $db->query($sql);
    $logger->debug('getMaxAttendanceDt()', $db->getLastQuery());
    $logger->debug('getMaxAttendanceDt()', $rows);
    if($rows){
        foreach($rows as $row){
            return $row['maxDate'];
        }
    }    
}