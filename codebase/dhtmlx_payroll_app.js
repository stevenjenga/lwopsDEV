/* 
Custom js that controls all the application GRID actions.

*/
var myLayout, myMenu, myGrid, myGridCalendar, payPeriodGrid, payMonthGrid, myDataProcessor, payPeriodDataProcessor;
var dhxComponent, myCombo, arrayOfRowIds, excelFileTitle, excelFileName, savedRowID, payPeriodDateRange, employeeType;
var deductLoan = 0;
var regenerate = 0;

var monthNames = ["January", "February", "March", "April", "May", "June",
					"July", "August", "September", "October", "November", "December"
				];

function initMydataProcessor(updtDataXmlFile, updateMode){
    console.log("updtDataXmlFile=" + updtDataXmlFile + " - updateMode=" + updateMode)
    aDataProcessor = new dataProcessor("functions/" + updtDataXmlFile);
    aDataProcessor.attachEvent("onRowMark", function (id) {
        if (this.is_invalid(id) == "invalid")
            return false;
        return true;
    });
    aDataProcessor.defineAction("updated", updateSucessMsgPopup);
    aDataProcessor.defineAction("inserted", insertSucessMsgPopup);
    aDataProcessor.defineAction("error", errorMsgPopup);
    aDataProcessor.setTransactionMode("GET", false);
    if(updateMode==0){
        aDataProcessor.setUpdateMode("off");
        console.log("update OFF");
    }
    return aDataProcessor;
}

function not_empty(value,row_id,column_index){
    console.log("not_empty value ="+value);
    if (value=="") {
        myGrid.setCellTextStyle(row_id,column_index,"background-color:red;");
        dhtmlx.alert({
                type:"alert-error",
                text:"This value(s) must be entered, cannot be empty",
                title:"Error!",
                ok:"Close"
        });                
        return false;
    }
    return true;
}

function greaterThanZero(value,row_id,column_index){
    console.log("greaterThanZero value = "+value);
    if (value > 0) {
        return true;
    }
    else {
        myGrid.setCellTextStyle(row_id,column_index,"background-color:red;");
        dhtmlx.alert({
                type:"alert-error",
                text:"This value(s) must be > 0",
                title:"Error!",
                ok:"Close"
        });                
        return false;
    }	
}

function sucessMsgPopup(){
	dhtmlx.message.position="top";
	dhtmlx.message("Data has been successfully saved!");
	return true;
}

function errorMsgPopup(response){
	console.log("error");
	dhtmlx.alert({
		  type:"alert-error",
		  text:response.firstChild.nodeValue,
		  title:"Error!",
		  ok:"OK"
	});
	return true;
 }

function isNumeric(n) {}

function get_currentDate_by_obj(d){
/*
#@ d given date object
return an object that content both normal date format and Named date format

*/

	var now = new Date(d);
	var day = ("0" + now.getDate()).slice(-2);
	var month =  now.getMonth()+1;
	var month3 =  now.getMonth();
	console.log(month);
	var month2 = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = (month)+"/"+(day)+"/"+now.getFullYear();
	var normalDate= now.getFullYear()+"/"+month2+"/"+day;
	var namedDate = monthNames[month3]+" "+day+" "+now.getFullYear();
	return {'date1':normalDate,'date2':namedDate};
}

function get_currentDate_Arr(){
	/*

	return an object that content current day, month and year

	*/

	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = (now.getMonth() + 1);
	var month2 = now.getMonth();
	var today = (month)+"/"+(day)+"/"+now.getFullYear();
	return {'day':day,'month':month,'year':now.getFullYear(),'actualMonth':month2};
}


function get_currentDate(){
	/*

	return current date

	*/

	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = (month)+"/"+(day)+"/"+now.getFullYear();
	return today;
}

