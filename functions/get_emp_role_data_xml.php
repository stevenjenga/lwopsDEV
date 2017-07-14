<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadEmployeeRoleGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function loadEmployeeRoleGrid() {
    global $db, $logger;

    $sql = "SELECT employeerole.oid AS erOid, CONCAT(employee.firstName,' ', employee.middleInitial,' ',employee.lastName) AS employeeNm, "
        . "role, description, employeeroletype.oid AS rOid, effectiveDt, endDt, employee.oid AS empOid  "
        . "FROM EmployeeRole "
        . "INNER JOIN employee ON employee.oid = employeerole.employeeOid "
        . "INNER JOIN employeeroletype ON employeeroletype.oid = employeerole.employeeRoleTypeOid "
        . "ORDER BY employeeNm";

    $rows = $db->query($sql);
    $logger->debug('loadEmployeeRoleGrid()', $db->getLastQuery());
    
    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');

    /* start output of data */
    echo '<rows id="0">';
    echo '	<head>
            <column width="120" type="ro" align="right" sort="str">Employee Name</column>
            <column width="120" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >ROLE'.getEmployeeRolesList().'</column>	            
            <column width="80" type="dhxCalendar" align="right" sort="str">Effective Date</column>
            <column width="80" type="dhxCalendar" align="right" sort="str">End date</column>
            <column width="0" type="ro" align="right" sort="str"></column>
        </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['erOid'] . "'>");
            print("<cell><![CDATA[" . $row['employeeNm'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['role'] . "]]></cell>");
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['effectiveDt']))."]]></cell>");
            if($row['endDt']!=NULL){
                $endDate = date('M.d.Y', strtotime($row['endDt']));
            }else{
                $endDate="";
            }            
            print("<cell><![CDATA[".$endDate."]]></cell>"); //
            print("<cell><![CDATA[" . $row['empOid'] . "]]></cell>");
            print("</row>");
        }
    } else {
        
    }
    echo '</rows>';
}

?>