<?php

require_once('../functions/functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    getSalaryFrequency();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function getSalaryFrequency() {
    global $db, $logger;

    $sql = "SELECT type, description FROM SalaryType";

    $rows = $db->query($sql);
    $logger->debug('getSalaryFrequency()', $db->getLastQuery());
    $logger->debug('getSalaryFrequency()', $rows);
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