<?php
require_once('../functions/functions.php');
global $db;
global $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));

    $date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
    $logger->debug('$date', ['date'=>$date]);
    loadLoanDataGrid($date);
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadLoanDataGrid(){
    global $db, $logger;    
    $sql = "SELECT employeeloan.oid, employeeOid, CONCAT(firstName, ' ', middleInitial, ' ', lastName) as empName, loanNbr, loanDate, "
        . "loanAmount, purpose, nbrOfPayPeriods, opsMonthlyCalendarOid, installmentAmt "
        . "FROM employeeloan "
        . "INNER JOIN employee ON employee.oid = employeeloan.employeeOid";
    $rows = $db->query($sql);
    $logger->debug("loadLoanDataGrid()", $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    echo '<rows id="0">';
    echo  '	<head>		
            <column width="140" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Employee Name (FTE)'.getNamesOfFTEwithoutLoans().'</column>
            <column width="120" type="ro" align="left" sort="str">Loan Number</column>		
            <column width="100" type="dhxCalendar" align="left" sort="str">Loan Date</column>
            <column width="120" type="kenyaCurrency" align="right" sort="str">Amount</column>
            <column width="200" type="ed" align="left" sort="str">Purpose</column>
            <column width="90" type="ro" align="right" sort="str">Pay Period (months)</column>
            <column width="70" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Start Month'.getMonthlyCalendarDatesList().'</column>
            <column width="120" type="kenyaCurrency" align="right" sort="str">Installment Amount</column>
        </head>'; 
    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['oid']."'>");
            print("<cell><![CDATA[".$row['empName']."]]></cell>");
            print("<cell><![CDATA[".$row['loanNbr']."]]></cell>");
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['loanDate']))."]]></cell>");
            print("<cell><![CDATA[".$row['loanAmount']."]]></cell>");
            print("<cell><![CDATA[".$row['purpose']."]]></cell>");
            print("<cell><![CDATA[".$row['nbrOfPayPeriods']."]]></cell>");
            print("<cell><![CDATA[".$row['opsMonthlyCalendarOid']."]]></cell>");
            print("<cell><![CDATA[".$row['installmentAmt']."]]></cell>");
            print("</row>");
        }
    }
    echo '</rows>';
}

function getNamesOfFTEwithoutLoans() {
    global $db;
    global $logger;
    $employeeObj = $db->query("SELECT employee.oid AS eOid, firstName, middleinitial, lastName "
        . "FROM employee "
        . "INNER JOIN salary ON salary.employeeOid = employee.oid "
        . "WHERE salary.employeetype = 'S' "
        . "AND employee.oid NOT IN "
            . "(SELECT employeeOid "
                . "FROM employeeloan "
                . "INNER JOIN employeeloanpmt ON employeeloanpmt.employeeLoanOid = employeeloan.oid "
                . "WHERE paid = 0 ) "
        . "ORDER BY employee.firstName, employee.middleinitial, employee.lastName ");
    $logger->debug('getNamesOfFTEwithoutLoans()', $db->getLastQuery());
    $FTEemployeeNameList = '';
    if ($employeeObj) {
        foreach ($employeeObj as $value) {
            $id = $value["eOid"];
            $employeeNm = $value["firstName"] . " " . $value["middleinitial"] . " " . $value["lastName"];
            $FTEemployeeNameList .= "<option value='" . $id . "'>" . $employeeNm . "</option>";
        }
    }
    return $FTEemployeeNameList;
}
