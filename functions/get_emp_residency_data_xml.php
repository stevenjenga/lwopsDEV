<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadEmpResidencyData();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function loadEmpResidencyData() {
    global $db, $logger;

    $sql = "SELECT `oid`, `employeeOid`, `effectiveDt`, `endDt`, deductionAmt FROM `employeeresidency` ";

    $rows = $db->query($sql);
    $logger->debug('loadEmpResidencyData()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');

    /* start output of data */
    echo '<rows id="0">';
    echo '	<head>
            <column width="150" type="coro" text="" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >Employee' . getEmployeeNamesList() . '</column>	
            <column width="120" type="dhxCalendar"  align="left" sort="str" >Effective Date</column>	
            <column width="110" type="dhxCalendar" align="right" sort="str">End Date</column>        
            <column width="110" type="ed" align="right" sort="str">Rate</column> 
        </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['oid'] . "'>");
            print("<cell><![CDATA[" . $row['employeeOid'] . "]]></cell>");
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['effectiveDt']))."]]></cell>");
            if (!is_null($row['endDt'])) {
                print("<cell><![CDATA[".date('M.d.Y', strtotime($row['endDt']))."]]></cell>"); 
            }
            else {
                print("<cell><![CDATA[".''."]]></cell>");
            }
            print("<cell><![CDATA[" . $row['deductionAmt'] . "]]></cell>");
            print("</row>");
        }
    } 
    echo '</rows>';
}