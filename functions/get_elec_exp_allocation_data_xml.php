<?php
require_once('functions.php');
global $db,$logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadElecExpenseAllocationGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, P>_prepareQueryATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadElecExpenseAllocationGrid(){

    global $db,$logger;
    $sql = "SELECT electricityallocation.oid AS oid, lineOfBusinessOid, electricityAccountOid, CONCAT(' ',accountNbr, ' ') AS accountNbr, department, allocation, "
        . "startOpsMonthlyCalendarOid, endtOpsMonthlyCalendarOid "
        . "FROM electricityallocation "
        . "INNER JOIN lineofbusiness ON lineofbusiness.oid = electricityallocation.lineOfBusinessOid "
        . "INNER JOIN electricityaccount ON electricityaccount.oid = electricityallocation.electricityAccountOid "
        . "ORDER BY allocation ASC ";
    
    $rows = $db->query($sql);
    $logger->debug('loadElecExpenseAllocationGrid()', $db->getLastQuery());
            logStart("HERE XXXXXXXXXXXXXXXXX");
    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 
    echo '<rows id="0">';
    echo  '	<head>
            <column width="100" type="coro"  text="" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Account'.getElecAccountList().'</column>		
            <column width="190" type="coro"  text="" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Department'.getLOBnamesList().'</column>	
            <column width="70" type="ed" align="right" sort="str">Allocation %</column>
            <column width="80" type="coro"  text="" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1">Start Date'.getCurrentYearMonthsList().'</column>	
            <column width="80" type="coro"  text="" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1">End Date'.getCurrentYearMonthsList().'</column>	
        </head>';

    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['oid']."'>");
            print("<cell><![CDATA[".$row['accountNbr']."]]></cell>");           
            print("<cell><![CDATA[".$row['department']."]]></cell>");
            print("<cell><![CDATA[".$row['allocation']."]]></cell>");		
            print("<cell><![CDATA[".$row['startOpsMonthlyCalendarOid']."]]></cell>");		
            print("<cell><![CDATA[".$row['endtOpsMonthlyCalendarOid']."]]></cell>");		
            
            print("</row>");
        }
    }else{
    }
    echo '</rows>';
}