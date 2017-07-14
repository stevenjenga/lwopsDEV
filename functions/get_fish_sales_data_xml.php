<?php
require_once('functions.php');
global $db;
global $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $_GET);
    loadFishSalesDataGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadFishSalesDataGrid(){
    global $db;
    global $logger;

    if(isset($_REQUEST['date']) ){
    $date=$_REQUEST['date'];	
    }else{
        $date=date('Y-m-d');
    }

    $sql = "SELECT D1.oid, D1.salesDt, D1.customerOid, D1.type, D1.weight, D1.pricePerKg, D2.businessName, D2.storeNameNbr, D3.fishType, "
        . "(D1.weight * D1.pricePerKg) AS totPrice "
        . "FROM fishsales D1 "
        . "INNER JOIN customer D2 ON (D2.oid = D1.customerOid) "
        . "INNER JOIN fishtype D3 ON (D3.fishType = D1.type) ";

    if(isset($_REQUEST['date']) ){
        $sql .= "WHERE DATE(D1.salesDt)='$date'";
    }

    $rows = $db->query($sql);
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->trace);

    $customerObj=  $db->query("SELECT oid, businessName,storeNameNbr FROM customer ");
    $createOptionBusinessName= '';
    if($customerObj){
        foreach($customerObj as $value){ 
            $id=$value["oid"];
            $customerNm = $value["businessName"]." -".$value["storeNameNbr"];
            $createOptionBusinessName.="<option value='".$id."'>".$customerNm."</option>";
        }
    }

    $fishTypeObj=  $db->query("select fishType from fishtype");
    $fishOptions='';
    if($fishTypeObj){
        foreach($fishTypeObj as $value){
            $id=$value['fishType'];
            $fishOptions.="<option value='".$id."'>".$value['fishType']."</option>";
        }
    }

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    /* start output of data */
    echo '<rows id="0">';
    echo  '	<head>
            <column width="100" type="dhxCalendar" align="left" sort="str" >Sales Date</column>
            <column width="250" type="coro" text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Business/Customer Name'.$createOptionBusinessName.'
            </column>	
            <column width="100" type="coro" text="some text" filter="true" align="middle" editable="false" auto="true"  sort="str" xmlcontent="1">Fish Type'.$fishOptions.'</column>
            <column width="75" type="ed" align="right" sort="str">Weight</column>
            <column width="100" type="kenyaCurrency" align="right" sort="str">Price/Kg</column>
                    <column width="100" type="kenyaCurrencyro" align="right" sort="str">Tot Price</column>
        </head>';

    if($rows){
        foreach($rows as $row){
            echo ("<row id='".$row['oid']."'>");
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['salesDt']))."]]></cell>");
            $customerNm = $row["businessName"]." - ".$row["storeNameNbr"];
            print("<cell><![CDATA[".$customerNm."]]></cell>");
            print("<cell><![CDATA[".$row['fishType']."]]></cell>");
            print("<cell><![CDATA[".number_format($row['weight'],2)."]]></cell>");
            print("<cell><![CDATA[".$row['pricePerKg']."]]></cell>");
            print("<cell><![CDATA[".$row['totPrice']."]]></cell>");
            print("</row>");
        }
    }
    else{}
    echo '</rows>';
}