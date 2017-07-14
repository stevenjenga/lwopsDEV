<?php
require_once('functions.php');
require_once('get_payslip_functions.php');
global $db;
global $logger;
global $gratuityAmt;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug('_GET', $_GET);
    $empOid = filter_input(INPUT_GET, 'empOid');
    $employeeType = filter_input(INPUT_GET, 'empType');
    
    if (filter_input(INPUT_GET, "generatePayslip")) {
        $tDate = filter_input(INPUT_GET, "tDate");
        if(filter_input(INPUT_GET, "validateTerminationDt")){ 
            validateTerminationDate($empOid, $tDate);
            return;
        }
        
        $gratuityAmt = filter_input(INPUT_GET, 'gratuityAmt');

        if ($payslipOid = terminationPaySlipExists($empOid, $employeeType))
            deleteTerminationPayslip($payslipOid);
            generateAndLoadNewTerminationPayslip($tDate,$empOid,$employeeType);
    }
    else {
        loadBasicTerminationForm($empOid);
    }
    
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorPopup($e->getMessage());
}

function terminationPaySlipExists($empOid, $employeeType){
    global $db, $logger;
    $logger->debug('terminationPaySlipExists(XXX)', ['$empOid'=>$empOid]);
	switch($employeeType){
		case "C":
            $sql = "SELECT oid FROM casualemployeepayslip WHERE employeeOid = ".$empOid." AND payslipNbr LIKE 'T%' AND lockedFlg = 0 LIMIT 1";
            break;
		case "S":
            $sql = "SELECT oid FROM fteemployeepayslip WHERE employeeOid = ".$empOid." AND payslipNbr LIKE 'T%' AND lockedFlg = 0 LIMIT 1";
            break;
            throw new Exception("terminationPaySlipExists(): Invalid employeeType = F");
		case "F":
            break;
        default:
            throw new Exception("terminationPaySlipExists(): Error checking for existing termination payslip");
	}
    $rows = $db->query($sql);  
    $logger->debug("terminationPaySlipExists()", $db->getLastQuery());
    $logger->debug("terminationPaySlipExists()", $rows);
    if ($rows){
        foreach($rows as $row){
            return $row['oid'];
        }        
    }
    else {
        return false;        
    }
}
function getBasicTerminationEmployeeData($empOid){
    global $db, $logger;
    
    $sql = "SELECT oid, firstName, middleInitial, lastName, nationalID, mobileNbr, resident, elecDeduction, "
        . "ePayment, active, startDt, gender, comment "
        . "FROM employee "
        . "WHERE oid = $empOid ";

    $rows = $db->query($sql);
    $logger->debug('getBasicTerminationEmployeeData()', $db->getLastQuery());
    $logger->debug('getBasicTerminationEmployeeData()', $rows);
    return $rows;
}

function loadBasicTerminationForm($empOid) {
    global $db, $logger;

    $rows = getBasicTerminationEmployeeData($empOid);
    
    header("Content-type: text/xml");
    echo ('<?xml version="1.0" encoding="utf-8"?>');    
    foreach($rows as $row){
        print('<data>');
            print('<fname>'.$row['firstName'].'</fname>');
            print('<lname>'.$row['lastName'].'</lname>');
            print('<mname>'.$row['middleInitial'].'</mname>');
            print('<natID>'.$row['nationalID'].'</natID>');
            print('<empOid>'.$empOid .'</empOid>');
        print('</data>');
    }
}

function generateAndLoadNewTerminationPayslip($terminationDate,$empOid, $employeeType){
    global $logger;

    $periodStartDt = getPeriodStartDate($terminationDate,$employeeType); //assumes all other pay periods have been paid out
    $periodEndDt = $terminationDate;
    $newPayslipOid = generateTerminationPaySlipData($periodStartDt,$periodEndDt, $employeeType, $empOid);
    $pRow = getTerminationPayslipDataByPayslipOid($newPayslipOid,$employeeType);
    $pDuration = getDuration($periodStartDt,$periodEndDt);
    $bRow = getBasicTerminationEmployeeData($empOid);
    loadTerminationPayslip($bRow,$pRow,$pDuration,$employeeType);    
}

