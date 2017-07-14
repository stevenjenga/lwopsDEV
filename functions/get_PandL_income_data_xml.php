<?php
require_once('functions.php');
include('get_tea_PandL_data_db.php');
include('get_dairy_PandL_pivot_data_xml.php');
include('get_dairy_PandL_data_db.php');
include('get_pandl_pivot_data_xml.php');
include('get_fish_PandL_pivot_data_xml.php');
include('get_tea_PandL_pivot_data_xml.php');
include('get_mushroom_PandL_pivot_data_xml.php');
include('get_horticulture_PandL_pivot_data_xml.php');

global $LOB;
global $data;
global $lineOfBusinessOid;
global $db;
global $logger;
global $year, $month;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug('GET', $_GET);
    
    $LOB = filter_input(INPUT_GET, 'selectedPandLgrid', FILTER_SANITIZE_SPECIAL_CHARS);
    $selectedOidsStr = filter_input(INPUT_GET, 'selectedMonthsArray', FILTER_SANITIZE_SPECIAL_CHARS);
    $logger->debug('[GET]', ['LOB'=>$LOB, 'months'=>$selectedOidsStr]);
    
    $selectedOidsArray = getCalendarOidsArray();
    $db->startTransaction();
    deleteAllFromPandLpivotTale();
    generateAndSavePandLincome($selectedOidsArray);
    $db->commit();
    switch($LOB){
        case "FISH":
            loadFishPandLpivot($selectedOidsArray);
            break;
        case "TEA":
            loadTeaPandLpivot($selectedOidsArray);
            break;
        case "DAIRY":
            loadDairyPandLpivot($selectedOidsArray);
            break;
        case "MUSHROOM":
            loadMushroomPandLpivot($selectedOidsArray);
            break;
        case "HORTICULTURE":
        case "HORTICULTURE-KARANJA":
        case "HORTICULTURE-GREENHOUSE":
        case "HORTICULTURE-NJOGU":
            loadHorticulturePandLpivot($selectedOidsArray, $LOB);
            break;
        case "GENERAL":
        case "CONSTRUCTION":
            throw new Exception("undefined for ".$LOB);
        default:
            throw new Exception("start: No LineOfBusiness Oid for ".$LOB);
    }  
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
    $db->rollback();
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function deleteAllFromPandLpivotTale(){
    global $logger,$db;
    $sql = "DELETE FROM pandlpivot";
    $db->query($sql);
    $logger->debug('deleteAllFromPandLpivotTale()', $db->getLastQuery());
    if ($db->getLastErrno() != 0) {
        throw new Exception($db->getLastError());
    } 
    return;        
}
function generateAndSavePandLincome($selectedMonthOidsArray){
    /* @var $logger type */
    global $LOB,$data;
    $data = Array();
    
    setLineOfBusinessOid();
    foreach($selectedMonthOidsArray as $oid){
        deletePandLexistingrecord($oid);

        $year = getSelectedYear($oid);
        $month = getSelectedMonth($oid);
        $data['opsMonthlyCalendarOid'] = $oid;

        switch($LOB){
            case "FISH":
                getFishPandL($year, $month);
                break;
            case "TEA":
                getTeaPandL($year, $month,  $oid);
                break;
            case "DAIRY":
                getDairyPandL($year, $month);
                break;
            case "MUSHROOM":
                getMushroomPandL($year, $month);
                break;  
            case "HORTICULTURE":
            case "HORTICULTURE-KARANJA":
            case "HORTICULTURE-GREENHOUSE":
            case "HORTICULTURE-NJOGU":
                getHorticulturePandL($year, $month);
                break;
            default:
                throw new Exception("generateAndSavePandLincome(): Missing LineOfBusiness Oid for ".$LOB);
        }        
        savePandL($year, $month);
    }
}

function getFishPandL($year, $month){
    global $data, $logger; 
    
    getTotSalesIncome($year, $month); 
    getOtherIncome($year, $month); 
    getPurchases($year, $month); 
    getOtherPurchases($year, $month); 
    getGeneralExpenses($year, $month);
    getElecExpenses($data['opsMonthlyCalendarOid']); 
    $logger->debug('getFishPandL()', $data);
}

function getTeaPandL($year, $month){
    global $data, $logger; 
    
    getFactoryWght($year, $month); 
    getTeaFactoryRate($data['opsMonthlyCalendarOid']);
    getTeaPurchases($year, $month);
    getTeaBonus($data['opsMonthlyCalendarOid']); 
    getOtherIncome($year, $month);
    getTeaPickersLaborExpenses($year, $month);     
    getTripExpenses($data['opsMonthlyCalendarOid']);
    getCessExpenses($year, $month);
    getGeneralExpenses($year, $month);
    getElecExpenses($data['opsMonthlyCalendarOid']);
    $logger->debug('getTeaPandL()', $data);
    return;
 }
 
 function getDairyPandL($year, $month){
    global $data, $logger; 
   
    getTotSalesIncome($year, $month); 
    getCooperativeSales($data['opsMonthlyCalendarOid']);
    getOtherIncome($year, $month); 
    getPurchases($year, $month); 
    getOtherPurchases($year, $month);
    getCooperativeDeductions($data['opsMonthlyCalendarOid']);
    getGeneralExpenses($year, $month);
    getElecExpenses($data['opsMonthlyCalendarOid']); 
    $logger->debug('getDairyPandL()', $data);
}

 function getMushroomPandL($year, $month){
    global $data, $logger; 
   
    getTotSalesIncome($year, $month); 
    getOtherIncome($year, $month); 
    getPurchases($year, $month); 
    getOtherPurchases($year, $month);
    getGeneralExpenses($year, $month);
    getElecExpenses($data['opsMonthlyCalendarOid']); 
    $logger->debug('getMushroomPandL()', $data);
}

 function getHorticulturePandL($year, $month){
    global $data, $logger; 
   
    getTotSalesIncome($year, $month); 
    getOtherIncome($year, $month); 
    getPurchases($year, $month); 
    getOtherPurchases($year, $month);
    getGeneralExpenses($year, $month);
    getElecExpenses($data['opsMonthlyCalendarOid']); 
    $logger->debug('getHorticulturePandL()', $data);
}

