<?php
require_once('../functions/functions.php');
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
            lockCasualsPayslip($selectedDateRangeRowID,'casualemployeepayslip');
        }
        else {
            if ($_GET['regenerate']=='1') {
                if (payslipIsLocked($selectedDateRangeRowID,'casualemployeepayslip','opsBiWeeklyCalendarOid')){
                    throw new Exception("Regenaration of selected Payslip NOT ALLOWED - Payslip is LOCKED [".$selectedDateRangeRowID."]");
                }
                regeneratePayslipData($selectedDateRangeRowID,$employeeType);
            }
            else {
                getExisitingPaySlipData($selectedDateRangeRowID,$employeeType);
            }
        }
		loadCasualsPayslipGrid($selectedDateRangeRowID);
        logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
	}
	else {
		throw new Exception("Select pay period and click view");
	}
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()."]</b>");
}

//function payslipIsLocked($selectedDateRangeRowID){
//    global $logger;
//    global $db; 
///* @var $rows type */
//    $rows = $db->query("SELECT lockedFlg FROM CasualEmployeePaySlip WHERE opsBiWeeklyCalendarOid = $selectedDateRangeRowID");
//    if ($rows) {
//        foreach ($rows as $row) {
//            if ($row['lockedFlg'] == 1) {
//                return true;
//            }
//            else {
//                return false;
//            }
//        }
//    }
//    else {
//        throw new Exception("Erroe fetching lock flag");
//    }
//}

function regeneratePayslipData($selectedDateRangeRowID,$employeeType){
    global $logger;
    global $db;    
    $db->startTransaction();
    $logger->debug("", ['Regenerating'=>' CASUALS Payslips']);
    if (!deletePaySlipsForPayPeriod($selectedDateRangeRowID, $employeeType)) {
        $db->rollback();
        throw new Exception("Error deleting exisiting pay slips for opsBiWeeklyCalendarOid = ".$selectedDateRangeRowID."<br>"
                            . "SQL ERROR: ".$db->getLastError());
    }
    if (!generateAndSavePaySlip($selectedDateRangeRowID, $employeeType)){
        $db->rollback();
        throw new Exception("Error generating CASUALS pay slips. DB ERROR: ".$db->getLastError());               
    }
    $db->commit();    
}

function getExisitingPaySlipData($selectedDateRangeRowID,$employeeType){
    global $logger;
    global $db; 
    if (!payslipForPayPeriodExists($selectedDateRangeRowID, $employeeType)) {
        if (!generateAndSavePaySlip($selectedDateRangeRowID, $employeeType)) {
            throw new Exception("Error generating CASUALS pay slips. DB ERROR: ".$db->getLastError());                
        }  
    }
}

function lockCasualsPayslip($opsBiWeeklyCalendarOid){
    global $logger;
    global $db;
 
    $db->startTransaction();
    $data = Array(
        "lockedFlg" => 1,
        "lockDt" => date('Y-m-d'),
        "payslipNbr" => 'C'.generatePayslipNbr()
    );
    $db->where('opsBiWeeklyCalendarOid', $opsBiWeeklyCalendarOid);
    $db->update('casualemployeepayslip', $data);
    $logger->debug('lockCasualsPayslip()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        
        $db->commit();
        return;
    } else {
        $db->rollback();
        throw new Exception($db->getLastError());
    }
}