function getPeriodStartDate($date,$employeeType){
    global $db, $logger;

    switch($employeeType){
		case "S":
            $sql = "SELECT month, year, STR_TO_DATE(CONCAT(year,'-',monthNbr,'-','01'), '%Y-%m-%d') AS periodStartDate,"
                . "LAST_DAY(STR_TO_DATE(CONCAT(year,'-',monthNbr,'-','01'), '%Y-%m-%d')) AS periodEndDt,"
                . "LAST_DAY(STR_TO_DATE(CONCAT(year,'-',monthNbr,'-','01'), '%Y-%m-%d')) AS payDate "
                . "FROM opsmonthlycalendar "
                . "WHERE year = YEAR('$date') AND monthNbr = MONTH('$date') ";
            break;
		case "C":
            $sql = "SELECT periodStartDate,periodEndDt,payDate "
            . "FROM opsbiweeklycalendar WHERE '$date' BETWEEN periodStartDate AND periodEndDt";
            break;
		case "F":
            break;
        default:
            throw new Exception("getPeriodStartDate(): invalide employee type F");
	}
	$rows = $db->query($sql);
    $logger->debug("getPeriodStartDate()", $db->getLastQuery());
	if($rows){
        foreach($rows as $row){
            return $row['periodStartDate'];
        }
    } else {
        throw new Exception("getPeriodStartDate(): Error fetching pay period start date");
    }    
}
function deleteTerminationPayslip($payslipOid){
    global $db, $logger;
    $db->where ('oid', $payslipOid);
    $tableName = 'fteemployeepayslip';
    $db->delete($tableName);
    if ($db->getLastErrno() === 0) {
        $logger->debug("deleteTerminationPayslip()", $db->getLastQuery());
        return;
    }
    else {
        throw new Exception("deleteTerminationPayslip(): Error deleting payslip = ".$payslipOid);
    }
}

function loadTerminationPayslip($basicDataRow, $payslipRow, $pDuration, $employeeType){
    global $logger;
    $merged = Array();
    
    foreach($basicDataRow as $row){
        $merged['firstName'] = $row['firstName'];
        $merged['lastName'] = $row['lastName'];
        $merged['middleInitial'] = $row['middleInitial'];
        $merged['nationalID'] = $row['nationalID'];
    }
    switch($employeeType){
		case "S":
            $merged['daysPending'] = $pDuration['days'];
            loadFteTerminationPayslipData($payslipRow, $merged, $employeeType);
            break;
		case "C":
            loadCasualTerminationPayslipData($payslipRow, $merged, $employeeType);
            break;
		case "F":
            throw new Exception("getPeriodStartDate(): invalid employee type F");
            break;
        default:
            throw new Exception("getPeriodStartDate(): invalid employee type");
	}   
}

