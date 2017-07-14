<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadProduceBrands();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage());
}

function loadProduceBrands() {
    global $db, $logger;

    $sql = "SELECT name FROM HorticultureProduceBrand ORDER BY name";

    $rows = $db->query($sql);
    $logger->debug('loadProduceBrands()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');

    /* start output of data */
    echo '<rows id="0">';
    echo '	<head>
            <column width="150" type="ed" align="right" sort="str">BRAND NAME</column>
        </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['name'] . "'>");
            print("<cell><![CDATA[" . $row['name'] . "]]></cell>");
            print("</row>");
        }
    } else {}
    echo '</rows>';
}
