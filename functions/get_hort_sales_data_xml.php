<?php
require_once('../functions/functions.php');
global $db,$logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadHorticultureSalesGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadHorticultureSalesGrid(){
    global $db,$logger;
    
    $sql = "SELECT horticulturesales.oid AS hsOid, salesDt, customerOid, lineOfBusinessOid, horticultureProduceParentOid, quantity, unit, unitPrice, "
        . "(quantity*unitPrice) AS totPrice "
        . "FROM horticulturesales "
        . "INNER JOIN customer ON customer.oid = horticulturesales.customerOid "
        . "INNER JOIN horticultureproduceparent ON horticultureproduceparent.oid = horticulturesales.horticultureProduceParentOid ";

    if(isset($_REQUEST['date']) ){
        $date = $_REQUEST['date'];
        $sql .= " WHERE DATE(horticulturesales.salesDt)='$date'";
    }

    $rows = $db->query($sql);
    $logger->debug('loadHorticultureSalesGrid()', $db->getLastQuery()); 
    
    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    /* start output of data */
    echo '<rows id="0">';
    echo  '	<head>
            <column width="100" type="dhxCalendar" align="left" sort="str" >Sales Date</column>
            <column width="250" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Business/Customer Name'.getCustomerNamesList().'</column>	
            <column width="190" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Department'.getLOBnamesList().'</column>	
            <column width="140" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Produce Type'.getHortProduceList().'</column>	                
            <column width="50" type="ed" align="right" sort="str">Qty</column>
            <column width="80" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Sell Unit'.getHortProduceSellUnitList().'</column>	
            <column width="100" type="kenyaCurrency" align="right" sort="str">Price/Unit</column>
            <column width="100" type="kenyaCurrency" align="right" sort="str">Tot Price</column>
        </head>';

    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['hsOid']."'>");
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['salesDt']))."]]></cell>");
            print("<cell><![CDATA[".$row['customerOid']."]]></cell>");
            print("<cell><![CDATA[".$row['lineOfBusinessOid']."]]></cell>");
            print("<cell><![CDATA[".$row['horticultureProduceParentOid']."]]></cell>");
            print("<cell><![CDATA[".$row['quantity']."]]></cell>");
            print("<cell><![CDATA[".$row['unit']."]]></cell>");
            print("<cell><![CDATA[".$row['unitPrice']."]]></cell>");
            print("<cell><![CDATA[".$row['totPrice']."]]></cell>");
            print("</row>");
        }
    }
    else{}
    echo '</rows>';
}
?>