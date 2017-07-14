<?php
require_once('../functions/functions.php');
global $db;
global $logger;
global $errorLogger;

$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $_GET); die;
$mode = $_GET["!nativeeditor_status"]; 
$employeePaySlipoid = $_GET["employeePaySlipoid"]; 
header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="iso-8859-1"?>'); 

switch($mode){
	case "inserted":
	break;
	case "deleted":
	break;
	default:
		$db->where('employeePaySlipOid', $employeePaySlipoid);
        if ($db->has('EmployeeLoanPmt')){
            $sql = "SELECT 
                    employeeloanpmt.oid AS loanPmtOid, 
                    `employeeLoanOid`, 
                    `employeePaySlipOid`, 
                    `dateDeducted`, 
                    `deductionAmt`, 
                    `balanceAmount`,
                    employeeloan.loanAmount AS loanAmt 
                    FROM 
                    `employeeloanpmt` 
                    INNER JOIN employeeloan ON employeeloan.oid = employeeloanpmt.employeeLoanOid";
            $rows = $db->query($sql);
            if($rows){
                foreach($rows as $aRow){
                    $data = Array (
                        "loanPmtOid" => $aRow["loanPmtOid"],
                        "employeeLoanOid" => $aRow["employeeLoanOid"],
                        "employeePaySlipOid" => $aRow["employeePaySlipOid"],
                        "dateDeducted" => $aRow["dateDeducted"],
                        "balanceAmount" => $aRow["balanceAmount"],
                        "loanAmt" => $aRow["loanAmt"]
                        );
                }
            }       
        }
        else {
            $data = Array (
                        "loanPmtOid" => 0
                        );
        }
    $action = update_casualsPayslip($rowId, $data);
	break;
}

/* output update results */
echo "<data>";
echo "<action type='".$action[0]."' sid='".$action[1]."' tid='".$action[2]."'>".$action[3]."</action>";
echo "</data>";

function employeeLoanPmtRecord($employeePaySlipoid){

}
?>