function loadFteTerminationPayslipData($payslipRow, $merged, $employeeType){
    global $logger;
    global $gratuityAmt;

    foreach($payslipRow as $row){
        $logger->debug('loadFteTerminationPayslipData(row)', $row);
        $merged['employeeOid'] = $row['employeeOid'];
        $merged['payslipOid'] = $row['payslipOid'];
        $merged['opsMonthlyCalendarOid'] = $row['opsMonthlyCalendarOid'];
        $merged['employeeOid'] = $row['employeeOid'];
        $merged['salaryAmount'] = $row['salaryAmount'];
        $merged['dailyRate'] = $row['dailyRate'];
        $merged['daysMissed'] = $row['daysMissed'];
        $merged['totalParttimeHrs'] = $row['totalParttimeHrs'];
        $merged['hourlyRate'] = $row['hourlyRate'];
        $merged['parttimePay'] = $row['parttimePay'];
        $merged['otherDaysWorked'] = $row['otherDaysWorked'];
        $merged['otherDaysPayRate'] = $row['otherDaysPayRate']; 
        $merged['otherworkPay'] = $row['otherworkPay'];
        $merged['elecDeduction'] = $row['elecDeduction'];
        $merged['medicalDeduction'] = $row['medicalDeduction'];
        $merged['NSSFdeduction'] = $row['NSSFdeduction'];
        $merged['purchasesDeduction'] = $row['purchasesDeduction'];
        $merged['loanDeduction'] = $row['loanDeduction'];
        $merged['otherDeduction'] = $row['otherDeduction'];
        $merged['otherDeductionDescr'] = $row['otherDeductionDescr']; 
        $merged['bonus'] = $row['bonus']; 
        //
    }    
    $logger->debug('loadFteTerminationPayslipData(merge)', $merged);

    header("Content-type: text/xml");
    echo ('<?xml version="1.0" encoding="utf-8"?>');
    print('<data>');
        print('<empOid>'.$merged['employeeOid'] .'</empOid>');
        print('<salary>'.round($merged['salaryAmount'],2).'</salary>');
        print('<dailyPay>'.round($merged['dailyRate'],2).'</dailyPay>');
        print('<daysPending>'.$merged['daysPending'].'</daysPending>');
        $totPendingPay = ($merged['daysPending']*$merged['dailyRate']);
        print('<totalPay>'.$totPendingPay.'</totalPay>');
        print('<hourlyRate>'.$merged['hourlyRate'].'</hourlyRate>');
        print('<parttimeHrsPending>'.$merged['totalParttimeHrs'].'</parttimeHrsPending>');
        print('<totParttimePay>'.$merged['parttimePay'].'</totParttimePay>');
        print('<daysAbsent>'.$merged['daysMissed'].'</daysAbsent>');
        $daysAbsentDeduction = $merged['daysMissed']*$merged['dailyRate'];
        print('<daysAbsentDeduction>'.$daysAbsentDeduction.'</daysAbsentDeduction>');
        print('<elecDeduction>'.$merged['elecDeduction'].'</elecDeduction>');
        print('<medicalDeduction>'.$merged['medicalDeduction'].'</medicalDeduction>');
        print('<NSSFdeduction>'.$merged['NSSFdeduction'].'</NSSFdeduction>');
        print('<loanDeduction>'.$merged['loanDeduction'].'</loanDeduction>');
        print('<otherDeductions>'.$merged['otherDeduction'].'</otherDeductions>');
        print('<purchasesDeduction>'.$merged['purchasesDeduction'].'</purchasesDeduction>');
        print('<payslipOid>'.$merged['payslipOid'].'</payslipOid>');
        print('<gratuityAmt>'.$gratuityAmt.'</gratuityAmt>');
        
        $grossIncome =  $totPendingPay+$merged['parttimePay'];
        $totDeductions = $daysAbsentDeduction+$merged['medicalDeduction']+$merged['elecDeduction']+$merged['NSSFdeduction']+$merged['loanDeduction']+
                        $merged['otherDeduction']+$merged['purchasesDeduction'];        
        $netPay = $grossIncome - $totDeductions + $gratuityAmt;
        
        print('<grossPay>'.$grossIncome.'</grossPay>');
        print('<totalDeductions>'.$totDeductions.'</totalDeductions>'); 
        print('<netPayDue>'.$netPay.'</netPayDue>');
    print('</data>');
}

