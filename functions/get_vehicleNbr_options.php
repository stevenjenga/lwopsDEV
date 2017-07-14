<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadVehicleNbrs();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function loadVehicleNbrs() {
    global $db, $logger;

    $sql = "SELECT `oid`, `registration` FROM `vehicle` ORDER BY `vehicle`.`registration` ASC ";

    $rows = $db->query($sql);    
    if ($db->getLastErrno() != 0) {
        throw new Exception("loadVehicleNbrs()". $db->getLastError());
    }    

    $logger->debug('loadVehicleNbrs()', $db->getLastQuery());
    header("Content-type: text/xml");
	echo ('<?xml version="1.0" encoding="utf-8"?>');
        echo ('<complete>');
        if($rows){
            foreach($rows as $row){
                echo ('<option value="'.$row['oid'].'">'.$row['registration'].'</option>');
            }
        }    
        echo ('</complete>');
}

?>