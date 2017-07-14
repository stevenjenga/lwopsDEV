<?php
require_once('functions.php');
require_once('get_payslip_functions.php');
global $db;
global $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
	$logger->debug("GET", $_GET); 
	
	if(isset($_GET['selectedDateRangeRowID'])){
		$employeeType = $_GET['employeeType'];
		$selectedDateRangeRowID = $_GET['selectedDateRangeRowID'];
        
        if ($_GET['lockPayslip']=='1'){
            lockFTEpayslip($selectedDateRangeRowID,'fteemployeepayslip');
        }
        else {
            if ($_GET['regenerate']=='1') {
                if (payslipIsLocked($selectedDateRangeRowID,'fteemployeepayslip','opsMonthlyCalendarOid')){
                    throw new Exception("Regenaration of selected Payslip NOT ALLOWED - Payslip is LOCKED [".$selectedDateRangeRowID."]");
                }                
                
                regeneratePayslipData($selectedDateRangeRowID,$employeeType);
            }
            else {
                getExisitingPaySlipData($selectedDateRangeRowID,$employeeType);
            }

            loadFTEpayslipGrid($selectedDateRangeRowID);
            logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
        }
	}
	else {
		throw new Exception("Select pay month and click view");
	}
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function regeneratePayslipData($selectedDateRangeRowID,$employeeType){
    global $logger;
    global $db;    
    
    $db->startTransaction();
    $logger->debug("", ['Regenrating'=>' Payslips']);
    if (!deletePaySlipsForPayPeriod($selectedDateRangeRowID, $employeeType)) {
        $db->rollback();
        throw new Exception("Error deleting exisiting FTE pay slips for opsBiWeeklyCalendarOid. DB ERROR: ".$db->getLastError());
    }
    if (!generateAndSavePaySlip($selectedDateRangeRowID, $employeeType)){
        $db->rollback();
        throw new Exception("Error generating FTE pay slips. DB ERROR: ".$db->getLastError());               
    }
    $db->commit(); 
}

function getExisitingPaySlipData($selectedDateRangeRowID,$employeeType){
    global $logger;
    global $db; 

    if (!payslipForPayPeriodExists($selectedDateRangeRowID, $employeeType)) {
        if (!generateAndSavePaySlip($selectedDateRangeRowID, $employeeType)) {
            throw new Exception("Error generating FTE pay slips. DB ERROR: ".$db->getLastError());                
        }   
    }
}

function lockFTEpayslip($opsMonthlyCalendarOid){
    global $logger;
    global $db;
 
    $db->startTransaction();
    $data = Array(
        "lockedFlg" => 1,
        "lockDt" => date('Y-m-d'),
        "payslipNbr" => 'F'.generatePayslipNbr()
    );
    $db->where('opsMonthlyCalendarOid', $opsMonthlyCalendarOid);
    $db->update('fteemployeepayslip', $data);
    $logger->debug('lockFTEpayslip()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        markFTEadvanceAsPaid($opsMonthlyCalendarOid);
        $db->commit();
        return;
    } else {
        $db->rollback();
        throw new Exception($db->getLastError());
    }
}

