<?php

require_once('functions.php');


function loadTerminateEmployeeGrid($empOid) {
    global $db, $logger;

    $sql = "";

    $rows = $db->query($sql);
    $logger->debug('XXX()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');

    /* start output of data */
    echo '<rows id="0">';
    echo '	<head>
            <column width="85" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >MONTH' . getCurrentYearMonthsList() . '</column>	
            <column width="80" type="kenyaCurrencyro" align="right" sort="str">INCOME Sales</column>


        </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['oid'] . "'>");
            print("<cell><![CDATA[" . $row['opsMonthlyCalendarOid'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['salesIncome'] . "]]></cell>");
            print("</row>");
        }
    } else {
        
    }
    echo '</rows>';
}

?>