function savePandL($year, $month){
    global $db,$LOB,$data;
    $targetStartDt = new DateTime($year."-".$month."-01");
    $targetEndDt = new DateTime($year."-".$month."-01");
    $targetEndDt->modify('last day of this month'); 
    
    $otherWorkExpensesByRole = getOtherWorkExpensesByRole($targetStartDt->format('Y-m-d'),$targetEndDt->format('Y-m-d'));
    $parttimeExpensesByRole = getParttimeExpensesByRole($targetStartDt->format('Y-m-d'),$targetEndDt->format('Y-m-d'));
    $totExpensesByRole = combineExpensesByRole($parttimeExpensesByRole,$otherWorkExpensesByRole);
    
    switch($LOB){
        case "FISH":
            $id = $db->insert ('FishPandL', $data);
            savePandLexpenseDetails($id,$totExpensesByRole); 
        break;
        case "TEA":
            $id = $db->insert ('TeaPandL', $data);
            savePandLexpenseDetails($id,$totExpensesByRole);
        break;
        case "DAIRY":
            $id = $db->insert ('DairyPandL', $data);
            savePandLexpenseDetails($id,$totExpensesByRole);
            break;
        case "MUSHROOM":
            $id = $db->insert ('MushroomPandL', $data);
            savePandLexpenseDetails($id,$totExpensesByRole);
            break;  
        case "HORTICULTURE":
        case "HORTICULTURE-KARANJA":
        case "HORTICULTURE-GREENHOUSE":
        case "HORTICULTURE-NJOGU": 
            $id = $db->insert ('HorticulturePandL', $data);
            savePandLexpenseDetails($id,$totExpensesByRole);            
            break; 
        default:
            throw new Exception("savePandL(): ERROR saving PandL for ".$LOB);
    }
    if ($db->getLastErrno() === 0) {
    } else {
        throw new Exception($db->getLastError());
    }    
}

function deletePandLexistingrecord($oid){
    global $db,$logger,$LOB;
    
    deletePandLexpenseRecords($oid);
    $db->where ('opsMonthlyCalendarOid', $oid);
    switch($LOB){
        case "FISH":
            $db->delete ('FishPandL');
            break;
        case "TEA":
            $db->delete ('TeaPandL');
            break;
        case "DAIRY":
            $db->delete ('DairyPandL');
            break;
        case "MUSHROOM":
            $db->delete ('MushroomPandL');
            break;    
        case "HORTICULTURE":
        case "HORTICULTURE-KARANJA":
        case "HORTICULTURE-GREENHOUSE":
        case "HORTICULTURE-NJOGU":
        case "HORTICULTURE-ALL":
            $db->delete ('HorticulturePandL');
            break;
        default:
            throw new Exception("deletePandLexistingrecord() failed (PandL table does not exist) for LOB = ".$LOB);
    }
	$logger->debug('deletePandLexistingrecord()', $db->getLastQuery());
	if ($db->getLastErrno() != 0){
        throw new Exception($db->getLastError());
    }
}

function deletePandLexpenseRecords($oid){
    global $db,$logger,$LOB;

    $PandLoidArray = getPandLOids($oid);
    if($PandLoidArray){
        $logger->debug('deletePandLexpenseRecords(PandLoidArray)', $PandLoidArray);
        foreach($PandLoidArray as $row){
            switch($LOB){
                case "FISH":
                    $db->where ('fishPandLOid ', $row['oid']);
                    $db->delete ('FishPandLlabourExpenseDetail');                    
                    break;
                case "TEA":
                    $db->where ('teaPandLOid ', $row['oid']);
                    $db->delete ('TeaPandLlabourExpenseDetail');
                    break;
                case "DAIRY":
                    $db->where ('dairyPandLOid ', $row['oid']);
                    $db->delete ('DairyPandLlabourExpenseDetail');
                    break;
                case "MUSHROOM":
                    $db->where ('mushroomPandLOid ', $row['oid']);
                    $db->delete ('MushroomPandLlabourExpenseDetail');
                    break;
                case "HORTICULTURE":
                case "HORTICULTURE-KARANJA":
                case "HORTICULTURE-GREENHOUSE":
                case "HORTICULTURE-NJOGU":
                    $db->where ('HorticulturePandLOid ', $row['oid']);
                    $db->delete ('HorticulturePandLlabourExpenseDetail');                    
                    break;
                default:
                    throw new Exception("deletePandLexpenseRecords() failed for LOB = ".$LOB);
            }    
            $logger->debug('deletePandLexpenseRecords()', $db->getLastQuery());
            if ($db->getLastErrno() != 0){
                throw new Exception($db->getLastError());
            }
        }
    }     
}

