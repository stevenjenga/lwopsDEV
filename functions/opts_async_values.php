<?php
require_once('functions.php');
global $db;
global $logger;
$logger->debug("XXXXXX()", $_GET);
$empOid = filter_input(INPUT_GET, 'empOid', FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = "SELECT oid, firstName, middleInitial, lastName, employeeRoleOid, nationalID, mobileNbr, resident, elecDeduction, "
        . "ePayment, active, startDt, gender, comment "
        . "FROM employee "
        . "WHERE oid = $empOid ";

    $rows = $db->query($sql);
    $logger->debug("XXXXXX()", $db->getLastQuery());
    
header("Content-Type: text/xml");

echo ('<?xml version="1.0" encoding="utf-8"?>');
foreach($rows as $row){
	print('<data>');
		print('<fname>'.$row['firstName'].'</fname>');
		print('<lname>'.$row['lastName'].'</lname>');
		print('<natID>'.$row['nationalID'].'</natID>');
        
	print('</data>');
}
?>