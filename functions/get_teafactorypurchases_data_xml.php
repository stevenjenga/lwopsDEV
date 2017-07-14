<?php
require_once('functions.php');
global $db;
global $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    loadTeaFactoryPurchasesGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function teaFactoryPurchaseTypesList(){
    global $db;
	global $logger;
    $listObj=  $db->query("SELECT type, unit FROM teafactorypurchasetype");
    $theList = '';
    if($listObj){
        foreach($listObj as $row){ 
            $id = $row["type"];
            $displayValues = $row["type"];
            $theList .= "<option value='".$id."'>".$displayValues."</option>";
        }
    } 
    $logger->debug('getElecAccountList()',$db->getLastQuery());
    return $theList;    
}

function loadTeaFactoryPurchasesGrid() {
    global $db;
    global $logger;  
    
    $sql = "SELECT oid, purchaseDt, purchaseType, quantity, unit, unitPrice, (quantity*unitPrice) AS totCost "
        . "FROM TeaFactoryPurchases "
        . "INNER JOIN teafactorypurchasetype ON teafactorypurchasetype.type = teafactorypurchases.purchaseType";
    $date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
    if(isset($date)){
        $sql .= "WHERE purchaseDt = '$date'";
    }
  
    $rows = $db->query($sql);
    $logger->debug('loadTeaFactoryPurchasesGrid()', $db->getLAstQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 
    echo '<rows id="0">';
    echo  '	<head>
            <column width="90" type="dhxCalendar" align="left" sort="str" >Purchase Date</column>
            <column width="120" type="coro" text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1">Purchase Type'.teaFactoryPurchaseTypesList().'</column>	
            <column width="60" type="ed" align="right" sort="str">Quantity</column>
            <column width="40" type="ro" align="left" sort="str">Unit</column>
            <column width="75" type="kenyaCurrency" align="right" sort="str">Unit Cost</column>
            <column width="100" type="kenyaCurrencyro" align="right" sort="str">Total Cost</column>
            </head>';

//    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['oid']."'>");	
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['purchaseDt']))."]]></cell>");
            print("<cell><![CDATA[".$row['purchaseType']."]]></cell>");
            print("<cell><![CDATA[".$row['quantity']."]]></cell>");
            print("<cell><![CDATA[".$row['unit']."]]></cell>");
            print("<cell><![CDATA[".$row['unitPrice']."]]></cell>");
            print("<cell><![CDATA[".$row['totCost']."]]></cell>");
            print("</row>");
        }
//    }else{
//        throw new Exception("loadTeaFactoryPurchasesGrid(): NO DATA FOUND");
//    }
    echo '</rows>';
}