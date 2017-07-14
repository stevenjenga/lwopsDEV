<?php
require_once('../functions/functions.php');
require_once('get_payslip_functions.php');
global $db;
global $logger;
global $errorLogger;

try {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['START'=>'----------------------------------------------------------------------------------------------------']); 
	$logger->debug("[GET]", $_GET); 
	
	$selectedDateRangeRowID = $_GET['selectedDateRangeRowID'];
	loadFTEadvanceGrid($selectedDateRangeRowID);

    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['END'=>'----------------------------------------------------------------------------------------------------']); 
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadFTEadvanceGrid($selectedDateRangeRowID){
	global $db,$logger;
	
	$sql = "SELECT ftesalaryadvance.oid AS fOid, employeeOid, CONCAT(firstName, ' ', middleInitial, ' ', lastName) AS employeeName, "
        . "opsMonthlyCalendarOid, CONCAT(opsmonthlycalendar.month,' ',opsmonthlycalendar.year) AS payMonth, amount, paid "
        . "FROM ftesalaryadvance "
        . "INNER JOIN employee ON employee.oid = ftesalaryadvance.employeeOid "
        . "INNER JOIN opsmonthlycalendar ON opsmonthlycalendar.oid = opsMonthlyCalendarOid ";
    if ($selectedDateRangeRowID !=0){
        $sql .= "WHERE opsMonthlyCalendarOid=$selectedDateRangeRowID";
    }

	$rows = $db->query($sql);
	array_multisort($rows);
	$logger->debug("[loadFTEadvanceGrid()]", $db->getLastQuery());
   
    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    echo '<rows id="0">';
    echo  '	<head>
                <column width="140" type="coro" text="some text" filter="true" align="left" editable="false" auto="true" sort="str" xmlcontent="1" >Employee Name'.getFTEemployeeNamesList().'</column>
                <column width="85" type="kenyaCurrency" align="right" sort="str" >Amount</column>
                <column width="100" type="coro" text="some text" filter="true" align="middle" editable="false" auto="true"  sort="str" xmlcontent="1" >Pay Month'.getMonthlyCalendarDatesList().'</column>
                <column width="60" type="acheckro" align="middle" sort="str" >Paid</column>
                <column width="0" type="ro" align="middle" sort="str" ></column>
                <column width="0" type="ro" align="middle" sort="str" ></column>
            </head>'; 
    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['fOid']."'>");
            print("<cell><![CDATA[".$row['employeeName']."]]></cell>");
            print("<cell><![CDATA[".$row['amount']."]]></cell>");
            print("<cell><![CDATA[".$row['payMonth']."]]></cell>");
            print("<cell><![CDATA[".$row['paid']."]]></cell>");
            print("<cell><![CDATA[".$row['opsMonthlyCalendarOid']."]]></cell>");
            print("<cell><![CDATA[".$row['employeeOid']."]]></cell>");
            print("</row>");
        }
    }
    echo '</rows>';    
}
?>