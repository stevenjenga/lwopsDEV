<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 														EXPENSE CAPTURE CRUD
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_expense(){
    global $db;
	global $logger;
	
	$logger->debug('add_expense() -GET', $_GET);
	
	$data = Array (
			   "expenseDate" => date('Y-m-d',strtotime($_GET["c0"])),
			   "payee" => $_GET["c1"],
				"narration" => $_GET["c2"],
				"activityOid" => $_GET["c3"],
				"lineOfBusinessOid" => $_GET["c4"],
				"amount" => $_GET["c5"],
				"categoryOid" => $_GET["c6"]
				);

    $id = $db->insert ('expenses', $data);
    $logger->debug('add_expense()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return array('inserted',$id,$id,"SUCCESS!!");
    } else {
        return array('error',$id,$id,$db->getLastError());
    } 
}

function update_expense($rowId){
	global $errorLogger;
	global $logger;
	global $db;
	
	$logger->debug('update_expense() -GET', $_GET);
	$data = Array (					   
				"expenseDate" => date('Y-m-d',strtotime($_GET["c0"])),
				"payee" => $_GET["c1"],
				"narration" => $_GET["c2"],
				"amount" => $_GET["c5"]
				);
	
	if(is_numeric($_GET["c3"])){
		$data['activityOid']=$_GET["c3"];		
	}
	
	if(is_numeric($_GET["c4"])){
		$data['lineOfBusinessOid']=$_GET["c4"];	
	}		

	if(is_numeric($_GET["c6"])){
		$data['categoryOid']=$_GET["c6"];	
	}
	
	$db->where ('oid', $rowId);
	$db->update ('expenses', $data);	
	$logger->debug('update_expense()', $db->getLastQuery());

	if ($db->getLastErrno() === 0)	
		return array('updated',$rowId,$rowId,"SUCCESS!!");
	else 
		return array('error',$rowId,$rowId,$db->getLastError());	
}

function delete_expense($rowId){
    global $db;
	global $logger;
    
    $db->where ('oid', $rowId);
	$db->delete ('expenses');	
	$logger->debug('delete_expense()', $db->getLastQuery());

	if ($db->getLastErrno() === 0)	
		return array('deleted',$rowId,$rowId,"SUCCESS!!");
	else 
		return array('error',$rowId,$rowId,$db->getLastError());
}

function add_elecExpense(){
    global $db;
	global $logger;
	
    $logger->debug('add_elecExpense()', $_GET);
	$data = Array (					   
				"amount" => $_GET["c2"]
				);
	if(is_numeric($_GET["c0"])){
		$data['opsMonthlyCalendarOid'] = $_GET['c0'];
	}
	if(is_numeric($_GET["c1"])){
		$data['electricityAccounOid']=$_GET["c1"];
	}

    $id = $db->insert ('ElectricityExpense', $data);
    $logger->debug('update_elecExpense()', $db->getLastQuery());
    if ($db->getLastErrno() === 0) {
        return array('inserted',$id,$id,"SUCCESS!!");
    } else {
        return array('error',$id,$id,$db->getLastError());
    } 
}

function update_elecExpense($rowId){
	global $logger;
	global $db;
	
	$logger->debug('update_elecExpense(', $_GET);
	$data = Array (					   
				"amount" => $_GET["c2"]
				);
	if(is_numeric($_GET["c0"])){
		$data['opsMonthlyCalendarOid'] = $_GET['c0'];
	}	
	if(is_numeric($_GET["c1"])){
		$data['electricityAccounOid']=$_GET["c1"];
	}
	$db->where ('oid', $rowId);
	$db->update ('ElectricityExpense', $data);	
	$logger->debug('update_elecExpense()', $db->getLastQuery());

	if ($db->getLastErrno() === 0)	
		return array('updated',$rowId,$rowId,"SUCCESS!!");
	else 
		return array('error',$rowId,$rowId,$db->getLastError());	
}

function delete_elecExpense($rowId){}

