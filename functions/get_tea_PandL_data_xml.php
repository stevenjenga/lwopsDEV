<?php

require_once('functions.php');

function loadTeaPandLincomeGrid($monthOidsArray){
    global $db,$logger;
    
    $sql ="SELECT oid, lineOfBusinessOid, opsMonthlyCalendarOid, factoryWeight, factoryPurchaseRate, factoryBonus, purchasesRoundup, "
        . "purchasesFertilizer, purchasesDeliveryBook, otherPurchases, salaryExpenses, casualsBonusExpenses, fteBonusExpenses, fteSalaryExpenses, "
        . "nbrOfTrips, tripExpenses, labourTeaPickersExpenses, labourOtherWorkExpenses, labourParttimeExpenses, pruningExpenses, cessExpenses, "
        . "looseTeaPurchases, teaBagPurchases, generalExpenses, elecExpenses "
        . "FROM teapandl "
        . "WHERE opsMonthlyCalendarOid IN (".$monthOidsArray.") " 
        . "ORDER BY TeaPandL.opsMonthlyCalendarOid ASC ";

    $rows = $db->query($sql);
    $logger->debug('loadPandLincomeGrid()', $db->getLastQuery()); 
    
    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    /* start output of data */
    echo '<rows id="0">';
    echo  '	<head>
            <column width="70" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >MONTH'.getCurrentYearMonthsList().'</column>	
            <column width="90" type="kenyaCurrencyro" align="right" sort="str">INCOME Sales</column>
            <column width="90" type="kenyaCurrencyro" align="right" sort="str">PURCHASES RoundUp</column>
            <column width="90" type="kenyaCurrencyro" align="right" sort="str">PURCHASES Fertilizer</column>
            <column width="80" type="kenyaCurrencyro" align="right" sort="str">PURCHASES Delivery Book</column>
            <column width="75" type="kenyaCurrencyro" align="right" sort="str">PURCHASES Other</column>
            <column width="100" type="kenyaCurrencyro" align="right" sort="str">BONUS</column>
            <column width="100" type="kenyaCurrencyro" align="right" sort="str">GROSS PROFIT</column>
            <column width="95" type="kenyaCurrencyro" align="right" sort="str">EXPENSES Transport</column>
            <column width="90" type="kenyaCurrencyro" align="right" sort="str">EXPENSES Tea Pickers</column>
            <column width="90" type="kenyaCurrencyro" align="right" sort="str">EXPENSES Parttime Labour</column>
            <column width="90" type="kenyaCurrencyro" align="right" sort="str">EXPENSES Other Work Labour</column>
            <column width="90" type="kenyaCurrencyro" align="right" sort="str">EXPENSES Pruning</column>
            <column width="90" type="kenyaCurrencyro" align="right" sort="str">EXPENSES Bonus</column>
            <column width="90" type="kenyaCurrencyro" align="right" sort="str">EXPENSES Salaries</column>
            <column width="80" type="kenyaCurrencyro" align="right" sort="str">EXPENSES Cess</column>
            <column width="80" type="kenyaCurrencyro" align="right" sort="str">EXPENSES Made Tea</column>
            <column width="80" type="kenyaCurrencyro" align="right" sort="str">EXPENSES General</column>
            <column width="80" type="kenyaCurrencyro" align="right" sort="str">EXPENSES Electricity</column>
            <column width="100" type="kenyaCurrencyro" align="right" sort="str">TOT EXPENSES</column>
            <column width="100" type="kenyaCurrencyro" align="right" sort="str">NET PROFIT</column>
        </head>';
    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['oid']."'>");
            print("<cell><![CDATA[".$row['opsMonthlyCalendarOid']."]]></cell>");
            print("<cell><![CDATA[".$row['factoryWeight']."]]></cell>");
            print("<cell><![CDATA[".$row['purchasesRoundup']."]]></cell>");
            print("<cell><![CDATA[".$row['purchasesFertilizer']."]]></cell>");
            print("<cell><![CDATA[".$row['purchasesDeliveryBook']."]]></cell>");
            print("<cell><![CDATA[".$row['otherPurchases']."]]></cell>");
            print("<cell><![CDATA[".$row['factoryBonus']."]]></cell>");
            print("<cell><![CDATA[".'0'."]]></cell>");
            print("<cell><![CDATA[".$row['labourTeaPickersExpenses']."]]></cell>");
            print("<cell><![CDATA[".$row['tripExpenses']."]]></cell>");   
            print("<cell><![CDATA[".$row['labourParttimeExpenses']."]]></cell>");
            print("<cell><![CDATA[".$row['labourOtherWorkExpenses']."]]></cell>");
            print("<cell><![CDATA[".$row['pruningExpenses']."]]></cell>");
            $totBonusExpenses = $row['casualsBonusExpenses']+$row['fteBonusExpenses'];
            print("<cell><![CDATA[".$totBonusExpenses."]]></cell>");
            print("<cell><![CDATA[".$row['fteSalaryExpenses']."]]></cell>");
            print("<cell><![CDATA[".$row['cessExpenses']."]]></cell>");
            $totMadeTeaExpenses = $row['looseTeaPurchases']+$row['teaBagPurchases'];
            print("<cell><![CDATA[".$totMadeTeaExpenses."]]></cell>");             
            print("<cell><![CDATA[".$row['generalExpenses']."]]></cell>");   
            print("<cell><![CDATA[".$row['elecExpenses']."]]></cell>"); 
            print("<cell><![CDATA[".'0'."]]></cell>");
            print("<cell><![CDATA[".'0'."]]></cell>");
            print("</row>");

        }
    }
    echo '</rows>';
}

?>