function getPandLOids($oid){
    global $db, $logger, $LOB;  

    switch($LOB){
        case "FISH":
            $sql ="SELECT oid FROM fishpandl WHERE opsMonthlyCalendarOid  = $oid";
            break;
        case "TEA":
            $sql ="SELECT oid FROM teapandl WHERE opsMonthlyCalendarOid  = $oid";
            break;
        case "DAIRY":
            $sql ="SELECT oid FROM dairypandl WHERE opsMonthlyCalendarOid  = $oid";
            break;
        case "MUSHROOM":
            $sql ="SELECT oid FROM mushroompandl WHERE opsMonthlyCalendarOid  = $oid";
            break;
        case "HORTICULTURE":
            $sql ="SELECT oid FROM HorticulturePandL WHERE opsMonthlyCalendarOid  = $oid";
            break;            
        case "HORTICULTURE-KARANJA":
            $sql ="SELECT oid FROM HorticulturePandL WHERE opsMonthlyCalendarOid  = $oid";
            break;            
        case "HORTICULTURE-GREENHOUSE":
            $sql ="SELECT oid FROM HorticulturePandL WHERE opsMonthlyCalendarOid  = $oid";
            break;            
        case "HORTICULTURE-NJOGU":  
            $sql ="SELECT oid FROM HorticulturePandL WHERE opsMonthlyCalendarOid  = $oid";
            break;            
        break;            
        break;
        default:
            throw new Exception("getPandLOids(): No LineOfBusiness Oid for ".$LOB);
    }   
    $rows = $db->query($sql);
    if ($db->getLastErrno() != 0){
        throw new Exception($db->getLastError());
    }    
    $logger->debug('getPandLOids()', $db->getLastQuery());
    $logger->debug('getPandLOids()', $rows);
    return $rows;    
}

function setLineOfBusinessOid(){
    global $db, $logger, $LOB, $lineOfBusinessOid, $data;  
    
    $sql ="SELECT oid FROM LineOfBusiness WHERE department = ";
    switch($LOB){
        case "FISH":
            $sql .= "'FISH'";
            break;
        case "TEA":
            $sql .= "'TEA'";
            break;
        case "DAIRY":
            $sql .= "'DAIRY'";
            break;
        case "MUSHROOM":
            $sql .= "'MUSHROOM'";
            break;  
        case "HORTICULTURE":
            $sql .= "'HORTICULTURE'";
            break;             
        case "HORTICULTURE-KARANJA":
            $sql .= "'HORTICULTURE-KARANJA'";
            break;             
        case "HORTICULTURE-GREENHOUSE":
            $sql .= "'HORTICULTURE-GREENHOUSE'";
            break;             
        case "HORTICULTURE-NJOGU":  
            $sql .= "'HORTICULTURE-NJOGU'";
            break;             
        default:
            throw new Exception("setLineOfBusinessOid(): No LineOfBusiness Oid for ".$LOB);
    }   
    $rows = $db->query($sql);
    $logger->debug('setLineOfBusinessOid()', $db->getLastQuery());
    $logger->debug('setLineOfBusinessOid()', $rows);
    if($rows){
        foreach($rows as $row){
            $lineOfBusinessOid = $row['oid'];
            $data['lineOfBusinessOid'] = $lineOfBusinessOid;
        }
    } 
    else {
        throw new Exception("Error retrieving lineOfBusinessOid");
    }
}

function getTotSalesIncome($year, $month){
    global $logger,$data;
    $data['salesIncome'] = getRegularSalesIncome($year, $month) + getEmployeePurchases($year, $month);
    $logger->debug('getTotSalesIncome()', $data);
}

function getRegularSalesIncome($year, $month){
    global $db,$logger,$LOB,$data;    
    switch($LOB){
        case "FISH":
            $sql = "SELECT IF(SUM(weight*pricePerKg)IS NULL,0, SUM(weight*pricePerKg))  AS totSalesIncome "
            . "FROM fishsales WHERE YEAR(salesDt) = $year AND MONTH(salesDt) = $month ";
            break;
        case "TEA":
            break;
        case "DAIRY":
            $sql = "SELECT IF(SUM(`volume`*`pricePerLiter`)IS NULL,0, SUM(`volume`*`pricePerLiter`)) AS totSalesIncome  "
            . "FROM dairysales WHERE YEAR(salesDt) = $year AND MONTH(salesDt) = $month ";            
            break;
        case "MUSHROOM":
            $sql = "SELECT IF(SUM(`weightSold`*`pricePerKg`)IS NULL,0, SUM(`weightSold`*`pricePerKg`)) AS totSalesIncome  "
            . "FROM mushroomsales WHERE YEAR(salesDt) = $year AND MONTH(salesDt) = $month ";            
            break;
        case "HORTICULTURE":
        case "HORTICULTURE-KARANJA":
        case "HORTICULTURE-GREENHOUSE":
        case "HORTICULTURE-NJOGU": 
            $sql = "SELECT IF(SUM(`quantity`*`unitPrice`)IS NULL,0, SUM(`quantity`*`unitPrice`)) AS totSalesIncome "
            . "FROM horticulturesales WHERE YEAR(salesDt) = $year AND MONTH(salesDt) = $month "
            . "AND lineOfBusinessOid = ".getSpecificHortLineOfBusinessOid($LOB);            
            break;         
        default:
            throw new Exception("getRegularSalesIncome() not valid method call for LineOfBusiness = ".$LOB);
   }  
    $rows = $db->query($sql);
    $logger->debug('getRegularSalesIncome() for '.$LOB, $db->getLastQuery());
    $logger->debug('getRegularSalesIncome() for '.$LOB.' ('.$year.','.$month.')', $rows);
    
    if($rows){
        foreach($rows as $row){
            return $row['totSalesIncome'];
        }
    } 
    return 0;
}

