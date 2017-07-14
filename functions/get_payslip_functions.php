<?php
require_once('functions.php');
global $db;
global $logger;

$sundaysInTheMonthArray;
$holidaysInTheMonthArray;

function deletePaySlipsForPayPeriod($selectedDateRangeRowID, $employeeType, $payslipOid = null){
	global $db,$logger;

	switch($employeeType){
		case "C":
            if (isset($payslipOid)) {
            }
            else {
                $db->where ('opsBiWeeklyCalendarOid', $selectedDateRangeRowID);
                return $db->delete('casualemployeepayslip');
            }
		break;
		case "S":
            if (isset($payslipOid)) {
                $db->where ('payslipOid', $payslipOid);
                return $db->delete('fteemployeepayslip');                 
            }
            else {            
                $db->where ('opsMonthlyCalendarOid', $selectedDateRangeRowID);
                return $db->delete('fteemployeepayslip');                
            }
		break;
		case "F":
		break;
	}
}

function payslipForPayPeriodExists($selectedDateRangeRowID, $employeeType, $empOid = null){
	global $db,$logger;
	
	switch($employeeType){
		case "C":
            $db->where ('opsBiWeeklyCalendarOid', $selectedDateRangeRowID);
            $count = $db->has('casualemployeepayslip');
            $logger->debug("payslipForPayPeriodExists()", $db->getLastQuery());
			$logger->debug("payslipForPayPeriodExists() [Existing CASUALS paylslips count]", ['COUNT'=>$count]);
			return $count;
            break;
		case "S":
            $db->where ('opsMonthlyCalendarOid', $selectedDateRangeRowID);
            $count = $db->has('fteemployeepayslip');
            $logger->debug("payslipForPayPeriodExists()", $db->getLastQuery());
			$logger->debug("payslipForPayPeriodExists() [Existing FTE paylslips count]", ['COUNT'=>$count]);
			return $count;
            break;
		case "F":
            break;
	}
}

function payslipForPayEmployeeExists($payslipOid, $employeeType){
	global $db,$logger;
	
    $db->where ('oid', $payslipOid);
	switch($employeeType){
		case "C":
            $count = $db->has('casualemployeepayslip');
            $logger->debug("payslipForPayEmployeeExists()", $db->getLastQuery());
			$logger->debug("payslipForPayEmployeeExists() [Existing CASUALS paylslips count]", ['COUNT'=>$count]);
			return $count;
            break;
		case "S":
            $count = $db->has('fteemployeepayslip');
            $logger->debug("payslipForPayEmployeeExists()", $db->getLastQuery());
			$logger->debug("payslipForPayEmployeeExists() [Existing FTE paylslips count]", ['COUNT'=>$count]);
			return $count;
            break;
		case "F":
            return false;
            break;
	}
}

