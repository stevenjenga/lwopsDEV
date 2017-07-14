/* global myLayout, pAndLmonthGrid */
var selectedPandLgrid;

function otherDeptIncomeGrid(){
    console.log('Other Income capture grid....');
    myLayout.cells("a").setText('CAPTURE OTHER INCOME |  \n\
                                <input type="button" name="addOtherDeptIncomeBtn" value="Enter New Income " onclick="addOtherDeptIncome();">  |  \n\
                                <input type="button" name="otherDeptIncomeUdptBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    
    loadPageMenu(myLayout);
    setDatePickerDateToToday();
    initMyCalendar("get_other_dept_income_data_xml.php");

    myGrid = initMyGridNew("get_other_dept_income_data_xml.php");
    myGrid.attachHeader("#combo_filter,#combo_filter,&nbsp;,&nbsp;");
    
    myDataProcessor = initMydataProcessor("update_other_dept_income_data.php", 0);
    myDataProcessor.init(myGrid);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(3, greaterThanZero);
}

function PandLincomeGrid(gridType){
    console.log('loading PandL grid for:'+gridType);
    selectedPandLgrid = gridType;
    loadPandLgrid();
    loadPageMenu(myLayout);
}

function getPandLdata(){
    console.log("getPandLdata for:"+selectedPandLgrid);    
    loadPandLgrid();
}

function loadPandLgrid(){
    console.log("Loading PandL for:"+selectedPandLgrid);
    getDataXmlFile = "get_PandL_income_data_xml.php?selectedPandLgrid="+selectedPandLgrid;
    myGrid = myLayout.cells("a").attachGrid('gridbox');
    myGrid.setImagePath("codebase/imgs/");
    myGrid.setDateFormat("%M.%d.%Y");
    myGrid.enableAutoWidth(true);
    myGrid.enableEditEvents(true, false, true);
    
    //disable grid sorting
    myGrid.attachEvent("onBeforeSorting", function(ind,type,direction){
        console.log("PandLincomeGrid(): onBeforeSorting event fired...");
        return false;
    });

    myGrid.init();
    myGrid.enableSmartRendering(true, 50);
    myGrid.attachEvent("onXLE",showLoading);
    myGrid.attachEvent("onXLS",function(){showLoading(true)});//setOnLoadingStart(function(){showLoading(true)})    
    
    //load grid AND highlight totals rows
    myGrid.load("functions/" + getDataXmlFile,function(){
                                            myGrid.forEachRow(function(id){
                                                var rIndex = myGrid.getRowIndex(id);
                                                var cellObj = myGrid.cellByIndex(rIndex, 0);
                                                var value = cellObj.getValue();
                                                highlightTotalsRow(id,value);                                                
                                            })
			});    
    
    myLayout.cells("a").setText(selectedPandLgrid+' P&L  |  [<input type="button" name="exportToExcelBtn" value=" Export " onclick="exportToExcel()";">]');
    excelFileName = selectedPandLgrid+" P and L Report";
}


function highlightTotalsRow(id,value){
    if (/GROSS/.test(value) || /TOTAL/.test(value) || /NET/.test(value)) {
        console.log("id="+id); 
        console.log("value="+value); 
        myGrid.setRowTextBold(id);
        highlightNegativeValues(id);
    }
}

function highlightNegativeValues(id){
    var i;
    myGrid.forEachCell(id,function(cellObj,ind){
    //execute code for each cell in a row with the id "row1" 
    //cellObj - related cell object
    //ind - column index
        if (cellObj.getValue() < 0) {
            console.log("cell value="+cellObj.getValue());
            cellObj.setTextColor('red')
        }
    });    
}

function showLoading(fl){
    console.log("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX");
    var span = document.getElementById("recfound");
    if (!span) return;
    if(!myGrid._serialise){
            span.innerHTML = "<i>Loading... available in Professional Edition of dhtmlxGrid</i>"
            return;
    }
    span.style.color = "red";
    if(fl===true)
            span.innerHTML = "loading...";
    else
            span.innerHTML = "";
}
                
function displayPandLmonthGrid(view){
    pAndLmonthGrid = myLayout.cells(view).attachGrid();
    pAndLmonthGrid.setImagePath("codebase/imgs/");
    pAndLmonthGrid.setDateFormat("%M.%d.%Y");
    pAndLmonthGrid.load("functions/get_OpsMonthlyCalendar_data_xml.php?chkBox="+'1');

    pAndLmonthGrid.attachEvent("onCheck", function(rId,cInd,state){
        pAndLmonthGrid.setRowTextNormal(savedRowID);
        pAndLmonthGrid.setRowTextBold(rId);
        savedRowID = rId;
    });
    pAndLmonthGrid.init();
}

function addOtherDeptIncome(){
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', '0.00'], 0);
    myGrid.setRowColor(rowID, "00ff66");    
}