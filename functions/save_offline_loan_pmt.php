<?php

require_once('functions.php');
global $db, $logger, $paymentType;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug('REQUEST', $_REQUEST); 
    $paymentType = $_REQUEST['paymentType'];
    $db->startTransaction();
    
	switch($paymentType){
		case "PAYSLIP":
            if (payslipAlreadyUsed($_REQUEST['payslipNbr'], $_REQUEST['loanOid'])) {
                throw new Exception("Selected payslip [".$_REQUEST['payslipNbr']."] has been used previously");
            }
            deletUnpaidPmtSchedule($_REQUEST);
            generateAndSaveNewPmtSchedule($_REQUEST);
            savePmt($_REQUEST);     
		break;
		case "OFFLINE":
            validateOfflineAmountPaid($_REQUEST);
            deletUnpaidPmtSchedule($_REQUEST);
            generateAndSaveNewPmtSchedule($_REQUEST);
            savePmt($_REQUEST);            
		break;
		default:
            throw new Exception("Invalid paymentType =".$paymentType);
	}
    
    $db->commit();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
    return;
} catch (Exception $e) {
    $db->rollback();
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorPopup($e->getMessage());
}

function savePmt($request){
    global $db, $logger, $paymentType;
    $data = Array();
	switch($paymentType){
		case "PAYSLIP":
            $data['payslipNbr'] = $request['payslipNbr'];
		break;
		case "OFFLINE":
            $data['payslipNbr'] = "OFFLINE";           
		break;
		default:
            throw new Exception("Invalid paymentType =".$paymentType);
	}
    
    $loanPmtOid = $request['loanPmtOid'];
    $data['employeeLoanOid'] = $request['loanOid'];
    $data['deductionAmt'] = $request['amountPaid'];
    $data['balanceAmount'] = $request['currentLoanBal'] - $request['amountPaid'];
    $data['paid'] = 1;
    
    $date = new DateTime();
    $data['dateDeducted'] = $date->format('Y-m-d');
    $id = $db->insert('employeeloanpmt', $data);
    $logger->debug('savePmt()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return;
    } else {
        throw new Exception($db->getLastError());
    }
}

function validateOfflineAmountPaid($request){
    if ($request['amountPaid'] > $request['currentLoanBal']){
        throw new Exception("<br>Amount paid offline [".$request['amountPaid']."] must be less than the current balance [".$request['currentLoanBal']."]");
    }
    if ($request['amountPaid'] <= '0.0'){
        throw new Exception("Amount paid offline cannot be 0");
    }    
}

function payslipAlreadyUsed($payslipNbr, $loanOid){
    global $db, $logger;
    $sql = "SELECT 1 "
        . "FROM employeeloanpmt "
        . "INNER JOIN employeeloan ON employeeloan.oid = employeeloanpmt.employeeLoanOid "
        . "WHERE payslipNbr = '".$payslipNbr."' "
        . "AND employeeLoanOid = $loanOid ";
    $rows = $db->query($sql);
    if ($db->getLastErrno() != 0) {
        throw new Exception($db->getLastError());
    }    
    $logger->debug("validatePayslipNbr()", $db->getLastQuery()); 
	if($rows){
		return 1;
	}
    else {
        return 0;
    }     
}

function deletUnpaidPmtSchedule($request){
    //delete all and re-insert based on pmt made
    global $db, $logger;
    $sql = "DELETE FROM employeeloanpmt WHERE paid = 0 AND employeeLoanOid =". $request['loanOid'];
    $db->query($sql);
    $logger->debug("deletUnpaidPmtSchedule()", $db->getLastQuery()); 
    if ($db->getLastErrno() === 0) {
        return;
    } else {
        throw new Exception($db->getLastError());
    }    
}
function generateAndSaveNewPmtSchedule($request){
    global $logger, $paymentType;
    $i = 0;
    $schd = Array();
	switch($paymentType){
		case "PAYSLIP":
            $schd['installmentAmtDue'] = $request['amountPaid']; 
            break;
		case "OFFLINE":
            $schd['installmentAmtDue'] = $request['installmentAmtDue'];           
            break;
		default:
            throw new Exception("Invalid paymentType =".$paymentType);
	}    
    $schd['newLoanBalance'] = $request['currentLoanBal'] - $request['amountPaid'];
    $schd['modulasValue'] = $schd['newLoanBalance'] % $schd['installmentAmtDue'];
    $schd['nbrOfNewInstallmemts'] = ($schd['newLoanBalance'] - $schd['modulasValue'])/$schd['installmentAmtDue'];
    $logger->debug("generateAndSaveNewPmtSchedule()", $schd);
    try {
        while ($i < $schd['nbrOfNewInstallmemts']) {
            insertPmtSchedule($request, $schd, $i);
            $i++;
        }
        if ($schd['modulasValue'] > 0) {
            insertModulasAmt($request, $schd['modulasValue']);
        }
    } 
    catch (Exception $e) {
        throw $e->getMessage();
    }    
}

function insertPmtSchedule($request,$schd, $i){
    global $db, $logger;
    $data = Array();
    
    $data['employeeLoanOid'] = $request['loanOid'];
    $data['deductionAmt'] = $schd['installmentAmtDue'];
    $data['balanceAmount'] = $schd['newLoanBalance'] - ($schd['installmentAmtDue']*($i+1));
    $data['paid'] = 0;
    $data['payslipNbr'] = 0;
    $data['dateDeducted'] = '0000-00-00';
    $id = $db->insert('employeeloanpmt', $data);
    $logger->debug("insertPmtSchedule()", $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return $id;
    } else {
        throw new Exception($db->getLastError());
    }    
}

function insertModulasAmt($request, $modulasValue){
    global $db, $logger;
    $data = Array();

    $data['employeeLoanOid'] = $request['loanOid'];
    $data['deductionAmt'] = $modulasValue;
    $data['balanceAmount'] = 0;
    $data['paid'] = 0;
    $data['payslipNbr'] = 0;
    $data['dateDeducted'] = '0000-00-00';
    $id = $db->insert('employeeloanpmt', $data);
    $logger->debug("insertModulasAmt()", $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return $id;
    } else {
        throw new Exception($db->getLastError());
    }     
}