function generateTerminationPaySlipData($periodStartDt,$periodEndDt, $employeeType, $empOid){
    global $db,$logger;
    global $sundaysInTheMonthArray,$holidaysInTheMonthArray;
    $id = false;
    $logger->debug('generateTerminationPaySlipData()', ['empOid'=>$empOid,'periodStartDt'=>$periodStartDt,'periodEndDt'=>$periodEndDt]);
    $employeeOidsArray = array();
    $loanPayment = array();
    
    $sundaysInTheMonthArray = getSundaysInTheMonthArray($periodStartDt,$periodEndDt);
    $holidaysInTheMonthArray = getHolidaysInTheMonthArray($periodStartDt,$periodEndDt);
    
//	Get employee attendance array for date range
    $data = Array (
				"employeeOid" => $empOid,
				"employeeName" => 'n/a'
				);
    $employeeOidsArray[$empOid] = $data;
    $logger->debug('generateTerminationPaySlipData()', $data);
    $logger->debug('generateTerminationPaySlipData()', $employeeOidsArray);
    
	switch($employeeType){
		case "C":
			$partTimePayArray = getPartTimePayForCasualEmployees($periodStartDt, $periodEndDt, $employeeType);
			$otherWorkPayArray = getOtherWorkPayForCasualEmployees($periodStartDt, $periodEndDt, $employeeType);
        	$teaPickingPayArray = getTeaPickingPayForEmployees($periodStartDt, $periodEndDt, $employeeType);
            $teaPayRateArray = getTeaPayRateForTimePeriod($periodStartDt, $periodEndDt);
		break;
		case "S":
			$partTimePayArray = getPartTimePayForFTEEmployees($employeeOidsArray,$periodStartDt, $periodEndDt, $employeeType);
            $loanDeductionsArray = getEmployeeOutstandingLoanDetail($employeeOidsArray);
            $fteSalaryArray = getFTESalaryArray($employeeOidsArray,$periodStartDt, $periodEndDt);
            $fteAttendanceArray = getFTEattendance($employeeOidsArray,$periodStartDt, $periodEndDt);
            $fteAdvanceArray = getFTEterminationAdvancePaidOut($employeeOidsArray);
		break;
		case "F":
		break;
	}
	
	$medicalDeductionsArray = getMedicalDeductions($employeeOidsArray,$periodStartDt, $periodEndDt);
    $purchasesDeductionsArray = getPurchasesDeductions($employeeOidsArray,$periodStartDt, $periodEndDt);
	$otherDeductionsArray = getOtherDeductions($employeeOidsArray,$periodStartDt, $periodEndDt);
    $elecDeductionsArray = getElecDeductions($employeeOidsArray,$periodStartDt, $periodEndDt);
	// $empBonusArray = getBonus($periodStartDt, $periodEndDt);
	
	foreach($employeeOidsArray as $row){
		switch($employeeType){
			case "C":
				$data = Array (
					"employeeOid" => $row["employeeOid"],
					"opsBiWeeklyCalendarOid" => getOpsBiweeklyCalendarOidFromDate($periodStartDt)
					);
			break;
			case "S":
				$data = Array (
					"employeeOid" => $row["employeeOid"],
					"opsMonthlyCalendarOid" => getOpsMonthlyCalendarOidFromDate($periodStartDt)
					);

			break;
			case "F":
			break;
		}

		if (array_key_exists($row["employeeOid"], $medicalDeductionsArray)) {
            $data['medicalDeduction'] = $medicalDeductionsArray[$row["employeeOid"]]["medicalDeductionAmt"];
        } else {
            $data['medicalDeduction'] = 0.0;
        }

        if (array_key_exists ( $row["employeeOid"] , $elecDeductionsArray )) {
			$data['elecDeduction'] 	= $elecDeductionsArray[$row["employeeOid"]]["elecDeduction"];
		}
		else {
			$data['elecDeduction'] 	= 0.0;
		}
        
        if (array_key_exists ( $row["employeeOid"] , $purchasesDeductionsArray )) {
			$data['purchasesDeduction'] 	= $purchasesDeductionsArray[$row["employeeOid"]]["deductionAmt"];
		}
		else {
			$data['purchasesDeduction'] 	= 0.0;
		}  
        
        if (array_key_exists ( $row["employeeOid"] , $otherDeductionsArray )) {
			$data['otherDeduction'] 	= $otherDeductionsArray[$row["employeeOid"]]["deductionAmt"];
			$data['otherDeductionDescr'] 	= "n/a";
		}
		else {
			$data['otherDeduction'] 	= 0.0;
			$data['otherDeductionDescr'] 	= "n/a";
		}
        
		switch($employeeType){
			case "C":
                if (array_key_exists ( $row["employeeOid"] , $teaPickingPayArray )){
                    $data['totalTeaWeight'] = $teaPickingPayArray[$row["employeeOid"]]["totWeight"];
                    $data['teaPayRate']     = $teaPayRateArray["rate"];
                    $data['teaPay']         = $teaPickingPayArray[$row["employeeOid"]]["totWeight"]*$teaPayRateArray["rate"];;	
                }
                else{
                    $data['totalTeaWeight'] = 0.0;
                    $data['teaPayRate']     = 0.0;
                    $data['teaPay'] = 0.0;
                }

                if (array_key_exists ( $row["employeeOid"] , $partTimePayArray )){
                    $data['totalParttimeHrs'] 	= $partTimePayArray[$row["employeeOid"]]["totParttimeHours"];
                    $data['parttimePay']        = $partTimePayArray[$row["employeeOid"]]["parttimePay"];
                    $data['parttimePayRate']    = $partTimePayArray[$row["employeeOid"]]["hourlyRate"]; 
                    $data['dailyRate']    = $partTimePayArray[$row["employeeOid"]]["dailyRate"];
                }
                else {
                    $data['totalParttimeHrs'] 	= 0.0;
                    $data['parttimePay']        = 0.0;
                    $data['parttimePayRate']    = 0.0;
                    
                }
        
                if (array_key_exists ( $row["employeeOid"] , $otherWorkPayArray )){	
                    $data['otherDaysWorked']    = $otherWorkPayArray[$row["employeeOid"]]["totOtherWorkedDays"];
                    $data['otherHoursWorked']   = $otherWorkPayArray[$row["employeeOid"]]["otherHoursWorked"];
                    $data['otherworkPay']       = $otherWorkPayArray[$row["employeeOid"]]["otherWorkPay"];
                }       
                else {
                    $data['otherDaysWorked']    = 0.0;
                    $data['otherHoursWorked']   = 0.0;
                    $data['otherworkPay']       = 0.0;		
                }  
                
                $data['NSSFdeduction'] = 0.0;
                
				$data['bonus'] = 0.0;
                $data['payslipNbr'] ='T'.generatePayslipNbr();
                $id = savePayslip($employeeType,$data);                
                break;
			case "S":
                if (array_key_exists($row["employeeOid"], $loanDeductionsArray)) {
                    $data['loanDeduction'] = $loanDeductionsArray[$row["employeeOid"]]["loanDeduction"];
                    $data['loanBalance'] = $loanDeductionsArray[$row["employeeOid"]]["loanBalance"];
                } else {
                    $data['loanDeduction'] = 0.0;
                    $data['loanBalance'] = 0.0;
                }
                
                if (array_key_exists ( $row["employeeOid"] , $partTimePayArray )){
                    $data['totalParttimeHrs'] 	= $partTimePayArray[$row["employeeOid"]]["totParttimeHours"];
                    $data['parttimePay']        = $partTimePayArray[$row["employeeOid"]]["parttimePay"];
                }
                else {
                    $data['totalParttimeHrs'] 	= 0.0;
                    $data['parttimePay']        = 0.0;
                }
                
                if (array_key_exists($row["employeeOid"], $fteSalaryArray)) {
                    $data['dailyRate'] = $fteSalaryArray[$row["employeeOid"]]["dailyRate"];
                    $data['hourlyRate'] = $fteSalaryArray[$row["employeeOid"]]["hourlyRate"];
                    $data["salaryAmount"] = $fteSalaryArray[$row["employeeOid"]]["salaryAmount"];// 
                    $data["NSSFdeduction"] = $fteSalaryArray[$row["employeeOid"]]["NSSFdeduction"];
                } else {
                    $data['dailyRate'] = 0.0; 
                    $data['hourlyRate'] = 0.0;
                    $data["salaryAmount"] = 0.0;
                }    
                
                $data['bonus'] = 0.0;  
                
                if (array_key_exists($row["employeeOid"], $fteAdvanceArray)) {
                    $data["advance"] = $fteAdvanceArray[$row["employeeOid"]]["amount"];
                } else {
                    $data['advance'] = 0.0;
                } 
                
                if (array_key_exists($row["employeeOid"], $fteAttendanceArray)) {
                    $data["daysMissed"] = $fteAttendanceArray[$row["employeeOid"]]["daysMissed"];
                } else {
                    $data['daysMissed'] = 0;
                }  
                $data['payslipNbr'] ='T'.generatePayslipNbr();
                $id = savePayslip($employeeType,$data);
                break;
			case "F":
                return false;
                break;
		}
	}
    $logger->debug('generateTerminationPaySlipData()', $data);
    return $id;
}  

function savePayslip($employeeType,$data){
    global $db,$logger;
    $id = 0;
    
    switch($employeeType){
			case "C":
                $id = $db->insert('casualemployeepayslip', $data);
                $logger->debug('savePayslip()', $db->getLastQuery());                                
                if ($db->getLastErrno() != 0) {
                    throw new Exception("savePayslip(): Error inserting data into Casuals payslip table:".$db->getLastError());
                }
                break;                
                break;
			case "S":
                $id = $db->insert('fteemployeepayslip', $data);
                $logger->debug('savePayslip()', $db->getLastQuery());                                
                if ($db->getLastErrno() != 0){
                    throw new Exception("savePayslip(): Error inserting data into FTE payslip table:".$db->getLastError()); 
                }
                break;
			case "F":
                break;            
            default:
                throw new Exception("savePayslip(): Invalid employee type");
    }
    return $id;
}