function getEmployeePurchases($year, $month){
    global $db,$logger,$LOB,$lineOfBusinessOid;    
    
    $sql = "SELECT IF(SUM(`quantity`*`unitPrice`)IS NULL,0, SUM(`quantity`*`unitPrice`)) AS emloyeePurchaseIncome "
            . "FROM employeepurchases WHERE YEAR(purchaseDt) = $year AND MONTH(purchaseDt) = $month "
            . "AND lineOfBusinessOid = ".$lineOfBusinessOid;

    $rows = $db->query($sql);
    $logger->debug('getEmployeePurchases() for '.$LOB, $db->getLastQuery());
    $logger->debug('getEmployeePurchases() for '.$LOB.' ('.$year.','.$month.')', $rows);
    
    if($rows){
        foreach($rows as $row){
            return $row['emloyeePurchaseIncome'];
        }
    } 
    return 0;    
}
function getSpecificHortLineOfBusinessOid($LOB){
    global $db,$logger,$LOB; 
    $sql = "SELECT `oid` FROM `lineofbusiness` WHERE `department` = '".$LOB."'";    
    $rows = $db->query($sql);
    $logger->debug('getSpecificHortLineOfBusinessOid()', $db->getLastQuery());
    if($rows){
        foreach($rows as $row){
            return $row['oid'];
        }
    } 
    else {
        throw new Exception('getSpecificHortLineOfBusinessOid(): Failed to get oid for LOB = '.$LOB);
    }    
}
function getOtherIncome($year, $month){
    global $db,$logger, $data, $lineOfBusinessOid;
    $sql = "SELECT IF(SUM(incomeAmt)IS NULL,0, SUM(incomeAmt)) AS incomeAmt "
        . "FROM OtherDeptIncome WHERE lineOfBusinessOid = $lineOfBusinessOid "
        . "AND YEAR(date) = $year AND MONTH(date) = $month ";    
    $rows = $db->query($sql);
    $logger->debug('getOtherIncome()', $db->getLastQuery());
    if($rows){
        foreach($rows as $row){
            $data['otherIncome'] = $row['incomeAmt'];
        }
    } 
    return;
}

function getPurchases($year, $month){
    global $db,$logger,$LOB,$lineOfBusinessOid, $data;
    
    $sql = "SELECT ROUND(IF(SUM(amount)IS NULL,0, SUM(amount)),2) AS purchases "
        . "FROM Expenses "
        . "WHERE lineOfBusinessOid = $lineOfBusinessOid "
        . "AND categoryOid = 4 "
        . "AND YEAR(expenseDate) = $year AND MONTH(expenseDate) = $month ";
    $rows = $db->query($sql);
    $logger->debug('getPurchases()', $db->getLastQuery());
    if($rows){
        foreach($rows as $row){
            $data['purchases'] = $row['purchases'];
        }
    } 
    return;
}

function getOtherPurchases(){
    global $db,$logger, $data;
    return $data['otherPurchases'] = 0.0;
}

//UNUSED
//function getLabourParttimeExpenses($year, $month){
//    global $lineOfBusinessOid, $data;
//    $sql ="SELECT salaryAmount, hours, salarytype "
//        . "FROM empparttimehrs_vw "
//        . "WHERE YEAR(attendanceDt) = $year AND MONTH(attendanceDt) = $month AND lobOid = $lineOfBusinessOid ";
//    $data['labourParttimeExpenses'] = getExpensesByEmployeeType('SALARIED', $sql, $year, $month) + getExpensesByEmployeeType('CASUAL', $sql, $year, $month);
//}

//function getOtherworkExpense($targetStartDt, $targetEndDt){
//    //get other work assigned expense by LOB during PandL period
//    global $db, $logger, $lineOfBusinessOid, $data;
//    $expense = 0.0;
//    $month = 0;
//    $year = 0;
//    $sql = "SELECT hours, salaryAmount, salarytype, lobOid "
//        . "FROM empotherworkhrs_vw "
//        . "WHERE (attendanceDt BETWEEN '$targetStartDt' AND '$targetEndDt') AND lobOid = $lineOfBusinessOid";
//    $rows = $db->query($sql);
//    $logger->debug('getOtherworkExpense()', $db->getLastQuery());
//    $logger->debug('getOtherworkExpense()', $rows);
//    if ($rows) {
//        foreach($rows as $row) {
//            $expense += getEmployeeExpensebySalaryType($row);
//        }
//    } 
//    $data['labourOtherWorkExpenses'] = round($expense,2);
//    return;
//}

