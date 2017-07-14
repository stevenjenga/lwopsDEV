<?php
include __DIR__ . '/../functions.php';
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug("REQUEST",$_REQUEST); 
    $reportName = filter_input(INPUT_GET, 'reportName', FILTER_SANITIZE_SPECIAL_CHARS);
    switch ($reportName) {
        case "ROLES":
            getRolesRptData();
            break;
        case "EXPENSES_BY_DEPT":
            getExpenseByDeptRptData();
            break;
        case "SALES_BY_CUSTOMER":
            getSalesByCustRptData();
            break;
        case "SALES_BY_DEPT":
            getSalesByDeptRptData();
            break;        
        default:
            throw new Exception(pathinfo(__FILE__, PATHINFO_FILENAME)." Invalid ReportName = ".$reportName);
    }
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
} catch (Exception $e) {
    $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
    loadErrorGrid("<b>".$e->getMessage()."</b>");
}

function getRolesRptData() {
    global $db, $logger;

    $sql = "SELECT CONCAT(employee.firstName, ' ', employee.middleInitial, ' ', employee.lastName) AS empName, "
        . "employeeroletype.role, employeerole.effectiveDt, employeerole.endDt "
        . "FROM employee "
        . "INNER JOIN (employeerole, employeeroletype) "
        . "ON (employeerole.employeeOid = employee.oid "
        . "AND employeerole.employeeRoleTypeOid = employeeroletype.oid) "
        . "ORDER BY empName ASC, employeerole.effectiveDt ASC ";

    $rows = $db->query($sql);
    $logger->debug('getRolesRptData()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');
    echo '<rows id="0">';
    echo '	<head>
            <column width="150" type="ro" align="right" sort="str">EMPLOYEE NAME</column>
            <column width="120" type="ro" align="right" sort="str" >ROLE</column>
            <column width="100" type="ro" align="right" sort="str">Effective Date</column>        
            <column width="100" type="ro" align="right" sort="str" >End Date</column> 
            
        </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['oid'] . "'>");
            print("<cell><![CDATA[" . $row['empName'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['role'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['effectiveDt'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['endDt'] . "]]></cell>");
            print("</row>");
        }
    } 
    echo '</rows>';
}

function getExpenseByDeptRptData() {
    global $db, $logger;

    $logger->debug("GET",$_GET); 
    $startDateRange = filter_input(INPUT_GET, 'startDateRange');
    $endDateRange = filter_input(INPUT_GET, 'endDateRange');

    $sql = "SELECT expenses.oid, expenseDate, payee, narration, activityOid, lineOfBusinessOid, amount, categoryOid, lineofbusiness.department "
        . "FROM expenses  "
        . "INNER JOIN lineofbusiness ON lineofbusiness.oid = expenses.lineOfBusinessOid "
        . "WHERE expenseDate BETWEEN '".$startDateRange."' AND '".$endDateRange."' "
        . "ORDER BY expenseDate ASC";

    $rows = $db->query($sql);
    $logger->debug('getExpenseByDeptRptData()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');
    echo '<rows id="0">';
    echo '	<head>
            <column width="100" type="ro" align="right" sort="str">DATE</column>        
            <column width="100" type="ro" align="right" sort="str">DEPARTMENT</column>        
            <column width="250" type="ro" align="right" sort="str">PAYEE</column>
            <column width="250" type="ro" align="right" sort="str" >NARRATION</column>
            <column width="110" type="kenyaCurrencyro" align="right" sort="str" >AMOUNT</column> 
        </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['oid'] . "'>");
            print("<cell><![CDATA[" . $row['expenseDate'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['department'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['payee'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['narration'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['amount'] . "]]></cell>");
            print("</row>");
        }
    } 
    echo '</rows>';
}

function getSalesByCustRptData(){
    global $db, $logger;

    $logger->debug("GET",$_GET); 
    $startDateRange = filter_input(INPUT_GET, 'startDateRange');
    $endDateRange = filter_input(INPUT_GET, 'endDateRange');

    $sql = "SELECT customer.oid AS cOid, customer.businessName, "
        . "fishsales.oid AS fOid, fishsales.salesDt AS fSalesDt, (fishsales.weight*fishsales.pricePerKg) AS fSales, "
        . "horticulturesales.oid AS hOid, horticulturesales.salesDt AS hSalesDt, (horticulturesales.quantity*horticulturesales.unitPrice) AS hSales, "
        . "mushroomsales.oid AS mOid, mushroomsales.salesDt AS mSalesDt, (mushroomsales.weightSold*mushroomsales.pricePerKg) AS mSales, "
        . "dairysales.oid AS dOid, dairysales.salesDt AS dSalesDt, (dairysales.volume*dairysales.pricePerLiter) AS dSales FROM customer "
        . "LEFT JOIN (fishsales) ON (fishsales.customerOid = customer.oid) "
        . "LEFT JOIN ( horticulturesales) ON (horticulturesales.customerOid = customer.oid) "
        . "LEFT JOIN ( mushroomsales) ON (mushroomsales.customerOid = customer.oid) "
        . "LEFT JOIN ( dairysales) ON (dairysales.customerOid = customer.oid) "
        . "WHERE ((fishsales.salesDt BETWEEN '".$startDateRange."' AND '".$endDateRange."') "
        . "OR (horticulturesales.salesDt BETWEEN '".$startDateRange."' AND '".$endDateRange."') "
        . "OR (mushroomsales.salesDt BETWEEN '".$startDateRange."' AND '".$endDateRange."') "
        . "OR (dairysales.salesDt BETWEEN '".$startDateRange."' AND '".$endDateRange."')) "
        . "GROUP BY customer.oid "        
        . "ORDER BY `customer`.`businessName` ASC ";

    $rows = $db->query($sql);
    $logger->debug('getSalesByCustRptData()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');
    echo '<rows id="0">';
    echo '	<head>
            <column width="100" type="ro" align="right" sort="str">DATE</column>
            <column width="180" type="ro" align="right" sort="str">CUSTOMER</column>    
            <column width="100" type="kenyaCurrencyro" align="right" sort="str">FISH SALES</column>        
            <column width="100" type="kenyaCurrencyro" align="right" sort="str">HORT SALES</column> 
            <column width="100" type="kenyaCurrencyro" align="right" sort="str">MUSH SALES</column> 
            <column width="100" type="kenyaCurrencyro" align="right" sort="str">DAIRY SALES</column> 
        </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['cOid'] . "'>");
            print("<cell><![CDATA[" . getSalesByCustDt($row) . "]]></cell>");
            print("<cell><![CDATA[" . $row['businessName'] . "]]></cell>");
            if (is_null($row['fSales'])) {print("<cell><![CDATA[" . 0.00 . "]]></cell>");}
            else {print("<cell><![CDATA[" . $row['fSales'] . "]]></cell>");}
            if (is_null($row['hSales'])) {print("<cell><![CDATA[" . 0.00 . "]]></cell>");}
            else {print("<cell><![CDATA[" . $row['hSales'] . "]]></cell>");}
            if (is_null($row['mSales'])) {print("<cell><![CDATA[" . 0.00 . "]]></cell>");}
            else {print("<cell><![CDATA[" . $row['mSales'] . "]]></cell>");}
            if (is_null($row['dSales'])) {print("<cell><![CDATA[" . 0.00 . "]]></cell>");}
            else {print("<cell><![CDATA[" . $row['dSales'] . "]]></cell>");}
            print("</row>");
        }
    } 
    echo '</rows>';    
}
function getSalesByCustDt($row){
    if (!is_null($row['fSalesDt'])) return $row['fSalesDt'];
    if (!is_null($row['hSalesDt'])) return $row['hSalesDt'];
    if (!is_null($row['mSalesDt'])) return $row['mSalesDt'];
    if (!is_null($row['dSalesDt'])) return $row['dSalesDt'];
}