function generateAndSavePaySlip($selectedDateRangeRowID, $employeeType){
	global $db,$logger;
    global $sundaysInTheMonthArray,$holidaysInTheMonthArray;
 
    $employeeOidsArray = array();
    $loanPayment = array();
    
	//get the selected period start and end dates
	switch($employeeType){
		case "C":
			$dateSql = "SELECT periodStartDate, periodEndDt, payDate "
                . "FROM opsbiweeklycalendar "
                . "WHERE oid = $selectedDateRangeRowID ";         
		break;
		case "S":
			$dateSql = "SELECT month, year, STR_TO_DATE(CONCAT(year,'-',monthNbr,'-','01'), '%Y-%m-%d') AS periodStartDate,"
                . "LAST_DAY(STR_TO_DATE(CONCAT(year,'-',monthNbr,'-','01'), '%Y-%m-%d')) AS periodEndDt,"
                . "LAST_DAY(STR_TO_DATE(CONCAT(year,'-',monthNbr,'-','01'), '%Y-%m-%d')) AS payDate "
                . "FROM opsmonthlycalendar "
                . "WHERE oid = $selectedDateRangeRowID ";
		break;
		case "F":
		break;
	}
	
	$rows = $db->query($dateSql);
	$logger->debug("generateAndSavePaySlip()", $db->getLastQuery());
	$logger->debug("generateAndSavePaySlip() [PAY PERIOD]", $rows); 
	if($rows){
		foreach($rows as $row){
			$periodStartDt = date('Y-m-d', strtotime($row['periodStartDate']));
			$periodEndDt = date('Y-m-d', strtotime($row['periodEndDt']));
			$payDate = date('Y-m-d', strtotime($row['payDate']));
		}
	}
    else {
        loadErrorGrid("No payslips found for selected month");
    }
    $sundaysInTheMonthArray = getSundaysInTheMonthArray($periodStartDt,$periodEndDt);
    $holidaysInTheMonthArray = getHolidaysInTheMonthArray($periodStartDt,$periodEndDt);
    
	//Get employee attendance array for date range
    $employeeOidsArray = getEmployeeOidsForDateRange($periodStartDt,$periodEndDt, $employeeType);

	switch($employeeType){
		case "C":
			$partTimePayArray = getPartTimePayForCasualEmployees($periodStartDt, $periodEndDt, $employeeType);
			$otherWorkPayArray = getOtherWorkPayForCasualEmployees($periodStartDt, $periodEndDt, $employeeType);
        	$teaPickingPayArray = getTeaPickingPayForEmployees($periodStartDt, $periodEndDt, $employeeType);
            $teaPayRateArray = getTeaPayRateForTimePeriod($periodStartDt, $periodEndDt);
		break;
		case "S":
			$partTimePayArray = getPartTimePayForFTEEmployees($employeeOidsArray,$periodStartDt, $periodEndDt, $employeeType);
            $loanDeductionsArray = getLoansDeductions($employeeOidsArray);
            $fteSalaryArray = getFTESalaryArray($employeeOidsArray,$periodStartDt, $periodEndDt);
            $fteAttendanceArray = getFTEattendance($employeeOidsArray,$periodStartDt, $periodEndDt);
            $fteAdvanceArray = getFTEadvance($employeeOidsArray,$selectedDateRangeRowID);
		break;
		case "F":
		break;
	}
	
	$medicalDeductionsArray = getMedicalDeductions($employeeOidsArray,$periodStartDt, $periodEndDt);
    $purchasesDeductionsArray = getPurchasesDeductions($employeeOidsArray,$periodStartDt, $periodEndDt);
	$otherDeductionsArray = getOtherDeductions($employeeOidsArray,$periodStartDt, $periodEndDt);
    $elecDeductionsArray = getElecDeductions($employeeOidsArray,$periodStartDt, $periodEndDt);
	// $empBonusArray = getBonus($periodStartDt, $periodEndDt);
	
	foreach($employeeOidsArray as $row){
		switch($employeeType){
			case "C":
				$data = Array (
					"employeeOid" => $row["employeeOid"],
					"opsBiWeeklyCalendarOid" => $selectedDateRangeRowID
					);
			break;
			case "S":
				$data = Array (
					"employeeOid" => $row["employeeOid"],
					"opsMonthlyCalendarOid" => $selectedDateRangeRowID
					);

			break;
			case "F":
			break;
		}

		if (array_key_exists($row["employeeOid"], $medicalDeductionsArray)) {
            $data['medicalDeduction'] = $medicalDeductionsArray[$row["employeeOid"]]["medicalDeductionAmt"];
        } else {
            $data['medicalDeduction'] = 0.0;
        }

        if (array_key_exists ( $row["employeeOid"] , $elecDeductionsArray )) {
			$data['elecDeduction'] 	= $elecDeductionsArray[$row["employeeOid"]]["elecDeduction"];
		}
		else {
			$data['elecDeduction'] 	= 0.0;
		}
        
        if (array_key_exists ( $row["employeeOid"] , $purchasesDeductionsArray )) {
			$data['purchasesDeduction'] 	= $purchasesDeductionsArray[$row["employeeOid"]]["deductionAmt"];
		}
		else {
			$data['purchasesDeduction'] 	= 0.0;
		}  
        
        if (array_key_exists ( $row["employeeOid"] , $otherDeductionsArray )) {
			$data['otherDeduction'] 	= $otherDeductionsArray[$row["employeeOid"]]["deductionAmt"];
			$data['otherDeductionDescr'] 	= "n/a";
		}
		else {
			$data['otherDeduction'] 	= 0.0;
			$data['otherDeductionDescr'] 	= "n/a";
		}
        
		switch($employeeType){
			case "C":
                if (array_key_exists ( $row["employeeOid"] , $teaPickingPayArray )){
                    $data['totalTeaWeight'] = $teaPickingPayArray[$row["employeeOid"]]["totWeight"];
                    $data['teaPayRate']     = $teaPayRateArray["rate"];
                    $data['teaPay']         = $teaPickingPayArray[$row["employeeOid"]]["totWeight"]*$teaPayRateArray["rate"];;	
                }
                else{
                    $data['totalTeaWeight'] = 0.0;
                    $data['teaPayRate']     = 0.0;
                    $data['teaPay'] = 0.0;
                }

                if (array_key_exists ( $row["employeeOid"] , $partTimePayArray )){
                    $data['totalParttimeHrs'] 	= $partTimePayArray[$row["employeeOid"]]["totParttimeHours"];
                    $data['parttimePay']        = $partTimePayArray[$row["employeeOid"]]["parttimePay"];
                    $data['parttimePayRate']    = $partTimePayArray[$row["employeeOid"]]["hourlyRate"]; 
                    $data['dailyRate']    = $partTimePayArray[$row["employeeOid"]]["dailyRate"];
                }
                else {
                    $data['totalParttimeHrs'] 	= 0.0;
                    $data['parttimePay']        = 0.0;
                    $data['parttimePayRate']    = 0.0;
                    
                }
        
                if (array_key_exists ( $row["employeeOid"] , $otherWorkPayArray )){	
                    $data['otherDaysWorked']    = $otherWorkPayArray[$row["employeeOid"]]["totOtherWorkedDays"];
                    $data['otherHoursWorked']   = $otherWorkPayArray[$row["employeeOid"]]["otherHoursWorked"];
                    $data['otherworkPay']       = $otherWorkPayArray[$row["employeeOid"]]["otherWorkPay"];
                }       
                else {
                    $data['otherDaysWorked']    = 0.0;
                    $data['otherHoursWorked']   = 0.0;
                    $data['otherworkPay']       = 0.0;		
                }  
                
                $data['NSSFdeduction'] = 0.0;
                
				$data['bonus'] = 0.0;
//				$logger->debug('generateAndSavePaySlip()[CASUALS data]', $data);
				$id = $db->insert ('casualemployeepayslip', $data);
//				$logger->debug("generateAndSavePaySlip()[ADD CASUAL PAYSLIP]",$db->getLastQuery());
			break;
			case "S":
                if (array_key_exists($row["employeeOid"], $loanDeductionsArray)) {
                    $data['loanDeduction'] = $loanDeductionsArray[$row["employeeOid"]]["loanDeduction"];
                    $data['loanBalance'] = $loanDeductionsArray[$row["employeeOid"]]["loanBalance"];
                } else {
                    $data['loanDeduction'] = 0.0;
                    $data['loanBalance'] = 0.0;
                }
                
                if (array_key_exists ( $row["employeeOid"] , $partTimePayArray )){
                    $data['totalParttimeHrs'] 	= $partTimePayArray[$row["employeeOid"]]["totParttimeHours"];
                    $data['parttimePay']        = $partTimePayArray[$row["employeeOid"]]["parttimePay"];
                }
                else {
                    $data['totalParttimeHrs'] 	= 0.0;
                    $data['parttimePay']        = 0.0;
                }
                
                if (array_key_exists($row["employeeOid"], $fteSalaryArray)) {
                    $data['dailyRate'] = $fteSalaryArray[$row["employeeOid"]]["dailyRate"];
                    $data['hourlyRate'] = $fteSalaryArray[$row["employeeOid"]]["hourlyRate"];
                    $data["salaryAmount"] = $fteSalaryArray[$row["employeeOid"]]["salaryAmount"];// 
                    $data["NSSFdeduction"] = $fteSalaryArray[$row["employeeOid"]]["NSSFdeduction"];
                } else {
                    $data['dailyRate'] = 0.0; 
                    $data['hourlyRate'] = 0.0;
                    $data["salaryAmount"] = 0.0;
                }    
                
                $data['bonus'] = 0.0;  
                
                if (array_key_exists($row["employeeOid"], $fteAdvanceArray)) {
                    $data["advance"] = $fteAdvanceArray[$row["employeeOid"]]["amount"];
                } else {
                    $data['advance'] = 0.0;
                } 
                
                if (array_key_exists($row["employeeOid"], $fteAttendanceArray)) {
                    $data["daysMissed"] = $fteAttendanceArray[$row["employeeOid"]]["daysMissed"];
                } else {
                    $data['daysMissed'] = 0;
                }   
				$logger->debug('generateAndSavePaySlip()[FTE data]', $data);    
				$id = $db->insert('fteemployeepayslip', $data);
//				$logger->debug("generateAndSavePaySlip()[ADD FTE PAYSLIP]", $db->getLastQuery());                
                if ($db->getLastErrno() != 0) {
                    return false;
                }                  
			break;
			case "F":
			break;
		}
	}
    return true;
}

