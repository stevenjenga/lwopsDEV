<?php
require_once('functions.php');
global $db;
global $logger;

$payRate =0.0;
try {
	$selectedRowID = $_REQUEST['selectedRowID'];
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[REQUEST]=", $_REQUEST);

	//get the selected period start and end dates
	$dateSql = "SELECT periodStartDate, periodEndDt, payDate FROM opsbiweeklycalendar WHERE oid = $selectedRowID";
	$db->trace = array();
	$rows = $db->query($dateSql);
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[PAY PERIOD]", $rows);
	if($rows){
		foreach($rows as $row){
			$periodStartDt = date('Y-m-d', strtotime($row['periodStartDate']));
			$periodEndDt = date('Y-m-d', strtotime($row['periodEndDt']));
			$payDate = date('Y-m-d', strtotime($row['payDate']));
		}
	}
	if (!attendanceExistsBetween($periodStartDt, $periodEndDt))
		throw new Exception("Missing ATTENDANCE for selected time period [$periodStartDt to $periodEndDt] ");

	$sql = "SELECT GROUP_CONCAT(DISTINCT CONCAT('SUM(IF(attendanceDt = ''', attendanceDt,''', hours, 0)) AS ', aDay) ORDER BY attendanceDt ASC) as aRow 
	FROM empotherworkhrs_vw 
	WHERE attendanceDt BETWEEN '$periodStartDt' AND '$periodEndDt'";
	$db->trace = array();
	$rows = $db->query($sql);
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);

	if($rows){
		//create a temporary pivot table	
		foreach($rows as $row){
			if (!is_null($row['aRow'])) {
			$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['key1' => 'Row was NOT NULL']);
			$sql2 = "CREATE TABLE tempOtherWorkTable AS SELECT eOid, "
                . "CONCAT(firstName, ' ', middleinitial, ' ', lastName) AS employeeNm,". $row['aRow']." "
                . "FROM empotherworkhrs_vw GROUP BY eOid"; 
			$db->trace = array();
			$rows = $db->query($sql2);
			$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[tempOtherWorkTable Qry]", $db->trace);
			
			//get payroll data from temporary pivot table
			$db->trace = array();
			$rows = $db->query("SELECT * FROM tempOtherWorkTable ORDER BY employeeNm");
			$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);

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
			print('<column width="45" type="ro" align="middle" sort="str">Pay Type</column>');
			print('<column width="90" type="kenyaCurrencyro" align="right" sort="str">Base Pay</column>');
			print('<column width="85" type="kenyaCurrencyro" align="right" sort="str">Rate/Hr</column>');
			print('<column width="85" type="kenyaCurrencyro" align="right" sort="str">Payout</column>');
				
			echo	'</head>';
			if($rows){
				$totalHoursForPeriod = 0;
				$totalPayForPeriod = 0;
				$columnTotals  = 0;
				foreach($rows as $aRow){
					$columnNames = array_keys($aRow);
					$row = array_values($aRow);
					$rowTotal = 0;
					$data = getEmployeeSalaryDetails($row[0],$periodStartDt, $periodEndDt);
					$payType = $data['salarytype'];
					$basePay = $data['amount'];
					$payRate = $data['rate'];
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
					print("<cell><![CDATA[".$payType."]]></cell>");		
					print("<cell><![CDATA[".$basePay."]]></cell>");						
					print("<cell><![CDATA[".$payRate."]]></cell>");
					print("<cell><![CDATA[".$payRate*$rowTotal."]]></cell>");
					print("</row>");
					$totalHoursForPeriod = $totalHoursForPeriod + $rowTotal;
					$totalPayForPeriod = $totalPayForPeriod + ($payRate*$rowTotal);	
				}
			}
			$columnTotals = getColumnTotals($columnNames);
			echo '<row id="0">';
			print("<cell><![CDATA[<b>TOTAL</b>]]></cell>");
			for ($i=0; $i<count($columnTotals); $i++) {
				print("<cell><![CDATA[".$columnTotals[$i]."]]></cell>");	
			}
			print("<cell><![CDATA[<b>".$totalHoursForPeriod."</b>]]></cell>");
			print("<cell><![CDATA[-]]></cell>");
			print("<cell><![CDATA[0.0]]></cell>");
			print("<cell><![CDATA[0.0]]></cell>");
			print("<cell><![CDATA[".$totalPayForPeriod."]]></cell>");
			echo '</row>';
			echo '</rows>';
			
			$sql = "DROP TABLE tempOtherWorkTable";
			$db->trace = array();
			$rows = $db->query($sql);
			$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);	
			}
		}
	}
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()."</b>");
}

function getColumnTotals($columnNames){
	global $db;
	global $logger;
	$columnValues = array();
	$x=0;

	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[COLUMN NAMES]", $columnNames);

	for ($i=2; $i<16; $i++) {
		$columnTotalSql = "SELECT SUM(".$columnNames[$i].") AS dayTotal FROM `tempOtherWorkTable` ";
		$db->trace = array();
		$rows = $db->query($columnTotalSql);
		foreach($rows as $aRow) {
			$columnValues[$x++] = $aRow['dayTotal'];
		}
	}
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME)."[COLUMN TOTS]", $columnValues);
	return $columnValues;
}
?>