function loadCasualTerminationPayslipData($payslipRow, $merged, $employeeType){
    global $logger;
    global $gratuityAmt;
    
    foreach($payslipRow as $row){
        $merged['employeeOid'] = $row['employeeOid'];
        $merged['payslipOid'] = $row['payslipOid'];
        $merged['opsBiWeeklyCalendarOid'] = $row['opsBiWeeklyCalendarOid'];        
        $merged['dailyRate'] = $row['dailyRate'];
        $merged['hourlyRate'] = $row['dailyRate']/8;
        $merged['totalTeaWeight'] = $row['totalTeaWeight'];
        $merged['teaPayRate'] = $row['teaPayRate'];
        $merged['teaPay'] = $row['teaPayRate']*$row['totalTeaWeight'];
        $merged['totalParttimeHrs'] = $row['totalParttimeHrs'];
        $merged['parttimePay'] = ($row['dailyRate']/8)*$row['totalParttimeHrs'];
        $merged['otherHoursWorked'] = $row['otherHoursWorked'];
        $merged['otherworkPay'] = $row['otherworkPay'];
        $merged['medicalDeduction'] = $row['medicalDeduction'];
        $merged['NSSFdeduction'] = $row['NSSFdeduction'];
        $merged['elecDeduction'] = $row['elecDeduction'];
        $merged['purchasesDeduction'] = $row['purchasesDeduction'];
        $merged['Otherdeduction'] = $row['Otherdeduction'];
        $merged['bonus'] = $row['bonus']; 
        $merged['elecDeduction'] = $row['elecDeduction'];
    }    
    $logger->debug('loadCasualTerminationPayslipData(merge)', $merged);

    header("Content-type: text/xml");
    echo ('<?xml version="1.0" encoding="utf-8"?>');
    print('<data>');
        print('<empOid>'.$merged['employeeOid'] .'</empOid>');
        print('<dailyRate>'.$merged['dailyRate'].'</dailyRate>');
        print('<hourlyRate>'.$merged['hourlyRate'].'</hourlyRate>');
        print('<totalTeaWeight>'.$merged['totalTeaWeight'].'</totalTeaWeight>');
        print('<teaPayRate>'.round($merged['teaPayRate'],2).'</teaPayRate>');
        print('<teaPay>'.$merged['teaPay'].'</teaPay>');
        print('<totalParttimeHrs>'.$merged['totalParttimeHrs'].'</totalParttimeHrs>');
        print('<totParttimePay>'.$merged['parttimePay'].'</totParttimePay>');
        print('<otherHoursWorked>'.$merged['otherHoursWorked'].'</otherHoursWorked>');
        print('<otherworkPay>'.$merged['otherworkPay'].'</otherworkPay>');
        print('<medicalDeduction>'.$merged['medicalDeduction'].'</medicalDeduction>');
        print('<NSSFdeduction>'.$merged['NSSFdeduction'].'</NSSFdeduction>');
        print('<purchasesDeduction>'.$merged['purchasesDeduction'].'</purchasesDeduction>');        
        print('<otherDeductions>'.$merged['Otherdeduction'].'</otherDeductions>');        
        print('<totalDeductions>'.'0'.'</totalDeductions>'); 
        print('<elecDeduction>'.$merged['elecDeduction'].'</elecDeduction>');        
        print('<payslipOid>'.$merged['payslipOid'].'</payslipOid>');
        print('<gratuityAmt>'.$gratuityAmt.'</gratuityAmt>');
        
        $grossIncome = $merged['teaPay']+$merged['parttimePay']+$merged['otherworkPay'];
        $totDeductions = $merged['medicalDeduction']+$merged['NSSFdeduction']+$merged['purchasesDeduction']+$merged['Otherdeduction']=$merged['elecDeduction'];        
        $netPay = $grossIncome - $totDeductions + $gratuityAmt;
        
        print('<grossIncome>'.$grossIncome.'</grossIncome>');
        print('<totalDeductions>'.$totDeductions.'</totalDeductions>');
        print('<netPayDue>'.$netPay.'</netPayDue>');
    print('</data>');    
}