function getEmployeeOidsForDateRange($periodStartDt,$periodEndDt,$employeeType){
	global $db,$logger;
    $employeeOidArray = array();
	$sql = "SELECT DISTINCT attendance.employeeOid, CONCAT(employee.firstName,' ', employee.middleInitial, ' ', employee.lastName) AS employeeName "
        . "FROM attendance "
        . "INNER JOIN employee ON employee.oid = attendance.employeeOid "
        . "INNER JOIN salary ON salary.employeeOid = employee.oid "
        . "WHERE salary.employeetype ='$employeeType' "
        . "AND (attendanceDt BETWEEN '$periodStartDt' AND '$periodEndDt') "
        . "ORDER BY employeeName";

	$rows = $db->query($sql);
	$logger->debug("getEmployeeOidsForDateRange()", $db->getLastQuery());
	if($rows){
		foreach($rows as $row){
			$data = Array (
				"employeeOid" => $row["employeeOid"],
				"employeeName" => $row["employeeName"]
				);
			$employeeOidArray[$row["employeeOid"]] = $data;
		}
		$logger->debug("getEmployeeOidsForDateRange()", $employeeOidArray);
	}
	return $employeeOidArray;
}

function getTeaPickingPayForEmployees($periodStartDt,$periodEndDt,$employeeType){
	global $db,$logger;
    $teaPayArray = array();

    $sql = "SELECT employee.oid eOid, attendanceOid, SUM(weight) totWeight "
        . "FROM teapicking "
        . "INNER JOIN attendance ON attendance.oid = teapicking.attendanceOid "
        . "INNER JOIN employee ON employee.oid = attendance.employeeOid "
        . "INNER JOIN salary ON salary.employeeOid = employee.oid "
        . "WHERE ( attendanceDt BETWEEN '$periodStartDt' AND '$periodEndDt' ) AND salary.employeetype = '$employeeType' "
        . "GROUP BY employee.oid";
		
	$rows = $db->query($sql);
	$logger->debug('getTeaPickingPayForEmployees()', $db->getLastQuery());
	if($rows){
		foreach($rows as $row){
			$data = Array (
				"eOid" => $row["eOid"],
				"attendanceOid" => $row["attendanceOid"],
				"totWeight" => $row["totWeight"]
				);
			$teaPayArray[$row["eOid"]] = $data;
		}
		$logger->debug('getTeaPickingPayForEmployees()', $teaPayArray);
	}
	return $teaPayArray;
}

function getTeaPayRateForTimePeriod($periodStartDt,$periodEndDt){
    global $db,$logger;
    $sql = "SELECT teapickingrate.startDt, teapickingrate.endDt, teapickingrate.oid AS rateOid, rate "
        . "FROM teapickingrate "
        . "WHERE teapickingrate.startDt <= '$periodStartDt' "
        . "AND (teapickingrate.endDt >= '$periodEndDt' OR teapickingrate.endDt IS NULL) ";
		
	$rows = $db->query($sql);
	$logger->debug('getTeaPayRateForTimePeriod()', $db->getLastQuery());
	if($rows){
        $logger->debug('getTeaPayRateForTimePeriod()', $rows);
		foreach($rows as $row){
			return $data = ["rate" => $row["rate"]];
		}
	}
    else {
        throw new Exception("MISSING Tea Pay Rate for the period $periodStartDt to $periodStartDt");
    }
}


function getPartTimePayForCasualEmployees($periodStartDt, $periodEndDt, $employeeType){
	global $db,$logger;
    $parttimePayArray = array();

	$partTimePaySql = "SELECT employee.oid AS eOid,	attendanceOid,SUM(hours) AS totHours,salary.oid AS sOid,salary.amount AS dailyRate, "
        . "(salary.amount)/8 AS hourlyRate, ROUND(((salary.amount)/8) * SUM(hours),2) AS parttimePay "
        . "FROM parttimedetail "
        . "INNER JOIN attendance ON attendance.oid = parttimedetail.attendanceOid "
        . "INNER JOIN employee ON employee.oid = attendance.employeeOid "
        . "INNER JOIN salary ON salary.employeeOid = employee.oid "
        . "WHERE attendanceOid IN (SELECT attendance.oid FROM attendance WHERE (attendanceDt BETWEEN '$periodStartDt' AND '$periodEndDt') "
        . "AND ((('$periodStartDt' >= salary.effectivetDt AND '$periodEndDt' <= salary.endDt ) "
        . "OR (salary.effectivetDt <= '$periodStartDt' AND endDt IS NULL) "
        . "OR (salary.effectivetDt >= '$periodStartDt' AND endDt IS NULL))) "
        . "AND salary.employeetype = 'C') "
        . "GROUP BY employee.oid";
    
    $rows = $db->query($partTimePaySql);
	$logger->debug("getPartTimePayForCasualEmployees()", $db->getLastQuery());
	if($rows){
		foreach($rows as $row){
			$data = Array (
				"eOid" => $row["eOid"],
				"attendanceOid" => $row["attendanceOid"],
				"salaryOid" => $row["sOid"],
                "dailyRate" => $row["dailyRate"],
				"totParttimeHours" => $row["totHours"],
				"hourlyRate" => $row["hourlyRate"],
				"parttimePay" => $row["parttimePay"]
				);
			$parttimePayArray[$row["eOid"]] = $data;
		}
		$logger->debug('getPartTimePayForCasualEmployees()', $parttimePayArray);
	}
	return $parttimePayArray;
}

