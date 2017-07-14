<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadProduceSellingUnits();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function loadProduceSellingUnits() {
    global $db, $logger;
    $i = 0;
    $sql = "SELECT unit, description FROM HorticultureSellUnit ORDER BY unit";

    $rows = $db->query($sql);
    $logger->debug('loadProduceSellingUnits()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');

    /* start output of data */
    echo '<rows id="0">';
    echo '	<head>
            <column width="80" type="ed" align="right" sort="str">Unit</column>
            <column width="150" type="ed" align="left" sort="str" >Description</column>
        </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['unit'] . "'>");
            print("<cell><![CDATA[" . $row['unit'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['description'] . "]]></cell>");
            print("</row>");
        }
    } else {
        
    }
    echo '</rows>';
}

?>