function initMyGrid(getDataXmlFile,cell){
    console.log("cell = "+ cell);
    myGrid = myLayout.cells(cell).attachGrid('gridbox');
    myGrid.setImagePath("skins/web/imgs/dhxgrid_web/");

    myGrid.setDateFormat("%M.%d.%Y");
    myGrid.enableAutoWidth(true);
    myGrid.enableEditEvents(true,false, true);
    console.log("getDataXmlFile => "+getDataXmlFile);
    myGrid.load("functions/"+getDataXmlFile,function(){});
      
    myGrid.attachEvent("onBeforeSorting", function(ind,type,direction){
        console.log("onBeforeSorting event fired..."+ind+" - "+type+" - "+direction);
        return false;
    });

    console.log("grid loaded...");
    myGrid.setColSorting("na,na,na");
    myGrid.init();
    return myGrid;
}

function updateSucessMsgPopup(response){
	dhtmlx.message.position="top";
	dhtmlx.message("Changes successfully UPDATED!");
        console.log(response);
	return true;
}

function insertSucessMsgPopup(response){
	dhtmlx.message.position="top";
	dhtmlx.message("New record successfully INSERTED!");
        console.log(response);
	return true;
}

function errorMsgPopup(response){
	console.log("error");
        console.log(response);
	dhtmlx.alert({
		  type:"alert-error",
		  text:response.firstChild.nodeValue,
		  title:"Error!",
		  ok:"OK"
	});
	return true;
 }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	PAYROLL GRIDS
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function generatePayrollGrid(){
	console.log("Loading Payroll Grid.....");

	myLayout.cells("a").setText('Tea Payroll >>>| <input type="button" name="generateTeaPayrollBtn" value=" Generate " onclick="generateTeaPayroll();">');
	myLayout.cells("b").setText('Part Time Payroll >>>| <input type="button" name="generateParttimePayrollBtn" value=" Generate " onclick="generateParttimePayroll();">');
	myLayout.cells("c").setText('Other Work Payroll >>>| <input type="button" 	name="generateOtherWorkPayrollBtn" 	value=" Generate " onclick="generateOtherWorkPayroll();">');
	myLayout.cells("d").setText('Bi-Weekly Pay Calendar');
	myLayout.cells("d").setWidth(275);
	
	loadPageMenu(myLayout);
	
	displayPayPeriodGrid('d');
}

function generateTeaPayroll(){
	var i, selectedRowID, dateRange;
	
	i = 0;
	payPeriodGrid.forEachRow(function(row_id) {
		cellValue = payPeriodGrid.cellById(row_id,2).getValue();
		if(cellValue == 1) {
			i++;
			selectedRowID = row_id;
			dateRange = payPeriodGrid.cellById(row_id,0).getValue()+" -to- " +payPeriodGrid.cellById(row_id,1).getValue();
			excelFileName = "TeaPayRoll_"+payPeriodGrid.cellById(row_id,0).getValue()+"_" +payPeriodGrid.cellById(row_id,1).getValue();
			loadTeaPayrollGrid(selectedRowID,dateRange);
		}
	});
}

function loadTeaPayrollGrid(selectedRowID,selectedDateRange){
	myLayout.cells("a").setText('TEA Payroll >>>| <input type="button" name="generateTeaPayrollBtn" value=" Generate " onclick="generateTeaPayroll();"> - <b>['+selectedDateRange+']</b> - <input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">');
	myGrid = initMyGrid("get_teaPayroll_data_xml.php?selectedRowID="+selectedRowID, "a");
}


function generateParttimePayroll(){
	var i, selectedRowID, dateRange;
	
	i = 0;
	payPeriodGrid.forEachRow(function(row_id) {
		cellValue = payPeriodGrid.cellById(row_id,2).getValue();
		if(cellValue == 1) {
			i++;
			selectedRowID = row_id;
			dateRange = payPeriodGrid.cellById(row_id,0).getValue()+" -to- " +payPeriodGrid.cellById(row_id,1).getValue();
			excelFileName = "ParttimePayRollReport_"+payPeriodGrid.cellById(row_id,0).getValue()+"_" +payPeriodGrid.cellById(row_id,1).getValue();
			loadParttimePayrollGrid(selectedRowID,dateRange);
		}
	});
}

