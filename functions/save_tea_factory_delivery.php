<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug('REQUEST', $_REQUEST);

    $db->startTransaction();
    saveTeaFactoryDelivery($_REQUEST);
    $db->commit();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $db->rollback();
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorPopup($e->getMessage());
}

function saveTeaFactoryDelivery($request) {
    global $db, $logger;
    $data = Array();
    $data['ticketNbr'] = $request['ticketNbr'];
    $data['vehicleOid'] = $request['vehicleOid'];
    $data['consecNbr1'] = $request['consecNbr1'];
    $data['entryDateTm'] = $request['entryDateTm'];
    $data['firstWght'] = $request['firstWght'];
    $data['consecNbr2'] = $request['consecNbr2'];
    $data['exitDateTm'] = $request['exitDateTm'];
    $data['secondWght'] = $request['secondWght'];
    $data['delNo'] = $request['delNo'];
    
    if ($data['secondWght'] > $data['firstWght']){
        throw new Exception("2nd weight MUST be greater than 1st weight");
    }
    validateDeliveryTimes($data['entryDateTm'],$data['exitDateTm']);
    $id = $db->insert('teafactorydelivery', $data);
    $logger->debug('saveTeaFactoryDelivery()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return $id;
    } else {
        throw new Exception($db->getLastError());
    }
}

function validateDeliveryTimes($entryDateTm,$exitDateTm){
    global $db, $logger;
    $entry = new DateTime($entryDateTm);
    $exit = new DateTime($exitDateTm);
    if($entry > $exit){
        throw new Exception("Exit date & time MUST be greater Entry date & time");
    }
    return;
}