function getEmployeeExpensebySalaryType($row){
    global $year, $month;
    
	switch($row['salarytype']){
		case "D":
            $denominator = 8;
		break;
		case "M":
            $denominator = (date('t', mktime(0, 0, 0, $month, 1, $year)))*8;
		break;
		default:
            throw new Exception("Invalid Salary type in getEmpPArttimeExpense()");
		break;
	}
    return $row['hours']*($row['salaryAmount']/$denominator);
}

function getExpensesByEmployeeType($empType, $sql, $year, $month){
    global $db,$logger; 
    $totExpense = 0.0;
    switch($empType){
        case "CASUAL":
            $sql .= " AND salarytype = 'D' ";
            $denominator = 8;
        break;
        case "SALARIED":
            $sql .= " AND salarytype = 'M' ";
            $denominator = (date('t', mktime(0, 0, 0, $month, 1, $year)))*8; 
            break;
        default:
            throw new Exception("getParttimeExpensesByEmployeeType() invalid Employee Type = ".$empType);
   }    
    
    $rows = $db->query($sql);
    $logger->debug('getExpensesByEmployeeType()', $db->getLastQuery());
    $logger->debug('getExpensesByEmployeeType()[denominator='.$denominator.']', $rows);
    if($rows){
        foreach($rows as $row){
            $hourlyRate = $row['salaryAmount']/$denominator;
            $parttimePay = $row['hours']*$hourlyRate;
            $totExpense = $totExpense + $parttimePay;
        }
    } 
    $logger->debug('getExpensesByEmployeeType()', ['totExpense'=>round($totExpense,2)]);
    return round($totExpense,2);
}

function getGeneralExpenses($year, $month){
    global $db,$logger, $data, $lineOfBusinessOid;
    $data['generalExpenses'] =  0.0;
    $sql = "SELECT IF(SUM(amount) IS NULL, 0, SUM(amount)) AS totGeneralExpense "
        . "FROM expenses "
        . "WHERE YEAR(expenseDate) = $year and MONTH(expenseDate) = $month AND lineOfBusinessOid = $lineOfBusinessOid ";
    $rows = $db->query($sql);
    $logger->debug('getGeneralExpenses()', $db->getLastQuery());
    $logger->debug('getGeneralExpenses()', $rows);
    if($rows){
        foreach($rows as $row){
            $data['generalExpenses'] =  $row['totGeneralExpense'];
        }
    } 
    return;
}

function XXXgetSalaryExpenseAllocation($year, $month){
    global $db,$logger;

    $sql = "SELECT employeeOid,DATE(effectiveDt) AS effectiveDt, DATE(endDt) AS endDt, lineOfBusinessOid, allocation "
        . "FROM employeesalaryexpenseallocation "
        . "WHERE ( ( YEAR(effectiveDt)= $year AND MONTH(effectiveDt)= $month ) OR endDt IS NULL ) "
                . "OR ( YEAR(endDt)= $year AND MONTH(endDt)= $month ) "
        . "AND lineOfBussinessOid = $lineOfBusinessOid "
        . "ORDER BY effectiveDt ASC";
    $rows = $db->query($sql);
    $logger->debug('XXXgetSalaryExpenseAllocation()', $db->getLastQuery());
    $logger->debug('XXXgetSalaryExpenseAllocation()', $rows);
    if($rows){
        foreach($rows as $row){
            $effectiveDt = new DateTime($row['effectiveDt']);
            $endDt = new DateTime($row['endDt']);
            $expense = 0.0;
            while ($startDt < $endDt){
                $totWght = getTotWeightPicked($startDt->format('Y-m-d'), $endDt->format('Y-m-d'),$year, $month);
                $rate = getPayRate($row['employeeOid'], $effectiveDt->format('Y-m-d'), $endDt->format('Y-m-d')); 
                $expense = $expense + ($totWght*$rate);
            }
        }
    }
    else {
       return 0; 
    }    
    return $expense;
}

function getElecExpenses($oid){
    global $db,$logger, $data, $lineOfBusinessOid;
    $data['elecExpenses'] = 0.0;
    $sql = "SELECT lineOfBusinessOid, electricityAccountOid, electricityaccount.accountNbr, allocation, electricityexpense.amount, "
        . "(allocation/100)*electricityexpense.amount AS elecExpense, startOpsMonthlyCalendarOid "
        . "FROM electricityallocation "
        . "INNER JOIN electricityaccount ON electricityaccount.oid = electricityallocation.electricityAccountOid "
        . "INNER JOIN electricityexpense ON electricityexpense.electricityAccounOid = electricityallocation.electricityAccountOid "
        . "WHERE lineOfBusinessOid = $lineOfBusinessOid AND startOpsMonthlyCalendarOid = $oid ";
    $rows = $db->query($sql);
    $logger->debug('getElecExpenses()', $db->getLastQuery());
    $logger->debug('getElecExpenses()', $rows);
    if($rows){
        foreach($rows as $row){
            $data['elecExpenses'] += $row['elecExpense'];
        }
    }    
}

function getSelectedYear($oid){
    global $db; 
    $sql = "SELECT year from opsmonthlycalendar WHERE oid = $oid";
    $rows = $db->query($sql);
    if($rows){
        foreach($rows as $row){
            return $row['year'];
        }
    }
}

function getSelectedMonth($oid){
    global $db,$logger;
    $sql = "SELECT monthNbr from opsmonthlycalendar WHERE oid = $oid";
    $logger->debug('getSelectedMonth()', $db->getLastQuery());
    $rows = $db->query($sql);
    if($rows){
        foreach($rows as $row){
            return $row['monthNbr'];
        }
    }    
}

