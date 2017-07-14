<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug('REQUEST', $_REQUEST);
    savePurchasePmt($_REQUEST);
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage());
}

function savePurchasePmt($request) {
    global $db, $logger;

    $data = Array();
    $data['payslipNbr'] = $request['payslipNbr'];
    $data['paidFlg'] = 1;
    $db->where('oid', $request['purchaseOid']);
    $db->update('employeepurchases', $data);
    $logger->debug('savePurchasePmt())', $db->getLastQuery());
    if ($db->getLastErrno() === 0)
        return;
    else
        throw new Exception($db->getLastError()); 
}

