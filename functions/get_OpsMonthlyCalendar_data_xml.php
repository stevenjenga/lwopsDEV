<?php
require_once('../functions/functions.php');
global $db;
global $logger;
try {	
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));

    $fteAdvance = filter_input(INPUT_GET, 'fteAdvance', FILTER_SANITIZE_SPECIAL_CHARS);
    $chkBox = filter_input(INPUT_GET, 'chkBox', FILTER_SANITIZE_SPECIAL_CHARS);
    $logger->debug('[GET]', ['fteAdvance'=>$fteAdvance, 'chkBox'=>$chkBox]);
    loadMonthsCalendarGrid($fteAdvance,$chkBox);
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}    
    
function loadMonthsCalendarGrid($fteAdvance,$chkBox){ 
    global $db,$logger;    
    if ($fteAdvance){
        $sql = "SELECT oid, month, year, 0 AS flag "
            . "FROM opsmonthlycalendar "
            . "WHERE (monthNbr = MONTH(CURRENT_DATE) OR monthNbr = MONTH(CURRENT_DATE)+1) "
            . "AND year = YEAR(CURRENT_DATE) ";
    } 
    else{
        $sql = "SELECT oid, month, year, 0 AS flag FROM opsmonthlycalendar WHERE year = YEAR(CURRENT_DATE)";
    }
    $rows = $db->query($sql);
    $logger->debug('loadMonthsCalendarGrid()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    echo '<rows id="0">';
    if ($chkBox){
        echo  '	<head>		
                <column width="50" type="ro" align="right" sort="str">Month</column>	
                <column width="60" type="ro" align="left" sort="str">Year</column>		
                <column width="40" type="ch" align="left" sort="str"></column>
            </head>';
    }
    else {
        echo  '	<head>		
                <column width="50" type="ro" align="right" sort="str">Month</column>	
                <column width="60" type="ro" align="left" sort="str">Year</column>		
                <column width="40" type="ra" align="left" sort="str"></column>
            </head>';
    }	

    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['oid']."'>");
            print("<cell><![CDATA[".$row['month']."]]></cell>");		
            print("<cell><![CDATA[".$row['year']."]]></cell>");		
            print("<cell><![CDATA[".$row['flag']."]]></cell>");
            print("</row>");
        }
    }
    echo '</rows>';
}