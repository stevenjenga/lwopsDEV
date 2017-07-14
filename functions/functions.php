<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once $root.'/logger-php-master/src/Logger.php';
require_once('expenseFunctions.php');

use SurrealCristian\Logger;

require_once __DIR__ . '/../database/database.php';

global $logger;
$logger = new Logger('NAME', "debug.log", 'debug');

global $errorLogger;
$errorLogger = new Logger('NAME', "debug.log", 'debug');

global $db;
$db->setTrace(true);
$db->withTotalCount();


function checkRowExist() {
    /*
      checkRowExist function return the total count by employee id
      gr_id is a employee id that sent by dhtmlx
     */
    global $db;
    $sql = "select COUNT(*) as count from employee where oid='" . $_GET['gr_id'] . "' ";
    $result = $db->query($sql);
    return $result[0]['count'];
}

function checkRowExistGr() {
    /*
      checkRowExistGr function return the total count by employee id
      gr_id is a grid id(in term of grid) that sent by dhtmlx
      function will check if grid id is already exist.
      gr_id uses for first time insertion and current update time for employee.
      when you use refresh the page the gr_id is change to orignal id of employee
     */
    global $db;
    $sql = "select COUNT(*) as count from employee where gr_id='" . $_GET['gr_id'] . "' ";
    $result = $db->query($sql);
    return $result[0]['count'];
}

function checkRowExistInTable($tableName) {
    /*
      checkRowExistGr function return the total count by employee id
      gr_id is a grid id(in term of grid) that sent by dhtmlx
      function will check if grid id is already exist.
      gr_id uses for first time insertion and current update time for employee.
      when you use refresh the page the gr_id is change to orignal id of employee
     */
    global $db;
    $sql = "select COUNT(*) as count from $tableName where gr_id='" . $_GET['gr_id'] . "' ";

    $result = $db->query($sql);
    return $result[0]['count'];
}

function getEmployeeSalaryDetails($employeeOid, $periodStartDt, $periodEndDt) {
    global $db;
    global $logger;
    $salarytype = '';
    $salarySql = "SELECT employeeOid, employeetype, amount, salarytype, effectivetDt, endDt, DAY(LAST_DAY('$periodEndDt')) AS nbrOfDaysInMonth 
	FROM salary 
	WHERE ((effectivetDt > '$periodStartDt' AND endDt < '$periodEndDt') OR (effectivetDt > '$periodStartDt' AND endDt IS NULL) OR (effectivetDt < '$periodStartDt' AND endDt IS NULL)) AND employeeOid = $employeeOid";
    $rows = $db->query($salarySql);
    //$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->getLastQuery());
    if ($rows) {
        foreach ($rows as $row) {
            $amount = $row['amount'];
            $salarytype = $row['salarytype'];
            $nbrOfDaysInMonth = $row['nbrOfDaysInMonth'];
        }
    }
    if (!(strcmp($salarytype, 'D')))
        $rate = $amount / 8;
    elseif (!(strcmp($salarytype, 'H')))
        $rate = $amount;
    elseif (!(strcmp($salarytype, 'W')))
        $rate = $amount / (45);
    elseif (!(strcmp($salarytype, 'M')))
        $rate = $amount / ($nbrOfDaysInMonth * 8);
    else {
        $rate = 0;
        $amount = 0;
    }
    $data = Array("amount" => $amount,
        "salarytype" => $salarytype,
        "rate" => $rate
    );
    return $data;
}

