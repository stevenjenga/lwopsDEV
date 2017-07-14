<?php
require_once('functions.php');

global $lineOfBusinessOid, $LOB, $data, $year, $month, $expensesByRole;

function getFactoryWght($year, $month){
    global $data, $db, $logger;
    $sql ="SELECT TeaFactoryDelivery.oid, IF(SUM(nbrOfTrips) IS NULL,0,SUM(nbrOfTrips)) AS nbrOfTrips, "
        . "IF( SUM(factoryWeight) IS NULL, 0, SUM(factoryWeight) ) AS factoryWeight "
        . "FROM TeaFactoryDelivery "
        . "WHERE YEAR(entryDateTm ) = $year AND MONTH(entryDateTm ) = $month ";
    $rows = $db->query($sql);
    $logger->debug('getFactoryWght()', $db->getLastQuery());
    $logger->debug('getFactoryWght()', $rows);
    if($rows){
        foreach($rows as $row){
            $data['factoryWeight'] = $row['factoryWeight'];
            $data['nbrOfTrips'] = $row['nbrOfTrips'];
            return;
        }
    }
    else {
        $data['factoryWeight'] = 0;
        $data['nbrOfTrips'] = 0;        
    }
}

function getTeaFactoryRate($oid){
    //this function will maintain the same rate until the query finds a new rate which will then continue!!
    global $data, $db, $logger;    
    $sql = "SELECT rate "
        . "FROM `teafactoryrate` "
        . "WHERE startOpsMonthlyCalendarOid  = $oid ";
    $rows = $db->query($sql);
    $logger->debug('getTesFactoryRate()', $db->getLastQuery());
    $logger->debug('getTesFactoryRate()', $rows);
    if($rows){
        foreach($rows as $row){
            $data['factoryPurchaseRate'] = $row['rate'];
            return;
        }
    }   
    else {
        throw new Exception("Factory rate for Tea is undefined");
    }
}

function getTeaPurchases($year, $month){
    global $data, $db, $logger;
    $sql = "SELECT purchaseType, IF(SUM(quantity*unitPrice) IS NULL, 0, SUM(quantity*unitPrice)) AS purchaseAmount "
        . "FROM teafactorypurchases "
        . "WHERE YEAR(purchaseDt) = $year AND MONTH(purchaseDt) = $month "
        . "GROUP BY purchaseType";
    $rows = $db->query($sql);
    $logger->debug('getTeaPurchases()', $db->getLastQuery());
    $logger->debug('getTeaPurchases()', $rows);
    if($rows){
        foreach($rows as $row){
            switch($row['purchaseType']){
                case "DELIVERY BOOK":
                    $data['purchasesDeliveryBook'] = $row['purchaseAmount'];
                break;
                case "FERTILIZER":
                    $data['purchasesFertilizer'] = $row['purchaseAmount'];
                break;
                case "LOOSE TEA":
                    $data['looseTeaPurchases'] = $row['purchaseAmount'];
                break;
                case "TEA BAGS":
                    $data['teaBagPurchases'] = $row['purchaseAmount'];
                break;             
                case "ROUND-UP": 
                    $data['purchasesRoundup'] = $row['purchaseAmount'];
                break; 
                case "OTHER": 
                    $data['otherPurchases'] = $row['purchaseAmount'];
                break;             
                default:
                    throw new Exception("getTeaPurchases():Invalid purchaseType = ".$row['purchaseType']);
            }            
        }  
    }    
    else{
        $data['purchasesDeliveryBook'] = 0.0;
        $data['purchasesFertilizer'] = 0.0;
        $data['looseTeaPurchases'] = 0.0;
        $data['teaBagPurchases'] = 0.0;
        $data['purchasesRoundup'] = 0.0;
        $data['otherPurchases'] = 0.0;
    }  
    return;
}

function getMadeTeaExpenses(){
    global $data, $db, $logger;
    $sql = "SELECT oid, purchaseDt, type, quantity, unitPrice, IF(SUM(quantity*unitPrice) IS NULL, 0, SUM(quantity*unitPrice)) AS madeTeaExpenses "
        . "FROM TeaFactoryPurchases "
        . "WHERE YEAR(deliveryDt) = $year AND MONTH(deliveryDt) = $month ";
    $rows = $db->query($sql);
    $logger->debug('getTeaPurchases()', $db->getLastQuery());
    $logger->debug('getTeaPurchases()', $rows);
    if($rows){
        foreach($rows as $row){
            $data['madeTeaExpenses'] = $row['madeTeaExpenses'];
            return;
        }
    }     
}

