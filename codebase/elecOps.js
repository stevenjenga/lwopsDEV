/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	ELEC OPS GRIDS
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function elecExpenseAllocationGrid(){
    myLayout.cells("a").setText('ELECTRICITY EXPENSE ALLOCATION  | <input type="button" name="addNewElecExpenseAllocBtn" value=" Enter New Allocation " onclick="addNewElecExpenseAlloc();">  | <input type="button" name="elecExpenseAllocationUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);   
    myGrid = initMyGridNew("get_elec_exp_allocation_data_xml.php");
//    getDataXmlFile = "functions/get_elec_exp_allocation_data_xml.php";
//    myGrid = initMyGrid();
//    myGrid.load(getDataXmlFile);
//    myGrid.init();
    myGrid.attachHeader("#combo_filter,&nbsp;,&nbsp;,&nbsp;,&nbsp;");
        
    myDataProcessor = initMydataProcessor("update_elec_exp_allocation_data.php", 0)
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(2, greaterThanZero);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.init(myGrid);
}

function vehicleExpenseAllocationGrid(){
    myLayout.cells("a").setText('VEHICLE EXPENSE ALLOCATION  | <input type="button" name="addNewVehicleExpenseAllocBtn" value=" Enter New Allocation " onclick="addNewVehicleExpenseAlloc();">  | <input type="button" name="vehicleExpenseAllocationUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);   
    myGrid = initMyGridNew("get_vehicle_exp_allocation_data_xml.php");
       
    myDataProcessor = initMydataProcessor("update_vehicle_exp_allocation_data.php", 0)
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(2, greaterThanZero);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(4, not_empty);
    
    myDataProcessor.init(myGrid);    
}

function elecExpenseCaptureGrid(){
    myLayout.cells("a").setText('ELECTRICITY EXPENSES  | <input type="button" name="addNewElecExpenseBtn" value=" Enter New Expense " onclick="addNewElecExpense();">  |  <input type="button" name="elecExpenseUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    myGrid = initMyGridNew("get_elec_expense_data_xml.php");

    myGridCalendar = new dhtmlXCalendarObject("box");
    myGridCalendar.setSensitiveRange("2017-01-01", new Date());
    myGridCalendar.attachEvent("onClick", function(d){
    document.getElementById("box").value=get_currentDate_by_obj(d).date2;
            myGrid.clearAll();
            myGrid.load("functions/get_elec_expense_data_xml.php?date="+get_currentDate_by_obj(d).date1,function(){  //loading data to the grid
                    myGrid.forEachRow(function(id){});
            });
    });
    
    myDataProcessor = initMydataProcessor("update_elec_expense_data.php", 0)
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(3, greaterThanZero); 
    myDataProcessor.init(myGrid);
}

function addNewElecExpense(){
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID,['','',0.00],0);
    myGrid.setRowColor(rowID,"00ff66");    
}

function addNewElecExpenseAlloc(){
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID,['','',0,'',''],0);
    myGrid.setRowColor(rowID,"00ff66");    
}

function addNewVehicleExpenseAlloc(){
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID,['','',0.00],0);
    myGrid.setRowColor(rowID,"00ff66");    
}