<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug('REQUEST', $_REQUEST);
    $db->startTransaction();
    saveNewHire($_REQUEST);
    $db->commit();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
    return;    
} catch (Exception $e) {
    $db->rollback();
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage());
}

function saveNewHire($request) {
    global $db, $logger;
    $data = Array();
    $data['firstName'] = $request['firstName'];
    $data['middleInitial'] = $request['midInitial'];   
    $data['lastName'] = $request['lastName'];
    $data['nationalID'] = $request['nationalID'];
    $data['mobileNbr'] = $request['mobileNbr'];   
    $data['resident'] = $request['residentFlg'];
    $data['elecDeduction'] = $request['elecDeductionFlg'];
    $data['ePayment'] = $request['ePayment'];
    $data['active'] = 1;
    $data['startDt'] = $request['startDt'];
    $data['gender'] = $request['gender']; 
    $data['terminated'] = 0;
    $data['dateOfBirth'] = $request['DOB'];  
    $data['maritalStatus'] = $request['maritalStatus'];
    $data['spouseFirstNm'] = $request['spouseFirstNm'];   
    $data['spouseLastNm'] = $request['spouseLastNm'];
    $data['spouseMobNbr'] = $request['spouseMobNbr'];
    $data['prevEmployerName'] = $request['prevEmployerName'];
    $data['prevEmployerTelNbr'] = $request['prevEmployerTelNbr'];
    $data['prevEmployerStartDt'] = $request['prevEmployerStartDt'];
    $data['prevEmployerEndDt'] = $request['prevEmployerEndDt'];
    $data['prevEmployerLeavingReason'] = $request['prevEmployerLeavingReason'];
    $data['prevEmployerLocation'] = $request['prevEmployerLocation'];
    $data['workDoneAtPrevEmployer'] = $request['workDoneAtPrevEmployer'];
    $data['nxtOfKinFirstNm'] = $request['nxtOfKinFirstNm'];
    $data['nxtOfKinLastNm'] = $request['nxtOfKinLastNm'];  
    $data['nxtOfKinMobileNbr'] = $request['nxtOfKinMobileNbr'];
    $data['nxtOfKinResidence'] = $request['nxtOfKinResidence'];
    $data['nxtOfKinRelationship'] = $request['nxtOfKinRelationship'];
    $data['nxtOfKinPlaceOfWork'] = $request['nxtOfKinPlaceOfWork'];

    $id = $db->insert('employee', $data);
    $logger->debug('saveNewHire()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        saveSalary($request, $id);
        saveSalaryExpenseAllocation($request, $id);
        saveEmployeeRole($request, $id);
        insertAttendance($request, $id);
        saveNSSFdeduction($request, $id);
        saveMedicaldeduction($request, $id);
        return;
    } else {
        throw new Exception($db->getLastError());
    }
}
function saveSalary($request, $empOid){
    global $db, $logger;
    $data['employeeOid'] = $empOid;
    $data['employeetype'] = $request['employmentType'];
    $data['amount'] = $request['startingSalary'];     
    $data['effectivetDt'] = $request['startDt'];
    $data['salarytype'] = $request['salaryFrequency'];
    $id = $db->insert('salary', $data);
    $logger->debug('saveSalary()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return $id ;
    } else {
        throw new Exception($db->getLastError());
    }    
}

function saveSalaryExpenseAllocation($request, $empOid){
    global $db, $logger;
    $data['employeeOid'] = $empOid;
    $data['lineOfBusinessOid'] = $request['lineOfBusinessOid'];
    $data['effectiveDt'] = $request['startDt'];
    $data['allocation'] = 100;    
    $id = $db->insert('employeesalaryexpenseallocation', $data);
    $logger->debug('saveSsaveSalaryExpenseAllocationalary()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return $id ;
    } else {
        throw new Exception($db->getLastError());
    }     
}

function saveEmployeeRole($request, $empOid) {
    global $db, $logger;
    //oid, employeeOid, employeeRoleTypeOid, effectiveDt, endDt, createTmstp, updtTmstp
    $data['employeeOid'] = $empOid;
    $data['employeeRoleTypeOid'] = $request['employeeRole'];
    $data['effectiveDt'] = $request['startDt'];
    $id = $db->insert('employeerole', $data);
    $logger->debug('saveEmployeeRole()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return $id;
    } else {
        throw new Exception($db->getLastError());
    }
}

function saveNSSFdeduction($request, $empOid) {
    global $db, $logger;
    $data['employeeOid'] = $empOid;
    $data['deductionFlg'] = $request['NSSFdeductionFlg'];
    $data['effectiveDt'] = $request['startDt'];
    $id = $db->insert('NSSFDeduction', $data);
    $logger->debug('saveNSSFdeduction()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return $id;
    } else {
        throw new Exception($db->getLastError());
    }
}

function saveMedicaldeduction($request, $empOid) {
    global $db, $logger;
    $data['employeeOid'] = $empOid;
    $data['deductionFlg'] = $request['medicalDeductionFlg'];
    $data['effectiveDt'] = $request['startDt'];
    $id = $db->insert('MedicalDeduction', $data);
    $logger->debug('saveMedicaldeduction()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return $id;
    } else {
        throw new Exception($db->getLastError());
    }
}

function insertAttendance($request, $empOid) {
    global $db, $logger;
    $id = 0;

    $effectiveDate = new DateTime($request['startDt']);
    $today = new DateTime('today');
    while ($effectiveDate <= $today) {
        
        //check if attendance has been created for this day = $effectiveDate
        $db->where('attendanceDt', $effectiveDate->format('Y-m-d'));
        $logger->debug('insertAttendance()', $db->getLastQuery());
        
        //if it has, then add this new employee's attendance, else skip
        if ($db->has('attendance')) {
            $data = array(
                'employeeOid' => $empOid,
                'attendance_in' => 1,
                'attendanceDt' => $effectiveDate->format('Y-m-d')
            );
            $id = $db->insert("attendance", $data);
            if ($db->getLastErrno() != 0) {
                throw new Exception($db->getLastError());
            }
            $logger->debug('insertAttendance()', $db->getLastQuery());
            unset($data);
        } 
        $interval = new DateInterval('P1D');
        $effectiveDate->add($interval);
    }
    return $id;
}
