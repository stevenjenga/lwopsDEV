<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug("GET",$_GET); 
    $selectedRowID = filter_input(INPUT_GET, 'selectedRowID');
    loadTeaFcatoryStatementGrid($selectedRowID); 
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function loadTeaFcatoryStatementGrid($selectedRowID) {
    global $db, $logger;

    $monthStartDt = getMonthlyCalendarStartAsDateStr($selectedRowID);
    $monthEndDt = getMonthlyCalendarEndAsDateStr($selectedRowID);
    
    $sql = "SELECT oid, entryDateTm, firstWght, secondWght, (firstWght-secondWght) AS netWeight  "
        . "FROM teafactorydelivery "
        . "WHERE entryDateTm BETWEEN '$monthStartDt'  AND '$monthEndDt' ";

    $rows = $db->query($sql);
    $logger->debug('loadTeaFcatoryStatementGrid()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');

    /* start output of data */
    $totFirstWght = 0.0;
    $totSecondWght = 0.0;
    $totNetWeight = 0.0;
    echo '<rows id="0">';
    echo '	<head>
            <column width="80" type="ro" align="right" sort="str">DATE</column>
            <column width="100" type="ro" align="right" sort="str" >1st WEIGHT</column>
            <column width="100" type="ro" align="right" sort="str">2nd WEIGHT</column>        
            <column width="100" type="ro" align="right" sort="str" >NET WEIGHT</column> 
            
        </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['oid'] . "'>");
            print("<cell><![CDATA[" . date('M.d.Y', strtotime($row['entryDateTm'])) . "]]></cell>");
            print("<cell><![CDATA[" . $row['firstWght'] . "]]></cell>"); $totFirstWght = $totFirstWght + $row['firstWght'];
            print("<cell><![CDATA[" . $row['secondWght'] . "]]></cell>"); $totSecondWght = $totSecondWght + $row['secondWght'];
            print("<cell><![CDATA[" . $row['netWeight'] . "]]></cell>"); $totNetWeight = $totNetWeight + $row['netWeight'];
            print("</row>");
        }
        echo ("<row id='" . 'T1' . "'>");
        print("<cell><![CDATA[" . '-' . "]]></cell>");
        print("<cell><![CDATA[<b>" . $totFirstWght . "</b>]]></cell>");
        print("<cell><![CDATA[<b>" . $totSecondWght . "</b>]]></cell>");
        print("<cell><![CDATA[<b>" . $totNetWeight . "</b>]]></cell>");
        print("</row>");
        
        $rate = 20.0;
        echo ("<row id='" . 'T2' . "'>");
        print("<cell><![CDATA[" . ' ' . "]]></cell>");
        print("<cell><![CDATA[" . ' ' . "]]></cell>");
        print("<cell><![CDATA[" . 'FACTORY RATE:' . "]]></cell>");
        print("<cell><![CDATA[<b>" . $rate . "</b>]]></cell>");
        print("</row>"); 
        
        echo ("<row id='" . 'T3' . "'>");
        print("<cell><![CDATA[" . ' ' . "]]></cell>");
        print("<cell><![CDATA[" . ' ' . "]]></cell>");
        print("<cell><![CDATA[" . 'REVENUE:' . "]]></cell>");
        print("<cell><![CDATA[<b>" . $totNetWeight*$rate . "</b>]]></cell>");
        print("</row>");          
    }
    echo '</rows>';
}

?>