function getTerminationPayslipDataByEmployeeOid($empOid,$employeeType){
	global $db,$logger;

    switch($employeeType){
		case "S":
            $columnName = 'opsMonthlyCalendarOid';
            $tableName = 'fteemployeepayslip';
            $sql = "SELECT CONCAT(employee.firstName, ' ', employee.middleInitial, ' ', employee.lastName) AS employeeName, "
                    . " ".$tableName.".oid AS payslipOid, ".$columnName.", employeeOid, salaryAmount, dailyRate, daysMissed, "
                    . "totalParttimeHrs, hourlyRate, parttimePay, otherDaysWorked, "
                    . "otherDaysPayRate, otherworkPay, medicalDeduction, NSSFdeduction, purchasesDeduction, "
                    . "loanDeduction, otherDeduction, otherDeductionDescr, bonus, lockedFlg "
                    . "FROM ".$tableName." "
                    . "INNER JOIN employee ON employee.oid = ".$tableName.".employeeOid "
                    . "INNER JOIN opsmonthlycalendar ON opsmonthlycalendar.oid = ".$tableName.".opsMonthlyCalendarOid  "
                    . "WHERE employeeOid = $empOid";            
            break;
		case "C":
            $columnName = 'opsBiWeeklyCalendarOid';
            $tableName = 'casualemployeepayslip';
            $sql = "SELECT casualemployeepayslip.oid AS payslipOid, opsBiWeeklyCalendarOid, employeeOid, CONCAT(employee.firstName, ' ', "
                . "employee.middleInitial, ' ', employee.lastName) AS employeeName, dailyRate, totalTeaWeight, teaPayRate, teaPay, "
                . "totalParttimeHrs, parttimePayRate, parttimePay, otherDaysWorked, otherHoursWorked, otherworkPay, purchasesDeduction, "
                . "casualemployeepayslip.elecDeduction, medicalDeduction, NSSFdeduction, Otherdeduction, otherDeductionDescr, "
                . "bonus, lockedFlg "
                . "FROM casualemployeepayslip "
                . "INNER JOIN employee ON employee.oid = casualemployeepayslip.employeeOid "
                . "WHERE opsBiWeeklyCalendarOid = $opsBiWeeklyCalendarOid ";            
            break;
		case "F":
            break;
        default:
            throw new Exception("getTerminationPayslipDataByEmployeeOid: invalide employee type F");
	}
            
    $sql = "SELECT CONCAT(employee.firstName, ' ', employee.middleInitial, ' ', employee.lastName) AS employeeName, "
            . " ".$tableName.".oid AS payslipOid, ".$columnName.", employeeOid, salaryAmount, dailyRate, daysMissed, "
            . "totalParttimeHrs, hourlyRate, parttimePay, otherDaysWorked, "
            . "otherDaysPayRate, otherworkPay, medicalDeduction, NSSFdeduction, purchasesDeduction, "
            . "loanDeduction, otherDeduction, otherDeductionDescr, bonus, lockedFlg "
            . "FROM ".$tableName." "
            . "INNER JOIN employee ON employee.oid = ".$tableName.".employeeOid "
            . "INNER JOIN opsmonthlycalendar ON opsmonthlycalendar.oid = ".$tableName.".opsMonthlyCalendarOid  "
            . "WHERE employeeOid = $empOid";

    $logger->debug("getTerminationPayslipDataByEmployeeOid()", ['sql'=>$sql]);
	$rows = $db->query($sql);
    $logger->debug("getTerminationPayslipDataByEmployeeOid()", $db->getLastQuery());
	if($rows){
        return $rows;
    } else {
        throw new Exception("getFinalFTEpayslipData(): Error fetching final payslip");
    }
}

