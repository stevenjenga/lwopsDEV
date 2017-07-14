<?php
function loadFishPandLpivot($selectedMonthsArray) {
    global $db, $logger;
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));

    insertFishTopLevelDetail(getFishTopLevelSql($selectedMonthsArray));
    insertLaborExpenseDetail($selectedMonthsArray, getFishLaborExpenseDetailSql($selectedMonthsArray)); 
    insertLaborExpenseDetail($selectedMonthsArray, getFishRoleExpenseTotalsSql(getOids($selectedMonthsArray, 'fishpandl')));
    insertFishGeneralExpensesDetail(getFishTopLevelSql($selectedMonthsArray));
    insertFishNetProfit($selectedMonthsArray);
    loadPandLpivotGridHeader();
    loadPandLpivotGridDetail();
    
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}

function insertFishTopLevelDetail($sql){
    global $db, $logger;

    $rows = $db->query($sql);
    $logger->debug('insertRowDetailIntoPivotTable()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('INCOME - Sales',$rows,'salesIncome');
        insertRowDetail('INCOME - Other',$rows,'otherIncome');
        insertRowDetail('PURCHASES',$rows,'purchases');
        insertRowDetail('GROSS PROFIT',$rows,'grossProfit');         
   }   
   return;
}

function insertFishGeneralExpensesDetail($sql){
    global $db, $logger;
    $rows = $db->query($sql);
    $logger->debug('insertFishGeneralExpensesDetail()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('GENERAL - Expenses',$rows,'generalExpenses');
        insertRowDetail('GENERAL - Electricity',$rows,'elecExpenses');
        insertRowDetail('TOTAL GENERAL EXPENSES',$rows,'totGeneralExpenses');
   }   
   return;
}

function insertFishNetProfit($selectedMonthsArray){
    global $db, $logger;
    $pAndLoids = getOids($selectedMonthsArray, 'fishpandl');
    $sql = "SELECT fishpandl.oid, ((salesIncome + otherIncome - purchases) - (generalExpenses + elecExpenses) -(SUM(expenseAmount))) AS netProfit "
        . "FROM fishpandl "
        . "INNER JOIN fishpandllabourexpensedetail ON fishpandllabourexpensedetail.FishPandLOid = fishpandl.oid "
        . "WHERE fishpandl.oid IN (".$pAndLoids.") "
        . "GROUP BY fishpandl.oid";
    $rows = $db->query($sql);
    $logger->debug('insertFishNetProfit()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('NET PROFIT',$rows,'netProfit');
   }   
   return;
}

function getFishTopLevelSql($selectedMonthsArray){
    return "SELECT oid, lineOfBusinessOid, opsMonthlyCalendarOid, salesIncome, otherIncome, purchases, "
        . "(salesIncome+otherIncome-purchases) AS grossProfit, "
        . " generalExpenses, elecExpenses, "
        . "(generalExpenses+elecExpenses) AS totGeneralExpenses, "
        . "( (salesIncome+otherIncome-purchases) - (generalExpenses+elecExpenses)) AS netProfit "
        . "FROM fishpandl "
        . "WHERE opsMonthlyCalendarOid IN (".implode(',', $selectedMonthsArray).")";
}

function getFishLaborExpenseDetailSql($selectedMonthsArray){
    $PandLoids = getOids($selectedMonthsArray, "fishPandL");
    return "SELECT employeeroletype.role,expenseAmount "
        . "FROM fishpandllabourexpensedetail "
        . "INNER JOIN employeeroletype ON employeeroletype.oid = fishpandllabourexpensedetail.EmployeeRoleOid "
        . "WHERE FishPandLOid IN (".$PandLoids.") "
        . "ORDER BY role ";      
}

function getFishRoleExpenseTotalsSql($pAndLoids){
    return "SELECT 'TOTAL LABOUR EXPENSES' AS role, SUM(expenseAmount) AS expenseAmount "
        . "FROM fishpandllabourexpensedetail "
        . "WHERE fishpandllabourexpensedetail.FishPandLOid IN (".$pAndLoids.") GROUP BY FishPandLOid";
}



