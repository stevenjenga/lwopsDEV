<?php

function loadTeaPandLpivot($selectedMonthsArray) {
    global $db, $logger, $lineOfBusinessOid;
    $logger->debug('loadTeaPandLpivot()', $selectedMonthsArray);
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));

    insertTeaTopLevelDetail(getTeaTopLevelSql($selectedMonthsArray));
    insertLaborExpenseDetail($selectedMonthsArray, getTeaLaborExpenseDetailSql($selectedMonthsArray)); 
    insertLaborExpenseDetail($selectedMonthsArray, getTeaRoleExpenseTotalsSql(getOids($selectedMonthsArray, 'teapandl')));
    insertTeaBottomLevelDetail(getTeaTopLevelSql($selectedMonthsArray));
    insertTeaNetProfit($selectedMonthsArray);
    loadPandLpivotGridHeader();
    loadPandLpivotGridDetail();
    
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}

function insertTeaTopLevelDetail($sql){
    global $db, $logger, $lineOfBusinessOid;
    $rows = $db->query($sql);
    $logger->debug('insertTeaTopLevelDetail()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('SALES - Factory Wght',$rows,'factoryWeight');
        insertRowDetail('SALES - Factory Rate',$rows,'factoryPurchaseRate');
        insertRowDetail('SALES - FACTORY',$rows,'factorySales');
        insertRowDetail('INCOME - Other',$rows,'otherIncome');
        insertRowDetail('TOTAL SALES',$rows,'totSales');
        insertRowDetail('PURCHASES - RoundUp',$rows,'purchasesRoundup');
        insertRowDetail('PURCHASES - Fertiliser',$rows,'purchasesFertilizer');
        insertRowDetail('PURCHASES - Delivery Book',$rows,'purchasesDeliveryBook');
        insertRowDetail('TOTAL PURCHASES',$rows,'totPurchases');
        insertRowDetail('BONUS',$rows,'factoryBonus');
        insertRowDetail('GROSS PROFIT',$rows,'grossProfit'); 
        insertRowDetail('EXPENSES - Transport',$rows,'tripExpenses');
        insertRowDetail('EXPENSES - Tea Picking',$rows,'labourTeaPickersExpenses');
        insertRowDetail('EXPENSES - Pruning',$rows,'pruningExpenses');
        insertRowDetail('TOTAL OPERATIONAL EXPENSES',$rows,'operationalExpenses');        
   }   
   return;
}
function insertTeaBottomLevelDetail($sql){
    global $db, $logger, $lineOfBusinessOid;
    $rows = $db->query($sql);
    $logger->debug('insertTeaTopLevelDetail()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('GENERAL - Tea Cess',$rows,'cessExpenses');
        insertRowDetail('GENERAL - Made Tea',$rows,'madeTea');
        insertRowDetail('GENERAL - Expenses',$rows,'generalExpenses');
        insertRowDetail('GENERAL - Electricity',$rows,'elecExpenses');
        insertRowDetail('TOTAL GENERAL EXPENSES',$rows,'totGeneralExpenses');
   }   
   return;
}

function insertTeaNetProfit($selectedMonthsArray){
    global $db, $logger;
    $pAndLoids = getOids($selectedMonthsArray, 'teapandl');
    $sql = "SELECT teapandl.oid, "
        . "( ((factoryWeight * factoryPurchaseRate) - (purchasesRoundup + purchasesFertilizer + purchasesDeliveryBook) + factoryBonus + otherIncome) - "
        . "(tripExpenses+labourTeaPickersExpenses+pruningExpenses) - "
        . "(cessExpenses+looseTeaPurchases+teaBagPurchases+generalExpenses+elecExpenses) - "
        . "SUM(expenseAmount) ) AS netProfit "
        . "FROM teapandl "
        . "INNER JOIN teapandllabourexpensedetail ON teapandllabourexpensedetail.TeaPandLOid = teapandl.oid "
        . "WHERE teapandl.oid IN (".$pAndLoids.") "
        . "GROUP BY teapandl.oid";
    $rows = $db->query($sql);
    $logger->debug('insertTeaNetProfit()', $db->getLastQuery());  

    if ($rows) {
        insertRowDetail('NET PROFIT',$rows,'netProfit');
   }   
   return;
}

function getTeaTopLevelSql($selectedMonthsArray){
    $sql = "SELECT oid, lineOfBusinessOid, opsMonthlyCalendarOid, factoryWeight, factoryPurchaseRate, "
        . "(factoryWeight*factoryPurchaseRate) AS factorySales, factoryBonus, otherIncome, "
        . "((factoryWeight*factoryPurchaseRate)+otherIncome+factoryBonus) AS totSales, purchasesRoundup, "
        . "purchasesFertilizer, purchasesDeliveryBook, (purchasesRoundup+purchasesFertilizer+purchasesDeliveryBook) AS totPurchases, "
        . " ((factoryWeight * factoryPurchaseRate) - (purchasesRoundup + purchasesFertilizer + purchasesDeliveryBook) + factoryBonus ) AS grossProfit, otherPurchases, salaryExpenses, casualsBonusExpenses, fteBonusExpenses, "
        . "fteSalaryExpenses, nbrOfTrips, tripExpenses, labourTeaPickersExpenses, pruningExpenses, cessExpenses, "
        . "(tripExpenses+labourTeaPickersExpenses+pruningExpenses) AS operationalExpenses, "
        . "(looseTeaPurchases+teaBagPurchases) AS madeTea, generalExpenses, elecExpenses, "
        . "(cessExpenses+looseTeaPurchases+teaBagPurchases+generalExpenses+elecExpenses) AS totGeneralExpenses "
        . "FROM teapandl "
        . "WHERE opsMonthlyCalendarOid IN (".implode(',', $selectedMonthsArray).")";
 
   return $sql;
}

function getTeaLaborExpenseDetailSql($selectedMonthsArray){
    global $logger;

    $PandLoids = getOids($selectedMonthsArray, "teaPandL");
    $logger->debug('getTeaLaborExpenseDetailSql()', ['count'=> count($selectedMonthsArray)]);
    return "SELECT employeeroletype.role,expenseAmount "
        . "FROM teapandllabourexpensedetail "
        . "INNER JOIN employeeroletype ON employeeroletype.oid = teapandllabourexpensedetail.EmployeeRoleOid "
        . "WHERE TeaPandLOid IN (".$PandLoids.") "
        . "ORDER BY role ";      
}

function getTeaRoleExpenseTotalsSql($pAndLoids){
    return "SELECT 'TOTAL LABOUR EXPENSES' AS role, SUM(expenseAmount) AS expenseAmount "
        . "FROM teapandllabourexpensedetail "
        . "WHERE teapandllabourexpensedetail.teaPandLOid IN (".$pAndLoids.") GROUP BY teaPandLOid";
}