function getPartTimePayForFTEEmployees($employeeOidsArray,$periodStartDt, $periodEndDt, $employeeType){
	global $db,$logger;
    $parttimePayArray = array();
    foreach($employeeOidsArray as $row) {
        $partTimePaySql = "SELECT salary.amount, DAY(LAST_DAY('$periodStartDt')) AS numdays,employee.oid AS eOid, attendanceOid,SUM(hours) AS totHours, "
            . "DATE(attendanceDt) AS attendanceDt, salary.oid AS sOid, ROUND((salary.amount)/(	DAY(LAST_DAY('$periodStartDt'))),2) AS dailyRate, "
            . "SUM(hours) AS totHours, salary.oid AS sOid, ROUND((salary.amount)/(DAY(LAST_DAY('$periodStartDt')))/8,2) AS hourlyRate "
            . "FROM parttimedetail "
            . "INNER JOIN attendance on attendance.oid = parttimedetail.attendanceOid "
            . "INNER JOIN employee ON employee.oid = attendance.employeeOid "
            . "INNER JOIN salary ON salary.employeeOid = employee.oid "
            . "WHERE attendanceOid IN (SELECT attendance.oid FROM attendance "
                                        . "WHERE (attendanceDt BETWEEN '$periodStartDt' AND '$periodEndDt') "
                                        . "AND ((salary.effectivetDt < '$periodStartDt' AND endDt IS NULL) "
                                        . "OR (effectivetDt >= '$periodStartDt' AND endDt <= '$periodEndDt')) AND salary.employeetype = 'S') "
            . " AND employee.oid =".$row["employeeOid"]." GROUP BY employee.oid";

        $rows = $db->query($partTimePaySql);
        $logger->debug('getPartTimePayForFTEEmployees()', $db->getLastQuery());
        $logger->debug('getPartTimePayForFTEEmployees()[rows]', $rows);
        if($rows){
            foreach($rows as $row){
                $data = Array (
                    "eOid" => $row["eOid"],
                    "totParttimeHours" => $row["totHours"]
                    );
                $data["parttimePay"] = calulcateParttimePay($row["attendanceDt"], $row["totHours"], $row["hourlyRate"]);
                $parttimePayArray[$row["eOid"]] = $data;
            }
            $logger->debug('getPartTimePayForFTEEmployees()', $parttimePayArray);
        }
    }
	return $parttimePayArray;
}

function calulcateParttimePay($attendanceDt,$totHours,$hourlyRate){
    global $db,$logger;
    global $sundaysInTheMonthArray,$holidaysInTheMonthArray;
    
    foreach($sundaysInTheMonthArray as $row){
        if($row['Date'] == $attendanceDt){
            return 2*$totHours*$hourlyRate;
        }
    }
    foreach($holidaysInTheMonthArray as $row){
        if($row['db_date'] == $attendanceDt){
            return 2*$totHours*$hourlyRate;
        }
    }    
    return $totHours*$hourlyRate;
}

function getOtherWorkPayForCasualEmployees($periodStartDt, $periodEndDt, $employeeType){
	global $db,$logger;
    $otherWorkPayArray = array();
    
	$sql ="SELECT salary.amount AS dailyRate, employee.firstName, employee.lastName, otherworkassigned.oid AS owOid, SUM(hours) AS totHrsWorked, "
        . "employee.oid AS eOid, attendanceOid, ( SUM(hours)/ 8 ) AS totOtherWorkedDays, ( (salary.amount)/ 8 ) AS hourlyRate, "
        . "ROUND( ( SUM(hours)/ 8 ) * ( (salary.amount) ), 2 ) AS otherWorkPay "
        . "FROM otherworkassigned "
        . "INNER JOIN (employee, attendance, salary) ON "
                    . "( employee.oid = attendance.employeeOid AND attendance.oid = otherworkassigned.attendanceOid "
                        . "AND attendanceDt BETWEEN '$periodStartDt' AND '$periodEndDt' "
                        . "AND salary.employeeOid = employee.oid AND (salary.employeetype = '$employeeType') "
                        . "AND ( ( salary.effectivetDt < '$periodStartDt' AND endDt IS NULL ) "
                                . "OR ( effectivetDt >= '$periodStartDt' ) ) "
        . ") GROUP BY employee.oid";
	$rows = $db->query($sql);
    $logger->debug('getOtherWorkPayForCasualEmployees()', $db->getLastQuery());
    $logger->debug('getOtherWorkPayForCasualEmployees()[rows]', $rows);
	if($rows){
		foreach($rows as $row){
			$data = Array (
				"eOid" => $row["eOid"],
				"attendanceOid" => $row["attendanceOid"],
				"totOtherWorkedDays" => $row["totOtherWorkedDays"],
                "otherHoursWorked" => $row["totHrsWorked"],
				"dailyRate" => $row["dailyRate"],
                "hourlyRate" => $row["hourlyRate"],
				"otherWorkPay" => $row["otherWorkPay"]
				);
			$otherWorkPayArray[$row["eOid"]] = $data;
		}
        
	}
	$logger->debug('getOtherWorkPayForCasualEmployees()[otherWorkPayArray]', $otherWorkPayArray);
    return $otherWorkPayArray;
}

function getOtherWorkPayForFTEEmployees($periodStartDt, $periodEndDt, $employeeType){
	global $db,$logger;
    $otherWorkPayArray = array();
    
	$sql ="SELECT employee.firstName, employee.lastName, otherworkassigned.oid AS owOid, employee.oid AS eOid, attendanceOid, "
        . "( SUM(hours)/ 8 ) AS totOtherWorkedDays, ( (salary.amount)/ 8 ) AS dailyRate, "
        . "ROUND((SUM(hours)/ 8) * ((salary.amount)/ 8), 2) AS otherWorkPay, SUM(hours) AS otherHoursWorked   "
        . "FROM otherworkassigned "
        . "INNER JOIN (employee, attendance, salary) "
                    . "ON ( employee.oid = attendance.employeeOid AND attendance.oid = otherworkassigned.attendanceOid "
                            . "AND attendanceDt BETWEEN '$periodStartDt' AND '$periodEndDt' "
                            . "AND salary.employeeOid = employee.oid AND (salary.employeetype = '$employeeType') "
                            . "AND ( ( salary.effectivetDt < '$periodStartDt' AND endDt IS NULL ) "
                                    . "OR ( effectivetDt >= '$periodStartDt' AND endDt <= '$periodEndDt' ) ) "
                    . ") "
        . "GROUP BY employee.oid";
	$rows = $db->query($sql);
	$logger->debug('getOtherWorkPayForFTEEmployees()', $db->getLastQuery());
	if($rows){
		foreach($rows as $row){
			$data = Array (
				"eOid" => $row["eOid"],
				"attendanceOid" => $row["attendanceOid"],
				"totOtherWorkedDays" => $row["totOtherWorkedDays"],
                "otherHoursWorked" => $row["otherHoursWorked"],
				"dailyRate" => $row["dailyRate"],
				"otherWorkPay" => $row["otherWorkPay"]
				);
			$otherWorkPayArray[$row["eOid"]] = $data;
		}
		
	}
	$logger->debug('getOtherWorkPayForFTEEmployees()[otherWorkPayArray]', $otherWorkPayArray);
    return $otherWorkPayArray;
}

