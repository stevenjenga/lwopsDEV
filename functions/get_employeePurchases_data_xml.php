<?php
require_once('functions.php');
require_once('get_payslip_functions.php');
global $db,$logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug('GET', $_GET);
    $payingForPurchase = filter_input(INPUT_GET, 'payingForPurchase', FILTER_SANITIZE_SPECIAL_CHARS);
    if ($payingForPurchase) {
        $purchaseOid = filter_input(INPUT_GET, 'oid', FILTER_SANITIZE_SPECIAL_CHARS);
        getPayingForPurchaseFormData($purchaseOid);
    } else {   
        $date= filter_input(INPUT_GET, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
        loadEmployeePurchasesGrid($date);
    }
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function getPayingForPurchaseFormData($purchaseOid){
    global $db,$logger;
    $rows = $db->query("SELECT employeepurchases.oid, DATE(purchaseDt) AS purchaseDt, quantity, productUnit, "
        . "employeepurchases.description, unitPrice, salary.employeetype AS empType "
        . "FROM employeepurchases INNER JOIN (employee, salary, employeetype) "
            . "ON ( employee.oid = employeepurchases.employeeOid "
                . "AND salary.employeeOid = employee.oid "
                . "AND salary.employeetype = employeetype.type ) "
        . "WHERE employeepurchases.oid = $purchaseOid");

    $logger->debug('getPayingForPurchaseFormData()', $db->getLastQuery());
    if ($db->getLastErrno() != 0) {
        throw new Exception("getPayingForPurchaseFormData()", $db->getLastError());
    }

    header("Content-type: text/xml");
    echo ('<?xml version="1.0" encoding="utf-8"?>');
    foreach($rows as $row){
        print('<data>'); //
            print('<amount>'.$row["quantity"]*$row["unitPrice"].'</amount>');
            print('<descr>'.'Purchase made on '.$row["purchaseDt"]. ' - '.$row["quantity"].$row["productUnit"].' of '.$row["description"].'</descr>');
            print('<purchaseOid>'.$row["oid"].'</purchaseOid>');
            print('<empType>'.$row["oid"].'</empType>');
        print('</data>');
    }    
}

function loadEmployeePurchasesGrid($purchaseDate){
    global $db,$logger;

    $sql = "SELECT DISTINCT employeepurchases.oid, purchaseDt, employeepurchases.employeeOid, "
        . "CONCAT( firstName, ' ', middleInitial, ' ', lastName ) AS employeeName, quantity, productUnitType, "
        . "employeepurchases.description, unitPrice, (quantity * unitPrice) AS total, lineOfBusinessOid, paidFlg "
        . "FROM employeepurchases "
        . "INNER JOIN (employee, employeetype) ON ( employee.oid = employeepurchases.employeeOid ) ";
    if(isset($purchaseDate)){
        $sql .= "WHERE purchaseDt = '$purchaseDate'";
    }
    $rows = $db->query($sql);
    $logger->debug("loadEmployeePurchasesGrid()", $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    /* start output of data */
    echo '<rows id="0">';
    echo  '	<head>
            <column width="120" type="dhxCalendar"  align="left" sort="str" >Purchase Date</column>	
            <column width="150" type="coro"  text="" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Employee Name'.getEmployeeNamesList().'</column>
            <column width="75" type="ed" align="right" sort="str">Quantity</column>
            <column width="60" type="coro"  text="" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Unit'.getPurchaseUnitList().'</column>
            <column width="150" type="ed" align="left" sort="str">Description</column>
            <column width="200" type="coro"  text="" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Line of Business'.getLOBnamesList().'</column>        
            <column width="90" type="kenyaCurrency" align="right" sort="str">Unit Price</column>
            <column width="90" type="kenyaCurrencyro" align="right" sort="str">Total</column>
            <column width="45" type="acheckro" align="middle" sort="str">Paid?</column>
            <column width="120" type="payForPurchasesBtn" align="middle" sort="str">Pay with Payslip</column>
            <column width="0" type="ro" align="middle" sort="str"></column>
        </head>';

    if($rows){
        foreach($rows as $row){

            /* create xml tag for grid's row */

            echo ("<row id='".$row['oid']."'>");
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['purchaseDt']))."]]></cell>");
            print("<cell><![CDATA[".$row['employeeName']."]]></cell>");
            print("<cell><![CDATA[".$row['quantity']."]]></cell>");
            print("<cell><![CDATA[".$row['productUnitType']."]]></cell>");
            print("<cell><![CDATA[".$row['description']."]]></cell>");
            print("<cell><![CDATA[".$row['lineOfBusinessOid']."]]></cell>");
            print("<cell><![CDATA[".$row['unitPrice']."]]></cell>");
            print("<cell><![CDATA[".$row['total']."]]></cell>");
            print("<cell><![CDATA[".$row['paidFlg']."]]></cell>");
            print("<cell><![CDATA[".''."]]></cell>");
            print("<cell><![CDATA[".$row['paidFlg']."]]></cell>");
            print("</row>");
        }
    }
    echo '</rows>';
}