function loadCasualsPayslipGrid($opsBiWeeklyCalendarOid){
	global $db,$logger;
	$sql = "SELECT casualemployeepayslip.oid AS payslipOid, opsBiWeeklyCalendarOid, employeeOid, CONCAT(employee.firstName, ' ', "
            . "employee.middleInitial, ' ', employee.lastName) AS employeeName, dailyRate, totalTeaWeight, teaPayRate, teaPay, "
            . "totalParttimeHrs, parttimePayRate, parttimePay, otherDaysWorked, otherHoursWorked, otherworkPay, purchasesDeduction, "
            . "casualemployeepayslip.elecDeduction, medicalDeduction, NSSFdeduction, Otherdeduction, otherDeductionDescr, "
            . "bonus, lockedFlg "
            . "FROM casualemployeepayslip "
            . "INNER JOIN employee ON employee.oid = casualemployeepayslip.employeeOid "
            . "WHERE opsBiWeeklyCalendarOid = $opsBiWeeklyCalendarOid ";

	$rows = $db->query($sql);
	array_multisort($rows);
	$logger->debug("loadCasualsPayslipGrid()", $db->getLastQuery());

	if($rows){
		header("Content-type: text/xml");
		echo('<?xml version="1.0" encoding="utf-8"?>'); 

		/* start output of data */
		echo '<rows id="0">';
		echo  '	<head>
				<column width="120" type="ro" align="right" sort="str" >Name</column>
                <column width="75" type="kenyaCurrencyro" align="right" sort="str" >Day Rate</column>
                <column width="65" type="kenyaCurrencyro" align="right" sort="str" >Hourly Rate</column>
				<column width="45" type="ro" align="right" sort="str" >Tea Wght</column>
				<column width="75" type="kenyaCurrencyro" align="right" sort="str" >Tea Rate/kg</column>
				<column width="85" type="kenyaCurrencyro" align="right" sort="str" >Gross Tea Pay</column>
				<column width="45" type="ro" align="right" sort="str" >PT Hrs</column>				
				<column width="70" type="kenyaCurrencyro" align="right" sort="str" >Parttime Pay</column>
				<column width="50" type="ro" align="right" sort="str" >Other Hrs</column>
				<column width="75" type="kenyaCurrencyro" align="right" sort="str" >Other Hours Pay</column>
				<column width="85" type="kenyaCurrencyro" align="right" sort="str" >GROSS INCOME</column>
                <column width="70" type="kenyaCurrencyRedro" align="right" sort="str" >Deduction Elec</column>
				<column width="70" type="kenyaCurrencyRedro" align="right" sort="str" >Deduction Medical</column>
				<column width="70" type="kenyaCurrencyRedro" align="right" sort="str" >Deduction NSSF</column>
                <column width="70" type="kenyaCurrencyRedro" align="right" sort="str" >Deduction Other</column>
                <column width="70" type="kenyaCurrencyRedro" align="right" sort="str" >Deduction Purchases</column>
				<column width="86" type="kenyaCurrencyRedro" align="right" sort="str" >TOTAL DEDUCTIONS</column>
				<column width="80" type="kenyaCurrencyro" align="right" sort="str" >Bonus</column>
				<column width="80" type="kenyaCurrencyro" align="right" sort="str" >NET PAY</column>
                <column width="0" type="ro" align="right" sort="str" ></column>
                <column width="0" type="ro" align="right" sort="str" ></column>
			</head>';
			
		if($rows){
			$totIndividualIncome = 0.0;
			$totIndividualDeductions = 0.0;
			$totIndividualPay = 0.0;
			
			$totPayPeriodTeaWeight = 0.0;
			$totPayPeriodTeaPay = 0.0;
			$totPayPeriodParttimePay = 0.0;
			$totPayPeriodParttimeHrs = 0.0;
			$totPayPeriodOtherDaysWorked = 0.0;
			$totPayPeriodOtherDaysPay = 0.0;
			$totPayPeriodIncome = 0.0;
			
			$totPayPeriodMedicalDeductions = 0.0;
			$totPayPeriodNSSFDeductions = 0.0;
			$totPayPeriodOtherDeductions = 0.0;
            $totPayPeriodPurchasesDeductions = 0.0;
			
			$totPayPeriodBonusPay = 0.0;
			$totPayPeriodDeductions = 0.0;
			$totAmountForPayPeriod = 0.0;
			
			foreach($rows as $row){
				echo ("<row id='".$row['payslipOid']."'>");
				print("<cell><![CDATA[".$row['employeeName']."]]></cell>");
                print("<cell><![CDATA[".$row['dailyRate']."]]></cell>");
                print("<cell><![CDATA[".$row['parttimePayRate']."]]></cell>");
				print("<cell><![CDATA[".$row['totalTeaWeight']."]]></cell>");
				print("<cell><![CDATA[".$row['teaPayRate']."]]></cell>");
				print("<cell><![CDATA[".$row['teaPay']."]]></cell>"); $totIndividualIncome = $totIndividualIncome + $row['teaPay'];
				print("<cell><![CDATA[".$row['totalParttimeHrs']."]]></cell>");
				print("<cell><![CDATA[".$row['parttimePay']."]]></cell>"); $totIndividualIncome = $totIndividualIncome + $row['parttimePay'];
				print("<cell><![CDATA[".$row['otherHoursWorked']."]]></cell>");
				print("<cell><![CDATA[".$row['otherworkPay']."]]></cell>"); $totIndividualIncome = $totIndividualIncome + $row['otherworkPay'];
				print("<cell><![CDATA[".$totIndividualIncome."]]></cell>");
				print("<cell><![CDATA[".$row['elecDeduction']."]]></cell>"); $totIndividualDeductions = $totIndividualDeductions + $row['elecDeduction'];                
				print("<cell><![CDATA[".$row['medicalDeduction']."]]></cell>"); $totIndividualDeductions = $totIndividualDeductions + $row['medicalDeduction'];
				print("<cell><![CDATA[".$row['NSSFdeduction']."]]></cell>"); $totIndividualDeductions = $totIndividualDeductions + $row['NSSFdeduction'];
				print("<cell><![CDATA[".$row['Otherdeduction']."]]></cell>"); $totIndividualDeductions = $totIndividualDeductions + $row['Otherdeduction'];
				print("<cell><![CDATA[".$row['purchasesDeduction']."]]></cell>"); $totIndividualDeductions = $totIndividualDeductions + $row['purchasesDeduction'];
				print("<cell><![CDATA[".$totIndividualDeductions."]]></cell>");
				print("<cell><![CDATA[".$row['bonus']."]]></cell>"); 
                $totIndividualPay = $totIndividualIncome + $row['bonus'] - $totIndividualDeductions;
				print("<cell><![CDATA[".$totIndividualPay."]]></cell>"); 
                print("<cell><![CDATA[".$row['payslipOid']."]]></cell>");
                print("<cell><![CDATA[".$row['lockedFlg']."]]></cell>");
				print("</row>");
				
                $totIndividualDeductions = 0.0;
                $totIndividualIncome = 0.0;                
                
				$totPayPeriodTeaWeight = $totPayPeriodTeaWeight + $row['totalTeaWeight'];
				$totPayPeriodTeaPay = $totPayPeriodTeaPay +$row['teaPay'];
				$totPayPeriodParttimeHrs = $totPayPeriodParttimeHrs + $row['totalParttimeHrs'];
				$totPayPeriodParttimePay = $totPayPeriodParttimePay + $row['parttimePay'];
				$totPayPeriodOtherDaysWorked = $totPayPeriodOtherDaysWorked + $row['otherDaysWorked'];
				$totPayPeriodOtherDaysPay = $totPayPeriodOtherDaysPay + $row['otherworkPay'];
				$totPayPeriodIncome = $totPayPeriodIncome + $totIndividualIncome;
				
				$totPayPeriodMedicalDeductions = $totPayPeriodMedicalDeductions + $row['medicalDeduction'];
				$totPayPeriodNSSFDeductions = $totPayPeriodNSSFDeductions + $row['NSSFdeduction'];
				$totPayPeriodOtherDeductions = $totPayPeriodOtherDeductions + $row['Otherdeduction']; 
                $totPayPeriodPurchasesDeductions = $totPayPeriodPurchasesDeductions + $row['purchasesDeduction'];
				$totPayPeriodDeductions = $totPayPeriodDeductions + $totIndividualDeductions;
				
				$totPayPeriodBonusPay = $totPayPeriodBonusPay + $row['bonus'];
				
				$totAmountForPayPeriod = $totAmountForPayPeriod + $totIndividualPay ;
                $totIndividualPay = 0.0;
			}
			echo ("<row id='0'>");
			print("<cell><![CDATA[<b>TOTAL</b>]]></cell>");
            print("<cell><![CDATA[0]]></cell>");
            print("<cell><![CDATA[0]]></cell>");
			print("<cell><![CDATA[<b>".$totPayPeriodTeaWeight."</b>]]></cell>");
			print("<cell><![CDATA[0]]></cell>");
			print("<cell><![CDATA[".$totPayPeriodTeaPay."]]></cell>");
			print("<cell><![CDATA[<b>".$totPayPeriodParttimeHrs."</b>]]></cell>");
			print("<cell><![CDATA[".$totPayPeriodParttimePay."]]></cell>");
			print("<cell><![CDATA[<b>".$totPayPeriodOtherDaysWorked."</b>]]></cell>");
			print("<cell><![CDATA[".$totPayPeriodOtherDaysPay."]]></cell>");
			print("<cell><![CDATA[".$totPayPeriodIncome."]]></cell>");
            print("<cell><![CDATA[0]]></cell>");
			print("<cell><![CDATA[".$totPayPeriodMedicalDeductions."]]></cell>");
			print("<cell><![CDATA[".$totPayPeriodNSSFDeductions."]]></cell>");
			print("<cell><![CDATA[".$totPayPeriodOtherDeductions."]]></cell>");
			print("<cell><![CDATA[".$totPayPeriodPurchasesDeductions."]]></cell>");
			print("<cell><![CDATA[".$totPayPeriodDeductions."]]></cell>");
			print("<cell><![CDATA[".$totPayPeriodBonusPay."]]></cell>");
			print("<cell><![CDATA[".$totAmountForPayPeriod."]]></cell>");  
			print("</row>");
		}
		echo '</rows>';
	}
}
?>