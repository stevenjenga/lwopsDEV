<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadOtherIncomeGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function loadOtherIncomeGrid() {
    global $db, $logger;

    $sql = "SELECT `oid`, `date`, `lineOfBusinessOid`, `description`, `incomeAmt` FROM `otherdeptincome`";

    $rows = $db->query($sql);
    $logger->debug('loadOtherIncomeGrid()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');

    /* start output of data */
    echo '<rows id="0">';
    echo '	<head>
            <column width="100" type="dhxCalendar" align="left" sort="str">Date</column>               
            <column width="200" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Department' .getLOBnamesList(). '</column>	
            <column width="300" type="ed" align="left" sort="str">Description</column>
            <column width="120" type="kenyaCurrency" align="right" sort="str" >Income Amount</column>
        <column width="90" type="dbDeleteRowBtn" align="middle" sort="str">Delete?</column>            
        </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['oid'] . "'>");
            print("<cell><![CDATA[" . date('M.d.Y', strtotime($row['date'])) . "]]></cell>");
            print("<cell><![CDATA[" . $row['lineOfBusinessOid'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['description'] . "]]></cell>");            
            print("<cell><![CDATA[" . $row['incomeAmt'] . "]]></cell>");
            print("<cell><![CDATA[".''."]]></cell>");
            print("</row>");
        }
    } else {
        
    }
    echo '</rows>';
}

?>