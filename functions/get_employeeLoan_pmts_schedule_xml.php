<?php
require_once('../functions/functions.php');
global $db;
global $logger;
global $errorLogger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $_GET);
    loadLoanPmtsHistoryDataGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadLoanPmtsHistoryDataGrid() {
    global $db;
    global $logger;
    $loanPmtOid = 0;
    $sql = "";
        $sql = "SELECT employeeloanpmt.oid, payslipNbr, "
            . "employee.firstName, employee.lastName, loanNbr, dateDeducted, balanceAmount, "
            . "loanAmount, deductionAmt, paid, employeeloanpmt.updtTmstp "
            . "FROM employeeloanpmt "
            . "INNER JOIN employeeloan ON employeeloan.oid = employeeloanpmt.employeeLoanOid "
            . "INNER JOIN employee ON employee.oid = employeeloan.employeeOid "
            . "WHERE deductionAmt != 0 "
            . "ORDER BY firstname DESC, `employeeloanpmt`.`balanceAmount` DESC";
    $rows = $db->query($sql);
    $logger->debug("loadLoanPmtsHistoryDataGrid()", $db->trace);
    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    echo '<rows id="0">';
    echo  '	<head>		
            <column width="120" type="ro" align="left" sort="str">First Name</column>	
            <column width="120" type="ro" align="left" sort="str">Last Name</column>
            <column width="120" type="ro" align="left" sort="str">Loan Number</column>	
            <column width="120" type="kenyaCurrencyro" align="right" sort="str">Amount Paid</column>
            <column width="100" type="kenyaCurrencyro" align="right" sort="str">Balance</column>
            <column width="75" type="acheckro" align="middle" sort="str">Paid</column>
            <column width="120" type="ro" align="right" sort="str">Date Paid</column>
            <column width="120" type="ro" align="right" sort="str">Payslip Nbr</column>
            <column width="120" type="loanPmtByPayslipBtn" align="middle" sort="str">Pay with Payslip</column>
        </head>'; 

    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['oid']."'>");
            print("<cell><![CDATA[".$row['firstName']."]]></cell>");
            print("<cell><![CDATA[".$row['lastName']."]]></cell>");
            print("<cell><![CDATA[".$row['loanNbr']."]]></cell>");
            print("<cell><![CDATA[".$row['deductionAmt']."]]></cell>");
            print("<cell><![CDATA[".$row['balanceAmount']."]]></cell>");
            print("<cell><![CDATA[".$row['paid']."]]></cell>");
            print("<cell><![CDATA[".$row['dateDeducted']."]]></cell>");
            if ($row['payslipNbr'] == '0') {
                print("<cell><![CDATA[".'n/a'."]]></cell>");
            }
            else {
                print("<cell><![CDATA[".$row['payslipNbr']."]]></cell>");
            }
            print("<cell><![CDATA[".''."]]></cell>");
            print("</row>");
        }
    }

    echo '</rows>';    
}