function getExpenseAllocationByEmployee($targetStartDt, $targetEndDt){
    global $lineOfBusinessOid, $db, $logger;
    
    $sql = "SELECT CONCAT(firstName, ' ', middleInitial, ' ',lastName) AS employeeName, employeesalaryexpenseallocation.employeeOid, "
        . "allocation, employeeroletype.role, employeeRoleTypeOid  "
        . "FROM employeesalaryexpenseallocation "
        . "INNER JOIN( employee, employeerole, employeeroletype ) "
            . "ON ( employee.oid = employeesalaryexpenseallocation.employeeOid "
                . "AND employee.oid = employeerole.employeeOid "
                . "AND employeerole.employeeRoleTypeOid = employeeroletype.oid ) "
        . "WHERE ( ( employeesalaryexpenseallocation.endDt BETWEEN '$targetStartDt' AND '$targetEndDt' ) "
        . "OR( employeesalaryexpenseallocation.effectiveDt BETWEEN '$targetStartDt' AND '$targetEndDt' ) "
        . "OR( employeesalaryexpenseallocation.effectiveDt <= '$targetEndDt' AND employeesalaryexpenseallocation.endDt IS NULL ) ) "
        . "AND lineOfBusinessOid = $lineOfBusinessOid ";
    $rows = $db->query($sql);
    $logger->debug('getExpenseAllocationByEmployee()', $db->getLastQuery());
    $logger->debug('getExpenseAllocationByEmployee()', $rows); 
    if ($rows) {
        foreach ($rows as $row) {
			$emp = Array (
				"employeeOid" => $row["employeeOid"],
				"allocation" => $row["allocation"]
				);
			$employees[$row["employeeOid"]] = $emp;
        }  
    }
    $logger->debug('getExpenseAllocationByEmployee()', $employees); 
    return $employees;    
}

function getSalaryAndBonusExpenseFromPayslips($employees, $targetStartDt, $targetEndDt){
    global $data;
    $totPayPeriodBonusAmt = 0.0;
    $opsBiWeeklyCalendarArray = getCasualsPaySlipCalendarPayPeriods($targetStartDt, $targetEndDt); 
    foreach ($opsBiWeeklyCalendarArray as $row) {
        $OpsbiweeklycalendarOid = $row['oid'];
        $totPayPeriodBonusAmt += getCasualsPayPeriodBonusAmount($employees, $OpsbiweeklycalendarOid);
    }
    $data['casualsBonusExpenses'] = $totPayPeriodBonusAmt;
    getFTEpayPeriodSalaryAndBonusAmount($employees, $data['opsMonthlyCalendarOid']);
}

function getCasualsPaySlipCalendarPayPeriods($targetStartDt,$targetEndDt){
    global $db, $logger;

    $sql = "SELECT oid "
        . "FROM opsbiweeklycalendar "
        . "WHERE payDate Between '$targetStartDt' AND '$targetEndDt'";
    $rows = $db->query($sql);
    $logger->debug('getCasualsPaySlipCalendarPayPeriods()', $db->getLastQuery());
    $logger->debug('getCasualsPaySlipCalendarPayPeriods()', $rows);
    if ($rows) {
        return $rows;
    }
}

function getCasualsPayPeriodBonusAmount($employees, $oid){
    global $db, $logger;
    $totBonusPay = 0.0;

    foreach($employees as $emp) {
        $sql = "SELECT bonus "
            . "FROM casualemployeepayslip "
            . "WHERE employeeOid =".$emp["employeeOid"]." AND opsBiWeeklyCalendarOid  = $oid";
        $rows = $db->query($sql);
        $logger->debug('getCasualsPayPeriodBonusAmount()', $db->getLastQuery());
        if ($rows) {
            foreach ($rows as $row) {
                $allocation = ($employees[$emp["employeeOid"]]["allocation"])/100;
                $logger->debug('getCasualsPayPeriodBonusAmount()', ['bonus'=>$row['bonus'], 'allocation'=>$allocation]); 
                $totBonusPay += ($row['bonus']*$allocation);
            }  
        } 
    }  
    return $totBonusPay;
}

function getFTEpayPeriodSalaryAndBonusAmount($employees, $opsMonthlyCalendarOid){
    global $db, $logger, $data;
    $totBonusExpense = 0.0;
    $totSalaryExpense = 0.0;
    foreach($employees as $emp) {
        $sql = "SELECT bonus, salaryAmount FROM fteemployeepayslip "
            . "WHERE opsMonthlyCalendarOid = $opsMonthlyCalendarOid AND employeeOid = ".$emp["employeeOid"];
        $rows = $db->query($sql);
        $logger->debug('getFTEpayPeriodSalaryAndBonusAmount()', $db->getLastQuery());
        $logger->debug('getFTEpayPeriodSalaryAndBonusAmount()', $rows);
        if ($rows) {
            foreach($rows as $row) {
                $allocation = ($employees[$emp["employeeOid"]]["allocation"])/100;
                $logger->debug('getFTEpayPeriodSalaryAndBonusAmount()', ['bonus'=>$row['bonus'], 'allocation'=>$allocation]); 
                $logger->debug('getFTEpayPeriodSalaryAndBonusAmount()', ['salaryAmount'=>$row['salaryAmount'], 'allocation'=>$allocation]); 
                $totBonusExpense += ($row['bonus']*$allocation); 
                $totSalaryExpense += ($row['salaryAmount']*$allocation);
            }
        } 
    }
    $data['fteBonusExpenses'] = $totBonusExpense;
    $data['fteSalaryExpenses'] = $totSalaryExpense;    
}

