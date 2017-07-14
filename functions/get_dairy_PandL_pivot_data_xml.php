<?php
function loadDairyPandLpivot($selectedMonthsArray) {
    global $db, $logger;
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));

    insertDairyTopLevelDetail(getDairyTopLevelSql($selectedMonthsArray));
    insertLaborExpenseDetail($selectedMonthsArray, getDairyLaborExpenseDetailSql($selectedMonthsArray)); 
    insertLaborExpenseDetail($selectedMonthsArray, getDairyRoleExpenseTotalsSql(getOids($selectedMonthsArray, 'dairypandl')));
    insertDairyGeneralExpensesDetail(getDairyTopLevelSql($selectedMonthsArray));
    insertDairyNetProfit($selectedMonthsArray);
    loadPandLpivotGridHeader();
    loadPandLpivotGridDetail();
    
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}

function insertDairyTopLevelDetail($sql){
    global $db, $logger;

    $rows = $db->query($sql);
    $logger->debug('insertRowDetailIntoPivotTable()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('INCOME - Sales',$rows,'salesIncome');
        insertRowDetail('INCOME - Kiambaa Dairy',$rows,'cooperativeSales');
        insertRowDetail('SALES - Other',$rows,'otherIncome');
        insertRowDetail('TOTAL SALES',$rows,'totSales');        
        insertRowDetail('PURCHASES',$rows,'purchases');
        insertRowDetail('PURCHASES - Kiambaa Dairy Deductions',$rows,'cooperativeDeductions');
        insertRowDetail('GROSS PROFIT',$rows,'grossProfit');         
   }   
   return;
}

function insertDairyGeneralExpensesDetail($sql){
    global $db, $logger;
    $rows = $db->query($sql);
    $logger->debug('insertDairyGeneralExpensesDetail()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('GENERAL - Expenses',$rows,'generalExpenses');
        insertRowDetail('GENERAL - Electricity',$rows,'elecExpenses');
        insertRowDetail('TOTAL GENERAL EXPENSES',$rows,'totGeneralExpenses');
   }   
   return;
}

function insertDairyNetProfit($selectedMonthsArray){
    global $db, $logger;
    $pAndLoids = getOids($selectedMonthsArray, 'dairypandl');
    $sql = "SELECT dairypandl.oid, ((salesIncome + otherIncome - purchases) - (generalExpenses + elecExpenses) -(SUM(expenseAmount))) AS netProfit "
        . "FROM dairypandl "
        . "INNER JOIN dairypandllabourexpensedetail ON dairypandllabourexpensedetail.DairyPandLOid = dairypandl.oid "
        . "WHERE dairypandl.oid IN (".$pAndLoids.") "
        . "GROUP BY dairypandl.oid";
    $rows = $db->query($sql);
    $logger->debug('insertDairyNetProfit()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('NET PROFIT',$rows,'netProfit');
   }   
   return;
}

function getDairyTopLevelSql($selectedMonthsArray){
    return "SELECT oid, lineOfBusinessOid, opsMonthlyCalendarOid, salesIncome, otherIncome, purchases,cooperativeSales,cooperativeDeductions, "
        . "(salesIncome+cooperativeSales+otherIncome) AS totSales, "
        . "(salesIncome+cooperativeSales+otherIncome-purchases-otherPurchases) AS grossProfit,  "
        . "generalExpenses, elecExpenses, (generalExpenses+elecExpenses) AS totGeneralExpenses, "
        . "( (salesIncome+otherIncome-purchases) - (generalExpenses+elecExpenses)) AS netProfit "
        . "FROM dairypandl "
        . "WHERE opsMonthlyCalendarOid IN (".implode(',', $selectedMonthsArray).")";
}

function getDairyLaborExpenseDetailSql($selectedMonthsArray){
    $PandLoids = getOids($selectedMonthsArray, "dairyPandL");
    return "SELECT employeeroletype.role,expenseAmount "
        . "FROM dairypandllabourexpensedetail "
        . "INNER JOIN employeeroletype ON employeeroletype.oid = dairypandllabourexpensedetail.EmployeeRoleOid "
        . "WHERE DairyPandLOid IN (".$PandLoids.") "
        . "ORDER BY role ";      
}

function getDairyRoleExpenseTotalsSql($pAndLoids){
    return "SELECT 'TOTAL LABOUR EXPENSES' AS role, SUM(expenseAmount) AS expenseAmount "
        . "FROM dairypandllabourexpensedetail "
        . "WHERE dairypandllabourexpensedetail.DairyPandLOid IN (".$pAndLoids.") GROUP BY DairyPandLOid";
}



