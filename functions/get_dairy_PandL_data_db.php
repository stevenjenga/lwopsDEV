<?php
require_once('functions.php');
global $lineOfBusinessOid, $LOB, $data, $year, $month, $expensesByRole;

function getCooperativeSales($oid){
    global $db,$logger,$data;
    
    $sql = "SELECT IF(SUM(grossPay) IS NULL, 0, grossPay) AS grossPay FROM kiambaadairy WHERE opsMonthlyCalendaOid = $oid";
    $rows = $db->query($sql);
    $logger->debug('getCooperativeSales()', $db->getLastQuery()); 
    if ($rows) {
        foreach ($rows AS $row) {
            $data['cooperativeSales'] = $row['grossPay'] ;
        }
    }
    return; 
}

function getCooperativeDeductions($oid){
    global $db,$logger,$data;
    
    $sql = "SELECT IF(SUM(totalDeductions) IS NULL, 0, totalDeductions) AS totalDeductions FROM kiambaadairy WHERE opsMonthlyCalendaOid = $oid";
    $rows = $db->query($sql);
    $logger->debug('getCooperativeDeductions()', $db->getLastQuery()); 
    if ($rows) {
        foreach ($rows AS $row) {
            $data['cooperativeDeductions'] = $row['totalDeductions'] ;
        }
    }
    return;    
}