function loadParttimePayrollGrid(selectedRowID,selectedDateRange){
	myLayout.cells("b").setText('Part Time Payroll >>>| <input type="button" name="generateParttimePayrollBtn" value=" Generate " onclick="generateParttimePayroll();"> - <b>['+selectedDateRange+']</b> - <input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">');
	myGrid = initMyGrid("get_parttimePayroll_data_xml.php?selectedRowID="+selectedRowID, "b");
}

function generateOtherWorkPayroll(){
	var i, selectedRowID, dateRange;
	
	i = 0;
	payPeriodGrid.forEachRow(function(row_id) {
		cellValue = payPeriodGrid.cellById(row_id,2).getValue();
		if(cellValue == 1) {
			i++;
			selectedRowID = row_id;
			dateRange = payPeriodGrid.cellById(row_id,0).getValue()+" -to- " +payPeriodGrid.cellById(row_id,1).getValue();
			excelFileName = "OtherWorkPayRollReport_"+payPeriodGrid.cellById(row_id,0).getValue()+"_" +payPeriodGrid.cellById(row_id,1).getValue();
			loadOtherWorkPayrollGrid(selectedRowID,dateRange);
		}
	});
}

function loadOtherWorkPayrollGrid(selectedRowID,selectedDateRange){
	myLayout.cells("c").setText('Other Work Payroll >>>| <input type="button" name="generateParttimePayrollBtn" value=" Generate " onclick="generateOtherWorkPayroll();"> - <b>['+selectedDateRange+']</b> - <input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">');
	myGrid = initMyGrid("get_otherWorkPayroll_data_xml.php?selectedRowID="+selectedRowID, "c");
}

//function exportToExcel(){
//	console.log("codebase/grid-excel-php/generate.php?filename="+excelFileName);
//	myGrid.toExcel("codebase/grid-excel-php/generate.php?filename="+excelFileName);
//}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	CASUAL PAYSLIPS
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function listCasualsPaySlipsGrid(){
	console.log("Loading CASUALS listPaySlipsGrid.....");
	myLayout.cells("a").setText(' CASUALS PAY SLIPS   | <input type="button" name="viewCasualsPayslipsListBtn" value=" Click To View Payslips" onclick="viewCasualsPayslipsList();">');
	myLayout.cells("b").setText('Select Pay Period');
	myLayout.cells("b").setWidth(255);
	loadPageMenu(myLayout);
	
	displayPayPeriodGrid('b');
	myGrid = initMyGrid("get_casuals_payslip_data_xml.php?&regenerate=0&lockPayslip=0", "a");

        myDataProcessor = initMydataProcessor("update_casuals_payslip_data_xml.php", 0);
        myDataProcessor.init(myGrid);         
}

function viewCasualsPayslipsList(selectedDateRangeRowID,selectedDateRange){
	console.log("Viewing CASUALS PaySlips......");
	var i, selectedRowID, dateRangeTxt;
	i = 0;
	payPeriodGrid.forEachRow(function(row_id) {
		cellValue = payPeriodGrid.cellById(row_id,2).getValue();
		if(cellValue == 1) {
			i++;
			selectedRowID = row_id;
			dateRangeTxt = payPeriodGrid.cellById(row_id,0).getValue()+" -to- " +payPeriodGrid.cellById(row_id,1).getValue();
			excelFileName = "CASUALS_PaySlips_"+payPeriodGrid.cellById(row_id,0).getValue()+"_" +payPeriodGrid.cellById(row_id,1).getValue();
			loadCasualsPayslipsGrid(selectedRowID,dateRangeTxt);
		}
	});
}

