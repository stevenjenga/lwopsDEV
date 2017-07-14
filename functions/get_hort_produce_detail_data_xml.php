<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadProduceTypes();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function loadProduceTypes() {
    global $db, $logger;

    $sql = "SELECT oid, horticultureProduceParentoid, brand, variety, directPlanting, nurseryDuration, avgMaturityDays, harvestDurationDays "
        . "FROM HorticultureProduceDetail "
        . "ORDER BY variety,brand";

    $rows = $db->query($sql);
    $logger->debug('loadProduceTypes()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');

    /* start output of data */
    echo '<rows id="0">';
    echo '	<head>
            <column width="100" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >Parent' . getHortProduceParentList() . '</column>	
            <column width="100" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >Brande Name' . getHortBrandList() . '</column>	
            <column width="100" type="ed" align="right" sort="str">Varierty</column>
            <column width="100" type="acheck" align="left" sort="str" >Direct Planting</column>
            <column width="100" type="ed" align="left" sort="str">Nursery Duration</column>        
            <column width="100" type="ed" align="left" sort="str" >Avg. Maturity Days</column> 
            <column width="100" type="ed" align="left" sort="str" >Harvest Duration Days</column>             
        </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['oid'] . "'>");
            print("<cell><![CDATA[" . $row['horticultureProduceParentoid'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['brand'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['variety'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['directPlanting'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['nurseryDuration'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['avgMaturityDays'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['harvestDurationDays'] . "]]></cell>");            
            print("</row>");
        }
    } else {}
    echo '</rows>';
}