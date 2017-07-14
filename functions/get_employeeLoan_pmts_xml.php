<?php
require_once('functions.php');
global $db;
global $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $_GET);
    loadLoanPmtsDataGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadLoanPmtsDataGrid() {
    global $db;
    global $logger;
    $sql = "SELECT employeeloanpmt.oid, employeeloanpmt.employeeLoanOid, "
        . "CONCAT( employee.firstName, ' ', employee.middleInitial, ' ', employee.lastName ) AS employeeName, loanNbr, "
        . "loanAmount, deductionAmt, (balanceAmount+deductionAmt) AS loanBalance, MAX(balanceAmount), paid, "
        . "employeeloanpmt.updtTmstp, salary.employeetype AS empType "
        . "FROM employeeloanpmt "
        . "INNER JOIN employeeloan ON employeeloan.oid = employeeloanpmt.employeeLoanOid "
        . "INNER JOIN (employee, salary) ON (employee.oid = employeeloan.employeeOid AND employee.oid  = salary.employeeOid) "
        . "WHERE deductionAmt != 0 AND paid = 0 "
        . "GROUP BY employee.oid "
        . "ORDER BY `employeeloanpmt`.`balanceAmount` DESC";
    $rows = $db->query($sql);
    $logger->debug("loadLoanPmtsDataGrid()", $db->getLastQuery());
    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    echo '<rows id="0">';
    echo  '	<head>		
            <column width="140" type="coro" text="some text" filter="true" align="left" editable="false" auto="true" sort="str" xmlcontent="1" >Employee Name'.getEmployeeNamesList().'</column>
            <column width="120" type="ro" align="left" sort="str">Loan Number</column>	
            <column width="120" type="kenyaCurrencyro" align="right" sort="str">Installment Amount</column>
            <column width="100" type="kenyaCurrencyro" align="left" sort="str">Balance</column>
            <column width="75" type="acheck" align="right" sort="str">Paid</column>
            <column width="75" type="ro" align="right" sort="str">Date Paid</column>
            <column width="140" type="makePayslipLoanPmtBtn" align="right" sort="str">WITH PAYSLIP</column>
            <column width="140" type="makeOfflineLoanPmtBtn" align="right" sort="str">OFF-LINE</column>
            <column width="0" type="ro" align="right" sort="str"></column>
            <column width="0" type="ro" align="right" sort="str"></column>
        </head>'; 

    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['oid']."'>");
            print("<cell><![CDATA[".$row['employeeName']."]]></cell>");
            print("<cell><![CDATA[".$row['loanNbr']."]]></cell>");
            print("<cell><![CDATA[".$row['deductionAmt']."]]></cell>");
            print("<cell><![CDATA[".$row['loanBalance']."]]></cell>");
            print("<cell><![CDATA[".$row['paid']."]]></cell>");
            if (is_null($row['updtTmstp'])){
                print("<cell><![CDATA[".'n/a'."]]></cell>");
            }
            else {
                print("<cell><![CDATA[".$row['updtTmstp']."]]></cell>");
            }
            print("<cell><![CDATA[".''."]]></cell>");
            print("<cell><![CDATA[".''."]]></cell>");
            print("<cell><![CDATA[".$row['employeeLoanOid']."]]></cell>");
            print("<cell><![CDATA[".$row['empType']."]]></cell>");
            print("</row>");
        }
    }

    echo '</rows>';    
} 

function makeLoanPmt($loanPmtOid){
	global $db;
	global $logger;
	$logger->debug("makeLoanPmt() ", $_GET);

	$pmtDt = new datetime();
    confirmPmtIsDateBeforeLoanDt($loanPmtOid, $pmtDt);
	$data = Array (					
                "paid" => 1,
				"updtTmstp" => $pmtDt->format('Y-m-d')
				);
	$db->where ('oid', $loanPmtOid);
	$db->update ('employeeloanpmt', $data);	
	$logger->debug("makeLoanPmt() ", $db->getLastQuery());
	if ($db->getLastErrno() === 0)	
		return array('updated',$loanPmtOid,$loanPmtOid,"SUCCESS!!");
	else 
		return array('error',$loanPmtOid,$loanPmtOid,$db->getLastError());   
}

function confirmPmtIsDateBeforeLoanDt($loanPmtOid, $pmtDt){
	global $db;
	global $logger;
    $loanDt;
    
    $loanIDrows = $db->query("SELECT employeeLoanOid FROM employeeloanpmt WHERE oid =". $loanPmtOid." LIMIT 1");
    $logger->debug('pmtIsDateBeforeLoanDt()[loanIDrows]', $db->getLastQuery());
    foreach($loanIDrows as $row){
        $loanRows = $db->query("SELECT DATE(loandate) aS loanDate FROM employeeloan WHERE oid =". $row['employeeLoanOid']." LIMIT 1");
        $logger->debug('pmtIsDateBeforeLoanDt()[loanRows]', $db->getLastQuery());
        foreach($loanRows as $aRow){
            if ($pmtDt->format('Y-m-d') < (new datetime($aRow['loanDate']))->format('Y-m-d')){
                throw new Exception("Loan payment date MUST be AFTER date loan was taken");
            }
            else {
                return false;
            }            
        }
    }  

}