function loadCasualsPayslipsGrid(selectedDateRangeRowID,selectedDateRange){
    console.log("Loading CASUALS Pay Slips.....");
    myLayout.cells("b").setText('Select Pay Period');	
    myGrid = initMyGrid("get_casuals_payslip_data_xml.php?employeeType="+employeeType+"&regenerate="+0+"&lockPayslip="+0+"&selectedDateRangeRowID="+selectedDateRangeRowID, "a");
    myGrid.selectRow(0);
    
    myDataProcessor = new dataProcessor("functions/update_casuals_payslip_data_xml.php"); 
    myDataProcessor.attachEvent("onRowMark",function(id){
        if (this.is_invalid(id)=="invalid") 
            return false;
        return true;
    });
    myDataProcessor.defineAction("updated",sucessMsgPopup);
    myDataProcessor.defineAction("error",errorMsgPopup);
    myDataProcessor.setTransactionMode("GET", false);      
    myLayout.cells("a").setText(' CASUALS PAY SLIPS  ['+selectedDateRange+']\n\
                                | [<input type="button" name="viewCasualsPayslipsListBtn" value=" Click To View Payslips " onclick="viewCasualsPayslipsList();">]\n\
                                | [<input type="button" name="reGenerateCasualsPayslipsListBtn" value=" RE-GENERATE PAYSLIPS " onclick="reGenerateCasualsPayslipsList();">]\n\
                                | [<input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">]\n\
                                | [<input type="button" name="lockCasualsPayslipBtn" value="*LOCK PAYLSIP*" onclick="lockCasualsPayslip()";">]');
}

//NOT USED - for URL lining to a cell value (column type link)
function doOnCellSelected(rid,ind,sgref) {
    console.log("[rid - ind - sgref] "+rid+" - "+ind+" - "+sgref);
    if (ind == 14) {          
        var dhxWins = new dhtmlXWindows();
        wFloornotes = dhxWins.createWindow("wFloornotes", 100, 100, 450, 400);
        wFloornotes.setText("Floornotes");
        wFloornotes.center();
        wFloornotes.attachURL('../test.php');        
    }
}
function reGenerateCasualsPayslipsList(){
    console.log("Regenerating CASUALS PaySlips......");
    var i, selectedRowID, dateRangeTxt;
    i = 0;
    console.log("LockFlg = "+myGrid.cellById(0, 20).getValue());
    if (myGrid.cellById(0, 20).getValue() == 1) {
        dhtmlx.alert({
            type: "alert-error",
            text: "Payslip locked",
            title: "Error!",
            ok: "Close"
        });
        return;
    }    
    payPeriodGrid.forEachRow(function (row_id) {
        cellValue = payPeriodGrid.cellById(row_id, 2).getValue();
        if (cellValue == 1) {
            i++;
            selectedRowID = row_id;
            dateRangeTxt = payPeriodGrid.cellById(row_id, 0).getValue() + " -to- " + payPeriodGrid.cellById(row_id, 1).getValue();
            excelFileName = "CASUALS_PaySlips_" + payPeriodGrid.cellById(row_id, 0).getValue() + "_" + payPeriodGrid.cellById(row_id, 1).getValue();
            reGenerateCasualsPayslipsGrid(selectedRowID, dateRangeTxt);
        }
    });
}
function reGenerateCasualsPayslipsGrid(selectedDateRangeRowID,selectedDateRangeTxt){
    console.log("Loading CASUALS Pay Slips.....");
    myLayout.cells("b").setText('Select Pay Period');	
    myGrid = initMyGrid("get_casuals_payslip_data_xml.php?employeeType="+employeeType+"&regenerate=1&lockPayslip="+0+"&selectedDateRangeRowID="+selectedDateRangeRowID, "a");
    myLayout.cells("a").setText(' CASUALS PAYSLIPS  ['+selectedDateRangeTxt+']\n\
                                  | <input type="button" name="viewCasualsPayslipsListBtn" value=" Click To View Payslips " onclick="viewCasualsPayslipsList();">\n\
                                  | <input type="button" name="reGenerateCasualsPayslipsListBtn" value=" RE-GENERATE PAYSLIPS " onclick="reGenerateCasualsPayslipsList();">\n\
                                  | [<input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">]\n\
                                  | [<input type="button" name="lockCasualsPayslipBtn" value="*LOCK PAYLSIP*" onclick="lockCasualsPayslip()";">]');
    myGrid.selectRow(0);
}

