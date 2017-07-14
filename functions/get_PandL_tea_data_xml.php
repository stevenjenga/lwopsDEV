<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug("REQUEST", $_REQUEST);
    XXX();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function XXX() {
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
            <column width="100" type="kenyaCurrency" align="left" sort="str" >Rate</column>
            <column width="100" type="dhxCalendar" align="left" sort="str">Effective Date</column>        
            <column width="100" type="ro" align="left" sort="str" >End Date</column> 
            
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