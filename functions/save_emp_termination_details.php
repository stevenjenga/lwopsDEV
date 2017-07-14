<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug('REQUEST', $_REQUEST);
//{"dailyRate":"280","hourlyRate":"35","totalTeaWeight":"50","teaPayRate":"17.5","teaPay":"875","totalParttimeHrs":"1","totParttimePay":"35",
//"spacer1":"","otherHoursWorked":"8","otherworkPay":"280","grossIncome":"1190","medicalDeduction":"0","NSSFdeduction":"0","elecDeduction":"150",
//"purchasesDeduction":"150","otherDeductions":"0","totalDeductions":"300","payslipOid":"511","gratuityAmt":"1234",
//"gratuityComments":"GGGGGGGGGGGGGGGGG","terminationComments":"FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF",
//"empType":"C","terminationReason":"1","netPayDue":"2124","empOid":"14"
    $db->startTransaction();
    saveTermination($_REQUEST);
    updateTerminatedFlag($_REQUEST);
    prependEmployeeNameWithZZ($_REQUEST);
    lockPayslip($_REQUEST);
    terminateResidency($_REQUEST);
    $db->commit();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $db->rollback();
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage());
}

function saveTermination($request) {
    global $db, $logger;
    $data = Array();

    $data['employeeOid'] = $request['empOid'];
    $data['terminationDate'] = $request['terminationDate'];
    $data['employeeTerminationTypeOid'] = $request['terminationReason'];
    $data['comments'] = $request['terminationComments'];
    $data['gratuityAmt'] = $request['gratuityAmt'];
    $data['gratuityComments'] = $request['gratuityComments'];
    $id = $db->insert('EmployeeTermination', $data);
    $logger->debug('saveTermination()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return $id;
    } else {
        throw new Exception($db->getLastError());
    }
}

function updateTerminatedFlag($request){
    global $db, $logger;
    $data = Array();
    $data["terminated"] = 1;
    $data["active"] = 0;
    $db->where('oid', $request['empOid']);
    $db->update('employee', $data);
    $logger->debug('updateTerminatedFlag()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return;
    }
    else {
        throw new Exception($db->getLastError());    
    }
}

function prependEmployeeNameWithZZ($request){
    global $db, $logger;

    $sql = "SELECT oid, firstName, lastName "
        . "FROM employee "
        . "WHERE oid =".$request['empOid']." "
        . "LIMIT 1";

    $rows = $db->query($sql);
    $logger->debug('prependEmployeeNameWithZZ()', $db->getLastQuery());
    foreach($rows as $row){
        $data = Array(
            "firstName" => 'zz'.$row['firstName'],
            "lastName" => 'zz'.$row['lastName']
        );
    }
    $db->where('oid', $request['empOid']);
    $db->update('employee', $data);
    $logger->debug('prependEmployeeNameWithZZ()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return;
    }
    else {
        throw new Exception($db->getLastError());     
    }
}   
function lockPayslip($request){
    global $logger;
    global $db;
 
    $data = Array(
        "lockedFlg" => 1
    );
    $db->where('oid', $request['payslipOid']);
    
    switch($request['empType']){
		case "S":
            $db->update('fteemployeepayslip', $data);
            break;
		case "C":
            $db->update('casualemployeepayslip', $data);
            break;
		case "F":
            throw new Exception("lockPayslip(): invalid employee type F");
        default:
            throw new Exception("lockPayslip(): invalid employee type");
	}      

    $logger->debug('lockPayslip()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return;
    } else {
        throw new Exception($db->getLastError());
    }
}


function terminateResidency($request){
    global $db, $logger;
    $data = Array();
    
    $data['endDt'] = date('Y-m-d');
    $db->where('employeeOid', $request['empOid']);
    
    $id = $db->update('EmployeeResidency', $data);
    $logger->debug('terminateResidency()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return;
    } else {
        throw new Exception($db->getLastError());
    }     
}