function getTeaBonus($oid){
   global $data, $db, $logger;     
   $sql = "SELECT IF(SUM(amount) IS NULL, 0,SUM(amount)) as bonusAmount FROM TeaBonus WHERE opsMonthlyCalendarOid = $oid";
    $rows = $db->query($sql);
    $logger->debug('getTeaBonus()', $db->getLastQuery());
    $logger->debug('getTeaBonus()', $rows);
    if($rows){
        foreach($rows as $row){
            $data['factoryBonus'] = $row['bonusAmount'];
            return;
        }
    }  
}

function getTeaPickersLaborExpenses($year, $month){
    global $db,$logger,$data;
    $expense = 0.0;
    $totWght = 0.0;
    $totExpense = 0.0;    
    
    //get rate by pay period (rate can change from pay period to pay period)
    $sql = "SELECT rate, DATE(startDt) AS startDt, DATE(endDt) AS endDt "
        . "FROM teapickingrate "
        . "WHERE ( ( YEAR(startDt)= $year AND MONTH(startDt)= $month ) OR endDt IS NULL ) "
                . "OR ( YEAR(endDt)= $year AND MONTH(endDt)= $month ) "
        . "ORDER BY teapickingrate.startDt ASC";
    $rows = $db->query($sql);
    $logger->debug('getTeaPickersLaborExpenses()', $db->getLastQuery());
    $logger->debug('getTeaPickersLaborExpenses(rate by pay period)', $rows);
    if($rows){
        foreach($rows as $row){
            $d1 = new DateTime($row['startDt']);
            $d2 = new DateTime($year."-".$month."-01");
            $logger->debug('getTeaPickersLaborExpenses()', ['d1'=>$d1->format('Y-m-d'),'d2'=>$d2->format('Y-m-d')]);
            if ($d1 < $d2) {
                $startDt = $d2;
            }
            else{
                $startDt = $d1;
            }
            if (is_null($row['endDt'])) {
                //get the last day of the target month
                $endDt = new DateTime($year."-".$month."-01");
                $endDt->modify('last day of this month');
            }
            else {
                $endDt = new DateTime($row['endDt']);
            }
            $logger->debug('getTeaPickersLaborExpenses()', ['endDt'=>$endDt->format('Y-m-d')]);
            $expense = 0.0;
            $totWght = getTotWeightPicked($startDt->format('Y-m-d'), $endDt->format('Y-m-d'));
            $expense = ($totWght*$row['rate']);
            $totExpense = $totExpense + $expense;
        }
    }
    $data['labourTeaPickersExpenses'] = $totExpense;
    $logger->debug('getTeaPickersLaborExpenses()', ['labourTeaPickersExpenses'=>$totExpense]);
}

function getTotWeightPicked($startDt, $endDt){
   global $db,$logger;    
   $sql = "SELECT IF( SUM(weight) IS NULL, 0, SUM(weight) ) AS totWeight "
       . "FROM empteapickingdetail_vw "
       . "WHERE attendanceDt BETWEEN '".$startDt."' AND '".$endDt."' "; 

    $rows = $db->query($sql);
    $logger->debug('getTotWeightPicked()', $db->getLastQuery());
    $logger->debug('getTotWeightPicked()', $rows);
    if($rows){
        foreach($rows as $row){
            return $row['totWeight'];
        }
    }    
}

function getTeaPayRate($startDt, $endDt){
   global $db, $logger;    
   $sql = "SELECT rate FROM `teapickingrate` WHERE startDt = '".$startDt."' AND endDt = '".$endDt."'";
    $rows = $db->query($sql);
    $logger->debug('getTeaPayRate()', $db->getLastQuery());
    $logger->debug('getTeaPayRate()', $rows);
    if($rows){
        foreach($rows as $row){
            return $row['rate'];
        }
    }     
}

function getCessExpenses(){
    global $data;
    $cessRate = 1/100;
    $data['cessExpenses'] = $cessRate*($data['factoryWeight']*$data['factoryPurchaseRate']);
    return;
}

function getTripExpenses($oid){
    global $data, $db, $logger;  
    $data['tripExpenses'] = 0.0;
    $sql = "SELECT rate FROM teafactorytriprate WHERE startOpsMonthlyCalendarOid = $oid ";
    $rows = $db->query($sql);
    $logger->debug('getTripExpenses()', $db->getLastQuery());
    $logger->debug('getTripExpenses()', $rows);
    if ($rows) {
        foreach ($rows as $row) {
            $data['tripExpenses'] = $data['nbrOfTrips'] * $row['rate'];
        }
    }
    return;
}

function getPruningExpense(){
    global $data, $db, $logger; 
    
    $data['pruningExpense'] = 0.0;
}