function getFTEadvance($employeeOidsArray,$opsMonthlyCalendarOid){
	global $db,$logger;
	$FTEadvanceArray = array();

    foreach($employeeOidsArray as $row){
        $paySql = "SELECT oid, employeeOid, opsMonthlyCalendarOid, amount, paid "
            . "FROM ftesalaryadvance "
            . "WHERE employeeOid = ".$row["employeeOid"]." AND opsMonthlyCalendarOid = $opsMonthlyCalendarOid ";
        $rows = $db->query($paySql);
//        $logger->debug("getFTEadvance()", $db->getLastQuery()); 
        if($rows){
            foreach($rows as $aRow){
				$data = Array (
					"employeeOid" => $row["employeeOid"],
                    "amount" => $aRow["amount"]
					);             
            }
            $FTEadvanceArray[$row["employeeOid"]] = $data;
        }
        else {
            $data = Array (
                "employeeOid" => $row["employeeOid"],
                "amount" => 0.0
                );             
        }
        $FTEadvanceArray[$row["employeeOid"]] = $data;
    }
	$logger->debug("getFTEadvance()", $FTEadvanceArray);
	return $FTEadvanceArray;    
}

function getFTEterminationAdvancePaidOut($employeeOidsArray){
	global $db,$logger;
	$FTEadvanceArray = array();

    foreach($employeeOidsArray as $row){
        $paySql = "SELECT oid, employeeOid, IF(SUM(amount) IS NULL, 0, SUM(amount)) AS amount, paid "
            . "FROM ftesalaryadvance "
            . "WHERE employeeOid = ".$row["employeeOid"];
        $rows = $db->query($paySql);
        $logger->debug("getFTEterminationAdvancePaidOut()", $db->getLastQuery()); 
        if($rows){
            foreach($rows as $aRow){
				$data = Array (
					"employeeOid" => $row["employeeOid"],
                    "amount" => $aRow["amount"]
					);             
            }
            $FTEadvanceArray[$row["employeeOid"]] = $data;
        }
        else {
            $data = Array (
                "employeeOid" => $row["employeeOid"],
                "amount" => 0.0
                );             
        }
        $FTEadvanceArray[$row["employeeOid"]] = $data;
    }
	$logger->debug("getFTEterminationAdvancePaidOut()", $FTEadvanceArray);
	return $FTEadvanceArray;    
}
function getSundaysInTheMonthArray($monthStartDt,$monthEndDt){
	global $db,$logger;
    $rows = array();
    $sql = "select DATE_ADD('$monthStartDt', INTERVAL ROW DAY) as Date,
                                row+1  as DayOfMonth FROM
                                (
                                    SELECT @row := @row + 1 as row FROM 
                                        (SELECT 0 union all select 1 union all select 3 union all select 4 union all select 5 union all select 6) t1,
                                        (SELECT 0 union all select 1 union all select 3 union all select 4 union all select 5 union all select 6) t2, 
                                        (SELECT @row:=-1) t3 limit 31
                                ) b
                                WHERE 
                                DATE_ADD('$monthStartDt', INTERVAL ROW DAY) BETWEEN '$monthStartDt' AND '$monthEndDt' 
                                 AND DAYOFWEEK(DATE_ADD('$monthStartDt', INTERVAL ROW DAY))=1";    

	$logger->debug("getSundaysInTheMonthArray()", ['SQL'=>$sql]);
    $rows = $db->query($sql);
    
	$logger->debug("getSundaysInTheMonthArray()", $db->getLastQuery());
    $logger->debug("getSundaysInTheMonthArray()", $rows);
    return $rows;
}

function getHolidaysInTheMonthArray($monthStartDt,$monthEndDt){
	global $db,$logger;
    $rows = array();
    $sql = "SELECT * FROM opstimedimension WHERE year = 2017 AND holiday_flag LIKE 't' AND db_date BETWEEN '$monthStartDt' AND '$monthEndDt' ";
    $rows = $db->query($sql);
	$logger->debug("getHolidaysInTheMonthArray()", $db->getLastQuery());
    $logger->debug("getHolidaysInTheMonthArray()", $rows);
    return $rows;
}

function getMedicalDeductions($employeeOidsArray,$periodStartDt, $periodEndDt){
	global $db,$logger;
	$medicalDeductionsArray = array();
    $data = Array();
    $logger->debug("getMedicalDeductions()", $employeeOidsArray);
	foreach($employeeOidsArray as $row){     
        $sql = "SELECT oid, employeeOid, deductionFlg, effectiveDt, endDt "
            . "FROM medicaldeduction "
            . "WHERE effectiveDt <= '$periodStartDt' "
            . "AND (endDt >= '$periodEndDt' OR endDt IS NULL) "
            . "AND employeeOid = ".$row["employeeOid"];
		$rows = $db->query($sql);
        $logger->debug("getMedicalDeductions()", $db->getLastQuery());
		if($rows){
            foreach($rows as $aRow) {
                $data = Array (
                    "employeeOid" => $row["employeeOid"],
					"deductionFlg" => $aRow["deductionFlg"],
                    "medicalDeductionAmt" => $aRow["deductionFlg"] * 0.0
                 );
            }
        }
        else {
            $data = Array (
                "employeeOid" => $row["employeeOid"],
                "deductionFlg" => 0,
                "medicalDeductionAmt" => 0.0
             );            
        }
		$medicalDeductionsArray[$row["employeeOid"]] = $data;		
	}
    $logger->debug("getMedicalDeductions()",$medicalDeductionsArray);
	return $medicalDeductionsArray; 
}

function getLoansDeductions($employeeOidsArray){
    global $db,$logger;
//    $logger->debug('getLoansDeductions()', $employeeOidsArray);
	$loansDeductions = array();	
	foreach($employeeOidsArray as $row){
		$loanSql = "SELECT IF(MAX(deductionAmt) IS NULL, 0, MAX(deductionAmt)) AS installmentAmt "
            . "FROM employeeloanpmt "
            . "INNER JOIN employeeloan ON employeeloan.oid = employeeloanpmt.employeeLoanOid "
            . "WHERE paid = 0 AND deductionAmt != 0 "
            . "AND employeeloan.employeeOid = ".$row["employeeOid"];
		$loanRows = $db->query($loanSql);
		$logger->debug("getLoansDeductions()",$db->getLastQuery());
		if($loanRows){
			foreach($loanRows as $aRow){
				$data = Array (
					"employeeOid" => $row["employeeOid"],
					"loanDeduction" => $aRow["installmentAmt"],
                    "loanBalance" => 0.0
					);
				$loansDeductions[$row["employeeOid"]] = $data;
			}
		}
		else {
			$data = Array (
				"employeeOid" => $row["employeeOid"],
                "loanDeduction" => 0.0,
				"loanBalance" => 0.0
				);
		$loansDeductions[$row["employeeOid"]] = $data;
		}
	}
    $logger->debug("getLoansDeductions()", $loansDeductions);
	return $loansDeductions;
}

