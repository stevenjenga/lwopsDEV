<?php

require_once('../functions/functions.php');
global $db,$logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadVehicleExpenseGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadVehicleExpenseGrid() {
    global $db, $logger;

    $sql = "SELECT VehicleExpense.oid AS oid, date, vehicleOid, registration, payee, narration, amount, expenseCategoryOid "
        . "FROM VehicleExpense "
        . "INNER JOIN vehicle ON VehicleExpense.vehicleOid = vehicle.oid  "
        . "ORDER BY date ASC";

    $rows = $db->query($sql);
    $logger->debug('loadVehicleExpenseGrid()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');

    /* start output of data */
    echo '<rows id="0">';
    echo '	<head>
            <column width="120" type="dhxCalendar"  align="left" sort="str" >Expense Date</column>	
            <column width="85" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >Registration' . getVehicleRegList() . '</column>	
            <column width="150" type="ed" align="left" sort="str">Payee</column>
            <column width="150" type="ed" align="left" sort="str">Narration</column>
            <column width="100" type="kenyaCurrency" align="right" sort="str">Amount</column>
            <column width="100" type="coro"  text="" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">PandL Category'.getExpenseCategoryList().'</column>
        </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['oid'] . "'>");
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['date']))."]]></cell>");
            print("<cell><![CDATA[" . $row['registration'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['payee'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['narration'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['amount'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['expenseCategoryOid'] . "]]></cell>");
            print("</row>");
        }
    } else {
        
    }
    echo '</rows>';
}

?>