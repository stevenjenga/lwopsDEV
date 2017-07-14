<?php
require_once('functions.php');
global $db;
global $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadTeaBonusGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadTeaBonusGrid() {
    global $db;
    global $logger;  
    
    $rows = $db->query("SELECT oid, opsMonthlyCalendarOid, amount FROM TeaBonus");
    $logger->debug('loadTeaBonusGrid', $db->getLAstQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 
    echo '<rows id="0">';
    echo  '	<head>		
            <column width="80" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1">Date'.getMonthlyCalendarDatesList().'</column>	
            <column width="200" type="kenyaCurrency" align="right" sort="str">Amount</column>
            </head>';

    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['oid']."'>");	
            print("<cell><![CDATA[".$row['opsMonthlyCalendarOid']."]]></cell>");
            print("<cell><![CDATA[".$row['amount']."]]></cell>");
            print("</row>");
        }
    }
    echo '</rows>';
}