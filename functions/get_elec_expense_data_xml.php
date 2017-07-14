<?php
require_once('functions.php');
global $db,$logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadElecExpenseGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadElecExpenseGrid(){
    global $db,$logger;
    
    $sql = "SELECT oid, electricityAccounOid, opsMonthlyCalendarOid, amount "
        . "FROM ElectricityExpense ";

    $rows = $db->query($sql);
    $logger->debug('loadHorticultureSalesGrid()', $db->getLastQuery()); 
    
    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 
    echo '<rows id="0">';
    echo  '	<head>
            <column width="100" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Month'.getCurrentYearMonthsList().'</column>	        
            <column width="110" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >Account'.getElecAccountList().'</column>	
            <column width="120" type="kenyaCurrency" align="right" sort="str">Amount</column>
        </head>';

    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['oid']."'>");
            print("<cell><![CDATA[".$row['opsMonthlyCalendarOid']."]]></cell>");
            print("<cell><![CDATA[".$row['electricityAccounOid']."]]></cell>");
            print("<cell><![CDATA[".$row['amount']."]]></cell>");
            print("</row>");
        }
    }
    else{}
    echo '</rows>';
}
?>