function lockCasualsPayslip(){
    console.log("LOCKING CASUALS PaySlips......");
    var i, selectedRowID, dateRangeTxt;
    i = 0;
    payPeriodGrid.forEachRow(function(row_id) {
        cellValue = payPeriodGrid.cellById(row_id,2).getValue();
        if(cellValue == 1) {
            i++;
            selectedRowID = row_id;
            dateRangeTxt = payPeriodGrid.cellById(row_id,0).getValue()+" -to- " +payPeriodGrid.cellById(row_id,1).getValue();
            console.log('>>>locking for opsBiWeeklyCalendarOid = '+selectedRowID+' for date range ['+dateRangeTxt+']');
            lockAndReloadCasualsPayslipGrid(selectedRowID, dateRangeTxt);
        }
    });    
}

function lockAndReloadCasualsPayslipGrid(selectedDateRangeRowID, selectedDateRangeTxt){
    console.log("Loading LOCKED CASUALS Pay Slips.....");
    myLayout.cells("b").setText('Select Pay Period');	
    myGrid = initMyGrid("get_casuals_payslip_data_xml.php?employeeType="+employeeType+"&regenerate=0&lockPayslip="+1+"&selectedDateRangeRowID="+selectedDateRangeRowID, "a");
    myLayout.cells("a").setText(' CASUALS PAYSLIPS  ['+selectedDateRangeTxt+']\n\
                                  | <input type="button" name="viewCasualsPayslipsListBtn" value=" Click To View Payslips " onclick="viewCasualsPayslipsList();">\n\
                                  | [<input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">]\n\
                                  <<< THIS PAYSLIP IS LOCKED AND CANNOT BE REGENERATED >>>');
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	FTE ADVANCE & PAYSLIPS
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function loadFTEadvanceGrid(selectedDateRangeRowID,selectedDateRange){
    console.log("Loading FTE Advance.....");
    myGrid = initMyGrid("get_FTE_advance_data_xml.php?selectedDateRangeRowID="+0, "a");
    myLayout.cells("a").setText(' FTE ADVANCE | \n\
            <input type="button" name="addNewFTEadvanceBtn" value=" Enter New Advance" onclick="addNewFTEadvance();">  |  \n\
            <input type="button" name="FTEadvanceUdptBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
        
    loadPageMenu(myLayout);    
    myDataProcessor = initMydataProcessor("update_fte_advance_data_xml.php", 0);
    myDataProcessor.setVerificator(0,not_empty);
    myDataProcessor.setVerificator(1,not_empty);
    myDataProcessor.setVerificator(1,greaterThanZero);
    myDataProcessor.setVerificator(2,not_empty);
    myDataProcessor.init(myGrid);     
}

function addNewFTEadvance(){
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID,['',0.00,'','PC','','0'],0);
    myGrid.setRowColor(rowID,"00ff66");
}

function listFTEPaySlipsGrid(){
    console.log("Loading FTE Payslips Grid.....");
    myLayout.cells("a").setText(' FTE PAYSLIPS   | <input type="button" name="viewFTEPayslipsListBtn" value=" Click To View Payslips" onclick="viewFTEPayslipsList();">');
    myLayout.cells("b").setText('Select Pay Month');
    myLayout.cells("b").setWidth(175);
    loadPageMenu(myLayout);

    displayPayMonthGrid('b');
    myGrid = initMyGrid("get_FTE_payslip_data_xml.php", "a");
}

function viewFTEPayslipsList(selectedDateRangeRowID,selectedDateRange){
	console.log("Viewing FTE PaySlips......");
	var i, selectedRowID, dateRangeTxt;
	i = 0;
	payMonthGrid.forEachRow(function(row_id) {
		cellValue = payMonthGrid.cellById(row_id,2).getValue();
		if(cellValue == 1) {
			i++;
			selectedRowID = row_id;
			dateRangeTxt = payMonthGrid.cellById(row_id,0).getValue()+" " +payMonthGrid.cellById(row_id,1).getValue();
			excelFileName = "FTE_PaySlips_"+payMonthGrid.cellById(row_id,0).getValue()+"_" +payMonthGrid.cellById(row_id,1).getValue();
			loadFTEPayslipsGrid(selectedRowID,dateRangeTxt);
		}
	});
}

function loadFTEPayslipsGrid(selectedDateRangeRowID,selectedDateRange){
	console.log("Loading FTE Pay Slips.....");
	myLayout.cells("b").setText('Select Pay Period');	
	myGrid = initMyGrid("get_FTE_payslip_data_xml.php?employeeType="+employeeType+"&regenerate="+0+"&lockPayslip="+0+"&selectedDateRangeRowID="+selectedDateRangeRowID, "a");
	myLayout.cells("a").setText(' FTE PAYSLIPS  ['+selectedDateRange+'] | [<input type="button" name="viewFTEPayslipsListBtn" value=" Click To View Payslips " onclick="viewFTEPayslipsList();">] \n\
                                    | [<input type="button" name="reGenerateFTEpayslipsListBtn" value=" RE-GENERATE PAYSLIPS " onclick="reGenerateFTEpayslipsList();">] \n\
                                    | [<input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">]  \n\
                                    | [<input type="button" name="lockFTEPayslipBtn" value="*LOCK PAYLSIP*" onclick="lockFTEPayslip()";">]');
}

function reGenerateFTEpayslipsList(){
    console.log("Regenerating FTE PaySlips......");
    var i, selectedRowID, dateRangeTxt;
    i = 0;
    
    payMonthGrid.forEachRow(function(row_id) {
        cellValue = payMonthGrid.cellById(row_id,2).getValue();
        if(cellValue == 1) {
                i++;
                selectedRowID = row_id;
                dateRangeTxt = payMonthGrid.cellById(row_id,0).getValue()+" -to- " +payMonthGrid.cellById(row_id,1).getValue();
                excelFileName = "FTE_PaySlips_"+payMonthGrid.cellById(row_id,0).getValue()+"_" +payMonthGrid.cellById(row_id,1).getValue();
                reGenerateFTEpayslipsGrid(selectedRowID,dateRangeTxt);
        }
    });
}

function reGenerateFTEpayslipsGrid(selectedDateRangeRowID,selectedDateRangeTxt){
    console.log("Loading FTE Pay Slips.....");
    myLayout.cells("b").setText('Select Pay Period');	
    myGrid = initMyGrid("get_FTE_payslip_data_xml.php?employeeType="+employeeType+"&regenerate="+1+"&lockPayslip="+0+"&selectedDateRangeRowID="+selectedDateRangeRowID, "a");
    myLayout.cells("a").setText(' FTE PAYSLIPS  ['+selectedDateRangeTxt+']   \n\
                                | <input type="button" name="viewFTEPayslipsListBtn" value=" Click To View Payslips " onclick="viewFTEPayslipsList();">  \n\
                                | <input type="button" name="reGenerateFTEpayslipsListBtn" value=" RE-GENERATE PAYSLIPS " onclick="reGenerateFTEpayslipsList();">  \n\
                                | [<input type="button" name="lockFTEPayslipBtn" value="*LOCK PAYLSIP*" onclick="lockFTEPayslip()";">]');
    myGrid.selectRow(0);
}

function lockFTEPayslip(){
	console.log("LOCKING FTE PaySlips......");
	var i, selectedRowID, dateRangeTxt;
	i = 0;
	payMonthGrid.forEachRow(function(row_id) {
            cellValue = payMonthGrid.cellById(row_id,2).getValue();
            if(cellValue == 1) {
                i++;
                selectedRowID = row_id;
                dateRangeTxt = payMonthGrid.cellById(row_id,0).getValue()+" -to- " +payMonthGrid.cellById(row_id,1).getValue();
                console.log('>>>locking for opsMonthlyCalendarOid = '+selectedRowID+' for date range ['+dateRangeTxt+']');
                lockAndReloadFTEpayslipGrid(selectedRowID, dateRangeTxt);
            }
	});    
    
}

function lockAndReloadFTEpayslipGrid(selectedDateRangeRowID, selectedDateRangeTxt){
    console.log("Loading LOCKED FTE Pay Slips.....");
    myLayout.cells("b").setText('Select Pay Period');	
	myGrid = initMyGrid("get_FTE_payslip_data_xml.php?employeeType="+employeeType+"&regenerate="+1+"&lockPayslip="+1+"&selectedDateRangeRowID="+selectedDateRangeRowID, "a");
	myLayout.cells("a").setText(' FTE PAYSLIPS  ['+selectedDateRangeTxt+']   \n\
                                    | <input type="button" name="viewFTEPayslipsListBtn" value=" Click To View Payslips " onclick="viewFTEPayslipsList();">  \n\
                                    | <input type="button" name="reGenerateFTEpayslipsListBtn" value=" RE-GENERATE PAYSLIPS " onclick="reGenerateFTEpayslipsList();">  \n\
                                  <<< THIS PAYSLIP IS LOCKED NOW AND CANNOT BE REGENERATED >>>');
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	SALARY MGMT
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function employeeSalaryGrid(){
	console.log("Loading employeeSalaryGrid.....");
	myLayout.cells("a").setText('Employee Salaries | <input type="button" name="some_name" value=" Update Changes" onclick="myDataProcessor.sendData();">');
	myGrid = initMyGrid("get_salary_data_xml.php", "a");
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	HELPERS get_otherWorkPayroll_data_xml.php
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function loadView(view){
	if (myLayout != null) {
		myLayout.unload();
		console.log("unLoading myLayout.....");
		myLayout = null;
	}
	myLayout = new dhtmlXLayoutObject({
					parent: "layoutObj",
					pattern: view
					});
}

function doOnLoad() {
	loadView('4G');
	generatePayrollGrid();
}

function displayPayPeriodGrid(view){
	payPeriodGrid = myLayout.cells(view).attachGrid();
	payPeriodGrid.setImagePath("codebase/imgs/");
	payPeriodGrid.setDateFormat("%M.%d.%Y");
	payPeriodGrid.load("functions/get_OpsBiWeeklyCalendar_data_xml.php");
	
	payPeriodGrid.attachEvent("onCheck", function(rId,cInd,state){
            console.log("OnCheck event......");
            payPeriodGrid.setRowTextNormal(savedRowID);
            payPeriodGrid.setRowTextBold(rId);
            savedRowID = rId;
	});
	payPeriodGrid.init();
}

function displayPayMonthGrid(view){
    payMonthGrid = myLayout.cells(view).attachGrid();
    payMonthGrid.setImagePath("codebase/imgs/");
    payMonthGrid.setDateFormat("%M.%d.%Y");
    payMonthGrid.load("functions/get_OpsMonthlyCalendar_data_xml.php");

    payMonthGrid.attachEvent("onCheck", function(rId,cInd,state){
            console.log("OnCheck event......");
            payMonthGrid.setRowTextNormal(savedRowID);
            payMonthGrid.setRowTextBold(rId);
            savedRowID = rId;
    });
    payMonthGrid.init();
}


function setDatePickerDateToToday(){
	var getCurDateArr= get_currentDate_Arr();
	$('#box').val(monthNames[getCurDateArr.actualMonth]+" "+getCurDateArr.day+" "+  getCurDateArr.year);					
}

function loadPageMenu(aLayout){
	myMenu = aLayout.attachMenu({
		icons_path: "dhtmlxMenu/common/imgs/",
		xml: "dhtmlxMenu/common/dhxmenu_payroll.xml",
	});
	myMenu.attachEvent("onClick", function(id, zoneId, cas){

		if (id == "generate_payrolls") {
			employeeType = 'C';
			loadView('4G');			
			generatePayrollGrid();
		}	
		
		else if (id == "casuals_payslips") {
			employeeType = 'C';
			loadView('2U');			
			listCasualsPaySlipsGrid();
		}
		
		else if (id == "fte_payslips") {
			employeeType = 'S';
			loadView('2U');	
			listFTEPaySlipsGrid();
		} 
                

		else if (id == "fte_advance") {
			employeeType = 'S';
			loadView('1C');	
                        loadFTEadvanceGrid();
		}            
		// else if (id == "salary_list") {
			// employeeSalaryGrid();
		// }
		
		else {}

	});	
}

function get_currentDate_Arr(){
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = (now.getMonth() + 1);
	var month2 = now.getMonth();
	var today = (month)+"/"+(day)+"/"+now.getFullYear();
	return {'day':day,'month':month,'year':now.getFullYear(),'actualMonth':month2};
}

function setDatePickerDateToToday(){
	var getCurDateArr = get_currentDate_Arr();
	$('#box').val(monthNames[getCurDateArr.actualMonth]+" "+getCurDateArr.day+" "+  getCurDateArr.year);					
}

function checkAll(){
	/*
	Checked row for pertucular cell and id
	*/
	mygrid.setCheckedRows(3,1);
}	

function eXcell_myPrice(cell){ //the eXcell name is defined here
	if (cell){ 	// the default pattern
		this.cell = cell;
		this.grid = this.cell.parentNode.grid;
		eXcell_ed.call(this); //uses methods of the "ed" type
	}
	this.setValue=function(val){
		var cVal= two_decimal(val);
		/* actual data processing */
		this.setCValue("<span class='kes_color'>KES </span><span>"+cVal+"</span>",cVal);                                        
	}
	this.getValue=function(){       	/* getting the value */
		return this.cell.childNodes[1].innerHTML;
	}
}
/* nests all other methods from the base class */
eXcell_myPrice.prototype = new eXcell;			
function two_decimal(num){
	var num= parseFloat(num);
	var n = num.toFixed(2);
	return n;	
}

function eXcell_kenyaCurrency(cell){ 
	if (cell){ 	
		this.cell = cell;
		this.grid = this.cell.parentNode.grid;
		eXcell_ed.call(this); //uses methods of the "ed" type
	}
	this.setValue=function(val){
		var cVal= two_decimal(val);
		/* actual data processing */
		this.setCValue("<b><span class='kes_color'>KES </span></b><span>"+cVal+"</span>",cVal);                                        
	}
	this.getValue=function(){       	/* getting the value */
		return this.cell.childNodes[1].innerHTML;
	}
}
eXcell_kenyaCurrency.prototype = new eXcell;	
		
function eXcell_kgWeight(cell){ //the eXcell name is defined here
	if (cell){ 	// the default pattern
		this.cell = cell;
		this.grid = this.cell.parentNode.grid;
		eXcell_ed.call(this); //uses methods of the "ed" type
	}
	this.setValue=function(val){
		var cVal= two_decimal(val);
		/* actual data processing */
		this.setCValue("<span>"+cVal+"</span><b><span class='kes_color'> kg</span></b>",cVal);                                        
	}
	this.getValue=function(){       	/* getting the value */
		return this.cell.childNodes[1].innerHTML;
	}
}
eXcell_kgWeight.prototype = new eXcell;	

function addLoanPmt(row_id, rowIndex){
    console.log('row_id = '+ row_id);
    console.log('rowIndex = '+ rowIndex);
    amt = myGrid.cellById(row_id,14).getValue();
    console.log('amt = '+ amt);
    console.log('typeof amt = '+ typeof amt);
}
function two_decimal(num){
	var num= parseFloat(num);
	var n = num.toFixed(2);
	return n;
}
function eXcell_getDetail(cell){  // the eXcell name is defined here
    if (cell){                  // the default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function(){}   // read-only cell doesn't have edit method
    // the cell is read-only, so it's always in the disabled state
    this.isDisabled = function(){ return true; }
    this.setValue=function(val){
        var row_id=this.cell.parentNode.idd;     // gets the id of the related row
	var rowIndex=myGrid.getRowIndex(row_id);
		var cVal= two_decimal(val);
		/* actual data processing */
		this.setCValue("<b><span class='kes_color'>KES </span></b><span><a href='test.php?flag='"+row_id+">"+cVal+"</a></span>",cVal);
        //<a href='https://www.w3schools.com/html/'>Visit our HTML tutorial</a>
    }
    this.getValue=function(){       	/* getting the value */
            return this.cell.childNodes[1].innerHTML;
    }    
}
eXcell_getDetail.prototype = new eXcell; 	

function two_decimal(num){
	var num= parseFloat(num);
	var n = num.toFixed(2);
	return n;	
}
