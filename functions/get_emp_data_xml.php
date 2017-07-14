<?php
require_once('functions.php');
global $db,$logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadEmployeeMasterRollGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadEmployeeMasterRollGrid(){
    global $db, $logger;    
    $sql = "SELECT employee.oid, firstName, middleInitial, lastName, role, nationalID, mobileNbr, resident, "
        . "elecDeduction, ePayment, active, startDt, `terminated`, gender, salary.employeetype AS empType "
        . "FROM employee "
        . "INNER JOIN employeerole ON employeerole.employeeOid = employee.oid "
        . "INNER JOIN employeeroletype ON employeeroletype.oid = employeerole.employeeRoleTypeOid "
        . "INNER JOIN salary on salary.employeeOid = employee.oid "
        . "ORDER BY firstName, lastName, nationalID ";
    $rows = $db->query($sql);
    $logger->debug('loadEmployeeMasterRollGrid()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 
    echo '<rows id="0">';
    echo  '	<head>
            <column width="110" type="edtxt" align="left" sort="str">First Name</column>
            <column width="50" type="edtxt" align="left" sort="str">Initial</column>
            <column width="110" type="edtxt" align="left" sort="str">Last Name</column>
            <column width="110" type="ro" align="left" sort="str">Current Role</column>
            <column width="100" type="edtxt" align="left" sort="ed">National ID</column>
            <column width="120" type="ed" align="left" sort="int">Mobile Nbr.</column>
            <column width="75" type="acheck" align="left" sort="str">Resident?</column>
            <column width="75" type="acheck" align="left" sort="str">Deduct Elec?</column>
            <column width="50" type="acheck" align="left" sort="str">Active</column>getEmployeeGenderList()
            <column width="90" type="ro" align="middle" sort="date">Hire Date</column>
            <column width="60" type="coro" text="some text" filter="true" align="middle" editable="false" auto="true"  sort="str" xmlcontent="1" >Gender'.getEmployeeGenderList().'</column>
            <column width="80" type="acheckro" align="middle" sort="date">Terminated</column>	
            <column width="90" type="terminateEmployeeBtn" align="middle" sort="str">Terminate</column>
            <column width="0" type="ro" align="middle" sort="str"></column>	
        </head>';

    if($rows){
        foreach($rows as $row){		
            echo ("<row id='".$row['oid']."'>");
            print("<cell><![CDATA[".$row['firstName']."]]></cell>");
            print("<cell><![CDATA[".$row['middleInitial']."]]></cell>");
            print("<cell><![CDATA[".$row['lastName']."]]></cell>");
            print("<cell><![CDATA[".$row['role']."]]></cell>");
            print("<cell><![CDATA[".$row['nationalID']."]]></cell>");
            print("<cell><![CDATA[".$row['mobileNbr']."]]></cell>");
            print("<cell><![CDATA[".$row['resident']."]]></cell>");
            print("<cell><![CDATA[".$row['elecDeduction']."]]></cell>");
            print("<cell><![CDATA[".$row['active']."]]></cell>");
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['startDt']))."]]></cell>");
            print("<cell><![CDATA[".$row['gender']."]]></cell>");
            print("<cell><![CDATA[".$row['terminated']."]]></cell>");
            print("<cell><![CDATA[".''."]]></cell>");
            print("<cell><![CDATA[".$row['empType']."]]></cell>");
            print("</row>");
        }
    }
    echo '</rows>';
}