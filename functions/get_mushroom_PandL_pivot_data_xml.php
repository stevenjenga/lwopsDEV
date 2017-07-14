<?php
function loadMushroomPandLpivot($selectedMonthsArray) {
    global $db, $logger;
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));

    insertMushroomTopLevelDetail(getMushroomTopLevelSql($selectedMonthsArray));
    insertLaborExpenseDetail($selectedMonthsArray, getMushroomLaborExpenseDetailSql($selectedMonthsArray)); 
    insertLaborExpenseDetail($selectedMonthsArray, getMushroomRoleExpenseTotalsSql(getOids($selectedMonthsArray, 'mushroompandl')));
    insertMushroomGeneralExpensesDetail(getMushroomTopLevelSql($selectedMonthsArray));
    insertMushroomNetProfit($selectedMonthsArray);
    loadPandLpivotGridHeader();
    loadPandLpivotGridDetail();
    
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}

function insertMushroomTopLevelDetail($sql){
    global $db, $logger;

    $rows = $db->query($sql);
    $logger->debug('insertMushroomTopLevelDetail()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('INCOME - Sales',$rows,'salesIncome');
        insertRowDetail('INCOME - Other',$rows,'otherIncome');
        insertRowDetail('PURCHASES',$rows,'purchases');
        insertRowDetail('GROSS PROFIT',$rows,'grossProfit');         
   }   
   return;
}

function insertMushroomGeneralExpensesDetail($sql){
    global $db, $logger;
    $rows = $db->query($sql);
    $logger->debug('insertMushroomGeneralExpensesDetail()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('GENERAL - Expenses',$rows,'generalExpenses');
        insertRowDetail('GENERAL - Electricity',$rows,'elecExpenses');
        insertRowDetail('TOTAL GENERAL EXPENSES',$rows,'totGeneralExpenses');
   }   
   return;
}

function insertMushroomNetProfit($selectedMonthsArray){
    global $db, $logger;
    $pAndLoids = getOids($selectedMonthsArray, 'mushroompandl');
    $sql = "SELECT mushroompandl.oid, ((salesIncome + otherIncome - purchases) - (generalExpenses + elecExpenses) -(SUM(expenseAmount))) AS netProfit "
        . "FROM mushroompandl "
        . "INNER JOIN mushroompandllabourexpensedetail ON mushroompandllabourexpensedetail.MushroomPandLOid = mushroompandl.oid "
        . "WHERE mushroompandl.oid IN (".$pAndLoids.") "
        . "GROUP BY mushroompandl.oid";
    $rows = $db->query($sql);
    $logger->debug('insertMushroomNetProfit()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('NET PROFIT',$rows,'netProfit');
   }   
   return;
}

function getMushroomTopLevelSql($selectedMonthsArray){
    return "SELECT oid, lineOfBusinessOid, opsMonthlyCalendarOid, salesIncome, otherIncome, purchases, "
        . "(salesIncome+otherIncome-purchases) AS grossProfit, "
        . " generalExpenses, elecExpenses, "
        . "(generalExpenses+elecExpenses) AS totGeneralExpenses, "
        . "( (salesIncome+otherIncome-purchases) - (generalExpenses+elecExpenses)) AS netProfit "
        . "FROM mushroompandl "
        . "WHERE opsMonthlyCalendarOid IN (".implode(',', $selectedMonthsArray).")";
}

function getMushroomLaborExpenseDetailSql($selectedMonthsArray){
    $PandLoids = getOids($selectedMonthsArray, "mushroomPandL");
    return "SELECT employeeroletype.role,expenseAmount "
        . "FROM mushroompandllabourexpensedetail "
        . "INNER JOIN employeeroletype ON employeeroletype.oid = mushroompandllabourexpensedetail.EmployeeRoleOid "
        . "WHERE MushroomPandLOid IN (".$PandLoids.") "
        . "ORDER BY role ";      
}

function getMushroomRoleExpenseTotalsSql($pAndLoids){
    return "SELECT 'TOTAL LABOUR EXPENSES' AS role, SUM(expenseAmount) AS expenseAmount "
        . "FROM mushroompandllabourexpensedetail "
        . "WHERE mushroompandllabourexpensedetail.MushroomPandLOid IN (".$pAndLoids.") GROUP BY MushroomPandLOid";
}