//defunct - not used, probably broken
function getCasualsSalaryArray($employeeOidsArray,$periodStartDt, $periodEndDt){
	global $db,$logger;
	$casualsSalaryArray = array();
	$data = Array();    
    
    foreach($employeeOidsArray as $row) {
        $paySql ="SELECT employee.oid AS eOid, salary.oid AS sOid, salary.amount AS dailyRate, (salary.amount)/ 8 AS hourlyRate, "
                . "salary.effectivetDt, salary.endDt "
                . "FROM salary "
                . "INNER JOIN employee ON employee.oid = salary.employeeOid "
                . "WHERE (( '$periodStartDt' >= salary.effectivetDt AND '$periodEndDt' <= salary.endDt ) "
                    . "OR (salary.effectivetDt <= '$periodStartDt' AND endDt IS NULL) OR (salary.effectivetDt >= '2016-12-23' AND endDt IS NULL))) "
                . "GROUP BY employee.oid ";
        $rows = $db->query($paySql);
//        $logger->debug("getCasualsSalaryArray", $db->getLastQuery());
        if($rows){
            foreach($rows as $aRow){
				$data = Array (
					"employeeOid" => $row["employeeOid"],
					"dailyRate" => $aRow["dailyRate"],
                    "hourlyRate" => $aRow["hourlyRate"]
					);  
                $casualsSalaryArray[$row["employeeOid"]] = $data;
            }
        }
        else {
			$data = Array (
				"employeeOid" => $row["employeeOid"],
                "dailyRate" => 0.0,
				"hourlyRate" => 0.0
				);  
            $casualsSalaryArray[$row["employeeOid"]] = $data;
        }        
    }
	$logger->debug("getCasualsSalaryArray()", casualsSalaryArray); 	
	return $casualsSalaryArray;
}

function getFTESalaryArray($employeeOidsArray,$monthStartDt, $monthEndDt){
	global $db,$logger;
	$FTEsalaryArray = array();
	$data = Array();
    foreach($employeeOidsArray as $row) {
        $paySql = "SELECT salary.employeeOid, amount, effectivetDt, (((6000*0.06)+(amount-6000)*0.06)) AS NSSFdeduction,
                    ROUND( amount/DAY(LAST_DAY('$monthStartDt')), 2 ) AS dailyRate,
                    ROUND( (amount/DAY(LAST_DAY('$monthStartDt')))/8, 2 ) AS hourlyRate 
                    FROM salary 
                    WHERE salary.employeeOid = ".$row["employeeOid"]." AND (effectivetDt = '$monthStartDt' OR endDt IS NULL) ";
        $rows = $db->query($paySql);
//        $logger->debug("getFTESalaryArray", $db->getLastQuery());
        if($rows){
            foreach($rows as $aRow){
				$data = Array (
					"employeeOid" => $row["employeeOid"],
					"salaryAmount" => $aRow["amount"],
                    "hourlyRate" => $aRow["hourlyRate"],
                    "dailyRate" => $aRow["dailyRate"],
                    "NSSFdeduction" => $aRow["NSSFdeduction"]
					);  
                $FTEsalaryArray[$row["employeeOid"]] = $data;
            }
        }
        else {
			$data = Array (
				"employeeOid" => $row["employeeOid"],
                "salaryAmount" => 0.0,
				"hourlyRate" => 0.0,
                "dailyRate" => 0.0
				);  
            $FTEsalaryArray[$row["employeeOid"]] = $data;
        }        
    }
	$logger->debug("getFTESalaryArray()", $FTEsalaryArray); 	
	return $FTEsalaryArray;
}

function getFTEattendance($employeeOidsArray,$monthStartDt,$monthEndDt){
    $FTEattendanceArray = array();
    foreach($employeeOidsArray as $row) {
        $data = Array (
				"daysMissed" => getFTEdaysAbsent($row["employeeOid"],$monthStartDt,$monthEndDt)
            );
        $FTEattendanceArray[$row["employeeOid"]] = $data;
    }
    return $FTEattendanceArray;
}

function getFTEdaysAbsent($employeeOid,$monthStartDt,$monthEndDt){
    //need to exclude sundays or holidays for FTE's
	global $db,$logger, $sundaysInTheMonthArray;
    $daysAbsent = 0;
    
    $sql ="SELECT DATE(attendanceDt) AS dateAbsent, attendance_in "
        . "FROM attendance "
        . "WHERE attendance.employeeOid = $employeeOid AND (attendanceDt BETWEEN '$monthStartDt' AND '$monthEndDt') AND attendance.attendance_in = 0";
	$rows = $db->query($sql);
	$logger->debug("getFTEdaysAbsent()", $db->getLastQuery());
	if($rows){
        $logger->debug("getFTEdaysAbsent()",$rows);
        $daysAbsent = sizeof($rows);
		foreach($rows as $aRow){
            foreach($sundaysInTheMonthArray as $row){
                if($aRow['dateAbsent'] == $row['Date']){
                    $daysAbsent--;
                }
            }
		}
	}    
    return $daysAbsent;
}
function getPurchasesDeductions($employeeOidsArray,$periodStartDt, $periodEndDt) {
	global $db,$logger;
	$purchaseDeductions = array();	
	foreach($employeeOidsArray as $row){	
        $deductionsSql = "SELECT IF(SUM(quantity * unitPrice), SUM(quantity * unitPrice),0) AS deductionAmt "
            . "FROM employeepurchases "
            . "WHERE employeeOid = ".$row["employeeOid"]." "
            . "AND paidFlg=0";
		$deductionsRows = $db->query($deductionsSql);
//		$logger->debug('getPurchasesDeductions()', $db->getLastQuery());
		if($deductionsRows){
			foreach($deductionsRows as $aRow){
				$data = Array (
					"employeeOid" => $row["employeeOid"],
					"deductionAmt" => $aRow["deductionAmt"]
					);
				$purchaseDeductions[$row["employeeOid"]] = $data;
			}
		}
		else {
			$data = Array (
				"employeeOid" => $row["employeeOid"],
                "deductionAmt" => 0.0
				);
		$purchaseDeductions[$row["employeeOid"]] = $data;
		}		
	}
    $logger->debug('getPurchasesDeductions()', $purchaseDeductions);
	return $purchaseDeductions;    
}
function getOtherDeductions($employeeOidsArray,$periodStartDt, $periodEndDt){
	global $db,$logger;
	$otherDeductions = array();	
	foreach($employeeOidsArray as $row){	
        $deductionsSql = "SELECT IF(SUM(amount), SUM(amount),0) AS deductionAmt "
            . "FROM EmployeeotherDeduction "
            . "WHERE employeeOid = ".$row["employeeOid"]." "
            . "AND paidFlg=0";
		$deductionsRows = $db->query($deductionsSql);
//		$logger->debug('getOtherDeductions()', $db->getLastQuery());
		if($deductionsRows){
			foreach($deductionsRows as $aRow){
				$data = Array (
					"employeeOid" => $row["employeeOid"],
					"deductionAmt" => $aRow["deductionAmt"]
					);
				$otherDeductions[$row["employeeOid"]] = $data;
			}
		}
		else {
			$data = Array (
				"employeeOid" => $row["employeeOid"],
                "deductionAmt" => 0.0
				);
		$otherDeductions[$row["employeeOid"]] = $data;
		}		
	}
    $logger->debug('getOtherDeductions()', $otherDeductions);
	return $otherDeductions;
}

