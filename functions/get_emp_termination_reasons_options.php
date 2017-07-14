<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadTerminationReasons();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function loadTerminationReasons() {
    global $db, $logger;

    $sql = "SELECT oid, type, description FROM EmployeeTerminationType";

    $rows = $db->query($sql);
    $logger->debug('loadTerminationReasons()', $db->getLastQuery());
    $logger->debug('loadTerminationReasons()', $rows);
    header("Content-type: text/xml");
	echo ('<?xml version="1.0" encoding="utf-8"?>');
        echo ('<complete>');
        if($rows){
            foreach($rows as $row){
                echo ('<option value="'.$row['oid'].'">'.$row['type'].'</option>');
            }
        }    
        echo ('</complete>');
}