function markFTEadvanceAsPaid($opsMonthlyCalendarOid){
    global $db,$logger;
    $data = Array();
    $loanPmtOid = $request['loanPmtOid'];

    $data['paid'] = 1;
    $date = new DateTime();
    $data['updtTmstp'] = $date->format('Y-m-d');
    
    $db->where('opsMonthlyCalendarOid', $opsMonthlyCalendarOid);
    $db->update('ftesalaryadvance', $data);
    $logger->debug('markFTEadvanceAsPaid()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return;
    } else {
        throw new Exception($db->getLastError());
    }    
}
function loadFTEpayslipGrid($calendarOid){
	global $db,$logger;
	
	$sql = "SELECT CONCAT(employee.firstName, ' ', employee.middleInitial, ' ', employee.lastName) AS employeeName, "
            . "fteemployeepayslip.oid AS payslipOid, opsMonthlyCalendarOid, employeeOid, salaryAmount, dailyRate, daysMissed, "
            . "totalParttimeHrs, hourlyRate, parttimePay, otherDaysWorked, "
            . "otherDaysPayRate, otherworkPay, medicalDeduction, NSSFdeduction, purchasesDeduction, "
            . "loanDeduction, otherDeduction, otherDeductionDescr, bonus, lockedFlg "
            . "FROM fteemployeepayslip "
            . "INNER JOIN employee ON employee.oid = fteemployeepayslip.employeeOid "
            . "INNER JOIN opsmonthlycalendar ON opsmonthlycalendar.oid = fteemployeepayslip.opsMonthlyCalendarOid "
            . "WHERE opsMonthlyCalendarOid = $calendarOid";

	$rows = $db->query($sql);
	array_multisort($rows);
	$logger->debug("loadFTEpayslipGrid()", $db->getLastQuery());

	if($rows){
		header("Content-type: text/xml");
		echo('<?xml version="1.0" encoding="utf-8"?>'); 

		/* start output of data */
		echo '<rows id="0">';
		echo  '	<head>
				<column width="120" type="ro" align="right" sort="str" >Name</column>
				<column width="85" type="kenyaCurrencyro" align="right" sort="str" >Salary</column>
				<column width="70" type="kenyaCurrencyro" align="right" sort="str" >Daliy Rate</column>
                <column width="70" type="kenyaCurrencyro" align="right" sort="str" >Parttime Rate/Hr</column>
				<column width="60" type="ro" align="right" sort="str" >Parttime Hrs</column>
				<column width="77" type="kenyaCurrencyro" align="right" sort="str" >Parttime Pay</column>
				<column width="85" type="kenyaCurrencyro" align="right" sort="str" >GROSS INCOME</column>
                <column width="50" type="ro" align="right" sort="str" >Days Absent</column>
				<column width="76" type="kenyaCurrencyRedro" align="right" sort="str" >Deduction Days</column>
                <column width="70" type="kenyaCurrencyRedro" align="right" sort="str" >Deduction Medical</column>
				<column width="75" type="kenyaCurrencyRedro" align="right" sort="str" >Deduction NSSF</column>
                <column width="70" type="kenyaCurrencyRedro" align="right" sort="str" >Deduction Loan</column>
				<column width="70" type="kenyaCurrencyRedro" align="right" sort="str" >Deduction Other</column>
				<column width="70" type="kenyaCurrencyRedro" align="right" sort="str" >Deduction Purchases</column>
				<column width="86" type="kenyaCurrencyRedro" align="right" sort="str" >TOTAL DEDUCTIONS</column>
				<column width="80" type="kenyaCurrencyro" align="right" sort="str" >Bonus</column>
				<column width="85" type="kenyaCurrencyro" align="right" sort="str" >NET PAY</column>
                <column width="0" type="ro" align="right" sort="str" ></column>
                <column width="0" type="ro" align="right" sort="str" ></column>
			</head>';
			
		if($rows){
			
			$totPayPeriodParttimePay = 0.0;
			$totPayPeriodParttimeHrs = 0.0;
			$totPayPeriodGross = 0.0;
			
            $totPayPeriodDaysMissed = 0.0;
			$totPayPeriodDaysMissedDeduction = 0.0;
            $totPayPeriodMedicalDeductions = 0.0;
			$totPayPeriodNSSFDeductions = 0.0;
            $totPayPeriodLoanDeductions = 0.0;
            $totPayPeriodPurchasesDeductions = 0.0;
			$totPayPeriodOtherDeductions = 0.0;
			$totPayPeriodDeductions = 0.0;
			
			$totPayPeriodBonusPay = 0.0;
			
			$totAmountForPayPeriod = 0.0;
			
			foreach($rows as $row){
                
				$totIndividualGross = 0.0;
                $totIndividualDaysMissed = 0.0;
				$totIndividualDeductions = 0.0;
				$totIndividualPay = 0.0;
				echo ("<row id='".$row['payslipOid']."'>");
				print("<cell><![CDATA[".$row['employeeName']."]]></cell>");
				print("<cell><![CDATA[".$row['salaryAmount']."]]></cell>");
				print("<cell><![CDATA[".$row['dailyRate']."]]></cell>");
                print("<cell><![CDATA[".$row['hourlyRate']."]]></cell>");
				print("<cell><![CDATA[".$row['totalParttimeHrs']."]]></cell>");
				print("<cell><![CDATA[".$row['parttimePay']."]]></cell>"); $totIndividualGross = $totIndividualGross + $row['parttimePay'] + $row['salaryAmount'];
				print("<cell><![CDATA[".$totIndividualGross."]]></cell>");
                print("<cell><![CDATA[".$row['daysMissed']."]]></cell>");$totIndividualDaysMissed = $totIndividualDaysMissed + $row['daysMissed']; 
                print("<cell><![CDATA[".$row['daysMissed']*$row['dailyRate']."]]></cell>");$totIndividualDeductions = $totIndividualDeductions + ($row['daysMissed']*$row['dailyRate']);
				print("<cell><![CDATA[".$row['medicalDeduction']."]]></cell>"); $totIndividualDeductions = $totIndividualDeductions + $row['medicalDeduction'];
				print("<cell><![CDATA[".$row['NSSFdeduction']."]]></cell>"); $totIndividualDeductions = $totIndividualDeductions + $row['NSSFdeduction'];
				print("<cell><![CDATA[".$row['loanDeduction']."]]></cell>"); $totIndividualDeductions = $totIndividualDeductions + $row['loanDeduction'];
                print("<cell><![CDATA[".$row['otherDeduction']."]]></cell>"); $totIndividualDeductions = $totIndividualDeductions + $row['otherDeduction'];
				print("<cell><![CDATA[".$row['purchasesDeduction']."]]></cell>"); $totIndividualDeductions = $totIndividualDeductions + $row['purchasesDeduction'];
				print("<cell><![CDATA[".$totIndividualDeductions."]]></cell>");
				print("<cell><![CDATA[".$row['bonus']."]]></cell>"); 
                $totIndividualPay = $totIndividualGross + $row['bonus'] - $totIndividualDeductions;
				print("<cell><![CDATA[".$totIndividualPay."]]></cell>");
                print("<cell><![CDATA[".$row['payslipOid']."]]></cell>");
                print("<cell><![CDATA[".$row['lockedFlg']."]]></cell>");                
				print("</row>");
				
				$totPayPeriodParttimeHrs = $totPayPeriodParttimeHrs + $row['totalParttimeHrs'];
				$totPayPeriodParttimePay = $totPayPeriodParttimePay + $row['parttimePay'];
				$totPayPeriodGross = $totPayPeriodGross + $totIndividualGross;
				$totPayPeriodDaysMissed = $totPayPeriodDaysMissed + $totIndividualDaysMissed;
                
                $totPayPeriodDaysMissedDeduction = $totPayPeriodDaysMissedDeduction + ($row['daysMissed']*$row['dailyRate']);
				$totPayPeriodMedicalDeductions = $totPayPeriodMedicalDeductions + $row['medicalDeduction'];
				$totPayPeriodNSSFDeductions = $totPayPeriodNSSFDeductions + $row['NSSFdeduction'];
                $totPayPeriodLoanDeductions = $totPayPeriodLoanDeductions +$row['loanDeduction'];
                $totPayPeriodPurchasesDeductions = $totPayPeriodPurchasesDeductions + $row['purchasesDeduction'];               
				$totPayPeriodOtherDeductions = $totPayPeriodOtherDeductions + $row['otherDeduction'];
				$totPayPeriodDeductions = $totPayPeriodDeductions + $totIndividualDeductions;
				
				$totPayPeriodBonusPay = $totPayPeriodBonusPay + $row['bonus'];
				
				$totAmountForPayPeriod = $totAmountForPayPeriod + $totIndividualPay;
			}
			echo ("<row id='0'>");
                print("<cell><![CDATA[<b>TOTAL</b>]]></cell>");
                print("<cell><![CDATA[0]]></cell>");
                print("<cell><![CDATA[0]]></cell>");
                print("<cell><![CDATA[0]]></cell>");
                print("<cell><![CDATA[<b>".$totPayPeriodParttimeHrs."</b>]]></cell>");
                print("<cell><![CDATA[".$totPayPeriodParttimePay."]]></cell>");
                print("<cell><![CDATA[".$totPayPeriodGross."]]></cell>");
                print("<cell><![CDATA[".$totPayPeriodDaysMissed."]]></cell>");
                print("<cell><![CDATA[".$totPayPeriodDaysMissedDeduction."]]></cell>");
                print("<cell><![CDATA[".$totPayPeriodMedicalDeductions."]]></cell>");
                print("<cell><![CDATA[".$totPayPeriodNSSFDeductions."]]></cell>");
                print("<cell><![CDATA[".$totPayPeriodLoanDeductions."]]></cell>");
                print("<cell><![CDATA[".$totPayPeriodOtherDeductions."]]></cell>");
                print("<cell><![CDATA[".$totPayPeriodPurchasesDeductions."]]></cell>");
                print("<cell><![CDATA[".$totPayPeriodDeductions."]]></cell>");
                print("<cell><![CDATA[".$totPayPeriodBonusPay."]]></cell>");
                print("<cell><![CDATA[".$totAmountForPayPeriod."]]></cell>"); 
                print("<cell><![CDATA[-]]></cell>");
                print("<cell><![CDATA[-]]></cell>");
			print("</row>");
		}
		echo '</rows>';
	}
    else {
        throw new Exception("ERROR: Invalid Payslip period selected");
    }
}