function getTerminationPayslipDataByPayslipOid($payslipOid,$employeeType){
	global $db,$logger;

    switch($employeeType){
		case "S":
            $sql = "SELECT CONCAT(employee.firstName, ' ', employee.middleInitial, ' ', employee.lastName) AS employeeName, "
                . " fteemployeepayslip.oid AS payslipOid, opsMonthlyCalendarOid, employeeOid, salaryAmount, dailyRate, daysMissed, "
                . "totalParttimeHrs, hourlyRate, parttimePay, otherDaysWorked, "
                . "otherDaysPayRate, otherworkPay, medicalDeduction, NSSFdeduction, purchasesDeduction, "
                . "fteemployeepayslip.elecDeduction,loanDeduction, otherDeduction, otherDeductionDescr, bonus, lockedFlg "
                . "FROM fteemployeepayslip "
                . "INNER JOIN employee ON employee.oid = fteemployeepayslip.employeeOid "
                . "INNER JOIN opsmonthlycalendar ON opsmonthlycalendar.oid = fteemployeepayslip.opsMonthlyCalendarOid  "
                . "WHERE fteemployeepayslip.oid = ". $payslipOid;
            break;
		case "C":
            $sql = "SELECT casualemployeepayslip.oid AS payslipOid, opsBiWeeklyCalendarOid, employeeOid, CONCAT(employee.firstName, ' ', "
                . "employee.middleInitial, ' ', employee.lastName) AS employeeName, dailyRate, totalTeaWeight, teaPayRate, teaPay, "
                . "totalParttimeHrs, parttimePayRate, parttimePay, otherDaysWorked, otherHoursWorked, otherworkPay, purchasesDeduction, "
                . "casualemployeepayslip.elecDeduction, medicalDeduction, NSSFdeduction, Otherdeduction, otherDeductionDescr, "
                . "bonus, lockedFlg "
                . "FROM casualemployeepayslip "
                . "INNER JOIN employee ON employee.oid = casualemployeepayslip.employeeOid "
                . "WHERE casualemployeepayslip.oid = ". $payslipOid;
            break;
		case "F":
            break;
        default:
            throw new Exception("getTerminationPayslipDataByPayslipOid: invalide employee type F");
	}    


	$rows = $db->query($sql);
    $logger->debug("getTerminationPayslipDataByPayslipOid()", $db->getLastQuery());
    $logger->debug("getTerminationPayslipDataByPayslipOid(payslipRow)", $rows);
	if($rows){
        return $rows;
    } else {
        throw new Exception("getTerminationPayslipDataByPayslipOid(): Error fetching final payslip");
    }
}

function getEmployeeType($empOid){
    global $db,$logger;
    $sql = "SELECT employee.oid, salary.employeetype AS empType "
        . "FROM employee "
        . "INNER JOIN salary ON salary.employeeOid = employee.oid "
        . "WHERE employee.oid = $empOid ";
    $rows = $db->query($sql);
    $logger->debug('getEmployeeType()', $db->getLastQuery());
    $logger->debug('getEmployeeType()', $rows);    
    if ($rows){
        foreach($rows as $row){
            return $row['empType'];
        }        
    }
    else {
        throw new Exception("getEmployeeType(): Error fetching employee type");      
    }    
}

function getDuration($startDtStr, $endDtStr){
    global $logger;
    $data = Array();
    $startDt = new DateTime($startDtStr);
    $endDt = new DateTime($endDtStr);
    $diff = $startDt->diff($endDt, true);
    $data = Array(
        "days" => $diff->format('%d'),
        "hours" => $diff->format('%h')*8
    );    
    $logger->debug('getDuration()', $data); 
    
    return $data;
}
/**
 * A method to get check if attendance records exist beyond the termination date 0 not allowed to terminate if
 * attendance records exist post termination date
 * 
 * @return false if attendance else true
 */
function validateTerminationDate($empOid, $terminationDate){
    global $db,$logger;
    $count = false;
    $sql = "SELECT COUNT(*) AS count FROM attendance WHERE employeeOid = $empOid AND attendanceDt > '$terminationDate' AND attendance_in = 1 ";
    $rows = $db->query($sql);
    $logger->debug("validateTerminationDate()", $db->getLastQuery());
    
    if ($rows) {
        $logger->debug('validateTerminationDate()', $rows);
        foreach ($rows as $row) {
            if ($row['count'] != 0) {throw new Exception("Attendance records exist post termination date [- ".$terminationDate." -]");}
        }
    }
    else {
        throw new Exception("validateTerminationDate(): Error retrieing attendance records post termination date [- ".$terminationDate." -]");
    }
}