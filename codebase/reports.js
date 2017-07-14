var reportName;
var myLayout, payPeriodGrid, payMonthGrid;
var startDateRange, endDateRange;

function attendanceReportGrid(){
    console.log("Loading Attendance report.....");
    myLayout.cells("a").setText(' ATTENDANCE REPORT   | \n\
                                <input type="button" name="generateAttendanceRptBtn" value="Run Report" onclick="generateAttendanceRpt();">');
    myLayout.cells("b").setText('Select Attendance Period');
    myLayout.cells("b").setWidth(255);
    loadPageMenu(myLayout);
    displayPayPeriodGrid('b');
}

function generateAttendanceRpt(){
    var i, selectedRowID, dateRange;
    console.log('generateAttendanceRpt()');
    i = 0;
    payPeriodGrid.forEachRow(function(row_id) {
            cellValue = payPeriodGrid.cellById(row_id,2).getValue();
            console.log('generateAttendanceRpt() B4 cellValue='+cellValue);
            if(cellValue == 1) {
                console.log('generateAttendanceRpt() AFTER cellValue='+cellValue);
                i++;
                selectedRowID = row_id;
                dateRange = payPeriodGrid.cellById(row_id,0).getValue()+" -to- " +payPeriodGrid.cellById(row_id,1).getValue();
                excelFileName = "Attendance_"+payPeriodGrid.cellById(row_id,0).getValue()+"_" +payPeriodGrid.cellById(row_id,1).getValue();
                loadAttendanceRptGrid(selectedRowID,dateRange);
            }
    });
}

function loadAttendanceRptGrid(selectedRowID,selectedDateRange){
    console.log('loadAttendanceRptGrid(() selectedDateRange='+selectedDateRange);
    myLayout.cells("a").setText('ATTENDANCE REPORT >>>| <input type="button" name="generateAttendanceRptBtn" value="Run Report" onclick="generateAttendanceRpt();"> - <b>['+selectedDateRange+']</b> - <input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">');
    myGrid = initMyGridX("get_attendance_report_data_xml.php?selectedRowID="+selectedRowID, "a", true);
}

function teaPickedReportGrid(){
    console.log("Loading Tea Picked report.....");
    myLayout.cells("a").setText(' TEA PICKING REPORT   | <input type="button" name="generateTeaPickedRptBtn" value="Run Report" onclick="generateTeaPickedRpt();">');
    myLayout.cells("b").setText('Select Attendance Period');
    myLayout.cells("b").setWidth(255);
    loadPageMenu(myLayout);

    displayPayPeriodGrid('b');    
}

function generateTeaPickedRpt(){
    var i, selectedRowID, dateRange;

    i = 0;
    payPeriodGrid.forEachRow(function(row_id) {
            cellValue = payPeriodGrid.cellById(row_id,2).getValue();
            if(cellValue == 1) {
                i++;
                selectedRowID = row_id;
                dateRange = payPeriodGrid.cellById(row_id,0).getValue()+" -to- " +payPeriodGrid.cellById(row_id,1).getValue();
                excelFileName = "TeaPickingReport_"+payPeriodGrid.cellById(row_id,0).getValue()+"_" +payPeriodGrid.cellById(row_id,1).getValue();
                loadTeaPickedGrid(selectedRowID,dateRange);
            }
    });    
}
function loadTeaPickedGrid(selectedRowID,selectedDateRange){
    console.log('selectedDateRange='+selectedDateRange);
    myLayout.cells("a").setText('TEA PICKING REPORT >>>| <input type="button" name="generateTeaPickedRptBtn" value="Run Report" onclick="generateTeaPickedRpt();"> - <b>['+selectedDateRange+']</b> - <input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">');
    myGrid = initMyGridX("get_tea_picking_report_data_xml.php?selectedRowID="+selectedRowID, "a", true);
}

function monthlyTeaDeliveryStatementReportGrid(){
    console.log("Loading Monthly stmt report.....");
    myLayout.cells("a").setText('MONTHLY TEA FACTORY STATEMENT   | <input type="button" name="generateMonthlyTeaDeliveryStatementBtn" value="Run Report" onclick="generateMonthlyTeaDeliveryStatement();">');
    myLayout.cells("b").setText('Select Month');
    myLayout.cells("b").setWidth(255);
    loadPageMenu(myLayout);

    displayPayMonthGrid('b');   
}

function generateMonthlyTeaDeliveryStatement(){
    var i, selectedRowID, dateRange;
    i = 0;
    payMonthGrid.forEachRow(function(row_id) {
            cellValue = payMonthGrid.cellById(row_id,2).getValue();
            if(cellValue == 1) {
                    i++;
                    selectedRowID = row_id;
                    dateRangeTxt = payMonthGrid.cellById(row_id,0).getValue()+" " +payMonthGrid.cellById(row_id,1).getValue();
                    excelFileName = "FTE_PaySlips_"+payMonthGrid.cellById(row_id,0).getValue()+"_" +payMonthGrid.cellById(row_id,1).getValue();
                    loadMonthlyStmtGrid(selectedRowID,dateRangeTxt);
            }
    });;     
}

