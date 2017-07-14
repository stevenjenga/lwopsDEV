<?php
require_once('functions.php');
global $db, $logger;

try {
    logStart(pathinfo(__FILE__, PATHINFO_FILENAME));
    $logger->debug('REQUEST', $_REQUEST);
    loadSalaryExpenseAllocationGrid();
    logEnd(pathinfo(__FILE__, PATHINFO_FILENAME));
}
catch (Exception $e) {
	$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR THROWN: ' => $e->getMessage()]);
	loadErrorGrid("<b>".$e->getMessage()." [".$e->getLine()."]</b>");
}

function loadSalaryExpenseAllocationGrid(){
    global $db, $logger;

    if(isset($_REQUEST['employeeType']) ){
        $employeeType = $_REQUEST['employeeType'];	
    }    
    $sql = "SELECT DISTINCT role,employeesalaryexpenseallocation.oid, employeesalaryexpenseallocation.employeeOid, "
        . "CONCAT(firstName, ' ', middleInitial, ' ',lastName) AS employeeName, "
        . "DATE_FORMAT(employeesalaryexpenseallocation.effectiveDt,'%b.%d.%Y') AS effectiveDt, "
        . "DATE_FORMAT(		employeesalaryexpenseallocation.endDt,'%b.%d.%Y') AS endDt, allocation, "
        . "employeesalaryexpenseallocation.lineOfBusinessOid,department "
        . "FROM employeesalaryexpenseallocation "
        . "INNER JOIN (employee, employeerole, employeeroletype) "
            . "ON (employee.oid = employeesalaryexpenseallocation.employeeOid AND "
                . "employee.oid = employeerole.employeeOid AND "
                . "employeerole.employeeRoleTypeOid = employeeroletype.oid) "
        . "INNER JOIN lineofbusiness ON lineOfBusiness.oid = employeesalaryexpenseallocation.lineOfBusinessOid "
        . "WHERE employee.active = 1 AND employeeroletype.role != 'TEA PICKER' "
        . "ORDER BY employeeName, allocation";

    if(isset($_REQUEST['date']) ){
        $sql .= " AND e.active = 1 AND employeesalaryexpenseallocation.effectiveDt ='$date' ";
    }

    $rows = $db->query($sql);
    $logger->debug('loadSalaryExpenseAllocationGrid()', $db->getLastQuery());

    header("Content-type: text/xml");
    echo('<?xml version="1.0" encoding="utf-8"?>'); 

    echo '<rows id="0">';
    echo  '	<head>		
            <column width="120" type="coro"  text="" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1">Employee Name'.getNonTeaPickerEmployeeNamesList().'</column>
            <column width="100" type="ro" align="right" sort="str">Role</column>                       
            <column width="120*" type="coro"  text="some text" filter="true" align="left" editable="false" auto="true"  sort="str" xmlcontent="1" >Line of Business'.getLOBnamesList().'</column>
            <column width="75" type="ed" align="right" sort="str">Allocation (%)</column>
            <column width="110*" type="coro"  text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >Start Date'.getMonthlyCalendarStartDatesListAsDateString().'</column>
            <column width="110*" type="coro"  text="some text" filter="true" align="right" editable="false" auto="true"  sort="str" xmlcontent="1" >End Date'.getMonthlyCalendarEndDatesListAsDateString().'</column>
        </head>';

    if($rows){
        foreach($rows as $row){

            $endDt='';
            if(isset($row['endDt'])) 
                $endDt = date('M.d.Y', strtotime($row['endDt']));
            else
                $endDt = '';

            echo ("<row id='".$row['oid']."'>");	
            print("<cell><![CDATA[".$row['employeeName']."]]></cell>");
            print("<cell><![CDATA[".$row['role']."]]></cell>");
            print("<cell><![CDATA[".$row['department']."]]></cell>");
            print("<cell><![CDATA[".$row['allocation']."]]></cell>");
            print("<cell><![CDATA[".date('M.d.Y', strtotime($row['effectiveDt']))."]]></cell>");
            print("<cell><![CDATA[".$endDt."]]></cell>");
            print("</row>");
        }
    }
    echo '</rows>';
}

function getNonTeaPickerEmployeeNamesList(){
    global $db, $logger;
   
    $sql = "SELECT DISTINCT employee.oid, role, CONCAT( firstName, ' ', middleInitial, ' ', lastName ) AS employeeName "
        . "FROM employee "
        . "INNER JOIN (employeerole, employeeroletype) "
        . "ON ( employee.oid = employeerole.employeeOid AND employeerole.employeeRoleTypeOid = employeeroletype.oid ) "
        . "WHERE employee.active = 1 AND employeeroletype.role != 'TEA PICKER' "
        . "ORDER BY employeeName";
    
    $unitObj = $db->query($sql);
    $unitList = '';
    if ($unitObj) {
        foreach ($unitObj as $value) {
            $id = $value["oid"];
            $unitNm = $value["employeeName"];
            $unitList .= "<option value='" . $id . "'>" . $unitNm . "</option>";
        }
    }
    $logger->debug('getNonTeaPickerEmployeeNamesList()', $db->getLastQuery());
    return $unitList;    
}