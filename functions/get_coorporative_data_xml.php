<?php
require_once('../functions/functions.php');
global $db,$logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadDairyCorpSalesGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()."<br> [".$e->getLine()."]</b>");
}

function loadDairyCorpSalesGrid(){
    global $db,$logger;
    $sql = "SELECT oid, opsMonthlyCalendaOid, societyShares, packingShares, feedExpense, totalDeductions, rate, "
        . "deliveredQty, rejectedQty, acceptedQty, grossPay, netPay, society, packing "
        . "FROM kiambaaDairy";
    $rows = $db->query($sql);
    
    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 
    echo '<rows id="0">';
    echo  '	<head>
            <column width="80" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >MONTH'.getCurrentYearMonthsList().'</column>	
            <column width="100" type="kenyaCurrency" align="right" sort="str">SOCIETY SHARES</column>
            <column width="100" type="kenyaCurrency" align="right" sort="str">PACKING SHARES</column>
            <column width="100" type="kenyaCurrency" align="right" sort="str">FEED (STORES)</column>
            <column width="100" type="kenyaCurrencyro" align="right" sort="str">TOTAL DEDUCTIONS</column>
            <column width="100" type="kenyaCurrency" align="right" sort="str">RATE</column>
            <column width="75" type="ed" align="right" sort="str">DELIVERED</column>
            <column width="75" type="ed" align="right" sort="str">REJECTED</column>
            <column width="75" type="ro" align="right" sort="str">ACCEPTED</column>
            <column width="100" type="kenyaCurrencyro" align="right" sort="str">GROSS PAY</column>
            <column width="75" type="kenyaCurrencyro" align="right" sort="str">NET PAYABLE</column>
            <column width="100" type="ed" align="right" sort="str">SOCIETY</column>
            <column width="100" type="ed" align="right" sort="str">PACKING</column>
        </head>';    
    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['oid']."'>");
            print("<cell><![CDATA[".$row['opsMonthlyCalendaOid']."]]></cell>");
            print("<cell><![CDATA[".$row['societyShares']."]]></cell>");
            print("<cell><![CDATA[".$row['packingShares']."]]></cell>");
            print("<cell><![CDATA[".$row['feedExpense']."]]></cell>");
            print("<cell><![CDATA[".$row['totalDeductions']."]]></cell>");
            print("<cell><![CDATA[".$row['rate']."]]></cell>");
            print("<cell><![CDATA[".$row['deliveredQty']."]]></cell>");
            print("<cell><![CDATA[".$row['rejectedQty']."]]></cell>");		
            print("<cell><![CDATA[".$row['acceptedQty']."]]></cell>");		
            print("<cell><![CDATA[".$row['grossPay']."]]></cell>");		
            print("<cell><![CDATA[".$row['netPay']."]]></cell>");
            print("<cell><![CDATA[".$row['society']."]]></cell>");
            print("<cell><![CDATA[".$row['packing']."]]></cell>");
            print("</row>");
        }
    }
    else{}
    echo '</rows>';
}
