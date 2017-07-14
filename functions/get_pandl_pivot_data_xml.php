<?php
function insertTopLevelDetail($sql){
    global $db, $logger, $lineOfBusinessOid;
    $rows = $db->query($sql);
    $logger->debug('insertTopLevelDetail()', $db->getLastQuery());  
    $i = 0;
    if ($rows) {
        insertRowDetail($i,'INCOME - Sales',$rows,'salesIncome');
        insertRowDetail($i,'INCOME - Other',$rows,'otherIncome');
        insertRowDetail($i,'PURCHASES',$rows,'purchases');
        insertRowDetail($i,'EXPENSES - General',$rows,'generalExpenses');
        insertRowDetail($i,'EXPENSES - Electricity',$rows,'elecExpenses');      
   }   
   return;
}

function insertLaborExpenseDetail($selectedMonthsArray,$sql){
    global $db, $logger, $lineOfBusinessOid;
    
    $rows = $db->query($sql);
    $logger->debug('insertLaborExpenseDetail()', $db->getLastQuery()); 
    if ($rows) {
        $data = [];
        $i = 1;
        foreach ($rows AS $row) {
            if($i <= count($selectedMonthsArray)){
                $data['lineOfBusinessOid'] = $lineOfBusinessOid;
                $data['header'] = $row['role'];
                $index = 'm'.$i++;
                $data[$index] = $row['expenseAmount'];
            }
            else {
                $db->insert ('pandlpivot', $data);
                $logger->debug('insertLaborExpenseDetail()', $db->getLastQuery());                   
                unset($data);
                $i = 1;
                $data['lineOfBusinessOid'] = $lineOfBusinessOid;
                $data['header'] = $row['role'];
                $index = 'm'.$i++;  
                $data[$index] = $row['expenseAmount'];
                               
            }
        }
            $db->insert ('pandlpivot', $data);
            $logger->debug('insertLaborExpenseDetail()', $db->getLastQuery());        
    } 
}

function getOids($selectedMonthsArray, $tableName){
    global $db, $logger;
    $d = '';
    
    $sql = "SELECT oid "
        . "FROM $tableName "
        . "WHERE opsMonthlyCalendarOid IN (".implode(',', $selectedMonthsArray).")";
    $rows = $db->query($sql);
    $logger->debug('getOids()', $db->getLastQuery()); 
    if ($rows) {
        foreach ($rows AS $row) {
            $d .= $row['oid'] . ',';
        }
    }    
    $str = trim($d, ',');
    $logger->debug('getOids()', ['D'=>$d]); 
    return $str;
}


function insertRowDetail($header,$rows, $colName){
    global $db, $logger, $lineOfBusinessOid;
    $data = [];
    $i = 0;
    $data['lineOfBusinessOid'] = $lineOfBusinessOid;
    $data['header'] = $header;
    foreach ($rows as $row) {
        $index = 'm'.++$i;
        $data[$index] = $row[$colName];           
    } 
    $db->insert ('pandlpivot', $data);
    $logger->debug('insertRowDetail()', $db->getLastQuery());     
}

function loadPandLpivotGridHeader(){
    global $db, $logger;
    
    $headerSql ="SELECT CONCAT( opsmonthlycalendar.month, ' ', opsmonthlycalendar.year ) AS aMonth "
        . "FROM opsmonthlycalendar "
        . "WHERE year = YEAR(CURRENT_DATE) ORDER BY year ASC,monthNbr ASC ";

    $headerRows = $db->query($headerSql);
    $logger->debug('loadPandLpivotGridHeader()', $db->getLastQuery()); 

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');

    echo '<rows id="0">';
    echo '	<head>';    
    echo '	<column width="230" type="ro" align="right" sort="str">CATEGORY</column>';
    if($headerRows){
        foreach($headerRows as $row){
            echo '	<column width="110" type="kenyaCurrencyro" align="right" sort="str" >'.$row['aMonth'].'</column> ';
        }
    }  
    echo '</head>'; 
}

function loadPandLpivotGridDetail(){
    global $db, $logger, $lineOfBusinessOid;
    
    $detailSql ="SELECT `oid`,`header`, `m1`, `m2`, `m3`, `m4`, `m5`, `m6`, `m7`, `m8`, `m9`, `m10`, `m11`, `m12` "
        . "FROM `pandlpivot` "
        . "WHERE lineOfBusinessOid = $lineOfBusinessOid";

    $rows = $db->query($detailSql);
    $logger->debug('loadPandLpivotGridDetail()', $db->getLastQuery());    
    if ($rows) {
        $logger->debug('loadPandLpivotGridDetail()', $rows);
        foreach ($rows as $row) {
            echo ("<row id='" . $row['oid'] . "'>");
            print("<cell><![CDATA[" . $row['header'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['m1'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['m2'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['m3'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['m4'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['m5'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['m6'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['m7'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['m8'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['m9'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['m10'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['m11'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['m12'] . "]]></cell>");
            print("</row>");
        }
    } 
    echo '</rows>';
}
