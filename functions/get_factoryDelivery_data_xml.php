<?php
require_once('functions.php');
require_once('get_payslip_functions.php');
global $db,$logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadTeaFactoryDeliveryGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}



function loadTeaFactoryDeliveryGrid(){
    global $db,$logger;
    $sql = "SELECT teafactorydelivery.oid AS tOid, ticketNbr, vehicleOid, registration, consecNbr1, entryDateTm, firstWght, "
        . "consecNbr2, exitDateTm, secondWght, nbrOfTrips, factoryWeight, delNo "
        . "FROM teafactorydelivery "
        . "INNER JOIN vehicle ON vehicle.oid = teafactorydelivery.vehicleOid "
        . "WHERE ";
    if(isset($_REQUEST['date']) ){
        $date = $_REQUEST['date'];
        $sql .= "MONTH(entryDateTm) = MONTH('$date') ";
    }  
    else {
        $sql .= "MONTH(entryDateTm) = MONTH(CURRENT_DATE) ";
    }
    $rows = $db->query($sql);
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    echo '<rows id="0">';
    echo  '	<head>
            <column width="100" type="ed" align="right" sort="str">Ticket No.</column>
            <column width="80" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Vehicle No.'.getVehicleRegList().'</column>
            <column width="100" type="ed" align="right" sort="str">CONSEC_1</column>
            <column width="120" type="dhxCalendarA" align="left" sort="str" >ENTRY Date/TIme</column>
            <column width="100" type="ed" align="right" sort="str">1st Weight</column>
            <column width="100" type="ed" align="right" sort="str">CONSEC_2</column>
            <column width="120" type="dhxCalendar" align="left" sort="str" >EXIT Date/TIme</column>
            <column width="100" type="ed" align="right" sort="str">2nd Weight</column>            
            <column width="50" type="ro" align="right" sort="str">Nbr of Trips</column>
            <column width="100" type="ro" align="right" sort="str">Factory Weight</column>
            <column width="90" type="ed" align="right" sort="str">Delivery No.</column>
        </head>';

    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['tOid']."'>");
            print("<cell><![CDATA[".$row['ticketNbr']."]]></cell>");
            print("<cell><![CDATA[".$row['registration']."]]></cell>");
            print("<cell><![CDATA[".$row['consecNbr1']."]]></cell>");
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['entryDateTm']))."]]></cell>");
            print("<cell><![CDATA[".number_format($row['firstWght'],2,'.','')."]]></cell>");
            
            print("<cell><![CDATA[".$row['consecNbr2']."]]></cell>");
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['exitDateTm']))."]]></cell>");
            print("<cell><![CDATA[".number_format($row['secondWght'],2,'.','')."]]></cell>");
            $netWeight = $row['firstWght'] - $row['secondWght'];
            print("<cell><![CDATA[".$row['nbrOfTrips']."]]></cell>");
            print("<cell><![CDATA[".number_format($netWeight,2,'.','')."]]></cell>");
            print("<cell><![CDATA[".$row['delNo']."]]></cell>");
            print("</row>");
        }
    }
    echo '</rows>';
}