<?php

require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadEmployeeDeductions();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>" . $e->getMessage() . " [" . $e->getLine() . "]</b>");
}

function loadEmployeeDeductions() {
    global $db, $logger;

    $sql = "SELECT `oid`, date, `employeeOid`, `amount`, `description`, `paidFlg`, `payslipNbr` "
        . "FROM `employeeotherdeduction`";

    $rows = $db->query($sql);
    $logger->debug('loadEmployeeDeductions()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');

    /* start output of data */
    echo '<rows id="0">';
    echo '	<head>
            <column width="100" type="dhxCalendar" align="left" sort="str">Effective Date</column>                
            <column width="150" type="coro" text="" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >Employee' . getEmployeeNamesList() . '</column>	
            <column width="100" type="kenyaCurrency" align="right" sort="str">Amount</column>
            <column width="200" type="ed" align="left" sort="str" >Description/Purpose</column>
            <column width="80" type="acheckro" align="left" sort="str">Paid</column>        
            <column width="100" type="ro" align="left" sort="str" >Payslip Nbr</column> 
        </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['oid'] . "'>");
            print("<cell><![CDATA[" . date('M.d.Y', strtotime($row['date'])) . "]]></cell>");
            print("<cell><![CDATA[" . $row['employeeOid'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['amount'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['description'] . "]]></cell>");     
            print("<cell><![CDATA[" . $row['paidFlg'] . "]]></cell>");             
            print("<cell><![CDATA[" . $row['payslipNbr'] . "]]></cell>");
            print("</row>");
        }
    } else {
        
    }
    echo '</rows>';
}

?>