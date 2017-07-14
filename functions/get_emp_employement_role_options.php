<?php

require_once('../functions/functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadEmpRoleOptiions();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}
//employeerole
function loadEmpRoleOptiions() {
    global $db, $logger;

    $sql = "SELECT oid, role, description FROM employeeroletype ORDER BY role";

    $rows = $db->query($sql);
    $logger->debug('loadEmpRoleOptiions()', $db->getLastQuery());
    $logger->debug('loadEmpRoleOptiions()', $rows);
    header("Content-type: text/xml");
	echo ('<?xml version="1.0" encoding="utf-8"?>');
        echo ('<complete>');
        if($rows){
            foreach($rows as $row){
                echo ('<option value="'.$row['oid'].'">'.$row['role'].'</option>');
            }
        }    
        echo ('</complete>');
}
?>