function getElecDeductions($employeeOidsArray,$periodStartDt,$periodEndDt){
	global $db,$logger;
    $logger->debug('getElecDeductions()', $employeeOidsArray);
	$elecDeductions = array();	
    $elecDeductionRateArray = getElecDeductionRateForTimePeriod($periodStartDt,$periodEndDt);
	foreach($employeeOidsArray as $row){       
        $elecFlgSql = "SELECT 1 FROM employeeresidency  "
            . "WHERE effectiveDt <= '".$periodStartDt."' AND (endDt >= '".$periodEndDt."' OR endDt IS NULL)"
            . "AND employeeOid = ".$row['employeeOid'];
		$elecFlgRows = $db->query($elecFlgSql);
		if($elecFlgRows){
            foreach($elecFlgRows as $aRow) {
                $data = ['employeeOid' => $row['employeeOid']]; 
                $data["elecFlg"] = 1;
                $data["elecDeduction"] =  $elecDeductionRateArray['rate'];
            }
        }
        else {
            $data = ['employeeOid' => $row['employeeOid']]; 
            $data["elecFlg"] = 0;
            $data["elecDeduction"] =  0.0;
        }
		$elecDeductions[$row["employeeOid"]] = $data;		
	}
	return $elecDeductions;    
}

function getElecDeductionRateForTimePeriod($periodStartDt,$periodEndDt){
    global $db,$logger;
    $sql = "SELECT oid, rate, startDt, endDt "
        . "FROM ElecDeductionRate "
        . "WHERE startDt <= '$periodStartDt' "
        . "AND (endDt >= '$periodEndDt' OR endDt IS NULL) ";
		
	$rows = $db->query($sql);
	$logger->debug('getElecDeductionRateForTimePeriod()', $db->getLastQuery());
	if($rows){
        $logger->debug('getElecDeductionRateForTimePeriod()', $rows);
		foreach($rows as $row){
			return $data = ["rate" => $row["rate"]];
		}
	}
    else {
        throw new Exception("MISSING Elec deduction Rate for the period $periodStartDt to $periodStartDt");
    }
}

function getLastPayslipPeriod(){
	global $db,$logger;
	$sql = "SELECT MAX(opsBiWeeklyCalendarOid) as maxOid FROM casualemployeepayslip";
	$rows = $db->query($sql);
	$logger->debug('getLastPayslipPeriod', $db->getLastQuery());
	if($rows){
		$parttimePayArray = array();
		foreach($rows as $row)
			return $row["maxOid"];
	}
}

function payslipIsLocked($selectedDateRangeRowID, $tableName, $columnName, $payslipOid = null){
    global $logger;
    global $db; 
    $rows;
    
    if (isset($payslipOid)){
        $rows = $db->query("SELECT lockedFlg FROM ".$tableName." WHERE ".$columnName." = $payslipOid");
    }
    else {
        $rows = $db->query("SELECT lockedFlg FROM ".$tableName." WHERE ".$columnName." = $selectedDateRangeRowID");
    }
    if ($rows) {
        foreach ($rows as $row) {
            if ($row['lockedFlg'] == 1) {
                return true;
            }
            else {
                return false;
            }
        }
    }
    else {
        throw new Exception("payslipIsLocked(): ERror fetching lock flag from ".$tableName);
    }
}
function generatePayslipNbr(){
    $d = new DateTime();
    return $d->format('mdyGis');
}

function getEmployeeOutstandingLoanDetail($employeeOidsArray){
    global $db;
    global $logger;
    $data = Array();
    $outStandingLoanData = Array();
    $logger->debug('getEmployeeOutstandingLoanDetail()', $employeeOidsArray);
    foreach($employeeOidsArray as $row){
        $sql = "SELECT IF(loanNbr IS NULL, 'n/a', loanNbr) AS loanNbr, IF(loanDate IS NULL, '0000-00-00', loanDate) AS loanDate, "
            . "IF(loanAmount IS NULL, 0, loanAmount) AS loanAmount, IF(SUM(deductionAmt) IS NULL, 0, SUM(deductionAmt)) AS TotPaidAmt, "
            . "IF((loanAmount - SUM(deductionAmt)) IS NULL, 0, (loanAmount - SUM(deductionAmt))) as loanBalance, "
            . "IF(employeeloanpmt.oid IS NULL, 0, employeeloanpmt.oid) AS lOid, IF(employeeloan.oid IS NULL, 0, employeeloan.oid) AS eOid "
            . "FROM employeeloanpmt INNER JOIN employeeloan ON employeeloan.oid = employeeloanpmt.employeeLoanOid "
            . "WHERE paid = 1 AND employeeloan.employeeOid = ".$row["employeeOid"];
        $listObj = $db->query($sql);
        $logger->debug('getEmployeeOutstandingLoanDetail()', $db->getLastQuery());
        if ($listObj) {
            foreach ($listObj as $value) {
                $data['employeeOid'] = $row["employeeOid"];
                $data['loanDeduction'] = $value["loanBalance"];
                $data['loanBalance'] = 0.0;
                $data['loanNbr'] = $value["loanNbr"];
                $data['loanAmount'] = $value["loanAmount"];
                $data['TotPaidAmt'] = $value["TotPaidAmt"];
            }
        } 
        else {
                $data['employeeOid'] = $row["employeeOid"];
                $data['loanDeduction'] = 0.0;
                $data['loanBalance'] = 0.0;
                $data['loanNbr'] = 'n/a';
                $data['loanAmount'] = 0.0;
                $data['paidAmt'] = 0.0;        
        }
        $outStandingLoanData[$row["employeeOid"]] = $data;
    }
    $logger->debug('getEmployeeOutstandingLoanDetail()', $outStandingLoanData);
    return $outStandingLoanData;
}

function getOpsMonthlyCalendarOidFromDate($periodStartDt){
    global $db;
    global $logger;
    $unitObj = $db->query("SELECT oid, monthNbr, month, year "
        . "FROM opsmonthlycalendar "
        . "WHERE year = YEAR('2017-05-01') AND monthNbr = MONTH('$periodStartDt')");
    if ($db->getLastErrno() != 0)
        throw new Exception("getOpsMonthlyCalendarOidFromDate(): Error executing oid get query");    

    $logger->debug('getOpsMonthlyCalendarOidFromDate()', $db->getLastQuery());
    
    if ($unitObj) {
        foreach ($unitObj as $value) {
            return $value["oid"];
        }
    }
    else {
        throw new Exception("getOpsMonthlyCalendarOidFromDate(): No oid found matching given date: ".$periodStartDt);
    }
}

function getOpsBiweeklyCalendarOidFromDate($periodStartDt){
    global $db;
    global $logger;
    $unitObj = $db->query("SELECT oid FROM opsbiweeklycalendar WHERE `periodStartDate` = '$periodStartDt'");
    if ($db->getLastErrno() != 0)
        throw new Exception("getOpsBiweeklyCalendarOidFromDate(): Error executing get oid get query");    

    $logger->debug('getOpsBiweeklyCalendarOidFromDate()', $db->getLastQuery());
    
    if ($unitObj) {
        foreach ($unitObj as $value) {
            return $value["oid"];
        }
    }
    else {
        throw new Exception("getOpsBiweeklyCalendarOidFromDate(): No oid found matching given date: ".$periodStartDt);
    }
}