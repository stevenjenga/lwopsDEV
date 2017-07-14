<?php

require_once('../functions/functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    getLOBoptions();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function getLOBoptions() {
    global $db, $logger;

    $sql = "SELECT oid, department FROM LineOfBusiness ORDER BY department";

    $rows = $db->query($sql);
    $logger->debug('getLOBoptions()', $db->getLastQuery());
    $logger->debug('getLOBoptions()', $rows);
    header("Content-type: text/xml");
	echo ('<?xml version="1.0" encoding="utf-8"?>');
        echo ('<complete>');
        if($rows){
            foreach($rows as $row){
                echo ('<option value="'.$row['oid'].'">'.$row['department'].'</option>');
            }
        }    
        echo ('</complete>');
}

?>