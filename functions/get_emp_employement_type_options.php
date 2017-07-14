<?php

require_once('../functions/functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadEmpTypeOptions();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function loadEmpTypeOptions() {
    global $db, $logger;

    $sql = "SELECT type, description FROM EmployeeType";

    $rows = $db->query($sql);
    $logger->debug('loadEmpTypeOptions()', $db->getLastQuery());
    $logger->debug('loadEmpTypeOptions()', $rows);
    header("Content-type: text/xml");
	echo ('<?xml version="1.0" encoding="utf-8"?>');
        echo ('<complete>');
        if($rows){
            foreach($rows as $row){
                echo ('<option value="'.$row['type'].'">'.$row['description'].'</option>');
            }
        }    
        echo ('</complete>');
}

?>