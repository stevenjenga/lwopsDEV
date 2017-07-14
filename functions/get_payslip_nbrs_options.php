<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug('_GET', $_GET);
    loadPayslipNbrs(filter_input(INPUT_GET, 'employeeType', FILTER_SANITIZE_SPECIAL_CHARS));
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
}

function loadPayslipNbrs($employeeType) {
    global $db, $logger;
    $sql = '';
	switch($employeeType){
		case "C":
			$sql = "SELECT DISTINCT payslipNbr FROM casualemployeepayslip WHERE lockedFlg = 1";
            break;
		case "S":
			$sql = "SELECT DISTINCT payslipNbr FROM fteemployeepayslip WHERE lockedFlg = 1";            
            break;
		case "F":
            throw new Exception("loadPayslipNbrs() - Invalid employye type 'F'");
	}
    $rows = $db->query($sql);    
    if ($db->getLastErrno() != 0) {
        throw new Exception("loadPayslipNbrs()". $db->getLastError());
    }    


    $logger->debug('loadPayslipNbrs()', $db->getLastQuery());
    $logger->debug('loadPayslipNbrs()', $rows);
    header("Content-type: text/xml");
	echo ('<?xml version="1.0" encoding="utf-8"?>');
        echo ('<complete>');
        if($rows){
            foreach($rows as $row){
                echo ('<option value="'.$row['payslipNbr'].'">'.$row['payslipNbr'].'</option>');
            }
        }    
        echo ('</complete>');
}

