<?php
require_once('functions.php');
global $db;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadFactoryRateGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadFactoryRateGrid() {
    global $db, $logger;
    
    $sql = "SELECT oid, rate, startOpsMonthlyCalendarOid, endOpsMonthlyCalendarOid FROM TeaFactoryRate";

    $rows = $db->query($sql);
    $logger->debug('loadFactoryRateGrid()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    /* start output of data */
    echo '<rows id="0">';
    echo  '	<head>
            <column width="100" type="kenyaCurrency" align="left" sort="str" >Rate</column>
            <column width="85" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >Effective Date' . getCurrentYearMonthsList() . '</column>	
            <column width="85" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >End Date' . getCurrentYearMonthsList() . '</column>	
        </head>';

    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['oid']."'>");
            print("<cell><![CDATA[".$row['rate']."]]></cell>");
            print("<cell><![CDATA[".$row['startOpsMonthlyCalendarOid']."]]></cell>");
            print("<cell><![CDATA[".$row['endOpsMonthlyCalendarOid']."]]></cell>");
            print("</row>");
        }
    }
    echo '</rows>';
}