function add_elecExpAllocation(){
    global $db;
	global $logger;
    $id = 0;
	try {
        $logger->debug('add_elecExpAllocation()', $_GET);
        $account = $_GET['c0'];
        $data = Array (					   
                    "allocation" => $_GET['c2']
                    );
        if(is_numeric($account)){
            $data['electricityAccountOid'] = $account;
        }
        if(is_numeric($_GET["c1"])){
            $data['lineOfBusinessOid']=$_GET["c1"];
        }
        if(is_numeric($_GET["c3"])){
            $data['startOpsMonthlyCalendarOid'] = $_GET['c3'];
        }
        if(is_numeric($_GET["c4"])){
            $data['endtOpsMonthlyCalendarOid']=$_GET["c4"];
        }
        $id = $db->insert ('electricityallocation', $data);
        $logger->debug('add_elecExpAllocation()', $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted',$id,$id,"SUCCESS!!");
        } else {
            return array('error',$id,$id,$db->getLastError());
        } 
    }
    catch (Exception $e) {
        return array('error',$id,$id,$db->getLastError());
    }
}

function update_elecExpAllocation($rowId){
	global $logger;
	global $db;
    try {
        $logger->debug('update_elecExpAllocation()', $_GET);
        $account = $_GET['c0'];
        $allocationAmount = $_GET['c2'];
        
        $data = Array (					   
                    "allocation" => $allocationAmount
                    );
        if(is_numeric($_GET["c0"])){
            $data['electricityAccountOid'] = $account;
        }
        if(is_numeric($_GET["c1"])){
            $data['lineOfBusinessOid']=$_GET["c1"];
        }
        if(is_numeric($_GET["c3"])){
            $data['startOpsMonthlyCalendarOid'] = $_GET['c3'];
        }
        if(is_numeric($_GET["c4"])){
            $data['endtOpsMonthlyCalendarOid']=$_GET["c4"];
        }
        $db->where ('oid', $rowId);
        $db->update ('electricityallocation', $data);	
        $logger->debug('update_elecExpAllocation()', $db->getLastQuery());

        if ($db->getLastErrno() === 0)	
            return array('updated',$rowId,$rowId,"SUCCESS!!");
        else 
            return array('error',$rowId,$rowId,$db->getLastError());
    }
    catch (Exception $e) {
        return array('error',$rowId,$rowId,$e->getMessage());
    }        
}

function add_vehicleExpense(){
    global $db;
	global $logger;
    $id = 0;
	try {
        $logger->debug('add_vehicleExpense()', $_GET);
        
        $data = Array (	
				"date" => date('Y-m-d',strtotime($_GET["c0"])),
                "payee" => $_GET['c2'],
                "narration" => $_GET['c3'],
                "amount" => $_GET['c4']
                    );
        if(is_numeric($_GET["c1"])){
            $data['vehicleOid']=$_GET["c1"];
        }
        if(is_numeric($_GET["c5"])){
            $data['expenseCategoryOid'] = $_GET['c5'];
        }
        $id = $db->insert ('VehicleExpense', $data);
        $logger->debug('add_vehicleExpense()', $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted',$id,$id,"SUCCESS!!");
        } else {
            return array('error',$id,$id,$db->getLastError());
        } 
    }
    catch (Exception $e) {
        return array('error',$id,$id,$db->getLastError());
    }
}

function update_vehicleExpense($rowId){
	global $logger;
	global $db;
    try {
        $logger->debug('update_vehicleExpense()', $_GET);

        $data = Array (	
				"date" => date('Y-m-d',strtotime($_GET["c0"])),
                "payee" => $_GET['c2'],
                "narration" => $_GET['c3'],
                "amount" => $_GET['c4']
                    );
        if(is_numeric($_GET["c1"])){
            $data['vehicleOid']=$_GET["c1"];
        }
        if(is_numeric($_GET["c5"])){
            $data['expenseCategoryOid'] = $_GET['c5'];
        }

        $db->where ('oid', $rowId);
        $db->update ('VehicleExpense', $data);	
        $logger->debug('update_vehicleExpense()', $db->getLastQuery());

        if ($db->getLastErrno() === 0)	
            return array('updated',$rowId,$rowId,"SUCCESS!!");
        else 
            return array('error',$rowId,$rowId,$db->getLastError());
    }
    catch (Exception $e) {
        return array('error',$rowId,$rowId,$e->getMessage());
    }        
}