function loadMonthlyStmtGrid(selectedRowID,selectedDateRange){
    console.log('selectedDateRange='+selectedDateRange);
    myLayout.cells("a").setText('MONTHLY TEA FACTORY STATEMENT for '+selectedDateRange+'   | <input type="button" name="generateMonthlyTeaDeliveryStatementBtn" value="Run Report" onclick="generateMonthlyTeaDeliveryStatement();"> - <b>['+selectedDateRange+']</b> - <input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">');
    myGrid = initMyGridX("get_tea_factory_delivery_report_data_xml.php?selectedRowID="+selectedRowID, "a", true);
}

function rolesReportGrid(){
    console.log("Loading Roles report.....");
    reportName = 'ROLES';    
    excelFileName = reportName+"_REPORT";
    loadPageMenu(myLayout);
    generateStdRpt();
}
function expenseByDeptReportGrid(){
    console.log("Loading Expense report.....");
    myLayout.cells("a").setText('EXPENSES_BY_DEPT \n\
                                [From Date: <input id="cal1" type="text" value="" placeholder="select date"> \n\
                                 To Date: <input id="cal2" type="text" value="" placeholder="select date">] - \n\
                                <input type="button" name="filterDateByRangeBtn" value="Run Report" onclick="filterDateByRange();"> \n\
                                [<input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">]');
    reportName = 'EXPENSES_BY_DEPT'; 
    excelFileName = reportName+"_REPORT";
    loadPageMenu(myLayout);
    
    var startDtCalendar = new dhtmlXCalendarObject("cal1");
    startDtCalendar.setSensitiveRange("2016-12-23", new Date());
    startDtCalendar.attachEvent("onClick", function (d) {
        startDateRange = document.getElementById("cal1").value;
        console.log("date2 = "+startDateRange);
    });    

    var endDtCalendar = new dhtmlXCalendarObject("cal2");   
    endDtCalendar.setSensitiveRange("2016-12-28", new Date());
    endDtCalendar.attachEvent("onClick", function (d) {
        endDateRange = document.getElementById("cal2").value;
        console.log("date2 = "+endDateRange);
    });       
}

function salesByCustomerReportGrid(){
    console.log("Loading Sales report.....");
    myLayout.cells("a").setText('SALES_BY_CUSTOMER [From Date: <input id="cal1" type="text" value="" placeholder="select date"> \n\
                                 To Date: <input id="cal2" type="text" value="" placeholder="select date">] - \n\
                                <input type="button" name="filterDateByRangeBtn" value="Run Report" onclick="filterDateByRange();"> \n\
                                [<input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">]');
    reportName = 'SALES_BY_CUSTOMER'; 
    excelFileName = reportName+"_REPORT";
    loadPageMenu(myLayout);
    
    var startDtCalendar = new dhtmlXCalendarObject("cal1");
    startDtCalendar.setSensitiveRange("2016-12-23", new Date());
    startDtCalendar.attachEvent("onClick", function (d) {
        startDateRange = document.getElementById("cal1").value;
        console.log("date2 = "+startDateRange);
    });    

    var endDtCalendar = new dhtmlXCalendarObject("cal2");   
    endDtCalendar.setSensitiveRange("2016-12-28", new Date());
    endDtCalendar.attachEvent("onClick", function (d) {
        endDateRange = document.getElementById("cal2").value;
        console.log("date2 = "+endDateRange);
    });       
}

function genericReportGrid(rptName){
    console.log("Loading "+rptName+" report.....");
    reportName = rptName;
    myLayout.cells("a").setText(reportName + ' [From Date: <input id="cal1" type="text" value="" placeholder="select date"> \n\
                                 To Date: <input id="cal2" type="text" value="" placeholder="select date">] - \n\
                                <input type="button" name="filterDateByRangeBtn" value="Run Report" onclick="filterDateByRange();"> \n\
                                [<input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">]');
     
    excelFileName = reportName+"_REPORT";
    loadPageMenu(myLayout);
    
    var startDtCalendar = new dhtmlXCalendarObject("cal1");
    startDtCalendar.setSensitiveRange("2016-12-23", new Date());
    startDtCalendar.attachEvent("onClick", function (d) {
        startDateRange = document.getElementById("cal1").value;
        console.log("date2 = "+startDateRange);
    });    

    var endDtCalendar = new dhtmlXCalendarObject("cal2");   
    endDtCalendar.setSensitiveRange("2016-12-23", new Date());
    endDtCalendar.attachEvent("onClick", function (d) {
        endDateRange = document.getElementById("cal2").value;
        console.log("date2 = "+endDateRange);
    });    
}

function filterDateByRange(){
    getDataXmlFile = "reports/get_std_report_data_xml.php?reportName="+reportName+"&startDateRange="+startDateRange+"&endDateRange="+endDateRange; 
    
    myGrid = myLayout.cells('a').attachGrid('gridbox');
    myGrid.setImagePath("skins/web/imgs/dhxgrid_web/");

    myGrid.setDateFormat("%M.%d.%Y");
    myGrid.enableAutoWidth(true);
    myGrid.enableEditEvents(true, false, true);
    myGrid.load("functions/" + getDataXmlFile);
    console.log("reports grid loaded...");
    myGrid.init();
    myGrid.attachHeader("&nbsp;,#combo_filter,&nbsp;,&nbsp;,&nbsp;");
    return myGrid;
}

function generateStdRpt(){
    var i, selectedRowID, dateRange;
    console.log('generateStdRpt() for '+reportName);  
    myLayout.cells("a").setText('<<<< '+reportName+' REPORT >>> <input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">');
    myGrid = initMyGridX("reports/get_std_report_data_xml.php?reportName="+reportName, "a");
}
