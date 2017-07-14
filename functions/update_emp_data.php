<?php
require_once('../functions/functions.php');
global $db;
global $logger;
global $errorLogger;

$logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $_GET);
$mode = $_GET["!nativeeditor_status"]; 
$rowId = $_GET["gr_id"];

header("Content-type: text/xml");
echo('<?xml version="1.0" encoding="iso-8859-1"?>'); 

switch($mode){
	case "inserted":
        try {
            $db->startTransaction();
            $action = add_employee();
            $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $action); 
            if ($action[0] == "inserted"){
                $effectiveDate = new DateTime($action[3]);
                $today = new DateTime('today');
                while ( $effectiveDate <= $today){
                    //check if attendance has been created for this day = $effectiveDate
                    $db->where('attendanceDt', $effectiveDate->format('Y-m-d'));
                    //if it has, then add this new employee's attendance, else skip
                    if ($db->has('attendance')){
                        $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->getLastQuery()); 
                        $data=array(
                                'employeeOid'=> $action[1],
                                'attendance_in'=> 1,
                                'attendanceDt'=> $effectiveDate->format('Y-m-d')
                                );
                        $db->insert("attendance",$data); 
                        $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->getLastQuery());
                        unset($data);
                    }
                    else {
                        $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), $db->getLastQuery()); 
                    }
                    $interval = new DateInterval('P1D');
                    $effectiveDate->add($interval);                
                }            
            }
            $db->commit();
        }
        catch (Exception $e) {
            $logger->debug(pathinfo(__FILE__, PATHINFO_FILENAME), ['ERROR:'=>$e]);
            $db->rollback();
        } 
	break;
	case "deleted":
		//$action = delete_employee($rowId);
	break;
	default:
		$action = update_employee($rowId);
	break;
}	
/* output update results */
echo "<data>";
echo "<action type='".$action[0]."' sid='".$action[1]."' tid='".$action[2]."'>".$action[3]."</action>";
echo "</data>";

function insertAttendanceFromStartDtToToday($employeeOid, $effectiveDt){
    global $db;
    global $logger;
    $today = new DateTime('today');
//    $startDt = $effectiveDt->sub(new DateInterval('P1D'));
    while ( ($effectiveDt->sub(new DateInterval('P1D'))) < $today){
        $data=array(
                'employeeOid'=> $$employeeOid,
                'attendance_in'=> 1,
                'attendanceDt'=> $startDt->add(new DateInterval('P1D'))
                );
        $db->insert("attendance",$data);  
    }
}
?>