function getParttimeExpense($targetStartDt,$targetEndDt){
    //get parttime expense by LOB during PandL period. Assumes payslip is locked for this period
    global $db, $logger, $lineOfBusinessOid;
    $expense = 0.0;
    
    $sql = "SELECT hours, salaryAmount, salarytype, lobOid "
        . "FROM empparttimehrs_vw "
        . "WHERE (attendanceDt BETWEEN '$targetStartDt' AND '$targetEndDt') AND lobOid = $lineOfBusinessOid";
    $rows = $db->query($sql);
    $logger->debug('getParttimeExpense()', $db->getLastQuery());
    $logger->debug('getParttimeExpense()', $rows);
    if ($rows) {
        foreach($rows as $row) {
            $expense += getEmployeeExpensebySalaryType($row);
        }
    } 
    return round($expense,2);
}

function getParttimeExpensesByRole($targetStartDt, $targetEndDt){
    global $db, $logger, $lineOfBusinessOid ; 
    $roleExpense = Array();
    
//    $opsBiWeeklyCalendarArray = getCasualsPaySlipCalendarPayPeriods($targetStartDt, $targetEndDt); 

    $sql = "SELECT empparttimehrs_vw.eOid ,employeerole.employeeRoleTypeOid AS roleOid, SUM(hours) AS totHrs, salaryAmount, salarytype "
        . "FROM empparttimehrs_vw "
        . "INNER JOIN( employee, employeerole, employeeroletype ) "
            . "ON ( empparttimehrs_vw.eOid = employee.oid "
                . "AND employee.oid = employeerole.employeeOid "
                . "AND employeerole.employeeRoleTypeOid = employeeroletype.oid ) "
        . "WHERE ( attendanceDt BETWEEN '$targetStartDt' AND '$targetEndDt' ) "
            . "AND lobOid = $lineOfBusinessOid "
        . "GROUP BY empparttimehrs_vw.eOid ,salaryAmount,salarytype, employeerole.employeeRoleTypeOid";
    $rows = $db->query($sql);
    $logger->debug('getParttimeExpensesByRole()', $db->getLastQuery());
    $logger->debug('getParttimeExpensesByRole()', $rows);
    if ($rows) {
        foreach($rows as $row) {
            $expense = calculateExpense($row['totHrs'],$row['salaryAmount'],$row['salarytype']);
            if(array_key_exists($row['roleOid'], $roleExpense)){
                $roleExpense[$row['roleOid']] = $roleExpense[$row['roleOid']]+$expense;
            }
            else {
                $roleExpense[$row['roleOid']] = $expense;
            }
        }
    }      
    $logger->debug('getParttimeExpensesByRole()', $roleExpense);
    return fillEmptyRoleTypes($roleExpense);
}

function getOtherWorkExpensesByRole($targetStartDt, $targetEndDt){
    global $db, $logger, $lineOfBusinessOid ; 
    $roleExpense = Array();
    
//    $opsBiWeeklyCalendarArray = getCasualsPaySlipCalendarPayPeriods($targetStartDt, $targetEndDt); 

    $sql = "SELECT empotherworkhrs_vw.eOid ,employeerole.employeeRoleTypeOid AS roleOid, SUM(hours) AS totHrs, salaryAmount, salarytype "
        . "FROM empotherworkhrs_vw "
        . "INNER JOIN( employee, employeerole, employeeroletype ) "
            . "ON ( empotherworkhrs_vw.eOid = employee.oid "
                . "AND employee.oid = employeerole.employeeOid "
                . "AND employeerole.employeeRoleTypeOid = employeeroletype.oid ) "
        . "WHERE ( attendanceDt BETWEEN '$targetStartDt' AND '$targetEndDt' ) "
            . "AND lobOid = $lineOfBusinessOid "
        . "GROUP BY empotherworkhrs_vw.eOid ,salaryAmount,salarytype, employeerole.employeeRoleTypeOid";
    $rows = $db->query($sql);
    $logger->debug('getOtherWorkExpensesByRole()', $db->getLastQuery());
    $logger->debug('getOtherWorkExpensesByRole()', $rows);
    if ($rows) {
        foreach($rows as $row) {
            $expense = calculateExpense($row['totHrs'],$row['salaryAmount'],$row['salarytype']);
            if(array_key_exists($row['roleOid'], $roleExpense)){
                $roleExpense[$row['roleOid']] = $roleExpense[$row['roleOid']]+$expense;
            }
            else {
                $roleExpense[$row['roleOid']] = $expense;
            }
        }
    }      
    $logger->debug('getOtherWorkExpensesByRole()', $roleExpense);
    return fillEmptyRoleTypes($roleExpense);
}

function combineExpensesByRole($parttimeExpensesByRole,$otherWorkExpensesByRole){
    global $logger;
    $totExpenseByRole = [];
    $roles = getEmployeeRoleTypes();
    foreach($roles as $aRole) {
        $totExpenseByRole[$aRole['oid']] = $parttimeExpensesByRole[$aRole['oid']] + $otherWorkExpensesByRole[$aRole['oid']];
    }   
    $logger->debug('combineExpensesByRole()', $totExpenseByRole);
    return $totExpenseByRole;
}

