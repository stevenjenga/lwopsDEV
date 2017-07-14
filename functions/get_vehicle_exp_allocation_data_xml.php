<?php

require_once('../functions/functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadVehicleExpenseAllocationGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function loadVehicleExpenseAllocationGrid() {
    global $db, $logger;

    $sql = "SELECT VehicleExpenseAllocation.oid AS oid, vehicleOid, registration, lineOfBusinessOid, allocation, "
        . "startOpsMonthlyCalendarOid, endOpsMonthlyCalendarOid "
        . "FROM VehicleExpenseAllocation "
        . "INNER JOIN vehicle ON VehicleExpenseAllocation.vehicleOid = vehicle.oid "
        . "GROUP BY registration "
        . "ORDER BY registration";

    $rows = $db->query($sql);
    $logger->debug('loadVehicleExpenseAllocationGrid()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');

    /* start output of data */
    echo '<rows id="0">';
    echo '	<head>
            <column width="120" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >Registration' . getVehicleRegList() . '</column>	
            <column width="150" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >Deprtament' . getLOBnamesList() . '</column>	
            <column width="75" type="ed" align="left" sort="str">Allocation(%)</column>
            <column width="100" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1">Effective Date'.getMonthlyCalendarDatesList().'</column>	
            <column width="100" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1">End Date'.getMonthlyCalendarDatesList().'</column>	
            </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['oid'] . "'>");
            print("<cell><![CDATA[" . $row['registration'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['lineOfBusinessOid'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['allocation'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['startOpsMonthlyCalendarOid'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['endOpsMonthlyCalendarOid'] . "]]></cell>");
            print("</row>");
        }
    } else {
        
    }
    echo '</rows>';
}

?>