function delete_vehicleExpense($rowId){}

function add_vehicleExpenseAllocation(){
    global $db;
	global $logger;
    $id = 0;
	try {
        $logger->debug('add_vehicleExpenseAllocation()', $_GET);
        
        $data = Array (	
				"allocation" => $_GET['c2']
                    );
        if(is_numeric($_GET["c0"])){
            $data['vehicleOid']=$_GET["c0"];
        }
        if(is_numeric($_GET["c1"])){
            $data['lineOfBusinessOid'] = $_GET['c1'];
        }
        if(is_numeric($_GET["c3"])){
            $data['startOpsMonthlyCalendarOid'] = $_GET['c3'];
        }
        if(is_numeric($_GET["c4"])){
            $data['endOpsMonthlyCalendarOid'] = $_GET['c4'];
        }        
        $id = $db->insert ('VehicleExpenseAllocation', $data);
        $logger->debug('add_vehicleExpenseAllocation()', $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted',$id,$id,"SUCCESS!!");
        } else {
            return array('error',$id,$id,$db->getLastError());
        } 
    }
    catch (Exception $e) {
        return array('error',$id,$id,$db->getLastError());
    }
}

function update_vehicleExpenseAllocation($rowId){
	global $logger;
	global $db;
    try {
        $logger->debug('update_vehicleExpenseAllocation()', $_GET);
        
        $data = Array (	
				"allocation" => $_GET['c2']
                    );
        if(is_numeric($_GET["c0"])){
            $data['vehicleOid']=$_GET["c0"];
        }
        if(is_numeric($_GET["c1"])){
            $data['lineOfBusinessOid'] = $_GET['c1'];
        }
        if(is_numeric($_GET["c3"])){
            $data['startOpsMonthlyCalendarOid'] = $_GET['c3'];
        }
        if(is_numeric($_GET["c4"])){
            $data['endOpsMonthlyCalendarOid'] = $_GET['c4'];
        } 
        $db->where ('oid', $rowId);
        $db->update ('VehicleExpenseAllocation', $data);	
        $logger->debug('update_vehicleExpenseAllocation()', $db->getLastQuery());

        if ($db->getLastErrno() === 0)	
            return array('updated',$rowId,$rowId,"SUCCESS!!");
        else 
            return array('error',$rowId,$rowId,$db->getLastError());
    }
    catch (Exception $e) {
        return array('error',$rowId,$rowId,$e->getMessage());
    }        
}

function delete_vehicleExpenseAllocation($rowId){}

//OBSOLETE - to be replaced with triggers
function validateAllocationLessThan100Percent($account, $allocationAmount){
    global $db;
	global $logger;  
    $sql = "SELECT SUM(allocation) AS currentTot FROM electricityallocation ";
    
    if(is_numeric($account)){
        $sql .= "WHERE electricityAccountOid = $account LIMIT 1";
    }   
    else {
        $sql .= "INNER JOIN electricityaccount ON electricityaccount.oid = electricityallocation.electricityAccountOid "
            . "WHERE accountNbr = TRIM('$account')";
    }
    $rows = $db->query($sql);
    $logger->debug('validateAllocationLessThan100Percent()',$db->getLastQuery());    
    if($rows){
        foreach($rows as $row){ 
            $logger->debug('validateAllocationLessThan100Percent()',['TOT allocation will be: '=>$allocationAmount + $row["currentTot"]]);
            if (($allocationAmount + $row["currentTot"]) <= 100) {
                return $allocationAmount;
            }
            else {
                throw new Exception("Allocation amount is > 100%. Shouuld be (". (100 - $row["currentTot"]).") for selected account.");
            }
        }
    } 
}
function delete_elecExpAllocation($rowId){}

