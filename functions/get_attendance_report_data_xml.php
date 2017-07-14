<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug('$_REQUEST', $_REQUEST);
    $selectedRowID = $_REQUEST['selectedRowID'];    
    loadAttendanceRptData($selectedRowID);
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function loadAttendanceRptData($selectedRowID) {
    global $db, $logger; 
    $periodStartDt = 0 ;
    $periodEndDt = 0 ;

    //get the selected period start and end dates
	$dateSql = "SELECT periodStartDate, periodEndDt FROM opsbiweeklycalendar WHERE oid = $selectedRowID";

	$rows = $db->query($dateSql);
	$logger->debug('loadAttendanceRptData()', $db->getLastQuery());
	$logger->debug('loadAttendanceRptData()', $rows);
	if($rows){
		foreach($rows as $row){
			$periodStartDt = date('Y-m-d', strtotime($row['periodStartDate']));
			$periodEndDt = date('Y-m-d', strtotime($row['periodEndDt']));
		}
	}

    $sql = "SELECT GROUP_CONCAT(DISTINCT CONCAT('MAX(IF(attendanceDt = ''', attendanceDt,''', attendance_in, 0)) AS ', aDay)  "
        . "ORDER BY attendanceDt ASC) as aRow "
        . "FROM empAttendance_vw  "
        . "WHERE attendanceDt BETWEEN '$periodStartDt' AND '$periodEndDt' ORDER BY attendanceDt ASC ";

	$db->trace = array();
	$rows = $db->query($sql);
	$logger->debug('loadAttendanceRptData(sql1)', $db->getLastQuery());
    $logger->debug('loadAttendanceRptData(sql1)', $rows);

	if($rows){
		//create a temporary pivot table	
		foreach($rows as $row){
            $logger->debug('loadAttendanceRptData(concatrows row)', $row);
			if (!is_null($row['aRow'])) {
			$createTempTableSQL = "CREATE TABLE tempAttendanceRptTable "
                . "AS SELECT eOid, CONCAT(firstName, ' ', middleinitial, ' ', lastName) AS employeeNm,". $row['aRow']." "
                . "FROM empAttendance_vw GROUP BY eOid ORDER BY attendanceDt"; 

			$rows = $db->query($createTempTableSQL);
			$logger->debug('loadAttendanceRptData()', $db->getLastQuery());

			$rows = $db->query("SELECT * FROM tempAttendanceRptTable ORDER BY employeeNm ");
            $logger->debug('loadAttendanceRptData(sql3)', $db->getLastQuery());
            //$logger->debug('loadAttendanceRptData()', $rows);

            header("Content-type: text/xml");
			echo('<?xml version="1.0" encoding="utf-8"?>'); 

			echo 	'<rows id="0">';
                echo  	'<head>';		

                foreach($rows as $row){
                    $i = -1;
                    $columns = array_keys($row);
                    foreach($columns as $columnName){
                        $i++;
                        if ($i==0) continue;
                        if ($i==1) { $width = 145; $align="right"; $columnName = "Employee Name";}
                        else {$width = 55; $align="middle";}

                        print('<column width="'.$width.'" type="ro" align="'.$align.'" sort="str">'.$columnName.'</column>');
                        $i++;
                    }
                    break;
                }
                echo	'</head>';
                foreach($rows as $aRow){
                    $row = array_values($aRow);
                    $logger->debug('loadAttendanceRptData(table row)', $row);
                    echo ("<row id='".$row[0]."'>");	
                    print("<cell><![CDATA[".$row[1]."]]></cell>");	
                    print("<cell><![CDATA[".$row[2]."]]></cell>");	
                    print("<cell><![CDATA[".$row[3]."]]></cell>");	
                    print("<cell><![CDATA[".$row[4]."]]></cell>");	
                    print("<cell><![CDATA[".$row[5]."]]></cell>");	
                    print("<cell><![CDATA[".$row[6]."]]></cell>");	
                    print("<cell><![CDATA[".$row[7]."]]></cell>");	
                    print("<cell><![CDATA[".$row[8]."]]></cell>");	
                    print("<cell><![CDATA[".$row[9]."]]></cell>");	
                    print("<cell><![CDATA[".$row[10]."]]></cell>");	
                    print("<cell><![CDATA[".$row[11]."]]></cell>");	
                    print("<cell><![CDATA[".$row[12]."]]></cell>");	
                    print("<cell><![CDATA[".$row[13]."]]></cell>");	
                    print("<cell><![CDATA[".$row[14]."]]></cell>");
                    print("<cell><![CDATA[".$row[15]."]]></cell>");	
                    echo '</row>';
                }
                    
			echo '</rows>';
			
			$sql = "DROP TABLE tempAttendanceRptTable";
			$rows = $db->query($sql);
            $logger->debug('loadAttendanceRptData()', $db->getLastQuery());
			}
            else {
                throw new Exception("aRows was null");
            }
		}
	}
    else {
        throw new Exception("rows was null");
    }
}

?>