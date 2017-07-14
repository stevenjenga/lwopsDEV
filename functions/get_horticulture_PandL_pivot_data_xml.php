<?php
function loadHorticulturePandLpivot($selectedMonthsArray) {
    global $db, $logger;
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));

    insertHorticultureTopLevelDetail(getHorticultureTopLevelSql($selectedMonthsArray));
    insertLaborExpenseDetail($selectedMonthsArray, getHorticultureLaborExpenseDetailSql($selectedMonthsArray)); 
    insertLaborExpenseDetail($selectedMonthsArray, getHorticultureRoleExpenseTotalsSql(getOids($selectedMonthsArray, 'horticulturepandl')));
    insertHorticultureGeneralExpensesDetail(getHorticultureTopLevelSql($selectedMonthsArray));
    insertHorticultureNetProfit($selectedMonthsArray);
    loadPandLpivotGridHeader();
    loadPandLpivotGridDetail();
    
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}

function insertHorticultureTopLevelDetail($sql){
    global $db, $logger;

    $rows = $db->query($sql);
    $logger->debug('insertHorticultureTopLevelDetail()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('INCOME - Sales',$rows,'salesIncome');
        insertRowDetail('INCOME - Other',$rows,'otherIncome');
        insertRowDetail('PURCHASES',$rows,'purchases');
        insertRowDetail('GROSS PROFIT',$rows,'grossProfit');         
   }   
   return;
}

function insertHorticultureGeneralExpensesDetail($sql){
    global $db, $logger;
    $rows = $db->query($sql);
    $logger->debug('insertHorticultureGeneralExpensesDetail()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('GENERAL - Expenses',$rows,'generalExpenses');
        insertRowDetail('GENERAL - Electricity',$rows,'elecExpenses');
        insertRowDetail('TOTAL GENERAL EXPENSES',$rows,'totGeneralExpenses');
   }   
   return;
}

function insertHorticultureNetProfit($selectedMonthsArray){
    global $db, $logger;
    $pAndLoids = getOids($selectedMonthsArray, 'horticulturepandl');
    $sql = "SELECT horticulturepandl.oid, ((salesIncome + otherIncome - purchases) - (generalExpenses + elecExpenses) -(SUM(expenseAmount))) AS netProfit "
        . "FROM horticulturepandl "
        . "INNER JOIN horticulturepandllabourexpensedetail ON horticulturepandllabourexpensedetail.HorticulturePandLOid = horticulturepandl.oid "
        . "WHERE horticulturepandl.oid IN (".$pAndLoids.") "
        . "GROUP BY horticulturepandl.oid";
    $rows = $db->query($sql);
    $logger->debug('insertHorticultureNetProfit()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('NET PROFIT',$rows,'netProfit');
   }   
   return;
}

function getHorticultureTopLevelSql($selectedMonthsArray){
    return "SELECT oid, lineOfBusinessOid, opsMonthlyCalendarOid, salesIncome, otherIncome, purchases, "
        . "(salesIncome+otherIncome-purchases) AS grossProfit, "
        . " generalExpenses, elecExpenses, "
        . "(generalExpenses+elecExpenses) AS totGeneralExpenses, "
        . "( (salesIncome+otherIncome-purchases) - (generalExpenses+elecExpenses)) AS netProfit "
        . "FROM horticulturepandl "
        . "WHERE opsMonthlyCalendarOid IN (".implode(',', $selectedMonthsArray).")";
}

function getHorticultureLaborExpenseDetailSql($selectedMonthsArray){
    $PandLoids = getOids($selectedMonthsArray, "horticulturePandL");
    return "SELECT employeeroletype.role,expenseAmount "
        . "FROM horticulturepandllabourexpensedetail "
        . "INNER JOIN employeeroletype ON employeeroletype.oid = horticulturepandllabourexpensedetail.EmployeeRoleOid "
        . "WHERE HorticulturePandLOid IN (".$PandLoids.") "
        . "ORDER BY role ";      
}

function getHorticultureRoleExpenseTotalsSql($pAndLoids){
    return "SELECT 'TOTAL LABOUR EXPENSES' AS role, SUM(expenseAmount) AS expenseAmount "
        . "FROM horticulturepandllabourexpensedetail "
        . "WHERE horticulturepandllabourexpensedetail.HorticulturePandLOid IN (".$pAndLoids.") GROUP BY HorticulturePandLOid";
}