function add_employee($internalCall = 0) {
    global $db;
    global $logger;

    try {
        $logger->debug('add_employee() -GET', $_GET);

        $data = Array("firstName" => $_GET["c0"],
            "middleInitial" => strtoupper(trim(($_GET["c1"]))),
            "lastName" => $_GET["c2"],
            "nationalID" => $_GET["c4"],
            "mobileNbr" => $_GET["c5"],
            "resident" => $_GET["c6"],
            "elecDeduction" => $_GET["c7"],
            "active" => 1
        );
        if (is_numeric($_GET["c3"])) {
            $data['employeeRoleOid'] = $_GET["c3"];
        }
        if (isset($_GET['c9'])) {
            $startDate = new DateTime($_GET['c9']);
            $data['startDt'] = $startDate->format('Y-m-d');
        }
        $id = $db->insert('employee', $data);
        $logger->debug('add_employee()', $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
        if ($internalCall) {return ;}
            else {return array('inserted', $id, $id, $_GET['c9'], "SUCCESS!!");}
        } else {
            if ($internalCall) {throw new Exception($db->getLastError());}
            else {return array('error', $id, $id, $_GET['c9'], $db->getLastError());}
        }
    } catch (Exception $e) {
        $logger->debug("add_employee()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }
}

function update_employee($rowId) {
    global $db, $logger;
    
    try {
        $logger->debug('update_employee() -GET', $_GET);
        
        if (isTerminatedEmployee($rowId)){
            return array('error', $rowId, $rowId, "Update of Terminated employee not allowed");
        }
        
        $data = Array();
        if (is_numeric($_GET["c3"])) {
            if (isRoleChange($rowId, $_GET["c3"])){
                $data['employeeRoleOid'] = getCurrentRole($rowId);
                $data['terminated'] = 1;
                $data['active'] = 0;

                $db->startTransaction();
                terminateCurrentEmpRecord($data, $rowId);
                add_employee(1);
                $db->commit();
                return array('updated', $rowId, $rowId, "SUCCESS!!");
            }
        } else {
            $data = Array(
                "firstName" => $_GET["c0"],
                "middleInitial" => strtoupper(trim(($_GET["c1"]))),
                "lastName" => $_GET["c2"],
                "nationalID" => $_GET["c4"],
                "mobileNbr" => $_GET["c5"],
                "resident" => $_GET["c6"],
                "elecDeduction" => $_GET["c7"],
                "active" => $_GET["c8"]
            );
            
            if (isset($_GET['c9'])) {
                $dateStart = new DateTime($_GET['c9']);
                $data['startDt'] = $dateStart->format('Y-m-d');
            }

            $db->where('oid', $rowId);
            $db->update('employee', $data);
            $logger->debug('update_employee() (db2)', $db->getLastQuery());
            if ($db->getLastErrno() === 0)
                return array('updated', $rowId, $rowId, "SUCCESS!!");
            else
                return array('error', $rowId, $rowId, $db->getLastError());        
        }
    } catch (Exception $e) {
        $db->rollback();
        $logger->debug("update_employee()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }
}

function add_employeeResidency(){
    global $db, $logger;
    try {
        $logger->debug('add_employeeResidency()', $_GET);
        $data = Array();
        if (is_numeric($_GET["c0"])) {
            $data['employeeOid'] = $_GET["c0"];
        } 
        if (strlen($_GET['c1'])) {
            $dateStart = new DateTime($_GET['c1']);
            $data['effectiveDt'] = $dateStart->format('Y-m-d');
        }
        if (strlen($_GET['c2'])) {
            $dateStart = new DateTime($_GET['c2']);
            $data['endDt'] = $dateStart->format('Y-m-d');
        }        
        $data['deductionAmt'] = $_GET['c3'];
        $logger->debug("add_employeeResidency(data)", $data);
        $id = $db->insert('employeeresidency', $data);
        $logger->debug('add_employeeResidency()', $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $id, $id, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_employeeResidency()", ['ERROR:' => $e]);
        $db->rollback();        
        return array('error', 0, 0, $e->getMessage());
    }     
}

function update_employeeResidency($rowId){
    global $db;
    global $logger;
    $logger->debug("update_employeeResidency()", $_GET);

    try {
        $data = Array();
        if (is_numeric($_GET["c0"])) {
            $data['employeeOid'] = $_GET["c0"];
        }
        if (strlen($_GET['c1'])) {
            $d = new DateTime($_GET['c1']);
            $data['effectiveDt'] = $d->format('Y-m-d');
        }
        if (strlen($_GET['c2'])) {
            $dateStart = new DateTime($_GET['c2']);
            $data['endDt'] = $dateStart->format('Y-m-d');
        } 
        $data['deductionAmt'] = $_GET['c3'];
        $logger->debug("update_employeeResidency() ", $data);
        $db->where('oid', $rowId);
        $db->update('employeeresidency', $data);
        $logger->debug("update_employeeResidency() ", $db->getLastQuery());

        if ($db->getLastErrno() === 0) {
            return array('updated', $rowId, $rowId, "SUCCESS!!");
        } else {
            return array('error', $rowId, $rowId, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("update_employeeResidency()", ['ERROR:' => $e]);
        return array('error', $rowId, $rowId, $e->getMessage());
    }    
}

function add_employeesRole(){
    global $db, $logger;
    try {
        $logger->debug('add_employeesRole()', $_GET);
        $data = Array();
        if (is_numeric($_GET["c1"])) {
            $data['employeeRoleTypeOid'] = $_GET["c1"];
        } 
        if (isset($_GET['c2'])) {
            $dateStart = new DateTime($_GET['c2']);
            $data['effectiveDt'] = $dateStart->format('Y-m-d');
        }
        $data['employeeOid'] = $_GET["c4"];
        $logger->debug("add_employeesRole(data)", $data);
        $id = $db->insert('employeerole', $data);
        $logger->debug('add_employeesRole()', $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $id, $id, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_employeesRole()", ['ERROR:' => $e]);
        $db->rollback();        
        return array('error', 0, 0, $e->getMessage());
    }    
}

function update_employeesRole($rowId){
    global $db, $logger;
    try {
        $logger->debug('update_employeesRole()', $_GET);
        $data = Array();
        
        if (is_numeric($_GET["c1"])) { 
        //role changed
            if (isset($_GET['c3'])) {
            //terminate current role by updating the end date
                if (strlen($_GET['c3'])) {
                    $date = new DateTime($_GET['c3']);
                }                
                else {
                    return array('error', $rowId, $rowId, "End Date must be specified in order to change the employeed role.");
                }
                $data['endDt'] = $date->format('Y-m-d');
                $db->startTransaction();
                $db->where('oid', $rowId);
                $db->update('employeerole', $data);
                $logger->debug('update_employeesRole()', $db->getLastQuery());
                if ($db->getLastErrno() != 0) {
                    $db->rollback();
                    return array('error', $id, $id, $db->getLastError());
                }                
                // create a new role record
                add_employeesRole(); 
                $db->commit();
            } 
            else {
                return array('error', $rowId, $rowId, "End Date must be specified in order to change the employeed role.");
            }
        }
        else {
            if (isset($_GET['c2'])) {
                $date = new DateTime($_GET['c2']);
                $data['effectiveDt'] = $date->format('Y-m-d');
            }  
            if (strlen($_GET['c3'])) {
                $date = new DateTime($_GET['c3']);
                $data['endDt'] = $date->format('Y-m-d');                
            }
            $data['employeeOid'] = $_GET["c4"];
            $db->where('oid', $rowId);
            $db->update('employeerole', $data);
            $logger->debug("update_employeesRole() ", $db->getLastQuery());
            if ($db->getLastErrno() === 0)
                return array('updated', $rowId, $rowId, "SUCCESS!!");
            else
                return array('error', $rowId, $rowId, $db->getLastError());  
        }
      
    } catch (Exception $e) {
        return array('error', 0, 0, $e->getMessage());
    }    
}

function isTerminatedEmployee($empOid){
    global $db, $logger;

    $rows = $db->query("SELECT `terminated` from employee WHERE oid = $empOid LIMIT 1");
    $logger->debug("isTerminatedEmployee()", $db->getLastQuery());
    if ($db->getLastErrno() != 0) {
        throw new Exception($db->getLastError()); 
    }    
    foreach ($rows as $row) {
        return $row['terminated'];
    }    
}

function isRoleChange($empOid, $newRoleOid){
    global $db, $logger;

    $rows = $db->query("SELECT employeeRoleOid from employee WHERE oid = $empOid LIMIT 1");
    $logger->debug("isRoleChange()", $db->getLastQuery());
    if ($db->getLastErrno() != 0) {
        throw new Exception($db->getLastError()); 
    }
    foreach ($rows as $row) {
        if ($newRoleOid != $row['employeeRoleOid']){
            return true;
        }
        else {
            return false;
        }
    }
}

function getCurrentRole($empOid){
    global $db, $logger;
    $rows = $db->query("SELECT employeeRoleOid from employee WHERE oid = $empOid LIMIT 1");
    $logger->debug("getCurrentRole()", $db->getLastQuery());
    if ($db->getLastErrno() != 0) {
        throw new Exception($db->getLastError()); 
    }    
    foreach ($rows as $row) {
        return $row['employeeRoleOid'];
    }    
}

function getSalaryByDate($employeeOid, $dateStr){
    global $db, $logger;
    $sql = "SELECT `amount`,`effectivetDt`, `endDt` "
        . "FROM `salary` "
        . "WHERE `employeeOid` = $employeeOid "
        . "AND ( (`effectivetDt` <= '$dateStr' AND `endDt` IS NULL) OR (`effectivetDt` <= '$dateStr' AND `endDt` >= '$dateStr'))";
    $rows = $db->query($sql);
    $logger->debug("getSalaryByDate()", $db->getLastQuery());
    if ($db->getLastErrno() != 0) {
        throw new Exception($db->getLastError()); 
    }    
    $logger->debug("getSalaryByDate()", $rows);
    foreach ($rows as $row) {
        return $row['amount'];
    }     
}

//$periodStartDateStr and $periodEndDateStr MUST coincide with pay period (monthly or biWeekly) start and end dates 
function getSalaryByDateRange($employeeOid, $periodStartDateStr, $periodEndDateStr){
    global $db, $logger;
    $sql = "SELECT `amount`,`effectivetDt`, `endDt` "
        . "FROM `salary` "
        . "WHERE `employeeOid` = $employeeOid "
        . "AND ( (effectivetDt >= '$periodStartDateStr' AND endDt <= '$periodEndDateStr') "
            . "OR(effectivetDt <= '$periodStartDateStr' AND endDt IS NULL))";
    $rows = $db->query($sql);
    $logger->debug("getSalaryByDateRange()", $db->getLastQuery());
    if ($db->getLastErrno() != 0) {
        throw new Exception($db->getLastError()); 
    }    
    $logger->debug("getSalaryByDateRange()", $rows);
    if ($rows) {
        foreach ($rows as $row) {
            return $row['amount'];
        }
    } else {
        throw new Exception("No salary found for date range $periodStartDateStr to $periodEndDateStr for selected employee"); 
    }   
}

function terminateCurrentEmpRecord($data, $empOid){
    global $db, $logger;
    
    $db->where('oid', $empOid);
    $db->update('employee', $data);
    $logger->debug('terminateCurrentEmpRecord()', $db->getLastQuery());   
    if ($db->getLastErrno() === 0) {
        add_employeeTermination($empOid);
        return;
    }
    else {
        throw new Exception($db->getLastError());            
    }    
}

function add_employeeTermination($empOid){
    global $db, $logger;
    $data = Array();
    
    $data['employeeOid'] = $empOid;
    $data['terminationDate'] = date('Y-m-d');
    $data['employeeTerminationType'] = "ROLE CHANGE";
    $data['comments'] = "Change of role";
    $id = $db->insert('EmployeeTermination', $data);
    $logger->debug('add_employeeTermination()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return;
    } else {
        throw new Exception($db->getLastError());
    }    
}

function terminate_employee($rowId) {
    global $db, $logger;
    $logger->debug('terminate_employee() -GET', $_GET);

    $terminateDate = "0000-00-00";

    if ($_GET['c6'] == 0 && $_GET['c7'] == "") {
        $terminateDate = "";
    } else if ($_GET['c6'] == 0 && $_GET['c7'] != "") {
        $tdDate = date('Y-m-d', strtotime($_GET['c7']));
        $terminateDate = $tdDate;
    } else if ($_GET['c6'] == 1) {
        $terminateDate = "0000-00-00";
    } else {
        $terminateDate = "0000-00-00";
    }

    if ($_GET['c6'] == 0)
        $data = Array(
            "firstName" => $_GET["c0"],
            "middleInitial" => $_GET["c1"],
            "lastName" => $_GET["c2"],
            "nationalID" => $_GET["c3"],
            "mobileNbr" => $_GET["c4"],
            "resident" => $_GET["c5"],
            'active' => $_GET["c6"],
            'terminationDt' => date('Y-m-d', strtotime($_GET['c7']))
        );

    if (checkRowExistGr() > 0) {
        $db->where('gr_id', $grid);
        $db->update('employee', $data);
    } else {
        $db->where('oid', $grid);
        $db->update('employee', $data);
    }

    $logger->debug("update_attendance_row() ", $db->getLastQuery());
    if ($db->getLastErrno() === 0)
        return array('updated', $rowId, $rowId, "SUCCESS!!");
    else
        return array('error', $rowId, $rowId, $db->getLastError());
}

function delete_row() {
    
}

function update_attendance_row($rowId) {
    global $db;
    global $db;
    global $logger;
    $logger->debug("update_attendance_row() ", $_GET);

    $data = Array(
        "attendance_in" => $_GET["c1"],
    );
    $db->where('oid', $rowId);
    $db->update('attendance', $data);
    $logger->debug("update_attendance_row() ", $db->getLastQuery());
    if ($db->getLastErrno() === 0)
        return array('updated', $rowId, $rowId, "SUCCESS!!");
    else
        return array('error', $rowId, $rowId, $db->getLastError());
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 														DAIRY DATA RELATED CRUD
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_dairysales() {
    global $db;
    global $logger;
    $logger->debug("add_dairysales() ", $_GET);
    $grid = $_GET['gr_id'];

    $data = Array(
        "customerOid" => $_GET["c1"],
        "volume" => round($_GET["c2"], 2),
        "pricePerLiter" => round($_GET["c3"], 2)
    );

    if (isset($_GET['c0'])) {
        $salesDt = new DateTime($_GET['c0']);
        $data['salesDt'] = $salesDt->format('Y-m-d');
    }
    $id = $db->insert('dairysales', $data);
    $logger->debug("add_dairysales() [insert]", $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return array('inserted', $id, $id, "SUCCESS!!");
    } else {
        return array('error', $id, $id, $db->getLastError());
    }
}

function update_dairysales($rowId) {
    global $db;
    global $logger;
    $logger->debug("update_dairysales() ", $_GET);

    $data = Array(
        "volume" => $_GET["c2"],
        "pricePerLiter" => $_GET["c3"]
    );
    if (is_numeric($_GET["c1"])) {
        $data['customerOid'] = $_GET["c1"];
    }
    if (isset($_GET['c0'])) {
        $data['salesDt'] = date('Y-m-d h:i:s', strtotime($_GET['c0']));
    }
    $db->where('oid', $rowId);
    $db->update('dairysales', $data);
    $logger->debug("update_dairysales()[update] ", $db->getLastQuery());
    if ($db->getLastErrno() === 0)
        return array('updated', $rowId, $rowId, "SUCCESS!!");
    else
        return array('error', $rowId, $rowId, $db->getLastError());
}

function add_dairyProduction() {
    global $db, $logger;
    $logger->debug('add_dairyProductionData() -GET', $_GET);
    $grid = $_GET['gr_id'];
    $data = Array(
        "prodDate" => date('Y-m-d', strtotime($_GET['c0'])),
        "DairyCowNameOid" => $_GET["c1"],
        "amVolume" => $_GET["c2"],
        "mdVolume" => $_GET["c3"],
        "pmVolume" => $_GET["c4"]
    );
    $id = $db->insert('dairyproduction', $data);
    $logger->debug('add_dairyProductionData() -2', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return array('inserted', $id, $id, "SUCCESS!!");
    } else {
        return array('error', $id, $id, $db->getLastError());
    }
}

function update_dairyProduction() {
    global $db, $logger;

    $grid = $_GET["gr_id"];
    $data = Array(
        "prodDate" => date('Y-m-d', strtotime($_GET['c0'])),
        "amVolume" => $_GET["c2"],
        "mdVolume" => $_GET["c3"],
        "pmVolume" => $_GET["c4"]
    );

    if (is_numeric($_GET["c0"])) {
        $data['DairyCowNameOid'] = $_GET["c1"];
    }

    $db->where('oid', $grid);
    $db->update('dairyproduction', $data);
    $logger->debug('update_dairyProduction() (db)', $db->getLastQuery());
    $db->where('oid', $grid);
    if ($db->getLastErrno() === 0)
        return array('updated', $grid, $grid, "SUCCESS!!");
    else
        return array('error', $grid, $grid, $db->getLastError());
}

function add_dairyCorpStmt() {
    global $db, $logger;
    $logger->debug('add_dairyCorpStmt()', $_GET);
    $totalDeductions = $_GET["c1"] + $_GET["c2"] + $_GET["c3"];
    $acceptedVol = $_GET["c6"] - $_GET["c7"];
    $rate = $_GET["c5"];
    $grossPay = $acceptedVol * $rate;

    $data = Array(
        "societyShares" => $_GET["c1"],
        "packingShares" => $_GET["c2"],
        "feedExpense" => $_GET["c3"],
        "totalDeductions" => $totalDeductions,
        "rate" => $rate,
        "deliveredQty" => $_GET["c6"],
        "rejectedQty" => $_GET["c7"],
        "acceptedQty" => $acceptedVol,
        "grossPay" => $grossPay,
        "netPay" => $grossPay - $_GET["c4"],
        "society" => $_GET["c11"],
        "packing" => $_GET["c12"]
    );
    if (is_numeric($_GET["c0"])) {
        $data['opsMonthlyCalendaOid'] = $_GET["c0"];
    }
    $id = $db->insert('kiambaaDairy', $data);
    $logger->debug('add_dairyCorpStmt()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return array('inserted', $id, $id, "SUCCESS!!");
    } else {
        return array('error', $id, $id, $db->getLastError());
    }
}

function update_dairyCorpStmt($rowId) {
    global $db, $logger;

    $acceptedVol = $_GET["c6"] - $_GET["c7"];
    $rate = $_GET["c5"];
    $grossPay = $acceptedVol * $rate;

    $data = Array(
        "societyShares" => $_GET["c1"],
        "packingShares" => $_GET["c2"],
        "feedExpense" => $_GET["c3"],
        "totalDeductions" => $_GET["c4"],
        "rate" => $rate,
        "deliveredQty" => $_GET["c6"],
        "rejectedQty" => $_GET["c7"],
        "acceptedQty" => $acceptedVol,
        "grossPay" => $grossPay,
        "netPay" => $grossPay - $_GET["c4"],
        "society" => $_GET["c11"],
        "packing" => $_GET["c12"]
    );
    if (is_numeric($_GET["c0"])) {
        $data['opsMonthlyCalendaOid'] = $_GET["c0"];
    }

    $db->where('oid', $rowId);
    $db->update('kiambaaDairy', $data);
    $logger->debug('update_dairyCorpStmt()', $db->getLastQuery());
    $db->where('oid', $rowId);
    if ($db->getLastErrno() === 0)
        return array('updated', $rowId, $rowId, "SUCCESS!!");
    else
        return array('error', $rowId, $rowId, $db->getLastError());
}

function delete_dairyCorpStmt($rowId) {
    
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 														EMPLOYEE DATA RELATED CRUD
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function loanPmtsStarted($rowId) {
    global $db;
    global $logger;
    $db->where('oid', $rowId);
    $res = $db->has('employeeloanpmt');
    $logger->debug('loanPmtsStarted()', $db->getLastQuery());
    return $res;
}

function getEmployeeHireDt($oid){
    global $db;
    global $logger;
    $unitObj = $db->query("SELECT startDt FROM employee WHERE oid =". $oid);
    $logger->debug('getEmployeeHireDt()', $db->getLastQuery());
    if ($unitObj) {
        foreach ($unitObj as $value) {
            return new Datetime($value["startDt"]);
        }
    } else {
        throw new Exception("getEmployeeHireDt($oid): Failed to get start date");
    }
}

function getEmployeeLoanGridData() {
    global $db;
    global $logger;

    $data = Array();
    if (is_numeric($_GET["c0"])) {
        $data['employeeOid'] = $_GET["c0"];
    }
    if (isset($_GET['c2'])) {
        $dateEnd = new DateTime($_GET['c2']);
        $data['loanDate'] = $dateEnd->format('Y-m-d');
    }
    $data['loanAmount'] = $_GET["c3"];
    $data['purpose'] = $_GET["c4"];
    if (is_numeric($_GET["c6"])) {
        $data['opsMonthlyCalendarOid'] = $_GET["c6"];
    }
    $data['installmentAmt'] = $_GET["c7"];
    $data['nbrOfPayPeriods'] = round($_GET["c3"] / $_GET["c7"], 2);
    $logger->debug("getEmployeeLoanGridData()", $data);
    return $data;
}

function add_employeeDeductions(){
    global $db, $logger;
    try {
        $logger->debug('add_employeeDeductions()', $_GET);
        $data = Array();
        
        if (isset($_GET['c0'])) {
            $dateStart = new DateTime($_GET['c0']);
            $data['date'] = $dateStart->format('Y-m-d');
        }         
        if (is_numeric($_GET["c1"])) {
            $data['employeeOid'] = $_GET["c1"];
        } 
        $data['amount'] = $_GET['c2'];
        $data['description'] = $_GET['c3'];

        $logger->debug("add_employeeDeductions()", $data);
        $id = $db->insert('employeeotherdeduction', $data);
        $logger->debug('add_employeeDeductions()', $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $id, $id, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_employeeDeductions()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }    
}
function update_employeeDeductions($rowId){
    global $db;
    global $logger;
    $logger->debug("update_employeeDeductions()", $_GET);

    try {
        $data = Array();
        
        if (isset($_GET['c0'])) {
            $dateStart = new DateTime($_GET['c0']);
            $data['date'] = $dateStart->format('Y-m-d');
        }         
        if (is_numeric($_GET["c1"])) {
            $data['employeeOid'] = $_GET["c1"];
        } 
        $data['amount'] = $_GET['c2'];
        $data['description'] = $_GET['c3'];

        $logger->debug("update_employeeDeductions() ", $data);
        $db->where('oid', $rowId);
        $db->update('employeeotherdeduction', $data);
        $logger->debug("update_employeeDeductions() ", $db->getLastQuery());

        if ($db->getLastErrno() === 0) {
            return array('updated', $rowId, $rowId, "SUCCESS!!");
        } else {
            return array('error', $rowId, $rowId, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("update_employeeDeductions()", ['ERROR:' => $e]);
        return array('error', $rowId, $rowId, $e->getMessage());
    }     
}
function delete_employeeDeductions($rowId){
    global $db;
    global $logger;
    $logger->debug("delete_employeeDeductions()", $_GET);

    try {

        $db->where('oid', $rowId);
        $db->delete('employeeotherdeduction');
        $logger->debug("delete_employeeDeductions() ", $db->getLastQuery());

        if ($db->getLastErrno() === 0) {
            return array('deleted', $rowId, $rowId, "SUCCESS!!");
        } else {
            return array('error', $rowId, $rowId, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("delete_employeeDeductions()", ['ERROR:' => $e]);
        return array('error', $rowId, $rowId, $e->getMessage());
    }     
}

function add_employeeLoan() {
    global $db;
    global $logger;
    $logger->debug("add_employeeLoan() ", $_GET);

    $data = getEmployeeLoanGridData();
    $d = new DateTime();
    $data['loanNbr'] = $d->format('mdyGis');
    $db->startTransaction();
    $id = $db->insert('employeeloan', $data);
    if ($db->getLastErrno() === 0) {
        $logger->debug("add_employeeLoan()", $db->getLastQuery());
        if (addLoanPmtsSchedule($id, $data)) {
            $db->commit();
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            $db->rollback();
            return array('error', $id, $id, $db->getLastError());
        }
    } else {
        $logger->debug("add_employeeLoan()", $db->getLastQuery());
        return array('error', $id, $id, $db->getLastError());
    }
}

function addLoanPmtsSchedule($loanOid, $loanData) {
    global $db;
    global $logger;

    $data = Array();
    $logger->debug("addLoanPmtsSchedule(loanData)", $loanData);
    $data['employeeLoanOid'] = $loanOid;
    $data['deductionAmt'] = 0.0;
    $data['balanceAmount'] = $loanData['loanAmount'];
    $data['paid'] = 0;
    $logger->debug("addLoanPmtsSchedule()", $data);
    $id = $db->insert('employeeloanpmt', $data);
    if ($db->getLastErrno() != 0) {
        return false;
    }
    $i = 0;
    while ($i < floor($loanData['nbrOfPayPeriods'])) {
        $data['employeeLoanOid'] = $loanOid;
        $data['deductionAmt'] = $loanData['installmentAmt'];
        $data['balanceAmount'] = $loanData['loanAmount'] - ($loanData['installmentAmt'] * ($i + 1));
        $data['paid'] = 0;
        $logger->debug("addLoanPmtsSchedule()", $data);
        $id = $db->insert('employeeloanpmt', $data);
        if ($db->getLastErrno() != 0) {
            return false;
        }
        $currentBalance = $data['balanceAmount'];
        $i++;
    }
    if ($currentBalance != 0) {
        $data['employeeLoanOid'] = $loanOid;
        $data['deductionAmt'] = $loanData['installmentAmt'] * ($loanData['nbrOfPayPeriods'] - floor($loanData['nbrOfPayPeriods']));
        $data['balanceAmount'] = 0.0;
        $data['paid'] = 0;
        $logger->debug("addLoanPmtsSchedule()", $data);
        $id = $db->insert('employeeloanpmt', $data);
        if ($db->getLastErrno() != 0) {
            return false;
        }
    } else {
        return true;
    }
}

function update_employeeLoan($rowId) {
    global $db;
    global $logger;
    $logger->debug("update_employeeLoan() ", $_GET);

    if (loanPmtsStarted($_GET["gr_id"])) {
        return array('error', $rowId, $rowId, "Loan paymnets exist for this loan. Cannot make changes: " . $db->getLastError());
    }
    $data = getEmployeeLoanGridData();
    $db->where('oid', $rowId);
    $db->update('employeeloan', $data);
    $logger->debug("update_employeeLoan() ", $db->getLastQuery());
    if ($db->getLastErrno() === 0)
        return array('updated', $rowId, $rowId, "SUCCESS!!");
    else
        return array('error', $rowId, $rowId, $db->getLastError());
}

function update_employeePurchases($rowId) {
    global $db;
    global $logger;
    $logger->debug("update_employeePurchases() ", $_GET);

    $data = Array(
        "quantity" => $_GET["c2"],
        "productUnitType" => $_GET["c3"],
        "description" => $_GET["c4"],
        "unitPrice" => $_GET["c6"]
    );
    if (isset($_GET['c0'])) {
        $dateEnd = new DateTime($_GET['c0']);
        $data['purchaseDt'] = $dateEnd->format('Y-m-d');
    }
    if (is_numeric($_GET["c1"])) {
        $data['employeeOid'] = $_GET["c1"];
    }
    if (is_numeric($_GET["c5"])) {
        $data['lineOfBusinessOid'] = $_GET["c5"];
    }

    $db->where('oid', $rowId);
    $db->update('employeepurchases', $data);
    $logger->debug("update_employeePurchases() ", $db->getLastQuery());
    if ($db->getLastErrno() === 0)
        return array('updated', $rowId, $rowId, "SUCCESS!!");
    else
        return array('error', $rowId, $rowId, $db->getLastError());
}

function add_employeePurchases() {
    global $db;
    global $logger;
    try {
        $logger->debug("add_employeePurchases() ", $_GET);
        $grid = $_GET['gr_id'];

        $data = Array(
            "quantity" => $_GET["c2"],
            "productUnitType" => $_GET["c3"],
            "description" => $_GET["c4"],
            "unitPrice" => $_GET["c6"]
        );
        if (isset($_GET['c0'])) {
            $hireDt = getEmployeeHireDt($_GET["c1"]);
            $purchaseDt = new DateTime($_GET['c0']);
            if ($purchaseDt < $hireDt) {
                throw new Exception("Purchses cannot be made prior to employee hire date of [".$hireDt->format('Y-m-d')."]");
            }
            $data['purchaseDt'] = $purchaseDt->format('Y-m-d');
        }
        if (is_numeric($_GET["c1"])) {
            $data['employeeOid'] = $_GET["c1"];
        }
        if (is_numeric($_GET["c5"])) {
            $data['lineOfBusinessOid'] = $_GET["c5"];
        }
        $id = $db->insert('employeepurchases', $data);
        $logger->debug("add_employeePurchases() [insert]", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $id, $id, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_employeePurchases(X)", ['ERROR:' => $e->getMessage()]);
        return array('error', 0, 0, $e->getMessage());
    }        
}

function getFTEadvanceGridData($employeeOid){
    global $logger;
    $data = Array();
    $data['employeeOid'] = $employeeOid;
    $data["amount"] = $_GET["c1"];
    if (is_numeric($_GET["c2"])) {
        //date was changed
        $data['opsMonthlyCalendarOid'] = $_GET["c2"];
    }
    else {
        //date was NOT changed, use the original, hidden value
        $data['opsMonthlyCalendarOid'] = $_GET["c4"];
    }

    validateFTEadvanceAmount($data);

    $data["paid"] = 0;
    $logger->debug("getFTEadvanceGridData() ", $data);
    return $data;
}
function update_FTEadvance($rowId) {
    global $db;
    global $logger;
    $logger->debug("update_FTEadvance() ", $_GET);
    
    try {
        $data = getFTEadvanceGridData($_GET["c5"]);
        
        $db->where('oid', $rowId);
        $db->update('ftesalaryadvance', $data);
        $logger->debug("update_FTEadvance() ", $db->getLastQuery());
        
        if ($db->getLastErrno() === 0) {
            if ($db->count < 1){
                throw new Exception("Update count less than 0");
            }
            $logger->debug("update_FTEadvance()", $db->getLastQuery());
            return ['updated', $rowId, $rowId, "SUCCESS!!"];
        }
        else {
            throw new Exception($db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("update_FTEadvance()", ['ERROR:' => $e->getMessage()]);
        return ['error', $rowId, $rowId, $e->getMessage()];
    }         
}

function add_FTEadvance() {
    global $db;
    global $logger;
    $logger->debug("add_FTEadvance() ", $_GET);

    try {
        $data = getFTEadvanceGridData($_GET["c0"]);
        $id = $db->insert('ftesalaryadvance', $data);
        $logger->debug("add_FTEadvance()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            throw new Exception($db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_FTEadvance()", ['ERROR:' => $e->getMessage()]);
        return ['error', 0, 0, $e->getMessage()];
    }         
}
function validateFTEadvanceAmount($data){
    global $logger;
    $logger->debug("validateFTEadvanceAmount() ", $data);
    $periodStart = getMonthlyCalendarStartAsDateStr($data['opsMonthlyCalendarOid']);
    $periodEnd = getMonthlyCalendarEndAsDateStr($data['opsMonthlyCalendarOid']);
    $salary = getSalaryByDateRange($data['employeeOid'], $periodStart, $periodEnd);  
    if ($data['amount'] > ($salary/2)){
        throw new Exception("Advance amount [".$data['amount']."] must be less than or equal to 50% of the salary [$salary]");
    }
    else {
        return true;
    }
   
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 														DAIRY DATA RELATED CRUD
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//function add_coorporative() {
//    global $db, $logger;
//    $totalDeductions = $_GET["c1"] + $_GET["c2"] + $_GET["c3"];
//    $logger->debug("add_dairy_coorp_data(totalDeductions)", ['totalDeductions'=>$totalDeductions]);
//    $data = Array(
//        "societyShares" => $_GET["c1"],
//        "packingShares" => $_GET["c2"],
//        "feed" => $_GET["c3"],
//        "totalDeductions" => $totalDeductions,
//        "rate" => $_GET["c5"],
//        "delivered" => $_GET["c6"],
//        "rejected" => $_GET["c7"],
//        "accepted" => $_GET["c8"],
//        "grossPay" => $_GET["c9"],
//        "netPay" => $_GET["c10"]
//    );
//    if (is_numeric($_GET["c0"])) {
//        $data['opsMonthlyCalendaOid'] = $_GET["c0"];
//    }
//    $id = $db->insert('kiambaadairy', $data);
//    $logger->debug("add_dairy_coorp_data()", $db->getLastQuery());
//    if ($db->getLastErrno() === 0) {
//        return array('inserted', $id, $id, "SUCCESS!!");
//    } else {
//        return array('error', $id, $id, $db->getLastError());
//    }
//}
//
//function update_coorporative() {
//    /*
//      update_row function only update the current editing row using kiambaadairy id (gr_id)
//      This function take whole row data from $_GET global variable
//      It return an array with array(Status, sid, tid)
//      These are required for dhtmlx component
//
//     */
//    global $db;
//    $grid = $_GET["gr_id"];
//    $data = Array(
//        "gr_id" => $_GET['gr_id'],
//        "month" => $_GET["c0"],
//        "societyShares" => $_GET["c1"],
//        "packingShares" => $_GET["c2"],
//        "feed" => $_GET["c3"],
//        "totalDeductions" => $_GET["c4"],
//        "rate" => $_GET["c5"],
//        "delivered" => $_GET["c6"],
//        "rejected" => $_GET["c7"],
//        "accepted" => $_GET["c8"],
//        "grossPay" => $_GET["c9"],
//        "netPay" => $_GET["c10"]
//    );
//    if (isset($_GET['c0'])) {
//        $data['month'] = date('F', strtotime($_GET["c0"]));
//        $data['updtTmstp'] = date('Y-m-d h:i:s', strtotime($_GET["c0"]));
//    }
//
//    $db->setTrace(true);
//    $db->where('oid', $grid);
//    $db->update('kiambaadairy', $data);
//    $db->where('oid', $grid);
//    $newIdDb = $db->getOne("kiambaadairy");
//    return array('updated', $newIdDb['oid'], $newIdDb['oid']);
//}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 														MUSHROOM DATA RELATED CRUD
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_mushroomsales() {
    global $db;
    global $logger;
    $logger->debug("add_mushroomsales() ", $_GET);

    $data = Array(
        "customerOid" => $_GET["c1"],
        "weightSold" => $_GET["c2"],
        "pricePerKg" => $_GET["c3"]
    );

    if (isset($_GET['c0'])) {
        $salesDt = new DateTime($_GET['c0']);
        $data['salesDt'] = $salesDt->format('Y-m-d');
    }
    $id = $db->insert('mushroomsales', $data);
    $logger->debug("add_mushroomsales() [insert]", $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return array('inserted', $id, $id, "SUCCESS!!");
    } else {
        return array('error', $id, $id, $db->getLastError());
    }
}

function update_mushroomsales($rowId) {

    global $db;
    global $logger;
    $logger->debug("update_dairysales() ", $_GET);

    $data = Array(
        "weightSold" => $_GET["c2"],
        "pricePerKg" => $_GET["c3"]
    );
    if (is_numeric($_GET["c1"])) {
        $data['customerOid'] = $_GET["c1"];
    }
    if (isset($_GET['c0'])) {
        $data['salesDt'] = date('Y-m-d', strtotime($_GET['c0']));
    }
    $db->where('oid', $rowId);
    $db->update('mushroomsales', $data);
    $logger->debug("update_mushroomsales()[update] ", $db->getLastQuery());
    if ($db->getLastErrno() === 0)
        return array('updated', $rowId, $rowId, "SUCCESS!!");
    else
        return array('error', $rowId, $rowId, $db->getLastError());
}

function add_mushroomprod() {
    global $db;
    global $logger;

    $logger->debug('add_mushroomprod() -GET', $_GET);

    $grid = $_GET['gr_id'];
    $data = Array(
        "gr_id" => $_GET['gr_id'],
        "harvestDt" => date('Y-m-d', strtotime($_GET["c0"])),
        "roomNbr" => $_GET["c1"],
        "cropNbr" => $_GET["c2"],
        "harvestedWeight" => $_GET["c3"]
    );

    $id = $db->insert('mushroomproduction', $data);
    $logger->debug('add_mushroomprod() (db2)', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return array('inserted', $id, $id, "SUCCESS!!");
    } else {
        return array('error', $id, $id, $db->getLastError());
    }
}

function update_mushroomprod() {
    global $logger;
    global $db;

    $logger->debug('update_mushroomprod() -GET', $_GET);
    $grid = $_GET["gr_id"];
    $data = Array(
        "harvestDt" => date('Y-m-d h:i:s', strtotime($_GET["c0"])),
        "roomNbr" => $_GET["c1"],
        "cropNbr" => $_GET["c2"],
        "harvestedWeight" => $_GET["c3"]
    );
    $db->where('oid', $grid);
    $db->update('mushroomproduction', $data);
    $db->where('oid', $grid);
    $logger->debug('update_mushroomprod() -GET', $db->getLastQuery());
    $newIdDb = $db->getOne("mushroomproduction");
    return array('updated', $newIdDb['oid'], $newIdDb['oid']);
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 														OTHER WORK ASSIGNED CRUD
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function update_otherWork($rowId) {
    global $db;
    global $logger;
    $logger->debug("update_otherWork()", $_GET);

    try {
        $startTm = $_GET["c2"];
        $endTm = $_GET["c3"];
        $hours = getTotHours($startTm, $endTm);
        $data = Array(
            "startTm" => $startTm,
            "endTm" => $endTm,
            "hours" => $hours,
            "description" => $_GET["c5"],
            "remarks" => $_GET["c7"],
            "attendanceOid" => $_GET["c9"]
        );
        if (is_numeric($_GET["c6"])) {
            $data['lineOfBusinessOid'] = $_GET["c6"];
        }
        $db->where('oid', $rowId);
        $db->update('otherworkassigned', $data);
        $logger->debug("update_otherWork() ", $db->getLastQuery());

        if ($db->getLastErrno() === 0) {
            return array('updated', $rowId, $rowId, "SUCCESS!!");
        } else {
            return array('error', $rowId, $rowId, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("[update_otherWork()]", ['ERROR:' => $e]);
        return array('error', $rowId, $rowId, $e->getMessage());
    }
}

function add_otherWork() {
    global $db;
    global $logger;

    try {
        $startTm = $_GET["c2"];
        $endTm = $_GET["c3"];
        $hours = getTotHours($startTm, $endTm);
        $data = Array(
            "startTm" => $startTm,
            "endTm" => $endTm,
            "hours" => $hours,
            "description" => $_GET["c5"],
            "remarks" => $_GET["c7"],
            "attendanceOid" => $_GET["c9"]
        );
        if (is_numeric($_GET["c6"])) {
            $data['lineOfBusinessOid'] = $_GET["c6"];
        }

        $id = $db->insert('otherworkassigned', $data);
        $logger->debug("add_otherWork() [insert]", $_GET);
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $id, $id, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_otherWork()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 														FISH RELATED CRUD
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getFishSalesGridData(){
    $data = Array();

    if (isset($_GET['c0'])) {
        $dateEnd = new DateTime($_GET['c0']);
        $data['salesDt'] = $dateEnd->format('Y-m-d h:i:s');
    }
    if (is_numeric($_GET["c1"])) {
        $data['customerOid'] = $_GET["c1"];
    }
    if (isset($_GET['c2'])) {
        $data['type'] = $_GET["c2"];
    }  
    $data['weight'] = $_GET["c3"];
    $data['pricePerKg'] = $_GET["c4"];    
    return $data;
}
function add_fishsales() {
    global $db;
    global $logger;
    $logger->debug("add_fishsales() ", $_GET);

    try {
        $data = getFishSalesGridData();
        $id = $db->insert('fishsales', $data);
        $logger->debug("add_fishsales()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            throw new Exception($db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_fishsales()", ['ERROR:' => $e->getMessage()]);
        return ['error', 0, 0, $e->getMessage()];
    } 
}

function update_fishsales($rowId) {
    global $db;
    global $logger;
    $logger->debug("update_fishsales() ", $_GET);
    
    try {
        $data = getFishSalesGridData();
        $db->where('oid', $rowId);
        $db->update('fishsales', $data);
        $logger->debug("update_fishsales() ", $db->getLastQuery());
        
        if ($db->getLastErrno() === 0) {
            if ($db->count < 1){
                throw new Exception("Update count less than 0");
            }
            $logger->debug("update_fishsales()", $db->getLastQuery());
            return ['updated', $rowId, $rowId, "SUCCESS!!"];
        }
        else {
            throw new Exception($db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("update_FTEadvance()", ['ERROR:' => $e->getMessage()]);
        return ['error', $rowId, $rowId, $e->getMessage()];
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 														END: FISH CRUD
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getOtherIncomeGridData(){
    global $logger;
    $data = Array();
    
    $d = new DateTime($_GET['c0']);
    $data['date'] = $d->format('Y-m-d');
    if (is_numeric($_GET["c1"])) {
        $data['lineOfBusinessOid'] = $_GET["c1"];
    }
    $data['description'] = $_GET["c2"];
    $data['incomeAmt'] = $_GET["c3"];
    $logger->debug("getOtherIncomeGridData()", $data);
    return $data;
}
function add_otherDeptIncome(){
    global $db;
    global $logger;
    $logger->debug("add_otherDeptIncome() ", $_GET);
    try {
        $data = getOtherIncomeGridData();
        $id = $db->insert('OtherDeptIncome', $data);
        if ($db->getLastErrno() === 0) {
            $logger->debug("add_otherDeptIncome()", $db->getLastQuery());
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            throw new Exception($db->getLastError());
        } 
    } catch (Exception $e) {
        $logger->debug("add_otherDeptIncome()", ['ERROR:' => $e->getMessage()]);
        return array('error', 0, 0, $e->getMessage());
    }         
}
function update_otherDeptIncome($rowId){
    global $db, $logger;
    $logger->debug("update_otherDeptIncome() ", $_GET);
    try {
        $data = getOtherIncomeGridData();
        $db->where('oid', $rowId);
        $db->update('OtherDeptIncome', $data);
        $logger->debug("update_otherDeptIncome()", $db->getLastQuery());
        if ($db->getLastErrno() === 0)
            return array('updated', $rowId, $rowId, "SUCCESS!!");
        else
            return array('error', $rowId, $rowId, $db->getLastError());
    } catch (Exception $e) {
        $logger->debug("update_otherDeptIncome()", ['ERROR:' => $e->getMessage()]);
        return array('error', $rowId, $rowId, $e->getMessage());
    }    
}
function delete_otherDeptIncome($rowId){
    global $db;
    global $logger;
    $logger->debug("delete_otherDeptIncome()", $_GET);
    try {
        $db->where('oid', $rowId);
        $db->delete('OtherDeptIncome');
        $logger->debug("delete_otherDeptIncome() ", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('deleted', $rowId, $rowId, "SUCCESS!!");
        } else {
            return array('error', $rowId, $rowId, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("delete_otherDeptIncome()", ['ERROR:' => $e]);
        return array('error', $rowId, $rowId, $e->getMessage());
    }     
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 														HORT CRUD
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_horticululreSales() {
    global $db;
    global $logger;
    $logger->debug("add_horticululreSales() ", $_GET);

    try {
        $data = getHortSalesData();
        $id = $db->insert('horticulturesales', $data);
        $logger->debug("add_horticululreSales()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            throw new Exception($db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_horticululreSales()", ['ERROR:' => $e->getMessage()]);
        return ['error', 0, 0, $e->getMessage()];
    }
}

function getHortSalesData(){
    $data = Array();
    if (isset($_GET['c0'])) {
        $d = new DateTime($_GET['c0']);
        $data['salesDt'] = $d->format('Y-m-d');
    }
    if (isset($_GET['c1'])) {
        $data['customerOid'] = $_GET['c1'];
    }
    if (isset($_GET['c2'])) {
        $data['lineOfBusinessOid'] = $_GET['c2'];
    }
    if (isset($_GET['c3'])) {
        $data['horticultureProduceParentOid'] = $_GET['c3'];
    }    
    
    $data['quantity'] = $_GET["c4"];
    if (isset($_GET['c5'])) {
        $data['unit'] = $_GET['c5'];
    }    
    $data['unitPrice'] = $_GET["c6"];
    
    return $data;    
}

function update_horticululreSales($rowId) {
    global $db;
    global $logger;
    $logger->debug("update_horticululreSales() ", $_GET);
    
    try {
        $data = getHortSalesData();
        
        $db->where('oid', $rowId);
        $db->update('horticulturesales', $data);
        $logger->debug("update_horticululreSales() ", $db->getLastQuery());
        
        if ($db->getLastErrno() === 0) {
            if ($db->count < 1){
                throw new Exception("Update count less than 0");
            }
            $logger->debug("update_horticululreSales()", $db->getLastQuery());
            return ['updated', $rowId, $rowId, "SUCCESS!!"];
        }
        else {
            throw new Exception($db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("update_horticululreSales()", ['ERROR:' => $e->getMessage()]);
        return ['error', $rowId, $rowId, $e->getMessage()];
    } 
}

function delete_horticululreSales($rowId) {}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 														END: HORT CRUD
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 														SALARY CRUD
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function add_salary() {}

function update_salary($rowId) {
    global $logger;
    global $db;
    try {
        $logger->debug('update_salary() - $GET', $_GET);
        $employeeType = $_GET['c10'];
        $endDtStr = filter_input(INPUT_GET, 'c7', FILTER_SANITIZE_SPECIAL_CHARS);
        $db->startTransaction();
        if (!empty($endDtStr)) {
            $logger->debug("update_salary()", ['endDtStr:' => $endDtStr]);
            updateOldSalary();
        } else {
            $id = insertNewSalary($_GET, $rowId);
        }
        $db->commit();
        return array('inserted', $id, $id, "SUCCESS!!");
    } catch (Exception $e) {
        $logger->debug("update_salary()", ['ERROR:' => $e->getMessage()]);
        return array('error', $rowId, $rowId, $e->getMessage());
    }
}

function getEmployeeStartDt($oid) {
    global $logger;
    global $db;
    $rows = $db->query("SELECT startDt FROM employee WHERE oid = $oid ");
    $logger->debug("getEmployeeStartDt()", $db->getLastQuery());
    foreach ($rows as $row) {
        return new DateTime($row['startDt']);
    }
}

function insertNewSalary($input, $rowId) {
    global $logger;
    global $db;

    $employeeType = $input['c3'];
    $selectedEffeciveDt = $input['c6'];
    $employeeStartDt = getEmployeeStartDt($input["c8"]);
    if (new DateTime($selectedEffeciveDt) < $employeeStartDt) {
        throw new Exception("Effective date cannot be before employment start date");
    }
    switch ($employeeType) {
        case "C":
            $salarytype = "D";
            break;
        case "S":
            $salarytype = "M";
            break;
        case "F":
            $salarytype = "C";
            break;
        default:
            $salarytype = $input['c5'];
            break;
    }

    $actualEffectiveDt = getClosestPayPeriodStartDt($selectedEffeciveDt, $employeeType);
    $logger->debug("insertNewSalary()", ['actualEffectiveDt:' => $actualEffectiveDt]);
    $data = Array(
        "employeeOid" => $input["c8"],
        "employeetype" => $input["c3"],
        "amount" => $input["c4"],
        "salarytype" => $salarytype,
        "effectivetDt" => $actualEffectiveDt
    );
    $id = $db->insert('salary', $data);
    $logger->debug('insertNewSalary()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        terminateCurrentSalary($actualEffectiveDt, $rowId);
        return $id;
    } else {
        $db->rollback();
        throw new Exception($db->getLastError());
    }
}

function terminateCurrentSalary($dateStr, $rowId) {
    global $logger;
    global $db;
    $endDt = new DateTime($dateStr);
    $data = Array(
        "endDt" => $endDt->sub(new DateInterval("P1D"))->format('Y-m-d')
    );
    $db->where('oid', $rowId);
    $db->update('salary', $data);
    $logger->debug('terminateCurrentSalary()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return;
    } else {
        $db->rollback();
        throw new Exception($db->getLastError());
    }
}

function updateOldSalary() {
    throw new Exception("Update of old salary not allowed. Contact system admin");
}

function ZZZupdate_salary() {
    global $errorLogger;
    global $logger;
    global $db;

    $rowId = $_GET["gr_id"];
    $employeeType = $_GET['c10'];
    $logger->debug('update_salary() - $GET', $_GET);

    //if updating an old salary (endDt !=null) then we do not want to create a new salary row!! Check the db
    $sql = "SELECT endDt FROM salary WHERE oid = " . $rowId;
    $rows = $db->query($sql);
    $logger->debug('update_salary', $db->getLastQuery());
    $logger->debug('update_salary() - rows', $rows);
    // if($rows){
    foreach ($rows as $row) {
        if ($row['endDt'] != NULL) {
            $logger->debug('update_salary() - endDt not Null', $rows);
            $logger->debug('update_salary() - $GET', $_GET);
            $data = Array(
                "effectivetDt" => getClosestPayPeriodStartDt($_GET['c6'], $employeeType),
                "salarytype" => $_GET["c5"],
            );
            if (isset($_GET['c7']) and ( strlen($_GET['c7']) > 0)) {
                $data['endDt'] = getClosestPayPeriodEndDt($_GET['c6'], $_GET['c7'], $employeeType);
            }
            $data['amount'] = $_GET['c4'];
            $db->where('oid', $rowId);
            $db->update('salary', $data);
            if ($db->getLastErrno() === 0) {
                $logger->debug("update_salary(SUCCESS) ", $db->getLastQuery());
                return array('updated', $rowId, $rowId, "SUCCESS!!");
            } else {
                $logger->debug("update_salary(ERROR) ", $db->getLastQuery());
                return array('error', $rowId, $rowId, $db->getLastError());
            }
        }
        unset($data);
        if ($row['endDt'] == NULL) {
            if ($_GET['c9'] == "1")
                return false;

            $logger->debug('update_salary() - endDt is Null', $rows);

            //terminate the current salary record with an update to the endDt
            $endDt = getClosestPayPeriodEndDt($_GET['c6'], $_GET['c7'], $employeeType);
            $data = Array(
                "endDt" => $endDt
            );
            $db->where('oid', $rowId);
            $db->update('salary', $data);

            if ($db->getLastErrno() === 0) {
                $logger->debug("update_salary() terminated salary row (SUCCESS) ", $db->getLastQuery());
                //insert a new salary record for this employee
                unset($data);
                $today = date('Y-m-d');
                $data = Array(
                    "employeeOid" => $_GET["c8"],
                    "employeetype" => $_GET["c3"],
                    "amount" => $_GET["c4"],
                    "salarytype" => $_GET["c5"],
                    "effectivetDt" => getClosestPayPeriodStartDt($endDt, $employeeType)
                );

                $id = $db->insert('salary', $data);

                if ($db->getLastErrno() === 0) {
                    $logger->debug('update_salary() added new salary row (SUCCESS)', $db->getLastQuery());
                    return array('inserted', $id, $id, "SUCCESS!!");
                } else {
                    $logger->debug('update_salary() added new salary row (ERROR)', $db->getLastQuery());
                    return array('error', $id, $id, $db->getLastError());
                }
            } else {
                $logger->debug("update_salary() terminated salary row (ERROR) ", $db->getLastQuery());
                return array('error', $rowId, $rowId, $db->getLastError());
            }
        }
    }
    //}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 														CUSTOMER CRUD
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function add_customer() {
    global $db, $logger;
    $grid = $_GET['gr_id'];
    $data = Array(
        "gr_id" => $_GET['gr_id'],
        "businessName" => $_GET["c0"],
        "contactFirstName" => $_GET["c1"],
        "contactLastName" => $_GET["c2"],
        "storeNameNbr" => $_GET["c3"],
        "mobileNbr" => $_GET["c4"],
        /* "createTmstp" => date('Y-m-d',strtotime($_GET["c5"]))	 */
    );

    $db->setTrace(true);
    $id = $db->insert('customer', $data);
    if ($db->getLastErrno() === 0) {
        return array('inserted', $id, $id, "SUCCESS!!");
    } else {
        return array('error', $id, $id, $db->getLastError());
    }
}

function update_customer($rowId) {
    global $db, $logger;
    $data = Array(
        "businessName" => $_GET["c0"],
        "contactFirstName" => $_GET["c1"],
        "contactLastName" => $_GET["c2"],
        "storeNameNbr" => $_GET["c3"],
        "mobileNbr" => $_GET["c4"]
    );
    $db->where('oid', $rowId);
    $db->update('customer', $data);
    if ($db->getLastErrno() === 0) {
        $logger->debug("update_customer(SUCCESS) ", $db->getLastQuery());
        return array('updated', $rowId, $rowId, "SUCCESS!!");
    } else {
        $logger->debug("update_customer(ERROR) ", $db->getLastQuery());
        return array('error', $rowId, $rowId, $db->getLastError());
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 														EXPENSE ACTIVITY CRUD
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function add_expenseactivity() {
    global $db, $logger;
    $data = Array(
        "activity" => $_GET["c0"]
    );

    $id = $db->insert('expenseactivity', $data);
    if ($db->getLastErrno() === 0) {
        return array('inserted', $id, $id, "SUCCESS!!");
    } else {
        return array('error', $id, $id, $db->getLastError());
    }
}

function update_expenseactivity() {
    global $db, $logger;
    $grid = $_GET["gr_id"];
    $data = Array(
        "activity" => $_GET["c0"],
    );

    $db->where('oid', $grid);
    $db->update('expenseactivity', $data);
    $db->where('oid', $grid);
    $newIdDb = $db->getOne("expenseactivity");

    return array('updated', $newIdDb['oid'], $newIdDb['oid']);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	PART TIME DATA CRUD
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function update_partTimeData($rowId) {
    global $db, $logger;
    try {
        $logger->debug("update_partTimeData() ", $_GET);

        $startTm = $_GET["c2"];
        $endTm = $_GET["c3"];
        $hours = validateStartAndEndTime($startTm, $endTm);

        //time entered OK, now proceed to save row
        $data = Array(
            "startTm" => $startTm,
            "endTm" => $endTm,
            "hours" => $hours,
            "allocatedBy" => $_GET["c6"],
            "workDescription" => $_GET["c5"],
            "remarks" => $_GET["c8"]
        );
        if (is_numeric($_GET["c7"])) {
            $data['lineOfBussinessOid'] = $_GET["c7"];
        }
        $db->where('oid', $rowId);
        $db->update('parttimedetail', $data);
        $logger->debug("update_partTimeData()", $db->getLastQuery());
        if ($db->getLastErrno() === 0)
            return array('updated', $rowId, $rowId, "SUCCESS!!");
        else
            return array('error', $rowId, $rowId, $db->getLastError());
    } catch (Exception $e) {
        $logger->debug("[update_partTimeData()]", ['ERROR:' => $e->getMessage()]);
        return array('error', $rowId, $rowId, $e->getMessage());
    }
}

function add_partTimeData() {
    try {
        global $db;
        global $logger;
        $logger->debug("add_partTimeData() ", $_GET);

        $startTm = $_GET["c2"];
        $endTm = $_GET["c3"];
        $hours = validateStartAndEndTime($startTm, $endTm);

        $data = Array(
            "startTm" => $startTm,
            "endTm" => $endTm,
            "hours" => $hours,
            "workDescription" => $_GET["c5"],
            "allocatedBy" => $_GET["c6"],
            "remarks" => $_GET["c8"]
        );
        if (is_numeric($_GET["c7"])) {
            $data['lineOfBussinessOid'] = $_GET["c7"];
        }
        $data['employeeOid'] = $_GET["c10"];
        $data['attendanceOid'] = $_GET["c11"];

        $id = $db->insert('parttimedetail', $data);
        $logger->debug("add_partTimeData() [insert]", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $id, $id, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_partTimeData()", ['ERROR:' => $e->getMessage()]);
        return array('error', 0, 0, $e->getMessage());
    }
}

function validateStartAndEndTime($startTm, $endTm) {
    global $logger;    
    $logger->debug("validateStartAndEndTime()", ['startTm' => $startTm,'endTm' => $endTm]);
    try {
        $d1 = new DateTime('2017-01-01 ' . $startTm);
        if (!($d1))
            throw new Exception("Start Time is BOGUS");

        $d2 = new DateTime('2017-01-01 ' . $endTm);
        if (!($d2))
            throw new Exception("End Time is BOGUS");

        $minStartTm = new DateTime('2017-01-01 08:00');
        $maxStartTm = new DateTime('2017-01-01 17:00');
        if (($d1 >= $minStartTm) && ($d1 < $maxStartTm)) {
            throw new Exception("Start Time [$startTm] MUST be BEFORE 8am OR AFTER 5pm");
        }
        if (($d2 > $minStartTm) && ($d2 < $maxStartTm)) {
            throw new Exception("End Time [$endTm] MUST be BEFORE 8am OR AFTER 5pm");
        }

        if ($d1 > $d2) {
            throw new Exception("Start Time MUST be BEFORE End Time");
        }

        if (($d1 <= $minStartTm) && ($d2 > $minStartTm)) {
            throw new Exception("No Part-time allowed between 8am and 5pm");
        }

        $diff = $d2->diff($d1);
        $m = $diff->format("%i");
        $h = $diff->format("%h");
        $hours = round(($m + ($h * 60)) / 60, 2);
        return $hours;
    } catch (Exception $e) {
        throw($e);
    }
}

function getTotHours($startTm, $endTm) {
    try {
        $d1 = new DateTime('2017-01-01 ' . $startTm);
        if (!($d1))
            throw new Exception("Start Time is BOGUS");

        $d2 = new DateTime('2017-01-01 ' . $endTm);
        if (!($d2))
            throw new Exception("End Time is BOGUS");

        $diff = $d2->diff($d1);
        $m = $diff->format("%i");
        $h = $diff->format("%h");
        $hours = round(($m + ($h * 60)) / 60, 2);
        return $hours;
    } catch (Exception $e) {
        throw($e);
    }
}

function add_teaPruningRate() {
    global $db;
    global $logger;
    try {
        $logger->debug("add_teaPruningRate() ", $_GET);
        $data = Array(
            "ratePerBush" => $_GET["c0"]
        );
        if (isset($_GET['c1'])) {
            $startDt = getClosestPayPeriodStartDt($_GET['c1'], 'C');
            $data['startDt'] = $startDt;
            updatePreviousPruningRateEndDt($startDt);
        }

        $id = $db->insert('TeaPruningRate', $data);
        $logger->debug("add_teaPruningRate()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $id, $id, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_teaPruningRate()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }
}

function updatePreviousPruningRateEndDt($startDt, $tableName) {
    global $db;
    global $logger;
    $sql = "SELECT oid FROM $tableName WHERE endDt IS NULL LIMIT 1";
    $rows = $db->query($sql);
    $logger->debug('updatePreviousPruningRateEndDt()', $db->getLastQuery());
    foreach ($rows as $row) {
        $oid = $row['oid'];
        $startDtObj = new DateTime($startDt);
        $data = Array(
            "endDt" => $startDtObj->sub(new DateInterval("P1D"))->format('Y-m-d'),
        );
        $db->where('oid', $oid);
        $db->update($tableName, $data);
        $logger->debug("updatePreviousPruningRateEndDt()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return;
        } else {
            throw new Exception("updatePreviousPruningRateEndDt(): ERROR updating prevuous end date for table = " . $tableName);
        }
    }
}

function update_teapruningrate($rowId) {
    global $db;
    global $logger;
    return array('error', $rowId, $rowId, "Tea Pruning Rate UPDATE NOT ALLOWED!! Contact system administartor");
}

function add_teaPruning() {
    global $db;
    global $logger;
    $logger->debug("add_teaPruning() ", $_GET);
    $grid = $_GET['gr_id'];
    $data = Array(
        "nbrOfBushesPruned" => $_GET["c3"]
    );
    if (isset($_GET['c0'])) {
        $data['date'] = date('Y-m-d', strtotime($_GET['c0']));
    }
    if (is_numeric($_GET["c1"])) {
        $data['attendance_oid'] = $_GET["c1"];
    }
    if (is_numeric($_GET["c2"])) {
        $data['teaBlockOid'] = $_GET["c2"];
    }
    if (is_numeric($_GET["c4"])) {
        $data['teaPruningRateOid'] = $_GET["c4"];
    }

    $id = $db->insert('teapruning', $data);
    $logger->debug("add_teaPruning() [insert]", $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return array('inserted', $id, $id, "SUCCESS!!");
    } else {
        return array('error', $id, $id, $db->getLastError());
    }
}

function update_teaPruning() {
    global $db, $logger;
    $grid = $_GET["gr_id"];
    $data = Array(
        "ratePerBush" => $_GET["c0"],
    );
    if (isset($_GET['c1'])) {
        $data['startDt'] = date('Y-m-d', strtotime($_GET['c1']));
    }
    if (isset($_GET['c2'])) {
        $data['endDt'] = date('Y-m-d', strtotime($_GET['c2']));
    }

    $db->where('oid', $grid);
    $db->update('teapruningrate', $data);
    $db->where('oid', $grid);
    $newIdDb = $db->getOne("teapruningrate");

    return array('updated', $newIdDb['oid'], $newIdDb['oid']);
}

function add_teabonus() {
    global $db, $logger;
    try {
        $data = Array(
            "amount" => $_GET["c1"]
        );
        if (isset($_GET['c0'])) {
            $data['opsMonthlyCalendarOid'] = $_GET['c0'];
        }
        $id = $db->insert('teabonus', $data);
        $logger->debug("add_teabonus()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $id, $id, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_teabonus()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }
}

function update_teabonus($rowId) {
    global $db;
    global $logger;
    try {
        $data = Array(
            "amount" => $_GET["c1"]
        );
        if (isset($_GET['c0'])) {
            $data['opsMonthlyCalendarOid'] = $_GET['c0'];
        }
        $db->where('oid', $rowId);
        $db->update('teabonus', $data);
        $logger->debug("update_teabonus()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('updated', $rowId, $rowId, "SUCCESS!!");
        } else {
            return array('error', $rowId, $rowId, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("update_teabonus()", ['ERROR:' => $e]);
        return array('error', $rowId, $rowId, $e->getMessage());
    }
}

function add_teafactorypurchase() {
    global $db, $logger;
    try {
        $data = Array(
            "purchaseType" => $_GET["c1"],
            "quantity" => $_GET["c2"],
            "unitPrice" => $_GET["c4"]
        );
        if (isset($_GET['c0'])) {
            $data['purchaseDt'] = date('Y-m-d', strtotime($_GET['c0']));
        }
        $id = $db->insert('TeaFactoryPurchases', $data);
        $logger->debug("add_teafactorypurchase()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $id, $id, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_teafactorypurchase()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }
}

function update_teafactorypurchase($rowId) {
    global $db;
    global $logger;
    try {
        $data = Array(
            "purchaseType" => $_GET["c1"],
            "quantity" => $_GET["c2"],
            "unitPrice" => $_GET["c4"]
        );
        if (isset($_GET['c0'])) {
            $data['purchaseDt'] = date('Y-m-d', strtotime($_GET['c0']));
        }
        $db->where('oid', $rowId);
        $db->update('TeaFactoryPurchases', $data);
        $logger->debug("add_teafactorypurchase()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('updated', $rowId, $rowId, "SUCCESS!!");
        } else {
            return array('error', $rowId, $rowId, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_teafactorypurchase()", ['ERROR:' => $e]);
        return array('error', $rowId, $rowId, $e->getMessage());
    }
}

function add_teapickingrate() {
    global $db;
    global $logger;

    $data = Array(
        "rate" => $_GET["c0"]
    );

    if (isset($_GET['c1'])) {
        $startDt = getClosestPayPeriodStartDt($_GET['c1'], 'C');
        $data['startDt'] = $startDt;
        updatePreviousPruningRateEndDt($startDt, 'teapickingrate');
    }

    $id = $db->insert('teapickingrate', $data);
    if ($db->getLastErrno() === 0) {
        $logger->debug("add_teapickingrate(SUCCESS) ", $db->getLastQuery());
        return array('inserted', 0, 0, "SUCCESS!!");
    } else {
        $logger->debug("add_teapickingrate(ERROR) ", $db->getLastQuery());
        return array('error', 0, 0, $db->getLastError());
    }
}

function update_teapickingrate($rowId) {
    global $db;
    global $logger;
    return array('error', $rowId, $rowId, "Tea Picking Rate UPDATE NOT ALLOWED!! Contact system administartor");
}

function add_teaFactoryRate() {
    global $db;
    global $logger;
    $id = 0;

    $logger->debug("add_teaFactoryRate()", $_GET);
    $data = Array(
        "rate" => $_GET["c0"]
    );
    if (isset($_GET['c1'])) {
        $data['startOpsMonthlyCalendarOid'] = $_GET['c1'];
    }
    if (isset($_GET['c2'])) {
        $data['endOpsMonthlyCalendarOid'] = $_GET['c2'];
    }
    $id = $db->insert('TeaFactoryRate', $data);
    $logger->debug("add_teaFactoryRate()", $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return array('inserted', $id, $id, "SUCCESS!!");
    } else {
        return array('error', $id, $id, $db->getLastError());
    }
}

function update_teaFactoryRate($rowId) {
    global $db;
    global $logger;

    $logger->debug("update_teaFactoryRate()", $_GET);
    $data = Array(
        "rate" => $_GET["c0"]
    );
    if (isset($_GET['c1'])) {
        $data['startOpsMonthlyCalendarOid'] = $_GET['c1'];
    }
    if (isset($_GET['c2'])) {
        $data['endOpsMonthlyCalendarOid'] = $_GET['c2'];
    }
    $db->where('oid', $rowId);
    $db->update('TeaFactoryRate', $data);
    $logger->debug("update_teaFactoryRate()", $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return array('updated', $rowId, $rowId, "SUCCESS!!");
    } else {
        return array('error', $rowId, $rowId, $db->getLastError());
    }
}

function delete_teaFactoryRate($rowId) {
    
}

function update_teaPicking($rowId) {
    global $errorLogger;
    global $logger;
    global $db;
    try {
        $logger->debug('update_teaPicking() -GET', $_GET);

        $data = Array(
            "weight" => $_GET["c3"]
        );

        if (is_numeric($_GET["c2"])) {
            $teaBlockOid = $_GET["c2"];
            if ($teaBlockOid == 10) {
                return array('error', $rowId, $rowId, "Invalid Tea Block Selected");
            }
            $data['teaBlock_oid'] = $teaBlockOid;
        } else {
            //do not save default tea blov (0000)
            return array('error', $rowId, $rowId, "You must select a Tea Block");
        }

        $db->where('oid', $rowId);
        $db->update('teapicking', $data);
        if ($db->getLastErrno() === 0) {
            $logger->debug("update_teaPicking()", $db->getLastQuery());
            return array('updated', $rowId, $rowId, "SUCCESS!!");
        } else {
            $logger->debug("update_teaPicking()", $db->getLastQuery());
            return array('error', $rowId, $rowId, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("update_teaPicking()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }
}

function add_teaPicking() {
    global $logger;
    global $db;
    try {
        $logger->debug("add_teaPicking() ", $_GET);

        $data = Array(
            "weight" => $_GET["c3"]
        );

        if (is_numeric($_GET["c2"])) {
            $teaBlockOid = $_GET["c2"];
            if ($teaBlockOid == 10) {
                return array('error', $_GET['gr_id'], $_GET['gr_id'], "Invalid Tea Block Selected");
            }
            $data['teaBlock_oid'] = $teaBlockOid;
        } else {
            //do not save default tea blov (0000)
            return array('error', $_GET['gr_id'], $_GET['gr_id'], "You must select a Tea Block");
        }
        $data['attendanceOid'] = $_GET["c5"];
        $id = $db->insert('teapicking', $data);
        $logger->debug("add_teaPicking()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $_GET['gr_id'], $_GET['gr_id'], $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_teaPicking()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }
}

function update_teablock($rowId) {
    global $db;
    global $logger;
    $logger->debug("update_teablock() ", $_GET);

    try {
        $dateStart = new DateTime($_GET['c4']);
        $dateStart->format('Y-m-d');
        $data = Array(
            "blockSize" => $_GET['c2'],
            "nbrOfBushes" => $_GET['c3'],
            "lastDatePruned" => $dateStart->format('Y-m-d'),
            "nextPruneDate" => date("Y-m-d", strtotime(date("Y-m-d", strtotime($dateStart->format('Y-m-d'))) . " + 4 year"))
        );

        $db->where('oid', $rowId);
        $db->update('teablock', $data);
        $logger->debug("update_teablock() ", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('updated', $rowId, $rowId, "SUCCESS!!");
        } else {
            return array('error', $rowId, $rowId, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("update_teablock()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }
}

function add_teablock() {
    
}

function update_teaFactoryDelivery($rowId) {
    global $db;
    global $logger;
    $logger->debug("update_teaFactoryDelivery() ", $_GET);
    try {
        $data = Array();
        $data['ticketNbr'] = $_GET['c0'];
        if (is_numeric($_GET["c1"])) {
            $data['vehicleOid'] = $_GET["c1"];
        }        
        $data['consecNbr1'] = $_GET['c2'];
        if (isset($_GET['c3'])) {
            $deliveryDt = new DateTime($_GET['c3']);
            $data['entryDateTm'] = $deliveryDt->format('Y-m-d h:i');
        }
        $data['firstWght'] = $_GET['c4'];
        $data['consecNbr2'] = $_GET['c5'];
        if (isset($_GET['c6'])) {
            $deliveryDt = new DateTime($_GET['c6']);
            $data['exitDateTm'] = $deliveryDt->format('Y-m-d h:i');
        }        
        $data['secondWght'] = $_GET['c7'];
        
        if ($data['secondWght'] > $data['firstWght']){
            throw new Exception("2nd weight MUST be greater than 1st weight");
        }        
        $data['delNo'] = $_GET['c10'];
        $data['nbrOfTrips'] = 1;
        $db->where('oid', $rowId);
        $db->update('teafactorydelivery', $data);
        if ($db->getLastErrno() === 0) {
            $logger->debug("update_teaFactoryDelivery() ", $db->getLastQuery());
            return ['updated', $rowId, $rowId, "SUCCESS!!"];
        }
        else {
            throw new Exception($db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("update_teaFactoryDelivery()", ['ERROR:' => $e->getMessage()]);
        return ['error', $rowId, $rowId, $e->getMessage()];
    }       
}

function add_teaFactoryDelivery() {
    //done with a form submit
}

function getSalaryExpenseAllocation(){ 
    global $logger;
    $data = Array();
    if (is_numeric($_GET["c0"])) {
        $data['employeeOid'] = $_GET["c0"];
    }
    if (is_numeric($_GET["c2"])) {
        $data['lineOfBusinessOid'] = $_GET["c2"];
    }
    $data['allocation'] = $_GET["c3"];
    if (isset($_GET['c4'])) {
        $StartDate = new DateTime($_GET['c4']);
        $data['effectiveDt'] = $StartDate->format('Y-m-d');
    }     
    if (strlen($_GET['c5'])>0) {
        $endDate = new DateTime($_GET['c5']);
        if ($endDate < $StartDate){
            throw new Exception("Start Date MUST be greate than End Date");
        }            
        $data['endDt'] = $endDate->format('Y-m-d');
    }  
    $logger->debug("getSalaryExpenseAllocation() ", $data);
    return $data;
}
function update_salaryExpenseAllocation($rowId) {
    global $db;
    global $logger;
    try {
        $logger->debug("update_salaryExpenseAllocation() ", $_GET); 
        $data = getSalaryExpenseAllocation();
        $db->where('oid', $rowId);
        $db->update('employeesalaryexpenseallocation', $data);
        $logger->debug("update_salaryExpenseAllocation() ", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('updated', $rowId, $rowId, "SUCCESS!!");
        } else {
            return array('error', $rowId, $rowId, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("update_salaryExpenseAllocation()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }    
}

function add_salaryExpenseAllocation($employeeType) {
    global $db;
    global $logger;
    
    try {
        $logger->debug("add_salaryExpenseAllocation() ", $_GET);
        $data = getSalaryExpenseAllocation();
        $id = $db->insert('employeesalaryexpenseallocation', $data);
        $logger->debug("add_salaryExpenseAllocation()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $id, $id, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_salaryExpenseAllocation()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }         
}

function update_employeeLoanPmt($rowId, $loanPmt) {
    global $db;
    global $logger;
    $logger->debug("update_casualsPayslip() ", $_GET);
    die;
    if (!$loanPmt["loanPmtOid"]) {
        //loan pmt DOES NOT exist, create new
        $dataArray["employeeLoanOid"] = $loanPmt["employeeLoanOid"];
        $dataArray["employeePaySlipOid"] = filter_input(INPUT_GET, "c19");
        $dataArray["dateDeducted"] = $today = date('Y-m-d');
        $dataArray["deductionAmt"] = filter_input(INPUT_GET, "c13");
        $dataArray["balanceAmount"] = 0.0; //calculated in the tables insert trigger
        $id = $db->insert('EmployeeLoanPmt', $dataArray);
        $logger->debug("update_employeeLoanPmt()", $db->getLastQuery());
        if ($db->getLastErrno() === 0)
            return array('inserted', $id, $id, "SUCCESS!!");
        else
            return array('error', $id, $id, $db->getLastError());
    }
    else {
        //loan pmt exists, get it
        if (filter_input(INPUT_GET, "c13")) {
            $dataArray = Array();
            $dataArray["dateDeducted"] = filter_input(INPUT_GET, "c13");
            $dataArray["deductionAmt"] = filter_input(INPUT_GET, "c13");
            $dataArray["deductionAmt"] = filter_input(INPUT_GET, "c13");
        }
        $db->where('oid', $rowId);
        $db->update('EmployeeLoanPmt', $data);
        $logger->debug("update_casualsPayslip() ", $db->getLastQuery());
        if ($db->getLastErrno() === 0)
            return array('updated', $rowId, $rowId, "SUCCESS!!");
        else
            return array('error', $rowId, $rowId, $db->getLastError());
    }
}

function getClosestPayPeriodStartDt($date, $employeeType) {
    global $db;
    global $logger;
    $logger->debug("getClosestPayPeriodStartDt()", ['date:' => $date, 'employeeType:' => $employeeType]);
    $periodStartDate = null;
    $dateStr = new DateTime($date);
    switch ($employeeType) {
        case "C":
        case "CASUALS":
        case "CASUAL LABOURER":
            $sql = "SELECT periodStartDate "
                . "FROM opsbiweeklycalendar "
                . "WHERE periodStartDate >= '" . $dateStr->format('Y-m-d') . "' "
                . "ORDER BY periodStartDate LIMIT 1";
            $rows = $db->query($sql);
            $logger->debug("getClosestPayPeriodStartDt()", $db->getLastQuery());
            foreach ($rows as $row) {
                $periodStartDate = $row['periodStartDate'];
            }
            break;
        case "S":
        case "FTE":
        case "SALARIED LABOURER":
            $periodStartDate = getClosestMonthStartDt($dateStr);
            break;
        case "F":
            throw new Exception('Unable to set salary for Contract worker. Contact Sys admin');
            break;
    }
    return $periodStartDate;
}

function getClosestPayPeriodEndDt($currentStartDt, $specifiedEndDt, $employeeType) {
    global $db;
    global $logger;
    $periodEndDt = '';
    $dateStr = new DateTime($specifiedEndDt);
    switch ($employeeType) {
        case "C":
            $rows = $db->query("SELECT periodEndDt "
                . "FROM opsbiweeklycalendar "
                . "WHERE periodEndDt >= '" . $dateStr->format('Y-m-d') . "' "
                . "ORDER BY periodEndDt LIMIT 1");
            $logger->debug("getClosestPayPeriodEndDt() for " . $currentStartDt . ", " . $specifiedEndDt . ")", $db->getLastQuery());
            foreach ($rows as $row) {
                $periodEndDt = $row['periodEndDt'];
            }
            break;
        case "S":
            $sql = "SELECT LAST_DAY('" . $dateStr->format('Y-m-d') . "') AS periodEndDt";
            $rows = $db->query($sql);
            $logger->debug("getClosestPayPeriodEndDt() for " . $currentStartDt . ", " . $specifiedEndDt . ")", $db->getLastQuery());
            foreach ($rows as $row) {
                $periodEndDt = $row['periodEndDt'];
            }
            break;
        case "F":
            throw new Exception('Unable to set salary for Contract worker. Contact Sys admin');
            break;
    }


    return $periodEndDt;
}

function getClosestMonthStartDt($dt) {
    global $db;
    global $logger;
    $date = $dt->format('Y-m-d');
    $rows = $db->query("SELECT DATE_ADD(LAST_DAY('$date'),INTERVAL 1 DAY) as firstDay");
    $logger->debug("getClosestMonthStartDt()", $db->getLastQuery());
    foreach ($rows as $row) {
        return $row['firstDay'];
    }
}

function getClosestMonthEndDt($dt) {
    global $db;
    global $logger;
    $date = $dt->format('Y-m-d');
    $rows = $db->query("SELECT LAST_DAY('$date') as lastDay");
    $logger->debug("getClosestMonthStartDt()", $db->getLastQuery());
    foreach ($rows as $row) {
        return $row['lastDay'];
    }
}

function attendanceExistsBetween($periodStartDt, $periodEndDt) {
    global $db;
    global $logger;
    $rows = $db->query("SELECT COUNT(DISTINCT attendanceDt) AS rowcount FROM empTeaPickingDetail_vw WHERE attendanceDt BETWEEN '$periodStartDt' AND '$periodEndDt'");
    if ($rows) {
        foreach ($rows as $row) {
            $rowcount = $row['rowcount'];
        }
    }
    if ($rowcount < 14)
        return false;
    else
        return true;
}

function loadErrorGrid($errorMsg) {
    global $db;
    global $logger;
    $logger->debug("loadErrorGrid()", ['ERROR THROWN 3: ' => $errorMsg]);

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>');

    /* start output of data */
    echo '<rows id="0">';
    echo '	<head>
				<column width="1100" height="500" type="ro" align="left" sort="str" >MESSAGE</column>
			</head>';
    echo ("<row id='0'>");
    print("<cell><![CDATA[" . $errorMsg . "]]></cell>");
    print("</row>");
    echo '</rows>';

    return array('updated', 0, 0);
}

function loadErrorPopup($errorMsg) {
    global $db;
    global $logger;
    $logger->debug("loadErrorPopup()", ['FORM ERROR: ' => $errorMsg]);

    header("Content-type: text/xml");
    print("ERROR: ".$errorMsg." <br>");
}

function getEmployeeNamesList($employeeType = null) {
    global $db;
    global $logger;

    $sql = "SELECT employee.oid AS oid, firstName, middleinitial, lastName "
        . "FROM employee "
        . "INNER JOIN salary on salary.employeeOid = employee.oid "
        . "WHERE `terminated` = 0 ";

    if (isset($employeeType)) {
        switch ($employeeType) {
            case "FTE":
                $sql .= "AND salary.employeetype = 'S' ";
                break;
            case "CASUALS":
                $sql .= "AND salary.employeetype = 'C' ";
                break;
            default:
                break;
        }
    }
    $sql .= "ORDER BY employee.firstName, employee.middleinitial, employee.lastName";
    $db->query($sql);

    $listObj = $db->query($sql);
    $theList = '';
    if ($listObj) {

        foreach ($listObj as $row) {
            $id = $row["oid"];
            $displayValues = $row["firstName"] . " " . $row["middleinitial"] . " " . $row["lastName"];
            $theList .= "<option value='" . $id . "'>" . $displayValues . "</option>";
        }
    }
    $logger->debug('getEmployeeNamesList()', $db->getLastQuery());
    $logger->debug('getEmployeeNamesList()-theList', ['theList' => $theList]);
    return $theList;
}

function getFTEemployeeNamesList() {
    global $db;
    global $logger;
    $employeeObj = $db->query("SELECT employee.oid AS eOid, firstName, middleinitial, lastName "
        . "FROM employee "
        . "INNER JOIN salary ON salary.employeeOid = employee.oid "
        . "WHERE salary.employeetype = 'S' ");
    $logger->debug('getFTEemployeeNamesList()', $db->getLastQuery());
    $FTEemployeeNameList = '';
    if ($employeeObj) {
        foreach ($employeeObj as $value) {
            $id = $value["eOid"];
            $employeeNm = $value["firstName"] . " " . $value["middleinitial"] . " " . $value["lastName"];
            $FTEemployeeNameList .= "<option value='" . $id . "'>" . $employeeNm . "</option>";
        }
    }
    return $FTEemployeeNameList;
}

function getCustomerNamesList() {
    global $db;
    global $logger;
    $customerObj = $db->query("SELECT oid, businessName,storeNameNbr FROM customer ORDER BY businessName,storeNameNbr");
    $customerList = '';
    if ($customerObj) {
        foreach ($customerObj as $value) {
            $id = $value["oid"];
            $customerNm = $value["businessName"] . " -" . $value["storeNameNbr"];
            $customerList .= "<option value='" . $id . "'>" . $customerNm . "</option>";
        }
    }
    return $customerList;
}

function getHortProduceList() {
    global $db;
    global $logger;
    $produceObj = $db->query("SELECT oid, name FROM horticultureproduceparent ORDER BY name");
    $produceList = '';
    if ($produceObj) {
        foreach ($produceObj as $value) {
            $id = $value["oid"];
            $produceNm = $value["name"];
            $produceList .= "<option value='" . $id . "'>" . $produceNm . "</option>";
        }
    }
    $logger->debug('getHortProduceList()', $db->getLastQuery());
    return $produceList;
}

function getHortProduceSellUnitList() {
    global $db;
    global $logger;
    $unitObj = $db->query("SELECT unit, description FROM HorticultureSellUnit ORDER BY description");
    $unitList = '';
    if ($unitObj) {
        foreach ($unitObj as $value) {
            $id = $value["unit"];
            $unitNm = $value["description"];
            $unitList .= "<option value='" . $id . "'>" . $unitNm . "</option>";
        }
    }
    $logger->debug('getHortProduceSellUnitList()', $db->getLastQuery());
    return $unitList;
}

function getExpenseCategoryList() {
    global $db;
    global $logger;
    $unitObj = $db->query("SELECT oid, COGS, description FROM ExpenseCategory ORDER BY description");
    $unitList = '';
    if ($unitObj) {
        foreach ($unitObj as $value) {
            $id = $value["oid"];
            $unitNm = $value["description"];
            $unitList .= "<option value='" . $id . "'>" . $unitNm . "</option>";
        }
    }
    $logger->debug('getHortProduceSellUnitList()', $db->getLastQuery());
    return $unitList;
}

function getVehicleRegList() {
    global $db;
    global $logger;
    $unitObj = $db->query("SELECT oid, registration FROM vehicle ORDER BY registration");
    $unitList = '';
    if ($unitObj) {
        foreach ($unitObj as $value) {
            $id = $value["oid"];
            $unitNm = $value["registration"];
            $unitList .= "<option value='" . $id . "'>" . $unitNm . "</option>";
        }
    }
    $logger->debug('getVehicleRegList()', $db->getLastQuery());
    return $unitList;
}

function getTeaBlocksList() {
    global $db;
    global $logger;
    $unitObj = $db->query("SELECT * FROM teablock");;
    $unitList = '';
    if ($unitObj) {
        foreach ($unitObj as $value) {
            $id = $value["oid"];
            $unitNm = $value["name"];
            $unitList .= "<option value='" . $id . "'>" . $unitNm . "</option>";
        }
    }
    $logger->debug('getTeaBlocksList()', $db->getLastQuery());
    return $unitList;
}

function getPurchaseUnitList() {
    $theList = '<option value="KG">KG</option>
                <option value="PC">PC</option>
                <option value="BC">BUNCH</option>
                <option value="LTR">LTR</option>';
    return $theList;
}

function getCurrentYearMonthsList() {
    global $db;
    global $logger;
    $listObj = $db->query("SELECT oid, month, year, 0 AS flag FROM opsmonthlycalendar WHERE year = YEAR(CURRENT_DATE) ORDER BY monthNbr");
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $id = $row["oid"];
            $displayValues = $row["month"] . " -" . $row["year"];
            $theList .= "<option value='" . $id . "'>" . $displayValues . "</option>";
        }
    }
    $logger->debug('getCurrentYearMonthsList()', $db->getLastQuery());
    return $theList;
}

function getElecAccountList() {
    global $db;
    global $logger;
    $listObj = $db->query("SELECT oid, accountNbr FROM ElectricityAccount");
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $id = $row["oid"];
            $displayValues = $row["accountNbr"];
            $theList .= "<option value='" . $id . "'>" . $displayValues . "</option>";
        }
    }
    $logger->debug('getElecAccountList()', $db->getLastQuery());
    return $theList;
}

function getBiWeeklyCalendarDatesList() {
    global $db;
    global $logger;
    $listObj = $db->query("select oid, DATE_FORMAT(periodStartDate,'%b %d %Y') AS periodStartDate "
        . "FROM OpsBiWeeklyCalendar "
        . "WHERE periodStartDate BETWEEN DATE_ADD(CURRENT_DATE,INTERVAL -1 MONTH) AND DATE_ADD(CURRENT_DATE,INTERVAL 1 MONTH)");
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $id = $row["oid"];
            $displayValues = $row["periodStartDate"] . "-to-" . $row["periodEndDt"];
            $theList .= "<option value='" . $id . "'>" . $displayValues . "</option>";
        }
    }
    $logger->debug('getBiWeeklyCalendarList()', $db->getLastQuery());
    return $theList;
}

function getBiWeeklyCalendarStartDatesList() {
    global $db;
    global $logger;
    $listObj = $db->query("select oid, DATE_FORMAT(periodStartDate,'%b %d %Y') AS periodStartDate "
        . "FROM OpsBiWeeklyCalendar "
        . "WHERE periodStartDate BETWEEN DATE_ADD(CURRENT_DATE,INTERVAL -1 MONTH) AND DATE_ADD(CURRENT_DATE,INTERVAL 1 MONTH)");
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $id = $row["oid"];
            $displayValues = $row["periodStartDate"];
            $theList .= "<option value='" . $id . "'>" . $displayValues . "</option>";
        }
    }
    $logger->debug('getBiWeeklyCalendarStartDatesList()', $db->getLastQuery());
    return $theList;
}

function getBiWeeklyCalendarEndDatesList() {
    global $db;
    global $logger;
    $listObj = $db->query("select oid, DATE_FORMAT(periodEndDt,'%b %d %Y') AS periodEndDt "
        . "FROM OpsBiWeeklyCalendar "
        . "WHERE periodEndDt BETWEEN DATE_ADD(CURRENT_DATE,INTERVAL -1 MONTH) AND DATE_ADD(CURRENT_DATE,INTERVAL 1 MONTH)");
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $id = $row["oid"];
            $displayValues = $row["periodEndDt"];
            $theList .= "<option value='" . $id . "'>" . $displayValues . "</option>";
        }
    }
    $logger->debug('getBiWeeklyCalendarEndDatesList()', $db->getLastQuery());
    return $theList;
}

function getMonthlyCalendarDatesList() {
    global $db;
    global $logger;
    $listObj = $db->query("select oid, monthNbr, month, year "
        . "FROM opsmonthlycalendar "
        . "WHERE year = YEAR(CURRENT_DATE) "
        . "ORDER BY monthNbr ASC LIMIT 12");
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $id = $row["oid"];
            $displayValues = $row["month"] . " " . $row["year"];
            $theList .= "<option value='" . $id . "'>" . $displayValues . "</option>";
        }
    }
    $logger->debug('getMonthlyCalendarDatesList()', $db->getLastQuery());
    return $theList;
}

function getMonthlyCalendarStartDatesListAsDateString() {
    global $db;
    global $logger;
    $listObj = $db->query("select oid, monthNbr, month, year "
        . "FROM opsmonthlycalendar "
        . "WHERE year = YEAR(CURRENT_DATE) "
        . "ORDER BY monthNbr ASC LIMIT 12");
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $id = $row["oid"];
            $dateStr = new DateTime($row["year"].'-'.$row["monthNbr"].'-01');
//            $dateStr = new DateTime('2017-01-01');
            $displayValues = $dateStr->format('M.d.Y');
            $theList .= "<option value='" . $displayValues . "'>" . $displayValues . "</option>";
        }
    }
    $logger->debug('getMonthlyCalendarStartDatesListAsDateString()', $db->getLastQuery());
    return $theList;
}

function getMonthlyCalendarEndDatesListAsDateString() {
    global $db;
    global $logger;
    $listObj = $db->query("select oid, monthNbr, month, year "
        . "FROM opsmonthlycalendar "
        . "WHERE year = YEAR(CURRENT_DATE) "
        . "ORDER BY monthNbr ASC LIMIT 12");
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $id = $row["oid"];
            $dateStr = new DateTime($row["year"].'-'.$row["monthNbr"].'-01');
//            $dateStr = new DateTime('2017-01-01');
            $displayValues = $dateStr->format('M.t.Y');
            $theList .= "<option value='" . $displayValues . "'>" . $displayValues . "</option>";
        }
    }
    $logger->debug('getMonthlyCalendarEndDatesListAsDateString()', $db->getLastQuery());
    return $theList;
}

function getMonthlyCalendarStartAsDateStr($oid) {
    global $db;
    global $logger;
    $rows = $db->query("select oid, monthNbr, month, year "
        . "FROM opsmonthlycalendar "
        . "WHERE oid = $oid");
    $logger->debug('getMonthlyCalendarStartAsDate()', $db->getLastQuery());
    if ($rows) {
        foreach ($rows as $row) {
            $d = new DateTime($row["year"].'-'.$row["monthNbr"].'-01');
            return $d->format('Y-m-d');            
        }
    }
    else {
        throw new Exception("getMonthlyCalendarStartAsDate($oid) retrieved NULL");
    }
}

function getMonthlyCalendarEndAsDateStr($oid) {
    global $db;
    global $logger;
    $rows = $db->query("select oid, monthNbr, month, year "
        . "FROM opsmonthlycalendar "
        . "WHERE oid = $oid");
    $logger->debug('getMonthlyCalendarEndAsDateStr()', $db->getLastQuery());
    if ($rows) {
        foreach ($rows as $row) {
            $d = new DateTime($row["year"].'-'.$row["monthNbr"].'-01');
            return $d->format('Y-m-t');            
        }
    }
    else {
        throw new Exception("getMonthlyCalendarEndAsDateStr($oid) retrieved NULL");
    }
}

function get24hrClockList() {
    global $db;
    global $logger;
    $listObj = $db->query("SELECT timeString FROM `ops24hrtime`");
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $theList .= "<option value='" . $row["timeString"] . "'>" . $row["timeString"] . "</option>";
        }
    }
    $logger->debug('get24hrClockList()', $db->getLastQuery());
    return $theList;
}

function getOtherClockList() {
    global $db;
    global $logger;
    $listObj = $db->query("SELECT * FROM ops24hrtime WHERE timeString >= '08:00' AND timeString <= '17:00' ");
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $theList .= "<option value='" . $row["timeString"] . "'>" . $row["timeString"] . "</option>";
        }
    }
    $logger->debug('getOtherClockList()', $db->getLastQuery());
    return $theList;
}

function getParttimeClockList() {
    global $db;
    global $logger;
    $listObj = $db->query("SELECT * FROM ops24hrtime WHERE timeString <= '08:00' OR timeString >= '17:00'");
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $theList .= "<option value='" . $row["timeString"] . "'>" . $row["timeString"] . "</option>";
        }
    }
    $logger->debug('getParttimeClockList()', $db->getLastQuery());
    return $theList;
}

function getLOBnamesList() {
    global $db;
    global $logger;
    $listObj = $db->query("select oid, department from lineofbusiness ORDER BY department");
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $id = $row["oid"];
            $displayValues = $row["department"];
            $theList .= "<option value='" . $id . "'>" . $displayValues . "</option>";
        }
    }
    $logger->debug('getLOBnamesList()', $db->getLastQuery());
    return $theList;
}

function getEmployeeRolesList() {
    global $db;
    global $logger;
    $listObj = $db->query("SELECT oid, role FROM employeeroletype ORDER BY role");
    $logger->debug('getEmployeeRolesList()', $db->getLastQuery());
    if ($db->getLastErrno() != 0) {
        throw new Exception("getEmployeeRolesList()", $db->getLastError());
    }
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $id = $row["oid"];
            $displayValues = $row["role"];
            $theList .= "<option value='" . $id . "'>" . $displayValues . "</option>";
        }
    }
    return $theList;
}

function getSupervisorNamesList(){
    global $db;
    global $logger;
    $listObj = $db->query("SELECT employee.oid, CONCAT( employee.firstName, ' ', employee.middleInitial,' ', employee.lastName) AS employeeName "
        . "FROM employee INNER JOIN (employeerole, employeeroletype) "
        . "ON ( employee.oid = employeerole.employeeOid AND employeerole.employeeRoleTypeOid = employeeroletype.oid ) "
        . "WHERE role = 'SUPERVISOR' OR role = 'DIRECTOR' "
        . "ORDER BY employeeName");
    $logger->debug('getSupervisorNamesList()', $db->getLastQuery());
    if ($db->getLastErrno() != 0) {
        throw new Exception("getSupervisorNamesList()", $db->getLastError());
    }
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $id = $row["oid"];
            $displayValues = $row["employeeName"];
            $theList .= "<option value='" . $id . "'>" . $displayValues . "</option>";
        }
    }
    return $theList;    
}
function getEmployeeGenderList(){
    $theList = '<option value="MALE">M</option>
                <option value="FEMALE">F</option>';
    return $theList;    
}

function getHortBrandList() {
    global $db;
    global $logger;
    $unitObj = $db->query("SELECT name FROM HorticultureProduceBrand ORDER BY name");
    if ($db->getLastErrno() != 0) {
        throw new Exception("getHortBrandList()", $db->getLastError());
    }    
    $unitList = '';
    $i = 0;
    if ($unitObj) {
        foreach ($unitObj as $value) {
            $id = $value["name"];
            $unitNm = $value["name"];
            $unitList .= "<option value='" . $id . "'>" . $unitNm . "</option>";
        }
    }
    $logger->debug('getHortBrandList()', $db->getLastQuery());
    return $unitList;
}

function getHortProduceParentList() {
    global $db;
    global $logger;
    $listObj = $db->query("SELECT oid, name FROM HorticultureProduceParent ORDER BY name");
    $theList = '';
    if ($listObj) {
        foreach ($listObj as $row) {
            $id = $row["oid"];
            $displayValues = $row["name"];
            $theList .= "<option value='" . $id . "'>" . $displayValues . "</option>";
        }
    }
    $logger->debug('getHortProduceParentList()', $db->getLastQuery());
    return $theList;
}

function logStart($filename) {
    global $db;
    global $logger;
    $logger->debug($filename, ['' => '']);    
    $logger->debug($filename, ['START' => '---------------------------------------[' . $filename . ']---------------------------------------------------']);
}

function logEnd($filename) {
    global $db;
    global $logger;
    $logger->debug($filename, ['END' => '---------------------------------------[' . $filename . ']---------------------------------------------------']);
}

