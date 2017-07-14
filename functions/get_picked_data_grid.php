<?php

require_once('functions.php');
global $db, $logger;

function loadTeaPickData($payroll = true){
    logStart("loadTeaPickData()");
    global $db, $logger;
    $payRate =0.0;
    try {
        $logger->debug("loadTeaPickData()", $_REQUEST); 
        $selectedRowID = $_REQUEST['selectedRowID'];
        //get the selected period
        $dateSql = "SELECT periodStartDate, periodEndDt, payDate FROM opsbiweeklycalendar WHERE oid = $selectedRowID";
        $rows = $db->query($dateSql);
        $logger->debug("loadTeaPickData()", $db->getLastQuery());
        $logger->debug("loadTeaPickData()", $rows);
        if($rows){
            foreach($rows as $row){
                $periodStartDt = date('Y-m-d', strtotime($row['periodStartDate']));
                $periodEndDt = date('Y-m-d', strtotime($row['periodEndDt']));
                $payDate = date('Y-m-d', strtotime($row['payDate']));
            }
        }

        if (!attendanceExistsBetween($periodStartDt, $periodEndDt))
            throw new Exception("Missing ATTENDANCE for selected time period [$periodStartDt to $periodEndDt] ");

        //get pay rate valid for selected pay period
        $rateSql = "SELECT rate, startDt, endDt "
            . "FROM teapickingrate "
            . "WHERE startDt >= '$periodStartDt' AND endDt <= '$periodEndDt' OR (endDt IS NULL) ORDER BY startDt LIMIT 1 ";
        $rows = $db->query($rateSql);
        $logger->debug("loadTeaPickData()",$db->getLastQuery());
        if($rows){
            foreach($rows as $row){
                $payRate = $row['rate'];
            }
        }

        $sql = "SELECT GROUP_CONCAT(DISTINCT CONCAT('SUM(IF(attendanceDt = ''', attendanceDt,''', weight, 0)) AS ', aDay) ORDER BY attendanceDt ASC) as aRow
        FROM empTeaPickingDetail_vw 
        WHERE attendanceDt BETWEEN '$periodStartDt' AND '$periodEndDt' 
        ORDER BY attendanceDt ASC";

        $rows = $db->query($sql);
        $logger->debug("loadTeaPickData()",$db->getLastQuery());
        // $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[concatrows]", $rows);
        if($rows){
            //create a temporary pivot table
            foreach($rows as $row){
                $logger->debug("loadTeaPickData() [concatrows row]", $row);
                $db->query("DROP TABLE IF EXISTS ctable");
                $createTempTableSQL = "CREATE TABLE ctable "
                    . "AS SELECT eOid, CONCAT(firstName, ' ', middleinitial, ' ', lastName) AS employeeNm, ". $row['aRow']." "
                    . "FROM empTeaPickingDetail_vw GROUP BY eOid ORDER BY attendanceDt ASC";
                $rows = $db->query($createTempTableSQL);
                $logger->debug("loadTeaPickData()",$db->getLastQuery());

                //get payroll data from temporary pivot table
                $rows = $db->query("SELECT * FROM ctable ORDER BY employeeNm");
                $logger->debug("loadTeaPickData()",$db->getLastQuery());

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
                        else {$width = 50; $align="middle";}
                        print('<column width="'.$width.'" type="ro" align="'.$align.'" sort="str">'.$columnName.'</column>');
                        $i++;
                    }
                    break;
                }

                print('<column width="50" type="ro" align="middle" sort="str">TOTAL</column>');
                if ($payroll){                    
                    print('<column width="80" type="kenyaCurrencyro" align="right" sort="str">Rate/Kg</column>');
                    print('<column width="95" type="kenyaCurrencyro" align="right" sort="str">Payout</column>');
                }
                echo	'</head>';
                if($rows){
                    $rowTotal = 0;
                    $totalWeightForPeriod = 0;
                    $totalPayForPeriod = 0;
                    foreach($rows as $aRow){	
                        $columnNames = array_keys($aRow);
                        $row = array_values($aRow); 
                        $rowTotal = 0;
                        echo ("<row id='".$row[0]."'>");	
                        print("<cell><![CDATA[".$row[1]."]]></cell>");	
                        print("<cell><![CDATA[".$row[2]."]]></cell>");	$rowTotal = $rowTotal + $row[2];
                        print("<cell><![CDATA[".$row[3]."]]></cell>");	$rowTotal = $rowTotal + $row[3];
                        print("<cell><![CDATA[".$row[4]."]]></cell>");	$rowTotal = $rowTotal + $row[4];
                        print("<cell><![CDATA[".$row[5]."]]></cell>");	$rowTotal = $rowTotal + $row[5];
                        print("<cell><![CDATA[".$row[6]."]]></cell>");	$rowTotal = $rowTotal + $row[6];
                        print("<cell><![CDATA[".$row[7]."]]></cell>");	$rowTotal = $rowTotal + $row[7];
                        print("<cell><![CDATA[".$row[8]."]]></cell>");	$rowTotal = $rowTotal + $row[8];
                        print("<cell><![CDATA[".$row[9]."]]></cell>");	$rowTotal = $rowTotal + $row[9];
                        print("<cell><![CDATA[".$row[10]."]]></cell>");	$rowTotal = $rowTotal + $row[10];
                        print("<cell><![CDATA[".$row[11]."]]></cell>");	$rowTotal = $rowTotal + $row[11];
                        print("<cell><![CDATA[".$row[12]."]]></cell>");	$rowTotal = $rowTotal + $row[12];
                        print("<cell><![CDATA[".$row[13]."]]></cell>");	$rowTotal = $rowTotal + $row[13];
                        print("<cell><![CDATA[".$row[14]."]]></cell>");	$rowTotal = $rowTotal + $row[14];
                        print("<cell><![CDATA[".$row[15]."]]></cell>");	$rowTotal = $rowTotal + $row[15];
                        print("<cell><![CDATA[".$rowTotal."]]></cell>");	
                        
                        if ($payroll){
                            print("<cell><![CDATA[".$payRate."]]></cell>");
                            print("<cell><![CDATA[".$payRate*$rowTotal."]]></cell>");
                            $totalPayForPeriod = $totalPayForPeriod + ($payRate*$rowTotal);
                        }
                        $totalWeightForPeriod = $totalWeightForPeriod + $rowTotal;
                        print("</row>");
                    }			
                }
                $columnTotals = getColumnTotals($columnNames);
                echo 	'<row id="0">';
                print("<cell><![CDATA[<b>TOTAL</b>]]></cell>");	
                for ($i=0; $i<count($columnTotals); $i++) {
                    print("<cell><![CDATA[".$columnTotals[$i]."]]></cell>");	
                }
                print("<cell><![CDATA[<b>".$totalWeightForPeriod."</b>]]></cell>");
                if ($payroll){
                    print("<cell><![CDATA[0]]></cell>");
                    print("<cell><![CDATA[".$totalPayForPeriod."]]></cell>");
                }
                echo '</row>';
                echo '</rows>';

                $sql = "DROP TABLE ctable";
                $rows = $db->query($sql);
                $logger->debug("loadTeaPickData()",$db->getLastQuery());
            }
        }
        logStart("loadTeaPickData()");
    }
    catch (Exception $e) {
        $logger->debug("loadTeaPickData()", ['ERROR THROWN: ' => $e->getMessage()]);
        loadErrorGrid("<b>".$e->getMessage()."</b>");
    }
}
function getColumnTotals($columnNames){
	global $db;
	global $logger;
	$columnValues = array();
	$x=0;

	$logger->debug("getColumnTotals()", $columnNames);

	for ($i=2; $i<16; $i++) {
		$columnTotalSql = "SELECT SUM(".$columnNames[$i].") AS dayTotal FROM `ctable` ";
		$db->trace = array();
		$rows = $db->query($columnTotalSql);
		//$logger->debug("getColumnTotals()",$db->getLastQuery());;
		foreach($rows as $aRow) {
			$columnValues[$x++] = $aRow['dayTotal'];
		}
	}
	// $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[COLUMN TOTS]", $columnValues);
	return $columnValues;
}
?>