function calculateExpense($totHrs,$salaryAmount,$salarytype){
    $denominator = getDenominator($salarytype);
    return $totHrs*($salaryAmount/$denominator);
}

function fillEmptyRoleTypes($currentRoles){
    global $logger;
    $availableRoles = getEmployeeRoleTypes();
    foreach($availableRoles as $aRole) {
        if(!array_key_exists($aRole['oid'], $currentRoles)){    
            $currentRoles[$aRole['oid']] = 0.0;
        }
    }
    $logger->debug('fillEmptyRoleTypes()', $currentRoles);
    return $currentRoles;
}

function getEmployeeRoleTypes(){
    global $db, $logger; 
    
    $sql = "SELECT oid, role FROM employeeroletype";
    $rows = $db->query($sql);
    $logger->debug('getEmployeeRoleTypes()', $db->getLastQuery());
    $logger->debug('getEmployeeRoleTypes()', $rows);
    return $rows;    
}

//UNUSED
//function getOtherLaborExpense($yr, $mth){
//    global $logger, $data, $year, $month, $expensesByRole;
//    $year = $yr;
//    $month = $mth;
//    
//    $targetStartDt = new DateTime($year."-".$month."-01");
//    $targetEndDt = new DateTime($year."-".$month."-01");
//    $targetEndDt->modify('last day of this month'); 
//    $logger->debug('getOtherLaborExpense()',['$targetStartDt'=>$targetStartDt->format('Y-m-d'), '$targetEndDt'=>$targetEndDt->format('Y-m-d')]);
//    
//    //allocation applies to Bonus and Salary payments ONLY
//    $employeesAllocationArray = getExpenseAllocationByEmployee($targetStartDt->format('Y-m-d'),$targetEndDt->format('Y-m-d'));
//    getSalaryAndBonusExpenseFromPayslips($employeesAllocationArray, $targetStartDt->format('Y-m-d'),$targetEndDt->format('Y-m-d'));
//    
//    //parttime & otherwork expense driven by LOB value
//    $data['labourParttimeExpenses'] = getParttimeExpense($targetStartDt->format('Y-m-d'),$targetEndDt->format('Y-m-d'));
//  
//    getOtherworkExpense($targetStartDt->format('Y-m-d'),$targetEndDt->format('Y-m-d'));
//    $logger->debug('getOtherLaborExpense()', ['labourOtherWorkExpenses'=>$data['labourOtherWorkExpenses']]);
//    
//}
function getDenominator($salarytype){
    global $year, $month;
	switch($salarytype){
		case "D":
            $denominator = 8;
		break;
		case "M":
            $denominator = (date('t', mktime(0, 0, 0, $month, 1, $year)))*8;
		break;
		default:
            throw new Exception("Invalid Salary type in getEmpPArttimeExpense()");
		break;
	}    
    return $denominator;
}

function savePandLexpenseDetails($oid,$expensesByRole){
    global $db,$logger, $LOB;
    $id = 0;    
    switch($LOB){
        case "FISH":
            $oidColumnNm = "FishPandLOid";
            $tableNm = "FishPandLlabourExpenseDetail";
            break;
        case "TEA":
            $oidColumnNm = "teaPandLOid";
            $tableNm = "TeaPandLlabourExpenseDetail";
            break;
        case "DAIRY":
            $oidColumnNm = "DairyPandLOid";
            $tableNm = "DairyPandLlabourExpenseDetail";
            break;
        case "MUSHROOM":
            $oidColumnNm = "mushroomPandLOid";
            $tableNm = "MushroomPandLlabourExpenseDetail";
            break;
        case "HORTICULTURE":
        case "HORTICULTURE-KARANJA":
        case "HORTICULTURE-GREENHOUSE":
        case "HORTICULTURE-NJOGU":
            $oidColumnNm = "HorticulturePandLOid";
            $tableNm = "HorticulturePandLlabourExpenseDetail";            
            break;
        case "GENERAL":
        case "CONSTRUCTION":
            throw new Exception("savePandLexpenseDetails() undefined for ".$LOB);
        default:
            throw new Exception("savePandLexpenseDetails() undefined for ".$LOB);
    }    
    foreach ($expensesByRole as $key => $value) {
        $d = Array();
        $d[$oidColumnNm]=$oid;
        $d['employeeRoleOid']=$key;
        $d['expenseAmount']=$value;
        $id = $db->insert ($tableNm, $d);
        $logger->debug('savePandLexpenseDetails()', $db->getLastQuery());
        if ($db->getLastErrno() != 0) {
            throw new Exception($db->getLastError());
        }        
    }
    return $id;
}

function getCalendarOidsArray(){
    global $db,$logger, $LOB;
    $oidsArray = [];
    $sql = "SELECT oid FROM opsmonthlycalendar WHERE year = YEAR(CURRENT_DATE)";    
    $rows = $db->query($sql);
    $logger->debug('getCalendarOidsArray()', $db->getLastQuery());
    $logger->debug('getCalendarOidsArray()', $rows);
    if($rows){
        foreach($rows as $row){
            array_push($oidsArray, $row['oid']);
        }
        return $oidsArray;        
    } 
    else {
        throw new Exception("Error fetching Monthly Calendar Oids");
    }
}