function getSalesByDeptRptData(){
    global $db, $logger;

    $logger->debug("GET",$_GET); 
    $startDateRange = filter_input(INPUT_GET, 'startDateRange');
    $endDateRange = filter_input(INPUT_GET, 'endDateRange');

    $sql = "SELECT 'FISH' AS DEPT,fishsales.salesDt AS fSalesDt, (fishsales.weight*fishsales.pricePerKg) AS sales "
        . "FROM fishSales "
        . "WHERE (fishsales.salesDt BETWEEN '".$startDateRange."' AND '".$endDateRange."')"
        . "GROUP BY fishsales.salesDt "
        . "UNION "
        . "SELECT lineofbusiness.department AS DEPT, horticulturesales.salesDt AS hSalesDt, ( horticulturesales.quantity * horticulturesales.unitPrice ) AS sales "
        . "FROM horticulturesales "
        . "INNER JOIN lineofbusiness ON lineofbusiness.oid = horticulturesales.lineOfBusinessOid "
        . "WHERE (horticulturesales.salesDt BETWEEN '".$startDateRange."' AND '".$endDateRange."') "
        . "GROUP BY horticulturesales.salesDt, lineofbusiness.department "
        . "UNION "
        . "SELECT 'MUSHROOM' AS DEPT, mushroomsales.salesDt AS mSalesDt, (mushroomsales.weightSold * mushroomsales.pricePerKg) AS sales "
        . "FROM mushroomsales "
        . "WHERE (mushroomsales.salesDt BETWEEN '".$startDateRange."' AND '".$endDateRange."') "
        . "GROUP BY mushroomsales.salesDt "
        . "UNION "
        . "SELECT 'DAIRY' AS DEPT, dairysales.salesDt AS dSalesDt, (dairysales.volume * dairysales.pricePerLiter) AS sales "
        . "FROM dairysales "
        . "WHERE (dairysales.salesDt BETWEEN '".$startDateRange."' AND '".$endDateRange."') "
        . "GROUP BY dairysales.salesDt ";

    $rows = $db->query($sql);
    $logger->debug('getSalesByDeptRptData()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');
    echo '<rows id="0">';
    echo '	<head>
            <column width="100" type="ro" align="right" sort="str">DATE</column>
            <column width="180" type="ro" align="right" sort="str">DEPARTMENT</column>    
            <column width="100" type="kenyaCurrencyro" align="right" sort="str">SALES</column>        
        </head>';

    if ($rows) {
        foreach ($rows as $row) {
            echo ("<row id='" . $row['cOid'] . "'>");
            print("<cell><![CDATA[" . getSalesByCustDt($row) . "]]></cell>");
            print("<cell><![CDATA[" . $row['DEPT'] . "]]></cell>");
            print("<cell><![CDATA[" . $row['sales'] . "]]></cell>");
            print("</row>");
        }
    } 
    echo '</rows>';     
}